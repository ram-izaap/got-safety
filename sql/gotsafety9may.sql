-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2016 at 08:43 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

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

CREATE TABLE IF NOT EXISTS `about_us` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
  `id` int(11) NOT NULL,
  `page_id` int(5) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `api_logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text NOT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `time` int(11) NOT NULL,
  `authorized` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=879837 DEFAULT CHARSET=utf8;

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
-- Table structure for table `cal_osha`
--

CREATE TABLE IF NOT EXISTS `cal_osha` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cal_osha`
--

INSERT INTO `cal_osha` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `all`, `is_display`) VALUES
(1, 'Test', 'dummyPDF.pdf', '2016-03-22', 29, 8, 1, 1),
(2, 'Asdsad', 'Spanish_Abuse_and_Domestic_Violence_Reporting.pdf', '2016-03-15', 29, 0, 0, 1),
(3, 'Call osha test', 'dummyPDF.pdf', '2016-03-22', 29, 8, 1, 1),
(4, 'Call osha test 1', 'dummy.pdf', '2016-03-22', 29, 8, 1, 1),
(5, 'Call osha test 3', 'dummy1.pdf', '2016-03-22', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `content`) VALUES
(1, '<p>1234 Street Dr.<br /> Vancouver, BC<br /> Canada<br /> V6G 1G9</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `display_content`
--

CREATE TABLE IF NOT EXISTS `display_content` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `display_content`
--

INSERT INTO `display_content` (`id`, `content`) VALUES
(1, '<p>Cal/OSHA requires regular inspections of the workplace to determine any unsafe conditions &amp; the action necessary to remedy such issues.</p>\r\n<p><strong>Per Cal/OSHA code &sect;1511. General Safety Precautions.</strong></p>\r\n<p>(a) No worker shall be required or knowingly permitted to work in an unsafe place, unless for the purpose of making it safe and then only after proper precautions have been taken to protect the employee while doing such work.</p>\r\n<p>(b) Prior to the presence of its employees, the employer shall make a thorough survey of the conditions of the site to determine, so far as practicable, the predictable hazards to employees and the kind and extent of safeguards necessary to prosecute the work in a safe manner.</p>'),
(2, '<p>In California every employer is required by law (Labor Code Section) to provide a safe and healthful workplace for his/her employees. Title 8 of the California Code of Regulations (CCR), requires every California employer to have an effective Injury and Illness Prevention Program in writing that must be in accord with T8 CCR Section 3203 of the General Industry Safety Orders. This documentation file contains written programs required by Cal/OSHA.</p>'),
(3, '<p>In the package, you&rsquo;ll find information that will help you complete Cal/OSHA&rsquo;s Log and Summary of Work-Related Injuries and Illnesses. You must post the previous year&rsquo;s Summary only &ndash; not the Log &ndash; by February 1st and keep posted until April 30th of this year. You must keep the Log and Summary for 5 years following the year to which they pertain.</p>'),
(4, '<p>Here you will find your Training Schedule and Records for this year. If there is no schedule below please fill out our <a href="#">Training Schedule Sheet</a> and send it into EEAP by Fax or email. If you would like us to keep your attendance sheet records you may send them into EEAP by Fax or Email. <a href="#">Attendance Sheet</a> records saved here are for backup purposes only. Employers are required to save the original at their location.</p>'),
(5, '<p>In order to fill-out the "Interactive" Forms, they must first be saved to your computer. Right click on link and click "save target as.." in Internet Explorer or "save link as.." in Firefox. Once you have saved the form, you may open it and fill it out.</p>\r\n<p><strong> Labor Law Poster Updates for Family and Medical Leave (CFRA) Effective July 1st 2015</strong></p>\r\n<p>*Required for Employers with 50 or more employees. Print, and place over the poster. It is designed to fit over the current Notice B using the trim marks as a guide*</p>'),
(6, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_name`, `employee_email`, `created_user`, `updated_user`, `created_date`, `updated_date`, `is_active`) VALUES
(4, 'Saran', 'saran@gmail.com', 29, 0, '2016-04-06 16:15:30', '2016-04-06 10:45:30', 1),
(5, 'Saran test1', 'sarantest@gmail.com', 29, 8, '2016-04-07 20:06:46', '2016-04-06 10:48:26', 1),
(6, 'Sdqed', 'qwewqew@gmail.com', 29, 8, '2016-04-07 20:06:25', '2016-04-06 10:52:33', 1),
(7, 'Test emp', 'testemp@gmail.com', 39, 0, '2016-04-07 19:55:47', '2016-04-07 14:25:47', 1),
(8, 'Dsadas', 'wewqe@gmail.com', 29, 8, '2016-04-15 19:47:02', '2016-04-07 14:46:25', 1),
(12, 'Dasd', 'saran2@gmail.com', 29, 0, '2016-04-07 20:52:05', '2016-04-07 15:22:05', 1),
(13, 'Ram', 'ram@gmail.com', 29, 0, '2016-04-16 12:44:14', '2016-04-16 07:14:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE IF NOT EXISTS `enquiry` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(150) NOT NULL,
  `best_time` varchar(100) NOT NULL,
  `number` varchar(50) NOT NULL,
  `suggestion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `inspection_reports` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspection_reports`
--

INSERT INTO `inspection_reports` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `all`, `is_display`) VALUES
(2, 'Asdsad', 'Spanish_Abuse_and_Domestic_Violence_Reporting.pdf', '2016-03-15', 29, 0, 0, 1),
(3, 'Test report', '1dummy.pdf', '2016-03-22', 29, 8, 1, 1),
(4, 'Test records2', 'dummy.pdf', '2016-03-22', 29, 8, 1, 1),
(5, 'Test records3', 'dummyPDF.pdf', '2016-03-22', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE IF NOT EXISTS `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `custom_key` tinyint(4) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `level`, `ignore_limits`, `custom_key`, `date_created`) VALUES
(43, 'test', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `lession` (
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lession`
--

INSERT INTO `lession` (`id`, `title`, `content`, `from`, `to_date`, `created_date`, `updated_date`, `created_user`, `updated_user`, `visible_to_all`, `is_active`) VALUES
(13, 'ATV Safety', '<h2 align="center">Page 1</h2>\r\n<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p><img src="/got_safety/assets/images/admin/uploads/page1_1.png" alt="" width="547" height="701" />&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp;&nbsp;&nbsp;</p>\r\n<h2 align="center">Page 2</h2>\r\n<p style="text-align: justify;"><strong>&nbsp;</strong></p>\r\n<p style="text-align: justify;"><strong><img src="/got_safety/assets/images/admin/uploads/page2_1.png" alt="" width="551" height="706" /></strong></p>', '2016-04-05', '2016-05-10', '2016-02-19 06:31:44', '2016-04-07 13:06:47', 29, 8, 0, 1),
(14, 'Abuse and Domestic Violence Reporting', '<h2 align="center">Page 1</h2>\r\n<p>&nbsp;<img src="/got_safety/assets/images/admin/uploads/page1.png" alt="" width="554" height="710" /></p>\r\n<h2 align="center">Page 2</h2>\r\n<p><img src="/got_safety/assets/images/admin/uploads/page2.png" alt="" width="551" height="706" /></p>\r\n<p>&nbsp;</p>', '2016-04-08', '2016-05-18', '2016-02-19 07:05:31', '2016-04-07 13:35:04', 29, 8, 1, 1),
(15, 'test', '<p>ascdasd</p>', '', '', '2016-02-27 12:50:12', '2016-02-27 18:20:12', 39, 0, 0, 1),
(16, 'test', '<p>asdas</p>', '', '', '2016-03-01 10:01:07', '2016-03-01 15:31:07', 42, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lession_attachment`
--

CREATE TABLE IF NOT EXISTS `lession_attachment` (
  `id` int(11) NOT NULL,
  `lession_id` int(5) NOT NULL,
  `language` varchar(255) NOT NULL,
  `type` int(5) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_name_quiz` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lession_attachment`
--

INSERT INTO `lession_attachment` (`id`, `lession_id`, `language`, `type`, `f_name`, `f_name_quiz`, `is_active`) VALUES
(14, 13, 'English', 1, 'English_ATV_Safety.pdf', 'English_ATV_Safety-Quiz.pdf', 1),
(15, 13, 'Spanish', 1, 'Spanish_ATV_Safety.pdf', 'Spanish_ATV_Safety-Quiz.pdf', 1),
(16, 14, 'English', 1, 'English_Abuse_and_Domestic_Violence_Reporting.pdf', 'English_Abuse_and_Domestic_Violence_Reporting-Quiz.pdf', 1),
(17, 14, 'Spanish', 1, 'Spanish_Abuse_and_Domestic_Violence_Reporting.pdf', 'Spanish_Abuse_and_Domestic_Violence_Reporting-Quiz.pdf', 1),
(18, 13, 'Dutch', 1, 'dummyPDF.pdf', 'dummy.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lesson_content`
--

CREATE TABLE IF NOT EXISTS `lesson_content` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson_content`
--

INSERT INTO `lesson_content` (`id`, `content`) VALUES
(1, '<p>The California Code states that &ldquo;regular&rdquo; training must take place, i.e., monthly for businesses such as yours. A business whose employees are primarily out in the field, such as construction co., must provide training every 10 working days.</p>\r\n<p>If you hire a new employee, they must be trained in safety practices prior to working. These requirements are valid for every employee. Also, the documentation of same is important - make sure the attendance sheets are signed and kept.</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `limits`
--

CREATE TABLE IF NOT EXISTS `limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `all`, `is_display`) VALUES
(3, 'Test 2', 'dummyPDF1.pdf', '2016-03-22', 29, 8, 1, 1),
(4, 'Test 3', 'dummy2.pdf', '2016-03-22', 29, 8, 1, 1),
(5, 'Test 4', '1dummy.pdf', '2016-03-22', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dynamic_fields` text NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `pages` (
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
-- Table structure for table `posters`
--

CREATE TABLE IF NOT EXISTS `posters` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `all` int(2) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posters`
--

INSERT INTO `posters` (`id`, `title`, `content`, `created_date`, `updated_date`, `created_user`, `updated_user`, `all`, `is_active`) VALUES
(13, 'ATV Safety poster', '<h2 align="center">Page 1</h2>\r\n<p style="text-align: justify;"><img src="/got_safety/assets/images/admin/uploads/page1_2.png" alt="" width="523" height="670" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p>&nbsp;</p>', '2016-02-19 06:31:44', '2016-03-22 16:42:16', 29, 8, 1, 1),
(14, 'Abuse and Domestic Violence Reporting-Posters1', '<h2 align="center">Page 1</h2>\r\n<p><img src="/got_safety/assets/images/admin/uploads/page2_2.png" alt="" width="541" height="693" /></p>', '2016-02-19 07:05:31', '2016-03-22 16:41:34', 29, 8, 1, 1),
(15, 'test', '<p>ascdasd</p>', '2016-02-27 12:50:12', '2016-02-27 18:20:12', 39, 0, 0, 1),
(16, 'test', '<p>asdas</p>', '2016-03-01 10:01:07', '2016-03-01 15:31:07', 42, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posters_attachment`
--

CREATE TABLE IF NOT EXISTS `posters_attachment` (
  `id` int(11) NOT NULL,
  `poster_id` int(5) NOT NULL,
  `language` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `f_name_quiz` varchar(255) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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
-- Table structure for table `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `all`, `is_display`) VALUES
(1, 'Test records', '1dummy.pdf', '2016-03-22', 29, 8, 1, 1),
(3, 'Test 2', 'dummyPDF.pdf', '2016-03-22', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `safety_forms`
--

CREATE TABLE IF NOT EXISTS `safety_forms` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `all` int(2) NOT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `safety_forms`
--

INSERT INTO `safety_forms` (`id`, `title`, `pdf_file`, `created_date`, `created_user`, `updated_user`, `all`, `is_display`) VALUES
(1, 'Test forms1', '1dummy.pdf', '2016-03-22', 29, 8, 1, 1),
(3, 'Test forms2', 'dummy.pdf', '2016-03-22', 29, 8, 1, 1),
(4, 'Test forms3', 'dummyPDF.pdf', '2016-03-22', 29, 8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sign_off`
--

CREATE TABLE IF NOT EXISTS `sign_off` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `employee_id` int(5) NOT NULL,
  `client_id` int(5) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sign_off`
--

INSERT INTO `sign_off` (`id`, `topic`, `lesson_id`, `employee_id`, `client_id`, `created_date`) VALUES
(1, 'Abuse and Domestic Violence Reporting ', 0, 4, 29, '2016-04-05 16:15:30'),
(2, 'ATV Safety ', 0, 5, 39, '2016-04-06 17:15:30'),
(3, 'ATV Safety ', 0, 4, 29, '2016-04-16 18:47:17'),
(4, '300logs', 0, 4, 29, '2016-04-18 12:40:41'),
(5, '300logs', 0, 4, 38, '2016-04-18 12:41:08'),
(6, '300logs', 0, 4, 29, '2016-04-18 12:42:26'),
(7, 'test records', 0, 4, 29, '2016-04-18 12:46:29'),
(8, 'ATV safety', 0, 4, 29, '2016-04-18 12:47:20'),
(9, 'ATV Safety', 0, 4, 29, '2016-04-18 12:47:52'),
(10, 'ATV safezdfzfty', 0, 4, 29, '2016-04-18 13:00:28'),
(11, '300logs', 0, 4, 29, '2016-04-18 13:17:22'),
(12, '300logs', 0, 4, 29, '2016-05-02 13:14:31'),
(13, '300logs', 0, 4, 29, '2016-05-03 07:39:22'),
(14, '300logsrrtw', 0, 4, 29, '2016-05-03 07:39:30'),
(15, '300logs', 0, 4, 29, '2016-05-03 08:19:02'),
(16, 'title', 0, 6, 29, '2016-05-03 10:14:55'),
(17, 'title', 0, 4, 29, '2016-05-03 10:16:54'),
(18, 'title', 0, 5, 29, '2016-05-03 10:27:38'),
(19, 'title', 0, 5, 29, '2016-05-03 10:30:58'),
(20, 'title', 0, 5, 29, '2016-05-03 10:32:08'),
(21, 'title', 0, 6, 29, '2016-05-03 10:34:35'),
(22, 'title', 0, 6, 29, '2016-05-03 10:39:59'),
(23, 'title', 0, 12, 29, '2016-05-03 11:11:42'),
(24, 'title', 0, 5, 29, '2016-05-03 11:23:53'),
(25, 'title', 0, 5, 29, '2016-05-03 11:28:29'),
(26, 'title', 0, 8, 29, '2016-05-03 11:32:21'),
(27, 'title', 0, 8, 29, '2016-05-03 11:38:07'),
(28, 'title', 0, 8, 29, '2016-05-03 11:38:48'),
(29, 'title', 0, 5, 29, '2016-05-04 07:10:40'),
(30, 'title', 0, 6, 29, '2016-05-04 07:14:53'),
(31, 'title', 0, 4, 29, '2016-05-04 07:15:09'),
(32, 'title', 0, 5, 29, '2016-05-04 08:29:00'),
(33, 'title', 0, 4, 29, '2016-05-06 07:19:47'),
(34, 'title', 0, 8, 29, '2016-05-06 11:29:00'),
(35, 'title', 0, 6, 29, '2016-05-06 11:30:17'),
(36, 'title', 0, 6, 29, '2016-05-06 14:21:00'),
(37, 'ATV Safety', 0, 8, 29, '2016-05-07 07:22:37'),
(38, 'ATV Safety', 0, 8, 29, '2016-05-07 07:23:48'),
(39, 'Abuse and Domestic Violence Reporting', 0, 6, 29, '2016-05-07 07:24:39'),
(40, '', 13, 8, 0, '2016-05-09 08:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
  `created_id` varchar(5) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `ori_password`, `email`, `language`, `role`, `phone`, `employee_limit`, `is_active`, `created_id`, `created_date`) VALUES
(8, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@gmail.com', '', 1, '9876543212', 0, 1, '', '2015-03-13 09:03:07'),
(29, 'client', '3677b23baa08f74c28aba07f0cb6554e', 'client123', 'client1@gmail.com', '1,2', 2, '', 50, 1, '8', '2016-04-07 15:24:42'),
(38, 'user1', '6ad14ba9986e3615423dfca256d04e3f', 'user123', 'user@gmail.com', '', 3, '', 0, 1, '29', '2016-02-27 11:39:14'),
(39, 'client2', '3677b23baa08f74c28aba07f0cb6554e', 'client123', 'client2@gmail.com', '1,3', 2, '', 0, 1, '8', '2016-04-07 13:55:18'),
(40, 'user2', '6ad14ba9986e3615423dfca256d04e3f', 'user123', 'user2@gmail.com', '', 3, '', 0, 1, '39', '2016-02-24 12:50:02'),
(62, 'jack', '827ccb0eea8a706c4c34a16891f84e7b', '', 'aasds@gmail.com', '1', 2, '', 20, 1, '8', '2016-04-16 05:39:42'),
(60, 'gift', '827ccb0eea8a706c4c34a16891f84e7b', '', 'saran@gmail.com', '1', 2, '', 0, 1, '8', '2016-04-12 12:00:32'),
(61, 'tester', '827ccb0eea8a706c4c34a16891f84e7b', '', 'asasds@gmail.com', '1', 2, '', 0, 1, '8', '2016-04-15 14:16:50'),
(68, 'dum_in', '2208639860dda3f5c6bf627bbe3657c7', '', 'saran@gmail.com', '1', 2, '', 110, 1, '8', '2016-04-18 09:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `webinars`
--

CREATE TABLE IF NOT EXISTS `webinars` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `video_file` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `created_user` int(5) NOT NULL,
  `updated_user` int(5) NOT NULL,
  `all` int(2) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webinars`
--

INSERT INTO `webinars` (`id`, `title`, `link`, `video_file`, `created_date`, `created_user`, `updated_user`, `all`, `is_active`) VALUES
(6, 'HAZCOM GHS', '<p>https://www.youtube.com/embed/G5wa94XiDGo</p>', '', '2016-02-23', 29, 8, 0, 1),
(7, 'Reporting Injuries to Cal OSHA', '<p>https://www.youtube.com/embed/xBhUD06o7DM</p>', '', '2016-02-27', 29, 8, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
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
-- Indexes for table `cal_osha`
--
ALTER TABLE `cal_osha`
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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sign_off`
--
ALTER TABLE `sign_off`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `add_pages`
--
ALTER TABLE `add_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `api_logs`
--
ALTER TABLE `api_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=879837;
--
-- AUTO_INCREMENT for table `cal_osha`
--
ALTER TABLE `cal_osha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `display_content`
--
ALTER TABLE `display_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inspection_reports`
--
ALTER TABLE `inspection_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lession`
--
ALTER TABLE `lession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `lession_attachment`
--
ALTER TABLE `lession_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `lesson_content`
--
ALTER TABLE `lesson_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `limits`
--
ALTER TABLE `limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posters`
--
ALTER TABLE `posters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `posters_attachment`
--
ALTER TABLE `posters_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `safety_forms`
--
ALTER TABLE `safety_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sign_off`
--
ALTER TABLE `sign_off`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `webinars`
--
ALTER TABLE `webinars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
