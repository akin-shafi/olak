-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 01:32 PM
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
-- Database: `olak_food`
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

INSERT INTO `access_control` (`id`, `user_id`, `dashboard`, `sales_mgt`, `add_sales`, `edit_sales`, `manage_sales`, `expenses_mgt`, `add_exp`, `edit_exp`, `delete_exp`, `report_mgt`, `access_control`, `company_setup`, `user_mgt`, `filtering`, `created_by`, `created_at`, `deleted`) VALUES
(1, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2022-04-21 13:58:19', ''),
(2, '2', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '2022-06-07 09:32:06', '');

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
(1, 'Super Admin', 'admin@gmail.com', '+1 (501) 243-1641', '85f5aed8f1484aa634e875c943756de7.jpg', 'Blanditiis pariatur', '$2y$10$THE0NiMs6E3ae1X2mNuqF.MKWUDTE8xrWe3EBPzXms9/zh2JBg/cW', '0', '1', '1', '1', '', '2022-04-15 12:16:35', '2022-04-15 12:16:35', '1', ''),
(2, 'Chairman', 'chairman@gmail.com', '09012345678', '749bad0c7df2b6734c0ebea83800b8c9.jpg', 'Usanda, Ilorin, Kwara State', '$2y$10$rpOU29meC.xWWCqkQoN8rO2l80lvFUIvD7Nz9ySFIN47zc4AiF91W', '0', '2', '1', '1', '', '2022-06-07 09:32:06', '2022-06-07 09:32:06', '1', '');

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
(2, '1', 'Unity', 'Ilorin, Kwara State', 'Ilorin', 'Kwara', '2020-02-04', '2022-05-10 02:43:52', ''),
(3, '1', 'Toll-gate', 'Toll-gate, Ibadan', 'Ibadan', 'Oyo', '2012-09-02', '2022-06-07 09:14:41', '');

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
  `updated_at` varchar(50) NOT NULL,
  `deleted` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_flow`
--

INSERT INTO `cash_flow` (`id`, `credit_sales`, `cash_sales`, `pos`, `transfer`, `narration`, `company_id`, `branch_id`, `created_by`, `created_at`, `updated_at`, `deleted`) VALUES
(1, '600', '790', '170', '690', 'Dolore quia illo vel', '1', '1', '1', '2022-06-04', '', ''),
(2, '940', '240', '380', '600', 'Dolorem excepteur su', '1', '1', '1', '2022-06-05', '', ''),
(3, '93', '26', '43', '66', 'Odio quaerat reicien', '1', '1', '1', '2022-06-06', '', '');

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
(1, '1', 'Super Admin', 'olak@gmail.com', '08012345678', 'Olak petroleum', 'Ilorin, Kwara State', '0212547892', 'faeb92e9b253b9c94ba6abc6ef37855d.png', '2022-05-10', '0000-00-00', '');

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
(1, '1', '1', '55LTR petrol', '55', '9075', 'Aroma fuel', '1', '2022-06-06', '0000-00-00 00:00:00', ''),
(2, '1', '1', 'Food', '', '5000', 'Staff food', '1', '2022-06-06', '0000-00-00 00:00:00', ''),
(3, '1', '1', 'Shola transport', '', '3300', 'Transport to Ibadan', '1', '2022-06-06', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file_name` varchar(191) NOT NULL,
  `cash_flow_id` varchar(191) NOT NULL,
  `created_at` date NOT NULL,
  `deleted` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_name`, `cash_flow_id`, `created_at`, `deleted`) VALUES
(1, '037adf9af822f33fc3321a5917a1fb14.png', '1', '2022-06-05', ''),
(2, '809ba2b3070f16ada25efdb3a944f351.png', '1', '2022-06-05', ''),
(3, '7e1cfe4349b42a1991ac828576ab7b85.png', '2', '2022-06-06', ''),
(4, '35147bb8aa0ef8be75ee52e9324efc1e.png', '2', '2022-06-06', ''),
(5, '446566ee86571beac8002b462e086566.png', '2', '2022-06-06', '');

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
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
