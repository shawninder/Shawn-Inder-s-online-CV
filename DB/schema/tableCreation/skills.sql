CREATE TABLE IF NOT EXISTS Skills
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL COMMENT 'simply the name of the language (or software or other) concerned',
	url VARCHAR(50)
);
