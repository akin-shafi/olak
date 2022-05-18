-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2022 at 09:53 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olak_invoice_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `company_id` varchar(191) DEFAULT NULL,
  `branch_id` varchar(191) DEFAULT NULL,
  `invoiceNum` varchar(50) NOT NULL,
  `client_id` int(11) NOT NULL,
  `billingFormat` varchar(50) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `total_amount` varchar(50) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `grand_total` varchar(50) NOT NULL,
  `part_payment` varchar(50) NOT NULL,
  `balance` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` varchar(50) NOT NULL,
  `deleted` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `company_id`, `branch_id`, `invoiceNum`, `client_id`, `billingFormat`, `currency`, `start_date`, `due_date`, `total_amount`, `tax`, `grand_total`, `part_payment`, `balance`, `created_date`, `updated_date`, `deleted`) VALUES
(1, '1', '1', '100196', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '10450', '0', '10450', '10450', '', '2022-03-15 17:40:00', '', ''),
(2, '1', '1', '100123', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '6000', '0', '6000', '6000', '', '2022-03-15 17:45:47', '', ''),
(3, '1', '1', '100170', 1, 'Postpaid', 'NGN', '2022-03-15', '2022-03-15', '20000', '0', '20000', '20000', '', '2022-03-15 17:47:19', '', ''),
(4, '1', '1', '100153', 1, 'Prepaid', 'NGN', '2022-03-16', '2022-03-15', '450', '0', '450', '450', '', '2022-03-15 17:51:33', '', ''),
(5, '1', '1', '100125', 1, 'Prepaid', 'NGN', '2022-03-16', '2022-03-17', '20000', '0', '20000', '20000', '', '2022-03-15 17:52:20', '', ''),
(6, '1', '1', '100142', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '900', '0', '900', '900', '', '2022-03-15 17:53:55', '', ''),
(7, '1', '1', '100185', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '360000', '0', '360000', '360000', '', '2022-03-15 17:59:03', '', ''),
(8, '1', '1', '100195', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '450', '0', '450', '450', '', '2022-03-15 18:02:08', '', ''),
(9, '1', '1', '100137', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '15000', '0', '15000', '15000', '', '2022-03-15 18:21:22', '', ''),
(10, '1', '1', '100135', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '450', '0', '450', '450', '', '2022-03-15 18:25:55', '', ''),
(11, '1', '1', '100151', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:07', '', ''),
(12, '1', '1', '100135', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:12', '', ''),
(13, '1', '1', '100127', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:13', '', ''),
(14, '1', '1', '100186', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:13', '', ''),
(15, '1', '1', '100189', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '', '1050000', '1000000', '50000', '2022-03-20 13:49:14', '', ''),
(16, '1', '1', '100163', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:25', '', ''),
(17, '1', '1', '100197', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '450', '0', '450', '450', '', '2022-03-20 14:10:43', '', ''),
(18, '1', '2', '100110', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '8000', '', '8000', '8000', '0', '2022-03-20 14:11:35', '2022-04-09 17:17:02', ''),
(21, '1', '2', '100133', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '11600', '0', '11600', '11600', '0', '2022-04-08 12:54:16', '', ''),
(22, '1', '2', '100141', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '22800', '0', '22800', '22800', '0', '2022-04-08 12:54:17', '', ''),
(23, '1', '2', '100179', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '9800', '0', '9800', '9800', '0', '2022-04-08 12:54:18', '', ''),
(24, '1', '2', '100131', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '28000', '0', '28000', '28000', '0', '2022-04-08 12:54:18', '', ''),
(25, '1', '2', '100149', 3, 'Prepaid', 'NGN', '2022-04-11', '2022-04-13', '102250', '0', '104500', '100000', '2250', '2022-04-08 14:59:05', '', ''),
(26, '1', '2', '100159', 2, 'Prepaid', 'NGN', '2022-04-08', '2022-04-08', '12000', '', '12000', '12000', '0', '2022-04-08 15:09:49', '2022-04-09 19:23:03', '0'),
(33, '1', '1', '100162', 2, 'Prepaid', 'NGN', '2022-05-18', '2022-05-18', '10000', '0', '10000', '10000', '0', '2022-05-18 20:51:05', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
