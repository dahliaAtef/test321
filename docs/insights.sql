-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2016 at 05:02 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_insights`
--

-- --------------------------------------------------------

--
-- Table structure for table `insights`
--

CREATE TABLE `insights` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `followers` int(10) DEFAULT NULL,
  `follows` int(10) DEFAULT NULL,
  `number_of_posted_media` int(10) DEFAULT NULL,
  `total_likes` int(10) DEFAULT NULL,
  `total_comments` int(10) DEFAULT NULL,
  `engagement_rate` float DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `insights`
--

INSERT INTO `insights` (`id`, `model_id`, `followers`, `follows`, `number_of_posted_media`, `total_likes`, `total_comments`, `engagement_rate`, `created`, `updated`) VALUES
(114, 60, 160, 405, 10, 9, 2, NULL, '2016-02-16 13:06:39', '0000-00-00 00:00:00'),
(115, 60, 162, 422, 11, 10, 2, NULL, '2016-02-17 16:46:36', '2016-02-17 16:46:34'),
(116, 61, NULL, NULL, NULL, 1, 0, 0.62, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(117, 62, NULL, NULL, NULL, 1, 1, NULL, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(118, 63, NULL, NULL, NULL, 0, 0, NULL, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(119, 64, NULL, NULL, NULL, 0, 0, NULL, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(120, 65, NULL, NULL, NULL, 0, 0, NULL, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(121, 66, NULL, NULL, NULL, 0, 0, NULL, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(122, 67, NULL, NULL, NULL, 0, 0, NULL, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(123, 68, NULL, NULL, NULL, 0, 0, NULL, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(124, 69, NULL, NULL, NULL, 3, 1, NULL, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(125, 70, NULL, NULL, NULL, 1, 0, NULL, '2016-02-17 16:46:35', '2016-02-17 16:46:35'),
(126, 71, NULL, NULL, NULL, 4, 0, NULL, '2016-02-17 16:46:36', '2016-02-17 16:46:36'),
(131, 60, 162, 424, 11, 11, 2, NULL, '2016-02-18 12:47:19', '2016-02-18 12:47:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `insights`
--
ALTER TABLE `insights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ModelInsights` (`model_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `insights`
--
ALTER TABLE `insights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `insights`
--
ALTER TABLE `insights`
  ADD CONSTRAINT `fk_ModelInsights` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
