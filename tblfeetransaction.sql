-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 19, 2019 at 03:42 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yogis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblfeetransaction`
--

DROP TABLE IF EXISTS `tblfeetransaction`;
CREATE TABLE IF NOT EXISTS `tblfeetransaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(100) NOT NULL,
  `paymentdate` int(11) NOT NULL,
  `forthemonthof` int(11) NOT NULL,
  `amount` float NOT NULL,
  `notificationdate` date NOT NULL COMMENT 'next payment date',
  `isnotified` enum('No','Yes','Na') NOT NULL,
  `note` varchar(8000) NOT NULL,
  `trnid` int(11) NOT NULL,
  `package` int(11) NOT NULL,
  `dancecategory` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
