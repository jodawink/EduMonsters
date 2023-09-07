-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 07, 2023 at 09:50 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edumonsters`
--

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

DROP TABLE IF EXISTS `challenges`;
CREATE TABLE IF NOT EXISTS `challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(510) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `name`, `code`, `created_by`, `created_at`) VALUES
(2, 'quick test 2', 'QNUX', 2, '2022-10-03 21:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `challenge_stages`
--

DROP TABLE IF EXISTS `challenge_stages`;
CREATE TABLE IF NOT EXISTS `challenge_stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `challenge_id` int(11) DEFAULT NULL,
  `stage_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `challange_id` (`challenge_id`),
  KEY `stage_id` (`stage_id`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `challenge_stages`
--

INSERT INTO `challenge_stages` (`id`, `challenge_id`, `stage_id`) VALUES
(11, 2, 5),
(10, 2, 4),
(9, 2, 3),
(8, 2, 2),
(7, 2, 1),
(12, 2, 6),
(13, 2, 7),
(14, 2, 8),
(15, 2, 9),
(16, 2, 10),
(17, 2, 11),
(18, 2, 12),
(19, 2, 13),
(20, 2, 14),
(96, 2, 90),
(94, 2, 88),
(93, 2, 87);

-- --------------------------------------------------------

--
-- Table structure for table `known_sessions`
--

DROP TABLE IF EXISTS `known_sessions`;
CREATE TABLE IF NOT EXISTS `known_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(36) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `valid_until` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `session_id` (`session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_idx` (`role_id`),
  KEY `permission_idx` (`permission_id`),
  KEY `compound_idx` (`role_id`,`permission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(41, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `answers` text,
  `difficulty` int(11) DEFAULT NULL,
  `set_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `set_id` (`set_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `content`, `answers`, `difficulty`, `set_id`, `created_by`, `created_at`) VALUES
(1, 'what is 2 + 2', '[\"4\",\"3\",\"2\",\"1\"]', 1, 1, 2, '2022-10-10 18:45:35'),
(2, 'what is 2 + 5', '[\"7\",\"6\",\"8\",\"5\"]', 1, 1, 2, '2022-10-10 18:45:35'),
(3, 'what is 3 x 4', '[\"12\",\"10\",\"11\",\"14\"]', 1, 3, 2, '2022-10-10 18:45:35'),
(4, 'what is 3-2', '[\"1\",\"2\",\"3\",\"4\"]', 1, 2, 2, '2022-10-10 18:46:46'),
(19, 'what is 7 - 5 ?', '[\"2\",\"5\",\"3\",\"6\"]', 1, 2, 2, '2022-10-19 18:48:21'),
(11, 'What is 10 - 5 ?', '[\"5\",\"3\",\"4\",\"6\"]', 3, 2, 2, '2022-10-13 19:27:42'),
(13, 'what is 3 + 3 ?', '[\"6\",\"5\",\"4\",\"7\"]', 1, 1, 2, '2022-10-19 18:46:23'),
(14, 'what is 5 + 3 ?', '[\"8\",\"5\",\"4\",\"7\"]', 1, 1, 2, '2022-10-19 18:46:37'),
(15, 'what is 2 x 2 ?', '[\"4\",\"5\",\"3\",\"7\"]', 1, 3, 2, '2022-10-19 18:46:53'),
(16, 'what is 3 x 2 ?', '[\"6\",\"5\",\"3\",\"7\"]', 1, 3, 2, '2022-10-19 18:47:03'),
(17, 'what is 4 x 3 ?', '[\"12\",\"16\",\"4\",\"43\"]', 1, 3, 2, '2022-10-19 18:47:35'),
(18, 'what is 6 - 2 ?', '[\"4\",\"5\",\"3\",\"2\"]', 1, 2, 2, '2022-10-19 18:47:59'),
(20, 'what is 10 - 5 ?', '[\"5\",\"4\",\"3\",\"6\"]', 1, 2, 2, '2022-10-19 18:48:55'),
(21, 'what is 11 - 7 ?', '[\"4\",\"9\",\"3\",\"6\"]', 1, 2, 2, '2022-10-19 18:49:15'),
(22, 'what is 10  - 9 ?', '[\"1\",\"9\",\"3\",\"6\"]', 1, 2, 2, '2022-10-19 18:49:38'),
(23, 'what is 10  - 8 ?', '[\"2\",\"9\",\"3\",\"6\"]', 1, 2, 2, '2022-10-19 18:49:45'),
(24, 'what is 9  - 4 ?', '[\"5\",\"9\",\"3\",\"6\"]', 1, 2, 2, '2022-10-19 18:49:59'),
(25, 'what is 9  - 5 ?', '[\"4\",\"9\",\"3\",\"6\"]', 1, 2, 2, '2022-10-19 18:50:07'),
(26, 'what is 4 + 2 ?', '[\"6\",\"7\",\"3\",\"5\"]', 1, 1, 2, '2022-10-19 18:50:58'),
(27, 'what is 4 + 3 ?', '[\"7\",\"6\",\"3\",\"5\"]', 1, 1, 2, '2022-10-19 18:51:06'),
(28, 'what is 4 + 1 ?', '[\"5\",\"6\",\"3\",\"4\"]', 1, 1, 2, '2022-10-19 18:51:15'),
(29, 'what is 5 + 4 ?', '[\"9\",\"6\",\"3\",\"4\"]', 1, 1, 2, '2022-10-19 18:51:29'),
(30, 'what is 3 x 5 ?', '[\"15\",\"6\",\"5\",\"4\"]', 1, 3, 2, '2022-10-19 18:51:46'),
(31, 'what is 5 x 3 ?', '[\"15\",\"6\",\"5\",\"4\"]', 1, 3, 2, '2022-10-19 18:52:00'),
(32, 'what is 7 x 2 ?', '[\"14\",\"7\",\"5\",\"4\"]', 1, 3, 2, '2022-10-19 18:52:13'),
(33, 'What is 12 + 7 ?', '[\"19\",\"20\",\"15\",\"21\"]', 1, 1, 2, '2022-10-23 19:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '', 'The Administrator of the application', '2017-10-31 23:00:00', '2017-10-31 23:00:00'),
(2, 'Editor', '', 'This user can access the application but all the permissions are removed.\r\nOnly non-restricted areas can be accessed. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sets`
--

DROP TABLE IF EXISTS `sets`;
CREATE TABLE IF NOT EXISTS `sets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(510) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sets`
--

INSERT INTO `sets` (`id`, `title`, `created_by`, `created_at`) VALUES
(1, 'Addition set', 2, '2022-10-10 18:40:07'),
(2, 'Substruction set', 2, '2022-10-10 18:40:07'),
(3, 'Multiplication', 2, '2022-10-10 18:42:03'),
(4, 'Big numbers', 2, '2022-10-23 19:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stage_name` varchar(255) DEFAULT NULL,
  `required_questions` int(11) DEFAULT NULL,
  `corect_questions` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `stage_name`, `required_questions`, `corect_questions`, `created_at`) VALUES
(1, 'level 1', 5, 4, '2022-10-05 19:14:08'),
(2, 'STAGE 2', 5, 4, '2022-10-05 19:14:16'),
(90, 'Stage 3', 5, 4, '2022-10-12 22:41:52'),
(15, 'stage 3', 5, 0, '2022-10-10 20:32:42'),
(16, 'stage 3', 5, 0, '2022-10-10 20:49:44'),
(17, 'stage 3', 5, 0, '2022-10-10 20:51:52'),
(18, 'stage 3', 5, 0, '2022-10-10 20:56:04'),
(19, 'stage 3', 5, 0, '2022-10-10 20:57:33'),
(20, 'stage 3', 5, 0, '2022-10-10 20:57:53'),
(21, 'stage 3', 5, 0, '2022-10-10 20:57:55'),
(22, 'stage 3', 5, 0, '2022-10-10 20:57:56'),
(23, 'stage 3', 5, 0, '2022-10-10 21:01:27'),
(24, 'stage 3', 5, 0, '2022-10-10 21:01:47'),
(25, 'stage 3', 5, 0, '2022-10-10 21:05:21'),
(26, 'stage 3', 5, 0, '2022-10-10 21:07:21'),
(27, 'stage 3', 5, 0, '2022-10-10 21:07:50'),
(28, 'stage 3', 5, 0, '2022-10-10 21:08:13'),
(29, 'stage 3', 5, 0, '2022-10-10 21:08:23'),
(30, 'stage 3', 5, 0, '2022-10-10 21:08:36'),
(31, 'stage 3', 5, 0, '2022-10-10 21:11:28'),
(32, 'stage 3', 5, 0, '2022-10-10 21:13:33'),
(33, 'stage 3', 5, 0, '2022-10-10 21:13:50'),
(34, 'stage 3', 5, 0, '2022-10-10 21:15:11'),
(35, 'stage 3', 5, 0, '2022-10-10 21:16:10'),
(36, 'stage 3', 5, 0, '2022-10-10 21:16:58'),
(37, 'stage 3', 5, 0, '2022-10-10 21:17:14'),
(38, 'stage 3', 5, 0, '2022-10-10 21:17:46'),
(39, 'stage 3', 5, 0, '2022-10-10 21:17:47'),
(40, 'stage 3', 5, 0, '2022-10-10 21:17:48'),
(41, 'stage 3', 5, 0, '2022-10-10 21:17:48'),
(42, 'stage 3', 5, 0, '2022-10-10 21:18:33'),
(43, 'stage 3', 5, 0, '2022-10-10 21:18:34'),
(44, 'stage 3', 5, 0, '2022-10-10 21:18:35'),
(45, 'stage 3', 5, 0, '2022-10-10 21:18:43'),
(46, 'stage 3', 5, 0, '2022-10-10 21:18:53'),
(47, 'stage 3', 5, 0, '2022-10-10 21:18:53'),
(48, 'stage 3', 5, 0, '2022-10-10 21:18:54'),
(49, 'stage 3', 5, 0, '2022-10-10 21:18:54'),
(50, 'stage 3', 5, 0, '2022-10-10 21:18:55'),
(51, 'stage 3', 5, 0, '2022-10-10 21:19:08'),
(52, 'stage 3', 5, 0, '2022-10-10 21:19:09'),
(53, 'stage 3', 5, 0, '2022-10-10 21:19:36'),
(54, 'stage 3', 5, 0, '2022-10-10 21:19:59'),
(55, 'stage 3', 5, 0, '2022-10-10 21:20:13'),
(56, 'stage 3', 5, 0, '2022-10-10 21:20:14'),
(57, 'stage 3', 5, 0, '2022-10-10 21:20:15'),
(58, 'stage 3', 5, 0, '2022-10-10 21:22:05'),
(59, 'stage 3', 5, 0, '2022-10-10 21:22:13'),
(60, 'stage 3', 5, 0, '2022-10-10 21:22:39'),
(61, 'stage 3', 5, 0, '2022-10-10 21:23:44'),
(62, 'stage 3', 5, 0, '2022-10-10 21:26:35'),
(63, 'stage 3', 5, 0, '2022-10-10 21:29:10'),
(64, 'stage 3', 5, 0, '2022-10-10 21:31:38'),
(65, 'stage 3', 5, 0, '2022-10-10 21:31:39'),
(66, 'stage 3', 5, 0, '2022-10-10 21:31:59'),
(67, 'stage 3', 5, 0, '2022-10-10 21:32:00'),
(68, 'stage 3', 5, 0, '2022-10-10 21:32:10'),
(69, 'stage 3', 5, 0, '2022-10-10 21:33:23'),
(70, 'stage 3', 5, 0, '2022-10-10 21:35:13'),
(71, 'stage 3', 5, 0, '2022-10-10 21:37:17'),
(72, 'stage 3', 5, 0, '2022-10-10 21:37:36'),
(73, 'stage 3', 5, 0, '2022-10-10 21:38:46'),
(74, 'stage 3', 5, 0, '2022-10-10 21:39:05'),
(75, 'stage 3', 5, 0, '2022-10-10 21:42:36'),
(76, 'stage 3', 5, 0, '2022-10-10 21:43:06'),
(77, 'stage 3', 5, 0, '2022-10-10 21:43:55'),
(78, 'stage 3', 5, 0, '2022-10-10 21:44:40'),
(79, 'stage 3', 5, 0, '2022-10-10 21:44:41'),
(80, 'stage 3', 5, 0, '2022-10-10 21:45:28'),
(81, 'stage 3', 5, 0, '2022-10-10 21:51:26'),
(82, 'stage 3', 5, 0, '2022-10-10 21:53:35'),
(83, 'stage 3', 5, 0, '2022-10-10 21:53:37'),
(84, 'final stage', 4, 0, '2022-10-10 21:54:41'),
(85, 'final stage', 4, 0, '2022-10-10 21:54:45'),
(86, 'final stage', 4, 0, '2022-10-10 21:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `stage_sets`
--

DROP TABLE IF EXISTS `stage_sets`;
CREATE TABLE IF NOT EXISTS `stage_sets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stage_id` int(11) DEFAULT NULL,
  `set_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stage_id` (`stage_id`),
  KEY `set_id` (`set_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stage_sets`
--

INSERT INTO `stage_sets` (`id`, `stage_id`, `set_id`) VALUES
(38, 4, 3),
(36, 2, 2),
(44, 88, 2),
(52, 1, 3),
(51, 1, 1),
(45, 89, 1),
(47, 90, 2),
(53, 90, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password_2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `last_logged_at` datetime DEFAULT NULL,
  `login_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `role_id` char(1) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `full_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `reset_code` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_index1117` (`username`),
  UNIQUE KEY `user_email_index1117` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password_2`, `created_at`, `last_logged_at`, `login_count`, `role_id`, `email`, `full_name`, `reset_code`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2020-05-25 22:27:52', '2023-09-07 11:48:36', 12, '1', 'admin@admin.com', 'Administrator', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `profile_image` varchar(510) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_user_id` (`users_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `users_user_id`, `email`, `date_of_birth`, `profile_image`, `contact`, `created_at`) VALUES
(1, 2, '', '2022-10-03', '', '', '2022-10-03 20:28:09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
