-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 05:32 PM
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
-- Database: `hoteliap_petroleum`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_control`
--

CREATE TABLE `access_control` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `dashboard` varchar(50) NOT NULL,
  `sales_mgt` varchar(191) NOT NULL,
  `add_dip` varchar(50) NOT NULL,
  `add_sales` varchar(50) NOT NULL,
  `edit_sales` varchar(50) NOT NULL,
  `manage_sales` varchar(50) NOT NULL,
  `expenses_mgt` varchar(191) NOT NULL,
  `add_exp` varchar(50) NOT NULL,
  `edit_exp` varchar(50) NOT NULL,
  `delete_exp` varchar(50) NOT NULL,
  `report_mgt` varchar(50) NOT NULL,
  `access_control` varchar(50) NOT NULL,
  `company_setup` varchar(50) NOT NULL,
  `user_mgt` varchar(50) NOT NULL,
  `product_mgt` varchar(191) NOT NULL,
  `filtering` varchar(50) NOT NULL,
  `created_by` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_control`
--

INSERT INTO `access_control` (`id`, `user_id`, `dashboard`, `sales_mgt`, `add_dip`, `add_sales`, `edit_sales`, `manage_sales`, `expenses_mgt`, `add_exp`, `edit_exp`, `delete_exp`, `report_mgt`, `access_control`, `company_setup`, `user_mgt`, `product_mgt`, `filtering`, `created_by`, `created_at`, `deleted`) VALUES
(1, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2022-04-21 13:58:19', ''),
(2, '2', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '1', '0', '2', '2022-05-30 03:01:22', ''),
(3, '3', '0', '1', '1', '0', '0', '1', '1', '0', '0', '0', '1', '0', '0', '0', '0', '0', '1', '2022-05-30 10:17:22', ''),
(4, '4', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '2022-05-30 10:19:22', ''),
(5, '5', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `full_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `profile_img` varchar(191) NOT NULL,
  `address` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `reset_password` varchar(2) NOT NULL DEFAULT '0',
  `admin_level` varchar(2) NOT NULL,
  `company_id` varchar(191) NOT NULL,
  `branch_id` varchar(191) NOT NULL,
  `status` varchar(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` varchar(5) DEFAULT NULL,
  `deleted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `full_name`, `email`, `phone`, `profile_img`, `address`, `hashed_password`, `reset_password`, `admin_level`, `company_id`, `branch_id`, `status`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(1, 'Super Admin', 'admin1@gmail.com', '08012345678', 'olak.png', 'Ilori, Kwara State', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '1', '1', '1', '1', '', '2022-05-30 01:06:43', '2022-05-30 01:06:43', '1', NULL),
(2, 'Compliance Personel', 'compliance@gmail.com', '08087654321', 'ee455f890b6c099e53081a4df0fc0913.jpg', 'A Division, Ilorin, Kwara State', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '5', '1', '1', '', '2022-05-30 03:01:22', '2022-05-30 03:01:22', '2', ''),
(3, 'Manager Management', 'manager@gmail.com', '09087654321', 'c511658b0f317a7e0de6969fe2c15ecc.jpg', '', '$2y$10$Da6l/ZfxEWrj7y/LeXouFO0foBsKdknQtSg6UzIZrHTTC8wYS5vu.', '0', '6', '1', '1', '', '2022-05-30 10:17:21', '2022-05-30 10:17:21', '1', ''),
(4, 'Supervisor Personel', 'supervisor@gmail.com', '08012345678', '9c38dedfe125b231f298f2b3790db383.jpg', '', '$2y$10$EgLt8zuWV1PnFqI1d8VdgOWVyHZK5SsbY7URpXmzFlnyH.zlAu4KG', '0', '7', '1', '1', '', '2022-05-30 10:19:22', '2022-05-30 10:19:22', '1', ''),
(5, 'Special User', 'special@gmail.com', '08098765432', 'b206dc6211241171382a785717c09d11.png', '', '$2y$10$J8lOL/FN0OkGAIjejMpMV.11tlMjLpCY/Rg1L21fiqXur8BUKCHK6', '0', '8', '1', '1', '', '2022-05-30 12:12:20', '2022-05-30 12:12:20', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `established_in` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `company_id`, `name`, `address`, `city`, `state`, `established_in`, `created_at`, `deleted`) VALUES
(1, '1', 'A Division', 'Ilorin, Kwara State', 'Ilorin', 'Kwara', '2020-04-01', '2022-05-30 00:51:55', ''),
(2, '1', 'Usanda', 'Usanda, Ilorin, Kwara', 'Ilorin', 'Kwara', '2020-01-01', '2022-05-30 00:53:09', '');

-- --------------------------------------------------------

--
-- Table structure for table `cash_flow`
--

CREATE TABLE `cash_flow` (
  `id` int(11) NOT NULL,
  `credit_sales` varchar(191) NOT NULL,
  `cash_sales` varchar(191) NOT NULL,
  `pos` varchar(191) NOT NULL,
  `transfer` varchar(255) NOT NULL,
  `cheque` varchar(50) NOT NULL,
  `credit_voucher` varchar(255) NOT NULL,
  `narration` text NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `created_by` varchar(5) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_flow`
--

INSERT INTO `cash_flow` (`id`, `credit_sales`, `cash_sales`, `pos`, `transfer`, `cheque`, `credit_voucher`, `narration`, `company_id`, `branch_id`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '35000', '60000', '25000', '40000', '25000', '', 'Thanks', '1', '1', '1', '2022-06-05', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `user_id` varchar(5) DEFAULT NULL,
  `full_name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `reg_no` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `user_id`, `full_name`, `email`, `phone`, `name`, `address`, `reg_no`, `logo`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '1', 'Super Admin', 'olak@integrated.com', '08012345678', 'Integrated Olak Group of Companies', 'Yidi road, Ilorin, Kwara State', '1000123', '4dc03fcc8632995896e7413eb4a67f5b.png', '2022-05-30', '0000-00-00', '');

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
(1, '1', '29100', '0', '29100', '2712', '447000', '26388', '26300', '447480', '-88', '1', '1', '3', '4', '2022-06-04', '2022-06-05 15:07:28', ''),
(2, '1', '26300', '9', '26309', '1200', '198000', '25109', '', '198000', '', '1', '1', '3', '4', '2022-06-05', '2022-06-05 15:20:10', ''),
(3, '2', '22450', '0', '22450', '1500', '247500', '20950', '', '247500', '', '1', '1', '3', '4', '2022-06-04', '2022-06-05 15:47:11', '');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `company_id` varchar(191) DEFAULT NULL,
  `branch_id` varchar(191) DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `quantity` varchar(191) NOT NULL,
  `amount` varchar(191) NOT NULL,
  `narration` varchar(255) NOT NULL,
  `created_by` varchar(191) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `company_id`, `branch_id`, `title`, `quantity`, `amount`, `narration`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '1', '1', '55LTR petrol', '55', '9075', 'Aroma Petrol ', '1', '2022-06-05', '2022-06-05 15:41:56', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `tank` varchar(5) NOT NULL,
  `rate` varchar(191) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `tank`, `rate`, `branch_id`, `created_at`, `deleted`) VALUES
(1, 'PMS', '1', '165', '1', '2022-05-30 04:13:36', ''),
(2, 'PMS', '2', '165', '1', '2022-05-30 04:14:04', ''),
(3, 'PMS', '3', '165', '1', '2022-05-30 04:14:19', ''),
(4, 'PMS', '4', '165', '1', '2022-05-30 04:14:34', ''),
(5, 'PMS', '5', '165', '1', '2022-05-30 04:14:46', ''),
(6, 'AGO', '6', '700', '1', '2022-05-30 04:15:05', ''),
(7, 'AGO', '7', '700', '1', '2022-05-30 04:15:18', ''),
(8, 'DPK', '8', '345', '1', '2022-05-30 04:15:31', '');

-- --------------------------------------------------------

--
-- Table structure for table `remittance`
--

CREATE TABLE `remittance` (
  `id` int(11) NOT NULL,
  `rate` varchar(191) NOT NULL,
  `quantity` varchar(191) NOT NULL,
  `amount` varchar(191) NOT NULL,
  `narration` varchar(255) NOT NULL,
  `created_by` varchar(5) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_control`
--
ALTER TABLE `access_control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash_flow`
--
ALTER TABLE `cash_flow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_sheet`
--
ALTER TABLE `data_sheet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remittance`
--
ALTER TABLE `remittance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_control`
--
ALTER TABLE `access_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cash_flow`
--
ALTER TABLE `cash_flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_sheet`
--
ALTER TABLE `data_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `remittance`
--
ALTER TABLE `remittance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
