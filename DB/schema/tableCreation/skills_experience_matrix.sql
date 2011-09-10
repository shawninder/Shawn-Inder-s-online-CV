CREATE TABLE IF NOT EXISTS skills_experience_matrix
(
	skill INT NOT NULL,
	experience INT NOT NULL,
	description TEXT COMMENT 'Describes what was done/learned during this experience using this skill',
	FOREIGN KEY (skill) REFERENCES Skills(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (experience) REFERENCES Experience(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	PRIMARY_KEY (skill, experience)
);
