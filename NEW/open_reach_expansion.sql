-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2016 at 04:46 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `open_reach_expansion`
--

-- --------------------------------------------------------

--
-- Table structure for table `bf_activities`
--

CREATE TABLE IF NOT EXISTS `bf_activities` (
  `activity_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `activity` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted` tinyint(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=540 ;

--
-- Dumping data for table `bf_activities`
--

INSERT INTO `bf_activities` (`activity_id`, `user_id`, `activity`, `module`, `created_on`, `deleted`) VALUES
(1, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-21 06:11:13', 0),
(2, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-25 04:53:26', 0),
(3, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-25 05:03:20', 0),
(4, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-25 06:59:37', 0),
(5, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-25 07:12:41', 0),
(6, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-26 04:16:20', 0),
(7, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-26 07:30:23', 0),
(8, 1, 'Created Module: assigned : 127.0.0.1', 'modulebuilder', '2015-05-26 13:18:34', 0),
(9, 1, 'Deleted Module: assigned : 127.0.0.1', 'builder', '2015-05-26 13:24:23', 0),
(10, 1, 'Created Module: userinfo : 127.0.0.1', 'modulebuilder', '2015-05-26 13:29:14', 0),
(11, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-27 04:04:36', 0),
(12, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-27 04:05:52', 0),
(13, 1, 'Deleted Module: userinfo : 127.0.0.1', 'builder', '2015-05-27 04:07:33', 0),
(14, 1, 'Created Module: userinfo : 127.0.0.1', 'modulebuilder', '2015-05-27 04:14:29', 0),
(15, 1, 'Created Module: userinfo : 127.0.0.1', 'modulebuilder', '2015-05-27 04:14:38', 0),
(16, 1, 'Deleted Module: userinfo : 127.0.0.1', 'builder', '2015-05-27 04:42:46', 0),
(17, 1, 'Created Module: technology : 127.0.0.1', 'modulebuilder', '2015-05-27 04:47:26', 0),
(18, 1, 'Created record with ID: 1 : 127.0.0.1', 'technology', '2015-05-27 04:48:20', 0),
(19, 1, 'Deleted record with ID: 1 : 127.0.0.1', 'technology', '2015-05-27 05:06:30', 0),
(20, 1, 'Created record with ID: 2 : 127.0.0.1', 'technology', '2015-05-27 05:15:27', 0),
(21, 1, 'FIXME ("us_log_status_change"): admin : Activateed', 'users', '2015-05-27 05:45:03', 0),
(22, 1, 'App settings saved from: 127.0.0.1', 'ui', '2015-05-27 07:53:42', 0),
(23, 1, 'App settings saved from: 127.0.0.1', 'ui', '2015-05-27 07:54:37', 0),
(24, 1, 'App settings saved from: 127.0.0.1', 'ui', '2015-05-27 07:55:45', 0),
(25, 1, 'App settings saved from: 127.0.0.1', 'ui', '2015-05-27 07:55:49', 0),
(26, 1, 'Created record with ID: 3 : 127.0.0.1', 'technology', '2015-05-27 11:08:31', 0),
(27, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-27 12:40:26', 0),
(28, 1, 'Created record with ID: 1 : 127.0.0.1', 'category', '2015-05-27 13:18:53', 0),
(29, 1, 'Created record with ID: 1 : 127.0.0.1', 'navigation', '2015-05-27 13:19:27', 0),
(30, 1, 'Created record with ID: 4 : 127.0.0.1', 'technology', '2015-05-27 13:22:16', 0),
(31, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-28 04:04:37', 0),
(32, 1, 'Created Module: dddd : 127.0.0.1', 'modulebuilder', '2015-05-28 04:36:08', 0),
(33, 1, 'Deleted Module: dddd : 127.0.0.1', 'builder', '2015-05-28 04:36:33', 0),
(34, 1, 'Deleted Module: technology : 127.0.0.1', 'builder', '2015-05-28 04:36:38', 0),
(35, 1, 'Created Module: technology : 127.0.0.1', 'modulebuilder', '2015-05-28 04:37:38', 0),
(36, 1, 'Created Module: technology : 127.0.0.1', 'modulebuilder', '2015-05-28 04:37:42', 0),
(37, 1, 'Deleted Module: technology : 127.0.0.1', 'builder', '2015-05-28 04:51:26', 0),
(38, 1, 'Created Module: technology : 127.0.0.1', 'modulebuilder', '2015-05-28 04:51:56', 0),
(39, 1, 'Deleted Module: technology : 127.0.0.1', 'builder', '2015-05-28 04:56:16', 0),
(40, 1, 'Created Module: technology : 127.0.0.1', 'modulebuilder', '2015-05-28 04:57:01', 0),
(41, 1, 'Deleted Module: technology : 127.0.0.1', 'builder', '2015-05-28 04:58:26', 0),
(42, 1, 'Created Module: test mod : 127.0.0.1', 'modulebuilder', '2015-05-28 04:59:18', 0),
(43, 1, 'Created Module: frfrff : 127.0.0.1', 'modulebuilder', '2015-05-28 05:04:06', 0),
(44, 1, 'Deleted Module: frfrff : 127.0.0.1', 'builder', '2015-05-28 05:04:23', 0),
(45, 1, 'Deleted Module: test_mod : 127.0.0.1', 'builder', '2015-05-28 05:04:27', 0),
(46, 1, 'Created Module: testing1 : 127.0.0.1', 'modulebuilder', '2015-05-28 05:05:29', 0),
(47, 1, 'Created record with ID: 1 : 127.0.0.1', 'testing1', '2015-05-28 05:05:41', 0),
(48, 1, 'Deleted record with ID: 1 : 127.0.0.1', 'testing1', '2015-05-28 05:05:50', 0),
(49, 1, 'Migrate Type: refer_friend_ to Version: 1 from: 127.0.0.1', 'migrations', '2015-05-28 05:10:30', 0),
(50, 1, 'Migration module: refer_friend Version: 1 from: 127.0.0.1', 'migrations', '2015-05-28 05:10:30', 0),
(51, 1, 'Migrate Type: refer_friend_ to Version: 2 from: 127.0.0.1', 'migrations', '2015-05-28 05:10:39', 0),
(52, 1, 'Migration module: refer_friend Version: 2 from: 127.0.0.1', 'migrations', '2015-05-28 05:10:39', 0),
(53, 1, 'Created record with ID: 2 : 127.0.0.1', 'category', '2015-05-28 05:26:37', 0),
(54, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-28 05:33:28', 0),
(55, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-28 05:49:59', 0),
(56, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-28 05:57:24', 0),
(57, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-28 05:57:49', 0),
(58, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-28 09:24:03', 0),
(59, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-29 04:37:47', 0),
(60, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-29 04:50:12', 0),
(61, 1, 'Created record with ID: 1 : 127.0.0.1', 'testing1', '2015-05-29 04:58:58', 0),
(62, 1, 'FIXME ("bf_common_act_create_record"): 1 : 127.0.0.1', 'pages', '2015-05-29 05:26:53', 0),
(63, 1, 'Deleted Module: testing1 : 127.0.0.1', 'builder', '2015-05-29 05:29:52', 0),
(64, 1, 'Deleted Module: Refer_Friend : 127.0.0.1', 'builder', '2015-05-29 05:29:57', 0),
(65, 1, 'Created record with ID: 1 : 127.0.0.1', 'menu', '2015-05-29 05:36:12', 0),
(66, 1, 'Updated record with ID: 1 : 127.0.0.1', 'menu', '2015-05-29 06:04:29', 0),
(67, 1, 'Updated record with ID: 1 : 127.0.0.1', 'menu', '2015-05-29 06:04:39', 0),
(68, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-29 06:13:35', 0),
(69, 1, 'Created record with ID: 2 : 127.0.0.1', 'menu', '2015-05-29 06:14:40', 0),
(70, 1, 'Created record with ID: 2 : 127.0.0.1', 'navigation', '2015-05-29 06:32:10', 0),
(71, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-29 10:56:46', 0),
(72, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-29 11:21:40', 0),
(73, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-29 11:22:58', 0),
(74, 1, 'created a new %s User: d', 'users', '2015-05-29 11:24:49', 0),
(75, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-29 12:52:57', 0),
(76, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-30 03:55:12', 0),
(77, 1, 'Created Module: 4wt : 127.0.0.1', 'modulebuilder', '2015-05-30 03:57:35', 0),
(78, 1, 'Deleted Module: testing1 : 127.0.0.1', 'builder', '2015-05-30 04:21:28', 0),
(79, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-30 04:26:03', 0),
(80, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-30 04:29:11', 0),
(81, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-30 04:46:56', 0),
(82, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-30 04:50:19', 0),
(83, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-30 06:35:39', 0),
(84, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-30 07:06:55', 0),
(85, 1, 'logged in from: 127.0.0.1', 'users', '2015-05-30 07:44:00', 0),
(86, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-01 03:59:22', 0),
(87, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-01 04:05:39', 0),
(88, 1, 'Migrate Type: banner_ to Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:05:23', 0),
(89, 1, 'Migration module: banner Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:05:23', 0),
(90, 1, 'Migrate Type: banner_ to Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:05:30', 0),
(91, 1, 'Migration module: banner Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:05:30', 0),
(92, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-01 06:11:19', 0),
(93, 1, 'Migrate Type: banner_ Uninstalled Version: 0 from: 127.0.0.1', 'migrations', '2015-06-01 06:14:48', 0),
(94, 1, 'Migration module: banner Version: 0 from: 127.0.0.1', 'migrations', '2015-06-01 06:14:48', 0),
(95, 1, 'Migrate Type: banner_ to Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:14:54', 0),
(96, 1, 'Migration module: banner Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:14:55', 0),
(97, 1, 'Migrate Type: banner_ to Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:15:16', 0),
(98, 1, 'Migration module: banner Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:15:16', 0),
(99, 1, 'Migrate Type: banner_ Uninstalled Version: 0 from: 127.0.0.1', 'migrations', '2015-06-01 06:15:49', 0),
(100, 1, 'Migration module: banner Version: 0 from: 127.0.0.1', 'migrations', '2015-06-01 06:15:49', 0),
(101, 1, 'Migrate Type: banner_ to Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:15:54', 0),
(102, 1, 'Migration module: banner Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:15:54', 0),
(103, 1, 'Migrate Type: banner_ to Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:15:58', 0),
(104, 1, 'Migration module: banner Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:15:58', 0),
(105, 1, 'Migrate Type: social_media_ to Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:44:21', 0),
(106, 1, 'Migration module: social_media Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:44:21', 0),
(107, 1, 'Migrate Type: social_media_ to Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:44:26', 0),
(108, 1, 'Migration module: social_media Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:44:26', 0),
(109, 1, 'Migrate Type: social_media_ Uninstalled Version: 0 from: 127.0.0.1', 'migrations', '2015-06-01 06:45:53', 0),
(110, 1, 'Migration module: social_media Version: 0 from: 127.0.0.1', 'migrations', '2015-06-01 06:45:53', 0),
(111, 1, 'Migrate Type: social_media_ to Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:46:18', 0),
(112, 1, 'Migration module: social_media Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 06:46:18', 0),
(113, 1, 'Migrate Type: social_media_ to Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:46:25', 0),
(114, 1, 'Migration module: social_media Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 06:46:25', 0),
(115, 1, 'Migrate Type: social_media_ to Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 07:09:00', 0),
(116, 1, 'Migration module: social_media Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 07:09:00', 0),
(117, 1, 'Created record with ID: 2 : 127.0.0.1', 'banner', '2015-06-01 07:19:05', 0),
(118, 1, 'Created record with ID: 3 : 127.0.0.1', 'banner', '2015-06-01 07:19:16', 0),
(119, 1, 'Created record with ID: 4 : 127.0.0.1', 'banner', '2015-06-01 07:19:23', 0),
(120, 1, 'Created record with ID: 1 : 127.0.0.1', 'social_media', '2015-06-01 07:28:35', 0),
(121, 1, 'Updated record with ID: 1 : 127.0.0.1', 'menu', '2015-06-01 07:46:15', 0),
(122, 1, 'Updated record with ID: 1 : 127.0.0.1', 'menu', '2015-06-01 07:46:25', 0),
(123, 1, 'Migrate Type: newsletter_ to Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 09:16:35', 0),
(124, 1, 'Migration module: newsletter Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 09:16:35', 0),
(125, 1, 'Migrate Type: newsletter_ to Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 09:16:42', 0),
(126, 1, 'Migration module: newsletter Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 09:16:43', 0),
(127, 1, 'Migrate Type: newsletter_ Uninstalled Version: 0 from: 127.0.0.1', 'migrations', '2015-06-01 09:25:47', 0),
(128, 1, 'Migration module: newsletter Version: 0 from: 127.0.0.1', 'migrations', '2015-06-01 09:25:47', 0),
(129, 1, 'Migrate Type: newsletter_ to Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 09:25:57', 0),
(130, 1, 'Migration module: newsletter Version: 1 from: 127.0.0.1', 'migrations', '2015-06-01 09:25:57', 0),
(131, 1, 'Migrate Type: newsletter_ to Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 09:26:03', 0),
(132, 1, 'Migration module: newsletter Version: 2 from: 127.0.0.1', 'migrations', '2015-06-01 09:26:03', 0),
(133, 1, 'Created record with ID: 16 : 127.0.0.1', 'newsletter', '2015-06-01 10:30:53', 0),
(134, 2, 'logged in from: 127.0.0.1', 'users', '2015-06-01 12:46:12', 0),
(135, 2, 'logged in from: 127.0.0.1', 'users', '2015-06-01 12:50:16', 0),
(136, 2, 'logged in from: 127.0.0.1', 'users', '2015-06-01 12:50:17', 0),
(137, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-01 13:27:41', 0),
(138, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-02 04:03:58', 0),
(139, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-02 04:04:18', 0),
(140, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-02 04:14:26', 0),
(141, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-02 04:53:31', 0),
(142, 1, 'Created record with ID: 5 : 127.0.0.1', 'banner', '2015-06-02 05:43:31', 0),
(143, 1, 'Updated record with ID: 1 : 127.0.0.1', 'banner', '2015-06-02 05:56:27', 0),
(144, 1, 'Updated record with ID: 1 : 127.0.0.1', 'category', '2015-06-02 06:15:47', 0),
(145, 1, 'Updated record with ID: 1 : 127.0.0.1', 'category', '2015-06-02 06:18:09', 0),
(146, 1, 'Updated record with ID: 1 : 127.0.0.1', 'category', '2015-06-02 06:24:36', 0),
(147, 1, 'Created record with ID: 3 : 127.0.0.1', 'category', '2015-06-02 06:25:47', 0),
(148, 1, 'Updated record with ID: 1 : 127.0.0.1', 'category', '2015-06-02 06:34:39', 0),
(149, 1, 'Created Module: sac : 127.0.0.1', 'modulebuilder', '2015-06-02 08:42:24', 0),
(150, 1, 'Deleted Module: sac : 127.0.0.1', 'builder', '2015-06-02 08:47:24', 0),
(151, 1, 'Created Module: sac : 127.0.0.1', 'modulebuilder', '2015-06-02 08:48:27', 0),
(152, 1, 'Deleted Module: sac : 127.0.0.1', 'builder', '2015-06-02 08:49:15', 0),
(153, 1, 'Created Module: uih : 127.0.0.1', 'modulebuilder', '2015-06-02 08:50:23', 0),
(154, 1, 'Deleted Module: uih : 127.0.0.1', 'builder', '2015-06-02 08:53:52', 0),
(155, 1, 'Created record with ID: 6 : 127.0.0.1', 'banner', '2015-06-02 09:00:13', 0),
(156, 1, 'Created record with ID: 7 : 127.0.0.1', 'banner', '2015-06-02 09:00:30', 0),
(157, 1, 'Created record with ID: 8 : 127.0.0.1', 'banner', '2015-06-02 09:00:30', 0),
(158, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-02 09:39:06', 0),
(159, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-02 09:40:57', 0),
(160, 1, 'Deleted Module: test : 127.0.0.1', 'builder', '2015-06-02 09:48:40', 0),
(161, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-02 09:51:03', 0),
(162, 1, 'Updated record with ID: 3 : 127.0.0.1', 'category', '2015-06-02 09:55:09', 0),
(163, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-02 09:59:41', 0),
(164, 1, 'Deleted Module: test : 127.0.0.1', 'builder', '2015-06-02 10:01:06', 0),
(165, 1, 'Created record with ID: 9 : 127.0.0.1', 'banner', '2015-06-02 13:01:13', 0),
(166, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 03:57:10', 0),
(167, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 04:15:33', 0),
(168, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 04:50:06', 0),
(169, 1, 'Created Module: dsfy : 127.0.0.1', 'modulebuilder', '2015-06-03 05:12:20', 0),
(170, 1, 'Created record with ID: 1 : 127.0.0.1', 'dsfy', '2015-06-03 05:13:00', 0),
(171, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 05:31:14', 0),
(172, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 05:31:23', 0),
(173, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 05:31:34', 0),
(174, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 05:32:20', 0),
(175, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 05:43:56', 0),
(176, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 05:49:01', 0),
(177, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 05:53:36', 0),
(178, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 06:08:23', 0),
(179, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:11:02', 0),
(180, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:13:20', 0),
(181, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:23:37', 0),
(182, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:24:59', 0),
(183, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:28:22', 0),
(184, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:30:24', 0),
(185, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:30:28', 0),
(186, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:31:36', 0),
(187, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:35:26', 0),
(188, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:45:13', 0),
(189, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:45:19', 0),
(190, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:45:24', 0),
(191, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:45:27', 0),
(192, 1, 'App settings saved from: 127.0.0.1', 'core', '2015-06-03 06:45:32', 0),
(193, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-03 07:06:11', 0),
(194, 1, 'Created record with ID: 1 : 127.0.0.1', 'test', '2015-06-03 07:06:27', 0),
(195, 1, 'Created record with ID: 2 : 127.0.0.1', 'test', '2015-06-03 07:06:28', 0),
(196, 1, 'Created record with ID: 3 : 127.0.0.1', 'test', '2015-06-03 07:06:34', 0),
(197, 1, 'Deleted Module: test : 127.0.0.1', 'builder', '2015-06-03 07:14:32', 0),
(198, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-03 07:24:33', 0),
(199, 1, 'Created record with ID: 1 : 127.0.0.1', 'test', '2015-06-03 07:25:16', 0),
(200, 1, 'Created record with ID: 2 : 127.0.0.1', 'test', '2015-06-03 07:26:05', 0),
(201, 1, 'Created record with ID: 3 : 127.0.0.1', 'test', '2015-06-03 07:28:30', 0),
(202, 1, 'Created record with ID: 4 : 127.0.0.1', 'test', '2015-06-03 07:28:30', 0),
(203, 1, 'Created record with ID: 5 : 127.0.0.1', 'test', '2015-06-03 07:32:28', 0),
(204, 1, 'Created record with ID: 6 : 127.0.0.1', 'test', '2015-06-03 07:32:42', 0),
(205, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 07:49:32', 0),
(206, 1, 'Deleted Module: test : 127.0.0.1', 'builder', '2015-06-03 07:51:47', 0),
(207, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 07:51:50', 0),
(208, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 07:52:27', 0),
(209, 1, 'Deleted Module: Refer_Friend : 127.0.0.1', 'builder', '2015-06-03 09:38:26', 0),
(210, 1, 'Created record with ID: 3 : 127.0.0.1', 'menu', '2015-06-03 09:45:43', 0),
(211, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-03 09:58:23', 0),
(212, 1, 'Created record with ID: 1 : 127.0.0.1', 'test', '2015-06-03 09:58:36', 0),
(213, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-03 09:59:51', 0),
(214, 1, 'Deleted Module: test : 127.0.0.1', 'builder', '2015-06-03 10:00:07', 0),
(215, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-03 10:01:07', 0),
(216, 1, 'Created record with ID: 1 : 127.0.0.1', 'test', '2015-06-03 10:01:19', 0),
(217, 1, 'Deleted Module: test : 127.0.0.1', 'builder', '2015-06-03 10:01:50', 0),
(218, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 10:01:48', 0),
(219, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 10:03:33', 0),
(220, 1, 'Deleted Module: dsfy : 127.0.0.1', 'builder', '2015-06-03 10:03:40', 0),
(221, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 10:59:44', 0),
(222, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 12:02:20', 0),
(223, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 12:05:40', 0),
(224, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-03 12:11:03', 0),
(225, 1, 'Created record with ID: 1 : 127.0.0.1', 'test', '2015-06-03 12:11:24', 0),
(226, 1, 'Created record with ID: 2 : 127.0.0.1', 'test', '2015-06-03 12:11:29', 0),
(227, 1, 'Deleted Module: test : 127.0.0.1', 'builder', '2015-06-03 12:12:25', 0),
(228, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-03 12:14:57', 0),
(229, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-03 12:15:50', 0),
(230, 1, 'Created record with ID: 1 : 127.0.0.1', 'test', '2015-06-03 12:16:18', 0),
(231, 1, 'Created Module: testtestestsest : 127.0.0.1', 'modulebuilder', '2015-06-03 12:16:40', 0),
(232, 1, 'Deleted Module: test : 127.0.0.1', 'builder', '2015-06-03 12:18:43', 0),
(233, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-04 04:30:41', 0),
(234, 1, 'Created Module: product : 127.0.0.1', 'modulebuilder', '2015-06-04 04:35:00', 0),
(235, 1, 'Deleted Module: product : 127.0.0.1', 'builder', '2015-06-04 04:35:30', 0),
(236, 1, 'Created Module: Product : 127.0.0.1', 'modulebuilder', '2015-06-04 04:40:39', 0),
(237, 1, 'Created record with ID: 1 : 127.0.0.1', 'product', '2015-06-04 04:41:13', 0),
(238, 1, 'Created record with ID: 2 : 127.0.0.1', 'product', '2015-06-04 04:41:26', 0),
(239, 1, 'Created record with ID: 3 : 127.0.0.1', 'product', '2015-06-04 04:41:39', 0),
(240, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-05 03:52:48', 0),
(241, 1, 'Created Module: cloth type : 127.0.0.1', 'modulebuilder', '2015-06-05 05:20:48', 0),
(242, 1, 'Created record with ID: 1 : 127.0.0.1', 'cloth_type', '2015-06-05 05:21:07', 0),
(243, 1, 'Deleted Module: cloth_type : 127.0.0.1', 'builder', '2015-06-05 05:22:16', 0),
(244, 1, 'Created Module: cloth : 127.0.0.1', 'modulebuilder', '2015-06-05 05:32:45', 0),
(245, 1, 'Created record with ID: 1 : 127.0.0.1', 'cloth', '2015-06-05 05:32:54', 0),
(246, 1, 'Created record with ID: 2 : 127.0.0.1', 'cloth', '2015-06-05 05:32:57', 0),
(247, 1, 'Created record with ID: 3 : 127.0.0.1', 'cloth', '2015-06-05 05:33:00', 0),
(248, 1, 'Deleted Module: cloth : 127.0.0.1', 'builder', '2015-06-05 05:43:25', 0),
(249, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-05 12:04:22', 0),
(250, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-05 12:09:40', 0),
(251, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-06 05:29:34', 0),
(252, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-06 11:26:07', 0),
(253, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-06 11:28:45', 0),
(254, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-08 09:12:19', 0),
(255, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-09 04:48:29', 0),
(256, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-09 12:59:52', 0),
(257, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-12 05:38:09', 0),
(258, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-12 05:39:42', 0),
(259, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-12 05:52:30', 0),
(260, 1, 'Created Module: f : 127.0.0.1', 'modulebuilder', '2015-06-12 05:59:06', 0),
(261, 1, 'Deleted Module: f : 127.0.0.1', 'builder', '2015-06-12 05:59:29', 0),
(262, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-12 10:42:04', 0),
(263, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-19 04:06:39', 0),
(264, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-19 04:49:51', 0),
(265, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-19 07:48:01', 0),
(266, 1, 'Created Module: test : 127.0.0.1', 'modulebuilder', '2015-06-19 07:50:48', 0),
(267, 1, 'Created record with ID: 1 : 127.0.0.1', 'test', '2015-06-19 07:51:26', 0),
(268, 1, 'Created record with ID: 2 : 127.0.0.1', 'test', '2015-06-19 07:51:58', 0),
(269, 1, 'Created record with ID: 3 : 127.0.0.1', 'test', '2015-06-19 08:14:24', 0),
(270, 1, 'Created record with ID: 10 : 127.0.0.1', 'banner', '2015-06-19 08:18:48', 0),
(271, 1, 'Updated record with ID: 10 : 127.0.0.1', 'banner', '2015-06-19 08:19:20', 0),
(272, 1, 'Created record with ID: 4 : 127.0.0.1', 'test', '2015-06-19 08:27:31', 0),
(273, 1, 'Created Module: facebook : 127.0.0.1', 'modulebuilder', '2015-06-19 08:36:03', 0),
(274, 1, 'Created record with ID: 1 : 127.0.0.1', 'facebook', '2015-06-19 08:53:47', 0),
(275, 1, 'Updated record with ID: 3 : 127.0.0.1', 'category', '2015-06-19 09:11:39', 0),
(276, 1, 'Updated record with ID: 3 : 127.0.0.1', 'category', '2015-06-19 09:12:34', 0),
(277, 1, 'Updated record with ID: 3 : 127.0.0.1', 'category', '2015-06-19 09:21:54', 0),
(278, 1, 'Updated record with ID: 3 : 127.0.0.1', 'category', '2015-06-19 09:29:38', 0),
(279, 1, 'Updated record with ID: 1 : 127.0.0.1', 'facebook', '2015-06-19 09:33:53', 0),
(280, 1, 'Created record with ID: 2 : 127.0.0.1', 'facebook', '2015-06-19 09:39:04', 0),
(281, 1, 'Created record with ID: 3 : 127.0.0.1', 'facebook', '2015-06-19 09:39:39', 0),
(282, 1, 'Created record with ID: 5 : 127.0.0.1', 'test', '2015-06-19 09:50:53', 0),
(283, 1, 'Created Module: sport : 127.0.0.1', 'modulebuilder', '2015-06-19 11:20:27', 0),
(284, 1, 'Deleted Module: sport : 127.0.0.1', 'builder', '2015-06-19 11:21:54', 0),
(285, 1, 'Created Module: sport : 127.0.0.1', 'modulebuilder', '2015-06-19 11:23:07', 0),
(286, 1, 'Created Module: sport : 127.0.0.1', 'modulebuilder', '2015-06-19 11:23:13', 0),
(287, 1, 'Created record with ID: 1 : 127.0.0.1', 'sport', '2015-06-19 11:23:27', 0),
(288, 1, 'logged in from: 127.0.0.1', 'users', '2015-06-23 08:19:18', 0),
(289, 1, 'logged in from: 127.0.0.1', 'users', '2015-11-10 03:18:28', 0),
(290, 1, 'modified user: Super Admin', 'users', '2015-11-10 03:49:29', 0),
(291, 1, 'logged in from: 127.0.0.1', 'users', '2015-11-10 03:50:38', 0),
(292, 1, 'modified user: Admin', 'users', '2015-11-10 03:53:21', 0),
(293, 2, 'logged in from: ::1', 'users', '2015-12-02 04:42:26', 0),
(294, 2, 'logged in from: ::1', 'users', '2015-12-02 06:05:20', 0),
(295, 2, 'Created record with ID: 11 : ::1', 'banner', '2015-12-02 06:06:35', 0),
(296, 2, 'logged in from: ::1', 'users', '2015-12-02 06:15:37', 0),
(297, 2, 'FIXME ("bf_common_act_create_record"): 2 : ::1', 'pages', '2015-12-02 06:19:10', 0),
(298, 2, 'logged in from: ::1', 'users', '2015-12-02 07:27:00', 0),
(299, 2, 'Created Module: test_bijal : ::1', 'modulebuilder', '2015-12-02 07:29:24', 0),
(300, 2, 'Created record with ID: 1 : ::1', 'test_bijal', '2015-12-02 07:29:53', 0),
(301, 2, 'Created record with ID: 2 : ::1', 'test_bijal', '2015-12-02 07:29:57', 0),
(302, 2, 'Migrate Type: test_bijal_ Uninstalled Version: 0 from: ::1', 'migrations', '2015-12-02 07:30:21', 0),
(303, 2, 'Migration module: test_bijal Version: 0 from: ::1', 'migrations', '2015-12-02 07:30:21', 0),
(304, 2, 'Deleted Module: test_bijal : ::1', 'builder', '2015-12-02 07:31:04', 0),
(305, 2, 'Migrate Type: user_master_ to Version: 1 from: ::1', 'migrations', '2015-12-11 07:47:15', 0),
(306, 2, 'Migration module: user_master Version: 1 from: ::1', 'migrations', '2015-12-11 07:47:15', 0),
(307, 2, 'logged in from: ::1', 'users', '2015-12-11 07:53:48', 0),
(308, 1, 'logged in from: ::1', 'users', '2015-12-11 08:03:42', 0),
(309, 1, 'logged in from: ::1', 'users', '2015-12-11 08:57:10', 0),
(310, 1, 'logged in from: ::1', 'users', '2016-01-22 10:53:14', 0),
(311, 1, 'logged in from: ::1', 'users', '2016-01-22 11:02:27', 0),
(312, 1, 'logged in from: ::1', 'users', '2016-01-22 11:03:03', 0),
(313, 1, 'logged in from: ::1', 'users', '2016-01-22 11:11:10', 0),
(314, 1, 'logged in from: ::1', 'users', '2016-01-22 11:11:22', 0),
(315, 2, 'logged in from: ::1', 'users', '2016-03-16 12:35:05', 0),
(316, 2, 'logged in from: ::1', 'users', '2016-04-28 12:08:51', 0),
(317, 2, 'Created Module: BRCategory : ::1', 'modulebuilder', '2016-04-28 12:17:38', 0),
(318, 2, 'Deleted Module: BRCategory : ::1', 'builder', '2016-04-28 12:18:16', 0),
(319, 2, 'Created Module: Category_BR : ::1', 'modulebuilder', '2016-04-28 12:21:42', 0),
(320, 2, 'Created record with ID: 1 : ::1', 'category_br', '2016-04-28 12:23:55', 0),
(321, 2, 'Deleted Module: Category_BR : ::1', 'builder', '2016-04-28 12:31:53', 0),
(322, 2, 'Deleted Module: Category : ::1', 'builder', '2016-04-28 12:33:32', 0),
(323, 2, 'Created Module: Category : ::1', 'modulebuilder', '2016-04-28 12:34:54', 0),
(324, 2, 'Deleted Module: Category : ::1', 'builder', '2016-04-28 12:35:10', 0),
(325, 2, 'Created Module: Category : ::1', 'modulebuilder', '2016-04-28 12:36:12', 0),
(326, 2, 'Created record with ID: 1 : ::1', 'category', '2016-04-28 12:37:12', 0),
(327, 2, 'Updated record with ID: 1 : ::1', 'category', '2016-04-28 12:37:17', 0),
(328, 2, 'Created Module: Advertisement Banner : ::1', 'modulebuilder', '2016-04-28 12:43:37', 0),
(329, 2, 'Deleted Module: Category : ::1', 'builder', '2016-04-28 12:45:14', 0),
(330, 2, 'Deleted Module: Advertisement_Banner : ::1', 'builder', '2016-04-28 12:45:17', 0),
(331, 2, 'logged in from: ::1', 'users', '2016-05-05 09:33:30', 0),
(332, 1, 'logged in from: ::1', 'users', '2016-05-05 10:39:09', 0),
(333, 2, 'logged in from: ::1', 'users', '2016-05-05 10:46:13', 0),
(334, 2, 'logged in from: ::1', 'users', '2016-05-05 11:04:56', 0),
(335, 2, 'Migrate Type: country_master_ to Version: 1 from: ::1', 'migrations', '2016-05-05 11:05:12', 0),
(336, 2, 'Migration module: country_master Version: 1 from: ::1', 'migrations', '2016-05-05 11:05:12', 0),
(337, 2, 'Migrate Type: country_master_ Uninstalled Version: 0 from: ::1', 'migrations', '2016-05-05 11:06:05', 0),
(338, 2, 'Migration module: country_master Version: 0 from: ::1', 'migrations', '2016-05-05 11:06:06', 0),
(339, 2, 'Migrate Type: country_master_ to Version: 1 from: ::1', 'migrations', '2016-05-05 11:06:16', 0),
(340, 2, 'Migration module: country_master Version: 1 from: ::1', 'migrations', '2016-05-05 11:06:16', 0),
(341, 2, 'logged in from: ::1', 'users', '2016-05-05 11:08:38', 0),
(342, 1, 'logged in from: ::1', 'users', '2016-05-05 11:09:08', 0),
(343, 2, 'logged in from: ::1', 'users', '2016-05-05 11:10:09', 0),
(344, 2, 'Created Module: Category Applicable Master : ::1', 'modulebuilder', '2016-05-05 11:19:44', 0),
(345, 2, 'Created Module: Category Regional Master : ::1', 'modulebuilder', '2016-05-05 11:31:49', 0),
(346, 2, 'Created Module: Category National Master : ::1', 'modulebuilder', '2016-05-05 12:00:20', 0),
(347, 2, 'Created Module: Customer Type Regional : ::1', 'modulebuilder', '2016-05-05 12:15:31', 0),
(348, 2, 'logged in from: ::1', 'users', '2016-05-09 07:13:03', 0),
(349, 2, 'logged in from: ::1', 'users', '2016-05-11 10:34:36', 0),
(350, 2, 'logged in from: ::1', 'users', '2016-05-12 04:50:34', 0),
(351, 2, 'logged in from: ::1', 'users', '2016-05-14 05:51:26', 0),
(352, 2, 'logged in from: ::1', 'users', '2016-05-15 06:18:31', 0),
(353, 2, 'created a new Head Officer: HO India', 'users', '2016-05-15 08:52:58', 0),
(354, 45, 'logged in from: ::1', 'users', '2016-05-15 09:20:06', 0),
(355, 2, 'logged in from: ::1', 'users', '2016-05-15 12:13:46', 0),
(356, 45, 'logged in from: ::1', 'users', '2016-05-16 05:21:12', 0),
(357, 45, 'logged in from: ::1', 'users', '2016-05-16 13:23:36', 0),
(358, 45, 'logged in from: ::1', 'users', '2016-05-16 16:03:10', 0),
(359, 45, 'logged in from: ::1', 'users', '2016-05-17 05:33:57', 0),
(360, 45, 'logged in from: ::1', 'users', '2016-05-17 12:55:29', 0),
(361, 45, 'logged in from: ::1', 'users', '2016-05-18 05:51:15', 0),
(362, 45, 'logged in from: ::1', 'users', '2016-05-18 06:21:13', 0),
(363, 45, 'logged in from: ::1', 'users', '2016-05-18 06:38:18', 0),
(364, 45, 'logged in from: ::1', 'users', '2016-05-18 10:34:07', 0),
(365, 45, 'logged in from: ::1', 'users', '2016-05-18 16:02:43', 0),
(366, 45, 'logged in from: ::1', 'users', '2016-05-18 14:30:29', 0),
(367, 45, 'logged in from: ::1', 'users', '2016-05-19 05:31:03', 0),
(368, 45, 'logged in from: ::1', 'users', '2016-05-19 08:25:49', 0),
(369, 45, 'logged in from: ::1', 'users', '2016-05-19 12:05:57', 0),
(370, 45, 'logged in from: ::1', 'users', '2016-05-20 06:51:31', 0),
(371, 9, 'logged in from: ::1', 'users', '2016-05-20 07:18:32', 0),
(372, 45, 'logged in from: ::1', 'users', '2016-05-20 05:25:28', 0),
(373, 45, 'logged in from: ::1', 'users', '2016-05-20 07:42:06', 0),
(374, 9, 'logged in from: ::1', 'users', '2016-05-20 07:43:01', 0),
(375, 9, 'logged in from: ::1', 'users', '2016-05-20 06:32:16', 0),
(376, 45, 'logged in from: ::1', 'users', '2016-05-20 08:44:04', 0),
(377, 45, 'logged in from: ::1', 'users', '2016-05-20 08:57:42', 0),
(378, 45, 'logged in from: ::1', 'users', '2016-05-20 08:58:03', 0),
(379, 45, 'logged in from: ::1', 'users', '2016-05-20 11:11:07', 0),
(380, 9, 'logged in from: ::1', 'users', '2016-05-20 11:18:04', 0),
(381, 45, 'logged in from: ::1', 'users', '2016-05-20 12:05:04', 0),
(382, 45, 'logged in from: ::1', 'users', '2016-05-20 12:06:23', 0),
(383, 19, 'logged in from: ::1', 'users', '2016-05-20 12:06:47', 0),
(384, 18, 'logged in from: ::1', 'users', '2016-05-20 12:13:30', 0),
(385, 19, 'logged in from: ::1', 'users', '2016-05-20 12:13:58', 0),
(386, 45, 'logged in from: ::1', 'users', '2016-05-20 13:59:12', 0),
(387, 20, 'logged in from: ::1', 'users', '2016-05-20 16:05:27', 0),
(388, 9, 'logged in from: ::1', 'users', '2016-05-20 14:48:11', 0),
(389, 20, 'logged in from: ::1', 'users', '2016-05-21 07:28:32', 0),
(390, 9, 'logged in from: ::1', 'users', '2016-05-23 05:28:42', 0),
(391, 20, 'logged in from: ::1', 'users', '2016-05-23 07:58:55', 0),
(392, 23, 'logged in from: ::1', 'users', '2016-05-23 07:49:14', 0),
(393, 20, 'logged in from: ::1', 'users', '2016-05-23 09:45:51', 0),
(394, 20, 'logged in from: ::1', 'users', '2016-05-23 14:58:08', 0),
(395, 9, 'logged in from: ::1', 'users', '2016-05-23 17:16:47', 0),
(396, 14, 'logged in from: ::1', 'users', '2016-05-23 17:17:51', 0),
(397, 14, 'logged in from: ::1', 'users', '2016-05-23 17:19:38', 0),
(398, 20, 'logged in from: ::1', 'users', '2016-05-24 05:17:31', 0),
(399, 12, 'logged in from: ::1', 'users', '2016-05-24 06:08:51', 0),
(400, 20, 'logged in from: ::1', 'users', '2016-05-24 06:45:43', 0),
(401, 12, 'logged in from: ::1', 'users', '2016-05-24 06:45:55', 0),
(402, 14, 'logged in from: ::1', 'users', '2016-05-24 07:00:11', 0),
(403, 20, 'logged in from: ::1', 'users', '2016-05-24 07:04:06', 0),
(404, 9, 'logged in from: ::1', 'users', '2016-05-24 07:06:41', 0),
(405, 20, 'logged in from: ::1', 'users', '2016-05-24 09:14:12', 0),
(406, 20, 'logged in from: ::1', 'users', '2016-05-24 07:29:34', 0),
(407, 14, 'logged in from: ::1', 'users', '2016-05-24 07:39:58', 0),
(408, 14, 'logged in from: ::1', 'users', '2016-05-24 07:46:43', 0),
(409, 20, 'logged in from: ::1', 'users', '2016-05-24 07:46:51', 0),
(410, 45, 'logged in from: ::1', 'users', '2016-05-24 09:16:09', 0),
(411, 9, 'logged in from: ::1', 'users', '2016-05-24 09:16:25', 0),
(412, 20, 'logged in from: ::1', 'users', '2016-05-24 10:14:36', 0),
(413, 45, 'logged in from: ::1', 'users', '2016-05-24 10:30:51', 0),
(414, 20, 'logged in from: ::1', 'users', '2016-05-24 10:31:29', 0),
(415, 20, 'logged in from: ::1', 'users', '2016-05-24 15:25:27', 0),
(416, 45, 'logged in from: ::1', 'users', '2016-05-24 16:45:07', 0),
(417, 45, 'logged in from: ::1', 'users', '2016-05-25 07:10:12', 0),
(418, 9, 'logged in from: ::1', 'users', '2016-05-25 10:00:08', 0),
(419, 14, 'logged in from: ::1', 'users', '2016-05-25 11:08:03', 0),
(420, 20, 'logged in from: ::1', 'users', '2016-05-25 11:11:50', 0),
(421, 9, 'logged in from: ::1', 'users', '2016-05-25 16:30:24', 0),
(422, 9, 'logged in from: ::1', 'users', '2016-05-25 16:56:27', 0),
(423, 45, 'logged in from: ::1', 'users', '2016-05-26 07:17:28', 0),
(424, 9, 'logged in from: ::1', 'users', '2016-05-26 07:30:39', 0),
(425, 20, 'logged in from: ::1', 'users', '2016-05-26 11:25:23', 0),
(426, 9, 'logged in from: ::1', 'users', '2016-05-26 11:35:21', 0),
(427, 9, 'logged in from: ::1', 'users', '2016-05-26 11:38:59', 0),
(428, 14, 'logged in from: ::1', 'users', '2016-05-26 12:16:43', 0),
(429, 9, 'logged in from: ::1', 'users', '2016-05-26 12:51:33', 0),
(430, 20, 'logged in from: ::1', 'users', '2016-05-26 13:12:38', 0),
(431, 4, 'logged in from: ::1', 'users', '2016-05-26 13:16:40', 0),
(432, 20, 'logged in from: ::1', 'users', '2016-05-26 13:17:36', 0),
(433, 14, 'logged in from: ::1', 'users', '2016-05-26 13:19:01', 0),
(434, 19, 'logged in from: ::1', 'users', '2016-05-26 13:19:43', 0),
(435, 9, 'logged in from: ::1', 'users', '2016-05-26 13:24:54', 0),
(436, 14, 'logged in from: ::1', 'users', '2016-05-26 13:52:25', 0),
(437, 45, 'logged in from: ::1', 'users', '2016-05-26 14:06:07', 0),
(438, 45, 'logged in from: ::1', 'users', '2016-05-27 07:06:55', 0),
(439, 20, 'logged in from: ::1', 'users', '2016-05-27 08:30:34', 0),
(440, 9, 'logged in from: ::1', 'users', '2016-05-27 13:47:46', 0),
(441, 14, 'logged in from: ::1', 'users', '2016-05-27 14:57:24', 0),
(442, 45, 'logged in from: ::1', 'users', '2016-05-27 15:52:20', 0),
(443, 45, 'logged in from: ::1', 'users', '2016-05-28 07:33:30', 0),
(444, 20, 'logged in from: ::1', 'users', '2016-05-28 12:30:05', 0),
(445, 9, 'logged in from: ::1', 'users', '2016-05-28 12:34:50', 0),
(446, 14, 'logged in from: ::1', 'users', '2016-05-28 12:41:36', 0),
(447, 45, 'logged in from: ::1', 'users', '2016-05-28 12:42:23', 0),
(448, 9, 'logged in from: ::1', 'users', '2016-05-28 12:55:17', 0),
(449, 9, 'logged in from: ::1', 'users', '2016-05-28 13:40:37', 0),
(450, 9, 'logged in from: ::1', 'users', '2016-05-28 16:51:01', 0),
(451, 9, 'logged in from: ::1', 'users', '2016-05-30 07:28:29', 0),
(452, 20, 'logged in from: ::1', 'users', '2016-05-30 05:32:02', 0),
(453, 45, 'logged in from: ::1', 'users', '2016-05-30 05:33:52', 0),
(454, 9, 'logged in from: ::1', 'users', '2016-05-30 05:42:32', 0),
(455, 20, 'logged in from: ::1', 'users', '2016-05-30 05:45:58', 0),
(456, 9, 'logged in from: ::1', 'users', '2016-05-30 05:49:58', 0),
(457, 20, 'logged in from: ::1', 'users', '2016-05-30 06:04:17', 0),
(458, 45, 'logged in from: ::1', 'users', '2016-05-30 09:56:24', 0),
(459, 45, 'logged in from: ::1', 'users', '2016-05-30 09:43:46', 0),
(460, 20, 'logged in from: 127.0.0.1', 'users', '2016-05-30 10:29:50', 0),
(461, 45, 'logged in from: ::1', 'users', '2016-05-30 10:30:00', 0),
(462, 45, 'logged in from: ::1', 'users', '2016-05-30 13:49:06', 0),
(463, 45, 'logged in from: ::1', 'users', '2016-05-30 13:33:09', 0),
(464, 9, 'logged in from: ::1', 'users', '2016-05-30 14:02:56', 0),
(465, 45, 'logged in from: ::1', 'users', '2016-05-30 14:17:42', 0),
(466, 20, 'logged in from: ::1', 'users', '2016-05-30 14:18:05', 0),
(467, 45, 'logged in from: ::1', 'users', '2016-05-30 16:30:34', 0),
(468, 45, 'logged in from: ::1', 'users', '2016-05-30 14:32:07', 0),
(469, 20, 'logged in from: ::1', 'users', '2016-05-31 05:19:37', 0),
(470, 45, 'logged in from: ::1', 'users', '2016-05-31 05:45:58', 0),
(471, 45, 'logged in from: ::1', 'users', '2016-05-31 08:06:37', 0),
(472, 20, 'logged in from: ::1', 'users', '2016-05-31 07:00:51', 0),
(473, 20, 'logged in from: ::1', 'users', '2016-05-31 07:34:22', 0),
(474, 45, 'logged in from: ::1', 'users', '2016-05-31 07:36:11', 0),
(475, 20, 'logged in from: ::1', 'users', '2016-05-31 07:41:50', 0),
(476, 9, 'logged in from: ::1', 'users', '2016-05-31 09:45:03', 0),
(477, 20, 'logged in from: ::1', 'users', '2016-05-31 09:21:50', 0),
(478, 45, 'logged in from: ::1', 'users', '2016-05-31 10:55:48', 0),
(479, 20, 'logged in from: ::1', 'users', '2016-05-31 11:20:25', 0),
(480, 45, 'logged in from: ::1', 'users', '2016-05-31 12:03:07', 0),
(481, 9, 'logged in from: ::1', 'users', '2016-05-31 14:10:43', 0),
(482, 14, 'logged in from: ::1', 'users', '2016-05-31 17:20:11', 0),
(483, 45, 'logged in from: ::1', 'users', '2016-06-01 08:12:51', 0),
(484, 45, 'logged in from: ::1', 'users', '2016-06-01 06:57:23', 0),
(485, 45, 'logged in from: ::1', 'users', '2016-06-02 07:16:38', 0),
(486, 45, 'logged in from: ::1', 'users', '2016-06-02 05:22:14', 0),
(487, 9, 'logged in from: ::1', 'users', '2016-06-02 09:50:13', 0),
(488, 45, 'logged in from: ::1', 'users', '2016-06-02 10:11:59', 0),
(489, 9, 'logged in from: ::1', 'users', '2016-06-02 12:24:16', 0),
(490, 45, 'logged in from: ::1', 'users', '2016-06-02 12:26:30', 0),
(491, 45, 'logged in from: ::1', 'users', '2016-06-02 11:06:34', 0),
(492, 45, 'logged in from: ::1', 'users', '2016-06-02 11:07:33', 0),
(493, 20, 'logged in from: ::1', 'users', '2016-06-02 14:37:36', 0),
(494, 45, 'logged in from: ::1', 'users', '2016-06-02 15:32:06', 0),
(495, 20, 'logged in from: ::1', 'users', '2016-06-02 15:33:54', 0),
(496, 45, 'logged in from: ::1', 'users', '2016-06-02 14:06:24', 0),
(497, 45, 'logged in from: ::1', 'users', '2016-06-02 17:29:33', 0),
(498, 20, 'logged in from: ::1', 'users', '2016-06-02 17:30:12', 0),
(499, 45, 'logged in from: ::1', 'users', '2016-06-02 17:32:36', 0),
(500, 20, 'logged in from: ::1', 'users', '2016-06-02 17:35:20', 0),
(501, 45, 'logged in from: ::1', 'users', '2016-06-02 18:08:29', 0),
(502, 20, 'logged in from: ::1', 'users', '2016-06-02 18:09:02', 0),
(503, 45, 'logged in from: ::1', 'users', '2016-06-03 05:12:38', 0),
(504, 45, 'logged in from: ::1', 'users', '2016-06-03 07:13:29', 0),
(505, 20, 'logged in from: ::1', 'users', '2016-06-03 07:22:09', 0),
(506, 45, 'logged in from: ::1', 'users', '2016-06-03 05:46:27', 0),
(507, 45, 'logged in from: ::1', 'users', '2016-06-03 05:47:03', 0),
(508, 9, 'logged in from: ::1', 'users', '2016-06-03 05:47:19', 0),
(509, 9, 'logged in from: ::1', 'users', '2016-06-03 06:38:11', 0),
(510, 14, 'logged in from: ::1', 'users', '2016-06-03 06:41:55', 0),
(511, 9, 'logged in from: ::1', 'users', '2016-06-03 06:43:38', 0),
(512, 14, 'logged in from: ::1', 'users', '2016-06-03 07:16:15', 0),
(513, 20, 'logged in from: ::1', 'users', '2016-06-03 07:17:39', 0),
(514, 45, 'logged in from: ::1', 'users', '2016-06-03 07:21:18', 0),
(515, 9, 'logged in from: ::1', 'users', '2016-06-03 07:31:22', 0),
(516, 45, 'logged in from: ::1', 'users', '2016-06-03 07:43:02', 0),
(517, 9, 'logged in from: ::1', 'users', '2016-06-03 07:43:23', 0),
(518, 14, 'logged in from: ::1', 'users', '2016-06-03 07:44:41', 0),
(519, 9, 'logged in from: ::1', 'users', '2016-06-03 13:52:03', 0),
(520, 45, 'logged in from: ::1', 'users', '2016-06-03 11:55:33', 0),
(521, 45, 'logged in from: ::1', 'users', '2016-06-03 13:55:44', 0),
(522, 20, 'logged in from: ::1', 'users', '2016-06-03 13:56:07', 0),
(523, 9, 'logged in from: ::1', 'users', '2016-06-03 11:56:25', 0),
(524, 14, 'logged in from: ::1', 'users', '2016-06-03 11:57:16', 0),
(525, 20, 'logged in from: ::1', 'users', '2016-06-03 11:57:49', 0),
(526, 20, 'logged in from: ::1', 'users', '2016-06-03 12:01:26', 0),
(527, 45, 'logged in from: ::1', 'users', '2016-06-03 14:01:23', 0),
(528, 20, 'logged in from: ::1', 'users', '2016-06-03 14:01:46', 0),
(529, 9, 'logged in from: ::1', 'users', '2016-06-03 14:02:24', 0),
(530, 20, 'logged in from: ::1', 'users', '2016-06-03 12:06:00', 0),
(531, 45, 'logged in from: ::1', 'users', '2016-06-03 12:23:43', 0),
(532, 9, 'logged in from: ::1', 'users', '2016-06-03 12:24:37', 0),
(533, 20, 'logged in from: ::1', 'users', '2016-06-03 12:27:50', 0),
(534, 20, 'logged in from: ::1', 'users', '2016-06-03 12:40:20', 0),
(535, 45, 'logged in from: ::1', 'users', '2016-06-03 13:04:58', 0),
(536, 20, 'logged in from: ::1', 'users', '2016-06-03 13:38:43', 0),
(537, 45, 'logged in from: ::1', 'users', '2016-06-03 14:08:34', 0),
(538, 20, 'logged in from: ::1', 'users', '2016-06-03 14:32:46', 0),
(539, 14, 'logged in from: ::1', 'users', '2016-06-03 14:40:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bf_banner`
--

CREATE TABLE IF NOT EXISTS `bf_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `bf_banner`
--

INSERT INTO `bf_banner` (`id`, `description`, `image`, `status`, `position`) VALUES
(3, 'asdfasdfsd', 'beauty.jpg', 1, 3),
(4, 'sdafsdfsd', '455779790-security-guard-vor-frue-plads-wedding-march-guarding.jpg', 0, 4),
(6, 'test', 'blogpost1.jpg', 0, 5),
(7, 'test2', 'blogpost2.jpg', 1, 6),
(9, 'test3', 'blogpost5.jpg', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `bf_countries`
--

CREATE TABLE IF NOT EXISTS `bf_countries` (
  `counrty_id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL DEFAULT 'US',
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` varchar(10) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`counrty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=241 ;

--
-- Dumping data for table `bf_countries`
--

INSERT INTO `bf_countries` (`counrty_id`, `iso`, `name`, `printable_name`, `iso3`, `numcode`, `status`, `deleted`) VALUES
(1, 'AD', 'ANDORRA', 'Andorra', 'AND', '20', 0, 0),
(2, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', '784', 0, 0),
(3, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', '4', 0, 0),
(4, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', '28', 0, 0),
(5, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', '660', 0, 0),
(6, 'AL', 'ALBANIA', 'Albania', 'ALB', '8', 0, 0),
(7, 'AM', 'ARMENIA', 'Armenia', 'ARM', '51', 0, 0),
(8, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', '530', 0, 0),
(9, 'AO', 'ANGOLA', 'Angola', 'AGO', '24', 0, 0),
(10, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0, 0),
(11, 'AR', 'ARGENTINA', 'Argentina', 'ARG', '32', 0, 0),
(12, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', '16', 0, 0),
(13, 'AT', 'AUSTRIA', 'Austria', 'AUT', '40', 0, 0),
(14, 'AU', 'AUSTRALIA', 'Australia', 'AUS', '36', 0, 0),
(15, 'AW', 'ARUBA', 'Aruba', 'ABW', '533', 0, 0),
(16, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', '31', 0, 0),
(17, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', '70', 0, 0),
(18, 'BB', 'BARBADOS', 'Barbados', 'BRB', '52', 0, 0),
(19, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', '50', 0, 0),
(20, 'BE', 'BELGIUM', 'Belgium', 'BEL', '56', 0, 0),
(21, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', '854', 0, 0),
(22, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', '100', 0, 0),
(23, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', '48', 0, 0),
(24, 'BI', 'BURUNDI', 'Burundi', 'BDI', '108', 0, 0),
(25, 'BJ', 'BENIN', 'Benin', 'BEN', '204', 0, 0),
(26, 'BM', 'BERMUDA', 'Bermuda', 'BMU', '60', 0, 0),
(27, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', '96', 0, 0),
(28, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', '68', 0, 0),
(29, 'BR', 'BRAZIL', 'Brazil', 'BRA', '76', 0, 0),
(30, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', '44', 0, 0),
(31, 'BT', 'BHUTAN', 'Bhutan', 'BTN', '64', 0, 0),
(32, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0, 0),
(33, 'BW', 'BOTSWANA', 'Botswana', 'BWA', '72', 0, 0),
(34, 'BY', 'BELARUS', 'Belarus', 'BLR', '112', 0, 0),
(35, 'BZ', 'BELIZE', 'Belize', 'BLZ', '84', 0, 0),
(36, 'CA', 'CANADA', 'Canada', 'CAN', '124', 0, 0),
(37, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 0, 0),
(38, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', '180', 0, 0),
(39, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', '140', 0, 0),
(40, 'CG', 'CONGO', 'Congo', 'COG', '178', 0, 0),
(41, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', '756', 0, 0),
(42, 'CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', '384', 0, 0),
(43, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', '184', 0, 0),
(44, 'CL', 'CHILE', 'Chile', 'CHL', '152', 0, 0),
(45, 'CM', 'CAMEROON', 'Cameroon', 'CMR', '120', 0, 0),
(46, 'CN', 'CHINA', 'China', 'CHN', '156', 0, 0),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', '170', 0, 0),
(48, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', '188', 0, 0),
(49, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 0, 0),
(50, 'CU', 'CUBA', 'Cuba', 'CUB', '192', 0, 0),
(51, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', '132', 0, 0),
(52, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 0, 0),
(53, 'CY', 'CYPRUS', 'Cyprus', 'CYP', '196', 0, 0),
(54, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', '203', 0, 0),
(55, 'DE', 'GERMANY', 'Germany', 'DEU', '276', 0, 0),
(56, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', '262', 0, 0),
(57, 'DK', 'DENMARK', 'Denmark', 'DNK', '208', 0, 0),
(58, 'DM', 'DOMINICA', 'Dominica', 'DMA', '212', 0, 0),
(59, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', '214', 0, 0),
(60, 'DZ', 'ALGERIA', 'Algeria', 'DZA', '12', 0, 0),
(61, 'EC', 'ECUADOR', 'Ecuador', 'ECU', '218', 0, 0),
(62, 'EE', 'ESTONIA', 'Estonia', 'EST', '233', 0, 0),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', '818', 0, 0),
(64, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', '732', 0, 0),
(65, 'ER', 'ERITREA', 'Eritrea', 'ERI', '232', 0, 0),
(66, 'ES', 'SPAIN', 'Spain', 'ESP', '724', 0, 0),
(67, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', '231', 0, 0),
(68, 'FI', 'FINLAND', 'Finland', 'FIN', '246', 0, 0),
(69, 'FJ', 'FIJI', 'Fiji', 'FJI', '242', 0, 0),
(70, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', '238', 0, 0),
(71, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', '583', 0, 0),
(72, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', '234', 0, 0),
(73, 'FR', 'FRANCE', 'France', 'FRA', '250', 0, 0),
(74, 'GA', 'GABON', 'Gabon', 'GAB', '266', 0, 0),
(75, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', '826', 0, 0),
(76, 'GD', 'GRENADA', 'Grenada', 'GRD', '308', 0, 0),
(77, 'GE', 'GEORGIA', 'Georgia', 'GEO', '268', 0, 0),
(78, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', '254', 0, 0),
(79, 'GH', 'GHANA', 'Ghana', 'GHA', '288', 0, 0),
(80, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', '292', 0, 0),
(81, 'GL', 'GREENLAND', 'Greenland', 'GRL', '304', 0, 0),
(82, 'GM', 'GAMBIA', 'Gambia', 'GMB', '270', 0, 0),
(83, 'GN', 'GUINEA', 'Guinea', 'GIN', '324', 0, 0),
(84, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', '312', 0, 0),
(85, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', '226', 0, 0),
(86, 'GR', 'GREECE', 'Greece', 'GRC', '300', 0, 0),
(87, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0, 0),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', '320', 0, 0),
(89, 'GU', 'GUAM', 'Guam', 'GUM', '316', 0, 0),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', '624', 0, 0),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', '328', 0, 0),
(92, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', '344', 0, 0),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0, 0),
(94, 'HN', 'HONDURAS', 'Honduras', 'HND', '340', 0, 0),
(95, 'HR', 'CROATIA', 'Croatia', 'HRV', '191', 0, 0),
(96, 'HT', 'HAITI', 'Haiti', 'HTI', '332', 0, 0),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', '348', 0, 0),
(98, 'ID', 'INDONESIA', 'Indonesia', 'IDN', '360', 1, 0),
(99, 'IE', 'IRELAND', 'Ireland', 'IRL', '372', 0, 0),
(100, 'IL', 'ISRAEL', 'Israel', 'ISR', '376', 0, 0),
(101, 'IN', 'INDIA', 'India', 'IND', '356', 1, 0),
(102, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 0, 0),
(103, 'IQ', 'IRAQ', 'Iraq', 'IRQ', '368', 0, 0),
(104, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', '364', 0, 0),
(105, 'IS', 'ICELAND', 'Iceland', 'ISL', '352', 0, 0),
(106, 'IT', 'ITALY', 'Italy', 'ITA', '380', 0, 0),
(107, 'JM', 'JAMAICA', 'Jamaica', 'JAM', '388', 0, 0),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', '400', 0, 0),
(109, 'JP', 'JAPAN', 'Japan', 'JPN', '392', 0, 0),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', '404', 0, 0),
(111, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', '417', 0, 0),
(112, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', '116', 0, 0),
(113, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', '296', 0, 0),
(114, 'KM', 'COMOROS', 'Comoros', 'COM', '174', 0, 0),
(115, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', '659', 0, 0),
(116, 'KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', '408', 0, 0),
(117, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', '410', 0, 0),
(118, 'KW', 'KUWAIT', 'Kuwait', 'KWT', '414', 0, 0),
(119, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', '136', 0, 0),
(120, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', '398', 0, 0),
(121, 'LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', '418', 0, 0),
(122, 'LB', 'LEBANON', 'Lebanon', 'LBN', '422', 0, 0),
(123, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', '662', 0, 0),
(124, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', '438', 0, 0),
(125, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', '144', 0, 0),
(126, 'LR', 'LIBERIA', 'Liberia', 'LBR', '430', 0, 0),
(127, 'LS', 'LESOTHO', 'Lesotho', 'LSO', '426', 0, 0),
(128, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', '440', 0, 0),
(129, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', '442', 0, 0),
(130, 'LV', 'LATVIA', 'Latvia', 'LVA', '428', 0, 0),
(131, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', '434', 0, 0),
(132, 'MA', 'MOROCCO', 'Morocco', 'MAR', '504', 0, 0),
(133, 'MC', 'MONACO', 'Monaco', 'MCO', '492', 0, 0),
(134, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', '498', 0, 0),
(135, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', '450', 0, 0),
(136, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', '584', 0, 0),
(137, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', '807', 0, 0),
(138, 'ML', 'MALI', 'Mali', 'MLI', '466', 0, 0),
(139, 'MM', 'MYANMAR', 'Myanmar', 'MMR', '104', 0, 0),
(140, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', '496', 0, 0),
(141, 'MO', 'MACAO', 'Macao', 'MAC', '446', 0, 0),
(142, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', '580', 0, 0),
(143, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', '474', 0, 0),
(144, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', '478', 0, 0),
(145, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', '500', 0, 0),
(146, 'MT', 'MALTA', 'Malta', 'MLT', '470', 0, 0),
(147, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', '480', 0, 0),
(148, 'MV', 'MALDIVES', 'Maldives', 'MDV', '462', 0, 0),
(149, 'MW', 'MALAWI', 'Malawi', 'MWI', '454', 0, 0),
(150, 'MX', 'MEXICO', 'Mexico', 'MEX', '484', 0, 0),
(151, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', '458', 1, 0),
(152, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', '508', 0, 0),
(153, 'NA', 'NAMIBIA', 'Namibia', 'NAM', '516', 0, 0),
(154, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', '540', 0, 0),
(155, 'NE', 'NIGER', 'Niger', 'NER', '562', 0, 0),
(156, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', '574', 0, 0),
(157, 'NG', 'NIGERIA', 'Nigeria', 'NGA', '566', 0, 0),
(158, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', '558', 0, 0),
(159, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', '528', 0, 0),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', '578', 0, 0),
(161, 'NP', 'NEPAL', 'Nepal', 'NPL', '524', 0, 0),
(162, 'NR', 'NAURU', 'Nauru', 'NRU', '520', 0, 0),
(163, 'NU', 'NIUE', 'Niue', 'NIU', '570', 0, 0),
(164, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', '554', 0, 0),
(165, 'OM', 'OMAN', 'Oman', 'OMN', '512', 0, 0),
(166, 'PA', 'PANAMA', 'Panama', 'PAN', '591', 0, 0),
(167, 'PE', 'PERU', 'Peru', 'PER', '604', 0, 0),
(168, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', '258', 0, 0),
(169, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', '598', 0, 0),
(170, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', '608', 1, 0),
(171, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', '586', 0, 0),
(172, 'PL', 'POLAND', 'Poland', 'POL', '616', 0, 0),
(173, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', '666', 0, 0),
(174, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', '612', 0, 0),
(175, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', '630', 0, 0),
(176, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 0, 0),
(177, 'PT', 'PORTUGAL', 'Portugal', 'PRT', '620', 0, 0),
(178, 'PW', 'PALAU', 'Palau', 'PLW', '585', 0, 0),
(179, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', '600', 0, 0),
(180, 'QA', 'QATAR', 'Qatar', 'QAT', '634', 0, 0),
(181, 'RE', 'REUNION', 'Reunion', 'REU', '638', 0, 0),
(182, 'RO', 'ROMANIA', 'Romania', 'ROM', '642', 0, 0),
(183, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', '643', 0, 0),
(184, 'RW', 'RWANDA', 'Rwanda', 'RWA', '646', 0, 0),
(185, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', '682', 0, 0),
(186, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', '90', 0, 0),
(187, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', '690', 0, 0),
(188, 'SD', 'SUDAN', 'Sudan', 'SDN', '736', 0, 0),
(189, 'SE', 'SWEDEN', 'Sweden', 'SWE', '752', 0, 0),
(190, 'SG', 'SINGAPORE', 'Singapore', 'SGP', '702', 1, 0),
(191, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', '654', 0, 0),
(192, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', '705', 0, 0),
(193, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', '744', 0, 0),
(194, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', '703', 0, 0),
(195, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', '694', 0, 0),
(196, 'SM', 'SAN MARINO', 'San Marino', 'SMR', '674', 0, 0),
(197, 'SN', 'SENEGAL', 'Senegal', 'SEN', '686', 0, 0),
(198, 'SO', 'SOMALIA', 'Somalia', 'SOM', '706', 0, 0),
(199, 'SR', 'SURINAME', 'Suriname', 'SUR', '740', 0, 0),
(200, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', '678', 0, 0),
(201, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', '222', 0, 0),
(202, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', '760', 0, 0),
(203, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', '748', 0, 0),
(204, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', '796', 0, 0),
(205, 'TD', 'CHAD', 'Chad', 'TCD', '148', 0, 0),
(206, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0, 0),
(207, 'TG', 'TOGO', 'Togo', 'TGO', '768', 0, 0),
(208, 'TH', 'THAILAND', 'Thailand', 'THA', '764', 1, 0),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', '762', 0, 0),
(210, 'TK', 'TOKELAU', 'Tokelau', 'TKL', '772', 0, 0),
(211, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 0, 0),
(212, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', '795', 0, 0),
(213, 'TN', 'TUNISIA', 'Tunisia', 'TUN', '788', 0, 0),
(214, 'TO', 'TONGA', 'Tonga', 'TON', '776', 0, 0),
(215, 'TR', 'TURKEY', 'Turkey', 'TUR', '792', 0, 0),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', '780', 0, 0),
(217, 'TV', 'TUVALU', 'Tuvalu', 'TUV', '798', 0, 0),
(218, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', '158', 0, 0),
(219, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', '834', 0, 0),
(220, 'UA', 'UKRAINE', 'Ukraine', 'UKR', '804', 0, 0),
(221, 'UG', 'UGANDA', 'Uganda', 'UGA', '800', 0, 0),
(222, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 0, 0),
(223, 'US', 'UNITED STATES', 'United States', 'USA', '840', 0, 0),
(224, 'UY', 'URUGUAY', 'Uruguay', 'URY', '858', 0, 0),
(225, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', '860', 0, 0),
(226, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', '336', 0, 0),
(227, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', '670', 0, 0),
(228, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', '862', 0, 0),
(229, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', '92', 0, 0),
(230, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', '850', 0, 0),
(231, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', '704', 1, 0),
(232, 'VU', 'VANUATU', 'Vanuatu', 'VUT', '548', 0, 0),
(233, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', '876', 0, 0),
(234, 'WS', 'SAMOA', 'Samoa', 'WSM', '882', 0, 0),
(235, 'YE', 'YEMEN', 'Yemen', 'YEM', '887', 0, 0),
(236, 'YT', 'MAYOTTE', 'Mayotte', '', '568', 0, 0),
(237, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', '710', 0, 0),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', '894', 0, 0),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', '716', 0, 0),
(240, 'vc', 'vbc', 'vb', NULL, '11', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bf_email_queue`
--

CREATE TABLE IF NOT EXISTS `bf_email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(254) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `alt_message` text,
  `max_attempts` int(11) NOT NULL DEFAULT '3',
  `attempts` int(11) NOT NULL DEFAULT '0',
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `csv_attachment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_email_template`
--

CREATE TABLE IF NOT EXISTS `bf_email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_facebook`
--

CREATE TABLE IF NOT EXISTS `bf_facebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(255) NOT NULL,
  `superadmin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bf_facebook`
--

INSERT INTO `bf_facebook` (`id`, `admin`, `superadmin`) VALUES
(1, '1', '1'),
(2, '1', '1'),
(3, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_company_current_stock`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_company_current_stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `intrum_quantity` decimal(9,2) DEFAULT NULL,
  `unrestricted_quantity` decimal(9,2) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `batch_exp_date` date DEFAULT NULL,
  `batch_mfg_date` date DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bf_ishop_company_current_stock`
--

INSERT INTO `bf_ishop_company_current_stock` (`stock_id`, `date`, `product_sku_id`, `intrum_quantity`, `unrestricted_quantity`, `batch`, `batch_exp_date`, `batch_mfg_date`, `country_id`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(1, '2016-06-01', 1, '123345.00', '111111.00', '123', '2016-06-27', '2016-06-20', 101, 45, 45, 1, '2016-05-31 15:03:49', '2016-06-01 07:37:10'),
(2, '2016-06-12', 2, '999.00', '999.00', 'qwe', '2016-06-27', '2016-06-30', 101, 45, 45, 1, '2016-06-01 07:16:28', '2016-06-01 07:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_company_current_stock_log`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_company_current_stock_log` (
  `current_stock_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `intransit_quantity` decimal(9,2) DEFAULT NULL,
  `unrestricted_quantity` decimal(9,2) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `batch_exp_date` date DEFAULT NULL,
  `batch_mfg_date` date DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`current_stock_log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bf_ishop_company_current_stock_log`
--

INSERT INTO `bf_ishop_company_current_stock_log` (`current_stock_log_id`, `stock_id`, `date`, `product_sku_id`, `intransit_quantity`, `unrestricted_quantity`, `batch`, `batch_exp_date`, `batch_mfg_date`, `country_id`, `created_by_user`, `modified_by_user`, `log_date`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, '2016-05-01', 1, '123.00', '123.00', '123', '2016-05-22', '2016-05-23', 101, 45, 0, '2016-05-31 15:03:49', 1, '2016-05-31 15:03:49', NULL),
(2, 1, '2016-05-01', 1, '123.00', '123.00', '123', '2016-05-22', '2016-05-23', 101, 45, 0, '2016-05-31 15:22:39', 1, '2016-05-31 15:22:39', NULL),
(3, 2, '2016-06-03', 2, '123345.00', '111111.00', 'sdf45', '2016-06-19', '2016-06-30', 101, 45, 0, '2016-06-01 07:16:28', 1, '2016-06-01 07:16:28', NULL),
(4, 2, '2016-06-12', 2, '999.00', '999.00', 'qwe', '2016-06-27', '2016-06-30', 101, 45, 0, '2016-06-01 07:18:30', 1, '2016-06-01 07:18:30', NULL),
(5, 1, '2016-06-01', 1, '123345.00', '111111.00', '123', '2016-06-27', '2016-06-20', 101, 45, 0, '2016-06-01 07:37:10', 1, '2016-06-01 07:37:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_credit_limit`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_credit_limit` (
  `credit_limit_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `credit_limit` decimal(9,2) DEFAULT NULL,
  `current_outstanding_limit` decimal(9,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`credit_limit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bf_ishop_credit_limit`
--

INSERT INTO `bf_ishop_credit_limit` (`credit_limit_id`, `customer_id`, `credit_limit`, `current_outstanding_limit`, `date`, `country_id`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(1, 9, '456.00', '456.00', '2016-06-27', 101, 45, 45, 1, '2016-06-01 10:20:02', '2016-06-01 10:31:58'),
(2, 11, '234.00', '768.00', '2016-06-26', 101, 45, 0, 1, '2016-06-01 12:03:40', NULL),
(3, 37, '1546.00', '89098.00', '2016-06-27', 101, 45, 0, 1, '2016-06-01 12:04:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_credit_limit_log`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_credit_limit_log` (
  `credit_limit_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `credit_limit_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `credit_limit` decimal(9,2) DEFAULT NULL,
  `current_outstanding_limit` decimal(9,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`credit_limit_log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bf_ishop_credit_limit_log`
--

INSERT INTO `bf_ishop_credit_limit_log` (`credit_limit_log_id`, `credit_limit_id`, `customer_id`, `credit_limit`, `current_outstanding_limit`, `date`, `country_id`, `created_by_user`, `modified_by_user`, `log_date`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 9, '123.00', '123.00', '2016-06-26', 101, 45, 0, '2016-06-01 10:20:02', 1, '2016-06-01 10:20:02', NULL),
(2, 1, 9, '456.00', '456.00', '2016-06-27', 101, 45, 0, '2016-06-01 10:31:58', 1, '2016-06-01 10:31:58', NULL),
(3, 2, 11, '234.00', '768.00', '2016-06-26', 101, 45, 0, '2016-06-01 12:03:40', 1, '2016-06-01 12:03:40', NULL),
(4, 3, 37, '1546.00', '89098.00', '2016-06-27', 101, 45, 0, '2016-06-01 12:04:02', 1, '2016-06-01 12:04:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_orders`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id_from` int(11) DEFAULT NULL,
  `customer_id_to` int(11) DEFAULT NULL,
  `order_taken_by_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `estimated_delivery_date` datetime DEFAULT NULL,
  `PO_no` varchar(255) DEFAULT NULL,
  `order_tracking_no` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice_date` datetime DEFAULT NULL,
  `order_status` tinyint(1) DEFAULT NULL,
  `order_recived_status` tinyint(1) DEFAULT NULL,
  `read_status` tinyint(1) DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `bf_ishop_orders`
--

INSERT INTO `bf_ishop_orders` (`order_id`, `customer_id_from`, `customer_id_to`, `order_taken_by_id`, `order_date`, `total_amount`, `estimated_delivery_date`, `PO_no`, `order_tracking_no`, `invoice_no`, `invoice_date`, `order_status`, `order_recived_status`, `read_status`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(1, 9, 0, 45, '2016-05-19', NULL, NULL, '6666', '583316', NULL, NULL, 0, NULL, 0, 45, NULL, 1, '2016-05-19 16:58:43', NULL),
(2, 19, 11, 45, '2016-05-19', NULL, NULL, NULL, '907152', NULL, NULL, 4, NULL, 0, 45, NULL, 1, '2016-05-19 16:59:51', NULL),
(4, 9, 0, 9, '2016-05-20', NULL, NULL, '111', '300509', NULL, NULL, 1, NULL, 0, 9, NULL, 1, '2016-05-20 08:42:11', NULL),
(5, 9, 0, 45, '2016-05-20', NULL, NULL, '4444', '743606', NULL, NULL, 3, NULL, 0, 45, NULL, 1, '2016-05-20 08:58:28', NULL),
(6, 9, 0, 45, '2016-05-20', NULL, NULL, '7777', '214982', NULL, NULL, 1, NULL, 0, 45, NULL, 1, '2016-05-20 09:07:13', NULL),
(9, 4, 19, 20, '2016-05-31', NULL, NULL, NULL, '248114', NULL, NULL, 0, NULL, 0, 20, NULL, 1, '2016-05-21 14:11:06', NULL),
(10, 4, 0, 20, '2014-09-09', NULL, NULL, NULL, '953604', NULL, NULL, 0, NULL, 0, 20, NULL, 1, '2016-05-24 09:19:32', NULL),
(11, 16, 10, 20, '1970-01-01', NULL, NULL, NULL, '484037', NULL, NULL, 0, NULL, 0, 20, NULL, 1, '2016-05-24 12:36:11', NULL),
(12, 10, 0, 20, '1970-01-01', NULL, NULL, NULL, '915082', NULL, NULL, 0, NULL, 0, 20, NULL, 1, '2016-05-24 12:37:16', NULL),
(13, 9, 0, 9, '2016-05-26', NULL, NULL, '22222', '880358', NULL, NULL, 0, NULL, 0, 9, NULL, 1, '2016-05-26 08:45:20', NULL),
(14, 14, 9, 20, '2016-05-25', NULL, NULL, '89889', '177999', NULL, NULL, 4, NULL, 1, 20, NULL, 1, '2016-05-26 11:32:53', NULL),
(15, 15, 9, 20, '2016-05-27', NULL, NULL, NULL, '493313', NULL, NULL, 4, NULL, 0, 20, NULL, 1, '2016-05-26 11:33:37', NULL),
(17, 4, 0, 20, '1970-01-01', NULL, NULL, NULL, '218676', NULL, NULL, 4, NULL, 0, 20, NULL, 1, '2016-05-26 13:14:57', NULL),
(18, 4, 0, 20, '1970-01-01', NULL, NULL, NULL, '723077', NULL, NULL, 4, NULL, 0, 20, NULL, 1, '2016-05-26 13:15:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_physical_stock`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_physical_stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_month` date DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `bf_ishop_physical_stock`
--

INSERT INTO `bf_ishop_physical_stock` (`stock_id`, `stock_month`, `product_sku_id`, `quantity`, `customer_id`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(1, '2016-05-01', 1, '12.00', 9, 9, NULL, 1, '2016-05-23 06:54:00', NULL),
(2, '2016-05-01', 1, '12.00', 9, 9, NULL, 1, '2016-05-23 06:54:00', NULL),
(3, '2016-05-01', 1, '12.00', 9, 9, NULL, 1, '2016-05-23 06:56:39', NULL),
(4, '2016-05-01', 1, '12.00', 9, 9, NULL, 1, '2016-05-23 06:56:39', NULL),
(5, '2016-05-01', 1, '12.00', 10, 20, NULL, 1, '2016-05-23 15:21:52', NULL),
(6, '2016-05-01', 1, '12.00', 10, 20, NULL, 1, '2016-05-23 15:21:52', NULL),
(7, '2016-05-01', 2, '1234.00', 10, 20, NULL, 1, '2016-05-23 15:21:52', NULL),
(8, '2016-05-01', 2, '1234.00', 10, 20, NULL, 1, '2016-05-23 15:21:52', NULL),
(9, '2016-05-01', 1, '11.00', 10, 20, NULL, 1, '2016-05-23 15:23:31', NULL),
(10, '2016-05-01', 1, '11.00', 10, 20, NULL, 1, '2016-05-23 15:23:31', NULL),
(11, '2016-05-01', 2, '22.00', 10, 20, NULL, 1, '2016-05-23 15:23:31', NULL),
(12, '2016-05-01', 2, '22.00', 10, 20, NULL, 1, '2016-05-23 15:23:31', NULL),
(13, '2016-05-01', 1, '5.00', 10, 20, NULL, 1, '2016-05-23 15:27:18', NULL),
(14, '2016-05-01', 1, '5.00', 10, 20, NULL, 1, '2016-05-23 15:27:18', NULL),
(15, '2016-05-01', 1, '6.00', 10, 20, NULL, 1, '2016-05-23 15:27:18', NULL),
(16, '2016-05-01', 1, '6.00', 10, 20, NULL, 1, '2016-05-23 15:27:18', NULL),
(17, '2016-05-01', 1, '5.00', 10, 20, NULL, 1, '2016-05-23 15:27:59', NULL),
(18, '2016-05-01', 1, '6.00', 10, 20, NULL, 1, '2016-05-23 15:27:59', NULL),
(19, '2016-05-01', 1, '5.00', 14, 20, NULL, 1, '2016-05-23 15:55:36', NULL),
(20, '2016-05-01', 1, '5.00', 14, 20, NULL, 1, '2016-05-23 15:55:36', NULL),
(21, '2016-05-01', 1, '6.00', 14, 20, NULL, 1, '2016-05-23 15:55:36', NULL),
(22, '2016-05-01', 1, '6.00', 14, 20, NULL, 1, '2016-05-23 15:55:37', NULL),
(26, '2016-05-01', 1, '45.00', 17, 20, NULL, 1, '2016-05-23 15:57:58', NULL),
(27, '2016-05-01', 1, '67.00', 17, 20, NULL, 1, '2016-05-23 15:58:53', NULL),
(28, '2016-05-01', 1, '67.00', 17, 20, NULL, 1, '2016-05-23 15:58:53', NULL),
(29, '2016-05-01', 1, '78.00', 17, 20, NULL, 1, '2016-05-23 15:58:53', NULL),
(30, '2016-05-01', 1, '78.00', 17, 20, NULL, 1, '2016-05-23 15:58:53', NULL),
(31, '2016-05-01', 1, '56.00', 17, 20, NULL, 1, '2016-05-23 16:02:07', NULL),
(32, '2016-05-01', 1, '87.00', 17, 20, NULL, 1, '2016-05-23 16:02:07', NULL),
(33, '2016-05-01', 1, '77.00', 18, 20, NULL, 1, '2016-05-23 16:03:12', NULL),
(34, '2016-05-01', 1, '77.00', 18, 20, NULL, 1, '2016-05-23 16:03:12', NULL),
(35, '2016-05-01', 1, '44.00', 18, 20, NULL, 1, '2016-05-23 16:03:12', NULL),
(36, '2016-05-01', 1, '44.00', 18, 20, NULL, 1, '2016-05-23 16:03:12', NULL),
(37, NULL, 1, '88.00', NULL, 20, NULL, 1, '2016-05-23 16:07:34', NULL),
(38, NULL, 1, '88.00', NULL, 20, NULL, 1, '2016-05-23 16:07:34', NULL),
(39, NULL, 1, '89.00', NULL, 20, NULL, 1, '2016-05-23 16:07:34', NULL),
(40, NULL, 1, '89.00', NULL, 20, NULL, 1, '2016-05-23 16:07:34', NULL),
(41, NULL, 1, '77.00', NULL, 20, NULL, 1, '2016-05-23 16:08:58', NULL),
(42, NULL, 1, '99.00', NULL, 20, NULL, 1, '2016-05-23 16:08:58', NULL),
(43, '2016-05-01', 1, '123.00', 12, 12, NULL, 1, '2016-05-24 06:54:46', NULL),
(44, '2016-05-01', 1, '999.00', 12, 12, NULL, 1, '2016-05-24 06:56:08', NULL),
(45, '2016-05-01', 2, '555.00', 12, 12, NULL, 1, '2016-05-24 06:56:09', NULL),
(46, '2016-05-01', 1, '123.00', 14, 14, NULL, 1, '2016-05-24 07:03:16', NULL),
(47, '2016-05-01', 2, '123456.00', 14, 14, NULL, 1, '2016-05-24 07:03:16', NULL),
(48, '2016-05-01', 1, '88.00', 18, 20, NULL, 1, '2016-05-24 07:04:25', NULL),
(49, '2016-05-01', 2, '44.00', 11, 20, NULL, 1, '2016-05-24 07:05:24', NULL),
(50, '2016-05-01', 1, '33.00', 11, 20, NULL, 1, '2016-05-24 07:05:24', NULL),
(51, '2016-05-01', 1, '12.00', 17, 20, NULL, 1, '2016-05-30 05:49:11', NULL),
(52, '2016-05-01', 1, '23.00', 10, 20, NULL, 1, '2016-05-30 05:49:39', NULL),
(53, '2016-05-01', 1, '12.00', 9, 9, NULL, 1, '2016-05-30 05:50:26', NULL),
(54, '2016-05-01', 1, '12.00', 16, 20, NULL, 1, '2016-05-30 09:36:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_primary_sales`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_primary_sales` (
  `primary_sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `PO_no` varchar(255) DEFAULT NULL,
  `order_tracking_no` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `invoice_recived_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`primary_sales_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `bf_ishop_primary_sales`
--

INSERT INTO `bf_ishop_primary_sales` (`primary_sales_id`, `customer_id`, `PO_no`, `order_tracking_no`, `invoice_no`, `invoice_date`, `total_amount`, `invoice_recived_status`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(1, 9, '123', '123', '123', '2016-05-16', NULL, 0, 1, NULL, 1, '2016-05-16 11:57:01', NULL),
(3, 9, '123', '123', '123', '2016-05-23', '33.00', 0, 1, NULL, 1, '2016-05-16 12:07:54', NULL),
(4, 10, '23432', '23432', '123', '2016-05-30', '87.00', 0, 45, NULL, 1, '2016-05-16 12:15:11', NULL),
(5, 11, 'kj', 'kj', 'qwe', '2016-05-15', '76.00', 0, 45, NULL, 1, '2016-05-16 14:36:12', NULL),
(6, 10, '323', '323', '32', '2016-05-23', '332.00', 0, 45, NULL, 1, '2016-05-20 09:07:39', NULL),
(7, 10, '323', '323', '32', '2016-05-23', '332.00', 0, 45, NULL, 1, '2016-05-20 09:07:39', NULL),
(8, 10, '53', '543', 'tre', '2016-05-23', '123.00', 0, 45, NULL, 1, '2016-05-20 14:40:55', NULL),
(9, 10, '53', '543', 'tre', '2016-05-23', '123.00', 0, 45, NULL, 1, '2016-05-20 14:40:55', NULL),
(10, 9, '32', '12', '11', '2016-05-31', '12.00', 0, 45, NULL, 1, '2016-05-31 06:50:21', NULL),
(11, 11, '123', '21', '12', '2016-05-29', '123.00', 0, 45, NULL, 1, '2016-05-31 06:53:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_primary_sales_product`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_primary_sales_product` (
  `primary_sales_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `primary_sales_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `dispatched_quantity` decimal(9,2) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`primary_sales_product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `bf_ishop_primary_sales_product`
--

INSERT INTO `bf_ishop_primary_sales_product` (`primary_sales_product_id`, `primary_sales_id`, `product_sku_id`, `quantity`, `dispatched_quantity`, `amount`) VALUES
(1, 1, 1, '123.00', '123.00', '123.00'),
(2, 1, 2, '32.00', '23.00', '655.00'),
(3, 2, 2, '3453.00', '4353.00', '345.00'),
(4, 3, 1, '231.00', '123.00', '11.00'),
(5, 3, 2, '123.00', '4356.00', '22.00'),
(6, 4, 2, '123.00', '123.00', '54.00'),
(7, 4, 2, '23.00', '43.00', '33.00'),
(8, 5, 2, '11.00', '67.00', '76.00'),
(9, 6, 2, '3.00', '3.00', '332.00'),
(10, 7, 2, '3.00', '3.00', '332.00'),
(11, 8, 2, '543.00', '60.00', '123.00'),
(12, 9, 1, '543.00', '100.00', '123.00'),
(13, 10, 1, '12.00', NULL, '12.00'),
(14, 11, 2, '12.00', '123.00', '123.00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_product_order`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_product_order` (
  `product_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_sku_id` int(11) NOT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `quantity_kg_ltr` decimal(9,2) DEFAULT NULL,
  `dispatched_quantity` decimal(9,2) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`product_order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `bf_ishop_product_order`
--

INSERT INTO `bf_ishop_product_order` (`product_order_id`, `order_id`, `product_sku_id`, `unit`, `quantity`, `quantity_kg_ltr`, `dispatched_quantity`, `amount`) VALUES
(1, 1, 1, 'packages', '4.00', '2.00', '6.00', '50.00'),
(2, 1, 1, 'packages', '5.00', '2.50', '4.00', '60.00'),
(4, 2, 1, 'box', '7.00', '14.00', NULL, NULL),
(5, 2, 1, 'packages', '8.00', '4.00', NULL, NULL),
(6, 2, 1, 'kg/ltr', '9.00', '9.00', NULL, NULL),
(8, 4, 1, 'box', '5.00', '10.00', NULL, NULL),
(9, 4, 1, 'packages', '6.00', '3.00', NULL, NULL),
(10, 4, 1, 'kg/ltr', '7.00', '7.00', NULL, NULL),
(11, 5, 1, 'box', '4.00', '8.00', '3.00', NULL),
(12, 5, 1, 'packages', '5.00', '2.50', '3.00', NULL),
(13, 6, 1, 'packages', '5.00', '2.50', NULL, NULL),
(17, 9, 1, 'box', '5.00', '10.00', NULL, NULL),
(18, 9, 1, 'packages', '5.00', '2.50', NULL, NULL),
(19, 10, 1, 'box', '4.00', '8.00', NULL, NULL),
(20, 10, 1, 'packages', '6.00', '3.00', NULL, NULL),
(21, 11, 1, 'packages', '5.00', '2.50', NULL, NULL),
(22, 11, 1, 'box', '7.00', '14.00', NULL, NULL),
(23, 12, 1, 'box', '88.00', '176.00', NULL, NULL),
(24, 12, 1, 'packages', '99.00', '49.50', NULL, NULL),
(25, 13, 1, 'packages', '5.00', '2.50', '4.00', '100.00'),
(26, 13, 1, 'packages', '5.00', '2.50', NULL, NULL),
(27, 13, 1, 'kg/ltr', '6.00', '6.00', NULL, NULL),
(28, 14, 1, 'box', '5.00', '3.00', '3.00', '200.00'),
(30, 15, 1, 'packages', '7.00', '3.50', NULL, NULL),
(31, 15, 1, 'box', '8.00', '16.00', NULL, NULL),
(34, 17, 1, 'box', '5.00', '10.00', NULL, NULL),
(35, 17, 1, 'packages', '6.00', '3.00', NULL, NULL),
(36, 18, 1, 'box', '7.00', '14.00', NULL, NULL),
(37, 18, 1, 'packages', '8.00', '4.00', NULL, NULL),
(38, 18, 1, 'kg/ltr', '8.00', '8.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_rol`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `units` varchar(20) DEFAULT NULL,
  `rol_quantity` decimal(9,2) DEFAULT NULL,
  `rol_quantity_Kg_Ltr` decimal(9,2) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `bf_ishop_rol`
--

INSERT INTO `bf_ishop_rol` (`rol_id`, `customer_id`, `product_sku_id`, `units`, `rol_quantity`, `rol_quantity_Kg_Ltr`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(1, 9, 1, 'box', '12.00', '24.00', 45, NULL, 1, '2016-05-19 15:16:12', NULL),
(2, 9, 1, 'packages', '12.00', '6.00', 45, NULL, 1, '2016-05-19 15:16:12', NULL),
(3, 9, 1, 'packages', '12.00', '6.00', 45, NULL, 1, '2016-05-19 15:17:49', NULL),
(4, 9, 1, 'box', '5.00', '10.00', 45, NULL, 1, '2016-05-19 15:21:19', NULL),
(5, 9, 1, 'packages', '5.00', '2.50', 45, NULL, 1, '2016-05-19 15:21:19', NULL),
(6, 9, 1, 'box', '5.00', '10.00', 45, NULL, 1, '2016-05-19 15:21:21', NULL),
(7, 9, 1, 'packages', '5.00', '2.50', 45, NULL, 1, '2016-05-19 15:21:21', NULL),
(8, 9, 1, 'box', '5.00', '10.00', 45, NULL, 1, '2016-05-19 15:21:21', NULL),
(9, 9, 1, 'packages', '5.00', '2.50', 45, NULL, 1, '2016-05-19 15:21:21', NULL),
(10, 9, 1, 'box', '5.00', '10.00', 45, NULL, 1, '2016-05-19 15:21:21', NULL),
(11, 9, 1, 'packages', '5.00', '2.50', 45, NULL, 1, '2016-05-19 15:21:21', NULL),
(12, 9, 1, 'box', '5.00', '10.00', 45, NULL, 1, '2016-05-19 15:21:21', NULL),
(13, 9, 1, 'packages', '5.00', '2.50', 45, NULL, 1, '2016-05-19 15:21:21', NULL),
(14, 9, 1, 'box', '5.00', '10.00', 45, NULL, 1, '2016-05-19 15:21:22', NULL),
(15, 9, 1, 'packages', '5.00', '2.50', 45, NULL, 1, '2016-05-19 15:21:22', NULL),
(16, 9, 1, 'box', '5.00', '10.00', 45, NULL, 1, '2016-05-19 15:21:22', NULL),
(17, 9, 1, 'packages', '5.00', '2.50', 45, NULL, 1, '2016-05-19 15:21:22', NULL),
(18, 9, 1, 'box', '5.00', '10.00', 45, NULL, 1, '2016-05-19 15:21:22', NULL),
(19, 9, 1, 'packages', '5.00', '2.50', 45, NULL, 1, '2016-05-19 15:21:22', NULL),
(20, 9, 1, 'box', '5.00', '10.00', 45, NULL, 1, '2016-05-19 15:21:22', NULL),
(21, 9, 1, 'packages', '5.00', '2.50', 45, NULL, 1, '2016-05-19 15:21:22', NULL),
(22, 9, 1, 'box', '7.00', '14.00', 45, NULL, 1, '2016-05-19 15:22:14', NULL),
(23, 9, 1, 'packages', '8.00', '4.00', 45, NULL, 1, '2016-05-19 15:22:14', NULL),
(24, 9, 1, 'box', '4.00', '8.00', 45, NULL, 1, '2016-05-19 15:24:53', NULL),
(25, 9, 1, 'box', '4.00', '8.00', 45, NULL, 1, '2016-05-19 15:31:29', NULL),
(26, 9, 1, 'box', '1234.00', '2468.00', 45, NULL, 1, '2016-05-20 14:46:47', NULL),
(27, 10, 1, 'box', '123.00', '246.00', 45, NULL, 1, '2016-05-30 12:24:17', NULL),
(28, 10, 1, 'packages', '11.00', '5.50', 45, NULL, 1, '2016-05-30 12:24:17', NULL),
(29, 19, 1, 'box', '12.00', '24.00', 45, NULL, 1, '2016-05-30 12:25:21', NULL),
(30, 19, 1, 'packages', '21.00', '10.50', 45, NULL, 1, '2016-05-30 12:25:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_scheme_allocation`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_scheme_allocation` (
  `allocation_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheme_id` int(11) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `slab_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `geo_id2` int(11) DEFAULT NULL,
  `geo_id1` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`allocation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bf_ishop_scheme_allocation`
--

INSERT INTO `bf_ishop_scheme_allocation` (`allocation_id`, `scheme_id`, `year`, `slab_id`, `customer_id`, `country_id`, `geo_id2`, `geo_id1`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(6, 2, '2016-01-01', 6, 16, 101, 1, 4, 45, NULL, 1, '2016-06-03 12:16:09', NULL),
(7, 2, '2016-01-01', 6, 14, 101, 1, 2, 45, NULL, 1, '2016-06-03 12:16:20', NULL),
(8, 1, '2016-01-01', 3, 14, 101, 20, 28, 45, NULL, 1, '2016-06-03 12:16:31', NULL),
(9, 3, '2016-01-01', 11, 18, 101, 20, 21, 45, NULL, 1, '2016-06-03 12:16:43', NULL),
(10, 0, '2016-01-01', 0, 0, 101, 0, 0, 45, NULL, 1, '2016-06-03 13:03:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_secondary_sales`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_secondary_sales` (
  `secondary_sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `etn_no` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `PO_no` varchar(255) DEFAULT NULL,
  `order_tracking_no` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `total_amount` decimal(9,2) DEFAULT NULL,
  `invoice_recived_status` tinyint(1) DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`secondary_sales_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bf_ishop_secondary_sales`
--

INSERT INTO `bf_ishop_secondary_sales` (`secondary_sales_id`, `etn_no`, `customer_id`, `PO_no`, `order_tracking_no`, `invoice_no`, `invoice_date`, `total_amount`, `invoice_recived_status`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(1, NULL, 14, '123', '123', '123', '2016-05-30', '23246.00', 0, 9, NULL, 1, '2016-05-20 10:40:44', NULL),
(2, NULL, 14, 'sda21', '345', '123', '2016-05-23', '123.00', 0, 9, NULL, 1, '2016-05-20 11:59:15', NULL),
(3, NULL, 17, '12312', '12121', '12', '2016-05-22', '122.00', 0, 12, NULL, 1, '2016-05-24 06:41:40', NULL),
(4, NULL, 17, '12312', '12121', '12', '2016-05-22', '122.00', 0, 12, NULL, 1, '2016-05-24 06:41:40', NULL),
(5, NULL, 17, '345', '123', '123', '2016-05-22', '12333.00', 0, 12, NULL, 1, '2016-05-24 06:44:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_secondary_sales_product`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_secondary_sales_product` (
  `secondary_sales_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `secondary_sales_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `dispatched_quantity` decimal(9,2) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`secondary_sales_product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bf_ishop_secondary_sales_product`
--

INSERT INTO `bf_ishop_secondary_sales_product` (`secondary_sales_product_id`, `secondary_sales_id`, `product_sku_id`, `quantity`, `dispatched_quantity`, `amount`) VALUES
(1, 1, 1, '123.00', '123.00', '123.00'),
(2, 1, 1, '123.00', '11.00', '23123.00'),
(3, 2, 1, '123.00', NULL, '123.00'),
(4, 3, 1, '12.00', NULL, '122.00'),
(5, 4, 1, '12.00', NULL, '122.00'),
(6, 5, 1, '123.00', NULL, '12333.00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_ishop_target`
--

CREATE TABLE IF NOT EXISTS `bf_ishop_target` (
  `ishop_target_id` int(11) NOT NULL AUTO_INCREMENT,
  `month_data` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `quantity` decimal(9,2) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`ishop_target_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bf_ishop_target`
--

INSERT INTO `bf_ishop_target` (`ishop_target_id`, `month_data`, `customer_id`, `product_sku_id`, `quantity`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(1, '2016-05-01', 9, 1, '5.00', NULL, NULL, 1, NULL, NULL),
(2, '2016-06-01', 9, 2, '7.00', NULL, NULL, 1, NULL, NULL),
(3, '2016-06-01', 11, 1, '8.00', NULL, NULL, 1, '2016-06-02 12:21:24', NULL),
(4, '2016-06-01', 9, 1, '6.00', 45, NULL, 1, '2016-06-02 02:01:37', NULL),
(5, '2016-06-01', 14, 1, '6.00', 45, NULL, 1, '2016-06-02 02:01:37', NULL),
(6, '2016-05-01', 18, 1, '8.00', 45, NULL, 1, '2016-06-02 02:04:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_login_attempts`
--

CREATE TABLE IF NOT EXISTS `bf_login_attempts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_assumptions`
--

CREATE TABLE IF NOT EXISTS `bf_master_assumptions` (
  `assumption_id` int(11) NOT NULL AUTO_INCREMENT,
  `assumption_group_name_id` int(11) DEFAULT NULL,
  `assumption_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`assumption_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `bf_master_assumptions`
--

INSERT INTO `bf_master_assumptions` (`assumption_id`, `assumption_group_name_id`, `assumption_name`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'Aliran Udara/Angin', 0, 0, 0, 1, NULL, NULL),
(2, 2, 'Areal tanaman- Berkurang', 0, 0, 0, 1, NULL, NULL),
(3, 2, 'Areal tanaman- Bertambah', 0, 0, 0, 1, NULL, NULL),
(4, 1, 'Banjir', 0, 0, 0, 1, NULL, NULL),
(5, 3, 'Bekerjasama dengan perusahaan benih', 0, 0, 0, 1, NULL, NULL),
(6, 1, 'Curah hujan', 0, 0, 0, 1, NULL, NULL),
(7, 3, 'Distribusi sampel demo', 0, 0, 0, 1, NULL, NULL),
(8, 3, 'Distribusi sampel gratis', 0, 0, 0, 1, NULL, NULL),
(9, 4, 'DO/DA/FDO', 0, 0, 0, 1, NULL, NULL),
(10, 2, 'Dosis penyemprotan', 0, 0, 0, 1, NULL, NULL),
(11, 5, 'Harga Komoditas-Rendah', 0, 0, 0, 1, NULL, NULL),
(12, 5, 'Harga Komoditas-Tinggi', 0, 0, 0, 1, NULL, NULL),
(13, 7, 'Harga Naik', 0, 0, 0, 1, NULL, NULL),
(14, 7, 'Harga turun', 0, 0, 0, 1, NULL, NULL),
(15, 3, 'Hari kegiatan lapangan', 0, 0, 0, 1, NULL, NULL),
(16, 2, 'Kejadian Penyakit-rendah', 0, 0, 0, 1, NULL, NULL),
(17, 2, 'Kejadian penyakit-tinggi', 0, 0, 0, 1, NULL, NULL),
(18, 1, 'Kelembaban', 0, 0, 0, 1, NULL, NULL),
(19, 3, 'Ketersediaan bahan baku', 0, 0, 0, 1, NULL, NULL),
(20, 1, 'Kondisi iklim-Menguntungkan', 0, 0, 0, 1, NULL, NULL),
(21, 1, 'Kondisi iklim-Merugikan', 0, 0, 0, 1, NULL, NULL),
(22, 3, 'Kontak Petani', 0, 0, 0, 1, NULL, NULL),
(23, 6, 'Masalah penumpukan barang', 0, 0, 0, 1, NULL, NULL),
(24, 3, 'MDA lainnya', 0, 0, 0, 1, NULL, NULL),
(25, 6, 'Mitra kerja baru', 0, 0, 0, 1, NULL, NULL),
(26, 6, 'Mitra Kerja lama', 0, 0, 0, 1, NULL, NULL),
(27, 1, 'Musim', 0, 0, 0, 1, NULL, NULL),
(28, 3, 'Pasar baru yang belum tersentuh', 0, 0, 0, 1, NULL, NULL),
(29, 3, 'Peluncuran Produk', 0, 0, 0, 1, NULL, NULL),
(30, 6, 'Pembayaran di muka/ DP', 0, 0, 0, 1, NULL, NULL),
(31, 3, 'Peningkatan Efisiensi', 0, 0, 0, 1, NULL, NULL),
(32, 2, 'Penjualan Crop', 0, 0, 0, 1, NULL, NULL),
(33, 6, 'Penjualan produk pesaing', 0, 0, 0, 1, NULL, NULL),
(34, 2, 'Penyemprotan mengurangi serangan hama/penyakit', 0, 0, 0, 1, NULL, NULL),
(35, 2, 'Penyemprotan pencegahan', 0, 0, 0, 1, NULL, NULL),
(36, 7, 'Persaingan harga', 0, 0, 0, 1, NULL, NULL),
(37, 6, 'Persaingan pengembangan pasar', 0, 0, 0, 1, NULL, NULL),
(38, 6, 'Persediaan tinggi', 0, 0, 0, 1, NULL, NULL),
(39, 2, 'Persiapan masa tanam', 0, 0, 0, 1, NULL, NULL),
(40, 6, 'Persiapan persiapan barang', 0, 0, 0, 1, NULL, NULL),
(41, 6, 'Persiapan Skim', 0, 0, 0, 1, NULL, NULL),
(42, 3, 'Pertemuan Petani', 0, 0, 0, 1, NULL, NULL),
(43, 8, 'Pertumbuhan pasar normal (YOY)', 0, 0, 0, 1, NULL, NULL),
(44, 3, 'Pod Days', 0, 0, 0, 1, NULL, NULL),
(45, 6, 'Produk Baru Kompetitor', 0, 0, 0, 1, NULL, NULL),
(46, 3, 'Program sukses', 0, 0, 0, 1, NULL, NULL),
(47, 3, 'Rekomendasi lembaga penelitian/universitas', 0, 0, 0, 1, NULL, NULL),
(48, 2, 'Rumput/gulma-rendah', 0, 0, 0, 1, NULL, NULL),
(49, 2, 'Rumput/gulma-Tinggi', 0, 0, 0, 1, NULL, NULL),
(50, 2, 'Serangan Hama', 0, 0, 0, 1, NULL, NULL),
(51, 2, 'Serangan hama-rendah', 0, 0, 0, 1, NULL, NULL),
(52, 2, 'Serangan hama-Tinggi', 0, 0, 0, 1, NULL, NULL),
(53, 5, 'Situasi ekspor', 0, 0, 0, 1, NULL, NULL),
(54, 6, 'Skim komersial', 0, 0, 0, 1, NULL, NULL),
(55, 6, 'Skim Kompetitor', 0, 0, 0, 1, NULL, NULL),
(56, 1, 'Suhu', 0, 0, 0, 1, NULL, NULL),
(57, 2, 'Tanaman pengganti', 0, 0, 0, 1, NULL, NULL),
(58, 4, 'Tenaga kerja tambahan', 0, 0, 0, 1, NULL, NULL),
(59, 3, 'Tuber day', 0, 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_assumptions_group_name`
--

CREATE TABLE IF NOT EXISTS `bf_master_assumptions_group_name` (
  `assumption_group_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`assumption_group_name_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `bf_master_assumptions_group_name`
--

INSERT INTO `bf_master_assumptions_group_name` (`assumption_group_name_id`, `group_name`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Weather\r\n', NULL, NULL, 0, 1, NULL, NULL),
(2, 'Crops\r\n', NULL, NULL, 0, 1, NULL, NULL),
(3, 'Market Dev.Activity\r\n', NULL, NULL, 0, 1, NULL, NULL),
(4, 'Manpower\r\n', NULL, NULL, 0, 1, NULL, NULL),
(5, 'Post Harvest\r\n', NULL, NULL, 0, 1, NULL, NULL),
(6, 'Commercial\r\n', NULL, NULL, 0, 1, NULL, NULL),
(7, 'Price\r\n', NULL, NULL, 0, 1, NULL, NULL),
(8, 'General\r\n', NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_business_geography_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_business_geography_details` (
  `business_geo_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` date DEFAULT NULL,
  `geo_level_id` int(11) DEFAULT NULL,
  `parent_geo_id` int(11) DEFAULT NULL,
  `business_georaphy_code` varchar(255) DEFAULT NULL,
  `business_georaphy_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`business_geo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `bf_master_business_geography_details`
--

INSERT INTO `bf_master_business_geography_details` (`business_geo_id`, `year`, `geo_level_id`, `parent_geo_id`, `business_georaphy_code`, `business_georaphy_name`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, '2016-01-01', 3, 0, '1', 'Philippines', NULL, NULL, 0, 1, NULL, NULL),
(2, '2016-01-01', 2, 1, '1', 'Region I', NULL, NULL, 0, 1, NULL, NULL),
(3, '2016-01-01', 1, 2, '1', 'Territory 1', NULL, NULL, 0, 1, NULL, NULL),
(4, '2016-01-01', 2, 1, '2', 'Luzon - Gentrade', NULL, NULL, 0, 1, NULL, NULL),
(5, '2016-01-01', 1, 4, '2', 'Isabela', NULL, NULL, 0, 1, NULL, NULL),
(6, '2016-01-01', 1, 4, '3', 'Cordillera Administrative Region', NULL, NULL, 0, 1, NULL, NULL),
(7, '2016-01-01', 1, 4, '4', 'Nueva Ecija', NULL, NULL, 0, 1, NULL, NULL),
(8, '2016-01-01', 1, 4, '5', 'Pangasinan', NULL, NULL, 0, 1, NULL, NULL),
(9, '2016-01-01', 1, 4, '6', 'Pampanga, Bulacan, Tarlac', NULL, NULL, 0, 1, NULL, NULL),
(10, '2016-01-01', 1, 4, '7', 'Calabarzon', NULL, NULL, 0, 1, NULL, NULL),
(11, '2016-01-01', 1, 4, '8', 'Bicol', NULL, NULL, 0, 1, NULL, NULL),
(12, '2016-01-01', 1, 4, '9', 'Luzon Mango Areas', NULL, NULL, 0, 1, NULL, NULL),
(13, '2016-01-01', 2, 1, '3', 'Vismin - Gentrade', NULL, NULL, 0, 1, NULL, NULL),
(14, '2016-01-01', 1, 13, '10', 'Visayas', NULL, NULL, 0, 1, NULL, NULL),
(15, '2016-01-01', 1, 13, '11', 'Eastern Mindanao', NULL, NULL, 0, 1, NULL, NULL),
(16, '2016-01-01', 1, 13, '12', 'SOCCSKARGEN', NULL, NULL, 0, 1, NULL, NULL),
(17, '2016-01-01', 1, 13, '13', 'Nothern Mindanao', NULL, NULL, 0, 1, NULL, NULL),
(18, '2016-01-01', 1, 13, '14', 'Western Mindanao', NULL, NULL, 0, 1, NULL, NULL),
(19, '2016-01-01', 1, 13, '15', 'Visimin Mango Areas', NULL, NULL, 0, 1, NULL, NULL),
(20, '2016-01-01', 3, 0, '', 'Indonesia', NULL, NULL, 0, 1, NULL, NULL),
(21, '2016-01-01', 2, 20, '', 'R1 (Danau Toba)', NULL, NULL, 0, 1, NULL, NULL),
(22, '2016-01-01', 1, 21, '', 'Simalungun', NULL, NULL, 0, 1, NULL, NULL),
(23, '2016-01-01', 1, 21, '', 'Tanah Karo', NULL, NULL, 0, 1, NULL, NULL),
(24, '2016-01-01', 1, 21, '', 'Deli Serdang', NULL, NULL, 0, 1, NULL, NULL),
(25, '2016-01-01', 1, 21, '', 'Langkat', NULL, NULL, 0, 1, NULL, NULL),
(26, '2016-01-01', 1, 21, '', 'Asahan', NULL, NULL, 0, 1, NULL, NULL),
(27, '2016-01-01', 1, 21, '', 'Aceh Tenggara', NULL, NULL, 0, 1, NULL, NULL),
(28, '2016-01-01', 2, 20, '', 'R3 (Gajah)', NULL, NULL, 0, 1, NULL, NULL),
(29, '2016-01-01', 1, 27, '', 'Bukit Barisan', NULL, NULL, 0, 1, NULL, NULL),
(30, '2016-01-01', 1, 27, '', 'Lamsel', NULL, NULL, 0, 1, NULL, NULL),
(31, '2016-01-01', 1, 27, '', 'Sumsel', NULL, NULL, 0, 1, NULL, NULL),
(32, '2016-01-01', 1, 27, '', 'Lamtim', NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_business_geography_level_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_business_geography_level_country` (
  `business_geography_countrylevel_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) DEFAULT NULL,
  `level_name` varchar(255) DEFAULT NULL,
  `political_geo_lavel_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`business_geography_countrylevel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `bf_master_business_geography_level_country`
--

INSERT INTO `bf_master_business_geography_level_country` (`business_geography_countrylevel_id`, `level_id`, `level_name`, `political_geo_lavel_id`, `country_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'Territory\r\n', 2, 101, NULL, NULL, 0, 1, NULL, NULL),
(2, 2, 'Area\r\n', NULL, 101, NULL, NULL, 0, 1, NULL, NULL),
(3, 3, 'Zone\r\n', NULL, 101, NULL, NULL, 0, 1, NULL, NULL),
(4, 1, 'Territory\r\n', 3, 98, NULL, NULL, 0, 1, NULL, NULL),
(5, 2, 'Region\r\n', NULL, 98, NULL, NULL, 0, 1, NULL, NULL),
(6, 3, 'Country\r\n', NULL, 98, NULL, NULL, 0, 1, NULL, NULL),
(7, 1, 'Territory\r\n', 3, 151, NULL, NULL, 0, 1, NULL, NULL),
(8, 2, 'Region\r\n', NULL, 151, NULL, NULL, 0, 1, NULL, NULL),
(9, 3, 'Country\r\n', NULL, 151, NULL, NULL, 0, 1, NULL, NULL),
(10, 1, 'Territory\r\n', 3, 231, NULL, NULL, 0, 1, NULL, NULL),
(11, 2, 'Region\r\n', NULL, 231, NULL, NULL, 0, 1, NULL, NULL),
(12, 3, 'Country\r\n', NULL, 231, NULL, NULL, 0, 1, NULL, NULL),
(13, 1, 'Territory\r\n', 3, 170, NULL, NULL, 0, 1, NULL, NULL),
(14, 2, 'Region\r\n', NULL, 170, NULL, NULL, 0, 1, NULL, NULL),
(15, 3, 'Country\r\n', NULL, 170, NULL, NULL, 0, 1, NULL, NULL),
(16, 1, 'Territory\r\n', 3, 190, NULL, NULL, 0, 1, NULL, NULL),
(17, 2, 'Region\r\n', NULL, 190, NULL, NULL, 0, 1, NULL, NULL),
(18, 3, 'Country\r\n', NULL, 190, NULL, NULL, 0, 1, NULL, NULL),
(19, 1, 'Territory\r\n', 3, 208, NULL, NULL, 0, 1, NULL, NULL),
(20, 2, 'Region\r\n', NULL, 208, NULL, NULL, 0, 1, NULL, NULL),
(21, 3, 'Country\r\n', NULL, 208, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_business_geography_level_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_business_geography_level_regional` (
  `business_geography_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) DEFAULT NULL,
  `level_name` varchar(255) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`business_geography_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `bf_master_business_geography_level_regional`
--

INSERT INTO `bf_master_business_geography_level_regional` (`business_geography_level_id`, `level`, `level_name`, `year`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 'L1', 'Territory', '0000-00-00', NULL, NULL, 0, 1, NULL, NULL),
(2, 'L2', 'Region', '0000-00-00', NULL, NULL, 0, 1, NULL, NULL),
(3, 'L3', 'Country', '0000-00-00', NULL, NULL, 0, 1, NULL, NULL),
(4, 'L4', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(5, 'L5', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(6, 'L6', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(7, 'L7', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(8, 'L8', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_business_political_geo_mapping`
--

CREATE TABLE IF NOT EXISTS `bf_master_business_political_geo_mapping` (
  `geo_mapping_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` date DEFAULT NULL,
  `business_geo_id` int(11) DEFAULT NULL,
  `polotical_geo_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`geo_mapping_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bf_master_business_political_geo_mapping`
--

INSERT INTO `bf_master_business_political_geo_mapping` (`geo_mapping_id`, `year`, `business_geo_id`, `polotical_geo_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, '2016-01-01', 2, 49, 45, NULL, 0, 1, NULL, NULL),
(2, '2016-01-01', 13, 61, 45, NULL, 0, 1, NULL, NULL),
(3, '2016-01-01', 4, 63, 45, NULL, 0, 1, NULL, NULL),
(4, '2016-01-01', 28, 129, 45, NULL, 0, 1, NULL, NULL),
(5, '2016-01-01', 21, 134, 45, NULL, 0, 1, NULL, NULL),
(6, '2016-01-01', 28, 49, 45, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_category_applicable`
--

CREATE TABLE IF NOT EXISTS `bf_master_category_applicable` (
  `category_applicable_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `applicable_name` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_applicable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bf_master_category_applicable`
--

INSERT INTO `bf_master_category_applicable` (`category_applicable_id`, `status`, `applicable_name`, `deleted`, `created_on`, `modified_on`) VALUES
(1, 1, 'Employee Master\r\n', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Product Master\r\n', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Disease Master\r\n', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'Crop Master\r\n', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'Retailer\r\n', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 'Distributor\r\n', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'Farmer\r\n', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_category_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_category_country` (
  `category_national_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `category_id` int(11) DEFAULT NULL,
  `category_national_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_national_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `bf_master_category_country`
--

INSERT INTO `bf_master_category_country` (`category_national_id`, `status`, `category_id`, `category_national_name`, `country_id`, `created_by_user`, `modified_by_user`, `deleted`, `created_on`, `modified_on`) VALUES
(1, 1, 1, 'A', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 2, 'B', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 3, 'C', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 4, 'A', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 5, 'B', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 6, 'C', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 7, 'Core \r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 8, 'Non Core\r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 9, 'Core \r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 10, 'Non Core\r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 11, 'Imp\r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 12, 'Very Impt\r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 13, 'Imp\r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 14, 'Very Impt\r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 15, 'Imp\r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, 16, 'Very Impt\r\n', 101, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 1, 1, 'A', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 1, 2, 'B', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 1, 3, 'C', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, 4, 'A', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, 5, 'B', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, 6, 'C', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, 7, 'Core \r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, 8, 'Non Core\r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 1, 9, 'Core \r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 1, 10, 'Non Core\r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 1, 11, 'Imp\r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 1, 12, 'Very Impt\r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 1, 13, 'Imp\r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 1, 14, 'Very Impt\r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, 15, 'Imp\r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 1, 16, 'Very Impt\r\n', 98, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 1, 'A', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 1, 2, 'B', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 3, 'C', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 1, 4, 'A', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 1, 5, 'B', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 1, 6, 'C', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 1, 7, 'Core \r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 1, 8, 'Non Core\r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 1, 9, 'Core \r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 1, 10, 'Non Core\r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 1, 11, 'Imp\r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, 12, 'Very Impt\r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 1, 13, 'Imp\r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 1, 14, 'Very Impt\r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 1, 15, 'Imp\r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 1, 16, 'Very Impt\r\n', 151, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 1, 1, 'A', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, 2, 'B', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 1, 3, 'C', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 1, 4, 'A', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 1, 5, 'B', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 1, 6, 'C', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 1, 7, 'Core \r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 1, 8, 'Non Core\r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 1, 9, 'Core \r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 1, 10, 'Non Core\r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 1, 11, 'Imp\r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 1, 12, 'Very Impt\r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 1, 13, 'Imp\r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 1, 14, 'Very Impt\r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 1, 15, 'Impt\r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 1, 16, 'Very Impt\r\n', 231, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 1, 1, 'A', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 1, 2, 'B', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 1, 3, 'C', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 1, 4, 'A', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 1, 5, 'B', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 1, 6, 'C', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 1, 7, 'Core \r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 1, 8, 'Non Core\r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 1, 9, 'Core \r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 1, 10, 'Non Core\r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 1, 11, 'Imp\r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 1, 12, 'Very Impt\r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 1, 13, 'Imp\r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 1, 14, 'Very Impt\r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 1, 15, 'Imp\r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 1, 16, 'Very Impt\r\n', 170, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 1, 1, 'A', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 1, 2, 'B', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 1, 3, 'C', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 1, 4, 'A', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 1, 5, 'B', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 1, 6, 'C', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 1, 7, 'Core \r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 1, 8, 'Non Core\r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 1, 9, 'Core \r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 1, 10, 'Non Core\r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 1, 11, 'Imp\r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 1, 12, 'Very Impt\r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 1, 13, 'Imp\r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 1, 14, 'Very Impt\r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 1, 15, 'Imp\r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 1, 16, 'Very Impt\r\n', 190, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 1, 1, 'A', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 1, 2, 'B', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 1, 3, 'C', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 1, 4, 'A', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 1, 5, 'B', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 1, 6, 'C', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 1, 7, 'Core \r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 1, 8, 'Non Core\r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 1, 9, 'Core \r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 1, 10, 'Non Core\r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 1, 11, 'Imp\r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 1, 12, 'Very Impt\r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 1, 13, 'Imp\r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 1, 14, 'Very Impt\r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 1, 15, 'Imp\r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 1, 16, 'Very Impt\r\n', 205, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_category_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_category_regional` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `category_name` varchar(255) NOT NULL,
  `category_code` varchar(30) NOT NULL,
  `category_applicable_id` int(11) NOT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `bf_master_category_regional`
--

INSERT INTO `bf_master_category_regional` (`category_id`, `status`, `category_name`, `category_code`, `category_applicable_id`, `created_by_user`, `modified_by_user`, `deleted`, `created_on`, `modified_on`) VALUES
(1, 1, 'A', '001', 1, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'B', '002', 1, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'C', '003', 1, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'A', '004', 2, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'B', '005', 2, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 'C', '006', 2, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'Core \r\n', '007', 3, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 'Non Core\r\n', '008', 3, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 'Core \r\n', '009', 4, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 'Non Core\r\n', '010', 4, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 'Imp\r\n', '011', 5, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 'Very Impt\r\n', '012', 5, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 'Imp\r\n', '013', 6, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 'Very Impt\r\n', '014', 6, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 'Imp\r\n', '015', 7, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, 'Very Impt\r\n', '016', 7, NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_compititor`
--

CREATE TABLE IF NOT EXISTS `bf_master_compititor` (
  `compititor_id` int(11) NOT NULL AUTO_INCREMENT,
  `compititor_name` varchar(255) DEFAULT NULL,
  `compititor_code` varchar(255) DEFAULT NULL,
  `location` text,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`compititor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bf_master_compititor`
--

INSERT INTO `bf_master_compititor` (`compititor_id`, `compititor_name`, `compititor_code`, `location`, `description`, `deleted`, `status`, `created_on`, `modified_on`, `country_id`) VALUES
(1, 'Zee Company Ltd\r\n', '1', 'Mumbai', 'Zee Company Ltd', 0, 1, NULL, NULL, NULL),
(2, 'Anand Fertilizers\r\n', '2', 'Anand', 'Anand Fertilizers', 0, 1, NULL, NULL, NULL),
(3, 'Ahmedabad Corporation\r\n', '3', 'Ahmedabad', 'Ahmedabad Corporation', 0, 1, NULL, NULL, NULL),
(4, 'Krishi Seva Kendra\r\n', '4', 'Delhi', 'Krishi Seva Kendra', 0, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_complaint_detail`
--

CREATE TABLE IF NOT EXISTS `bf_master_complaint_detail` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type_id` int(11) DEFAULT NULL,
  `complaint_subject` varchar(255) DEFAULT NULL,
  `reminder1_days` int(11) DEFAULT NULL,
  `reminder1_desigination_id` int(11) DEFAULT NULL,
  `reminder1_other_desigination_id` int(11) DEFAULT NULL,
  `other_desigination_person1_id` int(11) DEFAULT NULL,
  `reminder2_days` int(11) DEFAULT NULL,
  `reminder2_desigination_id` int(11) DEFAULT NULL,
  `reminder2_other_desigination_id` int(11) DEFAULT NULL,
  `other_desigination_person2_id` int(11) DEFAULT NULL,
  `reminder3_days` int(11) DEFAULT NULL,
  `reminder3_desigination_id` int(11) DEFAULT NULL,
  `reminder3_other_desigination_id` int(11) DEFAULT NULL,
  `other_desigination_person3_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `bf_master_complaint_detail`
--

INSERT INTO `bf_master_complaint_detail` (`complaint_id`, `complaint_type_id`, `complaint_subject`, `reminder1_days`, `reminder1_desigination_id`, `reminder1_other_desigination_id`, `other_desigination_person1_id`, `reminder2_days`, `reminder2_desigination_id`, `reminder2_other_desigination_id`, `other_desigination_person2_id`, `reminder3_days`, `reminder3_desigination_id`, `reminder3_other_desigination_id`, `other_desigination_person3_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'Account Statement\r\n', 5, NULL, NULL, NULL, 10, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(2, 1, 'Credit Balance Refund\r\n', 5, NULL, NULL, NULL, 10, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(3, 1, 'Credit note copy\r\n', 2, NULL, NULL, NULL, 7, NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(4, 1, 'Delay in PLI Discounts Credit Note\r\n', 15, NULL, NULL, NULL, 20, NULL, NULL, NULL, 25, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(5, 1, 'Invoice Copy Required\r\n', 2, NULL, NULL, NULL, 7, NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(6, 2, 'Leakage / Damage Material\r\n', 45, NULL, NULL, NULL, 50, NULL, NULL, NULL, 55, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(7, 2, 'Late Delivery of Consignment\r\n', 45, NULL, NULL, NULL, 50, NULL, NULL, NULL, 55, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(8, 2, 'Empty Pack/bottle\r\n', 45, NULL, NULL, NULL, 50, NULL, NULL, NULL, 55, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(9, 2, 'Non Recipt of material\r\n', 25, NULL, NULL, NULL, 30, NULL, NULL, NULL, 35, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_complaint_type`
--

CREATE TABLE IF NOT EXISTS `bf_master_complaint_type` (
  `complaint_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`complaint_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bf_master_complaint_type`
--

INSERT INTO `bf_master_complaint_type` (`complaint_type_id`, `complaint_type_name`, `country_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Account\r\n', 101, NULL, NULL, 0, 1, NULL, NULL),
(2, 'Non-Account\r\n', NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_conversation`
--

CREATE TABLE IF NOT EXISTS `bf_master_conversation` (
  `conversation_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sku_id` int(11) DEFAULT NULL,
  `sku_convesion_factor` decimal(9,2) DEFAULT NULL,
  `sku_result` varchar(255) DEFAULT NULL,
  `box_conversion_factor` decimal(9,2) DEFAULT NULL,
  `box_result` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`conversation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bf_master_conversation`
--

INSERT INTO `bf_master_conversation` (`conversation_id`, `product_sku_id`, `sku_convesion_factor`, `sku_result`, `box_conversion_factor`, `box_result`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, '0.50', NULL, '2.00', NULL, NULL, NULL, 0, 1, NULL, NULL),
(2, 91, '0.25', NULL, '1.00', NULL, NULL, NULL, 0, 1, NULL, NULL),
(3, 92, '1.00', NULL, '2.00', NULL, NULL, NULL, 0, 1, NULL, NULL),
(4, 109, '0.50', NULL, '2.00', NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_crop_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_crop_country` (
  `crop_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `crop_id` int(11) DEFAULT NULL,
  `crop_name` varchar(255) DEFAULT NULL,
  `crop_code` varchar(255) DEFAULT NULL,
  `Description` text,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`crop_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `bf_master_crop_country`
--

INSERT INTO `bf_master_crop_country` (`crop_country_id`, `crop_id`, `crop_name`, `crop_code`, `Description`, `country_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'Grapes', '1', '', 101, 0, 0, 0, 1, NULL, NULL),
(2, 2, 'Banana', '2', '', 101, 0, 0, 0, 1, NULL, NULL),
(3, 3, 'Apple', '3', '', 101, 0, 0, 0, 1, NULL, NULL),
(4, 4, 'Potato', '4', '', 101, 0, 0, 0, 1, NULL, NULL),
(5, 5, 'Mango', '5', '', 101, 0, 0, 0, 1, NULL, NULL),
(6, 6, 'Ground Nut', '6', '', 101, 0, 0, 0, 1, NULL, NULL),
(7, 7, 'Cucurbits', '7', '', 101, 0, 0, 0, 1, NULL, NULL),
(8, 8, 'Chili', '8', '', 101, 0, 0, 0, 1, NULL, NULL),
(9, 9, 'Corn', '9', '', 101, 0, 0, 0, 1, NULL, NULL),
(10, 10, 'Cucumber', '10', '', 101, 0, 0, 0, 1, NULL, NULL),
(11, 1, 'Grapes', '1', '', 98, 0, 0, 0, 1, NULL, NULL),
(12, 2, 'Banana', '2', '', 98, 0, 0, 0, 1, NULL, NULL),
(13, 3, 'Apple', '3', '', 98, 0, 0, 0, 1, NULL, NULL),
(14, 4, 'Potato', '4', '', 98, 0, 0, 0, 1, NULL, NULL),
(15, 5, 'Mango', '5', '', 98, 0, 0, 0, 1, NULL, NULL),
(16, 6, 'Ground Nut', '6', '', 98, 0, 0, 0, 1, NULL, NULL),
(17, 7, 'Cucurbits', '7', '', 98, 0, 0, 0, 1, NULL, NULL),
(18, 8, 'Chili', '8', '', 98, 0, 0, 0, 1, NULL, NULL),
(19, 9, 'Corn', '9', '', 98, 0, 0, 0, 1, NULL, NULL),
(20, 10, 'Cucumber', '10', '', 98, 0, 0, 0, 1, NULL, NULL),
(21, 1, 'Grapes', '1', '', 151, 0, 0, 0, 1, NULL, NULL),
(22, 2, 'Banana', '2', '', 151, 0, 0, 0, 1, NULL, NULL),
(23, 3, 'Apple', '3', '', 151, 0, 0, 0, 1, NULL, NULL),
(24, 4, 'Potato', '4', '', 151, 0, 0, 0, 1, NULL, NULL),
(25, 5, 'Mango', '5', '', 151, 0, 0, 0, 1, NULL, NULL),
(26, 6, 'Ground Nut', '6', '', 151, 0, 0, 0, 1, NULL, NULL),
(27, 7, 'Cucurbits', '7', '', 151, 0, 0, 0, 1, NULL, NULL),
(28, 8, 'Chili', '8', '', 151, 0, 0, 0, 1, NULL, NULL),
(29, 9, 'Corn', '9', '', 151, 0, 0, 0, 1, NULL, NULL),
(30, 10, 'Cucumber', '10', '', 151, 0, 0, 0, 1, NULL, NULL),
(31, 1, 'Grapes', '1', '', 231, 0, 0, 0, 1, NULL, NULL),
(32, 2, 'Banana', '2', '', 231, 0, 0, 0, 1, NULL, NULL),
(33, 3, 'Apple', '3', '', 231, 0, 0, 0, 1, NULL, NULL),
(34, 4, 'Potato', '4', '', 231, 0, 0, 0, 1, NULL, NULL),
(35, 5, 'Mango', '5', '', 231, 0, 0, 0, 1, NULL, NULL),
(36, 6, 'Ground Nut', '6', '', 231, 0, 0, 0, 1, NULL, NULL),
(37, 7, 'Cucurbits', '7', '', 231, 0, 0, 0, 1, NULL, NULL),
(38, 8, 'Chili', '8', '', 231, 0, 0, 0, 1, NULL, NULL),
(39, 9, 'Corn', '9', '', 231, 0, 0, 0, 1, NULL, NULL),
(40, 10, 'Cucumber', '10', '', 231, 0, 0, 0, 1, NULL, NULL),
(41, 1, 'Grapes', '1', '', 170, 0, 0, 0, 1, NULL, NULL),
(42, 2, 'Banana', '2', '', 170, 0, 0, 0, 1, NULL, NULL),
(43, 3, 'Apple', '3', '', 170, 0, 0, 0, 1, NULL, NULL),
(44, 4, 'Potato', '4', '', 170, 0, 0, 0, 1, NULL, NULL),
(45, 5, 'Mango', '5', '', 170, 0, 0, 0, 1, NULL, NULL),
(46, 6, 'Ground Nut', '6', '', 170, 0, 0, 0, 1, NULL, NULL),
(47, 7, 'Cucurbits', '7', '', 170, 0, 0, 0, 1, NULL, NULL),
(48, 8, 'Chili', '8', '', 170, 0, 0, 0, 1, NULL, NULL),
(49, 9, 'Corn', '9', '', 170, 0, 0, 0, 1, NULL, NULL),
(50, 10, 'Cucumber', '10', '', 170, 0, 0, 0, 1, NULL, NULL),
(51, 1, 'Grapes', '1', '', 190, 0, 0, 0, 1, NULL, NULL),
(52, 2, 'Banana', '2', '', 190, 0, 0, 0, 1, NULL, NULL),
(53, 3, 'Apple', '3', '', 190, 0, 0, 0, 1, NULL, NULL),
(54, 4, 'Potato', '4', '', 190, 0, 0, 0, 1, NULL, NULL),
(55, 5, 'Mango', '5', '', 190, 0, 0, 0, 1, NULL, NULL),
(56, 6, 'Ground Nut', '6', '', 190, 0, 0, 0, 1, NULL, NULL),
(57, 7, 'Cucurbits', '7', '', 190, 0, 0, 0, 1, NULL, NULL),
(58, 8, 'Chili', '8', '', 190, 0, 0, 0, 1, NULL, NULL),
(59, 9, 'Corn', '9', '', 190, 0, 0, 0, 1, NULL, NULL),
(60, 10, 'Cucumber', '10', '', 190, 0, 0, 0, 1, NULL, NULL),
(61, 1, 'Grapes', '1', '', 208, 0, 0, 0, 1, NULL, NULL),
(62, 2, 'Banana', '2', '', 208, 0, 0, 0, 1, NULL, NULL),
(63, 3, 'Apple', '3', '', 208, 0, 0, 0, 1, NULL, NULL),
(64, 4, 'Potato', '4', '', 208, 0, 0, 0, 1, NULL, NULL),
(65, 5, 'Mango', '5', '', 208, 0, 0, 0, 1, NULL, NULL),
(66, 6, 'Ground Nut', '6', '', 208, 0, 0, 0, 1, NULL, NULL),
(67, 7, 'Cucurbits', '7', '', 208, 0, 0, 0, 1, NULL, NULL),
(68, 8, 'Chili', '8', '', 208, 0, 0, 0, 1, NULL, NULL),
(69, 9, 'Corn', '9', '', 208, 0, 0, 0, 1, NULL, NULL),
(70, 10, 'Cucumber', '10', '', 208, 0, 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_crop_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_crop_regional` (
  `crop_id` int(11) NOT NULL AUTO_INCREMENT,
  `crop_name` varchar(255) DEFAULT NULL,
  `crop_code` varchar(255) DEFAULT NULL,
  `Description` text,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`crop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bf_master_crop_regional`
--

INSERT INTO `bf_master_crop_regional` (`crop_id`, `crop_name`, `crop_code`, `Description`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Grapes', '1', NULL, NULL, NULL, 0, 1, NULL, NULL),
(2, 'Banana\r\n', '2', NULL, NULL, NULL, 0, 1, NULL, NULL),
(3, 'Apple\r\n', '3', NULL, NULL, NULL, 0, 1, NULL, NULL),
(4, 'Potato\r\n', '4', NULL, NULL, NULL, 0, 1, NULL, NULL),
(5, 'Mango\r\n', '5', NULL, NULL, NULL, 0, 1, NULL, NULL),
(6, 'Ground Nut\r\n', '6', NULL, NULL, NULL, 0, 1, NULL, NULL),
(7, 'Cucurbits\r\n', '7', NULL, NULL, NULL, 0, 1, NULL, NULL),
(8, 'Chili\r\n', '8', NULL, NULL, NULL, 0, 1, NULL, NULL),
(9, 'Corn\r\n', '9', NULL, NULL, NULL, 0, 1, NULL, NULL),
(10, 'Cucumber\r\n', '10', NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_customer_business_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_customer_business_details` (
  `customer_business_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `avg_daily_counter` int(11) DEFAULT NULL,
  `avg_daily_footfalls` int(11) DEFAULT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `house_no` varchar(255) DEFAULT NULL,
  `address` text,
  `landmark` varchar(255) DEFAULT NULL,
  `geo_level_id1` int(11) DEFAULT NULL,
  `geo_level_id2` int(11) DEFAULT NULL,
  `geo_level_id3` int(11) DEFAULT NULL,
  `pincode` varchar(30) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_business_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_customer_crop_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_customer_crop_details` (
  `customer_crop_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `yeild_HA` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`customer_crop_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `bf_master_customer_crop_details`
--

INSERT INTO `bf_master_customer_crop_details` (`customer_crop_detail_id`, `user_id`, `crop_id`, `yeild_HA`) VALUES
(1, 4, 1, '10.00'),
(2, 4, 2, '11.00'),
(3, 4, 3, '12.00'),
(4, 5, 5, '13.00'),
(5, 6, 7, '14.00'),
(6, 6, 8, '15.00'),
(7, 6, 9, '16.00'),
(8, 6, 10, '17.00'),
(9, 7, 1, '18.00'),
(10, 7, 8, '19.00'),
(11, 7, 7, '20.00'),
(12, 7, 4, '21.00'),
(13, 7, 10, '22.00'),
(14, 8, 8, '23.00'),
(15, 25, 1, '24.00'),
(16, 25, 10, '25.00'),
(17, 26, 6, '26.00'),
(18, 26, 4, '27.00'),
(19, 27, 6, '28.00'),
(20, 27, 6, '29.00'),
(21, 29, 6, '30.00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_customer_farming_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_customer_farming_details` (
  `customer_framing_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_no` int(20) DEFAULT NULL,
  `house_no` varchar(255) DEFAULT NULL,
  `address` text,
  `landmark` varchar(255) DEFAULT NULL,
  `geo_level_id1` int(11) DEFAULT NULL,
  `geo_level_id2` int(11) DEFAULT NULL,
  `geo_level_id3` int(11) DEFAULT NULL,
  `pincode` varchar(30) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_framing_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_customer_to_customer_mapping`
--

CREATE TABLE IF NOT EXISTS `bf_master_customer_to_customer_mapping` (
  `CtoC_mapping_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_customer_id` int(11) DEFAULT NULL,
  `to_customer_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`CtoC_mapping_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `bf_master_customer_to_customer_mapping`
--

INSERT INTO `bf_master_customer_to_customer_mapping` (`CtoC_mapping_id`, `from_customer_id`, `to_customer_id`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 9, 14, 0, 1, NULL, NULL),
(2, 9, 15, 0, 1, NULL, NULL),
(3, 10, 15, 0, 1, NULL, NULL),
(4, 10, 16, 0, 1, NULL, NULL),
(5, 11, 16, 0, 1, NULL, NULL),
(6, 11, 17, 0, 1, NULL, NULL),
(7, 12, 17, 0, 1, NULL, NULL),
(8, 12, 18, 0, 1, NULL, NULL),
(9, 13, 17, 0, 1, NULL, NULL),
(10, 13, 18, 0, 1, NULL, NULL),
(11, 13, 19, 0, 1, NULL, NULL),
(12, 14, 4, 0, 1, NULL, NULL),
(13, 14, 5, 0, 1, NULL, NULL),
(14, 15, 5, 0, 1, NULL, NULL),
(15, 15, 6, 0, 1, NULL, NULL),
(16, 16, 6, 0, 1, NULL, NULL),
(17, 16, 7, 0, 1, NULL, NULL),
(18, 16, 8, 0, 1, NULL, NULL),
(19, 17, 4, 0, 1, NULL, NULL),
(20, 17, 6, 0, 1, NULL, NULL),
(21, 17, 8, 0, 1, NULL, NULL),
(22, 18, 3, 0, 1, NULL, NULL),
(23, 18, 7, 0, 1, NULL, NULL),
(24, 19, 4, 0, 1, NULL, NULL),
(25, 19, 5, 0, 1, NULL, NULL),
(26, 19, 6, 0, 1, NULL, NULL),
(27, 19, 7, 0, 1, NULL, NULL),
(28, 19, 8, 0, 1, NULL, NULL),
(29, 35, 30, 0, 1, NULL, NULL),
(30, 35, 31, 0, 1, NULL, NULL),
(31, 36, 32, 0, 1, NULL, NULL),
(32, 36, 33, 0, 1, NULL, NULL),
(33, 37, 30, 0, 1, NULL, NULL),
(34, 37, 34, 0, 1, NULL, NULL),
(35, 38, 30, 0, 1, NULL, NULL),
(36, 38, 32, 0, 1, NULL, NULL),
(37, 39, 30, 0, 1, NULL, NULL),
(38, 39, 31, 0, 1, NULL, NULL),
(39, 39, 32, 0, 1, NULL, NULL),
(40, 39, 33, 0, 1, NULL, NULL),
(41, 30, 25, 0, 1, NULL, NULL),
(42, 30, 26, 0, 1, NULL, NULL),
(43, 31, 26, 0, 1, NULL, NULL),
(44, 31, 27, 0, 1, NULL, NULL),
(45, 32, 27, 0, 1, NULL, NULL),
(46, 32, 27, 0, 1, NULL, NULL),
(47, 33, 28, 0, 1, NULL, NULL),
(48, 33, 29, 0, 1, NULL, NULL),
(49, 34, 26, 0, 1, NULL, NULL),
(50, 34, 27, 0, 1, NULL, NULL),
(51, 34, 28, 0, 1, NULL, NULL),
(52, 19, 10, 0, 1, NULL, NULL),
(53, 19, 11, 0, 1, NULL, NULL),
(54, 19, 12, 0, 1, NULL, NULL),
(55, 19, 13, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_customer_type_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_customer_type_country` (
  `customer_type_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_type_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `customer_type_code` varchar(30) DEFAULT NULL,
  `customer_type_name` varchar(255) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`customer_type_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `bf_master_customer_type_country`
--

INSERT INTO `bf_master_customer_type_country` (`customer_type_country_id`, `customer_type_id`, `country_id`, `customer_type_code`, `customer_type_name`, `description`, `deleted`, `status`, `created_by_user`, `modified_by_user`, `created_on`, `modified_on`) VALUES
(1, 1, 101, '001', 'Farmer', 'Farmer', 0, 1, 3, 3, '2016-05-09 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 101, '002', 'Retailer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 101, '003', 'Distributor', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 98, '004', 'Farmer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 98, '005', 'Retailer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 3, 98, '006', 'Distributor', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 151, '007', 'Farmer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2, 151, '008', 'Retailer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 3, 151, '009', 'Distributor', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 231, '010', 'Farmer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 2, 231, '011', 'Retailer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 3, 231, '012', 'Distributor', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 170, '013', 'Farmer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 2, 170, '014', 'Retailer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 3, 170, '015', 'Distributor', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, 190, '016', 'Farmer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 2, 190, '017', 'Retailer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 3, 190, '018', 'Distributor', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 1, 208, '019', 'Farmer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 2, 208, '020', 'Retailer', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 3, 208, '021', 'Distributor', NULL, 0, 1, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_customer_type_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_customer_type_regional` (
  `customer_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `customer_level` varchar(255) NOT NULL,
  `customer_type_name` varchar(255) NOT NULL,
  `customer_type_code` varchar(100) NOT NULL,
  `customer_type_description` text,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`customer_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bf_master_customer_type_regional`
--

INSERT INTO `bf_master_customer_type_regional` (`customer_type_id`, `status`, `customer_level`, `customer_type_name`, `customer_type_code`, `customer_type_description`, `created_by_user`, `modified_by_user`, `deleted`, `created_on`, `modified_on`) VALUES
(1, 1, 'L1', 'Farmer', '001', 'Farmer', 3, 3, 0, '2016-05-09 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'L2', 'Retailer', '002', 'Retailer', NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'L3', 'Distributor', '003', 'Distributor', NULL, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_customer_type_to_geo_mapping`
--

CREATE TABLE IF NOT EXISTS `bf_master_customer_type_to_geo_mapping` (
  `ct_to_g_mapping_id` int(11) NOT NULL AUTO_INCREMENT,
  `cusomer_type_id` int(11) DEFAULT NULL,
  `geo_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`ct_to_g_mapping_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bf_master_customer_type_to_geo_mapping`
--

INSERT INTO `bf_master_customer_type_to_geo_mapping` (`ct_to_g_mapping_id`, `cusomer_type_id`, `geo_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 3, 4, NULL, NULL, 0, 1, NULL, NULL),
(2, 2, 3, NULL, NULL, 0, 1, NULL, NULL),
(3, 1, 2, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_department_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_department_country` (
  `department_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_regional_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `department_country_name` varchar(255) DEFAULT NULL,
  `department_country_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`department_country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_department_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_department_regional` (
  `department_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_regional_name` varchar(255) DEFAULT NULL,
  `department_regional_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`department_regional_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_designation_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_designation_country` (
  `desigination_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `desigination_regional_id` int(11) DEFAULT NULL,
  `desigination_country_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `business_geo_level_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`desigination_country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_designation_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_designation_regional` (
  `desigination_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `regional_level` varchar(255) DEFAULT NULL,
  `desigination_regional_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`desigination_regional_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_designation_role`
--

CREATE TABLE IF NOT EXISTS `bf_master_designation_role` (
  `desigination_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `desigination_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`desigination_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_disease_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_disease_country` (
  `disease_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `disease_id` int(11) DEFAULT NULL,
  `disease_name` varchar(255) DEFAULT NULL,
  `disease_code` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`disease_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=204 ;

--
-- Dumping data for table `bf_master_disease_country`
--

INSERT INTO `bf_master_disease_country` (`disease_country_id`, `disease_id`, `disease_name`, `disease_code`, `country_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'Botrytis(Grey or Noble Rot)', '1', 101, 0, 0, 0, 1, NULL, NULL),
(2, 2, 'Blast', '2', 101, 0, 0, 0, 1, NULL, NULL),
(3, 3, 'Apple scab', '3', 101, 0, 0, 0, 1, NULL, NULL),
(4, 4, 'Fusarium Wilt', '4', 101, 0, 0, 0, 1, NULL, NULL),
(5, 5, 'Powdery Mildew Tomato', '5', 101, 0, 0, 0, 1, NULL, NULL),
(6, 6, 'Anthracnose Tomato', '6', 101, 0, 0, 0, 1, NULL, NULL),
(7, 7, 'Early Blight Tomato', '7', 101, 0, 0, 0, 1, NULL, NULL),
(8, 8, 'Late Blight Tomato', '8', 101, 0, 0, 0, 1, NULL, NULL),
(9, 9, 'Sooty Mold', '9', 101, 0, 0, 0, 1, NULL, NULL),
(10, 10, 'Diplodia Stem End Rot', '10', 101, 0, 0, 0, 1, NULL, NULL),
(11, 11, 'Scab', '11', 101, 0, 0, 0, 1, NULL, NULL),
(12, 12, 'Anthracnose Mango', '12', 101, 0, 0, 0, 1, NULL, NULL),
(13, 13, 'Stem rot', '13', 101, 0, 0, 0, 1, NULL, NULL),
(14, 14, 'Aspergellus Crown rot', '14', 101, 0, 0, 0, 1, NULL, NULL),
(15, 15, 'Rust', '15', 101, 0, 0, 0, 1, NULL, NULL),
(16, 16, 'Late Leaf Spot', '16', 101, 0, 0, 0, 1, NULL, NULL),
(17, 17, 'Early Leaf Spot', '17', 101, 0, 0, 0, 1, NULL, NULL),
(18, 18, 'Alternaria Blight', '18', 101, 0, 0, 0, 1, NULL, NULL),
(19, 19, 'Anthracnose Cucurbits', '19', 101, 0, 0, 0, 1, NULL, NULL),
(20, 20, 'Powdery Mildew Cucurbits', '20', 101, 0, 0, 0, 1, NULL, NULL),
(21, 21, 'Downy Mildew Cucurbits', '21', 101, 0, 0, 0, 1, NULL, NULL),
(22, 22, 'Damping Off Cucurbits', '22', 101, 0, 0, 0, 1, NULL, NULL),
(23, 23, 'Choanephora Blight', '23', 101, 0, 0, 0, 1, NULL, NULL),
(24, 24, 'Alternaria Leaf Spot', '24', 101, 0, 0, 0, 1, NULL, NULL),
(25, 25, 'Cercospora Leaf Spot Chili', '25', 101, 0, 0, 0, 1, NULL, NULL),
(26, 26, 'Powdery Mildew Chili', '26', 101, 0, 0, 0, 1, NULL, NULL),
(27, 27, 'Damping Off', '27', 101, 0, 0, 0, 1, NULL, NULL),
(28, 28, 'Anthracnose', '28', 101, 0, 0, 0, 1, NULL, NULL),
(29, 29, 'Freckles', '29', 101, 0, 0, 0, 1, NULL, NULL),
(30, 1, 'Botrytis(Grey or Noble Rot)', '1', 98, 0, 0, 0, 1, NULL, NULL),
(31, 2, 'Blast', '2', 98, 0, 0, 0, 1, NULL, NULL),
(32, 3, 'Apple scab', '3', 98, 0, 0, 0, 1, NULL, NULL),
(33, 4, 'Fusarium Wilt', '4', 98, 0, 0, 0, 1, NULL, NULL),
(34, 5, 'Powdery Mildew Tomato', '5', 98, 0, 0, 0, 1, NULL, NULL),
(35, 6, 'Anthracnose Tomato', '6', 98, 0, 0, 0, 1, NULL, NULL),
(36, 7, 'Early Blight Tomato', '7', 98, 0, 0, 0, 1, NULL, NULL),
(37, 8, 'Late Blight Tomato', '8', 98, 0, 0, 0, 1, NULL, NULL),
(38, 9, 'Sooty Mold', '9', 98, 0, 0, 0, 1, NULL, NULL),
(39, 10, 'Diplodia Stem End Rot', '10', 98, 0, 0, 0, 1, NULL, NULL),
(40, 11, 'Scab', '11', 98, 0, 0, 0, 1, NULL, NULL),
(41, 12, 'Anthracnose Mango', '12', 98, 0, 0, 0, 1, NULL, NULL),
(42, 13, 'Stem rot', '13', 98, 0, 0, 0, 1, NULL, NULL),
(43, 14, 'Aspergellus Crown rot', '14', 98, 0, 0, 0, 1, NULL, NULL),
(44, 15, 'Rust', '15', 98, 0, 0, 0, 1, NULL, NULL),
(45, 16, 'Late Leaf Spot', '16', 98, 0, 0, 0, 1, NULL, NULL),
(46, 17, 'Early Leaf Spot', '17', 98, 0, 0, 0, 1, NULL, NULL),
(47, 18, 'Alternaria Blight', '18', 98, 0, 0, 0, 1, NULL, NULL),
(48, 19, 'Anthracnose Cucurbits', '19', 98, 0, 0, 0, 1, NULL, NULL),
(49, 20, 'Powdery Mildew Cucurbits', '20', 98, 0, 0, 0, 1, NULL, NULL),
(50, 21, 'Downy Mildew Cucurbits', '21', 98, 0, 0, 0, 1, NULL, NULL),
(51, 22, 'Damping Off Cucurbits', '22', 98, 0, 0, 0, 1, NULL, NULL),
(52, 23, 'Choanephora Blight', '23', 98, 0, 0, 0, 1, NULL, NULL),
(53, 24, 'Alternaria Leaf Spot', '24', 98, 0, 0, 0, 1, NULL, NULL),
(54, 25, 'Cercospora Leaf Spot Chili', '25', 98, 0, 0, 0, 1, NULL, NULL),
(55, 26, 'Powdery Mildew Chili', '26', 98, 0, 0, 0, 1, NULL, NULL),
(56, 27, 'Damping Off', '27', 98, 0, 0, 0, 1, NULL, NULL),
(57, 28, 'Anthracnose', '28', 98, 0, 0, 0, 1, NULL, NULL),
(58, 29, 'Freckles', '29', 98, 0, 0, 0, 1, NULL, NULL),
(59, 1, 'Botrytis(Grey or Noble Rot)', '1', 151, 0, 0, 0, 1, NULL, NULL),
(60, 2, 'Blast', '2', 151, 0, 0, 0, 1, NULL, NULL),
(61, 3, 'Apple scab', '3', 151, 0, 0, 0, 1, NULL, NULL),
(62, 4, 'Fusarium Wilt', '4', 151, 0, 0, 0, 1, NULL, NULL),
(63, 5, 'Powdery Mildew Tomato', '5', 151, 0, 0, 0, 1, NULL, NULL),
(64, 6, 'Anthracnose Tomato', '6', 151, 0, 0, 0, 1, NULL, NULL),
(65, 7, 'Early Blight Tomato', '7', 151, 0, 0, 0, 1, NULL, NULL),
(66, 8, 'Late Blight Tomato', '8', 151, 0, 0, 0, 1, NULL, NULL),
(67, 9, 'Sooty Mold', '9', 151, 0, 0, 0, 1, NULL, NULL),
(68, 10, 'Diplodia Stem End Rot', '10', 151, 0, 0, 0, 1, NULL, NULL),
(69, 11, 'Scab', '11', 151, 0, 0, 0, 1, NULL, NULL),
(70, 12, 'Anthracnose Mango', '12', 151, 0, 0, 0, 1, NULL, NULL),
(71, 13, 'Stem rot', '13', 151, 0, 0, 0, 1, NULL, NULL),
(72, 14, 'Aspergellus Crown rot', '14', 151, 0, 0, 0, 1, NULL, NULL),
(73, 15, 'Rust', '15', 151, 0, 0, 0, 1, NULL, NULL),
(74, 16, 'Late Leaf Spot', '16', 151, 0, 0, 0, 1, NULL, NULL),
(75, 17, 'Early Leaf Spot', '17', 151, 0, 0, 0, 1, NULL, NULL),
(76, 18, 'Alternaria Blight', '18', 151, 0, 0, 0, 1, NULL, NULL),
(77, 19, 'Anthracnose Cucurbits', '19', 151, 0, 0, 0, 1, NULL, NULL),
(78, 20, 'Powdery Mildew Cucurbits', '20', 151, 0, 0, 0, 1, NULL, NULL),
(79, 21, 'Downy Mildew Cucurbits', '21', 151, 0, 0, 0, 1, NULL, NULL),
(80, 22, 'Damping Off Cucurbits', '22', 151, 0, 0, 0, 1, NULL, NULL),
(81, 23, 'Choanephora Blight', '23', 151, 0, 0, 0, 1, NULL, NULL),
(82, 24, 'Alternaria Leaf Spot', '24', 151, 0, 0, 0, 1, NULL, NULL),
(83, 25, 'Cercospora Leaf Spot Chili', '25', 151, 0, 0, 0, 1, NULL, NULL),
(84, 26, 'Powdery Mildew Chili', '26', 151, 0, 0, 0, 1, NULL, NULL),
(85, 27, 'Damping Off', '27', 151, 0, 0, 0, 1, NULL, NULL),
(86, 28, 'Anthracnose', '28', 151, 0, 0, 0, 1, NULL, NULL),
(87, 29, 'Freckles', '29', 151, 0, 0, 0, 1, NULL, NULL),
(88, 1, 'Botrytis(Grey or Noble Rot)', '1', 231, 0, 0, 0, 1, NULL, NULL),
(89, 2, 'Blast', '2', 231, 0, 0, 0, 1, NULL, NULL),
(90, 3, 'Apple scab', '3', 231, 0, 0, 0, 1, NULL, NULL),
(91, 4, 'Fusarium Wilt', '4', 231, 0, 0, 0, 1, NULL, NULL),
(92, 5, 'Powdery Mildew Tomato', '5', 231, 0, 0, 0, 1, NULL, NULL),
(93, 6, 'Anthracnose Tomato', '6', 231, 0, 0, 0, 1, NULL, NULL),
(94, 7, 'Early Blight Tomato', '7', 231, 0, 0, 0, 1, NULL, NULL),
(95, 8, 'Late Blight Tomato', '8', 231, 0, 0, 0, 1, NULL, NULL),
(96, 9, 'Sooty Mold', '9', 231, 0, 0, 0, 1, NULL, NULL),
(97, 10, 'Diplodia Stem End Rot', '10', 231, 0, 0, 0, 1, NULL, NULL),
(98, 11, 'Scab', '11', 231, 0, 0, 0, 1, NULL, NULL),
(99, 12, 'Anthracnose Mango', '12', 231, 0, 0, 0, 1, NULL, NULL),
(100, 13, 'Stem rot', '13', 231, 0, 0, 0, 1, NULL, NULL),
(101, 14, 'Aspergellus Crown rot', '14', 231, 0, 0, 0, 1, NULL, NULL),
(102, 15, 'Rust', '15', 231, 0, 0, 0, 1, NULL, NULL),
(103, 16, 'Late Leaf Spot', '16', 231, 0, 0, 0, 1, NULL, NULL),
(104, 17, 'Early Leaf Spot', '17', 231, 0, 0, 0, 1, NULL, NULL),
(105, 18, 'Alternaria Blight', '18', 231, 0, 0, 0, 1, NULL, NULL),
(106, 19, 'Anthracnose Cucurbits', '19', 231, 0, 0, 0, 1, NULL, NULL),
(107, 20, 'Powdery Mildew Cucurbits', '20', 231, 0, 0, 0, 1, NULL, NULL),
(108, 21, 'Downy Mildew Cucurbits', '21', 231, 0, 0, 0, 1, NULL, NULL),
(109, 22, 'Damping Off Cucurbits', '22', 231, 0, 0, 0, 1, NULL, NULL),
(110, 23, 'Choanephora Blight', '23', 231, 0, 0, 0, 1, NULL, NULL),
(111, 24, 'Alternaria Leaf Spot', '24', 231, 0, 0, 0, 1, NULL, NULL),
(112, 25, 'Cercospora Leaf Spot Chili', '25', 231, 0, 0, 0, 1, NULL, NULL),
(113, 26, 'Powdery Mildew Chili', '26', 231, 0, 0, 0, 1, NULL, NULL),
(114, 27, 'Damping Off', '27', 231, 0, 0, 0, 1, NULL, NULL),
(115, 28, 'Anthracnose', '28', 231, 0, 0, 0, 1, NULL, NULL),
(116, 29, 'Freckles', '29', 231, 0, 0, 0, 1, NULL, NULL),
(117, 1, 'Botrytis(Grey or Noble Rot)', '1', 170, 0, 0, 0, 1, NULL, NULL),
(118, 2, 'Blast', '2', 170, 0, 0, 0, 1, NULL, NULL),
(119, 3, 'Apple scab', '3', 170, 0, 0, 0, 1, NULL, NULL),
(120, 4, 'Fusarium Wilt', '4', 170, 0, 0, 0, 1, NULL, NULL),
(121, 5, 'Powdery Mildew Tomato', '5', 170, 0, 0, 0, 1, NULL, NULL),
(122, 6, 'Anthracnose Tomato', '6', 170, 0, 0, 0, 1, NULL, NULL),
(123, 7, 'Early Blight Tomato', '7', 170, 0, 0, 0, 1, NULL, NULL),
(124, 8, 'Late Blight Tomato', '8', 170, 0, 0, 0, 1, NULL, NULL),
(125, 9, 'Sooty Mold', '9', 170, 0, 0, 0, 1, NULL, NULL),
(126, 10, 'Diplodia Stem End Rot', '10', 170, 0, 0, 0, 1, NULL, NULL),
(127, 11, 'Scab', '11', 170, 0, 0, 0, 1, NULL, NULL),
(128, 12, 'Anthracnose Mango', '12', 170, 0, 0, 0, 1, NULL, NULL),
(129, 13, 'Stem rot', '13', 170, 0, 0, 0, 1, NULL, NULL),
(130, 14, 'Aspergellus Crown rot', '14', 170, 0, 0, 0, 1, NULL, NULL),
(131, 15, 'Rust', '15', 170, 0, 0, 0, 1, NULL, NULL),
(132, 16, 'Late Leaf Spot', '16', 170, 0, 0, 0, 1, NULL, NULL),
(133, 17, 'Early Leaf Spot', '17', 170, 0, 0, 0, 1, NULL, NULL),
(134, 18, 'Alternaria Blight', '18', 170, 0, 0, 0, 1, NULL, NULL),
(135, 19, 'Anthracnose Cucurbits', '19', 170, 0, 0, 0, 1, NULL, NULL),
(136, 20, 'Powdery Mildew Cucurbits', '20', 170, 0, 0, 0, 1, NULL, NULL),
(137, 21, 'Downy Mildew Cucurbits', '21', 170, 0, 0, 0, 1, NULL, NULL),
(138, 22, 'Damping Off Cucurbits', '22', 170, 0, 0, 0, 1, NULL, NULL),
(139, 23, 'Choanephora Blight', '23', 170, 0, 0, 0, 1, NULL, NULL),
(140, 24, 'Alternaria Leaf Spot', '24', 170, 0, 0, 0, 1, NULL, NULL),
(141, 25, 'Cercospora Leaf Spot Chili', '25', 170, 0, 0, 0, 1, NULL, NULL),
(142, 26, 'Powdery Mildew Chili', '26', 170, 0, 0, 0, 1, NULL, NULL),
(143, 27, 'Damping Off', '27', 170, 0, 0, 0, 1, NULL, NULL),
(144, 28, 'Anthracnose', '28', 170, 0, 0, 0, 1, NULL, NULL),
(145, 29, 'Freckles', '29', 170, 0, 0, 0, 1, NULL, NULL),
(146, 1, 'Botrytis(Grey or Noble Rot)', '1', 190, 0, 0, 0, 1, NULL, NULL),
(147, 2, 'Blast', '2', 190, 0, 0, 0, 1, NULL, NULL),
(148, 3, 'Apple scab', '3', 190, 0, 0, 0, 1, NULL, NULL),
(149, 4, 'Fusarium Wilt', '4', 190, 0, 0, 0, 1, NULL, NULL),
(150, 5, 'Powdery Mildew Tomato', '5', 190, 0, 0, 0, 1, NULL, NULL),
(151, 6, 'Anthracnose Tomato', '6', 190, 0, 0, 0, 1, NULL, NULL),
(152, 7, 'Early Blight Tomato', '7', 190, 0, 0, 0, 1, NULL, NULL),
(153, 8, 'Late Blight Tomato', '8', 190, 0, 0, 0, 1, NULL, NULL),
(154, 9, 'Sooty Mold', '9', 190, 0, 0, 0, 1, NULL, NULL),
(155, 10, 'Diplodia Stem End Rot', '10', 190, 0, 0, 0, 1, NULL, NULL),
(156, 11, 'Scab', '11', 190, 0, 0, 0, 1, NULL, NULL),
(157, 12, 'Anthracnose Mango', '12', 190, 0, 0, 0, 1, NULL, NULL),
(158, 13, 'Stem rot', '13', 190, 0, 0, 0, 1, NULL, NULL),
(159, 14, 'Aspergellus Crown rot', '14', 190, 0, 0, 0, 1, NULL, NULL),
(160, 15, 'Rust', '15', 190, 0, 0, 0, 1, NULL, NULL),
(161, 16, 'Late Leaf Spot', '16', 190, 0, 0, 0, 1, NULL, NULL),
(162, 17, 'Early Leaf Spot', '17', 190, 0, 0, 0, 1, NULL, NULL),
(163, 18, 'Alternaria Blight', '18', 190, 0, 0, 0, 1, NULL, NULL),
(164, 19, 'Anthracnose Cucurbits', '19', 190, 0, 0, 0, 1, NULL, NULL),
(165, 20, 'Powdery Mildew Cucurbits', '20', 190, 0, 0, 0, 1, NULL, NULL),
(166, 21, 'Downy Mildew Cucurbits', '21', 190, 0, 0, 0, 1, NULL, NULL),
(167, 22, 'Damping Off Cucurbits', '22', 190, 0, 0, 0, 1, NULL, NULL),
(168, 23, 'Choanephora Blight', '23', 190, 0, 0, 0, 1, NULL, NULL),
(169, 24, 'Alternaria Leaf Spot', '24', 190, 0, 0, 0, 1, NULL, NULL),
(170, 25, 'Cercospora Leaf Spot Chili', '25', 190, 0, 0, 0, 1, NULL, NULL),
(171, 26, 'Powdery Mildew Chili', '26', 190, 0, 0, 0, 1, NULL, NULL),
(172, 27, 'Damping Off', '27', 190, 0, 0, 0, 1, NULL, NULL),
(173, 28, 'Anthracnose', '28', 190, 0, 0, 0, 1, NULL, NULL),
(174, 29, 'Freckles', '29', 190, 0, 0, 0, 1, NULL, NULL),
(175, 1, 'Botrytis(Grey or Noble Rot)', '1', 208, 0, 0, 0, 1, NULL, NULL),
(176, 2, 'Blast', '2', 208, 0, 0, 0, 1, NULL, NULL),
(177, 3, 'Apple scab', '3', 208, 0, 0, 0, 1, NULL, NULL),
(178, 4, 'Fusarium Wilt', '4', 208, 0, 0, 0, 1, NULL, NULL),
(179, 5, 'Powdery Mildew Tomato', '5', 208, 0, 0, 0, 1, NULL, NULL),
(180, 6, 'Anthracnose Tomato', '6', 208, 0, 0, 0, 1, NULL, NULL),
(181, 7, 'Early Blight Tomato', '7', 208, 0, 0, 0, 1, NULL, NULL),
(182, 8, 'Late Blight Tomato', '8', 208, 0, 0, 0, 1, NULL, NULL),
(183, 9, 'Sooty Mold', '9', 208, 0, 0, 0, 1, NULL, NULL),
(184, 10, 'Diplodia Stem End Rot', '10', 208, 0, 0, 0, 1, NULL, NULL),
(185, 11, 'Scab', '11', 208, 0, 0, 0, 1, NULL, NULL),
(186, 12, 'Anthracnose Mango', '12', 208, 0, 0, 0, 1, NULL, NULL),
(187, 13, 'Stem rot', '13', 208, 0, 0, 0, 1, NULL, NULL),
(188, 14, 'Aspergellus Crown rot', '14', 208, 0, 0, 0, 1, NULL, NULL),
(189, 15, 'Rust', '15', 208, 0, 0, 0, 1, NULL, NULL),
(190, 16, 'Late Leaf Spot', '16', 208, 0, 0, 0, 1, NULL, NULL),
(191, 17, 'Early Leaf Spot', '17', 208, 0, 0, 0, 1, NULL, NULL),
(192, 18, 'Alternaria Blight', '18', 208, 0, 0, 0, 1, NULL, NULL),
(193, 19, 'Anthracnose Cucurbits', '19', 208, 0, 0, 0, 1, NULL, NULL),
(194, 20, 'Powdery Mildew Cucurbits', '20', 208, 0, 0, 0, 1, NULL, NULL),
(195, 21, 'Downy Mildew Cucurbits', '21', 208, 0, 0, 0, 1, NULL, NULL),
(196, 22, 'Damping Off Cucurbits', '22', 208, 0, 0, 0, 1, NULL, NULL),
(197, 23, 'Choanephora Blight', '23', 208, 0, 0, 0, 1, NULL, NULL),
(198, 24, 'Alternaria Leaf Spot', '24', 208, 0, 0, 0, 1, NULL, NULL),
(199, 25, 'Cercospora Leaf Spot Chili', '25', 208, 0, 0, 0, 1, NULL, NULL),
(200, 26, 'Powdery Mildew Chili', '26', 208, 0, 0, 0, 1, NULL, NULL),
(201, 27, 'Damping Off', '27', 208, 0, 0, 0, 1, NULL, NULL),
(202, 28, 'Anthracnose', '28', 208, 0, 0, 0, 1, NULL, NULL),
(203, 29, 'Freckles', '29', 208, 0, 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_disease_crop_product_mapping`
--

CREATE TABLE IF NOT EXISTS `bf_master_disease_crop_product_mapping` (
  `product_crop_disease_id` int(11) NOT NULL AUTO_INCREMENT,
  `pbg_id` int(11) DEFAULT NULL,
  `crop_id` int(11) DEFAULT NULL,
  `disease_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_crop_disease_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `bf_master_disease_crop_product_mapping`
--

INSERT INTO `bf_master_disease_crop_product_mapping` (`product_crop_disease_id`, `pbg_id`, `crop_id`, `disease_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 1, 1, 0, 0, 0, 1, NULL, NULL),
(2, 1, 2, 2, 0, 0, 0, 1, NULL, NULL),
(3, 1, 3, 3, 0, 0, 0, 1, NULL, NULL),
(4, 2, 3, 4, 0, 0, 0, 1, NULL, NULL),
(5, 2, 3, 5, 0, 0, 0, 1, NULL, NULL),
(6, 2, 3, 6, 0, 0, 0, 1, NULL, NULL),
(7, 3, 4, 7, 0, 0, 0, 1, NULL, NULL),
(8, 3, 4, 8, 0, 0, 0, 1, NULL, NULL),
(9, 3, 5, 9, 0, 0, 0, 1, NULL, NULL),
(10, 4, 5, 10, 0, 0, 0, 1, NULL, NULL),
(11, 4, 5, 11, 0, 0, 0, 1, NULL, NULL),
(12, 4, 5, 12, 0, 0, 0, 1, NULL, NULL),
(13, 5, 6, 13, 0, 0, 0, 1, NULL, NULL),
(14, 5, 6, 1, 0, 0, 0, 1, NULL, NULL),
(15, 5, 6, 2, 0, 0, 0, 1, NULL, NULL),
(16, 5, 6, 3, 0, 0, 0, 1, NULL, NULL),
(17, 6, 6, 4, 0, 0, 0, 1, NULL, NULL),
(18, 6, 7, 5, 0, 0, 0, 1, NULL, NULL),
(19, 6, 7, 6, 0, 0, 0, 1, NULL, NULL),
(20, 7, 7, 7, 0, 0, 0, 1, NULL, NULL),
(21, 7, 7, 8, 0, 0, 0, 1, NULL, NULL),
(22, 7, 7, 9, 0, 0, 0, 1, NULL, NULL),
(23, 8, 8, 10, 0, 0, 0, 1, NULL, NULL),
(24, 8, 8, 11, 0, 0, 0, 1, NULL, NULL),
(25, 8, 8, 12, 0, 0, 0, 1, NULL, NULL),
(26, 9, 8, 13, 0, 0, 0, 1, NULL, NULL),
(27, 9, 8, 15, 0, 0, 0, 1, NULL, NULL),
(28, 9, 8, 16, 0, 0, 0, 1, NULL, NULL),
(29, 10, 9, 17, 0, 0, 0, 1, NULL, NULL),
(30, 11, 9, 18, 0, 0, 0, 1, NULL, NULL),
(31, 11, 9, 19, 0, 0, 0, 1, NULL, NULL),
(32, 11, 10, 20, 0, 0, 0, 1, NULL, NULL),
(33, 12, 10, 21, 0, 0, 0, 1, NULL, NULL),
(34, 12, 10, 22, 0, 0, 0, 1, NULL, NULL),
(35, 12, 11, 23, 0, 0, 0, 1, NULL, NULL),
(36, 13, 11, 24, 0, 0, 0, 1, NULL, NULL),
(37, 13, 11, 25, 0, 0, 0, 1, NULL, NULL),
(38, 13, 12, 26, 0, 0, 0, 1, NULL, NULL),
(39, 14, 12, 27, 0, 0, 0, 1, NULL, NULL),
(40, 14, 12, 28, 0, 0, 0, 1, NULL, NULL),
(41, 14, 13, 29, 0, 0, 0, 1, NULL, NULL),
(42, 15, 13, 1, 0, 0, 0, 1, NULL, NULL),
(43, 15, 13, 2, 0, 0, 0, 1, NULL, NULL),
(44, 15, 14, 3, 0, 0, 0, 1, NULL, NULL),
(45, 16, 14, 4, 0, 0, 0, 1, NULL, NULL),
(46, 16, 14, 5, 0, 0, 0, 1, NULL, NULL),
(47, 16, 15, 6, 0, 0, 0, 1, NULL, NULL),
(48, 17, 15, 7, 0, 0, 0, 1, NULL, NULL),
(49, 17, 15, 8, 0, 0, 0, 1, NULL, NULL),
(50, 17, 16, 9, 0, 0, 0, 1, NULL, NULL),
(51, 18, 16, 10, 0, 0, 0, 1, NULL, NULL),
(52, 18, 16, 11, 0, 0, 0, 1, NULL, NULL),
(53, 18, 17, 12, 0, 0, 0, 1, NULL, NULL),
(54, 19, 17, 13, 0, 0, 0, 1, NULL, NULL),
(55, 19, 17, 14, 0, 0, 0, 1, NULL, NULL),
(56, 19, 18, 15, 0, 0, 0, 1, NULL, NULL),
(57, 20, 18, 16, 0, 0, 0, 1, NULL, NULL),
(58, 20, 18, 17, 0, 0, 0, 1, NULL, NULL),
(59, 20, 19, 18, 0, 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_disease_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_disease_regional` (
  `disease_id` int(11) NOT NULL AUTO_INCREMENT,
  `disease_name` varchar(255) DEFAULT NULL,
  `disease_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`disease_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `bf_master_disease_regional`
--

INSERT INTO `bf_master_disease_regional` (`disease_id`, `disease_name`, `disease_code`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Botrytis(Grey or Noble Rot)', '1', 0, 0, 0, 1, NULL, NULL),
(2, 'Blast', '2', 0, 0, 0, 1, NULL, NULL),
(3, 'Apple scab', '3', 0, 0, 0, 1, NULL, NULL),
(4, 'Fusarium Wilt', '4', 0, 0, 0, 1, NULL, NULL),
(5, 'Powdery Mildew Tomato', '5', 0, 0, 0, 1, NULL, NULL),
(6, 'Anthracnose Tomato', '6', 0, 0, 0, 1, NULL, NULL),
(7, 'Early Blight Tomato', '7', 0, 0, 0, 1, NULL, NULL),
(8, 'Late Blight Tomato', '8', 0, 0, 0, 1, NULL, NULL),
(9, 'Sooty Mold', '9', 0, 0, 0, 1, NULL, NULL),
(10, 'Diplodia Stem End Rot', '10', 0, 0, 0, 1, NULL, NULL),
(11, 'Scab', '11', 0, 0, 0, 1, NULL, NULL),
(12, 'Anthracnose Mango', '12', 0, 0, 0, 1, NULL, NULL),
(13, 'Stem rot', '13', 0, 0, 0, 1, NULL, NULL),
(14, 'Aspergellus Crown rot', '14', 0, 0, 0, 1, NULL, NULL),
(15, 'Rust', '15', 0, 0, 0, 1, NULL, NULL),
(16, 'Late Leaf Spot', '16', 0, 0, 0, 1, NULL, NULL),
(17, 'Early Leaf Spot', '17', 0, 0, 0, 1, NULL, NULL),
(18, 'Alternaria Blight', '18', 0, 0, 0, 1, NULL, NULL),
(19, 'Anthracnose Cucurbits', '19', 0, 0, 0, 1, NULL, NULL),
(20, 'Powdery Mildew Cucurbits', '20', 0, 0, 0, 1, NULL, NULL),
(21, 'Downy Mildew Cucurbits', '21', 0, 0, 0, 1, NULL, NULL),
(22, 'Damping Off Cucurbits', '22', 0, 0, 0, 1, NULL, NULL),
(23, 'Choanephora Blight', '23', 0, 0, 0, 1, NULL, NULL),
(24, 'Alternaria Leaf Spot', '24', 0, 0, 0, 1, NULL, NULL),
(25, 'Cercospora Leaf Spot Chili', '25', 0, 0, 0, 1, NULL, NULL),
(26, 'Powdery Mildew Chili', '26', 0, 0, 0, 1, NULL, NULL),
(27, 'Damping Off', '27', 0, 0, 0, 1, NULL, NULL),
(28, 'Anthracnose', '28', 0, 0, 0, 1, NULL, NULL),
(29, 'Freckles', '29', 0, 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_education_specialization`
--

CREATE TABLE IF NOT EXISTS `bf_master_education_specialization` (
  `edu_specialization_id` int(11) NOT NULL AUTO_INCREMENT,
  `edu_specialization_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`edu_specialization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_electonic`
--

CREATE TABLE IF NOT EXISTS `bf_master_electonic` (
  `electonic_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`electonic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_employee_current_profile`
--

CREATE TABLE IF NOT EXISTS `bf_master_employee_current_profile` (
  `profile_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `date_joining` date DEFAULT NULL,
  `date_confirmation` date DEFAULT NULL,
  `date_regisnation` date DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `desigination_id` int(11) DEFAULT NULL,
  `onhold` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_employee_experience_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_employee_experience_details` (
  `experince_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `desigination` varchar(255) DEFAULT NULL,
  `roles_responsibility` text,
  PRIMARY KEY (`experince_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_employee_to_geo`
--

CREATE TABLE IF NOT EXISTS `bf_master_employee_to_geo` (
  `employe_geo_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `geo_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`employe_geo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_employe_to_customer`
--

CREATE TABLE IF NOT EXISTS `bf_master_employe_to_customer` (
  `employe_customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`employe_customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `bf_master_employe_to_customer`
--

INSERT INTO `bf_master_employe_to_customer` (`employe_customer_id`, `customer_id`, `year`, `employee_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 4, '2016-01-01', 20, 0, 0, 0, 1, NULL, NULL),
(2, 5, '2016-01-01', 20, 0, 0, 0, 1, NULL, NULL),
(3, 6, '2016-01-01', 20, 0, 0, 0, 1, NULL, NULL),
(4, 7, '2016-01-01', 21, 0, 0, 0, 1, NULL, NULL),
(5, 8, '2016-01-01', 21, 0, 0, 0, 1, NULL, NULL),
(6, 9, '2016-01-01', 21, 0, 0, 0, 1, NULL, NULL),
(7, 10, '2016-01-01', 22, 0, 0, 0, 1, NULL, NULL),
(8, 11, '2016-01-01', 22, 0, 0, 0, 1, NULL, NULL),
(9, 12, '2016-01-01', 22, 0, 0, 0, 1, NULL, NULL),
(10, 13, '2016-01-01', 22, 0, 0, 0, 1, NULL, NULL),
(11, 14, '2016-01-01', 23, 0, 0, 0, 1, NULL, NULL),
(12, 15, '2016-01-01', 23, 0, 0, 0, 1, NULL, NULL),
(13, 16, '2016-01-01', 23, 0, 0, 0, 1, NULL, NULL),
(14, 17, '2016-01-01', 24, 0, 0, 0, 1, NULL, NULL),
(15, 18, '2016-01-01', 24, 0, 0, 0, 1, NULL, NULL),
(16, 19, '2016-01-01', 24, 0, 0, 0, 1, NULL, NULL),
(17, 25, '2016-01-01', 40, 0, 0, 0, 1, NULL, NULL),
(18, 26, '2016-01-01', 40, 0, 0, 0, 1, NULL, NULL),
(19, 27, '2016-01-01', 40, 0, 0, 0, 1, NULL, NULL),
(20, 28, '2016-01-01', 41, 0, 0, 0, 1, NULL, NULL),
(21, 29, '2016-01-01', 41, 0, 0, 0, 1, NULL, NULL),
(22, 30, '2016-01-01', 41, 0, 0, 0, 1, NULL, NULL),
(23, 31, '2016-01-01', 42, 0, 0, 0, 1, NULL, NULL),
(24, 32, '2016-01-01', 42, 0, 0, 0, 1, NULL, NULL),
(25, 33, '2016-01-01', 42, 0, 0, 0, 1, NULL, NULL),
(26, 34, '2016-01-01', 43, 0, 0, 0, 1, NULL, NULL),
(27, 35, '2016-01-01', 43, 0, 0, 0, 1, NULL, NULL),
(28, 36, '2016-01-01', 43, 0, 0, 0, 1, NULL, NULL),
(29, 37, '2016-01-01', 44, 0, 0, 0, 1, NULL, NULL),
(30, 38, '2016-01-01', 44, 0, 0, 0, 1, NULL, NULL),
(31, 39, '2016-01-01', 44, 0, 0, 0, 1, NULL, NULL),
(32, 14, '2016-01-01', 20, 0, 0, 0, 1, NULL, NULL),
(33, 15, '2016-01-01', 20, 0, 0, 0, 1, NULL, NULL),
(34, 16, '2016-01-01', 20, 0, 0, 0, 1, NULL, NULL),
(35, 17, '2016-01-01', 20, 0, 0, 0, 1, NULL, NULL),
(36, 18, '2016-01-01', 20, 0, 0, 0, 1, NULL, NULL),
(37, 19, '2016-01-01', 20, 0, 0, 0, 1, NULL, NULL),
(38, 9, '2016-01-01', 20, NULL, NULL, 0, 1, NULL, NULL),
(39, 10, '2016-01-01', 20, NULL, NULL, 0, 1, NULL, NULL),
(40, 11, '2016-01-01', 20, NULL, NULL, 0, 1, NULL, NULL),
(41, 12, '2016-01-01', 20, NULL, NULL, 0, 1, NULL, NULL),
(42, 13, '2016-01-01', 20, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_employe_type`
--

CREATE TABLE IF NOT EXISTS `bf_master_employe_type` (
  `employee_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_type_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`employee_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bf_master_employe_type`
--

INSERT INTO `bf_master_employe_type` (`employee_type_id`, `employee_type_name`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Regional HO', 0, 1, NULL, NULL),
(2, 'Country HO', 0, 1, NULL, NULL),
(3, 'Country Employee', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_political_geography_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_political_geography_details` (
  `political_geo_id` int(11) NOT NULL AUTO_INCREMENT,
  `geo_level_id` int(11) DEFAULT NULL,
  `parent_geo_id` int(11) DEFAULT NULL,
  `political_geography_code` varchar(255) DEFAULT NULL,
  `political_geography_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`political_geo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=140 ;

--
-- Dumping data for table `bf_master_political_geography_details`
--

INSERT INTO `bf_master_political_geography_details` (`political_geo_id`, `geo_level_id`, `parent_geo_id`, `political_geography_code`, `political_geography_name`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 6, 0, '1', 'Philippines', NULL, NULL, 0, 1, NULL, NULL),
(2, 5, 1, '1', 'Region I', NULL, NULL, 0, 1, NULL, NULL),
(3, 4, 2, '1', 'Pangasinan', NULL, NULL, 0, 1, NULL, NULL),
(4, 3, 3, '1', 'Malasiqui', NULL, NULL, 0, 1, NULL, NULL),
(5, 2, 4, '1', 'Asin Este', NULL, NULL, 0, 1, NULL, NULL),
(6, 2, 4, '2', 'Asin Weste', NULL, NULL, 0, 1, NULL, NULL),
(7, 2, 4, '3', 'Bacundao Este', NULL, NULL, 0, 1, NULL, NULL),
(8, 2, 4, '4', 'Bacundao Weste', NULL, NULL, 0, 1, NULL, NULL),
(9, 2, 4, '5', 'Bakitiw', NULL, NULL, 0, 1, NULL, NULL),
(10, 2, 4, '6', 'Canan Sur', NULL, NULL, 0, 1, NULL, NULL),
(11, 2, 4, '7', 'Cawayan Bogtong', NULL, NULL, 0, 1, NULL, NULL),
(12, 2, 4, '8', 'Don Pedro', NULL, NULL, 0, 1, NULL, NULL),
(13, 2, 4, '9', 'Gatang', NULL, NULL, 0, 1, NULL, NULL),
(14, 2, 4, '10', 'Manggan-Dampay', NULL, NULL, 0, 1, NULL, NULL),
(15, 2, 4, '11', 'Nancapian', NULL, NULL, 0, 1, NULL, NULL),
(16, 2, 4, '12', 'Nalsian Sur', NULL, NULL, 0, 1, NULL, NULL),
(17, 2, 4, '13', 'Nansangaan', NULL, NULL, 0, 1, NULL, NULL),
(18, 2, 4, '14', 'Talospatang', NULL, NULL, 0, 1, NULL, NULL),
(19, 2, 4, '15', 'Taloy', NULL, NULL, 0, 1, NULL, NULL),
(20, 2, 4, '16', 'Taloyan', NULL, NULL, 0, 1, NULL, NULL),
(21, 2, 4, '17', 'Tambac', NULL, NULL, 0, 1, NULL, NULL),
(22, 2, 4, '18', 'Ungib', NULL, NULL, 0, 1, NULL, NULL),
(23, 2, 4, '19', 'Bolintaguen', NULL, NULL, 0, 1, NULL, NULL),
(24, 2, 4, '20', 'Mantacdang', NULL, NULL, 0, 1, NULL, NULL),
(25, 2, 4, '21', 'Canan Norte', NULL, NULL, 0, 1, NULL, NULL),
(26, 2, 4, '22', 'Waig', NULL, NULL, 0, 1, NULL, NULL),
(27, 2, 4, '23', 'Amacalan', NULL, NULL, 0, 1, NULL, NULL),
(28, 2, 4, '24', 'Apaya', NULL, NULL, 0, 1, NULL, NULL),
(29, 2, 4, '25', 'Banawang', NULL, NULL, 0, 1, NULL, NULL),
(30, 2, 4, '26', 'Bawer', NULL, NULL, 0, 1, NULL, NULL),
(31, 2, 4, '27', 'Butao', NULL, NULL, 0, 1, NULL, NULL),
(32, 2, 4, '28', 'Cabueldatan', NULL, NULL, 0, 1, NULL, NULL),
(33, 2, 4, '29', 'Gomez', NULL, NULL, 0, 1, NULL, NULL),
(34, 2, 4, '30', 'Ican', NULL, NULL, 0, 1, NULL, NULL),
(35, 2, 4, '31', 'Loqueb Sur', NULL, NULL, 0, 1, NULL, NULL),
(36, 2, 4, '32', 'Malimpec', NULL, NULL, 0, 1, NULL, NULL),
(37, 2, 4, '33', 'Olea', NULL, NULL, 0, 1, NULL, NULL),
(38, 2, 4, '34', 'Palapar Norte', NULL, NULL, 0, 1, NULL, NULL),
(39, 2, 4, '35', 'Polong Sur', NULL, NULL, 0, 1, NULL, NULL),
(40, 2, 4, '36', 'Tabo-Sili', NULL, NULL, 0, 1, NULL, NULL),
(41, 2, 4, '37', 'Umando', NULL, NULL, 0, 1, NULL, NULL),
(42, 2, 4, '38', 'Palong', NULL, NULL, 0, 1, NULL, NULL),
(43, 2, 4, '39', 'Lunec', NULL, NULL, 0, 1, NULL, NULL),
(44, 3, 3, '2', 'San Carlos City', NULL, NULL, 0, 1, NULL, NULL),
(45, 2, 44, '40', 'Antipangol', NULL, NULL, 0, 1, NULL, NULL),
(46, 2, 44, '41', 'Bacnar', NULL, NULL, 0, 1, NULL, NULL),
(47, 2, 44, '42', 'Balaya', NULL, NULL, 0, 1, NULL, NULL),
(48, 2, 44, '43', 'Balayong', NULL, NULL, 0, 1, NULL, NULL),
(49, 3, 3, '3', 'Rosales', NULL, NULL, 0, 1, NULL, NULL),
(50, 2, 49, '44', 'Acop', NULL, NULL, 0, 1, NULL, NULL),
(51, 2, 49, '45', 'Bakitbakit', NULL, NULL, 0, 1, NULL, NULL),
(52, 2, 49, '46', 'Balingcanaway', NULL, NULL, 0, 1, NULL, NULL),
(53, 2, 49, '47', 'Rabago', NULL, NULL, 0, 1, NULL, NULL),
(54, 2, 49, '48', 'Rizal', NULL, NULL, 0, 1, NULL, NULL),
(55, 2, 49, '49', 'Salvacion', NULL, NULL, 0, 1, NULL, NULL),
(56, 2, 49, '50', 'San Antonio', NULL, NULL, 0, 1, NULL, NULL),
(57, 2, 49, '51', 'Don Antonio Village', NULL, NULL, 0, 1, NULL, NULL),
(58, 2, 49, '52', 'Zone II (Pob.)', NULL, NULL, 0, 1, NULL, NULL),
(59, 2, 49, '53', 'Zone III (Pob.)', NULL, NULL, 0, 1, NULL, NULL),
(60, 2, 49, '54', 'Zone V (Pob.)', NULL, NULL, 0, 1, NULL, NULL),
(61, 3, 3, '4', 'Tayug', NULL, NULL, 0, 1, NULL, NULL),
(62, 2, 61, '55', 'Guzon', NULL, NULL, 0, 1, NULL, NULL),
(63, 3, 3, '5', 'Malasiqui', NULL, NULL, 0, 1, NULL, NULL),
(64, 2, 63, '56', 'Casantamaria-an', NULL, NULL, 0, 1, NULL, NULL),
(65, 2, 63, '57', 'Bacundao East', NULL, NULL, 0, 1, NULL, NULL),
(66, 5, 1, '2', 'Region II', NULL, NULL, 0, 1, NULL, NULL),
(67, 4, 66, '2', 'Isabela', NULL, NULL, 0, 1, NULL, NULL),
(68, 3, 67, '6', 'San Isidro', NULL, NULL, 0, 1, NULL, NULL),
(69, 2, 68, '58', 'Cabayogan', NULL, NULL, 0, 1, NULL, NULL),
(70, 2, 68, '59', 'Dalimag', NULL, NULL, 0, 1, NULL, NULL),
(71, 2, 68, '60', 'Langbaban', NULL, NULL, 0, 1, NULL, NULL),
(72, 2, 68, '61', 'Manayday', NULL, NULL, 0, 1, NULL, NULL),
(73, 2, 68, '62', 'Rizal West', NULL, NULL, 0, 1, NULL, NULL),
(74, 2, 68, '63', 'Tambacan', NULL, NULL, 0, 1, NULL, NULL),
(75, 2, 68, '64', 'Tigasao', NULL, NULL, 0, 1, NULL, NULL),
(76, 2, 68, '65', 'Caimbang', NULL, NULL, 0, 1, NULL, NULL),
(77, 2, 68, '66', 'Cambansag', NULL, NULL, 0, 1, NULL, NULL),
(78, 2, 68, '67', 'Candungao', NULL, NULL, 0, 1, NULL, NULL),
(79, 2, 68, '68', 'Cansague Norte', NULL, NULL, 0, 1, NULL, NULL),
(80, 2, 68, '69', 'Cambaleon', NULL, NULL, 0, 1, NULL, NULL),
(81, 2, 68, '70', 'Dugmanon', NULL, NULL, 0, 1, NULL, NULL),
(82, 2, 68, '71', 'Iba', NULL, NULL, 0, 1, NULL, NULL),
(83, 2, 68, '72', 'La Union', NULL, NULL, 0, 1, NULL, NULL),
(84, 2, 68, '73', 'Lapu-lapu', NULL, NULL, 0, 1, NULL, NULL),
(85, 2, 68, '74', 'Sawata', NULL, NULL, 0, 1, NULL, NULL),
(86, 2, 68, '75', 'Salvacion', NULL, NULL, 0, 1, NULL, NULL),
(87, 2, 68, '76', 'San Juan', NULL, NULL, 0, 1, NULL, NULL),
(88, 2, 68, '77', 'Seven Hills', NULL, NULL, 0, 1, NULL, NULL),
(89, 2, 68, '78', 'Veriato', NULL, NULL, 0, 1, NULL, NULL),
(90, 2, 68, '79', 'Villaflor', NULL, NULL, 0, 1, NULL, NULL),
(91, 2, 68, '80', 'Patanad', NULL, NULL, 0, 1, NULL, NULL),
(92, 2, 68, '81', 'Pantoc', NULL, NULL, 0, 1, NULL, NULL),
(93, 2, 68, '82', 'Sabtan-olo', NULL, NULL, 0, 1, NULL, NULL),
(94, 2, 68, '83', 'Del Carmen (Pob.)', NULL, NULL, 0, 1, NULL, NULL),
(95, 2, 68, '84', 'Roxas', NULL, NULL, 0, 1, NULL, NULL),
(96, 2, 68, '85', 'Santa Paz', NULL, NULL, 0, 1, NULL, NULL),
(97, 2, 68, '86', 'Abehilan', NULL, NULL, 0, 1, NULL, NULL),
(98, 2, 68, '87', 'Cabanugan', NULL, NULL, 0, 1, NULL, NULL),
(99, 2, 68, '88', 'Cansague Sur', NULL, NULL, 0, 1, NULL, NULL),
(100, 2, 68, '89', 'Masonoy', NULL, NULL, 0, 1, NULL, NULL),
(101, 2, 68, '90', 'Bitaogan', NULL, NULL, 0, 1, NULL, NULL),
(102, 2, 68, '91', 'Manikling', NULL, NULL, 0, 1, NULL, NULL),
(103, 2, 68, '92', 'Batobato (Pob.)', NULL, NULL, 0, 1, NULL, NULL),
(104, 2, 68, '93', 'Talisay', NULL, NULL, 0, 1, NULL, NULL),
(105, 2, 68, '94', 'Alegria', NULL, NULL, 0, 1, NULL, NULL),
(106, 2, 68, '95', 'Mabuhay', NULL, NULL, 0, 1, NULL, NULL),
(107, 2, 68, '96', 'Poblacion Norte', NULL, NULL, 0, 1, NULL, NULL),
(108, 2, 68, '97', 'Dacudao', NULL, NULL, 0, 1, NULL, NULL),
(109, 2, 68, '98', 'Igangon', NULL, NULL, 0, 1, NULL, NULL),
(110, 2, 68, '99', 'Sabangan', NULL, NULL, 0, 1, NULL, NULL),
(111, 2, 68, '100', 'Santo Niño', NULL, NULL, 0, 1, NULL, NULL),
(112, 2, 68, '101', 'Gomez', NULL, NULL, 0, 1, NULL, NULL),
(113, 2, 68, '102', 'Nagbukel', NULL, NULL, 0, 1, NULL, NULL),
(114, 2, 68, '103', 'Rizal East (Pob.)', NULL, NULL, 0, 1, NULL, NULL),
(115, 2, 68, '104', 'Victoria', NULL, NULL, 0, 1, NULL, NULL),
(116, 2, 68, '105', 'Poblacion', NULL, NULL, 0, 1, NULL, NULL),
(117, 2, 68, '106', 'Quezon', NULL, NULL, 0, 1, NULL, NULL),
(118, 2, 68, '107', 'Ramos East', NULL, NULL, 0, 1, NULL, NULL),
(119, 2, 68, '108', 'Ramos West', NULL, NULL, 0, 1, NULL, NULL),
(120, 2, 68, '109', 'Alua', NULL, NULL, 0, 1, NULL, NULL),
(121, 2, 68, '110', 'Calaba', NULL, NULL, 0, 1, NULL, NULL),
(122, 2, 68, '111', 'San Roque', NULL, NULL, 0, 1, NULL, NULL),
(123, 2, 68, '112', 'Biasong', NULL, NULL, 0, 1, NULL, NULL),
(124, 2, 68, '113', 'Cabungaan', NULL, NULL, 0, 1, NULL, NULL),
(125, 2, 68, '114', 'Matungao', NULL, NULL, 0, 1, NULL, NULL),
(126, 6, 0, '1', 'Indonesia', NULL, NULL, 0, 1, NULL, NULL),
(127, 5, 126, '1', 'Sulawesi Selatan', NULL, NULL, 0, 1, NULL, NULL),
(128, 4, 127, '1', 'Jeneponto', NULL, NULL, 0, 1, NULL, NULL),
(129, 3, 128, '1', 'Batang 1', NULL, NULL, 0, 1, NULL, NULL),
(130, 2, 129, '1', 'Kaluku', NULL, NULL, 0, 1, NULL, NULL),
(131, 2, 129, '2', 'Bontoraya', NULL, NULL, 0, 1, NULL, NULL),
(132, 5, 126, '2', 'Lampung', NULL, NULL, 0, 1, NULL, NULL),
(133, 4, 132, '2', 'Lampung Timur', NULL, NULL, 0, 1, NULL, NULL),
(134, 3, 133, '2', 'Batanghari', NULL, NULL, 0, 1, NULL, NULL),
(135, 2, 134, '3', 'Sri Basuki', NULL, NULL, 0, 1, NULL, NULL),
(136, 2, 134, '4', 'Rejo Agung', NULL, NULL, 0, 1, NULL, NULL),
(137, 2, 134, '5', 'Sumber Rejo', NULL, NULL, 0, 1, NULL, NULL),
(138, 2, 134, '6', 'Banar Joyo', NULL, NULL, 0, 1, NULL, NULL),
(139, 2, 134, '7', 'Bumi Mas', NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_political_geography_level_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_political_geography_level_country` (
  `political_geography_countrylevel_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) DEFAULT NULL,
  `level_name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`political_geography_countrylevel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `bf_master_political_geography_level_country`
--

INSERT INTO `bf_master_political_geography_level_country` (`political_geography_countrylevel_id`, `level_id`, `level_name`, `country_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'Market\r\n', 101, NULL, NULL, 0, 1, NULL, NULL),
(2, 2, 'Village', 101, NULL, NULL, 0, 1, NULL, NULL),
(3, 3, 'Territory\r\n', 101, NULL, NULL, 0, 1, NULL, NULL),
(4, 4, 'Area\r\n', 101, NULL, NULL, 0, 1, NULL, NULL),
(5, 5, 'Zone\r\n', 101, NULL, NULL, 0, 1, NULL, NULL),
(6, 6, 'Country\r\n', 101, NULL, NULL, 0, 1, NULL, NULL),
(7, 1, 'Dusun\r\n', 98, NULL, NULL, 0, 1, NULL, NULL),
(8, 2, 'Desa\r\n', 98, NULL, NULL, 0, 1, NULL, NULL),
(9, 3, 'Kechamaten\r\n', 98, NULL, NULL, 0, 1, NULL, NULL),
(10, 4, 'Kabupaten\r\n', 98, NULL, NULL, 0, 1, NULL, NULL),
(11, 5, 'Province\r\n', 98, NULL, NULL, 0, 1, NULL, NULL),
(12, 6, 'Country\r\n', 98, NULL, NULL, 0, 1, NULL, NULL),
(13, 1, 'Market\r\n', 151, NULL, NULL, 0, 1, NULL, NULL),
(14, 2, 'Village', 151, NULL, NULL, 0, 1, NULL, NULL),
(15, 3, 'Sub District\r\n', 151, NULL, NULL, 0, 1, NULL, NULL),
(16, 4, 'District\r\n', 151, NULL, NULL, 0, 1, NULL, NULL),
(17, 5, 'State\r\n', 151, NULL, NULL, 0, 1, NULL, NULL),
(18, 6, 'Country\r\n', 151, NULL, NULL, 0, 1, NULL, NULL),
(19, 1, 'Market\r\n', 231, NULL, NULL, 0, 1, NULL, NULL),
(20, 2, 'Sub District\r\n', 231, NULL, NULL, 0, 1, NULL, NULL),
(21, 3, 'District\r\n', 231, NULL, NULL, 0, 1, NULL, NULL),
(22, 4, 'Region\r\n', 231, NULL, NULL, 0, 1, NULL, NULL),
(23, 5, 'Province\r\n', 231, NULL, NULL, 0, 1, NULL, NULL),
(24, 6, 'Country\r\n', 231, NULL, NULL, 0, 1, NULL, NULL),
(25, 1, 'Market\r\n', 170, NULL, NULL, 0, 1, NULL, NULL),
(26, 2, 'Village', 170, NULL, NULL, 0, 1, NULL, NULL),
(27, 3, 'City\r\n', 170, NULL, NULL, 0, 1, NULL, NULL),
(28, 4, 'Province\r\n', 170, NULL, NULL, 0, 1, NULL, NULL),
(29, 5, 'Region\r\n', 170, NULL, NULL, 0, 1, NULL, NULL),
(30, 6, 'Country\r\n', 170, NULL, NULL, 0, 1, NULL, NULL),
(31, 1, 'Market\r\n', 190, NULL, NULL, 0, 1, NULL, NULL),
(32, 2, 'Village', 190, NULL, NULL, 0, 1, NULL, NULL),
(33, 3, 'Area\r\n', 190, NULL, NULL, 0, 1, NULL, NULL),
(34, 4, 'State\r\n', 190, NULL, NULL, 0, 1, NULL, NULL),
(35, 5, 'Province\r\n', 190, NULL, NULL, 0, 1, NULL, NULL),
(36, 6, 'Country\r\n', 190, NULL, NULL, 0, 1, NULL, NULL),
(37, 1, 'Market\r\n', 208, NULL, NULL, 0, 1, NULL, NULL),
(38, 2, 'Village', 208, NULL, NULL, 0, 1, NULL, NULL),
(39, 3, 'Area\r\n', 208, NULL, NULL, 0, 1, NULL, NULL),
(40, 4, 'State\r\n', 208, NULL, NULL, 0, 1, NULL, NULL),
(41, 5, 'Province\r\n', 208, NULL, NULL, 0, 1, NULL, NULL),
(42, 6, 'Country\r\n', 208, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_political_geography_level_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_political_geography_level_regional` (
  `political_geography_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) DEFAULT NULL,
  `level_name` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`political_geography_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `bf_master_political_geography_level_regional`
--

INSERT INTO `bf_master_political_geography_level_regional` (`political_geography_level_id`, `level`, `level_name`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 'L1', 'Market\r\n', NULL, NULL, 0, 1, NULL, NULL),
(2, 'L2', 'Village\r\n', NULL, NULL, 0, 1, NULL, NULL),
(3, 'L3', 'Area\r\n', NULL, NULL, 0, 1, NULL, NULL),
(4, 'L4', 'State\r\n', NULL, NULL, 0, 1, NULL, NULL),
(5, 'L5', 'Province\r\n', NULL, NULL, 0, 1, NULL, NULL),
(6, 'L6', 'Country\r\n', NULL, NULL, 0, 1, NULL, NULL),
(7, 'L7', NULL, NULL, NULL, 0, 1, NULL, NULL),
(8, 'L8', NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_price`
--

CREATE TABLE IF NOT EXISTS `bf_master_price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `price_type` varchar(255) DEFAULT NULL,
  `PBG_id` int(11) DEFAULT NULL,
  `product_sku_country_id` int(11) DEFAULT NULL,
  `price` decimal(9,2) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_product_sku_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_product_sku_country` (
  `product_sku_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sku_id` int(11) DEFAULT NULL,
  `product_sku_name` varchar(255) DEFAULT NULL,
  `product_sort_name` varchar(255) DEFAULT NULL,
  `product_regional_id1` int(11) DEFAULT NULL,
  `product_regional_id2` int(11) DEFAULT NULL,
  `product_regional_id3` int(11) DEFAULT NULL,
  `product_regional_id4` int(11) DEFAULT NULL,
  `product_regional_id5` int(11) DEFAULT NULL,
  `product_regional_id6` int(11) DEFAULT NULL,
  `PBG` int(11) DEFAULT NULL,
  `no_of_units` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `ref_code1` varchar(255) DEFAULT NULL,
  `ref_code2` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_sku_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `bf_master_product_sku_country`
--

INSERT INTO `bf_master_product_sku_country` (`product_sku_country_id`, `product_sku_id`, `product_sku_name`, `product_sort_name`, `product_regional_id1`, `product_regional_id2`, `product_regional_id3`, `product_regional_id4`, `product_regional_id5`, `product_regional_id6`, `PBG`, `no_of_units`, `country_id`, `ref_code1`, `ref_code2`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'A1', 'A1', 1, 48, 51, 57, 0, 0, 1, 1, 101, '10000001', '100000011', NULL, NULL, 0, 1, NULL, NULL),
(2, 2, 'A2', 'A2', 1, 48, 51, 57, 0, 0, 1, 2, 101, '10000002', '100000021', NULL, NULL, 0, 1, NULL, NULL),
(3, 3, 'B3', 'B3', 2, 49, 52, 58, 0, 0, 1, 3, 101, '10000003', '100000031', NULL, NULL, 0, 1, NULL, NULL),
(4, 0, 'B4', 'B4', 2, 49, 52, 58, 0, 0, 1, 4, 101, '10000004', '100000041', NULL, NULL, 0, 1, NULL, NULL),
(5, 0, 'C103', 'C103', 3, 50, 53, 59, 0, 0, 1, 5, 101, '10000005', '100000051', NULL, NULL, 0, 1, NULL, NULL),
(6, 0, 'C5', 'C5', 3, 50, 53, 59, 0, 0, 1, 6, 101, '10000006', '100000061', NULL, NULL, 0, 1, NULL, NULL),
(7, 0, 'C6', 'C6', 3, 50, 53, 59, 0, 0, 1, 7, 101, '10000007', '100000071', NULL, NULL, 0, 1, NULL, NULL),
(8, 0, 'C7', 'C7', 3, 50, 53, 59, 0, 0, 1, 8, 101, '10000008', '100000081', NULL, NULL, 0, 1, NULL, NULL),
(9, 0, 'C8', 'C8', 3, 50, 53, 59, 0, 0, 1, 9, 101, '10000009', '100000091', NULL, NULL, 0, 1, NULL, NULL),
(10, 0, 'D10', 'D10', 4, 48, 54, 60, 0, 0, 1, 1, 101, '10000010', '100000101', NULL, NULL, 0, 1, NULL, NULL),
(11, 0, 'D9', 'D9', 4, 48, 54, 60, 0, 0, 1, 2, 101, '10000011', '100000111', NULL, NULL, 0, 1, NULL, NULL),
(12, 0, 'E105', 'E105', 5, 49, 55, 57, 0, 0, 1, 3, 101, '10000012', '100000121', NULL, NULL, 0, 1, NULL, NULL),
(13, 0, 'E11', 'E11', 5, 49, 0, 57, 0, 0, 1, 4, 101, '10000013', '100000131', NULL, NULL, 0, 1, NULL, NULL),
(14, 0, 'E12', 'E12', 5, 49, 55, 57, 0, 0, 1, 5, 101, '10000014', '100000141', NULL, NULL, 0, 1, NULL, NULL),
(15, 0, 'F13', 'F13', 6, 50, 56, 58, 0, 0, 1, 6, 101, '10000015', '100000151', NULL, NULL, 0, 1, NULL, NULL),
(16, 0, 'F14', 'F14', 6, 50, 56, 58, 0, 0, 1, 7, 101, '10000016', '100000161', NULL, NULL, 0, 1, NULL, NULL),
(17, 0, 'G15', 'G15', 7, 48, 51, 59, 0, 0, 1, 8, 101, '10000017', '100000171', NULL, NULL, 0, 1, NULL, NULL),
(18, 0, 'G16', 'G16', 7, 48, 51, 59, 0, 0, 1, 9, 101, '10000018', '100000181', NULL, NULL, 0, 1, NULL, NULL),
(19, 0, 'G17', 'G17', 7, 48, 51, 59, 0, 0, 1, 1, 101, '10000019', '100000191', NULL, NULL, 0, 1, NULL, NULL),
(20, 0, 'H18', 'H18', 8, 49, 52, 60, 0, 0, 1, 2, 101, '10000020', '100000201', NULL, NULL, 0, 1, NULL, NULL),
(21, 0, 'I111', 'I111', 9, 50, 53, 57, 0, 0, 1, 3, 101, '10000021', '100000211', NULL, NULL, 0, 1, NULL, NULL),
(22, 0, 'I19', 'I19', 9, 50, 53, 57, 0, 0, 1, 4, 101, '10000022', '100000221', NULL, NULL, 0, 1, NULL, NULL),
(23, 0, 'I80', 'I80', 9, 50, 53, 57, 0, 0, 1, 5, 101, '10000023', '100000231', NULL, NULL, 0, 1, NULL, NULL),
(24, 0, 'I81', 'I81', 9, 50, 53, 57, 0, 0, 1, 6, 101, '10000024', '100000241', NULL, NULL, 0, 1, NULL, NULL),
(25, 0, 'J20', 'J20', 10, 48, 54, 58, 0, 0, 1, 7, 101, '10000025', '100000251', NULL, NULL, 0, 1, NULL, NULL),
(26, 0, 'J84', 'J84', 10, 48, 54, 58, 0, 0, 1, 8, 101, '10000026', '100000261', NULL, NULL, 0, 1, NULL, NULL),
(27, 0, 'K21', 'K21', 11, 49, 55, 59, 0, 0, 1, 9, 101, '10000027', '100000271', NULL, NULL, 0, 1, NULL, NULL),
(28, 0, 'K22', 'K22', 11, 49, 55, 59, 0, 0, 1, 1, 101, '10000028', '100000281', NULL, NULL, 0, 1, NULL, NULL),
(29, 0, 'L23', 'L23', 12, 50, 56, 60, 0, 0, 1, 2, 101, '10000029', '100000291', NULL, NULL, 0, 1, NULL, NULL),
(30, 0, 'L24', 'L24', 12, 50, 56, 60, 0, 0, 1, 3, 101, '10000030', '100000301', NULL, NULL, 0, 1, NULL, NULL),
(31, 0, 'L25', 'L25', 12, 50, 56, 60, 0, 0, 1, 4, 101, '10000031', '100000311', NULL, NULL, 0, 1, NULL, NULL),
(32, 0, 'M118', 'M118', 13, 48, 51, 57, 0, 0, 1, 5, 101, '10000032', '100000321', NULL, NULL, 0, 1, NULL, NULL),
(33, 0, 'M26', 'M26', 13, 48, 51, 57, 0, 0, 1, 6, 101, '10000033', '100000331', NULL, NULL, 0, 1, NULL, NULL),
(34, 0, 'M27', 'M27', 13, 48, 51, 57, 0, 0, 1, 7, 101, '10000034', '100000341', NULL, NULL, 0, 1, NULL, NULL),
(35, 0, 'N28', 'N28', 14, 49, 52, 58, 0, 0, 1, 8, 101, '10000035', '100000351', NULL, NULL, 0, 1, NULL, NULL),
(36, 0, 'N29', 'N29', 14, 49, 52, 58, 0, 0, 1, 9, 101, '10000036', '100000361', NULL, NULL, 0, 1, NULL, NULL),
(37, 0, 'N30', 'N30', 14, 49, 52, 58, 0, 0, 1, 1, 101, '10000037', '100000371', NULL, NULL, 0, 1, NULL, NULL),
(38, 0, 'N31', 'N31', 14, 49, 52, 58, 0, 0, 1, 2, 101, '10000038', '100000381', NULL, NULL, 0, 1, NULL, NULL),
(39, 0, 'N32', 'N32', 14, 49, 52, 58, 0, 0, 1, 3, 101, '10000039', '100000391', NULL, NULL, 0, 1, NULL, NULL),
(40, 0, 'N88', 'N88', 14, 49, 52, 58, 0, 0, 1, 4, 101, '10000040', '100000401', NULL, NULL, 0, 1, NULL, NULL),
(41, 0, 'O33', 'O33', 15, 50, 53, 59, 0, 0, 1, 5, 101, '10000041', '100000411', NULL, NULL, 0, 1, NULL, NULL),
(42, 0, 'P34', 'P34', 16, 48, 54, 60, 0, 0, 1, 6, 101, '10000042', '100000421', NULL, NULL, 0, 1, NULL, NULL),
(43, 0, 'P35', 'P35', 16, 48, 54, 60, 0, 0, 1, 7, 101, '10000043', '100000431', NULL, NULL, 0, 1, NULL, NULL),
(44, 0, 'Q36', 'Q36', 17, 49, 55, 57, 0, 0, 1, 8, 101, '10000044', '100000441', NULL, NULL, 0, 1, NULL, NULL),
(45, 0, 'R37', 'R37', 18, 50, 56, 58, 0, 0, 1, 9, 101, '10000045', '100000451', NULL, NULL, 0, 1, NULL, NULL),
(46, 0, 'S38', 'S38', 19, 48, 51, 59, 0, 0, 1, 1, 101, '10000046', '100000461', NULL, NULL, 0, 1, NULL, NULL),
(47, 0, 'T39', 'T39', 20, 49, 52, 60, 0, 0, 1, 2, 101, '10000047', '100000471', NULL, NULL, 0, 1, NULL, NULL),
(48, 0, 'T40', 'T40', 20, 49, 52, 60, 0, 0, 1, 3, 101, '10000048', '100000481', NULL, NULL, 0, 1, NULL, NULL),
(49, 0, 'T41', 'T41', 20, 49, 52, 60, 0, 0, 1, 4, 101, '10000049', '100000491', NULL, NULL, 0, 1, NULL, NULL),
(50, 0, 'T94', 'T94', 20, 49, 52, 60, 0, 0, 1, 5, 101, '10000050', '100000501', NULL, NULL, 0, 1, NULL, NULL),
(51, 0, 'U42', 'U42', 21, 50, 53, 57, 0, 0, 1, 6, 101, '10000051', '100000511', NULL, NULL, 0, 1, NULL, NULL),
(52, 0, 'U43', 'U43', 21, 50, 53, 57, 0, 0, 1, 7, 101, '10000052', '100000521', NULL, NULL, 0, 1, NULL, NULL),
(53, 0, 'U44', 'U44', 21, 50, 53, 57, 0, 0, 1, 8, 101, '10000053', '100000531', NULL, NULL, 0, 1, NULL, NULL),
(54, 0, 'U45', 'U45', 21, 50, 53, 57, 0, 0, 1, 9, 101, '10000054', '100000541', NULL, NULL, 0, 1, NULL, NULL),
(55, 0, 'U46', 'U46', 21, 50, 53, 57, 0, 0, 1, 1, 101, '10000055', '100000551', NULL, NULL, 0, 1, NULL, NULL),
(56, 0, 'U47', 'U47', 21, 50, 53, 57, 0, 0, 1, 2, 101, '10000056', '100000561', NULL, NULL, 0, 1, NULL, NULL),
(57, 0, 'U79', 'U79', 21, 50, 53, 57, 0, 0, 1, 3, 101, '10000057', '100000571', NULL, NULL, 0, 1, NULL, NULL),
(58, 0, 'U91', 'U91', 21, 50, 53, 57, 0, 0, 1, 4, 101, '10000058', '100000581', NULL, NULL, 0, 1, NULL, NULL),
(59, 0, 'V113', 'V113', 22, 48, 54, 58, 0, 0, 1, 5, 101, '10000059', '100000591', NULL, NULL, 0, 1, NULL, NULL),
(60, 0, 'V114', 'V114', 22, 48, 54, 58, 0, 0, 1, 6, 101, '10000060', '100000601', NULL, NULL, 0, 1, NULL, NULL),
(61, 0, 'V116', 'V116', 22, 48, 54, 58, 0, 0, 1, 7, 101, '10000061', '100000611', NULL, NULL, 0, 1, NULL, NULL),
(62, 0, 'V117', 'V117', 22, 48, 54, 58, 0, 0, 1, 8, 101, '10000062', '100000621', NULL, NULL, 0, 1, NULL, NULL),
(63, 0, 'V48', 'V48', 22, 48, 54, 58, 0, 0, 1, 9, 101, '10000063', '100000631', NULL, NULL, 0, 1, NULL, NULL),
(64, 0, 'V49', 'V49', 22, 48, 54, 58, 0, 0, 1, 1, 101, '10000064', '100000641', NULL, NULL, 0, 1, NULL, NULL),
(65, 0, 'V50', 'V50', 22, 48, 54, 58, 0, 0, 1, 2, 101, '10000065', '100000651', NULL, NULL, 0, 1, NULL, NULL),
(66, 0, 'V51', 'V51', 22, 48, 54, 58, 0, 0, 1, 3, 101, '10000066', '100000661', NULL, NULL, 0, 1, NULL, NULL),
(67, 0, 'W52', 'W52', 23, 49, 55, 59, 0, 0, 1, 4, 101, '10000067', '100000671', NULL, NULL, 0, 1, NULL, NULL),
(68, 0, 'W53', 'W53', 23, 49, 55, 59, 0, 0, 1, 5, 101, '10000068', '100000681', NULL, NULL, 0, 1, NULL, NULL),
(69, 0, 'W54', 'W54', 23, 49, 55, 59, 0, 0, 1, 6, 101, '10000069', '100000691', NULL, NULL, 0, 1, NULL, NULL),
(70, 0, 'W92', 'W92', 23, 49, 55, 59, 0, 0, 1, 7, 101, '10000070', '100000701', NULL, NULL, 0, 1, NULL, NULL),
(71, 0, 'W93', 'W93', 23, 49, 55, 59, 0, 0, 1, 8, 101, '10000071', '100000711', NULL, NULL, 0, 1, NULL, NULL),
(72, 0, 'W95', 'W95', 23, 49, 55, 59, 0, 0, 1, 9, 101, '10000072', '100000721', NULL, NULL, 0, 1, NULL, NULL),
(73, 0, 'X108', 'X108', 24, 50, 56, 60, 0, 0, 1, 1, 101, '10000073', '100000731', NULL, NULL, 0, 1, NULL, NULL),
(74, 0, 'X55', 'X55', 24, 50, 56, 60, 0, 0, 1, 2, 101, '10000074', '100000741', NULL, NULL, 0, 1, NULL, NULL),
(75, 0, 'X56', 'X56', 24, 50, 56, 60, 0, 0, 1, 3, 101, '10000075', '100000751', NULL, NULL, 0, 1, NULL, NULL),
(76, 0, 'X57', 'X57', 24, 50, 56, 60, 0, 0, 1, 4, 101, '10000076', '100000761', NULL, NULL, 0, 1, NULL, NULL),
(77, 0, 'X58', 'X58', 24, 50, 56, 60, 0, 0, 1, 5, 101, '10000077', '100000771', NULL, NULL, 0, 1, NULL, NULL),
(78, 0, 'X59', 'X59', 24, 50, 56, 60, 0, 0, 1, 6, 101, '10000078', '100000781', NULL, NULL, 0, 1, NULL, NULL),
(79, 0, 'Y60', 'Y60', 25, 48, 51, 57, 0, 0, 1, 7, 101, '10000079', '100000791', NULL, NULL, 0, 1, NULL, NULL),
(80, 0, 'Y87', 'Y87', 25, 48, 51, 57, 0, 0, 1, 8, 101, '10000080', '100000801', NULL, NULL, 0, 1, NULL, NULL),
(81, 0, 'Z61', 'Z61', 26, 49, 52, 58, 0, 0, 1, 9, 101, '10000081', '100000811', NULL, NULL, 0, 1, NULL, NULL),
(82, 0, 'AA62', 'AA62', 27, 50, 53, 59, 0, 0, 1, 1, 101, '10000082', '100000821', NULL, NULL, 0, 1, NULL, NULL),
(83, 0, 'AA89', 'AA89', 27, 50, 53, 59, 0, 0, 1, 2, 101, '10000083', '100000831', NULL, NULL, 0, 1, NULL, NULL),
(84, 0, 'AB63', 'AB63', 28, 48, 54, 60, 0, 0, 1, 3, 101, '10000084', '100000841', NULL, NULL, 0, 1, NULL, NULL),
(85, 0, 'AC64', 'AC64', 29, 49, 55, 57, 0, 0, 1, 4, 101, '10000085', '100000851', NULL, NULL, 0, 1, NULL, NULL),
(86, 0, 'AD65', 'AD65', 30, 50, 56, 58, 0, 0, 1, 5, 101, '10000086', '100000861', NULL, NULL, 0, 1, NULL, NULL),
(87, 0, 'AE66', 'AE66', 31, 48, 51, 59, 0, 0, 1, 6, 101, '10000087', '100000871', NULL, NULL, 0, 1, NULL, NULL),
(88, 0, 'AE86', 'AE86', 31, 48, 51, 59, 0, 0, 1, 4, 101, '10000088', '100000881', NULL, NULL, 0, 1, NULL, NULL),
(89, 0, 'AF67', 'AF67', 32, 49, 52, 60, 0, 0, 1, 8, 101, '10000089', '100000891', NULL, NULL, 0, 1, NULL, NULL),
(90, 0, 'AG68', 'AG68', 33, 50, 53, 57, 0, 0, 1, 9, 101, '10000090', '100000901', NULL, NULL, 0, 1, NULL, NULL),
(91, 0, 'AH110', 'AH110', 34, 48, 54, 58, 0, 0, 1, 4, 101, '10000091', '100000911', NULL, NULL, 0, 1, NULL, NULL),
(92, 0, 'AH69', 'AH69', 34, 48, 54, 58, 0, 0, 1, 2, 101, '10000092', '100000921', NULL, NULL, 0, 1, NULL, NULL),
(93, 0, 'AI70', 'AI70', 35, 49, 55, 59, 0, 0, 1, 3, 101, '10000093', '100000931', NULL, NULL, 0, 1, NULL, NULL),
(94, 0, 'AJ71', 'AJ71', 36, 50, 56, 60, 0, 0, 1, 4, 101, '10000094', '100000941', NULL, NULL, 0, 1, NULL, NULL),
(95, 0, 'AJ72', 'AJ72', 36, 50, 56, 60, 0, 0, 1, 5, 101, '10000095', '100000951', NULL, NULL, 0, 1, NULL, NULL),
(96, 0, 'AK73', 'AK73', 37, 48, 51, 57, 0, 0, 1, 6, 101, '10000096', '100000961', NULL, NULL, 0, 1, NULL, NULL),
(97, 0, 'AK74', 'AK74', 37, 48, 51, 57, 0, 0, 1, 7, 101, '10000097', '100000971', NULL, NULL, 0, 1, NULL, NULL),
(98, 0, 'AK97', 'AK97', 37, 48, 51, 57, 0, 0, 1, 8, 101, '10000098', '100000981', NULL, NULL, 0, 1, NULL, NULL),
(99, 0, 'AL75', 'AL75', 38, 49, 52, 58, 0, 0, 1, 9, 101, '10000099', '100000991', NULL, NULL, 0, 1, NULL, NULL),
(100, 0, 'AL83', 'AL83', 38, 49, 52, 58, 0, 0, 1, 1, 101, '10000100', '100001001', NULL, NULL, 0, 1, NULL, NULL),
(101, 0, 'AM76', 'AM76', 39, 50, 53, 59, 0, 0, 1, 2, 101, '10000101', '100001011', NULL, NULL, 0, 1, NULL, NULL),
(102, 0, 'AM77', 'AM77', 39, 50, 53, 59, 0, 0, 1, 3, 101, '10000102', '100001021', NULL, NULL, 0, 1, NULL, NULL),
(103, 0, 'AN101', 'AN101', 40, 48, 54, 60, 0, 0, 1, 4, 101, '10000103', '100001031', NULL, NULL, 0, 1, NULL, NULL),
(104, 0, 'AN78', 'AN78', 40, 48, 54, 60, 0, 0, 1, 5, 101, '10000104', '100001041', NULL, NULL, 0, 1, NULL, NULL),
(105, 0, 'AN96', 'AN96', 40, 48, 54, 60, 0, 0, 1, 6, 101, '10000105', '100001051', NULL, NULL, 0, 1, NULL, NULL),
(106, 0, 'AO82', 'AO82', 41, 49, 55, 57, 0, 0, 1, 7, 101, '10000106', '100001061', NULL, NULL, 0, 1, NULL, NULL),
(107, 0, 'AP112', 'AP112', 42, 50, 56, 58, 0, 0, 1, 8, 101, '10000107', '100001071', NULL, NULL, 0, 1, NULL, NULL),
(108, 0, 'AP85', 'AP85', 42, 50, 56, 58, 0, 0, 1, 9, 101, '10000108', '100001081', NULL, NULL, 0, 1, NULL, NULL),
(109, 0, 'AQ90', 'AQ90', 43, 48, 51, 59, 0, 0, 1, 4, 101, '10000109', '100001091', NULL, NULL, 0, 1, NULL, NULL),
(110, 0, 'AR106', 'AR106', 44, 49, 52, 60, 0, 0, 1, 2, 101, '10000110', '100001101', NULL, NULL, 0, 1, NULL, NULL),
(111, 0, 'AR107', 'AR107', 44, 49, 52, 60, 0, 0, 1, 3, 101, '10000111', '100001111', NULL, NULL, 0, 1, NULL, NULL),
(112, 0, 'AR98', 'AR98', 44, 49, 52, 60, 0, 0, 1, 4, 101, '10000112', '100001121', NULL, NULL, 0, 1, NULL, NULL),
(113, 0, 'AR99', 'AR99', 44, 49, 52, 60, 0, 0, 1, 5, 101, '10000113', '100001131', NULL, NULL, 0, 1, NULL, NULL),
(114, 0, 'AS100', 'AS100', 45, 50, 53, 57, 0, 0, 1, 6, 101, '10000114', '100001141', NULL, NULL, 0, 1, NULL, NULL),
(115, 0, 'AS109', 'AS109', 45, 50, 53, 57, 0, 0, 1, 7, 101, '10000115', '100001151', NULL, NULL, 0, 1, NULL, NULL),
(116, 0, 'AS115', 'AS115', 45, 50, 53, 57, 0, 0, 1, 8, 101, '10000116', '100001161', NULL, NULL, 0, 1, NULL, NULL),
(117, 0, 'AT102', 'AT102', 46, 48, 54, 58, 0, 0, 1, 9, 101, '10000117', '100001171', NULL, NULL, 0, 1, NULL, NULL),
(118, 0, 'AU104', 'AU104', 47, 49, 55, 59, 0, 0, 1, 1, 101, '10000118', '100001181', NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_product_sku_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_product_sku_regional` (
  `product_sku_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_regional_id1` int(11) DEFAULT NULL,
  `product_regional_id2` int(11) DEFAULT NULL,
  `product_regional_id3` int(11) DEFAULT NULL,
  `product_regional_id4` int(11) DEFAULT NULL,
  `product_regional_id5` int(11) DEFAULT NULL,
  `product_regional_id6` int(11) DEFAULT NULL,
  `product_sku_code` varchar(255) DEFAULT NULL,
  `product_sku_name` varchar(255) DEFAULT NULL,
  `product_sort_name` varchar(255) DEFAULT NULL,
  `product_technical_name` varchar(255) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `product_sku_size` varchar(255) DEFAULT NULL,
  `PBG` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_sku_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `bf_master_product_sku_regional`
--

INSERT INTO `bf_master_product_sku_regional` (`product_sku_id`, `product_regional_id1`, `product_regional_id2`, `product_regional_id3`, `product_regional_id4`, `product_regional_id5`, `product_regional_id6`, `product_sku_code`, `product_sku_name`, `product_sort_name`, `product_technical_name`, `uom_id`, `product_sku_size`, `PBG`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 48, 51, 57, 0, 0, '58515696', 'A1', 'A1', 'A1', 1, '3.2 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(2, 1, 48, 51, 57, 0, 0, '58515719', 'A2', 'A2', 'A2', 1, '4.8 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(3, 2, 49, 52, 58, 0, 0, '58551281', 'B3', 'B3', 'B3', 1, '10 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(4, 2, 49, 52, 58, 0, 0, '58555920', 'B4', 'B4', 'B4', 1, '10 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(5, 3, 50, 53, 59, 0, 0, '58276573', 'C103', 'C103', 'C103', 2, '200 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(6, 3, 50, 53, 59, 0, 0, '58637497', 'C5', 'C5', 'C5', 2, '6 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(7, 3, 50, 53, 59, 0, 0, '58646826', 'C6', 'C6', 'C6', 2, '4.8 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(8, 3, 50, 53, 59, 0, 0, '58929356', 'C7', 'C7', 'C7', 2, '4.8 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(9, 3, 50, 53, 59, 0, 0, '58930987', 'C8', 'C8', 'C8', 2, '20 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(10, 4, 48, 54, 60, 0, 0, '58902014', 'D10', 'D10', 'D10', 2, '4 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(11, 4, 48, 54, 60, 0, 0, '58644853', 'D9', 'D9', 'D9', 2, '20 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(12, 5, 49, 55, 57, 0, 0, '58860031', 'E105', 'E105', 'E105', 1, '25 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(13, 5, 49, 55, 57, 0, 0, '58559331', 'E11', 'E11', 'E11', 1, '20 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(14, 5, 49, 55, 57, 0, 0, '58567787', 'E12', 'E12', 'E12', 1, '20 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(15, 6, 50, 56, 58, 0, 0, '58469838', 'F13', 'F13', 'F13', 2, '6 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(16, 6, 50, 56, 58, 0, 0, '58668484', 'F14', 'F14', 'F14', 2, '3.84 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(17, 7, 48, 51, 59, 0, 0, '58346559', 'G15', 'G15', 'G15', 1, '20 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(18, 7, 48, 51, 59, 0, 0, '58346597', 'G16', 'G16', 'G16', 1, '20 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(19, 7, 48, 51, 59, 0, 0, '58346634', 'G17', 'G17', 'G17', 1, '20 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(20, 8, 49, 52, 60, 0, 0, '58175111', 'H18', 'H18', 'H18', 2, '20 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(21, 9, 50, 53, 57, 0, 0, '58042538', 'I111', 'I111', 'I111', 2, '0.4 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(22, 9, 50, 53, 57, 0, 0, '58526753', 'I19', 'I19', 'I19', 2, '1 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(23, 9, 50, 53, 57, 0, 0, '58948463', 'I80', 'I80', 'I80', 2, '0.4 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(24, 9, 50, 53, 57, 0, 0, '58981651', 'I81', 'I81', 'I81', 2, '0.4 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(25, 10, 48, 54, 58, 0, 0, '58258036', 'J20', 'J20', 'J20', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(26, 10, 48, 54, 58, 0, 0, '58270151', 'J84', 'J84', 'J84', 2, '10 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(27, 11, 49, 55, 59, 0, 0, '58497893', 'K21', 'K21', 'K21', 2, '10 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(28, 11, 49, 55, 59, 0, 0, '58923163', 'K22', 'K22', 'K22', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(29, 12, 50, 56, 60, 0, 0, '58175333', 'L23', 'L23', 'L23', 1, '5 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(30, 12, 50, 56, 60, 0, 0, '58249843', 'L24', 'L24', 'L24', 1, '25 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(31, 12, 50, 56, 60, 0, 0, '58525183', 'L25', 'L25', 'L25', 1, '5 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(32, 13, 48, 51, 57, 0, 0, '58041913', 'M118', 'M118', 'M118', 2, '0.25 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(33, 13, 48, 51, 57, 0, 0, '58532075', 'M26', 'M26', 'M26', 2, '7.2 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(34, 13, 48, 51, 57, 0, 0, '58532082', 'M27', 'M27', 'M27', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(35, 14, 49, 52, 58, 0, 0, '58175616', 'N28', 'N28', 'N28', 2, '10 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(36, 14, 49, 52, 58, 0, 0, '58175623', 'N29', 'N29', 'N29', 2, '7.2 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(37, 14, 49, 52, 58, 0, 0, '58175654', 'N30', 'N30', 'N30', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(38, 14, 49, 52, 58, 0, 0, '58175685', 'N31', 'N31', 'N31', 2, '20 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(39, 14, 49, 52, 58, 0, 0, '58567824', 'N32', 'N32', 'N32', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(40, 14, 49, 52, 58, 0, 0, '58932349', 'N88', 'N88', 'N88', 2, '0.5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(41, 15, 50, 53, 59, 0, 0, '58257978', 'O33', 'O33', 'O33', 2, '20 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(42, 16, 48, 54, 60, 0, 0, '58259163', 'P34', 'P34', 'P34', 2, '20 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(43, 16, 48, 54, 60, 0, 0, '58635875', 'P35', 'P35', 'P35', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(44, 17, 49, 55, 57, 0, 0, '58270106', 'Q36', 'Q36', 'Q36', 1, '16.96 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(45, 18, 50, 56, 58, 0, 0, '58697934', 'R37', 'R37', 'R37', 2, '4.8 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(46, 19, 48, 51, 59, 0, 0, '58361279', 'S38', 'S38', 'S38', 1, '10 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(47, 20, 49, 52, 60, 0, 0, '58579162', 'T39', 'T39', 'T39', 2, '4 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(48, 20, 49, 52, 60, 0, 0, '58629041', 'T40', 'T40', 'T40', 2, '4.8 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(49, 20, 49, 52, 60, 0, 0, '58637503', 'T41', 'T41', 'T41', 2, '6 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(50, 20, 49, 52, 60, 0, 0, '58364096', 'T94', 'T94', 'T94', 2, '0.1 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(51, 21, 50, 53, 57, 0, 0, '58361408', 'U42', 'U42', 'U42', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(52, 21, 50, 53, 57, 0, 0, '58361422', 'U43', 'U43', 'U43', 2, '20 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(53, 21, 50, 53, 57, 0, 0, '58364201', 'U44', 'U44', 'U44', 2, '4 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(54, 21, 50, 53, 57, 0, 0, '58626583', 'U45', 'U45', 'U45', 2, '6 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(55, 21, 50, 53, 57, 0, 0, '58626637', 'U46', 'U46', 'U46', 2, '4.8 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(56, 21, 50, 53, 57, 0, 0, '58642682', 'U47', 'U47', 'U47', 2, '200 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(57, 21, 50, 53, 57, 0, 0, '58975094', 'U79', 'U79', 'U79', 2, '20 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(58, 21, 50, 53, 57, 0, 0, '58364164', 'U91', 'U91', 'U91', 2, '0.1 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(59, 22, 48, 54, 58, 0, 0, '58044242', 'V113', 'V113', 'V113', 2, '0.3 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(60, 22, 48, 54, 58, 0, 0, '58044235', 'V114', 'V114', 'V114', 2, '0.5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(61, 22, 48, 54, 58, 0, 0, '58044259', 'V116', 'V116', 'V116', 2, '0.1 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(62, 22, 48, 54, 58, 0, 0, '58042798', 'V117', 'V117', 'V117', 2, '0.1 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(63, 22, 48, 54, 58, 0, 0, '58175470', 'V48', 'V48', 'V48', 2, '10 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(64, 22, 48, 54, 58, 0, 0, '58175487', 'V49', 'V49', 'V49', 2, '7.2 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(65, 22, 48, 54, 58, 0, 0, '58175517', 'V50', 'V50', 'V50', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(66, 22, 48, 54, 58, 0, 0, '58567817', 'V51', 'V51', 'V51', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(67, 23, 49, 55, 59, 0, 0, '58298254', 'W52', 'W52', 'W52', 2, '6 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(68, 23, 49, 55, 59, 0, 0, '58298322', 'W53', 'W53', 'W53', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(69, 23, 49, 55, 59, 0, 0, '58901987', 'W54', 'W54', 'W54', 2, '200 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(70, 23, 49, 55, 59, 0, 0, '58489003', 'W92', 'W92', 'W92', 2, '0.1 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(71, 23, 49, 55, 59, 0, 0, '58524865', 'W93', 'W93', 'W93', 2, '0.25 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(72, 23, 49, 55, 59, 0, 0, '58572118', 'W95', 'W95', 'W95', 2, '10 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(73, 24, 50, 56, 60, 0, 0, '58021625', 'X108', 'X108', 'X108', 1, '10 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(74, 24, 50, 56, 60, 0, 0, '58640244', 'X55', 'X55', 'X55', 1, '20 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(75, 24, 50, 56, 60, 0, 0, '58678605', 'X56', 'X56', 'X56', 1, '10 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(76, 24, 50, 56, 60, 0, 0, '58680301', 'X57', 'X57', 'X57', 1, '10 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(77, 24, 50, 56, 60, 0, 0, '58913942', 'X58', 'X58', 'X58', 1, '10 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(78, 24, 50, 56, 60, 0, 0, '58923750', 'X59', 'X59', 'X59', 1, '20 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(79, 25, 48, 51, 57, 0, 0, '58991001', 'Y60', 'Y60', 'Y60', 2, '6 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(80, 25, 48, 51, 57, 0, 0, '58646314', 'Y87', 'Y87', 'Y87', 2, '0.5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(81, 26, 49, 52, 58, 0, 0, '58493666', 'Z61', 'Z61', 'Z61', 3, '320 Gram', 1, NULL, NULL, 0, 1, NULL, NULL),
(82, 27, 50, 53, 59, 0, 0, '58599467', 'AA62', 'AA62', 'AA62', 3, '0.3 Gram', 1, NULL, NULL, 0, 1, NULL, NULL),
(83, 27, 50, 53, 59, 0, 0, '58983815', 'AA89', 'AA89', 'AA89', 3, '5 Gram', 1, NULL, NULL, 0, 1, NULL, NULL),
(84, 28, 48, 54, 60, 0, 0, '5AP10001', 'AB63', 'AB63', 'AB63', 1, '1 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(85, 29, 49, 55, 57, 0, 0, '5AP10002', 'AC64', 'AC64', 'AC64', 1, '1 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(86, 30, 50, 56, 58, 0, 0, '5AP10003', 'AD65', 'AD65', 'AD65', 1, '1 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(87, 31, 48, 51, 59, 0, 0, '45112067', 'AE66', 'AE66', 'AE66', 1, '4 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(88, 31, 48, 51, 59, 0, 0, '50104753', 'AE86', 'AE86', 'AE86', 4, '0.5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(89, 32, 49, 52, 60, 0, 0, '45091614', 'AF67', 'AF67', 'AF67', 1, '1 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(90, 33, 50, 53, 57, 0, 0, '45091613', 'AG68', 'AG68', 'AG68', 1, '1 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(91, 34, 48, 54, 58, 0, 0, '58562300', 'AH110', 'AH110', 'AH110', 4, '250 ml', 1, NULL, NULL, 0, 1, NULL, NULL),
(92, 34, 48, 54, 58, 0, 0, '58567411', 'AH69', 'AH69', 'AH69', 4, '1 kg', 1, NULL, NULL, 0, 1, NULL, NULL),
(93, 35, 49, 55, 59, 0, 0, '59021551', 'AI70', 'AI70', 'AI70', 1, '84 KG', 1, NULL, NULL, 0, 1, NULL, NULL),
(94, 36, 50, 56, 60, 0, 0, '58985079', 'AJ71', 'AJ71', 'AJ71', 2, '4.8 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(95, 36, 50, 56, 60, 0, 0, '58985086', 'AJ72', 'AJ72', 'AJ72', 2, '6 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(96, 37, 48, 51, 57, 0, 0, '58988902', 'AK73', 'AK73', 'AK73', 2, '5 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(97, 37, 48, 51, 57, 0, 0, '58970662', 'AK74', 'AK74', 'AK74', 2, '6 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(98, 37, 48, 51, 57, 0, 0, '58976480', 'AK97', 'AK97', 'AK97', 2, '10 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(99, 38, 49, 52, 58, 0, 0, '58971928', 'AL75', 'AL75', 'AL75', 2, '4.8 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(100, 38, 49, 52, 58, 0, 0, '58971461', 'AL83', 'AL83', 'AL83', 2, '6 Liter', 1, NULL, NULL, 0, 1, NULL, NULL),
(101, 39, 50, 53, 59, 0, 0, '58972987', 'AM76', 'AM76', 'AM76', 2, '4.8 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(102, 39, 50, 53, 59, 0, 0, '58972956', 'AM77', 'AM77', 'AM77', 2, '6 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(103, 40, 48, 54, 60, 0, 0, '58001276', 'AN101', 'AN101', 'AN101', 2, '200 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(104, 40, 48, 54, 60, 0, 0, '58950602', 'AN78', 'AN78', 'AN78', 2, '20 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(105, 40, 48, 54, 60, 0, 0, '58005311', 'AN96', 'AN96', 'AN96', 2, '2.5 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(106, 41, 49, 55, 57, 0, 0, '58984829', 'AO82', 'AO82', 'AO82', 1, '5 KG', 1, NULL, NULL, 0, 0, NULL, NULL),
(107, 42, 50, 56, 58, 0, 0, '58042347', 'AP112', 'AP112', 'AP112', 2, '4.8 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(108, 42, 50, 56, 58, 0, 0, '58940375', 'AP85', 'AP85', 'AP85', 2, '0.5 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(109, 43, 48, 51, 59, 0, 0, '5AP50002', 'AQ90', 'AQ90', 'AQ90', 4, '0.5 Kg', 1, NULL, NULL, 0, 0, NULL, NULL),
(110, 44, 49, 52, 60, 0, 0, '58989114', 'AR106', 'AR106', 'AR106', 2, '4.8 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(111, 44, 49, 52, 60, 0, 0, '58989121', 'AR107', 'AR107', 'AR107', 2, '1000 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(112, 44, 49, 52, 60, 0, 0, '58011916', 'AR98', 'AR98', 'AR98', 2, '10 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(113, 44, 49, 52, 60, 0, 0, '58987882', 'AR99', 'AR99', 'AR99', 2, '6 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(114, 45, 50, 53, 57, 0, 0, '58005939', 'AS100', 'AS100', 'AS100', 1, '100 KG', 1, NULL, NULL, 0, 0, NULL, NULL),
(115, 45, 50, 53, 57, 0, 0, '58024855', 'AS109', 'AS109', 'AS109', 1, '3 KG', 1, NULL, NULL, 0, 0, NULL, NULL),
(116, 45, 50, 53, 57, 0, 0, '58044341', 'AS115', 'AS115', 'AS115', 1, '0.25 KG', 1, NULL, NULL, 0, 0, NULL, NULL),
(117, 46, 48, 54, 58, 0, 0, '58238403', 'AT102', 'AT102', 'AT102', 2, '200 Liter', 1, NULL, NULL, 0, 0, NULL, NULL),
(118, 47, 49, 55, 59, 0, 0, '58635738', 'AU104', 'AU104', 'AU104', 1, '1.5 KG', 1, NULL, NULL, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_product_type_label_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_product_type_label_country` (
  `product_type_label_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_label_regional_id` int(11) DEFAULT NULL,
  `product_type_label_name` varchar(255) DEFAULT NULL,
  `Description` text,
  `country_id` int(11) DEFAULT NULL,
  `PBG` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_type_label_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bf_master_product_type_label_country`
--

INSERT INTO `bf_master_product_type_label_country` (`product_type_label_country_id`, `product_type_label_regional_id`, `product_type_label_name`, `Description`, `country_id`, `PBG`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'Product Business Group\r\n', 'Product Business Group', 101, 1, 3, 0, 0, 1, '2016-05-09 00:00:00', NULL),
(2, 2, 'Product Category', 'Product Category', 101, 0, 3, 3, 0, 1, '2016-05-09 00:00:00', NULL),
(3, 3, 'Product Segment\r\n', 'Product Segment', 101, 0, NULL, NULL, 0, 1, NULL, NULL),
(4, 4, 'Formulation\r\n', 'Formulation', 101, 0, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_product_type_label_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_product_type_label_regional` (
  `product_type_label_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_label_name` varchar(255) DEFAULT NULL,
  `product_type_label_code` varchar(255) DEFAULT NULL,
  `Description` text,
  `PBG` tinyint(1) DEFAULT '0',
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_type_label_regional_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bf_master_product_type_label_regional`
--

INSERT INTO `bf_master_product_type_label_regional` (`product_type_label_regional_id`, `product_type_label_name`, `product_type_label_code`, `Description`, `PBG`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Product Business Group\r\n', '101', 'Product Business Group', 1, 3, NULL, 0, 1, '2016-05-09 12:17:18', NULL),
(2, 'Product Category\r\n', '102', 'Product Category', 0, 3, 3, 0, 1, '2016-05-09 00:00:00', NULL),
(3, 'Product Segment\r\n', '103', 'Product Segment', 0, NULL, NULL, 0, 1, NULL, NULL),
(4, 'Formulation\r\n', '104', 'Formulation', 0, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_product_type_name_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_product_type_name_country` (
  `product_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_regional_id` int(11) DEFAULT NULL,
  `product_country_name` varchar(255) DEFAULT NULL,
  `Description` text,
  `country_id` int(11) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `bf_master_product_type_name_country`
--

INSERT INTO `bf_master_product_type_name_country` (`product_country_id`, `product_regional_id`, `product_country_name`, `Description`, `country_id`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'A', 'A', 101, NULL, NULL, 0, 1, NULL, NULL),
(2, 1, 'B', 'B', 101, NULL, NULL, 0, 1, NULL, NULL),
(3, 1, 'C', 'C', 101, NULL, NULL, 0, 1, NULL, NULL),
(4, 1, 'D', 'D', 101, NULL, NULL, 0, 1, NULL, NULL),
(5, 1, 'E', 'E', 101, NULL, NULL, 0, 1, NULL, NULL),
(6, 1, 'F', 'F', 101, NULL, NULL, 0, 1, NULL, NULL),
(7, 1, 'G', 'G', 101, NULL, NULL, 0, 1, NULL, NULL),
(8, 1, 'H', 'H', 101, NULL, NULL, 0, 1, NULL, NULL),
(9, 1, 'I', 'I', 101, NULL, NULL, 0, 1, NULL, NULL),
(10, 1, 'J', 'J', 101, NULL, NULL, 0, 1, NULL, NULL),
(11, 1, 'K', 'K', 101, NULL, NULL, 0, 1, NULL, NULL),
(12, 1, 'L', 'L', 101, NULL, NULL, 0, 1, NULL, NULL),
(13, 1, 'M', 'M', 101, NULL, NULL, 0, 1, NULL, NULL),
(14, 1, 'N', 'N', 101, NULL, NULL, 0, 1, NULL, NULL),
(15, 1, 'O', 'O', 101, NULL, NULL, 0, 1, NULL, NULL),
(16, 1, 'P', 'P', 101, NULL, NULL, 0, 1, NULL, NULL),
(17, 1, 'Q', 'Q', 101, NULL, NULL, 0, 1, NULL, NULL),
(18, 1, 'R', 'R', 101, NULL, NULL, 0, 1, NULL, NULL),
(19, 1, 'S', 'S', 101, NULL, NULL, 0, 1, NULL, NULL),
(20, 1, 'T', 'T', 101, NULL, NULL, 0, 1, NULL, NULL),
(21, 1, 'U', 'U', 101, NULL, NULL, 0, 1, NULL, NULL),
(22, 1, 'V', 'V', 101, NULL, NULL, 0, 1, NULL, NULL),
(23, 1, 'W', 'W', 101, NULL, NULL, 0, 1, NULL, NULL),
(24, 1, 'X', 'X', 101, NULL, NULL, 0, 1, NULL, NULL),
(25, 1, 'Y', 'Y', 101, NULL, NULL, 0, 1, NULL, NULL),
(26, 1, 'Z', 'Z', 101, NULL, NULL, 0, 1, NULL, NULL),
(27, 1, 'AA', 'AA', 101, NULL, NULL, 0, 1, NULL, NULL),
(28, 1, 'AB', 'AB', 101, NULL, NULL, 0, 1, NULL, NULL),
(29, 1, 'AC', 'AC', 101, NULL, NULL, 0, 1, NULL, NULL),
(30, 1, 'AD', 'AD', 101, NULL, NULL, 0, 1, NULL, NULL),
(31, 1, 'AE', 'AE', 101, NULL, NULL, 0, 1, NULL, NULL),
(32, 1, 'AF', 'AF', 101, NULL, NULL, 0, 1, NULL, NULL),
(33, 1, 'AG', 'AG', 101, NULL, NULL, 0, 1, NULL, NULL),
(34, 1, 'AH', 'AH', 101, NULL, NULL, 0, 1, NULL, NULL),
(35, 1, 'AI', 'AI', 101, NULL, NULL, 0, 1, NULL, NULL),
(36, 1, 'AJ', 'AJ', 101, NULL, NULL, 0, 1, NULL, NULL),
(37, 1, 'AK', 'AK', 101, NULL, NULL, 0, 1, NULL, NULL),
(38, 1, 'AL', 'AL', 101, NULL, NULL, 0, 1, NULL, NULL),
(39, 1, 'AM', 'AM', 101, NULL, NULL, 0, 1, NULL, NULL),
(40, 1, 'AN', 'AN', 101, NULL, NULL, 0, 1, NULL, NULL),
(41, 1, 'AO', 'AO', 101, NULL, NULL, 0, 1, NULL, NULL),
(42, 1, 'AP', 'AP', 101, NULL, NULL, 0, 1, NULL, NULL),
(43, 1, 'AQ', 'AQ', 101, NULL, NULL, 0, 1, NULL, NULL),
(44, 1, 'AR', 'AR', 101, NULL, NULL, 0, 1, NULL, NULL),
(45, 1, 'AS', 'AS', 101, NULL, NULL, 0, 1, NULL, NULL),
(46, 1, 'AT', 'AT', 101, NULL, NULL, 0, 1, NULL, NULL),
(47, 1, 'AU', 'AU', 101, NULL, NULL, 0, 1, NULL, NULL),
(48, 2, 'Category A', 'Category A', 101, NULL, NULL, 0, 1, NULL, NULL),
(49, 2, 'Category B', 'Category B', 101, NULL, NULL, 0, 1, NULL, NULL),
(50, 2, 'Category C', 'Category C', 101, NULL, NULL, 0, 1, NULL, NULL),
(51, 3, 'Fungicide', 'Fungicide', 101, NULL, NULL, 0, 1, NULL, NULL),
(52, 3, 'Insectiside', 'Insectiside', 101, NULL, NULL, 0, 1, NULL, NULL),
(53, 3, 'Herbiside', 'Herbiside', 101, NULL, NULL, 0, 1, NULL, NULL),
(54, 3, 'Crop Speciality', 'Crop Speciality', 101, NULL, NULL, 0, 1, NULL, NULL),
(55, 3, 'Pesticide', 'Pesticide', 101, NULL, NULL, 0, 1, NULL, NULL),
(56, 3, 'BD', 'BD', 101, NULL, NULL, 0, 1, NULL, NULL),
(57, 4, 'WC 80', 'WC 80', 101, NULL, NULL, 0, 1, NULL, NULL),
(58, 4, 'SC 15', 'SC 15', 101, NULL, NULL, 0, 1, NULL, NULL),
(59, 4, 'SC 50', 'SC 50', 101, NULL, NULL, 0, 1, NULL, NULL),
(60, 4, 'HC 50', 'HC 50', 101, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_product_type_name_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_product_type_name_regional` (
  `product_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_label_regional_id` int(11) DEFAULT NULL,
  `product_regional_name` varchar(255) DEFAULT NULL,
  `product_regional_code` varchar(255) DEFAULT NULL,
  `Description` text,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`product_regional_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `bf_master_product_type_name_regional`
--

INSERT INTO `bf_master_product_type_name_regional` (`product_regional_id`, `product_type_label_regional_id`, `product_regional_name`, `product_regional_code`, `Description`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 'A', '1001', 'A', NULL, NULL, 0, 1, NULL, NULL),
(2, 1, 'B', '1002', 'B', NULL, NULL, 0, 1, NULL, NULL),
(3, 1, 'C', '1003', 'C', NULL, NULL, 0, 1, NULL, NULL),
(4, 1, 'D', '1004', 'D', NULL, NULL, 0, 1, NULL, NULL),
(5, 1, 'E', '1005', 'E', NULL, NULL, 0, 1, NULL, NULL),
(6, 1, 'F', '1006', 'F', NULL, NULL, 0, 1, NULL, NULL),
(7, 1, 'G', '1007', 'G', NULL, NULL, 0, 1, NULL, NULL),
(8, 1, 'H', '1008', 'H', NULL, NULL, 0, 1, NULL, NULL),
(9, 1, 'I', '1009', 'I', NULL, NULL, 0, 1, NULL, NULL),
(10, 1, 'J', '1010', 'J', NULL, NULL, 0, 1, NULL, NULL),
(11, 1, 'K', '1011', 'K', NULL, NULL, 0, 1, NULL, NULL),
(12, 1, 'L', '1012', 'L', NULL, NULL, 0, 1, NULL, NULL),
(13, 1, 'M', '1013', 'M', NULL, NULL, 0, 1, NULL, NULL),
(14, 1, 'N', '1014', 'N', NULL, NULL, 0, 1, NULL, NULL),
(15, 1, 'O', '1015', 'O', NULL, NULL, 0, 1, NULL, NULL),
(16, 1, 'P', '1016', 'P', NULL, NULL, 0, 1, NULL, NULL),
(17, 1, 'Q', '1017', 'Q', NULL, NULL, 0, 1, NULL, NULL),
(18, 1, 'R', '1018', 'R', NULL, NULL, 0, 1, NULL, NULL),
(19, 1, 'S', '1019', 'S', NULL, NULL, 0, 1, NULL, NULL),
(20, 1, 'T', '1020', 'T', NULL, NULL, 0, 1, NULL, NULL),
(21, 1, 'U', '1021', 'U', NULL, NULL, 0, 1, NULL, NULL),
(22, 1, 'V', '1022', 'V', NULL, NULL, 0, 1, NULL, NULL),
(23, 1, 'W', '1023', 'W', NULL, NULL, 0, 1, NULL, NULL),
(24, 1, 'X', '1024', 'X', NULL, NULL, 0, 1, NULL, NULL),
(25, 1, 'Y', '1025', 'Y', NULL, NULL, 0, 1, NULL, NULL),
(26, 1, 'Z', '1026', 'Z', NULL, NULL, 0, 1, NULL, NULL),
(27, 1, 'AA', '1027', 'AA', NULL, NULL, 0, 1, NULL, NULL),
(28, 1, 'AB', '1028', 'AB', NULL, NULL, 0, 1, NULL, NULL),
(29, 1, 'AC', '1029', 'AC', NULL, NULL, 0, 1, NULL, NULL),
(30, 1, 'AD', '1030', 'AD', NULL, NULL, 0, 1, NULL, NULL),
(31, 1, 'AE', '1031', 'AE', NULL, NULL, 0, 1, NULL, NULL),
(32, 1, 'AF', '1032', 'AF', NULL, NULL, 0, 1, NULL, NULL),
(33, 1, 'AG', '1033', 'AG', NULL, NULL, 0, 1, NULL, NULL),
(34, 1, 'AH', '1034', 'AH', NULL, NULL, 0, 1, NULL, NULL),
(35, 1, 'AI', '1035', 'AI', NULL, NULL, 0, 1, NULL, NULL),
(36, 1, 'AJ', '1036', 'AJ', NULL, NULL, 0, 1, NULL, NULL),
(37, 1, 'AK', '1037', 'AK', NULL, NULL, 0, 1, NULL, NULL),
(38, 1, 'AL', '1038', 'AL', NULL, NULL, 0, 1, NULL, NULL),
(39, 1, 'AM', '1039', 'AM', NULL, NULL, 0, 1, NULL, NULL),
(40, 1, 'AN', '1040', 'AN', NULL, NULL, 0, 1, NULL, NULL),
(41, 1, 'AO', '1041', 'AO', NULL, NULL, 0, 1, NULL, NULL),
(42, 1, 'AP', '1042', 'AP', NULL, NULL, 0, 1, NULL, NULL),
(43, 1, 'AQ', '1043', 'AQ', NULL, NULL, 0, 1, NULL, NULL),
(44, 1, 'AR', '1044', 'AR', NULL, NULL, 0, 1, NULL, NULL),
(45, 1, 'AS', '1045', 'AS', NULL, NULL, 0, 1, NULL, NULL),
(46, 1, 'AT', '1046', 'AT', NULL, NULL, 0, 1, NULL, NULL),
(47, 1, 'AU', '1047', 'AU', NULL, NULL, 0, 1, NULL, NULL),
(48, 2, 'Category A', '1048', 'AV', NULL, NULL, 0, 1, NULL, NULL),
(49, 2, 'Category B', '1049', 'AW', NULL, NULL, 0, 1, NULL, NULL),
(50, 2, 'Category C', '1050', 'AX', NULL, NULL, 0, 1, NULL, NULL),
(51, 3, 'Fungicide', '1051', 'AY', NULL, NULL, 0, 1, NULL, NULL),
(52, 3, 'Insectiside', '1052', 'AZ', NULL, NULL, 0, 1, NULL, NULL),
(53, 3, 'Herbiside', '1053', 'BA', NULL, NULL, 0, 1, NULL, NULL),
(54, 3, 'Crop Speciality', '1054', 'BB', NULL, NULL, 0, 1, NULL, NULL),
(55, 3, 'Pesticide', '1055', 'BC', NULL, NULL, 0, 1, NULL, NULL),
(56, 3, 'BD', '1056', 'BD', NULL, NULL, 0, 1, NULL, NULL),
(57, 4, 'WC 80', '1057', 'BE', NULL, NULL, 0, 1, NULL, NULL),
(58, 4, 'SC 15', '1058', 'BF', NULL, NULL, 0, 1, NULL, NULL),
(59, 4, 'SC 50', '1059', 'BG', NULL, NULL, 0, 1, NULL, NULL),
(60, 4, 'HC 50', '1060', 'BH', NULL, NULL, 0, 1, NULL, NULL),
(61, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_promotional_material_country`
--

CREATE TABLE IF NOT EXISTS `bf_master_promotional_material_country` (
  `promotional_country_id` int(11) NOT NULL AUTO_INCREMENT,
  `promotional_regional_id` int(11) DEFAULT NULL,
  `promotional_material_country_name` int(11) DEFAULT NULL,
  `promotional_material_country_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`promotional_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bf_master_promotional_material_country`
--

INSERT INTO `bf_master_promotional_material_country` (`promotional_country_id`, `promotional_regional_id`, `promotional_material_country_name`, `promotional_material_country_code`, `created_by_user`, `modified_by_user`, `country_id`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, 0, '1001', NULL, NULL, NULL, 0, 1, NULL, NULL),
(2, 2, 0, '1002', NULL, NULL, NULL, 0, 1, NULL, NULL),
(3, 3, 0, '1003', NULL, NULL, NULL, 0, 1, NULL, NULL),
(4, 4, 0, '1004', NULL, NULL, NULL, 0, 1, NULL, NULL),
(5, 5, 0, '1005', NULL, NULL, NULL, 0, 1, NULL, NULL),
(6, 6, 0, '1006', NULL, NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_promotional_material_regional`
--

CREATE TABLE IF NOT EXISTS `bf_master_promotional_material_regional` (
  `promotional_regional_id` int(11) NOT NULL AUTO_INCREMENT,
  `promotional_material_regional_name` varchar(255) DEFAULT NULL,
  `promotional_material_regional_code` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`promotional_regional_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bf_master_promotional_material_regional`
--

INSERT INTO `bf_master_promotional_material_regional` (`promotional_regional_id`, `promotional_material_regional_name`, `promotional_material_regional_code`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Agclelance Card\r\n', '1001', NULL, NULL, 0, 1, NULL, NULL),
(2, 'Calendar\r\n', '1002', NULL, NULL, 0, 1, NULL, NULL),
(3, 'Leaflets\r\n', '1003', NULL, NULL, 0, 1, NULL, NULL),
(4, 'Handouts\r\n', '1004', NULL, NULL, 0, 1, NULL, NULL),
(5, 'Banners\r\n', '1005', NULL, NULL, 0, 1, NULL, NULL),
(6, 'Flex Banners\r\n', '1006', NULL, NULL, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_qualification`
--

CREATE TABLE IF NOT EXISTS `bf_master_qualification` (
  `qualification_id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`qualification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_scheme`
--

CREATE TABLE IF NOT EXISTS `bf_master_scheme` (
  `scheme_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheme_code` varchar(255) DEFAULT NULL,
  `scheme_name` varchar(255) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`scheme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bf_master_scheme`
--

INSERT INTO `bf_master_scheme` (`scheme_id`, `scheme_code`, `scheme_name`, `year`, `created_by_user`, `modified_by_user`, `country_id`, `status`, `created_on`, `modified_on`) VALUES
(1, '001', 'scheme1', '2016-01-01', 45, NULL, 101, 1, NULL, NULL),
(2, '002', 'scheme2', '2016-01-01', 45, NULL, 101, 1, NULL, NULL),
(3, '003', 'scheme3', '2016-01-01', 45, NULL, 101, 1, NULL, NULL),
(4, '004', 'scheme4', '2016-01-01', 45, NULL, 101, 1, NULL, NULL),
(5, '005', 'scheme5', '2016-01-01', 45, NULL, 101, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_scheme_slab`
--

CREATE TABLE IF NOT EXISTS `bf_master_scheme_slab` (
  `slab_id` int(11) NOT NULL AUTO_INCREMENT,
  `scheme_id` int(11) DEFAULT NULL,
  `1point` varchar(255) DEFAULT NULL,
  `slab_no` varchar(255) DEFAULT NULL,
  `product_sku_id` int(11) DEFAULT NULL,
  `value_per_kg` varchar(255) DEFAULT NULL,
  `value_per_point` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `target_point` varchar(255) DEFAULT NULL,
  `target_value` varchar(255) DEFAULT NULL,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`slab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `bf_master_scheme_slab`
--

INSERT INTO `bf_master_scheme_slab` (`slab_id`, `scheme_id`, `1point`, `slab_no`, `product_sku_id`, `value_per_kg`, `value_per_point`, `target`, `target_point`, `target_value`, `created_by_user`, `modified_by_user`, `status`, `created_on`, `modified_on`) VALUES
(1, 1, '123', 'slab1', 1, '12', '34', '1', '1', '2', 45, NULL, 1, NULL, NULL),
(2, 1, '123', 'slab2', 1, '11', '1', '12', '23', '1', 45, NULL, 1, NULL, NULL),
(3, 1, '32', 'slab3', 1, '11', '2', '12', '456', '1', 45, NULL, 1, NULL, NULL),
(4, 2, '231', 'slab4', 2, '10', '6', '21', '456', '1', 45, NULL, 1, NULL, NULL),
(5, 2, '2456', 'slab5', 2, '12', '3', '21', '456', '2', 45, NULL, 1, NULL, NULL),
(6, 2, '23', 'slab6', 2, '1', '5', '21', '645', '3', 45, NULL, 1, NULL, NULL),
(7, 3, '654', 'slab7', 3, '21', '1', '2134', '6456', '435', 45, NULL, 1, NULL, NULL),
(8, 3, '34', 'slab8', 3, '32', '3', '345', '456', '6', 45, NULL, 1, NULL, NULL),
(9, 3, '53', 'slab9', 3, '12', '1', '234', '456', '764', 45, NULL, 1, NULL, NULL),
(10, 3, '232', 'slab10', 3, '12', '2', '123', '45', '34', 45, NULL, 1, NULL, NULL),
(11, 3, '12', 'slab11', 3, '12', '3', '12', '646', '34', 45, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_uom`
--

CREATE TABLE IF NOT EXISTS `bf_master_uom` (
  `uom_id` int(11) NOT NULL AUTO_INCREMENT,
  `uom_code` varchar(255) DEFAULT NULL,
  `uom_name` varchar(255) DEFAULT NULL,
  `uom_Description` text,
  `created_by_user` int(11) DEFAULT NULL,
  `modified_by_user` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`uom_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bf_master_uom`
--

INSERT INTO `bf_master_uom` (`uom_id`, `uom_code`, `uom_name`, `uom_Description`, `created_by_user`, `modified_by_user`, `deleted`, `status`, `created_on`, `modified_on`) VALUES
(1, '101', 'KG', 'KG', 3, 3, 0, 1, '2016-05-11 00:00:00', NULL),
(2, '102', 'Liter\r\n', 'Liter', 3, 3, 0, 1, '2016-05-11 00:00:00', NULL),
(3, '103', 'Gram\r\n', 'Gram', 3, 3, 0, 1, '2016-05-11 00:00:00', NULL),
(4, '104', 'PC\r\n', 'PC', 3, 3, 0, 1, '2016-05-11 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_user_contact_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_user_contact_details` (
  `contact_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `primary_mobile_no` int(20) DEFAULT NULL,
  `secondary_mobile_no` int(20) DEFAULT NULL,
  `landline_no` int(20) DEFAULT NULL,
  `secondary_email_id` varchar(30) DEFAULT NULL,
  `website` varchar(30) DEFAULT NULL,
  `house_no` varchar(30) DEFAULT NULL,
  `address` text,
  `landmark` varchar(255) DEFAULT NULL,
  `geo_level_id3` int(11) DEFAULT NULL COMMENT 'Parent Level 2',
  `geo_level_id2` int(11) DEFAULT NULL COMMENT 'Parent Level 1',
  `geo_level_id1` int(11) DEFAULT NULL COMMENT 'Base Level',
  `pincode` varchar(30) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`contact_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `bf_master_user_contact_details`
--

INSERT INTO `bf_master_user_contact_details` (`contact_detail_id`, `user_id`, `primary_mobile_no`, `secondary_mobile_no`, `landline_no`, `secondary_email_id`, `website`, `house_no`, `address`, `landmark`, `geo_level_id3`, `geo_level_id2`, `geo_level_id1`, `pincode`, `latitude`, `longitude`) VALUES
(1, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(2, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, NULL, NULL),
(3, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 128, NULL, NULL, NULL),
(4, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 133, NULL, NULL, NULL),
(5, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(6, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 133, NULL, NULL, NULL),
(7, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, NULL, NULL),
(8, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 128, NULL, NULL, NULL),
(9, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 133, NULL, NULL, NULL),
(10, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL),
(11, 4, 123456789, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(12, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, NULL, NULL, NULL),
(13, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL),
(14, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, NULL, NULL),
(15, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, NULL, NULL),
(16, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, NULL, NULL),
(17, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 129, NULL, NULL, NULL),
(18, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 134, NULL, NULL, NULL),
(19, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_user_educational_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_user_educational_details` (
  `education_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `qualification_id` int(11) DEFAULT NULL,
  `edu_specialization_id` int(11) DEFAULT NULL,
  `instiute` varchar(255) DEFAULT NULL,
  `year` date DEFAULT '0000-00-00',
  PRIMARY KEY (`education_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `bf_master_user_educational_details`
--

INSERT INTO `bf_master_user_educational_details` (`education_detail_id`, `user_id`, `qualification_id`, `edu_specialization_id`, `instiute`, `year`) VALUES
(1, 4, 1, 1, 'S.P. University', '1985-01-01'),
(2, 5, 2, 2, 'Harward University', '1985-01-01'),
(3, 6, 3, 0, 'K.S Institute', '1985-01-01'),
(4, 7, 4, 0, 'A.B Instityte', '1985-01-01'),
(5, 8, 5, 0, 'ARIBAS', '1985-01-01'),
(6, 9, 6, 0, 'Oxford University', '1985-01-01'),
(7, 10, 7, 0, 'S.P. University', '1985-01-01'),
(8, 11, 8, 0, 'Harward University', '1985-01-01'),
(9, 12, 9, 0, 'Oxford University', '1985-01-01'),
(10, 13, 10, 0, 'S.P. University', '1985-01-01'),
(11, 14, 1, 1, 'Harward University', '1985-01-01'),
(12, 15, 2, 2, 'Oxford University', '1985-01-01'),
(13, 16, 3, 0, 'K.S Institute', '1985-01-01'),
(14, 17, 4, 0, 'A.B Instityte', '1985-01-01'),
(15, 18, 5, 0, 'ARIBAS', '1985-01-01'),
(16, 19, 6, 0, 'S.P. University', '1985-01-01'),
(17, 20, 7, 0, 'Harward University', '1985-01-01'),
(18, 21, 8, 0, 'Oxford University', '1985-01-01'),
(19, 22, 9, 0, 'S.P. University', '1985-01-01'),
(20, 23, 10, 0, 'Harward University', '1985-01-01'),
(21, 24, 1, 1, 'Oxford University', '1985-01-01'),
(22, 25, 2, 2, 'S.P. University', '1985-01-01'),
(23, 26, 3, 0, 'A.B Instityte', '1985-01-01'),
(24, 27, 4, 0, 'A.B Instityte', '1985-01-01'),
(25, 28, 5, 0, 'ARIBAS', '1985-01-01'),
(26, 29, 6, 0, 'S.P. University', '1985-01-01'),
(27, 30, 7, 0, 'Harward University', '1985-01-01'),
(28, 31, 8, 0, 'Oxford University', '1985-01-01'),
(29, 32, 9, 0, 'S.P. University', '1985-01-01'),
(30, 33, 10, 0, 'Harward University', '1985-01-01'),
(31, 34, 1, 1, 'Oxford University', '1985-01-01'),
(32, 35, 2, 2, 'S.P. University', '1985-01-01'),
(33, 36, 3, 0, 'A.B Instityte', '1985-01-01'),
(34, 37, 4, 0, 'A.B Instityte', '1985-01-01'),
(35, 38, 5, 0, 'ARIBAS', '1985-01-01'),
(36, 39, 6, 0, 'S.P. University', '1985-01-01'),
(37, 40, 7, 0, 'Harward University', '1985-01-01'),
(38, 41, 8, 0, 'Oxford University', '1985-01-01'),
(39, 42, 9, 0, 'S.P. University', '1985-01-01'),
(40, 43, 10, 0, 'Harward University', '1985-01-01'),
(41, 44, 1, 1, 'Oxford University', '1985-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_user_family_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_user_family_details` (
  `family_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `relative_name` varchar(255) DEFAULT NULL,
  `relative_relation` varchar(255) DEFAULT NULL,
  `relative_dob` date DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `dependent` tinyint(1) DEFAULT NULL,
  `mobile_no` int(20) DEFAULT NULL,
  `email_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`family_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_user_financial_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_user_financial_details` (
  `financial_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `electronic_owned_id` int(11) NOT NULL,
  `vechiles_owned_id` int(11) NOT NULL,
  PRIMARY KEY (`financial_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_user_group_member`
--

CREATE TABLE IF NOT EXISTS `bf_master_user_group_member` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_user_organization`
--

CREATE TABLE IF NOT EXISTS `bf_master_user_organization` (
  `organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_user_personal_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_user_personal_details` (
  `personal_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `salutation` varchar(50) DEFAULT NULL,
  `firm_name` varchar(30) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `call_name` varchar(30) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `martial_status` varchar(30) DEFAULT NULL,
  `introduction_year` int(11) DEFAULT NULL,
  `influencer` tinyint(1) DEFAULT NULL,
  `doa` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `blood_group` varchar(30) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `no_of_child` int(11) DEFAULT NULL,
  `average_pa_income` decimal(9,2) DEFAULT NULL,
  `land_size` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`personal_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `bf_master_user_personal_details`
--

INSERT INTO `bf_master_user_personal_details` (`personal_detail_id`, `user_id`, `salutation`, `firm_name`, `first_name`, `middle_name`, `last_name`, `call_name`, `gender`, `dob`, `religion`, `martial_status`, `introduction_year`, `influencer`, `doa`, `category_id`, `blood_group`, `profile_image`, `no_of_child`, `average_pa_income`, `land_size`) VALUES
(1, 4, 'Mr', 'test1', 'Ummed', 'Singh', 'Shekhawat', 'UD', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(2, 5, 'Mr', 'test2', 'Raj', 'Singh', 'Test', 'RAW', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(3, 6, 'Mr', 'test3', 'Rahul', 'Rathore', '', 'Rahul', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(4, 10, 'Mr', 'test3', 'Rahul98', 'Rathore78', '', 'Rahul87', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(5, 14, 'Mr', 'test356', 'Rahul9658', 'Rathore7865', '', 'Rahul876', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(6, 18, 'Mr', 'test356as', 'Rahul96df58', 'sdRadthore7865', '', 'Rahul876', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(7, 19, 'Mr', 'test35i6as', 'Rahul96', 'sdRadth', '', 'Rahul876', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(8, 15, 'Mr', 'test35i6as', 'yuyu', 'yu', 'yuy', 'yt', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(9, 17, 'Mr', 'gghjhj', 'yuyu', 'yu', 'yuy', 'yt', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(10, 16, 'Mr', 'sasasa', 'yuyu', 'yu', 'yuy', 'yt', 'Male', '1991-02-12', 'Hindu', 'Unmarried', 2015, 1, NULL, NULL, 'B', NULL, 0, '1000.00', '12000.00'),
(11, 9, 'Mr', 'dest1', 'dest1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 11, 'Mr', 'dest3', 'dest3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 12, 'Mr', 'dest4', 'dest4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 13, 'Mr', 'dest5', 'dest5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 36, 'Mr', '', 'tes111', 'a', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 20, 'Mr', '', 'zzzz', 'x', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_user_social_account_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_user_social_account_details` (
  `social_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `facebook_account` varchar(255) DEFAULT NULL,
  `gmail_plus_account` varchar(255) DEFAULT NULL,
  `linkedin_account` varchar(255) DEFAULT NULL,
  `twt_account` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`social_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_user_statutory_details`
--

CREATE TABLE IF NOT EXISTS `bf_master_user_statutory_details` (
  `statutory_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `passport_no` varchar(50) DEFAULT NULL,
  `ktp_no` varchar(50) DEFAULT NULL,
  `statutory_detail` varchar(50) DEFAULT NULL,
  `aadhaar_card_no` varchar(50) DEFAULT NULL,
  `UID1` varchar(50) DEFAULT NULL,
  `UID2` varchar(50) DEFAULT NULL,
  `UID3` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`statutory_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_master_vehicles`
--

CREATE TABLE IF NOT EXISTS `bf_master_vehicles` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_on` datetime DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bf_menu`
--

CREATE TABLE IF NOT EXISTS `bf_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `link_type` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `navigation_id` int(11) NOT NULL,
  `window` tinyint(1) NOT NULL,
  `image_name` varchar(255) NOT NULL DEFAULT '',
  `access_role_id` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bf_menu`
--

INSERT INTO `bf_menu` (`id`, `title`, `alias`, `link`, `link_type`, `parent_id`, `navigation_id`, `window`, `image_name`, `access_role_id`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `position`) VALUES
(1, 'ndfg', 'hjv', 'hjvjhv', 'other', 0, 1, 0, 'likeapp.png', 'a:1:{i:0;s:1:"1";}', '', '', '', 1, 1),
(2, 'okfsgs', 'opj', 'pojj', 'other', 0, 1, 0, '', 'a:1:{i:0;s:1:"0";}', '', '', '', 1, 2),
(3, 'aa', 'aa', 'http://newbonfire.com/pages/ddf', 'page', 0, 1, 0, '', 'a:1:{i:0;s:1:"0";}', '', '', '', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bf_navigation`
--

CREATE TABLE IF NOT EXISTS `bf_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bf_navigation`
--

INSERT INTO `bf_navigation` (`id`, `title`, `position`, `description`, `created_on`, `modified_on`, `status`) VALUES
(1, 'fsf', 'fdsf', 'fdsfsdff', '2015-05-27 13:19:27', '0000-00-00 00:00:00', 1),
(2, 'ipj', 'uyohl', 'hlo', '2015-05-29 06:32:10', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bf_newsletter`
--

CREATE TABLE IF NOT EXISTS `bf_newsletter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `emailID` varchar(50) NOT NULL,
  `subscribeDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bf_newsletter`
--

INSERT INTO `bf_newsletter` (`ID`, `firstName`, `lastName`, `emailID`, `subscribeDate`) VALUES
(1, 'saj', 'las', 'sajlas@gmail.com', '2015-06-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_newsletter_mail`
--

CREATE TABLE IF NOT EXISTS `bf_newsletter_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `send_subscriber` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `bf_newsletter_mail`
--

INSERT INTO `bf_newsletter_mail` (`id`, `title`, `content`, `created_on`, `modified_on`, `send_subscriber`) VALUES
(10, 'Save Up To $1,000 - 10% Off Promotion At Dimend SCAASI', '<p><a href="www.dscaasi.com"><img alt="Bride Wearing Dimend SCAASI Jeweler Rings" src="/assets/upload/editor/images/ds_banner.jpg" style="border-style:solid; border-width:1px; height:270px; width:500px" /></a></p>\n\n<p><span style="color:#003399">It&#39;s that time of year again, the days are getting shorter, the leaves are falling and Fall is upon us.<br />\nWe love this time of year, it marks the beginning of engagement and wedding season and we are thrilled to let our registered subscribers know of an exclusive promotion we are offering.</span></p>\n\n<p><span style="color:#003399">For a limited time take 10% off, up to $1,000*, when you purchase any engagement ring, wedding or anniversary ring. Simply mention this e-mail and FALL14 code.</span></p>\n\n<p><span style="color:#003399">You can use code FALL14 on our <a href="http://www.dimendscaasi.com">site</a>&nbsp;when you checkout, or <a href="http://www.dimendscaasi.com/schedule-appointment">in-store</a>.<br />\nIt is our way to entice and give back but hurry, offer ends soon.</span></p>\n\n<p><span style="color:#003399">As always, we are here to help, feel free to <a href="mailto:sales@dscaasi.com?subject=FALL14%2010%25%20Off%20Promotion%20Inquiry">e-mail</a> or call us at 312-857-1700.</span></p>\n\n<p><span style="color:#003399">The dimend SCAASI team<br />\n<a href="http://www.dimendscaasi.com/">www.dscaasi.com</a></span><br />\n312-857-1700</p>\n\n<p><span style="font-size:11px">*Offer cannot be combined with any other offers or discount codes, cannot be applied retroactively.</span></p>\n\n<p>&nbsp;</p>\n', '2014-09-22 13:38:49', '0000-00-00 00:00:00', 'a:115:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"6";i:3;s:2:"13";i:4;s:2:"14";i:5;s:2:"21";i:6;s:2:"22";i:7;s:2:"23";i:8;s:2:"24";i:9;s:2:"25";i:10;s:2:"26";i:11;s:2:"27";i:12;s:2:"28";i:13;s:2:"29";i:14;s:2:"30";i:15;s:2:"31";i:16;s:2:"32";i:17;s:2:"33";i:18;s:2:"35";i:19;s:2:"36";i:20;s:2:"37";i:21;s:2:"38";i:22;s:2:"39";i:23;s:2:"40";i:24;s:2:"42";i:25;s:2:"43";i:26;s:2:"44";i:27;s:2:"45";i:28;s:2:"46";i:29;s:2:"47";i:30;s:2:"48";i:31;s:2:"49";i:32;s:2:"51";i:33;s:2:"52";i:34;s:2:"53";i:35;s:2:"54";i:36;s:2:"57";i:37;s:2:"58";i:38;s:2:"59";i:39;s:2:"60";i:40;s:2:"61";i:41;s:2:"62";i:42;s:2:"65";i:43;s:2:"66";i:44;s:2:"67";i:45;s:2:"68";i:46;s:2:"69";i:47;s:2:"70";i:48;s:2:"71";i:49;s:2:"72";i:50;s:2:"73";i:51;s:2:"74";i:52;s:2:"75";i:53;s:2:"76";i:54;s:2:"77";i:55;s:2:"80";i:56;s:2:"81";i:57;s:2:"82";i:58;s:2:"88";i:59;s:2:"89";i:60;s:2:"91";i:61;s:2:"94";i:62;s:2:"96";i:63;s:3:"101";i:64;s:3:"102";i:65;s:3:"108";i:66;s:3:"111";i:67;s:3:"113";i:68;s:3:"114";i:69;s:3:"115";i:70;s:3:"116";i:71;s:3:"117";i:72;s:3:"118";i:73;s:3:"119";i:74;s:3:"120";i:75;s:3:"122";i:76;s:3:"123";i:77;s:3:"124";i:78;s:3:"127";i:79;s:3:"128";i:80;s:3:"129";i:81;s:3:"131";i:82;s:3:"132";i:83;s:3:"134";i:84;s:3:"135";i:85;s:3:"137";i:86;s:3:"139";i:87;s:3:"140";i:88;s:3:"141";i:89;s:3:"142";i:90;s:3:"143";i:91;s:3:"144";i:92;s:3:"145";i:93;s:3:"146";i:94;s:3:"147";i:95;s:3:"148";i:96;s:3:"149";i:97;s:3:"150";i:98;s:3:"151";i:99;s:3:"152";i:100;s:3:"153";i:101;s:3:"154";i:102;s:3:"155";i:103;s:3:"156";i:104;s:3:"157";i:105;s:3:"158";i:106;s:3:"159";i:107;s:3:"160";i:108;s:3:"161";i:109;s:3:"163";i:110;s:3:"164";i:111;s:3:"165";i:112;s:3:"166";i:113;s:3:"168";i:114;s:3:"169";}'),
(11, 'test', '<p>test</p>\r\n', '2014-12-30 05:50:14', '0000-00-00 00:00:00', NULL),
(12, 'dsfdsafdsaf', '<p>adsfasfdsafasdf</p>\r\n', '2014-12-30 05:52:13', '0000-00-00 00:00:00', NULL),
(13, 'adsfdsf', '<p>adsfasdfsadf</p>\r\n', '2014-12-30 05:52:45', '0000-00-00 00:00:00', NULL),
(14, 'afadsfadsf', '<p>fasdfasfasf</p>\r\n', '2014-12-30 05:54:16', '0000-00-00 00:00:00', 'a:1:{i:0;s:3:"325";}'),
(15, '', '', '2015-06-01 10:18:29', '0000-00-00 00:00:00', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}'),
(16, 'fdfdfd', '<p>dffdf</p>\r\n', '2015-06-01 10:30:53', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bf_pages`
--

CREATE TABLE IF NOT EXISTS `bf_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(100) NOT NULL,
  `page_slug` varchar(100) NOT NULL,
  `page_content` text NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bf_pages`
--

INSERT INTO `bf_pages` (`id`, `page_title`, `page_slug`, `page_content`, `created_on`, `modified_on`, `status`) VALUES
(1, 'vf', 'ddf', 'ddfdf', '2015-05-29 05:26:53', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bf_permissions`
--

CREATE TABLE IF NOT EXISTS `bf_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=320 ;

--
-- Dumping data for table `bf_permissions`
--

INSERT INTO `bf_permissions` (`permission_id`, `name`, `description`, `status`) VALUES
(2, 'Site.Content.View', 'Allow users to view the Content Context', 'active'),
(3, 'Site.Reports.View', 'Allow users to view the Reports Context', 'active'),
(4, 'Site.Settings.View', 'Allow users to view the Settings Context', 'active'),
(5, 'Site.Developer.View', 'Allow users to view the Developer Context', 'active'),
(6, 'Bonfire.Roles.Manage', 'Allow users to manage the user Roles', 'active'),
(7, 'Bonfire.Users.Manage', 'Allow users to manage the site Users', 'active'),
(8, 'Bonfire.Users.View', 'Allow users access to the User Settings', 'active'),
(9, 'Bonfire.Users.Add', 'Allow users to add new Users', 'active'),
(10, 'Bonfire.Database.Manage', 'Allow users to manage the Database settings', 'active'),
(11, 'Bonfire.Emailer.Manage', 'Allow users to manage the Emailer settings', 'active'),
(12, 'Bonfire.Logs.View', 'Allow users access to the Log details', 'active'),
(13, 'Bonfire.Logs.Manage', 'Allow users to manage the Log files', 'active'),
(14, 'Bonfire.Emailer.View', 'Allow users access to the Emailer settings', 'active'),
(15, 'Site.Signin.Offline', 'Allow users to login to the site when the site is offline', 'active'),
(16, 'Bonfire.Permissions.View', 'Allow access to view the Permissions menu unders Settings Context', 'active'),
(17, 'Bonfire.Permissions.Manage', 'Allow access to manage the Permissions in the system', 'active'),
(18, 'Bonfire.Roles.Delete', 'Allow users to delete user Roles', 'active'),
(19, 'Bonfire.Modules.Add', 'Allow creation of modules with the builder.', 'active'),
(20, 'Bonfire.Modules.Delete', 'Allow deletion of modules.', 'active'),
(21, 'Permissions.Administrator.Manage', 'To manage the access control permissions for the Administrator role.', 'active'),
(22, 'Permissions.Editor.Manage', 'To manage the access control permissions for the Editor role.', 'active'),
(24, 'Permissions.User.Manage', 'To manage the access control permissions for the User role.', 'active'),
(25, 'Permissions.Developer.Manage', 'To manage the access control permissions for the Developer role.', 'active'),
(27, 'Activities.Own.View', 'To view the users own activity logs', 'active'),
(28, 'Activities.Own.Delete', 'To delete the users own activity logs', 'active'),
(29, 'Activities.User.View', 'To view the user activity logs', 'active'),
(30, 'Activities.User.Delete', 'To delete the user activity logs, except own', 'active'),
(31, 'Activities.Module.View', 'To view the module activity logs', 'active'),
(32, 'Activities.Module.Delete', 'To delete the module activity logs', 'active'),
(33, 'Activities.Date.View', 'To view the users own activity logs', 'active'),
(34, 'Activities.Date.Delete', 'To delete the dated activity logs', 'active'),
(35, 'Bonfire.UI.Manage', 'Manage the Bonfire UI settings', 'active'),
(36, 'Bonfire.Settings.View', 'To view the site settings page.', 'active'),
(37, 'Bonfire.Settings.Manage', 'To manage the site settings.', 'active'),
(38, 'Bonfire.Activities.View', 'To view the Activities menu.', 'active'),
(39, 'Bonfire.Database.View', 'To view the Database menu.', 'active'),
(40, 'Bonfire.Migrations.View', 'To view the Migrations menu.', 'active'),
(41, 'Bonfire.Builder.View', 'To view the Modulebuilder menu.', 'active'),
(42, 'Bonfire.Roles.View', 'To view the Roles menu.', 'active'),
(43, 'Bonfire.Sysinfo.View', 'To view the System Information page.', 'active'),
(44, 'Bonfire.Translate.Manage', 'To manage the Language Translation.', 'active'),
(45, 'Bonfire.Translate.View', 'To view the Language Translate menu.', 'active'),
(46, 'Bonfire.UI.View', 'To view the UI/Keyboard Shortcut menu.', 'active'),
(49, 'Bonfire.Profiler.View', 'To view the Console Profiler Bar.', 'active'),
(50, 'Bonfire.Roles.Add', 'To add New Roles', 'active'),
(55, 'Email_Template.Settings.View', '', 'active'),
(56, 'Email_Template.Settings.Create', '', 'active'),
(57, 'Email_Template.Settings.Edit', '', 'active'),
(58, 'Email_Template.Settings.Delete', '', 'active'),
(59, 'Menu.Content.View', '', 'active'),
(60, 'Menu.Content.Create', '', 'active'),
(61, 'Menu.Content.Edit', '', 'active'),
(62, 'Menu.Content.Delete', '', 'active'),
(63, 'Navigation.Content.View', '', 'active'),
(64, 'Navigation.Content.Create', '', 'active'),
(65, 'Navigation.Content.Edit', '', 'active'),
(66, 'Navigation.Content.Delete', '', 'active'),
(67, 'Pages.Content.View', '', 'active'),
(68, 'Pages.Content.Create', '', 'active'),
(69, 'Pages.Content.Edit', '', 'active'),
(70, 'Pages.Content.Delete', '', 'active'),
(71, 'User_Management.Settings.View', '', 'active'),
(72, 'User_Management.Settings.Create', '', 'active'),
(73, 'User_Management.Settings.Edit', '', 'active'),
(74, 'User_Management.Settings.Delete', '', 'active'),
(91, 'Site.Dashboard.View', 'Allow user to view the Dashboard Context.', 'active'),
(102, 'Banner.Content.View', '', 'active'),
(103, 'Banner.Content.Create', '', 'active'),
(104, 'Banner.Content.Edit', '', 'active'),
(105, 'Banner.Content.Delete', '', 'active'),
(110, 'Social_Media.Content.View', '', 'active'),
(111, 'Social_Media.Content.Create', '', 'active'),
(112, 'Social_Media.Content.Edit', '', 'active'),
(113, 'Social_Media.Content.Delete', '', 'active'),
(118, 'Newsletter.Content.View', '', 'active'),
(119, 'Newsletter.Content.Create', '', 'active'),
(120, 'Newsletter.Content.Edit', '', 'active'),
(121, 'Newsletter.Content.Delete', '', 'active'),
(190, 'Site.Dashboard.View', 'Dashboard', 'active'),
(279, 'Site.Name.View', 'Allow user to view the Name Context.', 'active'),
(280, 'Site.Master.View', 'Allow user to view the Master Context.', 'active'),
(282, 'Site.SiteUsers.View', 'Allow user to view the SiteUsers Context.', 'active'),
(287, 'User_Master.Siteusers.View', '', 'active'),
(288, 'User_Master.Siteusers.Create', '', 'active'),
(289, 'User_Master.Siteusers.Edit', '', 'active'),
(290, 'User_Master.Siteusers.Delete', '', 'active'),
(295, 'Country_master.Master.View', 'View Country_master Master', 'active'),
(296, 'Country_master.Master.Create', 'Create Country_master Master', 'active'),
(297, 'Country_master.Master.Edit', 'Edit Country_master Master', 'active'),
(298, 'Country_master.Master.Delete', 'Delete Country_master Master', 'active'),
(299, 'Category_applicable_master.Master.View', 'View Category_applicable_master Master', 'active'),
(300, 'Category_applicable_master.Master.Create', 'Create Category_applicable_master Master', 'active'),
(301, 'Category_applicable_master.Master.Edit', 'Edit Category_applicable_master Master', 'active'),
(302, 'Category_applicable_master.Master.Delete', 'Delete Category_applicable_master Master', 'active'),
(303, 'Category_regional_master.Master.View', 'View Category_regional_master Master', 'active'),
(304, 'Category_regional_master.Master.Create', 'Create Category_regional_master Master', 'active'),
(305, 'Category_regional_master.Master.Edit', 'Edit Category_regional_master Master', 'active'),
(306, 'Category_regional_master.Master.Delete', 'Delete Category_regional_master Master', 'active'),
(307, 'Category_national_master.Master.View', 'View Category_national_master Master', 'active'),
(308, 'Category_country_master.Master.Create', 'Create Category_national_master Master', 'active'),
(309, 'Category_country_master.Master.Edit', 'Edit Category_national_master Master', 'active'),
(310, 'Category_country_master.Master.Delete', 'Delete Category_national_master Master', 'active'),
(311, 'Customer_type_regional.Master.View', 'View Customer_type_regional Master', 'active'),
(312, 'Customer_type_regional.Master.Create', 'Create Customer_type_regional Master', 'active'),
(313, 'Customer_type_regional.Master.Edit', 'Edit Customer_type_regional Master', 'active'),
(314, 'Customer_type_regional.Master.Delete', 'Delete Customer_type_regional Master', 'active'),
(315, 'Permissions.Head Officer.Manage', 'To manage the access control permissions for the Head Officer role.', 'active'),
(316, 'Permissions.Field Officer.Manage', 'To manage the access control permissions for the Field Officer role.', 'active'),
(317, 'Permissions.Distributor.Manage', 'To manage the access control permissions for the Distributor role.', 'active'),
(318, 'Permissions.Retailer.Manage', 'To manage the access control permissions for the Retailer role.', 'active'),
(319, 'Permissions.Farmer.Manage', 'To manage the access control permissions for the Farmer role.', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `bf_roles`
--

CREATE TABLE IF NOT EXISTS `bf_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(60) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `login_destination` varchar(255) NOT NULL DEFAULT '/',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `default_context` varchar(255) NOT NULL DEFAULT 'content',
  `access` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `bf_roles`
--

INSERT INTO `bf_roles` (`role_id`, `role_name`, `description`, `default`, `can_delete`, `login_destination`, `deleted`, `default_context`, `access`) VALUES
(1, 'Administrator', 'Has full control over every aspect of the site.', 0, 0, 'admin/dashboard', 0, 'dashboard', 1),
(2, 'Editor', 'Can handle day-to-day management, but does not have full power.', 0, 1, 'admin/dashboard', 0, 'dashboard', 1),
(4, 'User', 'This is the default user with access to login.', 1, 0, '', 0, 'content', 1),
(6, 'Developer', 'Developers typically are the only ones that can access the developer tools. Otherwise identical to Administrators, at least until the site is handed off.', 0, 1, '', 0, 'dashboard', 1),
(7, 'Head Officer', 'Head Officer', 0, 1, '', 0, 'dashboard', 1),
(8, 'Field Officer', 'Field Officer', 0, 1, '', 0, 'dashboard', 1),
(9, 'Distributor', 'Distributor', 0, 1, '', 0, 'dashboard', 1),
(10, 'Retailer', 'Retailer', 0, 1, '', 0, 'dashboard', 1),
(11, 'Farmer', 'Farmer', 0, 1, '', 0, 'dashboard', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bf_role_permissions`
--

CREATE TABLE IF NOT EXISTS `bf_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bf_role_permissions`
--

INSERT INTO `bf_role_permissions` (`role_id`, `permission_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 24),
(1, 25),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 49),
(1, 50),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 190),
(1, 279),
(1, 280),
(1, 282),
(1, 287),
(1, 288),
(1, 289),
(1, 290),
(1, 295),
(1, 296),
(1, 297),
(1, 298),
(1, 299),
(1, 300),
(1, 301),
(1, 302),
(1, 304),
(1, 305),
(1, 306),
(1, 307),
(1, 308),
(1, 309),
(1, 310),
(1, 311),
(1, 312),
(1, 313),
(1, 314),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 24),
(2, 25),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 49),
(2, 50),
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 102),
(2, 103),
(2, 104),
(2, 105),
(2, 110),
(2, 111),
(2, 112),
(2, 113),
(2, 118),
(2, 119),
(2, 120),
(2, 121),
(2, 190),
(2, 279),
(2, 280),
(2, 282),
(2, 287),
(2, 288),
(2, 289),
(2, 290),
(2, 295),
(2, 296),
(2, 297),
(2, 298),
(2, 299),
(2, 300),
(2, 301),
(2, 302),
(2, 303),
(2, 304),
(2, 305),
(2, 306),
(2, 307),
(2, 308),
(2, 309),
(2, 310),
(2, 311),
(2, 312),
(2, 313),
(2, 314),
(2, 315),
(2, 316),
(2, 317),
(2, 318),
(2, 319),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(6, 13),
(6, 49),
(6, 91),
(6, 280);

-- --------------------------------------------------------

--
-- Table structure for table `bf_schema_version`
--

CREATE TABLE IF NOT EXISTS `bf_schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bf_schema_version`
--

INSERT INTO `bf_schema_version` (`type`, `version`) VALUES
('banner_', 2),
('category_applicable_master_', 2),
('category_national_master_', 2),
('category_regional_master_', 2),
('core', 41),
('country_master_', 1),
('customer_type_regional_', 2),
('email_template_', 2),
('facebook_', 2),
('menu_', 2),
('navigation_', 2),
('newsletter_', 2),
('pages_', 2),
('product_', 2),
('social_media_', 2),
('sport_', 2),
('testtestestsest_', 2),
('test_', 2),
('user_management_', 1),
('user_master_', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bf_sessions`
--

CREATE TABLE IF NOT EXISTS `bf_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bf_settings`
--

CREATE TABLE IF NOT EXISTS `bf_settings` (
  `name` varchar(30) NOT NULL,
  `module` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bf_settings`
--

INSERT INTO `bf_settings` (`name`, `module`, `value`) VALUES
('auth.allow_name_change', 'core', '1'),
('auth.allow_register', 'core', '1'),
('auth.allow_remember', 'core', '1'),
('auth.do_login_redirect', 'core', '1'),
('auth.login_type', 'core', 'email'),
('auth.name_change_frequency', 'core', '1'),
('auth.name_change_limit', 'core', '1'),
('auth.password_force_mixed_case', 'core', '0'),
('auth.password_force_numbers', 'core', '0'),
('auth.password_force_symbols', 'core', '0'),
('auth.password_min_length', 'core', '8'),
('auth.password_show_labels', 'core', '0'),
('auth.remember_length', 'core', '1209600'),
('auth.user_activation_method', 'core', '0'),
('auth.use_extended_profile', 'core', '0'),
('auth.use_usernames', 'core', '1'),
('ext.country', 'core', 'US'),
('ext.state', 'core', 'CA'),
('ext.street_name', 'core', 'hello'),
('form_save', 'core.ui', 'ctrl+s/⌘+s'),
('goto_content', 'core.ui', 'alt+c'),
('mailpath', 'email', '/usr/sbin/sendmail'),
('mailtype', 'email', 'text'),
('meta.description', 'core', 'ddddddd'),
('meta.keyword', 'core', 'ddd'),
('password_iterations', 'users', '8'),
('protocol', 'email', 'mail'),
('sender_email', 'email', 'bhuvabhaumik@gmail.com'),
('site.languages', 'core', 'a:3:{i:0;s:7:"english";i:1;s:7:"persian";i:2;s:10:"portuguese";}'),
('site.list_limit', 'core', '25'),
('site.show_front_profiler', 'core', '1'),
('site.show_profiler', 'core', '1'),
('site.status', 'core', '1'),
('site.system_email', 'core', 'admin@mybonfire.com'),
('site.title', 'core', 'Reach Expansion'),
('site_footerscript', 'core', 'rrrrrrrr'),
('site_headerscript', 'core', ''),
('smtp_host', 'email', 'ssl://smtp.gmail.com'),
('smtp_pass', 'email', '9975919033whoru'),
('smtp_port', 'email', '465'),
('smtp_timeout', 'email', '3000'),
('smtp_user', 'email', 'bhuvabhaumik@gmail.com'),
('updates.bleeding_edge', 'core', '1'),
('updates.do_check', 'core', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bf_social_media`
--

CREATE TABLE IF NOT EXISTS `bf_social_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bf_social_media`
--

INSERT INTO `bf_social_media` (`id`, `label`, `link`, `image`, `status`, `position`) VALUES
(1, 'ff', 'ff', 'bg.gif', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bf_states`
--

CREATE TABLE IF NOT EXISTS `bf_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `abbrev` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `bf_states`
--

INSERT INTO `bf_states` (`id`, `name`, `abbrev`) VALUES
(1, 'Alaska', 'AK'),
(2, 'Alabama', 'AL'),
(3, 'American Samoa', 'AS'),
(4, 'Arizona', 'AZ'),
(5, 'Arkansas', 'AR'),
(6, 'California', 'CA'),
(7, 'Colorado', 'CO'),
(8, 'Connecticut', 'CT'),
(9, 'Delaware', 'DE'),
(10, 'District of Columbia', 'DC'),
(11, 'Florida', 'FL'),
(12, 'Georgia', 'GA'),
(13, 'Guam', 'GU'),
(14, 'Hawaii', 'HI'),
(15, 'Idaho', 'ID'),
(16, 'Illinois', 'IL'),
(17, 'Indiana', 'IN'),
(18, 'Iowa', 'IA'),
(19, 'Kansas', 'KS'),
(20, 'Kentucky', 'KY'),
(21, 'Louisiana', 'LA'),
(22, 'Maine', 'ME'),
(23, 'Marshall Islands', 'MH'),
(24, 'Maryland', 'MD'),
(25, 'Massachusetts', 'MA'),
(26, 'Michigan', 'MI'),
(27, 'Minnesota', 'MN'),
(28, 'Mississippi', 'MS'),
(29, 'Missouri', 'MO'),
(30, 'Montana', 'MT'),
(31, 'Nebraska', 'NE'),
(32, 'Nevada', 'NV'),
(33, 'New Hampshire', 'NH'),
(34, 'New Jersey', 'NJ'),
(35, 'New Mexico', 'NM'),
(36, 'New York', 'NY'),
(37, 'North Carolina', 'NC'),
(38, 'North Dakota', 'ND'),
(39, 'Northern Mariana Islands', 'MP'),
(40, 'Ohio', 'OH'),
(41, 'Oklahoma', 'OK'),
(42, 'Oregon', 'OR'),
(43, 'Palau', 'PW'),
(44, 'Pennsylvania', 'PA'),
(45, 'Puerto Rico', 'PR'),
(46, 'Rhode Island', 'RI'),
(47, 'South Carolina', 'SC'),
(48, 'South Dakota', 'SD'),
(49, 'Tennessee', 'TN'),
(50, 'Texas', 'TX'),
(51, 'Utah', 'UT'),
(52, 'Vermont', 'VT'),
(53, 'Virgin Islands', 'VI'),
(54, 'Virginia', 'VA'),
(55, 'Washington', 'WA'),
(56, 'West Virginia', 'WV'),
(57, 'Wisconsin', 'WI'),
(58, 'Wyoming', 'WY'),
(59, 'Armed Forces Africa', 'AE'),
(60, 'Armed Forces Canada', 'AE'),
(61, 'Armed Forces Europe', 'AE'),
(62, 'Armed Forces Middle East', 'AE'),
(63, 'Armed Forces Pacific', 'AP');

-- --------------------------------------------------------

--
-- Table structure for table `bf_users`
--

CREATE TABLE IF NOT EXISTS `bf_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `email` varchar(254) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password_hash` char(60) NOT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(45) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `reset_by` int(10) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` varchar(40) NOT NULL DEFAULT 'UM6',
  `language` varchar(20) NOT NULL DEFAULT 'english',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `force_password_reset` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(30) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `user_code` varchar(30) DEFAULT NULL,
  `bussiness_code` varchar(100) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `bf_users`
--

INSERT INTO `bf_users` (`id`, `role_id`, `email`, `username`, `password_hash`, `reset_hash`, `last_login`, `last_ip`, `created_on`, `deleted`, `reset_by`, `banned`, `ban_message`, `display_name`, `display_name_changed`, `timezone`, `language`, `active`, `activate_hash`, `force_password_reset`, `type`, `user_type_id`, `user_code`, `bussiness_code`, `country_id`) VALUES
(1, 1, 'webclues.superadmn@gmail.com', 'super admin', '$2a$08$PeRoU8Q4RyX807hJobuGUeew2n0zaF1WF45mkB./ftbRlLPrnonKG', NULL, '2016-05-05 11:09:08', '::1', '2015-05-21 06:10:48', 0, 1449907049, 0, NULL, 'Super Admin', NULL, 'UM6', 'english', 1, '', 0, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'webclues.admn@gmail.com', 'Admin', '$2a$08$PeRoU8Q4RyX807hJobuGUeew2n0zaF1WF45mkB./ftbRlLPrnonKG', NULL, '2016-05-15 12:13:46', '::1', '2015-05-29 11:24:49', 0, NULL, 0, NULL, 'Admin', NULL, 'UM6', 'english', 1, '', 0, NULL, NULL, NULL, NULL, 101),
(3, 4, 'sachin.dholu@webcluesglobal.com', 'sachin', '$2a$08$PeRoU8Q4RyX807hJobuGUeew2n0zaF1WF45mkB./ftbRlLPrnonKG', NULL, '0000-00-00 00:00:00', '', '2016-05-09 00:00:00', 0, NULL, 0, NULL, 'sachin', NULL, 'UM6', 'english', 1, '', 0, NULL, NULL, NULL, NULL, 101),
(4, 11, 'abc1@gmail.com', 'abc1', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '2016-05-26 13:16:40', '::1', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc1', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000001', NULL, 101),
(5, 11, 'abc2@gmail.com', 'abc2', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc2', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000002', NULL, 101),
(6, 11, 'abc3@gmail.com', 'abc3', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc3', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000003', NULL, 101),
(7, 11, 'abc4@gmail.com', 'abc4', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc4', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000004', NULL, 101),
(8, 11, 'abc5@gmail.com', 'abc5', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc5', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000005', NULL, 101),
(9, 9, 'abc6@gmail.com', 'abc6', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '2016-06-03 12:24:37', '::1', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc6', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000001', NULL, 101),
(10, 9, 'abc7@gmail.com', 'abc7', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc7', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000002', NULL, 101),
(11, 9, 'abc8@gmail.com', 'abc8', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc8', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000003', NULL, 101),
(12, 9, 'abc9@gmail.com', 'abc9', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '2016-05-24 06:45:55', '::1', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc9', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000004', NULL, 101),
(13, 9, 'abc10@gmail.com', 'abc10', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc10', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000005', NULL, 101),
(14, 10, 'abc11@gmail.com', 'abc11', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '2016-06-03 14:40:44', '::1', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc11', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000006', NULL, 101),
(15, 10, 'abc12@gmail.com', 'abc12', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc12', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000001', NULL, 101),
(16, 10, 'abc13@gmail.com', 'abc13', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc13', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000002', NULL, 101),
(17, 10, 'abc14@gmail.com', 'abc14', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc14', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000003', NULL, 101),
(18, 10, 'abc15@gmail.com', 'abc15', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '2016-05-20 12:13:30', '::1', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc15', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000004', NULL, 101),
(19, 10, 'abc16@gmail.com', 'abc16', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '2016-05-26 13:19:43', '::1', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc16', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000005', NULL, 101),
(20, 8, 'abc17@gmail.com', 'abc17', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '2016-06-03 14:32:46', '::1', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc17', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000001', NULL, 101),
(21, 8, 'abc18@gmail.com', 'abc18', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc18', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000002', NULL, 101),
(22, 8, 'abc19@gmail.com', 'abc19', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc19', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000003', NULL, 101),
(23, 8, 'abc20@gmail.com', 'abc20', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '2016-05-23 07:49:14', '::1', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc20', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000004', NULL, 101),
(24, 8, 'abc21@gmail.com', 'abc21', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc21', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000005', NULL, 101),
(25, 11, 'abc22@gmail.com', 'abc22', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc22', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000001', NULL, 101),
(26, 11, 'abc23@gmail.com', 'abc23', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc23', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000002', NULL, 101),
(27, 11, 'abc24@gmail.com', 'abc24', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc24', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000003', NULL, 101),
(28, 11, 'abc25@gmail.com', 'abc25', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc25', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000004', NULL, 101),
(29, 11, 'abc26@gmail.com', 'abc26', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc26', '0000-00-00', '', '', 1, '', 0, 'Customer', 1, '000005', NULL, 101),
(30, 10, 'abc27@gmail.com', 'abc27', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc27', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000001', NULL, 101),
(31, 10, 'abc28@gmail.com', 'abc28', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc28', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000002', NULL, 101),
(32, 10, 'abc29@gmail.com', 'abc29', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc29', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000003', NULL, 101),
(33, 10, 'abc30@gmail.com', 'abc30', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc30', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000004', NULL, 101),
(34, 10, 'abc31@gmail.com', 'abc31', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc31', '0000-00-00', '', '', 1, '', 0, 'Customer', 2, '000005', NULL, 101),
(35, 9, 'abc32@gmail.com', 'abc32', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc32', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000001', NULL, 101),
(36, 9, 'abc33@gmail.com', 'abc33', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc33', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000002', NULL, 101),
(37, 9, 'abc34@gmail.com', 'abc34', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc34', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000003', NULL, 101),
(38, 9, 'abc35@gmail.com', 'abc35', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc35', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000004', NULL, 101),
(39, 9, 'abc36@gmail.com', 'abc36', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc36', '0000-00-00', '', '', 1, '', 0, 'Customer', 3, '000005', NULL, 101),
(40, 8, 'abc37@gmail.com', 'abc37', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc37', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000001', NULL, 101),
(41, 8, 'abc38@gmail.com', 'abc38', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc38', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000002', NULL, 101),
(42, 8, 'abc39@gmail.com', 'abc39', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc39', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000003', NULL, 101),
(43, 8, 'abc40@gmail.com', 'abc40', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc40', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000004', NULL, 101),
(44, 8, 'abc41@gmail.com', 'abc41', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 0, 0, 0, '', 'abc41', '0000-00-00', '', '', 1, '', 0, 'Employee', 3, '000005', NULL, 101),
(45, 7, 'ho@gmail.com', 'hoindia', '$2a$08$rrPEtuxMQ2qXKNqSUFdO7efLDVvQpEeaEgIftPfpME4.BcBA7YLfm', NULL, '2016-06-03 14:08:34', '::1', '2016-05-15 08:52:57', 0, NULL, 0, NULL, 'HO India', NULL, 'UM6', 'english', 1, '', 0, 'Employee', 2, '000006', NULL, 101);

-- --------------------------------------------------------

--
-- Table structure for table `bf_user_cookies`
--

CREATE TABLE IF NOT EXISTS `bf_user_cookies` (
  `user_id` bigint(20) unsigned NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL,
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bf_user_meta`
--

CREATE TABLE IF NOT EXISTS `bf_user_meta` (
  `meta_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL DEFAULT '',
  `meta_value` text,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bf_user_meta`
--

INSERT INTO `bf_user_meta` (`meta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 2, 'state', ''),
(2, 2, 'country', 'US'),
(3, 1, 'state', ''),
(4, 1, 'country', 'US'),
(5, 45, 'country', 'US');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
