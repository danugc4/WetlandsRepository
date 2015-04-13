-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 11:46 PM
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
-- Table structure for table `Wetland`
--

CREATE TABLE IF NOT EXISTS `Wetland` (
`id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `county` varchar(30) NOT NULL,
  `siteSourceType` int(11) NOT NULL,
  `pretreatmentType` int(11) NOT NULL,
  `siteSize` int(11) NOT NULL,
  `siteDescription` longtext
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Wetland`
--

INSERT INTO `Wetland` (`id`, `name`, `county`, `siteSourceType`, `pretreatmentType`, `siteSize`, `siteDescription`) VALUES
(1, 'Moycullen', 'Galway', 1, 1, 2400, NULL),
(2, 'Keshcarrigan', 'Leitrim', 2, 3, 10, 'Description pending'),
(3, 'Ballyfarnon', 'Roscommon', 1, 1, 30, 'Another description pending'),
(4, 'Keadew', 'Roscommon', 1, 1, 2300, '...'),
(5, 'Cloonfad', 'Roscommon', 1, 1, 100, '........'),
(11, 'Inverin', 'Galway', 2, 2, 300, 'fff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Wetland`
--
ALTER TABLE `Wetland`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_PretreatmentType` (`pretreatmentType`), ADD KEY `FK_SiteSourceType` (`siteSourceType`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Wetland`
--
ALTER TABLE `Wetland`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Wetland`
--
ALTER TABLE `Wetland`
ADD CONSTRAINT `FK_PretreatmentType` FOREIGN KEY (`pretreatmentType`) REFERENCES `PretreatmentType` (`id`),
ADD CONSTRAINT `FK_SiteSourceType` FOREIGN KEY (`siteSourceType`) REFERENCES `SiteSourceType` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
