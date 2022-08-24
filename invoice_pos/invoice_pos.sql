-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2022 at 12:26 AM
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
-- Database: `olak_invoice_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_control`
--

CREATE TABLE `access_control` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `dashboard` varchar(50) NOT NULL,
  `product_mgt` varchar(50) NOT NULL,
  `customer_mgt` varchar(50) NOT NULL,
  `wallet_mgt` varchar(50) NOT NULL,
  `stock_mgt` varchar(50) NOT NULL,
  `settings_mgt` varchar(50) NOT NULL,
  `sales_mgt` varchar(191) NOT NULL,
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
  `filtering` varchar(50) NOT NULL,
  `created_by` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_control`
--

INSERT INTO `access_control` (`id`, `user_id`, `dashboard`, `product_mgt`, `customer_mgt`, `wallet_mgt`, `stock_mgt`, `settings_mgt`, `sales_mgt`, `add_sales`, `edit_sales`, `manage_sales`, `expenses_mgt`, `add_exp`, `edit_exp`, `delete_exp`, `report_mgt`, `access_control`, `company_setup`, `user_mgt`, `filtering`, `created_by`, `created_at`, `deleted`) VALUES
(1, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2022-04-21 13:58:19', ''),
(2, '2', '1', '1', '1', '1', '1', '1', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1', '0', '1', '0', '1', '2022-06-07 09:32:06', ''),
(3, '10', '1', '0', '0', '0', '1', '1', '0', '0', '1', '0', '0', '0', '1', '0', '1', '0', '0', '1', '0', '2', '2022-07-16 19:25:58', ''),
(4, '11', '1', '0', '1', '1', '0', '1', '0', '0', '0', '0', '1', '0', '0', '1', '1', '1', '1', '0', '0', '2', '2022-07-16 19:31:51', ''),
(5, '8', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2', '2022-07-16 20:00:28', ''),
(6, '6', '1', '1', '0', '0', '1', '0', '1', '1', '1', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '2', '2022-07-16 20:01:53', '');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `admin_level` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_by` varchar(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `phone`, `hashed_password`, `admin_level`, `company_id`, `branch_id`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Administrator', 'Admin', 'admin@gmail.com', '09012345678', '$2y$10$FdT3KdNe6INlyzvZICTtq.IhZYYSntHnr3vwkxp9eNI0fMcpCzuRW', 1, 1, 1, '', '2020-02-20 00:40:47', '2020-02-20 00:40:47', '0'),
(2, 'Shafi', 'Akinropo', 'sakinropo@gmail.com', '08145360866', '$2y$10$Jbx33HPoAb31xeq.W0oTV.skGKqC/qeM0RhkmdtGeJJbw72GtAt8C', 2, 1, 2, '1', '2022-03-13 11:49:20', '2022-03-13 11:49:20', ''),
(3, 'Sales', 'Manager 1', 'sales@gmail.com', '0812345678', '$2y$10$qHVPQ5Rr6dKRylzgT13EBOTiOxd0ZskeeWzBBgrbMyn4BYfgyDesq', 3, 1, 1, '2', '2022-03-13 12:22:59', '2022-03-13 12:22:59', ''),
(4, 'Emmanuel', 'Bello', 'belloemma@gmail.com', '08066516520', '$2y$10$RACF5TDeP5hgb5Zci.nGE.6WGefEcv80YrkHJdaf3qGYIeSfFDaMG', 3, 1, 2, '1', '2022-03-15 18:49:03', '2022-03-15 18:49:03', ''),
(5, 'Ridwan', 'Kolapo', 'ridwandkolapo@gmail.com', '07018229830', '$2y$10$dYhupi5zkOc4OTybnsjZPuICpWeTL.3Z9dYVGl9sXTgn6PLOBlyWG', 3, 1, 1, '1', '2022-05-08 12:40:56', '2022-05-08 12:40:56', ''),
(6, 'Salawudeen', 'Sarafa', 'omotoyinbotemitope112@gmail.com', '', '$2y$10$K8BNHNYzgONhZfqjCw/9NO57VsDZg.3f05W4ZU74qxDjrrxaQE4iy', 4, 1, 2, '1', '2022-05-25 15:16:33', '2022-05-25 15:16:33', ''),
(7, 'Issa', 'Jimoh', 'issajimoh@gmail.com', '', '$2y$10$oHkLNAhgXY8fLzrpkVJl4OmN9OTASAtRGyGaOog1hHNFnoHZyO0y2', 3, 1, 2, '1', '2022-05-25 15:18:43', '2022-05-25 15:18:43', ''),
(8, 'Taofeeq', 'Ajetunmobi', 'ajetunmobitaophyq@gmail.com', '', '$2y$10$0t2/prDVoMLfBEaLqEdh0uRK8zeFHl.2/aOurAkxz4/tlVCc.AbFW', 4, 1, 2, '1', '2022-05-25 15:26:08', '2022-05-25 15:26:08', ''),
(9, 'Abdul', 'Oyebola', 'bolaabdul31@gmail.com', '', '$2y$10$/YSPGCpRS8K6jel.pzcspuR.bkGMBPXuzRqNId0OjB5fMLIhLPlk2', 3, 1, 2, '1', '2022-05-25 15:34:04', '2022-05-25 15:34:04', ''),
(10, 'Darrel', 'Harmon', 'dobeqysyg@mailinator.com', '09012345678', '$2y$10$PoA1cFfjrMkdpgJRqa9KOOrEDrr81ludwyAyGOQvOpq62VjLWbgVO', 5, 1, 2, '2', '2022-07-16 19:25:58', '2022-07-16 19:25:58', ''),
(11, 'Martha', 'Hays', 'fyfi@mailinator.com', '+1 (559) 345-15', '$2y$10$rJ/JLr2wjjS4e/GanTuISed3xXx7nSyCCPrXLUXeM8lVRohtx9ULO', 3, 1, 2, '2', '2022-07-16 19:31:51', '2022-07-16 19:31:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bank_name`, `account_number`, `company_id`, `branch_id`, `created_at`, `created_by`, `deleted`) VALUES
(1, 'Zenith Bank', '01127399', '1', '', '2022-03-14 16:03:02', '', ''),
(2, 'Wema Bank', '0937784687', '1', '', '2022-03-14 16:03:14', '', ''),
(3, 'Access Bank', '1893783976', '1', '', '2022-03-14 16:03:14', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `plate_no` varchar(20) NOT NULL,
  `date` date DEFAULT NULL,
  `details` varchar(255) NOT NULL,
  `service` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `established_in` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `company_id`, `branch_name`, `address`, `city`, `state`, `established_in`, `created_at`, `deleted`) VALUES
(1, '1', 'Roofing Outlet A Division', 'Address A Division ilorin', 'Ilorin', 'Kwara State', '2022-03-12', '2022-03-13 11:04:02', ''),
(2, '1', 'Olak Roofing Sales Outlet - Iwo Road', 'New Yidi Road ', 'Ilorin', 'Kwara', '2022-03-09', '2022-03-15 18:48:14', ''),
(3, '1', 'Usanda', 'Ilorin, Kwara State', 'Ilorin', 'Kwara', '2016-02-17', '2022-07-16 21:29:12', '');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `registration_no` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `logo`, `company_name`, `registration_no`, `created_at`, `deleted`) VALUES
(1, '', 'Olak Roofing', '001', '2022-03-13 07:48:05', ''),
(2, '', 'Roofing Shop 2', '002', '2022-03-13 07:54:06', '1'),
(3, '', 'Roofing Shop 3', '003', '2022-03-13 07:55:03', '1'),
(4, '', 'Roofing Shop 4', '004', '2022-03-13 08:22:30', '1');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` int(11) NOT NULL,
  `company_name` varchar(225) NOT NULL,
  `contact_person` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `country` varchar(225) NOT NULL,
  `city` varchar(225) NOT NULL,
  `state` varchar(225) NOT NULL,
  `zip_code` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone_no` varchar(225) NOT NULL,
  `mobile_no` varchar(225) NOT NULL,
  `web_address` varchar(225) NOT NULL,
  `app_address` varchar(225) NOT NULL,
  `social` varchar(225) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `acct_name` varchar(50) NOT NULL,
  `acct_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `company_name`, `contact_person`, `address`, `country`, `city`, `state`, `zip_code`, `email`, `phone_no`, `mobile_no`, `web_address`, `app_address`, `social`, `bank_name`, `acct_name`, `acct_no`) VALUES
(1, 'Olak Roofing Sales Outlet', 'Salami Kehinde', 'Opposite Tobityex, New Yidi Road, Ilorin West Kwara Nigeria', 'Nigeria', 'Ilorin', 'Kwara', '12345', 'olakintegrated@gmail.com', '+234-8071390061', '+234-8071390061', 'www.olakgroup.com.ng', 'www.integratedolak.com', '@autoCraft', 'first bank Nig Plc', 'AutoCraft', '0198762456');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_id`, `first_name`, `last_name`, `phone`, `address`, `email`, `company_id`, `branch_id`, `created_by`, `created_at`, `deleted`) VALUES
(1, 'C01220716', 'Tatyana', 'Humphrey', '+1 (539) 769-6998', 'Reiciendis minima ve', 'piwa@mailinator.com', '1', '1', 2, '2022-07-16 22:07:13', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `transid` varchar(50) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `quantity` varchar(100) CHARACTER SET utf8 NOT NULL,
  `unit_cost` varchar(100) CHARACTER SET utf8 NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `barcode_symbology` varchar(191) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `alert_quantity` varchar(50) NOT NULL,
  `product_tax` varchar(255) NOT NULL,
  `tax_method` varchar(255) NOT NULL,
  `cost` varchar(191) NOT NULL,
  `price` varchar(191) NOT NULL,
  `vat` varchar(50) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `update_at` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `exception` varchar(50) NOT NULL DEFAULT '0',
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `branch_id`, `ref_no`, `file`, `code`, `barcode_symbology`, `pname`, `type`, `category`, `quantity`, `alert_quantity`, `product_tax`, `tax_method`, `cost`, `price`, `vat`, `total_price`, `details`, `created_at`, `update_at`, `created_by`, `exception`, `deleted`) VALUES
(1, '1', '', 'image.jpg', '22200494', '3', 'Old Embossed Colored Olak 0.20', 'Product', '1', '12', '2', '7.5', '1', '', '43000', '3225', '43000', '', '', '2022-03-13 14:08:30', '', '1', ''),
(2, '2', '', 'image.jpg', '16060266', '3', 'Old Embossed Colored Olak 0.25', 'Product', '1', '0', '0', '7.5', '1', '', '53000', '225', '53000', '', '', '2022-03-15 07:39:46', '', '0', ''),
(3, '1', '', 'image.jpg', '16051742', '3', 'Old Embossed Colored Olak 0.20 special', 'Product', '1', '0', '0', '7.5', '1', '', '46500', '375', '46500', '', '', '2022-03-15 07:41:57', '', '0', ''),
(4, '2', '', 'image.jpg', '16032151', '3', 'Old Embossed Colored Olak 0.15', 'Product', '1', '0', '0', '7.5', '1', '', '40500', '150', '40500', '', '', '2022-03-15 07:54:59', '', '0', ''),
(5, '2', '', 'image.jpg', '16064714', '3', 'Old Embossed Olak White 0.15', 'Product', '1', '0', '0', '7.5', '1', '', '38000', '2850', '38000', '', '', '2022-03-15 08:34:22', '', '0', ''),
(6, '2', '', 'image.jpg', '15520681', '3', 'Hand Brand Imported', 'Product', '1', '0', '0', '7.5', '1', '', '25000', '11.25', '25000', '', '', '2022-03-15 08:54:34', '', '0', ''),
(7, '1', '', 'image.jpg', '16043795', '3', 'Color Imported', 'Product', '1', '0', '0', '7.5', '1', '', '27000', '0', '27000', '', '', '2022-05-25 16:05:01', '', '1', ''),
(8, '1', '', 'image.jpg', '16101484', '3', 'Colored Olak Plain 0.15', 'Product', '1', '0', '0', '7.5', '1', '', '40500', '0', '40500', '', '', '2022-05-25 16:11:25', '', '1', ''),
(9, '1', '', 'image.jpg', '16152076', '3', 'Colored Olak Plain 0.20', 'Product', '1', '0', '0', '7.5', '1', '', '43000', '0', '43000', '', '', '2022-05-25 16:15:58', '', '1', ''),
(10, '1', '', 'image.jpg', '16155928', '3', 'Colored Olak Plain 0.25', 'Product', '1', '0', '0', '7.5', '1', '', '53000', '3225', '53000', '', '', '2022-05-25 16:16:34', '', '1', ''),
(11, '1', '', 'image.jpg', '16163467', '3', 'Lento Colored Plain 0.15', 'Product', '1', '0', '0', '7.5', '1', '', '40500', '3975', '40500', '', '', '2022-05-25 16:18:41', '', '1', ''),
(12, '2', '', 'image.jpg', '16185114', '3', 'Lento Colored Plain 0.20', 'Product', '1', '0', '0', '7.5', '1', '', '43000', '0', '43000', '', '', '2022-05-25 16:19:09', '', '1', ''),
(13, '2', '', 'image.jpg', '16202453', '3', 'Deep Gutter Embossed Colored olak 0.20', 'Product', '1', '0', '0', '7.5', '1', '', '43000', '3225', '43000', '', '', '2022-05-25 16:19:41', '', '1', ''),
(14, '1', '', 'image.jpg', '16194597', '3', 'Deep Gutter Embossed Colored Olak 0.15', 'Product', '1', '0', '0', '7.5', '1', '', '40500', '0', '40500', '', '', '2022-05-25 16:21:28', '', '1', ''),
(15, '2', '', 'image.jpg', '16215145', '3', 'Flat Embossed Colored  Olak 0.20', 'Product', '1', '0', '0', '7.5', '1', '', '43000', '0', '43000', '', '', '2022-05-25 16:22:17', '', '1', ''),
(16, '2', '', 'image.jpg', '16222185', '3', 'Flat Embossed Colored  Olak 0.15', 'Product', '1', '0', '0', '7.5', '1', '', '40500', '0', '40500', '', '', '2022-05-25 16:22:36', '', '1', ''),
(17, '2', '', 'image.jpg', '16224664', '3', 'Flat Embossed Colored  Imported', 'Product', '1', '0', '0', '7.5', '1', '', '27000', '0', '27000', '', '', '2022-05-25 16:23:40', '', '1', ''),
(18, '2', '', 'image.jpg', '16234871', '3', 'Deep Gutter Embossed Silver Olak 0.15', 'Product', '1', '0', '0', '7.5', '1', '', '39000', '0', '39000', '', '', '2022-05-25 16:24:34', '', '1', ''),
(19, '1', '', 'image.jpg', '16244332', '3', 'Deep Gutter Embossed Silver 0.20', 'Product', '1', '0', '0', '7.5', '1', '', '40000', '0', '40000', '', '', '2022-05-25 16:25:10', '', '1', ''),
(20, '1', '', 'image.jpg', '16251451', '3', 'Nigerite Design 4/4', 'Product', '3', '0', '0', '7.5', '1', '', '3000', '0', '3000', '', '', '2022-05-25 16:25:59', '', '0', ''),
(21, '1', '', 'image.jpg', '16260292', '3', 'Nigerite Plain 4/4', 'Product', '1', '0', '0', '7.5', '1', '', '2900', '0', '2900', '', '', '2022-05-25 16:26:37', '', '1', ''),
(22, '1', '', 'image.jpg', '16264132', '3', 'Lite Span Roof', 'Product', '3', '0', '0', '7.5', '1', '', '2900', '0', '2900', '', '', '2022-05-25 16:27:49', '', '0', ''),
(23, '1', '', 'image.jpg', '16280187', '3', 'Imperial 4/4', 'Product', '1', '0', '0', '7.5', '1', '', '2200', '0', '2200', '', '', '2022-05-25 16:28:32', '', '1', ''),
(24, '1', '', 'image.jpg', '16283286', '3', 'Top Right Design 4/4', 'Product', '1', '0', '0', '7.5', '1', '', '3000', '165', '3000', '', '', '2022-05-25 16:28:59', '', '1', ''),
(25, '1', '', 'image.jpg', '16285912', '3', 'Top Right Plain 4/4', 'Product', '1', '0', '0', '7.5', '1', '', '2900', '225', '2900', '', '', '2022-05-25 16:29:20', '', '1', ''),
(26, '1', '', 'image.jpg', '16293430', '3', 'Top Right 2/2 Ceiling', 'Product', '1', '0', '0', '7.5', '1', '', '5000', '0', '5000', '', '', '2022-05-25 16:30:06', '', '1', ''),
(27, '2', '', 'image.jpg', '16300688', '3', 'Normal 2/2 Ceiling Pack', 'Product', '1', '0', '0', '7.5', '1', '', '3500', '375', '3500', '', '', '2022-05-25 16:31:21', '', '1', ''),
(28, '2', '', 'image.jpg', '16313131', '3', 'Tile rod  Design', 'Product', '1', '0', '0', '7.5', '1', '', '130', '0', '130', '', '', '2022-05-25 16:32:04', '', '1', ''),
(29, '2', '', 'image.jpg', '16322465', '3', 'Tile rod  Plain', 'Product', '1', '0', '0', '7.5', '1', '', '120', '0', '120', '', '', '2022-05-25 16:32:57', '', '1', ''),
(30, '2', '', 'image.jpg', '16331493', '3', 'Deep Gutter Embossed Olak 0.25', 'Product', '1', '0', '0', '7.5', '1', '', '53000', '0', '53000', '', '', '2022-05-25 16:33:58', '', '1', ''),
(31, '2', '', 'image.jpg', '16341222', '3', 'Roofing Nail Packet (2 and half)', 'Product', '4', '0', '0', '7.5', '1', '', '3500', '0', '3500', '', '', '2022-05-25 16:35:29', '', '0', ''),
(32, '2', '', 'image.jpg', '16354588', '3', 'Nails Size 5 (Bag) ', 'Product', '4', '0', '0', '7.5', '1', '', '15000', '0', '15000', '', '', '2022-05-25 16:37:09', '', '0', ''),
(33, '2', '', 'image.jpg', '16371956', '3', 'Nails Size 5 (Half) ', 'Product', '4', '0', '0', '7.5', '1', '', '7750', '0', '7750', '', '', '2022-05-25 16:37:37', '', '0', ''),
(34, '2', '', 'image.jpg', '16374229', '3', 'Nails Size 5 (Quarter) ', 'Product', '4', '0', '0', '7.5', '1', '', '3900', '0', '3900', '', '', '2022-05-25 16:38:24', '', '0', ''),
(35, '2', '', 'image.jpg', '16383439', '3', 'Nails Size 4 (Bag) ', 'Product', '4', '0', '0', '7.5', '1', '', '15500', '0', '15500', '', '', '2022-05-25 16:39:01', '', '0', ''),
(36, '2', '', 'image.jpg', '16391337', '3', 'Nails Size 4 (Half) ', 'Product', '4', '0', '0', '7.5', '1', '', '7750', '0', '7750', '', '', '2022-05-25 16:39:32', '', '0', ''),
(37, '2', '', 'image.jpg', '16393754', '3', 'Nails Size 4 (Quarter)', 'Product', '4', '0', '0', '7.5', '1', '', '3900', '0', '3900', '', '', '2022-05-25 16:40:22', '', '0', ''),
(38, '2', '', 'image.jpg', '16402248', '3', 'Nails Size 3 (Bag)', 'Product', '4', '0', '0', '7.5', '1', '', '15500', '292.5', '15500', '', '', '2022-05-25 16:41:06', '', '0', ''),
(39, '2', '', 'image.jpg', '16410930', '3', 'Nails Size 3 (Half) ', 'Product', '4', '0', '0', '7.5', '1', '', '7750', '0', '7750', '', '', '2022-05-25 16:41:38', '', '0', ''),
(40, '2', '', 'image.jpg', '16414198', '3', 'Nails Size 3 (Quarter)', 'Product', '4', '0', '0', '7.5', '1', '', '3900', '0', '3900', '', '', '2022-05-25 16:42:05', '', '0', ''),
(41, '2', '', 'image.jpg', '16421983', '3', 'Nails Size 2 and Half (Bag) ', 'Product', '4', '0', '0', '7.5', '1', '', '16000', '0', '16000', '', '', '2022-05-25 16:42:59', '', '0', ''),
(42, '2', '', 'image.jpg', '16430212', '3', 'Nails Size 2 and Half - (Half) ', 'Product', '4', '0', '0', '7.5', '1', '', '8000', '0', '8000', '', '', '2022-05-25 16:43:49', '', '0', ''),
(43, '2', '', 'image.jpg', '16443911', '3', 'Nails Size 2 and Half - (Quarter) ', 'Product', '4', '0', '0', '7.5', '1', '', '4000', '600', '4000', '', '', '2022-05-25 16:44:20', '', '0', ''),
(44, '2', '', 'image.jpg', '16444697', '3', 'Nails Size 2 (Bag) ', 'Product', '4', '0', '0', '7.5', '1', '', '16000', '0', '16000', '', '', '2022-05-25 16:45:18', '', '0', ''),
(45, '2', '', 'image.jpg', '16451931', '3', 'Nails Size 2 - (Half)', 'Product', '4', '0', '0', '7.5', '1', '', '8000', '1200', '8000', '', '', '2022-05-25 16:46:52', '', '0', ''),
(46, '2', '', 'image.jpg', '16465336', '3', 'Nails Size 2 - (Quarter)', 'Product', '4', '0', '0', '7.5', '1', '', '4000', '600', '4000', '', '', '2022-05-25 16:47:27', '', '0', ''),
(47, '2', '', 'image.jpg', '16472897', '3', 'Nail Inch and Half - (Bag)', 'Product', '4', '0', '0', '7.5', '1', '', '22000', '300', '22000', '', '', '2022-05-25 16:48:52', '', '0', ''),
(48, '2', '', 'image.jpg', '16485219', '3', 'Nail Inch and Half - (Half Bag)', 'Product', '4', '0', '0', '7.5', '1', '', '11000', '1650', '11000', '', '', '2022-05-25 16:49:17', '', '0', ''),
(49, '2', '', 'image.jpg', '16491762', '3', 'Nail Inch and Half - (Quarter)', 'Product', '4', '0', '0', '7.5', '1', '', '5500', '825', '5500', '', '', '2022-05-25 16:49:40', '', '0', ''),
(50, '2', '', 'image.jpg', '16494192', '3', 'Nail Inch and Half - (ibs)', 'Product', '4', '0', '0', '7.5', '1', '', '500', '412.5', '500', '', '', '2022-05-25 16:50:03', '', '0', ''),
(51, '1', '', 'image.jpg', '17063877', '3', '1 inch - (bag)', 'Product', '4', '0', '0', '7.5', '1', '', '22000', '0', '22000', '', '', '2022-05-25 17:08:57', '', '0', ''),
(52, '1', '', 'image.jpg', '22130739', '3', 'Knox Sanchez', 'Product', '3', '935', '20', '0', '1', '59', '126', '0', '126', 'Doloribus veritatis ', '', '', '2022-07-16 22:14:27', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(191) NOT NULL,
  `exception` int(11) NOT NULL DEFAULT 0,
  `deleted` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category`, `created_at`, `created_by`, `exception`, `deleted`) VALUES
(1, 'Roofing Sheets', '2022-03-13 12:52:28', '', 1, ''),
(2, 'Pipe', '2022-05-08 10:53:13', '', 0, '1'),
(3, 'Abestors', '2022-05-08 11:53:26', '', 0, ''),
(4, 'Nails', '2022-05-25 14:49:38', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `quantity`, `created_at`, `created_by`, `deleted`) VALUES
(1, '6', '2', '2022-05-15 02:37:44', '', ''),
(2, '7', '0', '2022-05-25 16:05:01', '', ''),
(3, '8', '0', '2022-05-25 16:11:25', '', ''),
(4, '9', '0', '2022-05-25 16:15:58', '', ''),
(5, '10', '0', '2022-05-25 16:16:34', '', ''),
(6, '11', '0', '2022-05-25 16:18:41', '', ''),
(7, '12', '0', '2022-05-25 16:19:09', '', ''),
(8, '13', '0', '2022-05-25 16:19:41', '', ''),
(9, '14', '0', '2022-05-25 16:21:28', '', ''),
(10, '15', '0', '2022-05-25 16:22:18', '', ''),
(11, '16', '0', '2022-05-25 16:22:36', '', ''),
(12, '17', '0', '2022-05-25 16:23:40', '', ''),
(13, '18', '0', '2022-05-25 16:24:34', '', ''),
(14, '19', '0', '2022-05-25 16:25:10', '', ''),
(15, '20', '0', '2022-05-25 16:25:59', '', ''),
(16, '21', '0', '2022-05-25 16:26:37', '', ''),
(17, '22', '0', '2022-05-25 16:27:49', '', ''),
(18, '23', '0', '2022-05-25 16:28:32', '', ''),
(19, '24', '0', '2022-05-25 16:28:59', '', ''),
(20, '25', '0', '2022-05-25 16:29:20', '', ''),
(21, '26', '0', '2022-05-25 16:30:06', '', ''),
(22, '27', '0', '2022-05-25 16:31:21', '', ''),
(23, '28', '0', '2022-05-25 16:32:04', '', ''),
(24, '29', '0', '2022-05-25 16:32:57', '', ''),
(25, '30', '0', '2022-05-25 16:33:58', '', ''),
(26, '31', '0', '2022-05-25 16:35:29', '', ''),
(27, '32', '0', '2022-05-25 16:37:09', '', ''),
(28, '33', '0', '2022-05-25 16:37:37', '', ''),
(29, '34', '0', '2022-05-25 16:38:24', '', ''),
(30, '35', '0', '2022-05-25 16:39:01', '', ''),
(31, '36', '0', '2022-05-25 16:39:32', '', ''),
(32, '37', '0', '2022-05-25 16:40:22', '', ''),
(33, '38', '0', '2022-05-25 16:41:06', '', ''),
(34, '39', '0', '2022-05-25 16:41:38', '', ''),
(35, '40', '0', '2022-05-25 16:42:05', '', ''),
(36, '41', '0', '2022-05-25 16:42:59', '', ''),
(37, '42', '0', '2022-05-25 16:43:49', '', ''),
(38, '43', '0', '2022-05-25 16:44:20', '', ''),
(39, '44', '0', '2022-05-25 16:45:18', '', ''),
(40, '45', '0', '2022-05-25 16:46:52', '', ''),
(41, '46', '0', '2022-05-25 16:47:27', '', ''),
(42, '47', '0', '2022-05-25 16:48:52', '', ''),
(43, '48', '0', '2022-05-25 16:49:17', '', ''),
(44, '49', '0', '2022-05-25 16:49:40', '', ''),
(45, '50', '0', '2022-05-25 16:50:03', '', ''),
(46, '51', '0', '2022-05-25 17:08:57', '', ''),
(47, '52', '935', '2022-07-16 22:14:27', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `plate_no` varchar(20) NOT NULL,
  `make` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  `year` varchar(4) NOT NULL,
  `last_service` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `balance` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `customer_id`, `balance`, `company_id`, `branch_id`, `updated_at`, `created_at`, `deleted`) VALUES
(1, 'C01220716', '1205000', '1', '1', '2022-07-16 22:54:13', '2022-07-16 22:54:13', '');

-- --------------------------------------------------------

--
-- Table structure for table `walletdetails`
--

CREATE TABLE `walletdetails` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `refrence_no` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `walletdetails`
--

INSERT INTO `walletdetails` (`id`, `customer_id`, `amount`, `refrence_no`, `description`, `created_by`, `bank_name`, `account_no`, `updated_at`, `created_at`, `deleted`) VALUES
(1, 'C02220315', '400000', '', 'food', '2', '3', '1893783976', '2022-03-20 05:48:33', '2022-03-20 05:48:33', ''),
(2, 'C01220313', '30000', 'REF4455677', 'Bag', '2', '3', '1893783976', '2022-03-20 05:50:23', '2022-03-20 05:50:23', ''),
(3, 'C04220320', '4000000', 'REF0947648996', 'Purchase of 200 Roofing Sheet', '1', '1', '01127399', '2022-03-20 13:41:44', '2022-03-20 13:41:44', ''),
(4, 'C05220508', '1000000', '11223344', 'From ridwan123', '1', '1', '01127399', '2022-05-08 13:05:01', '2022-05-08 13:05:01', ''),
(5, 'C06220525', '4000000', '89867589', '', '1', '3', '1893783976', '2022-05-25 17:15:05', '2022-05-25 17:15:05', ''),
(6, 'C01220716', '1205000', '123', 'Description', '2', '3', '1893783976', '2022-07-16 23:05:24', '2022-07-16 23:05:24', '');

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
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
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
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `walletdetails`
--
ALTER TABLE `walletdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_control`
--
ALTER TABLE `access_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `walletdetails`
--
ALTER TABLE `walletdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
