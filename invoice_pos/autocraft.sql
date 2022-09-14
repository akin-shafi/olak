-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2020 at 06:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autocraft`
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
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `phone`, `hashed_password`, `admin_level`, `company_id`, `branch_id`,`created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Administrator', 'Admin', 'admin@gmail.com', '09012345678', '$2y$10$FdT3KdNe6INlyzvZICTtq.IhZYYSntHnr3vwkxp9eNI0fMcpCzuRW', 1, '', '2020-02-20 00:40:47', '2020-02-20 00:40:47', 0);

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
  `updated_date` date NOT NULL,
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

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `client_id`, `plate_no`, `date`, `details`, `service`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 1, 'ABD-130-EF', '2020-02-06', 'This is a booking test', 0, 1, '2020-02-20 01:01:46', '2020-02-20 01:01:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `phone`, `address`, `email`, `created_by`, `created_at`, `deleted`) VALUES
(1, 'Agunbiade', 'Adigun', '09012345678', 'Surulere', 'adigun@gmail.com', 1, '2020-02-20 00:02:41', 0);

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
(1, 'AutoCraft Corporate Service', 'Afeez Sanni', '56, Adeniran Ogunsanya Street Off Bode Thomos Surulere Lagos', 'Nigeria', 'Surulere', 'Lagos', '12345', 'autocraft@gmail.com', '08011110000', '08022220000', 'www.autocraft.com.ng', 'www.autocraft.com.ng', '@autoCraft', 'first bank Nig Plc', 'AutoCraft', '0198762456');

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
  `updatedTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





ALTER TABLE `access_control` ADD `can_approve` VARCHAR(50) NOT NULL DEFAULT '0' AFTER `access_control`;
ALTER TABLE `access_control` ADD `special_sales` VARCHAR(50) NOT NULL AFTER `sales_mgt`;
ALTER TABLE `wallet_funding_method` ADD `bank_name` VARCHAR(50) NOT NULL AFTER `amount`;
ALTER TABLE `access_control` ADD `compliance` VARCHAR(50) NOT NULL AFTER `user_mgt`;
ALTER TABLE `wallet_funding_method` ADD `refrence_no` VARCHAR(50) NOT NULL AFTER `payment_id`, ADD `description` TEXT NOT NULL AFTER `refrence_no`;
ALTER TABLE `access_control` ADD `process_waybill` VARCHAR(50) NOT NULL AFTER `filtering`;




ALTER TABLE `customer` ADD `balance` VARCHAR(50) NOT NULL DEFAULT '0' AFTER `branch_id`, ADD `deposit` 
VARCHAR(50) NOT NULL AFTER `balance`, ADD `payment_id` VARCHAR(50) NOT NULL AFTER `deposit`;



CREATE TABLE `expenses` ( `id` int(11) NOT NULL AUTO_INCREMENT, `company_id` varchar(191) DEFAULT NULL, `branch_id` varchar(191) DEFAULT NULL, `title` varchar(191) NOT NULL, `quantity` varchar(191) NOT NULL, `amount` varchar(191) NOT NULL, `narration` varchar(255) NOT NULL, `created_by` varchar(191) NOT NULL, 
  `created_at` date NOT NULL, `updated_at` datetime NOT NULL, `deleted` varchar(2) DEFAULT NULL, PRIMARY KEY (`id`) );

ALTER TABLE `expenses` CHANGE `created_at` `created_at` VARCHAR(50) NOT NULL, CHANGE `updated_at` `updated_at` VARCHAR(50) NOT NULL;





