CREATE TABLE IF NOT EXISTS Referrals
(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	author INT,
	body TEXT NOT NULL,
	receptionDate DATE,
	FOREIGN KEY (author) REFERENCES People(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

