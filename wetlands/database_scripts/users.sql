-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 11:44 PM
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varbinary(32) NOT NULL DEFAULT '0',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `company` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `job_title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `joined` datetime NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `name`, `company`, `job_title`, `joined`, `access`) VALUES
(6, 'seanin101', 'cb930f6566c4c8c3219c8753de84dfcf2aa15d73605148281a499378ba2f9f71', 0xfb22b8eb4ffec37d0ed1453e064a0f8108d93c18dfb618ac2489d7bed4ab3d59, 's.lydon13@nuigalway.ie', 'Sean Lydon', 'NUIG', 'Student', '1970-01-01 00:00:00', 2),
(8, 'john101', '8d5de1155f78ab50c1673b5de12ab28397e4347ac7d1268112944c35fe240847', 0xd759e24b0501d1515915727827c33c96da2f1645116b629d2ade09bd339c2d1e, 'smith@dell.ie', 'john', 'dell', 'ceo1', '1970-01-01 00:00:00', 3),
(9, 'josh2', '6b4e08b9297611b5c68e3af4c275337d9afb5868c99f054aefe5dcc062f63d55', 0x3667d710292ee2dd3b1c45eb8aa629fc48f1e433a357262f87b9500e07080da7, 'john@dell.com', 'josh', 'it', 'gg', '1970-01-01 00:00:00', 1),
(10, 'mike101', 'd9b0aaf0d26de2659fa50f2d5207e1aed8804437affc8fd19c84c1943bbffa73', 0x66925b6e1ff1f3110ad0691a9eed876dbfd8e07dab6d36199e6d90c986d2c1bb, 'mike@g.com', 'mike', 'it', 'it', '2015-03-31 19:10:43', 1),
(11, 'catgsmith', '9d06ef802bcdf59beec13e4b68617f9c96a71daf897b8ac7d4abf5f7a209230b', 0x4fd91c4c89eb037808a2007fd73f3ea60254daa0bf567f299fc8f6ceaa53d12f, 'catgsmith@gmail.ie', 'Catherine', 'NUIG', 'Student', '2015-03-31 19:13:01', 2),
(12, 'james101', '2d884af1de52153618a11ced3097d4f96d66ecf6312054cae90c1433600b674a', 0x4d8e115c7e54af6904ce45b8cdb445f35c61ea91d75aa18acf71c3a7cace2f92, 'j.smith@hotmail.com', 'James Smith', 'Mayo county council', 'Enviromental scientist', '2015-04-08 14:53:45', 1),
(13, 'michael101', '98a622336957dc469a9b668c7bdc75be6d1a6867548c36f042e3a207c8a985f3', 0x4a87ed154352f9288182929b5080881a29575ed710eb1b25214bb7385bb1f709, 'm.jones@hotmail.com', 'Michael Jones', 'Clare county council', 'Enviromental scientist', '2015-04-08 14:54:30', 1),
(14, 'CSevern1', '348c1548419fc4d37fe96ceb7e28ed239d6de89762551daf82deb5a5cb3e2de7', 0x4e41c42c102a38d0b8ccb8041844f03a2515789524db768879825e5c2844d9e9, 'c.severn1@nuigalway.ie', 'Ciaran Severn', 'companyname', 'jobtitle', '2015-04-09 10:33:36', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD KEY `access` (`access`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`access`) REFERENCES `groups` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
