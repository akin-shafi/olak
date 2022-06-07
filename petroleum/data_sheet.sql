-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 02:39 AM
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
(1, '1', '29100', '0', '29100', '2712', '447480', '26388', '', '447480', '', '1', '1', '3', '4', '2022-06-06', '2022-06-06 23:12:19', ''),
(2, '2', '22450', '0', '22450', '3789', '625220', '18661', '', '625185', '0', '1', '1', '3', '1', '2022-06-06', '2022-06-06 23:22:53', ''),
(3, '3', '30250', '0', '30250', '3435', '566775', '26815', '', '566775', '0', '1', '1', '3', '1', '2022-06-06', '2022-06-06 23:14:31', ''),
(4, '4', '18100', '0', '18100', '3408', '562320', '14692', '', '562320', '', '1', '1', '3', '4', '2022-06-06', '2022-06-06 23:15:16', ''),
(5, '5', '17150', '0', '17150', '6637', '1095105', '10513', '', '1095105', '', '1', '1', '3', '4', '2022-06-06', '2022-06-06 23:16:01', ''),
(6, '6', '7200', '0', '7200', '0', '0', '7200', '', '0', '', '1', '1', '3', '4', '2022-06-06', '2022-06-06 23:16:23', ''),
(7, '7', '6100', '0', '6100', '1221', '854700', '4879', '', '854700', '', '1', '1', '3', '4', '2022-06-06', '2022-06-06 23:17:20', ''),
(8, '8', '6250', '0', '6250', '336', '115920', '5914', '', '115920', '', '1', '1', '3', '4', '2022-06-06', '2022-06-06 23:18:27', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
