-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2020 at 08:42 AM
-- Server version: 10.2.36-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aies2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `type` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idSlide` int(11) NOT NULL,
  `eff` enum('O','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `flash`
--

CREATE TABLE `flash` (
  `id` tinyint(4) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flash`
--

INSERT INTO `flash` (`id`, `content`) VALUES
(1, '\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pas`
--

CREATE TABLE `pas` (
  `ID` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mac` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_id` int(11) NOT NULL,
  `captPres` tinyint(1) NOT NULL DEFAULT 1,
  `captQAir` tinyint(1) NOT NULL DEFAULT 0,
  `captTemp` tinyint(1) NOT NULL DEFAULT 1,
  `captFumee` tinyint(1) NOT NULL DEFAULT 0,
  `temp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CO2` int(11) NOT NULL,
  `COV` int(11) NOT NULL,
  `fumee` int(11) NOT NULL,
  `CtrlTv` enum('cec','ir','rs') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ir',
  `ModeFonc` enum('heure','presence') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'heure',
  `hStart` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hStop` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `presence` enum('O','N') COLLATE utf8mb4_unicode_ci NOT NULL,
  `idleTime` smallint(60) NOT NULL DEFAULT 60,
  `freqIr` float NOT NULL,
  `Pourcentage_SD` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pas`
--

INSERT INTO `pas` (`ID`, `name`, `ip`, `mac`, `version`, `zone_id`, `captPres`, `captQAir`, `captTemp`, `captFumee`, `temp`, `CO2`, `COV`, `fumee`, `CtrlTv`, `ModeFonc`, `hStart`, `hStop`, `presence`, `idleTime`, `freqIr`, `Pourcentage_SD`) VALUES
(2, 'PA_PROFS', '10.73.254.10', 'b8:27:eb:aa:70:09', '2.2', 2, 1, 0, 1, 0, '22.6', 0, 0, 0, 'ir', 'heure', '07:00', '19:00', 'N', 15, 0, 0),
(3, 'PA_TEST', '192.168.1.21', 'b8:27:eb:12:db:13', '3.1', 1, 1, 1, 1, 1, '18.3', 400, 0, 0, 'cec', 'presence', '19:09', '19:08', 'N', 5, 0, 25),
(4, 'PA-FOYER', '10.73.254.20', 'b8:27:eb:e9:17:d9', '2.1', 1, 1, 0, 1, 0, '20.7', 0, 0, 0, 'ir', 'heure', '07:00', '19:00', 'N', 15, 0, 0),
(5, 'PA-SELF', '10.73.254.13', 'b8:27:eb:93:da:8d', '2.2', 1, 1, 0, 1, 0, '21.1', 0, 0, 0, 'ir', 'heure', '07:00', '19:00', 'N', 15, 0, 0),
(6, 'PA-S', '10.73.254.14', 'b8:27:eb:c1:a6:2b', '2.2', 3, 1, 0, 1, 0, '-100.0', 0, 0, 0, 'ir', 'heure', '16:00', '15:55', 'N', 15, 0, 0),
(7, 'PA_AtelierSII', '10.73.254.15', 'b8:27:eb:c3:65:be', '2.3', 4, 1, 0, 1, 0, '24.1', 0, 0, 0, 'rs', 'heure', '07:55', '17:45', 'N', 15, 0, 0),
(8, 'PA_AtelierPRO', '10.73.254.16', 'b8:27:eb:87:ce:cd', '2.3', 4, 1, 0, 1, 0, '24.1', 0, 0, 0, 'ir', 'heure', '16:55', '16:53', 'N', 60, 0, 41);

-- --------------------------------------------------------

--
-- Table structure for table `rpi_update`
--

CREATE TABLE `rpi_update` (
  `id` tinyint(4) NOT NULL,
  `version` varchar(5) NOT NULL,
  `date` varchar(255) NOT NULL,
  `date_create` varchar(255) NOT NULL,
  `path` text NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rpi_update`
--

INSERT INTO `rpi_update` (`id`, `version`, `date`, `date_create`, `path`, `size`) VALUES
(1, '4.0', '202012211446', '202012211446', '/rpi/update/l9Jl7Zt7Ss_4.0.tgz', 2842882);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `zone1` int(11) NOT NULL,
  `zone2` int(11) NOT NULL,
  `zone3` int(11) NOT NULL,
  `zone4` int(11) NOT NULL,
  `zone5` int(11) NOT NULL,
  `Service_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ID`, `name`, `zone1`, `zone2`, `zone3`, `zone4`, `zone5`, `Service_ID`) VALUES
(1, 'Vie Scolaire', 1, 1, 1, 1, 1, 4),
(2, 'Direction', 1, 1, 1, 1, 1, 1),
(3, 'Infirmerie', 1, 1, 1, 1, 1, 2),
(4, 'CVL', 0, 0, 0, 0, 1, 3),
(5, 'DDFPT', 1, 1, 1, 1, 1, 5),
(6, 'gestion', 1, 1, 1, 1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `slidezone`
--

CREATE TABLE `slidezone` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'untilted',
  `path` varchar(255) NOT NULL DEFAULT 'unknow',
  `pathimg` varchar(255) DEFAULT NULL,
  `time` int(11) NOT NULL DEFAULT 6000,
  `zone` tinyint(4) NOT NULL DEFAULT 1,
  `priority` enum('yes','no') NOT NULL DEFAULT 'no',
  `state` enum('arch','diff','actif','') NOT NULL DEFAULT 'arch',
  `date_create` varchar(255) NOT NULL DEFAULT 'unknow',
  `date_start` varchar(255) NOT NULL DEFAULT 'unknow',
  `date_stop` varchar(255) NOT NULL DEFAULT 'unknow',
  `theme` int(11) NOT NULL,
  `creator` varchar(255) NOT NULL DEFAULT 'unknow'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slidezone`
--

INSERT INTO `slidezone` (`id`, `title`, `path`, `pathimg`, `time`, `zone`, `priority`, `state`, `date_create`, `date_start`, `date_stop`, `theme`, `creator`) VALUES
(130, 'ENSEIGNANTS ABSENTS', '/rpi/slide/MTUyODM4NTkyNg1.html', NULL, 12000, 0, 'no', 'actif', '202002101442', '202012261624', '---', 4, 'Administrateur'),
(231, 'Test diapo', '/rpi/slide/MTYwNzUwMTA5Mg33.html', NULL, 10000, 1, 'no', 'arch', '202012101844', '---', '---', 1, 'Administrateur'),
(234, 'essai image texte', '/rpi/slide/MTYwNzc3MDgzMg59.html', '/rpi/slide/images/image.jpeg202012121100', 8000, 1, 'no', 'arch', '202012121100', '---', '---', 2, 'Administrateur'),
(235, 'jeu de dés', '/rpi/slide/MTYwNzc4MDczOA80.html', '/rpi/slide/images/image.jpeg202012121345', 8000, 1, 'no', 'arch', '202012121345', '---', '---', 3, 'Administrateur'),
(236, 'Vidéo', '/rpi/slide/MTYwODU3MzA2OQ55.html', '/rpi/slide/videos/flower-1-.mp4202012211751', 12000, 1, 'no', 'arch', '202012211751', '---', '---', 6, 'Administrateur'),
(237, 'Bienvenue', '/rpi/slide/MTYwODYzODE3MQ59.html', '/rpi/slide/images/image.jpeg202012221156', 8000, 1, 'yes', 'actif', '202012221156', '202012221156', '---', 2, 'Administrateur'),
(238, 'Bienvenue', '/rpi/slide/MTYwODYzODI0MQ27.html', NULL, 3458, 1, 'no', 'actif', '202012221157', '202012221157', '---', 1, 'Administrateur');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'unknow',
  `folder` varchar(255) NOT NULL DEFAULT 'unknow',
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `name`, `folder`, `date`) VALUES
(1, 'Texte', 'MTQ5NTA2MzgwOA', '201705180114'),
(2, 'Texte + Image', 'MTQ5NTA2NDAxMg', '201705180114'),
(3, 'Image', 'MTQ5NTA2NDE0OA', '201705180114'),
(4, 'Absences', 'MTQ5NTA2NDE1OQ', '201705180114'),
(5, 'Menu (à venir)', 'MTQ5NTA2NDE3MA', '201705180114'),
(6, 'Vidéo', 'MTQ5NTA2NDE4Mg', '201705180114');

-- --------------------------------------------------------

--
-- Table structure for table `urgency`
--

CREATE TABLE `urgency` (
  `isOn` int(11) NOT NULL,
  `urgencyid` varchar(62) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `urgency`
--

INSERT INTO `urgency` (`isOn`, `urgencyid`) VALUES
(0, '999999999');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Common_Name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Created_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Common_Name`, `Permission`, `Password`, `Created_Date`) VALUES
(1, 'admin', 'Administrateur', 'admin', '4a0ae6907164e3fa1bddabc83bb1d0115a93b757', '2017-01-26 16:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `ID` int(11) NOT NULL,
  `zones` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idzone` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`ID`, `zones`, `idzone`) VALUES
(0, 'Partout', '0'),
(1, 'Lieux communs', '1'),
(2, 'Salle Professeurs', '2'),
(3, 'Bâtiment S', '3'),
(4, 'Ateliers', '4'),
(5, 'Foyer', '5'),
(6, 'local_dev', '6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `flash`
--
ALTER TABLE `flash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pas`
--
ALTER TABLE `pas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rpi_update`
--
ALTER TABLE `rpi_update`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Service_ID_UNIQUE` (`Service_ID`);

--
-- Indexes for table `slidezone`
--
ALTER TABLE `slidezone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urgency`
--
ALTER TABLE `urgency`
  ADD PRIMARY KEY (`isOn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `idzone` (`idzone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pas`
--
ALTER TABLE `pas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slidezone`
--
ALTER TABLE `slidezone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
