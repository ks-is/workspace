-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2015 at 10:50 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `score`
--

-- --------------------------------------------------------

--
-- Table structure for table `score_board`
--

CREATE TABLE IF NOT EXISTS `score_board` (
  `Name` varchar(30) NOT NULL,
  `HackThis` int(11) NOT NULL,
  `HackThisSite` int(11) NOT NULL,
  `CanYouHackIt` int(11) NOT NULL,
  `OverTheWire` int(11) NOT NULL,
  `Sum` int(11) NOT NULL,
  `Url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `score_board`
--

INSERT INTO `score_board` (`Name`, `HackThis`, `HackThisSite`, `CanYouHackIt`, `OverTheWire`, `Sum`, `Url`) VALUES
('hardwork', 4599, 576, 0, 595, 5770, 'https://www.wechall.net/profile/hardwork'),
('dutule9x', 53, 0, 112, 63, 228, 'https://www.wechall.net/profile/dutule9x'),
('vytartaros', 0, 0, 0, 0, 0, 'https://www.wechall.net/profile/vytartaros'),
('ncthanh1212', 531, 0, 0, 531, 1062, 'https://www.wechall.net/profile/ncthanh1212');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
