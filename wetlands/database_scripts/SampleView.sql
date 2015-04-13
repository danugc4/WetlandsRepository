-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 11:52 PM
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
-- Structure for view `SampleView`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`mydb1831gc`@`localhost` SQL SECURITY DEFINER VIEW `SampleView` AS select `inlet`.`wetlandID` AS `wetlandID`,`inlet`.`sampleDate` AS `sampleDate`,`inlet`.`dailyFlowRate` AS `dailyFlowRate`,`inlet`.`COD_inlet` AS `COD_inlet`,`outlet`.`COD_outlet` AS `COD_outlet`,`inlet`.`BOD_inlet` AS `BOD_inlet`,`outlet`.`BOD_outlet` AS `BOD_outlet`,`inlet`.`SS_inlet` AS `SS_inlet`,`outlet`.`SS_outlet` AS `SS_outlet`,`inlet`.`pH_inlet` AS `pH_inlet`,`outlet`.`pH_outlet` AS `pH_outlet`,`inlet`.`Oxy_inlet` AS `Oxy_inlet`,`outlet`.`Oxy_outlet` AS `Oxy_outlet`,`inlet`.`Temp_inlet` AS `Temp_inlet`,`outlet`.`Temp_outlet` AS `Temp_outlet`,`inlet`.`N_inlet` AS `N_inlet`,`outlet`.`N_outlet` AS `N_outlet`,`inlet`.`NH4N_inlet` AS `NH4N_inlet`,`outlet`.`NH4N_outlet` AS `NH4N_outlet`,`inlet`.`NO3N_inlet` AS `NO3N_inlet`,`outlet`.`NO3N_outlet` AS `NO3N_outlet`,`inlet`.`TON_inlet` AS `TON_inlet`,`outlet`.`TON_outlet` AS `TON_outlet`,`inlet`.`P_inlet` AS `P_inlet`,`outlet`.`P_outlet` AS `P_outlet`,`inlet`.`PO4P_inlet` AS `PO4P_inlet`,`outlet`.`PO4P_outlet` AS `PO4P_outlet` from (`SampleInletView` `inlet` left join `SampleOutletView` `outlet` on(((`inlet`.`wetlandID` = `outlet`.`wetlandID`) and (`inlet`.`sampleDate` = `outlet`.`sampleDate`)))) union select `outlet`.`wetlandID` AS `wetlandID`,`outlet`.`sampleDate` AS `sampleDate`,`outlet`.`dailyFlowRate` AS `dailyFlowRate`,`inlet`.`COD_inlet` AS `COD_inlet`,`outlet`.`COD_outlet` AS `COD_outlet`,`inlet`.`BOD_inlet` AS `BOD_inlet`,`outlet`.`BOD_outlet` AS `BOD_outlet`,`inlet`.`SS_inlet` AS `SS_inlet`,`outlet`.`SS_outlet` AS `SS_outlet`,`inlet`.`pH_inlet` AS `pH_inlet`,`outlet`.`pH_outlet` AS `pH_outlet`,`inlet`.`Oxy_inlet` AS `Oxy_inlet`,`outlet`.`Oxy_outlet` AS `Oxy_outlet`,`inlet`.`Temp_inlet` AS `Temp_inlet`,`outlet`.`Temp_outlet` AS `Temp_outlet`,`inlet`.`N_inlet` AS `N_inlet`,`outlet`.`N_outlet` AS `N_outlet`,`inlet`.`NH4N_inlet` AS `NH4N_inlet`,`outlet`.`NH4N_outlet` AS `NH4N_outlet`,`inlet`.`NO3N_inlet` AS `NO3N_inlet`,`outlet`.`NO3N_outlet` AS `NO3N_outlet`,`inlet`.`TON_inlet` AS `TON_inlet`,`outlet`.`TON_outlet` AS `TON_outlet`,`inlet`.`P_inlet` AS `P_inlet`,`outlet`.`P_outlet` AS `P_outlet`,`inlet`.`PO4P_inlet` AS `PO4P_inlet`,`outlet`.`PO4P_outlet` AS `PO4P_outlet` from (`SampleOutletView` `outlet` left join `SampleInletView` `inlet` on(((`inlet`.`wetlandID` = `outlet`.`wetlandID`) and (`inlet`.`sampleDate` = `outlet`.`sampleDate`))));

--
-- VIEW  `SampleView`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
