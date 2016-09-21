-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2015 at 08:25 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gawad`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Asterisk', '1', 1424278268);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1424278227, 1424278227),
('Asterisk', 1, 'Full Access', NULL, NULL, 1424278062, 1424279109);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Asterisk', '/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `base_content`
--

CREATE TABLE IF NOT EXISTS `base_content` (
`id` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `brief` tinytext NOT NULL,
  `description` text NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_content`
--

INSERT INTO `base_content` (`id`, `type`, `title`, `slug`, `brief`, `description`, `body`, `date`, `end_date`, `sort`, `hits`, `status`, `created`, `updated`) VALUES
(2, 1, 'Home Slider', 'home-slider', '', '', '', NULL, NULL, 1, 0, NULL, '2015-09-08 15:51:41', '2015-09-08 15:51:41'),
(5, 1, 'CEO', 'ceo', 'Saleh Nojara', 'Graphic designer', '<p>Hello there ! I&rsquo;m a web art director based in Lyon (France) and currently looking for work opportunities. I worked at Uzik, a French awarded digital agency, from 2011 to 2013. Then my experience brought me to Le Site, one of the largest e-commerce agency in Canada, during more than&nbsp;<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; one year. I won 3 Awwwards and 3 FWA among many other recognitions.<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; When I&#39;m not working, I spend most of my free time sharing my love for art with others on my blog: Art-Spire.com. The rest of my spare time is divided between tech blogs reading, video games, American TV shows, photography and occasional sleep.<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; and currently looking for work opportunities. I worked at Uzik, a French awarded digital agency, from 2011 to 2013. Then my experience brought me to Le Site, one of the argest e-commerce agency in Canada, during more than one year. I won 3 Awwwards and 3 FWA among many other recognitions.</p>\r\n', NULL, NULL, 4, 0, NULL, '2015-09-17 10:23:50', '2015-09-29 09:21:36'),
(6, 2, '2014', '2014', '', '', '', NULL, NULL, 1, 0, NULL, '2015-09-17 10:45:32', '2015-09-17 10:45:32'),
(7, 3, 'cairo', 'cairo', '', '', '<p>Showroom :&nbsp;El salab.</p><p>Address: 14 el mosawah st, from mohamed mazhar</p><p>telephone : +2 20 240 40 278</p><p>&nbsp;</p><p>Showroom :&nbsp;El salab.</p><p>Address: 14 el mosawah st, from mohamed mazhar</p><p>telephone : +2 20 240 40 278</p><p>&nbsp;</p><p>&nbsp;</p>', NULL, NULL, 1, 0, NULL, '2015-09-17 10:49:21', '2015-09-17 10:49:21'),
(8, 4, 'certificate 1', 'certificate-1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', NULL, NULL, 1, 0, NULL, '2015-09-17 10:54:20', '2015-09-17 11:03:21'),
(9, 1, 'About Us', 'about-us', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', NULL, NULL, 5, 0, NULL, '2015-09-17 11:04:41', '2015-09-17 11:04:41'),
(10, 1, 'Contact Us', 'contact-us', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus voluptates sint maiores a doloribus debitis, error repudiandae molestiae eligendi dignissimos id explicabo quo, eveniet accusamus autem commodi iusto voluptatum similique.</p>\r\n', NULL, NULL, 6, 0, NULL, '2015-09-17 11:05:38', '2015-09-17 11:05:38'),
(11, 2, '2015', '2015', '2015', '', '<p>2015</p>\r\n', NULL, NULL, 2, 0, NULL, '2015-09-17 15:15:03', '2015-09-17 15:15:03'),
(12, 3, 'Alexandria', 'alexandria', '', '', '<p>Showroom :&nbsp;El salab.</p>\r\n\r\n<p>Address: 14 el mosawah st, from mohamed mazhar</p>\r\n\r\n<p>telephone : +2 20 240 40 278</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Showroom :&nbsp;El salab.</p>\r\n\r\n<p>Address: 14 el mosawah st, from mohamed mazhar</p>\r\n\r\n<p>telephone : +2 20 240 40 278</p>\r\n', NULL, NULL, 2, 0, NULL, '2015-09-28 15:22:31', '2015-09-28 15:22:31'),
(13, 3, 'El Mansoura', 'el-mansoura', '', '', '<p>Showroom :&nbsp;El salab.</p>\r\n\r\n<p>Address: 14 el mosawah st, from mohamed mazhar</p>\r\n\r\n<p>telephone : +2 20 240 40 278</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Showroom :&nbsp;El salab.</p>\r\n\r\n<p>Address: 14 el mosawah st, from mohamed mazhar</p>\r\n\r\n<p>telephone : +2 20 240 40 278</p>\r\n', NULL, NULL, 3, 0, NULL, '2015-09-28 15:23:36', '2015-09-28 15:23:36'),
(14, 3, 'Tanta', 'tanta', '', '', '<p>Showroom :&nbsp;El salab.</p>\r\n\r\n<p>Address: 14 el mosawah st, from mohamed mazhar</p>\r\n\r\n<p>telephone : +2 20 240 40 278</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Showroom :&nbsp;El salab.</p>\r\n\r\n<p>Address: 14 el mosawah st, from mohamed mazhar</p>\r\n\r\n<p>telephone : +2 20 240 40 278</p>\r\n', NULL, NULL, 4, 0, NULL, '2015-09-28 15:33:32', '2015-09-28 15:33:32'),
(15, 3, 'Souhag', 'souhag', '', '', '<p>Showroom :&nbsp;El salab.</p>\r\n\r\n<p>Address: 14 el mosawah st, from mohamed mazhar</p>\r\n\r\n<p>telephone : +2 20 240 40 278</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Showroom :&nbsp;El salab.</p>\r\n\r\n<p>Address: 14 el mosawah st, from mohamed mazhar</p>\r\n\r\n<p>telephone : +2 20 240 40 278</p>\r\n', NULL, NULL, 5, 0, NULL, '2015-09-28 15:34:01', '2015-09-28 15:34:01'),
(16, 4, 'certificate 2', 'certificate-2', '', '', '', NULL, NULL, 2, 0, NULL, '2015-09-29 10:29:54', '2015-09-29 10:29:54'),
(17, 4, 'certificate 3', 'certificate-3', '', '', '', NULL, NULL, 3, 0, NULL, '2015-09-29 10:30:28', '2015-09-29 10:30:28'),
(18, 1, 'Customer Service', 'customer-service', '', '', '<p>Hello there ! I&rsquo;m a web art director based in Lyon (France) and currently looking for work opportunities. I worked at Uzik, a French awarded digital agency, from 2011 to 2013. Then my experience brought me to Le Site, one of the largest e-commerce agency in Canada, during more than&nbsp;<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; one year. I won 3 Awwwards and 3 FWA among many other recognitions.<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; When I&#39;m not working, I spend most of my free time sharing my love for art with others on my blog: Art-Spire.com. The rest of my spare time is divided between tech blogs reading, video games, American TV shows, photography and occasional sleep.<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; and currently looking for work opportunities. I worked at Uzik, a French awarded digital agency, from 2011 to 2013. Then my experience brought me to Le Site, one of the argest e-commerce agency in Canada, during more than one year. I won 3 Awwwards and 3 FWA among many other recognitions.</p>\r\n', NULL, NULL, 7, 0, NULL, '2015-09-29 11:05:05', '2015-09-29 11:05:05'),
(19, 2, '2016', '2016', '', '', '', NULL, NULL, 3, 0, NULL, '2015-09-29 14:04:27', '2015-09-29 14:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `base_media`
--

CREATE TABLE IF NOT EXISTS `base_media` (
`id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `path` varchar(255) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `mime` varchar(128) NOT NULL,
  `size` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `embed` text NOT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_media`
--

INSERT INTO `base_media` (`id`, `model_id`, `model`, `path`, `filename`, `mime`, `size`, `title`, `description`, `link`, `embed`, `status`, `type`, `sort`, `created`, `updated`) VALUES
(13, 8, 'Certificate', '/shared/uploads/2015/09/29/', '_8LDjBDdl9BL0OBm.png', 'image/png', 104698, '', '', '', '', NULL, NULL, 13, '2015-09-29 10:34:28', '2015-09-29 10:34:28'),
(14, 16, 'Certificate', '/shared/uploads/2015/09/29/', 'SMybBtc2fxh47XXO.png', 'image/png', 129061, '', '', '', '', NULL, NULL, 14, '2015-09-29 10:34:48', '2015-09-29 10:34:48'),
(15, 17, 'Certificate', '/shared/uploads/2015/09/29/', 'Pyji2_ZPEz9UlGPL.png', 'image/png', 120920, '', '', '', '', NULL, NULL, 15, '2015-09-29 10:35:06', '2015-09-29 10:35:06'),
(16, 6, 'Catalogue', '/shared/uploads/2015/09/29/', 'HuCQErkElFu8ouGL', 'application/pdf', 413252, '', '', '', '', NULL, NULL, 16, '2015-09-29 12:37:24', '2015-09-29 12:37:24'),
(17, 11, 'Catalogue', '/shared/uploads/2015/09/29/', 'ZvCicKAfR0ah7lED', 'application/pdf', 413252, '', '', '', '', NULL, NULL, 17, '2015-09-29 12:38:57', '2015-09-29 12:38:57'),
(19, 6, 'Catalogue', '/shared/uploads/2015/09/29/', 'HYgYdPJ8UFzpgpTe.png', 'image/png', 104698, '', '', '', '', NULL, NULL, 19, '2015-09-29 13:29:09', '2015-09-29 13:29:09'),
(20, 11, 'Catalogue', '/shared/uploads/2015/09/29/', '3LjUCY-Wvnl35Nj3.png', 'image/png', 120920, '', '', '', '', NULL, NULL, 20, '2015-09-29 13:29:28', '2015-09-29 13:29:28'),
(21, 19, 'Catalogue', '/shared/uploads/2015/09/29/', 'fZcH9XSKC2lmohNb.png', 'image/png', 1926687, '', '', '', '', NULL, NULL, 21, '2015-09-29 14:05:17', '2015-09-29 14:05:17'),
(22, 19, 'Catalogue', '/shared/uploads/2015/09/29/', 'ukuyFEH8TBii2bqm', 'application/pdf', 413252, '', '', '', '', NULL, NULL, 22, '2015-09-29 14:05:18', '2015-09-29 14:05:18'),
(23, 5, 'Page', '/shared/uploads/2015/09/29/', '-LpWnI6OE2O9MqBQ.png', 'image/png', 4301, '', '', '', '', NULL, NULL, 23, '2015-09-29 15:31:16', '2015-09-29 15:31:16'),
(24, 18, 'Page', '/shared/uploads/2015/09/29/', 'VY61DnyVnlv508jr.png', 'image/png', 197731, '', '', '', '', NULL, NULL, 24, '2015-09-29 15:36:54', '2015-09-29 15:36:54'),
(25, 9, 'Page', '/shared/uploads/2015/09/29/', 'AqfVUhwJJXOt_pXA.png', 'image/png', 197731, '', '', '', '', NULL, NULL, 25, '2015-09-29 15:37:12', '2015-09-29 15:37:12'),
(26, 5, 'Category', '/shared/uploads/2015/09/30/', 'Zs_KUVoggb440TQF.png', 'image/png', 1926687, '', '', '', '', NULL, NULL, 26, '2015-09-30 14:33:53', '2015-09-30 14:33:53'),
(27, 4, 'Category', '/shared/uploads/2015/09/30/', 'haxu1--Ni_qT7EB2.png', 'image/png', 1926687, '', '', '', '', NULL, NULL, 27, '2015-09-30 14:34:17', '2015-09-30 14:34:17'),
(28, 7, 'Category', '/shared/uploads/2015/09/30/', 'sQ4hj3QtFQkiPVAb.png', 'image/png', 104698, '', '', '', '', NULL, NULL, 28, '2015-09-30 14:40:21', '2015-09-30 14:40:21'),
(29, 11, 'Category', '/shared/uploads/2015/09/30/', 'OI9D7sZbYAKx6pT9.png', 'image/png', 129061, '', '', '', '', NULL, NULL, 29, '2015-09-30 14:42:16', '2015-09-30 14:42:16'),
(30, 12, 'Category', '/shared/uploads/2015/09/30/', 'T2I05vXcEBsGZLEw.png', 'image/png', 120920, '', '', '', '', NULL, NULL, 30, '2015-09-30 14:42:39', '2015-09-30 14:42:39'),
(31, 6, 'Category', '/shared/uploads/2015/09/30/', 'na1MCuVFwFIeWTyH.png', 'image/png', 104698, '', '', '', '', NULL, NULL, 31, '2015-09-30 14:43:07', '2015-09-30 14:43:07'),
(32, 8, 'Category', '/shared/uploads/2015/09/30/', 'AihaVsEHTVf-YQht.png', 'image/png', 129061, '', '', '', '', NULL, NULL, 32, '2015-09-30 14:43:32', '2015-09-30 14:43:32'),
(33, 9, 'Category', '/shared/uploads/2015/09/30/', 'iuTJXzH1cLBKU4vp.png', 'image/png', 120920, '', '', '', '', NULL, NULL, 33, '2015-09-30 14:43:58', '2015-09-30 14:43:58'),
(34, 16, 'Category', '/shared/uploads/2015/09/30/', 'x8hujFZO94fGB_Ha.png', 'image/png', 129061, '', '', '', '', NULL, NULL, 34, '2015-09-30 14:44:28', '2015-09-30 14:44:28'),
(35, 1, 'Product', '/shared/uploads/2015/09/30/', 'yVeVT_4Kg_Pn-nLp.png', 'image/png', 1926687, '', '', '', '', NULL, NULL, 35, '2015-09-30 14:46:19', '2015-09-30 14:46:19'),
(36, 2, 'Product', '/shared/uploads/2015/09/30/', 'Fy2H-jHHEuhSAekk.png', 'image/png', 104698, '', '', '', '', NULL, NULL, 36, '2015-09-30 14:46:34', '2015-09-30 14:46:34'),
(37, 3, 'Product', '/shared/uploads/2015/09/30/', 'XTX1AaYUMlxtV2Vi.png', 'image/png', 129061, '', '', '', '', NULL, NULL, 37, '2015-09-30 14:46:52', '2015-09-30 14:46:52'),
(38, 4, 'Product', '/shared/uploads/2015/09/30/', 'JFp9iNBpvx-jpwLE.png', 'image/png', 115141, '', '', '', '', NULL, NULL, 38, '2015-09-30 14:47:14', '2015-09-30 14:47:14'),
(39, 5, 'Product', '/shared/uploads/2015/09/30/', 'yPTx9TyvD8u3QQB1.png', 'image/png', 120920, '', '', '', '', NULL, NULL, 39, '2015-09-30 14:47:32', '2015-09-30 14:47:32'),
(40, 6, 'Product', '/shared/uploads/2015/09/30/', '3DqHcNrOG8yi-Y_J.png', 'image/png', 101840, '', '', '', '', NULL, NULL, 40, '2015-09-30 14:47:49', '2015-09-30 14:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `base_messages`
--

CREATE TABLE IF NOT EXISTS `base_messages` (
`id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `sender_id` int(10) unsigned DEFAULT NULL,
  `receiver_id` int(10) unsigned DEFAULT NULL,
  `model_id` int(10) unsigned DEFAULT NULL,
  `model` varchar(64) NOT NULL,
  `type` tinyint(3) unsigned DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `base_settings`
--

CREATE TABLE IF NOT EXISTS `base_settings` (
`id` int(10) unsigned NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `base_tree`
--

CREATE TABLE IF NOT EXISTS `base_tree` (
`id` int(10) unsigned NOT NULL COMMENT 'Unique tree node identifier',
  `root` int(10) unsigned DEFAULT NULL COMMENT 'Tree root identifier',
  `lft` int(11) NOT NULL COMMENT 'Nested set left property',
  `rgt` int(11) NOT NULL COMMENT 'Nested set right property',
  `lvl` smallint(6) NOT NULL COMMENT 'Nested set level / depth',
  `name` varchar(255) NOT NULL COMMENT 'The tree node name / label',
  `slug` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT 'The icon to use for the node',
  `icon_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Icon Type: 1 = CSS Class, 2 = Raw Markup',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is active (will be set to false on deletion)',
  `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is selected/checked by default',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is enabled',
  `readonly` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is read only (unlike disabled - will allow toolbar actions)',
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is visible',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is collapsed by default',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position up',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position down',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the left (from sibling to parent)',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the right (from sibling to child)',
  `removable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable (any children below will be moved as siblings before deletion)',
  `removable_all` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable along with descendants',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_tree`
--

INSERT INTO `base_tree` (`id`, `root`, `lft`, `rgt`, `lvl`, `name`, `slug`, `link`, `description`, `icon`, `icon_type`, `active`, `selected`, `disabled`, `readonly`, `visible`, `collapsed`, `movable_u`, `movable_d`, `movable_l`, `movable_r`, `removable`, `removable_all`, `created`, `updated`) VALUES
(1, 1, 1, 2, 0, 'Menu', 'menu', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 11:22:17', '2015-09-16 11:22:17'),
(2, 2, 1, 2, 0, 'Cities', 'cities', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 11:22:41', '2015-09-16 11:22:41'),
(3, 3, 1, 30, 0, 'Categories', 'categories', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 11:23:02', '2015-09-16 11:23:02'),
(4, 3, 10, 17, 1, 'Kitchen', 'kitchen', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 11:24:16', '2015-09-28 09:48:59'),
(5, 3, 2, 9, 1, 'Bathroom', 'bathroom', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 11:24:46', '2015-09-16 11:24:46'),
(6, 3, 11, 12, 2, 'Kitchen Child', 'kitchen-child', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 11:25:20', '2015-09-16 11:25:20'),
(7, 3, 3, 4, 2, 'Bathroom Child', 'bathroom-child', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 11:25:45', '2015-09-16 11:25:45'),
(8, 3, 13, 14, 2, 'Kitchen Child x', 'kitchen-child-x', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 15:41:25', '2015-09-16 15:41:25'),
(9, 3, 15, 16, 2, 'Kitchen Child y', 'kitchen-child-y', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 15:41:47', '2015-09-28 10:50:09'),
(11, 3, 5, 6, 2, 'Bathroom Child x', 'bathroom-child-x', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 15:42:45', '2015-09-16 15:42:45'),
(12, 3, 7, 8, 2, 'Bathroom Child y', 'bathroom-child-y', '', '', '', 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-16 15:46:08', '2015-09-16 15:46:08'),
(13, 3, 18, 21, 1, 'Livingroom', 'livingroom', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-22 10:02:19', '2015-09-22 10:02:19'),
(14, 3, 22, 25, 1, 'Garden', 'garden', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-22 11:10:10', '2015-09-22 11:10:10'),
(15, 3, 26, 29, 1, 'Garage', 'garden-2', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-22 11:12:14', '2015-09-22 11:12:32'),
(16, 3, 19, 20, 2, 'Livingroom Child', 'livingroom-child', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-28 10:45:28', '2015-09-28 10:45:28'),
(17, 3, 23, 24, 2, 'Garden Child', 'garden-child', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-28 10:45:58', '2015-09-28 10:45:58'),
(18, 3, 27, 28, 2, 'Garage Child', 'garage-child', '', '', NULL, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, '2015-09-28 10:46:29', '2015-09-28 10:46:29');

-- --------------------------------------------------------

--
-- Table structure for table `base_user`
--

CREATE TABLE IF NOT EXISTS `base_user` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` char(123) NOT NULL,
  `token` char(123) DEFAULT NULL,
  `token_type` tinyint(3) unsigned DEFAULT NULL,
  `auth_key` char(123) DEFAULT NULL,
  `sso_key` char(123) DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `base_user`
--

INSERT INTO `base_user` (`id`, `username`, `email`, `password`, `token`, `token_type`, `auth_key`, `sso_key`, `status`, `last_login`, `created`, `updated`) VALUES
(1, 'sharaf', 'a.sharaf@digitreeinc.com', '$2y$13$kikaRlsiqLeqqKNTLvnOMe/n7neQjrApbTKDAaDl7j7Loot1VMKlO', NULL, NULL, 'FhT8dCMQ-FhBOSeIZ4rUBsTidGm4q0vV', NULL, 2, '2015-09-30 14:28:04', '2015-09-08 12:58:24', '2015-09-08 12:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `meta_tags`
--

CREATE TABLE IF NOT EXISTS `meta_tags` (
`id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meta_tags`
--

INSERT INTO `meta_tags` (`id`, `model`, `model_id`, `title`, `keywords`, `description`, `created`, `updated`) VALUES
(1, 'Project', 1, 'First Project Test', 'First Project Test', 'First Project Test', '2015-09-08 15:06:12', '2015-09-08 15:39:55'),
(2, 'Career', 1, '', '', '', '2015-09-08 15:17:08', '2015-09-08 15:17:08'),
(3, 'Project', 2, '', '', '', '2015-09-08 15:28:53', '2015-09-08 15:28:53'),
(4, 'Page', 2, '', '', '', '2015-09-08 15:51:41', '2015-09-08 15:51:41'),
(7, 'Page', 5, '', '', '', '2015-09-17 10:23:50', '2015-09-29 09:21:36'),
(8, 'Catalogue', 6, '', '', '', '2015-09-17 10:45:32', '2015-09-17 10:45:32'),
(9, 'Showroom', 7, '', '', '', '2015-09-17 10:49:22', '2015-09-17 10:49:22'),
(10, 'Product', 4, '', '', '', '2015-09-17 13:44:34', '2015-09-17 13:44:34'),
(11, 'Product', 1, 'test2', 'test2', 'test2', '2015-09-17 14:06:49', '2015-09-17 14:23:54'),
(12, 'Product', 5, 'test5', 'test5', 'test5', '2015-09-17 14:42:55', '2015-09-17 14:42:55'),
(13, 'Catalogue', 11, '2015', '2015', '2015', '2015-09-17 15:15:03', '2015-09-17 15:15:03'),
(14, 'Product', 6, 'test6', 'test6', 'test6', '2015-09-20 11:52:17', '2015-09-20 11:52:17'),
(15, 'Showroom', 12, '', '', '', '2015-09-28 15:22:31', '2015-09-28 15:22:31'),
(16, 'Showroom', 13, '', '', '', '2015-09-28 15:23:36', '2015-09-28 15:23:36'),
(17, 'Showroom', 14, '', '', '', '2015-09-28 15:33:32', '2015-09-28 15:33:32'),
(18, 'Showroom', 15, '', '', '', '2015-09-28 15:34:01', '2015-09-28 15:34:01'),
(19, 'Certificate', 16, '', '', '', '2015-09-29 10:29:54', '2015-09-29 10:29:54'),
(20, 'Certificate', 17, '', '', '', '2015-09-29 10:30:28', '2015-09-29 10:30:28'),
(21, 'Page', 18, '', '', '', '2015-09-29 11:05:05', '2015-09-29 11:05:05'),
(22, 'Catalogue', 19, '', '', '', '2015-09-29 14:04:27', '2015-09-29 14:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `brief` varchar(500) NOT NULL,
  `description` tinytext NOT NULL,
  `body` text NOT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `embed` tinytext NOT NULL,
  `tags` varchar(255) NOT NULL,
  `featured` tinyint(1) unsigned DEFAULT '0',
  `status` tinyint(4) DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `title`, `slug`, `brief`, `description`, `body`, `price`, `embed`, `tags`, `featured`, `status`, `sort`, `created`, `updated`) VALUES
(1, 7, 'testing1', 'testing1', 'testing1', 'testing1', '<p>testing1</p>\r\n', '100.00', '', '', 0, NULL, 0, NULL, '2015-09-17 14:23:54'),
(2, 8, 'test 2', 'test-2', 'test 2', 'test 2', '<p>test 2</p>\r\n', '0.00', '', '', 0, NULL, 0, '2015-09-17 12:16:52', '2015-09-17 12:16:52'),
(3, 12, 'test3', 'test-3', 'test 3', 'test 3', '<p>test3</p>\r\n', '99.00', '', '', 0, NULL, 0, '2015-09-17 12:26:47', '2015-09-17 12:27:51'),
(4, 6, 'test4', 'test4', 'test4', 'test4', '<p>test4</p>\r\n', '5.00', '', '', 0, NULL, 1, '2015-09-17 13:44:34', '2015-09-17 13:44:34'),
(5, 12, 'test5', 'test5', 'test5', 'test5', '<p>test5</p>\r\n', '500.00', '', '', 1, NULL, 2, '2015-09-17 14:42:54', '2015-09-17 14:42:54'),
(6, 12, 'test6', 'test6', 'test6', 'test6', '<p>test6</p>\r\n', '200.00', '', '', 1, NULL, 3, '2015-09-20 11:52:16', '2015-09-20 11:52:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
 ADD PRIMARY KEY (`name`);

--
-- Indexes for table `base_content`
--
ALTER TABLE `base_content`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_media`
--
ALTER TABLE `base_media`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `base_messages`
--
ALTER TABLE `base_messages`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_base_messages_1` (`parent_id`), ADD KEY `fk_base_messages_2` (`sender_id`), ADD KEY `fk_base_messages_3` (`receiver_id`);

--
-- Indexes for table `base_settings`
--
ALTER TABLE `base_settings`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `key_UNIQUE` (`key`);

--
-- Indexes for table `base_tree`
--
ALTER TABLE `base_tree`
 ADD PRIMARY KEY (`id`), ADD KEY `tbl_tree_NK1` (`root`), ADD KEY `tbl_tree_NK2` (`lft`), ADD KEY `tbl_tree_NK3` (`rgt`), ADD KEY `tbl_tree_NK4` (`lvl`), ADD KEY `tbl_tree_NK5` (`active`);

--
-- Indexes for table `base_user`
--
ALTER TABLE `base_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username_UNIQUE` (`username`), ADD UNIQUE KEY `email_UNIQUE` (`email`), ADD UNIQUE KEY `token_UNIQUE` (`token`), ADD UNIQUE KEY `signature_UNIQUE` (`auth_key`), ADD UNIQUE KEY `login_token_UNIQUE` (`sso_key`);

--
-- Indexes for table `meta_tags`
--
ALTER TABLE `meta_tags`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `object` (`model`,`model_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_dgt_products_1_idx` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `base_content`
--
ALTER TABLE `base_content`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `base_media`
--
ALTER TABLE `base_media`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `base_messages`
--
ALTER TABLE `base_messages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `base_settings`
--
ALTER TABLE `base_settings`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `base_tree`
--
ALTER TABLE `base_tree`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique tree node identifier',AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `base_user`
--
ALTER TABLE `base_user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `meta_tags`
--
ALTER TABLE `meta_tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `fk_products_1` FOREIGN KEY (`category_id`) REFERENCES `base_tree` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
