-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 05:06 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1-log
-- PHP Version: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb1831`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Qualifier`(in s_data float, in s_qualifier int, out s_value varchar(50))
BEGIN
	SET s_value = '';
    

IF (s_data IS NOT NULL) THEN 
 
 
    CASE s_qualifier
 WHEN  0 THEN
    SET s_value = CONCAT('<',FORMAT(s_data, 2));
 WHEN 1 THEN
    SET s_value = CONCAT('>',FORMAT(s_data,2));
 ELSE
    SET s_value = CONCAT('',FORMAT(s_data,2));
 END CASE;

END IF;

END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `hello_world`() RETURNS text CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
  RETURN 'Hello World';
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `Qualifier`(`s_data` FLOAT, `s_qualifier` INT) RETURNS text CHARSET utf8 COLLATE utf8_unicode_ci
BEGIN
	DECLARE s_value TEXT DEFAULT '';

IF (s_data IS NOT NULL) THEN

SET s_value = 
      CASE
        WHEN s_qualifier = 0 THEN CONCAT('<',FORMAT(s_data, 2))
		WHEN s_qualifier = 1 THEN CONCAT('>',FORMAT(s_data, 2))
		ELSE CONCAT('',FORMAT(s_data,2))
      END ;
END IF;

  RETURN s_value;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Article`
--

CREATE TABLE IF NOT EXISTS `Article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext NOT NULL,
  `Publisher` text NOT NULL,
  `hyperlink` longtext,
  `abstract` longtext,
  `listSequenceNo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Article`
--

INSERT INTO `Article` (`id`, `title`, `Publisher`, `hyperlink`, `abstract`, `listSequenceNo`) VALUES
(1, 'Wetland Article 2014', '', 'http://www.nuigalway.ie', 'test......', 4),
(2, 'Another article', '', 'http://www.nuigalway.ie/gene/', 'This article.....', 5),
(3, 'Yet another article', '', 'http://www.nuigalway.ie', 'Following recent.....', 6);

-- --------------------------------------------------------

--
-- Table structure for table `AuthorizedUser`
--

CREATE TABLE IF NOT EXISTS `AuthorizedUser` (
  `userEmail` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` char(25) NOT NULL,
  `registrationDate` datetime NOT NULL,
  PRIMARY KEY (`userEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AuthorizedUser`
--

INSERT INTO `AuthorizedUser` (`userEmail`, `name`, `role`, `registrationDate`) VALUES
('demo2@gmail.com', '2user', 'Research', '2015-01-31 05:18:26'),
('demo@email.ie', 'user1', 'Administrator', '2015-01-30 00:00:00'),
('otheremail@mail.com', 'me33333333333333333333', 'Research', '2015-01-15 07:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', '{\r\n"admin": 0,\r\n"reg": 0,\r\n"auth": 0\r\n}'),
(2, 'Administrator', '{\r\n"admin": 1,\r\n"reg": 1,\r\n"auth": 1\r\n}'),
(3, 'Registered User', '{\r\n"admin": 0,\r\n"reg": 1,\r\n"auth": 0\r\n}'),
(4, 'Authorized User', '{\r\n"admin": 0,\r\n"reg": 1,\r\n"auth": 1\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `Observation`
--

CREATE TABLE IF NOT EXISTS `Observation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PretreatmentType`
--

CREATE TABLE IF NOT EXISTS `PretreatmentType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `PretreatmentType`
--

INSERT INTO `PretreatmentType` (`id`, `name`) VALUES
(1, 'Activated sludge treatment'),
(2, 'Primary'),
(3, 'Secondary');

-- --------------------------------------------------------

--
-- Table structure for table `Resource`
--

CREATE TABLE IF NOT EXISTS `Resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wetlandID` int(11) NOT NULL,
  `image` tinyblob,
  `description` longtext NOT NULL,
  `listSequenceNo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Resource_Wetland` (`wetlandID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Resource`
--

INSERT INTO `Resource` (`id`, `wetlandID`, `image`, `description`, `listSequenceNo`) VALUES
(1, 1, NULL, 'Resource1', 1),
(2, 2, NULL, 'Resource for wetland 2', 2),
(3, 3, NULL, 'Another resource', 3);

-- --------------------------------------------------------

--
-- Table structure for table `SampleData`
--

CREATE TABLE IF NOT EXISTS `SampleData` (
  `sampleID` int(11) NOT NULL,
  `samplePoint` set('I','O') NOT NULL,
  `COD` float NOT NULL,
  `qCOD` tinyint(1) DEFAULT NULL,
  `BOD` float NOT NULL,
  `qBod` tinyint(1) DEFAULT NULL,
  `suspSolids` float NOT NULL,
  `qSuspSolids` tinyint(1) DEFAULT NULL,
  `pH` float NOT NULL,
  `qPH` tinyint(1) DEFAULT NULL,
  `dissolvedOxy` float NOT NULL,
  `qDissolvedOxy` tinyint(1) DEFAULT NULL,
  `temp` float NOT NULL,
  `qTemp` tinyint(1) DEFAULT NULL,
  `nitrogren` float NOT NULL,
  `qNitrogren` tinyint(1) DEFAULT NULL,
  `NH4N` float NOT NULL,
  `qNH4N` tinyint(1) DEFAULT NULL,
  `NO3N` float NOT NULL,
  `qNO3N` tinyint(1) DEFAULT NULL,
  `TON` float NOT NULL,
  `qTON` tinyint(1) DEFAULT NULL,
  `phosphorous` float NOT NULL,
  `qPhosphorous` tinyint(1) DEFAULT NULL,
  `PO4P` float NOT NULL,
  `qPO4P` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`sampleID`,`samplePoint`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `SampleData`
--

INSERT INTO `SampleData` (`sampleID`, `samplePoint`, `COD`, `qCOD`, `BOD`, `qBod`, `suspSolids`, `qSuspSolids`, `pH`, `qPH`, `dissolvedOxy`, `qDissolvedOxy`, `temp`, `qTemp`, `nitrogren`, `qNitrogren`, `NH4N`, `qNH4N`, `NO3N`, `qNO3N`, `TON`, `qTON`, `phosphorous`, `qPhosphorous`, `PO4P`, `qPO4P`) VALUES
(1, 'I', 10, 0, 2, 0, 2, 0, 7.2, NULL, 0, NULL, 0, NULL, 8.69, NULL, 0, NULL, 0, NULL, 0, NULL, 0.54, NULL, 0.15, NULL),
(1, 'O', 10, 0, 2, 0, 2, 0, 7.3, NULL, 0, NULL, 0, NULL, 1.11, NULL, 0, NULL, 0, NULL, 0, NULL, 0.06, NULL, 0.029, NULL),
(2, 'I', 33, NULL, 2, 0, 2, 0, 7.4, NULL, 0, NULL, 0, NULL, 10.6, NULL, 0, NULL, 0, NULL, 0, NULL, 0.22, NULL, 0.094, NULL),
(2, 'O', 43, NULL, 2, 0, 2, 0, 7.4, NULL, 0, NULL, 0, NULL, 0.926, NULL, 0, NULL, 0, NULL, 0, NULL, 0.06, NULL, 0.015, NULL),
(3, 'I', 17, NULL, 2, 0, 2, 0, 7.8, NULL, 0, NULL, 0, NULL, 13.6, NULL, 0, NULL, 0, NULL, 0, NULL, 2.08, NULL, 1.73, NULL),
(3, 'O', 27, NULL, 2, 0, 2, 0, 7.6, NULL, 0, NULL, 0, NULL, 3.49, NULL, 0, NULL, 0, NULL, 0, NULL, 0.76, NULL, 0.675, NULL),
(4, 'I', 48, NULL, 2, 0, 2, 0, 7.5, NULL, 0, NULL, 0, NULL, 12.6, NULL, 0, NULL, 0, NULL, 0, NULL, 3.4, NULL, 0.25, NULL),
(4, 'O', 40, NULL, 2, 0, 2, NULL, 7.5, NULL, 0, NULL, 0, NULL, 3.73, NULL, 0, NULL, 0, NULL, 0, NULL, 0.93, NULL, 0.883, NULL),
(5, 'I', 108, NULL, 40, NULL, 35, NULL, 7.4, NULL, 0, NULL, 0, NULL, 12.8, NULL, 0, NULL, 0, NULL, 0, NULL, 2.24, NULL, 1.4, NULL),
(5, 'O', 22, NULL, 2, 0, 27, NULL, 7.9, NULL, 0, NULL, 0, NULL, 4.63, NULL, 0, NULL, 0, NULL, 0, NULL, 0.94, NULL, 0.696, NULL),
(6, 'I', 18, NULL, 2, 0, 2, 0, 7.5, NULL, 0, NULL, 0, NULL, 19.6, NULL, 1.99, NULL, 0, NULL, 0.1, 0, 2.9, NULL, 2.31, NULL),
(6, 'O', 20, NULL, 2, 0, 7, NULL, 7.3, NULL, 0, NULL, 0, NULL, 10.9, NULL, 0, NULL, 0, NULL, 0, NULL, 2.52, NULL, 2.26, NULL),
(7, 'I', 10, 0, 2, 0, 11, NULL, 6.7, NULL, 0, NULL, 0, NULL, 13.9, NULL, 9.54, NULL, 0, NULL, 2.4, NULL, 0.25, NULL, 0.132, NULL),
(7, 'O', 10, 0, 2, 0, 2, 0, 6.7, NULL, 0, NULL, 0, NULL, 6.33, NULL, 0, NULL, 0, NULL, 0, NULL, 1.04, NULL, 1.04, NULL),
(8, 'I', 10, 0, 2, 0, 5, NULL, 7.2, NULL, 0, NULL, 0, NULL, 8.13, NULL, 4.86, NULL, 0, NULL, 2.34, NULL, 0.22, NULL, 0.04, NULL),
(8, 'O', 10, 0, 2, 0, 2, NULL, 7.2, NULL, 0, NULL, 0, NULL, 2.4, NULL, 0, NULL, 0, NULL, 0, NULL, 0.17, NULL, 0.13, NULL),
(9, 'I', 10, NULL, 2, 0, 3, NULL, 7.4, NULL, 0, NULL, 0, NULL, 9.07, NULL, 0.406, NULL, 0, NULL, 7.43, NULL, 0.14, NULL, 0.012, NULL),
(9, 'O', 13, NULL, 2, 0, 2, 0, 7.2, NULL, 0, NULL, 0, NULL, 3.53, NULL, 0, NULL, 0, NULL, 0, NULL, 0.23, NULL, 0.086, NULL),
(10, 'I', 13, NULL, 2, 0, 4, NULL, 7.1, NULL, 0, NULL, 0, NULL, 7.94, NULL, 0.581, NULL, 0, NULL, 7.27, NULL, 0.79, NULL, 0.586, NULL),
(10, 'O', 10, 0, 2, 0, 2, NULL, 7, NULL, 0, NULL, 0, NULL, 2.94, NULL, 0, NULL, 0, NULL, 0, NULL, 0.48, NULL, 0.405, NULL),
(11, 'I', 40, NULL, 2, 0, 6, NULL, 7, NULL, 0, NULL, 0, NULL, 8.66, NULL, 1.82, NULL, 0, NULL, 5.69, NULL, 0.324, NULL, 0.175, NULL),
(11, 'O', 43, NULL, 2, 0, 3, NULL, 6.7, NULL, 0, NULL, 0, NULL, 5.83, NULL, 0, NULL, 0, NULL, 0, NULL, 0.18, NULL, 0.075, NULL),
(12, 'I', 16, NULL, 2, 0, 3, NULL, 6.9, NULL, 0, NULL, 0, NULL, 11.9, NULL, 1.36, NULL, 0, NULL, 11.1, NULL, 0.24, NULL, 0.055, NULL),
(12, 'O', 10, NULL, 2, 0, 2, 0, 6.7, NULL, 0, NULL, 0, NULL, 3.92, NULL, 0, NULL, 0, NULL, 0, NULL, 0.09, NULL, 0.022, NULL),
(13, 'O', 0, NULL, 1.8, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(14, 'O', 27, NULL, 4, NULL, 0, NULL, 7.4, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0.197, NULL, 0, NULL, 0, NULL, 0, NULL),
(15, 'O', 27, NULL, 1.8, NULL, 2, NULL, 7.17, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(16, 'O', 22, NULL, 1.32, NULL, 6, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(17, 'O', 34, NULL, 0.9, NULL, 2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(18, 'O', 32, NULL, 1.3, NULL, 6, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 3.7, NULL, 0, NULL),
(19, 'O', 28, NULL, 1.8, NULL, 2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(20, 'O', 25, NULL, 1.9, NULL, 0, NULL, 7.64, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0.0528, NULL, 0, NULL, 0, NULL, 0, NULL),
(21, 'O', 23, NULL, 1.9, NULL, 0.2, NULL, 7.78, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(22, 'O', 26, NULL, 1, NULL, 0.2, NULL, 7.31, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(23, 'O', 30, NULL, 1.14, NULL, 3, NULL, 7.13, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(24, 'O', 35, NULL, 1, NULL, 1, NULL, 7.44, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(25, 'I', 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 6.713, NULL, 3.543, NULL),
(25, 'O', 0, 0, 1, NULL, 0.8, NULL, 7.25, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(26, 'O', 21.8, NULL, 1.1, NULL, 0.4, NULL, 7.08, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(27, 'O', 44.2, NULL, 5.2, NULL, 2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(28, 'I', 64.7, NULL, 6.8, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(28, 'O', 19.5, NULL, 3, NULL, 1.4, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(29, 'I', 106.6, NULL, 0, NULL, 15.2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(29, 'O', 10.2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(30, 'I', 84.1, NULL, 7.2, NULL, 35.6, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(31, 'O', 6.8, NULL, 1.4, NULL, 0.4, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(32, 'O', 27, NULL, 5, NULL, 15, NULL, 6.18, NULL, 0, NULL, 0, NULL, 4.343, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(33, 'O', 17, NULL, 2, NULL, 4, NULL, 7.32, NULL, 0, NULL, 0, NULL, 7, NULL, 0, NULL, 0, NULL, 0, NULL, 3.169, NULL, 0, NULL),
(34, 'I', 16, NULL, 42, NULL, 28, NULL, 7.5, NULL, 0, NULL, 0, NULL, 10.51, NULL, 0, NULL, 0, NULL, 0, NULL, 0.925, NULL, 0, NULL),
(34, 'O', 25, NULL, 2, NULL, 0, NULL, 7.36, NULL, 0, NULL, 0, NULL, 6.59, NULL, 0, NULL, 0, NULL, 0, NULL, 1.278, NULL, 0, NULL),
(35, 'O', 19, NULL, 2, NULL, 2, NULL, 7.31, NULL, 0, NULL, 0, NULL, 0, 9, 0, NULL, 0, NULL, 0, NULL, 1.506, NULL, 0, NULL),
(36, 'O', 14, NULL, 2, NULL, 5, NULL, 7.15, NULL, 0, NULL, 0, NULL, 7.67, NULL, 0, NULL, 0, NULL, 0, NULL, 1.256, NULL, 0, NULL),
(37, 'O', 97, NULL, 18, NULL, 0, NULL, 7.04, NULL, 0, NULL, 0, NULL, 1, 0, 0, NULL, 0, NULL, 0, NULL, 3.334, NULL, 0, NULL),
(38, 'O', 9, NULL, 2, NULL, 1, NULL, 7.33, NULL, 0, NULL, 0, NULL, 6.79, NULL, 0, NULL, 0, NULL, 0, NULL, 1.574, NULL, 0, NULL),
(39, 'I', 36, NULL, 5, NULL, 20, NULL, 7.41, NULL, 0, NULL, 0, NULL, 6.39, NULL, 0, NULL, 0, NULL, 0, NULL, 0.747, NULL, 0, NULL),
(39, 'O', 18, NULL, 1, NULL, 1, NULL, 7.18, NULL, 0, NULL, 0, NULL, 3.8, 1, 0, NULL, 0, NULL, 0, NULL, 0.576, NULL, 0, NULL),
(40, 'O', 19, NULL, 1, NULL, 16, NULL, 7.56, NULL, 0, NULL, 0, NULL, 2.6, NULL, 0, NULL, 0, NULL, 0, NULL, 1.34, NULL, 0, NULL),
(41, 'O', 70, NULL, 31, NULL, 31, NULL, 0, NULL, 0, NULL, 0, NULL, 9.9, NULL, 0, NULL, 0, NULL, 0, NULL, 4.9, NULL, 0, NULL),
(42, 'O', 67, NULL, 24, NULL, 14, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(43, 'O', 22, NULL, 1, 0, 5, 0, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(44, 'O', 18, NULL, 0, NULL, 0.8, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(45, 'O', 24, NULL, 0, NULL, 7.5, 0, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(46, 'O', 24, NULL, 0, NULL, 11.2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(47, 'O', 23.2, NULL, 0, NULL, 1.2, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(48, 'O', 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 1, 0),
(49, 'O', 19, NULL, 0, NULL, 2.5, 0, 7.27, NULL, 0, NULL, 0, NULL, 3.76, NULL, 0.275, NULL, 0, NULL, 0, NULL, 0.748, NULL, 0.733, NULL),
(50, 'O', 48, NULL, 0, NULL, 4.33, NULL, 7.27, NULL, 0, NULL, 0, NULL, 3.76, NULL, 0, NULL, 0, NULL, 0, NULL, 1.78, NULL, 1.62, NULL),
(51, 'O', 26, NULL, 0, NULL, 5.6, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 1, 0),
(52, 'O', 15, 0, 0, NULL, 10, 0, 7.26, NULL, 0, NULL, 0, NULL, 0, NULL, 3.383, NULL, 0, NULL, 0, NULL, 0, NULL, 3.39, NULL),
(53, 'O', 23.8, NULL, 0, NULL, 1, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL),
(54, 'O', 18, NULL, 0, NULL, 2.5, 0, 7.2, NULL, 0, NULL, 0, NULL, 5.94, NULL, 0.294, NULL, 0, NULL, 0, NULL, 1.44, NULL, 1.06, NULL),
(55, 'O', 36, NULL, 0, NULL, 2.5, 0, 7.24, NULL, 0, NULL, 0, NULL, 3.5, NULL, 0.139, NULL, 0, NULL, 0, NULL, 0.84, NULL, 0.71, NULL),
(57, 'O', 20, 0, 2.8, NULL, 10, NULL, 7.61, NULL, 0, NULL, 0, NULL, 0, NULL, 0.093, NULL, 0, NULL, 0, NULL, 0, NULL, 0.72, NULL),
(58, 'O', 24, NULL, 1.56, NULL, 13, NULL, 7.33, NULL, 0, NULL, 0, NULL, 0, NULL, 0.08, NULL, 0, NULL, 0, NULL, 0, NULL, 2.6, NULL),
(59, 'O', 18, NULL, 3.14, NULL, 7, 0, 7.06, NULL, 0, NULL, 0, NULL, 0, NULL, 0.402, NULL, 0, NULL, 0, NULL, 0, NULL, 0.36, NULL),
(60, 'O', 21, NULL, 1.73, NULL, 11, NULL, 7.62, NULL, 0, NULL, 0, NULL, 0, NULL, 0.079, NULL, 0, NULL, 0, NULL, 0, NULL, 2.09, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `SampleInletView`
--
CREATE TABLE IF NOT EXISTS `SampleInletView` (
`wetlandID` int(11)
,`sampleDate` date
,`dailyFlowRate` float
,`COD_inlet` text
,`BOD_inlet` text
,`SS_inlet` text
,`pH_inlet` text
,`Oxy_inlet` text
,`Temp_inlet` text
,`N_inlet` text
,`NH4N_inlet` text
,`NO3N_inlet` text
,`TON_inlet` text
,`P_inlet` text
,`PO4P_inlet` text
);
-- --------------------------------------------------------

--
-- Table structure for table `SampleObservation`
--

CREATE TABLE IF NOT EXISTS `SampleObservation` (
  `sampleID` int(11) NOT NULL,
  `observationID` int(11) NOT NULL,
  PRIMARY KEY (`sampleID`,`observationID`),
  KEY `FK_SampleObservation_Observation` (`observationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stand-in structure for view `SampleOutletView`
--
CREATE TABLE IF NOT EXISTS `SampleOutletView` (
`wetlandID` int(11)
,`sampleDate` date
,`dailyFlowRate` float
,`COD_outlet` text
,`BOD_outlet` text
,`SS_outlet` text
,`pH_outlet` text
,`Oxy_outlet` text
,`Temp_outlet` text
,`N_outlet` text
,`NH4N_outlet` text
,`NO3N_outlet` text
,`TON_outlet` text
,`P_outlet` text
,`PO4P_outlet` text
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `SampleView`
--
CREATE TABLE IF NOT EXISTS `SampleView` (
`wetlandID` int(11)
,`sampleDate` date
,`dailyFlowRate` float
,`COD_inlet` text
,`COD_outlet` text
,`BOD_inlet` text
,`BOD_outlet` text
,`SS_inlet` text
,`SS_outlet` text
,`pH_inlet` text
,`pH_outlet` text
,`Oxy_inlet` text
,`Oxy_outlet` text
,`Temp_inlet` text
,`Temp_outlet` text
,`N_inlet` text
,`N_outlet` text
,`NH4N_inlet` text
,`NH4N_outlet` text
,`NO3N_inlet` text
,`NO3N_outlet` text
,`TON_inlet` text
,`TON_outlet` text
,`P_inlet` text
,`P_outlet` text
,`PO4P_inlet` text
,`PO4P_outlet` text
);
-- --------------------------------------------------------

--
-- Table structure for table `SiteSourceType`
--

CREATE TABLE IF NOT EXISTS `SiteSourceType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `SiteSourceType`
--

INSERT INTO `SiteSourceType` (`id`, `name`) VALUES
(1, 'Municipal'),
(2, 'Agricultural'),
(3, 'Industrial');

-- --------------------------------------------------------

--
-- Table structure for table `submittedFiles`
--

CREATE TABLE IF NOT EXISTS `submittedFiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `content` blob NOT NULL,
  `dateUploaded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varbinary(32) NOT NULL DEFAULT '0',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `company` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `job_title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `group` (`group`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `name`, `company`, `job_title`, `joined`, `group`) VALUES
(6, 'seanin101', 'cb930f6566c4c8c3219c8753de84dfcf2aa15d73605148281a499378ba2f9f71', '˚"∏ÎO˛√}—E>JÅŸ<ﬂ∂¨$â◊æ‘´=Y', 's.lydon13@nuigalway.ie', 'Sean Lydon', 'NUIG', 'Student', '2015-02-18 17:26:05', 2),
(7, 'catgsmith', '9a93dc6e6ddd3abd8bfa2d8926aeabef3032462cb7e609686953b8b5c619e08c', '@≈Vy©,ídQß¡&Ÿq8z˚ËXZ”ºÕπ/pF$bs', 'catgsmith@gmail.ie', 'Catherine Gaughan-Smith', 'NUIG', 'Student', '2015-02-22 15:49:32', 1),
(9, 'barbarakelly', 'b83963595391bb8f85813d0cdcf2df839c1ebdcc90cae989378074f5ffa3f3e9', '¬Üc(\0r˘A.´g≠Üˆ¬ïÚ€Ó°úÊ∆i''EÉõ', 'barbarakelly@gmail.ie', 'Barbara', 'NUIG', 'Student', '2015-02-22 19:45:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE IF NOT EXISTS `user_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_session`
--

INSERT INTO `user_session` (`id`, `user_id`, `hash`) VALUES
(2, 7, 'e22a0f24d4b18010a3239f1d3842c77be6a5afe1773c0ae9596b922127f9ab30');

-- --------------------------------------------------------

--
-- Table structure for table `Wetland`
--

CREATE TABLE IF NOT EXISTS `Wetland` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `county` varchar(30) NOT NULL,
  `siteSourceType` int(11) NOT NULL,
  `pretreatmentType` int(11) NOT NULL,
  `siteSize` int(11) NOT NULL,
  `siteDescription` longtext,
  PRIMARY KEY (`id`),
  KEY `FK_PretreatmentType` (`pretreatmentType`),
  KEY `FK_SiteSourceType` (`siteSourceType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Wetland`
--

INSERT INTO `Wetland` (`id`, `name`, `county`, `siteSourceType`, `pretreatmentType`, `siteSize`, `siteDescription`) VALUES
(1, 'Moycullen', 'Galway', 1, 1, 2400, NULL),
(2, 'Keshcarrigan', 'Leitrim', 2, 3, 10, 'Description pending'),
(3, 'Ballyfarnon', 'Roscommon', 1, 1, 30, 'Another description pending'),
(4, 'Keadew', 'Roscommon', 1, 1, 2300, '...'),
(5, 'Cloonfad', 'Roscommon', 1, 1, 100, '........');

-- --------------------------------------------------------

--
-- Table structure for table `WetlandArticle`
--

CREATE TABLE IF NOT EXISTS `WetlandArticle` (
  `articleID` int(11) NOT NULL,
  `wetlandID` int(11) NOT NULL,
  PRIMARY KEY (`articleID`,`wetlandID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `WetlandArticle`
--

INSERT INTO `WetlandArticle` (`articleID`, `wetlandID`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `WetlandSample`
--

CREATE TABLE IF NOT EXISTS `WetlandSample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wetlandID` int(11) NOT NULL,
  `sampleDate` date NOT NULL,
  `dailyFlowRate` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wetlandID` (`wetlandID`,`sampleDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Dumping data for table `WetlandSample`
--

INSERT INTO `WetlandSample` (`id`, `wetlandID`, `sampleDate`, `dailyFlowRate`) VALUES
(1, 1, '2013-01-10', 707),
(2, 1, '2013-02-14', 0),
(3, 1, '2013-03-12', 0),
(4, 1, '2013-04-09', 0),
(5, 1, '2013-05-14', 0),
(6, 1, '2013-06-11', 0),
(7, 1, '2013-07-17', 0),
(8, 1, '2013-08-13', 0),
(9, 1, '2013-09-10', 0),
(10, 1, '2013-10-11', 0),
(11, 1, '2013-11-14', 0),
(12, 1, '2013-12-06', 0),
(13, 2, '1999-10-14', 0),
(14, 2, '2000-07-27', 0),
(15, 2, '2001-07-26', 0),
(16, 2, '2002-06-17', 0),
(17, 2, '2002-07-09', 0),
(18, 2, '2002-07-23', 0),
(19, 2, '2002-08-27', 0),
(20, 2, '2002-09-04', 0),
(21, 2, '2003-03-20', 0),
(22, 2, '2003-05-22', 0),
(23, 2, '2003-07-15', 0),
(24, 2, '2003-09-22', 0),
(25, 2, '2004-05-14', 0),
(26, 2, '2004-07-13', 0),
(27, 2, '2005-02-01', 0),
(28, 2, '2005-12-15', 0),
(29, 2, '2005-12-20', 0),
(30, 2, '2006-01-20', 0),
(31, 2, '2006-06-20', 0),
(32, 2, '2006-07-07', 0),
(33, 2, '2006-09-14', 0),
(34, 2, '2007-01-04', 0),
(35, 2, '2007-01-17', 0),
(36, 2, '2007-03-12', 0),
(37, 2, '2007-09-05', 0),
(38, 2, '2008-04-09', 0),
(39, 2, '2009-01-20', 0),
(40, 2, '2010-02-24', 0),
(41, 2, '2011-01-25', 0),
(42, 2, '2011-01-27', 0),
(43, 2, '2011-07-28', 0),
(44, 2, '2012-01-23', 0),
(45, 2, '2012-05-24', 0),
(46, 2, '2012-06-24', 0),
(47, 2, '2012-08-02', 0),
(48, 2, '2012-10-10', 0),
(49, 2, '2012-12-05', 0),
(50, 2, '2013-03-05', 0),
(51, 2, '2013-06-20', 0),
(52, 2, '2013-08-21', 0),
(53, 2, '2013-10-22', 0),
(54, 2, '2014-03-27', 0),
(55, 2, '2014-11-11', 0),
(56, 2, '2016-02-15', 0),
(57, 3, '2014-03-11', 0),
(58, 3, '2014-08-13', 0),
(59, 4, '2014-01-21', 0),
(60, 5, '2014-04-30', 0);

-- --------------------------------------------------------

--
-- Structure for view `SampleInletView`
--
DROP TABLE IF EXISTS `SampleInletView`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `SampleInletView` AS select `w`.`wetlandID` AS `wetlandID`,`w`.`sampleDate` AS `sampleDate`,`w`.`dailyFlowRate` AS `dailyFlowRate`,`Qualifier`(`inlet`.`COD`,`inlet`.`qCOD`) AS `COD_inlet`,`Qualifier`(`inlet`.`BOD`,`inlet`.`qBod`) AS `BOD_inlet`,`Qualifier`(`inlet`.`suspSolids`,`inlet`.`qSuspSolids`) AS `SS_inlet`,`Qualifier`(`inlet`.`pH`,`inlet`.`qPH`) AS `pH_inlet`,`Qualifier`(`inlet`.`dissolvedOxy`,`inlet`.`qDissolvedOxy`) AS `Oxy_inlet`,`Qualifier`(`inlet`.`temp`,`inlet`.`qTemp`) AS `Temp_inlet`,`Qualifier`(`inlet`.`nitrogren`,`inlet`.`qNitrogren`) AS `N_inlet`,`Qualifier`(`inlet`.`NH4N`,`inlet`.`qNH4N`) AS `NH4N_inlet`,`Qualifier`(`inlet`.`NO3N`,`inlet`.`qNO3N`) AS `NO3N_inlet`,`Qualifier`(`inlet`.`TON`,`inlet`.`qTON`) AS `TON_inlet`,`Qualifier`(`inlet`.`phosphorous`,`inlet`.`qPhosphorous`) AS `P_inlet`,`Qualifier`(`inlet`.`PO4P`,`inlet`.`qPO4P`) AS `PO4P_inlet` from (`SampleData` `inlet` left join `WetlandSample` `w` on((`w`.`id` = `inlet`.`sampleID`))) where (`inlet`.`samplePoint` = 'I');

-- --------------------------------------------------------

--
-- Structure for view `SampleOutletView`
--
DROP TABLE IF EXISTS `SampleOutletView`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `SampleOutletView` AS select `w`.`wetlandID` AS `wetlandID`,`w`.`sampleDate` AS `sampleDate`,`w`.`dailyFlowRate` AS `dailyFlowRate`,`Qualifier`(`outlet`.`COD`,`outlet`.`qCOD`) AS `COD_outlet`,`Qualifier`(`outlet`.`BOD`,`outlet`.`qBod`) AS `BOD_outlet`,`Qualifier`(`outlet`.`suspSolids`,`outlet`.`qSuspSolids`) AS `SS_outlet`,`Qualifier`(`outlet`.`pH`,`outlet`.`qPH`) AS `pH_outlet`,`Qualifier`(`outlet`.`dissolvedOxy`,`outlet`.`qDissolvedOxy`) AS `Oxy_outlet`,`Qualifier`(`outlet`.`temp`,`outlet`.`qTemp`) AS `Temp_outlet`,`Qualifier`(`outlet`.`nitrogren`,`outlet`.`qNitrogren`) AS `N_outlet`,`Qualifier`(`outlet`.`NH4N`,`outlet`.`qNH4N`) AS `NH4N_outlet`,`Qualifier`(`outlet`.`NO3N`,`outlet`.`qNO3N`) AS `NO3N_outlet`,`Qualifier`(`outlet`.`TON`,`outlet`.`qTON`) AS `TON_outlet`,`Qualifier`(`outlet`.`phosphorous`,`outlet`.`qPhosphorous`) AS `P_outlet`,`Qualifier`(`outlet`.`PO4P`,`outlet`.`qPO4P`) AS `PO4P_outlet` from (`SampleData` `outlet` left join `WetlandSample` `w` on((`w`.`id` = `outlet`.`sampleID`))) where (`outlet`.`samplePoint` = 'O');

-- --------------------------------------------------------

--
-- Structure for view `SampleView`
--
DROP TABLE IF EXISTS `SampleView`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `SampleView` AS select `inlet`.`wetlandID` AS `wetlandID`,`inlet`.`sampleDate` AS `sampleDate`,`inlet`.`dailyFlowRate` AS `dailyFlowRate`,`inlet`.`COD_inlet` AS `COD_inlet`,`outlet`.`COD_outlet` AS `COD_outlet`,`inlet`.`BOD_inlet` AS `BOD_inlet`,`outlet`.`BOD_outlet` AS `BOD_outlet`,`inlet`.`SS_inlet` AS `SS_inlet`,`outlet`.`SS_outlet` AS `SS_outlet`,`inlet`.`pH_inlet` AS `pH_inlet`,`outlet`.`pH_outlet` AS `pH_outlet`,`inlet`.`Oxy_inlet` AS `Oxy_inlet`,`outlet`.`Oxy_outlet` AS `Oxy_outlet`,`inlet`.`Temp_inlet` AS `Temp_inlet`,`outlet`.`Temp_outlet` AS `Temp_outlet`,`inlet`.`N_inlet` AS `N_inlet`,`outlet`.`N_outlet` AS `N_outlet`,`inlet`.`NH4N_inlet` AS `NH4N_inlet`,`outlet`.`NH4N_outlet` AS `NH4N_outlet`,`inlet`.`NO3N_inlet` AS `NO3N_inlet`,`outlet`.`NO3N_outlet` AS `NO3N_outlet`,`inlet`.`TON_inlet` AS `TON_inlet`,`outlet`.`TON_outlet` AS `TON_outlet`,`inlet`.`P_inlet` AS `P_inlet`,`outlet`.`P_outlet` AS `P_outlet`,`inlet`.`PO4P_inlet` AS `PO4P_inlet`,`outlet`.`PO4P_outlet` AS `PO4P_outlet` from (`SampleInletView` `inlet` left join `SampleOutletView` `outlet` on(((`inlet`.`wetlandID` = `outlet`.`wetlandID`) and (`inlet`.`sampleDate` = `outlet`.`sampleDate`)))) union select `outlet`.`wetlandID` AS `wetlandID`,`outlet`.`sampleDate` AS `sampleDate`,`outlet`.`dailyFlowRate` AS `dailyFlowRate`,`inlet`.`COD_inlet` AS `COD_inlet`,`outlet`.`COD_outlet` AS `COD_outlet`,`inlet`.`BOD_inlet` AS `BOD_inlet`,`outlet`.`BOD_outlet` AS `BOD_outlet`,`inlet`.`SS_inlet` AS `SS_inlet`,`outlet`.`SS_outlet` AS `SS_outlet`,`inlet`.`pH_inlet` AS `pH_inlet`,`outlet`.`pH_outlet` AS `pH_outlet`,`inlet`.`Oxy_inlet` AS `Oxy_inlet`,`outlet`.`Oxy_outlet` AS `Oxy_outlet`,`inlet`.`Temp_inlet` AS `Temp_inlet`,`outlet`.`Temp_outlet` AS `Temp_outlet`,`inlet`.`N_inlet` AS `N_inlet`,`outlet`.`N_outlet` AS `N_outlet`,`inlet`.`NH4N_inlet` AS `NH4N_inlet`,`outlet`.`NH4N_outlet` AS `NH4N_outlet`,`inlet`.`NO3N_inlet` AS `NO3N_inlet`,`outlet`.`NO3N_outlet` AS `NO3N_outlet`,`inlet`.`TON_inlet` AS `TON_inlet`,`outlet`.`TON_outlet` AS `TON_outlet`,`inlet`.`P_inlet` AS `P_inlet`,`outlet`.`P_outlet` AS `P_outlet`,`inlet`.`PO4P_inlet` AS `PO4P_inlet`,`outlet`.`PO4P_outlet` AS `PO4P_outlet` from (`SampleOutletView` `outlet` left join `SampleInletView` `inlet` on(((`inlet`.`wetlandID` = `outlet`.`wetlandID`) and (`inlet`.`sampleDate` = `outlet`.`sampleDate`))));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Resource`
--
ALTER TABLE `Resource`
  ADD CONSTRAINT `FK_Resource_Wetland` FOREIGN KEY (`wetlandID`) REFERENCES `Wetland` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `SampleData`
--
ALTER TABLE `SampleData`
  ADD CONSTRAINT `FK_WetlandSample` FOREIGN KEY (`sampleID`) REFERENCES `WetlandSample` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `SampleObservation`
--
ALTER TABLE `SampleObservation`
  ADD CONSTRAINT `FK_SampleObservation_Observation` FOREIGN KEY (`observationID`) REFERENCES `Observation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_SampleObservation_Sample` FOREIGN KEY (`sampleID`) REFERENCES `WetlandSample` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group`) REFERENCES `groups` (`id`);

--
-- Constraints for table `Wetland`
--
ALTER TABLE `Wetland`
  ADD CONSTRAINT `FK_PretreatmentType` FOREIGN KEY (`pretreatmentType`) REFERENCES `PretreatmentType` (`id`),
  ADD CONSTRAINT `FK_SiteSourceType` FOREIGN KEY (`siteSourceType`) REFERENCES `SiteSourceType` (`id`);

--
-- Constraints for table `WetlandArticle`
--
ALTER TABLE `WetlandArticle`
  ADD CONSTRAINT `FK_WetlandArticle_Article` FOREIGN KEY (`articleID`) REFERENCES `Article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_WetlandArticle_Wetland` FOREIGN KEY (`articleID`) REFERENCES `Wetland` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `WetlandSample`
--
ALTER TABLE `WetlandSample`
  ADD CONSTRAINT `FK_WetlandID` FOREIGN KEY (`wetlandID`) REFERENCES `Wetland` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
