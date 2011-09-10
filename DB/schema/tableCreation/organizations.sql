CREATE TABLE IF NOT EXISTS Organizations
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY_KEY,
	name VARCHAR(50) NOT NULL,
	description TEXT,
	logoPath VARCHAR(50) COMMENT 'full path to image, needs to work as-is in <img> tag',
	url VARCHAR(50) COMMENT 'used as actual link, so URL needs to work as-is',
);
