-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 01:06 PM
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
-- Database: `olak_petroleum`
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
  `settings` varchar(50) NOT NULL,
  `filtering` varchar(50) NOT NULL,
  `created_by` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_control`
--

INSERT INTO `access_control` (`id`, `user_id`, `dashboard`, `users_mgt`, `product_mgt`, `sales_mgt`, `expenses_mgt`, `report_mgt`, `settings`, `filtering`, `created_by`, `created_at`, `deleted`) VALUES
(1, '2', '0', '0', '0', '1', '1', '0', '0', '', '1', '2022-04-21 13:17:11', ''),
(2, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2022-04-21 13:58:19', ''),
(7, '4', '0', '1', '1', '1', '1', '1', '0', '', '', '2022-05-25 00:12:29', ''),
(8, '3', '0', '0', '0', '1', '0', '0', '0', '', '', '2022-05-25 00:13:11', ''),
(9, '5', '1', '1', '1', '1', '1', '1', '1', '1', '', '2022-05-25 23:43:44', '');

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
(1, 'Super Admin', 'admin1@gmail.com', '+1 (501) 243-1641', '85f5aed8f1484aa634e875c943756de7.jpg', 'Blanditiis pariatur', '$2y$10$THE0NiMs6E3ae1X2mNuqF.MKWUDTE8xrWe3EBPzXms9/zh2JBg/cW', '0', '1', '1', '1', '', '2022-04-15 12:16:35', '2022-04-15 12:16:35', '1', ''),
(2, 'Ryan Banks', 'manager@gmail.com', '+1 (371) 637-5636', '57e0a2ba95fc6a7a552f5eb01a2b6c3b.jpg', 'Id quibusdam velit ', '$2y$10$T0WVsxGM2zBr/cgyneBf1exdJtTILTrryFRs9Ui0kLsHBHRrGrCsq', '0', '3', '1', '1', '', '2022-04-15 13:01:39', '2022-04-15 13:01:39', '1', ''),
(3, 'Ojo Gbadamosi', 'supervisor@gmail.com', '08025487896', '', '', '$2y$10$tHeQG.KIU8yeIfL76jMtQeBVJ6moKPG/wIlnBNdI/NZ2CGA86NHe.', '0', '4', '1', '1', '', '2022-05-24 23:48:33', '2022-05-24 23:48:33', '1', ''),
(4, 'Salami Lawal', 'compliance@gmail.com', '08032545896', '', '', '$2y$10$XMD3YrNkxgAYWbxdNCLoDOrc18AMjK6G/g6eFA6a3jjkFHcnYAhi2', '0', '2', '1', '1', '', '2022-05-24 23:54:55', '2022-05-24 23:54:55', '1', ''),
(5, 'General Manager', 'general@gmail.com', '08090254878', '', '', '$2y$10$lF8rJqPpIMOch8BGfzf2KuQjeFGMm/Ohqa654Uul4ad8rZOeCbrGa', '0', '5', '1', '1', '', '2022-05-25 23:43:05', '2022-05-25 23:43:05', '1', '');

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
-- Table structure for table `cash_flow`
--

CREATE TABLE `cash_flow` (
  `id` int(11) NOT NULL,
  `credit_sales` varchar(191) NOT NULL,
  `cash_sales` varchar(191) NOT NULL,
  `pos` varchar(191) NOT NULL,
  `transfer` varchar(255) NOT NULL,
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

INSERT INTO `cash_flow` (`id`, `credit_sales`, `cash_sales`, `pos`, `transfer`, `narration`, `company_id`, `branch_id`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(3, '2000', '2500', '1500', '65000', 'POS wema bank : 10,000\r\nPOS uba bank : 2,000', '1', '1', '1', '2022-05-27', '0000-00-00 00:00:00', '');

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
(1, '1', 'Liberty Gross', 'olak@gmail.com', '08012345678', 'Olak petroleum', 'Ilorin, Kwara State', '0212547892', 'faeb92e9b253b9c94ba6abc6ef37855d.png', '2022-05-10', '0000-00-00', '');

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
  `sales_in_ltr` varchar(15) NOT NULL,
  `expected_stock` varchar(15) NOT NULL,
  `actual_stock` varchar(15) NOT NULL,
  `over_or_short` varchar(15) NOT NULL,
  `exp_sales_value` varchar(15) NOT NULL,
  `cash_submitted` varchar(15) NOT NULL,
  `total_sales` varchar(15) NOT NULL,
  `total_value` varchar(15) NOT NULL,
  `grand_total_value` varchar(15) NOT NULL,
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

INSERT INTO `data_sheet` (`id`, `product_id`, `open_stock`, `new_stock`, `total_stock`, `sales_in_ltr`, `expected_stock`, `actual_stock`, `over_or_short`, `exp_sales_value`, `cash_submitted`, `total_sales`, `total_value`, `grand_total_value`, `company_id`, `branch_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '1', '29100', '0', '29100', '2712', '26388', '26500', '112', '439344', '439350', '0', '0', '0', '1', '1', '1', '', '2022-02-13', '', ''),
(2, '2', '22450', '0', '22450', '3789', '18661', '18600', '-61', '613818', '613825', '0', '0', '0', '1', '1', '1', '', '2022-02-13', '', ''),
(3, '3', '30250', '0', '30250', '3435', '26815', '26800', '-15', '556470', '556475', '0', '0', '0', '1', '1', '1', '', '2022-02-13', '', ''),
(4, '4', '18100', '0', '18100', '3408', '14692', '14750', '58', '552096', '552100', '0', '0', '0', '1', '1', '1', '', '2022-02-13', '', ''),
(5, '5', '17150', '0', '17150', '6637', '10513', '10650', '137', '1075194', '1075205', '0', '0', '0', '1', '1', '1', '', '2022-02-13', '', ''),
(6, '6', '7200', '0', '7200', '0', '7200', '7200', '0', '0', '0', '0', '0', '0', '1', '1', '1', '', '2022-02-13', '', ''),
(7, '7', '6100', '0', '6100', '1221', '4879', '4900', '21', '409035', '409035', '0', '0', '0', '1', '1', '1', '', '2022-02-13', '', ''),
(8, '8', '6250', '0', '6250', '336', '5914', '5950', '36', '115920', '115920', '0', '0', '0', '1', '1', '1', '', '2022-02-13', '', ''),
(9, '1', '29100', '0', '29100', '2145', '26955', '26955', '0', '347490', '347490', '0', '0', '0', '1', '1', '1', '', '2022-03-29', '', ''),
(10, '2', '22450', '0', '22450', '1125', '21325', '21326', '1', '182250', '182250', '0', '0', '0', '1', '1', '1', '', '2022-03-29', '', ''),
(11, '8', '12548', '0', '12548', '1100', '11448', '11448', '0', '379500', '379500', '0', '0', '0', '1', '1', '1', '', '2022-03-29', '', ''),
(12, '6', '22540', '0', '22540', '125', '22415', '22414', '-1', '41875', '41875', '0', '0', '0', '1', '1', '1', '', '2022-03-29', '', ''),
(13, '2', '28501', '0', '28501', '275', '28226', '28226', '0', '44550', '44550', '0', '0', '0', '1', '1', '1', '', '2022-03-30', '', ''),
(14, '6', '19850', '0', '19850', '8245', '11605', '11605', '0', '2762075', '2762075', '0', '0', '0', '1', '1', '1', '', '2022-03-30', '', ''),
(15, '7', '27256', '0', '27256', '9248', '18008', '18008', '0', '3098080', '3098080', '0', '0', '0', '1', '1', '1', '', '2022-04-30', '', ''),
(16, '5', '26785', '0', '26785', '1005', '25780', '25790', '10', '162810', '162810', '0', '0', '0', '1', '1', '1', '', '2022-05-01', '', ''),
(17, '8', '21458', '0', '21458', '2120', '19338', '19339', '1', '731400', '731410', '0', '0', '0', '1', '1', '1', '', '2022-05-01', '', ''),
(18, '6', '27985', '0', '27985', '905', '27895', '27899', '4', '30150', '30190', '0', '0', '0', '1', '1', '1', '', '2022-05-01', '', ''),
(19, '1', '29541', '0', '29541', '1202', '28339', '28400', '61', '194724', '194724', '0', '0', '0', '1', '2', '1', '', '2022-05-01', '', ''),
(20, '7', '25647', '0', '25647', '1008', '24639', '24600', '-39', '337680', '337680', '0', '0', '0', '1', '2', '1', '', '2022-05-01', '', ''),
(21, '8', '36955', '0', '36955', '2010', '34945', '34940', '-5', '693450', '693500', '0', '0', '0', '1', '2', '1', '', '2022-05-01', '', ''),
(22, '4', '12505', '0', '12505', '250', '12255', '12255', '0', '40500', '40500', '0', '0', '0', '1', '2', '1', '', '2022-05-08', '', ''),
(23, '2', '36', '42', '78', '29', '49', '49', '0', '4698', '26', '0', '0', '0', '1', '1', '1', '', '2022-05-08', '', ''),
(24, '4', '12545', '0', '12545', '2547', '9998', '9998', '0', '412614', '412614', '0', '0', '0', '1', '1', '1', '', '2022-05-08', '', ''),
(25, '8', '12547', '0', '12547', '2547', '10000', '10000', '0', '878715', '878715', '0', '0', '0', '1', '1', '1', '', '2022-05-08', '', ''),
(26, '4', '25478', '0', '25478', '6577', '18901', '18900', '-1', '1065474', '1065474', '0', '0', '0', '1', '1', '1', '', '2022-05-08', '', ''),
(27, '7', '32547', '0', '32547', '2890', '29657', '29655', '-2', '968150', '968150', '0', '0', '0', '1', '1', '1', '', '2022-05-08', '', ''),
(28, '6', '18750', '0', '18750', '7860', '10890', '10800', '-90', '2633100', '2633000', '0', '0', '0', '1', '1', '1', '', '2022-05-09', '', ''),
(29, '4', '12547', '0', '12547', '2547', '10000', '10000', '0', '412614', '407430', '0', '0', '0', '1', '1', '1', '', '2022-05-09', '', ''),
(30, '2', '25487', '0', '25487', '25400', '87', '87', '0', '4114800', '4114800', '0', '0', '0', '1', '1', '1', '', '2022-05-09', '', ''),
(31, '8', '251545', '0', '251545', '10151', '241394', '241392', '-2', '3502095', '3502095', '0', '0', '0', '1', '1', '1', '', '2022-05-09', '', ''),
(32, '2', '2500', '0', '2500', '1500', '1000', '1000', '0', '243000', '405000', '0', '0', '0', '1', '2', '1', '', '2022-05-09', '', ''),
(33, '6', '1350', '0', '1350', '1300', '50', '50', '0', '435500', '452250', '0', '0', '0', '1', '2', '1', '', '2022-05-09', '', ''),
(34, '8', '3584', '0', '3584', '3450', '134', '133', '-1', '1190250', '1190250', '0', '0', '0', '1', '2', '1', '', '2022-05-09', '', ''),
(35, '5', '25487', '0', '25487', '21050', '4437', '4435', '-2', '3410100', '3410100', '0', '0', '0', '1', '2', '1', '', '2022-05-09', '', ''),
(36, '1', '11052', '0', '11052', '250', '10802', '11027', '0', '41250', '41250', '0', '0', '0', '1', '2', '1', '', '2022-05-24', '', ''),
(37, '8', '2500', '0', '2500', '350', '2150', '2150', '0', '120750', '12250', '0', '0', '0', '1', '2', '1', '', '2022-05-24', '', ''),
(38, '6', '11052', '0', '11052', '1257', '9795', '9795', '0', '421095', '325405', '0', '0', '0', '1', '2', '1', '', '2022-05-24', '', ''),
(39, '1', '14556', '900', '15456', '2180', '13376', '13380', '-6', '359700', '358000', '0', '0', '0', '1', '1', '4', '4', '2022-05-25', '2022-05-25 10:47:49', ''),
(49, '1', '11052', '0', '11052', '', '', '', '', '', '', '', '', '', '1', '1', '2', '', '2022-05-26', '', ''),
(50, '2', '950', '0', '950', '', '', '', '', '', '', '', '', '', '1', '1', '2', '', '2022-05-26', '', ''),
(51, '3', '12780', '0', '12780', '', '', '', '', '', '', '', '', '', '1', '1', '2', '', '2022-05-26', '', ''),
(52, '4', '1105', '0', '1105', '250', '855', '1102', '247', '41250', '3254', '', '', '', '1', '1', '4', '4', '2022-05-26', '2022-05-26 14:28:14', ''),
(53, '1', '12500', '0', '12500', '500', '12000', '11550', '-450', '82500', '15000', '', '', '', '1', '1', '1', '3', '2022-05-27', '2022-05-27 07:01:50', ''),
(54, '2', '14520', '0', '14520', '650', '13870', '13869', '-1', '107250', '12500', '', '', '', '1', '1', '1', '3', '2022-05-27', '2022-05-27 07:01:50', '');

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
(1, '1', '1', '1', '18.51', '2999', 'King', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(2, '1', '1', '1', '18.51', '2999', 'King', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(3, '1', '1', '1', '18.51', '2999', 'King', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(4, '1', '1', '1', '55.55', '9000', 'Eucharistic', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(5, '1', '1', '1', '49.38', '8000', 'Eucharistic', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(6, '1', '1', '1', '420', '140700', 'Alamo c/o Transport', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(7, '1', '1', '1', '180', '60300', 'Baba Biodun c/o Transport', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(8, '1', '1', '2', '', '200', 'Station use', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(9, '1', '1', '2', '300', '100500', 'fuelling of Olak generator', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(10, '1', '1', '3', '', '20000', 'PR. Tayo @ Depot ', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(11, '1', '1', '3', '', '400', 'Transport c/o Bank', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(12, '1', '1', '3', '', '700', 'Islamiyat attendant\'s shortage', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(13, '1', '1', '3', '', '500', 'Blessing attendant\'s shortage', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(14, '1', '1', '3', '', '1000', 'Jamiu attendant\'s shortage', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(15, '1', '1', '4', '40', '6480', 'Alhaji Lukman', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(16, '1', '1', '4', '60', '9720', 'Factory Sienna', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(17, '1', '1', '4', '43.20', '6999', 'KIA Jeep', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(18, '1', '1', '4', '30', '4860', 'Mr. Ranti', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(19, '1', '1', '4', '40', '6480', 'Frontier', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(20, '1', '1', '4', '', '8400', '6pcs of Polo c/o Olak Ibadan', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(21, '1', '1', '4', '', '4800', '6 Trousers @ #800 each', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(22, '1', '1', '4', '', '500', 'grinding machine', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(23, '1', '1', '4', '', '2000', 'Repair of walking talking charger', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(24, '1', '1', '5', '', '726100', 'P.O.S', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(25, '1', '1', '1', '30', '10350', 'Baba Ijesha', '1', '2022-03-29', '0000-00-00 00:00:00', ''),
(26, '1', '1', '2', '', '8000', 'Station usage', '1', '2022-03-29', '0000-00-00 00:00:00', ''),
(27, '1', '1', '2', '300', '103500', 'fuelling of olak generator', '1', '2022-03-29', '0000-00-00 00:00:00', ''),
(28, '1', '1', '3', '', '15600', 'Shortage by Tokunbo', '1', '2022-03-29', '0000-00-00 00:00:00', ''),
(29, '1', '1', '1', '2500', '862500', 'Baba Ojo ', '1', '2022-03-30', '0000-00-00 00:00:00', ''),
(30, '1', '1', '2', '200', '67000', 'Olak Generator', '1', '2022-03-30', '0000-00-00 00:00:00', ''),
(31, '1', '1', '3', '', '4000', 'Sunbo collect', '1', '2022-04-30', '0000-00-00 00:00:00', ''),
(32, '1', '1', '4', '', '6500', 'Collected', '1', '2022-04-30', '0000-00-00 00:00:00', ''),
(33, '1', '1', '5', '', '250400', 'P.O.S Wema', '1', '2022-04-30', '0000-00-00 00:00:00', ''),
(34, '1', '1', '1', '25', '8375', 'Idris for Olak Gen', '1', '2022-05-01', '0000-00-00 00:00:00', ''),
(35, '1', '2', '2', '50', '16750', 'Olak Gen', '1', '2022-05-01', '0000-00-00 00:00:00', ''),
(36, '1', '1', '1', '300', '48600', 'Baba Ibeji', '1', '2022-05-01', '0000-00-00 00:00:00', ''),
(37, '1', '1', '3', '', '50000', 'Money for food', '1', '2022-05-01', '0000-00-00 00:00:00', ''),
(38, '1', '2', '3', '781', '261635', 'Deleniti non aliquam', '1', '2022-05-08', '0000-00-00 00:00:00', ''),
(39, '1', '2', '3', '781', '261635', 'Deleniti non aliquam', '1', '2022-05-08', '0000-00-00 00:00:00', ''),
(40, '1', '2', '3', '781', '261635', 'Deleniti non aliquam', '1', '2022-05-08', '0000-00-00 00:00:00', ''),
(41, '1', '2', '2', '44', '7128', 'Reprehenderit minima', '1', '2022-05-08', '0000-00-00 00:00:00', ''),
(42, '1', '1', '4', '250', '83750', 'Temporibus aut ea cu', '1', '2022-05-08', '0000-00-00 00:00:00', ''),
(43, '1', '1', '3', '941', '324645', 'Neque in qui dolores', '1', '2022-05-08', '0000-00-00 00:00:00', ''),
(44, '1', '1', '1', '669', '230805', 'Baba Ibeji, from market', '1', '2022-05-09', '2022-05-09 16:51:54', ''),
(45, '1', '2', '1', '2', '690', 'Baba Ibeji', '1', '2022-05-24', '0000-00-00 00:00:00', ''),
(46, '1', '2', '2', '2', '670', 'Company used', '1', '2022-05-24', '0000-00-00 00:00:00', ''),
(47, '1', '2', '3', '', '5000', 'Baba Jibola', '1', '2022-05-24', '0000-00-00 00:00:00', ''),
(48, '1', '2', '1', '1', '165', 'Baba Jibola recieved 1 ltr of petrol', '1', '2022-05-24', '0000-00-00 00:00:00', ''),
(49, '1', '2', '2', '', '2000', 'Bunmi collected 2000 naira for pencil', '1', '2022-05-24', '0000-00-00 00:00:00', ''),
(50, '1', '2', '5', '', '50000', 'Transfer to Access POS bank', '1', '2022-05-24', '0000-00-00 00:00:00', ''),
(51, '1', '2', '5', '', '30000', 'POS Zenith', '1', '2022-05-24', '0000-00-00 00:00:00', ''),
(52, '1', '2', '5', '', '20000', 'POS heritage', '1', '2022-05-24', '0000-00-00 00:00:00', ''),
(53, '1', '1', 'Petrol for generator', '20 ltrs', '3300', 'Petrol for office', '1', '2022-05-27', '2022-05-27 08:17:49', ''),
(54, '1', '1', 'A4 paper', '1 pack', '1600', 'A4 paper for recording of credit sales', '1', '2022-05-27', '0000-00-00 00:00:00', ''),
(55, '1', '1', 'Shola transport', '', '2000', 'Shola transport to Ibadan', '1', '2022-05-27', '0000-00-00 00:00:00', ''),
(56, '1', '1', 'Food', '', '4500', 'Food for staff', '1', '2022-05-27', '0000-00-00 00:00:00', '');

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
(1, 'PMS', '1', '165', '1', '2022-04-13 18:18:38', NULL),
(2, 'PMS', '2', '165', '1', '2022-04-13 18:18:47', NULL),
(3, 'PMS', '3', '165', '1', '2022-04-13 18:18:55', NULL),
(4, 'PMS', '4', '165', '1', '2022-04-13 18:19:06', NULL),
(5, 'PMS', '5', '165', '1', '2022-04-13 18:19:23', NULL),
(6, 'AGO', '6', '700', '1', '2022-04-13 18:19:52', NULL),
(7, 'AGO', '7', '700', '1', '2022-04-13 18:20:02', NULL),
(8, 'DPK', '8', '345', '1', '2022-04-13 18:20:17', NULL),
(9, 'PMS', '10', '165', '2', '2022-05-24 10:20:44', NULL);

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
-- Dumping data for table `remittance`
--

INSERT INTO `remittance` (`id`, `rate`, `quantity`, `amount`, `narration`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '', '', '33', 'Surplus on P.M.S', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(2, '', '', '335000', 'Premier Lotto paid in for 1000L of AGO', '1', '2022-02-13', '0000-00-00 00:00:00', ''),
(3, '', '', '1500', 'Returned Changed from Sunbo', '1', '2022-04-30', '0000-00-00 00:00:00', ''),
(4, '', '', '500', 'Bolu returned 500 from message', '1', '2022-05-24', '0000-00-00 00:00:00', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_sheet`
--
ALTER TABLE `data_sheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `remittance`
--
ALTER TABLE `remittance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
