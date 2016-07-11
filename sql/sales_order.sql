-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2016 at 05:18 PM
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
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `order_status` enum('COMPLETED','FAILED','PENDING','PROCESSING','CANCELLED','REFUNDED') NOT NULL,
  `cart_total` double NOT NULL,
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

INSERT INTO `sales_order` (`id`, `customer_id`, `order_status`, `cart_total`, `total_amount`, `total_items`, `payment_type`, `shipping_address_id`, `billing_address_id`, `tax`, `shipping`, `paid_status`, `txn_id`, `cc_last_digits`, `created_date`, `updated_date`) VALUES
(1, 72, 'PENDING', 0, 13, 1, 'authorize', 2, 1, 0, 5, 'Y', NULL, NULL, '2016-07-08 13:59:01', '2016-07-08 11:59:01'),
(2, 72, 'PENDING', 0, 13, 1, 'authorize', 2, 1, 0, 5, 'Y', NULL, NULL, '2016-07-08 13:59:04', '2016-07-08 11:59:04'),
(3, 72, 'PENDING', 0, 13, 1, 'authorize', 2, 1, 0, 5, 'Y', NULL, NULL, '2016-07-08 13:59:21', '2016-07-08 11:59:21'),
(4, 72, 'COMPLETED', 0, 13, 1, 'authorize', 2, 1, 0, 5, 'Y', '2261023350', 'XXXX1111', '2016-07-08 13:59:44', '2016-07-08 11:59:46'),
(5, 89, 'FAILED', 0, 18, 1, 'authorize', 6, 5, 0, 5, 'N', NULL, NULL, '2016-07-11 09:49:51', '2016-07-11 07:49:54'),
(6, 114, 'PENDING', 0, 18, 1, 'paypal', 8, 7, 0, 5, 'N', NULL, NULL, '2016-07-11 10:03:47', '2016-07-11 08:03:47'),
(7, 115, 'COMPLETED', 0, 18, 1, 'authorize', 10, 9, 0, 5, 'Y', '2261111426', 'XXXX1111', '2016-07-11 10:11:08', '2016-07-11 08:11:11'),
(8, 116, 'COMPLETED', 0, 44, 3, 'authorize', 12, 11, 0, 5, 'Y', '2261113833', 'XXXX1111', '2016-07-11 11:47:36', '2016-07-11 09:47:38'),
(9, 117, 'COMPLETED', 13, 18, 1, 'authorize', 14, 13, 0, 5, 'Y', '2261120765', 'XXXX1111', '2016-07-11 15:47:09', '2016-07-11 13:47:11'),
(10, 117, 'COMPLETED', 13, 18, 1, 'authorize', 14, 13, 0, 5, 'Y', '2261120766', 'XXXX1111', '2016-07-11 15:47:18', '2016-07-11 13:47:19'),
(11, 117, 'FAILED', 13, 18, 1, 'authorize', 14, 13, 0, 5, 'N', NULL, NULL, '2016-07-11 15:48:29', '2016-07-11 13:48:31'),
(12, 116, 'COMPLETED', 26, 31, 2, 'authorize', 10, 11, 0, 5, 'Y', '2261120859', 'XXXX1111', '2016-07-11 15:50:20', '2016-07-11 13:50:21'),
(13, 116, 'COMPLETED', 26, 31, 2, 'authorize', 10, 11, 0, 5, 'Y', '2261120873', 'XXXX1111', '2016-07-11 15:50:36', '2016-07-11 13:50:38'),
(14, 116, 'COMPLETED', 26, 31, 2, 'authorize', 10, 11, 0, 5, 'Y', '2261120875', 'XXXX1111', '2016-07-11 15:50:40', '2016-07-11 13:50:42'),
(15, 116, 'PENDING', 26, 31, 2, 'paypal', 10, 11, 0, 5, 'N', NULL, NULL, '2016-07-11 16:07:21', '2016-07-11 14:07:21'),
(16, 116, 'PENDING', 13, 18, 1, 'paypal', 10, 11, 0, 5, 'N', NULL, NULL, '2016-07-11 16:27:34', '2016-07-11 14:27:34'),
(17, 116, 'PENDING', 13, 18, 1, 'paypal', 10, 11, 0, 5, 'N', NULL, NULL, '2016-07-11 16:30:19', '2016-07-11 14:30:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
