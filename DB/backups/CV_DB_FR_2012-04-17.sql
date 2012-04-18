--
-- MySQL 5.1.61
-- Wed, 18 Apr 2012 02:10:27 +0000
--

CREATE TABLE `Experiences` (
   `id` int(11) not null auto_increment,
   `organization` int(11),
   `title` varchar(100),
   `description` text,
   `startDate` date,
   `endDate` date,
   PRIMARY KEY (`id`),
   KEY `organization` (`organization`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('1', '1', 'Programmeur Analyste Scientifique (stage)', 'J\'ai développé pour la section des applications des modèles de qualité de l\'air d\'Environnement Canada, divers produits logiciels. Ceux-ci fournissent des observations et des prévisions au public, à des développeurs web ainsi qu\'à des prévisionnistes en qualité de l\'air partout au pays.', '2011-05-05', '2011-08-12');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('2', '3', 'Concepteur et Développeur Web', 'J\'ai travaillé sur WebÉchange avec pour but de faciliter l\'inscription aux programmes d\'échanges pour les étudiants qui désirent partir et l\'étude des dossiers pour les membres des administrations des écoles concernées.\nJ\'ai offert à tous ces utilisateurs de nouvelles possibilités qui facilitent le processus d\'étude à l\'étranger. Étant seul sur le projet pendant la majorité de mon mandat, j\'étais responsable également du contrôle de la qualité, du rapport avec le client et de la réponse aux urgences.', '2009-05-02', '2011-05-05');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('3', '2', 'Administrateur de Base de Données et Consultant Logiciel', 'J\'ai apporté plusieurs modifications au système comptable de Kheops International afin de permettre de nouvelles possibilités, notamment au niveau de la gestion de l\'inventaire et de la fixe des prix. J\'ai également profité de mes connaissances techniques pour aider à l\'élaboration d\'une stratégie à long terme en ce qui concerne les logiciels utilisés par l\'entreprise.', '2011-08-01', '');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('4', '4', 'Concepteur et Développeur Web (bénévole)', 'Je suis l\'un des quatres membres fondateurs de KiungoWiki, un wiki de musique rassemblant un maximum d\'information sur les artistes, les chansons et les enregistrements. Bien que ma tâche principale soit de concevoir et de développer l\'expérience et l\'interface utilisateur, je participe depuis le début à la prise de décisions couvrant l\'étendue du projet.', '2010-10-10', '');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('5', '5', 'Concepteur & Développeur Web', 'Le site web sur lequel vous vous trouvez est ma façon de présenter mes expériences et de démontrer mes compétences et ma passion pour le domaine du web. J\'ai décider d\'apporter une touche novatrice au curriculum vitea classique en explicitant les liens qui existent entre mes compétences et les expériences de travail qui m\'ont permis de perfectionner ces dernières.', '2011-10-01', '');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('6', '6', 'Projet scolaire: Jeu de course multijoueur en 3D', 'Avec cinq partenaires, j\'ai créé en quatre mois un jeu de course automobile complet avec éditeur de niveaux, intelligence artificielle et obstacles interactifs. Ce projet a mis à l\'épreuve la capacité de chaque membre de l\'équipe à travailler sous pression avec des échéances et des critères d\'évaluation très précis.', '2011-01-10', '2011-05-18');

CREATE TABLE `Languages` (
   `name` varchar(32) not null,
   `stars` tinyint(3) unsigned not null,
   PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `Languages` (`name`, `stars`) VALUES ('Anglais', '5');
INSERT INTO `Languages` (`name`, `stars`) VALUES ('Français', '5');

CREATE TABLE `Organizations` (
   `id` int(11) not null auto_increment,
   `name` varchar(100),
   `description` text,
   `url` varchar(100),
   `location` varchar(100),
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('1', 'Environnement Canada', 'Environnement Canada a pour mandat de préserver et d\'améliorer la qualité de l\'environnement naturel, de conserver les ressources renouvelables du Canada, de conserver et protéger les ressources en eau du Canada, de prévoir les conditions et les avertissements météorologiques quotidiens, de fournir des renseignements météorologiques détaillés à l\'ensemble du Canada, d\'appliquer la législation sur les eaux limitrophes et de coordonner les politiques et les programmes environnementaux au nom du gouvernement fédéral.', 'http://www.ec.gc.ca/', 'Dorval, QC');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('2', 'Kheops International', 'Kheops International est une compagnie d\'importation, de distribution et un grossiste de cadeaux significatifs ayant pour but d\'inspirer et d\'unifier les gens, de promouvoir le bien-être, ou simplement de créer un rapprochement avec la nature. Leurs représentant parcours le globe à la recherche des meilleurs produits métaphysiques/nouvel âge sur le marché.', 'http://www.kheopsinternational.com/', 'Colebrooke, NH');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('3', 'WebÉchange - École Polytechnique de Montréal', 'Le Service aux étudiants de Polytechnique s\'efforce à favoriser la réussite des étudiants autant sur le plan académique que personnel en offrant une gamme de ressources et de services dont des programmes d\'échanges à l\'étranger, d\'aide financière et autres.', 'http://www.groupes.polymtl.ca/echanges/accueil.php', 'Montréal, QC');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('4', 'KiungoWiki', 'Un wiki pour les artistes, les chansons, les enregistrements et les liens qui relients tout ça ensemble.', 'http://kiungowiki.org', 'Montreal, QC');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('5', 'CV interactif de Shawn Inder', 'Ce site web! Je voulais un CV qui détaille mes compétences et mon expérience de travaille tout en démontrant mon enthousiasme et ma créativité en offrant une façon nouvelle et unique de voir le CV.', '', 'Montréal, QC');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('6', 'Projet scolaire à l\'École Polytechnique de Montréal', '', 'http://www.polymtl.ca/etudes/cours/details.php?sigle=INF2990', 'Montréal, QC');

CREATE TABLE `Persons` (
   `id` int(11) not null auto_increment,
   `firstName` varchar(50),
   `lastName` varchar(50),
   `gender` enum('male','female'),
   `position` varchar(100),
   `organization` int(11),
   `email` varchar(50),
   PRIMARY KEY (`id`),
   KEY `organization` (`organization`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;

INSERT INTO `Persons` (`id`, `firstName`, `lastName`, `gender`, `position`, `organization`, `email`) VALUES ('1', 'David', 'Anselmo', 'male', 'Météorologiste', '1', 'david.anselmo@ec.gc.ca');
INSERT INTO `Persons` (`id`, `firstName`, `lastName`, `gender`, `position`, `organization`, `email`) VALUES ('2', 'Paul-André', 'Beaulieu', 'male', 'Programmeur Analyste Scientifique', '1', 'paul-andre.beaulieu@ec.gc.ca');
INSERT INTO `Persons` (`id`, `firstName`, `lastName`, `gender`, `position`, `organization`, `email`) VALUES ('3', 'Micheline', 'Freyssonnet', 'female', 'Coordonnatrice du marketing', '2', 'micheline@kheopsinternational.com');
INSERT INTO `Persons` (`id`, `firstName`, `lastName`, `gender`, `position`, `organization`, `email`) VALUES ('4', 'Annick', 'Corbeil', 'female', 'Coordonnatrice des programmes de mobilité internationale', '3', 'annick.corbeil@etsmtl.ca');

CREATE TABLE `Referral_excerpts` (
   `id` int(11) not null auto_increment,
   `title` varchar(100) default 'What others have said about me',
   `referral` int(11),
   `body` text not null,
   PRIMARY KEY (`id`),
   KEY `referral` (`referral`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=17;

INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('1', '', '1', '(traduit de l\'anglais) Ces réalisations ont largement dépassé nos plus grandes attentes pour un étudiant arrivant de l\'extérieur et ne connaissant rien de nos processus internes.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('2', 'Livre la marchandise', '2', '(traduit de l\'anglais) Pendant son stage, Shawn a été capable de travailler sur différents projets, mettant à profit le temps où il devait attendre la rétroaciton de clients. Le résultat de cette efficacité a été de complété plus de tâches que nous croyions possible initialement.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('7', 'Livre la marchandise', '1', '(traduit de l\'anglais) Il est exceptionnel de voir la rapidité avec laquelle Shawn est devenu un membre productif de notre équipe. En deux semaines, il avait déjà terminé le développement de notre premier produit.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('8', 'Esprit d\'équipe', '1', '(traduit de l\'anglais) Pour complémenter ses abiletés techniques et intuitives, Shawn, a facilement intégré notre groupe, entre autre en participant à des partie de cartes et de haki sur l\'heure du dîner.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('3', 'Impact', '3', 'Certains des outils développés nous servent quotidiennement pour identifier rapidement des problèmes opérationnels urgents.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('4', 'Polyvalence', '2', '(traduit de l\'anglais) Je suis certain que Shawn sera un coéquipier précieux dans tous ses futurs projets au travail.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('5', 'Pensée positive', '4', '(traduit de l\'anglais) Son attitude ne laissait aucune place à l\'échec.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('9', 'Penser avant d\'agir', '4', '(traduit de l\'anglais) Il s\'est montré attentif à nos besoins et a su trouver des failles dans mon raisonnement et apporter des corrections avant le début des travaux malgré qu\'il n\'était pas familier avec notre entreprise, diminuant ainsi le nombre d\'heures nécessaires pour ce projet.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('6', 'Esprit critique', '2', '(traduit de l\'anglais) Au lieu de suivre bêtement les instructions, Shawn réinvestissait ses connaissances et entammait de sa propre initiative des recherches et expériences afin d\'apporter des améliorations aux produits qu\'il développait, les rendant meilleurs qu\'initialement planifiés.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('10', 'Personnalité', '4', '(traduit de l\'anglais) Shawn est un meneur d\'équipe naturel qui voit le bon côté des gens avec qui il travaille. Il a travailler de près avec deux personnes dans notre compagnie et les deux ont dit de lui qu\'il était ouvert d\'esprit, respectueux, plein de ressources et intéressant.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('15', 'Social', '5', '(traduit de l\'anglais) Shawn a une très bonne écoute; il est de toute évidence une personne sociale.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('12', 'Ce que les autres disent de moi', '5', '(traduit de l\'anglais) J\'ai été très impressionné par sa compréhension rapide et exacte de mes besoins, et par sa capacité à produire une application qui y réponde.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('13', 'Innovateur', '5', '(traduit de l\'anglais) Il est très créatif et trouve souvent des solutions et idées nouvelles.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('14', 'Professionnalisme', '5', '(traduit de l\'anglais) J\'avais l\'impression de travailler avec un professionnel mature, pas un étudiant.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('11', 'Talents non-techniques', '5', '(traduit de l\'anglais) Les collègues géniaux se démarquent souvent par leur personnalités et leurs talents interpersonnels qui complémentent leurs talents au niveau technique. C\'est le cas de Shawn et je n\'hésiterais jamais à l\'engager à nouveau.');

CREATE TABLE `Referrals` (
   `id` int(11) not null auto_increment,
   `author` int(11),
   `body` text not null,
   `receptionDate` date,
   PRIMARY KEY (`id`),
   KEY `author` (`author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

INSERT INTO `Referrals` (`id`, `author`, `body`, `receptionDate`) VALUES ('1', '1', 'Shawn served as a summer student between May 2 and August 12, 2011 at the Air Quality Modeling Applications Section (AQMAS) of Environment Canada. During my supervision of Shawn from May 2 to June 17, he developed numerous programs (requiring knowledge of UNIX, TCL, HTML, and SQL databases). The purpose of these programs is to generate products that provide important observation and model data to operational air quality forecasters via an internal Environment Canada web site.\n\nIt was exceptional how quickly Shawn became a contributing member of our team. Within a matter of two weeks, he had already largely completed the development of our first product. He quickly assimilated the information we were able to provide him with and demonstrated a very good understanding of our processing systems by the many pertinent questions he posed.\n\nWe had planned four sub-projects for Shawn to work on during the first 10 to 12 weeks of his internship and he had completed (or almost completed) all of them within the first 8 weeks. He was able to work on all four simultaneously while we waited for feedback from various clients (the Environment Canada Storm Prediction Centers) across the country. Drawing upon his past experience and knowledge, Shawn was able to contribute his own unique and useful ideas to make the final products of each of the sub-projects better than initially anticipated. As a result of his efficiency, we were able to complete more tasks than initially planned.\n\nComplementing Shawn\'s technical and intuitive abilities, he easily socially integrated within our group, including joining colleagues for lunch time card games and hacky. To conclude, we were extremely happy with the contributions made by Shawn to our program. His accomplishments were beyond our highest expectations of what could be accomplished by a student who arrived cold from the outside, lacking knowledge of our internal processing systems.', '2011-06-17');
INSERT INTO `Referrals` (`id`, `author`, `body`, `receptionDate`) VALUES ('2', '1', 'During the summer of 2011, Shawn Inder worked a four month internship at the Air Quality Modeling Applications Section (AQMAS) of Environment Canada. Over much of this time I served as the direct supervisor over Shawn\'s work.\n\nShawn\'s tasks were primarily concentrated on developing code to generate new products for the Environment Canada meteorologists who make the daily forecasts of air quality that are used by many Canadians. His work required a high level of understanding of the UNIX environment, coding in TCL and HTML, and building and manipulating SQL databases.\n\nShawn had an immediate impact as he was able to learn our processing systems and coding methods extremely quickly. Within the first two weeks after beginning, Shawn had almost completed two of the 6 main work tasks we had laid out for him during the summer. He quickly assimilated the information we were able to provide him with and demonstrated a good understanding of our processing systems by the many pertinent questions he posed.\n\nDrawing from his past experience and skill-base, Shawn also provided important improvements to the products he developed. Rather than simply following instructions, on his own initiative he researched and experimented ways to make them better than they were initially planned. During his internship, Shawn was able to work on different projects simultaneously while we waited for feedback on the new products from our clients.  As a result of his efficiency, we were able to complete more tasks than initially thought possible.\n\nComplementing Shawn\'s technical and intuitive abilities, he easily socially integrated within our group, including joining colleagues for\nlunch time card games and hacky. In summary, Shawn\'s accomplishments during his internship at Environment Canada met and exceeded our expectations. I am confident he will be a valuable team member on any future work endeavors.\n\nAnd as If all that were not enough, his continual relaxed posture ( NOT recommended by most chiropractors) beyond-cool bed-head, and remarkable hacky skills (I don\'t hacky myself but word on the street confirms) would make Shawn an invaluable member of any team. Just don\'t ask him to be Sheriff.', '2011-08-12');
INSERT INTO `Referrals` (`id`, `author`, `body`, `receptionDate`) VALUES ('3', '2', 'Commentaires du superviseur au sujet du rapport de stage: Portrait un peu romancé de l\'environnement de travail, mais qui sous-estime l\'impact de son travail pour les membres de l\'équipe et les clients externes. Certains des outils développés nous servent quotidiennement pour identifier rapidement des problèmes opérationnels urgents.', '2011-08-12');
INSERT INTO `Referrals` (`id`, `author`, `body`, `receptionDate`) VALUES ('4', '3', 'I\'ve been working with Kheops International for over 20 years and have had many opportunities to train and  work with young adults. Working with Shawn, a young man that has a lot of potential, has been my second best encounter in all these years.\n\nI hired Shawn to make some modifications in our customizable accounting, financial and business software (UA business software 7.0). He had told me that he had some experience with SQL but knew very little about Microsoft Access, on which UA runs (we use the 2002 version of MS Access).\nI was surprised by Shawn\'s attitude; He was able to listen carefully to our needs, something I\'ve not seen with other people I\'ve had to work with. In fact, even though he did not know our business very well, he found a few glitches in my reasoning and was able to make corrections before the work was started, lowering the amount of hours needed for this project.\nHe also took over some of the parts done by an experienced programmer (25 years of experience) and corrected some of his work, finding a way to tell him with a touch of humor so that the person would not be offended. Indeed, Shawn is a natural team worker and sees the good in the people he works with. He has been in contact with 2 other persons in our company and both found him open, respectful, resourceful and interesting to work with.\nI, myself, appreciate how receptive Shawn has been and the capacity he has shown to foresee the repercussion of any mistakes he made in his work. I have also found him to be a good teacher, finding simple ways to explain the different tasks he accomplished and making sure I understood, so that I could have more autonomy in the future and not depend on him as much to do simple tasks. Instead of thinking only about his salary, he was helpful and thought about our company as well.\nFor example, some of our tasks were time sensitive and he worked extra hours to ensure that our deadlines were met. Still, he was careful enough to perform tests and back up our data to avoid any problems. For unsolved issues, he was quick to research solutions, consulting his friends or the Internet. He had an attitude which left no space for failure.\nBefore each consultation conference call we had with our senior programmer, he took the necessary time to prepare his questions and gather test results concerning his problematic queries. During the call, he quickly understood the rather complicated tasks and adjustments he needed to accomplish.\nShawn’s capacity to listen, his cool temper, his deep understanding of the task at hand and his great communication skills in both English and French make working with him an exceptional experience that enriched both my knowledge and the company. He is honest, simple and so open minded that he will be a valuable asset for any company.\nI hope my perspective will be helpful to you as you evaluate this exceptional candidate. ', '2011-09-10');
INSERT INTO `Referrals` (`id`, `author`, `body`, `receptionDate`) VALUES ('5', '4', 'I had the pleasure of working with Shawn Inder as his direct supervisor during an internship at École Polytechnique, Montréal. Shawn had the responsibility of working with one other student intern on developing a web application to manage and promote international student exchange programs at the institution. We had numerous meetings to discuss my needs, the needs of administrators, and also the needs of students.\n\nShawn is an excellent listener and definitely a people person. I was very impressed with his clear and quick understanding of my needs and his ability to translate these into the application. He is a rigorous and hard worker. He is also a solution-focused, creative thinker, often coming up with new solutions and ideas. I felt I was working with a mature professional rather than a student.\n\nAs I was not able to comment directly on his technical ability, an IT and Software Engineering Professor also supervised his work, and often told me how impressed he was with Shawn, and how he was well documenting his code, etc.\n\nTo conclude, great colleagues most often shine because of their great personalities and interpersonal skills, which carry them far beyond the technical work accomplished. This is Shawn\'s case and I would never hesitate to hire him again.\n\nPlease do not hesitate to contact me should you require further information.', '2011-10-05');

CREATE TABLE `Skills` (
   `id` int(11) not null auto_increment,
   `name` varchar(50) not null,
   `shortName` varchar(25),
   `history` text,
   `stars` smallint(6) unsigned,
   `selfEvaluation` tinytext,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=15;

INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('3', 'HyperText Markup Language', 'HTML', 'J\'apprend le HTML depuis maintenant plusieurs années de façon auto-didacte et m\'en suis servi dans plusieurs projets de petite et grande envergure. Ayant rapidement rencontré des problèmes de compatibilités inter-navigateur et autres problèmes uniques au monde du web, j\'écris depuis longtemps du HTML sémantiquement correct qui respecte les standards afin the produire de sites web accessibles à tous.', '5', 'Je peux écrire du HTML de première qualité les yeux fermés');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('4', 'Cascading Style Sheets', 'CSS', 'Je me suis appris le CSS il y a plusieurs années et je m\'y suis beaucoup éxercé depuis. Je m\'assure également d\'être au courant des derniers standards et des outils comme WebPutty et SCSS qui rendent l\'écriture de CSS beaucoup plus efficace qu\'il y a quelques années.', '5', 'Je sais profiter du meilleur que CSS a à offrir pour créé des designs accessibles et esthétiques.');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('5', 'Javascript', '', 'Après plusieurs années d\'apprentissage, je comprend maintenant très bien les principes fondamentaux et la structure du Javascript. Je me concentre maintenant plutôt sur jQuery et d\'autres librairies incroyables qui font du Javascript un outil si puissant pour le développeur et l\'utilisateur.', '5', 'Je sais comment profiter du grand pouvoir de Javascript afin d\'améliorer l\'expérience de l\'utilisateur');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('6', 'C++', '', 'J\'ai appris le C++ à l\'Université à travers divers cours et projets. J\'ai également eu l\'occasion d\'apprendre quelques librairies utiles comme Boost et OpenMP, et de mettre tout ça en pratique dans divers contextes opérationnels (sur Windows, sur Linux, embarqué sur micro-contrôleur).', '4', 'Je maîtrise assez bien le C++ pour créer ce dont j\'ai besoin avec peu de difficultés');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('7', 'Java', '', 'Je n\'ai jamais étudié le Java, mais je m\'en suis servi dans différents travaux d\'école et je me suis rendu compte qu\'une fois qu\'on connaît le C++, le Java n\'est pas très difficile à apprendre. En effet, malgré mon manque d\'expérience avec ce language, je sens que mon Java est utilisable.', '3', 'À toutes fins pratiques, je peux utiliser Java');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('8', 'Tool Command Language', 'Tcl', 'J\'ai appris le Tcl au cours d\'un stage d\'été et je suis fier de voir le peu de temps qu\'il m\'a fallu pour devenir productif. J\'ai maintenant une bonne compréhension des bases du langage et je sais éviter les attrapes majeures qu\'il comporte.', '3', 'Je connaîs assez bien ce langage pour l\'utiliser intelligement');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('9', 'PHP: Hypertext Preprocessor', 'PHP', 'J\'ai appris le PHP afin de construire des sites web avec des bases de données. Je m\'en suis servis beaucoup à cet escient, mais j\'ai aussi appris à m\'en servir pour fournir des interactions AJAX intéressantes aux utilisateurs, et pour profiter des multiples librairies que d\'autres ont développés.', '5', 'Je peux rapidement brandir les pleins pouvoirs du PHP.');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('10', 'Structured Query Language', 'SQL', 'Cela fait plusieurs années que j\'utilise le SQL pour créer et gérer des bases de données spécialisées. J\'ai également suivi un cour qui m\'en a appris davantage sur les détails d\'implémentation et les stratégies d\'optimizations utilisées dans certains outils rafinant ainsi ma compréhension du language et de ses différentes versions.', '4', 'J\'ai une bonne maîtrise du langage dans un contexte avec une seule base de données, mais je manque d\'expérience avec les systèmes distribués');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('11', 'Ruby', '', 'J\'ai commencé à utiliser le Ruby dans le cadre d\'un projet auquel je participe bénévolement et qui est bâti sur Ruby on Rails. Il a été extrèmement formateur pour moi de fouiller les masses de gems à code source ouvert qui existent sur le web et je suis maintenant en mesure de me servir de Ruby assez efficacement.', '3', 'Je peux utiliser ce langage, mais il me faut encore pratiquer avant de pouvoir me déclarer maître');

CREATE TABLE `experience_images` (
   `experience` int(11),
   `src` varchar(50) CHARSET latin1 not null,
   `description` text,
   PRIMARY KEY (`src`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `experience_images` (`experience`, `src`, `description`) VALUES ('1', 'images/organizations/environmentCanada.jpg', '');
INSERT INTO `experience_images` (`experience`, `src`, `description`) VALUES ('2', 'images/organizations/sep.jpg', '');
INSERT INTO `experience_images` (`experience`, `src`, `description`) VALUES ('3', 'images/organizations/kheopsInternational.jpg', '');
INSERT INTO `experience_images` (`experience`, `src`, `description`) VALUES ('4', 'images/organizations/kiungoWiki.jpg', '');
INSERT INTO `experience_images` (`experience`, `src`, `description`) VALUES ('5', 'images/organizations/cv.jpg', '');
INSERT INTO `experience_images` (`experience`, `src`, `description`) VALUES ('6', 'images/organizations/jeu.jpg', '');

CREATE TABLE `experience_link` (
   `experience` int(10) unsigned not null,
   `text` varchar(100) not null,
   `url` varchar(200) not null,
   `title` varchar(200),
   PRIMARY KEY (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `experience_link` (`experience`, `text`, `url`, `title`) VALUES ('5', 'Voir le code source', 'https://github.com/shawninder/Shawn-Inder-s-online-CV', 'Voir le code source de ce site sur Github');
INSERT INTO `experience_link` (`experience`, `text`, `url`, `title`) VALUES ('4', 'Voir le code source', 'https://github.com/M2i3/KiungoWiki', 'Voir le code source de ce site sur Github');

CREATE TABLE `experience_referral_matrix` (
   `experience` int(11) not null,
   `referral` int(11) not null,
   PRIMARY KEY (`experience`,`referral`),
   KEY `referral` (`referral`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `experience_referral_matrix` (`experience`, `referral`) VALUES ('1', '1');
INSERT INTO `experience_referral_matrix` (`experience`, `referral`) VALUES ('1', '2');
INSERT INTO `experience_referral_matrix` (`experience`, `referral`) VALUES ('1', '3');
INSERT INTO `experience_referral_matrix` (`experience`, `referral`) VALUES ('2', '5');
INSERT INTO `experience_referral_matrix` (`experience`, `referral`) VALUES ('3', '4');

CREATE TABLE `experience_skill_matrix` (
   `skill` int(11) not null,
   `experience` int(11) not null,
   `description` text not null,
   PRIMARY KEY (`skill`,`experience`),
   KEY `experience` (`experience`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('3', '1', 'J\'ai dévoloppé pour Environnement Canada plusieurs produits présentant de l\'information importante aux prévisonnistes partout au Canada par l\'intermédiaire un site Web intranet. Suivant les priorités établies par l\'organisme, j\'ai crée des pages HTML hautement accessibles et en accord avec les standards du Web.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('3', '2', 'L\'application Web dont j\'étais en charge à l\'École Polytechnique de Montréal devait être hautement accessible et digne d\'une des plus grandes école d\'ingénierie du pays. J\'ai atteint ces objectifs pour des douzaines de pages HTML désencombrés et sémantiquement correctes, la majorité d\'entres elles ayant également des éléments interactifs.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('4', '1', 'Les prévisonnistes d\'Environnement Canada doivent traiter des quantitées importantes de données quotidiennement. Pour les produits que j\'ai développés, j\'ai créé des designs CSS élégants et ergonomiques qui permettent de facilement différencier les différentes sortes de données et qui s\'adaptent à l\'environnement local de l\'utilisateur.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('3', '4', 'KiungoWiki est une application Web qui devra son succès à la simplicité de son interface et à l\'accessibilité des ses données, autant pour les utilisateurs que pour les moteurs de recherches. Étant un des dévelopeurs principaux du projet, j\'ai produit des pages HTML de haute qualité avec ces critères en tête.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('4', '4', 'KiungoWiki vise à devenir LA référence en matière d\'informations musicales. Afin de gagner la confiance du public, j\'utilise le meilleur du CSS le plus récent afin de produire un design visuel professionnel, engageant, esthétique et efficace.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('5', '4', 'Un des plus gros défis de KiungoWiki est d\'attirer les utilisateurs qui vont créer le contenu prisé par les utilisateurs passifs. Avec ce fait en tête, j\'implémente des scripts Javascript non-obstructifs qui automatisent et accélèrent le travail de ceux qui souhaitent contribuer et pour qui Javascript est activé dans leur navigateur.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('11', '4', 'KiungoWiki est bâti sur Ruby on Rails, alors j\'ai évidement écrit beaucoup de Ruby, mais j\'ai aussi passé beaucoup de temps à scruter le code source ouvert de l\'API de Rails et des nombreuses gems qui existent afin de saisir de pleines mains le potentiel de Ruby et des outils développés par sa grande communauté.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('4', '2', 'WebÉchange supporte une myriade de tâches administratives complexes et offre aux étudiants et aux membres de l\'administration beaucoup d\'outils afin de les aider dans leurs démarches. Grâce à la magie du CSS, J\'ai pu produire un aspect visuel élégant et cohérent à travers l\'application, malgré le grand nombre de fonctionnalités différentes qu\'il possède.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('5', '1', 'Les produits que j\'ai développé pour Environnement Canada se devaient d\'être hautement accessible, notamment en ce qui concerne l\'aspect facultatif du Javascript. J\'ai tout de même pu grandement augmenter le contrôle des utilisateurs sur leurs données de façon intuitive et adaptée, sans toute fois limiter la fonctionnalité disponible aux utilisateurs ayant le Javascript désactivé dans leur navigateur.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('5', '2', 'J\'ai beaucoup utilisé Javascript dans cette application pour accélérer les tâches que doivent effectuer les utilisateurs en leur offrant des outils simples mais efficaces, que ce soit pour naviguer rapidement à travers de complexes formulaires ou pour catégoriser des photos.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('8', '1', 'La majorité des produits que j\'ai développé pour Environnement Canada ont nécessité la création de scripts Tcl pouvant interagir avec un Système d\'Informations Géographiques maison, produire des pages Web HTML, des documents CSV ou XML, ou manipuler d\'énormes bases de données sqlite contenant des informations mises à jour à chaque heure.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('9', '2', 'WebÉchange fonctionne grâce à une base de donnée grandissante contenant toutes sortes d\'informations entrées par ses utilisateurs, certaines d\'entre elles étant sujettes à des protocoles de sécurité très stricts. Les nombreux scripts PHP que j\'ai créer ou mis à jour offrent une grande flexibilité aux utilisateurs tout en assurant un respect des protocoles d\'accès à l\'aide de mots de passe cryptés et de stratégies de validation d\'entrés utilisateurs.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('10', '1', 'Environnement Canada stocke d\'énormes quantités de données à chaque heure dans plusieurs bases de données sqlite. J\'ai fait beaucoup de modifications pour permettre à ces bases de données de demeurer performantes et robustes sous une grande charge, et j\'ai écrit du SQL de qualité qui a augmenté l\'efficacité des transactions et faciliter la récupération des erreurs.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('10', '2', 'WebÉchange facilite une communication asynchrone (mais soumise à des échéances strictes) entre les étudiants souhaitant étudier une session à l\'étranger, les étudiants l\'ayant déjà fait dans le passé, et les administrateurs et coordonnateurs de l\'école d\'acceuil et de l\'école de départ. J\'ai supporté cette conversation grâce à une base de données MySQL qui réagit à des événements temporels et à des changements dans l\'information.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('10', '3', 'Le système comptable qu\'utilise Kheops International est construit sur une base de donnée Microsoft Access et comporte des centaines de tables spécialisées couvrant une variétée de scénarios d\'entreprise possibles. J\'ai ajouté à ce nombre grâce à des requêtes SQL précises qui tiennent compte du modèle d\'affaire et des priorités de l\'entreprise, ainsi que des centaines de contraintes appliquées par le système comptable lui-même.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('3', '5', 'Le HTML que j\'ai écris pour ce CV rend son contenu accessible aux lecteurs d\'écran, navigables par l\'intermédiaire du clavier et utilisable sur n\'importe quel ordinateur. J\'espère démontrer ainsi non seulement mes capacités, mais aussi ma motivation à créer des sites Web de qualité, même dans leurs détails les moins visibles.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('4', '5', 'J\'ai choisi de créer un design épuré et intuitif pour ce site Web. Stylé exclusivement avec CSS, il convient autant aux petits écrans qu\'aux grands et réserve même des petits extras pour ceux qui ont des navigateurs récents.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('5', '5', 'Ce site Web constitue un moyen d\'explorer la relation qui existe entre mes expériences de travail et les compétences que j\'ai pu perfectionner au cours de ces dernières. Grâce à une série d\'animations et d\'interactions Javascript pertinentes, j\'ai pu offrir une vue d\'ensemble sur cette relation qui permet à l\'utilisateur de l\'explorer à sa guise en accédant à des vues détaillées des différents éléments, rendant l\'expérience plus flexible et personnalisée.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('9', '5', 'Les informations paraissant sur mon CV sont contenues dans une base de données et accompagnés de scripts PHP pouvant générer les différentes versions dont j\'ai besoin. La mise à jour est donc aussi simple que de mettre les données à jour tandis que la traduction de ces données en un document en ligne ou en PDF est faite automatiquement.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('10', '5', 'La base de données MySQL qui gère les informations de ce site Web est simple, mais elle me permet de traiter le contenu et la présentation de mon CV séparément. De plus, je travaille présentement sur un système me permettant de récolter et d\'afficher automatiquement les rétro-actions des visiteurs ou des anciens employeurs qui visitent le site.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('6', '6', 'La création du jeu a impliqué la traduction de logique de jeu complexe et d\'une myriade de fonctionnalités en code C++ efficace à plusieurs fils d\'exécution capable d\'offrir une expérience rapide et engageante aux joueurs.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('7', '6', 'Certaines fonctions du jeu, comme l\'éditeur de niveau, requérait une interface utilisateur capable d\'offrir une expérience flexible, puissante et simple. J\'ai développer celle-ci en Java, utilisant la Java Native Interface (JNI) pour communiquer avec les librairies C++ qui contrôlent la logique du jeu et l\'affichage.');

CREATE TABLE `schooling` (
   `school` varchar(50),
   `degree` varchar(50),
   `status` varchar(50),
   `years` varchar(50)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `schooling` (`school`, `degree`, `status`, `years`) VALUES ('École Polytechnique de Montréal', 'Ingénierie Logicielle', 'BAC en cours', '2008-2011');
INSERT INTO `schooling` (`school`, `degree`, `status`, `years`) VALUES ('Collège de Maisonneuve', 'Sciences Pures et Appliquées', 'DEC obtenu', '2006-2008');
