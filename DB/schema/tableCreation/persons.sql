CREATE TABLE IF NOT EXISTS Persons
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(50),
	lastName VARCHAR(50),
	gender enum('male', 'female'),
	position VARCHAR(50),
	organization INT,
	email VARCHAR(50),
	FOREIGN KEY (organization) REFERENCES Organizations(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	CHECK (firstName IS NOT NULL OR (lastName IS NOT NULL AND gender IS NOT NULL)),
	CHECK ((organization IS NULL AND position IS NULL) OR organization IS NOT NULL)
)
