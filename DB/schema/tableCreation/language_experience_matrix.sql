CREATE TABLE IF NOT EXISTS language_experience_matrix
(
	language INT NOT NULL,
	experience INT NOT NULL,
	description TEXT NOT NULL,
	FOREIGN KEY (language) REFERENCES Languages(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (experience) REFERENCES Experiences(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	PRIMARY KEY (language, experience)
);
