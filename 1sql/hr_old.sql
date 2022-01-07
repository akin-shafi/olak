-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2022 at 05:04 PM
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
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `profile_img`, `hashed_password`, `reset_password`, `admin_level`, `account_status`, `company_id`, `created_at`, `updated_at`, `created_by`, `deleted`) VALUES
(1, 'Admin', 'One', 'admin1@gmail.com', 'user.png', '$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka', '1', NULL, NULL, '1', '2021-12-15 11:25:08', '2021-12-15 12:24:40', '1', '');

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
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `company_id`, `branch_name`, `address`, `city`, `state`, `established_in`, `created_at`, `deleted`) VALUES
(1, '1', 'Ilorin', 'Commodi est consecte', 'Ejura', 'Kwara', '1998-01-03', '2022-01-03 13:03:40', 0);

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
(1, '', 'Olak eatery', '000001', '2022-01-03 15:03:17', '');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `created_at`, `deleted`) VALUES
(1, 'Agric', '2022-01-03 15:52:11', 0);

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
(1, 'Hr', 1, '2022-01-03 17:04:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `marital_status` enum('single','married','divorced') NOT NULL,
  `children` varchar(50) NOT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `photo` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `date_employed` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `department_id`, `designation_id`, `first_name`, `last_name`, `gender`, `phone`, `email`, `hashed_password`, `address`, `country`, `state`, `dob`, `marital_status`, `children`, `religion`, `photo`, `location`, `date_employed`, `created_at`, `deleted`) VALUES
(1, 'HR-00001', 1, 1, 'Tanner', 'Gardner', 'female', '14255547215', 'user@gmail.com', '$2y$10$yOcFjgUCI76zTH3O9rSGTOfOfPn6EMXQobjaA0p2x7/aZ7HvDA/hS', 'Accusantium similiqu', 'Nigeria', 'Lagos', '2000-07-04', 'single', '', '', '1641335241.jpg', '', '2019-11-05', '2022-01-03 18:46:25', 0),
(2, 'Et voluptatem aute d', 1, 1, 'Darius', 'Hardy', 'female', '14255547215', 'jace@mailinator.com', '$2y$10$PFg5DV2gEG2T73jeU7lULeMiGuHeKH5mS1Psz1JAT44ultlR8rmWC', 'Cupiditate explicabos', 'Nigeria', 'Lagos', '1996-10-06', 'married', '3', '', '1641340040.jpg', '', '1982-02-03', '2022-01-05 00:46:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE `employee_details` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `kin_name` varchar(50) NOT NULL,
  `kin_relationship` varchar(20) NOT NULL,
  `kin_phone_1` varchar(20) NOT NULL,
  `kin_phone_2` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `employee_id`, `account_name`, `bank_name`, `account_number`, `kin_name`, `kin_relationship`, `kin_phone_1`, `kin_phone_2`, `created_at`, `deleted`) VALUES
(1, 2, '', '', '', '', '', '', '', '2022-01-05 13:55:36', 0),
(2, 2, 'My name', 'GTBank', '020212512', 'Jane Donaldson', 'brother', '+1 (699) 254-7684', '+1 (691) 634-5985', '2022-01-05 13:55:41', 0);

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

--
-- Dumping data for table `employee_education`
--

INSERT INTO `employee_education` (`id`, `employee_id`, `institution`, `subject`, `start_date`, `complete_date`, `degree`, `grade`, `created_at`, `deleted`) VALUES
(1, 2, 'Federal university of technology, Akure, Ondo State', 'Mechanical Engineering', '2021-12-06', '2022-01-05', '', '', '2022-01-05 20:49:43', 0);

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

--
-- Dumping data for table `employee_experience`
--

INSERT INTO `employee_experience` (`id`, `employee_id`, `company_name`, `location`, `job_position`, `period_from`, `period_to`, `created_at`, `deleted`) VALUES
(1, 2, 'Sandsify', 'Lagos', 'Web developer', '2022-01-04', '2022-01-05', '2022-01-05 20:50:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `net_salary` varchar(50) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `employee_id`, `net_salary`, `payment_status`, `created_at`, `deleted`) VALUES
(1, 1, '15000', 0, '2022-01-04 14:32:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_deductions`
--

CREATE TABLE `salary_deductions` (
  `id` int(11) NOT NULL,
  `salary_id` int(11) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `pension` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary_deductions`
--

INSERT INTO `salary_deductions` (`id`, `salary_id`, `tax`, `pension`, `created_at`, `deleted`) VALUES
(1, 1, '2500', '1500', '2022-01-04 14:32:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_earnings`
--

CREATE TABLE `salary_earnings` (
  `id` int(11) NOT NULL,
  `salary_id` int(11) NOT NULL,
  `basic_salary` varchar(50) NOT NULL,
  `house_rent` varchar(50) NOT NULL,
  `transport` varchar(50) NOT NULL,
  `medical` varchar(50) NOT NULL,
  `furniture` varchar(50) NOT NULL,
  `meal` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary_earnings`
--

INSERT INTO `salary_earnings` (`id`, `salary_id`, `basic_salary`, `house_rent`, `transport`, `medical`, `furniture`, `meal`, `created_at`, `deleted`) VALUES
(1, 1, '10000', '2000', '3000', '1000', '500', '2500', '2022-01-04 14:32:05', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
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
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
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
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_deductions`
--
ALTER TABLE `salary_deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_earnings`
--
ALTER TABLE `salary_earnings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_education`
--
ALTER TABLE `employee_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_experience`
--
ALTER TABLE `employee_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary_deductions`
--
ALTER TABLE `salary_deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary_earnings`
--
ALTER TABLE `salary_earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
