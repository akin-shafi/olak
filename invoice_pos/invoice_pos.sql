-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2022 at 10:53 PM
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
-- Database: `invoice_pos`
--

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
(1, 'Administrator', 'Admin', 'admin@gmail.com', '09012345678', '$2y$10$FdT3KdNe6INlyzvZICTtq.IhZYYSntHnr3vwkxp9eNI0fMcpCzuRW', 1, 0, 0, '', '2020-02-20 00:40:47', '2020-02-20 00:40:47', '0'),
(2, 'Shafi', 'Akinropo', 'Sakinropo@gmail.com', '08145360866', '$2y$10$Jbx33HPoAb31xeq.W0oTV.skGKqC/qeM0RhkmdtGeJJbw72GtAt8C', 2, 1, 1, '1', '2022-03-13 11:49:20', '2022-03-13 11:49:20', ''),
(3, 'Sales', 'Manager 1', 'sales@gmail.com', '0812345678', '$2y$10$qHVPQ5Rr6dKRylzgT13EBOTiOxd0ZskeeWzBBgrbMyn4BYfgyDesq', 3, 1, 1, '2', '2022-03-13 12:22:59', '2022-03-13 12:22:59', ''),
(4, 'Emmanuel', 'Bello', 'belloemma@gmail.com', '08066516520', '$2y$10$RACF5TDeP5hgb5Zci.nGE.6WGefEcv80YrkHJdaf3qGYIeSfFDaMG', 3, 1, 2, '1', '2022-03-15 18:49:03', '2022-03-15 18:49:03', '');

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

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`id`, `invoiceNum`, `client_id`, `billingFormat`, `currency`, `start_date`, `due_date`, `total_amount`, `tax`, `grand_total`, `part_payment`, `balance`, `created_date`, `updated_date`, `deleted`) VALUES
(1, '100196', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '10450', '0', '10450', '10450', '', '2022-03-15 17:40:00', '', ''),
(2, '100123', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '6000', '0', '6000', '6000', '', '2022-03-15 17:45:47', '', ''),
(3, '100170', 1, 'Postpaid', 'NGN', '2022-03-15', '2022-03-15', '20000', '0', '20000', '20000', '', '2022-03-15 17:47:19', '', ''),
(4, '100153', 1, 'Prepaid', 'NGN', '2022-03-16', '2022-03-15', '450', '0', '450', '450', '', '2022-03-15 17:51:33', '', ''),
(5, '100125', 1, 'Prepaid', 'NGN', '2022-03-16', '2022-03-17', '20000', '0', '20000', '20000', '', '2022-03-15 17:52:20', '', ''),
(6, '100142', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '900', '0', '900', '900', '', '2022-03-15 17:53:55', '', ''),
(7, '100185', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '360000', '0', '360000', '360000', '', '2022-03-15 17:59:03', '', ''),
(8, '100195', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '450', '0', '450', '450', '', '2022-03-15 18:02:08', '', ''),
(9, '100137', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '15000', '0', '15000', '15000', '', '2022-03-15 18:21:22', '', ''),
(10, '100135', 1, 'Prepaid', 'NGN', '2022-03-15', '2022-03-15', '450', '0', '450', '450', '', '2022-03-15 18:25:55', '', ''),
(11, '100151', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:07', '', ''),
(12, '100135', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:12', '', ''),
(13, '100127', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:13', '', ''),
(14, '100186', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:13', '', ''),
(15, '100189', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:14', '', ''),
(16, '100163', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '1050000', '0', '1050000', '1050000', '', '2022-03-20 13:49:25', '', ''),
(17, '100197', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '450', '0', '450', '450', '', '2022-03-20 14:10:43', '', ''),
(18, '100110', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '450', '0', '450', '450', '', '2022-03-20 14:11:35', '', ''),
(19, '100175', 4, 'Prepaid', 'NGN', '2022-03-20', '2022-03-20', '526000', '0', '526000', '526000', '', '2022-03-20 14:48:30', '', '');

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
(2, '1', 'Olak Roofing Sales Outlet - Iwo Road', 'New Yidi Road ', 'Ilorin', 'Kwara', '2022-03-09', '2022-03-15 18:48:14', '');

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
(1, 'C01220313', 'Shafi', 'Akinropo', '08145360866', 'Obate iwo osun state', 'Sakinropo@gmail.com', '1', '1', 3, '2022-03-13 17:03:29', ''),
(2, 'C02220315', 'Frances', 'Udeme', '08098345789', '43, Masalasi Street odun ade', 'udeme@gmail.com', '1', '1', 2, '2022-03-15 18:03:17', ''),
(3, 'C03220315', 'Adebisi', 'Adepoju', '08123456789', 'Obate iwo osun state', 'adepoju@gmail.com', '1', '2', 4, '2022-03-15 18:03:10', ''),
(4, 'C04220320', 'ABC', 'Company', '08145768907', 'Ade Street', 'ade@gmail.com', '0', '0', 1, '2022-03-20 13:03:10', '');

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
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `transid`, `service_type`, `quantity`, `unit_cost`, `amount`, `created_at`, `created_by`, `updated_at`) VALUES
(1, '100196', '6', '3', '150', '450', '2022-03-15 17:40:00', '2', ''),
(2, '100196', '4', '5', '2000', '10000', '2022-03-15 17:40:00', '2', ''),
(3, '100123', '4', '3', '2000', '6000', '2022-03-15 17:45:47', '2', ''),
(4, '100170', '3', '4', '5000', '20000', '2022-03-15 17:47:19', '2', ''),
(5, '100153', '6', '3', '150', '450', '2022-03-15 17:51:33', '2', ''),
(6, '100125', '3', '4', '5000', '20000', '2022-03-15 17:52:20', '2', ''),
(7, '100142', '6', '6', '150', '900', '2022-03-15 17:53:55', '2', ''),
(8, '100185', '5', '4', '90000', '360000', '2022-03-15 17:59:03', '2', ''),
(9, '100195', '6', '3', '150', '450', '2022-03-15 18:02:08', '2', ''),
(10, '100137', '3', '3', '5000', '15000', '2022-03-15 18:21:22', '2', ''),
(11, '100135', '6', '3', '150', '450', '2022-03-15 18:25:55', '2', ''),
(12, '100151', '1', '200', '2000', '400000', '2022-03-20 13:49:07', '1', ''),
(13, '100151', '3', '100', '5000', '500000', '2022-03-20 13:49:07', '1', ''),
(14, '100151', '2', '50', '3000', '150000', '2022-03-20 13:49:07', '1', ''),
(15, '100135', '1', '200', '2000', '400000', '2022-03-20 13:49:12', '1', ''),
(16, '100135', '3', '100', '5000', '500000', '2022-03-20 13:49:12', '1', ''),
(17, '100135', '2', '50', '3000', '150000', '2022-03-20 13:49:12', '1', ''),
(18, '100127', '1', '200', '2000', '400000', '2022-03-20 13:49:13', '1', ''),
(19, '100127', '3', '100', '5000', '500000', '2022-03-20 13:49:13', '1', ''),
(20, '100127', '2', '50', '3000', '150000', '2022-03-20 13:49:13', '1', ''),
(21, '100186', '1', '200', '2000', '400000', '2022-03-20 13:49:13', '1', ''),
(22, '100186', '3', '100', '5000', '500000', '2022-03-20 13:49:13', '1', ''),
(23, '100186', '2', '50', '3000', '150000', '2022-03-20 13:49:13', '1', ''),
(24, '100189', '1', '200', '2000', '400000', '2022-03-20 13:49:14', '1', ''),
(25, '100189', '3', '100', '5000', '500000', '2022-03-20 13:49:14', '1', ''),
(26, '100189', '2', '50', '3000', '150000', '2022-03-20 13:49:14', '1', ''),
(27, '100163', '1', '200', '2000', '400000', '2022-03-20 13:49:25', '1', ''),
(28, '100163', '3', '100', '5000', '500000', '2022-03-20 13:49:25', '1', ''),
(29, '100163', '2', '50', '3000', '150000', '2022-03-20 13:49:25', '1', ''),
(30, '100197', '6', '3', '150', '450', '2022-03-20 14:10:43', '2', ''),
(31, '100110', '6', '3', '150', '450', '2022-03-20 14:11:35', '2', ''),
(32, '100175', '1', '70', '1800', '126000', '2022-03-20 14:48:30', '1', ''),
(33, '100175', '2', '100', '3000', '300000', '2022-03-20 14:48:30', '1', ''),
(34, '100175', '3', '20', '5000', '100000', '2022-03-20 14:48:30', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `barcode_symbology` varchar(191) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `sold_bottle` varchar(50) NOT NULL DEFAULT '0',
  `sold_shut` varchar(50) NOT NULL DEFAULT '0',
  `alert_quantity` varchar(50) NOT NULL,
  `product_tax` varchar(255) NOT NULL,
  `tax_method` varchar(255) NOT NULL,
  `sell_per_shut` varchar(50) NOT NULL DEFAULT '0',
  `cost` varchar(191) NOT NULL,
  `price` varchar(191) NOT NULL,
  `shut_price` varchar(100) NOT NULL,
  `no_of_shut` varchar(50) NOT NULL,
  `left_bottle` varchar(191) NOT NULL,
  `left_shut` varchar(191) NOT NULL,
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

INSERT INTO `products` (`id`, `ref_no`, `file`, `code`, `barcode_symbology`, `pname`, `type`, `category`, `quantity`, `sold_bottle`, `sold_shut`, `alert_quantity`, `product_tax`, `tax_method`, `sell_per_shut`, `cost`, `price`, `shut_price`, `no_of_shut`, `left_bottle`, `left_shut`, `vat`, `total_price`, `details`, `created_at`, `update_at`, `created_by`, `exception`, `deleted`) VALUES
(1, '', 'image.jpg', '14081295', '3', 'Aluminium Sheet', 'Product', '1', '0', '', '', '0', '7.5', '1', '0', '', '2000', '', '', '0', '', '0', '2000', '', '', '2022-03-13 14:08:30', '', '0', ''),
(2, '', 'image.jpg', '07331447', '', 'Mini Abestors', 'Product', '1', '0', '', '', '0', '7.5', '', '0', '', '3000', '', '', '', '', '', '', '', '', '2022-03-15 07:39:46', '', '0', ''),
(3, '', 'image.jpg', '07414661', '3', 'Small Abestor', 'Product', '1', '0', '', '', '0', '7.5', '', '0', '', '5000', '', '', '', '', '', '5000', '', '', '2022-03-15 07:41:57', '', '0', ''),
(4, '', 'image.jpg', '11565036', '3', 'Plate', 'Product', '1', '0', '', '', '0', '7.5', '1', '0', '', '2000', '', '', '', '', '150', '2000', '', '', '2022-03-15 07:54:59', '', '0', ''),
(5, '', 'image.jpg', '11563447', '3', 'Pipe', 'Product', '1', '0', '', '', '0', '7.5', '1', '0', '', '90000', '', '', '', '', '6750', '90000', '', '', '2022-03-15 08:34:22', '', '0', ''),
(6, '', 'image.jpg', '08545230', '3', 'Bolt & Nut', 'Product', '1', '0', '', '', '0', '7.5', '1', '0', '', '150', '', '', '', '', '7.5', '150', '', '', '2022-03-15 08:54:34', '', '0', '');

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
(1, 'Roofing Sheet', '2022-03-13 13:52:28', '', 0, '');

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

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `client_id`, `plate_no`, `make`, `model`, `year`, `last_service`, `deleted`) VALUES
(1, 1, 'ABD-130-EF', 'Toyota', 'Corola', '2016', '0000-00-00 00:00:00', 0),
(2, 1, 'AAA-130-QT', 'Mercedese', 'Benz', '2017', '2020-02-13 00:00:00', 0),
(3, 1, 'ASD-901-FG', 'Toyota', 'Corola', '2013', '2020-02-07 00:00:00', 0),
(4, 1, 'ASD-901-FG', 'Toyota', 'Corola', '2013', '2020-02-07 00:00:00', 0),
(5, 1, 'AAA-130-QT', 'Toyota', 'Corola', '2016', '2020-02-07 00:00:00', 0);

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
(1, 'C01220313', '60000', '1', '1', '2022-03-13 17:55:29', '2022-03-13 17:55:29', ''),
(3, 'C02220315', '3000000', '1', '1', '2022-03-15 18:27:17', '2022-03-15 18:27:17', ''),
(4, 'C03220315', '2000000', '1', '2', '2022-03-15 18:51:10', '2022-03-15 18:51:10', ''),
(5, 'C03220315', '2000000', '', '', '2022-03-15 18:55:18', '2022-03-15 18:55:18', ''),
(6, 'C04220320', '4000000', '1', '2', '2022-03-20 13:35:10', '2022-03-20 13:35:10', '');

-- --------------------------------------------------------

--
-- Table structure for table `walletDetails`
--

CREATE TABLE `walletDetails` (
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
-- Dumping data for table `walletDetails`
--

INSERT INTO `walletDetails` (`id`, `customer_id`, `amount`, `refrence_no`, `description`, `created_by`, `bank_name`, `account_no`, `updated_at`, `created_at`, `deleted`) VALUES
(1, 'C02220315', '400000', '', 'food', '2', '3', '1893783976', '2022-03-20 05:48:33', '2022-03-20 05:48:33', ''),
(2, 'C01220313', '30000', 'REF4455677', 'Bag', '2', '3', '1893783976', '2022-03-20 05:50:23', '2022-03-20 05:50:23', ''),
(3, 'C04220320', '4000000', 'REF0947648996', 'Purchase of 200 Roofing Sheet', '1', '1', '01127399', '2022-03-20 13:41:44', '2022-03-20 13:41:44', '');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `walletDetails`
--
ALTER TABLE `walletDetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `walletDetails`
--
ALTER TABLE `walletDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
