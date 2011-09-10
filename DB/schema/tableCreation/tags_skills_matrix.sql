CREATE TABLE IF NOT EXISTS tags_skills_matrix
(
	tag INT NOT NULL,
	skill INT NOT NULL,
	FOREIGN KEY (tag) REFERENCES Tags(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (skill) REFERENCES Skills(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	PRIMARY KEY (tag, skill)
);
