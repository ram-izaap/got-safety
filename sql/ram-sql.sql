-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2016 at 10:31 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

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
(1, 73, 'Plan - Silver', '50', '20002012477', 'Success', 'Authorize', '2016-06-27 09:38:04'),
(2, 72, 'Silver', '50', '2260773828', 'Success', 'Authorize', '2016-07-02 12:16:53');

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
(1, 'ramkumar.izaap@gmail.com', 'TEST', '88efW9BQ', '9w5ZX493x6Qu2cGu', '88efW9BQ', '9w5ZX493x6Qu2cGu', 'TEST', '2016-07-12 13:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `payment_recurring_profiles`
--

CREATE TABLE `payment_recurring_profiles` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `profile_id` varchar(255) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
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

INSERT INTO `payment_recurring_profiles` (`id`, `user_id`, `profile_id`, `plan_id`, `customer_id`, `profile_start_date`, `next_billing_date`, `subscription_id`, `trans_id`, `invoice_no`, `amount`, `profile_status`, `payment_status`, `pending_reason`, `last_payment_date`, `last_payment_amt`, `payment_method`) VALUES
(1, 76, 'I-J2R4BM3645LJ', 0, '', '2016-06-30 07:00:00', '2016-06-30 10:00:00', 0, 4, 0, 15, 'Active', 'Completed', 'None', '0000-00-00 00:00:00', 0, 'paypal'),
(2, 82, '1431743308', 19, '1468478641', '2016-07-14 00:00:00', '2016-08-15 00:00:00', 4147744, 0, 857943553, 123, 'Active', 'Completed', '', '2016-07-14 00:44:05', 123, 'Authorize');

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
  `trans_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `mode` varchar(25) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_transaction_history`
--

INSERT INTO `payment_transaction_history` (`id`, `user_id`, `profile_id`, `last_payment_date`, `last_payment_amt`, `trans_id`, `status`, `mode`, `created_date`) VALUES
(1, 82, 4147744, '2016-07-14 00:44:05', 123, '2261238329', 'Success', 'Authorize', '2016-07-14 07:06:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_api_credentials`
--
ALTER TABLE `payment_api_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment_api_credentials`
--
ALTER TABLE `payment_api_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_recurring_profiles`
--
ALTER TABLE `payment_recurring_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment_transaction_history`
--
ALTER TABLE `payment_transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
