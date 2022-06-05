-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2022 at 11:49 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olak_petroleum`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_sheet`
--

CREATE TABLE `data_sheet` (
  `id` int(11) NOT NULL,
  `product_id` varchar(5) NOT NULL,
  `open_stock` varchar(50) NOT NULL,
  `new_stock` varchar(50) NOT NULL,
  `total_stock` varchar(15) NOT NULL,
  `sales_in_ltr` varchar(191) NOT NULL,
  `total_sales` varchar(15) NOT NULL,
  `expected_stock` varchar(191) NOT NULL,
  `actual_stock` varchar(191) NOT NULL,
  `expected_sales` varchar(15) NOT NULL,
  `over_or_short` varchar(50) NOT NULL,
  `company_id` varchar(15) NOT NULL,
  `branch_id` varchar(15) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_sheet`
--

INSERT INTO `data_sheet` (`id`, `product_id`, `open_stock`, `new_stock`, `total_stock`, `sales_in_ltr`, `total_sales`, `expected_stock`, `actual_stock`, `expected_sales`, `over_or_short`, `company_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '1', '29100', '0', '29100', '2712', '447000', '26388', '26500', '447480', '112', '1', '1', '1', '1', '2022-06-01', '2022-06-04 08:42:09', ''),
(2, '1', '26500', '0', '26500', '1765', '291200', '24735', '24700', '291225', '-35', '1', '1', '3', '4', '2022-06-02', '2022-06-04 08:52:02', ''),
(3, '1', '24700', '0', '24700', '1033', '170500', '23667', '23600', '170445', '-67', '1', '1', '3', '4', '2022-06-03', '2022-06-04 09:07:00', ''),
(4, '1', '23600', '0', '23600', '1200', '198100', '22400', '', '198000', '', '1', '1', '3', '4', '2022-06-04', '2022-06-04 10:48:01', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_sheet`
--
ALTER TABLE `data_sheet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_sheet`
--
ALTER TABLE `data_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
