-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2015 at 06:35 PM
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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `WetlandSample`
--
ALTER TABLE `WetlandSample`
  ADD CONSTRAINT `FK_WetlandID` FOREIGN KEY (`wetlandID`) REFERENCES `Wetland` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
