# Absolut Engine by Daniel Duris (c) 2001-2007
# Absolut Engine v1.73 database format

CREATE TABLE ae_modules (
`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`module` varchar(255),
`version` varchar(10),
`author` varchar(255),
`website` varchar(255),
`description` text,
`directory` varchar(255),
`menu1` tinyint,
`menu2` tinyint,
`menu3` tinyint,
`menu4` tinyint,
`menu5` tinyint,
`guestmodify` tinyint,
PRIMARY KEY (ID),
KEY `directory` (`directory`)
);

CREATE TABLE ae_temporary (
`ID` INT(10) UNSIGNED AUTO_INCREMENT,
`tempstring` text,
PRIMARY KEY (ID)
);

CREATE TABLE ae_cleanurlspool (
`cleanurl` varchar(255) NOT NULL,
KEY `cleanurl` (`cleanurl`)
);

CREATE TABLE ae_sections (
`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`section` varchar(255),
`parentsectionID` INT,
`articleID` INT,
`priority` decimal(10,2),
`filename` varchar(255),
PRIMARY KEY (ID),
KEY `parentsectionID` (`parentsectionID`),
KEY `articleID` (`articleID`)
);

CREATE TABLE ae_articlesections (
`articleID` INT,
`sectionID` INT,
KEY `articleID` (`articleID`),
KEY `sectionID` (`sectionID`)
);

CREATE TABLE ae_imagesets (
`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`description` varchar(255),
`authorID` INT(10) UNSIGNED,
PRIMARY KEY (ID)
);

CREATE TABLE ae_images (
`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`imagesetID` INT,
`filename` varchar(255),
`description` varchar(255),
PRIMARY KEY (ID),
KEY `imagesetID` (`imagesetID`)
);

CREATE TABLE ae_filesets (
`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`description` varchar(255),
`authorID` INT(10) UNSIGNED,
PRIMARY KEY (ID)
);

CREATE TABLE ae_files (
`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`filesetID` INT,
`filename` varchar(255),
PRIMARY KEY (ID),
KEY `filesetID` (`filesetID`)
);

CREATE TABLE ae_articles (
`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`title` text,
`beginning` text,
`text` text,
`authorID` INT(10) UNSIGNED,
`adate` date,
`atime` time,
`imagesetID` INT(10) UNSIGNED,
`filesetID` INT(10) UNSIGNED,
`priority` tinyint,
`status` tinyint,
`filename` varchar(255),
PRIMARY KEY (ID),
KEY `imagesetID` (`imagesetID`),
KEY `filesetID` (`filesetID`)
);
ALTER TABLE ae_articles ADD FULLTEXT (`title`);
ALTER TABLE ae_articles ADD FULLTEXT (`beginning`);
ALTER TABLE ae_articles ADD FULLTEXT (`text`);

CREATE TABLE ae_stats (
`articleID` INT(10) UNSIGNED,
`views` INT(10) UNSIGNED,
KEY `articleID` (`articleID`)
);

CREATE TABLE ae_relatedarticles (
`articleID` INT(10) UNSIGNED,
`relatedID` INT(10) UNSIGNED,
KEY `articleID` (`articleID`),
KEY `relatedID` (`relatedID`)
);

CREATE TABLE ae_activehooks (
`moduledir` varchar(255),
`hook` varchar(255),
`action` varchar(255),
KEY `moduledir` (`moduledir`)
);

CREATE TABLE ae_availablehooks (
`moduledir` varchar(255),
`hook` varchar(255),
`variables` varchar(255),
KEY `moduledir` (`moduledir`)
);

# position: 1-admin, 2-editor in chief, 3-editor
# language: EN - english, SK - slovak etc... ISO shorts - same as domain (.sk,.de,.no etc.)
CREATE TABLE ae_users (
`ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`user` varchar(30),
`password` varchar(100),
`fullname` varchar(100),
`position` tinyint,
`email` varchar(255),
`language` varchar(2),
`photo` varchar(255),
`otherinfo` text,
PRIMARY KEY (ID)
);

CREATE TABLE ae_login (
`userID` INT(10) UNSIGNED,
`loginID` varchar(100),
`logtime` varchar(100),
KEY `userID` (`userID`)
);

INSERT INTO ae_users VALUES(NULL,'admin','21232f297a57a5a743894a0e4a801fc3','Administrator','1','youremail@yourdomain.com','EN','','');