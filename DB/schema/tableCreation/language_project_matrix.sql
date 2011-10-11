CREATE TABLE IF NOT EXISTS language_project_matrix
(
	language INT NOT NULL,
	project INT NOT NULL,
	description TEXT NOT NULL,
	FOREIGN KEY (language) REFERENCES Languages(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (projects) REFERENCES Projects(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	PRIMARY KEY (language, projects)
);
