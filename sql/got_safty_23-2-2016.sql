-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2016 at 12:06 PM
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
-- Table structure for table `about_us`
--

CREATE TABLE IF NOT EXISTS `about_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `content`) VALUES
(1, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.</p>\r\n<p>Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>\r\n<p>Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</p>\r\n<p>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus.</p>\r\n<p>Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa.</p>\r\n<p>Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis</p>');

-- --------------------------------------------------------

--
-- Table structure for table `add_pages`
--

CREATE TABLE IF NOT EXISTS `add_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(5) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `add_pages`
--

INSERT INTO `add_pages` (`id`, `page_id`, `page_title`, `content`, `is_active`) VALUES
(1, 1, 'Test title', 'test content', 1),
(2, 2, 'Test title2', 'asds', 1),
(3, 3, 'Test title3', '<p>sdgds saran test</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `content`) VALUES
(1, '<p>1234 Street Dr.<br /> Vancouver, BC<br /> Canada<br /> V6G 1G9</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE IF NOT EXISTS `enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(150) NOT NULL,
  `best_time` varchar(100) NOT NULL,
  `number` varchar(50) NOT NULL,
  `suggestion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `first_name`, `last_name`, `email`, `company`, `best_time`, `number`, `suggestion`) VALUES
(1, 'saran', 'doss', 'sarandossit@gmail.com', 'izaap', 'Morning', '98765432', 'Test Suggestion');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `lang`, `is_active`) VALUES
(1, 'English', 1),
(2, 'Spanish', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `lession`
--

INSERT INTO `lession` (`id`, `title`, `content`, `created_date`, `updated_date`, `created_user`, `updated_user`, `is_active`) VALUES
(13, 'ATV Safety', '<h2 align="center">Page 1</h2>\r\n<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="http://eeap.com/members/lessons/lessons/ATV%20Safety//images/page1.png" alt="" width="513" height="655" /></p>\r\n<p>&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;</p>\r\n<h2 align="center">Page 2</h2>\r\n<p style="text-align: justify;"><strong>&nbsp;</strong></p>\r\n<p style="text-align: justify;"><strong><img src="http://eeap.com/members/lessons/lessons/ATV%20Safety//images/page2.png" alt="" width="510" height="766" /></strong></p>', '2016-02-19 06:31:44', '2016-02-19 12:28:30', 29, 8, 1),
(14, 'Abuse and Domestic Violence Reporting', '<h2 align="center">Page 1</h2>\r\n<p>&nbsp;<img src="http://eeap.com/members/lessons/lessons/Abuse%20and%20Domestic%20Violence%20Reporting//images/page1.png" alt="" width="544" height="697" /></p>\r\n<h2 align="center">Page 2</h2>\r\n<p><img src="http://eeap.com/members/lessons/lessons/Abuse%20and%20Domestic%20Violence%20Reporting//images/page2.png" alt="" width="548" height="702" /></p>\r\n<p><img src="/got_safety/assets/images/admin/uploads/angular.png" alt="" width="540" height="337" /></p>', '2016-02-19 07:05:31', '2016-02-22 16:31:30', 29, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lession_attachment`
--

CREATE TABLE IF NOT EXISTS `lession_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lession_id` int(5) NOT NULL,
  `language` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_name_quiz` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `lession_attachment`
--

INSERT INTO `lession_attachment` (`id`, `lession_id`, `language`, `f_name`, `f_name_quiz`, `is_active`) VALUES
(14, 13, 'English', 'English_ATV_Safety.pdf', 'English_ATV_Safety-Quiz.pdf', 1),
(15, 13, 'Spanish', 'Spanish_ATV_Safety.pdf', 'Spanish_ATV_Safety-Quiz.pdf', 1),
(16, 14, 'English', 'English_Abuse_and_Domestic_Violence_Reporting.pdf', 'English_Abuse_and_Domestic_Violence_Reporting-Quiz.pdf', 1),
(17, 14, 'Spanish', 'Spanish_Abuse_and_Domestic_Violence_Reporting.pdf', 'Spanish_Abuse_and_Domestic_Violence_Reporting-Quiz.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_content`
--

CREATE TABLE IF NOT EXISTS `lesson_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lesson_content`
--

INSERT INTO `lesson_content` (`id`, `content`) VALUES
(1, '<p>The California Code states that &ldquo;regular&rdquo; training must take place, i.e., monthly for businesses such as yours. A business whose employees are primarily out in the field, such as construction co., must provide training every 10 working days.</p>\r\n<p>If you hire a new employee, they must be trained in safety practices prior to working. These requirements are valid for every employee. Also, the documentation of same is important - make sure the attendance sheets are signed and kept.</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `dynamic_fields` text NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `dynamic_fields`, `is_active`) VALUES
(1, 'Test test 1234', '', 1),
(2, 'Sadsad', '', 1),
(3, 'Saran', 'name,email,contact', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ori_password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1=admin,2=client,3=user',
  `phone` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_id` varchar(5) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `ori_password`, `email`, `role`, `phone`, `is_active`, `created_id`, `created_date`) VALUES
(8, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@gmail.com', 1, '9876543212', 1, '', '2015-03-13 09:03:07'),
(29, 'client', '3677b23baa08f74c28aba07f0cb6554e', 'client123', 'client1@gmail.com', 2, '', 1, '8', '2016-02-17 09:58:03'),
(38, 'user1', '6ad14ba9986e3615423dfca256d04e3f', 'user123', 'user@gmail.com', 3, '', 1, '29', '2016-02-17 09:58:58'),
(39, 'client2', '3677b23baa08f74c28aba07f0cb6554e', 'client123', 'client2@gmail.com', 2, '', 1, '8', '2016-02-17 11:13:14'),
(40, 'user2', '6ad14ba9986e3615423dfca256d04e3f', 'user123', 'user2@gmail.com', 3, '', 1, '39', '2016-02-17 11:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `webinars`
--

CREATE TABLE IF NOT EXISTS `webinars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `video_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `webinars`
--

INSERT INTO `webinars` (`id`, `title`, `link`, `video_file`, `created_date`, `created_user`, `updated_user`, `is_active`) VALUES
(6, 'HAZCOM GHS', '<p>https://www.youtube.com/embed/G5wa94XiDGo</p>', '', '2016-02-19', 29, 8, 1),
(7, 'Reporting Injuries to Cal OSHA', '<p>https://www.youtube.com/embed/xBhUD06o7DM</p>', '', '2016-02-19', 29, 8, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
