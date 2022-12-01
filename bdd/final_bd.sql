-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 04, 2020 at 03:59 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `catID` int(11) NOT NULL AUTO_INCREMENT,
  `nomCat` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`catID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`catID`, `nomCat`) VALUES
(1, 'animal'),
(2, 'home'),
(3, 'family'),
(4, 'health'),
(5, 'nature'),
(6, 'landscape');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `photoId` int(11) NOT NULL AUTO_INCREMENT,
  `nomFich` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `catID` int(11) DEFAULT NULL,
  `uploaderID` int(11) DEFAULT NULL,
  `isPublic` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`photoId`),
  KEY `catID` (`catID`),
  KEY `uploaderID` (`uploaderID`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`photoId`, `nomFich`, `description`, `catID`, `uploaderID`, `isPublic`) VALUES
(1, 'photo1.jfif', 'la 1ere photo cat 2', 5, 1, 1),
(2, 'photo2.jfif', 'la 2eme photo cat 2', 6, 2, 1),
(3, 'photo3.jfif', 'la 3eme photo cat 3 u3', 2, 2, 1),
(4, 'photo4.jfif', 'la 4eme photo cat 4 u3', 2, 2, 1),
(5, 'ima.jpg', 'la 5eme photo cat 4 u2', 3, 2, 1),
(6, 'PhotographingTwilight_TannerWendellStewart-218136823-1500x1000.jpg', ' Une montagne de glace', 6, 1, 1),
(7, 'download.jpg', ' un lac dans une forÃªt isolÃ©', 6, 1, 1),
(8, 'pexels-photo-414171.jpeg', ' un landscape trÃ¨s beau', 6, 3, 1),
(9, 'stock-photo-142984111.jpg', ' Un animal sauvage', 1, 3, 1),
(10, 'slide_the.jpg', ' Un champs formidable', 5, 3, 1),
(11, 'download (1).jpg', ' Un abre isolÃ©', 5, 4, 1),
(12, 'road-1072823__340.jpg', ' Des arbres encore une fois', 5, 4, 1),
(13, 'health-wellness.jpg', ' Health wellness', 4, 4, 1),
(14, 'download (2).jpg', ' Encore sante', 4, 4, 1),
(17, 'unnamed_family.jpg', ' Une famille heureuse', 3, 3, 1),
(18, 'big-happy-harmonious-family-portrait-with-grandparents-two-young-couples-little-children-cartoon-vector-illustration_1284-17895.jpg', ' big happy harmonious family', 3, 3, 1),
(20, 'photo-1556955112-28cde3817b0a.jpg', 'vida loca dans ma villa', 2, 4, 1),
(21, 'pexels-photo-186077.jpeg', ' home sweet home', 2, 4, 1),
(23, 'download (3).jpg', ' Un panda ou koala', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isadmin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`uID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uID`, `username`, `password`, `isadmin`) VALUES
(1, 'admin', 'admin', 1),
(2, 'user1', 'user1', 0),
(3, 'alice12', 'alice12', 0),
(4, 'tiago17', 'tiago17', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
