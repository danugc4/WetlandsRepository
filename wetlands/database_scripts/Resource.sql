-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 11:34 PM
-- Server version: 5.6.22-log
-- PHP Version: 5.5.15-pl0-gentoo

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
-- Table structure for table `Resource`
--

CREATE TABLE IF NOT EXISTS `Resource` (
`id` int(11) NOT NULL,
  `wetlandID` int(11) NOT NULL,
  `fileID` int(10) NOT NULL,
  `description` longtext NOT NULL,
  `listSequenceNo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Resource`
--

INSERT INTO `Resource` (`id`, `wetlandID`, `fileID`, `description`, `listSequenceNo`) VALUES
(1, 1, 10, 'Resource1', 1),
(2, 2, 11, 'Resource for wetland 2', 2),
(3, 3, 12, 'Another resource', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Resource`
--
ALTER TABLE `Resource`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_Resource_Wetland` (`wetlandID`), ADD KEY `fileID` (`fileID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Resource`
--
ALTER TABLE `Resource`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Resource`
--
ALTER TABLE `Resource`
ADD CONSTRAINT `FK_Resource_Wetland` FOREIGN KEY (`wetlandID`) REFERENCES `Wetland` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `Resource_ibfk_1` FOREIGN KEY (`fileID`) REFERENCES `file` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
