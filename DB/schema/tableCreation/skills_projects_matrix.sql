CREATE TABLE IF NOT EXISTS skills_projects_matrix
(
	skill INT NOT NULL,
	project INT NOT NULL,
	description TEXT COMMENT 'Describes what was done/learned during this project using this skill',
	FOREIGN KEY (skill) REFERENCES Skills(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (project) REFERENCES Projects(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	PRIMARY KEY (skill, project)
);
