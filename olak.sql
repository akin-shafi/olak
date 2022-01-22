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
 `deleted` varchar(50) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `branches` (
 `id` int(11) NOT NULL,
 `company_id` varchar(50) NOT NULL,
 `branch_name` varchar(50) NOT NULL,
 `address` varchar(50) NOT NULL,
 `city` varchar(50) NOT NULL,
 `state` varchar(50) NOT NULL,
 `established_in` varchar(50) NOT NULL,
 `created_at` datetime DEFAULT NULL,
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `companies` (
 `id` int(11) NOT NULL,
 `logo` varchar(50) NOT NULL,
 `company_name` varchar(50) NOT NULL,
 `registration_no` varchar(50) NOT NULL,
 `created_at` datetime DEFAULT NULL,
 `deleted` varchar(50) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `departments` (
 `id` int(11) NOT NULL,
 `department_name` varchar(50) DEFAULT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `designations` (
 `id` int(11) NOT NULL,
 `designation_name` varchar(50) NOT NULL,
 `department_id` int(11) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `employee` (
 `id` int(11) NOT NULL,
 `firstname` varchar(50) NOT NULL,
 `lastname` varchar(50) NOT NULL,
 `othername` varchar(50) NOT NULL,
 `department` varchar(50) NOT NULL,
 `location` varchar(50) NOT NULL,
 `phone` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `marital_status` varchar(50) NOT NULL,
 `dob` varchar(50) NOT NULL,
 `kin_name` varchar(50) NOT NULL,
 `kin_phone` varchar(50) NOT NULL,
 `highest_qualification` varchar(50) NOT NULL,
 `date_employed` varchar(50) NOT NULL,
 `bank_name` varchar(50) NOT NULL,
 `bank_account` varchar(50) NOT NULL,
 `professional_body` varchar(50) NOT NULL,
 `present_salary` varchar(50) NOT NULL,
 `grade_step` varchar(50) NOT NULL,
 `created_at` datetime NOT NULL DEFAULT current_timestamp(),
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `employees` (
 `id` int(11) NOT NULL,
 `company_id` int(11) NOT NULL,
 `employee_id` varchar(5) NOT NULL,
 `father_name` varchar(50) NOT NULL,
 `gender` varchar(20) NOT NULL,
 `hashed_password` varchar(255) NOT NULL,
 `present_add` varchar(255) DEFAULT NULL,
 `permanent_add` varchar(255) NOT NULL,
 `blood_group` varchar(5) NOT NULL,
 `photo` varchar(50) NOT NULL,
 `notification` varchar(5) NOT NULL,
 `created_at` datetime DEFAULT NULL,
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `employee_attendances` (
 `id` int(11) NOT NULL,
 `employee_id` int(11) NOT NULL,
 `clock_in` time NOT NULL DEFAULT current_timestamp(),
 `clock_out` time NOT NULL,
 `note` varchar(255) NOT NULL,
 `created_at` datetime NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `employee_banks` (
 `id` int(11) NOT NULL,
 `employee_id` varchar(5) NOT NULL,
 `account_holder` varchar(50) NOT NULL,
 `account_number` varchar(50) NOT NULL,
 `bank_name` varchar(50) NOT NULL,
 `bank_location` varchar(50) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `employee_companies` (
 `id` int(11) NOT NULL,
 `employee_id` varchar(5) NOT NULL,
 `employee_number` varchar(15) NOT NULL,
 `department_id` varchar(5) NOT NULL,
 `designation_id` varchar(5) NOT NULL,
 `date_employed` varchar(20) NOT NULL,
 `reg_date` varchar(20) NOT NULL,
 `terminate_date` varchar(20) NOT NULL,
 `salary_type` varchar(2) NOT NULL,
 `salary` varchar(20) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
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
 `blood_group` varchar(5) NOT NULL,
 `present_add` varchar(255) NOT NULL,
 `permanent_add` varchar(255) NOT NULL,
 `notification` int(11) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
);


CREATE TABLE `employee_docs` (
 `id` int(11) NOT NULL,
 `employee_id` varchar(5) NOT NULL,
 `cv` varchar(50) NOT NULL,
 `id_card` varchar(50) NOT NULL,
 `offer_letter` varchar(50) NOT NULL,
 `acceptance_letter` varchar(50) NOT NULL,
 `agreement_letter` varchar(50) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
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
 `deleted` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `employee_experience` (
 `id` int(11) NOT NULL,
 `employee_id` int(11) NOT NULL,
 `company_name` varchar(50) NOT NULL,
 `location` varchar(50) NOT NULL,
 `job_position` varchar(50) NOT NULL,
 `period_from` date NOT NULL,
 `period_to` date NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `loans` (
 `id` int(11) NOT NULL,
 `ref_no` varchar(20) NOT NULL,
 `employee_id` int(11) NOT NULL,
 `type` int(11) NOT NULL,
 `amount` int(11) NOT NULL,
 `amount_paid` int(11) NOT NULL,
 `payment_method` int(11) NOT NULL,
 `date_requested` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 `date_issued` varchar(20) DEFAULT NULL,
 `status` int(11) NOT NULL,
 `file_upload` varchar(50) NOT NULL,
 `note` text NOT NULL,
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `payroll_additions` (
 `id` int(11) NOT NULL,
 `name` varchar(50) NOT NULL,
 `value` int(11) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `payroll_deductions` (
 `id` int(11) NOT NULL,
 `name` varchar(50) NOT NULL,
 `value` int(11) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `payroll_overtime` (
 `id` int(11) NOT NULL,
 `name` varchar(50) NOT NULL,
 `value` int(11) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) NOT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `salaries` (
 `id` int(11) NOT NULL,
 `employee_id` int(11) NOT NULL,
 `net_salary` varchar(50) NOT NULL,
 `payment_status` int(11) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `salary_deductions` (
 `id` int(11) NOT NULL,
 `salary_id` int(11) NOT NULL,
 `tax` int(11) NOT NULL,
 `pension` int(11) NOT NULL,
 `others` int(11) NOT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
);
CREATE TABLE `salary_earnings` (
 `id` int(11) NOT NULL,
 `salary_id` int(11) NOT NULL,
 `actual_amount` int(11) DEFAULT NULL,
 `basic_salary` varchar(50) NOT NULL,
 `housing` varchar(50) NOT NULL,
 `dressing` int(11) DEFAULT NULL,
 `transport` varchar(50) NOT NULL,
 `utility` int(11) DEFAULT NULL,
 `others` int(11) DEFAULT NULL,
 `created_at` datetime NOT NULL,
 `deleted` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
);



ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
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
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_additions`
--
ALTER TABLE `payroll_additions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_deductions`
--
ALTER TABLE `payroll_deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_overtime`
--
ALTER TABLE `payroll_overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_deductions`
--
ALTER TABLE `salary_deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_earnings`
--
ALTER TABLE `salary_earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;