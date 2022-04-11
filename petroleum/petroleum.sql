CREATE TABLE `admins` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
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
) 

CREATE TABLE `data_sheet` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `open_stock` varchar(50) NOT NULL,
 `new_stock` varchar(50) NOT NULL,
 `total_stock` varchar(15) NOT NULL,
 `sales` varchar(15) NOT NULL,
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
 `created_at` datetime NOT NULL,
 `updated_at` datetime NOT NULL,
 `deleted` varchar(15) NOT NULL,
 PRIMARY KEY (`id`)
) 