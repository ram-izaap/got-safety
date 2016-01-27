-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2016 at 09:06 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `got_safty`
--

-- --------------------------------------------------------

--
-- Table structure for table `lession`
--

CREATE TABLE IF NOT EXISTS `lession` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `lession`
--

INSERT INTO `lession` (`id`, `title`, `content`, `created_date`, `updated_date`, `created_user`, `updated_user`, `is_active`) VALUES
(1, 'Sample', 'test content ..', '2016-01-24 18:30:00', '2016-01-25 00:00:00', 0, 0, 1),
(2, 'sample text2 ..', 'test content for listing', '2016-01-24 18:30:00', '2016-01-25 00:00:00', 0, 0, 1),
(8, 'asdas', 'kjb', '2016-01-27 14:23:57', '2016-01-27 19:53:57', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lession_attachment`
--

CREATE TABLE IF NOT EXISTS `lession_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lession_id` int(5) NOT NULL,
  `language` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lession_attachment`
--

INSERT INTO `lession_attachment` (`id`, `lession_id`, `language`, `file_name`, `is_active`) VALUES
(1, 1, 'english', 'image.png', 1),
(3, 2, 'english', 'test1.jpg', 1),
(4, 2, 'spanish', 'test2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `profile_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ori_password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email_notification` tinyint(1) NOT NULL,
  `hide_profile` tinyint(1) NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `is_blocked` tinyint(1) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime NOT NULL,
  `location` varchar(50) NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `user_jewelry_type` varchar(255) NOT NULL,
  `own_txt` varchar(255) NOT NULL,
  `following_count` int(10) NOT NULL,
  `followed_count` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `about`, `profile_name`, `user_name`, `password`, `ori_password`, `email`, `role`, `phone`, `email_notification`, `hide_profile`, `gender`, `is_blocked`, `dob`, `created_id`, `updated_id`, `created_time`, `updated_time`, `location`, `user_image`, `user_jewelry_type`, `own_txt`, `following_count`, `followed_count`) VALUES
(8, 'admin', 'adminend', 'asdfafadsf', 'admin', 'admin', '0192023a7bbd73250516f069df18b500', 'admin123', 'sarandosssdfsdasasit@gmail.com', 1, '9876543212', 0, 0, NULL, 0, '0000-00-00', 8, 8, '2015-03-13 09:03:07', '2015-07-16 18:28:19', 'Chennai', '', '0', '', 1, 0),
(9, 'saran', 'doss', 'Really Good ..Great..Wow..', 'saran', 'saran', '2208639860dda3f5c6bf627bbe3657c7', 'saran', 'sarandossit@gmail.com', 1, '1234567890', 1, 0, 'male', 0, '0000-00-00', 8, 8, '2015-03-14 14:21:19', '2015-07-24 12:01:03', 'Chennai', 'bird25.jpg', '1,2,3,7', '', 2, 2),
(13, 'sadham', 'hussian', '', '', 'sadhamhussian', '90a8b8319e36717759419103c65759d7', 'sadham', 'sadham@gmail.com', 0, '9659362508', 0, 0, NULL, 0, '0000-00-00', 0, 0, '2015-04-07 07:17:55', '0000-00-00 00:00:00', '', 'img2.png', '0', '', 2, 7),
(12, 'test', 'user', '', '', 'testuser', '098f6bcd4621d373cade4e832627b4f6', '', 'test@gmailcom', 0, '9659362508', 1, 0, NULL, 0, '0000-00-00', 0, 0, '2015-04-07 07:16:19', '0000-00-00 00:00:00', '', 'img2.png', '0', '', 0, 0),
(17, 'raj', 'sekar', '', '', 'rajsekar', 'cac5ff630494aa784ce97b9fafac2500', 'raj123', 'raj@gmail.com', 0, '9876543212', 1, 0, 'male', 0, '0000-00-00', 0, 0, '2015-04-08 10:25:24', '0000-00-00 00:00:00', '', 'user-5-big.jpg', '0', '', 0, 3),
(18, 'skdsdj', 'asdsa', '', '', 'asds', '2208639860dda3f5c6bf627bbe3657c7', 'saran', 'sdkjsjf@gmail.com', 0, '9659362508', 0, 0, 'male', 0, '1989-11-19', 0, 0, '2015-04-17 12:57:01', '0000-00-00 00:00:00', '', '', '0', '', 0, 0),
(19, 'developer', 'test', 'dafgdhjg dgjghjk', 'developer', 'developer', '5e8edd851d2fdfbd7415232c67367cc3', 'developer', 'developer123@gmail.com', 0, '9876543212', 1, 0, NULL, 0, '', 0, 0, '2015-07-15 05:24:51', '0000-00-00 00:00:00', 'Chennai', 'bird102.jpg', '1,2', '', 13, 6),
(20, 'developerdev', 'testdeveloper', 'asdfdfgf  dfghgh', 'developer22', 'developerdevuser', '5e8edd851d2fdfbd7415232c67367cc3', '', 'developerid6668@gmail.com', 0, '98875565644', 0, 0, NULL, 0, '', 8, 8, '2015-07-15 12:07:19', '2015-07-16 16:33:12', 'Chennai', '', '', '', 0, 0),
(21, 'sdfgfsf', 'adsfdsfg', 'dsfdsf', 'fdaf', 'sadfdsf', '9f191b1e986e07c36e694001bc1117b5', '', 'sarandossiasdsgst@gmail.com', 0, '98875565644', 0, 0, NULL, 1, '', 8, 8, '2015-07-16 10:50:41', '2015-07-16 16:21:11', 'asdfgfghj', '', '', '', 0, 0),
(22, 'developerizaap', 'test', '', '', 'developerizaap', '960c6978ee9384ec9c4d7b6144764d45', 'vMUNJwR8Gh', 'developerizaap@gmail.com', 0, '', 0, 0, NULL, 0, '', 0, 0, '2015-07-17 07:49:39', '0000-00-00 00:00:00', '', '', '1,2', '', 0, 0),
(23, 'test', 'test', 'test content ..', 'test', 'test', '05a671c66aefea124cc08b76ea6d30bb', 'testtest', 'test@gmail.com', 0, '9876543212', 1, 0, NULL, 0, '', 0, 0, '2015-07-24 06:35:54', '0000-00-00 00:00:00', 'Chennai', '', '1,2', '', 0, 0),
(24, 'developer', 'test', '', 'developer', 'testuser', '5e8edd851d2fdfbd7415232c67367cc3', 'developer', 'developer.izaap@gmail.com', 0, '', 0, 0, NULL, 0, '', 0, 0, '2015-07-28 07:08:20', '0000-00-00 00:00:00', '', '', '1,2', '', 0, 0),
(25, 'tester', 'tester', '', 'testet', 'tester', 'e012f39d386a18cb18e7e319a8ef4523', 'testter', 'tester@gmail.com', 0, '', 0, 0, NULL, 0, '', 0, 0, '2015-07-28 07:12:04', '0000-00-00 00:00:00', '', '', '2,3', '', 0, 0),
(26, 'tester', 'tester', '', 'testet', 'tester', 'f5d1278e8109edd94e1e4197e04873b9', 'tester', 'tester123@gmail.com', 0, '', 0, 0, NULL, 0, '', 0, 0, '2015-07-28 07:16:37', '0000-00-00 00:00:00', '', '', '2,3', '', 0, 0),
(27, 'tester', 'tester', '', 'testet', 'tester', 'a1567f781f6662071be9937591ac83de', 'testrer', 'tester1234@gmail.com', 0, '', 0, 0, NULL, 0, '', 0, 0, '2015-07-28 07:17:52', '0000-00-00 00:00:00', '', '', '2,3', '', 0, 0),
(28, 'test', 'test', '', 'developer', 'james', 'a152e841783914146e4bcd4f39100686', 'asdfgh', 'developer.test12@gmail.com', 0, '', 0, 0, NULL, 0, '', 0, 0, '2015-07-28 07:24:21', '0000-00-00 00:00:00', '', '', '2,3', '', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
