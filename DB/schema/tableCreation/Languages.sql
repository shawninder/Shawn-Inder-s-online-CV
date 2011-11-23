CREATE TABLE IF NOT EXISTS Languages
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	shortName VARCHAR(25),
	comment VARCHAR(100) COMMENT 'Something like Mother tongue, Scripted, Object-Oriented, compiled...',
	selfEvaluation TEXT,
	isHuman BOOL NOT NULL
);
