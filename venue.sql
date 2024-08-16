-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 14, 2024 at 05:59 PM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `venue`
--

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
CREATE TABLE IF NOT EXISTS `experiences` (
  `experience_id` int(6) NOT NULL AUTO_INCREMENT,
  `experience` varchar(300) DEFAULT NULL,
  `location_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`experience_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`experience_id`, `experience`, `location_id`, `user_id`, `rating`) VALUES
(34, 'yep, good', 25, 4, 5),
(33, 'So Cool', 25, 3, 0),
(32, '', 24, 3, 5),
(31, 'not bad', 24, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(6) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  `rating` float DEFAULT NULL,
  `rating_count` int(6) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location`, `rating`, `rating_count`) VALUES
(25, 'sankt-peterburg', 4.5, 2),
(24, 'ryazan', 4.33333, 3);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(6) NOT NULL AUTO_INCREMENT,
  `photo_dir` varchar(250) NOT NULL,
  `location_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `photo_dir`, `location_id`, `user_id`) VALUES
(68, 'uploads/add/68.PNG', 25, 4),
(67, 'uploads/add/67.jpg', 25, 4),
(66, 'uploads/add/66.jpg', 25, 3),
(65, 'uploads/add/65.jpg', 25, 3),
(64, 'uploads/add/64.jpg', 25, 3),
(63, 'uploads/add/63.jpg', 24, 3),
(62, 'uploads/add/62.jpg', 24, 3),
(61, 'uploads/add/61.jpg', 24, 3),
(60, 'uploads/add/60.jpg', 24, 3),
(59, 'uploads/add/59.jpg', 24, 3),
(58, 'uploads/add/4.jpg', 24, 2),
(57, 'uploads/add/3.jpg', 24, 2),
(56, 'uploads/add/2.jpg', 24, 2),
(55, 'uploads/add/1.jpg', 24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(6) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_photo` varchar(250) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `user_photo`) VALUES
(4, 'Hudayar Tashov', 'thudayar@gmail.com', 'password', 'https://live.staticflickr.com/65535/53921919897_c76eb4b3a9_b.jpg'),
(2, 'Baygus Kukuk', 'bay@gus.com', 'bayguskukuk', 'uploads/pfp/2.jpg'),
(3, 'Bahanba', 'baha@ban.hren', 'ban.hren', 'uploads/pfp/3.jpg'),
(10, 'fwefwef', 'fwefwe@fwefwe.wefwef', 'wefwedwecrwerc', 'https://live.staticflickr.com/65535/53921919897_c76eb4b3a9_b.jpg'),
(9, 'sergerg', 'rgssrg@fefgr.khjk', 'jtyjrtyjrtyj', 'https://live.staticflickr.com/65535/53921919897_c76eb4b3a9_b.jpg'),
(8, 'wefwef', 'wfef@wdefw.com', 'woenofwunefe', 'https://live.staticflickr.com/65535/53921919897_c76eb4b3a9_b.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
