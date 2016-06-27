-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2016 at 05:31 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

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
-- Table structure for table `authorize_subscription`
--

CREATE TABLE `authorize_subscription` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `subscription_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `startDate` date NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sub_status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorize_subscription`
--

INSERT INTO `authorize_subscription` (`id`, `userid`, `subscription_id`, `name`, `startDate`, `amount`, `invoice_no`, `description`, `sub_status`, `created_date`, `last_updated`) VALUES
(1, 73, '4069535', 'Plan - Silver', '2016-06-27', '50', '680676715', 'Plan - Silver', 0, '2016-06-27 09:38:04', '2016-06-27 09:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `authorize_subscription_transaction`
--

CREATE TABLE `authorize_subscription_transaction` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `sub_id` varchar(255) NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `invoice_no` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorize_subscription_transaction`
--

INSERT INTO `authorize_subscription_transaction` (`id`, `userid`, `sub_id`, `trans_id`, `invoice_no`, `status`, `amount`, `date`) VALUES
(1, 73, '4063411', '2260112197', 1235227280, 'settledSuccessfully', '50', '2016-06-22 09:08:43'),
(2, 73, '4063425', '2260112199', 244377485, 'settledSuccessfully', '50', '2016-06-22 09:08:43'),
(3, 73, '4063426', '2260112200', 1003587202, 'settledSuccessfully', '50', '2016-06-22 09:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `client_subscription`
--

CREATE TABLE `client_subscription` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `customerid` varchar(255) NOT NULL,
  `profileid` varchar(255) NOT NULL,
  `payment_pro_id` varchar(255) NOT NULL,
  `ship_pro_id` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date_inserted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `userid`, `description`, `amount`, `trans_id`, `status`, `payment_mode`, `date_inserted`) VALUES
(1, 73, 'Plan - Silver', '50', '20002012477', 'Success', 'Authorize', '2016-06-27 09:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `id` int(11) NOT NULL,
  `paypal_email` varchar(255) NOT NULL,
  `paypal_mode` varchar(255) NOT NULL,
  `auth_login_id` varchar(255) NOT NULL,
  `auth_trans_key` varchar(255) NOT NULL,
  `live_auth_login_id` varchar(255) NOT NULL,
  `live_auth_trans_key` varchar(255) NOT NULL,
  `auth_mode` varchar(255) NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`id`, `paypal_email`, `paypal_mode`, `auth_login_id`, `auth_trans_key`, `live_auth_login_id`, `live_auth_trans_key`, `auth_mode`, `date_updated`) VALUES
(1, 'ramkumar.izaap@gmail.com', 'TEST', '88efW9BQ', '5Ay46g8aTKz2Kz5F', '88efW9BQ', '5Ay46g8aTKz2Kz5F', 'TEST', '2016-06-27 09:17:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authorize_subscription`
--
ALTER TABLE `authorize_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authorize_subscription_transaction`
--
ALTER TABLE `authorize_subscription_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_subscription`
--
ALTER TABLE `client_subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authorize_subscription`
--
ALTER TABLE `authorize_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `authorize_subscription_transaction`
--
ALTER TABLE `authorize_subscription_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `client_subscription`
--
ALTER TABLE `client_subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
