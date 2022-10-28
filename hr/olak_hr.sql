-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2022 at 08:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olak_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_control`
--

CREATE TABLE `access_control` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
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

INSERT INTO `access_control` (`id`, `user_id`, `users_mgt`, `product_mgt`, `sales_mgt`, `expenses_mgt`, `report_mgt`, `created_by`, `created_at`, `deleted`) VALUES
(1, '2', '1', '1', '0', '0', '0', '1', '2022-04-21 13:17:11', ''),
(2, '1', '1', '1', '1', '1', '1', '1', '2022-04-21 13:58:19', '');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_img` varchar(191) NOT NULL,
  `hashed_password` varchar(191) NOT NULL,
  `reset_password` varchar(50) NOT NULL,
  `admin_level` varchar(50) DEFAULT NULL,
  `account_status` varchar(50) DEFAULT NULL,
  `company_id` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `profile_img`, `hashed_password`, `reset_password`, `admin_level`, `account_status`, `company_id`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(1, 'Admin', 'One', 'super@hr.com', 'user.png', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '1', '2', NULL, '1', '2021-12-15 11:25:08', '2021-12-15 12:24:40', '1', ''),
(2, 'Salami', 'Kehinde', 'stakgf@gmail.com', '', '$2y$10$uSNUmBNCe5WUTtO04AcrBu/v04Ojt.2rdgFxwaGBr6sEYu2.AVAui', '0', '2', '', NULL, '2022-02-11 15:09:10', '2022-02-11 15:09:10', '1', ''),
(3, 'Sodiq', 'Jimoh', 'sodiq@olak.com', '', '$2y$10$a3RGpMYrM.fn4l5Iwrticu0FxEIA7ULIdeuFew9Z9KXHpbw0Vy6iC', '0', '3', '', NULL, '2022-02-15 17:51:43', '2022-02-15 17:51:43', '1', '1'),
(4, 'Ogunwusi', 'Kehinde', 'kehindeogunwusi11@gmail.com', '', '$2y$10$WO8GtUwQ0/0YMuPpAkapc.H4sIYhvSS8j7K6ykertOf2777I0bXPG', '0', '3', '', NULL, '2022-02-16 16:19:03', '2022-02-16 16:19:03', '2', '');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `established_in` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `company_name`, `company_id`, `branch_name`, `address`, `city`, `state`, `established_in`, `created_at`, `deleted`) VALUES
(1, 'Head Office', '8', 'Head office', 'New Yidi Road', 'Ilorin', 'Kwara', '2022-02-04 15:23:00', '2022-02-04 15:23:00', 0),
(2, 'Retail Outlet', '1', 'Ilorin (Station)', 'Station', 'Ilorin', 'Kwara', '1998-01-03', '2022-01-03 13:03:40', 1),
(3, 'Retail Outlet', '1', 'Ilorin (Usanda) Sobi Road', 'Sobi Road ', 'Ilorin', 'Kwara', '2004-07-08', '2022-01-08 07:54:46', 0),
(4, 'Aroma', '2', 'Aroma Unity', 'Unity Road', 'Ilorin', 'Kwara', '2017-06-08', '2022-01-08 07:59:06', 0),
(5, 'Aroma', '2', 'Aroma A Division', 'Area A\' Divison', 'Ilorin', 'Kwara', '2017-06-08', '2022-01-08 08:00:30', 0),
(6, 'Aroma', '2', 'Aroma Iwo Road', 'Ibadan Iwo Road ', 'Ibadan', 'Oyo', '2017-06-08', '2022-01-08 08:02:10', 0),
(7, 'Aroma', '2', 'Aroma Toll-Gate', 'Toll-Gate Ibadan', 'Ibadan', 'Oyo ', '2021-02-08', '2022-01-08 08:03:35', 0),
(8, 'Aroma Bakery ', '5', 'Aroma Bakery Ilorin(Unity)', 'Ilorin Unity', 'Ilorin', 'Kwara', '2018-02-08', '2022-01-08 08:05:43', 1),
(9, 'Aroma Bakery ', '5', 'Aroma Bakery Ibadan(Iwo Road)', 'Ibadan(Iwo Road)', 'Ibadan', 'Kwara', '2017-06-08', '2022-01-08 08:08:06', 1),
(10, 'Petroleum', '4', 'Olak Pet. Ilorin(A-Division) ', 'A Division', 'ilorin', 'Kwara', '2019-07-08', '2022-01-08 08:09:58', 0),
(11, 'Petroleum', '4', 'Olak Pet. Ibadan', 'Lagos Ibadan express way', 'Ibadan', 'Oyo', '2020-06-08', '2022-01-08 08:12:20', 0),
(12, 'Petroleum', '4', 'Olak Pet. Usanda', 'Sobi Road ', 'Ilorin', 'Kwara', '2019-02-08', '2022-01-08 08:13:58', 0),
(13, 'Gas', '6', 'Olak Gas-Ilorin', 'A Division', 'Ilorin', 'Kwara', '2019-02-08', '2022-01-08 08:16:14', 0),
(14, 'Olak Roofing Factory', '3', 'Olak Roofing Factory(Irewolede)', 'Irewolede', 'Ilorin', 'Kwara', '2021-07-07', '2022-01-08 08:17:45', 0),
(15, 'Retail Outlet', '1', 'Ilorin (A division)', 'A division', 'Ilorin', 'Kwara', '2019-06-08', '2022-01-08 08:21:12', 0),
(16, 'Retail Outlet', '1', 'Ibadan (Iwo Road)', 'Ibadan Iwo Road ', 'Ibadan', 'Kwara', '2019-02-08', '2022-01-08 08:22:23', 0),
(17, 'Aroma', '2', 'Sango', 'Opposite First Bank Sango Poly Road', 'Ibadan', 'Oyo', '2022-08-17 14:41:36', '2022-08-17 14:41:36', 0),
(18, 'Aroma', '2', 'Eleyele', 'Opposite Midas Pharmacy, Eleyele Roundabout ', 'Ibadan', 'Oyo', '2022-08-17 14:48:58', '2022-08-17 14:48:58', 0);

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
(1, '', 'Retail Outlet', '001', '2022-01-03 15:03:17', ''),
(2, '', 'Aroma', '002', '2022-01-08 07:46:43', ''),
(3, '', 'Olak Roofing Factory', '003', '2022-01-08 07:47:04', ''),
(4, '', 'Petroleum', '004', '2022-01-08 07:47:18', ''),
(5, '', 'Aroma Bakery', '005', '2022-01-08 07:47:59', '1'),
(6, '', 'Gas', '006', '2022-01-08 08:14:53', ''),
(7, '', 'Transport', '007', '2022-01-27 20:17:50', ''),
(8, '', 'Head Office', '008', '2022-01-27 20:40:09', ''),
(9, '', '', '009', '2022-01-27 21:11:52', '');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` int(11) NOT NULL,
  `loan_config` varchar(5) NOT NULL,
  `process_salary` varchar(50) NOT NULL DEFAULT '0',
  `visibility` varchar(50) NOT NULL DEFAULT '0',
  `process_salary_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `loan_config`, `process_salary`, `visibility`, `process_salary_date`) VALUES
(1, '1', '1', '1', '2022-01-02'),
(2, '1', '1', '0', '2022-04-08'),
(3, '1', '0', '0', '2022-02-28'),
(4, '0', '0', '0', '2022-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `created_at`, `deleted`) VALUES
(1, 'Account', '2022-01-26 08:50:52', 0),
(2, 'Human Resource & Admin', '2022-01-26 08:51:07', 0),
(3, 'Compliance', '2022-01-26 08:51:22', 0),
(4, 'Kitchen', '2022-01-26 08:51:32', 0),
(5, 'Transport', '2022-01-26 08:51:41', 0),
(6, 'Procurement', '2022-02-04 15:20:23', 0),
(7, 'Sales & Marketing', '2022-02-09 16:08:46', 0),
(8, 'Pie Xpress', '2022-02-10 15:59:49', 0),
(9, 'Cashier', '2022-02-10 16:00:15', 0),
(10, 'Fryer', '2022-02-10 16:00:27', 0),
(11, 'Supervision', '2022-02-11 09:40:13', 0),
(12, 'furnance', '2022-03-14 16:53:16', 0),
(13, 'Colourline', '2022-03-15 16:39:49', 0),
(14, 'Maintenance', '2022-03-15 16:40:25', 0),
(15, 'Mill Operation', '2022-03-15 16:40:47', 0),
(16, 'CRM Operation', '2022-03-15 16:41:19', 0),
(17, 'CGL', '2022-03-15 16:41:51', 0),
(18, 'Mechanical', '2022-03-15 16:42:06', 0),
(19, 'Electrical', '2022-03-15 16:42:18', 0),
(20, 'Entryline', '2022-04-22 08:57:59', 0),
(21, 'Bakery', '2022-04-23 14:58:39', 0),
(22, 'cook', '2022-06-27 13:54:52', 0),
(23, 'Host', '2022-08-17 14:28:52', 0),
(24, 'roll forming', '2022-08-23 11:33:44', 0),
(25, 'corrugating', '2022-08-23 11:38:41', 0),
(26, 'galvanizing', '2022-08-23 11:43:19', 0),
(27, 'Weighbridge', '2022-08-23 17:48:00', 0),
(28, 'Quality Assurance', '2022-08-23 18:05:41', 0),
(29, 'Gas', '2022-08-23 18:20:40', 0),
(30, 'warehouse', '2022-08-24 12:54:23', 0),
(31, 'MD\'s Office', '2022-08-24 16:30:35', 0),
(32, 'supermarket', '2022-08-26 12:12:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(50) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `department_id`, `created_at`, `deleted`) VALUES
(1, 'Shop one', 0, '2022-01-18 16:20:35', 0),
(2, 'Shop two', 0, '2022-01-18 16:20:51', 0),
(3, 'Shop three', 0, '2022-01-18 16:21:01', 0),
(4, 'Shop four', 0, '2022-01-18 16:21:10', 0),
(5, 'cooks', 0, '2022-01-18 16:21:25', 0),
(6, 'attendants', 0, '2022-01-22 13:09:23', 0),
(7, 'Driver', 0, '2022-01-26 08:53:39', 0),
(8, 'Cook', 0, '2022-01-26 08:53:50', 0),
(9, 'Fuel Pump Attendant', 0, '2022-01-26 08:54:02', 0),
(10, 'Procurement Manager', 0, '2022-02-04 15:20:47', 0),
(11, 'Sales Attendant', 0, '2022-02-09 16:05:34', 0),
(12, 'Sales Attendant', 0, '2022-02-09 16:05:35', 1),
(13, 'Cashier', 0, '2022-02-10 16:01:50', 0),
(14, 'Fryer', 0, '2022-02-10 16:02:16', 0),
(15, 'Pie xpress', 0, '2022-02-10 16:02:35', 0),
(16, 'Security', 0, '2022-02-10 19:00:40', 0),
(17, 'Sales Representative', 0, '2022-02-11 09:23:06', 0),
(18, 'Cleaner', 0, '2022-02-11 09:26:21', 0),
(19, 'Internal Control & Compliance', 0, '2022-02-11 09:34:58', 1),
(20, 'Internal Control & Compliance', 0, '2022-02-11 09:35:54', 0),
(21, 'Manager', 0, '2022-02-11 09:40:36', 0),
(22, 'Assistant Manager', 0, '2022-02-11 09:42:37', 0),
(23, 'supervisor', 0, '2022-02-11 11:15:34', 0),
(24, 'officer', 0, '2022-02-11 15:57:01', 0),
(25, 'Expatriate', 0, '2022-03-14 16:57:02', 0),
(26, 'operator', 0, '2022-04-22 08:59:00', 0),
(27, 'Baker', 0, '2022-04-23 14:58:59', 0),
(28, 'cok', 0, '2022-06-27 13:55:05', 1),
(29, 'cook', 0, '2022-06-27 13:57:02', 0),
(30, 'host', 0, '2022-08-17 16:55:54', 0),
(31, 'parking', 0, '2022-08-23 11:34:27', 1),
(32, 'packing', 0, '2022-08-23 11:36:56', 0),
(33, 'corrugating', 0, '2022-08-23 11:39:04', 0),
(34, 'roll grinder', 0, '2022-08-23 12:27:53', 0),
(35, 'Sharing operator', 0, '2022-08-23 12:45:45', 0),
(36, 'furnance', 0, '2022-08-23 12:46:39', 0),
(37, 'Trimming Officer', 0, '2022-08-23 14:35:25', 0),
(38, 'Coater operator', 0, '2022-08-23 14:38:41', 0),
(39, 'online sharing', 0, '2022-08-23 17:34:26', 0),
(40, 'Exit officer', 0, '2022-08-23 17:40:14', 0),
(41, 'Weighbridge', 0, '2022-08-23 17:45:38', 1),
(42, 'Pickling operator', 0, '2022-08-23 17:50:31', 0),
(43, 'mechanic', 0, '2022-08-23 17:56:49', 0),
(44, 'quality officer', 0, '2022-08-23 18:05:07', 0),
(45, 'forklift', 0, '2022-08-23 18:11:33', 0),
(46, 'Tunner', 0, '2022-08-23 18:24:47', 0),
(47, 'Welder manager', 0, '2022-08-24 10:30:18', 0),
(48, 'Exit operator', 0, '2022-08-24 10:42:12', 0),
(49, 'Mechanical Manager', 0, '2022-08-24 10:45:13', 0),
(50, 'Store officer', 0, '2022-08-24 12:54:59', 0),
(51, 'entry operator', 0, '2022-08-24 13:16:50', 0),
(52, 'celler operator', 0, '2022-08-24 13:27:10', 0),
(53, 'Helper', 0, '2022-08-24 13:40:43', 0),
(54, 'offline', 0, '2022-08-24 13:45:32', 0),
(55, 'online operator', 0, '2022-08-24 13:53:39', 0),
(56, 'Gardener', 0, '2022-08-24 14:36:26', 0),
(57, 'Welder', 0, '2022-08-24 14:44:07', 0),
(58, 'plumber', 0, '2022-08-24 15:59:09', 0),
(59, 'Secretary', 0, '2022-08-24 16:31:01', 0),
(60, 'PA', 0, '2022-08-24 16:31:26', 0),
(61, 'Procurement officer', 0, '2022-09-20 19:24:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `other_name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `kin_name` varchar(50) NOT NULL,
  `kin_phone` varchar(50) NOT NULL,
  `present_add` varchar(255) DEFAULT NULL,
  `permanent_add` varchar(255) NOT NULL,
  `highest_qualification` varchar(255) NOT NULL,
  `company` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `date_employed` varchar(50) NOT NULL,
  `employment_type` varchar(5) NOT NULL,
  `present_salary` varchar(50) NOT NULL,
  `grade_step` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_code` varchar(50) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `company_id` varchar(5) NOT NULL,
  `photo` varchar(20) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `update_profile` varchar(11) NOT NULL DEFAULT '0',
  `created_at` varchar(50) NOT NULL,
  `deleted` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `last_name`, `other_name`, `phone`, `email`, `gender`, `marital_status`, `dob`, `kin_name`, `kin_phone`, `present_add`, `permanent_add`, `highest_qualification`, `company`, `branch`, `department`, `job_title`, `date_employed`, `employment_type`, `present_salary`, `grade_step`, `bank_name`, `bank_code`, `account_number`, `blood_group`, `company_id`, `photo`, `notification`, `hashed_password`, `update_profile`, `created_at`, `deleted`) VALUES
(1, '27', 'TAIWO ', 'DAVID', 'OLAREWAJU', '8060248043', 'olarewajudavid016@gmail.com', 'male', 'Married', '1980-05-28', 'Sinmisola Taiwo ', '8060248043', '44 Kotagora Street Stadium Road Ilorin', 'Ifetedo Ita Alamu Area Ilorin', 'SSCE', 'Retail Outlet', 'Ilorin (A division)', 'Account', 'Cashier', '2002-03-12', '1', '155000', 'Senior Executive Assistsant_4', 'ACCESS BANK', '044', '95349674', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(2, '50', 'EDUNGBOLA ', 'SILAS', 'LEKE', '8034833747', 'edunsilas@yahoo.co.uk', 'Male', 'Married', '01/10/1978', 'Edungbola Olusike', '8135495499', 'Opposite Metropolitan Square Asa Dam Road Ilorin', 'Opposite Metropolitan Square Asa Dam Road Ilorin', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Account', 'Assistant Manager', '2007-07-17', '1', '155500', 'Asistant Manager_2', 'ACCESS BANK', '044', '9138806', 'O', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(3, '58', 'ADEMOJE ', 'ABIODUN', ' LAWAL', '7039480106', 'ademojeb@gmail.com', 'Male', 'Married', '14/09/1982', 'Fawaz Lawal', '7039480106', '29 Alafia Oluwa Baptist Church Osere Ilorin', '29 Alafia Oluwa Baptist Church Osere Ilorin', 'HND', 'Gas', 'Head office', 'Account', 'Cashier', '2008-06-06', '1', '135000', 'Executive Assistant_4', 'ACCESS BANK', '044', '9138837', 'A', '6', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(4, '66', 'SHITTU ', 'WASIU', 'OPEYEMI', '7030292462', 'shittuwasiu64@gmail.com', 'Male', 'Married', '', 'Shittu Lateefat', '8133116572', '32 Kajola Monatan Ibadan', '15 Okepopo Street Osogbo', 'SSCE', 'Retail Outlet', 'Ibadan (Iwo Road)', 'Sales & Marketing', 'Sales Attendant', '2010-01-11', '1', '80000', 'Executive Officer_2', 'WEMA', '035', '247018701', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(5, '77', 'AJETUNMOBI ', 'TAOFEEQ ', 'AYOBAMI', '8072036129', 'ajetunmobitaophyq@gmail.com', 'Male', 'Married', '1992-08-23', 'Ajetunmobi Suliyat', '8181630188', '28 Zone B Aliyu Awu Oluwa Olunde Ibadan', '28 Zone B Aliyu Awu Oluwa Olunde Ibadan', 'OND', 'Petroleum', 'Olak Pet. Ibadan', 'Account', 'Cashier', '2011-07-01', '1', '50000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '783269755', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(6, '78', 'ADEBAYO ', 'WILLIAMS', 'OLADELE', '8037760465', 'bayowillio49@gmail.com', 'Male', 'Married', '24/10/1982', 'Adebayo Esther Monisola', '8103784220', 'Famous Street Jimba-Oja Ifelodun L.G.A. Kwara', 'Ile Olohaujo Compound Isolo-Opin Ekiti LGA Kwara ', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Account', 'officer', '2011-08-08', '1', '127500', 'Executive Assistant_4', 'ACCESS BANK', '044', '33598366', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(7, '99', 'OLANIYAN ', 'MARUF', 'ADETUNJI', '8035655809', 'mao4life@gmail.com', 'Male', 'Married', '28/08/1982', 'Olaniyan Faruq', '8062225123', 'Ga-Imam Adisco Street Ilorin', 'Ga-Imam Adisco Street Ilorin', 'HND', 'Head Office', 'Head office', 'Account', 'Assistant Manager', '2013-06-01', '1', '127500', 'Executive Assistant_1', 'UBA', '033', '2113804502', 'O pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(8, '101', 'OJEWOLE ', 'KAYODE ', 'FESTUS', '8060968062', 'ojewolekayode@gmail.com', 'Male', 'Married', '', 'Olayioye Olawunmi', '7039453343', '2 Olunlade Along Ajage-Ipo Road Ilorin', '2 Olunlade Along Ajage-Ipo Road Ilorin', 'HND', 'Head Office', 'Head office', 'Account', 'officer', '2013-06-13', '1', '95000', 'Executive Assistant_1', 'FBN', '011', '3101874916', '', '8', '', '', '$2y$10$V22ikog4RlBnV40yI1n84erROiSozmoNtqyno6aJmXTkluTQvPgOq', '1', '', ''),
(9, '106', 'OLAOYE', 'SHOLA ', 'YINKA', '7033505959', 'sholayinka14@gmail.com', 'Male', 'Married', '2020-07-29', 'Kudabo James Sunday', '8088757588', '5 Opposite CAC Alabebe Monatan Ibadan', '9 Ring Road Ilemisin Compound Obbo Aiyegunle Kwara', 'HND', 'Aroma', 'Aroma Iwo Road', 'Account', 'officer', '2020-07-29', '1', '80000', 'Executive Officer_2', 'WEMA', '035', '249045310', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(10, '217', 'BELLO ', 'KAMILDEEN ', 'AYOBAMI', '8033699072', 'kamildeen4real@gmail.com', 'Male', 'Married', '04/12/1974', 'Bello Khadijat', '7030405867', '3 Ifesowapo Zone 3 Onigari Busstop Ayegun  Ibadan', '3 Ifesowapo Zone 3 Onigari Busstop Ayegun  Ibadan', 'MSc', 'Head office', 'Head office', 'Account', 'Manager', '02/05/2018', '1', '155000', 'Deputy Manager_1', 'ACCESS BANK', '044', '809236673', '', '', '', '', '$2y$10$w2uL3uNljXurDlcabSpIKO6.tTMQSyFpYWb58sXLoQuZYfzWSV6Ny', '1', '', '1'),
(11, '248', 'SAMSON ', 'IFEOLADAPO', 'IBIGBEMI', '9060009830', 'samsonifeola@gmail.com', 'Male', 'Married', '15/05/1984', 'Mrs Ifeoladapo', '8032210607', '11 Memudu Layemo Street Awolowo Road Tanke Ilorin', '11 Memudu Layemo Street Awolowo Road Tanke Ilorin', 'B.Sc', 'Head Office', 'Head office', 'Procurement', 'Procurement officer', '2019-09-01', '1', '55000', 'Senior Office Assistant_1', 'ACCESS BANK', '044', '79728655', 'A pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(12, '264', 'OLASEHINDE ', 'EKUNDAYO', '', '8039106065', 'olasehindeekundayo@yahoo.com', 'Male', 'Married', '22/08/1981', 'David Mary Abosede', '8035220859', '20F Off Unity Road Ilorin', '20F Off Unity Road Ilorin', 'HND', 'Head Office', 'Head office', 'Account', 'officer', '2020-01-12', '1', '80000', 'Executive Officer_2', 'ACCESS BANK', '044', '35829154', 'O pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(13, '279', 'SALAWUDEEN ', 'ABAYOMI', 'MUBASIRY', '8108013649', 'salawudeenabayomi7@gmail.com', 'Male', 'Single', '14/06/1991', 'Salawu Rauf', '8036404550', '3 Opposite C.A.C. Primary School Monatan', '3 Opposite C.A.C. Primary School Monatan', 'SSCE', 'Aroma', 'Aroma Unity', 'Account', 'Cashier', '2020-08-04', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '57530360', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(14, '328', 'ADEYEMO ', 'ADEKUNLE ', 'DEMILARE', '9035597246', 'smallmighty1990@gmail.com', 'Male', 'Married', '21/12/1989', 'Adeshina Aderomola', '8164858108', 'Powerline Junction Irewolede Area Ilorin', 'Aniyan Close behind St Andrew\'s Primary School Oke-Baale Osogbo', 'OND', 'Retail Outlet', 'Ilorin (A division)', 'Account', 'officer', '2021-04-12', '1', '60000', 'Senior Office Assistant_2', 'GTB', '', '265812889', 'O pos', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(15, '357', 'ADEWUMI ', 'STEPHEN ', 'ABIODUN', '8032243346', 'bigharbby46@gmail.com', 'Male', 'Single', '26/12/1984', 'Adewumi Kayode Shola', '8030233984', '1 Orisunbare off Asa Dam Ilorin', '1 Orisunbare off Asa Dam Ilorin', 'HND', 'Aroma', 'Head office', 'Account', 'officer', '2021-07-22', '1', '70000', 'Senior Office Assistant_4', 'WEMA ', '035', '251344746', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(16, '362', 'AJADI', 'YETUNDE', 'ODUNITAN', '7062626506', 'odunajadi2015@gmail.com', 'Female', 'Married', '14/08/1994', 'Saka Harvis Bamidele', '07035539140', 'Behind Living Faith Church Kilanko, Offa garage', 'Rehoboth Villa Zone 14 Agbede Oke Odo Tanke Ilorin', 'B.Sc', 'Head Office', 'Head office', 'Account', 'officer', '2021-08-02', '1', '60000', 'Senior Office Assistant_2', 'FBN', '011', '3117986603', 'O pos', '8', '', '', '$2y$10$/PJ9/AFiiAQjtTWVDlwBueoKkUjX2239GdlIClRirpuJT7l8f0yFy', '1', '', ''),
(17, '382', 'AKANDE ', 'OLUWABUKOLA', 'TOSIN', '8137357098', 'oluwabukolaakande88@gmail.com', 'Female', 'Single', '', 'Akande Olorunnisola', '7045673712', '16 Kangin Araromi Off Olulade Ilorin', '16 Kangin Araromi Off Olulade Ilorin', 'B.Sc', 'Head Office', 'Head office', 'Account', 'officer', '2021-09-01', '1', '60000', 'Senior Office Assistant_2', 'ECO', '050', '2593073596', '', '8', '', '', '$2y$10$9QuoBwhXdTHe3CHWK1k1WerwpwOv9so681WDr6gHmKuyZvMP5WFDq', '1', '', ''),
(18, '36', 'OSUOLALE ', 'AKOLAWOLE  Daud', 'DAUD', '7030262395', 'kholexgman10@gmail.com', 'Male', 'Married', '10/04/1984', 'Daud  Tawakalit', '8160150966', 'Airport Road Prince House Papa Ibadan', 'Behinde Bat star Sango Area Ore meji House Ilorin', 'BSc', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'Manager', '2005-05-27', '1', '190000', 'Assistant Manager_1', 'ACCESS BANK', '044', '35627518', 'O pos', '2', '', '', '$2y$10$oFLfXRXUda4SZ9abltdUJO5mwRRBbo.rqBATAFSFOKmQgn7YfxQ.u', '1', '', ''),
(19, '41', 'FREDRICK', 'DARE', '', '8032948352', 'dfred2012@gmail.com', 'Male', 'Married', '18/04/1980', 'Fredrick Racheal ', '8066391991', 'Agandi Zone C Block B 17 Olodo Ibadan', 'Agandi Zone C Block B 17 Olodo Ibadan', 'NCE', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'Manager', '2006-03-06', '1', '162500', 'Assistant Manager_3', 'WEMA', '035', '241236640', 'O pos', '2', '', '', '$2y$10$CmnBBx94u6GBp.D91oCuMetMMXmX/Pg.O1VbvJlhcCaCeHDVX4IGe', '1', '', ''),
(20, '52', 'ADIAMO', 'SURAJU', 'SINA-AYOMI', '8033410488', 'adiamosuraj@gmail.com', 'Male', 'Married', '14/02/1972', 'Adiamo Kafilat', '8111494533', '1 Adegoke Street Olubadan Estate Wema Ibadan', '1 Adegoke Street Olubadan Estate Wema Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Maintenance', 'Manager', '2008-04-03', '1', '155000', 'Assistant Manager_1', 'WEMA', '035', '238990681', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(21, '55', 'ADELUSI ', 'ADEBAYO', 'SAMUEL', '7035665661', 'samueladelusi@gmail.com', 'Male', 'Married', '08/05/1989', 'Adebayo Nathaniel', '', '21I Isokan Estate Oganla Area Babaagba Apata Ibadan', '21I Isokan Estate Oganla Area Babaagba Apata Ibadan', 'HND', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'Manager', '2008-05-11', '1', '135000', 'Senior Executive Assistant_2', 'WEMA', '035', '239201210', 'O pos', '2', '', '', '$2y$10$EaoVtkHlcfhGgINvVFQgVOYxxzJcIGEDMS1ncAv9s40Uwfzz6A.OO', '1', '', ''),
(22, '56', 'ABDUL ', 'OYEBOLA ', 'D', '8071390055', 'bolaabdul31@gmail.com', 'Male', 'Married', '24/04/1982', 'Adewusi Abdul', '9152776501', '34 Idiishin Quarters Elewuro Akobo Ojurin Ibadan', '27 Jimoh Oyediran Street Obogun Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'Operational Manager', '12/05/2008', '1', '100000', 'Senior Executive Assistant_2', 'WEMA', '035', '239200639', 'O pos', '', '', '', '$2y$10$0Om8j21EUqErH5JxQIvkv.FTiECU1GDJusGaywDlxLR6ObuxfMhMa', '1', '', '1'),
(23, '61', 'ABDUL ', 'OYEBOLA ', 'AYOBAMI', '8071390055', 'bolaabdul31@gmail.com', 'Male', 'Married', '23/03/1977', 'Adewusi Abdul', '9152776501', '34 Idiishin Quarters Elewuro Akobo Ojurin Ibadan', 'Ifedapo Itesiwaju Zone 2 Oke Odo Basorun Ariyo Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Pie Xpress', 'Supervisor', '05/08/2008', '1', '60000', 'Executive Officer_2', 'WEMA', '035', '239113971', 'O pos', '', '', '', '$2y$10$/qHkQ9luA7S5QUpYctN1tu.pr9jfBjjZxdY3w6.0.E0CZJuFFEjAa', '1', '', '1'),
(24, '71', 'KOLAWOLE ', 'KAZEEM', 'ADABAYO', '8034803134', 'kholawolay1908@gmail.com', 'Male', 'Married', '19/08/1982', 'Kolawole Taofeeq', '8038606667', 'Plot 9/10 Abayomi Street Iwo Road Ibadan', 'Plot 9/10 Abayomi Street Iwo Road Ibadan', 'B.Ed', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'supervisor', '2010-10-11', '1', '80000', 'Executive Officer_2', 'WEMA', '035', '228928416', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(25, '137', 'GBADEBO ', 'NURUDEEN', 'OLAWALE', '8105966000', 'wizzywadex@yahoo.com', 'Male', 'Married', '21/06/1992', 'Gbadebo AbdulMalik', '', '2A Ife Sowapo Community behinde NNPC Adegbayi Ibadan', '2A Ife Sowapo Community behinde NNPC Adegbayi Ibadan', 'B.Sc', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'supervisor', '2011-06-01', '1', '80000', 'Executive Officer_2', 'WEMA', '035', '239116147', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(26, '149', 'BADMUS', 'ADEWALE', 'DAMILOLA', '9027326954', 'stephentoyin180@gmail.com', 'Male', 'Married', '05/03/1983', 'Badmus Oluwashindara', '', '20 Okesuna Street Sango Ibadan', '20 Okesuna Street Sango Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Pie Xpress', 'Head', '05/10/2014', '1', '50000', 'Senior Office Assistant_4', 'WEMA', '035', '239119296', 'B pos', '', '', '', '$2y$10$f5OAaXK2rl92iQx1PBYiTetQ55rKQj67G3Lcnbzr7uN5ALfsEvQFm', '1', '', '1'),
(27, '153', 'AYUBA ', 'IDRIS', 'ABIOLA', '8141641365', 'ayubaidris18@gmail.com', 'Female', 'Married', '16/03/1991', 'Sadam Idris', '', '21 Oko Ode Street Ayetoro Road Asa Dam Ilorin', '10 Akinwumi Compound opposite Ile-Marun Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Cook', 'Head', '02/01/2015', '1', '50000', 'Senior Office Assistant_4', 'WEMA', '035', '239194778', 'O pos', '', '', '', '$2y$10$h.wqPQeCWLwAzjA.Er0YEeThTmbDrrxdtom8baFxL/LthLEENgLVW', '1', '', '1'),
(28, '164', 'OGUNSOLA', 'TAOREED', 'OLADIMEJI', '7082071026', 'ogunsola_oladimeji83@gmail.com', 'Male', 'Married', '31/01/1993', 'Ogunsola Barakat', '9043887403', '10 Aba Ada Oki Street Olodo Ibadan', '10 Aba Ada Oki Street Olodo Ibadan', 'NCE', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'supervisor', '2015-03-15', '1', '60000', 'Senior Office Assistant_1', 'WEMA', '035', '239197315', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(29, '186', 'AKINOLA', 'DAYO', 'OLUWASEUN', '8166184803', 'akinoladayo50@gmail.com', 'Female', 'Single', '19/04/1993', 'Akinola Toyin', '7089803617', '20 NEC Agbati Close off Alakia Road Ibadan', '20 NEC Agbati Close off Alakia Road Ibadan', 'OND', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '05/01/2016', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '247107872', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(30, '205', 'OJO', 'OLUKUNMI ', 'ABIODUN', '8136642833', 'aoolukunmi@gmail.com', 'Male', 'Married', '', 'Ojo Heritage', '7086805047', 'Baale Atinti Adeleye Olodo Ibadab', 'Baale Atinti Adeleye Olodo Ibadab', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'supervisor', '2016-01-12', '1', '60000', 'Senior Office Assistant', 'WEMA', '035', '239169301', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(31, '212', 'OLAJIDE ', 'OLUSHOLA ', 'SAMSON', '7068507979', 'olumanishola202@gmail.com', 'Male', 'Married', '29/11/1986', 'Olajide Precious', '8068986560', '32 Ogo-Oluwa Street Cele Road Monatan Ibadan', '32 Ogo-Oluwa Street Cele Road Monatan Ibadan', 'OND', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'supervisor', '2017-09-01', '1', '60000', 'Office Assistant_3', 'WEMA', '035', '239119337', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(32, '214', 'OLAWURE', 'IBRAHIM', '', '9069742708', 'olaib1609@gmail.com', 'Male', 'Married', '', 'Olawure Haruna', '8146692729', '1 Alhaji Abayomi Street Iwo Road Ibadan', '1 Alhaji Abayomi Street Iwo Road Ibadan', '', 'Aroma', 'Aroma Iwo Road', 'Bakery', 'Baker', '2018-01-04', '1', '45000', 'Office Assistant_3', 'WEMA', '035', '239200866', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(33, '227', 'OWOLABI ', 'MUILIYU', 'OLAYINKA', '8145053495', 'olayinkaowolabi1761@gmail.com', 'Male', 'Married', '11/06/1995', 'Owolabi Kafayat', '8148296212', '45 Arojojoye Street Sawmill Area Ilorin', '25 Gbamigbo Street GaaKanbi Ilorin', 'OND', 'Aroma', 'Aroma Unity', 'Fryer', 'supervisor', '2019-03-13', '1', '60000', 'Senior Office Assistant_1', 'WEMA ', '035', '246619091', 'B pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(34, '262', 'OLARIBIGBE', 'TOBI', 'S', '7016770152', 'solaribigbetobi111@gmail.com', 'Male', 'Single', '', 'Oladimeji Abiodun', '7064273355', '11 Bode Kumapayi Iyana Agbala Iwo Road Ibadan', '11 Bode Kumapayi Iyana Agbala Iwo Road Ibadan', '', 'Aroma', 'Aroma Iwo Road', 'Host', 'host', '2020-01-01', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '248070405', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(35, '265', 'ASHIRU', 'AFEEZ', 'ADEWALE', '8154677562', 'afizadwale@gmail.com', 'Male', 'Single', '04/09/1992', 'Alhaji T.O. Fashamu', '8056681522', 'ODK Street Off Alakia Isero Road Alakia Ibadan', '1 Sallam Sallam Street Off Ashipa Olosan Road Alakia Ibadan', 'NCE', 'Aroma', 'Aroma Iwo Road', 'Fryer', 'Fryer', '2020-02-01', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '245114874', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(36, '280', 'IBRAHIM', 'SULIYAT', 'BOLANLE', '7035434868', 'suliyatibraheem7@gmail.com', 'Female', 'Married', '', 'Olayiwola Ismail', '8038509017', '23 Molade Asaju Zone Molade Iwo Road Ibadan', '23 Molade Asaju Zone Molade Iwo Road Ibadan', 'OND', 'Aroma', 'Aroma Iwo Road', 'cook', 'Cook', '2020-08-15', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '227985953', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(37, '281', 'ADEPOJU', 'AMINAT', 'BISOLA', '8115166377', '', 'Female', 'Single', '17/07/1997', 'Adejumo Ifeoluwa', '9036528905', '4 Olagoke Akano Iyana Cele Street Iwo Road Ibadan', '4 Olagoke Akano Iyana Cele Street Iwo Road Ibadan', 'HND', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '15/08/2020', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '247180109', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(38, '282', 'HAMMED', 'HAKEEM', 'ADEWALE', '8064866314', 'hardex96@gmail.com', 'Male', 'Single', '17/02/1990', 'Taofeek Olalekan', '8056681522', '1 Sallam Sallam Street off Olosan Road Ashipa Alakia Isebo Ibadan', '1 Sallam Sallam Street off Olosan Road Ashipa Alakia Isebo Ibadan', 'OND', 'Aroma', 'Aroma Iwo Road', 'Fryer', 'Fryer', '2020-08-15', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '247800025', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(39, '285', 'OGUNDUMILA', 'OLUWAYOMI ', 'SIKEMI', '7014939142', 'ogundumilaoluwayomi@gmail.com', 'Female', 'Single', '', 'Ogundumila Boluwatife', '8063146269', '9 Sekunderin Street SIS Road Three Airport Area Ibadan', '9 Sekunderin Street SIS Road Three Airport Area Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'cook', 'Cook', '2020-10-01', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '247997996', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(40, '287', 'GBADAMOSI', 'RAMON', 'TOPE', '7050908923', 'badmusramontemitope@gmail.com', 'Male', 'Single', '31/01/1998', 'Badmus Taoreed', '8030581939', '11 Alafia Estate Ayetoro Muslim Ibadan', '11 Alafia Estate Ayetoro Muslim Ibadan', 'SSCE', 'Aroma', 'Eleyele', 'Bakery', 'Baker', '2020-10-02', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '249170924', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(41, '312', 'ADEDEJI', 'BUNMI', 'TEMILOLUWA', '9039244065', 'adedejibunmi99@gmail.com', 'Female', 'Single', '26/05/1997', 'Adedeji Oluwapelumi', '9151828814', '14 Osunkunle Street Sawmill Ibadan', '14 Osunkunle Street Sawmill Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '10/02/2021', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '249696846', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(42, '321', 'AJAGBE', 'IDRIS', 'ADEMOLA', '9151819558', 'idrisajagbe9@gmail.com', 'Male', 'Single', '03/03/2002', 'Mrs Ajagbe', '8157595485', '9-10 Osan Best Way Iwo Road Ibadan', '9-10 Osan Best Way Iwo Road Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Fryer', 'Fryer', '2021-03-08', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '249842210', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(43, '322', 'SALAHUDEEN', 'ZAINAB', 'ADEBIMPE', '738757821', 'zpimpesalaudeen@gmail.com', 'Female', 'Married', '', 'Salahudeen Halimah', '8151810369', '513 Orisunmibare Molade Ayegbami Ibadan', '513 Orisunmibare Molade Ayegbami Ibadan', 'OND', 'Aroma', 'Aroma Iwo Road', 'cook', 'Cook', '2021-03-15', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '230103902', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(44, '323', 'OYERINDE', 'ESTHER', 'ADEBUKOLA', '9022993577', 'adebukolaesther324@gmail.com', 'Female', 'Single', '14/03/1992', 'Oyerinde Adesunkanmi', '7042118655', '23 Babanle Oremeji Street Ibadan', '23 Babanle Oremeji Street Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '15/03/2021', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '249725025', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(45, '334', 'LASISI', 'OLALEKAN', 'USMAN', '903793204', 'lasisilekan79@gmail.com', 'Male', 'Single', '28/08/1996', 'Lasisi Elijah', '7039491050', 'Sarunmi Street Alakia Ibadan', 'Sarunmi Street Alakia Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Fryer', 'Fryer', '02/05/2021', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '236135820', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(46, '335', 'HAMZAT', 'ABASS', '', '8060082291', 'bassamzat@gmail.com', 'Male', 'Single', '', 'Adebisi Janet', '8128148674', 'N4/101 Alakia Olosan Ibadan', 'N4/101 Alakia Olosan Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Bakery', 'Baker', '2021-10-05', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '248952244', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(47, '340', 'ADEWOLE ', 'BISOLA', '', '9069688992', 'adewoleabisola22@gmail.com', 'Female', 'Single', '08/05/1997', 'Adewole Afolakemi', '8063328756', '8 Agboola Street Monatan Ibadan', '8 Agboola Street Monatan Ibadan', 'OND', 'Aroma', 'Aroma Iwo Road', 'Cook', 'Cook', '15/06/2021', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '233164995', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(48, '343', 'BABALOLA ', 'OLUSHOLA', 'AFOLABI', '9019190443', 'zacheusayinde30@gmail.com', 'Male', 'Married', '08/08/1984', 'Babalola Deborah', '8164151647', '10 Omolewa Street Olodo Iwo Road Ibadan', '10 Omolewa Street Olodo Iwo Road Ibadan', 'OND', 'Aroma', 'Aroma Iwo Road', 'Fryer', 'Fryer', '2021-06-17', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '251310462', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(49, '392', 'TAJUDEEN', 'AKOREDE', 'ISIAKA', '7040629050', 'awedaakorede317@gmail.com', 'Male', 'Single', '12/06/2000', 'Afeez Isiaka ', '7086612304', 'Orita Challenge Ibadan', 'Orita Challenge Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Pie Xpress', 'Pie xpress', '2021-09-17', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '252394315', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(50, '393', 'OLANIYAN ', 'MUJEEB', 'AYOMIDE', '9152708787', 'olaniyankenymujeeb@gmail.com', 'Male', 'Single', '09/07/2003', 'Olaniyan Mubarak Tolashe', '8148060914', 'E2/922 Alayaki Sogbesan Iwo Road Ibdan', 'E2/922 Alayaki Sogbesan Iwo Road Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Bakery', 'Baker', '2021-10-01', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '252441109', 'B pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(51, '394', 'ADEWALE ', 'STEPHEN', 'ROTIMI', '9157722719', 'mechizedek029@gmail.com', 'Male', 'Single', '20/07/1997', 'Ayodele Deborah', '9128156519', '58 Molade Ori-Asaju Iwo Road Ilorin', '58 Molade Ori-Asaju Iwo Road Ilorin', 'OND', 'Aroma', 'Aroma Iwo Road', 'Fryer', 'Fryer', '2021-10-01', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '252441350', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(52, '395', 'OYEGADE ', 'FUNMILAYO', 'HANNAH', '8140234029', 'oyegadegold@gmail.com', 'Female', 'Single', '07/01/1995', 'Abimbola Oriola', '9157732423', '2 Testing Ground behind Stanbic Bank Idi Ape Ibadan', '2 Testing Ground behind Stanbic Bank Idi Ape Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'cook', 'cook', '2021-10-01', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '252501616', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(53, '419', 'ORIOWO', 'ADESOLA', 'ABIGAEL', '7014313176', 'owoade26@gmail.com', 'Female', 'Single', '', 'Adesola Dorcas', '8020611074', 'Olajumoke Street Oniguguru Iyana Church Ibadan', 'Oke Ifa Onimon Street Iwo Osun', 'NCE', 'Aroma', 'Aroma Iwo Road', 'Kitchen', 'Cook', '2021-12-06', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(54, '420', 'ADEOYE ', 'ADEMOLA', 'OMOBOLAJI', '08164292612', 'adeomoade27@gmail.com', 'male', 'Married', '1985-12-27', 'Adeoye Israel', '', '4 Budale Street Adesola Area Ibadan', '21 Ifeoluwa Road G Iyana Agbala Ibadan', 'NCE', 'Aroma', 'Aroma Iwo Road', 'Pie Xpress', 'Pie xpress', '2021-12-06', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(55, '421', 'AKINTOBI', 'DAMILOLA ', 'OPEYEMI', '9063132935', '', 'Female', 'Single', '08/08/1998', 'Adelani Adefunke', '8065217250', '43 Arulogun Olodo Iwo Road Ibadan', '43 Arulogun Olodo Iwo Road Ibadan', 'NCE', 'Aroma', 'Aroma Iwo Road', 'Cook', 'Cook', '07/12/2021', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(56, '428', 'AKINWUMI', 'OLAIDE', 'SURAJAT', '8100621268', 'akinwunmisurajat@gmail.com', 'Female', 'Single', '03/11/1999', 'Akinwunmi Faosiyat', '8134253489', '47 Balogun Amosun Ibadan', '47 Balogun Amosun Ibadan', 'OND', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2021-11-13', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '0253****34', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(57, '431', 'GBADAMOSI', 'MUYIDEEN', 'KOLAWOLE', '8034239460', '', 'Male', 'Married', '02/05/1974', 'AbdulAzeez Badmus', '8034239460', '41 Alafia Estate Ayetoro Muslim Ibadan', '41 Alafia Estate Ayetoro Muslim Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Account', 'Cashier', '2021-12-06', '1', '60000', 'Executive Officer_2', 'ACCESS BANK', '044', '45063666', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(58, '444', 'AYOBAMI', 'OLAITAN', 'DOLAPO', '9058766790', 'ayobamiolaitan004@gmail.com', 'Female', 'Single', '04/11/1998', 'Ayobami Sekenat', '9055885615', '12 Tose Moniya Ibadan', '12 Tose Moniya Ibadan', 'OND', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '15/10/2021', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '253372572', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(59, '72', 'AGBEJA ', 'JAMIU', '', '8165951636', 'agbejamiu@gmail.com', 'Male', 'Married', '26/06/1993', 'Agbaje Baleeqis', '9064040923', 'B 10 Idi-Ogun Street Ilase Ibadan', '7 Omotara Street Agbowo U.I. Ibadan', 'NCE', 'Aroma', 'Aroma Iwo Road', 'Account', 'Cashier', '2010-11-25', '1', '80000', 'Executive Officer_2', 'ACCESS BANK', '044', '87882273', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(60, '79', 'FRIDAY ', 'HADAMA', 'EMMANUEL', '8059793372', 'hadamaebira73@gmail.com', 'Male', 'Married', '', 'David Hdama', '7058033754', 'N5/358 Yemetu Adabale Omikunle Ibadan', 'N5/358 Yemetu Adabale Omikunle Ibadan', '', 'Aroma', 'Aroma Iwo Road', 'Procurement', 'officer', '2021-10-07', '1', '40000', 'Office Assistant_3', 'KEYSTONE', '', '6031591364', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(61, '53', 'OYINLOLA ', 'TAIYE', '', '8069379788', 'oyin.taye@yahoo.com', 'Female', 'Married', '21/03/1983', 'Ojo Gabriel', '8083969593', '8 Road 2 Adejimi Estate Off Ologuneru Ibadan', '8 Road 2 Adejimi Estate Off Ologuneru Ibadan', 'OND', 'Aroma', 'Aroma Toll-Gate', 'Supervision', 'Manager', '2008-05-01', '1', '135000', 'Senior Executive Assistant_2', 'WEMA', '035', '239194819', 'O pos', '2', '', '', '$2y$10$JEVhTQXlnBTLU0pLLVuFw.nvyLUdDdwkse46AKA.Iq0jj4vQ0/gxO', '1', '', ''),
(62, '54', 'ADEGBOLA', 'BAYONLE ', 'ABAYOMI', '8063694146', 'kingdexterg8@gmail.com', 'Male', 'Married', '20/04/1990', 'Adegbola Fodilat', '8138631834', '4 Zone E Elelu Village Alakia Adegbayi Ibadan', '20 Olofa Street Araromi Area behind IGS Molete Ibadan', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Supervision', 'Manager', '2008-05-11', '1', '135000', 'Senior Executive Assistant_2', 'WEMA', '035', '238992386', 'O pos', '2', '', '', '$2y$10$cfRpVGJ.h5jHjBgnQ4PPeOVzZ/Zx9XaviwRPlPTuT6KQIBsjJTiSK', '1', '', ''),
(63, '60', 'FOWOWE', 'OLANREWAJU', 'JOSEPH', '9052394278', 'babalarry60@gmail.com', 'Male', 'Married', '', 'Fowowe Mary', '9040190632', 'Zone 4 10 Idi Oro Street Oda-Ona Elewe Orita Challenge Ibadan', 'VR 31 Igbaye Street Ilesha Osun', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Supervision', 'supervisor', '2008-08-03', '1', '80000', 'Executive Officer_2', 'WEMA', '035', '239203609', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(64, '64', 'SODIQ ', 'DAUD', 'AYOYUNKU', '8054535450', 'sodiqdaud00@gmail.com', 'Male', 'Married', '20/04/1972', 'Sodiq Saadat', '9152414868', '9 Olohunnisola Akekuta Aba Ada Ayetoro Muslim Area Ibadan', '9 Olohunnisola Akekuta Aba Ada Ayetoro Muslim Area Ibadan', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Supervision', 'Supervisor', '30/03/2009', '1', '60000', 'Executive Officer_2', 'WEMA', '035', '239206882', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(65, '91', 'AFEES ', 'ADIGUN', 'OYEYEMI', '8063890884', 'feescouppy.yafees@yahoo.com', 'male', 'Married', '1986-05-10', 'Adigun Farhan', '8139654039', 'Bello Street Idi Ope Eleyele Ibadan', 'Bello Street Idi Ope Eleyele Ibadan', 'HND', 'Aroma', 'Aroma Toll-Gate', 'Supervision', 'supervisor', '2012-12-16', '1', '80000', 'Senior Office Assistant_4', 'WEMA', '035', '239211183', '1', '2', '1645383185.jpg', 'on', '$2y$10$XlrHHnB8XuOf4WsvJbKnEuPvVdhUa.dEhQLaOjL4S7GXTv4ezyMwq', '1', '', ''),
(66, '119', 'JIMOH', 'KAFAYAT', '', '7069133139', 'kaffyiyawobaba@gmail.com', 'Female', 'Married', '', 'Jimoh Aliya', '', '1 Road 2 Temitope Estate Ibadan', '25 Sawia Olorunsogo Akanran Road Ilorin', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Cook', 'Head', '09/10/2013', '1', '50000', 'Senior Office Assistant_4', 'WEMA', '035', '239194761', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(67, '173', 'ADEBIYI ', 'CAROLINE', 'ODUNAYO', '8165892802', 'nofycarobiyi@gmail.com', 'Female', 'Married', '', 'Oyewale Tobiloba', '9050578050', 'Academy Olomi Ile Sheu Isale Alfa Orelope Ibadan', '5 Isale Alfa Baba Adajo Ibadan', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Supervision', 'supervisor', '2015-06-03', '1', '60000', 'Senior Office Assistant_1', 'WEMA', '035', '239209883', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(68, '263', 'SHAABA ', 'MUDASHIR', 'OLAYINKA', '8162106719', 'shaabaolayinka87@gmail.com', 'Male', 'Married', '06/03/1987', 'Olayinka Faridah', '7067751428', '27 Oke Odo Olosan Alakia Ibadan', '14 Prince Shaaba Street Sawmill Garage Ilorin', 'OND', 'Aroma', 'Aroma Toll-Gate', 'Pie Xpress', 'Pie xpress', '2020-01-11', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '245134641', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(69, '297', 'ADEBODUN ', 'BARAKAT', 'ADEDOJA', '8133825331', 'adebodunfolawemi@gmail.com', 'Female', 'Single', '15/03/1999', 'Adebodun Fola', '7053275792', 'SW4/234 Oke Ado Ibadan', 'SW4/234 Oke Ado Ibadan', 'NCE', 'Aroma', 'Aroma Toll-Gate', 'Cashier', 'Cashier', '2021-01-04', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '248814137', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(70, '324', 'DAVID ', 'ESTHER ', 'ANUOLUWAPOSI', '8155732001', 'davidestherify@gmail.com', 'female', 'Single', '', 'Mary John', '8116118082', '28 Omiyele Moganna Councilor Olomi Ibadan', '28 Omiyele Moganna Councilor Olomi Ibadan', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Host', 'host', '2021-06-01', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '249754603', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(71, '326', 'ADELEYE ', 'ADEDOTUN', 'TEMITAYO', '9016823156', '', 'Male', 'Single', '30/05/1994', 'Adeleye Sunday', '', 'SWS/104 Agbokojo Foko Ibadan', 'SWS/104 Agbokojo Foko Ibadan', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Host', 'Host', '02/04/2021', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '249946235', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(72, '353', 'LAWAL ', 'WARIZ ', 'ADEYEMI', '7017185686', 'lawalwariz405@gmail.com', 'Male', 'Single', '22/04/1999', 'Lawal Idris', '8065741498', '2 Iyonu Oluwa Street Ayegun Ibadab', '2 Iyonu Oluwa Street Ayegun Ibadab', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Pie Xpress', 'Pie xpress', '2021-07-01', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '251406886', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(73, '354', 'KOLAWOLE', 'BISOLA ', 'VICTORIA', '7045216122', 'kolawolebisola192@gmail.com', 'Female', 'Single', '17/09/2000', 'Kolawole Juwon', '8050481766', '2 Zone 2 Onikoko Arobiewe Olodo Ibadan', '2 Zone 2 Onikoko Arobiewe Olodo Ibadan', 'OND', 'Aroma', 'Aroma Toll-Gate', 'Host', 'Host', '05/07/2021', '1', '30000', 'Office Assistant_3', 'WEMA', '035', '251293473', 'B neg', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(74, '356', 'AKANMU', 'WASIU', 'OLAMIDE', '', 'olaakanmuwas@gmail.com', 'Male', 'Single', '', 'Akanmu Tawakalitu', '8103284796', 'S4/2788 Ile Alaasa Wesley Elekuro Ibadan', 'S4/2788 Ile Alaasa Wesley Elekuro Ibadan', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Fryer', 'Fryer', '2021-07-01', '1', '40000', 'Office Assistant_3', 'WEMA', '035', '251407096', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(75, '408', 'ADEBAYO ', 'TUMININUN', 'CHRISTANA', '9153880608', 'porchqueen@gmail.com', 'Female', 'Married', '18/04/1990', 'Adebayo Daniel', '8079405805', '46 Oba Abimbola Layout Felele Challenge Ibadan', '46 Oba Abimbola Layout Felele Challenge Ibadan', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Kitchen', 'Cook', '2021-10-12', '1', '40000', 'Office Assistant_3', 'WEMA', '035', 'O253063315', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(76, '409', 'AKINYELE', 'OLUWASEYI', 'AYOOLA', '8078867633', 'oluwaseyiayooluwa@gmail.com', 'Male', 'Married', '28/03/1985', 'Atinuke Akinyele', '8085267550', '2 Alhaji G.O. Babalola Street Odunlade Mosifala Muslim Ibadan', '2 Alhaji G.O. Babalola Street Odunlade Mosifala Muslim Ibadan', 'OND', 'Aroma', 'Aroma Toll-Gate', 'Fryer', 'Fryer', '2021-11-07', '1', '40000', 'Office Assistant_3', 'WEMA', '035', 'O252986846', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(77, '422', 'TIJANI ', 'IBRAHIM ', 'OPEYEMI', '9055206898', 'ibrahimtijani547@gmail.com', 'Male', 'Single', '10/03/1997', 'Tijani Taofeek O', '8160250699', 'S4/547A Wesley College Road Ibadan', 'S4/547A Wesley College Road Ibadan', 'SSCE', 'Aroma', 'Aroma Toll-Gate', 'Bakery', 'Baker', '2021-12-06', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '253761666', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(78, '423', 'AMWOWENI ', 'KAYODE', 'JAMES', '09091790581', 'jkayode86@gmail.com', 'male', 'Single', '1989-02-28', '', '', '', '', '', 'Aroma', 'Aroma Toll-Gate', 'Fryer', 'Fryer', '2022-01-06', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(79, '240', 'FABIYI ', 'OYENIKE', 'FOLASHADE', '8132209156', 'oyenikefola2015@gmail.com', 'Female', 'Single', '25/04/1994', 'Fabiyi Oyebola', '9075993435', '31 Araromi Agbabiaka Off Upper Gaa Akanbi Ilorin', '31 Araromi Agbabiaka Off Upper Gaa Akanbi Ilorin', 'OND', 'Aroma', 'Aroma Unity', 'Kitchen', 'Cook', '2019-07-17', '1', '45000', 'Senior Office Assistant_1', 'WEMA ', '035', '243462241', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(80, '241', 'ABOLARINWA ', 'SAMSONDEEN ', 'AKINTUNDE', '8062228142', 'aakintundesamsondeen97@yahoo.com', 'Male', 'Married', '15/06/1986', 'Abolarinwa Kabir', '7039188201', '81 Ita Amodu Road Ilorin', '81 Ita Amodu Road Ilorin', 'HND', 'Aroma', 'Aroma Unity', 'Pie Xpress', 'Pie xpress', '2019-07-17', '1', '45000', 'Senior Office Assistant_1', 'WEMA ', '035', '243454774', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(81, '243', 'OYEDELE', 'FERANMI ', 'TOYIN', '8139760369', 'oyedeleferanmi169@gmail.com', 'Male', 'Married', '07/07/1992', 'Oyedele Opeyemi Funmilayo', '7069044120', 'Flat 3 Behind Alafia Oluwa Baptist Church Osere Ilorin', 'Flat 3 Behind Alafia Oluwa Baptist Church Osere Ilorin', 'OND', 'Aroma', 'Aroma Unity', 'Host', 'host', '2019-07-18', '1', '45000', 'Senior Office Assistant_1', 'WEMA ', '035', '243483194', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(82, '268', 'ISSA ', 'OLUWASEMILORE ', 'AISHA', '8087246345', 'agboolaoluwasemilore112@gmail.com', 'Female', 'Single', '08/08/2001', 'Mrs Issa Medinat', '8062526553', '8 Aduagba Street Danialu Gaa-Akanbi Ilorin', '8 Aduagba Street Danialu Gaa-Akanbi Ilorin', 'SSCE', 'Aroma', 'Aroma A Division', 'Fryer', 'Fryer', '2021-02-11', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '249067002', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(83, '283', 'OKUNLOLA', 'TOLULOPE ', 'BUKOLA', '9039043691', 'oluwanifemi60@gmail.com', 'Female', 'Single', '06/04/1993', 'Okunlola  Toyin', '8156782132', 'Taiwo Oke Ilorin', 'Arogun\'s Compound Okuku Osun', 'SSCE', 'Aroma', 'Aroma A Division', 'Kitchen', 'Cook', '2020-09-15', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '231630083', 'O neg', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(84, '261', 'SALIMAN ', 'FALILAT ', 'OMOBOLANLE', '9085212101', 'salmanfalilat@gmail.com', 'Female', 'Married', '19/03/1996', 'Salman Faridah', '', '7 Fagba Compound Emir\'s Palace Ilorin', '35 Ita Alamu Ilorin', 'NCE', 'Aroma', 'Aroma Unity', 'Supervision', 'supervisor', '2019-12-25', '1', '60000', 'Senior Office Assistant_1', 'WEMA ', '035', '237141015', 'O neg', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(85, '43', 'ADEBAYO ', 'AKEEM', 'OLUWAFUNMINIYI', '7035418263', 'adebayoakeem41@gmail.com', 'Male', 'Married', '17/11/1982', 'AbdulAkeem Risikat', '9028077340', '40 Kotagora Street Stadium Road Ilorin', '40 Kotagora Street Stadium Road Ilorin', 'OND', 'Aroma', 'Ibadan (Iwo Road)', 'Supervision', 'Manager', '2005-06-05', '1', '135000', 'Senior Executive Assistant_2', 'WEMA ', '035', '239286015', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(86, '70', 'YISA ', 'ABIODUN', 'MONSURU', '7036592752', 'yabiodun24@gmail.com', 'Male', 'Married', '18/05/1988', 'Yisa Oluwakemi', '8166776309', '27B Ikoyi Community behind Busary Alao College off Yidi Road Ilorin', '4 Road D Lamo Street Alakia Ibadan', 'HND', 'Aroma', 'Aroma A Division', 'Supervision', 'supervisor', '2010-08-07', '1', '80000', 'Executive Officer_2', 'WEMA ', '035', '0271228569', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(87, '184', 'SHITTU', 'FADILULAHI', 'OLAWALE', '8101160424', 'shittuolawale@gmail.com', 'Male', 'Single', '20/06/1997', 'Shittu Bola', '8110965337', '48 Harau Akande Street Orita Challenge Ibadan', '48 Harau Akande Street Orita Challenge Ibadan', 'SSCE', 'Aroma', 'Aroma Unity', 'Supervision', 'supervisor', '2015-12-01', '1', '80000', 'Executive Officer_2', 'WEMA ', '035', '239198398', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(88, '199', 'LASISI ', 'TEMILOLU ', 'OLUWASEUN', '8165383700', 'lasisiproftemilolu@gmail.com', 'Male', 'Single', '28/07/1993', 'Lasisi Tobi', '8124314306', '13 Elewi Odo Iwo Road Ibadan', '13 Elewi Odo Iwo Road Ibadan', 'NCE', 'Aroma', 'Aroma Unity', 'Supervision', 'Assistant Manager', '2016-07-15', '1', '100000', 'Executive Assistant_2', 'WEMA', '035', '239188298', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(89, '207', 'OLADEJO ', 'OLAKUNLE ', 'DAMOLA', '7036190262', 'ojaybaba709@gmail.com', 'Male', 'Single', '02/01/1992', 'Oladejo Rebbeca', '7050776257', '10 Irewolede street Powerline Ilorin', '10 Irewolede street Powerline Ilorin', 'SSCE', 'Aroma', 'Aroma A Division', 'Supervision', 'supervisor', '2016-06-04', '1', '80000', 'Executive Officer_2', 'WEMA ', '035', '239196590', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(90, '221', 'ABDULLAHI ', 'BILIKIS ', 'OLAITAN', '7033721472', 'olaitan1@gmail.com', 'Male', 'Married', '15/12/2009', 'Abdullahi Hakeem', '8035371976', '10 Masalasi Street Osere Ilorin', '10 Masalasi Street Osere Ilorin', 'B.Sc', 'Aroma', 'Aroma Unity', 'Supervision', 'supervisor', '2018-09-01', '1', '80000', 'Executive Officer_2', 'WEMA ', '035', '241047844', 'B pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(91, '229', 'ABDULRAHEEM ', 'TAIWO', 'M', '8100326302', 'raheemtm25@gmail.com', 'Male', 'Married', '', 'AbdulRaheem Kehinde', '7033840753', '56 Ayetoro Asa Dam Area Ilorin', 'Oke Ogi Compound Iree Osun', 'NCE', 'Aroma', 'Aroma Unity', 'Supervision', 'supervisor', '2019-04-27', '1', '80000', 'Senior Office Assistant_1', 'WEMA ', '035', '246631233', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(92, '239', 'TAOFEQ ', 'ABDULQOWIYU ', 'OLALEKAN', '8101189942', 'horlalekantaofeeq20@gmail.com', 'Male', 'Married', '20/06/1995', 'Taofeeq AbdulQuadri', '7069006662', 'Kinlanko Offa Garage Area Ilorin', 'Kinlanko Offa Garage Area Ilorin', 'OND', 'Aroma', 'Unity', 'Fryer', 'Fryer', '17/07/2019', '1', '35000', 'Senior Office Assistant_1', 'WEMA ', '035', '243454712', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(93, '242', 'AWOYELE ', 'HOPE ', 'BOLUWATIFE', '8164864878', 'awoyele1234@gmail.com', 'Female', 'Single', '08/01/1997', 'Awoyele Joseph Oluwakayode', '8039425518', 'Opposite Estate Junction Kilanko Road off Offa Garage Ilorin', 'Opposite Estate Junction Kilanko Road off Offa Garage Ilorin', 'OND', 'Aroma', 'Aroma Unity', 'Kitchen', 'Cook', '2019-07-18', '1', '45000', 'Senior Office Assistant_1', 'WEMA ', '035', '243454815', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(94, '244', 'ABDULAZEEZ ', 'ABDULLAHI', 'DAHOOD', '7013517019', 'oluwaseunabdul2017@gmail.com', 'Male', 'Single', '03/12/1998', 'Dauda Ramat', '8060058940', 'J Harmony Community Danialu Gaa-Akanbi Ilorin', 'J Harmony Community Danialu Gaa-Akanbi Ilorin', 'OND', 'Aroma', 'Aroma Unity', 'Cashier', 'Cashier', '2019-07-18', '1', '45000', 'Senior Office Assistant_1', 'WEMA ', '035', '243454918', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(95, '273', 'BELLO', 'KABIR', 'L', '7061342793', 'kabirbello102@gmail.com', 'Male', 'Single', '', 'Bello Ariyike', '', '5 Agbo Street Fate Ilorin', 'Aduubo Street Iragbiji Osun', 'SSCE', 'Aroma', 'Aroma Unity', 'Host', 'host', '2020-06-03', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '246619280', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(96, '291', 'ADEPOJU', 'ISIAQ', 'ABOLAKALE', '8066804349', 'easyvilla072@gmail.com', 'Male', 'Married', '30/05/1993', 'Adepoju AbdulHakeem K.', '8060212636', '52 Akalambi Sobi Road Ilorin', '52 Akalambi Sobi Road Ilorin', 'HND', 'Aroma', 'Aroma Unity', 'Bakery', 'Baker', '2020-10-17', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '247576546', 'A pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(97, '302', 'POPOOLA', 'ABISOLA ', 'AYOMIDE', '8165048162', '', 'Female', 'Single', '14/02/2000', 'Popoola Ronke', '7012636597', '7 Sango Road Ilorin', '7 Sango Road Ilorin', 'SSCE', 'Aroma', 'Unity', 'Cook', 'Cook', '08/01/2021', '1', '30000', 'Office Assistant_3', 'WEMA ', '035', '249003198', 'B pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(98, '303', 'SAHEED ', 'AHMED ', 'OLAREWAJU', '8136634614', 'horlarahmad1@gmail.com', 'Male', 'Single', '26/12/2000', '', '7063879519', '42 Ile Imam Compound Ita Adu Gambari Area Ilorin', '42 Ile Imam Compound Ita Adu Gambari Area Ilorin', 'SSCE', 'Aroma', 'Aroma Unity', 'Fryer', 'Fryer', '2021-01-08', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '249027530', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(99, '305', 'ISSA', 'ABDULFATAI ', 'ABOLAJI', '7039026259', 'abolajiaja13@gmail.com', 'Male', 'Married', '14/02/1990', 'Issa Sulaiman Aihibi', '9029527947', '3 Agunko Compound Pakata Area Ilorin', '3 Agunko Compound Pakata Area Ilorin', 'OND', 'Aroma', 'Aroma Unity', 'Bakery', 'Baker', '2021-01-15', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '251506085', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(100, '306', 'ADEBAYO', 'MURITALA', 'OLAITAN', '8060026767', 'muritalaadebayo1@gmail.com', 'Male', 'Married', '15/09/1985', 'Adebayo Wasiu', '7039024380', '25 Kaba Road Lanjorin Street Sabo Oke', '25 Kaba Road Lanjorin Street Sabo Oke', 'OND', 'Aroma', 'Aroma Unity', 'Pie Xpress', 'Pie xpress', '2021-01-17', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '249005336', 'O neg', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(101, '307', 'ABUBAKAR ', 'MARIAM ', 'JUMAI', '8148359222', 'tapajumaima@gmail.com', 'Female', 'Single', '', 'Abubakar Ramat', '8103532083', '8 Adualere Street Ilorin', '8 Adualere Street Ilorin', 'SSCE', 'Aroma', 'Aroma A Division', 'cook', 'Cook', '2021-01-17', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '248989093', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(102, '311', 'TIAMIYU', 'MUJEEB', 'AYANFE', '8036544391', 'tiamiyumujeeb04@gmail.com', 'Male', 'Married', '20/09/1990', 'Tijani Mariam', '8143564343', 'Opposite NUT Office Asa Dam Ilorin', 'Masifa Road Oke Oyo Ejigbo Osun', 'HND', 'Aroma', 'Aroma Unity', 'Pie Xpress', 'Pie xpress', '2021-02-08', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '249005635', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(103, '313', 'ADEDOSU ', 'MATHIAS', 'SANJO', '7035176602', 'sanjodosu82@gmail.com', 'Male', 'Married', '', 'Adedosu Alex', '8065036135', 'Olohunsogo Amoyo Ilorin', 'Ojomu\'s Compound Ijabe Osun', '', 'Aroma', 'Aroma A Division', 'Fryer', 'Fryer', '2021-02-14', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '249049617', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(104, '327', 'ABDULQUADRI ', 'KABIRAT', 'HADI', '9030456573', 'caddiva@gmail.com', 'Female', 'Single', '28/04/1999', '', '8168112135', 'Eleko Along Poly Road Ilorin', 'Eleko Along Poly Road Ilorin', 'SSCE', 'Aroma', 'Aroma A Division', 'Cashier', 'Cashier', '2021-04-04', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '249655418', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(105, '339', 'HUNGBEME ', 'SENAYON', 'RACHEAL', '7062181307', 'shenayonrashy@gmailcom', 'Female', 'Single', '07/01/1987', 'Hungbeme Ponhemi', '8030426808', '4 Niger Road Ilorin', '4 Niger Road Ilorin', 'OND', 'Aroma', 'Aroma A Division', 'cook', 'cook', '15/06/2021', '1', '30000', 'Office Assistant_3', 'WEMA ', '035', '251015781', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '');
INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `last_name`, `other_name`, `phone`, `email`, `gender`, `marital_status`, `dob`, `kin_name`, `kin_phone`, `present_add`, `permanent_add`, `highest_qualification`, `company`, `branch`, `department`, `job_title`, `date_employed`, `employment_type`, `present_salary`, `grade_step`, `bank_name`, `bank_code`, `account_number`, `blood_group`, `company_id`, `photo`, `notification`, `hashed_password`, `update_profile`, `created_at`, `deleted`) VALUES
(106, '346', 'OKUNOLA ', 'AYODELE ', 'EMMANUEL', '8068484333', 'okunayodele74@gmail.com', 'Male', 'Married', '02/06/1986', 'Okunola Taiye', '8165780286', '22 Ajobi Ojuaran Street Egbejila Area Airport Ilorin', '22 Ajobi Ojuaran Street Egbejila Area Airport Ilorin', 'NCE', 'Aroma', 'Aroma Unity', 'Bakery', 'Baker', '2021-07-07', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '251506085', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(107, '348', 'ABILORO ', 'SEYI', 'BLESSING', '8072138980', 'blessing11@gmail.com', 'Female', 'Married', '01/08/1990', 'Eruese Samuel', '9071449898', '71 Osin Kawu off Asa Dam Ilorin', '71 Osin Kawu off Asa Dam Ilorin', 'NCE', 'Aroma', 'Aroma Unity', 'cook', 'Cook', '2021-07-07', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '251983446', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(108, '349', 'OMOWUMI ', 'SHINA', '', '9034012181', 'oluwashinaomowumi2020@gmail.com', 'Male', 'Single', '04/05/1990', 'Samuel Omowumi', '8037420166', '22 Tinu Street Akerebiata Area Ilorin', '22 Tinu Street Akerebiata Area Ilorin', 'OND', 'Aroma', 'Aroma Unity', 'Pie Xpress', 'Pie xpress', '2021-07-08', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '251581804', 'O neg', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(109, '350', 'ABUBAKAR', 'HAWAU ', 'OMOTAYO', '8035442470', 'hawauomotayo907@gmail.com', 'Female', 'Single', '29/09/2000', 'Faruq Bolaji', '8023700043', '13 Balogun Fulani Ilorin', '20 Gbodofu Compound Ilorin', 'SSCE', 'Aroma', 'Aroma Unity', 'Cashier', 'Cashier', '2021-07-08', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '251642552', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(110, '383', 'SANNI ', 'STEPHEN ', 'SUNDAY', '8177191217', 'sansunny@yahoo.com', 'Male', 'Married', '04/12/1981', 'Oluwafunmito Opeyemi Sanni', '8146039412', '13 Iino Street Offa Garage Ilorin', '37 Opposite New Bathel Church Kangu Aararomi Olunlade Ilorin', 'HND', 'Aroma', 'Aroma Unity', 'Bakery', 'Baker', '2021-08-16', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '251576125', 'A pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(111, '384', 'ABUBAKAR', 'NOIMOT', 'FOLASHADE', '7047615863', 'noimatfolashade28@gmail.com', 'Female', 'Single', '20/06/1995', 'Alhaji Hassan Yusuf Alabi', '8060757608', '147 Oloye Street Ilorin', '147 Oloye Street Ilorin', 'NCE', 'Aroma', 'Aroma Unity', 'Cashier', 'Cashier', '2021-10-01', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '252307519', 'A pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(112, '385', 'AFOLABI', 'MUSBAU ', 'ADEMOLA', '7065347702', 'afolabimusbau7702@gmail.com', 'Female', 'Single', '02/04/1992', 'Farouk Sakiru', '8066091440', '40 Niger Road Sakamoh Ilorin', '40 Niger Road Sakamoh Ilorin', 'HND', 'Aroma', 'Aroma A Division', 'Host', 'host', '2021-09-15', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '252201349', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(113, '391', 'ABDULSALAM', 'QUDIRAT', 'OJUOLAPE', '8133353190', 'qudrohabdulsalam@gmail.com', 'Female', 'Single', '13/03/1998', 'Neemot AbdulSalam', '8033452255', 'Kara Laregada Alagbade Mountain View Ilorin', 'Kara Laregada Alagbade Mountain View Ilorin', 'SSCE', 'Aroma', 'Aroma A Division', 'cook', 'cook', '2021-09-02', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '252594407', 'A pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(114, '398', 'IBRAHIM', 'WASIU', 'ADEBOLA', '8061621764', 'wasiuibrahim146@gmail.com', 'Male', 'Married', '11/02/1987', 'Ibrahim Fatimoh', '8130269461', '11 Sakamo Street Niger Road Ilorin', '26 Alomalaya Powerline Ganmo', 'HND', 'Aroma', 'Aroma Unity', 'Supervision', 'Manager', '2021-11-01', '1', '', '', '', '', '', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(115, '410', 'BELLO ', 'MISTURAH', 'ORIYOMI', '9039000285', 'bellomisturahoriyomi@gmail.com', 'Female', 'Single', '05/06/1999', 'Bello Fatimoh Ajibola', '9039000285', '120 Isokan Community Agbo Danualu Ilorin', '120 Isokan Community Agbo Danualu Ilorin', 'OND', 'Aroma', 'Aroma Unity', 'Cashier', 'Cashier', '2021-12-01', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '253587116', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(116, '411', 'ELEMOSHO ', 'BALIKIS', 'BOLAKALE', '7014754825', 'balikiselemosho90@gmail.com', 'Female', 'Single', '12/12/1996', 'Elemosho Malik', '8141303240', '14 Ibrahim Taiwo Road Ilorin', '14 Ibrahim Taiwo Road Ilorin', 'SSCE', 'Aroma', 'Aroma Unity', 'Bakery', 'Baker', '2021-12-01', '1', '45000', 'Office Assistant_4', 'WEMA ', '035', '248669162', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(117, '416', 'ADEYEYE', 'OLOLADE ', 'GRACE', '7034810254', 'adeyeyeololadegrace@gmail.com', 'Female', 'Single', '02/10/2001', 'Adeyeye Afolake', '7015670921', 'Phase 2 Mushin opposite Lahola Street Maraba Area Ilorin', 'Phase 2 Mushin opposite Lahola Street Maraba Area Ilorin', 'OND', 'Aroma', 'Unity', 'Cashier', 'Cashier', '01/12/2021', '1', '30000', 'Office Assistant_3', 'WEMA ', '035', '253818814', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(118, '417', 'ADEDIRAN', ' ASISAT', '', '9055012999', 'asisatadediran115@gmail.com', 'Female', 'Single', '28/10/1997', 'Awojide Omolade Asiata', '8036013535', 'Zone 4 102 Osere Area Ilorin', 'Zone 4 102 Osere Area Ilorin', 'OND', 'Aroma', 'Aroma A Division', 'Cashier', 'Cashier', '2021-12-06', '1', '40000', 'Office Assistant_3', 'WEMA ', '035', '253717625', 'B', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(119, '429', 'JAMIU ', 'TAOFEEK', 'OLANREWAJU', '7048354529', 'jamiutaofeek2@gmail.com', 'Male', 'Single', '04/04/1997', 'Ishola Fatimoh', '8067640784', '25 Edun Street Ilorin', '25 Edun Street Ilorin', 'SSCE', 'Aroma', 'Unity', 'Bakery', 'Baker', '20/12/2021', '1', '30000', 'Office Assistant_3', 'WEMA ', '035', '253862422', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(120, '430', 'OLATIDE ', 'ABIOLA ', 'OLAWUMI', '8163830575', 'abiolaolatide@gmail.com', 'Female', 'Widow', '12/01/1991', 'Abikoye David Olatomiwa', '8065038351', '', 'Opposite Alkad Filling Station Apata Eiyekorin', 'OND', 'Aroma', 'Aroma Unity', 'cook', 'Cook', '2021-12-31', '1', '40000', 'Office Assistant_3', '', '', '', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(121, '442', 'OLUFEMI', 'OLUWAJUWONLO', 'ADENIKE', '07026569145', 'olufemiadenike293@gmail.com', 'female', 'Single', '1997-05-27', 'Feyintola Rowland', '07026140938', 'The Johnson\'s Elekoyogon Area Ilorin\r\n', 'TITCOMBE College Egbe Kogi\r\n', '', 'Aroma', 'Aroma A Division', 'Cashier', 'Cashier', '2022-01-09', '1', '40000', '', '', '', '', '3', '2', '', 'on', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(122, '30', 'ABDULSALAM ', 'AKEEM', '', '7035721131', 'obaakeem1@gmail.com', 'Male', 'Married', '', 'AbdulSalam Rukayat', '7037092114', '24 Ganmo Area Ilorin', '24 Ganmo Area Ilorin', 'NCE', 'Aroma', 'Aroma A Division', 'Procurement', 'Manager', '2003-05-18', '1', '135000', 'Senior Executive Assistant_2', 'ACCESS BANK', '044', '20780702', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(123, '15', 'GBADAMOSI', 'TAOFEEK', 'KOLAWOLE', '8035070538', 'kolabadmus02@gmail.com', 'Male', 'Married', '13/03/1976', 'Mrs Gbadamosi', '8105772867', '17 Idi egun Community offa Garage Ilorin', '17 Idi egun community offa Garage Ilorin', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Supervision', 'Manager', '01/12/1996', '1', '', '', 'ACCESS BANK', '044', '439237110', '', '', '', '', '$2y$10$qiVj.9L1cICCEeTFykKGGOpulhTplRpZc9yYej6LCJvGPl/bdOl9O', '1', '', ''),
(124, '19', 'ABDULAZEEZ ', 'ADEBAYO ', 'ABDULWAHEED', '8139623630', 'azeezwaheed31@gmail.com', 'Male', 'Married', '15/01/1979', 'Habeeblahi Abdulazeez', '8131831922', '5 Aiyeloja Central Mosque Osere Okoerin Ilorin', '5 Aiyeloja Central Mosque Osere Okoerin Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'roll forming', 'parking', '1999-10-19', '1', '85000', 'Executive Officer_3', 'FIDELITY ', '70', '6322430591', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(125, '22', 'AYINLA ', 'JAMIU', 'ABIMBOLA', '8032460889', 'ayinlajamiu5@yahoo.com', 'Male', 'Married', '15/09/1978', 'Shaibu Ayinla', '9135024640', '32 Alalubusa Street Muraba Ilorin', '10 Labaika Road Ikirun Osun', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'corrugating', 'corrugating', '2000-10-14', '1', '85000', 'Executive Officer_3', 'FIDELITY', '70', '5333347993', 'A pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(126, '25', 'OGUNSHOLA', 'OLURANTI', 'RAPHEAL', '7061030114', 'rantiogunshola78@gmail.com', 'Male', 'Married', '', 'Olutunde Precious', '8140291358', '13 Baba-Ode Layout Ilorin ', '13 Baba-Ode Layout Ilorin ', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'roll forming', 'Manager', '2001-08-03', '1', '210000', 'Manager_2', 'FIDELITY', '70', '5333323252', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(127, '35', 'RABIU', 'MUYIDEEN', '', '8142618992', 'muyideenrabiu236@gmail.com', 'Male', 'Married', '16/02/1981', 'Rabiu Mujidat', '9016663570', '7 Fagba Compound Ilorin', '7 Fagba Compound Ilorin', 'NCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'packing', '2015-04-06', '1', '70000', 'Senior Officer Assistant', 'ACCESS BANK', '044', '1499097904', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(128, '69', 'ABUBAKAR ', 'ADEJARE', 'MUIDEEN', '8035824432', 'muideenadejare90@gmail.com', 'Male', 'Married', '15/08/1990', 'Abubakar Halimat', '7037197002', '20 Sapati Street Ilorin', '20 Surulere Sapati Street Ilorin', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Maintenance', 'officer', '2010-06-25', '1', '95000', 'Executive Assistant_1', 'FIDELITY BANK', '', '6322495251', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(129, '75', 'GARUBA ', 'HAMMED', '', '8139683320', 'amoduhammed@gmail.com', 'Male', 'Married', '', 'Jamiu Oladimeji', '8144437189', '54 Ile Oladimeji Kankatu Ilorin', '54 Ile Oladimeji Kankatu Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Supervision', 'supervisor', '2006-03-05', '1', '65000', 'Senior Officer Assistant_3', 'ACCESS BANK', '044', '1498880022', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(130, '80', 'ABDULRASHEED ', 'HAFEEZ', 'OLAITAN', '7036049690', 'abdulrasheedolaitan62@gmail.com', 'Male', 'Married', '11/01/1987', 'AbdulRasheed Khaleed', '9067585155', '7 Fagba Compound Ilorin', '7 Fagba Compound Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'CRM Operation', 'roll grinder', '2011-10-20', '1', '90000', 'Executive Officer_2', 'ACCESS BANK', '044', '6238871721', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(131, '81', 'ABDULRASHEED ', 'LUKMAN', 'OLATUNBOSUN', '9084974179', 'tessyolatunbosuna@gmail.com', 'Male', 'Married', '20/07/1983', 'AbdulRasheed AbdulMalik', '8119566862', '7 Fagba Compound Ilorin', '7 Fagba Compound Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Procurement', 'officer', '2010-06-30', '1', '90000', 'Executive Officer_4', 'FIDELITY', '70', '6238871721', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(132, '83', 'YEKINI ', 'AFEEZ', '', '8032980708', '', 'Male', 'Married', '03/01/1990', 'Yekini Debora', '9031359883', '23 Ose Olorun Street off Asa Dam Road', '23 Ose Olorun Street off Asa Dam Road', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Corrugation', 'Officer', '01/05/2014', '1', '50000', 'Senior Office Assistant_4', 'ECO', '050', '4250002668', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(133, '84', 'OKORO ', 'ONORIEVAOGHENE', 'JAMES', '8028416936', 'okorojames326@gmail.com', 'Male', 'Married', '29/04/1980', 'James Rebecca', '9063617394', '12 Taiye-Kehinde Street Sawmill Ilorin', '12 Taiye-Kehinde Street Sawmill Ilorin', 'NABTEB', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Electrical', 'Manager', '2012-02-01', '1', '162500', 'Assistant Manager_4', 'UBA', '033', '2014084041', 'O neg', '3', '', '', '$2y$10$9kznFLuWT7qqyy9J1sfsX.KLu.syMMYVn009qvIXCobWGM3rFNiY2', '1', '', ''),
(134, '86', 'OLALERE', 'WAHEED', 'AYINLA', '8142685357', 'ayinlalere73@gmail.com', 'Male', 'Married', '', 'Ayinla Mistura ', '8134366003', '10 Tinu Street Akerebiata Ilorin', '10 Tinu Street Akerebiata Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Sharing operator', '2012-06-11', '1', '95000', 'Executive Assistant_1', 'FIRST ', '', '3118099395', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(135, '88', 'ABDULKAREEM ', 'TAJUDDEN', '', '8107722753', '', 'Male', 'Married', '13/02/1976', 'Oyebola Maryam', '8107722194', '73 Oke kudu Airport Area Ilorin', '73 Oke kudu Airport Area Ilorin', 'NCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill', 'Celler Operator', '13/08/2012', '1', '65000', 'Executive Officer_3', 'ACCESS BANK', '044', '1499068546', 'B', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(136, '95', 'BELLO', 'KAZEEM', 'ATANDA', '815067594', 'atandabello80@gmail.com', 'Male', 'Married', '', 'Bello Sukurat', '8130684751', '5 Olabisi Street Joro Asa Dam Ilorin', '5 Olabisi Street Joro Asa Dam Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'roll forming', 'operator', '2013-02-13', '1', '75000', 'Executive Officer_1', 'UBA', '033', '2106248085', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(137, '96', 'AJIDE', 'BISI', 'JONATHAN', '8163961450', 'ajidebisi123@yahoo.com', 'Male', 'Married', '15/08/1964', 'Ajide Michael Oluwatosin', '9134058772', 'A21 Opeyemi Street Sawmill Area Ilorin', 'A21 Opeyemi Street Sawmill Area Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'corrugating', 'operator', '2013-02-13', '1', '85000', 'Executive Officer_3', 'ACCESS BANK', '044', '1499457599', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(138, '98', 'JETHRO ', 'LAZARUS', '', '8023475178', 'jethrolaz70@gmail.com', 'Male', 'Married', '', 'Jethro Maidadiya', '8141227362', 'Odota Airport Road Ilorin', 'Odota Airport Road Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'furnance', 'Assistant Manager', '2013-05-26', '1', '120000', 'Senior Executive Assistant _3', 'ACCESS BANK', '044', '1499771394', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(139, '102', 'EDWARD ', 'DANIEL', '', '9080576787', 'eddan12@gmail.com', 'Male', 'Married', '', 'Emmanuel Edward', '812318384', 'Balogun Street Egbejila Airport Area Ilorin', 'Balogun Street Egbejila Airport Area Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'entry operator', '2013-06-30', '1', '95000', 'Executive Assistant_1', 'ACCESS BANK', '044', '1503676088', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(140, '103', 'UMARU ', 'AZEEZ', '', '8132913426', '', 'Male', 'Married', '21/02/1983', 'Umaru Waliyu', '8135181310', '26 Agoji Ogale Eyen Koren Ilorin', '26 Agoji Ogale Eyen Koren Ilorin', 'FLSC', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Furnace', 'Operator', '13/07/2013', '1', '65000', 'Senior Officer_3', 'ACCESS BANK', '044', '1504695525', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(141, '104', 'ADEMILOLA ', 'TUNDE', 'EMMANUEL', '8051934882', 'tundeademilolatayo@gmail.com', 'Male', 'Married', '15/12/1985', 'Ademilola Samuel', '814120787', '266 Umaru Saro Road Sawmill Ilorin', '266 Umaru Saro Road Sawmill Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'officer', '2013-07-13', '1', '90000', 'Senior Officer_3', 'FIDELITY', '70', '3047124876', 'A pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(142, '110', 'AMANKWU', 'JOHN', 'OYICHI', '8060254052', 'oyichijohn84@gmail.com', 'Male', 'Married', '', 'Amankwu Success', '', '53 Ayetoro Street Asa Dam Ilorin', '53 Ayetoro Street Asa Dam Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Trimming Officer', '2013-08-21', '1', '100000', 'Executive Assistant_2', 'ACCESS BANK', '044', '1499018211', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(143, '111', 'BABATUNDE ', 'AFOLABI ', 'KOLADE', '7065347046', 'afolabibabatunde652@gmail.com', 'Male', 'Married', '23/03/1986', 'Afolabi Kehinde', '8143193515', '6 Yaru House Ayetoro Area Ilorin', '6 Yaru House Ayetoro Area Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Colourline', 'Coater operator', '2013-08-26', '1', '100000', 'Executive Assistant_2', 'ACCESS BANK', '044', '1505738799', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(144, '112', 'LAWAL', 'ABDULRASHEED', 'WOLE', '8164560219', 'egbonwoleebile@gmail.com', 'Male', 'Married', '', 'Lawal Halimat Bolanle', '8121659536', '34 Ayegbami Street Osere Area Ilorin', '10 Araromi Street Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'packing', '2013-08-27', '1', '100000', 'Executive Assistant_2', 'ACCESS BANK', '044', '1505571376', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(145, '113', 'ADEBISI ', 'TAIWO', 'ADEBISI ', '8062989582', 'adeomomejiabdul@gmail.com', 'Male', 'Married', '', 'Dauda Naimot', '7062767244', '35 Egbejila Road Ilorin', '5 Oduore Street off Airport Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'packing', '2013-08-27', '1', '95000', 'Executive Assistant_1', 'ACCESS BANK', '044', '1501303865', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(146, '114', 'ADEBOWALE ', 'ADENIYI ', 'JOSEPH', '813805491', 'adebowaleadeniyijoseph@gmail.com', 'Male', 'Married', '24/12/1980', 'Kehinde Omotayo Moses', '7033846255', '28 Oremeji Street opposite Irewolede Asa Dam Ilorin', 'A49 Jooro Asa Dam Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Colourline', 'Coater operator', '2013-09-03', '1', '100000', 'Executive Assistant_2', 'ZENITH', '057', '2123048103', 'O', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(147, '115', 'ONIFADE ', 'ISMAIL', '', '7037746879', 'onysma09@gmail.com', 'Male', 'Married', '', 'Onifade Fauzan', '8136004214', '5 Ajibade Igosun Street Asa Dam Ilorin', '5 Ajibade Igosun Street Asa Dam Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'corrugating', 'Assistant Manager', '2013-09-03', '1', '100000', 'Executive Assistant_2', 'FIDELITY', '70', '5333338838', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(148, '116', 'SUNDAY ', 'MARTINS', '', '8137747585', 'martinss@gmail.com', 'Male', 'Married', '', 'Samuel Sunday', '', '78 Jooro Street off Asa Dam Road Ilorin', '36 Tunla Street Aina Ijebu Ogun', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'corrugating', 'operator', '2013-10-08', '1', '85000', 'Executive Officer_3', 'ACCESS BANK', '044', '77146440', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(149, '117', 'AYUBA ', 'IDRIS', 'SAIEDU', '8141641365', 'ayubaidris18@gmail.com', 'Male', 'Married', '15/04/1990', 'Sadam Idris', '', '21 Oko Ode Street Ayetoro Road Asa Dam Ilorin', '17 Mobolaji Street Aladoyinbo opposite Afeez Busstop Lagos', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'furnance', 'officer', '2013-09-18', '1', '95000', 'Executive Assistant_1', 'ACCESS BANK', '044', '1505650361', 'B pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(150, '120', 'ADEKUNLE ', 'ABDULJELILI', 'ABIODUN', '8036443978', 'abbeydseniorman@gmail.com', 'Male', 'Married', '', 'AbdulMalik Adekunle', '8187092191', 'Opposite Butterfield Bakery Jooro Village', 'Opposite Butterfield Bakery Jooro Village', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'online sharing', '2013-10-10', '1', '85000', 'Executive Officer_3', 'FIDELITY', '70', '6323219326', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(151, '121', 'ADEOSUN ', 'BABATUNDE', 'SEYI', '9032121746', 'seyitundeiadeosun@gmail.com', 'Male', 'Married', '', 'Adeosun Omolola', '8100791509', 'Oko Ode Odota Area Ilorin', '10 Ayie Toro Oketa Ogun', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'packing', '2013-10-13', '1', '85000', 'Executive Officer_3', 'ACCESS BANK', '044', '1500986021', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(152, '122', 'AGBAJE ', 'OJO', 'SUNDAY', '8035384337', 'agbajeojosunday@gmail.com', 'Male', 'Married', '22/12/1987', 'Agbaje Ige', '8030775637', 'Adeniyi House Egbejila Road Off Airport Road Ilorin', '22 Eku Quarter Ibillo Akoko Edo', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'Exit officer', '2013-11-13', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '1498860877', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(153, '123', 'ABIOLA ', 'JEREMIAH ', 'MACAULAY', '9075075713', 'jamacaulay01@gmail.com', 'Male', 'Married', '', 'Macaulay Mary', '8134537281', '105 Temidire Irewolede off New Yidi Road Ilorin', '105 Temidire Irewolede off New Yidi Road Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'corrugating', 'operator', '2013-09-13', '1', '95000', 'Executive Assistant_1', 'ACCESS BANK', '044', '5333320756', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(154, '124', 'ADEKUNLE ', 'SAMUEL ', 'ADEFOLABI', '7065829562', '', 'Male', 'Married', '05/10/1990', 'Adekunle Segun', '8162113136', 'Asa Dam Road Ile Alase', '22 Ojedokun Close Iju Ogundinu Lagos', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill', 'Trimming Officer', '05/10/1990', '1', '75000', 'Executive Assistant_1', 'FIDELITY', '70', '5333320756', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(155, '126', 'TELLA', 'KUNLE', 'NURUDEEN', '9030024225', '', 'Male', 'Married', '28/03/1983', 'Tella Fauzeeyah', '8050599386', 'Gbagba Airport Road Ilorin', 'Gbagba Airport Road Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Corrugation', 'Operator', '15/11/2013', '1', '65000', 'Executive Officer_3', 'FBN', '011', '3082372278', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(156, '127', 'OGUNBIYI', 'RUFUS', 'OLALEKAN', '8039114825', 'ogunbiyi1rufus@gmail.com', 'Male', 'Married', '02/03/1984', 'Olorunnishola Oluwapamilerin', '8060091605', '25 Ayiegun House Isale Asa Opo-Malu Ilorin', '1 Odoye Compound Ejiu Ile ', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Weighbridge', 'operator', '2013-10-21', '1', '95000', 'Executive Officer_3', 'ACCESS BANK', '044', '1499166404', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(157, '128', 'ADEFILA ', 'FATAI', 'ADEBAYO', '8063967863', 'adeabulefataifila@gmail.com', 'Male', 'Married', '', 'Adefila Sakirat', '8163736236', 'Oko Erin Near Stadium Road Ilorin', 'Oko Erin Near Stadium Road Ilorin', 'NCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Pickling operator', '2013-10-21', '1', '70000', 'Senior Office Assistant_4', 'FIDELITY', '70', '5333323269', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(158, '129', 'LAWAL', 'AKEEM', 'OLADIMEJI', '8032392520', 'akskill@gmail.com', 'Male', 'Married', '06/12/1983', 'Hadizat Lawal', '8125731634', '4 Gbagba Area Airport Road Ilorin', '14 Alafia Oluwa Baptist Church Osere Area Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Trimming Officer', '2013-10-22', '1', '80000', 'Executive Office_2', 'FBN', '011', '3089208404', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(159, '130', 'SABO', 'OBIDA', 'GOTI', '8139169146', 'lasdone6@gmail.com', 'Male', 'Married', '21/04/1982', 'Gotin Marcus Happiness', '8137775338', '10 Adio Baale Street Aiyetoro Area off Asa Dam Ilorin', 'Bumbur Bangai Karim Lamido LGA Taraba', 'FLSC', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'mechanic', '2013-11-04', '1', '105000', 'Executive Assistant_3', 'ACCESS BANK', '044', '25774518', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(160, '133', 'SULAIMAN ', 'OLANREWAJU', 'SHERIFF', '8138562881', 'sulaimanlanre93@gmail.com', 'Male', 'Married', '08/02/1990', 'Basit Olanrawaju', '7061580414', 'Flat 9 Block B Orelope Estate Odota Ilorin', 'Flat 9 Block B Orelope Estate Odota Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Electrical', 'officer', '2013-12-03', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '1498984906', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(161, '141', 'HAMMED ', 'KAZEEM', '', '9034939874', 'kazmed9@gmail.com', 'Male', 'Married', '', 'Kazeem Jamiu', '7084105601', 'Off Orelope Steet Odota Area Ilorin', 'Off Orelope Steet Odota Area Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'corrugating', 'Assistant Manager', '2014-04-14', '1', '85000', 'Executive Officer_3', 'ACCESS BANK', '044', '1499097980', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(162, '143', 'AJAIYEOBA', 'STEPHEN ', 'TOYIN', '8067294137', 'stephentoyin180@gmail.com', 'Male', 'Married', '25/09/1985', 'Agboola Omolara', '8165607042', '15 Arogogoye Street Sawmill Ilorin', '2 Gbagba Street Airport Road Ilorin', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Colourline', 'quality officer', '2014-05-27', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '1498517274', 'AB', '3', '', '', '$2y$10$0AMt9M9LSmnFL/F5TIBYx.rjMEmpggD65sa9CFhbv7nD.Df7.09Li', '1', '', ''),
(163, '145', 'OSASONA ', 'ZACCHAEUS', 'OLUFEMI', '8063711919', 'femolastic70@yahoo.com', 'Male', 'Married', '31/07/1980', 'Osasona Bukola', '8036396240', 'Beside Community Secondary School Gawmo Ilorin', 'Ekela Compound Obbo Ile Ekiti LGA', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'forklift', '2014-07-20', '1', '105000', 'Executive Assistant_3', 'FIDELITY', '70', '5333323142', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(164, '148', 'TAIYE ', 'ABDULKABIR', '', '8050923289', 'kabirtaiye@yahoo.com', 'Male', 'Married', '25/11/1986', 'Kabir Khalid', '8079799622', '10 Alaba Ogele Ilorin', '50 Irewolede Street Eyekorin Ogele Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Gas', 'operator', '2013-08-10', '1', '95000', 'Executive Assistant_1', 'ACCESS BANK', '044', '1505507654', 'O neg', '3', '', '', '$2y$10$yAl8lSWWgBAmKzsZQ5e8zeLys2zdRqTlHHKse5JRBYjm4HvOfUgCW', '1', '', ''),
(165, '150', 'SALIHU', 'DAUDA', '', '8037534027', 'omoalhajadaud12@gmail.com', 'Male', 'Married', '', 'Salihu Lukuman', '7038893662', '82 Ile Tuntun Shao Garage Ilorin', '5 Ile Oloro Abudu Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'corrugating', 'operator', '2014-12-22', '1', '80000', 'Executive Office_2', 'ACCESS BANK', '044', '1504553410', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(166, '152', 'BEN', 'OGUMA', '', '8069706449', 'benoguma@gmail.com', 'Male', 'Married', '14/01/1976', 'Oguma Lucky', '8136152800', '32 Taiye-Kehinde Street beside IGS School Ilorin', '58 Uvwlama Community opposite Town Hall Delta', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'Tunner', '2015-01-01', '1', '90000', 'Senior Office Assistant_4', 'FIDELITY ', '70', '5333348048', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(167, '154', 'ADEBAYO ', 'ADEMOLA', 'BASIRU', '8104811050', 'adebashdemola@gmail.com', 'Male', 'Married', '', 'Adebayo Taoheed', '9061785066', '5 Airport Road Ilorin', '10 Oke-Afo Road Ikirun', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Trimming Officer', '2014-01-04', '1', '85000', 'Executive Office_2', 'ACCESS BANK', '044', '1501139288', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(168, '156', 'ALABI ', 'SAHEED', '', '7039177171', 'isholaontop@gmail.com', 'male', 'Married', '', 'Alabi Kehinde', '7039733365', 'Alebiosu Close Irewolede', 'Alebiosun Close Irewolede', 'B.Sc', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'corrugating', 'operator', '2014-04-08', '1', '65000', 'Senior Officer Assistant_3', 'ACCESS BANK', '044', '44751267', '', '3', '1648148618.jpg', '', '$2y$10$XsDsg4w01JunjbnMTzlO.uXQ/MywFxzmsSBVQck76.q2PPTPiS23m', '1', '', ''),
(169, '159', 'OLUWOLE', 'ABIODUN', 'EMMANUEL', '8140316928', 'professionalabbey25@gmail.com', 'Male', 'Married', '', 'Ogunyemi Francis', '8109970707', '32 Arilewo Street Airport Road Ilorin', '32 Arilewo Street Airport Road Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Welder', '2015-02-02', '1', '85000', 'Executive Officer_1', 'ACCESS BANK', '044', '1504961422', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(170, '163', 'EFE ', 'JOHNSON', 'EMMANUEL', '8034293220', 'efejohnson099@gmail.com', 'Male', 'Married', '25/08/1980', 'Efe Isreal', '8038428057', '22 Adualere street off Amulegbe Area Ilorin', '11 Akinjobi Street Ijegun Road Ikotun Lagos', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'mechanic', '2015-04-12', '1', '110000', 'Executive Assistant_4', 'ACCESS BANK', '044', '1498803106', 'O pos', '3', '', '', '$2y$10$dxRWG6c1XmTzdfscam5.ieEE15zYMqyN7vO7GlhVzXV4focXWWodG', '1', '', ''),
(171, '166', 'ISAH', 'OZOVEHE ', 'YUSUF', '8034081359', 'yisah223@gmail.com', 'Male', 'Married', '24/05/1983', 'Isah Ibrahim', '8039669005', '5 David Akintola Street Sabo Oke Ilorin', '5 CAC Sabo Oke Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Colourline', 'Exit operator', '2015-03-20', '1', '65000', 'Senior Officer Assistant_3', 'FIDELITY ', '70', '6556434570', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(172, '167', 'ADEYEMI ', 'DEJI', '', '9023470689', '', 'Male', 'Married', '22/06/1992', 'Adeyemi Temitope', '8022559616', '14 Olu-Oba Egbejila Street Airport Ilorin', 'Oke-Ohin Kabba Bunnu LGA Kogi', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill', 'Pickling Operator', '15/04/2015', '1', '45000', 'Senior Officer Assistant_3', 'FIDELITY ', '70', '5333348055', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(173, '170', 'EKOM', 'PETER ', 'USMAN', '7035063866', 'upekom72@gmail.com', 'Male', 'Married', '', 'Peter Emmanuel', '9073149435', 'Galadima Close opposite Oko Erin IbrahimTaiwo Road Ilorin', 'Mada Station Nasarawa Egbon', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Mechanical Manager', '2015-05-15', '1', '120000', 'Senior Executive Assistant_2', 'UBA', '033', '2014884313', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(174, '171', 'JAMES', 'ADOGO', 'ABANZ', '8035574481', 'adogojames00@gmail.com', 'Male', 'Married', '15/02/1976', 'James Godwin', '', '42 Aduragba Street Asa Dam Road Ilorin', '18 IKM Street Igoli Ogoja Cross River', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'furnance', 'operator', '2015-05-15', '1', '100000', 'Executive Assistant_2', 'ACCESS BANK', '044', '4529727', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(175, '175', 'JAMES', 'EMMANUEL', '', '8139303703', 'jemma169@gmail.com', 'Male', 'Married', '', 'Gabriel Emmanuel', '', 'Airforce Gbagba Ilorin', 'Airforce Gbagba Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'furnance', 'operator', '2015-06-05', '1', '70000', 'Senior Office Assistant_4', 'FIDELITY ', '70', '6556503829', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(176, '176', 'OLANREWAJU ', 'SULEIMAN', 'OLABISI', '7068505137', 'olanrewajus96@gmail.com', 'Male', 'Married', '10/11/1987', 'Olanrewaju Maruf', '7030713691', '23 Jooro Street off Asa Dam Road Ilorin', '35 Ile Sakossi Compound Idi-Ogun Offa ', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'mechanic', '2015-06-05', '1', '70000', 'Senior Officer Assistant_3', 'UBA', '033', '2068168625', 'O pos', '3', '', '', '$2y$10$8G6DZRtywQiZxZI86b6LiOCBYxX.3w4tiTtrFb5WW/N/A9iK2XUhu', '1', '', ''),
(177, '177', 'YUSUF ', 'ABDULKABIRU ', 'OLATUNJI', '8165994309', 'kbolatunjiy@gmail.com', 'Male', 'Married', '', 'Yusuf Zainab', '', 'Ile Alata Ita Alamu opposite matrix filling station Ilorin', 'Ile Alata Ita Alamu opposite matrix filling station Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'packing', '2015-06-15', '1', '65000', 'Senior Officer Assistant_3', 'ACCESS BANK', '044', '1505317033', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(178, '179', 'AWE', 'IGE', '', '8030859924', 'babaigeawe73@gmail.com', 'Male', 'Married', '', 'Awe Mary', '', '26 Galadima Street Airport Road Ilorin', '26 Galadima Street Airport Road Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'corrugating', 'operator', '2015-06-15', '1', '65000', 'Senior Officer Assistant_3', 'FIDELITY ', '70', '5333338821', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(179, '180', 'ADEBAYO ', 'ABDULRASAQ', '', '8067927781', 'abayomiolamilekan80@gmail.com', 'Male', 'Married', '18/08/1983', 'AbdulRasaq Mariam', '7064852054', '48 Lysun Lao Street Opposite Lysun Secondary School Lao Ilorin', '48 Lysun Lao Street Opposite Lysun Secondary School Lao Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'warehouse', 'Store officer', '2015-05-27', '1', '105000', 'Executive Assistant_3', 'FCMB', '', '1597437018', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(180, '182', 'MOHAMMED ', 'AYODELE ', 'RAFIU', '8034757296', 'mohraf139@gmail.com', 'Male', 'Married', '', 'Mohammed Gbenga', '9070867712', '60 Irewolede Ilorin', '60 Irewolede Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'entry operator', '2015-10-15', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '1501418970', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(181, '189', 'AFIZ', 'MALIK', '', '8029586295', 'azmalik5573@gmail.com', 'Male', 'Married', '', 'Malik Isa', '8064456345', 'Powerline Irewolede Ilorin', 'Edo', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Tunner', '2016-05-02', '1', '95000', 'Executive Assistant_1', 'ACCESS BANK', '044', '1501344671', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(182, '190', 'SHITTU ', 'JAMIU', '', '7038890307', 'jamiushittu06@gmail.com', 'Male', 'Married', '18/10/1994', 'Shittu Amina', '8034949985', '7 Olohunsogo Street Zango Ilorin', '7 Olohunsogo Street Zango Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'celler operator', '2016-05-25', '1', '65000', 'Senior Officer Assistant_3', 'POLARIS ', '', '1018301786', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(183, '191', 'ADEWUYI ', 'SAHEED ', 'ADEGBOLA', '8068054358', 'adewuyisaheed@gmail.com', 'Male', 'Married', '06/08/1988', 'Adewale Banke', '706849058', '47 Kilanko Street Off Offa Garage Area Ilorin', '47 Kilanko Street Off Offa Garage Area Ilorin', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'roll forming', 'packing', '2015-05-27', '1', '60000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '1499025839', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(184, '193', 'FANIRAN ', 'SESAN', 'SUNDAY', '8067152598', 'faniransesan@gmail.com', 'Male', 'Married', '14/01/1981', 'Faniran Olasunkanmi Triumph', '8067122580', '10 Orisunmibare Community Osin Okete Ilorin', '10 Orisunmibare Community Osin Okete Ilorin', 'B.Ed', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'furnance', 'operator', '2016-05-31', '1', '75000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '1498651730', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(185, '194', 'KAYODE ', 'ADEBOYE', 'EMMANUEL', '8102005185', 'emmaadekay@gmail.com', 'Male', 'Married', '', 'Adeniyi Motunrayo', '8139536071', '24 Powerline Area Irewolede Ilorin', '24 Powerline Area Irewolede Ilorin', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'mechanic', '2016-05-31', '1', '60000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '1498920308', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(186, '195', 'MUDASHIR ', 'RASHEED', 'ADEKOLA', '7038848105', 'mudashirrasheed@gmail.com', 'Male', 'Married', '23/11/1982', 'Amoo Suliat Tunrayo', '9063629220', '25 Ifesowapo Street Ita-Alamu Ilorin', '25 Ifesowapo Street Ita-Alamu Ilorin', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Colourline', 'entry operator', '2016-05-31', '1', '60000', 'Senior Office Assistant_2', 'FBN', '011', '3116774616', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(187, '196', 'AMOO ', 'BABATUNDE ', 'BABATUNDE', '9062187743', 'hamoojamiu33@gmail.com', 'Male', 'Married', '18/09/1979', 'Jimoh Zainab', '8062784613', '17 Mubo Street Maraba Ilorin', 'Ile Igbomina Compound Omi-Aro Ifelodun LGA Kwara', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Gas', 'Operator', '31/05/2016', '1', '40000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '1502713067', 'O neg', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(188, '197', 'OLAITAN', 'GIDEON ', 'KAYODE', '9077812966', 'odeontan298@gmail.com', 'Male', 'Married', '', 'Olaitan Foluke ', '8146218722', 'Behind Ero Omo Secondary School Kilanko Offa Garage Ilorin', 'Behind Ero Omo Secondary School Kilanko Offa Garage Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Helper', '2016-06-30', '1', '60000', 'Senior Office Assistant_2', 'FIDELITY ', '70', '6556503575', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(189, '208', 'OGUNNIMO ', 'OLALEKAN', '', '806679502', 'olanimolekan@gmail.com', 'Male', 'Married', '', 'Mrs A.S. Ogunnimo', '7039389874', 'Ifesowapo Street Ganmo Kwara', 'Behinde Step down Ganmo Kwara', 'FLSC', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'roll forming', 'operator', '2016-06-30', '1', '60000', 'Senior Office Assistant_2', 'FIDELITY ', '70', '5333357141', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(190, '209', 'ADISA', 'OLAREWAJU', 'WASIU', '7037989680', 'wasisawa2912@gmail.com', 'Male', 'Married', '', 'Adisa Falilat', '9085212101', '9 Ita Adu Okelele Road Ilorin', '35 Ita Alamu Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'offline', '2015-04-15', '1', '60000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '1499023787', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(191, '213', 'BELLO ', 'RAMON ', 'ADEBAYO ', '8033578864', 'belloadebayo2017@gmail.com', 'Male', 'Married', '07/10/1967', 'Alhaja R.A. Bello', '8033708408', '10 Jacob Alabi Street MFM Church Area Tanke Ilorin', '10 Jacob Alabi Street MFM Church Area Tanke Ilorin', 'M.Sc', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Sales & Marketing', 'Assistant Manager', '2017-11-05', '1', '180000', 'Deputy Manager_1', 'ACCESS BANK', '044', '28942298', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(192, '219', 'RASAQ ', 'MUSA', 'OLAYINKA', '8165451637', 'rasaqblackky@gmail.com', 'Male', 'Married', '', 'Musa Suliyat', '7046221397', '47 Balogun Hospital Street Surulere Ilorin', 'Ile Alasinrin Pakata Ilorin West LGA', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'furnance', 'operator', '2018-07-03', '1', '65000', 'Office Assistant_3', 'FIDELITY ', '70', '6556397439', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(193, '220', 'SOLIU', 'LUKMAN', '', '7038893662', 'lukmansoliu9@gmail.com', 'Male', 'Single', '13/01/1997', 'Soliu Monsurat', '7037464419', '81 Shao Garage Ilorin', '81 Shao Garage Ilorin', 'NCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'online operator', '2018-08-07', '1', '60000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '1502139539', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(194, '224', 'OBI', 'BRIGHT', '', '8067511711', 'kennybright5@gmail.com', 'Male', 'Married', '06/01/1987', 'Bright Blessing', '8105120068', 'Pa Thomas Akande Close Oke Oba Tanke Ilorin', 'Pa Thomas Akande Close Oke Oba Tanke Ilorin', 'M.Sc', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Quality Assurance', 'officer', '2019-03-01', '1', '110000', 'Executive Assistant_4', 'ACCESS BANK', '044', '1501331917', 'A pos', '3', '', '', '$2y$10$az4qi9pbVNwuyboX6CTgnuiC8fJ96KK9mCAnKW/CWwij0G86e3YYa', '1', '', ''),
(195, '225', 'FASASI ', 'JAMIU', 'OLADIMEJI', '8039304377', 'fasasijamiu39@gmail.com', 'Male', 'Married', '07/09/1992', 'Fasasi AbdulLateef', '8065971122', '2 Narto Junction Airport Road Ilorin', '20 Papa Ajao Street NITEL Road Takie Ogbomoso', 'B.Tech', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Assistant Manager', '2019-03-03', '1', '80000', 'Executive Officer_2', 'ACCESS BANK', '044', '71586383', 'O pos', '3', '', '', '$2y$10$aoCkAfNaYHcdPx3YmxDDZugE1dbaiG5sefyRHCEZO045e0csKxvF6', '1', '', ''),
(196, '256', 'SAHEED', 'AHMED', 'OLANREWAJU', '7069389732', 'ayodeji4luv@gmail.com', 'Male', 'Married', '18/07/1987', 'Jimoh Toheebat Abimbola', '8107905562', 'G 102 Balogun Ba\'are Gambari Ilorin', 'G 102 Balogun Ba\'are Gambari Ilorin', 'NCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Helper', '2019-11-08', '1', '50000', 'Office Assistant_3', 'ACCESS BANK', '044', '728095061', 'A pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(197, '260', 'OLADIPO', 'TAIYE ', 'ABOLAJI', '9030500789', 'tayeabolaji03@gmail.com', 'Female', 'Married', '04/09/1997', 'Oladipo Kehinde', '9063314230', '17 Temidire Street Irewolede Ilorin', '6 Ile Olupo Odo Omu-Aran', 'NCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Kitchen', 'Helper', '2019-12-09', '1', '35000', 'Office Assistant_2', 'ACCESS BANK', '044', '1498486905', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(198, '270', 'DAVID', 'AKAV', '', '8138988833', 'mecakavd@gmail.com', 'Male', 'Married', '', 'David Rose', '8163266021', '25 Oko Erin Junction Ilorin', '20 Ubamgag Market Street Gboko Benue', 'FLSC', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'mechanic', '2020-03-03', '1', '90000', 'Executive Officer_4', 'ZENITH', '057', '2190229753', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(199, '274', 'IBRAHIM', 'OLUFUNKE', '', '8032229821', 'ibrahimfunke83@gmail.com', 'Female', 'Married', '18/05/1989', 'Ibrahim Aduke', '8032576149', '24 Irede Community Airport Area Ilorin', '6 Odo Anku Ejuku Kogi', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Kitchen', 'Helper', '2020-06-04', '1', '35000', 'Office Assistant_2', 'FBN', '011', '3013285185', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(200, '275', 'ADIGUN', 'FUNMILAYO', 'ESTHER', '7034915666', 'ibrahimfunke83@gmail.com', 'Female', 'Married', '27/02/1995', 'Adigun Mojisola', '8034201450', '52 Aribidesi Street Airport Road Ilorin', '6 Sanga SOJ Street Along Atiba LGA Oyo', 'OND', 'Aroma', 'Aroma Unity', 'cook', 'cook', '', '1', '30000', 'Office Assistant_2', 'ACCESS BANK', '044', '1498298340', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(201, '299', 'SALAUDEEN', 'MUHAMMED', '', '8066516785', 'mmsalawu75@gmail.com', 'Male', 'Married', '', 'Shuaib Salaudeen', '8067086530', '79 Ile Aluko Compound Okelele Ilorin', '79 Ile Aluko Compound Okelele Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Human Resource & Admin', 'Gardener', '2021-01-06', '1', '35000', 'Office Assistant_2', 'ACCESS BANK', '044', '1499024124', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(202, '304', 'JOHN', 'SALOME', 'SHARRON', '7068709653', 'sharonsj5@gmail.com', 'Female', 'Married', '', 'James Christiana', '9131533887', 'Irewolede Ilorin', 'Igede Benue', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Kitchen', 'Helper', '2021-11-01', '1', '35000', 'Office Assistant_2', 'ACCESS BANK', '044', '1509102710', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(203, '310', 'ABDULLAHI ', 'BOLAJI', '', '8147249511', '', 'Male', 'Married', '18/04/1996', 'Muraina Abdullahi', '8035703210', '4 Adilowo Street Opposite Airport Ilorin', '45 Ila Tola Beside Budo Alfa Mosque Oyo', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Galvanising', 'welder ', '02/02/2021', '1', '50000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '1500834328', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(204, '316', 'AKINWUMI', 'EZEKIEL', '', '8123308768', 'ezekielakin@gmail.com', 'Male', 'Married', '', 'Akinwumi Samuel Taiye', '7010523335', '12 Eyenkarin Apata Ilorin', '12 Eyenkarin Apata Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Welder', '2021-02-05', '1', '65000', 'Senior Officer Assistant_3', 'ACCESS BANK', '044', '1498833688', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(205, '318', 'OSASONA ', 'SIMON ', 'KAYODE', '8132410481', 'osasonakayode3@gmail.com', 'Male', 'Married', '09/09/1988', 'Osasona Mary Omoyeni', '8100721224', '42 Egbe Road Amoyo Kwara ', '42 Egbe Road Amoyo Kwara', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'Exit operator', '2021-02-23', '1', '55000', 'Senior Office Assistant_1', 'ACCESS BANK', '044', '86521649', 'A pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '');
INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `last_name`, `other_name`, `phone`, `email`, `gender`, `marital_status`, `dob`, `kin_name`, `kin_phone`, `present_add`, `permanent_add`, `highest_qualification`, `company`, `branch`, `department`, `job_title`, `date_employed`, `employment_type`, `present_salary`, `grade_step`, `bank_name`, `bank_code`, `account_number`, `blood_group`, `company_id`, `photo`, `notification`, `hashed_password`, `update_profile`, `created_at`, `deleted`) VALUES
(206, '320', 'YINUSA ', 'TAJUDDEN', 'ALADE', '8136756511', 'tajudeentunde1@gmail.com', 'Male', 'Married', '02/04/1985', 'Yinusa Medinat', '8032865980', '29 Asa Dam Road Ilorin', '29 Asa Dam Road Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Helper', '2021-02-27', '1', '55000', 'Senior Office Assistant_1', 'ACCESS BANK', '044', '1498905770', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(207, '344', 'AKIODE ', 'ENIOLA', 'AKINOLA', '8033180007', 'eniolaaakiode@yahoo.com', 'Male', 'Married', '06/06/1983', 'Rosemary Akiode', '8033180007', 'Plot 24 Block XI Ajebo Housing Estate Abeokuta', 'Plot 24 Block XI Ajebo Housing Estate Abeokuta', 'B.Sc', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Marketing', 'Manager', '01/07/2021', '1', '200000', 'Manager_3', 'ACCESS BANK', '044', '99755738', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(208, '345', 'ABDULQAUDRI', 'USMAN ', 'OLANREWAJU', '8136437097', 'abdulqaudricusman@gmail.com', 'Male', 'Married', '10/09/1989', 'Usman Hasmau', '8136437097', '9 Arilewo Street Budonuhu Airport Ilorin', '1 Yusuf Compound Kulende Sango Ilorin', 'OND', 'Aroma', 'Ibadan (Iwo Road)', 'Maintenance', 'mechanic', '2021-07-01', '1', '70000', 'Senior Office Assistant_4', 'FCMB', '214', '6322414018', 'O pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(209, '361', 'AJAYI ', 'KEHINDE', '', '8130302295', 'kennyajayi21@gmail.com', 'Male', 'Married', '', 'Ajayi Nike', '9063705539', '32 Iludun Street Aiport Ilorin', '32 Iludun Street Aiport Ilorin', 'FLSC', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'Welder', '2021-08-01', '1', '60000', 'Senior Office Assistant_2', 'STERLING', '232', '501783997', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(210, '363', 'OWOLABI ', 'AYOMIDE', 'ADEBOLA', '814495508', 'ayodebola717@gmail.com', 'Female', 'Married', '06/09/1995', 'Adegbola Adesanmi', '8145320407', 'Eiyenkorin Ilorin', 'Eiyenkorin Ilorin', 'NCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Kitchen', 'Helper', '2021-08-10', '1', '35000', 'Office Assistant_2', 'STERLING ', '232', '65715777', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(211, '364', 'OLADELE ', 'TIMILEYIN ', 'EMMANUEL', '8086770242', 'timileyinoladele20@gmail.com', 'Male', 'Married', '18/06/1998', 'Edungbola Leke', '8034833747', 'Asa Dam Area Ilorin', 'Asa Dam Area Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Electrical', 'officer', '2020-03-26', '1', '55000', 'Senior Office Assistant_1', 'ZENITH ', '057', '2255290429', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(212, '370', 'ORIOLOWO ', 'AYOBAMI ', 'DAMILOLA', '8144704829', 'oriolowoayobami@gmail.com', 'Male', 'Married', '19/10/1992', 'Oriolowo Olaide Favor', '8168020691', 'Irewolede Awilo Ilorin', '19 Ajiyo Olunde Ibadan', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'galvanizing', 'Exit operator', '2015-01-05', '1', '80000', 'Executive Officer_2', 'ACCESS BANK', '044', '1498917472', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(213, '372', 'ABDULSALAM ', 'ABDULAZEEZ ', 'OLASUNKANMI', '8143496007', 'abdulsalamabdulazeez8@gmail.com', 'Male', 'Married', '', 'Mariam AbdulSalam', '8164465009', '5 Temidire Street off Airport Road Ilorin', '2 Ogunkoya Street Olorunsogo Ilorin', 'OND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Maintenance', 'plumber', '2018-10-01', '1', '100000', 'Executive Assistant_2', 'FCMB', '', '2808983010', '', '3', '', 'on', '$2y$10$dWjPsY7syjXzRzyiUAVhj.TRA/NqB7VH2PeHHC0iQTqxedpVBl6nW', '1', '', ''),
(214, '464', 'SULAIMAN', 'AYINDE ', 'AKEEM', '8069657374', 'akayindesule@gmail.com', 'Male', 'Married', '', 'Akeem AbdulWariz', '9139117166', '22 Kudimoh Street Ikolaba Compound Adabata Ilorin', '22 Kudimoh Street Ikolaba Compound Adabata Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Entryline', 'operator', '2021-03-03', '1', '50000', 'Office Assistant_3', 'ACCESS BANK', '044', '696893434', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(215, '13', 'JAMES', 'TUESDAY', '', '8164919410', 'tuesdayjames@gmail.com', 'Male', 'Married', '', 'James Feranmi', '8052151599', 'Beside Love Water  Cocacola Road Babaode Ilorin', 'Beside Love Water Cocacola Road Babaode Ilorin', 'FLSC', 'Head Office', 'Head office', 'Human Resource & Admin', 'Driver', '1990-12-01', '1', '99000', ' Chief Driver _2 ', 'ACCESS BANK', '044', '9138734', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(216, '14', 'BABA', 'SHUAIB ', '', '8067086530', 'babashuaibalfala@gmail.com', 'Male', 'Married', '', 'AbdulHammed Shuaib', '7032984493', 'Ile Aliko Adangba Road Okelele  Ilorin', 'Ile Aliko Adangba Road Okelele  Ilorin', 'FLSC', 'Head Office', 'Head office', 'Human Resource & Admin', 'Gardener', '1995-07-01', '1', '50000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '810884965', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(217, '18', 'IBRAHIM ', 'ADEGBOYEGA ', 'FATAI', '8068764444', 'adegboyega895@gmail.com', 'Male', 'Married', '17/06/1950', 'Adegboyega Kabiru', '8062556135', 'Ita Elepa Area off Asa Dam Road Ilorin', 'Ita Elepa Area off Asa Dam Road Ilorin', 'FLSC', 'Retail Outlet', 'Ilorin (A division)', 'Human Resource & Admin', 'Driver', '1999-02-15', '1', '60000', 'Driver_4', 'ACCESS BANK', '044', '9139353', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(218, '24', 'AYEDJO ', 'IDRIS ', 'UMAR', '7046533156', 'akowojo1@gmail.com', 'Male', 'Married', '', 'Idris Muraina', '8186439506', 'Olak Filling Station opposite A division Ilorin', 'Olak Filling Station opposite A division Ilorin', 'FLSC', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '1999-07-06', '1', '76000', 'Senior Security Officer_4', 'ACCESS BANK', '044', '814630486', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(219, '28', 'SOLIU ', 'ABUBAKRY ', 'BAMIDELE', '7034382159', 'babatundesoliu67@gmail.com', 'Male', 'Married', '', 'Bamidele Ganiyu', '9028880771', '', '', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2002-04-01', '1', '72000', 'Senior Security Officer_3', 'ACCESS BANK', '044', '815411772', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(220, '29', 'ABDULKAREEM ', 'JIMOH ', 'AKIBU', '7037238870', 'abdulkareemjimoh@gmail.com', 'Male', 'Married', '04/07/1977', 'Abdulkareem Munarat', '8105295249', 'Osin Olatunji Ilorin', 'Osin Olatunji Ilorin', 'FLSC', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2003-01-02', '1', '68000', 'Senior Security Officer_2', 'ACCESS BANK', '044', '816648809', 'O pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(221, '57', 'OJO', 'BANKOLE', 'SAMUEL', '8062591688', 'bankright39@gmail.com', 'Male', 'Married', '05/05/1980', 'Ojo Goodness Paul', '7083170759', '35 Budo Iya along Kings Step Secondary School Ilorin', '35 Budo Iya along Kings Step Secondary School Ilorin', 'OND', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2008-06-03', '1', '64000', 'Senior Security Officer_1', 'ACCESS BANK', '044', '814413078', 'O pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(222, '63', 'ADEOYE', 'MOSHOOD', '', '8032852802', 'ademoshood66@gmail.com', 'Male', 'Married', '', 'Adeoye Azeez', '8085546515', 'E 7/146 Ode Aje Street Ibadan', 'E 7/146 Ode Aje Street Ibadan', 'FLSC', 'Aroma', 'Aroma Iwo Road', 'Human Resource & Admin', 'Driver', '2008-09-18', '1', '103000', 'Chief Driver _3', 'WEMA', '035', '239167761', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(223, '65', 'SOLIU ', 'SUARA ', 'SUARA', '7017822369', '', 'Male', 'Married', '16/03/1973', 'Soliu AbdulQoyuum', '8129195695', 'Ajia Egbeda Ibadan', 'E9/377 Oluyoro Oke Adu Ibadan', '', 'Retail outlet', 'Ibadan (Iwo Road)', 'HR & Admin', 'Driving', '14/09/2009', '1', '38000', 'Driver_3', 'ACCESS BANK', '044', '61618999', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(224, '82', 'HAMMED ', 'JIMOH ', 'ASUNKERE', '9069054808', 'jimedasunkere@gmail.com', 'Male', 'Married', '', 'Hammed Ibrahim', '7062166474', '9 Ile Olori Abata Asunkere Ilorin', '9 Ile Olori Abata Asunkere Ilorin', 'FLSC', 'Retail Outlet', 'Ilorin (Usanda) Sobi Road', 'Human Resource & Admin', 'Driver', '2013-01-04', '1', '42000', 'Driver_1', '', '', '', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(225, '92', 'OLUSEGUN ', 'ALABA ', 'SEUN', '8105008949', 'olusegunseun500@gmail.com', 'Male', 'Married', '11/10/1983', 'Olusegun Liberty', '', '4 Old Kara Sango Ilorin ', '4 Old Kara Sango Ilorin ', 'SSCE', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2013-01-02', '1', '49000', 'Security Officer_3', 'ACCESS BANK', '044', '1223552538', 'O pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(226, '118', 'YAKUBU', 'MURITALA', '', '9012889044', 'alfamuri1011@gmail.com', 'Male', 'Married', '', 'Zainab Yakubu', '8022181734', 'Gaa Saka Ita-Amo Ilorin', 'Gaa Saka Ita-Amo Ilorin', 'FLSC', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Human Resource & Admin', 'Driver', '2013-10-01', '1', '95000', 'Chief Driver_1', 'ACCESS BANK', '044', '1499721320', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(227, '135', 'OLORUNLEKE ', 'JIDE', '', '8029162608', 'babagoddyleke@gmail.com', 'Male', 'Married', '12/06/1970', 'Michael Olorunleke', '8094854193', '12 Gbelowowa Street Olorunsogo Gaa-Akanbi Ilorin', '12 Gbelowowa Street Olorunsogo Gaa-Akanbi Ilorin', 'SSCE', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2014-01-01', '1', '49000', 'Security Officer_3', 'ACCESS BANK', '044', '814633463', 'O pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(228, '136', 'BABA ', 'YUSUF', '', '8166897568', 'gentlebabayusuf@gmail.com', 'Male', 'Married', '', '', '', 'Olak Filling Station opposite A division Ilorin', 'Olak Filling Station opposite A division Ilorin', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2014-01-07', '1', '49000', 'Security Officer_3', '', '', '', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(229, '144', 'BENJAMEN', 'ATTA', '', '8148037253', 'attaben1@gmail.com', 'Male', 'Married', '', 'Benjamen Samuel', '8104104766', '29 Iroyin Ayo Street Akerebiata Ilorin', '29 Iroyin Ayo Street Akerebiata Ilorin', 'FLSC', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2014-06-24', '1', '49000', 'Security Officer_3', 'ACCESS BANK', '044', '825507681', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(230, '162', 'ADAM', 'SAKA', '', '9018626610', '', 'Male', 'Married', '20/07/1976', 'Toheeb Adam', '', 'Ile Kelebe Alfa Yahaya Itaamon Ilorin', 'Ile Kelebe Alfa Yahaya Itaamon Ilorin', '', 'Head office', 'Head office', 'HR & Admin', 'Driving', '15/02/2015', '1', '42000', 'Driver_4', '', '', '', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(231, '174', 'JIBRIB ', 'ISSAH', '', '8140059554', 'abutawajibrib@gmail.com', 'Male', 'Married', '', 'Issah Saratu', '9060637490', 'Olak Filling Station opposite A division Ilorin', 'Olak Filling Station opposite A division Ilorin', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2015-06-04', '1', '64000', 'Security Officer_4', 'ACCESS BANK', '044', '819152116', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(232, '185', 'ABDULSALAM', 'ABDULRAFIU ', 'AJAO', '8134207641', 'ajaoabdulsalamraf@gmail.com', 'Male', 'Married', '', 'AbdulSalam AbdulMalik', '8145227721', '67 Oke Agodi Alfa Yahaya Ilorin', '67 Oke Agodi Alfa Yahaya Ilorin', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Human Resource & Admin', 'Driver', '2015-11-30', '1', '72000', 'Assistant Senior Driver_3', 'ACCESS BANK', '044', '1499389591', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(233, '210', 'SANNI ', 'AMINULLAHI', '', '8185478947', 'saminullahi0604@gmail.com', 'Male', 'Married', '', 'Aminullahi Aishat', '8101806729', 'Kilanko Road off Offa Garage Ilorin', 'Kilano Road off  Offa Garage Ilorin', 'SSCE', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2017-06-26', '1', '45000', 'Security Officer_2', '', '', '', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(234, '215', 'SHUAIB', 'SARAKI', '', '', 'ssarakis@gmail.com', 'Male', 'Married', '', '', '', '', '', '', 'Aroma', 'Aroma Iwo Road', 'Human Resource & Admin', 'Security', '2017-12-30', '1', '38000', 'Security Officer_1', '', '', '', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(235, '216', 'MANASSEH', 'LAIRA ', 'SUNDAY', '7032442594', 'lairamanassehs@gmail.com', 'Male', 'Married', '', 'Manasseh Racheal', '8139155402', '7 Cele street  Basin Ilorin', 'Madakiya Zaira Kunduna', 'SSCE', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2018-05-01', '1', '45000', 'Security Officer_2', 'ACCESS BANK', '044', '89600958', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(236, '218', 'AFISSU', 'AZEEZ', 'TAMURA', '8145299146', 'tamuraafissuaz@gmail.com', 'Male', 'Married', '', 'Garuba Husseni', '7088958799', 'Abdul Raak Road GRA Ilorin', 'Abdul Raak Road GRA Ilorin', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2018-07-01', '1', '45000', 'Security Officer_2', 'ACCESS BANK', '044', '820442136', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(237, '222', 'AUDU ', 'NOAH', '', '8063219796', 'noahaudu3@gmail.com', 'Male', 'Married', '01/10/1980', 'Audu Testimony', '8063219796', '2 Alakuko House Irewolade Opposite Sawmill Ilorin', '2 Alakuko House Irewolade Opposite Sawmill Ilorin', 'SSCE', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2018-09-07', '1', '45000', 'Security Officer_2', 'ACCESS BANK', '044', '68913002', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(238, '226', 'AYEGBA ', 'MICHEAL', '', '8035231370', 'jm9811723@gmail.com', 'Male', 'Married', '30/06/1981', 'Micheal Confidence', '8035231370', 'Budo Oke Eiyenkorin Asa LGA Kwara', 'Emachadu Ogugu', 'NCE', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2019-03-15', '1', '45000', 'Security Officer_2', 'ACCESS BANK', '044', '816656644', 'O pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(239, '230', 'OYIBO ', 'SAMUEL', 'ADAH', '7035622751', 'soyiboadah@gmail.com', 'Male', 'Single', '', 'Adah A. Christopha', '8076127632', 'Iwo Street Offa Garage Ilorin ', 'Iwo Street Offa Garage Ilorin', 'SSCE', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2019-06-07', '1', '45000', 'Security Officer_2', 'ACCESS BANK', '044', '817085142', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(240, '231', 'BENJAMIN ', 'ADEMU', '', '8065693466', 'benademu77@gmail.com', 'Male', 'Married', '', 'Ademu Onechojon', '8061334883', 'Off M.M Filling Station Agbo Oba Ilorin', 'Ate Ofugo Ankpa Kogi', 'NCE', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2019-06-07', '1', '45000', 'Security Officer_2', 'ACCESS BANK', '044', '821352625', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(241, '234', 'AWEDA', 'WASIU', '', '8165106603', 'awedawedawasi@gmail.com', 'Male', 'Married', '', 'Awedu Fawasi', '8109869877', '67 Akerebiata Road Ilorin', '2 Oloru street Ilorin', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2019-06-15', '1', '45000', 'Security Officer_2', 'ACCESS BANK', '044', '1392031018', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(242, '255', 'INAWOLE ', 'TOPE ', 'SEGUN', '9069702703', 'inawoletops11@gmail.com', 'Male', 'Single', '', 'Seun Olayegun', '8069835087', '5 Tinu Street off Sobi Road Akerebiata Ilorin', '5 Tinu Street off Sobi Road Akerebiata Ilorin', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2020-10-02', '1', '45000', 'Security Officer_2', 'ACCESS BANK', '044', '1237406351', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(243, '271', 'MOHAMMED', 'YAKUB ', 'TAWERE', '8030809723', 'mohammedyakub1099@gmail.com', 'Male', 'Married', '13/12/1978', 'Mohammed Wakilat', '8068311179', 'Olak Filling Station opposite A division Ilorin', 'Olak Filling Station opposite A division Ilorin', 'SSCE', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2020-04-20', '1', '42000', 'Security Officer_1', 'ACCESS BANK', '044', '1483484057', 'AB', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(244, '276', 'OLANREWAJU', 'ABOLAMI', 'LUQMON', '9047594474', 'abolajiolanrewaju4@gmail.com', 'Male', 'Married', '', 'Olanrewaju Suliat', '9026272632', '56 Adabata Road Off Baboko Ilorin ', '56 Adabata Road Off Baboko Ilorin ', 'OND', 'Retail Outlet', 'Ilorin (Usanda) Sobi Road', 'Human Resource & Admin', 'Driver', '2020-06-12', '1', '42000', 'Driver_1', '', '', '', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(245, '278', 'AJE ', 'ADISA', '', '9032879075', 'ajeadisa61@gmail.com', 'Male', 'Married', '', 'Adisa Samuel', '8037526678', '20 Oja-Iya Area Ilorin', '20 Oja-Iya Area Ilorin', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2020-07-14', '1', '42000', 'Security Officer_1', 'ZENITH', '057', '2120255269', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(246, '295', 'HANAFI ', 'IDOWU ', 'OLOWU', '7032044760', 'goldensonolowo@gmail.com', 'Male', 'Married', '15/03/1983', '', '8184322016', '27 Alfa Yahaya Street Itan Mon Ilorin', '1 Awimonse Oko Olowo Area Ilorin', 'NCE', 'Aroma', 'Aroma Unity', 'Human Resource & Admin', 'Driver', '2020-11-15', '1', '42000', 'Driver_1', 'GTB', '', '0216507842', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(247, '338', 'SALAMI ', 'KEHINDE', 'ADEWALE', '8053021822', 'stakgf@gmail.com', 'Male', 'Married', '20/05/1982', 'Ogunshina Rashidat', '8028859311', '6 Oyetola Street Mafoluku Oshodi Lagos', '6 Oyetola Street Mafoluku Oshodi Lagos', 'B.Agric', 'Head Office', 'Head office', 'Human Resource & Admin', 'Manager', '2021-06-01', '1', '200000', 'Assistant Manager_1', 'ACCESS BANK', '044', '1495405774', 'O pos', '8', '', '', '$2y$10$7Ee2KrutnQYnUGe3yPK5AOtPs3pJhLoVOI9VDVs8JaIRwkBdVGtQS', '1', '', ''),
(248, '360', 'BUSARI ', 'ABDULFATAI', 'AKANDE', '9065723175', 'akandebusarifatty@gmail.com', 'Male', 'Married', '', 'AbdulFatai Nafisat', '8057785064', 'Ile Ganga beside Babata Mosque Alore Ilorin', 'Oni Bata Compound Abayawo Area Ilorin', 'FLSC', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Human Resource & Admin', 'Driver', '2021-08-01', '1', '60000', 'Driver_4', 'ACCESS BANK', '044', '1498821106', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(249, '367', 'BISONG ', 'MATHEW', '', '8061193860', 'oldsolidermathew@gmail.com', 'Male', 'Married', '', 'Lucky Bisong', '8162126082', '', '', 'FLSC', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2012-01-31', '1', '68000', 'Senior Security Officer ', '', '', '', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(250, '371', 'ABUBAKAR', 'SABI', 'IBRAHIM', '8167341608', 'ibsabiabu@gmail.com', 'Male', 'Married', '', 'Musa Abubakar', '8148606067', 'Osere Off Sementary Road Ilorin', 'Subayo Wolu Compound Ilesha-Buruba', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2018-07-01', '1', '45000', 'Security Officer_2', '', '', '', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(251, '396', 'SOLIU ', 'BALOGUN', '', '8142185692', 'balosoliu@gmail.com', 'Male', 'Married', '', 'Mrs Soliu Adijat', '9076040992', '5 Sule Manager Street Iwo Road Ibadan', '5 Sule Manager Street Iwo Road Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Human Resource & Admin', 'Security', '2018-01-10', '1', '30000', '', '', '', '', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(252, '397', 'NAJIM ', 'ABDULLAHI', '', '8165564964', 'najimabdul@gmail.com', 'Male', 'Married', '', 'Mrs Nojeem Shakirat', '7011445012', '8 Sule Manager Street Iwo Road Ibadan', '8 Sule Manager Street Iwo Road Ibadan', 'SSCE', 'Aroma', 'Aroma Iwo Road', 'Human Resource & Admin', 'Security', '2013-06-09', '1', '30000', '', 'WEMA', '035', '2251212897', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(253, '415', 'IBRAHIM ', 'SAHEED', '', '', 'bennysaheedib@gmail.com', 'Male', 'Married', '', '', '', '', '', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Security', '2021-12-10', '1', '38000', 'Security Officer_1', '', '', '', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(254, '432', 'ALHASSAN', 'SAHEED', '', '', 'alhassansaheed@gmail.com', 'Male', 'Married', '', '', '', '', '', '', 'Petroleum', 'Olak Pet. Ibadan', 'Human Resource', 'Security', '', '1', '30000', 'Security Officer_1', '', '', '', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(255, '433', 'ABDULLAHI', 'ABDULAZEEZ', '', '', '', 'Male', 'Married', '', '', '', '', '', '', 'Petroleum', 'Olak Pet. Ibadan', 'Human Resource', 'Security', '', '1', '30000', 'Security Officer_1', '', '', '', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(256, '447', 'OMOTAYO ', 'DANIEL ', 'TAYO', '8052301843', '', 'Male', 'Married', '', '', '', '', '', '', 'Aroma', 'Aroma Iwo Road', 'HR & Admin', 'Driving', '05/01/2022', '1', '30000', 'Driver_1', '', '', '', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(257, '74', 'IBRAHEEM ', 'WAHEED ', 'ADEKUNLE', '8068315144', 'ibwaheedadekunle98@gmail.com', 'Male', 'Married', '24/11/1977', 'Ibraheem Abolaji', '8035284719', '56 Halleluyah Estate Osogbo', '56 Halleluyah Estate Osogbo', 'HND', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Compliance', 'Manager', '2011-02-01', '1', '110000', 'Executive Assistant_4', 'POLARIS ', '076', '3023386453', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(258, '87', 'OGUNLANA', 'ROTIMI', 'JACOB', '8025837445', 'olurotimijacob@gmail.com', 'Male', 'Married', '28/04/1982', 'Alawode Racheal', '813446355', '9 Blue House Klm 17 Alakia Express Celical Ibadan', '', 'HND', 'Head Office', 'Head office', 'Compliance', 'Manager', '2012-08-02', '1', '110000', 'Executive Assistant_4', 'ACCESS BANK', '044', '811446464', 'O pos', '8', '', '', '$2y$10$c3.dVPfmtFlmsv8BN979C.OjVqhBSZ2eFIIPp3sfJq1Xoh1beZVze', '1', '', ''),
(259, '97', 'OLANIYI', 'ISOLA', 'OLASUNKANMI', '8034870968', 'bukolaolaniyi277@gmail.com', 'Male', 'Married', '13/05/1983', 'Olaniyi Sola', '8163835015', '32 Iyana Oluwa street Ilorin', '32 Iyana Oluwa street Ilorin', 'HND', 'Head Office', 'Head office', 'Compliance', 'Manager', '2013-03-02', '1', '95000', 'Executive Assistant_1', 'ACCESS BANK', '044', '812376108', 'O pos', '8', '', '', '$2y$10$iuvlx7j3aslE0Pi/Xr/U9eF0tmVLgPf.aXeYcEy1DAQW/uLlkz.ZK', '1', '', ''),
(260, '157', 'ABDUL ', 'OYEBOLA ', 'NAIMAH', '8071390055', 'bolaabdul31@gmail.com', 'female', 'Single', '', 'Adewusi Abdul', '9152776501', '34 Idiishin Quarters Elewuro Akobo Ojurin Ibadan', '34 Idiishin Quarters Elewuro Akobo Ojurin Ibadan', 'BSc', 'Head Office', 'Head office', 'Compliance', 'officer', '2015-02-01', '1', '90000', 'Executive Officer_4', 'ACCESS BANK', '044', '811789754', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(261, '172', 'OGUNWUSI', 'BLESSING', 'KEHINDE', '8034328916', 'kehindeogunwusi11@gmail.com', 'female', 'Married', '', 'Ogunwusi Oluwatoyin', '9036986479', '4 Ogbondoroko street Oke Laro Ilorin', '64 Alusekere Street Ede Osun', 'PGDE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Compliance', 'officer', '2015-05-19', '1', '90000', 'Executive Officer_4', 'ACCESS BANK', '044', '813565217', '1', '3', '', '', '$2y$10$Ldvxcx0irFWv5BCCjoZysOIa1k2W0S218IbZpe6ekSSIePL/mJeFC', '1', '', ''),
(262, '211', 'ODETAYO ', 'YINUSA', 'OLAWALE', '8164969294', 'yunusmedic@gmail.com', 'male', 'Married', '1984-07-21', 'Odetayo AbdulMuqeet', '8164969294', '9 Olootu Street Iyana Church Area Ibadan', 'Y E 35 Oye-Oke Street Adekunle Area Ila-Orangun Osun', 'B.Tech', 'Aroma', 'Aroma Iwo Road', 'Compliance', 'officer', '2017-07-28', '1', '95000', 'Executive Officer_2', 'ACCESS BANK', '044', '811643775', '4', '2', '1645543061.jpg', 'on', '$2y$10$sAQzObf6x6kc0IYx3XLwFuibLvV0ky52p4OaazsA3ekxvT9.oivn.', '1', '', ''),
(263, '293', 'SIYANBOLA', 'AZEEZ', 'ADEKUNLE', '8132552221', 'siyanbolaazeez1818@gmail.com', 'Male', 'Single', '12/04/1994', 'Siyanbola Luqman', '8116814649', 'Powerline Junction Irewolede Area Ilorin', '14 Islamic Street Ede Osun', 'HND', 'Head Office', 'Aroma Unity', 'Compliance', 'officer', '', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '1481539290', '', '8', '', '', '$2y$10$85wF2u79RwohkXIbMFVaXu2Wkrz8Chfr.6oOkrvTEKEtDLxSUya7m', '1', '', ''),
(264, '294', 'LABAIKA', 'IBRAHIM ', 'OLATUNJI', '7068380484', 'ibrahimlabaika360@gmail.com', 'Male', 'Married', '08/09/1989', 'Labaika Aisha', '9022021040', '33 Ndarabi Compound Karuma Street Ojagboro Ilorin', '33 Ndarabi Compound Karuma Street Ojagboro Ilorin', 'B.Sc', 'Head Office', 'Olak Pet. Ilorin(A-Division) ', 'Compliance', 'officer', '2020-11-30', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '1455569638', 'A pos', '8', '', '', '$2y$10$bmozqkD/uriW0tNy7c6EHOpQmTric2vjPNizuIvPQMiZ6P/E/byAu', '1', '', ''),
(265, '336', 'OKEWOLE', 'NURUDEEN', 'TAYO', '8138597781', 'okewolenurudeen@gmail.com', 'Male', 'Married', '20/03/1983', 'Azeez Barakat Okewole', '8164293146', 'Besides globa  phase.2  adura gbewa community  no 60 osere area ilorin kwara state', '', 'NCE', 'Gas', 'Olak Gas-Ilorin', 'Internal Control & Compliance', 'Officer', '10/05/2021', '1', '40000', 'Senior Office Assistant_2', 'GTB', '', '49355575', 'O pos', '', '', '', '$2y$10$790xNwuhrnwlcHh9vseoNeoyF5Al./oBvySfb7UlX5v3Cpb.7O7kS', '1', '', '1'),
(266, '381', 'JIMOH ', 'SODIQ ', 'OPEYEMI', '8131033036', 'jimohsodiq3@gmail.com', 'Male', 'Single', '31/10/1994', 'Jimoh Afis Olamilekan', '8112277675', 'As-Salam Villa Dan Giwa via Oke Ose Along Old Jebba Road Ilorin', '8 Maxwell Street Ajangbadi Ilemba Hausa Ojo Lagos', 'HND', 'Head office', 'Head office', 'Internal Control & Compliance', 'Officer', '01/09/2021', '1', '40000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '775621619', 'O neg', '', '', '', '$2y$10$y/vf65XubJzdxgPt2ai29./NR0grajtjF2LIiooAWlXZc4OvLWY3C', '1', '', '1'),
(267, '412', 'OLUGBAJE', 'AZEEZ', 'ADEKOLA', '7066268526', 'olugbaje488@gmail.vom', 'Male', 'Married', '14/07/1986', 'Aluko Babatunde Kabiru', '8148579803', '103 Costain Area Osogbo', '77 Balogun Compound Asipa Ife North Osun', 'HND', 'Head Office', 'Olak Pet. Ibadan', 'Compliance', 'Internal Control & Compliance', '2021-12-17', '1', '65000', 'Senior Security Officer_1', 'ACCESS BANK', '044', '52398477', 'A pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(268, '51', 'ENIMOLA ', 'JOSHUA', 'OLUTIMI', '8035285661', 'joemola2012@gmail.com', 'Male', 'Married', '24/05/1981', 'Enimola Blessing', '8054400046', '54 Oke Maro Temidire Amoyo Area Ilorin', '54 Oke Maro Temidire Amoyo Area Ilorin', 'HND', 'Head Office', 'Head office', 'MD\'s Office', 'Secretary', '2008-03-04', '1', '155000', 'Senior Executive Assistant_3', 'ACCESS BANK', '044', '9139061', 'O pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(269, '73', 'IGE ', 'KEHINDE', 'OLUSEYI', '8033788280', 'xlkenny4u@gmail.com', 'Male', 'Married', '04/07/1979', 'Ige Adebisi Dammy', '8034789008', 'Aleniboro/ Idi Egun Offa Garage Area Ilorin', '7 Matanmi Street Oroki Housing Estate Osogbo ', 'HND', 'Head Office', 'Head office', 'MD\'s Office', 'PA', '2011-02-01', '1', '135000', 'Executive Assistant_4', 'ACCESS BANK', '044', '810892590', 'A pos', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(270, '11', 'AYINLA ', 'AKEEM', 'OLALEKAN', '8033559033', 'akayinla@gmail.com', 'Male', 'Married', '17/10/1967', 'Rasheedat Ayinla', '8167745314', '20 Fate Road beside Total Filling Station off Peacork Street Ilorin', '20 Fate Road beside Total Filling Station off Peacork Street Ilorin', 'HND', 'Head office', 'Head office', 'Supervision', 'General Manager', '01/02/1992', '1', '', '', '', '', '', 'B pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(271, '33', 'ALAGBILE', 'EMMANUEL', 'LEKAN', '8037728136', 'sunday4real70@gmail.com', 'Male', 'Married', '', 'Alagbile Mayowa', '8180468104', '9 Taiye-Kehinde Street Sawmill Area Ilorin', '9 Taiye-Kehinde Street Sawmill Area Ilorin', 'HND', 'Head Office', 'Head office', 'Supervision', 'Manager', '2003-02-01', '1', '290000', 'Senior Manager_1', 'ACCESS BANK', '044', '9138923', '', '8', '', '', '$2y$10$UO9LXmn3wrhl/cIBc52QQ.i9E/RIUp4uxUIW3QzNOfWrQ1lAux4ki', '1', '', ''),
(272, '42', 'SALIU ', 'MOHAMMED ', 'YUSUF ', '8054788480', 'alhajisaliuyusuf@gmail.com', 'Male', 'Married', '17/05/1950', 'Alhaja A.O. Yusuf', '7089000456', '4 Fashola Closed Sawmill Ilorin', '4 Fashola Closed Sawmill Ilorin', 'NCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Supervision', 'supervisor', '2006-04-11', '1', '50000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '9139047', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(273, '62', 'ABDULSALAM', 'ABDULFATAI', 'ADEROPO', '9075433373', 'ropoabdulsalamfatai@gmail.com', 'Male', 'Married', '', 'AbdulSalam Aminat', '8072194148', '11 Mountain View Estate Akerebiata Ilorin', 'Eho Compound Etan', 'OND', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Supervision', 'Manager', '2008-09-09', '1', '90000', 'Executive Officer_4', 'ACCESS BANK', '044', '92684060', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(274, '232', 'AFOLAYAN', 'ABAYOMI', 'YEMI', '8105484306', 'abayomiyemi@gmail.com', 'Male', 'Married', '09/01/1993', 'Mr. Afolayan', '8036032338', '9 Anike Street Offa Garage Ilorin', '9 Arike Close Offa Garage Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Account', 'Cashier', '2019-06-15', '1', '50000', 'Office Assistant_1', 'ACCESS BANK', '044', '824044590', 'A', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(275, '245', 'JAMIU', 'MUHYDEEN ', 'ADANLA', '9066234030', '', 'Male', 'Married', '25/05/1999', 'Zakariyah Kamaldeen', '9039728992', 'Edun Street Isale Koto Ilorin', 'Edun Street Isale Koto Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division)', 'Sales', 'Attendant', '20/07/2019', '1', '20000', 'office Assistant_1', 'ACCESS BANK', '044', '824047728', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(276, '298', 'ABDULLAHI', 'MOHAMMED', '', '8104111370', 'mohabdulgadunje@gmail.com', 'Male', 'Single', '', 'Muhammed Yusuf', '8166254899', 'Beside A division Ajasa Ipo Road Ilorin', 'Alaguwa House Gaa-Akanbi Ilorin', 'SSCE', 'Petroleum', 'Olak Gas-Ilorin', 'Sales & Marketing', 'Sales Attendant', '2021-01-05', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1455370681', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(277, '300', 'SAUTA', 'ISMAIL', '', '9031378567', 'sautaismail2019@gmail.com', 'Male', 'Single', '22/11/1998', 'Saheed Sauta', '8029505989', '35 Isalekoto Street Ilorin', '35 Isalekoto Street Ilorin', 'SSCE', 'Gas', 'Olak Gas-Ilorin', 'Sales & Marketing', 'Sales Attendant', '2021-01-07', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1455549294', 'O pos', '6', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(278, '329', 'DUNG JUNG', 'SIMI ', 'VICTORIA', '7038342950', 'dungviccky@gmail.com', 'Female', 'Single', '13/10/1997', 'David Benjamin', '8107021918', '12 Jatto Phase 1 Kilanko Road Off Offa Garage Area Ilorin', '12 Jatto Phase 1 Kilanko Road Off Offa Garage Area Ilorin', 'OND', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2021-04-25', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1484444049', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(279, '330', 'JIMOH', 'KAFILAT', 'ADESEWA', '9031862535', 'jimohkafilatadesewa@gmaail.com', 'Female', 'Single', '', 'Jimoh Adetunji', '8055774284', '4 Anuoluwa Community Off Asa Dam Road Ilorin', '4 Anuoluwa Community Off Asa Dam Road Ilorin', 'NCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division)', 'Sales', 'Attendant', '25/04/2021', '1', '20000', 'office Assistant_1', 'ACCESS BANK', '044', '1481541844', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(280, '331', 'ABDUL YEKEEN', 'ISLAMIYAT', 'OMOBOLANLE', '9033279812', 'bolanleislamiyat00@gmail.com', 'Female', 'Single', '', 'AbdulYekeen Taibat', '9064508074', 'Alagbede Compound Niger Road Ilorin', 'Alagbede Compound Niger Road Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2021-04-27', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1481653563', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(281, '374', 'ABDULGANIU', 'JAMIU', '', '9026124414', '', 'Male', 'Married', '11/09/1989', 'AbdulGaniu Mariam', '9074049155', '36 Abata Jagun Okelele Area Ilorin', '36 Abata Jagun Okelele Area Ilorin', '', 'Petroleum', 'Olak Pet. Ilorin(A-Division)', 'Sales', 'Attendant', '07/01/2021', '1', '20000', 'office Assistant_1', '', '', '', 'B pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(282, '377', 'OLOJEDE', 'OLUWABUNMI ', 'MARY', '8147242111', 'bunmex16@gmail.com', 'Female', 'Single', '29/05/1996', 'Olojede Boluwatife', '9068611331', '26 Ifelodun Street Aiyetoro Odota Area Ilorin', '26 Ifelodun Street Aiyetoro Odota Area Ilorin', 'OND', 'Petroleum', 'Olak Pet. Ilorin(A-Division)', 'Sales', 'Attendant', '16/08/2021', '1', '20000', 'office Assistant_1', 'ACCESS BANK', '044', '1496549952', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(283, '378', 'AYILARA ', 'REBECCA', '', '8125377836', 'atinukeayilara21@gmail.com', 'Female', 'Single', '19/07/2001', 'Ayilara Oluwagbenga', '8163154037', '51 Temidire Street Okemaro Amoyo Kwara', '51 Temidire Street Okemaro Amoyo Kwara', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2021-08-16', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1493243455', 'O neg', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(284, '379', 'GOBIR ', 'SALISU', 'JAMIU', '9032055348', 'salisjamiugbobir2017@gmail.com', 'Male', 'Single', '29/07/1994', 'Gobir Ramat', '7068901791', 'G112 Gambari Baare Compound Ilorin', 'G112 Gambari Baare Compound Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division)', 'Sales', 'Attendant', '17/08/2021', '1', '20000', 'office Assistant_1', 'STERLING', '232', '71137721', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(285, '387', 'ISSA ', 'KAZEEM ', 'ABOLAJI', '8143165157', 'kcabolajissa@gmail.com', 'Male', 'Single', '', 'Issa Latifat', '9036273391', '20 Emir\'s Road Ilorin', '20 Emir\'s Road Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2021-09-28', '1', '30000', 'office Assistant_1', 'UBA', '033', '2204366104', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(286, '388', 'OLUWOLE ', 'TAIWO', 'CHRISTANAH', '9017795726', 'xtristywolet@gmail.com', 'Female', 'Married', '', 'Shodeinde Ore-Ofe', '8146024335', '29 Kilanko Road Offa Garage Ilorin', 'J22 Ile Alowolodu Street Osun Ekiti', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2021-10-01', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1505876026', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(287, '389', 'ABUBAKAR', 'MARYAM', 'TOYOSI', '8153549970', 'abubakarmaryamtoyosi@gmail.com', 'Female', 'Single', '01/05/2002', 'Abubakar Halimat', '9159470395', '69 Edun Street Ilorin', '69 Edun Street Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2021-10-04', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1505877236', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(288, '390', 'ADEOYE ', 'IDOWU ', 'BLESSING', '9023035481', 'idblessing0703@gmail.com', 'Female', 'Single', '', 'Ajiboye Odunola', '9033347192', 'Olulade Ilorin', 'Olulade Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2021-10-04', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1505956582', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(289, '200', 'ROTIMI ', 'SANNI', 'MUHAMMED', '8141685166', 'sannimohammed63@gmail.com', 'Male', 'Single', '15/09/1996', 'Rotimi Saheed', '8033368020', '11 Osin Street Ilorin', '11 Osin Street Ilorin', 'SSCE', 'Gas', 'Olak Gas-Ilorin', 'Sales', 'Attendant', '04/08/2016', '1', '30000', 'Office Assistant_3', 'ACCESS BANK', '044', '822077220', 'B pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(290, '228', 'ROWLAND ', 'SAMSON', 'YEMI', '8036450224', 'rollesxz@gmail.com', 'Male', 'Married', '18/11/1984', 'Rowland Bukola Oroniyi', '8130623649', '46A Itaesowapo Oko-Erin Ilorin', '46A Itaesowapo Oko-Erin Ilorin', 'HND', 'Gas', 'Olak Gas-Ilorin', 'Supervision', 'Manager', '16/04/2019', '1', '50000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '1436839866', 'B pos', '', '', '', '$2y$10$tvAU8cblX00AqdzngzRa1.xktNG98RaZ5SJYmZOHJMpeRs95rUQVG', '1', '', '1'),
(291, '233', 'IBRAHIM', 'ABDULKADIR', '', '8032297173', 'dareoba@gmail.com', 'Male', 'Married', '20/04/1981', 'AbdulKadir Lukman', '8064476338', '7 Ita Aburo Centre Igboro Ilorin', '7 Ita Aburo Centre Igboro Ilorin', 'SSCE', 'Gas', 'Olak Gas-Ilorin', 'Sales & Marketing', 'Sales Attendant', '2019-06-15', '1', '40000', 'Office Assistant_3', 'ACCESS BANK', '044', '821379305', '', '6', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(292, '440', 'OLUSHOLA', 'EMMANUEL', '', '8184561928', 'bamideleemmanuel974@gmail.com', 'Male', 'Single', '26/09/2001', 'Olushola Omolola', '8032458095', '66 Aduralere Street Amilegbe Ilorin', '66 Aduralere Street Amilegbe Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2021-01-10', '1', '30000', '', 'UBA', '033', '2201169146', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(293, '441', 'OMOTOSHO', 'GRACE', 'OYINDAMOLA', '8101703951', 'omotoshograce@gmail.com', 'Female', 'Single', '27/08/1992', 'Nelson Omotosho', '8160562321', '1 Temidire Street Oke Maro Amoyo Kwara', '1 Temidire Street Oke Maro Amoyo Kwara', 'OND', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2021-01-10', '1', '30000', '', 'ACCESS BANK', '044', '57787762', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(294, '32', 'ADEGOKE ', 'SUNDAY', '', '8030630793', 'adele79@gmail.com', 'Male', 'Married', '', 'Adegoke Oluwayemisi', '8062606868', 'New Era Water View Behind Eucharistic Ilorin', 'New Era Water View Behind Eucharistic Ilorin', 'NCE', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2003-12-20', '1', '85000', 'Executive Officer_3', 'ACCESS BANK', '044', '9139308', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(295, '46', 'ADEDOKUN ', 'ELIJAH', 'ADEDIRE', '7039550509', 'adejah1110@gmail.com', 'Male', 'Married', '', 'Adedokun Opeyemi', '9062042647', '22 Owode Onirin Checking Point Area Ilorin', '22 Owode Onirin Checking Point Area Ilorin', 'OND', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2007-02-02', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '9139315', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(296, '21', 'BABALOLA ', 'BASIRU', 'OLOBU', '8039411445', 'babaolobubashy@gmail.com', 'Male', 'Married', '', 'Habeeb Babalola', '8067054630', 'Beside Love Water  Cocacola Road Babaode Ilorin', 'Beside Love Water  Cocacola Road Babaode Ilorin', 'FLSC', 'Petroleum', 'Olak Pet. Usanda', 'Supervision', 'supervisor', '2000-04-14', '1', '90000', 'Executive Officer_4', 'ACCESS BANK', '044', '9139054', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(297, '34', 'OKEWOLE ', 'OLUSEGUN ', 'AREO', '8066750288', 'agbawoleolak@gmail.com', 'Male', 'Married', '', 'Okewole Opeyemi', '9063987590', '6 Mantanmi Street Ajegunle Ilorin', '6 Mantanmi Street Ajegunle Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Usanda', 'Supervision', 'supervisor', '2004-01-10', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '9139250', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(298, '146', 'JIMOH ', 'ABDULLAHI', '', '8068325813', 'jimabdul05@gmail.com', 'male', 'Married', '1985-05-05', 'Abdullahi AbdulLateef', '8034592993', 'Aleniboro/ Idi Egun Offa Garage Area Ilorin', 'Aleniboro/ Idi Egun Offa Garage Area Ilorin', 'HND', 'Petroleum', 'Olak Pet. Usanda', 'Supervision', 'Manager', '2014-08-10', '1', '120000', 'Senior Executive Assistant_2', 'ACCESS BANK', '044', '72300142', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(299, '251', 'ADEBAYO', 'AISHAT', '', '8172312984', 'adebayoaishat3@gmail.com', 'Male', 'Single', '02/10/1994', 'Adebayo Amidat', '9098888588', '51 Ori Okoh Faagba Ilorin', '51 Ori Okoh Faagba Ilorin', 'OND', 'Petroleum', 'Olak Pet. Usanda', 'Sales', 'Sales attendant', '30/09/2019', '1', '20000', 'office Assistant_1', 'ACCESS BANK', '044', '1413712827', 'B pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(300, '252', 'ISMAIL ', 'OLAYINKA', 'MUHYDEEN', '9075223432', 'muhydeen383@gmail.com', 'Male', 'Single', '12/08/1998', 'Bola Saudat', '8062769988', '26 Isale Koko Dumoh Ilorin', '26 Isale Koko Dumoh Ilorin', 'OND', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2019-10-01', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1395817121', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(301, '258', 'OLAYIOYE', 'OLAIDE', 'SOLOMON', '8167656505', 'olayioyesolomom24@gmail.com', 'Male', 'Single', '22/07/1994', 'Olayioye Babatunde J', '7047522129', '37 Oja Iya Street Off Ita Amodu Ilorin', '37 Oja Iya Street Off Ita Amodu Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2019-11-11', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1436067010', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(302, '288', 'ISMOIL ', 'MUMEEN', 'OLAWALE', '8162698107', 'mumeenolawale07@gmail.com', 'Male', 'Married', '', 'Mumeen Muhammed Fathu', '7045054371', '14 Ogunmi Compound Agaaka Ilorin', '20 Ajia Compound Agaka Ilorin', 'NCE', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2020-10-02', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1395753850', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(303, '292', 'ABDULRASAQ ', 'YUSUF ', 'OLATUNJI', '9035699048', 'abdulrasaqolatunji@gmail.com', 'Male', 'Single', '01/03/1996', 'AbdulRasaq Muhammed', '9071646040', '7 Fagba Street Emir\'s Palace Ilorin', '7 Fagba Street Emir\'s Palace Ilorin', 'NCE', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2020-10-19', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1436111432', 'A pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(304, '333', 'SAKARIYAU', 'FALILAT', '', '8151109423', 'zhakariyahfalilat24@gmail.com', 'Female', 'Single', '', 'Sakariyau Aishat', '8137370591', '24 Asaju Compound Idi-Ape Ilorin', '24 Asaju Compound Idi-Ape Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2021-02-28', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1480272750', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(305, '337', 'ABDULAZEEZ ', 'MEDINAT', '', '7019319621', 'medabdul10@gmail.com', 'Female', 'Married', '', 'Adebayo Fatimoh', '8125540865', 'G1 Idris Ajao Street Akerebiata Ilorin', 'G1 Idris Ajao Street Akerebiata Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2021-05-26', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1479292970', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(306, '376', 'TOHEEB ', 'USMAN', '', '805930529', 'usmantoheeb44@gmail.com', 'Male', 'Single', '01/01/1999', 'Lukman Idris', '8094939703', '5 Ile Oniwasi Isalekoto Ilorin', '5 Ile Oniwasi Isalekoto Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2021-06-01', '1', '30000', 'office Assistant_1', 'ACCESS BANK', '044', '1436855525', 'A pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(307, '380', 'ANDA ', 'JOY', 'TERE-ERE', '137397541', '', 'Female', 'Single', '01/06/2003', 'Mr. A.M. Anda', '8034646376', 'Block 49 Sobi Military Barracks Ilorin', 'Block 49 Sobi Military Barracks Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Usanda', 'Sales', 'Sales attendant', '19/08/2021', '1', '20000', 'office Assistant_1', 'FCMB', '214', '8183924017', 'A pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(308, '439', 'ADISA', 'RIDWANULLAH', 'OLATUNJI', '9013969267', 'olatunjiadisa20@gmail.com', 'Male', 'Single', '20/07/2000', 'Moshood Sulaiman', '9035722572', '84 Akerebiata Lane Ilorin', '84 Akerebiata Lane Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2022-01-10', '1', '30000', 'office Assistant_2', 'GTB', '', '538502514', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(309, '259', 'BAMIDELE', 'BOSEDE', '', '915345346', 'muyiwabose60@gmail.com', 'Female', 'Married', '', 'Salahudeen Ini-Oluwa', '8077338516', '86 Aduralere Street Amilegbe Ilorin', '86 Aduralere Street Amilegbe Ilorin', 'SSCE', 'Petroleum', 'Olak Pet. Usanda', 'supermarket', 'Sales Representative', '2019-11-14', '1', '35000', 'office Assistant_2', 'ACCESS BANK', '044', '84672365', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(310, '16', 'ABDULSALAM', 'SULEIMON', '', '8034756527', 'abdulsalamsualaimon29@gmail.com', 'Male', 'Married', '04/03/1975', 'AbdulSalam Mubarak ', '9064676001', '2 Zionist Estate Oluyole Ibadan', '2 Zionist Estate Oluyole Ibadan', 'SSCE', 'Petroleum', 'Head office', 'Procurement', 'Manager', '1998-04-12', '1', '340000', 'Senior Manager_1', 'ACCESS BANK', '044', '9138851', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '');
INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `last_name`, `other_name`, `phone`, `email`, `gender`, `marital_status`, `dob`, `kin_name`, `kin_phone`, `present_add`, `permanent_add`, `highest_qualification`, `company`, `branch`, `department`, `job_title`, `date_employed`, `employment_type`, `present_salary`, `grade_step`, `bank_name`, `bank_code`, `account_number`, `blood_group`, `company_id`, `photo`, `notification`, `hashed_password`, `update_profile`, `created_at`, `deleted`) VALUES
(311, '38', 'ADERIBIGBE ', 'MUDASIR', '', '8052926623', 'mudaaderibigbe10@gmail.com', 'Male', 'Married', '', 'Aderibigbe Roimat', '8051125104', 'Block 9&10 Abayomi Layout Alarere Ibadan', 'Block 9&10 Abayomi Layout Alarere Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Supervision', 'Manager', '2005-09-11', '1', '142500', 'Senior Executive Assistant _2', 'ACCESS BANK', '044', '16628099', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(312, '48', 'ISMAILA', 'SHERIFFDEEN ', 'OLASUNKANMI', '8060436419', 'sheriffdeenismaila98@gmail.com', 'Male', 'Married', '25/06/1984', 'Ismaila Aishat Taiwo', '9079980100', '31 Amuloko Idiose Ibadan', '31 Amuloko Idiose Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Supervision', 'supervisor', '2007-06-12', '1', '100000', 'Executive Assistant_2', 'ACCESS BANK', '044', '27207320', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(313, '49', 'ABIODUN', 'AMBALI', 'SULAYMAN', '8036877024', 'abiodunambali@gmail.com', 'Male', 'Married', '', 'Abiodun Barakat', '8032122384', 'Zone 2 Jaloke Aba Alfa Olami Area Ibadan', 'Zone 2 Jaloke Aba Alfa Olami Area Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Supervision', 'supervisor', '2007-07-13', '1', '70000', 'Senior Office Assistant_4', 'ACCESS BANK', '044', '63502128', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(314, '109', 'SHITTU ', 'HAMMED', 'OLALEKAN', '8163633793', 'hammedshittu1410@gmail.com', 'Male', 'Married', '', 'Shittu Lateefat', '8152931578', '5 Akinrinade Street Hassana Academic Ibadan', '5 Akinrinade Street Hassana Academic Ibadan', 'SSCE', 'Head Office', 'Head office', 'Procurement', 'Procurement officer', '2014-08-19', '1', '50000', 'Office Assistant_1', 'ACCESS BANK', '044', '1224544422', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(315, '206', 'ABDULRASAQ ', 'JELILAT', 'ABIMBOLA', '8075532995', '', 'Female', 'Married', '10/10/1984', 'Busari Haliya', '8159305284', 'E7/1533 Ayekale Ibadan', 'E7/1533 Ayekale Ibadan', 'OND', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '', '1', '20000', 'Office Assistant_1', 'ACCESS BANK', '044', '29844090', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(316, '269', 'ALAKA ', 'SODIQ', 'OLAYINKA', '8107782788', 'ayinkus97@gmail.com', 'male', 'Single', '1996-09-29', 'Alaka Olamide', '7063977059', '21 Zone 2 Adeshina Street Akana Olunde Ibadan', '21 Zone 2 Adeshina Street Akana Olunde Ibadan', 'OND', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2020-02-29', '1', '30000', 'Office Assistant_1', 'ACCESS BANK', '044', '1390570230', '3', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(317, '369', 'SULAIMAN', 'HAMMED', '', '09137329246', 'sulaimanhammed@gmail.com', 'male', 'Married', '1994-07-17', '', '', '', '', '', 'Aroma', 'Eleyele', 'Cashier', 'Cashier', '2013-12-01', '1', '50000', 'Office Assistant_1', 'ACCESS BANK', '044', '0055693623', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(318, '399', 'TAIWO ', 'OLORUNJUWON', 'TIMILEYIN', '8109050403', 'ttjuwon712@gmail.com', 'Male', 'Single', '', 'Olumide Taiwo', '9022909084', '2 Temidire Street Odo Oba Ibadan', 'Soka Area Isokan Ibadan', 'OND', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2021-10-18', '1', '30000', 'Office Assistant_1', 'ACCESS BANK', '044', '1510060946', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(319, '400', 'OLADIPUPO ', 'TESLEEM', '', '8021789086', 'oladipupooladapo93@gmail.com', 'Male', 'Single', '22/10/2003', 'Oladipupo Azeez', '', '6 Fadairo Street Orita Challenge Ibadan', '6 Fadairo Street Orita Challenge Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2021-10-18', '1', '30000', 'Office Assistant_1', 'ACCESS BANK', '044', '1509644205', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(320, '401', 'MARY', 'DICKSON ', 'OLUWASEUN', '8182083557', 'maryseunson1510@gmai.com', 'Female', 'Single', '', 'Dickson Alice Itunu', '7052570973', '11 Gbajumo Street Boluwaji Area Ibadan', '11 Gbajumo Street Boluwaji Area Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2021-10-18', '1', '30000', 'Office Assistant_1', 'ACCESS BANK', '044', '1509643411', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(321, '402', 'ADEWOLE', 'IDOWU ', 'ORIYOMI', '7089918330', 'oriyomiadewole28@gmail.com', 'Female', 'Single', '10/06/1999', 'Adewole Kehinde Khadijat', '8151460826', '2 Atagba Street Jaloke Alagunfhon Ibadan', '2 Atagba Street Jaloke Alagunfhon Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'supermarket', 'Sales Representative', '2021-10-18', '1', '30000', 'Office Assistant_1', 'ACCESS BANK', '044', '1509644542', 'O neg', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(322, '403', 'FABAYO ', 'DANIEL', 'OLUWATIMILEHIN', '8167418338', 'dollyphabz@gmail.com', 'Male', 'Single', '05/10/1997', 'Yusuf Dolapo', '8151563819', '1 Elder Ilori Street Olomi Omiyale Academy Ibadan', '1 Elder Ilori Street Olomi Omiyale Academy Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2021-10-18', '1', '30000', 'Office Assistant_1', 'ACCESS BANK', '044', '1509416343', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(323, '404', 'ADETUNJI ', 'OPEYEMI', 'MICHAEL', '7017978839', 'opeyemi1797@gmail.com', 'Male', 'Single', '07/08/2000', 'Adetunji Abosede', '8059723788', '24 Ayegun Street Olomi Ibadan', '21 Oluwalogbon Estate Ayegun Olomi Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Sales', 'Attendant', '18/10/2021', '1', '20000', 'Office Assistant_1', 'ACCESS BANK', '044', '1509415724', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(324, '405', 'ABDULGANIYU', 'DAUDA', ' OLALEKAN', '8039324494', '', 'Male', 'Married', '14/06/1984', 'AbdulGaniyu Faisat', '8101374246', '119 Olubode Street Ore-Meji Igi Sogba Agugu Ibadan ', '119 Olubode Street Ore-Meji Igi Sogba Agugu Ibadan ', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Sales', 'Attendant', '18/10/2021', '1', '20000', 'Office Assistant_1', 'ACCESS BANK', '044', '44180839', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(325, '425', 'AKINTOLA ', 'BOLUWATIFE ', 'HANNAH', '7012505651', 'boluwatifeakintola00@gmail.com', 'Female', 'Single', '15/04/2002', 'Samuel', '8151126731', 'Behind Olak Filling Station Toll gate Ibadan', 'Behind Olak Filling Station Toll gate Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2021-12-06', '1', '30000', 'Office Assistant_1', 'ACCESS BANK', '044', '1500468332', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(326, '426', 'ADEJUMOBI ', 'NOFISAT ', 'ENIOLA', '9134975015', 'enyade1207@gmail.com', 'Female', 'Single', '', 'Adejumobi Adenike', '8106509505', 'Ajegunle Street Olorunsogo Omowumi Area Ibadan', 'Ajegunle Street Olorunsogo Omowumi Area Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2021-12-06', '1', '30000', 'Office Assistant_1', '', '', '', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(327, '434', 'KEHINDE ', 'ADEOLA ', 'AKOREDE', '', '', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '1', '', '', '', '', '', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(328, '435', 'TAIWO ', 'OLUMIDE ', 'JOSHUA', '', '', 'Male', '', '', '', '', '', '', '', 'Aroma', 'Aroma Iwo Road', 'Human Resource', 'Driver', '2022-01-06', '1', '30000', '', '', '', '', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(329, '436', 'PHILIP ', 'GLORY ', 'ABOSEDE', '08085299849', 'gloryabosede2410@gmail.com', 'female', 'Single', '2004-01-24', 'Phillip Grace Oluwayemisi', '', '34 Peace Zone Road 5 Moganna Councilor\'s Street Idi Iroko\r\n', '34 Peace Zone Road 5 Moganna Councilor\'s Street Idi Iroko\r\n', '', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2022-01-17', '1', '30000', '', 'ACCESS BANK', '044', '1525597589', '3', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(330, '437', 'OGINI ', 'BUNMI', 'GBEMI', '08063701414', 'oginni4bunmi@gmail.com', 'female', 'Married', '1978-04-06', 'Oginni Ayoola Isaac', '08055653335', '2 Agbaje Orita Challenge Ibadan\r\n', '2 Agbaje Orita Challenge Ibadan\r\n', '', 'Aroma', 'Aroma Toll-Gate', 'Kitchen', 'cook', '2021-01-07', '1', '40000', '', 'ACCESS BANK', '044', '1473299465', '7', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(331, '438', 'OMOTAYO ', 'DANIEL', 'TAYO', '08052301843', 'youngdaniel29@gmail.com', 'Male', '', '', '', '', '', '', '', 'Aroma', 'Aroma Iwo Road', 'Human Resource & Admin', 'Driver', '2022-01-06', '1', '38000', '', '', '', '', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(332, '39', 'OGHENEGUEKE', 'JANET', 'MARY', '9060151315', 'mary.ogheagueke@yahoo.com', 'Male', 'Married', '20/02/1980', 'Akindosu Janet', '8059106523', 'Mongana Councellor Zene 3 Alaka Ibadan', 'Mongana Councellor Zene 3 Alaka Ibadan', 'SSCE', 'Aroma', 'Head office', 'Procurement', 'officer', '2005-09-12', '1', '60000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '1225572873', 'A pos', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(333, '93', 'OYERINDE ', 'TUNDE Julius', 'JULIUS', '8052664999', 'oyerindej@gmail.com', 'Male', 'Married', '20/11/1986', 'Oyerinde .R. Bola', '09131456978', '2 College Crescent Molete Ibadan', 'Oba\'s Compound Ila-Odo Osun', 'NCE', 'Aroma', 'Aroma Iwo Road', 'Procurement', 'officer', '2013-01-05', '1', '70000', 'Senior Office Assistant_3', 'ACCESS BANK', '044', '50506095', 'A pos', '2', '', '', '$2y$10$UkD85tFaCRv5sPfI4VzmkOqXP21jx/HaNNlBY7zZYeYhOiE72rfda', '1', '', ''),
(334, '266', 'MUKAILA', 'OLAWUMI', 'MUSROFAT', '9099184170', 'musrofatolawumi@gmail.com', 'Female', 'Single', '01/05/1998', 'Adebare Salaudeen M.', '8034713682', 'Ifelajulo Zone 2 Olunde Area Ago Ibadan', 'Ifelajulo Zone 2 Olunde Area Ago Ibadan', 'SSCE', 'Petroleum', 'Olak Pet. Ibadan', 'supermarket', 'Cashier', '2020-02-04', '1', '30000', 'Office Assistant_1', 'ACCESS BANK', '044', '1507386273', 'O pos', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(335, '108', 'SALIMAN ', 'SULAIMAN ', 'AJANI', '8052820055', 'sulimansulaimanajan@gmail.com', 'Male', 'Married', '', 'Sulaiman Awwal', '8135346532', '2 AbdulSalam Akanbi Olunlade Ilorin', '2 AbdulSalam Akanbi Olunlade Ilorin', 'OND', 'Retail Outlet', 'Ilorin (Usanda) Sobi Road', 'Sales & Marketing', 'Sales Representative', '2013-08-13', '1', '50000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '35815458', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(336, '247', 'SHITTU ', 'ABDULWAHEED ', 'AKOREDE', '8033256059', 'shittuabdulwaheedakorede@gmail.com', 'Male', 'Married', '28/01/1982', 'Shittu Hammed Anigilaje', '8035097969', 'Osin Aremu Area Ilorin West LGA', 'Osin Aremu Area Ilorin West LGA', 'OND', 'Retail Outlet', 'Ilorin (Usanda) Sobi Road', 'Sales & Marketing', 'Sales Representative', '2019-08-01', '1', '40000', 'Office Assistant _3', 'ACCESS BANK', '044', '826423911', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(337, '20', 'BELLO ', 'EMMAMUEL', 'BABATUNDE', '8066516520', 'belloemma2015@gmail.com', 'Male', 'Married', '20/09/1976', 'Bello Adenike', '8030420657', 'Kilanko Road off Offa Garage Ilorin', 'Kilano Road off  Offa Garage Ilorin', 'HND', 'Retail Outlet', 'Ilorin (A division)', 'Supervision', 'Manager', '2000-01-02', '1', '200000', 'Senior Executive Assistant_5', 'ACCESS BANK', '044', '9138813', 'A pos', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(338, '107', 'RASAQ', 'AHMED ', 'OLAITAN', '8094788460', 'rasaqahmed2021@gmail.com', 'Male', 'Married', '06/04/1992', 'Ahmed Aishat', '8145295030', '7 Fagba Compound Ilorin', '7 Fagba Compound Ilorin', 'SSCE', 'Retail Outlet', 'Ilorin (A division)', 'Sales & Marketing', 'Sales Representative', '2013-08-13', '1', '50000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '35828676', 'O pos', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(339, '183', 'ADEMOLA', 'RASAQ ', 'AKINOLA', '8030463561', 'adeakinolarasaq@gmail.com', 'Male', 'Married', '', 'Yusuf Akinola', '8132164809', '2 Surulere Street Ganmo Ilorin', '2 Surulere Street Ganmo Ilorin', 'SSCE', 'Retail Outlet', 'Ilorin (A division)', 'Sales & Marketing', 'Sales Representative', '2005-12-15', '1', '80000', 'Executive Officer_2', 'ACCESS BANK', '044', '9139078', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(340, '246', 'JIMOH', 'IDOWU', 'KAZEEM', '8036783960', 'idkcj@gmail.com', 'Male', 'Married', '', 'Yusuf Salamat', '7030880032', '3 Owoseni Adeshina Street IGS Sawmill Ilorin', '3 Owoseni Adeshina Street IGS Sawmill Ilorin', 'SSCE', 'Retail Outlet', 'Ilorin (A division)', 'warehouse', 'Store officer', '2019-08-01', '1', '40000', 'Office Assistant_3', 'ACCESS BANK', '044', '823571361', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(341, '272', 'OLUDARE', 'TAIYE', '', '9151896255', 'omowolidare7@gmail.com', 'Male', 'Married', '', 'Oludare Blessing', '9122149448', 'D16 Budo Iya Ita-Alamu Ilorin', 'D16 Budo Iya Ita-Alamu Ilorin', 'SSCE', 'Retail Outlet', 'Ilorin (A division)', 'Sales & Marketing', 'Sales Representative', '2022-05-07', '1', '40000', 'Office Assistant_3', 'ACCESS BANK', '044', '1395818575', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(342, '286', 'LAWAL ', 'SIJUWOLA', 'IBRAHIM', '8032427840', 'independentmathematician@gmail.com', 'Male', 'Married', '', 'Lawal Tosin Ismail', '9030960139', 'Behinde Matrix Filling Station Ita-Alamu Ilorin', 'Behinde Matrix Filling Station Ita-Alamu Ilorin', 'BSc', 'Retail Outlet', 'Ilorin (A division)', 'Supervision', 'Manager', '2000-10-01', '1', '180000', 'Deputy Manager_1', 'ACCESS BANK', '044', '9139339', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(343, '289', 'ADEBAYO ', 'MUBARAK', 'OLAIDE', '8147522177', 'mubarakaide77@gmail.com', 'male', 'Married', '1987-08-08', 'Adebayo Barakat Bisola', '8168657082', 'Olufimo Compound Oketto Oyo', 'Olufimo Compound Oketto Oyo', 'SSCE', 'Retail Outlet', 'Ilorin (A division)', 'Sales & Marketing', 'Sales Representative', '2020-10-07', '1', '40000', 'Office Assistant_3', 'ACCESS BANK', '044', '1436831901', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(344, '47', 'OLANIYI ', 'HAMMED', 'ARANSIOLA', '8033103685', 'hamedolaniyi971@gmail.com', 'Male', 'Married', '28/09/1983', 'Olaniyi Fausat', '8034189504', 'Irewolede beside Marvelous Hotel Ilorin', 'Irewolede beside Marvelous Hotel Ilorin', 'NCE', 'Retail Outlet', 'Ilorin (Usanda) Sobi Road', 'Supervision', 'Manager', '2007-03-12', '1', '80000', 'Executive Officer_2', 'ACCESS BANK', '044', '9138772', 'A', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(345, '201', 'FIFELOLA ', 'OLAMILEKAN ', 'STEPHEN', '8185109195', 'olamilekanstephen45@gmail.com', 'Male', 'Married', '28/08/1998', 'Idowu Fifelola', '8069505596', '17 Cementry Road Irewolede Yidi Road Ilorin', '47 Mejidadi Street Ita Amodu Ilorin', 'OND', 'Retail Outlet', 'Ilorin (Usanda) Sobi Road', 'Sales & Marketing', 'Sales Representative', '2012-08-19', '1', '50000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '81219871', 'A pos', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(346, '40', 'ISSA ', 'JIMOH', '', '8062087624', 'issahjimoh@gmail.com', 'Male', 'Married', '19/12/1980', 'AbdulRasaq Issa', '8063094789', '12 Giwa Adinni Close beside Olawore Complex Sanyo Ibadan', '45 Opomalu Street Ilorin', 'OND', 'Retail Outlet', 'Ibadan (Iwo Road)', 'Supervision', 'Manager', '2005-09-19', '1', '155000', 'Senior Executive Assistant_4', 'ACCESS BANK', '044', '9138899', 'A pos', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(347, '44', 'AYUBA ', 'TAOFEEK', '', '8052202803', '', 'Male', 'Married', '05/10/1973', 'Taofeek Barakat', '7039675743', '38 Irewole Olokofefe Fatusi Ibadan', '38 Irewole Olokofefe Fatusi Ibadan', 'SSCE', 'Retail outlet', 'Ibadan (Iwo Road)', 'Sales', 'Sales attendant', '05/07/2006', '1', '70000', 'Executive Officer_4', 'ACCESS BANK', '044', '9139205', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(348, '67', 'SULAIMAN ', 'TAOFEEK ', 'KOLAWOLE', '8071998516', 'taofeekkolawole@gmail.com', 'Male', 'Married', '05/05/1981', 'Olabisi Adijat Oparinde', '8052132405', 'Arolu Street Adogba Road Monatan Ibadan', '101 Sule Manager Street Iwo Road Ibadan', 'HND', 'Retail Outlet', 'Ibadan (Iwo Road)', 'Supervision', 'Assistant Manager', '2010-03-05', '1', '100000', 'Executive Assistant_1', 'ACCESS BANK', '044', '59050710', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(349, '140', 'LAWAL', 'HABEEB ', 'KEHINDE', '7055777167', 'hawwalkenny@gmail.com', 'Male', 'Married', '', 'Lawal Habibat', '8168626384', '4 Omotosho Street Iyana Agbala Iwo Road Ibadan', '10 Arubiewe Aremo Ibadan', 'SSCE', 'Retail Outlet', 'Ibadan (Iwo Road)', 'Sales & Marketing', 'Sales Representative', '2013-11-11', '1', '50000', 'Senior Office Assistant_2', 'ACCESS BANK', '044', '58995706', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(350, '187', 'SALAWUDEEN ', 'SARAFA ', 'TEMITOPE', '8118481111', 'omotoyinbotemitope112@gmail.com', 'Male', 'Married', '', 'Fasilat Salawudeen', '9050542507', 'Ojo Express Elewu Odo Ibadan', 'Ojo Express Elewu Odo Ibadan', 'SSCE', 'Retail Outlet', 'Ibadan (Iwo Road)', 'Sales & Marketing', 'Sales Representative', '2015-01-05', '1', '45000', 'Senior Office Assistant_1', 'ACCESS BANK', '044', '73257528', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(351, '254', 'SOLOMON', 'OLAYEMI ', 'JOSHUA', '8132363597', 'soloyemij@gmail.com', 'Male', 'Married', '', 'Olayemi Ayomide', '8154399877', '17 Olosan Area Best Way Iwo Road Ibadan', '17 Olosan Area Best Way Iwo Road Ibadan', '', 'Head Office', 'Ibadan (Iwo Road)', 'Human Resource & Admin', 'Security', '2019-10-01', '1', '38000', 'Office Assistant_3', '', '', '', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(352, '308', 'RIDWANULLAHI', 'ABASS', 'OJO', '9034347074', '', 'Male', 'Married', '29/10/1993', 'Abass Hajarat', '8118542131', '27 Coperative 2 Ogbere Idi Osa Muslim Ibadan', '4 Omilabu Area Odinjo Ibadan', 'OND', 'Retail outlet', 'Ibadan (Iwo Road)', 'Sales', 'Sales attendant', '20/01/2021', '1', '30000', 'Office Assistant_3', 'ACCESS BANK', '044', '1450719256', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(353, '309', 'ADEJUMO ', 'KHALID', 'GBOLAHAN', '9047192909', 'khalidgbolahan6@gmail.com', 'Male', 'Single', '11/09/2000', 'Alhaji Ismail Olanipekun', '8110235408', '20 Abaodan Street Monatan Ibadan', '20 Abaodan Street Monatan Ibadan', 'SSCE', 'Retail Outlet', 'Ibadan (Iwo Road)', 'Sales & Marketing', 'Sales Representative', '2021-01-25', '1', '40000', 'Office Assistant_3', 'ACCESS BANK', '044', '1228414299', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(354, '365', 'AMIIDU ', 'AFOLABI', '', '', '', 'Male', '', '', '', '', '', '', '', 'Retail Outlet', 'Ibadan (Iwo Road)', 'Sales & Marketing', 'Sales Representative', '2003-01-01', '1', '127500', 'Assistant Manager_2', 'ACCESS BANK', '044', '9139236', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(355, '445', 'OLANREWAJU ', 'MUKAILA', 'OWOLABI', '8155090083', 'owomukailao@gmail.com', 'male', 'Single', '1992-04-21', 'Olanrewaju Abolaji', '9047594474', '56 Adabata Road Off Baboko Ilorin ', '56 Adabata Road Off Baboko Ilorin ', 'SSCE', 'Retail Outlet', 'Ilorin (A division)', 'Sales & Marketing', 'Sales Representative', '2022-01-04', '1', '40000', 'Office Assistant_3', '', '', '', '', '1', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(356, '12', 'BELLO ', 'BABATUNDE', 'RAHEEM', '8036694852', 'raheemtundebello76@gmail.com', 'Male', 'Married', '01/08/1976', 'Bello Babatunde Wasiu', '8035736216', '2 Gate behind Matrix Petrol Station Ita Alamu Ilorin', '2 Gate behind Matrix Petrol Station Ita Alamu Ilorin', 'OND', 'Transport', 'Head office', 'Transport', 'Manager', '1993-01-08', '1', '200000', 'Deputy Manager_3', 'ACCESS BANK', '044', '9130298', 'O pos', '7', '', '', '$2y$10$5y8MBqABFqlKZ7/RUJYNFOGUN1fR14skiD2ISz4MEbNqfJuQvBvbe', '1', '', ''),
(357, '26', 'OLATUNJI', 'GANIYU ', '', '7037226777', 'alhajigani69@gmail.com', 'Male', 'Married', '', 'Surajudeen Olatunji', '8142697076', '75 Isale Jagun Street Ilorin', '75 Isale Jagun Street Ilorin', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2001-10-20', '1', '68000', 'Assistant Senior Driver_2', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(358, '31', 'ADEYEMI ', 'HAMEED', '', '8032197500', 'adeameed58@gmail.com', 'Male', 'Married', '', 'Hammed Waheed Adeyinka', '7033917109', '70 Owoyemi Crescent Ita Alamu Ilorin', '70 Owoyemi Crescent Ita Alamu Ilorin', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2003-11-18', '1', '91000', 'Senior Driver_4', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(359, '37', 'KOSAMOTU ', 'AKANBI', '', '7062938121', 'kosamotakanbi62@gmail.com', 'Male', 'Married', '', 'Afusat Kosamotu', '7034829769', 'Abuja Lane 3 Kilanko Offa Garage Ilorin', '19 Pakata Road Ilorin', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2005-07-17', '1', '38000', 'Driver_1', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(360, '45', 'TAIWO', 'RAUFU ', '', '8032338352', 'traufu55@gmail.com', 'Male', 'Married', '', 'Abdulrauf Risikat', '8068715265', 'Oke Rofun Ajaekusi Ogbomoso', 'Oke Rofun Ajaekusi Ogbomoso', '', 'Transport', 'Head office', 'Transport', 'Driver', '2006-11-12', '1', '53000', 'Driver_3', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(361, '59', 'SALAUDEEN', 'ABDULKARIM', '', '8063100210', 'salaukarim56@gmail.com', 'Male', 'Married', '', 'Dr. Biodun Abdulkareem', '8162918473', '101 Salami Subairu Street Ilorin', '101 Salami Subairu Street Ilorin', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2008-06-12', '1', '53000', 'Driver_4', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(362, '76', 'AYINLA ', 'JAMIU', 'BABALOKE', '8033805067', 'ayjamiu74@gmail.com', 'Male', 'Married', '', 'Jamiu Balikis', '8165983224', 'Adabata Area Ilorin', 'Adabata Area Ilorin', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2008-05-10', '1', '53000', 'Driver_4', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(363, '89', 'ISIAKA  ', 'AMUDA ', 'RAIMI', '7045615258', 'isamuda51@gmail.com', 'Male', 'Married', '', '', '9064177098', '12 Ajikobi Road Omoda Area Ilorin', '12 Ajikobi Road Omoda Area Ilorin', '', 'Transport', 'Head office', 'Transport', 'Driver', '2008-08-15', '1', '38000', 'Driver_1', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(364, '132', 'ALAAYA ', 'SOLIU', '', '8155090076', 'alaayasoliu@gmail.com', 'Male', 'Married', '', '', '', 'Oke Oyi Ilorin East LGA', 'Oke Oyi Ilorin East LGA', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2013-12-01', '1', '38000', 'Driver_1', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(365, '134', 'OGUNTUNDE', 'KOLAWOLE', 'OGUNDIPE', '7063087652', '', 'Male', 'Married', '10/12/1960', 'Seun Oguntunde', '8105662910', 'Saka-Saka Street Odo -Ota Ilorin ', 'Saka-Saka Street Odo -Ota Ilorin ', 'FLSC', 'Transport', 'A division', 'Transport', 'Truck Driver', '10/12/2014', '1', '38000', 'Driver_3', '', '', '', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(366, '138', 'ISSA ', 'KAREEM', '', '8096586266', 'issakareem82@gmail.com', 'Male', 'Married', '', 'Issa Fatimat Omowumi', '8169169527', '20 Galiki Area Sango Ilorin ', '20 Galiki Area Sango Ilorin ', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2011-02-04', '1', '49000', 'Driver_3', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(367, '139', 'HAMMED ', 'BABATUNDE', '', '9058653889', '', 'Male', 'Married', '25/12/1988', 'Idrs Hammed', '9014936088', '14 Ile Iya Ipapo Adabata Ilorin', '14 Ile Iya Ipapo Adabata Ilorin', 'FLSC', 'Transport', 'A division', 'Transport', 'Truck Driver', '16/02/2014', '1', '38000', 'Driver_3', '', '', '', 'O pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(368, '151', 'SALMAN ', 'ABULRAHMAN', '', '9036067658', 'saahman54@gmail.com', 'Male', 'Married', '', 'AbdulRahman Sakirat', '9066401001', '70 Adabata Street Ilorin', '70 Adabata Street Ilorin', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2012-12-08', '1', '49000', 'Driver_3', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(369, '165', 'IBRAHIM ', 'TAJUDEEN', '', '8028913158', 'ibrahimtajudeen@gmail.com', 'Male', 'Married', '', 'Ibrahim Adewale', '', '2 Ioworin Block Alase Moniyah Ibadan', '2 Ioworin Block Alase Moniyah Ibadan', '', 'Transport', 'Head office', 'Transport', 'Driver', '2006-03-15', '1', '49000', 'Driver_3', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(370, '168', 'SHEU ', 'SULYMAN', '', '9032129433', 'lyman59@gmail.com', 'Male', 'Married', '', 'Shehu Balikis', '7030363187', '53 Okelele Street Ilorin', '53 Okelele Street Ilorin', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2009-04-19', '1', '49000', 'Driver_3', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(371, '198', 'ALAMU ', 'JOHN ', 'AJADI', '9067835858', 'alamuj64@gmail.com', 'Male', 'Married', '', 'Alamu Samuel', '7068837979', 'Idi Oro Oke Alapata Ogbomoso', 'Idi Oro Oke Alapata Ogbomoso', '', 'Transport', 'Head office', 'Transport', 'Driver', '2016-02-28', '1', '49000', 'Driver_3', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(372, '277', 'USMAN ', 'BOLAKALE', '', '7035855461', 'uakale56@gmail.com', 'Male', 'Married', '', 'Akeem Bolakale', '8109830809', 'G110 Gambari Ilorin', 'G110 Gambari Ilorin', 'FLSC', 'Transport', 'Head office', 'Transport', 'Driver', '2020-03-17', '1', '38000', 'Driver_1', '', '', '', '', '7', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(373, '414', 'ABDULRASAK ', 'SHIRU', '', '8142622630', '', 'Male', 'Married', '01/10/1960', 'Shiru Risikat', '8139433029', 'Shiru Compound 58 Pakata Road Ilorin', 'Shiru Compound 58 Pakata Road Ilorin', 'FLSC', 'Transport', 'A division', 'Transport', 'Truck Driver', '20/12/2021', '1', '30000', 'Driver_1', '', '', '', '', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(375, '1', 'AYEJO', 'FATIMO', '', '9061910605', 'alhajafatiayedjo@gmail.com', 'Female', 'Married', '', 'Muriana Idris', '8103726696', 'Olak Filling Station opposite Police A Division Barracks Ilorin', 'Olak Filling Station opposite Police A Division Barracks Ilorin', '', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Human Resource & Admin', 'Cleaner', '1999-07-06', '2', '21600', '', 'ACCESS BANK', '044', '814414295', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(376, '3', 'ADEGBOYE ', 'KUDIRAT', '', '8100958674', 'kudigboye68@gmail.com', 'Female', 'Married', '', 'Adegboye Olaleye', '8100494909', '10 Abayomi Atele Iwo Road Ilorin', '10 Abayomi Atele Iwo Road Ilorin', 'FLSC', 'Aroma', 'Aroma Iwo Road', 'Human Resource & Admin', 'Cleaner', '2008-12-01', '2', '40000', 'Office Assistant_3', 'WEMA', '035', '239344724', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(377, '4', 'ADEKUNLE ', 'EYINTAYO', 'COMFORT', '7062987745', 'adeeyintayocomfort@gmail.com', 'Female', 'Married', '', 'Abisola  Adekunle', '7037885903', 'Land of Mercy (New site) Reke Ogbondoroko Ilorin', 'Land of Mercy (New site) Reke Ogbondoroko Ilorin', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Cleaner', '2010-04-25', '2', '35000', 'Office Assistant_2', 'ACCESS BANK', '044', '65463806', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(378, '5', 'DICKSON ', 'DEBORAH', '', '8075546272', 'dicksondebby70@gmail.com', 'Female', 'Married', '', 'Agboola Oluwakemi', '8115731870', 'Adebayo Idi Ayunre Orile Ogo Ibadan', 'Adebayo Idi Ayunre Orile Ogo Ibadan', 'FLSC', 'Petroleum', 'Olak Pet. Ibadan', 'Human Resource & Admin', 'Cleaner', '2012-12-02', '2', '35000', '', 'ACCESS BANK', '044', '1224634088', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(379, '6', 'BENJAMEN ', 'BLESSING', '', '8104104766', 'benblessing80@gmail.com', 'Female', 'Married', '', 'Benjamen', '8148037253', '9 Iroyin Ayo Akerabiata Ilorin', '9 Iroyin Ayo Akerabiata Ilorin', 'FLSC', 'Petroleum', 'Olak Pet. Usanda', 'Human Resource & Admin', 'Cleaner', '2014-06-24', '2', '21600', '', '', '', '', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(380, '7', 'OLUWOLE ', 'FLORENCE', '', '8149956927', 'oluwoleflo70@gmail.com', 'Female', 'Married', '', 'Timothy Oluwole', '8139305950', '4 Jooro Street Egbejila Ilorin', '4 Jooro Street Egbejila Ilorin', 'FLSC', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Human Resource & Admin', 'Cleaner', '2015-07-09', '2', '25000', '', 'FIDELITY', '70', '6556290080', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(381, '8', 'ISSA ', 'SARATU ', 'TURE', '9060637490', 'saratuture83@gmail.com', 'Female', 'Married', '', 'Issa Uzafat', '', 'Olak Filling Station opposite Police A Division Barracks Ilorin', 'Olak Filling Station opposite Police A Division Barracks Ilorin', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Cleaner', '2015-06-15', '2', '21600', '', 'ACCESS BANK', '044', '816653519', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(382, '9', 'AGBOLA ', 'OLUWAKEMI', '', '8115731370', 'agbolakemo90@gmail.com', 'Female', 'Married', '', 'Oluwapelumi Agboola', '', '24 Adebayo Idi Ayuore Boluwaji Area Ibadan', '24 Adebayo Idi Ayuore Boluwaji Area Ibadan', 'FLSC', 'Petroleum', 'Olak Pet. Ibadan', 'Human Resource & Admin', 'Cleaner', '2016-01-10', '2', '35000', 'Office Assistant_2', 'ACCESS BANK', '044', '1226018442', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(383, '10', 'ADENIKE', 'SULEMAN', '', '8103526216', 'sulenikky62@gmail.com', 'female', 'Married', '', 'Wasiu Suleman', '9063498977', '22 Adamu Road Off Taiwo Road Ilorin', '22 Adamu Road Off Taiwo Road Ilorin', 'FLSC', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Human Resource & Admin', 'Cleaner', '2016-02-04', '2', '25000', '', 'FIDELITY ', '70', '6556397147', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(384, '11', 'OYEWOLE ', 'FUNMILOLA', '', '8033245325', 'oyelola70@gmail.com', 'Female', 'Married', '', 'Oyewole Esther Adeola', '9049132125', '3 Ona-Ara Street Off Eyini Road Orita Challenge Ibadan', '3 Ona-Ara Street Off Eyini Road Orita Challenge Ibadan', 'FLSC', 'Aroma', 'Aroma Toll-Gate', 'Human Resource & Admin', 'Cleaner', '2017-11-01', '2', '35000', 'Office Assistant_2', 'WEMA', '035', '245904091', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(385, '533', 'ABDULKADRIL', 'LUKMAN', 'OLAREWAJU', '7042127420', 'adisalukmano@gmail.com', 'male', 'Married', '1995-05-13', 'AbdulKadri AbdulLateef', '9028664613', '76 Edun Street Ilorin', '76 Edun Street Ilorin', 'FLSC', 'Gas', 'Olak Gas-Ilorin', 'Gas', 'Sales Attendant', '2018-07-18', '1', '40000', 'Office Assistant_3', 'UBA', '033', '2238913167', '', '6', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(386, '13', 'BABATUNDE ', 'BASIRAT', '', '8023984120', 'bababashy80@gmail.com', 'Female', 'Married', '', 'Babatunde AbdulBasheet', '8093985744', '75 Ile-Nla Ojagboro Ilorin', '75 Ile-Nla Ojagboro Ilorin', 'FLSC', 'Aroma', 'Aroma Unity', 'Human Resource & Admin', 'Cleaner', '2018-11-03', '2', '40000', 'Office Assistant_3', 'ZENITH', '057', '2254294657', '', '2', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(387, '14', 'OLASUNKUNMI', 'OLAREWAJU ', 'ABDULWASIU', '8124210752', 'olasukanmiwasiu28@gmail.com', 'Male', 'Married', '', 'AbdulWasiu Habibat', '135682633', 'Zone I Ifesowapo Community Aliara Off Asa Dam Ilorin', 'Zone I Ifesowapo Community Aliara Off Asa Dam Ilorin', 'SSCE', 'Petroleum', 'Ilorin (A division)', 'Human Resource & Admin', 'Cleaner', '2019-11-01', '2', '30000', '', 'GTB', '', '1657223110', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(388, '15', 'AFOLABI', 'KEHINDE ', 'AFUSAT', '8134715345', 'anutykehinde73@gmail.com', 'Female', 'Married', '', 'Afolabi Opeyemi', '8110099844', '5 Shesira Street Elekoyangan Area ', '5 Shesira Street Elekoyangan Area ', 'FLSC', 'Petroleum', 'Olak Pet. Usanda', 'Human Resource & Admin', 'Cleaner', '2020-10-30', '2', '30000', 'Office Assistant_2', 'ACCESS BANK', '044', '1396158500', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(389, '17', 'AZEEZ ', 'RASHEDAT', 'FUNMILAYO', '7050609705', 'rashylayoaz@gmail.com', 'Female', 'Married', '', 'Azeez Boluwatife', '', 'Behind Olak Filling Station Toll gate Ibadan', 'Behind Olak Filling Station Toll gate Ibadan', 'FLSC', 'Petroleum', 'Olak Pet. Ibadan', 'Human Resource & Admin', 'Cleaner', '2021-06-29', '2', '35000', 'Office Assistant_2', '', '', '', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(390, '21', 'HALIMAT', 'YAKUB', '', '', 'halimatyakub21@gmail.com', 'Female', 'Married', '', '', '', '', '', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Cleaner', '2021-11-01', '2', '21600', '', '', '', '', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(391, '22', 'MUSTAPHA ', 'ISSA', '', '9046151297', 'mmusty97@gmail.com', 'Male', 'Single', '', '', '', '', '', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Cleaner', '2021-12-01', '2', '40000', 'Office Assistant_3', '', '', '', '', '8', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(392, '23', 'HABIB', 'MAMUD', '', '8164025360', 'habibmamud23@gmail.com', 'Male', 'Married', '', 'Habib Medinat', '8075572675', 'Oke Suna Street Ilorin', 'Oke Suna Street Ilorin', 'FLSC', 'Petroleum', 'Olak Pet. Usanda', 'Human Resource & Admin', 'Cleaner', '2021-11-21', '2', '21600', '', 'GTB', '', '124573960', '', '4', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(393, '24', 'JIMOH ', 'GANIYU ', 'OLANREWAJU', '07068494186', 'jimohganiyulanre@gmail.com', 'male', 'Single', '1985-10-25', 'Yusuf Ganiyu Jimoh', '09132751164', '22 Opeloyeru Street Sawmill Garage Ilorin', '22 Opeloyeru Street Sawmill Garage Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Human Resource & Admin', 'Cleaner', '2022-01-18', '2', '40000', 'Office Assistant_3', '', '', '', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(394, '25', 'ISHOLA ', 'OLORUNTOBA', 'PETER', '07034172977', 'ginyginy007@yahoo.com', 'male', 'Single', '2002-04-25', 'Ishola Oluwakemi', '09051017332', 'Zone 18 Temidire Street Olemeta Ayoaye Kele Upper Igaakobi Ilorin', 'Zone 18 Temidire Street Olemeta Ayoaye Kele Upper Igaakobi Ilorin', 'SSCE', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Human Resource & Admin', 'Cleaner', '2022-01-18', '2', '40000', 'Office Assistant_3', '', '058', '0516772834', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(396, '1', 'RAKESH ', 'SHARMA', '', '8071390040', 'r.rakeshsharma78@rediffmail.com', 'male', 'Married', '1978-06-25', 'Anamika Rakesh', '8071390040', '4 Powerline beside Marvelour Hotel Irewolede', '4 Powerline beside Marvelour Hotel Irewolede', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Colourline', 'Manager', '2016-09-16', '1', '146000', '', '', '', '', '2', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(397, '2', 'ASHOK ', 'KUMAR', '', '8121354164', 'ashokrana1032017@gmail.com', 'Male', 'Married', '22/08/1962', 'Darshana Rana', '8121354164', 'Plot 5 New Yidi Road Ilorin', 'Plot 5 New Yidi Road Ilorin', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Maintenance', 'Manager', '2017-03-10', '1', '146000', '', '', '', '', 'B pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(398, '3', 'SANTOSH ', 'KUMAR ', 'KHATUA', '(91738) 186-1655', 'khatuasantoshkumar@gmail.com', 'Male', 'Married', '02/04/1985', 'Lil Khatua', '(91738)1134775', 'Plot 5 New Yidi Road Ilorin', 'Hypo-Putina PS Kamarda District Balasore State Odisha India', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mill Operation', 'Manager', '2019-03-06', '1', '110000', '', '', '', '', 'A pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(399, '4', 'SINGH ', 'NIRANJAH ', 'KUMAR', '7013257938', 'kumar.niranjan770@gmail.com', 'Male', 'Married', '25/04/1983', 'Anil Kumar Singh', '(91912)2625258', 'Plot 5 New Yidi Road Ilorin', 'V/PO- Khangaon P.S-Chandt Dist-Bhospur Bihar India', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'CRM Operation', 'Manager', '2019-03-06', '1', '110000', '', '', '', '', 'B pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(400, '5', 'MAURYA', 'UMESH', '', '9079156168', 'umeshmaurya4748u@gmail.com', 'Male', 'Married', '01/05/1983', 'Sunita Devi', '(91842)3425098', 'Plot 5 New Yidi Road Ilorin', 'Tahwa Bhawahi Chappar Bhihgari Bazar Deoria India', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'CRM Mill', 'Manager', '06/03/2019', '1', '', '', '', '', '', 'A pos', '', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', '1'),
(401, '6', 'KUMAR ', 'SURINDER', '', '9074368949', 'surinderdhiman1973@gmail.com', 'Male', 'Married', '14/03/1973', 'Reena Kumari', '(90743)68949', 'Plot 5 New Yidi Road Ilorin', 'Surinda Kumar Village Rajoh Palahi PO Ghallour Kangda HP India', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mechanical', 'Manager', '', '1', '160000', '', '', '', '', 'AB po', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(402, '7', 'ANSARI ', 'ABDULKASIM', '', '9015583517', 'abdulkasim012@gmail.com', 'Male', 'Married', '10/01/1984', 'Sabya Khatun', '(91907)8202490', 'Plot 5 New Yidi Road Ilorin', 'Vill-Agauthar Sundar Post Agauthar Nanda Bihar India', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'CRM Operation', 'Manager', '2019-05-06', '1', '110000', '', '', '', '', 'B pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(403, '8', 'NAYAK ', 'SUKANTA', 'KUMAR', '9015436413', 'sukantanatak777@gmail.com', 'Male', 'Married', '16/05/1983', 'Padmini Nayar', '(91814)4829109', 'Plot 5 New Yidi Road Ilorin', 'At Kendusahi PO Nuagan PS Rajkanika District Kendrapara India', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'CRM Operation', 'Manager', '2019-05-06', '1', '110000', '', '', '', '', 'O pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(404, '10', 'AVDHESH ', 'SINGH', '', '8087395128', '', 'Male', 'Married', '05/05/1971', 'Savitri Devi', '(91955)4888481', 'Plot 5 New Yidi Road Ilorin', 'Shukrydden Pur Machhechha Lakhlmpur Kheri Uttar prades India', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'CGL', 'Expatriate', '2020-10-22', '1', '110000', '', '', '', '', '', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(405, '11', 'YADAV ', 'JILAJEET', '', '9128929879', 'jjyadavpdp@gmail.com', 'Male', 'Married', '12/01/1979', 'Mrs Gayatri', '(91512)24140', 'Plot 5 New Yidi Road Ilorin', 'Khanjahan Pur District Azamgarh U.P. 223222 India', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Supervision', 'Expatriate', '2021-10-02', '1', '200000', '', '', '', '', 'B pos', '3', '', '', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '0', '', ''),
(406, '12', 'TRIPATHI ', 'SHASHI ', 'RANJAN', '9128929879', 'trushashi@gmail.com', 'Male', 'Married', '13/08/1984', 'Amrita Tripathi', '(91825)2903665', 'Plot 5 New Yidi Road Ilorin', 'Moh by pass road Shivpuri colony Daltonsian India', 'Expatriat', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Electrical', 'Manager', '2021-10-02', '1', '150000', '', '', '', '', 'O pos', '3', '', '', '$2y$10$aNl/CvX/vtFUSUyEHz/W6.enHSey2DZ9iPZZ4fmR12yQDR98tIHla', '1', '', ''),
(512, '434', 'AKOREDE', 'KEHINDE', 'ADEOLA', '09058908554', 'kehindeakorede114@gmail.com', 'female', 'Single', '1998-12-22', 'AKOREDE FOLASHADE', '09016620349', '77 AJEKUNLE STREET OLORUNSAGO IBADAN', '77 AJEKUNLE STREET OLORUNSAGO IBADAN', '', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2022-01-17', '1', '30000', '', 'ACCESS BANK', '044', '1415116168', '3', '4', '', '', '$2y$10$g75Fp78iP0wHWV2nSMc0K.sjxsIm1s2KU3/PO9rrjZM9SMcoSql1C', '0', '2022-02-09 12:35:11', ''),
(513, '448', 'Adebayo', 'Afolashade', 'Esther', '09129261066', 'xthershade@gmail.com', 'female', 'Single', '2022-01-17', 'Adebayo Emmanuel', '09157289382', 'Oloruntobi Zone 7B Soka Ibadan\r\n', 'Oloruntobi Zone 7B Soka Ibadan\r\n', '', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2022-01-17', '1', '30000', '', 'ACCESS BANK', '044', '1109704726', '3', '4', '', '', '$2y$10$EtcJm9UP8.8E6x2SVhgAweC8R8ThOQJ855s4OB9ocltUN9ZcT7cSC', '0', '2022-02-10 19:13:20', ''),
(514, '447', 'Odeniyan', 'Oluwayomi', 'Bukumi', '08164588834', 'odeniyanbukunmi@gmail.com', 'male', 'Married', '1989-10-10', 'Odeniyan Funwalayo', '08058769813', '15 Fest Mary Street Behind NASFAT Ilorin', '15 Fest Mary Street Behind NASFAT Ilorin', '', 'Head Office', 'Head office', 'Compliance', 'officer', '2022-02-01', '1', '50000', '', 'ACCESS BANK', '044', '0091321030', '1', '8', '', '', '$2y$10$XKZC8lG8N7C2CXFtLLyVsOgyBmOpIHuqifwuXVCk6I/FcoYb8Y1NO', '0', '2022-02-12 10:06:56', ''),
(516, '026', 'Mustapha', 'Abike', '', '', 'mustyabike@gmail.com', 'female', 'Married', '', '', '', '', '', '', 'Head Office', 'Head office', 'Human Resource & Admin', 'Cleaner', '2022-01-04', '2', '21600', '', '', '', '', '', '8', '', '', '$2y$10$zLhNhevvqaYEooTnDA2Ms.KsCz.LCLXZ0/Wg/ba3.wnvA2vfeBQ.C', '0', '2022-04-23 08:58:16', ''),
(517, '470', 'Muritala', 'Quadri', '', '07058836867', '', 'male', 'Married', '', '', '', '', '', '', 'Transport', 'Head office', 'Transport', 'Driver', '2022-03-16', '1', '30000', '', '', '', '', '', '7', '', '', '$2y$10$6qggeC3PMk4uDIq4nX1Qlu0hoJha/Uqgq2Bak8D/Xcm5bII0Vmoqe', '0', '2022-04-23 09:03:06', '1'),
(518, '474', 'LAMIDI', 'AKEEM', 'ADEREMI', '08035030556', 'lamidakeem68@gmail.com', 'male', 'Married', '1968-02-02', 'Folashade Aderemi', '08034342521', 'Ara Oyo Compound Oke Oyi Ilorin\r\n', 'Ara Oyo Compound Oke Oyi Ilorin\r\n', '', 'Transport', 'Head office', 'Transport', 'Driver', '2022-04-13', '1', '38000', '', 'UNION', '', '0038633990', '', '7', '', '', '$2y$10$Dde3m.HsAC3YSXKZvZUGG.6VoovypguXjMNggXXbFdjFso.XOHBgG', '0', '2022-04-23 09:09:04', ''),
(519, '475', 'TELLA', 'ASHIRU', 'MUKAILA', '08030993974', 'mutellashiru58@gmail.com', 'male', 'Married', '1958-08-18', 'Shakira Tella', '07033622419', '48, Irewolede Powerline Area Ilorin\r\n', '48, Irewolede Powerline Area Ilorin\r\n', '', 'Transport', 'Head office', 'Transport', 'Driver', '2022-04-13', '1', '38000', '', 'UBA', '', '2193686399', '', '7', '', '', '$2y$10$dNHubpFNwJ/sl80RCce1M.lz.DhLj.TSMrauURN5zxO77cUY2OGdK', '0', '2022-04-23 09:13:41', '1'),
(520, '471', 'SAIDU', 'MOHAMMED', 'KAMALDEEN', '08160686613', 'razalghul0@gmail.com', 'male', 'Single', '1991-08-03', 'Alhaji Sikirullah Saidu', '08033840105', '13C Ikokoro Street Off Niger Road Ilorin\r\n', '13C Ikokoro Street Off Niger Road Ilorin\r\n', '', 'Head Office', 'Olak Pet. Usanda', 'Compliance', 'officer', '2022-03-15', '1', '65000', '', 'ACCESS BANK', '', '1219463613', '3', '8', '', 'on', '$2y$10$oaFc7UEqmz2ta7XyPrSfBuQzx3wg6SsIKG5Mv65LaW1Lg6wMVSQ5O', '0', '2022-04-23 09:21:55', ''),
(521, '476', 'MURITALA', 'SAHEED', 'OLALEKAN', '08034217316', 'muritalasaheed2005@gmail.com', 'male', 'Married', '1992-09-20', '', '', '8 Obalende Lane Gbonmi Area Osogbo Osun\r\n', '8 Obalende Lane Gbonmi Area Osogbo Osun\r\n', '', 'Head Office', 'Aroma Iwo Road', 'Compliance', 'officer', '2022-04-15', '1', '65000', '', '', '', '', '', '8', '', 'on', '$2y$10$CennmRp9.6U./ruhqlDVmu0Ivdu4nzNKLcDDQ6Sd8wBAudlE.hl4i', '0', '2022-04-23 09:26:59', ''),
(522, '472', 'AJIDE', 'OLUFEMI', '', '08067787527', 'ajideolufemi80@gmail.com', 'male', 'Married', '1985-10-23', 'Seyi Ajide', '08139397503', '2 Hajia Habiba Bola Ajia Street Basin Ilorin\r\n', '2 Hajia Habiba Bola Ajia Street Basin Ilorin\r\n', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'furnance', 'operator', '2022-04-14', '1', '65000', '', 'UBA', '', '2068307684', '3', '3', '', 'on', '$2y$10$Wd3RwHe1XOZSQzIODeEWtObs4oZnJQetUVKalYRGgZUgaxUCV9K2.', '0', '2022-04-23 09:43:02', ''),
(523, '466', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', 'Aroma', 'Aroma Unity', 'Fryer', 'Fryer', '2022-02-26', '1', '40000', '', 'WEMA', '', '255655194', '2', '2', '', 'on', '$2y$10$KbrtK1BoPG8Wv2PnLEMuLOC6IRwXZEab.IDqLaQCQH1DdadOQoS6q', '0', '2022-04-23 09:54:23', ''),
(524, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$pJoZklt3RKS21z60v1OawOyLKN7qYoMAiA0jDU8hUolvIa4PdtvAK', '0', '2022-04-23 09:54:23', '1'),
(525, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$YrzvSSWlhk2AQi3IKAIsaeFXcEQvZNhZe7F5AybLCV1mT8lOoQ/gm', '0', '2022-04-23 09:54:24', '1'),
(526, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$equis3/nFCAHQ36zTuyG9uksR.xsvt8CZQENDP5Vg0cDBBNnJRYK2', '0', '2022-04-23 09:54:24', '1');
INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `last_name`, `other_name`, `phone`, `email`, `gender`, `marital_status`, `dob`, `kin_name`, `kin_phone`, `present_add`, `permanent_add`, `highest_qualification`, `company`, `branch`, `department`, `job_title`, `date_employed`, `employment_type`, `present_salary`, `grade_step`, `bank_name`, `bank_code`, `account_number`, `blood_group`, `company_id`, `photo`, `notification`, `hashed_password`, `update_profile`, `created_at`, `deleted`) VALUES
(527, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$8lNvZSI/JrkULV5NYcFXK.0UL.clRTe4xHHqoDmqIghHWXqJjkKP6', '0', '2022-04-23 09:54:24', '1'),
(528, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$0.pFenlhRlJ2MDkDSdYJgut6Hg1m/HpB.X06C1DNE6ST9g4bwQuwa', '0', '2022-04-23 09:54:24', '1'),
(529, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$/yUWaCvT4P/koHy4fH4SReWzHh/pEkcymswCpxyeEzfdQTMm5sNt.', '0', '2022-04-23 09:54:24', '1'),
(530, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$ontoi7NNMz7MBPHTtHn76e.yT2EFpKFtRwhkyU4RrdUHdcX5xeEbO', '0', '2022-04-23 09:54:24', '1'),
(531, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$8Dyc/xCeKFWcG.pRyLMOn.zxSll72rVkkquHXRsH.Ht1etYQ8Fbue', '0', '2022-04-23 09:54:24', '1'),
(532, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$APN4.iyfBudLwTNo4nOHx.K8aqFdA9S.G3ugNBZGbBQ5n/YE76SOS', '0', '2022-04-23 09:54:24', '1'),
(533, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$erP.f9iqT6T7MmoNFrWlDO1M0Xe/84hQgIm/rsTmF0x1GR9E5zbdi', '0', '2022-04-23 09:54:24', '1'),
(534, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$j9LmpTVr.bLYRRrTKhgb.e4fpZRpyNJ12Op.luIPLGTnaTqT/PpYi', '0', '2022-04-23 09:54:24', '1'),
(535, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$Py2NPA1tkmLWvII2WuB96.WPKEslhsW.aFrSbOtBgM3Zg8Mw5JMTK', '0', '2022-04-23 09:54:24', '1'),
(536, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$ZgTnNWp3dji15m9eWa2vnOoIqqZNowmTOP1IzFDU4A6hOPZmqapsC', '0', '2022-04-23 09:54:24', '1'),
(537, '', 'ABDULYEKINI 	', 'RIDWAN', 'OLAYINKA', '09031362755', 'omoluabiridwan66@gmail.com', 'male', 'Single', '1995-02-22', 'AbdulYekeen Babatunde', '07064349593', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '12 Adualere Street Omoluabi Compound Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '2', '', '', 'on', '$2y$10$X9IudpHKVdgpX8n1PEYxte9mzTSuIz7kZjnKnMd746LOqQZA0x6Qm', '0', '2022-04-23 09:54:24', '1'),
(538, '424', 'ONIPINLA', 'VICTORIA', 'ADENIKE', '09066003278', 'adenikevictoria2017@gmail.com', 'female', 'Married', '1997-08-23', 'Adetimehin AbdulNaheem', '08026732608', '16 Suruler Estate Ile Sheu Olomi Academy Ibadan\r\n', '16 Suruler Estate Ile Sheu Olomi Academy Ibadan\r\n', '', 'Aroma', 'Aroma Toll-Gate', 'Kitchen', 'Cook', '2021-12-06', '1', '40000', '', 'WEMA', '', '0254500493', '3', '2', '', 'on', '$2y$10$SjD9eqCycbeiwK2KrxNbv.O2G4OCOF7ljs/.8cJCYp2gmHliAdQRy', '0', '2022-04-23 10:10:26', ''),
(539, '448', 'ORIOWO', 'KEHINDE', 'OLAMIDE', '09050746418', 'oriowokehinde12@gmail.com', 'female', 'Single', '1999-08-18', 'Oriolowo Taiwo Olaniyi', '08112137897', 'SW6/537A Ajibola Street Agbokojo Area Ibadan\r\n', 'SW6/537A Ajibola Street Agbokojo Area Ibadan\r\n', '', 'Aroma', 'Aroma Toll-Gate', 'Cashier', 'Cashier', '2022-02-01', '1', '40000', '', 'WEMA', '', '0254605817', '3', '2', '', 'on', '$2y$10$6WeJspqQUjaQWYqjrsg6N.2VxpBt8iOjt9oqiUxtBKaaVor78sZiy', '0', '2022-04-23 10:23:00', ''),
(540, '449', 'SALAWUDEEN', 'ZAINAB', 'OLAITAN', '09074758036', '', 'female', 'Single', '2000-05-30', 'Salawudeen Balkis', '09078980422', 'Zone 1 33 Olowukemi Street Academy Olomi Ibadan\r\n', 'Zone 1 33 Olowukemi Street Academy Olomi Ibadan\r\n', '', 'Aroma', 'Aroma Toll-Gate', 'Kitchen', 'Cook', '2022-02-01', '1', '30000', '', 'WEMA', '', '0254771141', '3', '2', '', '', '$2y$10$khd2x.A8JCaCgyOGH2ILre.2LtML9gbZAWH0pM3X7r54xOAll1cUa', '0', '2022-04-23 10:34:10', ''),
(541, '468', 'BOLARINWA', 'ABIGAIL', 'AYOBAMI', '08139476793', 'bolarinwaabigeal@gmail.com', 'female', 'Single', '2000-06-29', 'Bolarinwa Ololade', '', '3 Olorobo Street Bashorun Ibadan\r\n', '3 Olorobo Street Bashorun Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2022-03-01', '1', '40000', '', 'WEMA', '', '0260199238', '3', '2', '', '', '$2y$10$P77CFibpIqKwd1LcKjFqr.FTcicDadqiTs34P4dG3h24qxeeHFKJ2', '0', '2022-04-23 10:39:48', ''),
(542, '450', 'ADUMA', 'LUCY', 'AMARACHI', '08108602911', 'amarachilucy04@gmail.com', 'female', 'Single', '2002-08-19', 'Aduma Emmanuella Munachi', '090673161194', '7 Abayomi Street Iwo Road Ibadan\r\n', '7 Abayomi Street Iwo Road Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2022-02-04', '1', '30000', '', 'WEMA', '', '0254573462', '', '2', '', 'on', '$2y$10$fA8NQtQh3rvEwBEE7V6Svug2jU/JBe2sunMIM8wIA45fWsRQVts2y', '0', '2022-04-23 13:39:50', '1'),
(543, '452', 'FAGBOHUN', 'DAMILOLA', 'OLOLADE', '08114229460', 'damilolaolade1999@gmail.com', 'female', 'Single', '1999-04-12', 'Mrs Fagbohun', '08144061454', '11 Asipa Papalamo Alakia Isebo Ibadan\r\n', '11 Asipa Papalamo Alakia Isebo Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2022-02-07', '1', '40000', '', 'WEMA', '', '0254569371', '3', '2', '', 'on', '$2y$10$4vl6aOlwo24qgbgZ4SBs6e2z3yr7L20WuL0pay2l3pp1k.kpRY5vm', '0', '2022-04-23 13:48:26', ''),
(544, '453', 'EJIGBO', 'REBECCA', 'FUNMILAYO', '08061120245', 'rebeccaenitan47@gmail.com', 'female', 'Single', '1997-03-08', 'Ejigbo Anuoluwapo', '08024759898', 'Efun Olaogun Old Ife Road Ibadan\r\n', 'Efun Olaogun Old Ife Road Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2022-02-08', '1', '30000', '', 'WEMA', '', '0254574139', '2', '2', '', 'on', '$2y$10$r/AE8lgjZVb9oJ2cgyIfgeVS79A.zdFPjIOlT/c7ruSvp83.IebIO', '0', '2022-04-23 14:19:47', '1'),
(545, '454', 'OYEWOLE', 'BLESSING', 'CAROLINE', '08106657886', 'blessingoyewole017@gmail.com', 'female', 'Single', '1998-08-12', 'Oyewole Oluwadesire', '08136312997', 'Efun Olaogun Old Ife Road Ibadan\r\n', 'Efun Olaogun Old Ife Road Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2022-02-08', '1', '30000', '', 'WEMA', '', '0254573888', '2', '2', '', 'on', '$2y$10$HyWRyK/cWPOOb6VJWPcEbuFAkJVyPDx5/DJxs.gi7GV2yrGo87F6u', '0', '2022-04-23 14:26:11', '1'),
(546, '455', 'OLADEJO', 'TEMITOPE', 'BOSE', '08163643515', 'oladejotabitha109@gmail.com', 'female', 'Single', '1999-02-28', 'Oladejo Oluwatosin', '07086561702', '4 Ire Akari Street Adewolu Ibadan\r\n', '15 Road A2 Alarere Behind Toun Hospital Iwo Road Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2022-02-04', '1', '30000', '', 'WEMA', '', '0254572290', '', '2', '', 'on', '$2y$10$U8EuroMEmy4UmAc1DvKhR.GPYmq2OG6VL3F78ja6yMfS9pYepwUiC', '0', '2022-04-23 14:44:21', '1'),
(547, '456', 'OSINBOLA', 'IFEOLUWA', 'FATIMOH', '08120725534', '', 'female', 'Single', '1999-04-23', 'Mrs Osinbola', '07048136212', 'Salam Salam Omokeye Road Behind Christ Foundation Assembly Alakia Ibadan\r\n', 'Salam Salam Omokeye Road Behind Christ Foundation Assembly Alakia Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2022-02-04', '1', '30000', '', '', '', '', '3', '2', '', '', '$2y$10$epo8KD8Vf4xGaQNMpEsUPe4fElDAUs5G95WiFHm8eP8MRq38aknxy', '0', '2022-04-23 14:51:12', '1'),
(548, '457', 'OLASUPO', 'ADEWOLE', 'ISMAIL', '09054561033', 'olasupoadewole@gmail.com', 'male', 'Married', '1988-05-05', 'Alalade Suliyat', '07066626233', '15 Ogooluwa Estate Olodo Garage Ibadan\r\n', '15 Ogooluwa Estate Olodo Garage Ibadan\r\n', '', 'Aroma', 'Eleyele', 'Bakery', 'Baker', '2022-02-01', '1', '40000', '', 'WEMA', '', '0254576906', '3', '2', '', 'on', '$2y$10$aZ7hryzjE1IhY2rR4Wsi/OMbh9FANtGxNBpKdNQTEvcFmgheGZiHO', '0', '2022-04-23 14:56:35', ''),
(549, '459', 'OYEWO', 'TAIWO', 'DAVID', '08159830898', 'oyetai94@yahoo.com', 'male', 'Single', '1994-01-18', 'Dorcas Oyewo', '09072137453', '12 Olagoke Akano Street Abayomi Iwo Road Ibadan\r\n', '12 Olagoke Akano Street Abayomi Iwo Road Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Pie Xpress', 'Pie xpress', '2022-02-06', '1', '40000', '', 'WEMA', '', '0254568185', '3', '2', '', 'on', '$2y$10$3FO2v38dtTWCKRLrq2df1OaNiCyyD/hx99uRKVRvUAafkMA4Ekkpi', '0', '2022-04-23 15:07:01', ''),
(550, '460', 'AYANSIJI', 'FATIMA', 'ADERONKE', '09073227260', 'ayansijiolaitan@gmail.com', 'female', 'Single', '1997-07-02', 'Mrs Ayansiji', '07055197710', '2 Osan Street Best Way Ibadan\r\n', '2 Osan Street Best Way Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Kitchen', 'Cook', '2022-02-06', '1', '30000', '', '', '', '', '2', '2', '', 'on', '$2y$10$L9W44CmxeJ7OmZztcdcOHOR/qdgWPm5zbMR2cE36QTNMERRih0EFi', '0', '2022-04-23 15:14:13', ''),
(551, '461', 'OKETOYE', 'AFISAT', 'TINUADE', '08163542176', 'oketoyeafisatamoke0703@gmail.com', 'female', 'Single', '1995-03-07', 'Oketoye Hussain Taiwo', '08036952834', '27 Adewumi Olosunde Estate Along Lalupon Ibadan\r\n', '27 Adewumi Olosunde Estate Along Lalupon Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2022-02-01', '1', '40000', '', 'WEMA', '', '0254577037', '3', '2', '', 'on', '$2y$10$IpzcdXWAAKaZr9K9J/Lc/uagwuLsPqy8wIx4meP703wErC7t9J7pe', '0', '2022-04-23 15:19:37', ''),
(552, '462', 'OYEKUNLE', 'AHMED', '', '08036328663', 'hammedoladeinde67@gmail.com', 'male', 'Single', '1989-09-18', 'Oyeunle Luqman', '08055302364', '41 Oko Mope Ayekale Ibadan\r\n', '41 Oko Mope Ayekale Ibadan\r\n', '', 'Aroma', 'Eleyele', 'Bakery', 'Baker', '2022-02-01', '1', '40000', '', 'WEMA', '', '0255110309', '', '2', '', 'on', '$2y$10$D.ymlUkZkWfx28asrNhe7.6TEGhnfsa0G0/hae3IraMrYVeSfr/PO', '0', '2022-04-23 15:24:41', ''),
(553, '463', 'SHITTU', 'AYISHAT', 'OLOLADE', '08159822114', 'ololadeshittu24@gmail.com', 'female', 'Single', '2000-05-24', 'Shittu Malik', '08159822114', 'Dizengoff Alanso Area Iyan Church Ibadan\r\n', 'Dizengoff Alanso Area Iyan Church Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Cashier', 'Cashier', '2022-02-16', '1', '40000', '', 'WEMA', '', '0254575095', '3', '2', '', 'on', '$2y$10$tjb3IFCptwzEn56/FWhopuZ66hJPWwfXn/ua9qJ2a8rBXtP.ImiYm', '0', '2022-04-23 15:29:45', '1'),
(554, '0056', 'FASAKIN', 'OLANIYI', 'D', '07033164735', 'olafasakind@gmail.com', 'male', 'Married', '1982-04-23', 'Fasakin Taiwo O.', '07046493017', '27 Jimoh Oyediran Street Obogun Ibadan\r\n', '27 Jimoh Oyediran Street Obogun Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Bakery', 'Manager', '2008-03-12', '1', '135000', '', 'WEMA', '', '0239200639', '3', '2', '', '', '$2y$10$5dP9UBPuNxZqrpcia3hVx.rFhTb73ZgCgYN4OXgUy9cGthXlz6PuS', '0', '2022-04-23 15:37:45', ''),
(555, '0061', 'OLADIPUPO', 'RASHEED', 'AYOBAMI', '08052150032', 'olaayorash77@gmail.com', 'male', 'Married', '1977-03-23', 'Mrs Asabi', '07025131124', 'Ifedapo Itesiwaju Zone 2 Oke Odo Basorun Ariyo Ibadan\r\n', 'Ifedapo Itesiwaju Zone 2 Oke Odo Basorun Ariyo Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'supervisor', '2008-08-05', '1', '80000', '', 'WEMA', '', '0239113971', '3', '2', '', '', '$2y$10$P5.AwtVWFqjGnSYUu9gHxuUVm0makm9fKx6OrI3feNv3ll0U/no52', '0', '2022-04-23 15:44:39', ''),
(556, '153', 'LAWAL', 'MARIAM', 'ABIOLA', '08055914714', 'chefbiolamal@gmail.com', 'female', 'Married', '1991-03-16', 'Adio Mayowa', '08051567551', '10 Akinwumi Compound opposite Ile-Marun Ibadan\r\n', '10 Akinwumi Compound opposite Ile-Marun Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Supervision', 'supervisor', '2015-01-02', '1', '70000', '', 'WEMA', '', '0239194778', '3', '2', '', '', '$2y$10$XV7wYlUOiQnUqiEViFNg4eFSu1GDd7pjNjJq9SEakg5xk7juclBwK', '0', '2022-04-23 15:58:14', ''),
(557, '249', 'ODUKOJO ', 'WURAOLA ', 'AMINAT', '08132610216', 'wuraolaodukoj7@gmail.com', 'female', 'Single', '1998-07-19', 'Ojukojo Shakirat Olaide', '08055306541', '25 Jaloke Olomi Ibadan\r\n', '25 Jaloke Olomi Ibadan\r\n', '', 'Aroma', 'Aroma Toll-Gate', 'cook', 'cook', '2019-09-02', '1', '40000', '', 'WEMA', '', '0243446025', '', '2', '', '', '$2y$10$d.Uouvd5msZmAJU2psdbrOqAJyrbrSGe.XzCgezt.i06/FGxfr10m', '0', '2022-06-27 13:52:20', ''),
(558, '478', 'ARAOYE', 'MOTUNRAYO', 'ADEFOYEKE', '09060642709', 'arinpeola22@gmail.com', 'female', 'Single', '1998-06-22', 'Araoye Michael', '07081663378', 'Mejidadi Street Taiwo Road Ilorin\r\n', '3 Yidi Road Iwajowa Community Owode Ede Osun\r\n', '', 'Aroma', 'Aroma Unity', 'cook', 'cook', '2022-04-17', '1', '30000', '', 'WEMA', '', '0262170390', '2', '2', '', '', '$2y$10$UtuhyO2DID2TRtIoDwFX0OUqTh836VFG/4l9l.8wkSDTAFWQ.MtDi', '0', '2022-06-27 14:11:44', '1'),
(559, '479', 'ADEYI', 'PETER ', 'ADEGBOYEGA', '08143451046', 'peteradeyi43@gmail.com', 'male', 'Single', '1998-09-22', 'Olawale Pelumi Titilope', '08151891979', '15 Ajelanwa Street Sango Ilorin Kwara\r\n', '15 Ajelanwa Street Sango Ilorin Kwara\r\n', '', 'Aroma', 'Aroma Unity', 'Bakery', 'Baker', '2022-04-19', '1', '40000', '', 'WEMA', '', '0268761053', '', '2', '', '', '$2y$10$VsXjJlRUTyulu9NcyGk3pe2BlrnEkbReIQfy9CbzOyp3lxky7q8BO', '0', '2022-06-27 14:21:55', ''),
(560, '477', 'ADENIYI', 'TEMITOPE ', 'SEYI', '07032870740', 'adeniyitemmy92@gmail.com', 'female', 'Single', '1992-06-19', 'Adeniyi Grace', '08039423565', '8 Atele Abayomi Street Iwo Road Ibadan\r\n', '8 Atele Abayomi Street Iwo Road Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'cook', 'cook', '2022-04-06', '1', '30000', '', 'WEMA', '', '0227462173', '3', '2', '', '', '$2y$10$n8sBfhPckduCEbWR6a.kW.1hQKuwSkLvG1s/h5a0e1bvow4O2AV3a', '0', '2022-06-27 14:55:10', '1'),
(561, '481', 'ALI-LUWANGA', 'EMMANUEL', 'OCHEJE', '09030384918', 'aliemmanuel1997@gmail.com', 'male', 'Single', '1998-01-20', 'Luwanga Isaac', '09133158064', '6, Oyetola Street, Mafoluku Oshodi', '1 Baba Ode Opposite Love Water Ilorin\r\n', '', 'Aroma', 'Aroma Unity', 'cook', 'cook', '2022-04-27', '1', '40000', '', 'WEMA', '', '0265002599', '3', '2', '', '', '$2y$10$bHjHTN7awSpcCyRVVfbPMOmmvZtOdPZMFYWkWxxwzS3zJ0S5G9bvi', '0', '2022-06-27 15:20:12', ''),
(562, '482', 'AYANWOLE', 'AMIDAT ', 'OLUWAFUNMILAYO', '09168740041', 'ayanwole.amidat@gmail.com', 'female', 'Single', '1998-10-26', 'Ayanwole Aliu Isola', '08143578500', '26 Alasela Street Off Taiwo Road Ilorin\r\n', 'Patiko\'s Compound Laka Area Ogbomoso Oyo\r\n', '', 'Aroma', 'Aroma Unity', 'cook', 'cook', '2022-04-29', '1', '40000', '', 'WEMA', '', '0268012171', '', '2', '', '', '$2y$10$MJz2xNZdKvU//xvLL7q0eeIZ7nkcu03Ft0CT4ECWrGcGoL9dlbrNq', '0', '2022-06-27 15:43:46', ''),
(563, '493', 'IBRAHIM', 'WASIU', 'OLAWALE', '07034368775', 'ibrahimolawalewasiu@gmail.com', 'male', 'Single', '1994-07-05', 'Ibrahim Habeeb Opeyemi', '07089809964', '10 Ogunsola Street Asa Dam Area Ilorin\r\n', '25A Kudimo Street Adabata Ilorin \r\n', '', 'Aroma', 'Aroma Unity', 'Cashier', 'Cashier', '2022-05-10', '1', '40000', '', 'WEMA', '', '0268691381', '3', '2', '', '', '$2y$10$S7Jf2ERvqXK4HiuOoPg4cO6w21Xw9F1MBRd8USNujE8VZNCqPrcxi', '0', '2022-06-27 16:21:10', ''),
(564, '488', 'AGBOOLA ', 'LATEEF', 'OLADAYO', '08055723501', 'olatconcepts111@gmail.com', 'male', 'Married', '1986-03-03', 'Agboola Anot Temitope', '07060620058', '51 Powerline Junction Sanyo Ibadan Oyo\r\n', '51 Powerline Junction Sanyo Ibadan Oyo\r\n', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Sales & Marketing', 'Manager', '2022-06-06', '1', '155000', '', 'ACCESS BANK', '', '0811140690', '3', '3', '', '', '$2y$10$5zFdah9RljBX/VIEiPXQR.s.mW.3xRWzFggV729pwbLXk0YQXfXkO', '0', '2022-06-27 16:28:09', ''),
(565, '492', 'SOLIU', 'ABDULGAFAR', 'ADAVIZE', '08026981885', 'adavizefaith@gmail.com', 'male', 'Single', '2001-04-28', 'Soliu Rodeeah', '08148678444', '8 Saidu Ayide Street Off Taiwo Road Ilorin\r\n', '8 Saidu Ayide Street Off Taiwo Road Ilorin\r\n', '', 'Aroma', 'Head office', 'Procurement', 'officer', '2022-05-13', '1', '40000', '', 'WEMA', '', '0256691586', '3', '2', '', '', '$2y$10$LJ4Vld62lBHoXWw7GodSruemByBCzfgHNB/tG3O2q1yYPuDzPf3gS', '0', '2022-08-20 18:30:18', ''),
(566, '495', 'RASHEED', 'FAUSAT', 'KIKELOMO', '08140340186', 'rasheedfausat@gmail.com', 'female', 'Single', '275760-05-25', 'Rasheed Nimota', '08103293301', '35 Akorede Street Sango Ibadan\r\n', 'Isinigbo Golden Estate Akure\r\n', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-04-14', '1', '30000', '', 'WEMA', '', '0268137427', '', '2', '', '', '$2y$10$VQS7D9BIVQzkF6ApLzLfl.8WPJqFsdmclxNYwTFV7wems0CLGIEey', '0', '2022-08-22 12:59:33', ''),
(567, '496', 'FOLORUNSHO ', 'OLUWABUNMI ', 'HANNAH', '09079621491', 'folorunshobunmi08@gmail.com', 'female', 'Single', '1996-08-25', 'Folorunsho Isreal', '07012357527', '23 Moboluwaduro Zone C Papupo Area Asolo Ibadan \r\n', '23 Moboluwaduro Zone C Papupo Area Asolo Ibadan \r\n', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268005278', '', '2', '', '', '$2y$10$ENTdYvjuRHcH8cbh7ukC/eb1UjGBXqdwg5Ypc8XIliZD5cmb70kGC', '0', '2022-08-22 13:19:50', '1'),
(568, '', 'FOLORUNSHO ', 'OLUWABUNMI ', 'HANNAH', '09079621491', 'folorunshobunmi08@gmail.com', 'female', 'Single', '1996-08-25', 'Folorunsho Isreal', '07012357527', '23 Moboluwaduro Zone C Papupo Area Asolo Ibadan \r\n', '23 Moboluwaduro Zone C Papupo Area Asolo Ibadan \r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$e7v6A4vjueP8LvlFwJy1a.eYodiJwa08oc.X604aS6se09jyZiJ6C', '0', '2022-08-22 13:19:50', '1'),
(569, '', 'FOLORUNSHO ', 'OLUWABUNMI ', 'HANNAH', '09079621491', 'folorunshobunmi08@gmail.com', 'female', 'Single', '1996-08-25', 'Folorunsho Isreal', '07012357527', '23 Moboluwaduro Zone C Papupo Area Asolo Ibadan \r\n', '23 Moboluwaduro Zone C Papupo Area Asolo Ibadan \r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$T8XvH5Xn3jg1DFC5/QDTuOVEUxTOx0/B.XJfMCd00gocD3d0JQkPu', '0', '2022-08-22 13:19:52', '1'),
(570, '499', 'FARINU', 'TEMITOPE', 'OLUWABUNMI', '08100941784', 'oluwaseuntemitope1992@gmail.com', 'female', 'Single', '1992-10-23', 'Farinu Temitope', '08026898698', '48 Irepodun Zone II Isale Molade Academy Iwo Road Ibadan\r\n', '48 Irepodun Zone II Isale Molade Academy Iwo Road Ibadan\r\n', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268070605', '3', '2', '', '', '$2y$10$jOo3JgddSiR1LnMP/2D4s.uvfdGaj653bDJMlPrRab7t9HUhYtNLK', '0', '2022-08-22 14:01:20', ''),
(571, '500', 'POPOOLA', 'ADIJAT', 'IBUNKUNLOWA', '09029550401', 'kmoshood559@gmail.com', 'female', 'Single', '1992-03-03', 'Popoola Ridwan', '09026862116', '95 Believers Quarters Apete Ariyibi Ibadan\r\n', '34 Fajebe Street Ikenne Remo Ogun\r\n', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-04-15', '1', '30000', '', 'WEMA', '', '0267962963', '3', '2', '', '', '$2y$10$tVvdc.TUhkARrU5.zxK4O.0PgItAIoRqJZQ4xt1baaPeXgC5i8JGO', '0', '2022-08-22 14:06:58', ''),
(572, '502', 'OLAJIDE', 'OLAJUMOKE', 'ELIZABETH', '08071895461', 'jumokea120@gmail.com', 'female', 'Single', '1995-02-02', 'Ajayi Bola', '07011562345', '3 Aderogba Estate Apete Ibadan \r\n', '3 Aderogba Estate Apete Ibadan \r\n', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-04-15', '1', '30000', '', 'WEMA', '', '0267963197', '', '2', '', '', '$2y$10$IF/wkWQTnr2on9bj125qM.St98jL72q1egseQugBhOkvVrURcP8Eu', '0', '2022-08-22 14:11:43', ''),
(573, '503', 'ADENIYI ', 'KAOSARAT', 'AJOKE', '07030484131', 'adeniyiomobonike52@gmail.com', 'female', 'Single', '1993-12-31', 'AdeniyiWaliyat', '09037990881', '52 Barrack Ojoo Along Idi-Omo Ibadan\r\n\r\n', '52 Barrack Ojoo Along Idi-Omo Ibadan\r\n', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268070502', '3', '2', '', '', '$2y$10$38KQkMIpfPvb9Exr.DT0v.EG8UDm9eLss5UEAZS3f29EiPKWsgyaS', '0', '2022-08-22 14:17:41', ''),
(574, '503', 'ADENIYI ', 'KAOSARAT', 'AJOKE', '07030484131', 'adeniyiomobonike52@gmail.com', 'female', 'Single', '1993-12-31', 'Adeniyi   Waliyat', '09037990881', '52 Barrack Ojoo Along Idi-Omo Ibadan\r\n\r\n', '52 Barrack Ojoo Along Idi-Omo Ibadan\r\n', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-04-15', '1', '30000', '', '', '', '', '3', '2', '', '', '$2y$10$GiruDN6srNeX3PTEERvwTeCEMC/c6r2rsakDYgdIbu92tjJy7Fzia', '0', '2022-08-22 14:17:41', ''),
(575, '504', 'CHARLES ', 'OYINDAMOLA', 'FOLASHADE', '07015022160', 'oyindamolafolashade63@gmail.com', 'female', 'Single', '2001-12-12', 'Charles Monday', '07087000264', '4 Bello Street Idi Ope Eleyele Ibadan\r\n', '4 Bello Street Idi Ope Eleyele Ibadan\r\n', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-04-15', '1', '30000', '', 'WEMA', '', '0264005421', '3', '2', '', '', '$2y$10$iaJ4jpMp11eMuTFB7Z1AQ.2P72Bh3JkLXkWxt9CwA7x8AvvWp.z82', '0', '2022-08-22 14:21:37', ''),
(576, '', 'GBADAMOSI', 'FATHIA', '', '09046584370', 'gbadamosifa25@gmail.com', 'female', 'Single', '2003-01-19', 'Gbadamosi Fawaz', '07042561145', '14 Bello Street Idi-Ope Eleyele Ibadan\r\n', '14 Bello Street Idi-Ope Eleyele Ibadan\r\n', '', 'Aroma', 'Sango', 'Host', 'host', '2022-04-15', '1', '30000', '', 'WEMA', '', '0265341001', '3', '2', '', '', '$2y$10$NHG3IR4yvZflU/dX9/Z87OeEpxl2lLPFbnOB9J7wHCIA6/hVDIemO', '0', '2022-08-22 15:00:17', ''),
(577, '506', 'EFOAGUI', 'EKPEREAMAKA', 'FAVOUR', '08038382341', 'favourefoagui17@gmail.com', 'female', 'Single', '1998-07-20', 'Anthony Obiora', '08038388062', 'Alaro Street Off Poly road Sango Ibadan\r\n', 'Alaro Street Off Poly road Sango Ibadan\r\n', '', 'Aroma', 'Sango', 'Cashier', 'Cashier', '2022-04-15', '1', '30000', '', '', '', '', '1', '2', '', '', '$2y$10$sgp5RlEgR7OEuQVPhQcuRez1qWcPc/EU9T7Zpk/FpEPPj.ryX5P7G', '0', '2022-08-22 15:05:42', ''),
(578, '512', 'YUSUFF ', 'OMOLARA', 'HANAT', '08050987081', 'yusufhanat@gmail.com', 'female', 'Single', '1999-09-10', 'Yusuf Adebayo', '07017529717', '8 Ojedeji Street Eleyele Ibadan\r\n', '25 Obokun Street Eleyele Ibadan\r\n', '', 'Aroma', 'Sango', 'Fryer', 'Fryer', '2022-04-15', '1', '30000', '', '', '', '', '', '2', '', '', '$2y$10$CsWpjjWMDGhE/ijEX995oOtXtKwoUaHHS2bZubH5FMVDSXyswvZwq', '0', '2022-08-22 15:10:50', ''),
(579, '514', 'OLOGUN ', 'OLAMIDE', 'REBECCA', '07032979410', 'olamiderebecca915@gmail.com', 'female', 'Single', '1997-03-19', 'Ologun Emmanuel', '07061209424', '5 Halleluyah House Jeje Apete Ibadan\r\n', '5 Halleluyah House Jeje Apete Ibadan\r\n', '', 'Aroma', 'Sango', 'Cashier', 'Cashier', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268070667', '3', '2', '', '', '$2y$10$zHu2ABHelVfUWtGQxXAMkOApp7PRdZHSuBkNFNoJApYPewelZgT22', '0', '2022-08-22 15:19:35', ''),
(580, '516', 'SAFIU ', 'SULIYAT ', 'BOLAJI', '07026747108', 'zhulgold@gmail.com', 'female', 'Single', '1992-10-16', 'Sofiu Baliqis Adeola', '09065076515', 'E9/963 Agba-Akin Street Testing Ground Iwo Road Ibadan\r\n', 'E9/963 Agba-Akin Street Testing Ground Iwo Road Ibadan\r\n', '', 'Aroma', 'Sango', 'Fryer', 'Fryer', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268003061', '3', '2', '', '', '$2y$10$XyrNqVYQHwc2A0xPyOYKrum5.Xo3Z6TU9gR4cpWHsv.nT5IF/CW/O', '0', '2022-08-22 15:37:03', '1'),
(581, '027', 'OLALEYE', 'OLUNIKE', 'VICTORIA', '08036135458', 'oovicky76@gmail.com', 'female', 'Married', '1976-08-08', '', '', '46 Poly Road Sangp Ibadan\r\n', '46 Poly Road Sangp Ibadan\r\n', '', 'Aroma', 'Sango', 'Human Resource', 'Cleaner', '2022-07-01', '2', '30000', '', 'WEMA', '', '0271456407', '', '2', '', '', '$2y$10$CutjSglVLSenlE8g1C0Iruxx6gHUeS0rBBC4Xe28zt1oEebtY2W66', '0', '2022-08-22 17:41:10', ''),
(582, '', 'AGBOOLA ', 'LATEEF', 'OLADAYO', '08055723501', 'olatconcepts111@gmail.com', 'male', 'Married', '1987-03-03', 'Agboola Anot Temitope', '07060620058', '51 Powerline Junction Sanyo Ibadan Oyo\r\n', '51 Powerline Junction Sanyo Ibadan Oyo\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$ZBpOJuRSupiR348moFvPWu5Zh3OeCPHgHKcxxrNOK0isZTnLNTO.m', '0', '2022-08-24 16:05:03', '1'),
(583, '491', 'ABDULKAREEM ', 'SHERIFAT', 'OMOLARA', '08088002530', 'omololasherifat2019@gmail.com', 'female', 'Single', '1999-02-10', 'Lawal Khadijat Titilayo', '07082495251', 'Plot 3 New Yidi Road Irewolede Ilorin\r\n', 'C83 Iluteju Community Osere Area Ilorin\r\n', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Kitchen', 'Helper', '2022-06-10', '1', '35000', '', 'UBA', '', '2136172862', '3', '3', '', '', '$2y$10$6uCcaZuhBCTauDDQDKEECeRiYGHHN0t9P2y5LHV45yLVnCuKxT7Au', '0', '2022-08-24 16:08:58', ''),
(584, '', 'ABDULKAREEM ', 'SHERIFAT', 'OMOLARA', '08088002530', 'omololasherifat2019@gmail.com', 'female', 'Single', '1999-02-10', 'Lawal Khadijat Titilayo', '07082495251', 'Plot 3 New Yidi Road Irewolede Ilorin\r\n', 'C83 Iluteju Community Osere Area Ilorin\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '3', '', '', '', '$2y$10$nwuNmnfqtILCP9JYQRwRYOocxkQc65joSar4glzGHNVlvcTpMNCnu', '0', '2022-08-24 16:09:00', '1'),
(585, '532', 'OBIDARA ', 'MUSIBAU', 'OLABAYO', '09154683799', 'obidara.musibau@gmail.com', 'male', 'Married', '1973-02-12', 'Obidara Hammed', '09151696846', '8 Surulere Street Agbati Olosan Alakia Area Ibadan\r\n', '8 Surulere Street Agbati Olosan Alakia Area Ibadan\r\n', '', 'Retail Outlet', 'Ibadan (Iwo Road)', 'Human Resource & Admin', 'Driver', '2022-08-15', '1', '34000', '', '', '', '', '', '1', '', '', '$2y$10$OIPw72sf.QVwrwV4F1xEu.QILK/lV004RSFj3/CN7RPA7ZUuvPlS.', '0', '2022-08-25 08:43:49', ''),
(586, '480', 'MOHAMMED', 'ABDULMUMEEN', '', '08140683134', 'mohmumeen@gmail.com', 'male', '', '1997-10-26', 'Mohammed AbdulLateef', '07084032791', 'New Market Bani Kani Area Okota Uta Boriti LGA Kwara \r\n', 'New Market Bani Kani Area Okota Uta Boriti LGA Kwara \r\n', '', 'Head Office', 'Olak Pet. Ibadan', 'Human Resource & Admin', 'Security', '2022-05-05', '1', '38000', '', '', '', '', '', '8', '', '', '$2y$10$UgvRHdr/QoXMk4GaSeYrl.PZ5TC8DmFbQfZ13nhKukOUDt8xNx0t6', '0', '2022-08-25 13:50:29', ''),
(587, '489', 'YUSUF ', ' LUKMAN', '', '08168339041', 'yusluk2022@gmail.com', 'male', 'Single', '', '', '', '', '', '', 'Head Office', 'Olak Pet. Ibadan', 'Human Resource & Admin', 'Security', '2022-05-10', '1', '38000', '', '', '', '', '', '8', '', '', '$2y$10$38715.VVFWGcYXGiabtbNO8.74ROPWvZMtgt7ImqEc3Qupkuc7vq2', '0', '2022-08-25 15:36:09', ''),
(588, '', 'YUSUF ', ' LUKMAN', '', '08168339041', 'yusluk2022@gmail.com', 'male', 'Single', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$hogC4Kx0.aIRmtioQIqbduCSmyC4IUZS7gyH1k2SrRtD7VkVXdRE2', '0', '2022-08-25 15:36:09', '1'),
(589, '490', 'AMBALI ', 'ABDULLAHI', '', '09021980499', 'abdulamali@gmail.com', 'male', 'Single', '', '', '', '', '', '', 'Head Office', 'Olak Pet. Ibadan', 'Human Resource & Admin', 'Security', '2022-05-10', '1', '38000', '', '', '', '', '', '8', '', '', '$2y$10$eeYMSb1fGXV3fAKnX2cMfe8WNDUVscXjCjAYdj3rDyWqPoECXw7.i', '0', '2022-08-25 15:41:21', ''),
(590, '520', 'ABODARIN', 'SEMIU ', '', '09072201400', 'absemiu00@gmail.com', 'male', '', '', '', '', '', '', '', 'Head Office', 'Eleyele', 'Human Resource & Admin', 'Security', '2022-07-01', '1', '30000', '', '', '', '', '', '8', '', '', '$2y$10$zT5Fcy1SraGGAnUbK5j99uZa6b/ywtyF5U3uPPdwy79ET589P14iS', '0', '2022-08-25 15:49:28', ''),
(591, '', 'ABODARIN', 'SEMIU ', '', '09072201400', 'absemiu00@gmail.com', 'male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$ALAweKV5WTZOZ5un7q32PORsP2qrjbtTW2KO7xx6Nc2rITI8yD16y', '0', '2022-08-25 15:49:28', '1'),
(592, '521', 'AMECHI', 'FRANCIS ', '', '08063704999', 'amechifrancis11@gmail.com', 'male', 'Single', '1984-06-15', 'Chukuman Amachi', '08075756500', '', '', '', 'Head Office', 'Sango', 'Human Resource & Admin', 'Security', '2022-07-01', '1', '30000', '', '', '', '', '', '8', '', '', '$2y$10$RECSBxKR4zdauQMcOzLD1OZxNBTB9VrPfiSk2BObreQvU7tREH2.a', '0', '2022-08-25 15:57:04', ''),
(593, '522', 'OLAJIDE', 'TAIWO', 'EZEKIEL', '07050274241', 'tolajidee@gmail.com', 'male', 'Married', '1976-04-04', 'Olajide Tomiwa Faranmi', '09010171717', '5 Akorede Street Sango Poly Road Ibadan\r\n', '5 Akorede Street Sango Poly Road Ibadan\r\n', '', 'Head Office', 'Sango', 'Human Resource & Admin', 'Security', '2022-07-01', '1', '30000', '', '', '', '', '', '8', '', '', '$2y$10$yiQVdRz3SvmFkKtrBuagG.4if6ooFwK.uzCe3QhP9nSApv8QNFc/a', '0', '2022-08-25 16:01:43', ''),
(594, '523', 'BALOGUN', 'OMO OLA ', '', '09127424830', 'baloomoola2000@gmail.com', 'male', 'Married', '1970-04-03', 'Jimoh Oluwatobi ', '08038639645', '18 Agugu Street Oremeji Ibadan\r\n', '18 Agugu Street Oremeji Ibadan\r\n', '', 'Head Office', 'Sango', 'Human Resource & Admin', 'Security', '2022-07-01', '1', '30000', '', '', '', '', '', '8', '', '', '$2y$10$3uBgWNKzqT1yJC39XvKFnOzbkJuvuP3IVaZeuZJH1lzOtJXRHvzlO', '0', '2022-08-25 16:06:38', ''),
(595, '524', 'DIMEKE ', ' INNOCENT', '', '08163232039', 'diinnocent@gmail.com', 'male', 'Single', '1987-05-26', 'Akindele Gbenga', '07082595500', '', '', '', 'Head Office', 'Sango', 'Human Resource & Admin', 'Security', '2022-07-01', '1', '30000', '', '', '', '', '', '8', '', '', '$2y$10$XNn98gES0hKBa2Wf56sYuOzSL2FyP8foDRyuFJF9MfxEmd5BtIJjq', '0', '2022-08-25 16:10:00', ''),
(596, '245', 'JAMIU', 'MUHYDEEN ', 'ADANLA', '09066234030', 'mayoadanlaj@gmail.com', 'male', 'Single', '1999-05-25', 'Zakariyah Kamaldeen', '09039728992', 'Edun Street Isale Koto Ilorin\r\n', 'Edun Street Isale Koto Ilorin\r\n', '', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2019-07-20', '1', '30000', '', 'ACCESS BANK', '', '0824047728', '3', '4', '', '', '$2y$10$3aoTjwXp5aTESYmuLL9O9eFuRl0M.fmJjGMU3oV/lHINDPXG0D1gy', '0', '2022-08-26 10:24:48', ''),
(597, '', 'ADEBAYO', 'AFOLASHADE', 'ESTHER', '09129261066', 'xthershade@gmail.com', 'female', 'Single', '2003-04-24', 'Adebayo Emmanuel', '09157289382', 'Oloruntobi Zone 7B Soka Ibadan\r\n', 'Oloruntobi Zone 7B Soka Ibadan\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '3', '', '', '', '$2y$10$5R9qmy2cAm40kSmgt2Dnge45W4PaAAbhxgcrnsDZXX2wfK3on5mt2', '0', '2022-08-26 13:15:36', '1'),
(598, '486', 'MUKAILA', 'ALIMAT ', 'OLAITAN', '', 'olaitanalimat@gmail.com', '', '', '', '', '', '', '', '', 'Petroleum', 'Olak Pet. Ibadan', 'Sales & Marketing', 'Sales Attendant', '2022-05-06', '1', '30000', '', '', '', '', '', '4', '', '', '$2y$10$DBs8e75DeU2TEBRpKTIkzOGx.nWqoQnsDVEBTqTwVxABcuZ19OI4q', '0', '2022-08-26 13:22:49', ''),
(599, '365', 'AMIIDU ', 'AFOLABI', '', '07034443447', 'babafoamidu@gmail.com', 'male', '', '', '', '', '', '', '', 'Retail Outlet', 'Ibadan (Iwo Road)', 'Sales & Marketing', 'Manager', '1990-01-01', '1', '162500', '', 'ACCESS BANK', '', '0009139236', '', '1', '', '', '$2y$10$UwddLkWIVZ1nhT9ih3IOHeVWwESDvq2x/SQwmLBTpbIsx0EUH/pna', '0', '2022-08-27 09:45:06', ''),
(600, '', 'SALAWUDEEN ', 'SARAFA ', 'TEMITOPE', '08118481111', 'omotoyinbotemitope112@gmail.com', 'male', 'Married', '1990-07-30', 'Fasilat Salawudeen', '09050542507', 'Ojo Express Elewu Odo Ibadan\r\n', 'Ojo Express Elewu Odo Ibadan\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$FAOkMw5oyu5yfpovY.zVqOPJ/05WebAVnJOuIJT5EKiK0fAhn5GK6', '0', '2022-09-05 12:11:39', '1'),
(601, '', 'OLALEYE', 'OLUNIKE', 'VICTORIA', '08036135458', 'oovicky76@gmail.com', 'female', 'Married', '1976-08-08', 'Olaleye Janet', '08036135458', 'Olajide House 59 Poly Road Sango Ibadan\r\n', 'Olajide House 59 Poly Road Sango Ibadan\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$5ZuPKK1PU5fWm0ahVPzzJulN2dvB1vgDc750JmsbsYJFBgZ/dQZ.i', '0', '2022-09-15 15:41:08', '1'),
(602, '498', 'SALAWU ', 'RAIFU', 'SEGUN', '08036404550', 'olanrewajutobiloba12@gmail.com', 'male', 'Married', '1988-12-17', 'Salawudeen Abayomi', '08108013649', '17 Ayedaade Area Caterpilar Monatan Ibadan\r\n', '17 Ayedaade Area Caterpilar Monatan Ibadan\r\n', '', 'Aroma', 'Sango', 'Fryer', 'Fryer', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268005216', '3', '2', '', '', '$2y$10$LyMdbDmuaxSGtBeF7oZA1.6QhQC8PY6SCBhT26JxOoQR.O3AL3SHW', '0', '2022-09-16 07:50:03', ''),
(603, '508', 'OLUFEMI', 'EMMANUEL ', 'SUNDAY', '07018473011', 'fmemmanuelsunday@gmail.com', 'male', 'Single', '1998-07-04', 'Olufemi Isreal Sunday', '', '7 Alaro Street Off Poly Road Sango Ibadan\r\n', '7 Alaro Street Off Poly Road Sango Ibadan\r\n', '', 'Aroma', 'Sango', 'Fryer', 'Fryer', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268338523', '3', '2', '', '', '$2y$10$n.8nRT56Bc5JOLLKduCUM.gL1IrI463O4M1yx11GfEoKgr7SeyHqy', '0', '2022-09-16 08:20:14', ''),
(604, '511', 'OSOKAYA ', 'ADEOLA ', 'TUNBOSUN', '08162242535', 'osokoyatunbosun10@gmail.com', 'male', 'Married', '1980-06-10', 'Osokoya Olufunke', '08081976142', '2 Olopade Street Off Adediran Oke Itunu Ibadan\r\n', '2 Olopade Street Off Adediran Oke Itunu Ibadan\r\n', '', 'Aroma', 'Eleyele', 'Bakery', 'Baker', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268160412', '2', '2', '', '', '$2y$10$PpJJwzMwc.EhdY0DahLX0eCmTpRSUZtInHPxLdeAyHVVhEU0887ie', '0', '2022-09-16 08:28:17', ''),
(605, '507', 'MICHAEL ', 'BUNMI', 'ABIODUN', '07080405358', 'michaelbunmi182@gmail.com', 'male', 'Single', '1995-05-05', 'Michael Modupeoluwa', '08157083085', '24 Orisunmibare Street Alarere Sawmill Ibadan\r\n', '24 Orisunmibare Street Alarere Sawmill Ibadan\r\n', '', 'Aroma', 'Sango', 'Pie Xpress', 'Pie xpress', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268004178', '1', '2', '', '', '$2y$10$/1Kn5nFOnQ5jz8An7uoZ2OkLufqzw8FVeLewAWih1FClPmmTT2/5K', '0', '2022-09-16 11:19:48', ''),
(606, '509', 'AMINU ', 'AKOREDE', 'ABDULMUMEEN', '09060294227', 'alameenwfakoo@gmail.com', 'male', 'Single', '1990-09-09', 'Aminu Mahaada', '07088422147', '5 Ayenero Street Ajegunle Apapa Lagos\r\n', '8 Galadima Street Airport Ilorin\r\n', '', 'Aroma', 'Sango', 'Pie Xpress', 'Pie xpress', '2022-04-15', '1', '30000', '', 'WEMA', '', '0270143740', '1', '2', '', '', '$2y$10$57LrSRF/frXfWb9MVH0SZuPalNTKadmg1.zJGh33RWBLkn8ujPTDW', '0', '2022-09-16 12:40:45', ''),
(607, '513', 'ABORISADE ', 'BLESSING', 'FUNMI', '08132936069', 'aborisadeblessing7@gmail.com', 'female', 'Single', '1995-02-13', 'Mrs Abiodun Tobiloba Racheal', '08106557761', '30 Taiwo Street Sango Ibadan\r\n', '22 Ijaye-Orile Moniya Ibadan\r\n', '', 'Aroma', 'Sango', 'Cashier', 'Cashier', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268292348', '3', '2', '', '', '$2y$10$3EuFFemCgW9aYLBI7eN7NuV0ol1OHTwABgqAWRKsPLxz6VyV./Fxy', '0', '2022-09-16 17:08:28', ''),
(608, '515', 'ADEDOKUN ', 'ADEWUNMI', 'THEOPHILUS', '08054082434', 'adedokunadewunmi4@gmail.com', 'male', 'Single', '1996-07-30', 'Mr. Adedokun Adeyemi', '09022548654', 'Idi Ito Street Sango Ibadan\r\n', 'Ayinde Layout Apata Ibadan\r\n', '', 'Aroma', 'Sango', 'Pie Xpress', 'Pie xpress', '2022-04-15', '1', '30000', '', 'WEMA', '', '0260609838', '1', '2', '', '', '$2y$10$66eE1DCdWvFUUJWZceHvTO7bNaVLjnT7BrZgOrX2LlmJynTPPmK56', '0', '2022-09-16 17:31:30', ''),
(609, '501', 'AJAYI ', 'BISOLA', 'FERANMI', '09038097338', 'charlottewilliams716@gmail.com', 'female', 'Single', '1998-07-07', 'Ajayi Tunmise', '08170119621', '69 Bembo Street Off Poly Road Sango Ibadan\r\n', '2 Aderogba Awotan Street Apete Ibadan\r\n', '', 'Aroma', 'Sango', 'Cashier', 'Cashier', '2022-04-15', '1', '30000', '', 'WEMA', '', '0267962705', '3', '2', '', '', '$2y$10$pbS/UXLhxJdBCCOSCQ2b0O9LxgKL0EyvnqniEi.rF0k2wNhYPPd3i', '0', '2022-09-17 11:01:22', ''),
(610, '497', 'AKINYELE ', 'OLAMIDE', 'OLUWANIFEMI', '09016462154', 'akinyeleboluwatife626@gmail.com', 'female', 'Single', '2002-01-01', 'Akinyele Bisola ', '07057826990', '45 Papa Street Copland Apete Ibadan\r\n', '45 Papa Street Copland Apete Ibadan\r\n', '', 'Aroma', 'Sango', 'Cashier', 'Cashier', '2022-04-15', '1', '30000', '', 'ACCESS BANK', '', '1507832990', '3', '2', '', '', '$2y$10$LCXhlF4btdRsg4IofZ0PoulqGnNKfQyIyD/eEhP3.N0MNgAgm/UjC', '0', '2022-09-17 12:15:42', ''),
(611, '529', 'AMINU ', 'ADEKUNLE', '', '08078755137', 'aaminu0905@gmail.com', 'male', 'Single', '1992-05-09', 'Aminu Monsurat', '07052087107', 'E9/922 Alagaki Abayomi Street Iwo Road Ibadan\r\n', 'E9/922 Alagaki Abayomi Street Iwo Road Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Pie Xpress', 'Pie xpress', '2022-07-01', '1', '30000', '', 'WEMA', '', '0271456342', '3', '2', '', '', '$2y$10$2fmQTL.SkrqeNuO2y/jEYuD1P6TNNctoRJNUQNHTwxHjCgsMD8bLq', '0', '2022-09-17 12:56:38', ''),
(612, '528', 'AYANSIJI ', 'OLAWALE ', 'ABDULGANIYU', '08123472758', 'ayansijiolawale843@gmail.com', 'male', 'Single', '2001-06-03', 'Akinsola Tejumola', '8141848435', '13 Idi Osan Agbaakwu Iwo Road Ibadan\r\n', '13 Idi Osan Agbaakwu Iwo Road Ibadan\r\n', '', 'Aroma', 'Aroma Iwo Road', 'Pie Xpress', 'Pie xpress', '2022-07-01', '1', '30000', '', 'WEMA', '', '0267542314', '3', '2', '', '', '$2y$10$qMB/nvY2m4GIlDhKajcnh.UXX.hdiOC55xhfNuZOjbaAP4l9pgVS6', '0', '2022-09-17 13:11:17', ''),
(613, '455', 'OLADEJO ', 'TEMITOPE ', 'BOSE', '08163643515', 'oladejotabitha109@gmail.com', 'female', 'Single', '1999-02-28', 'Oladejo Oluwatosin', '07086561702', '4 Ire Akari Street Adewolu Ibadan\r\n', '15 Road A2 Alarere Behind Toun Hospital Iwo Road Ibadan\r\n', '', 'Aroma', 'Ibadan (Iwo Road)', 'Cashier', 'Cashier', '2022-02-04', '1', '40000', '', 'WEMA', '', '0254572290', '', '2', '', '', '$2y$10$lETtrXUB18GoosLxrumjFe4s/yy3trurwQW0EhUKAdaoz8ltHba12', '0', '2022-09-20 10:16:24', ''),
(614, '456', 'OSINBOLA', 'IFEOLUWA', 'FATIMOH', '08120725534', 'osinbolaifeoluwa2022@gmail.com', 'female', 'Single', '1999-02-23', 'Mrs Osinbola', '07048136212', 'Salam Salam Omokeye Road Behind Christ Foundation Assembly Alakia Ibadan\r\n', 'Salam Salam Omokeye Road Behind Christ Foundation Assembly Alakia Ibadan\r\n', '', 'Aroma', 'Ibadan (Iwo Road)', 'Cashier', 'Cashier', '2022-02-04', '1', '40000', '', 'WEMA', '', '0255165990', '3', '2', '', '', '$2y$10$4wmXt4WdLuGuGxtiXB1jd.qhgYkLtAt6nRAQpaNZVjDXqIRIlmdxS', '0', '2022-09-20 10:23:14', ''),
(615, '517', 'SALIMON', 'WASIAT', 'ADEYINKA', '07012037101', 'wasiatade2206@gmail.com', 'female', 'Single', '1991-06-22', '', '', '', '', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-04-15', '1', '30000', '', 'WEMA', '', '0268160917', '', '2', '', '', '$2y$10$hgH0GfxTcPUc88sFD63ICu7LSPqdCutPvQSpf7G2gu/1TTOgiYugO', '0', '2022-09-20 11:15:27', ''),
(616, '510', 'OLANREWAJU', 'IFEOLUWA ', 'OLAMIDE', '08136680409', 'olanrewajuifemide14@gmail.com', 'female', 'Single', '1998-03-14', '', '', '63 Onipepeye Old-Ife Road Ibadan\r\n', '63 Onipepeye Old-Ife Road Ibadan\r\n', '', 'Aroma', 'Sango', 'Cashier', 'Cashier', '2022-04-15', '1', '30000', '', 'WEMA', '', '0267962640', '', '2', '', '', '$2y$10$0vdMou.L0qg3Tk4r7A3fD.UJ9888.79NTtAR4DfVsFDzfiabptIYu', '0', '2022-09-20 12:52:20', ''),
(617, '', 'OLANREWAJU', 'IFEOLUWA ', 'OLAMIDE', '08136680409', 'olaifeolamide2022@gmail.com', 'female', 'Single', '1998-03-14', '', '', '63 Onipepeye Old-Ife Road Ibadan\r\n', '63 Onipepeye Old-Ife Road Ibadan\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$2.TqXjcAO5m9hKJR/im/hud5NNlT9o7IZsuTYquRpqaC9EvEchvca', '0', '2022-09-20 12:52:22', '1'),
(618, '332', 'AYODELE', 'YETUNDE', '', '08143241884', 'oyeniyiyetundeayodele@gmail.com', 'female', 'Married', '1988-12-12', 'Oyeniyi Yinka', '08144669305', 'Agbabika Road Upper Gaa-Akanbi Ilorin\r\n', 'Agbabika Road Upper Gaa-Akanbi Ilorin', '', 'Aroma', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'ZENITH', '', '2118702968', '3', '2', '', '', '$2y$10$Uo63Cut4secYtMPxXSlNa.xJnehJihTeLtEIG9w.gIzZXrxHRnnIW', '0', '2022-09-20 16:04:23', ''),
(619, '518', 'OGUNWALE ', 'RASHEEDAT', 'ABIOLA', '07058919632', 'rashyabiola1402@gmail.com', 'female', 'Single', '1992-02-14', 'Ogunwale Milia', '09077451848', '14 Alhaji Bello Street Idi- Ope Eleyele Ibadan\r\n', '14 Alhaji Bello Street Idi- Ope Eleyele Ibadan\r\n', '', 'Aroma', 'Sango', 'Host', 'host', '2022-04-15', '1', '30000', '', 'WEMA', '', '0267998021', '', '2', '', '', '$2y$10$dOc17d71H3XzbaP.0R06Te8G1HcsfGMZFUEZFxICwMrujqpx40gRC', '0', '2022-09-20 19:19:18', ''),
(620, '485', 'LAWAL', 'SHUKROH', '', '08151496052', 'lshukroh04@gmail.com', 'female', 'Single', '2004-12-03', 'Lawal Soliat', '', '2 Sule Manager Street Iwo Road Ibadan \r\n', '2 Sule Manager Street Iwo Road Ibadan', '', 'Aroma', 'Ibadan (Iwo Road)', 'cook', 'cook', '2020-10-01', '1', '30000', '', 'WEMA', '', ' 268240868 ', '', '2', '', '', '$2y$10$V623TVBdkmw4wfbroSdgrOcnzc.ofZgJ8cM39t1kF3Ixns9g.6q96', '0', '2022-09-24 11:52:57', ''),
(621, '494', ' AYINDE', 'SIKIRU', '', '08077027701', 'esekaybaker@gmail.com', 'male', 'Married', '', '', '', '', '', '', 'Aroma', 'Eleyele', 'Bakery', 'Baker', '2022-05-05', '1', '60000', '', '', '', '', '', '2', '', '', '$2y$10$RrWSoiBBwq9TjEMmMNo8RO28DubYQR.SC3rmYgqgY8FvWLISx6cR6', '0', '2022-09-24 13:37:07', ''),
(622, '538', 'OLADIMEJI ', 'SAMUEL', 'LEKAN', '08132242537', 'samueloladimeji2014@gmail.com', 'male', 'Single', '1996-09-23', '', '', '14 Fashina Street Orogun Area Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'Fryer', 'Fryer', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271574345', '', '2', '', '', '$2y$10$HrN1D5inAnOVHag3fXP1ueF36bfV2SDqJfsW6b5XtwAOafva/OYVq', '0', '2022-09-24 14:20:13', ''),
(623, '', 'OLADIMEJI ', 'SAMUEL', 'LEKAN', '08132242537', 'samueloladimeji2014@gmail.com', 'male', 'Single', '1996-09-23', '', '', '14 Fashina Street Orogun Area Ibadan\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$W40qMgA9ZzC7sisxR72VZOnc7Psy1VyPJLc/JslAkbd4Ukplrqw2q', '0', '2022-09-24 14:20:13', '1'),
(624, '', 'OLADIMEJI ', 'SAMUEL', 'LEKAN', '08132242537', 'samueloladimeji2014@gmail.com', 'male', 'Single', '1996-09-23', '', '', '14 Fashina Street Orogun Area Ibadan\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$TXAquvvHOdJLVvNec22S1OIMXU2apwAqETwSLSUwTcqJPecdymMly', '0', '2022-09-24 14:20:13', '1'),
(625, '', 'OLADIMEJI ', 'SAMUEL', 'LEKAN', '08132242537', 'samueloladimeji2014@gmail.com', 'male', 'Single', '1996-09-23', '', '', '14 Fashina Street Orogun Area Ibadan\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$dOF34VJnMUd8yQsK7wC5Tezjs1hPAOOqmjd0VNnG.8UgwZ5yFAt4K', '0', '2022-09-24 14:20:13', '1'),
(626, '', 'OLADIMEJI ', 'SAMUEL', 'LEKAN', '08132242537', 'samueloladimeji2014@gmail.com', 'male', 'Single', '1996-09-23', '', '', '14 Fashina Street Orogun Area Ibadan\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$dR4y2wBbfeXDIvrYXgGb8exDfzztnkTSKUmEaFJK9LI0C38a8U.Ue', '0', '2022-09-24 14:20:13', '1'),
(627, '526', 'OLANLOKUN', 'OLUWATAYO', 'MOSES', '09073150530', 'tayo0535@gmail.com', 'male', 'Single', '1993-04-02', 'Mrs Olankokun', '08055520599', '18 Olagoke Street Abayomi Iwo Road Ibadan\r\n', '18 Olagoke Street Abayomi Iwo Road Ibadan\r\n', '', 'Aroma', 'Ibadan (Iwo Road)', 'Pie Xpress', 'Pie xpress', '2022-06-20', '1', '30000', '', 'WEMA', '', '0269893371', '', '2', '', '', '$2y$10$dXE.7mJk7tXCc3SDmyTnceB7P00Du7mQcJ/LQXR6ZJU/n0H7yUfd2', '0', '2022-09-25 14:48:43', ''),
(628, '544', 'CHIEWUZIE', 'JENNIFER', 'CHINWENDU', '07068665126', 'jenniferemmanuel604@gmail.com', 'female', 'Single', '1997-11-03', '', '', '38 Taiwo Street Off Bembo Sango Ibadan\r\n', '', '', 'Aroma', 'Ibadan (Iwo Road)', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271535423', '', '2', '', '', '$2y$10$uoIx9Y4X3t0rQb5l76jBi.ftyzzbrqlLF32XdhbFhmb/27VUECHBO', '0', '2022-09-26 15:39:47', ''),
(629, '558', 'ADELEKE ', 'ADENIKE', 'AMIDAT', '08163875386', 'mamalaw145@gmail.com', 'female', 'Single', '1997-04-06', '', '', '40 Agboola Street Molade Ibadan\r\n', '', '', 'Aroma', 'Ibadan (Iwo Road)', 'Cashier', 'Cashier', '2022-08-01', '1', '30000', '', 'WEMA', '', '0235572877', '', '2', '', '', '$2y$10$YeXZYfBAG/v/JMMtXBmfP.zfaCM0CoOWT/9m6gzRVcY9AbTsoy/56', '0', '2022-09-26 15:49:03', ''),
(630, '566', 'ABDUL-RAZAQ ', 'MALIK', '', '09130380413', 'abdulrazaqmalik1218@gmail.com', 'male', 'Single', '1996-08-18', '', '', '4 Balogun Street Bashorun Ibadan\r\n', '', '', 'Aroma', 'Ibadan (Iwo Road)', 'Pie Xpress', 'Pie xpress', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271455541', '', '2', '', '', '$2y$10$3T5E3W6s.UqGWQ2k8U4hde1.edtVIsNYfvWLn.YeQW1S.YY9a3m5W', '0', '2022-09-26 15:53:44', ''),
(631, '', 'ABDUL-RAZAQ ', 'MALIK', '', '09130380413', 'abdulrazaqmalik1218@gmail.com', 'male', 'Single', '1996-08-18', '', '', '4 Balogun Street Bashorun Ibadan\r\n', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$grSW4FelO6t5.bNc.oGeBeKsHPqXnp9ume7Z8lWwFCvQ.xx5jnlGe', '0', '2022-09-26 15:53:46', '1'),
(632, '530', 'ADEGBOYEGA ', 'RUKAYAT', 'TEMITOPE', '09044979688', 'adegboyegarukayat2022@gmail.com', 'female', 'Single', '', '', '', '', '', '', 'Aroma', 'Ibadan (Iwo Road)', 'Cashier', 'Cashier', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271702812', '', '2', '', '', '$2y$10$basNsTMAy3jtqpLiySe8vegGhn7nEq1kJ7U5TTM4IO4VwwWh0wYNS', '0', '2022-09-26 16:07:12', ''),
(633, '557', 'KAYODE', 'BASIRAT', 'OLASUNKANMI', '09045804099', 'kayodebasirat@gmail.com', 'male', 'Single', '1989-01-08', '', '', 'Oremeji Street Yemetu Alaadorin Ibadan\r\n', '', '', 'Aroma', 'Ibadan (Iwo Road)', 'Host', 'host', '2022-09-01', '1', '30000', '', 'WEMA', '', '0271570897', '', '2', '', '', '$2y$10$KZ6knTx7NDoY.WM9fQ4ieuW9lb0W9sPJEuEI2EyqegOHtErEoXe5e', '0', '2022-09-26 16:18:10', ''),
(634, '567', 'OYEBAMIJI', 'ABIDEMI', '', '07060578118', 'abibamoye@gmail.com', 'male', 'Single', '1987-01-19', '', '', 'Plasto Street, I.K. Dairo Gate Ibadan\r\n', '', '', 'Aroma', 'Ibadan (Iwo Road)', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271455486', '', '2', '', '', '$2y$10$IZK0ZJzu9SrngXlksh/SLuHmTFlKriMEEb39O6BaRDV9889ddlZm6', '0', '2022-09-26 19:11:46', ''),
(635, '546', 'OYEDIJI ', 'ADURAGBEMI', 'EUNICE', '7025158658', 'aduragbemi55@gmail.com', 'female', 'Single', '2004-05-05', '', '', '16 Adetokun Area Ologuneru Ibadan\r\n', '', '', 'Aroma', 'Sango', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271552866', '', '2', '', '', '$2y$10$v6TAXWjqo1EeHCAnPTG4PeitWVB3Qjc.CYv8Ko.3TO.QbctfKb1pW', '0', '2022-09-26 20:00:40', '1'),
(636, '562', 'YUSUF', 'TAOFEEK ', ' OLUWADAMILARE', '09053577518', 'dammytimmy@gmail.com', 'male', 'Single', '2003-12-08', '', '', '20 Benjamin Street Eleyele Ibadan\r\n', '', '', 'Aroma', 'Sango', 'Host', 'host', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271455572', '', '2', '', '', '$2y$10$/TtDQE/VGqbyCDxe8HajKerez1IXZv7t2mGRN4j/r9mO.tyxcCkNa', '0', '2022-09-26 20:09:25', ''),
(637, '539', 'AYANBODE', 'OWOLABI', '', '09023426615', 'owoayan84@gmail.com', 'male', 'Single', '1991-04-08', '', '', '22 Alakkia Street Isebo Iwo Road\r\n', '', '', 'Aroma', 'Eleyele', 'Pie Xpress', 'Pie xpress', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271455730', '', '2', '', '', '$2y$10$MjkTr4YemSz2ZuZ557Y.te7U1Kch9Qm.gK8bgol8rCrVTxlhb.0g6', '0', '2022-09-26 20:33:50', ''),
(638, '540', 'BADMUS ', 'HAMMED', 'AYOMIDE', '08069487684', 'badmushammed98@gmail.com', 'male', 'Single', '1998-09-02', '', '', '56 Alemo-Oke Street Sango\r\n', '', '', 'Aroma', 'Eleyele', 'Pie Xpress', 'Pie xpress', '2022-08-01', '1', '30000', '', '', '', '', '', '2', '', '', '$2y$10$Q3yP7ONM7Wh4snrWUligouySbc4z.J5FTkPvHaDNLsNbT.YqxBgCy', '0', '2022-09-27 10:13:59', ''),
(639, '580', 'SULAIMON ', 'RIDWAN', 'ADISA', '7034278483', 'muryjohn0805184@gmail.com', 'male', 'Single', '', '', '', '', '', '', 'Aroma', 'Ibadan (Iwo Road)', 'Fryer', 'Fryer', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271456397', '', '2', '', '', '$2y$10$RGg5C.s1Uge2ZxlGXy7mQOvXtf6OqJyZTEQZAU.QGfCVp/.i/9nRm', '0', '2022-09-27 11:37:20', '');
INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `last_name`, `other_name`, `phone`, `email`, `gender`, `marital_status`, `dob`, `kin_name`, `kin_phone`, `present_add`, `permanent_add`, `highest_qualification`, `company`, `branch`, `department`, `job_title`, `date_employed`, `employment_type`, `present_salary`, `grade_step`, `bank_name`, `bank_code`, `account_number`, `blood_group`, `company_id`, `photo`, `notification`, `hashed_password`, `update_profile`, `created_at`, `deleted`) VALUES
(640, '541', 'BELLO ', 'JEMILLAT', 'OPEYEMI', '08140321812', 'jemilatbello940@gmail.com', 'female', 'Single', '1998-03-31', '', '', '25 Otun Street Jeje Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0270352715', '', '2', '', '', '$2y$10$hzbnHJgoL17K7.VJQHa33ORkS70SoqjRfYx0vQUtVGKCl/Rp6T8Xy', '0', '2022-09-27 11:48:19', ''),
(641, '542', 'ABDULMUMIN ', 'ZAINUB', 'ADEKEMI', '08064451799', 'azainabadekemi@gmail.com', 'female', 'Single', '1998-02-12', '', '', 'Ore-Ofe Lane 1, Osajin Apete Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'Cashier', 'Cashier', '2022-08-01', '1', '30000', '', 'WEMA', '', '0233209812', '', '2', '', '', '$2y$10$h7.pdLkl2vySdbmXQRpPIuWePvIYKHgKnDz55/FULgZsyTluukrBi', '0', '2022-09-27 11:55:15', ''),
(642, '543', 'MOSHOOD ', 'MARIAM', 'ADEDAMOLA', '08109899829', 'mariamade278@gmail.com', 'female', 'Single', '1996-08-27', '', '', 'Idito Area Poly Road Sango Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271455527', '', '2', '', '', '$2y$10$/DubVh770B0ReP57IhSR0OnKNUuD1avWF6bRNx/95LSr7WHBwrbMa', '0', '2022-09-27 12:01:51', ''),
(643, '545', 'ADEDIRAN ', 'YETUNDE', 'AZEEZAT', '08028009965', 'adediranyetunde2020@gmail.com', 'female', 'Single', '2000-05-24', '', '', '30 Surulere Street Sango Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'Cashier', 'Cashier', '2022-08-01', '1', '30000', '', 'WEMA', '', '0269727212', '', '2', '', '', '$2y$10$NkFjp.PeKU07rZQq9Sffc.r/gIwKDS0piiJx7GwZsHYEfoIAfRWR2', '0', '2022-09-27 12:08:08', ''),
(644, '547', 'OLANIYI', 'AYOMIDE', 'SAMUEL', '08137155310', 'olaniyiayomide80@gmail.com', 'male', '', '', '', '', '', '', '', 'Aroma', 'Eleyele', 'Pie Xpress', 'Pie xpress', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271408286', '', '2', '', '', '$2y$10$BXp2JHKcE2QhP4amv9ShquaHvd2CmrQALmJgTrDnrB4oWpy4CJI9m', '0', '2022-09-27 12:15:17', ''),
(645, '548', 'ODEYEMI', 'ABAYOMI', 'OLALEKAN', '08160701292', 'beatbydemo@gmail.com', 'male', 'Single', '1993-10-05', '', '', 'Road 2 Owola Stree Ologunerun Eruwa Road Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271544540', '', '2', '', '', '$2y$10$tqNesMcJXln5t7dLjb3yzOGlnKbzFjdW.8Evb06AF4AD5BvFvTkiW', '0', '2022-09-27 12:22:08', ''),
(646, '549', 'AWOTIMILEHIN ', 'SHOLA', '', '09035492641', 'olaitansola3@gmail.com', 'male', 'Single', '1991-04-21', '', '', '6 Agbofieti Street Ile titun Teachers Quareters Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'Fryer', 'Fryer', '2022-08-01', '1', '30000', '', 'WEMA', '', '0269882487', '', '2', '', '', '$2y$10$MJ6iIcX1u3C7pXOtBjg5FeUyLfxB5k4ASBdslxuxLItgUnitEiSA2', '0', '2022-09-27 12:25:29', ''),
(647, '550', 'SALAMI ', 'IBRAHIM', 'ADISA', '07085617413', 'hardeyjumohorlar@gmail.com', 'male', 'Single', '1992-10-25', '', '', 'N1/505 Toki Compound Ayeye Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'Pie Xpress', 'Pie xpress', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271473163', '', '2', '', '', '$2y$10$TOuY8e3/r8oOYqJOgwpJFObfpJe2K.cKFk8PH1Q9vPF/J8IP10Tk.', '0', '2022-09-27 12:29:51', ''),
(648, '551', 'ABIOYE ', 'ADEOYE', '', '09126294363', 'abiade2369@gmail.com', '', '', '', '', '', '', '', '', 'Aroma', 'Eleyele', 'Fryer', 'Fryer', '2022-08-01', '1', '30000', '', 'WEMA', '', '0269752476', '', '2', '', '', '$2y$10$NWXL55/vmVSGbheXBiyZLuHY1SvDNLFzN57.e6u92qHywOAW7rFAK', '0', '2022-09-27 12:32:23', ''),
(649, '552', 'OLAWUYI', 'TIWALADE ', 'PONMILE', '08139585102', 'olawuyitiwalade6@gmail.com', 'female', 'Single', '', '', '', 'Opposite The Polytechnic Ibadan Gate Sango Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0269885835', '', '2', '', '', '$2y$10$Slvb9BAe0oktBP/Nr6oqMesXuBMJIqLv.9c/3lVXHD1XA3HjHGbVu', '0', '2022-09-27 13:27:47', ''),
(650, '553', 'OLUWATIMILEHIN ', 'OLUWABUKOLA', 'JULIANAH', '08103767880', 'jollyjulianah@gmail.com', 'female', 'Single', '1989-11-05', '', '', '39 Bisimorafa Street Ijokodo Barracks Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271455716', '', '2', '', '', '$2y$10$huLqtYhwUK4BDFc.5Py7AuqB4w934xKMULEYU5RyXC2NJByv71Cxe', '0', '2022-09-27 13:33:42', ''),
(651, '554', 'EZE ', 'JOY ', 'CHINWE', '08137057447', 'joyeze4545@gmail.com', '', '', '', '', '', '', '', '', 'Aroma', 'Eleyele', 'Cashier', 'Cashier', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271456438', '', '2', '', '', '$2y$10$uHHJzjWiWidTxn/z.XuoKui2Npxr.GwUg4sDgjh3hpOV0RdyjNmge', '0', '2022-09-27 13:37:26', ''),
(652, '555', 'BUSARI ', 'NAFISAT ', 'OMOSALEWA', '07012266860', 'bnafisat75@gmail.com', 'female', 'Single', '1994-07-15', '', '', '53 Ifelodun Zone D Jaloke Olomi Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271454805', '', '2', '', '', '$2y$10$Sor/IeI9kFDCSEsp6/ySiO0wU1/8Ubff8GgF/zchjXyNqTHfSNl7K', '0', '2022-09-27 13:58:27', ''),
(653, '556', 'BOLAJI', 'OLAPEJU', 'RACHEAL', '08164154114', 'olapejuwura@gmail.com', 'female', 'Single', '1997-11-27', '', '', '7b Tafo Arena Street Ijokodo Sango Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'Cashier', 'Cashier', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271565015', '', '2', '', '', '$2y$10$OezPo6mwBEIakw8AFYB/OO2f8aD532OPpS43saiFH24CQ9wg5wOC.', '0', '2022-09-27 14:02:05', ''),
(654, '559', 'SALAMI', 'NASRAT', 'OREOLUWA', '09041697286', 'salaminasratoreoluwa@gmail.com', 'female', 'Single', '2001-03-07', '', '', '9 Elewure Street Ojurin Sango Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271632418', '', '2', '', '', '$2y$10$QOAmuQ8GzcTi.15sRyGjt.PmDEdRQlTfm5ELlLM.ay8iuP82EbFTW', '0', '2022-09-27 14:07:09', ''),
(655, '560', 'OGUNWALE ', 'CHRISTIANA ', 'OYINLADE', '07069453542', 'oyinladechristiana12@gmail.com', 'female', '', '1986-10-13', '', '', '18 Akorede Street Off Poly Road Sango Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'cook', 'cook', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271457435', '', '2', '', '', '$2y$10$tT/3HkxZ88gBwgE8JyxDVOeA7Yix0PzCcOskgyMWjyk5KHwsUBJzy', '0', '2022-09-27 14:21:17', ''),
(656, '563', 'OLADIPUPO ', 'ARAOLA ', 'OLAMIDE', '08132759571', 'oladipupoaraolaolamide@gmail.com', 'male', 'Single', '1998-12-24', '', '', '', '', '', 'Aroma', 'Eleyele', 'Fryer', 'Fryer', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271402844', '', '2', '', '', '$2y$10$5g55oMvctdUr79NfFp4KsOp2HD1uBOv7kzfFCUTuogKJ/2BqToTkm', '0', '2022-09-27 14:38:17', ''),
(657, '564', 'OLAOYE ', 'WARIS ', 'OLAMILEKAN', '09130788091', 'wariswagzy@gmail.com', 'male', '', '2001-04-27', '', '', '6A Surulere Street Sango Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'Host', 'host', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271444107', '', '2', '', '', '$2y$10$FHRy8BSx48/I3NkqpzlZD.LMcLv3gG1HM3AbzarUPyloEQHhna/o2', '0', '2022-09-27 14:42:18', ''),
(658, '568', 'POPOOLA', 'KAMOUDEEN', 'DAMILARE', '09061202558', 'ddray150@gmail.com', 'male', 'Single', '1998-01-10', '', '', '29 Surulere Street Elewure Sango Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'Host', 'host', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271456854', '', '2', '', '', '$2y$10$LF7tVqUNzb4tvPmnHsHGzODyoriXp0b3dRKVHYLKIZxkOHJEfJ9yi', '0', '2022-09-27 14:48:18', ''),
(659, '561', 'ABOLAJI', 'YUNUS', 'AYINDE ', '09124490134', 'abolajiyunus31@gmail.com', 'male', 'Single', '1997-02-20', '', '', '76 Edun Street Ilorin\r\n', '', '', 'Aroma', 'Eleyele', 'Bakery', 'Baker', '2022-08-01', '1', '30000', '', 'WEMA', '', '0271456524', '', '2', '', '', '$2y$10$zSuA0xPZRAgietBKL7m9XOOcRq3OOn2IjJcbhtFvE0vQKs77Vtbjy', '0', '2022-09-27 14:55:30', ''),
(660, '565', 'OLAWALE ', 'ABIODUN ', 'ROBERT', '08122228049', 'suskyhazd@gmail.com', 'male', 'Single', '1989-12-31', '', '', '15 Adebayo Street Sango Ibadan\r\n', '', '', 'Aroma', 'Eleyele', 'Bakery', 'Baker', '2022-08-01', '1', '30000', '', 'WEMA', '', '0239046152', '', '2', '', '', '$2y$10$h/rAveWryo6a66pGFeVkQ.vM6KvKdbmaHFQcgaqSpdTf0dctIag1S', '0', '2022-09-27 15:02:41', ''),
(661, '534', 'OLURINDE ', 'TEMITOPE', 'VICTORIA', '09095049339', 'topsugar79@gmail.com', '', '', '', '', '', '', '', '', 'Aroma', 'Aroma Unity', 'cook', 'cook', '2022-08-01', '1', '40000', '', 'WEMA', '', '0271600169', '', '2', '', '', '$2y$10$FsdteiXTopLi1XDi4BZmse8bS7EDEF3yn.2OBA7Z1WUO5jdTe.VPq', '0', '2022-09-27 15:33:17', ''),
(662, '570', 'SIKIRU ', 'OLANREWAJU', '', '07049077832', 'sikiruwelder1@gmail.com', '', '', '', '', '', '', '', '', 'Olak Roofing Factory', 'Olak Roofing Factory(Irewolede)', 'Mechanical', 'Welder', '2022-09-01', '1', '50000', '', '', '', '', '', '3', '', '', '$2y$10$GxTy277mwu1i7E7hpP5pSOJOwZfKVD2Wl6L2GXblUIS.SkIfzAVla', '0', '2022-09-27 18:37:14', ''),
(663, '571', 'SHUAIB ', 'SHERIFFDEEN', 'GBEMISOLA', '09065132878', 'shuaibsheriffdeen@gmail.com', 'male', 'Single', '', '', '', '44 Ile Bale Street Agbo Oba Ilorin\r\n', '', '', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'FBN', '', '3116187506', '', '4', '', '', '$2y$10$IrDta1cjFbaX./WZR0teM.asrBpWxoxAnaYNg/K.FCr4XCNoDjc3G', '0', '2022-09-27 19:35:43', ''),
(664, '572', 'ABDULLAHI ', 'RUKAYAT', '', '09133151330', 'adeola2000@gmail.com', 'female', 'Single', '2000-03-02', 'Abdullahi Rasidat', '0818005982', '57 Ode-Gbagba Kakatu Compound Okelele Gambari Ilorin\r\n', '55 Kankantu Area Odebanbag Compound Ilorin\r\n', '', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'GTB', '', '0556003420', '', '4', '', '', '$2y$10$6Jet7NLf0MDmkc49uXfrJ.Hg8LxblXF3.30DeU/S2ZLbeKTN.LB4K', '0', '2022-09-27 19:41:36', ''),
(665, '573', 'OLANIYAN', 'KEHINDE', 'OMOLOLA', '08130527476', 'olaomokenny@gmail.com', 'female', 'Single', '', '', '', '27 Galadima Street Airport Road Ilorin\r\n', '', '', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'UBA', '', '2211428965', '', '4', '', '', '$2y$10$fx9oSJIMpR.pn.nevhQu1.YEUaxePBm6wUFWpLeCFJ4RlMVpBB0/K', '0', '2022-09-28 02:22:48', ''),
(666, '574', 'IDRIS ', 'MORUFAT ', 'ABIODUN', '08141311882', 'abdullahiidrismorufat@gmail.com', 'female', 'Single', '', '', '', '35 Niger Road Ilorin\r\n', '', '', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'UBA', '', '2197358982', '', '4', '', '', '$2y$10$uKXuP8I0jSTbgTSfC33VEu6YkU08LQ3k5hcGCSgkjIs2Izc33Cdia', '0', '2022-09-28 07:36:49', ''),
(667, '575', 'OLUDARE', 'EMMANUEL', 'SUNDAY', '09130051607', 'sundayemmanuel76@gmail.com', 'male', 'Single', '', '', '', '24 Alagbede Area Offa Garage Ilorin\r\n', '', '', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'ACCESS BANK', '', '0036690687', '', '4', '', '', '$2y$10$sRBttC00U3cgth/XJa0hIelK0LCxjs.JtM8OojCrz.O2O/9Uul9rS', '0', '2022-09-28 08:31:33', ''),
(668, '575', 'OLUDARE', 'EMMANUEL', 'SUNDAY', '09130051607', 'sundayemmanuel76@gmail.com', 'male', 'Single', '1999-03-16', 'Oludare Abiodun', '09019304019', '24 Alagbede Area Offa Garage Ilorin\r\n', '24 Alagbede Area Offa Garage Ilorin', '', 'Petroleum', 'Ilorin (A division)', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'ACCESS BANK', '', '0036690687', '3', '4', '', '', '$2y$10$HMQh1yIwnIEg4Dnji/6/EutOBJ1sHN9VbO3LG6.BnIlowLU2mvr6e', '0', '2022-09-28 08:35:19', '1'),
(669, '578', 'KAZEEM ', 'SAHEED', '', '09022523909', 'kazeemsaheed63@gmail.com', 'male', 'Single', '', '', '', '42 Gaa-Akanbi Road Ilorin\r\n', '', '', 'Petroleum', 'Olak Pet. Ilorin(A-Division) ', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'GTB', '', '0455376443', '', '4', '', '', '$2y$10$W7lZc3NIu35gLccJoH2QX.7JK.iusxMByXD.cnVeZ1wxfL0sfr7dO', '0', '2022-09-28 08:38:44', ''),
(670, '576', 'USMAN ', 'YUSUF', 'OLATUNJI', '09060389419', 'ogbenime@gmail.com', 'male', 'Single', '', '', '', '8 Ile Babakha Street Baruba Area Ilorin\r\n', '', '', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'FCMB', '', '5010642014', '', '4', '', '', '$2y$10$4R.wha2IQAVH8JHgwPVOX.qgTooXFUZ7vd7h/gGiS54/RXsjHrPMK', '0', '2022-09-28 08:42:15', ''),
(671, '577', 'AGBELA ', 'IBRAHIM ', 'RIDWAN', '08057146956', 'ibrahimridwan@gmail.com', 'male', 'Single', '', '', '', '23 Isale-Koto Street Near Ago Market Ilorin\r\n', '', '', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'FBN', '', '0623512684', '', '4', '', '', '$2y$10$Bx2nGAY4e6yr4Oz10ApcT.A8W1bUVlM1PEGMC87yp.brKDgkJaTjW', '0', '2022-09-28 08:54:26', ''),
(672, '579', 'OJO ', 'CHRISTIANA', 'OMOMO', '09035249890', 'christyomomo@gmail.com', 'male', 'Single', '', '', '', '78 Onitiku Street Sao garage Ilorin\r\n', '', '', 'Petroleum', 'Olak Pet. Usanda', 'Sales & Marketing', 'Sales Attendant', '2022-09-01', '1', '30000', '', 'UBA', '', '2237747761', '', '4', '', '', '$2y$10$s1PLUiE7x/V8XP78Q/00IuVpTIh6pAza.SFOu9USkqm9fwHZPfCqy', '0', '2022-09-28 08:58:59', ''),
(673, '028', 'FRIDAY', 'VERONICA', '', '', 'verofry28@gmail.com', 'female', 'Married', '', '', '', '', '', '', 'Aroma', 'Eleyele', 'Human Resource & Admin', 'Cleaner', '2022-09-09', '2', '30000', '', '', '', '', '', '2', '', '', '$2y$10$8TQJFt1YkvfEHuRqCF9UJ.wG5tfZSluLBkefjHZJKALqEW3avCBX.', '0', '2022-09-28 17:37:24', '1'),
(674, '29', 'OLAKAYODE ', ' ADUNNI ', '', '07081713320', 'mamaadunniola@gmail.com', 'female', 'Married', '1961-05-23', '', '', '', '', '', 'Aroma', 'Eleyele', 'Human Resource & Admin', 'Cleaner', '2022-10-03', '2', '30000', '', '', '', '', '', '2', '', '', '$2y$10$4nu1KUTAqNR6I//6Sr5sG.NxAuJFcaJ.JOqijpFgtv6SpvWjKpYO2', '0', '2022-10-08 17:23:22', ''),
(675, '581', 'YAKUBU ', 'ABDULSALAM', '', '', 'yakubuabdulsalambenin@gmail.com', 'male', 'Married', '', '', '', '', '', '', 'Aroma', 'Eleyele', 'Human Resource & Admin', 'Driver', '2022-10-03', '1', '34000', '', '', '', '', '', '2', '', '', '$2y$10$1qpIWb6uMbq/4WL8w3sIbearkyr.v4t00hEDNjrXpgJD.6F5fEkZa', '0', '2022-10-08 17:26:40', '1'),
(676, '414', 'ABDULRASAK ', 'SHIRU', '', '08142622630', 'akamoshiru10@gmail.com', 'male', 'Married', '1960-10-01', 'Shiru Risikat', '08139433029', 'Shiru Compound 58 Pakata Road Ilorin\r\n', 'Shiru Compound 58 Pakata Road Ilorin\r\n', '', 'Transport', 'Head office', 'Transport', 'Driver', '2022-10-01', '1', '38000', '', '', '', '', '', '7', '', '', '$2y$10$I1gvXV.upz847gVTITQ/IO1vKZvfIdQHLozVB1qqu5rpbE1V2RXBG', '0', '2022-10-13 08:38:11', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendances`
--

CREATE TABLE `employee_attendances` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `clock_in` time NOT NULL DEFAULT current_timestamp(),
  `clock_out` time NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_docs`
--

CREATE TABLE `employee_docs` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(5) NOT NULL,
  `cv` varchar(50) NOT NULL,
  `id_card` varchar(50) NOT NULL,
  `offer_letter` varchar(50) NOT NULL,
  `acceptance_letter` varchar(50) NOT NULL,
  `agreement_letter` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_education`
--

CREATE TABLE `employee_education` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `complete_date` date NOT NULL,
  `degree` varchar(50) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_experience`
--

CREATE TABLE `employee_experience` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `job_position` varchar(50) NOT NULL,
  `period_from` date NOT NULL,
  `period_to` date NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee_types`
--

CREATE TABLE `employee_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_types`
--

INSERT INTO `employee_types` (`id`, `name`, `created_at`, `deleted`) VALUES
(1, 'Regular', '2022-01-19 13:47:45', 0),
(2, 'Ad-hoc', '2022-01-26 08:54:57', 0),
(3, 'Contract', '2022-01-26 08:55:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_type` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `duration` varchar(50) NOT NULL,
  `days_left` varchar(50) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `date_approved` date NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee_id`, `leave_type`, `date_from`, `date_to`, `duration`, `days_left`, `reason`, `status`, `approved_by`, `date_approved`, `created_at`, `deleted`) VALUES
(1, 381, 7, '2022-01-24', '2022-01-29', '5 days', '1', '', 2, 1, '2022-02-03', '2022-01-24 12:28:22', 0),
(3, 133, 6, '2022-02-01', '2022-02-01', '', '12', 'Travel to my home town to visit my sick parents', 1, 0, '2022-02-11', '2022-02-11 12:52:17', 0),
(4, 556, 4, '2022-05-08', '2022-05-08', '', '60', 'Child support', 4, 1, '2022-05-08', '2022-05-08 12:13:28', 0),
(5, 556, 4, '2022-05-08', '2022-05-08', '', '60', 'Child support', 1, 0, '2022-05-08', '2022-05-08 12:13:30', 0),
(6, 556, 4, '2022-05-08', '2022-05-08', '', '60', 'Child support', 4, 1, '2022-05-08', '2022-05-08 12:13:32', 0),
(7, 556, 4, '2022-05-08', '2022-05-08', '', '60', 'Child support', 1, 0, '2022-05-08', '2022-05-08 12:13:33', 0),
(8, 556, 4, '2022-05-08', '2022-05-08', '', '60', 'Child support', 1, 0, '2022-05-08', '2022-05-08 12:13:34', 0),
(9, 556, 4, '2022-05-08', '2022-05-08', '', '60', 'Child support', 1, 0, '2022-05-08', '2022-05-08 12:13:34', 0),
(10, 556, 4, '2022-05-08', '2022-05-08', '', '60', 'Child support', 1, 0, '2022-05-08', '2022-05-08 12:13:38', 0),
(11, 556, 4, '2022-05-08', '2022-05-08', '', '60', 'Child support', 1, 0, '2022-05-08', '2022-05-08 12:13:38', 0),
(12, 556, 4, '2022-05-08', '2022-05-08', '', '60', 'Child support', 4, 1, '2022-05-08', '2022-05-08 12:13:39', 0),
(13, 555, 3, '2022-05-08', '2022-05-08', '', '25', 'Sick', 3, 1, '2022-05-08', '2022-05-08 12:14:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE `leave_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `duration`, `created_at`, `deleted`) VALUES
(1, 'Half Day Leave', '1', '2022-01-21 13:19:37', 0),
(2, 'Casual Leave', '30', '2022-01-21 13:20:07', 0),
(3, 'Sick Leave', '25', '2022-01-21 13:20:21', 0),
(4, 'Maternity Leave', '60', '2022-01-21 13:20:33', 0),
(5, 'Paternity Leave', '0', '2022-01-21 13:20:45', 0),
(6, 'Annual Leave', '14', '2022-01-21 13:20:57', 0),
(7, 'Unpaid Leave', '6', '2022-01-21 13:21:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `long_term_loans`
--

CREATE TABLE `long_term_loans` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(10) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `amount_requested` varchar(50) NOT NULL,
  `amount_paid` varchar(50) NOT NULL,
  `commitment` varchar(50) NOT NULL,
  `date_requested` datetime NOT NULL,
  `deduction_date` varchar(50) NOT NULL,
  `loan_duration` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `long_term_loans`
--

INSERT INTO `long_term_loans` (`id`, `employee_id`, `ref_no`, `amount_requested`, `amount_paid`, `commitment`, `date_requested`, `deduction_date`, `loan_duration`, `deleted`) VALUES
(1, '676', '1500517', '30000', '0', '3000', '2022-10-23 15:00:51', '2022-10-23', '10', ''),
(2, '674', '1501346', '20000', '0', '2000', '2022-10-23 15:01:34', '2022-10-23', '10', '');

-- --------------------------------------------------------

--
-- Table structure for table `long_term_loan_details`
--

CREATE TABLE `long_term_loan_details` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `employee_id` varchar(10) NOT NULL,
  `type` varchar(5) NOT NULL,
  `commitment_duration` varchar(50) NOT NULL,
  `loan_repayment` varchar(50) NOT NULL,
  `balance` varchar(50) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL,
  `note` varchar(50) NOT NULL,
  `file_uploads` varchar(50) NOT NULL,
  `issued_by` int(11) NOT NULL,
  `date_approved` date NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `long_term_loan_details`
--

INSERT INTO `long_term_loan_details` (`id`, `ref_no`, `employee_id`, `type`, `commitment_duration`, `loan_repayment`, `balance`, `payment_method`, `status`, `note`, `file_uploads`, `issued_by`, `date_approved`, `created_at`, `deleted`) VALUES
(1, '1500517', '676', '', '10', '3000', '', '', '3', '', '', 1, '2022-10-23', '2022-10-23 15:00:51', ''),
(2, '1501346', '674', '', '10', '2000', '', '', '3', '', '', 1, '2022-10-23', '2022-10-25 18:38:35', '');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `present_salary` varchar(50) NOT NULL,
  `loan` varchar(50) NOT NULL,
  `salary_advance` varchar(191) NOT NULL,
  `overtime_allowance` varchar(191) NOT NULL,
  `leave_allowance` varchar(50) NOT NULL,
  `other_allowance` varchar(50) DEFAULT NULL,
  `other_deduction` varchar(50) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  `present_days` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `pension` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `employee_id`, `present_salary`, `loan`, `salary_advance`, `overtime_allowance`, `leave_allowance`, `other_allowance`, `other_deduction`, `note`, `present_days`, `payment_status`, `month`, `created_at`, `tax`, `pension`, `deleted`) VALUES
(1, '564', '155000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(2, '563', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(3, '562', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(4, '561', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(5, '560', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(6, '559', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(7, '558', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(8, '557', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(9, '556', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(10, '555', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(11, '554', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(12, '553', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(13, '552', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(14, '551', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(15, '550', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(16, '549', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(17, '548', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(18, '547', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(19, '546', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(20, '544', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(21, '543', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(22, '542', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(23, '541', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(24, '540', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(25, '539', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(26, '538', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(27, '523', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(28, '522', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(29, '521', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(30, '520', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(31, '519', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(32, '518', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(33, '517', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(34, '516', '11600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:36', '', '', ''),
(35, '514', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(36, '513', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(37, '512', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(38, '406', '150000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(39, '405', '200000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(40, '404', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(41, '403', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(42, '402', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(43, '401', '160000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(44, '399', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(45, '398', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(46, '397', '146000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(47, '396', '146000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(48, '394', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(49, '393', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(50, '392', '6000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(51, '391', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(52, '390', '11600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(53, '389', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(54, '388', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(55, '387', '15000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(56, '386', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(57, '385', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(58, '384', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(59, '383', '15000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(60, '382', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(61, '381', '11600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(62, '380', '15000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(63, '379', '6000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(64, '378', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(65, '377', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(66, '376', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(67, '375', '11600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(68, '373', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(69, '372', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(70, '371', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(71, '370', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(72, '369', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(73, '368', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(74, '366', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(75, '364', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(76, '363', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(77, '362', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(78, '361', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(79, '360', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(80, '359', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(81, '358', '72000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(82, '357', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(83, '356', '170000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(84, '355', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(85, '354', '127500', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(86, '353', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(87, '351', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(88, '350', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(89, '349', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(90, '348', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(91, '347', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(92, '346', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(93, '345', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(94, '344', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(95, '343', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(96, '342', '155000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(97, '341', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(98, '340', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(99, '339', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(100, '338', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(101, '337', '115000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(102, '336', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(103, '335', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(104, '334', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(105, '333', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(106, '332', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(107, '331', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(108, '330', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(109, '329', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(110, '326', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(111, '325', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(112, '324', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(113, '323', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(114, '322', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(115, '321', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(116, '320', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(117, '319', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(118, '318', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(119, '317', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(120, '316', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(121, '315', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(122, '314', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(123, '313', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(124, '312', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(125, '311', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(126, '310', '250000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(127, '309', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(128, '308', '20001', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(129, '306', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(130, '305', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(131, '304', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(132, '303', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(133, '302', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(134, '301', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(135, '300', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(136, '298', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(137, '297', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(138, '296', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(139, '295', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(140, '294', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(141, '293', '0', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(142, '292', '0', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(143, '291', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(144, '290', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(145, '289', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(146, '288', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(147, '287', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(148, '286', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(149, '285', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(150, '284', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(151, '283', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(152, '280', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(153, '279', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(154, '278', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(155, '277', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(156, '276', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(157, '274', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(158, '273', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(159, '272', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(160, '271', '250000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(161, '270', '0', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(162, '269', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(163, '268', '105000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(164, '267', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(165, '265', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(166, '264', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(167, '263', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(168, '262', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(169, '261', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(170, '260', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(171, '259', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(172, '258', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(173, '257', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(174, '255', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(175, '254', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(176, '253', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(177, '252', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(178, '251', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(179, '250', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(180, '249', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(181, '248', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(182, '247', '120000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(183, '246', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(184, '245', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(185, '244', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(186, '243', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(187, '242', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(188, '241', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(189, '240', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(190, '239', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(191, '238', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(192, '237', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(193, '236', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(194, '235', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(195, '234', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(196, '233', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(197, '232', '53000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(198, '231', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(199, '230', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(200, '229', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(201, '228', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(202, '227', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(203, '226', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(204, '225', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(205, '224', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(206, '223', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(207, '222', '83000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(208, '221', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(209, '220', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(210, '219', '53000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(211, '218', '57000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(212, '217', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(213, '216', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(214, '215', '79000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(215, '214', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(216, '213', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(217, '212', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(218, '211', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(219, '210', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(220, '209', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(221, '208', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(222, '207', '200000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(223, '206', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(224, '205', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(225, '204', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(226, '203', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(227, '202', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(228, '201', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(229, '200', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(230, '199', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(231, '198', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(232, '197', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(233, '196', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(234, '195', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(235, '194', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(236, '193', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(237, '192', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(238, '191', '155000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(239, '190', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(240, '189', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(241, '188', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(242, '186', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(243, '185', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(244, '184', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(245, '183', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(246, '182', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(247, '181', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(248, '180', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(249, '179', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(250, '178', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(251, '177', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(252, '176', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(253, '175', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(254, '174', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(255, '173', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(256, '172', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(257, '171', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(258, '170', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(259, '169', '55000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(260, '168', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(261, '167', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(262, '166', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(263, '165', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(264, '164', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(265, '163', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(266, '162', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(267, '161', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(268, '160', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(269, '159', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(270, '158', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(271, '157', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(272, '156', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(273, '155', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(274, '153', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(275, '152', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(276, '151', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(277, '150', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(278, '149', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(279, '148', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(280, '147', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(281, '146', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(282, '145', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(283, '144', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(284, '143', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(285, '142', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(286, '141', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(287, '139', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(288, '138', '105000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(289, '137', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(290, '136', '55000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(291, '135', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(292, '134', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(293, '133', '142000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(294, '131', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(295, '130', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(296, '129', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(297, '128', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(298, '127', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(299, '126', '190000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(300, '125', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(301, '124', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(302, '123', '0', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(303, '122', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(304, '121', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(305, '120', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(306, '119', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(307, '118', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(308, '116', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(309, '115', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(310, '114', '0', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(311, '113', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(312, '112', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(313, '111', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(314, '110', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(315, '109', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(316, '108', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(317, '107', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(318, '106', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(319, '105', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(320, '104', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(321, '103', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(322, '102', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(323, '101', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(324, '100', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(325, '99', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(326, '98', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(327, '96', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(328, '95', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(329, '94', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(330, '93', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(331, '92', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(332, '91', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(333, '90', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(334, '89', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(335, '88', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(336, '87', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(337, '86', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(338, '85', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(339, '84', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(340, '83', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(341, '82', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(342, '81', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(343, '80', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(344, '79', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(345, '78', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(346, '77', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(347, '76', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(348, '75', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(349, '74', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(350, '72', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(351, '70', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(352, '69', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(353, '68', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(354, '67', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(355, '66', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(356, '65', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(357, '63', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(358, '62', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(359, '61', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(360, '60', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(361, '59', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(362, '57', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(363, '56', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(364, '55', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(365, '54', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(366, '53', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(367, '52', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(368, '51', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(369, '50', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(370, '49', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(371, '48', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(372, '47', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(373, '46', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(374, '43', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(375, '42', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(376, '40', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(377, '39', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(378, '38', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(379, '36', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(380, '35', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(381, '34', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(382, '33', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(383, '32', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(384, '31', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(385, '30', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(386, '28', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(387, '25', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(388, '24', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(389, '21', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(390, '20', '120000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(391, '19', '135000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(392, '18', '120000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(393, '17', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(394, '16', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(395, '15', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(396, '14', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(397, '13', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(398, '12', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(399, '11', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(400, '10', '155000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(401, '9', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(402, '8', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(403, '7', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(404, '6', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(405, '5', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(406, '4', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(407, '3', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(408, '2', '127500', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(409, '1', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-02', '2022-06-28 21:28:37', '', '', ''),
(410, '676', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(411, '674', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(412, '672', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(413, '671', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(414, '670', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(415, '669', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(416, '668', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(417, '667', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(418, '666', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(419, '665', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(420, '664', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(421, '663', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(422, '662', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(423, '661', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(424, '660', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(425, '659', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(426, '658', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(427, '657', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(428, '656', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(429, '655', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(430, '654', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(431, '653', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(432, '652', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(433, '651', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(434, '650', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(435, '649', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(436, '648', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(437, '647', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', '');
INSERT INTO `payroll` (`id`, `employee_id`, `present_salary`, `loan`, `salary_advance`, `overtime_allowance`, `leave_allowance`, `other_allowance`, `other_deduction`, `note`, `present_days`, `payment_status`, `month`, `created_at`, `tax`, `pension`, `deleted`) VALUES
(438, '646', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(439, '645', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(440, '644', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(441, '643', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(442, '642', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(443, '641', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(444, '640', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(445, '639', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(446, '638', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(447, '637', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(448, '636', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(449, '634', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(450, '633', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(451, '632', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(452, '630', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(453, '629', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(454, '628', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(455, '627', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(456, '622', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(457, '621', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(458, '620', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(459, '619', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(460, '618', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(461, '616', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(462, '615', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(463, '614', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(464, '613', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(465, '612', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(466, '611', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(467, '610', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(468, '609', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(469, '608', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(470, '607', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(471, '606', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(472, '605', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(473, '604', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(474, '603', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(475, '602', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(476, '599', '162500', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(477, '598', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(478, '596', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(479, '595', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(480, '594', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(481, '593', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(482, '592', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(483, '590', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(484, '589', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(485, '587', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(486, '586', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(487, '585', '34000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(488, '583', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(489, '581', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(490, '579', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(491, '578', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(492, '577', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(493, '576', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(494, '575', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(495, '574', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(496, '573', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(497, '572', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(498, '571', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(499, '570', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(500, '566', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(501, '565', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(502, '564', '155000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(503, '563', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(504, '562', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(505, '561', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(506, '559', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(507, '557', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(508, '556', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(509, '555', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(510, '554', '135000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(511, '552', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(512, '551', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(513, '550', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(514, '549', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(515, '548', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(516, '543', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(517, '541', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(518, '540', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(519, '539', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(520, '538', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(521, '523', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(522, '522', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(523, '521', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(524, '520', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(525, '518', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(526, '516', '21600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(527, '514', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(528, '513', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(529, '512', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(530, '406', '150000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(531, '405', '200000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(532, '404', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(533, '403', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(534, '402', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(535, '401', '160000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(536, '399', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(537, '398', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(538, '397', '146000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(539, '396', '146000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(540, '394', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(541, '393', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(542, '392', '21600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(543, '391', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(544, '390', '21600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(545, '389', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(546, '388', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(547, '387', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(548, '386', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(549, '385', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(550, '384', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(551, '383', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(552, '382', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(553, '381', '21600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(554, '380', '25000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(555, '379', '21600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(556, '378', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(557, '377', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(558, '376', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(559, '375', '21600', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(560, '373', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(561, '372', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(562, '371', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(563, '370', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(564, '369', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(565, '368', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(566, '366', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(567, '364', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(568, '363', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(569, '362', '53000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(570, '361', '53000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(571, '360', '53000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(572, '359', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(573, '358', '91000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(574, '357', '68000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(575, '356', '200000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(576, '355', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(577, '353', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(578, '351', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(579, '350', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(580, '349', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(581, '348', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(582, '346', '155000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(583, '345', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(584, '344', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(585, '343', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(586, '342', '180000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(587, '341', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(588, '340', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(589, '339', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(590, '338', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(591, '337', '200000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(592, '336', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(593, '335', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(594, '334', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(595, '333', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(596, '332', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(597, '331', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(598, '330', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(599, '329', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(600, '326', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(601, '325', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(602, '323', '20000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(603, '322', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(604, '321', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(605, '320', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(606, '319', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(607, '318', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(608, '317', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(609, '316', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(610, '314', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(611, '313', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(612, '312', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(613, '311', '142500', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(614, '310', '340000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(615, '309', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(616, '308', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(617, '306', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(618, '305', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(619, '304', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(620, '303', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(621, '302', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(622, '301', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(623, '300', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(624, '298', '120000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(625, '297', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(626, '296', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(627, '295', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(628, '294', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(629, '293', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(630, '292', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(631, '291', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(632, '288', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(633, '287', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(634, '286', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(635, '285', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(636, '283', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(637, '280', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(638, '278', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(639, '277', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(640, '276', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(641, '274', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(642, '273', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(643, '272', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(644, '271', '290000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(645, '270', '0', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(646, '269', '135000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(647, '268', '155000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(648, '267', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(649, '264', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(650, '263', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(651, '262', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(652, '261', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(653, '260', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(654, '259', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(655, '258', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(656, '257', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(657, '253', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(658, '252', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(659, '251', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(660, '250', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(661, '249', '68000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(662, '248', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(663, '247', '200000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(664, '246', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(665, '245', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(666, '244', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(667, '243', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(668, '242', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(669, '241', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(670, '240', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(671, '239', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(672, '238', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(673, '237', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(674, '236', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(675, '235', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(676, '234', '38000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(677, '233', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(678, '232', '72000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(679, '231', '64000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(680, '229', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(681, '228', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(682, '227', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(683, '226', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(684, '225', '49000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(685, '224', '42000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(686, '222', '103000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(687, '221', '64000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(688, '220', '68000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(689, '219', '72000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(690, '218', '76000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(691, '217', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(692, '216', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(693, '215', '99000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(694, '214', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(695, '213', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(696, '212', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(697, '211', '55000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(698, '210', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(699, '209', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(700, '208', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(701, '206', '55000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(702, '205', '55000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(703, '204', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(704, '202', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(705, '201', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(706, '199', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(707, '198', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(708, '197', '35000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(709, '196', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(710, '195', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(711, '194', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(712, '193', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(713, '192', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(714, '191', '180000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(715, '190', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(716, '189', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(717, '188', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(718, '186', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(719, '185', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(720, '184', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(721, '183', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(722, '182', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(723, '181', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(724, '180', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(725, '179', '105000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(726, '178', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(727, '177', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(728, '176', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(729, '175', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(730, '174', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(731, '173', '120000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(732, '171', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(733, '170', '110000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(734, '169', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(735, '168', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(736, '167', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(737, '166', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(738, '165', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(739, '164', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(740, '163', '105000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(741, '162', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(742, '161', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(743, '160', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(744, '159', '105000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(745, '158', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(746, '157', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(747, '156', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(748, '153', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(749, '152', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(750, '151', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(751, '150', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(752, '149', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(753, '148', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(754, '147', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(755, '146', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(756, '145', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(757, '144', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(758, '143', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(759, '142', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(760, '141', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(761, '139', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(762, '138', '120000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(763, '137', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(764, '136', '75000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(765, '134', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(766, '133', '162500', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(767, '131', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(768, '130', '90000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(769, '129', '65000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(770, '128', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(771, '127', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(772, '126', '210000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(773, '125', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(774, '124', '85000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(775, '123', '0', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(776, '122', '135000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(777, '121', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(778, '120', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(779, '118', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(780, '116', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(781, '114', '0', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(782, '113', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(783, '112', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(784, '110', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(785, '109', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(786, '108', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(787, '107', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(788, '106', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(789, '105', '30000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(790, '104', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(791, '103', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(792, '102', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(793, '100', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(794, '99', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(795, '98', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(796, '96', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(797, '95', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(798, '91', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(799, '90', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(800, '89', '800000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(801, '88', '100000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(802, '87', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(803, '86', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(804, '85', '135000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(805, '84', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(806, '83', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(807, '81', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(808, '80', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(809, '79', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(810, '78', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(811, '76', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(812, '75', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(813, '74', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(814, '72', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(815, '70', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(816, '69', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(817, '68', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(818, '67', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(819, '66', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(820, '65', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(821, '63', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(822, '62', '135000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(823, '61', '135000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(824, '60', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(825, '59', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(826, '56', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(827, '54', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(828, '53', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(829, '52', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(830, '51', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(831, '50', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(832, '49', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(833, '48', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(834, '46', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(835, '43', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(836, '42', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(837, '40', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(838, '39', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(839, '38', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(840, '36', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(841, '35', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(842, '34', '40000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(843, '33', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(844, '32', '45000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(845, '31', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(846, '30', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(847, '28', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(848, '25', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(849, '24', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(850, '21', '135000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(851, '20', '155000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(852, '19', '162500', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(853, '18', '190000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(854, '17', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(855, '16', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(856, '15', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(857, '14', '60000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(858, '13', '70000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(859, '12', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(860, '11', '55000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(861, '9', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(862, '8', '95000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(863, '7', '127500', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(864, '6', '127500', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(865, '5', '50000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(866, '4', '80000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(867, '3', '135000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(868, '2', '155500', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', ''),
(869, '1', '155000', '0.00', '', '0', '0', '0', '0', '', '31', '1', '2022-10', '2022-10-20 12:29:06', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_item`
--

CREATE TABLE `payroll_item` (
  `id` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `addon` varchar(50) NOT NULL DEFAULT '1',
  `category` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_item`
--

INSERT INTO `payroll_item` (`id`, `item`, `addon`, `category`, `amount`, `created_at`, `deleted`) VALUES
(1, 'Basic', '1', '1', '12', '2022-01-22 22:13:01', ''),
(2, 'Housing', '1', '1', '32', '2022-01-22 22:16:04', ''),
(3, 'Dressing', '1', '1', '7', '2022-01-22 22:19:14', ''),
(4, 'Conveyance (Transport)', '1', '1', '8', '2022-01-22 22:21:11', ''),
(5, 'Utility', '1', '1', '6', '2022-01-22 22:21:42', ''),
(6, 'Others', '1', '1', '35', '2022-01-22 22:25:30', ''),
(7, 'Tax(PAYE)', '1', '3', '0', '2022-01-23 13:24:06', ''),
(8, 'Pension', '1', '3', '8', '2022-01-23 13:26:39', ''),
(9, 'Overtime Allowance', '1', '1', '0', '2022-01-25 18:28:10', ''),
(10, 'Leave Allowance', '1', '1', '0', '2022-01-25 18:28:39', ''),
(11, 'Additional Days Pay', '1', '1', '0', '2022-01-25 18:29:09', '');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_narrations`
--

CREATE TABLE `payroll_narrations` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(5) NOT NULL,
  `overtime_allowance` varchar(50) NOT NULL,
  `leave_allowance` varchar(50) NOT NULL,
  `other_allowance` varchar(50) NOT NULL,
  `other_deduction` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `present_salary` varchar(50) NOT NULL,
  `loan` varchar(50) NOT NULL,
  `salary_advance` varchar(191) NOT NULL,
  `overtime_allowance` varchar(191) NOT NULL,
  `leave_allowance` varchar(50) NOT NULL,
  `other_allowance` varchar(50) DEFAULT NULL,
  `other_deduction` varchar(50) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  `present_days` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `pension` varchar(50) NOT NULL,
  `deleted` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salary_advances`
--

CREATE TABLE `salary_advances` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(10) NOT NULL,
  `total_requested` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary_advances`
--

INSERT INTO `salary_advances` (`id`, `employee_id`, `total_requested`, `created_at`, `deleted`) VALUES
(1, '389', '14000', '2022-10-21 11:00:01', 0),
(2, '378', '12000', '2022-10-21 11:03:11', 0),
(3, '325', '7000', '2022-10-21 11:03:42', 0),
(4, '313', '20000', '2022-10-21 11:05:49', 0),
(5, '562', '16000', '2022-10-21 11:07:08', 0),
(6, '90', '25000', '2022-10-21 11:08:13', 0),
(7, '96', '10000', '2022-10-21 11:09:11', 0),
(8, '86', '10000', '2022-10-21 11:09:47', 0),
(9, '89', '20000', '2022-10-21 11:14:49', 0),
(10, '87', '25000', '2022-10-21 11:15:14', 0),
(11, '386', '10000', '2022-10-21 11:24:12', 0),
(12, '15', '28000', '2022-10-21 11:25:27', 0),
(13, '106', '16000', '2022-10-21 11:26:16', 0),
(14, '91', '30000', '2022-10-21 11:27:02', 1),
(15, '559', '10000', '2022-10-21 11:27:42', 0),
(16, '110', '15000', '2022-10-21 11:28:11', 0),
(17, '99', '16000', '2022-10-21 11:35:21', 0),
(18, '246', '15000', '2022-10-21 11:35:48', 0),
(19, '263', '20000', '2022-10-21 11:36:09', 0),
(20, '554', '54000', '2022-10-21 11:36:58', 0),
(21, '30', '20000', '2022-10-21 11:37:34', 0),
(22, '68', '16000', '2022-10-21 11:37:57', 0),
(23, '19', '60000', '2022-10-21 11:38:21', 0),
(24, '657', '3000', '2022-10-21 11:38:41', 0),
(25, '637', '10000', '2022-10-21 11:39:00', 0),
(26, '46', '10000', '2022-10-21 11:39:22', 0),
(27, '654', '3000', '2022-10-21 11:42:09', 0),
(28, '566', '24000', '2022-10-21 11:42:34', 1),
(29, '581', '10000', '2022-10-21 11:45:26', 0),
(30, '314', '20000', '2022-10-21 12:15:24', 0),
(31, '85', '40000', '2022-10-21 12:17:04', 0),
(32, '606', '8000', '2022-10-21 12:18:22', 0),
(33, '660', '8000', '2022-10-21 12:18:46', 0),
(34, '330', '16000', '2022-10-21 12:19:07', 0),
(35, '331', '10000', '2022-10-21 12:19:28', 0),
(36, '555', '32000', '2022-10-21 12:21:51', 0),
(37, '124', '30000', '2022-10-21 12:42:06', 0),
(38, '125', '34000', '2022-10-21 12:45:53', 0),
(39, '126', '84000', '2022-10-21 12:46:29', 0),
(40, '127', '15000', '2022-10-21 12:47:06', 0),
(41, '128', '38000', '2022-10-21 12:47:38', 0),
(42, '129', '20000', '2022-10-21 12:48:03', 0),
(43, '134', '38000', '2022-10-21 12:48:57', 0),
(44, '130', '30000', '2022-10-21 12:50:04', 0),
(45, '131', '30000', '2022-10-21 12:50:35', 0),
(46, '133', '65000', '2022-10-21 12:51:08', 0),
(47, '136', '30000', '2022-10-21 12:51:50', 0),
(48, '137', '34000', '2022-10-21 12:52:14', 0),
(49, '138', '45000', '2022-10-21 12:52:38', 0),
(50, '139', '35000', '2022-10-21 12:53:03', 0),
(51, '141', '5000', '2022-10-21 12:53:28', 0),
(52, '142', '40000', '2022-10-21 12:53:53', 0),
(53, '143', '25000', '2022-10-21 12:54:27', 0),
(54, '144', '40000', '2022-10-21 12:54:55', 0),
(55, '145', '30000', '2022-10-21 12:55:24', 0),
(56, '146', '40000', '2022-10-21 12:55:49', 0),
(57, '147', '40000', '2022-10-21 12:56:09', 0),
(58, '148', '34000', '2022-10-21 12:56:33', 0),
(59, '149', '35000', '2022-10-21 12:56:53', 0),
(60, '226', '30000', '2022-10-21 12:57:42', 0),
(61, '150', '34000', '2022-10-21 12:58:16', 0),
(62, '151', '34000', '2022-10-21 12:58:51', 0),
(63, '152', '10000', '2022-10-21 12:59:27', 0),
(64, '153', '38000', '2022-10-21 13:00:15', 0),
(65, '156', '38000', '2022-10-21 13:00:53', 0),
(66, '157', '28000', '2022-10-21 13:01:18', 0),
(67, '158', '31000', '2022-10-21 13:02:08', 0),
(68, '159', '40000', '2022-10-21 13:02:38', 0),
(69, '160', '18000', '2022-10-21 13:03:13', 0),
(70, '161', '31000', '2022-10-21 13:04:22', 0),
(71, '162', '28000', '2022-10-21 13:04:51', 0),
(72, '163', '40000', '2022-10-21 13:05:27', 0),
(73, '164', '30000', '2022-10-21 13:06:06', 0),
(74, '165', '30000', '2022-10-21 13:07:09', 0),
(75, '166', '32000', '2022-10-21 13:07:51', 0),
(76, '167', '30000', '2022-10-21 13:08:30', 0),
(77, '168', '25000', '2022-10-21 13:09:08', 0),
(78, '169', '34000', '2022-10-21 13:09:38', 0),
(79, '170', '44000', '2022-10-21 13:10:01', 0),
(80, '171', '26000', '2022-10-21 13:10:31', 0),
(81, '173', '48000', '2022-10-21 13:11:24', 0),
(82, '174', '40000', '2022-10-21 13:11:52', 0),
(83, '175', '25000', '2022-10-21 13:12:17', 0),
(84, '176', '28000', '2022-10-21 13:13:05', 0),
(85, '178', '20000', '2022-10-21 13:13:30', 0),
(86, '179', '42000', '2022-10-21 13:14:06', 0),
(87, '180', '5000', '2022-10-21 13:14:47', 0),
(88, '232', '25000', '2022-10-21 13:15:56', 0),
(89, '181', '38000', '2022-10-21 13:16:15', 0),
(90, '182', '26000', '2022-10-21 16:29:05', 0),
(91, '183', '20000', '2022-10-21 16:29:51', 0),
(92, '184', '30000', '2022-10-21 16:30:24', 0),
(93, '185', '24000', '2022-10-21 16:30:58', 0),
(94, '186', '24000', '2022-10-21 16:31:37', 0),
(95, '188', '24000', '2022-10-21 16:32:10', 0),
(96, '189', '24000', '2022-10-21 16:32:46', 0),
(97, '192', '25000', '2022-10-21 16:33:38', 0),
(98, '190', '20000', '2022-10-21 16:35:54', 0),
(99, '193', '15000', '2022-10-21 16:36:44', 0),
(100, '194', '20000', '2022-10-21 16:38:42', 0),
(101, '196', '12000', '2022-10-21 16:39:13', 0),
(102, '198', '36000', '2022-10-21 16:39:36', 0),
(103, '204', '26000', '2022-10-21 16:41:52', 0),
(104, '205', '22000', '2022-10-21 16:42:22', 0),
(105, '206', '22000', '2022-10-21 16:42:48', 0),
(106, '248', '20000', '2022-10-21 16:43:08', 0),
(107, '209', '10000', '2022-10-21 16:43:35', 0),
(108, '212', '20000', '2022-10-21 16:44:10', 0),
(109, '211', '7000', '2022-10-21 16:44:40', 0),
(110, '213', '30000', '2022-10-21 16:46:43', 0),
(111, '522', '25000', '2022-10-21 16:47:22', 0),
(112, '662', '15000', '2022-10-21 16:48:02', 0),
(113, '383', '5000', '2022-10-21 16:48:45', 0),
(114, '214', '20000', '2022-10-21 16:49:19', 0),
(115, '393', '16000', '2022-10-21 16:49:45', 0),
(116, '394', '15000', '2022-10-21 16:50:19', 0),
(117, '258', '10000', '2022-10-21 17:41:10', 1),
(118, '247', '80000', '2022-10-21 17:42:00', 0),
(119, '236', '10000', '2022-10-21 17:42:31', 0),
(120, '216', '20000', '2022-10-21 17:42:54', 0),
(121, '341', '16000', '2022-10-21 17:43:25', 0),
(122, '305', '7000', '2022-10-21 17:44:47', 0),
(123, '244', '10000', '2022-10-21 17:45:11', 0),
(124, '3', '54000', '2022-10-21 17:45:55', 0),
(125, '8', '38000', '2022-10-21 17:48:18', 0),
(126, '227', '14000', '2022-10-21 17:49:01', 0),
(127, '296', '30000', '2022-10-21 17:49:52', 0),
(128, '300', '12000', '2022-10-21 17:50:38', 0),
(129, '2', '40000', '2022-10-21 17:51:07', 0),
(130, '297', '28000', '2022-10-21 17:51:35', 0),
(131, '219', '28800', '2022-10-21 17:52:16', 0),
(132, '242', '13000', '2022-10-21 17:53:40', 0),
(133, '271', '116000', '2022-10-21 17:54:18', 0),
(134, '191', '70000', '2022-10-21 17:54:44', 0),
(135, '249', '27200', '2022-10-21 17:55:11', 0),
(136, '377', '14000', '2022-10-21 17:55:47', 0),
(137, '245', '16800', '2022-10-21 17:56:06', 0),
(138, '302', '10000', '2022-10-21 17:56:26', 0),
(139, '231', '20000', '2022-10-21 17:56:46', 0),
(140, '228', '10000', '2022-10-21 17:57:09', 0),
(141, '356', '50000', '2022-10-21 17:57:47', 0),
(142, '221', '14000', '2022-10-21 17:58:39', 0),
(143, '243', '16800', '2022-10-21 18:03:06', 0),
(144, '357', '25000', '2022-10-21 18:03:28', 0),
(145, '358', '35000', '2022-10-21 18:03:56', 0),
(146, '359', '15000', '2022-10-21 18:04:14', 0),
(147, '360', '20000', '2022-10-21 18:04:34', 0),
(148, '361', '20000', '2022-10-21 18:04:55', 0),
(149, '362', '20000', '2022-10-21 18:05:48', 0),
(150, '364', '15000', '2022-10-21 18:06:18', 0),
(151, '366', '15000', '2022-10-21 18:07:07', 0),
(152, '368', '19600', '2022-10-21 18:07:43', 0),
(153, '370', '19600', '2022-10-21 18:08:09', 0),
(154, '371', '19600', '2022-10-21 18:08:31', 0),
(155, '363', '15000', '2022-10-21 18:09:03', 0),
(156, '372', '15000', '2022-10-21 18:09:27', 0),
(157, '518', '15000', '2022-10-21 18:10:16', 0),
(158, '259', '38000', '2022-10-21 18:11:16', 0),
(159, '261', '36000', '2022-10-21 18:11:39', 0),
(160, '224', '16800', '2022-10-21 18:12:37', 0),
(161, '298', '30000', '2022-10-21 18:12:56', 0),
(162, '215', '33000', '2022-10-21 18:13:22', 0),
(163, '217', '24000', '2022-10-21 18:14:06', 0),
(164, '273', '36000', '2022-10-21 18:14:40', 0),
(165, '6', '50000', '2022-10-21 18:15:16', 0),
(166, '309', '14000', '2022-10-21 18:15:45', 0),
(167, '388', '5000', '2022-10-21 18:16:08', 0),
(168, '7', '51000', '2022-10-21 18:16:32', 0),
(169, '387', '12000', '2022-10-21 18:16:57', 0),
(170, '292', '5000', '2022-10-21 18:17:18', 0),
(171, '268', '30000', '2022-10-21 18:17:43', 0),
(172, '385', '11000', '2022-10-21 18:18:22', 0),
(173, '301', '10000', '2022-10-21 18:18:46', 0),
(174, '286', '10000', '2022-10-21 18:19:06', 0),
(175, '1', '60000', '2022-10-21 18:19:43', 0),
(176, '278', '24000', '2022-10-21 18:20:01', 1),
(177, '277', '10000', '2022-10-21 18:20:37', 0),
(178, '285', '12000', '2022-10-21 18:21:11', 0),
(179, '355', '15000', '2022-10-21 18:21:33', 0),
(180, '237', '18000', '2022-10-21 18:21:53', 0),
(181, '339', '20000', '2022-10-21 18:22:16', 0),
(182, '274', '10000', '2022-10-21 18:22:35', 0),
(183, '283', '5000', '2022-10-21 18:22:55', 0),
(184, '233', '18000', '2022-10-21 18:23:29', 0),
(185, '293', '5000', '2022-10-21 18:24:25', 0),
(186, '257', '44000', '2022-10-21 18:25:03', 0),
(187, '238', '5000', '2022-10-21 18:25:34', 0),
(188, '295', '20000', '2022-10-21 18:25:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_advance_details`
--

CREATE TABLE `salary_advance_details` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `type` varchar(5) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `date_requested` datetime NOT NULL,
  `date_issued` date NOT NULL,
  `status` varchar(5) NOT NULL,
  `file_upload` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary_advance_details`
--

INSERT INTO `salary_advance_details` (`id`, `ref_no`, `employee_id`, `type`, `amount`, `date_requested`, `date_issued`, `status`, `file_upload`, `note`, `created_by`, `deleted`) VALUES
(1, 'SAL-8850389', 389, '1', '14000', '2022-10-21 11:00:01', '2022-10-21', '3', '', '', '2', 0),
(2, 'SAL-8920378', 378, '1', '12000', '2022-10-21 11:03:11', '2022-10-21', '3', '', '', '2', 0),
(3, 'SAL-9640325', 325, '1', '7000', '2022-10-21 11:03:42', '2022-10-21', '3', '', '', '2', 0),
(4, 'SAL-7430313', 313, '1', '20000', '2022-10-21 11:05:49', '2022-10-21', '3', '', '', '2', 0),
(5, 'SAL-7810562', 562, '1', '16000', '2022-10-21 11:07:08', '2022-10-21', '3', '', '', '2', 0),
(6, 'SAL-569090', 90, '1', '25000', '2022-10-21 11:08:13', '2022-10-21', '3', '', '', '2', 0),
(7, 'SAL-458096', 96, '1', '10000', '2022-10-21 11:09:11', '2022-10-21', '3', '', '', '2', 0),
(8, 'SAL-643086', 86, '1', '10000', '2022-10-21 11:09:47', '2022-10-21', '3', '', '', '2', 0),
(9, 'SAL-379089', 89, '1', '20000', '2022-10-21 11:14:49', '2022-10-21', '3', '', '', '2', 0),
(10, 'SAL-571087', 87, '1', '25000', '2022-10-21 11:15:14', '2022-10-21', '3', '', '', '2', 0),
(11, 'SAL-1170386', 386, '1', '10000', '2022-10-21 11:24:12', '2022-10-21', '3', '', '', '2', 0),
(12, 'SAL-804015', 15, '1', '28000', '2022-10-21 11:25:27', '2022-10-21', '3', '', '', '2', 0),
(13, 'SAL-2090106', 106, '1', '16000', '2022-10-21 11:26:16', '2022-10-21', '3', '', '', '2', 0),
(14, 'SAL-360091', 91, '1', '15000', '2022-10-21 11:27:02', '2022-10-21', '3', '', '', '2', 1),
(15, 'SAL-237091', 91, '1', '15000', '2022-10-21 11:27:09', '2022-10-21', '3', '', '', '2', 0),
(16, 'SAL-5710559', 559, '1', '10000', '2022-10-21 11:27:42', '2022-10-21', '3', '', '', '2', 0),
(17, 'SAL-4470110', 110, '1', '15000', '2022-10-21 11:28:11', '2022-10-21', '3', '', '', '2', 0),
(18, 'SAL-746099', 99, '1', '15000', '2022-10-21 11:35:21', '2022-10-21', '3', '', '', '2', 0),
(19, 'SAL-3890246', 246, '1', '15000', '2022-10-21 11:35:48', '2022-10-21', '3', '', '', '2', 0),
(20, 'SAL-8660263', 263, '1', '20000', '2022-10-21 11:36:09', '2022-10-21', '3', '', '', '2', 0),
(21, 'SAL-9340554', 554, '1', '54000', '2022-10-21 11:36:58', '2022-10-21', '3', '', '', '2', 0),
(22, 'SAL-712030', 30, '1', '20000', '2022-10-21 11:37:34', '2022-10-21', '3', '', '', '2', 0),
(23, 'SAL-646068', 68, '1', '16000', '2022-10-21 11:37:57', '2022-10-21', '3', '', '', '2', 0),
(24, 'SAL-683019', 19, '1', '60000', '2022-10-21 11:38:21', '2022-10-21', '3', '', '', '2', 0),
(25, 'SAL-4830657', 657, '1', '3000', '2022-10-21 11:38:41', '2022-10-21', '3', '', '', '2', 0),
(26, 'SAL-2380637', 637, '1', '10000', '2022-10-21 11:39:00', '2022-10-21', '3', '', '', '2', 0),
(27, 'SAL-780046', 46, '1', '10000', '2022-10-21 11:39:22', '2022-10-21', '3', '', '', '2', 0),
(28, 'SAL-6400654', 654, '1', '3000', '2022-10-21 11:42:09', '2022-10-21', '3', '', '', '2', 0),
(29, 'SAL-6490566', 566, '1', '12000', '2022-10-21 11:42:34', '2022-10-21', '3', '', '', '2', 0),
(30, 'SAL-7670566', 566, '1', '12000', '2022-10-21 11:43:16', '2022-10-21', '3', '', '', '2', 1),
(31, 'SAL-4670581', 581, '1', '10000', '2022-10-21 11:45:26', '2022-10-21', '3', '', '', '2', 0),
(32, 'SAL-3420314', 314, '1', '20000', '2022-10-21 12:15:24', '2022-10-21', '3', '', '', '2', 0),
(33, 'SAL-938085', 85, '1', '40000', '2022-10-21 12:17:04', '2022-10-21', '3', '', '', '2', 0),
(34, 'SAL-8660606', 606, '1', '8000', '2022-10-21 12:18:22', '2022-10-21', '3', '', '', '2', 0),
(35, 'SAL-8180660', 660, '1', '8000', '2022-10-21 12:18:46', '2022-10-21', '3', '', '', '2', 0),
(36, 'SAL-3200330', 330, '1', '16000', '2022-10-21 12:19:07', '2022-10-21', '3', '', '', '2', 0),
(37, 'SAL-2100331', 331, '1', '10000', '2022-10-21 12:19:28', '2022-10-21', '3', '', '', '2', 0),
(38, 'SAL-9840555', 555, '1', '32000', '2022-10-21 12:21:51', '2022-10-21', '3', '', '', '2', 0),
(39, 'SAL-5070124', 124, '1', '30000', '2022-10-21 12:42:06', '2022-10-21', '3', '', '', '2', 0),
(40, 'SAL-5160125', 125, '1', '34000', '2022-10-21 12:45:53', '2022-10-21', '3', '', '', '2', 0),
(41, 'SAL-4760126', 126, '1', '84000', '2022-10-21 12:46:29', '2022-10-21', '3', '', '', '2', 0),
(42, 'SAL-7620127', 127, '1', '15000', '2022-10-21 12:47:06', '2022-10-21', '3', '', '', '2', 0),
(43, 'SAL-7380128', 128, '1', '38000', '2022-10-21 12:47:38', '2022-10-21', '3', '', '', '2', 0),
(44, 'SAL-6120129', 129, '1', '20000', '2022-10-21 12:48:03', '2022-10-21', '3', '', '', '2', 0),
(45, 'SAL-9470134', 134, '1', '38000', '2022-10-21 12:48:57', '2022-10-21', '3', '', '', '2', 0),
(46, 'SAL-7870130', 130, '1', '30000', '2022-10-21 12:50:04', '2022-10-21', '3', '', '', '2', 0),
(47, 'SAL-6100131', 131, '1', '30000', '2022-10-21 12:50:35', '2022-10-21', '3', '', '', '2', 0),
(48, 'SAL-5580133', 133, '1', '65000', '2022-10-21 12:51:08', '2022-10-21', '3', '', '', '2', 0),
(49, 'SAL-5540136', 136, '1', '30000', '2022-10-21 12:51:50', '2022-10-21', '3', '', '', '2', 0),
(50, 'SAL-1150137', 137, '1', '34000', '2022-10-21 12:52:14', '2022-10-21', '3', '', '', '2', 0),
(51, 'SAL-2670138', 138, '1', '45000', '2022-10-21 12:52:38', '2022-10-21', '3', '', '', '2', 0),
(52, 'SAL-9480139', 139, '1', '35000', '2022-10-21 12:53:03', '2022-10-21', '3', '', '', '2', 0),
(53, 'SAL-6380141', 141, '1', '5000', '2022-10-21 12:53:28', '2022-10-21', '3', '', '', '2', 0),
(54, 'SAL-8190142', 142, '1', '40000', '2022-10-21 12:53:53', '2022-10-21', '3', '', '', '2', 0),
(55, 'SAL-1870143', 143, '1', '25000', '2022-10-21 12:54:27', '2022-10-21', '3', '', '', '2', 0),
(56, 'SAL-1460144', 144, '1', '40000', '2022-10-21 12:54:55', '2022-10-21', '3', '', '', '2', 0),
(57, 'SAL-6650145', 145, '1', '30000', '2022-10-21 12:55:24', '2022-10-21', '3', '', '', '2', 0),
(58, 'SAL-8450146', 146, '1', '40000', '2022-10-21 12:55:49', '2022-10-21', '3', '', '', '2', 0),
(59, 'SAL-8360147', 147, '1', '40000', '2022-10-21 12:56:09', '2022-10-21', '3', '', '', '2', 0),
(60, 'SAL-1010148', 148, '1', '34000', '2022-10-21 12:56:33', '2022-10-21', '3', '', '', '2', 0),
(61, 'SAL-1260149', 149, '1', '35000', '2022-10-21 12:56:53', '2022-10-21', '3', '', '', '2', 0),
(62, 'SAL-1970226', 226, '1', '30000', '2022-10-21 12:57:42', '2022-10-21', '3', '', '', '2', 0),
(63, 'SAL-8750150', 150, '1', '34000', '2022-10-21 12:58:16', '2022-10-21', '3', '', '', '2', 0),
(64, 'SAL-6210151', 151, '1', '34000', '2022-10-21 12:58:51', '2022-10-21', '3', '', '', '2', 0),
(65, 'SAL-6080152', 152, '1', '10000', '2022-10-21 12:59:27', '2022-10-21', '3', '', '', '2', 0),
(66, 'SAL-5150153', 153, '1', '38000', '2022-10-21 13:00:15', '2022-10-21', '3', '', '', '2', 0),
(67, 'SAL-5780156', 156, '1', '38000', '2022-10-21 13:00:53', '2022-10-21', '3', '', '', '2', 0),
(68, 'SAL-4430157', 157, '1', '28000', '2022-10-21 13:01:18', '2022-10-21', '3', '', '', '2', 0),
(69, 'SAL-3850158', 158, '1', '31000', '2022-10-21 13:02:08', '2022-10-21', '3', '', '', '2', 0),
(70, 'SAL-4700159', 159, '1', '40000', '2022-10-21 13:02:38', '2022-10-21', '3', '', '', '2', 0),
(71, 'SAL-1110160', 160, '1', '18000', '2022-10-21 13:03:13', '2022-10-21', '3', '', '', '2', 0),
(72, 'SAL-5920161', 161, '1', '31000', '2022-10-21 13:04:22', '2022-10-21', '3', '', '', '2', 0),
(73, 'SAL-4040162', 162, '1', '28000', '2022-10-21 13:04:51', '2022-10-21', '3', '', '', '2', 0),
(74, 'SAL-3060163', 163, '1', '40000', '2022-10-21 13:05:27', '2022-10-21', '3', '', '', '2', 0),
(75, 'SAL-6630164', 164, '1', '30000', '2022-10-21 13:06:06', '2022-10-21', '3', '', '', '2', 0),
(76, 'SAL-9600165', 165, '1', '30000', '2022-10-21 13:07:09', '2022-10-21', '3', '', '', '2', 0),
(77, 'SAL-1200166', 166, '1', '32000', '2022-10-21 13:07:51', '2022-10-21', '3', '', '', '2', 0),
(78, 'SAL-3240167', 167, '1', '30000', '2022-10-21 13:08:30', '2022-10-21', '3', '', '', '2', 0),
(79, 'SAL-4700168', 168, '1', '25000', '2022-10-21 13:09:08', '2022-10-21', '3', '', '', '2', 0),
(80, 'SAL-4490169', 169, '1', '34000', '2022-10-21 13:09:38', '2022-10-21', '3', '', '', '2', 0),
(81, 'SAL-6290170', 170, '1', '44000', '2022-10-21 13:10:01', '2022-10-21', '3', '', '', '2', 0),
(82, 'SAL-2250171', 171, '1', '26000', '2022-10-21 13:10:31', '2022-10-21', '3', '', '', '2', 0),
(83, 'SAL-3000173', 173, '1', '48000', '2022-10-21 13:11:24', '2022-10-21', '3', '', '', '2', 0),
(84, 'SAL-4130174', 174, '1', '40000', '2022-10-21 13:11:52', '2022-10-21', '3', '', '', '2', 0),
(85, 'SAL-9330175', 175, '1', '25000', '2022-10-21 13:12:17', '2022-10-21', '3', '', '', '2', 0),
(86, 'SAL-3980176', 176, '1', '28000', '2022-10-21 13:13:05', '2022-10-21', '3', '', '', '2', 0),
(87, 'SAL-3720178', 178, '1', '20000', '2022-10-21 13:13:30', '2022-10-21', '3', '', '', '2', 0),
(88, 'SAL-4950179', 179, '1', '42000', '2022-10-21 13:14:06', '2022-10-21', '3', '', '', '2', 0),
(89, 'SAL-4710180', 180, '1', '5000', '2022-10-21 13:14:47', '2022-10-21', '3', '', '', '2', 0),
(90, 'SAL-1290232', 232, '1', '25000', '2022-10-21 13:15:56', '2022-10-21', '3', '', '', '2', 0),
(91, 'SAL-9590181', 181, '1', '38000', '2022-10-21 13:16:15', '2022-10-21', '3', '', '', '2', 0),
(92, 'SAL-3840182', 182, '1', '26000', '2022-10-21 16:29:05', '2022-10-21', '3', '', '', '2', 0),
(93, 'SAL-8210183', 183, '1', '20000', '2022-10-21 16:29:51', '2022-10-21', '3', '', '', '2', 0),
(94, 'SAL-7890184', 184, '1', '30000', '2022-10-21 16:30:24', '2022-10-21', '3', '', '', '2', 0),
(95, 'SAL-6010185', 185, '1', '24000', '2022-10-21 16:30:58', '2022-10-21', '3', '', '', '2', 0),
(96, 'SAL-1460186', 186, '1', '24000', '2022-10-21 16:31:37', '2022-10-21', '3', '', '', '2', 0),
(97, 'SAL-9530188', 188, '1', '24000', '2022-10-21 16:32:10', '2022-10-21', '3', '', '', '2', 0),
(98, 'SAL-6600189', 189, '1', '24000', '2022-10-21 16:32:46', '2022-10-21', '3', '', '', '2', 0),
(99, 'SAL-8000192', 192, '1', '25000', '2022-10-21 16:33:38', '2022-10-21', '3', '', '', '2', 0),
(100, 'SAL-1300190', 190, '1', '20000', '2022-10-21 16:35:54', '2022-10-21', '3', '', '', '2', 0),
(101, 'SAL-2940193', 193, '1', '15000', '2022-10-21 16:36:44', '2022-10-21', '3', '', '', '2', 0),
(102, 'SAL-2970194', 194, '1', '20000', '2022-10-21 16:38:42', '2022-10-21', '3', '', '', '2', 0),
(103, 'SAL-6630196', 196, '1', '12000', '2022-10-21 16:39:13', '2022-10-21', '3', '', '', '2', 0),
(104, 'SAL-1450198', 198, '1', '36000', '2022-10-21 16:39:36', '2022-10-21', '3', '', '', '2', 0),
(105, 'SAL-6290204', 204, '1', '26000', '2022-10-21 16:41:52', '2022-10-21', '3', '', '', '2', 0),
(106, 'SAL-6310205', 205, '1', '22000', '2022-10-21 16:42:22', '2022-10-21', '3', '', '', '2', 0),
(107, 'SAL-9150206', 206, '1', '22000', '2022-10-21 16:42:48', '2022-10-21', '3', '', '', '2', 0),
(108, 'SAL-4610248', 248, '1', '20000', '2022-10-21 16:43:08', '2022-10-21', '3', '', '', '2', 0),
(109, 'SAL-5410209', 209, '1', '10000', '2022-10-21 16:43:35', '2022-10-21', '3', '', '', '2', 0),
(110, 'SAL-6240212', 212, '1', '32000', '2022-10-21 16:44:10', '2022-10-21', '3', '', '', '2', 0),
(111, 'SAL-8360211', 211, '1', '7000', '2022-10-21 16:44:40', '2022-10-21', '3', '', '', '2', 0),
(112, 'SAL-5680213', 213, '1', '30000', '2022-10-21 16:46:43', '2022-10-21', '3', '', '', '2', 0),
(113, 'SAL-2390522', 522, '1', '25000', '2022-10-21 16:47:22', '2022-10-21', '3', '', '', '2', 0),
(114, 'SAL-5850662', 662, '1', '15000', '2022-10-21 16:48:02', '2022-10-21', '3', '', '', '2', 0),
(115, 'SAL-4140383', 383, '1', '5000', '2022-10-21 16:48:45', '2022-10-21', '3', '', '', '2', 0),
(116, 'SAL-9410214', 214, '1', '20000', '2022-10-21 16:49:19', '2022-10-21', '3', '', '', '2', 0),
(117, 'SAL-8260393', 393, '1', '16000', '2022-10-21 16:49:45', '2022-10-21', '3', '', '', '2', 0),
(118, 'SAL-4780394', 394, '1', '15000', '2022-10-21 16:50:19', '2022-10-21', '3', '', '', '2', 0),
(119, 'SAL-4780258', 258, '1', '5000', '2022-10-21 17:41:10', '2022-10-21', '3', '', '', '2', 0),
(120, 'SAL-5480258', 258, '1', '5000', '2022-10-21 17:41:10', '2022-10-21', '3', '', '', '2', 1),
(121, 'SAL-2930247', 247, '1', '80000', '2022-10-21 17:42:00', '2022-10-21', '3', '', '', '2', 0),
(122, 'SAL-4740236', 236, '1', '10000', '2022-10-21 17:42:31', '2022-10-21', '3', '', '', '2', 0),
(123, 'SAL-9520216', 216, '1', '20000', '2022-10-21 17:42:54', '2022-10-21', '3', '', '', '2', 0),
(124, 'SAL-2250341', 341, '1', '16000', '2022-10-21 17:43:25', '2022-10-21', '3', '', '', '2', 0),
(125, 'SAL-2390305', 305, '1', '7000', '2022-10-21 17:44:47', '2022-10-21', '3', '', '', '2', 0),
(126, 'SAL-9830244', 244, '1', '10000', '2022-10-21 17:45:11', '2022-10-21', '3', '', '', '2', 0),
(127, 'SAL-13703', 3, '1', '54000', '2022-10-21 17:45:55', '2022-10-21', '3', '', '', '2', 0),
(128, 'SAL-19208', 8, '1', '38000', '2022-10-21 17:48:18', '2022-10-21', '3', '', '', '2', 0),
(129, 'SAL-8180227', 227, '1', '14000', '2022-10-21 17:49:01', '2022-10-21', '3', '', '', '2', 0),
(130, 'SAL-1620296', 296, '1', '30000', '2022-10-21 17:49:52', '2022-10-21', '3', '', '', '2', 0),
(131, 'SAL-5970300', 300, '1', '12000', '2022-10-21 17:50:38', '2022-10-21', '3', '', '', '2', 0),
(132, 'SAL-26902', 2, '1', '40000', '2022-10-21 17:51:07', '2022-10-21', '3', '', '', '2', 0),
(133, 'SAL-8430297', 297, '1', '28000', '2022-10-21 17:51:35', '2022-10-21', '3', '', '', '2', 0),
(134, 'SAL-4030219', 219, '1', '28800', '2022-10-21 17:52:16', '2022-10-21', '3', '', '', '2', 0),
(135, 'SAL-5520242', 242, '1', '13000', '2022-10-21 17:53:40', '2022-10-21', '3', '', '', '2', 0),
(136, 'SAL-4700271', 271, '1', '116000', '2022-10-21 17:54:18', '2022-10-21', '3', '', '', '2', 0),
(137, 'SAL-4500191', 191, '1', '70000', '2022-10-21 17:54:44', '2022-10-21', '3', '', '', '2', 0),
(138, 'SAL-4220249', 249, '1', '27200', '2022-10-21 17:55:11', '2022-10-21', '3', '', '', '2', 0),
(139, 'SAL-5660377', 377, '1', '14000', '2022-10-21 17:55:47', '2022-10-21', '3', '', '', '2', 0),
(140, 'SAL-6920245', 245, '1', '16800', '2022-10-21 17:56:06', '2022-10-21', '3', '', '', '2', 0),
(141, 'SAL-6700302', 302, '1', '10000', '2022-10-21 17:56:26', '2022-10-21', '3', '', '', '2', 0),
(142, 'SAL-8860231', 231, '1', '20000', '2022-10-21 17:56:46', '2022-10-21', '3', '', '', '2', 0),
(143, 'SAL-1690228', 228, '1', '10000', '2022-10-21 17:57:09', '2022-10-21', '3', '', '', '2', 0),
(144, 'SAL-2120356', 356, '1', '50000', '2022-10-21 17:57:47', '2022-10-21', '3', '', '', '2', 0),
(145, 'SAL-3490221', 221, '1', '14000', '2022-10-21 17:58:39', '2022-10-21', '3', '', '', '2', 0),
(146, 'SAL-7190243', 243, '1', '16800', '2022-10-21 18:03:06', '2022-10-21', '3', '', '', '2', 0),
(147, 'SAL-6550357', 357, '1', '25000', '2022-10-21 18:03:28', '2022-10-21', '3', '', '', '2', 0),
(148, 'SAL-2270358', 358, '1', '35000', '2022-10-21 18:03:56', '2022-10-21', '3', '', '', '2', 0),
(149, 'SAL-1070359', 359, '1', '15000', '2022-10-21 18:04:14', '2022-10-21', '3', '', '', '2', 0),
(150, 'SAL-9930360', 360, '1', '20000', '2022-10-21 18:04:34', '2022-10-21', '3', '', '', '2', 0),
(151, 'SAL-7990361', 361, '1', '20000', '2022-10-21 18:04:55', '2022-10-21', '3', '', '', '2', 0),
(152, 'SAL-3340362', 362, '1', '20000', '2022-10-21 18:05:48', '2022-10-21', '3', '', '', '2', 0),
(153, 'SAL-2930364', 364, '1', '15000', '2022-10-21 18:06:18', '2022-10-21', '3', '', '', '2', 0),
(154, 'SAL-1350366', 366, '1', '15000', '2022-10-21 18:07:07', '2022-10-21', '3', '', '', '2', 0),
(155, 'SAL-6240368', 368, '1', '19600', '2022-10-21 18:07:43', '2022-10-21', '3', '', '', '2', 0),
(156, 'SAL-1760370', 370, '1', '19600', '2022-10-21 18:08:09', '2022-10-21', '3', '', '', '2', 0),
(157, 'SAL-6010371', 371, '1', '19600', '2022-10-21 18:08:31', '2022-10-21', '3', '', '', '2', 0),
(158, 'SAL-1310363', 363, '1', '15000', '2022-10-21 18:09:03', '2022-10-21', '3', '', '', '2', 0),
(159, 'SAL-1580372', 372, '1', '15000', '2022-10-21 18:09:27', '2022-10-21', '3', '', '', '2', 0),
(160, 'SAL-5650518', 518, '1', '15000', '2022-10-21 18:10:16', '2022-10-21', '3', '', '', '2', 0),
(161, 'SAL-1220259', 259, '1', '38000', '2022-10-21 18:11:16', '2022-10-21', '3', '', '', '2', 0),
(162, 'SAL-8320261', 261, '1', '36000', '2022-10-21 18:11:39', '2022-10-21', '3', '', '', '2', 0),
(163, 'SAL-8620224', 224, '1', '16800', '2022-10-21 18:12:37', '2022-10-21', '3', '', '', '2', 0),
(164, 'SAL-8860298', 298, '1', '30000', '2022-10-21 18:12:56', '2022-10-21', '3', '', '', '2', 0),
(165, 'SAL-2550215', 215, '1', '33000', '2022-10-21 18:13:22', '2022-10-21', '3', '', '', '2', 0),
(166, 'SAL-2410217', 217, '1', '24000', '2022-10-21 18:14:06', '2022-10-21', '3', '', '', '2', 0),
(167, 'SAL-2670273', 273, '1', '36000', '2022-10-21 18:14:40', '2022-10-21', '3', '', '', '2', 0),
(168, 'SAL-50306', 6, '1', '50000', '2022-10-21 18:15:16', '2022-10-21', '3', '', '', '2', 0),
(169, 'SAL-3070309', 309, '1', '14000', '2022-10-21 18:15:45', '2022-10-21', '3', '', '', '2', 0),
(170, 'SAL-8440388', 388, '1', '5000', '2022-10-21 18:16:08', '2022-10-21', '3', '', '', '2', 0),
(171, 'SAL-75007', 7, '1', '51000', '2022-10-21 18:16:32', '2022-10-21', '3', '', '', '2', 0),
(172, 'SAL-4190387', 387, '1', '12000', '2022-10-21 18:16:57', '2022-10-21', '3', '', '', '2', 0),
(173, 'SAL-8640292', 292, '1', '5000', '2022-10-21 18:17:18', '2022-10-21', '3', '', '', '2', 0),
(174, 'SAL-9080268', 268, '1', '30000', '2022-10-21 18:17:43', '2022-10-21', '3', '', '', '2', 0),
(175, 'SAL-3290385', 385, '1', '11000', '2022-10-21 18:18:22', '2022-10-21', '3', '', '', '2', 0),
(176, 'SAL-6090301', 301, '1', '10000', '2022-10-21 18:18:46', '2022-10-21', '3', '', '', '2', 0),
(177, 'SAL-1360286', 286, '1', '10000', '2022-10-21 18:19:06', '2022-10-21', '3', '', '', '2', 0),
(178, 'SAL-62601', 1, '1', '60000', '2022-10-21 18:19:43', '2022-10-21', '3', '', '', '2', 0),
(179, 'SAL-9310278', 278, '1', '12000', '2022-10-21 18:20:01', '2022-10-21', '3', '', '', '2', 0),
(180, 'SAL-8770278', 278, '1', '12000', '2022-10-21 18:20:13', '2022-10-21', '3', '', '', '2', 1),
(181, 'SAL-5630277', 277, '1', '10000', '2022-10-21 18:20:37', '2022-10-21', '3', '', '', '2', 0),
(182, 'SAL-3040285', 285, '1', '12000', '2022-10-21 18:21:11', '2022-10-21', '3', '', '', '2', 0),
(183, 'SAL-1090355', 355, '1', '15000', '2022-10-21 18:21:33', '2022-10-21', '3', '', '', '2', 0),
(184, 'SAL-3990237', 237, '1', '18000', '2022-10-21 18:21:53', '2022-10-21', '3', '', '', '2', 0),
(185, 'SAL-2110339', 339, '1', '20000', '2022-10-21 18:22:16', '2022-10-21', '3', '', '', '2', 0),
(186, 'SAL-9300274', 274, '1', '10000', '2022-10-21 18:22:35', '2022-10-21', '3', '', '', '2', 0),
(187, 'SAL-4490283', 283, '1', '5000', '2022-10-21 18:22:55', '2022-10-21', '3', '', '', '2', 0),
(188, 'SAL-8140233', 233, '1', '18000', '2022-10-21 18:23:29', '2022-10-21', '3', '', '', '2', 0),
(189, 'SAL-3100293', 293, '1', '5000', '2022-10-21 18:24:25', '2022-10-21', '3', '', '', '2', 0),
(190, 'SAL-4460257', 257, '1', '44000', '2022-10-21 18:25:03', '2022-10-21', '3', '', '', '2', 0),
(191, 'SAL-5560238', 238, '1', '5000', '2022-10-21 18:25:34', '2022-10-21', '3', '', '', '2', 0),
(192, 'SAL-7820295', 295, '1', '20000', '2022-10-21 18:25:55', '2022-10-21', '3', '', '', '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_expenses`
--

CREATE TABLE `staff_expenses` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `note` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attendances`
--
ALTER TABLE `employee_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_docs`
--
ALTER TABLE `employee_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_education`
--
ALTER TABLE `employee_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_experience`
--
ALTER TABLE `employee_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_types`
--
ALTER TABLE `employee_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_types`
--
ALTER TABLE `leave_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `long_term_loans`
--
ALTER TABLE `long_term_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `long_term_loan_details`
--
ALTER TABLE `long_term_loan_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_item`
--
ALTER TABLE `payroll_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll_narrations`
--
ALTER TABLE `payroll_narrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_advances`
--
ALTER TABLE `salary_advances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_advance_details`
--
ALTER TABLE `salary_advance_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_expenses`
--
ALTER TABLE `staff_expenses`
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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=677;

--
-- AUTO_INCREMENT for table `employee_attendances`
--
ALTER TABLE `employee_attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_docs`
--
ALTER TABLE `employee_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_education`
--
ALTER TABLE `employee_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_experience`
--
ALTER TABLE `employee_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_types`
--
ALTER TABLE `employee_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `leave_types`
--
ALTER TABLE `leave_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `long_term_loans`
--
ALTER TABLE `long_term_loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `long_term_loan_details`
--
ALTER TABLE `long_term_loan_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=870;

--
-- AUTO_INCREMENT for table `payroll_item`
--
ALTER TABLE `payroll_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payroll_narrations`
--
ALTER TABLE `payroll_narrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT for table `salary_advances`
--
ALTER TABLE `salary_advances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `salary_advance_details`
--
ALTER TABLE `salary_advance_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `staff_expenses`
--
ALTER TABLE `staff_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
