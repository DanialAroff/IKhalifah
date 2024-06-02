-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2024 at 03:20 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ikhalifah`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

DROP TABLE IF EXISTS `parents`;
CREATE TABLE IF NOT EXISTS `parents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `ic_no` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `relationship` enum('father','mother') DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` enum('boy','girl') DEFAULT NULL,
  `birthcertno` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `is_approved` enum('pending','approved','rejected') DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_parent`
--

DROP TABLE IF EXISTS `student_parent`;
CREATE TABLE IF NOT EXISTS `student_parent` (
  `student_id` int NOT NULL,
  `parent_id` int NOT NULL,
  PRIMARY KEY (`student_id`,`parent_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_code` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_code`, `username`, `email`, `password`, `user_type`, `date_created`) VALUES
(13, '202406-00001', 'Adibah', 'adibah@gmail.com', '$2y$10$IX8Q.Ekx0YnxA..ONp5mr.5GFh3YtFdobTzkz.OufcTMsLKPXvp4K', 'teacher', '2024-06-02 15:54:33'),
(12, '202405-00001', 'danial', 'danial@gmail.com', '$2y$10$koo5yNchU6UGqZH7Ac56MOvKBPu732B8D3v/lIGmQMOheu8beZB4u', 'user', '2024-05-02 11:55:35'),
(14, '202406-00001', 'Admin1', 'admin1@gmail.com', '$2y$10$K92LeprvmxTIjguZbX.kl.tMSX7E9safTfl0RdAip1XpMuf.1GEae', 'admin', '2024-06-02 15:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `users_token`
--

DROP TABLE IF EXISTS `users_token`;
CREATE TABLE IF NOT EXISTS `users_token` (
  `email` int NOT NULL,
  `refresh_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
