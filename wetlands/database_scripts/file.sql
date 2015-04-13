-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 09:39 PM
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
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
`id` int(10) NOT NULL,
  `userID` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `uploaded` datetime NOT NULL,
  `test` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `userID`, `filename`, `uploaded`, `test`) VALUES
(10, 6, 'hello.txt', '2015-03-05 19:25:55', ''),
(11, 6, 'example_for_db_15.jpg', '2015-03-05 19:53:18', ''),
(12, 6, 'example_for_db_16.jpg', '2015-03-05 19:55:16', ''),
(13, 6, 'example_for_db_17.jpg', '2015-03-05 19:55:35', ''),
(14, 6, 'example_for_db_18.jpg', '2015-03-05 19:55:56', ''),
(15, 6, 'hello_1.txt', '2015-03-05 19:58:09', ''),
(16, 6, 'destinationhello_2.txt', '2015-03-06 13:57:58', ''),
(17, 6, '/home/danu_gc4/public_html/uploaded/example_for_db_19.jpg', '2015-03-06 13:58:27', ''),
(19, 6, 'example_for_db_23.jpg', '2015-03-06 15:49:49', ''),
(20, 6, 'example_for_db_31.jpg', '2015-03-12 16:00:51', ''),
(21, 6, 'example_for_db_32.jpg', '2015-03-12 16:02:11', ''),
(22, 11, 'example_for_db_40.jpg', '2015-03-12 16:16:45', ''),
(23, 11, 'example_for_db_42.jpg', '2015-03-12 16:18:16', ''),
(24, 11, 'example_for_db_50.jpg', '2015-03-12 16:29:52', ''),
(25, 6, 'example_for_db_59.jpg', '2015-03-12 19:32:09', ''),
(26, 6, 'example_for_db_60.jpg', '2015-03-12 19:35:55', ''),
(27, 6, 'example_for_db_61.jpg', '2015-03-13 14:13:37', ''),
(28, 6, 'example_for_db_62.jpg', '2015-03-13 14:14:53', ''),
(29, 6, 'example_for_db_63.jpg', '2015-04-09 14:25:08', ''),
(30, 6, 'example_for_db_64.jpg', '2015-04-09 14:27:55', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
 ADD PRIMARY KEY (`id`), ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `file`
--
ALTER TABLE `file`
ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
