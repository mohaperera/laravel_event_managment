-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2014 at 07:15 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inwizards`
--
CREATE DATABASE IF NOT EXISTS `inwizards` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `inwizards`;

-- --------------------------------------------------------

--
-- Table structure for table `erp_binding_methods`
--

CREATE TABLE IF NOT EXISTS `erp_binding_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `erp_binding_methods`
--

-- --------------------------------------------------------

--
-- Table structure for table `erp_booths`
--

CREATE TABLE IF NOT EXISTS `erp_booths` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `boothnumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `companyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statues` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `erp_cover_types`
--

CREATE TABLE IF NOT EXISTS `erp_cover_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `erp_cover_types`
--

INSERT INTO `erp_cover_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Die Cut Material', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Image Wrap', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Padded Leather', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `erp_designs`
--

CREATE TABLE IF NOT EXISTS `erp_designs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `json` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `designs_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `erp_events`
--

CREATE TABLE IF NOT EXISTS `erp_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `finish_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `erp_events`
--

INSERT INTO `erp_events` (`id`, `user_id`, `title`, `description`, `start_date`, `finish_date`, `city`, `created_at`, `updated_at`) VALUES
(1, 1, 'first Event', 'first Event desc', '2012-02-02', '2012-02-25', 'Jabalpur', '2014-03-27 14:37:40', '2014-03-29 00:04:17'),
(2, 1, 'sdfadfdsfdsffds', 'sdfsdf sdfdsf ssdfdsf sdfds ', 'sdf', 'sdf', 'sdfsdf', '2014-03-28 13:22:40', '2014-03-28 13:22:40'),
(3, 1, 'sdfsdfsdf', 'sdfdsfsdfsdf', '', '', 'sfsdfsdfsdf', '2014-03-30 04:27:25', '2014-03-30 04:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `erp_exhibitors`
--

CREATE TABLE IF NOT EXISTS `erp_exhibitors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `compnayLogo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `boothNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `productsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `productDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `featured` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `erp_groups`
--

CREATE TABLE IF NOT EXISTS `erp_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `erp_groups`
--

INSERT INTO `erp_groups` (`id`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin a', '2014-03-24 18:30:00', '2014-03-27 12:55:30', NULL),
(4, 'sencond group', 'sencond group desc s', '2014-03-27 11:41:47', '2014-03-27 12:55:45', NULL),
(5, 'Third Group', 'Third Group desc', '2014-03-27 11:44:15', '2014-03-27 11:44:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `erp_migrations`
--

CREATE TABLE IF NOT EXISTS `erp_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `erp_migrations`
--

INSERT INTO `erp_migrations` (`migration`, `batch`) VALUES
('2014_01_01_000001_create_users_table', 1),
('2014_01_01_000002_create_template_type_table', 1),
('2014_01_01_000003_create_binding_method_table', 1),
('2014_01_01_000004_create_cover_type_table', 1),
('2014_01_01_000005_create_templates_table', 1),
('2014_01_01_000006_create_urls_table', 1),
('2014_01_08_052826_create_designs_table', 1),
('2014_03_13_065756_create_events_table', 1),
('2014_03_14_094406_create_speakers_table', 1),
('2014_03_14_122442_create_mysessions_table', 1),
('2014_03_14_133812_create_sponsors_table', 1),
('2014_03_19_155841_create_exhibitors_table', 1),
('2014_03_19_161933_create_booths_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `erp_mysessions`
--

CREATE TABLE IF NOT EXISTS `erp_mysessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `erp_mysessions`
--

INSERT INTO `erp_mysessions` (`id`, `session_title`, `description`, `room`, `created_at`, `updated_at`) VALUES
(1, 'sdfsdfdsf', 'sdfsdfsdf', 'sdfsdfdsf', '2014-03-28 15:16:56', '2014-03-28 15:16:56'),
(3, 'sadfsddfsdf333', 'fdsfsdfsdfsdf333', 'sdfdsfds33', '2014-03-28 15:19:26', '2014-03-28 15:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `erp_speakers`
--

CREATE TABLE IF NOT EXISTS `erp_speakers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `SpeakerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jobTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `companyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sessionTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebookAccount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitterAccount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `speakers_speakername_unique` (`SpeakerName`),
  KEY `speakers_event_id_index` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `erp_sponsors`
--

CREATE TABLE IF NOT EXISTS `erp_sponsors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `compnayLogo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `boothNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sponsorshipcategory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `productsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `productDescription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `erp_sponsors`
--

INSERT INTO `erp_sponsors` (`id`, `companyName`, `compnayLogo`, `boothNumber`, `sponsorshipcategory`, `category`, `website`, `productsName`, `image`, `productDescription`, `created_at`, `updated_at`) VALUES
(1, 'sdfsdfsdfdsf', 'sdfdsfdsfdsf', 'sdfdsfdsfdsf', 'sdfdsfdsfdsf', 'sdfdsfsdfdsf', 'asdfsadfasf', 'asdfasfasdfasdf', 'asdfdsfdsfsdf', 'safdsfdsfdsfdsfsdfsdfdsf', '2014-03-28 14:24:55', '2014-03-28 14:24:55'),
(2, 'sadfsdfdsf', 'sdfdsf', 'sdfdsfdsf', 'sdfdsf', 'sdfsdf', 'gdfghfghfgh', 'dgfghfghf', 'hgfhdfghfh', 'dfghfghfghgfhgfh', '2014-03-28 14:25:25', '2014-03-28 14:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `erp_templates`
--

CREATE TABLE IF NOT EXISTS `erp_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `design_data` text COLLATE utf8_unicode_ci,
  `exterior_dimensions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interior_dimensions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pages` smallint(6) DEFAULT NULL,
  `symmetrical_bleed` smallint(6) DEFAULT NULL,
  `spine_width` smallint(6) DEFAULT NULL,
  `hinge_offset` smallint(6) DEFAULT NULL,
  `collate` tinyint(1) DEFAULT NULL,
  `crop_marks` tinyint(1) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `seam_orientation` tinyint(1) DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `template_type_id` int(10) unsigned NOT NULL,
  `binding_method_id` int(10) unsigned NOT NULL,
  `cover_type_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `templates_alias_unique` (`alias`),
  KEY `templates_template_type_id_index` (`template_type_id`),
  KEY `templates_binding_method_id_index` (`binding_method_id`),
  KEY `templates_cover_type_id_index` (`cover_type_id`),
  KEY `templates_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `erp_template_types`
--

CREATE TABLE IF NOT EXISTS `erp_template_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `erp_template_types`
--

INSERT INTO `erp_template_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Photobook', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Poster', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `erp_urls`
--

CREATE TABLE IF NOT EXISTS `erp_urls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `erp_users`
--

CREATE TABLE IF NOT EXISTS `erp_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `authentication_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `erp_users`
--

INSERT INTO `erp_users` (`id`, `group_id`, `username`, `password`, `email`, `authentication_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'EventManager', '$2y$10$S.g1rizOKb.wYOWZ2zq77e682rovrcvv9W92fXiS6mqBslnFFbBY6', 'manish.jakhode@hiteshi.com', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(2, 2, 'bvikasvburman', '$admin123', 'bvikasvburman@gmail.com', NULL, '2014-03-27 13:50:42', '2014-03-29 14:56:09', NULL),
(4, 2, 'admin', 'admin', 'manish.jakhode@hiteshi.com', NULL, '2014-03-28 11:37:35', '2014-03-28 11:37:35', NULL),
(5, 2, 'dsfdsfsd', 'sdfsdfs', 'ssfsdf@gmail.com', NULL, '2014-03-28 11:37:57', '2014-03-28 11:37:57', NULL),
(6, 2, 'dfgdfgdfg', 'fsdfdsf', 'gdfgdfg@dfdsf.com', NULL, '2014-03-28 11:55:17', '2014-03-28 11:55:17', NULL),
(7, 2, 'sdfdsfsdfds', '$2y$10$p5XItbHYDtdvhIw3xrWiQOVWDNbKGVFrBF98D0E1voILI5TA1yXxi', 'sdfdsfsdf@fasdfs.com', NULL, '2014-03-28 23:42:22', '2014-03-28 23:42:22', NULL),
(8, 2, 'test123', '$2y$10$H2.djpmLs5j6vVkX7RruReJF6iSxHxgjN1p0PAC/uC1zgoLvwrlVq', 'test@test.com', NULL, '2014-03-28 23:47:18', '2014-03-28 23:47:18', NULL),
(9, 2, 'monika', '$2y$10$.YNk.S4UrEo.qXWwmUStAOawfZQ62HP8UGXf5cV0CccjuQw.Fb19y', 'monika@gmail.com', NULL, '2014-03-30 03:24:36', '2014-03-30 03:24:36', NULL),
(10, 2, 'sdfdsfsdf', '$2y$10$AgCalLE.x0pHEHCksOe0pedwk1ZNGCzKfrNTojBxg5qL1LqXvfTFa', 'test@test.com', NULL, '2014-03-30 03:26:07', '2014-03-30 03:26:07', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `erp_designs`
--
ALTER TABLE `erp_designs`
  ADD CONSTRAINT `designs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `erp_users` (`id`);

--
-- Constraints for table `erp_speakers`
--
ALTER TABLE `erp_speakers`
  ADD CONSTRAINT `speakers_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `erp_events` (`id`);

--
-- Constraints for table `erp_templates`
--
ALTER TABLE `erp_templates`
  ADD CONSTRAINT `templates_binding_method_id_foreign` FOREIGN KEY (`binding_method_id`) REFERENCES `erp_binding_methods` (`id`),
  ADD CONSTRAINT `templates_cover_type_id_foreign` FOREIGN KEY (`cover_type_id`) REFERENCES `erp_cover_types` (`id`),
  ADD CONSTRAINT `templates_template_type_id_foreign` FOREIGN KEY (`template_type_id`) REFERENCES `erp_template_types` (`id`),
  ADD CONSTRAINT `templates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `erp_users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
