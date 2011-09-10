CREATE TABLE IF NOT EXISTS Projects
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50),
	description TEXT,
	logoPath VARCHAR(50) COMMENT 'full path to image, needs to work as-is in <img> tag',
	url VARCHAR(50) COMMENT 'used as actual link, so URL needs to work as-is',
	startDate DATE,
	endDate DATE COMMENT 'NULL means I still participate in this project',
	CHECK( name IS NOT NULL OR description IS NOT NULL )
);
