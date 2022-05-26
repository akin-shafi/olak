-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2022 at 08:16 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olak_procurement`
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
  `deleted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_control`
--

INSERT INTO `access_control` (`id`, `user_id`, `dashboard`, `users_mgt`, `product_mgt`, `sales_mgt`, `expenses_mgt`, `report_mgt`, `created_by`, `created_at`, `deleted`) VALUES
(1, '1', '1', '1', '1', '1', '1', '1', '', '2022-05-10 04:38:09', ''),
(2, '2', '0', '1', '1', '1', '0', '0', '', '2022-05-10 04:46:54', '1'),
(3, '3', '0', '0', '0', '1', '0', '0', '', '2022-05-10 04:47:06', '');

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
  `created_by` varchar(5) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `full_name`, `email`, `phone`, `profile_img`, `address`, `hashed_password`, `reset_password`, `admin_level`, `company_id`, `branch_id`, `status`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Adelabu Gbenga', 'admin1@gmail.com', '08012345678', '043b6061fabb63805ae369c4eef020c9.png', 'Blanditiis pariatur', '$2y$10$THE0NiMs6E3ae1X2mNuqF.MKWUDTE8xrWe3EBPzXms9/zh2JBg/cW', '0', '1', '1', '1', '', '1', '2022-04-15 12:16:35', '2022-04-15 12:16:35', ''),
(2, 'Yinka Olaoye', 'admin@gmail.com', '08012547895', 'fe52637f737f68a73498300e20319a6b.png', 'address', '$2y$10$647eqN4ojVveH2w42uPOvuwjQLPA8l8v/wOeebGjmGf5uJY9nyEua', '0', '2', '1', '2', '', '1', '2022-05-10 04:42:02', '2022-05-10 04:42:02', ''),
(3, 'Support Person', 'support@gmail.com', '07045878965', '40964b4875b5981e65caca8a35e2d476.png', 'Amet recusandae De', '$2y$10$wIZ.yQJ1GzEAi37XbFa4Z.kHVI0k5Vn/5hukQzvtceDrA1CLUGAvS', '0', '3', '1', '2', '', '1', '2022-05-10 04:43:35', '2022-05-10 04:43:35', '');

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
(1, '1', 'Aroma Toll Gate', 'Toll Gate Lagos Ibadan Express way ', 'Ibadan', 'Oyo', '2004-10-29', '2022-04-14 15:46:08', ''),
(2, '1', 'Aroma Iwo Road', 'Iwo Road Ibadan', 'Ibadan', 'Oyo', '2008-05-10', '2022-04-15 13:11:47', '');

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
(1, '1', 'Alhaji Ibrahim Olaiya', 'olak@gmail.com', '08012345678', 'Olak Integrated', 'Ilorin, Kwara State', 'abcd12345efgh', 'e8d36a0d813e7e1929f419fe561a3060.jpg', '2022-04-14', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `grand_total` varchar(191) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `company_id` varchar(50) DEFAULT NULL,
  `branch_id` varchar(50) DEFAULT NULL,
  `vendor_img` varchar(191) NOT NULL,
  `status` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `due_date` varchar(50) NOT NULL,
  `created_by` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `invoice_no`, `grand_total`, `full_name`, `company_id`, `branch_id`, `vendor_img`, `status`, `note`, `due_date`, `created_by`, `created_at`, `deleted`) VALUES
(1, 'PO-00158', '55750', 'Adelabu Gbenga', '1', '2', 'PO-00158.jpg', '2', 'Payment is due within 15 days of request.', '2022-05-11', '1', '2022-05-11 15:59:53', ''),
(2, 'PO-00188', '411500', 'Adelabu Gbenga', '1', '1', '', '1', 'Payment is due within 15 days of request.', '2022-05-11', '1', '2022-05-11 17:25:27', ''),
(3, 'PO-00110', '9000', 'Adelabu Gbenga', '1', '1', '', '1', 'Payment is due within 15 days of request.', '2022-05-11', '1', '2022-05-11 19:35:20', '');

-- --------------------------------------------------------

--
-- Table structure for table `request_details`
--

CREATE TABLE `request_details` (
  `id` int(11) NOT NULL,
  `request_id` varchar(50) NOT NULL,
  `item_name` varchar(191) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit_price` varchar(50) DEFAULT NULL,
  `amount` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_details`
--

INSERT INTO `request_details` (`id`, `request_id`, `item_name`, `quantity`, `unit_price`, `amount`, `created_at`, `deleted`) VALUES
(1, '1', 'Cruz Michael', '5', '3450', '17250', '2022-05-11 15:59:53', ''),
(2, '1', 'Cooper Acevedo', '2', '12500', '25000', '2022-05-11 15:59:53', ''),
(3, '1', 'Rhona Marshall', '3', '4500', '13500', '2022-05-11 15:59:53', ''),
(4, '2', 'Rice', '14', '25000', '350000', '2022-05-11 17:25:27', ''),
(5, '2', 'Sierra Mayer', '5', '12300', '61500', '2022-05-11 17:25:27', ''),
(6, '3', 'Rice', '3', '3000', '9000', '2022-05-11 19:35:20', '');

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
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_details`
--
ALTER TABLE `request_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_control`
--
ALTER TABLE `access_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_details`
--
ALTER TABLE `request_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
