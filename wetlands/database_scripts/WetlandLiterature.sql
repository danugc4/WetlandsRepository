-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 07:12 PM
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
-- Table structure for table `WetlandLiterature`
--

CREATE TABLE IF NOT EXISTS `WetlandLiterature` (
  `LiteratureID` int(11) NOT NULL,
  `wetlandID` int(11) NOT NULL,
  UNIQUE KEY `LiteratureID` (`LiteratureID`,`wetlandID`),
  KEY `wetlandID` (`wetlandID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `WetlandLiterature`
--

INSERT INTO `WetlandLiterature` (`LiteratureID`, `wetlandID`) VALUES
(2, 1),
(1, 2),
(3, 2),
(3, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `WetlandLiterature`
--
ALTER TABLE `WetlandLiterature`
  ADD CONSTRAINT `WetlandLiterature_ibfk_2` FOREIGN KEY (`wetlandID`) REFERENCES `Wetland` (`id`),
  ADD CONSTRAINT `WetlandLiterature_ibfk_1` FOREIGN KEY (`LiteratureID`) REFERENCES `Literature` (`LiteratureID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
