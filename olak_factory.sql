-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 11:02 PM
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
-- Database: `olak_factory`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_control`
--

CREATE TABLE `access_control` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `dashboard` varchar(50) NOT NULL,
  `users_mgt` varchar(50) NOT NULL,
  `product_mgt` varchar(191) NOT NULL,
  `sales_mgt` varchar(191) NOT NULL,
  `expenses_mgt` varchar(191) NOT NULL,
  `report_mgt` varchar(50) NOT NULL,
  `created_by` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_control`
--

INSERT INTO `access_control` (`id`, `user_id`, `dashboard`, `users_mgt`, `product_mgt`, `sales_mgt`, `expenses_mgt`, `report_mgt`, `created_by`, `created_at`, `deleted`) VALUES
(1, '2', '0', '1', '1', '1', '0', '0', '1', '2022-04-21 13:17:11', ''),
(2, '1', '1', '1', '1', '1', '1', '1', '1', '2022-04-21 13:58:19', '');

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
(1, 'Bukola Aribigbola', 'admin1@gmail.com', '+1 (501) 243-1641', '85f5aed8f1484aa634e875c943756de7.jpg', 'Blanditiis pariatur', '$2y$10$THE0NiMs6E3ae1X2mNuqF.MKWUDTE8xrWe3EBPzXms9/zh2JBg/cW', '0', '1', '1', '1', '', '2022-04-15 12:16:35', '2022-04-15 12:16:35', '1', ''),
(2, 'Carlos Decker', 'user@gmail.com', '+1 (832) 321-6998', '57e0a2ba95fc6a7a552f5eb01a2b6c3b.jpg', 'Natus temporibus nes', '$2y$10$UbcLVBq2PqfP2DU9AW4YeeHwD7wchvyThG0/ysRUbczAusDDab9B6', '0', '2', '1', '2', '', '2022-04-15 13:01:39', '2022-04-15 13:01:39', '1', '');

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
(1, '1', 'Usanda', 'Usanda, Ilorin, Kwara State', 'Ilorin', 'Kwara', '2019-01-01', '2022-05-10 02:42:43', ''),
(2, '1', 'Unity', 'Ilorin, Kwara State', 'Ilorin', 'Kwara', '2020-02-04', '2022-05-10 02:43:52', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Beige', '1', '2022-05-19 16:06:56', '2022-05-19 16:07:47', ''),
(2, 'Blue', '1', '2022-05-19 16:08:07', '2022-05-19 16:08:07', ''),
(3, 'Brown', '1', '2022-05-19 16:08:15', '2022-05-19 16:08:15', ''),
(4, 'Green', '1', '2022-05-19 16:08:22', '2022-05-19 16:08:22', ''),
(5, 'Dark red', '1', '2022-05-19 16:08:31', '2022-05-19 16:08:31', ''),
(6, 'Ivory', '1', '2022-05-19 16:09:21', '2022-05-19 16:09:21', ''),
(7, 'Silver', '1', '2022-05-19 16:09:28', '2022-05-19 16:09:28', ''),
(8, 'Black', '1', '2022-05-19 16:09:37', '2022-05-19 16:09:37', ''),
(9, 'Milk ivory', '1', '2022-05-19 16:09:58', '2022-05-19 16:09:58', '');

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
(1, '1', 'Liberty Gross', 'olak@gmail.com', '08012345678', 'Olak factory', 'Ilorin, Kwara State', '0212547892', 'faeb92e9b253b9c94ba6abc6ef37855d.png', '2022-05-10', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `gauges`
--

CREATE TABLE `gauges` (
  `id` int(11) NOT NULL,
  `value` varchar(191) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gauges`
--

INSERT INTO `gauges` (`id`, `value`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '0.1', '1', '2022-05-19 15:58:13', '2022-05-19 16:00:57', ''),
(2, '0.15', '1', '2022-05-19 16:01:04', '', ''),
(3, '0.2', '1', '2022-05-19 16:01:21', '', ''),
(4, '0.25', '1', '2022-05-19 16:01:28', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Flat embossed', '1', '2022-05-19 15:20:42', '2022-05-19 15:33:19', NULL),
(2, 'Flat plain', '1', '2022-05-19 15:36:24', '2022-05-19 15:36:24', ''),
(3, 'Deep gutter embossed', '1', '2022-05-19 15:36:42', '2022-05-19 15:36:42', ''),
(4, 'Accessory', '1', '2022-05-19 15:37:01', '2022-05-19 15:37:01', ''),
(5, 'Old type embossed', '1', '2022-05-19 15:37:19', '2022-05-19 15:37:19', ''),
(6, 'Deep Gutter plain', '1', '2022-05-19 19:43:35', '2022-05-19 19:43:35', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_phase_one`
--

CREATE TABLE `stock_phase_one` (
  `id` int(11) NOT NULL,
  `product_id` varchar(5) NOT NULL,
  `category_id` varchar(5) NOT NULL,
  `gauge_id` varchar(5) NOT NULL,
  `open_stock` varchar(50) NOT NULL,
  `production` varchar(50) NOT NULL,
  `return_inward` varchar(50) NOT NULL,
  `total_production` varchar(50) NOT NULL,
  `sales` varchar(50) NOT NULL,
  `imported` varchar(50) NOT NULL,
  `local` varchar(15) NOT NULL,
  `total_sales` varchar(50) NOT NULL,
  `closing_stock` varchar(50) NOT NULL,
  `company_id` varchar(15) NOT NULL,
  `branch_id` varchar(15) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_phase_one`
--

INSERT INTO `stock_phase_one` (`id`, `product_id`, `category_id`, `gauge_id`, `open_stock`, `production`, `return_inward`, `total_production`, `sales`, `imported`, `local`, `total_sales`, `closing_stock`, `company_id`, `branch_id`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '1', '1', '1', '92', '0', '0', '92', '0', '0', '0', '0', '92', '1', '1', '1', '2022-05-19', '', ''),
(2, '2', '1', '2', '73', '0', '0', '73', '0', '0', '0', '0', '73', '1', '1', '1', '2022-05-19', '', ''),
(3, '3', '1', '4', '97.3', '0', '0', '97.3', '0', '0', '18.9', '18.9', '78.4', '1', '1', '1', '2022-05-19', '', ''),
(4, '6', '1', '3', '14', '0', '0', '14', '0', '0', '0', '0', '14', '1', '1', '1', '2022-05-19', '', ''),
(5, '4', '1', '1', '2.9', '0', '0', '2.9', '0', '0', '0', '0', '2.9', '1', '1', '1', '2022-05-19', '', ''),
(6, '5', '1', '4', '3', '15.3', '0', '18.3', '0', '0', '15.3', '15.3', '3', '1', '1', '1', '2022-05-19', '', ''),
(7, '1', '2', '1', '92', '0', '0', '92', '0', '0', '0', '0', '92', '1', '1', '1', '2022-05-19', '', ''),
(8, '2', '2', '2', '73', '0', '0', '73', '0', '0', '0', '0', '73', '1', '1', '1', '2022-05-19', '', ''),
(9, '3', '2', '4', '97.3', '0', '0', '97.3', '0', '0', '18.9', '18.9', '78.4', '1', '1', '1', '2022-05-19', '', ''),
(10, '6', '2', '3', '14', '0', '0', '14', '0', '0', '0', '0', '14', '1', '1', '1', '2022-05-19', '', ''),
(11, '4', '2', '1', '2.9', '0', '0', '2.9', '0', '0', '0', '0', '2.9', '1', '1', '1', '2022-05-19', '', ''),
(12, '5', '2', '4', '3', '15.3', '0', '18.3', '0', '0', '15.3', '15.3', '3', '1', '1', '1', '2022-05-19', '', ''),
(13, '1', '3', '1', '92', '0', '0', '92', '0', '0', '0', '0', '92', '1', '1', '1', '2022-05-19', '', ''),
(14, '2', '3', '2', '73', '0', '0', '73', '0', '0', '0', '0', '73', '1', '1', '1', '2022-05-19', '', ''),
(15, '3', '3', '4', '97.3', '0', '0', '97.3', '0', '0', '18.9', '18.9', '78.4', '1', '1', '1', '2022-05-19', '', ''),
(16, '6', '3', '3', '14', '0', '0', '14', '0', '0', '0', '0', '14', '1', '1', '1', '2022-05-19', '', ''),
(17, '4', '3', '1', '2.9', '0', '0', '2.9', '0', '0', '0', '0', '2.9', '1', '1', '1', '2022-05-19', '', ''),
(18, '5', '3', '4', '3', '15.3', '0', '18.3', '0', '0', '15.3', '15.3', '3', '1', '1', '1', '2022-05-19', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock_phase_two`
--

CREATE TABLE `stock_phase_two` (
  `id` int(11) NOT NULL,
  `product_id` varchar(5) NOT NULL,
  `category_id` varchar(5) NOT NULL,
  `gauge_id` varchar(5) NOT NULL,
  `open_stock` varchar(50) NOT NULL,
  `production` varchar(50) NOT NULL,
  `transfer` varchar(50) NOT NULL,
  `total_production` varchar(50) NOT NULL,
  `sales` varchar(50) NOT NULL,
  `closing_stock` varchar(50) NOT NULL,
  `remarks` varchar(191) NOT NULL,
  `company_id` varchar(15) NOT NULL,
  `branch_id` varchar(15) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gauges`
--
ALTER TABLE `gauges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_phase_one`
--
ALTER TABLE `stock_phase_one`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_phase_two`
--
ALTER TABLE `stock_phase_two`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_control`
--
ALTER TABLE `access_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gauges`
--
ALTER TABLE `gauges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_phase_one`
--
ALTER TABLE `stock_phase_one`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stock_phase_two`
--
ALTER TABLE `stock_phase_two`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
