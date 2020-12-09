-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 02:34 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `idParticipants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`idParticipants`) VALUES
(82);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `idEvents` int(11) NOT NULL,
  `idOrganizer` int(11) NOT NULL,
  `eventName` varchar(255) NOT NULL,
  `eventCity` varchar(255) NOT NULL,
  `eventDescription` mediumtext NOT NULL,
  `eventStart` date NOT NULL,
  `eventEnd` date NOT NULL,
  `eventState` varchar(45) NOT NULL,
  `eventURL` varchar(100) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`idEvents`, `idOrganizer`, `eventName`, `eventCity`, `eventDescription`, `eventStart`, `eventEnd`, `eventState`, `eventURL`, `approved`) VALUES
(4, 0, 'Pompeii: The Immortal City', 'Orlando', 'Orlando Science Center exhibit of Pompeii', '2020-10-26', '2021-01-24', 'Florida', 'https://www.osc.org/pompeii/', 0),
(7, 0, 'Seaworlds Christmas Celebration', 'Orlando', 'Seaworld Christmas Event', '2020-11-14', '2020-12-31', 'Florida', 'https://seaworld.com/orlando/events/christmas-celebration/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `eventsparticipated`
--

CREATE TABLE `eventsparticipated` (
  `idEvents` int(11) NOT NULL,
  `idParticipants` int(11) NOT NULL,
  `idEventsParticipants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `idParticipants` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `eventsParticipated` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`idParticipants`, `username`, `password`, `eventsParticipated`) VALUES
(82, 'testadmin', '9283a03246ef2dacdc21a9b137817ec1', NULL),
(211, 'testusername', '473379a601ad81d17e7584754d90140c', NULL),
(334, 'Logan', '5f4dcc3b5aa765d61d8327deb882cf99', NULL),
(433, 'testinguserinput', '536b63309d1f8c6c7a360f4a9ad30a46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`username`, `password`) VALUES
('adminusername', 'e3274be5c857fb42ab72d786e281b4b8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`idParticipants`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`idEvents`),
  ADD UNIQUE KEY `eventName_UNIQUE` (`eventName`),
  ADD UNIQUE KEY `idEvents_UNIQUE` (`idEvents`),
  ADD UNIQUE KEY `eventURL` (`eventURL`);

--
-- Indexes for table `eventsparticipated`
--
ALTER TABLE `eventsparticipated`
  ADD PRIMARY KEY (`idEventsParticipants`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`idParticipants`),
  ADD UNIQUE KEY `idParticipants_UNIQUE` (`idParticipants`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`username`,`password`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `password_UNIQUE` (`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `idEvents` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `eventsparticipated`
--
ALTER TABLE `eventsparticipated`
  MODIFY `idEventsParticipants` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `idParticipants` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `fk_adminid` FOREIGN KEY (`idParticipants`) REFERENCES `participants` (`idParticipants`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
