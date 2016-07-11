-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2016 at 02:13 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
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
-- Indexes for table `shipping_cost`
--
ALTER TABLE `shipping_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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
-- AUTO_INCREMENT for table `shipping_cost`
--
ALTER TABLE `shipping_cost`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
