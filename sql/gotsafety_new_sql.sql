-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2016 at 08:40 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gotsafety`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `content`) VALUES
(1, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.</p>\r\n<p>Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>\r\n<p>Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</p>\r\n<p>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus.</p>\r\n<p>Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa.</p>\r\n<p>Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis</p>');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(10) NOT NULL,
  `name` varchar(55) NOT NULL,
  `company_name` longtext NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address` longtext NOT NULL,
  `state` varchar(10) NOT NULL,
  `city` varchar(55) NOT NULL,
  `country` varchar(10) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `type` varchar(5) NOT NULL,
  `userid` int(10) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `name`, `company_name`, `email`, `phone`, `address`, `state`, `city`, `country`, `zip_code`, `type`, `userid`, `created_date`) VALUES
(1, 'gavaskar', 'izaap technologies', 'gavaskarizaap@gmail.com', '2132123212', 'chennai', 'ME', 'chennai', 'BB', '600040', 'ba', 0, '2016-07-08 13:59:01'),
(2, 'ramkumar', 'izaap', 'gavaskar@gmail.com', '3212321232', 'Tiruvanmaiyur', 'KY', 'chennai', 'BB', '600050', 'sa', 0, '2016-07-08 13:59:01'),
(3, 'sdfsad', 'fasdf', 'asdfasdf@gmail.com', 'dsfasdf', 'asdfasd', 'ME', 'fasdf', 'BD', '600040', 'ba', 0, '2016-07-08 16:08:38'),
(4, 'dsfas', 'dfasdf', 'asdfasdf@gmail.com', 'dfasdfasdf', 'asdfasdf', 'LA', 'adsf', 'BB', '600040', 'sa', 0, '2016-07-08 16:08:38'),
(5, 'sddsfasd', 'fadsf', 'asdfasdf@gmail.com', 'sadfasdfasdf', 'asdf', 'ME', 'dasfadsf', 'BB', 'dasfasdf', 'ba', 0, '2016-07-11 09:49:51'),
(6, 'asdfasdf', 'dsfasdf', 'asdfasdf@gmail.com', 'fasdf', 'asdfasd', 'LA', 'dsfasdf', 'BB', 'adsfasdf', 'sa', 0, '2016-07-11 09:49:51'),
(7, 'dsfasdf', 'asdfasdf', 'asfaadsfadsf@gmail.com', 'dsfasdfasdf', 'asdfasdf', 'ME', 'asdfasdf', 'BB', 'dsafasdfasdf', 'ba', 0, '2016-07-11 10:03:46'),
(8, 'dsfasd', 'fasdf', 'dsfasdf@gmail.com', 'sdafasdfdfasdfs', 'fasdf', 'LA', 'asdfaasd', 'DK', 'dsfasdf', 'sa', 0, '2016-07-11 10:03:46'),
(9, 'gavaskar', 'sadfADSsad', 'sadASDASD@gmail.com', 'dsfasdfasdfadsf', 'asdfasdf', 'ME', 'dsfasdf', 'BB', 'dsfasdfadsf', 'ba', 0, '2016-07-11 10:11:08'),
(10, 'sdfasdf', '', 'asdfasdf@gmail.com', 'dsfasdf', 'dsfasdfdcsd', 'LA', 'dasdf', 'DK', 'asdfasdf', 'sa', 29, '2016-07-11 10:11:08'),
(11, 'dsfasdf', 'asdfasdf', 'sdgfsafgsdfg@gmail.com', 'asdfasdfasdf', 'dasfadsf', 'ME', 'asdf', 'BB', 'dasfasdf', 'ba', 116, '2016-07-11 11:47:36'),
(12, 'sdfasdf', 'dfasdfa', 'dsfasdf@gmail.com', 'sdfasdf', 'fasdfa', 'LA', 'adsfads', 'DK', 'asdfasdf', 'sa', 116, '2016-07-11 11:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `add_pages`
--

CREATE TABLE `add_pages` (
  `id` int(11) NOT NULL,
  `page_id` int(5) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_pages`
--

INSERT INTO `add_pages` (`id`, `page_id`, `page_title`, `content`, `is_active`) VALUES
(4, 4, 'About us', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.</p>\r\n<p>Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>\r\n<p>Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.</p>\r\n<p>Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus.</p>\r\n<p>Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa.</p>\r\n<p>Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis..</p>', 1),
(5, 5, 'Contact us', '<p>1234 Street Dr.<br /> Vancouver, BC<br /> Canada<br /> V6G 1G9</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `api_logs`
--

CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text NOT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `time` int(11) NOT NULL,
  `authorized` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_logs`
--

INSERT INTO `api_logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `authorized`) VALUES
(879721, 'api/get_user_lesson_list', 'post', 'a:2:{s:7:"user_id";s:2:"42";s:10:"created_id";s:0:"";}', '', '127.0.0.1', 1457014507, 0),
(879722, 'api/get_user_lesson_list', 'post', 'a:3:{s:9:"X-APP-KEY";s:4:"test";s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";}', 'test', '127.0.0.1', 1457014636, 1),
(879723, 'api/get_user_lesson_list', 'post', 'a:3:{s:9:"X-APP-KEY";s:4:"test";s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";}', 'test', '127.0.0.1', 1457015162, 1),
(879724, 'api/get_user_lesson_list', 'post', 'a:3:{s:9:"X-APP-KEY";s:4:"test";s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";}', 'test', '127.0.0.1', 1457015358, 1),
(879725, 'api/get_user_lesson_list', 'get', 'a:0:{}', '', '127.0.0.1', 1457015370, 0),
(879726, 'api/get_user_lesson_list', 'post', 'a:0:{}', '', '127.0.0.1', 1457015412, 0),
(879727, 'api/get_user_lesson_list', 'post', 'a:1:{s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457015424, 1),
(879728, 'api/get_user_lesson_list', 'post', 'a:3:{s:9:"X-APP-KEY";s:4:"test";s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";}', 'test', '127.0.0.1', 1457015458, 1),
(879729, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"42";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017034, 1),
(879730, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017047, 1),
(879731, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"38";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017063, 1),
(879732, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"38";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017217, 1),
(879733, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"38";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017496, 1),
(879734, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017514, 1),
(879735, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017566, 1),
(879736, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017578, 1),
(879737, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"38";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017585, 1),
(879738, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"38";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017590, 1),
(879739, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017628, 1),
(879740, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017656, 1),
(879741, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017797, 1),
(879742, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:1:"8";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017865, 1),
(879743, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017875, 1),
(879744, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:1:"8";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457017879, 1),
(879745, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:1:"8";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457018071, 1),
(879746, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:1:"8";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457018138, 1),
(879747, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"40";s:10:"created_id";s:2:"39";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457018231, 1),
(879748, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"40";s:10:"created_id";s:2:"39";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457018251, 1),
(879749, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"40";s:10:"created_id";s:2:"39";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457018268, 1),
(879750, 'api/get_user_lesson_list', 'post', 'a:3:{s:7:"user_id";s:2:"29";s:10:"created_id";s:1:"8";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457018278, 1),
(879751, 'api/get_user_lesson_list', 'get', 'a:1:{s:10:"created_id";s:12:"8?user_id=29";}', '', '127.0.0.1', 1457334804, 0),
(879752, 'api/get_user_lesson_list', 'get', 'a:1:{s:10:"created_id";s:27:"8?user_id=29?X-APP-KEY=test";}', '', '127.0.0.1', 1457334838, 0),
(879753, 'api/get_user_lesson_list&created_id=8&user_id=29&X-APP-KEY=test', 'get', 'a:0:{}', '', '127.0.0.1', 1457334898, 0),
(879754, 'api/get_user_lesson_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457335027, 1),
(879755, 'api/get_user_lesson_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457335161, 1),
(879756, 'api/get_user_lesson_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457336103, 1),
(879757, 'api/get_user_lesson_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457339182, 1),
(879758, 'api/get_user_lesson_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457344706, 1),
(879759, 'api/get_lesson_content', 'get', 'a:1:{s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457345111, 1),
(879760, 'api/get_user_webinars_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457345417, 1),
(879761, 'api/get_lesson_attachment', 'get', 'a:2:{s:9:"lesson_id";s:2:"14";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457345801, 1),
(879762, 'api/get_lesson_attachment', 'get', 'a:2:{s:9:"lesson_id";s:2:"14";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457345830, 1),
(879763, 'api/search_lesson', 'get', 'a:2:{s:5:"title";s:3:"and";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346036, 1),
(879764, 'api/search_lesson', 'get', 'a:2:{s:5:"title";s:1:"s";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346073, 1),
(879765, 'api/search_lesson', 'get', 'a:2:{s:5:"title";s:1:"s";s:9:"X-APP-KEY";s:6:"testsd";}', '', '127.0.0.1', 1457346262, 0),
(879766, 'api/search_lesson', 'get', 'a:2:{s:5:"title";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346280, 1),
(879767, 'api/search_lesson', 'get', 'a:2:{s:5:"title";s:1:"s";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346287, 1),
(879768, 'api/get_lesson_details', 'get', 'a:2:{s:2:"id";s:2:"14";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346307, 1),
(879769, 'api/get_all_lesson_list', 'get', 'a:1:{s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346416, 1),
(879770, 'api/get_user_detail', 'get', 'a:3:{s:7:"user_id";s:2:"29";s:4:"role";s:1:"3";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346588, 1),
(879771, 'api/get_user_detail', 'get', 'a:3:{s:7:"user_id";s:2:"29";s:4:"role";s:1:"2";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346599, 1),
(879772, 'api/get_user_detail', 'get', 'a:3:{s:7:"user_id";s:2:"29";s:4:"role";s:1:"2";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346657, 1),
(879773, 'api/get_user_detail', 'get', 'a:3:{s:7:"user_id";s:2:"29";s:4:"role";s:1:"2";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346782, 1),
(879774, 'api/get_user_detail', 'get', 'a:3:{s:7:"user_id";s:2:"38";s:4:"role";s:1:"3";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346813, 1),
(879775, 'api/get_client_list', 'get', 'a:1:{s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457346984, 1),
(879776, 'api/get_user_list', 'get', 'a:1:{s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457347098, 1),
(879777, 'api/get_user_lesson_list&created_id=8&user_id=29&X-APP-KEY=test', 'get', 'a:0:{}', '', '127.0.0.1', 1457690225, 0),
(879778, 'api/get_user_lesson_list&created_id=8&user_id=29&X-APP-KEY=test', 'get', 'a:0:{}', '', '127.0.0.1', 1457690257, 0),
(879779, 'api/get_user_lesson_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457690260, 1),
(879780, 'api/get_user_webinars_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457779794, 1),
(879781, 'api/get_user_webinars_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1457779825, 1),
(879782, 'api/login', 'post', 'a:2:{s:8:"username";s:5:"user1";s:8:"password";s:7:"user123";}', '', '127.0.0.1', 1458198912, 0),
(879783, 'api/login', 'post', 'a:3:{s:8:"username";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458198994, 1),
(879784, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199028, 1),
(879785, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199305, 1),
(879786, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199341, 1),
(879787, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:18:"user123qwrewrewrer";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199346, 1),
(879788, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:26:"user123qwrewrewrerwerfwete";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199360, 1),
(879789, 'api/login', 'post', 'a:3:{s:4:"name";s:0:"";s:8:"password";s:0:"";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199368, 1),
(879790, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199380, 1),
(879791, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"clent";s:8:"password";s:9:"client123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199392, 1),
(879792, 'api/login', 'post', 'a:3:{s:4:"name";s:6:"clent1";s:8:"password";s:9:"client123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199396, 1),
(879793, 'api/login', 'post', 'a:3:{s:4:"name";s:6:"client";s:8:"password";s:9:"client123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199404, 1),
(879794, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"admin";s:8:"password";s:5:"admin";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458199415, 1),
(879795, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"admin";s:8:"password";s:5:"admin";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458202798, 1),
(879796, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458202809, 1),
(879797, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:0:"";}', '', '127.0.0.1', 1458202812, 0),
(879798, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458202817, 1),
(879799, 'api/get_user_poster_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458651326, 1),
(879800, 'api/get_user_poster_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458651351, 1),
(879801, 'api/get_user_poster_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"39";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458651362, 1),
(879802, 'api/get_posters_attachment', 'get', 'a:2:{s:9:"poster_id";s:2:"14";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458651583, 1),
(879803, 'api/get_posters_attachment', 'get', 'a:2:{s:9:"poster_id";s:2:"14";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458651607, 1),
(879804, 'api/get_posters_attachment', 'get', 'a:2:{s:9:"poster_id";s:2:"14";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458651646, 1),
(879805, 'api/get_posters_attachment', 'get', 'a:2:{s:9:"poster_id";s:2:"14";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458651670, 1),
(879806, 'api/get_posters_attachment', 'get', 'a:2:{s:9:"poster_id";s:2:"14";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458651718, 1),
(879807, 'api/get_content', 'get', 'a:2:{s:4:"type";s:1:"6";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458652145, 1),
(879808, 'api/get_content', 'get', 'a:2:{s:4:"type";s:1:"5";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458652182, 1),
(879809, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653019, 1),
(879810, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653049, 1),
(879811, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653110, 1),
(879812, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653194, 1),
(879813, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653209, 1),
(879814, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653368, 1),
(879815, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653380, 1),
(879816, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653470, 1),
(879817, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653523, 1),
(879818, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653553, 1),
(879819, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653639, 1),
(879820, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"2";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653693, 1),
(879821, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"39";s:4:"type";s:1:"2";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653723, 1),
(879822, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"38";s:4:"type";s:1:"2";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653788, 1),
(879823, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:2:"29";s:7:"user_id";s:2:"38";s:4:"type";s:1:"2";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458653818, 1),
(879824, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:2:"29";s:7:"user_id";s:2:"38";s:4:"type";s:1:"2";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654052, 1),
(879825, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"38";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654098, 1),
(879826, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654114, 1),
(879827, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:2:"29";s:7:"user_id";s:2:"38";s:4:"type";s:1:"2";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654121, 1),
(879828, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:2:"29";s:7:"user_id";s:2:"38";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654128, 1),
(879829, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:2:"29";s:7:"user_id";s:2:"38";s:4:"type";s:1:"1";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654758, 1),
(879830, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:2:"29";s:7:"user_id";s:2:"38";s:4:"type";s:1:"7";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654766, 1),
(879831, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:2:"29";s:7:"user_id";s:2:"38";s:4:"type";s:1:"7";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654814, 1),
(879832, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:2:"29";s:7:"user_id";s:2:"38";s:4:"type";s:1:"5";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654822, 1),
(879833, 'api/get_user_menu_list', 'get', 'a:4:{s:10:"created_id";s:2:"29";s:7:"user_id";s:2:"38";s:4:"type";s:1:"5";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458654943, 1),
(879834, 'api/get_user_lesson_list', 'get', 'a:3:{s:10:"created_id";s:1:"8";s:7:"user_id";s:2:"29";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1458739635, 1),
(879835, 'api/login', 'post', 'a:3:{s:8:"username";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1459170582, 1),
(879836, 'api/login', 'post', 'a:3:{s:4:"name";s:5:"user1";s:8:"password";s:7:"user123";s:9:"X-APP-KEY";s:4:"test";}', 'test', '127.0.0.1', 1459170592, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `id` int(10) NOT NULL,
  `attr_name` longtext NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`id`, `attr_name`, `is_active`, `updated_date`) VALUES
(34, 'label size', 1, '2016-07-01 08:56:26'),
(35, 'poster size', 1, '2016-07-01 08:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(10) NOT NULL,
  `attr_id` int(10) NOT NULL,
  `attr_val` longtext NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `attr_id`, `attr_val`, `is_active`, `updated_date`) VALUES
(26, 34, '134*1201', 1, '2016-07-01 09:36:14'),
(27, 34, '190*210', 1, '2016-07-01 09:13:22'),
(28, 35, '12*30', 1, '2016-07-01 09:13:39'),
(29, 35, '38*98', 1, '2016-07-01 09:13:46'),
(30, 35, '90*120', 1, '2016-07-01 09:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `cal_osha`
--

CREATE TABLE `cal_osha` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `visible_to_all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cal_osha`
--

INSERT INTO `cal_osha` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `visible_to_all`, `is_display`) VALUES
(2, 'Asdsad', 'Spanish_Abuse_and_Domestic_Violence_Reporting.pdf', '2016-03-15', 29, 0, 0, 1),
(3, 'Call osha test', 'dummyPDF.pdf', '2016-05-31', 29, 8, 1, 1),
(4, 'Call osha test 1', 'dummy.pdf', '2016-05-31', 29, 8, 1, 1),
(5, 'Call osha test 3', 'dummy1.pdf', '2016-05-31', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `cat_name` varchar(70) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`, `updated_date`) VALUES
(8, 'Caution Stickers', '2016-07-01 08:56:13'),
(9, 'Danger Stickers', '2016-07-01 08:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `content`) VALUES
(1, '<p>1234 Street Dr.<br /> Vancouver, BC<br /> Canada<br /> V6G 1G9</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afganistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'AS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegowina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CD', 'Congo, the Democratic Republic of the'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'CI', 'Cote d''Ivoire'),
(54, 'HR', 'Croatia (Hrvatska)'),
(55, 'CU', 'Cuba'),
(56, 'CY', 'Cyprus'),
(57, 'CZ', 'Czech Republic'),
(58, 'DK', 'Denmark'),
(59, 'DJ', 'Djibouti'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'TP', 'East Timor'),
(63, 'EC', 'Ecuador'),
(64, 'EG', 'Egypt'),
(65, 'SV', 'El Salvador'),
(66, 'GQ', 'Equatorial Guinea'),
(67, 'ER', 'Eritrea'),
(68, 'EE', 'Estonia'),
(69, 'ET', 'Ethiopia'),
(70, 'FK', 'Falkland Islands (Malvinas)'),
(71, 'FO', 'Faroe Islands'),
(72, 'FJ', 'Fiji'),
(73, 'FI', 'Finland'),
(74, 'FR', 'France'),
(75, 'FX', 'France, Metropolitan'),
(76, 'GF', 'French Guiana'),
(77, 'PF', 'French Polynesia'),
(78, 'TF', 'French Southern Territories'),
(79, 'GA', 'Gabon'),
(80, 'GM', 'Gambia'),
(81, 'GE', 'Georgia'),
(82, 'DE', 'Germany'),
(83, 'GH', 'Ghana'),
(84, 'GI', 'Gibraltar'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GN', 'Guinea'),
(92, 'GW', 'Guinea-Bissau'),
(93, 'GY', 'Guyana'),
(94, 'HT', 'Haiti'),
(95, 'HM', 'Heard and Mc Donald Islands'),
(96, 'VA', 'Holy See (Vatican City State)'),
(97, 'HN', 'Honduras'),
(98, 'HK', 'Hong Kong'),
(99, 'HU', 'Hungary'),
(100, 'IS', 'Iceland'),
(101, 'IN', 'India'),
(102, 'ID', 'Indonesia'),
(103, 'IR', 'Iran (Islamic Republic of)'),
(104, 'IQ', 'Iraq'),
(105, 'IE', 'Ireland'),
(106, 'IL', 'Israel'),
(107, 'IT', 'Italy'),
(108, 'JM', 'Jamaica'),
(109, 'JP', 'Japan'),
(110, 'JO', 'Jordan'),
(111, 'KZ', 'Kazakhstan'),
(112, 'KE', 'Kenya'),
(113, 'KI', 'Kiribati'),
(114, 'KP', 'Korea, Democratic People''s Republic of'),
(115, 'KR', 'Korea, Republic of'),
(116, 'KW', 'Kuwait'),
(117, 'KG', 'Kyrgyzstan'),
(118, 'LA', 'Lao People''s Democratic Republic'),
(119, 'LV', 'Latvia'),
(120, 'LB', 'Lebanon'),
(121, 'LS', 'Lesotho'),
(122, 'LR', 'Liberia'),
(123, 'LY', 'Libyan Arab Jamahiriya'),
(124, 'LI', 'Liechtenstein'),
(125, 'LT', 'Lithuania'),
(126, 'LU', 'Luxembourg'),
(127, 'MO', 'Macau'),
(128, 'MK', 'Macedonia, The Former Yugoslav Republic of'),
(129, 'MG', 'Madagascar'),
(130, 'MW', 'Malawi'),
(131, 'MY', 'Malaysia'),
(132, 'MV', 'Maldives'),
(133, 'ML', 'Mali'),
(134, 'MT', 'Malta'),
(135, 'MH', 'Marshall Islands'),
(136, 'MQ', 'Martinique'),
(137, 'MR', 'Mauritania'),
(138, 'MU', 'Mauritius'),
(139, 'YT', 'Mayotte'),
(140, 'MX', 'Mexico'),
(141, 'FM', 'Micronesia, Federated States of'),
(142, 'MD', 'Moldova, Republic of'),
(143, 'MC', 'Monaco'),
(144, 'MN', 'Mongolia'),
(145, 'MS', 'Montserrat'),
(146, 'MA', 'Morocco'),
(147, 'MZ', 'Mozambique'),
(148, 'MM', 'Myanmar'),
(149, 'NA', 'Namibia'),
(150, 'NR', 'Nauru'),
(151, 'NP', 'Nepal'),
(152, 'NL', 'Netherlands'),
(153, 'AN', 'Netherlands Antilles'),
(154, 'NC', 'New Caledonia'),
(155, 'NZ', 'New Zealand'),
(156, 'NI', 'Nicaragua'),
(157, 'NE', 'Niger'),
(158, 'NG', 'Nigeria'),
(159, 'NU', 'Niue'),
(160, 'NF', 'Norfolk Island'),
(161, 'MP', 'Northern Mariana Islands'),
(162, 'NO', 'Norway'),
(163, 'OM', 'Oman'),
(164, 'PK', 'Pakistan'),
(165, 'PW', 'Palau'),
(166, 'PA', 'Panama'),
(167, 'PG', 'Papua New Guinea'),
(168, 'PY', 'Paraguay'),
(169, 'PE', 'Peru'),
(170, 'PH', 'Philippines'),
(171, 'PN', 'Pitcairn'),
(172, 'PL', 'Poland'),
(173, 'PT', 'Portugal'),
(174, 'PR', 'Puerto Rico'),
(175, 'QA', 'Qatar'),
(176, 'RE', 'Reunion'),
(177, 'RO', 'Romania'),
(178, 'RU', 'Russian Federation'),
(179, 'RW', 'Rwanda'),
(180, 'KN', 'Saint Kitts and Nevis'),
(181, 'LC', 'Saint LUCIA'),
(182, 'VC', 'Saint Vincent and the Grenadines'),
(183, 'WS', 'Samoa'),
(184, 'SM', 'San Marino'),
(185, 'ST', 'Sao Tome and Principe'),
(186, 'SA', 'Saudi Arabia'),
(187, 'SN', 'Senegal'),
(188, 'SC', 'Seychelles'),
(189, 'SL', 'Sierra Leone'),
(190, 'SG', 'Singapore'),
(191, 'SK', 'Slovakia (Slovak Republic)'),
(192, 'SI', 'Slovenia'),
(193, 'SB', 'Solomon Islands'),
(194, 'SO', 'Somalia'),
(195, 'ZA', 'South Africa'),
(196, 'GS', 'South Georgia and the South Sandwich Islands'),
(197, 'ES', 'Spain'),
(198, 'LK', 'Sri Lanka'),
(199, 'SH', 'St. Helena'),
(200, 'PM', 'St. Pierre and Miquelon'),
(201, 'SD', 'Sudan'),
(202, 'SR', 'Suriname'),
(203, 'SJ', 'Svalbard and Jan Mayen Islands'),
(204, 'SZ', 'Swaziland'),
(205, 'SE', 'Sweden'),
(206, 'CH', 'Switzerland'),
(207, 'SY', 'Syrian Arab Republic'),
(208, 'TW', 'Taiwan'),
(209, 'TJ', 'Tajikistan'),
(210, 'TZ', 'Tanzania, United Republic of'),
(211, 'TH', 'Thailand'),
(212, 'TG', 'Togo'),
(213, 'TK', 'Tokelau'),
(214, 'TO', 'Tonga'),
(215, 'TT', 'Trinidad and Tobago'),
(216, 'TN', 'Tunisia'),
(217, 'TR', 'Turkey'),
(218, 'TM', 'Turkmenistan'),
(219, 'TC', 'Turks and Caicos Islands'),
(220, 'TV', 'Tuvalu'),
(221, 'UG', 'Uganda'),
(222, 'UA', 'Ukraine'),
(223, 'AE', 'United Arab Emirates'),
(224, 'GB', 'United Kingdom'),
(225, 'US', 'United States'),
(226, 'UM', 'United States Minor Outlying Islands'),
(227, 'UY', 'Uruguay'),
(228, 'UZ', 'Uzbekistan'),
(229, 'VU', 'Vanuatu'),
(230, 'VE', 'Venezuela'),
(231, 'VN', 'Viet Nam'),
(232, 'VG', 'Virgin Islands (British)'),
(233, 'VI', 'Virgin Islands (U.S.)'),
(234, 'WF', 'Wallis and Futuna Islands'),
(235, 'EH', 'Western Sahara'),
(236, 'YE', 'Yemen'),
(237, 'YU', 'Yugoslavia'),
(238, 'ZM', 'Zambia'),
(239, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `display_content`
--

CREATE TABLE `display_content` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `display_content`
--

INSERT INTO `display_content` (`id`, `content`) VALUES
(1, '<p>INspection Cal/OSHA requires regular inspections of the workplace to determine any unsafe conditions &amp; the action necessary to remedy such issues.</p>\r\n<p><strong>Per Cal/OSHA code &sect;1511. General Safety Precautions.</strong></p>\r\n<p>(a) No worker shall be required or knowingly permitted to work in an unsafe place, unless for the purpose of making it safe and then only after proper precautions have been taken to protect the employee while doing such work.</p>\r\n<p>(b) Prior to the presence of its employees, the employer shall make a thorough survey of the conditions of the site to determine, so far as practicable, the predictable hazards to employees and the kind and extent of safeguards necessary to prosecute the work in a safe manner.</p>'),
(2, '<p>call osha In California every employer is required by law (Labor Code Section) to provide a safe and healthful workplace for his/her employees. Title 8 of the California Code of Regulations (CCR), requires every California employer to have an effective Injury and Illness Prevention Program in writing that must be in accord with T8 CCR Section 3203 of the General Industry Safety Orders. This documentation file contains written programs required by Cal/OSHA.</p>'),
(3, '<p>300 In the package, you&rsquo;ll find information that will help you complete Cal/OSHA&rsquo;s Log and Summary of Work-Related Injuries and Illnesses. You must post the previous year&rsquo;s Summary only &ndash; not the Log &ndash; by February 1st and keep posted until April 30th of this year. You must keep the Log and Summary for 5 years following the year to which they pertain.</p>'),
(4, '<p>Records Here you will find your Training Schedule and Records for this year. If there is no schedule below please fill out our <a href="#">Training Schedule Sheet</a> and send it into EEAP by Fax or email. If you would like us to keep your attendance sheet records you may send them into EEAP by Fax or Email. <a href="#">Attendance Sheet</a> records saved here are for backup purposes only. Employers are required to save the original at their location.</p>'),
(5, '<p>Forms In order to fill-out the "Interactive" Forms, they must first be saved to your computer. Right click on link and click "save target as.." in Internet Explorer or "save link as.." in Firefox. Once you have saved the form, you may open it and fill it out.</p>\r\n<p><strong> Labor Law Poster Updates for Family and Medical Leave (CFRA) Effective July 1st 2015</strong></p>\r\n<p>*Required for Employers with 50 or more employees. Print, and place over the poster. It is designed to fit over the current Notice B using the trim marks as a guide*</p>'),
(6, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_name`, `employee_email`, `emp_id`, `created_user`, `updated_user`, `created_date`, `updated_date`, `is_active`) VALUES
(12, 'Dasd', 'saran2@gmail.com', 'EMP5', 29, 8, '2016-04-21 16:58:47', '2016-04-07 15:22:05', 1),
(13, 'Ram', 'ram@gmail.com', 'EMP4', 29, 8, '2016-04-21 17:00:11', '2016-04-16 07:14:07', 1),
(14, 'Tes', 'saranASDS@gmail.com', 'EMP1', 61, 8, '2016-04-21 16:59:59', '2016-04-21 11:29:54', 1),
(98, 'sample', 'test@gmail.com', 'EMP10', 29, 8, '0000-00-00 00:00:00', '2016-04-25 08:09:24', 1),
(99, 'sample2', 'test@gmail.com', 'EMP15', 29, 8, '0000-00-00 00:00:00', '2016-04-25 08:09:24', 1),
(103, 'Qwdqew', 'wqewew@gmail.com', 'EMP14', 29, 0, '2016-04-25 13:41:14', '2016-04-25 08:11:14', 1),
(122, 'sample3', 'test@gmail.com', 'EMP16', 29, 8, '2016-04-25 13:50:00', '2016-04-25 08:20:00', 1),
(137, 'sample4', 'test@gmail.com', 'EMP16', 61, 8, '2016-04-25 13:51:49', '2016-04-25 08:21:49', 1),
(151, 'sample3', 'test@gmail.com', 'EMP17', 29, 0, '2016-04-25 13:53:28', '2016-04-25 08:23:28', 1),
(156, 'sample3', 'test@gmail.com', 'EMP17', 61, 8, '2016-04-25 14:56:58', '2016-04-25 09:26:58', 1),
(170, 'Employee Name', 'Email', 'Employee ID', 0, 8, '2016-05-27 19:19:57', '2016-05-27 13:49:57', 1),
(214, 'Sample44', 'test@gmail.com', 'EMP25', 29, 0, '2016-05-30 12:29:47', '2016-05-30 06:59:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(150) NOT NULL,
  `best_time` varchar(100) NOT NULL,
  `number` varchar(50) NOT NULL,
  `suggestion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `first_name`, `last_name`, `email`, `company`, `best_time`, `number`, `suggestion`) VALUES
(1, 'saran', 'doss', 'sarandossit@gmail.com', 'izaap', 'Morning', '98765432', 'Test Suggestion'),
(2, 'saran', 'doss', 'saran@gmail.com', 'izaap tech', 'Morning', '9659362508', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `inspection_reports`
--

CREATE TABLE `inspection_reports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `visible_to_all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspection_reports`
--

INSERT INTO `inspection_reports` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `visible_to_all`, `is_display`) VALUES
(2, 'Asdsad', 'Spanish_Abuse_and_Domestic_Violence_Reporting.pdf', '2016-03-15', 29, 0, 0, 1),
(3, 'Test report', '1dummy.pdf', '2016-03-22', 29, 8, 1, 1),
(4, 'Test records2', 'dummy.pdf', '2016-05-31', 29, 8, 1, 1),
(5, 'Test records3', 'dummyPDF.pdf', '2016-05-31', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `custom_key` tinyint(4) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `level`, `ignore_limits`, `custom_key`, `date_created`) VALUES
(43, 'test', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `lang`, `is_active`) VALUES
(1, 'English', 1),
(2, 'Spanish', 1),
(3, 'Dutch', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lession`
--

CREATE TABLE `lession` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `from` varchar(50) NOT NULL,
  `to_date` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `visible_to_all` int(2) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lession`
--

INSERT INTO `lession` (`id`, `title`, `content`, `from`, `to_date`, `created_date`, `updated_date`, `created_user`, `updated_user`, `visible_to_all`, `is_active`) VALUES
(13, 'ATV Safety', '<h2 align="center">Page 1</h2>\r\n<p>&nbsp;<img src="http://izaapinnovations.com/got_safety/assets/images/admin/uploads/page1_3.png" alt="" width="550" height="705" /></p>\r\n<h2 align="center">Page 2</h2>\r\n<p><img src="http://izaapinnovations.com/got_safety/assets/images/admin/uploads/page2_3.png" alt="" width="558" height="715" /></p>\r\n<p>&nbsp;</p>', '2016-04-05', '2016-06-28', '2016-02-19 06:31:44', '2016-05-30 09:23:35', 29, 8, 1, 1),
(14, 'Abuse and Domestic Violence Reporting', '<h2 align="center">Page 1</h2>\r\n<p>&nbsp;<img src="http://izaapinnovations.com/got_safety/assets/images/admin/uploads/page1_3.png" alt="" width="550" height="705" /></p>\r\n<h2 align="center">Page 2</h2>\r\n<p><img src="http://izaapinnovations.com/got_safety/assets/images/admin/uploads/page2_3.png" alt="" width="558" height="715" /></p>\r\n<p>&nbsp;</p>', '2016-04-08', '2016-06-25', '2016-02-19 07:05:31', '2016-05-31 06:49:04', 29, 8, 1, 1),
(15, 'test', '<p>ascdasd</p>', '2016-04-08', '2016-04-15', '2016-02-27 12:50:12', '2016-02-27 18:20:12', 39, 0, 1, 1),
(16, 'test', '<p>asdas</p>', '', '', '2016-03-01 10:01:07', '2016-03-01 15:31:07', 42, 0, 0, 1),
(17, 'Steve''s TEst', '<p>Steve''s Test</p>', '2016-06-17', '2016-06-30', '2016-06-16 19:50:44', '2016-06-16 13:50:44', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lession_attachment`
--

CREATE TABLE `lession_attachment` (
  `id` int(11) NOT NULL,
  `lession_id` int(5) NOT NULL,
  `language` varchar(255) NOT NULL,
  `type` int(5) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_name_quiz` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lession_attachment`
--

INSERT INTO `lession_attachment` (`id`, `lession_id`, `language`, `type`, `f_name`, `f_name_quiz`, `is_active`) VALUES
(14, 13, 'English', 1, 'English_ATV_Safety.pdf', 'English_ATV_Safety-Quiz.pdf', 1),
(15, 13, 'Spanish', 1, 'Spanish_ATV_Safety.pdf', 'Spanish_ATV_Safety-Quiz.pdf', 1),
(16, 14, 'English', 1, 'English_Abuse_and_Domestic_Violence_Reporting.pdf', 'English_Abuse_and_Domestic_Violence_Reporting-Quiz.pdf', 1),
(17, 14, 'Spanish', 1, 'Spanish_Abuse_and_Domestic_Violence_Reporting.pdf', 'dummy.pdf', 1),
(18, 13, 'Dutch', 1, 'dummyPDF.pdf', 'dummy.pdf', 1),
(19, 17, 'English', 1, 'Kevins_routes1.pdf', 'Kevins_routes1.pdf', 1),
(20, 17, 'Spanish', 3, '', 'Merit_Badge_Form.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_content`
--

CREATE TABLE `lesson_content` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson_content`
--

INSERT INTO `lesson_content` (`id`, `content`) VALUES
(1, '<p>The California Code states that &ldquo;regular&rdquo; training must take place, i.e., monthly for businesses such as yours. A business whose employees are primarily out in the field, such as construction co., must provide training every 10 working days.</p>\r\n<p>If you hire a new employee, they must be trained in safety practices prior to working. These requirements are valid for every employee. Also, the documentation of same is important - make sure the attendance sheets are signed and kept.</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE `limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `action` text NOT NULL,
  `action_id` int(11) NOT NULL,
  `line` text NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=REDUNDANT;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `action`, `action_id`, `line`, `created_time`, `updated_time`) VALUES
(0, 'Payment Declined:Expiration date is required.', 5, 'sales_order', '2016-07-11 09:49:54', '2016-07-11 07:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `visible_to_all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `visible_to_all`, `is_display`) VALUES
(3, 'Test 2', 'dummyPDF1.pdf', '2016-05-31', 29, 8, 1, 1),
(4, 'Test 3', 'dummy2.pdf', '2016-05-31', 29, 8, 1, 1),
(5, 'Test 4', '1dummy.pdf', '2016-05-31', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dynamic_fields` text NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `dynamic_fields`, `is_active`) VALUES
(4, 'Aboutus', 'about,company', 1),
(5, 'Contactus', 'Contact,company', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `content` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_api_credentials`
--

CREATE TABLE `payment_api_credentials` (
  `id` int(11) NOT NULL,
  `api_username` varchar(255) NOT NULL,
  `api_password` varchar(255) NOT NULL,
  `api_signature` varchar(255) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `api_version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_api_credentials`
--

INSERT INTO `payment_api_credentials` (`id`, `api_username`, `api_password`, `api_signature`, `payment_mode`, `api_version`) VALUES
(1, 'punithalakshmi1587-facilitator_api1.gmail.com', '1404819301', 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAO8HsMyMC7m-QbuLkiSoxlhnATDW', 'sandbox', 123);

-- --------------------------------------------------------

--
-- Table structure for table `payment_recurring_profiles`
--

CREATE TABLE `payment_recurring_profiles` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `profile_id` varchar(255) NOT NULL,
  `profile_start_date` datetime NOT NULL,
  `next_billing_date` datetime NOT NULL,
  `subscription_id` bigint(20) NOT NULL,
  `trans_id` bigint(20) NOT NULL,
  `invoice_no` bigint(20) NOT NULL,
  `amount` double NOT NULL,
  `profile_status` varchar(50) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `pending_reason` varchar(150) NOT NULL,
  `last_payment_date` datetime NOT NULL,
  `last_payment_amt` double NOT NULL,
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_recurring_profiles`
--

INSERT INTO `payment_recurring_profiles` (`id`, `user_id`, `profile_id`, `profile_start_date`, `next_billing_date`, `subscription_id`, `trans_id`, `invoice_no`, `amount`, `profile_status`, `payment_status`, `pending_reason`, `last_payment_date`, `last_payment_amt`, `payment_method`) VALUES
(1, 76, 'I-J2R4BM3645LJ', '2016-06-30 07:00:00', '2016-06-30 10:00:00', 0, 4, 0, 15, 'Active', 'Completed', 'None', '0000-00-00 00:00:00', 0, 'paypal');

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction_history`
--

CREATE TABLE `payment_transaction_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `last_payment_date` datetime NOT NULL,
  `last_payment_amt` double NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(10) NOT NULL,
  `plan_type` varchar(40) NOT NULL,
  `plan_amount` decimal(11,2) NOT NULL,
  `plan_desc` longtext NOT NULL,
  `plan_directory` enum('Y','N') NOT NULL DEFAULT 'Y',
  `is_active` int(2) NOT NULL DEFAULT '1',
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `plan_type`, `plan_amount`, `plan_desc`, `plan_directory`, `is_active`, `updated_date`) VALUES
(12, 'my plans', '123.00', '<p>dfsdf</p>', 'Y', 1, '2016-06-22 15:36:10'),
(13, 'frg1', '1241.00', '<p>sdfsdf1</p>', 'N', 1, '2016-06-22 15:37:06'),
(14, 'gavaskar', '56.00', '<p>plans is plan also called as plan</p>', 'Y', 1, '2016-06-22 15:40:27'),
(15, 'silvers1', '1231.00', '<p>dsfdsf1</p>', 'Y', 0, '2016-06-23 15:43:27'),
(16, 'wer1', '12311.00', '<p>weqwe11</p>', 'N', 0, '2016-06-23 14:59:00'),
(17, 'dubaguru', '12.00', '<p>dubaguru</p>', 'Y', 1, '2016-06-27 13:25:36'),
(18, 'dubaguru1', '12.00', '<p>dfsdaf</p>', 'Y', 1, '2016-06-27 13:25:32'),
(19, 'silver1', '123.00', '<p>sdasd</p>', 'Y', 1, '2016-06-27 14:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `posters`
--

CREATE TABLE `posters` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `visible_to_all` int(2) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posters`
--

INSERT INTO `posters` (`id`, `title`, `content`, `created_date`, `updated_date`, `created_user`, `updated_user`, `visible_to_all`, `is_active`) VALUES
(13, 'ATV Safety poster', '<h2 align="center">Page 1</h2>\r\n<p style="text-align: justify;"><img src="http://izaapinnovations.com/got_safety/assets/images/admin/uploads/page2_4.png" alt="" width="536" height="687" /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p>&nbsp;</p>', '2016-02-19 06:31:44', '2016-05-31 07:04:34', 29, 8, 1, 1),
(14, 'Abuse and Domestic Violence Reporting-Posters1', '<h2 align="center">Page 1</h2>\r\n<p><img src="http://izaapinnovations.com/got_safety/assets/images/admin/uploads/page1_4.png" alt="" width="556" height="713" /></p>', '2016-02-19 07:05:31', '2016-05-31 07:03:54', 29, 8, 1, 1),
(15, 'test', '<p>ascdasd</p>', '2016-02-27 12:50:12', '2016-02-27 18:20:12', 39, 0, 0, 1),
(16, 'test', '<p>asdas</p>', '2016-03-01 10:01:07', '2016-03-01 15:31:07', 42, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posters_attachment`
--

CREATE TABLE `posters_attachment` (
  `id` int(11) NOT NULL,
  `poster_id` int(5) NOT NULL,
  `language` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_name_quiz` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posters_attachment`
--

INSERT INTO `posters_attachment` (`id`, `poster_id`, `language`, `f_name`, `f_name_quiz`, `is_active`) VALUES
(14, 13, 'English', 'dummy3.pdf', '1dummy1.pdf', 1),
(15, 13, 'Spanish', 'dummy2.pdf', 'dummyPDF1.pdf', 1),
(16, 14, 'English', 'dummyPDF.pdf', 'dummy1.pdf', 1),
(17, 14, 'Spanish', '1dummy.pdf', 'dummy.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` longtext NOT NULL,
  `cat` int(10) NOT NULL,
  `img` varchar(55) NOT NULL,
  `add_info` longtext NOT NULL,
  `sku` varchar(30) NOT NULL,
  `attr_id` int(10) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `cat`, `img`, `add_info`, `sku`, `attr_id`, `is_active`, `updated_date`) VALUES
(10, 'Poster', '<p>dfsdf</p>', 8, 'Chrysanthemum4.jpg', '<p>sdfasdf</p>', 'sdfsdf', 31, 1, '2016-06-30 16:31:53'),
(11, 'posters', '<p>sdfasdf</p>', 9, 'Chrysanthemum5.jpg', '<p>asdfasdf</p>', 'dsafasdf', 31, 1, '2016-06-30 16:32:22'),
(12, 'xzxczXc', '<p>xcZXcZXc</p>', 8, 'Chrysanthemum6.jpg', '<p>xzcZXC</p>', 'cXZc', 31, 1, '2016-07-01 08:44:45'),
(13, 'Dangers Stickres', '<p>sdfsadf</p>', 9, 'Chrysanthemum7.jpg', '<p>sdf</p>', 'dsf', 34, 1, '2016-07-01 09:36:21'),
(14, 'cdsd', '<p>sdasd</p>', 8, 'Chrysanthemum8.jpg', '<p>asdasd</p>', 'sadasd', 34, 1, '2016-07-05 15:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_price`
--

CREATE TABLE `product_price` (
  `id` int(10) NOT NULL,
  `variation_id` int(10) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_price`
--

INSERT INTO `product_price` (`id`, `variation_id`, `price`, `updated_date`) VALUES
(1, 4, '13.00', '2016-06-24 18:09:25'),
(2, 5, '14.00', '2016-06-27 08:13:28'),
(3, 7, '152.00', '2016-06-24 18:09:25'),
(4, 8, '12.00', '2016-06-24 18:03:33'),
(5, 9, '15.00', '2016-06-24 18:03:26'),
(6, 10, '14.00', '2016-06-24 18:03:33'),
(7, 11, '12.00', '2016-06-24 18:07:06'),
(8, 12, '12.00', '2016-06-24 18:28:09'),
(9, 13, '15.00', '2016-06-27 08:13:28'),
(10, 14, '12.00', '2016-06-27 12:20:59'),
(11, 15, '12.00', '2016-06-27 14:35:52'),
(12, 16, '12.00', '2016-06-27 14:52:34'),
(13, 17, '12.00', '2016-06-30 11:26:37'),
(14, 18, '13.00', '2016-06-27 14:52:57'),
(15, 19, '14.00', '2016-06-30 11:26:27'),
(16, 20, '12.00', '2016-06-30 11:26:20'),
(17, 21, '12.00', '2016-06-30 11:26:20'),
(18, 22, '12.00', '2016-06-27 14:53:43'),
(19, 23, '13.00', '2016-06-30 11:22:23'),
(20, 24, '14.00', '2016-06-30 11:22:23'),
(21, 25, '12.00', '2016-06-30 16:31:53'),
(22, 26, '13.00', '2016-06-30 16:31:54'),
(23, 27, '14.00', '2016-06-30 12:02:11'),
(24, 28, '12.00', '2016-06-30 16:32:22'),
(25, 29, '11.00', '2016-06-30 16:32:22'),
(26, 30, '11.00', '2016-07-01 08:44:45'),
(27, 31, '12.00', '2016-07-01 08:44:45'),
(28, 32, '12.00', '2016-07-01 09:36:21'),
(29, 33, '13.00', '2016-07-01 09:36:21'),
(30, 34, '12.00', '2016-07-05 15:22:44'),
(31, 35, '13.00', '2016-07-05 15:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

CREATE TABLE `product_variation` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `attr_val_id` int(10) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_variation`
--

INSERT INTO `product_variation` (`id`, `p_id`, `attr_val_id`, `updated_date`) VALUES
(1, 1, 9, '2016-06-24 17:02:49'),
(2, 1, 10, '2016-06-24 17:02:49'),
(4, 2, 9, '2016-06-24 17:10:53'),
(5, 2, 10, '2016-06-24 17:10:53'),
(7, 2, 11, '2016-06-24 18:01:47'),
(8, 3, 9, '2016-06-24 18:03:15'),
(9, 3, 11, '2016-06-24 18:03:26'),
(10, 3, 10, '2016-06-24 18:03:33'),
(11, 4, 9, '2016-06-24 18:07:06'),
(12, 5, 10, '2016-06-24 18:24:32'),
(13, 2, 15, '2016-06-27 08:13:28'),
(14, 4, 10, '2016-06-27 09:22:18'),
(15, 5, 15, '2016-06-27 14:35:45'),
(16, 6, 17, '2016-06-27 14:52:24'),
(17, 6, 18, '2016-06-27 14:52:24'),
(18, 7, 17, '2016-06-27 14:52:57'),
(19, 7, 18, '2016-06-27 14:52:57'),
(20, 8, 20, '2016-06-27 14:53:43'),
(21, 8, 21, '2016-06-27 14:53:43'),
(22, 8, 22, '2016-06-27 14:53:43'),
(23, 9, 18, '2016-06-28 14:18:36'),
(24, 9, 19, '2016-06-28 14:18:36'),
(25, 10, 18, '2016-06-30 12:02:11'),
(26, 10, 19, '2016-06-30 12:02:11'),
(28, 11, 18, '2016-06-30 16:11:03'),
(29, 11, 19, '2016-06-30 16:11:03'),
(30, 12, 18, '2016-07-01 08:44:37'),
(31, 12, 19, '2016-07-01 08:44:37'),
(32, 13, 25, '2016-07-01 09:35:55'),
(33, 13, 26, '2016-07-01 09:35:55'),
(34, 14, 26, '2016-07-05 15:21:54'),
(35, 14, 27, '2016-07-05 15:21:54');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `visible_to_all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `visible_to_all`, `is_display`) VALUES
(1, 'Test records', '1dummy.pdf', '2016-05-31', 29, 8, 1, 1),
(3, 'Test 2', 'dummyPDF.pdf', '2016-05-31', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `safety_forms`
--

CREATE TABLE `safety_forms` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `visible_to_all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `safety_forms`
--

INSERT INTO `safety_forms` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `visible_to_all`, `is_display`) VALUES
(1, 'Test forms1', '1dummy.pdf', '2016-05-31', 29, 8, 1, 1),
(3, 'Test forms2', 'dummy.pdf', '2016-05-31', 29, 8, 1, 1),
(4, 'Test forms3', 'dummyPDF.pdf', '2016-05-31', 29, 8, 1, 1),
(5, 'Testtets', 'BL_Store_List_2016.pdf', '2016-06-15', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `order_status` enum('COMPLETED','FAILED','PENDING') NOT NULL,
  `total_amount` double NOT NULL,
  `total_items` int(11) NOT NULL,
  `payment_type` varchar(45) NOT NULL,
  `shipping_address_id` int(10) NOT NULL,
  `billing_address_id` int(10) NOT NULL,
  `tax` double NOT NULL,
  `shipping` double NOT NULL,
  `paid_status` enum('Y','N') NOT NULL,
  `txn_id` text,
  `cc_last_digits` varchar(45) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id`, `customer_id`, `order_status`, `total_amount`, `total_items`, `payment_type`, `shipping_address_id`, `billing_address_id`, `tax`, `shipping`, `paid_status`, `txn_id`, `cc_last_digits`, `created_date`, `updated_date`) VALUES
(1, 72, 'PENDING', 13, 1, 'authorize', 2, 1, 0, 5, 'Y', NULL, NULL, '2016-07-08 13:59:01', '2016-07-08 11:59:01'),
(2, 72, 'PENDING', 13, 1, 'authorize', 2, 1, 0, 5, 'Y', NULL, NULL, '2016-07-08 13:59:04', '2016-07-08 11:59:04'),
(3, 72, 'PENDING', 13, 1, 'authorize', 2, 1, 0, 5, 'Y', NULL, NULL, '2016-07-08 13:59:21', '2016-07-08 11:59:21'),
(4, 72, 'COMPLETED', 13, 1, 'authorize', 2, 1, 0, 5, 'Y', '2261023350', 'XXXX1111', '2016-07-08 13:59:44', '2016-07-08 11:59:46'),
(5, 89, 'FAILED', 18, 1, 'authorize', 6, 5, 0, 5, 'N', NULL, NULL, '2016-07-11 09:49:51', '2016-07-11 07:49:54'),
(6, 114, 'PENDING', 18, 1, 'paypal', 8, 7, 0, 5, 'N', NULL, NULL, '2016-07-11 10:03:47', '2016-07-11 08:03:47'),
(7, 115, 'COMPLETED', 18, 1, 'authorize', 10, 9, 0, 5, 'Y', '2261111426', 'XXXX1111', '2016-07-11 10:11:08', '2016-07-11 08:11:11'),
(8, 116, 'COMPLETED', 44, 3, 'authorize', 12, 11, 0, 5, 'Y', '2261113833', 'XXXX1111', '2016-07-11 11:47:36', '2016-07-11 09:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_item`
--

CREATE TABLE `sales_order_item` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `attr_id` int(10) NOT NULL,
  `attr_val_id` int(10) NOT NULL,
  `item_status` enum('NEW','PENDING','ACCEPTED','SHIPPED','COMPLETE','REFUNDING','REFUNDED','AMAZON-SHIPPED','CANCELLED') NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` int(10) NOT NULL,
  `sales_order_id` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order_item`
--

INSERT INTO `sales_order_item` (`id`, `product_id`, `attr_id`, `attr_val_id`, `item_status`, `unit_price`, `quantity`, `sales_order_id`, `created_date`, `updated_date`) VALUES
(1, 13, 34, 26, 'ACCEPTED', 13, 1, 1, '2016-07-08 13:59:01', '2016-07-08 11:59:01'),
(2, 13, 34, 26, 'ACCEPTED', 13, 1, 2, '2016-07-08 13:59:04', '2016-07-08 11:59:04'),
(3, 13, 34, 26, 'ACCEPTED', 13, 1, 3, '2016-07-08 13:59:21', '2016-07-08 11:59:21'),
(4, 13, 34, 26, 'ACCEPTED', 13, 1, 4, '2016-07-08 13:59:44', '2016-07-08 11:59:44'),
(5, 13, 34, 26, 'ACCEPTED', 13, 1, 5, '2016-07-11 09:49:52', '2016-07-11 07:49:52'),
(6, 13, 34, 26, 'ACCEPTED', 13, 1, 6, '2016-07-11 10:03:47', '2016-07-11 08:03:47'),
(7, 13, 34, 26, 'ACCEPTED', 13, 1, 7, '2016-07-11 10:11:08', '2016-07-11 08:11:08'),
(8, 13, 34, 26, 'ACCEPTED', 13, 3, 8, '2016-07-11 11:47:36', '2016-07-11 09:47:36');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_cost`
--

CREATE TABLE `shipping_cost` (
  `id` int(10) NOT NULL,
  `shipping_amt` double NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_cost`
--

INSERT INTO `shipping_cost` (`id`, `shipping_amt`, `created_date`) VALUES
(1, 5, '2016-07-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sign_off`
--

CREATE TABLE `sign_off` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `lesson_id` int(5) NOT NULL,
  `employee_id` int(5) NOT NULL,
  `emp_id` varchar(100) NOT NULL,
  `client_id` int(5) NOT NULL,
  `sign` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sign_off`
--

INSERT INTO `sign_off` (`id`, `topic`, `lesson_id`, `employee_id`, `emp_id`, `client_id`, `sign`, `created_date`) VALUES
(9, '', 13, 151, 'EMP17', 29, 'sign151-13.png', '2016-06-04 04:17:53'),
(10, '', 13, 99, 'EMP15', 29, 'sign99-13.png', '2016-06-04 08:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `state_code` varchar(10) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_code`, `state_code`, `state_name`) VALUES
(1, 'US', 'AL', 'Alabama'),
(2, 'US', 'AK', 'Alaska'),
(3, 'US', 'AZ', 'Arizona'),
(4, 'US', 'AR', 'Arkansas'),
(5, 'US', 'CA', 'California'),
(6, 'US', 'CO', 'Colorado'),
(7, 'US', 'CT', 'Connecticut'),
(8, 'US', 'DE', 'Delaware'),
(9, 'US', 'FL', 'Florida'),
(10, 'US', 'GA', 'Georgia'),
(11, 'US', 'HI', 'Hawaii'),
(12, 'US', 'ID', 'Idaho'),
(13, 'US', 'IL', 'Illinois'),
(14, 'US', 'IN', 'Indiana'),
(15, 'US', 'IA', 'Iowa'),
(16, 'US', 'KS', 'Kansas'),
(17, 'US', 'KY', 'Kentucky'),
(18, 'US', 'LA', 'Louisiana'),
(19, 'US', 'ME', 'Maine'),
(20, 'US', 'MD', 'Maryland'),
(21, 'US', 'MA', 'Massachusetts'),
(22, 'US', 'MI', 'Michigan'),
(23, 'US', 'MN', 'Minnesota'),
(24, 'US', 'MS', 'Mississippi'),
(25, 'US', 'MO', 'Missouri'),
(26, 'US', 'MT', 'Montana'),
(27, 'US', 'NE', 'Nebraska'),
(28, 'US', 'NV', 'Nevada'),
(29, 'US', 'NH', 'New Hampshire'),
(30, 'US', 'NJ', 'New Jersey'),
(31, 'US', 'NM', 'New Mexico'),
(32, 'US', 'NY', 'New York'),
(33, 'US', 'NC', 'North Carolina'),
(34, 'US', 'ND', 'North Dakota'),
(35, 'US', 'OH', 'Ohio'),
(36, 'US', 'OK', 'Oklahoma'),
(37, 'US', 'OR', 'Oregon'),
(38, 'US', 'PA', 'Pennsylvania'),
(39, 'US', 'RI', 'Rhode Island'),
(40, 'US', 'SC', 'South Carolina'),
(41, 'US', 'SD', 'South Dakota'),
(42, 'US', 'TN', 'Tennessee'),
(43, 'US', 'TX', 'Texas'),
(44, 'US', 'UT', 'Utah'),
(45, 'US', 'VT', 'Vermont'),
(46, 'US', 'VA', 'Virginia'),
(47, 'US', 'WA', 'Washington'),
(48, 'US', 'WV', 'West Virginia'),
(49, 'US', 'WI', 'Wisconsin'),
(50, 'US', 'WY', 'Wyoming'),
(51, 'US', 'DC', 'District of Columbia'),
(52, 'CA', 'BC', 'British Columbia'),
(53, 'CA', 'NL', 'Newfoundland and Labrador'),
(54, 'CA', 'QC', 'Quebec'),
(55, 'CA', 'S ON', 'Southern Ontario'),
(56, 'CA', 'N ON', 'Northern Ontario'),
(57, 'CA', 'MB', 'Manitoba'),
(58, 'CA', 'SK', 'Saskatchewan'),
(59, 'CA', 'AB', 'Alberta'),
(60, 'CA', 'NB', 'New Brunswick'),
(61, 'CA', 'NT', 'Northwest Territories'),
(62, 'CA', 'NS', 'Nova Scotia'),
(63, 'CA', 'NU', 'Nunavut'),
(64, 'CA', 'PE', 'Prince Edward Island'),
(65, 'CA', 'YT', 'Yukon');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(10) NOT NULL,
  `tax_amt` double NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `tax_amt`, `created_date`) VALUES
(1, 0, '2016-07-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ori_password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `language` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1=admin,2=client,3=user',
  `phone` varchar(20) NOT NULL,
  `employee_limit` int(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `plan_type` int(11) NOT NULL,
  `created_id` varchar(5) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `ori_password`, `email`, `language`, `role`, `phone`, `employee_limit`, `is_active`, `plan_type`, `created_id`, `created_date`) VALUES
(8, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@gmail.com', '', 1, '9876543212', 0, 1, 0, '', '2015-03-13 09:03:07'),
(29, 'john', '3677b23baa08f74c28aba07f0cb6554e', 'client123', 'client1@gmail.com', '1,2', 2, '', 50, 1, 0, '8', '2016-05-31 07:07:23'),
(38, 'user1', '6ad14ba9986e3615423dfca256d04e3f', 'user123', 'user@gmail.com', '', 3, '', 0, 1, 0, '29', '2016-02-27 11:39:14'),
(70, 'Steve Crawley', '5064208011ada8bed4a0710ee6647425', '', 'stevec@eeap.net', '1', 2, '', 100, 1, 0, '8', '2016-06-13 14:05:29'),
(69, 'asdaas saran', '827ccb0eea8a706c4c34a16891f84e7b', '', 'asds@gmail.com', '', 3, '', 0, 1, 0, '29', '2016-04-18 11:51:31'),
(61, 'tester', '827ccb0eea8a706c4c34a16891f84e7b', '', 'asasds@gmail.com', '1', 2, '', 10, 1, 0, '8', '2016-04-21 11:29:47'),
(71, 'Michael', '88cf200e6d88efd88e2a779d6e34bfb2', '', 'Mc@eeap.net', '1', 2, '', 0, 1, 0, '8', '2016-06-13 14:44:32'),
(75, 'Punitha', '098f6bcd4621d373cade4e832627b4f6', '', 'punitha@izaaptech.in', '1', 2, '', 0, 1, 0, '8', '2016-06-30 07:04:37'),
(76, 'Punitha', '098f6bcd4621d373cade4e832627b4f6', '', 'punitha@izaaptech.in', '1', 2, '', 0, 1, 0, '8', '2016-06-30 07:15:54');

-- --------------------------------------------------------

--
-- Table structure for table `webinars`
--

CREATE TABLE `webinars` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `video_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `visible_to_all` int(2) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webinars`
--

INSERT INTO `webinars` (`id`, `title`, `link`, `video_file`, `created_date`, `created_user`, `updated_user`, `visible_to_all`, `is_active`) VALUES
(6, 'HAZCOM GHS', '<p>https://www.youtube.com/embed/G5wa94XiDGo</p>', '', '2016-02-23', 29, 8, 0, 1),
(7, 'Reporting Injuries to Cal OSHA', '<p>https://www.youtube.com/embed/xBhUD06o7DM</p>', '', '2016-05-30', 29, 8, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_pages`
--
ALTER TABLE `add_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_logs`
--
ALTER TABLE `api_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_attrname` (`attr_id`);

--
-- Indexes for table `cal_osha`
--
ALTER TABLE `cal_osha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `display_content`
--
ALTER TABLE `display_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection_reports`
--
ALTER TABLE `inspection_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lession`
--
ALTER TABLE `lession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lession_attachment`
--
ALTER TABLE `lession_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson_content`
--
ALTER TABLE `lesson_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_api_credentials`
--
ALTER TABLE `payment_api_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_recurring_profiles`
--
ALTER TABLE `payment_recurring_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_transaction_history`
--
ALTER TABLE `payment_transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posters`
--
ALTER TABLE `posters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posters_attachment`
--
ALTER TABLE `posters_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Category` (`cat`);

--
-- Indexes for table `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safety_forms`
--
ALTER TABLE `safety_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_cost`
--
ALTER TABLE `shipping_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sign_off`
--
ALTER TABLE `sign_off`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webinars`
--
ALTER TABLE `webinars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `add_pages`
--
ALTER TABLE `add_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `api_logs`
--
ALTER TABLE `api_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=879837;
--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `cal_osha`
--
ALTER TABLE `cal_osha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `display_content`
--
ALTER TABLE `display_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;
--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inspection_reports`
--
ALTER TABLE `inspection_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lession`
--
ALTER TABLE `lession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `lession_attachment`
--
ALTER TABLE `lession_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `lesson_content`
--
ALTER TABLE `lesson_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `limits`
--
ALTER TABLE `limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_api_credentials`
--
ALTER TABLE `payment_api_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_recurring_profiles`
--
ALTER TABLE `payment_recurring_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_transaction_history`
--
ALTER TABLE `payment_transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `posters`
--
ALTER TABLE `posters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `posters_attachment`
--
ALTER TABLE `posters_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `product_variation`
--
ALTER TABLE `product_variation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `safety_forms`
--
ALTER TABLE `safety_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipping_cost`
--
ALTER TABLE `shipping_cost`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sign_off`
--
ALTER TABLE `sign_off`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `webinars`
--
ALTER TABLE `webinars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD CONSTRAINT `fk_attrname` FOREIGN KEY (`attr_id`) REFERENCES `attribute` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_Category` FOREIGN KEY (`cat`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
