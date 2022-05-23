-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 06:22 PM
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
(9, 'Milk ivory', '1', '2022-05-19 16:09:58', '2022-05-19 16:09:58', ''),
(10, 'Hand brand', '1', '2022-05-21 01:11:25', '2022-05-21 01:11:25', ''),
(12, 'Old type', '1', '2022-05-21 01:11:34', '2022-05-21 01:11:34', '');

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
-- Table structure for table `material_phase_one`
--

CREATE TABLE `material_phase_one` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `raw_category_id` varchar(50) NOT NULL,
  `raw_group_id` varchar(50) NOT NULL,
  `open_stock` varchar(191) NOT NULL,
  `inflow` varchar(50) NOT NULL,
  `total_stock` varchar(50) NOT NULL,
  `outflow` varchar(50) NOT NULL,
  `closing_stock` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `remarks` varchar(191) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_phase_one`
--

INSERT INTO `material_phase_one` (`id`, `type`, `raw_category_id`, `raw_group_id`, `open_stock`, `inflow`, `total_stock`, `outflow`, `closing_stock`, `company_id`, `branch_id`, `remarks`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '1', '1', '2', '11052', '0', '11052', '0', '11052', '1', '1', 'Thanks', '1', '2022-05-21', '2022-05-22 13:44:54', ''),
(2, '1', '1', '1', '5908', '18', '5926', '0', '5926', '1', '1', '', '1', '2022-05-22', '2022-05-22 13:46:54', ''),
(3, '2', '1', '2', '3', '0', '3', '0', '3', '1', '1', '', '1', '2022-05-22', '2022-05-22 13:49:30', ''),
(4, '2', '1', '1', '3', '0', '3', '0', '3', '1', '1', '', '1', '2022-05-22', '2022-05-22 13:49:30', '');

-- --------------------------------------------------------

--
-- Table structure for table `material_phase_two`
--

CREATE TABLE `material_phase_two` (
  `id` int(11) NOT NULL,
  `product_id` varchar(191) NOT NULL,
  `weight` varchar(191) NOT NULL,
  `open_scb` varchar(191) NOT NULL,
  `open_stock` varchar(191) NOT NULL,
  `inflow_scb` varchar(191) NOT NULL,
  `inflow` varchar(191) NOT NULL,
  `total_stock_scb` varchar(191) NOT NULL,
  `total_stock` varchar(191) NOT NULL,
  `outflow_scb` varchar(191) NOT NULL,
  `outflow` varchar(191) NOT NULL,
  `closing_stock_scb` varchar(191) NOT NULL,
  `closing_stock` varchar(191) NOT NULL,
  `created_by` varchar(191) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material_phase_two`
--

INSERT INTO `material_phase_two` (`id`, `product_id`, `weight`, `open_scb`, `open_stock`, `inflow_scb`, `inflow`, `total_stock_scb`, `total_stock`, `outflow_scb`, `outflow`, `closing_stock_scb`, `closing_stock`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '10', '25.433', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '2022-05-22', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_by` varchar(15) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_type`, `name`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '2', 'Flat embossed', '1', '2022-05-19 15:20:42', '2022-05-19 15:33:19', NULL),
(2, '2', 'Flat plain', '1', '2022-05-19 15:36:24', '2022-05-19 15:36:24', ''),
(3, '2', 'Deep gutter embossed', '1', '2022-05-19 15:36:42', '2022-05-19 15:36:42', ''),
(4, '2', 'Accessory', '1', '2022-05-19 15:37:01', '2022-05-19 15:37:01', ''),
(5, '2', 'Old type embossed', '1', '2022-05-19 15:37:19', '2022-05-19 15:37:19', ''),
(6, '2', 'Deep Gutter plain', '1', '2022-05-19 19:43:35', '2022-05-19 19:43:35', ''),
(7, '2', 'Old type', '1', '2022-05-20 16:13:59', '2022-05-20 16:13:59', ''),
(8, '2', 'h/brand 6ft', '1', '2022-05-21 01:12:55', '2022-05-21 01:12:55', ''),
(9, '2', 'h/brand 8ft', '1', '2022-05-21 01:13:11', '2022-05-22 14:19:25', ''),
(10, '1', 'zink 1', '1', '2022-05-22 14:39:08', '2022-05-22 14:39:08', ''),
(11, '1', 'zink 2', '1', '2022-05-22 14:39:25', '2022-05-22 14:39:25', ''),
(12, '1', 'hydrated limes', '1', '2022-05-22 14:39:48', '2022-05-22 14:39:48', ''),
(13, '1', 'alloy', '1', '2022-05-22 14:40:02', '2022-05-22 14:40:02', ''),
(14, '1', 'lead 3', '1', '2022-05-22 14:40:20', '2022-05-22 14:40:20', ''),
(15, '1', 'lime', '1', '2022-05-22 14:40:30', '2022-05-22 14:40:30', ''),
(16, '1', 'lead 5', '1', '2022-05-22 14:40:39', '2022-05-22 14:40:39', ''),
(17, '1', 'lead 6', '1', '2022-05-22 14:40:54', '2022-05-22 14:40:54', ''),
(18, '1', 'aluminum', '1', '2022-05-22 14:41:28', '2022-05-22 14:41:28', ''),
(19, '1', 'degreasant pwd', '1', '2022-05-22 14:42:22', '2022-05-22 14:42:22', ''),
(20, '1', 'special flux powder', '1', '2022-05-22 14:42:37', '2022-05-22 14:42:37', ''),
(21, '1', 'galva flux pwd', '1', '2022-05-22 14:42:57', '2022-05-22 14:42:57', ''),
(22, '1', 'amonia HCL/pwd', '1', '2022-05-22 14:43:26', '2022-05-22 14:43:26', ''),
(23, '1', 'gardobond chemical', '1', '2022-05-22 14:43:44', '2022-05-22 14:43:44', ''),
(24, '1', 'gardoclean powder bag', '1', '2022-05-22 14:44:01', '2022-05-22 14:44:49', ''),
(25, '1', 'dioxidant chromic', '1', '2022-05-22 14:44:33', '2022-05-22 14:44:33', ''),
(26, '1', 'galva flux liquid', '1', '2022-05-22 14:45:15', '2022-05-22 14:45:15', ''),
(27, '1', 'HCL klensol', '1', '2022-05-22 14:45:58', '2022-05-22 14:45:58', ''),
(28, '1', 'kegs of Hydrochloric acid', '1', '2022-05-22 14:46:23', '2022-05-22 14:46:23', ''),
(29, '1', 'anthymony', '1', '2022-05-22 14:46:35', '2022-05-22 14:46:35', ''),
(30, '1', 'tin metal', '1', '2022-05-22 14:46:46', '2022-05-22 14:46:46', '');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_categories`
--

CREATE TABLE `raw_material_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `raw_material_categories`
--

INSERT INTO `raw_material_categories` (`id`, `name`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'beige', '2022-05-21 17:39:24', '2022-05-21 17:44:38', NULL),
(2, 'Blue', '2022-05-21 17:39:31', '2022-05-21 17:39:31', ''),
(3, 'Brown', '2022-05-21 17:39:35', '2022-05-21 17:39:35', ''),
(4, 'Green', '2022-05-21 17:39:41', '2022-05-21 17:39:41', ''),
(5, 'red', '2022-05-21 17:39:47', '2022-05-21 17:39:47', ''),
(6, 'Ivory', '2022-05-21 17:40:40', '2022-05-21 17:40:40', ''),
(7, 'Silver', '2022-05-21 17:40:49', '2022-05-21 17:40:49', ''),
(8, 'Black', '2022-05-21 17:41:03', '2022-05-21 17:41:03', ''),
(9, 'milk', '2022-05-21 17:41:09', '2022-05-21 17:41:09', '');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material_groups`
--

CREATE TABLE `raw_material_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `raw_material_groups`
--

INSERT INTO `raw_material_groups` (`id`, `name`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'local', '2022-05-21 17:47:59', '2022-05-21 17:50:19', ''),
(2, 'imported', '2022-05-21 17:50:11', '2022-05-21 17:50:27', NULL);

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
(1, '1', '1', '1', '92', '0', '0', '92', '0', '0', '0', '0', '92', '1', '1', '1', '2022-05-19', '2022-05-20 16:09:17', ''),
(2, '2', '1', '2', '73', '0', '0', '73', '0', '0', '0', '0', '73', '1', '1', '1', '2022-05-19', '2022-05-20 16:09:17', ''),
(3, '3', '1', '4', '97.3', '0', '0', '97.3', '0', '0', '18.9', '18.9', '78.4', '1', '1', '1', '2022-05-19', '2022-05-20 16:09:17', ''),
(4, '6', '1', '3', '14', '0', '0', '14', '0', '0', '0', '0', '14', '1', '1', '1', '2022-05-19', '2022-05-20 16:09:18', ''),
(5, '4', '1', '1', '2.9', '0', '0', '2.9', '0', '0', '0', '0', '2.9', '1', '1', '1', '2022-05-19', '2022-05-20 16:09:18', ''),
(6, '5', '1', '4', '3', '15.3', '0', '18.3', '0', '0', '15.3', '15.3', '3', '1', '1', '1', '2022-05-19', '2022-05-20 16:09:18', ''),
(7, '1', '2', '1', '29', '0', '0', '29', '0', '0', '0', '0', '29', '1', '1', '1', '2022-05-19', '2022-05-20 16:06:57', ''),
(8, '2', '2', '2', '4', '0', '0', '4', '0', '0', '0', '0', '4', '1', '1', '1', '2022-05-19', '2022-05-20 16:06:57', ''),
(9, '3', '2', '4', '3', '0', '0', '3', '0', '0', '0', '0', '3', '1', '1', '1', '2022-05-19', '2022-05-20 16:06:57', ''),
(10, '6', '2', '3', '23', '0', '0', '23', '0', '0', '0', '0', '23', '1', '1', '1', '2022-05-19', '2022-05-20 16:06:57', ''),
(11, '4', '2', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '1', '2022-05-19', '2022-05-20 16:06:57', ''),
(12, '5', '2', '4', '22.4', '0', '0', '22.4', '0', '0', '0', '0', '22.4', '1', '1', '1', '2022-05-19', '2022-05-20 16:06:58', ''),
(13, '1', '3', '1', '10', '0', '0', '10', '0', '0', '0', '0', '10', '1', '1', '1', '2022-05-19', '2022-05-20 16:14:17', ''),
(14, '2', '3', '2', '23', '0', '0', '23', '0', '0', '0', '0', '23', '1', '1', '1', '2022-05-19', '2022-05-20 16:14:17', ''),
(15, '3', '3', '4', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '1', '2022-05-19', '2022-05-20 16:14:17', ''),
(16, '6', '3', '3', '41', '0', '0', '41', '0', '0', '0', '0', '41', '1', '1', '1', '2022-05-19', '2022-05-20 16:14:17', ''),
(17, '7', '3', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '1', '2022-05-19', '2022-05-20 16:14:17', ''),
(18, '5', '3', '4', '38.4', '0', '0', '38.4', '0', '0', '0', '0', '38.4', '1', '1', '1', '2022-05-19', '2022-05-20 16:14:17', ''),
(19, '1', '4', '', '65', '0', '0', '65', '0', '0', '0', '0', '65', '1', '1', '1', '2022-05-20', '', ''),
(20, '2', '4', '', '45', '0', '0', '45', '0', '0', '0', '0', '45', '1', '1', '1', '2022-05-20', '', ''),
(21, '3', '4', '', '63.3', '0', '0', '63.3', '0', '0', '0', '0', '63.3', '1', '1', '1', '2022-05-20', '', ''),
(22, '6', '4', '', '28.9', '0', '0', '28.9', '0', '0', '0', '0', '28.9', '1', '1', '1', '2022-05-20', '', ''),
(23, '4', '4', '', '1.2', '0', '0', '1.2', '0', '0', '0', '0', '1.2', '1', '1', '1', '2022-05-20', '', ''),
(24, '5', '4', '', '2', '0', '0', '2', '0', '0', '0', '0', '2', '1', '1', '1', '2022-05-20', '', ''),
(25, '1', '5', '', '49', '0', '0', '49', '0', '0', '0', '0', '49', '1', '1', '1', '2022-05-20', '', ''),
(26, '2', '5', '', '3', '0', '0', '3', '0', '0', '0', '0', '3', '1', '1', '1', '2022-05-20', '', ''),
(27, '3', '5', '', '78.6', '0', '0', '78.6', '0', '0', '0', '0', '78.6', '1', '1', '1', '2022-05-20', '', ''),
(28, '6', '5', '', '8', '0', '0', '8', '0', '0', '0', '0', '8', '1', '1', '1', '2022-05-20', '', ''),
(29, '4', '5', '', '0.8', '0', '0', '0.8', '0', '0', '0', '0', '0.8', '1', '1', '1', '2022-05-20', '', ''),
(30, '5', '5', '', '13.9', '0', '0', '13.9', '0', '0', '0', '0', '13.9', '1', '1', '1', '2022-05-20', '', ''),
(31, '1', '6', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '1', '2022-05-20', '', ''),
(32, '2', '6', '', '44', '0', '0', '44', '0', '0', '0', '0', '44', '1', '1', '1', '2022-05-20', '', ''),
(33, '3', '6', '', '42', '0', '0', '42', '0', '0', '0', '0', '42', '1', '1', '1', '2022-05-20', '', ''),
(34, '6', '6', '', '102', '0', '0', '102', '0', '0', '0', '0', '102', '1', '1', '1', '2022-05-20', '', ''),
(35, '5', '6', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '1', '2022-05-20', '', ''),
(36, '1', '7', '', '3', '0', '0', '3', '0', '0', '0', '0', '3', '1', '1', '1', '2022-05-21', '', NULL),
(37, '2', '7', '', '3', '0', '0', '3', '0', '0', '0', '0', '3', '1', '1', '1', '2022-05-21', '', NULL),
(38, '3', '7', '', '2', '0', '0', '2', '0', '0', '0', '0', '2', '1', '1', '1', '2022-05-21', '', NULL),
(39, '6', '7', '', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '1', '2022-05-21', '', NULL),
(40, '5', '7', '', '9', '0', '0', '9', '0', '0', '0', '0', '9', '1', '1', '1', '2022-05-21', '', NULL);

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
-- Dumping data for table `stock_phase_two`
--

INSERT INTO `stock_phase_two` (`id`, `product_id`, `category_id`, `gauge_id`, `open_stock`, `production`, `transfer`, `total_production`, `sales`, `closing_stock`, `remarks`, `company_id`, `branch_id`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '8', '10', '2', '389', '0', '0', '389', '0', '389', 'Well done', '1', '1', '1', '2022-05-21', '2022-05-21 13:39:44', NULL),
(2, '9', '10', '2', '138', '136', '0', '274', '40', '234', 'Well done', '1', '1', '1', '2022-05-21', '2022-05-21 13:39:44', NULL),
(3, '8', '10', '3', '8134', '100', '0', '8234', '0', '8234', 'Well done', '1', '1', '1', '2022-05-21', '2022-05-21 13:39:44', NULL),
(4, '9', '10', '3', '3543', '100', '0', '3643', '0', '3643', 'Well done', '1', '1', '1', '2022-05-21', '2022-05-21 13:39:44', NULL),
(5, '8', '10', '4', '108', '0', '0', '108', '0', '108', 'Well done', '1', '1', '1', '2022-05-21', '2022-05-21 13:39:44', NULL),
(6, '9', '10', '4', '98', '0', '0', '98', '0', '98', 'Well done', '1', '1', '1', '2022-05-21', '2022-05-21 13:39:44', NULL);

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
-- Indexes for table `material_phase_one`
--
ALTER TABLE `material_phase_one`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_phase_two`
--
ALTER TABLE `material_phase_two`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material_categories`
--
ALTER TABLE `raw_material_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_material_groups`
--
ALTER TABLE `raw_material_groups`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `material_phase_one`
--
ALTER TABLE `material_phase_one`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `material_phase_two`
--
ALTER TABLE `material_phase_two`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `raw_material_categories`
--
ALTER TABLE `raw_material_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `raw_material_groups`
--
ALTER TABLE `raw_material_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_phase_one`
--
ALTER TABLE `stock_phase_one`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `stock_phase_two`
--
ALTER TABLE `stock_phase_two`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
