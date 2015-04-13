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
-- Structure for view `SampleOutletView`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`mydb1831gc`@`localhost` SQL SECURITY DEFINER VIEW `SampleOutletView` AS select `w`.`wetlandID` AS `wetlandID`,`w`.`sampleDate` AS `sampleDate`,`w`.`dailyFlowRate` AS `dailyFlowRate`,(case `outlet`.`qCOD` when 0 then concat('<',format(`outlet`.`COD`,2)) when 1 then concat('>',format(`outlet`.`COD`,2)) else concat('',format(`outlet`.`COD`,2)) end) AS `COD_outlet`,(case `outlet`.`qBod` when 0 then concat('<',format(`outlet`.`BOD`,2)) when 1 then concat('>',format(`outlet`.`BOD`,2)) else concat('',format(`outlet`.`BOD`,2)) end) AS `BOD_outlet`,(case `outlet`.`qSuspSolids` when 0 then concat('<',format(`outlet`.`suspSolids`,2)) when 1 then concat('>',format(`outlet`.`suspSolids`,2)) else concat('',format(`outlet`.`suspSolids`,2)) end) AS `SS_outlet`,(case `outlet`.`qPH` when 0 then concat('<',format(`outlet`.`pH`,2)) when 1 then concat('>',format(`outlet`.`pH`,2)) else concat('',format(`outlet`.`pH`,2)) end) AS `pH_outlet`,(case `outlet`.`qDissolvedOxy` when 0 then concat('<',format(`outlet`.`dissolvedOxy`,2)) when 1 then concat('>',format(`outlet`.`dissolvedOxy`,2)) else concat('',format(`outlet`.`dissolvedOxy`,2)) end) AS `Oxy_outlet`,(case `outlet`.`qTemp` when 0 then concat('<',format(`outlet`.`temp`,2)) when 1 then concat('>',format(`outlet`.`temp`,2)) else concat('',format(`outlet`.`temp`,2)) end) AS `Temp_outlet`,(case `outlet`.`qNitrogren` when 0 then concat('<',format(`outlet`.`nitrogren`,2)) when 1 then concat('>',format(`outlet`.`nitrogren`,2)) else concat('',format(`outlet`.`nitrogren`,2)) end) AS `N_outlet`,(case `outlet`.`qNH4N` when 0 then concat('<',format(`outlet`.`NH4N`,2)) when 1 then concat('>',format(`outlet`.`NH4N`,2)) else concat('',format(`outlet`.`NH4N`,2)) end) AS `NH4N_outlet`,(case `outlet`.`qNO3N` when 0 then concat('<',format(`outlet`.`NO3N`,2)) when 1 then concat('>',format(`outlet`.`NO3N`,2)) else concat('',format(`outlet`.`NO3N`,2)) end) AS `NO3N_outlet`,(case `outlet`.`qTON` when 0 then concat('<',format(`outlet`.`TON`,2)) when 1 then concat('>',format(`outlet`.`TON`,2)) else concat('',format(`outlet`.`TON`,2)) end) AS `TON_outlet`,(case `outlet`.`qPhosphorous` when 0 then concat('<',format(`outlet`.`phosphorous`,2)) when 1 then concat('>',format(`outlet`.`phosphorous`,2)) else concat('',format(`outlet`.`phosphorous`,2)) end) AS `P_outlet`,(case `outlet`.`qPO4P` when 0 then concat('<',format(`outlet`.`PO4P`,2)) when 1 then concat('>',format(`outlet`.`PO4P`,2)) else concat('',format(`outlet`.`PO4P`,2)) end) AS `PO4P_outlet` from (`SampleData` `outlet` left join `WetlandSample` `w` on((`w`.`id` = `outlet`.`sampleID`))) where (`outlet`.`samplePoint` = 'O');

--
-- VIEW  `SampleOutletView`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
