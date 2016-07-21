-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2016 at 05:02 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gotsafety_backup`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `client_username` varchar(55) NOT NULL,
  `client_password` varchar(55) NOT NULL,
  `company_name` longtext NOT NULL,
  `company_phone_no` varchar(55) NOT NULL,
  `company_address` longtext NOT NULL,
  `company_url` varchar(100) NOT NULL,
  `main_contact` varchar(55) NOT NULL,
  `main_contact_no` varchar(55) NOT NULL,
  `main_email_addr` varchar(55) NOT NULL,
  `main_contact_address` longtext NOT NULL,
  `no_of_employees` int(10) NOT NULL,
  `plan_type` int(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `language` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1=admin,2=client,3=user',
  `phone` varchar(20) NOT NULL,
  `employee_limit` int(10) NOT NULL,
  `profile_img` varchar(55) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_id` varchar(5) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `client_username`, `client_password`, `company_name`, `company_phone_no`, `company_address`, `company_url`, `main_contact`, `main_contact_no`, `main_email_addr`, `main_contact_address`, `no_of_employees`, `plan_type`, `email`, `language`, `role`, `phone`, `employee_limit`, `profile_img`, `is_active`, `created_id`, `created_date`) VALUES
(8, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', '', '', '', '', '', '', 0, 0, 'admin@gmail.com', '', 1, '9876543212', 0, '', 1, '', '2015-03-13 09:03:07'),
(29, 'john', '3677b23baa08f74c28aba07f0cb6554e', '', '', '', '', '', '', '', '', '', '', 0, 0, 'client1@gmail.com', '1,2', 2, '', 50, '', 1, '8', '2016-05-31 07:07:23'),
(38, 'user1', '6ad14ba9986e3615423dfca256d04e3f', '', '', '', '', '', '', '', '', '', '', 0, 0, 'user@gmail.com', '', 3, '', 0, '', 1, '29', '2016-02-27 11:39:14'),
(132, 'fsdf', '7d70663568cac5af684503681e3a4d41', '', '', '', '', '', '', '', '', '', '', 0, 0, 'dfsdf@gmail.com', '1', 2, 'dgfsdfgsdf', 0, '', 1, '8', '2016-07-14 04:24:44'),
(133, 'dfas', '5a5dc3936c05c32e61aa539e7ffb40c0', '', '', '', '', '', '', '', '', '', '', 0, 0, 'asdfasdf@gmaIL.com', '1', 2, 'dsfasd', 0, '', 1, '8', '2016-07-15 10:48:29'),
(134, 'gavaskar', 'e2db0456d1dd81019bc902acf1e712c1', '', '', '', '', '', '', '', '', '', '', 0, 0, 'gavaskar@gmail.com', '1', 2, '2132123212', 0, '', 1, '8', '2016-07-16 03:44:55'),
(135, 'zczs', '7072e1c8354087341a49c9b4edb4a72e', '', '', '', '', '', '', '', '', '', '', 0, 0, 'adsfdf@gmail.com', '1', 2, 'cxczxczxczxc', 0, '', 1, '8', '2016-07-18 10:32:07'),
(136, 'dfs11', '4dd93d36f4a8f8cb53a7aa11a1b78584', '', '', '', '', '', '', '', '', '', '', 0, 0, 'dfasd1@gmail.com', '1', 2, '1232123212', 0, '', 1, '8', '2016-07-19 11:48:14'),
(137, 'sdfasdf', '5e64fe04bfd8363b6c74ea86f5c867f1', '', '', '', '', '', '', '', '', '', '', 0, 0, 'fasdfadfs@gmail.com', '1', 2, '1232123212', 0, '', 1, '8', '2016-07-19 12:15:28'),
(138, 'sdasd', '6c0cbf5029aed0af395ac4b864c6b095', '', '', '', '', '', '', '', '', '', '', 0, 0, 'SADASD@GMAIL.COM', '1', 2, '1232123212', 0, '', 1, '8', '2016-07-19 16:13:21'),
(139, 'dfasd', '44aec5c90998c729635347147dce882e', '', '', '', '', '', '', '', '', '', '', 0, 0, 'asdfsadf@gmail.com', '1', 2, '3212321232', 0, '', 1, '8', '2016-07-19 17:46:11'),
(140, 'dsfdsaf', 'b8cb271ad3c79237254b6138ecce4c09', '', '', '', '', '', '', '', '', '', '', 0, 0, 'asdfasdfsdf@gmail.com', '1', 2, '1232123212', 0, '', 1, '8', '2016-07-19 17:55:22'),
(141, 'sadA', '14bc879e91722204a357587eede09330', '', '', '', '', '', '', '', '', '', '', 0, 0, 'ADASD@GMAIL.COM', '1', 2, '3212321232', 0, '', 1, '8', '2016-07-19 17:56:53'),
(142, 'DFSDF', '69d7b44b58da181da5790eb97729907f', '', '', '', '', '', '', '', '', '', '', 0, 0, 'SDFSDF@GMAIL.COM', '1', 2, '2343234334', 0, '', 1, '8', '2016-07-19 17:58:04'),
(143, 'DFASDF', '5b19019644b4958b8bb1536beffaaa4c', '', '', '', '', '', '', '', '', '', '', 0, 0, 'ASDFDSF@GMAIL.COM', '1', 2, '1232123212', 0, '', 1, '8', '2016-07-19 18:01:50'),
(144, 'gavaskar1', 'e2db0456d1dd81019bc902acf1e712c1', '', '', 'izaap1', '542123121', '<p>izaap technology, valasaravakkam, chennai-6000501</p>', 'www.izaap1.com', '54123212231', '12321232121', 'izaap1@gmail.com', '<p>Chennai1</p>', 121, 19, 'gavaskarizaap@gmail.com', '2', 2, '', 0, '', 1, '8', '2016-07-20 08:12:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Plantype` (`plan_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
