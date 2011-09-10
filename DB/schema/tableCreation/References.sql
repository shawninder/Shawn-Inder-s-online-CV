CREATE TABLE IF NOT EXISTS `References`
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	person INT NOT NULL,
	description TEXT COMMENT 'How is this person able to evaluate me',
	FOREIGN KEY (person) REFERENCES Persons(id) ON DELETE RESTRICT ON UPDATE CASCADE
);
