CREATE TABLE IF NOT EXISTS experiences_referrals_matrix
(
	experience INT NOT NULL,
	referral INT NOT NULL,
	FOREIGN KEY (experience) REFERENCES Experiences(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (referral) REFERENCES Referrals(id) ON DELETE RESTRICT ON UPDATE CASCADE,
	PRIMARY_KEY(experience, referral)
);

