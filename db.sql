CREATE DATABASE web320final;
USE web320final;
CREATE TABLE `user` (
 	 `id` int(11) NOT NULL AUTO_INCREMENT,
 	 `fname` varchar(45) DEFAULT NULL,
 `lname` varchar(45) DEFAULT NULL,
 	 `username` varchar(45) NOT NULL,
 	 `email` varchar(45) NOT NULL,
 `date_joined` datetime NOT NULL,
 	 PRIMARY KEY (`id`)
);
INSERT INTO `user`(
`fname`,
`lname`,
`username`,
`email`,
`date_joined`
) VALUES (
'Anonymous',  
'N/A',
'none',
'anonymous@unknown.com',
'1111-11-11 11:11:11'
);
CREATE TABLE `pass` (
`userid` int(11) NOT NULL,
`password` varchar(32) DEFAULT NULL,
 	PRIMARY KEY (`userid`)
);
CREATE TABLE `typingScore` (
  `id` int(11) NOT NULL,
  `difficulty` varchar(45) NOT NULL,
  `score` int(11) NOT NULL,
  `date` datetime NOT NULL,
  	PRIMARY KEY (`id`)
) ;
CREATE TABLE `typingPref` (
 `userid` int(11) NOT NULL,
 	 `difficulty` varchar(45) NOT NULL,
 	 PRIMARY KEY (`userid`)
);
CREATE TABLE IF NOT EXISTS `hangmanscore` (
  `id` int(11) NOT NULL,
  `scored` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `words` (`word`, `difficulty`) VALUES
('rat', 'Easy'),
('fish', 'Easy'),
('horse', 'Easy'),
('fat', 'Easy'),
('number', 'Easy'),
('free', 'Easy'),
('track', 'Easy'),
('fact', 'Easy'),
('zebra', 'Easy'),
('panda', 'Easy'),
('goalie', 'Medium'),
('cooperation', 'Medium'),
('zipper', 'Medium'),
('cliffhanger', 'Medium'),
('overachieved', 'Medium'),
('musical', 'Medium'),
('atrocious', 'Hard'),
('obsolete', 'Hard'),
('xylophone', 'Hard'),
('Luxembourg', 'Hard'),
('quantitative', 'Hard'),
('quiche', 'Hard'),
('lackadaisical', 'Hard'),
('inevitable', 'Hard'),
('keys', 'Easy'),
('panic', 'Easy'),
('sequel', 'Medium'),
('fairytale', 'Medium'),
('gorgeous', 'Easy'),
('mountain', 'Easy'),
('octopus', 'Medium'),
('ethos', 'Hard'),
('synonym', 'Hard'),
('onomatopoeia', 'Hard'),
('zoanthropy', 'Hard'),
('zany', 'Hard');
