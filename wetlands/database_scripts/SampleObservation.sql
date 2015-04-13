-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 11:39 PM
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
-- Table structure for table `SampleObservation`
--

CREATE TABLE IF NOT EXISTS `SampleObservation` (
  `sampleID` int(11) NOT NULL,
  `observationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `SampleObservation`
--
ALTER TABLE `SampleObservation`
 ADD PRIMARY KEY (`sampleID`,`observationID`), ADD KEY `FK_SampleObservation_Observation` (`observationID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `SampleObservation`
--
ALTER TABLE `SampleObservation`
ADD CONSTRAINT `FK_SampleObservation_Observation` FOREIGN KEY (`observationID`) REFERENCES `Observation` (`observationID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `FK_SampleObservation_Sample` FOREIGN KEY (`sampleID`) REFERENCES `WetlandSample` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
