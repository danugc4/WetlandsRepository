-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2015 at 11:51 PM
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
-- Structure for view `SampleInletView`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`mydb1831gc`@`localhost` SQL SECURITY DEFINER VIEW `SampleInletView` AS select `w`.`wetlandID` AS `wetlandID`,`w`.`sampleDate` AS `sampleDate`,`w`.`dailyFlowRate` AS `dailyFlowRate`,(case `inlet`.`qCOD` when 0 then concat('<',format(`inlet`.`COD`,2)) when 1 then concat('>',format(`inlet`.`COD`,2)) else concat('',format(`inlet`.`COD`,2)) end) AS `COD_inlet`,(case `inlet`.`qBod` when 0 then concat('<',format(`inlet`.`BOD`,2)) when 1 then concat('>',format(`inlet`.`BOD`,2)) else concat('',format(`inlet`.`BOD`,2)) end) AS `BOD_inlet`,(case `inlet`.`qSuspSolids` when 0 then concat('<',format(`inlet`.`suspSolids`,2)) when 1 then concat('>',format(`inlet`.`suspSolids`,2)) else concat('',format(`inlet`.`suspSolids`,2)) end) AS `SS_inlet`,(case `inlet`.`qPH` when 0 then concat('<',format(`inlet`.`pH`,2)) when 1 then concat('>',format(`inlet`.`pH`,2)) else concat('',format(`inlet`.`pH`,2)) end) AS `pH_inlet`,(case `inlet`.`qDissolvedOxy` when 0 then concat('<',format(`inlet`.`dissolvedOxy`,2)) when 1 then concat('>',format(`inlet`.`dissolvedOxy`,2)) else concat('',format(`inlet`.`dissolvedOxy`,2)) end) AS `Oxy_inlet`,(case `inlet`.`qTemp` when 0 then concat('<',format(`inlet`.`temp`,2)) when 1 then concat('>',format(`inlet`.`temp`,2)) else concat('',format(`inlet`.`temp`,2)) end) AS `Temp_inlet`,(case `inlet`.`qNitrogren` when 0 then concat('<',format(`inlet`.`nitrogren`,2)) when 1 then concat('>',format(`inlet`.`nitrogren`,2)) else concat('',format(`inlet`.`nitrogren`,2)) end) AS `N_inlet`,(case `inlet`.`qNH4N` when 0 then concat('<',format(`inlet`.`NH4N`,2)) when 1 then concat('>',format(`inlet`.`NH4N`,2)) else concat('',format(`inlet`.`NH4N`,2)) end) AS `NH4N_inlet`,(case `inlet`.`qNO3N` when 0 then concat('<',format(`inlet`.`NO3N`,2)) when 1 then concat('>',format(`inlet`.`NO3N`,2)) else concat('',format(`inlet`.`NO3N`,2)) end) AS `NO3N_inlet`,(case `inlet`.`qTON` when 0 then concat('<',format(`inlet`.`TON`,2)) when 1 then concat('>',format(`inlet`.`TON`,2)) else concat('',format(`inlet`.`TON`,2)) end) AS `TON_inlet`,(case `inlet`.`qPhosphorous` when 0 then concat('<',format(`inlet`.`phosphorous`,2)) when 1 then concat('>',format(`inlet`.`phosphorous`,2)) else concat('',format(`inlet`.`phosphorous`,2)) end) AS `P_inlet`,(case `inlet`.`qPO4P` when 0 then concat('<',format(`inlet`.`PO4P`,2)) when 1 then concat('>',format(`inlet`.`PO4P`,2)) else concat('',format(`inlet`.`PO4P`,2)) end) AS `PO4P_inlet` from (`SampleData` `inlet` left join `WetlandSample` `w` on((`w`.`id` = `inlet`.`sampleID`))) where (`inlet`.`samplePoint` = 'I');

--
-- VIEW  `SampleInletView`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
