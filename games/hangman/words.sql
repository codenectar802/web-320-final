-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2014 at 03:55 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hangman_words`
--

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `word` varchar(50) NOT NULL,
  `difficulty` enum('Easy','Medium','Hard') NOT NULL DEFAULT 'Easy',
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `words`
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
