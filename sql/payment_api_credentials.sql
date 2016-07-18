-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2016 at 03:30 PM
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
-- Table structure for table `payment_api_credentials`
--

CREATE TABLE `payment_api_credentials` (
  `id` int(11) NOT NULL,
  `api_username` varchar(255) NOT NULL,
  `api_password` varchar(255) NOT NULL,
  `api_signature` varchar(255) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `api_version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_api_credentials`
--

INSERT INTO `payment_api_credentials` (`id`, `api_username`, `api_password`, `api_signature`, `payment_mode`, `payment_method`, `api_version`) VALUES
(1, 'punithalakshmi1587-facilitator_api1@gmail.com', 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAO8HsMyMC7m-QbuLkiSoxlhnATDW', '1404819301', 'sandbox', 'paypal', 123),
(2, '88efW9BQ', '83QK5f5s87qPkQh9', '', 'TEST', 'authorize', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_api_credentials`
--
ALTER TABLE `payment_api_credentials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_api_credentials`
--
ALTER TABLE `payment_api_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
