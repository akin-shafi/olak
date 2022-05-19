

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(191) NOT NULL,
  `deleted` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


INSERT INTO categories VALUES
("1","Alcoholic Wine","2020-12-25 21:14:13","",""),
("2","Non Alcoholic Wine","2020-12-25 21:14:17","",""),
("3","Beer","2020-12-25 21:14:20","",""),
("4","Soft Drink","2020-12-25 21:14:24","",""),
("5","Juice","2020-12-25 21:14:27","",""),
("6","Water","2020-12-25 21:14:30","",""),
("7","vodka","2021-01-27 08:52:43","","");




CREATE TABLE `company_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `acct_no` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO company_details VALUES
("1","D\'Prime","","28B Adebayo Doherty Road, Lekki phase1","","","","","","+234 812 085 7267","","","","","","","");




CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `shop_address` text NOT NULL,
  `home_address` text NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `customer_type` int(11) DEFAULT NULL,
  `active` varchar(50) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;


INSERT INTO customers VALUES
("1","Shafi","Akinropo","Obate iwo osun state","08145360866","sakinropo@gmail.com","","","$2y$10$OHAZN0zaeIUTFqwn/5iVZeh6AekxB7YPITI8sgBnJFmNmlS1EQSti","1","1","2020-07-10 13:07:52","0000-00-00 00:00:00","2","0"),
("2","Adekunle","Ajanlekoko","Ajegunle Lagos","09104397066","adeyemo_kunle@yahoo.com","","","$2y$10$JRcNmG/HGSJ0dkhDl9SDrugVMLaCvC39VytLl.4nqlcHc4x2nHeNq","1","1","2020-07-16 23:13:54","0000-00-00 00:00:00","2","0"),
("3","Sunny ","omobolanle","52 tafa balewa cresent off adeniran ogunsanya road, Surulere, Lagos","08027183668","ashabiomobolanle@gmail.com","","","$2y$10$H3kdgFkml3sIFXksDPHvdu9NyMf5zdGr3Ko4xcpHHahnogmcMaBTG","1","0","2020-07-17 10:43:40","0000-00-00 00:00:00","2","0"),
("24","Alade","Thomos","","08024536942","","Obate iwo osun state","","$2y$10$MnEy9HmCugm.DKW9P6KSf.ou1K570SRDWqrtt/DpyRQIv1MKnPnA.","0","0","2020-11-22 12:54:26","0000-00-00 00:00:00","0","0"),
("25","Biliaminu","Bello","","08023514028","","Hosue 15, shope 10 frances mba","","$2y$10$u0aK9IsuolGd39kVJrHGIeLz27wrYzEP29GDB2NRU8P.FLVfFYvpW","0","0","2020-11-22 12:55:45","0000-00-00 00:00:00","0","0"),
("26","Biliki","Bello","","08145360867","","Obate iwo osun state","","$2y$10$MVPcIoGq2g1/IPTwqSHPfOkVkQzTDHZOnRSS9HcZEao7T.jcQPrrm","0","0","2020-11-22 12:57:18","0000-00-00 00:00:00","0","0"),
("27","folusho","Awolere","","08176542356","","oke mada","","$2y$10$hP0E0frklZRClIeVSqFOOOj4/8Wkp1Uq58PZ9UlWL6XYjXNod5Q5q","0","0","2020-11-22 13:02:48","0000-00-00 00:00:00","0","0"),
("28","Peace","Abc","","08098374683","","","","$2y$10$VoJeWInRB/O3XPkPT7QJZ.6233RWwsnC6XoV8rqKAsHsvH1BT88tq","0","0","2021-01-25 20:20:39","0000-00-00 00:00:00","0","0");




CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL,
  `item` varchar(191) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `attached` text NOT NULL,
  `amount` varchar(191) NOT NULL,
  `note` text NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


INSERT INTO expenses VALUES
("1","2021-01-27 07:04","","","","32000","Biro","2021-01-27 07:05:06","2","0"),
("2","2021-01-27 07:10","Biro","","","1000","","2021-01-27 07:10:43","2","0"),
("3","2021-01-27 07:34","Biro","","","1000","","2021-01-27 07:34:44","2","0"),
("4","2021-01-27 07:34","Biro","100412","","1000","My biro","2021-01-27 07:35:16","1","0");




CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;


INSERT INTO products VALUES
("1","18112020202154new-hall-bacchus.jpg","vvxd","3","New hall bacchus","Product","1","78","12","7.5","2","0","50000","55000","5000","20","20","20","4125","59125","Powerfull","2020-11-13 04:24:33","2020-11-01 03:06:03","3","0"),
("2","18112020202100fanta.jpg","vvxr","3","fanta","Product","4","85","12","0","1","0","90.00","99.00","","","","","","99.00","Soft drink","2020-11-13 09:12:07","2020-11-13 03:09:00","3","0"),
("3","18112020201918foxon-park.jpg","Vxdd","3","foxon park","Product","1","26","12","7.5","2","0","80000","90000","6000","3","","","7.5","96750","Alcoholic","0000-00-00 00:00:00","2020-11-13 15:33:00","3","0"),
("4","18112020201759jacques-champagne.jpg","Vxdy","3","Jacques champagne","Product","1","7","2","7.5","1","0","160000","180000","10000","30","8","26","13500","180000","Not to be sold for person(s) under 18 year old","0000-00-00 00:00:00","2020-11-13 17:53:40","3","0"),
("5","18112020143819corona-cereza.jpg","54491069","3","Corona Cereza","Product","1","21","12","7.5","2","1","80000","90000","5000","1","","1","6750","96750","","0000-00-00 00:00:00","2020-11-13 20:56:17","3","0"),
("6","13112020205938Sprite-Zero-PET.jpg","54491063","3","Sprite","Product","4","31","12","0","1","0","90.00","98.00","","12","","","","98.00","","0000-00-00 00:00:00","2020-11-13 20:59:38","3","0"),
("7","18112020151658coca-cola.jpg","54491068","3","coca-cola","Product","4","10","12","0","1","0","90.00","98.00","","20","","","","98.00","Soft drink","0000-00-00 00:00:00","2020-11-13 21:12:16","3","0"),
("8","15122020165206eva.jpg","16464151","3","Eva Water","Product","6","360","12","0","0","0","90","100","","13","","","","100","","0000-00-00 00:00:00","2020-12-15 16:49:25","1","0"),
("9","15122020165634five.jpg","16553240","3","5alive","Product","5","349","12","0","1","0","230","250","","11","","","","250","","0000-00-00 00:00:00","2020-12-15 16:56:34","1","0"),
("10","15122020173720eva-wine.jpg","17364230","3","Eva wine","Product","2","359","12","7.5","2","0","11000","13000","1000","10","","","975","13975","","0000-00-00 00:00:00","2020-12-15 17:37:20","1","0"),
("11","","06210062","3","Tequila","Product","1","24","12","7.5","1","0","12000","15000","1500","10","24","2","0","15000","","0000-00-00 00:00:00","2021-01-25 06:23:29","0","0");




CREATE TABLE `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cash_in_hand` varchar(191) NOT NULL,
  `cash_sales` varchar(191) NOT NULL,
  `total_cash_submitted` varchar(191) NOT NULL,
  `cheque_sales` varchar(191) NOT NULL,
  `no_of_cheque` varchar(191) NOT NULL,
  `total_cheques_submitted` varchar(191) NOT NULL,
  `credit_card_sales` varchar(191) NOT NULL,
  `no_cc_slips` varchar(191) NOT NULL,
  `total_cc_slips_submitted` varchar(191) NOT NULL,
  `bank_transfer_sales` varchar(191) NOT NULL,
  `gift_card_sales` varchar(191) NOT NULL,
  `others` varchar(191) NOT NULL,
  `total_cash` varchar(191) NOT NULL,
  `total` varchar(191) NOT NULL,
  `note` text NOT NULL,
  `verfication_status` varchar(191) NOT NULL DEFAULT '0',
  `expenses` varchar(191) NOT NULL,
  `open_time` datetime NOT NULL,
  `close_time` varchar(191) NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;


INSERT INTO register VALUES
("1","20000","26000","26000","0","0","0","0","0","0","0","0","0","46000","26000","","1","","2021-01-22 15:17:32","2021-01-23 15:47:21","2","0"),
("2","60000","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","","2021-01-23 13:16:48","","1","0"),
("3","20000","0","31000","0","0","0","11000","1","1","0","0","0","20000","11000","","1","","2021-01-23 17:25:08","2021-01-24 07:48:56","2","0"),
("4","1000","30000","41000","0","0","0","0","0","0","10000","0","0","31000","40000","","1","","2021-01-24 07:43:49","2021-01-25 06:13:17","2","0"),
("5","60000","502250","562250","0","0","0","0","0","0","0","0","0","562250","502250","","1","","2021-01-25 06:13:36","2021-01-26 06:25:26","2","0"),
("6","0","1500","1500","0","0","0","0","0","0","0","0","0","1500","1500","","0","","2021-01-26 06:30:41","2021-01-27 07:54:47","2","0"),
("7","40000","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","","2021-01-27 07:54:56","","2","0");




CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_no` varchar(100) NOT NULL,
  `product_id` varchar(90) NOT NULL,
  `product_quantity` varchar(90) NOT NULL,
  `unit_price` varchar(100) NOT NULL COMMENT 'This is the unit price sold per bottle or per shut',
  `subtotal` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `returned` varchar(50) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;


INSERT INTO sales VALUES
("1","100153","5","1","5000","5000","2","2021-01-22 16:35:49","","2021-01-22 16:35:49","","0"),
("2","100153","4","1","10000","10000","2","2021-01-22 16:35:49","","2021-01-22 16:35:49","","0"),
("3","100153","3","1","6000","6000","2","2021-01-22 16:35:49","","2021-01-22 16:35:49","","0"),
("4","100153","1","1","5000","5000","2","2021-01-22 16:35:49","","2021-01-22 16:35:49","","0"),
("5","100236","1","1","5000","5000","2","2021-01-23 21:46:20","","2021-01-23 21:46:20","","0"),
("6","100236","3","1","6000","6000","2","2021-01-23 21:46:20","","2021-01-23 21:46:20","","0"),
("7","100335","4","3","10000","30000","2","2021-01-24 22:58:49","","2021-01-24 22:58:49","","0"),
("8","100424","1","2","5000","10000","2","2021-01-24 23:33:54","","2021-01-24 23:33:54","","0"),
("9","100573","11","2","1500","3000","2","2021-01-25 11:00:01","","2021-01-25 11:00:01","","0"),
("10","100668","11","1","1500","1500","2","2021-01-25 11:09:11","","2021-01-25 11:09:11","","0"),
("11","100744","11","1","1500","1500","2","2021-01-25 11:10:34","","2021-01-25 11:10:34","","0"),
("12","100832","11","1","1500","1500","2","2021-01-25 11:11:45","","2021-01-25 11:11:45","","0"),
("13","100954","11","1","1500","1500","2","2021-01-25 11:25:43","","2021-01-25 11:25:43","","0"),
("14","101035","11","1","1500","1500","2","2021-01-25 11:27:30","","2021-01-25 11:27:30","","0"),
("15","101120","1","1","59125","59125","2","2021-01-25 20:57:38","","2021-01-25 20:57:38","","0"),
("16","101120","3","1","96750","96750","2","2021-01-25 20:57:38","","2021-01-25 20:57:38","","0"),
("17","101243","1","1","59125","59125","2","2021-01-25 20:59:02","","2021-01-25 20:59:02","","0"),
("18","101243","3","1","96750","96750","2","2021-01-25 20:59:02","","2021-01-25 20:59:02","","0"),
("19","101243","4","1","180000","180000","2","2021-01-25 20:59:02","","2021-01-25 20:59:02","","0"),
("20","101311","11","1","1500","1500","2","2021-01-26 06:41:00","","2021-01-26 06:41:00","","0"),
("21","101480","5","1","5000","5000","2","2021-01-27 07:58:30","","2021-01-27 07:58:30","","0"),
("22","101480","4","1","10000","10000","2","2021-01-27 07:58:30","","2021-01-27 07:58:30","","0");




CREATE TABLE `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;


INSERT INTO store VALUES
("1","D\'Prime","wine store","wine_store.jpg","2020-12-23 19:58:04","1","0"),
("2","D\'Prime","lounge","lounge.jpg","2020-12-24 11:52:38","1","0");




CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) DEFAULT NULL,
  `company_phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company_address` varchar(255) DEFAULT NULL,
  `contact_person` varchar(20) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `supplier_type` int(11) DEFAULT NULL,
  `active` varchar(50) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;


INSERT INTO suppliers VALUES
("1","Landmark Polytechnic","08145360866","bursary.landmarkpolytechnic@gmail.com","Ayetoro/Itele Ayobo","Landmark Polytechnic","08098290445","$2y$10$GbxI6968HHIcqy9mjzzG9uGQhadw/LHZfHwj8KtWM3j0tlL/aMmr.","","0","2020-12-08 17:03:29","0000-00-00 00:00:00","0","0"),
("2","Landmark Polytechnic","08145360866","bursary.landmarkpolytechnic@gmail.com","Ayetoro/Itele Ayobo","Adekunle James","08098290445","$2y$10$O9C8pT8VL0jhrruX2qxCr.rLlXwbNi.x4fwqzkzfL6efR1CaKqJRi","","0","2020-12-08 17:03:50","0000-00-00 00:00:00","0","0");




CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` varchar(50) NOT NULL,
  `customer_id` varchar(150) NOT NULL,
  `trans_no` varchar(100) NOT NULL,
  `total_item` varchar(150) NOT NULL,
  `quantity_in_item` varchar(150) NOT NULL,
  `cost_of_item` varchar(150) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `total_paid` varchar(150) NOT NULL,
  `balance` varchar(150) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `payment_note` text NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `verification_status` varchar(100) NOT NULL,
  `verified_by` varchar(100) NOT NULL,
  `verified_at` datetime NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;


INSERT INTO transaction VALUES
("1","2","0","100153","4","4","26000","0","0","26000","0","cash","","","2","2021-01-22 16:35:49","1","2","2021-01-23 11:47:30","0"),
("2","2","0","100236","2","2","11000","0","0","11000","0","credit_card","","","2","2021-01-23 21:46:20","1","2","2021-01-25 07:08:29","0"),
("3","2","0","100335","1","3","30000","0","0","30000","0","cash","","","2","2021-01-24 22:58:48","1","2","2021-01-25 07:08:33","0"),
("4","2","0","100424","1","2","10000","0","0","10000","0","transfer","","","2","2021-01-24 23:33:54","1","2","2021-01-25 07:09:03","0"),
("5","2","","100573","1","2","3000","0","0","3000","0","cash","","","2","2021-01-25 11:00:00","1","1","2021-01-26 06:35:41","0"),
("6","2","","100668","1","1","1500","0","0","1500","0","cash","","","2","2021-01-25 11:09:10","0","0","0000-00-00 00:00:00","0"),
("7","2","","100744","1","1","1500","0","0","1500","0","cash","","","2","2021-01-25 11:10:34","0","0","0000-00-00 00:00:00","0"),
("8","2","","100832","1","1","1500","0","0","1500","0","cash","","","2","2021-01-25 11:11:44","0","0","0000-00-00 00:00:00","0"),
("9","2","","100954","1","1","1500","0","0","1500","0","cash","","","2","2021-01-25 11:25:43","0","0","0000-00-00 00:00:00","0"),
("10","2","","101035","1","1","1500","0","0","1500","0","cash","","","2","2021-01-25 11:27:30","0","0","0000-00-00 00:00:00","0"),
("11","1","0","101120","2","2","155875","0","0","155875","0","cash","","","2","2021-01-25 20:57:38","0","0","0000-00-00 00:00:00","0"),
("12","1","0","101243","3","3","335875","0","0","335875","0","cash","","","2","2021-01-25 20:59:02","0","0","0000-00-00 00:00:00","0"),
("13","2","0","101311","1","1","1500","0","0","1500","0","cash","","","2","2021-01-26 06:41:00","0","0","0000-00-00 00:00:00","0"),
("14","2","0","101480","2","2","15000","0","0","15000","0","cash","","","2","2021-01-27 07:58:30","1","2","2021-01-27 08:06:44","0");




CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_no` varchar(50) DEFAULT NULL,
  `ref_no` varchar(100) NOT NULL,
  `total_paid` varchar(50) DEFAULT NULL,
  `outstanding` varchar(255) DEFAULT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  `note` text NOT NULL,
  `payment_note` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `paid_at` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;


INSERT INTO transaction_details VALUES
("1","100153","Ref101177","26000","0","cash","","","2","2021-01-22 16:35:49","2021-01-22 16:35:49","0"),
("2","100236","Ref10252","11000","0","credit_card","","","2","2021-01-23 21:46:20","2021-01-23 21:46:20","0"),
("3","100335","Ref103124","30000","0","cash","","","2","2021-01-24 22:58:48","2021-01-24 22:58:48","0"),
("4","100424","Ref10425","10000","0","transfer","","","2","2021-01-24 23:33:54","2021-01-24 23:33:54","0"),
("5","100573","Ref105182","3000","0","cash","","","2","2021-01-25 11:00:00","2021-01-25 11:00:00","0"),
("6","100668","Ref106191","1500","0","cash","","","2","2021-01-25 11:09:11","2021-01-25 11:09:11","0"),
("7","100744","Ref10781","1500","0","cash","","","2","2021-01-25 11:10:34","2021-01-25 11:10:34","0"),
("8","100832","Ref108183","1500","0","cash","","","2","2021-01-25 11:11:45","2021-01-25 11:11:45","0"),
("9","100954","Ref109105","1500","0","cash","","","2","2021-01-25 11:25:43","2021-01-25 11:25:43","0"),
("10","101035","Ref11069","1500","0","cash","","","2","2021-01-25 11:27:30","2021-01-25 11:27:30","0"),
("11","101120","Ref111101","155875","0","cash","","","2","2021-01-25 20:57:38","2021-01-25 20:57:38","0"),
("12","101243","Ref112176","335875","0","cash","","","2","2021-01-25 20:59:02","2021-01-25 20:59:02","0"),
("13","101311","Ref113193","1500","0","cash","","","2","2021-01-26 06:41:00","2021-01-26 06:41:00","0"),
("14","101480","Ref11472","15000","0","cash","","","2","2021-01-27 07:58:30","2021-01-27 07:58:30","0");




CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `profile_img` varchar(191) NOT NULL,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `admin_level` varchar(255) NOT NULL,
  `account_status` varchar(191) NOT NULL,
  `store_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;


INSERT INTO users VALUES
("1","Admin","One","","08098290445","admin1@gmail.com","1","pic1.jpg","admin","$2y$10$df9kgE/lDm/j3TyklJyoguf5w0MTfZE8tpJqs1EUINLn7XqZYptka","1","1","","2020-02-10 23:08:09","0000-00-00 00:00:00","1","0"),
("2","Shafi","Akinropo","","08145360866","sales@gmail.com","male","user1.png","sales","$2y$10$dmckDrf5uEAFKOPt5c2vXOUhW3oUGJdRXeSVvr49/kpMexpjjKnTS","4","1","","2020-11-28 08:26:37","2020-11-28 08:26:37","1","0"),
("3","Ade","bola","","+2348098290446","sandsify@gmail.com","male","user2.png","ade","$2y$10$BIwHlz.L4knr6j0BLfQ2neFpwvckOyWkvzE/R.6KgImN0iofZqMRm","3","1","1","2020-11-28 08:28:33","2020-11-28 08:28:33","1","0"),
("4","shade","blade","","+2348145360866","inspector@gmail.com","female","user1.png","shade","$2y$10$J/VIM3faXMXUexw8nzM9Bei41Fh6u94UKBqMb1JeU.xH/WXA6gLrW","5","1","1","2020-11-30 06:51:07","2020-11-30 06:51:07","1","0"),
("5","Nkem","cyntia","","08145360867","cyntia@gmail.com","female","user2.png","cyntia","$2y$10$FO2qFLEc.ckkXrDnzbvif.WBhqGfFBWjDy42HvxyrosfZWbjH/1Qq","4","1","1","2020-11-30 17:04:49","2020-11-30 17:04:49","1","0");


