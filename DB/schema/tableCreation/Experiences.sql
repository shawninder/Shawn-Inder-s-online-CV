CREATE TABLE IF NOT EXISTS Experiences
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	organization INT,
	position VARCHAR(50),
	jobDescription TEXT,
	startDate DATE,
	endDate DATE COMMENT 'NULL means I still occupy this position',
	FOREIGN KEY (organization) REFERENCES Organizations(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
