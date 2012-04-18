--
-- MySQL 5.1.61
-- Wed, 18 Apr 2012 02:17:44 +0000
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

INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('1', '1', 'Scientific Programmer Analyst Intern', 'I served as an intern for Environment Canada in the Air Quality Modeling Applications Section. There, I developed various products which provide important observation and forecast data to the public, web application developers and air quality forecasters all over the country.', '2011-05-05', '2011-08-12');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('2', '3', 'Web Designer & Developer', 'During the two years I worked on WebÉchange, I\'ve added countless new features which empower both the students using the system and members of the school\'s administration, making the whole process of studying abroad that much easier on both sides. Being the only developer for most of my time on the project, I was also in charge of testing, communicating with the client and reacting to emergencies.', '2009-05-02', '2011-05-05');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('3', '2', 'Database Administrator & Software Consultant', 'Kheops International asked me to add a few twists and turns to their 15 year old accounting software. I also shared with them my technical knowledge of the software world to help make crucial long-term decisions regarding their software setup.', '2011-08-01', '');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('4', '4', 'Web Designer & Developer (volunteer)', 'I am one of the four founders of KiungoWiki, a wiki about artists, songs, recordings and the links that tie everything together. From the start, I\'ve been involved with decision-making throughout the scope of the project, but my main tasks are related to the design and development of the user experience and interface.', '2010-10-10', '');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('5', '5', 'Web Designer & Developer', 'This website is my way of saying I have a certain set of skills and proving it by the same occasion. I designed the user experience, built and filled the database, and created a beautiful, functional, and accessible website to show you what I am capable of.', '2011-10-01', '');
INSERT INTO `Experiences` (`id`, `organization`, `title`, `description`, `startDate`, `endDate`) VALUES ('6', '6', 'Class project: Multiplayer racing game in 3D', 'Five teammates and I created a full-fledged 3D multiplayer racing game in 4 months during a full time study semester, complete with level editor, artificial intelligence and interactive obstacles.', '2011-01-10', '2011-05-18');

CREATE TABLE `Languages` (
   `name` varchar(32) not null,
   `stars` tinyint(3) unsigned not null,
   PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `Languages` (`name`, `stars`) VALUES ('English', '5');
INSERT INTO `Languages` (`name`, `stars`) VALUES ('French', '5');

CREATE TABLE `Organizations` (
   `id` int(11) not null auto_increment,
   `name` varchar(100),
   `description` text,
   `url` varchar(100),
   `location` varchar(100),
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;

INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('1', 'Environment Canada', 'Environment Canada works to preserve and enhance the quality of the natural environment; conserve Canada\'s renewable resources; conserve and protect Canada\'s water resources; carry out meteorology and provide weather forecasts; enforce rules relating to boundary waters; and, coordinate environmental policies and programs for the federal government.', 'http://www.ec.gc.ca/', 'Dorval, QC');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('2', 'Kheops International', 'Kheops International is a importer, distributor and wholesaler of meaningful gifts targeted to inspire and unify people, promote well being, or simply connect to Mother Nature, constantly researching the globe for the best products in the metaphysical/new age market.', 'http://www.kheopsinternational.com/', 'Colebrooke, NH');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('3', 'WebÉchange - École Polytechnique de Montréal', 'The student services department of the École Polytechnique de Montréal provides free academic consulting to all the school\'s students, helping them with student exchange programs, financial support, and more.', 'http://www.groupes.polymtl.ca/echanges/accueil.php', 'Montréal, QC');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('4', 'KiungoWiki', 'A wiki about music, songs and links that tie everything together.', 'http://kiungowiki.org', 'Montreal, QC');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('5', 'Shawn Inder\'s interactive CV', 'This Website! I wanted a CV that listed my experience and skills, and proved my enthusiasm and creativity by providing a unique CV experience!', '', 'Montréal, QC');
INSERT INTO `Organizations` (`id`, `name`, `description`, `url`, `location`) VALUES ('6', 'Class Project at the École Polytechnique de Montréal', '', 'http://www.polymtl.ca/etudes/cours/details.php?sigle=INF2990', 'Montréal, QC');

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

INSERT INTO `Persons` (`id`, `firstName`, `lastName`, `gender`, `position`, `organization`, `email`) VALUES ('1', 'David', 'Anselmo', 'male', 'Meteorologist', '1', 'david.anselmo@ec.gc.ca');
INSERT INTO `Persons` (`id`, `firstName`, `lastName`, `gender`, `position`, `organization`, `email`) VALUES ('2', 'Paul-André', 'Beaulieu', 'male', 'Scientific Programmer Analyst', '1', 'paul-andre.beaulieu@ec.gc.ca');
INSERT INTO `Persons` (`id`, `firstName`, `lastName`, `gender`, `position`, `organization`, `email`) VALUES ('3', 'Micheline', 'Freyssonnet', 'female', 'Marketing Coordinator', '2', 'micheline@kheopsinternational.com');
INSERT INTO `Persons` (`id`, `firstName`, `lastName`, `gender`, `position`, `organization`, `email`) VALUES ('4', 'Annick', 'Corbeil', 'female', 'International mobility programs coordinator', '3', 'annick.corbeil@etsmtl.ca');

CREATE TABLE `Referral_excerpts` (
   `id` int(11) not null auto_increment,
   `title` varchar(100) default 'What others have said about me',
   `referral` int(11),
   `body` text not null,
   PRIMARY KEY (`id`),
   KEY `referral` (`referral`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=17;

INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('1', 'The Extra Mile', '1', 'His accomplishments\nwere beyond our highest expectations of what could be accomplished by a\nstudent who arrived cold from the outside, lacking knowledge of our\ninternal processing systems.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('2', 'Get\'s Things Done', '2', 'During his internship, Shawn was able to work on different projects simultaneously while we waited for feedback on the new products from our clients. As a result of his efficiency, we were able to complete more tasks than initially thought possible.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('7', 'Get\'s Things Done', '1', 'It was exceptional how quickly Shawn became a contributing member of our team. Within a matter of two weeks, he had already largely completed the development of our first product.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('8', 'Team Spirit', '1', 'Complementing Shawn\'s technical and intuitive abilities, he easily socially integrated within our group, including joining colleagues for lunch time card games and hacky.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('3', 'Impact', '3', '(translated) Certain tools developed by Shawn are used daily to quickly identify urgent operational problems.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('4', 'Polyvalent', '2', 'I am confident he will be a valuable team member on any future work endeavors.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('5', 'Positive Thinking', '4', 'He had an attitude which left no space for failure.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('9', 'Forward Thinking', '4', 'He was able to listen carefully to our needs [and] even though he did not know our business very well, he found a few glitches in my reasoning and was able to make corrections before the work was started, lowering the amount of hours needed for this project.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('6', 'Critical Thinking', '2', 'Drawing from his past experience and skill-base, Shawn also provided important improvements to the products he developed. Rather than simply following instructions, on his own initiative he researched and experimented ways to make them better than they were initially planned.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('10', 'Personality', '4', 'Indeed, Shawn is a natural team worker and sees the good in the people he works with. He has been in contact with 2 other persons in our company and both found him open, respectful, resourceful and interesting to work with.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('15', 'People person', '5', 'Shawn is an excellent listener and definitely a people person.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('12', 'What others have said about me', '5', 'I was very impressed with his clear and\nquick understanding of my needs and his ability to translate these into the application.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('13', 'An Innovator', '5', 'He is a solutions-focused, creative thinker, often coming up with new solutions and ideas.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('14', 'Professionnalism', '5', 'I felt I was Working with a mature professional rather than a student.');
INSERT INTO `Referral_excerpts` (`id`, `title`, `referral`, `body`) VALUES ('11', 'Non-technical skills', '5', '[...] great colleagues most often shine because of their great personalities and interpersonal \nskills, which carry them far beyond the technical work accomplished. This is Shawn’s case and I would never hesitate to hire him gain.');

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

INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('3', 'HyperText Markup Language', 'HTML', 'I\'ve been teaching myself HTML for many years now and using it in various small and not-so-small projects. Faced with cross-browser compatibility problems and other issues unique to the web since the very beginning, I\'ve been following best practices and writing accessible and semantically correct code ever since.', '5', 'I can write great HTML with my eyes closed');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('4', 'Cascading Style Sheets', 'CSS', 'I\'ve taught myself CSS many years ago and have been putting my skills to the test on many occasions. I also make certain that I am up-to-date with the latest standards and tools like WebPutty and SCSS that make writing CSS a lot easier than it was a few years ago.', '5', 'I can create beautiful and accessible designs using the best CSS has to offer');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('5', 'Javascript', '', 'I\'ve been continuously learning about Javascript for many years and I now understand its core principles and structure very well. Lately, I\'ve been focusing on jQuery and other amazing libraries that make Javascript such a powerful tool, both for the end-user and for the developer.', '5', 'I know how to harness javascript\'s power to greatly enhance user experience');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('6', 'C++', '', 'I was taught C++ in school and have used it in various school projects. I\'ve also learned about a few useful libraries such as Boost and OpenMP, and about the differences that exist between the Windows and Linux environments.', '4', 'With C++, I usually achieve the desired results with little difficulty');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('7', 'Java', '', 'I was never really taught Java, but I was asked to use it in various school projects and it turns out it really isn\'t that hard when you already know C++. In fact, despite my lack of practice with the language, I feel my Java is very usable.', '3', 'I can get things done with Java fairly easily');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('8', 'Tool Command Language', 'Tcl', 'I learned Tcl recently during a summer internship and was pleased to see how fast I became productive with it. I now have a good understanding of its basics and know about the major pitfalls to look out for.', '3', 'I know enough about this language to make intelligent use of it');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('9', 'PHP: Hypertext Preprocessor', 'PHP', 'I taught myself how to use PHP in order to build database-backed websites. I\'ve been using it a lot for that purpose, but also to power AJAX-driven interactions and to take advantage of the many freely-distributed PHP libraries that have been developed by others.', '5', 'I can leverage the full power of PHP quickly');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('10', 'Structured Query Language', 'SQL', 'I learned by myself how to use SQL to build and manage databases which fit specific needs. Lately, I also followed a course which taught me about implementation details and optimization strategies, refining my understanding of the language and its many different versions.', '4', 'I master this language for single databases but haven\'t yet used it in a distributed system');
INSERT INTO `Skills` (`id`, `name`, `shortName`, `history`, `stars`, `selfEvaluation`) VALUES ('11', 'Ruby', '', 'I started learning Ruby quite recently on a volunteer Ruby on Rails web project. It\'s been extremely helpful to browse through the impressive amount of open source gems one can find on the internet and I now have very usable Ruby skills.', '3', 'I can use this language, but I need more practice before I can claim mastery');

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

INSERT INTO `experience_link` (`experience`, `text`, `url`, `title`) VALUES ('5', 'See the source code', 'https://github.com/shawninder/Shawn-Inder-s-online-CV', 'See this website\'s source code on github.');
INSERT INTO `experience_link` (`experience`, `text`, `url`, `title`) VALUES ('4', 'See the source code', 'https://github.com/M2i3/KiungoWiki', 'See KiungoWiki\'s source code on github.');

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

INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('3', '1', 'Most products I developed for Environment Canada presented important information to forecasters all over the country via their intranet website. I provided them with accessible HTML web pages which they could use to interact with the data.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('3', '2', 'The web application I was responsible of at l\'École Polytechnique de Montréal needed to be highly accessible and professionally designed. I created dozens of semantically correct and clutter-free HTML pages, most of them being interactive in nature.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('4', '1', 'Forecasters at Environment Canada need to analyse enormous amounts of numeric data on a daily basis. I provided them with beautiful and usable CSS designs which help differentiate different kinds of data and adapt to the user\'s local environment.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('3', '4', 'KiungoWiki is a web application destined to serve web pages to a wide variety of desktops, laptops, handheld devices and tablets. As one of the lead developers on the project, I have been writing top-notch HTML to make sure our wiki is usable by everyone.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('4', '4', 'KiungoWiki\'s aim is to become THE reference for musical information. To improve our chances of success, I\'m using the latest a greatest that CSS has to offer to create compelling, professional-looking visual designs geared towards efficiency and aesthetics.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('5', '4', 'One of the biggest challenges facing KiungoWiki is getting enough people to contribute information and create useful content that will attract passive users. With that in mind, I\'m implementing various non-obtrusive Javascripts which will help accelerate and automate the tasks involved in contributing to the wiki for those who have javascript enabled on their browser.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('11', '4', 'KiungoWiki is built on the Ruby on Rails framework so I\'ve obviously been writing a lot of Ruby, but I\'ve also spent a lot of time looking through the rails API source code and browsing through the numerous gems that exist out there in order to grasp the full potential of what ruby and its community have to offer. ');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('4', '2', 'WebÉchange supports a myriad of complex administrative tasks and provides lots of tools to both students and members of the schools administration. I used the latest and greatest CSS techniques to give all users an elegant and consistent look and feel throughout the application.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('5', '1', 'It was important that all the products I developed for Environment Canada be 100% functional for all users, but in many places I managed to give increased control to users with gracefully degrading, non-obtrusive Javascripts which do not compromise functionality for users using assistive technologies or less capable browsers that don\'t support the necessary scripting objects.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('5', '2', 'I used Javascript extensively for this web application to provide the users whith rich interactive capabilities facilitating and accelerating the various tasks they were trying to accomplish, be it navigating through large and complex forms or quickly tagging and categorizing photos.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('8', '1', 'Most of the tools I developed for Environment Canada involved creating TCL scripts which could interact with their proprietary Goegraphic Information System and produce HTML web pages, CSV and XML text files, or simply manipulate numerous sqlite databases holding huge quantities of hourly updated data.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('9', '2', 'WebÉchange\'s services are backed by a growing database full of user generated content subject to strict access protocols. The multiple PHP scripts I created and updated offered great power and flexibility to all users while enforcing strict security policies with encrypted password protection and secure user input validation strategies.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('10', '1', 'Environment Canada stores enormous amounts of near-real-time data in numerous sqlite databases. I\'ve done a lot of tweaking to get them to perform quickly and robustly under heavy load, and have written no-corners-cut SQL which improved efficiency and facilitated error recovery.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('10', '2', 'WebÉchange facilitates a time-sensitive, but asynchronous conversation engaging exchange program participants, ex-participants, administrators and program coordinators from the host school and the student\'s home school.  I supported this conversation with SQL which triggered e-mails and responded to date-time events as well as information-based events.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('10', '3', 'Built on a Microsoft Access database, Kheops International\'s accounting software includes hundreds of specialized tables covering a wide variety of possible accounting scenarios. I added to those scenarios with precise SQL queries that took into account the company\'s business model and priorities.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('3', '5', 'The HTML I\'ve written for this page makes its content screen-reader friendly, keyboard accessible, and usable  on any computer or handheld device.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('4', '5', 'I\'ve made this website\'s design intuitive and clutter-free. Entirely styled with CSS, it offers little bonuses to browsers supporting the latest and greatest CSS features.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('5', '5', 'This website solves the challenge of offering intuitive navigation to a detailed many-to-many relationship connecting different skills to different experiences. The meaningful Javascript animations and interactions I\'ve included offer a broad view of my skills and experience and allow the user to dive into any desired section, making for a leaner and more flexible experience.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('9', '5', 'I decided my CV should be contained in a database and accompanied by a series of PHP scripts capable of serving it according to my needs automatically, making the task of maintaining it as easy as keeping the information up to date. Translating this into an interactive website and a PDF document is all done automatically and allows both versions to be available as soon as the data is modified in the database.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('10', '5', 'The MySQL database backing this website is fairly simple, but it allows me to treat my CV\'s content and presentation separately. I\'m currently working on a comment system allowing me to organize and present visitor feedback as well as employer feedback!');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('6', '6', 'Making this game involved translating complex game logic and a rich set of features into efficient, multi-threaded C++ code to offer high-speed action fun to the gamer.');
INSERT INTO `experience_skill_matrix` (`skill`, `experience`, `description`) VALUES ('7', '6', 'Some of our game\'s features, like level editing, required complete user interfaces capable of offering a lot of flexibility to the user and a smooth, engaging experience. We coded the user interface entirely in Java, using the Java Native Interface to communicate with the C++ libraries in which we held all the game logic and controlled the display.');

CREATE TABLE `schooling` (
   `school` varchar(50),
   `degree` varchar(50),
   `status` varchar(50),
   `years` varchar(50)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `schooling` (`school`, `degree`, `status`, `years`) VALUES ('École Polytechnique de Montréal', 'Software Engineering', 'B.Eng. in progress', '2008-2011');
INSERT INTO `schooling` (`school`, `degree`, `status`, `years`) VALUES ('Collège de Maisonneuve', 'Pure and Applied Sciences', 'DCS obtained', '2006-2008');
