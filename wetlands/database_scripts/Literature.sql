-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 07:10 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `Literature`
--

CREATE TABLE IF NOT EXISTS `Literature` (
  `LiteratureID` int(11) NOT NULL AUTO_INCREMENT,
  `LiteratureTitle` longtext NOT NULL,
  `LiteratureAuthor` text NOT NULL,
  `LiteratureDate` year(4) NOT NULL,
  `Publisher` text NOT NULL,
  `DOI` longtext,
  `listPriority` int(11) NOT NULL,
  PRIMARY KEY (`LiteratureID`),
  UNIQUE KEY `LiteratureID` (`LiteratureID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Literature`
--

INSERT INTO `Literature` (`LiteratureID`, `LiteratureTitle`, `LiteratureAuthor`, `LiteratureDate`, `Publisher`, `DOI`, `listPriority`) VALUES
(1, 'An integrated constructed wetland to treat contaminants and nutrients from dairy farmyard dirty water.', 'E.J. Dunne, N. Culleton, G. O Donovan, R. Harrington, A.E. Olsen', 2004, 'Ecological Engineering', 'http://dx.doi.org/10.1016/j.ecoleng.2004.11.010', 2),
(2, 'Long-term performance of a representative integrated constructed wetland treating farmyard runoff.', 'Atif Mustafaa, Miklas Scholz, Rory Harrington, Paul Carroll', 2009, 'Ecological Engineering', 'http://dx.doi.org/10.1016/j.ecoleng.2008.12.008', 2),
(3, 'Assessment of pre-digested piggery wastewater treatment operations with surface flow integrated constructed wetland systems.', 'Caolan Harrington, Miklas Scholz', 2010, 'Bioresource Technology', 'http://dx.doi.org/10.1016/j.biortech.2010.03.147', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
