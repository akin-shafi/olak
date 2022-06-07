

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(191) NOT NULL,
  `deleted` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;


INSERT INTO categories VALUES
("1","MOCKTAIL","2021-04-19 11:54:45","",""),
("2","COCKTAIL","2021-04-19 11:57:48","",""),
("3","SHOOTERS","2021-04-19 11:58:14","",""),
("4","SOFT DRINKS","2021-04-19 11:58:30","",""),
("5","ENERGY DRINK","2021-04-19 11:58:56","",""),
("6","BEER","2021-04-19 11:59:06","",""),
("7","SHISHA","2021-04-19 11:59:22","",""),
("8","WHISKEY","2021-04-19 12:00:29","",""),
("9","SINGLE MALT","2021-04-19 12:00:48","",""),
("10","COGNAC","2021-04-19 12:01:09","",""),
("11","VODKA","2021-04-19 12:01:20","",""),
("12","CHAMPAGNE","2021-04-19 12:01:31","",""),
("13","WHITE WINE","2021-04-19 12:01:46","",""),
("14","RESERVE SPECIAL","2021-04-19 12:02:50","",""),
("15","SPARKLING WINE","2021-04-19 12:03:07","",""),
("16","BREAKFAST","2021-04-19 12:07:51","",""),
("17","AFRICAN FOOD","2021-04-19 12:08:59","",""),
("18","AFRICAN MAIN DISH","2021-04-19 12:09:23","",""),
("19","NIGERIAN SOUP","2021-04-19 12:09:47","",""),
("20","AFRICAN COMBO","2021-04-19 12:10:00","",""),
("21","SEAFOOD","2021-04-19 12:10:13","",""),
("22","PASTA","2021-04-19 12:10:23","",""),
("23","SIDE ORDERS","2021-04-19 12:10:42","","");




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




CREATE TABLE `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(50) NOT NULL,
  `product_quantity` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `update_at` varchar(191) NOT NULL,
  `update_by` int(50) NOT NULL,
  `deleted` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


INSERT INTO order_item VALUES
("1","1","2","55000","110000","0","2021-03-03 18:43:30","2","","0",""),
("2","3","1","90000","90000","0","2021-03-03 18:43:30","2","","0",""),
("3","1","2","55000","110000","0","2021-03-03 18:55:57","2","","0",""),
("4","3","1","90000","90000","0","2021-03-03 18:55:57","2","","0",""),
("5","1","1","55000","55000","0","2021-03-03 18:58:07","2","","0",""),
("6","2","1","99.00","99","0","2021-03-03 18:58:07","2","","0",""),
("7","6","3","98.00","294","0","2021-03-03 18:58:07","2","","0",""),
("8","9","1","250","250","0","2021-03-03 18:58:32","2","","0","");




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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;


INSERT INTO products VALUES
("1","","12125019","3","CHAPMAN","Product","1","0","12","7.5","1","0","900","1000","","","0","","75","1000","","0000-00-00 00:00:00","2021-04-19 12:13:44","0","0"),
("2","","12572655","3","VIRGIN COLADA","Product","1","0","12","7.5","1","0","","1500","","","0","","0","1500","","0000-00-00 00:00:00","2021-04-19 12:58:27","0","0"),
("3","","12593256","3","VIRGIN DALQUIRI","Product","1","0","12","7.5","1","0","","1500","","","0","","0","1500","","0000-00-00 00:00:00","2021-04-19 13:00:12","0","0"),
("4","","13002986","3","FRUIT COCKTAIL","Product","1","0","12","7.5","1","0","","1500","","","0","","0","1500","","0000-00-00 00:00:00","2021-04-19 13:00:52","0","0"),
("5","","13011079","3","STRAWBERRY BULL","Product","1","0","12","7.5","1","0","","1500","","","0","","0","1500","","0000-00-00 00:00:00","2021-04-19 13:01:35","0","0"),
("6","","13020438","3","LEMONADE","Product","1","0","12","7.5","1","0","","1500","","","0","","0","1500","","0000-00-00 00:00:00","2021-04-19 13:02:26","0","0"),
("7","","13025337","3","VRIGIN MAI TAI","Product","1","0","12","7.5","1","0","","1500","","","0","","0","1500","","0000-00-00 00:00:00","2021-04-19 13:03:10","0","0"),
("8","","13034752","3","PINA COLADA","Product","2","0","12","7.5","1","0","","3000","","","0","","0","3000","","0000-00-00 00:00:00","2021-04-19 13:04:12","0","0"),
("9","","13050987","3","MARGARITA","Product","2","0","12","7.5","1","0","","3000","","","0","","0","3000","","0000-00-00 00:00:00","2021-04-19 13:05:32","0","0"),
("10","","13064422","3","LONG ISLAND TEA ","Product","2","0","12","7.5","1","0","","2800","","","0","","0","2800","","0000-00-00 00:00:00","2021-04-19 13:07:01","0","0"),
("11","","13072858","3","BLUE LAGOON ","Product","2","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:08:24","0","0"),
("12","","13090544","3","WHISKEY SOUR ","Product","2","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:09:35","0","0"),
("13","","13100614","3","STRAWBERRY DAIQUIRI ","Product","2","0","12","7.5","1","0","","2800","","","0","","0","2800","","0000-00-00 00:00:00","2021-04-19 13:10:39","0","0"),
("14","","13111024","3","TEQUILA SUNRISE ","Product","2","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:11:37","0","0"),
("15","","13121715","3","CLASSIC MOJITO ","Product","2","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:12:38","0","0"),
("16","","13131440","3","FLAVOURED MOJITO ","Product","2","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:13:46","0","0"),
("17","","13142565","3","COSMOPOLITAN","Product","2","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:14:47","0","0"),
("18","","13152227","3","MAI TAI ","Product","2","0","12","7.5","1","0","","2800","","","0","","0","2800","","0000-00-00 00:00:00","2021-04-19 13:15:53","0","0"),
("19","","13162994","3","TOM COLLINS","Product","2","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:16:56","0","0"),
("20","","13173072","3","SEX ON THE BEACH ","Product","2","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:17:53","0","0"),
("21","","13182623","3","AMBIANCEâ€™S LAS MAN","Product","2","0","12","7.5","1","0","","3500","","","0","","0","3500","","0000-00-00 00:00:00","2021-04-19 13:18:45","0","0"),
("22","","13192510","3","OLD FASHION ","Product","2","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:19:51","0","0"),
("23","","13204272","3","B 52","Product","3","0","12","7.5","1","0","","2800","","","0","","0","2800","","0000-00-00 00:00:00","2021-04-19 13:21:18","0","0"),
("24","","13215749","3","BRAIN DAMAGED","Product","3","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:22:23","0","0"),
("25","","13225659","3","MIMOSA","Product","3","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:23:30","0","0"),
("26","","13243379","3","MING FLAMING LAMBORGIHINI","Product","3","0","12","7.5","1","0","","2500","","","0","","0","2500","","0000-00-00 00:00:00","2021-04-19 13:25:18","0","0"),
("27","","13283441","3","WATER","Product","4","0","12","7.5","1","0","","300","","","0","","0","300","","0000-00-00 00:00:00","2021-04-19 13:29:02","0","0"),
("28","","13294443","3","COKE, SPRITE","Product","4","0","12","7.5","1","0","","500","","","0","","0","500","","0000-00-00 00:00:00","2021-04-19 13:30:16","0","0"),
("29","","13312524","3","MALTINA","Product","4","0","12","7.5","1","0","","500","","","0","","0","500","","0000-00-00 00:00:00","2021-04-19 13:31:49","0","0"),
("30","","13321454","3","JUICE","Product","4","0","12","7.5","1","0","","500","","","0","","0","500","","0000-00-00 00:00:00","2021-04-19 13:32:46","0","0"),
("31","","13331160","3","JUICE PITCHER ","Product","4","0","12","7.5","1","0","","2000","","","0","","0","2000","","0000-00-00 00:00:00","2021-04-19 13:33:37","0","0"),
("32","","133409100","3","CRANBERRY PITCHER ","Product","4","0","12","7.5","1","0","","3000","","","0","","0","3000","","0000-00-00 00:00:00","2021-04-19 13:34:29","0","0"),
("33","","13354437","3","POWER HORSE, RED BULL","Product","5","0","12","7.5","1","0","","1000","","","0","","0","1000","","0000-00-00 00:00:00","2021-04-19 13:36:23","0","0"),
("34","","13370238","3","HEINEKEN ","Product","6","0","12","7.5","1","0","","700","","","0","","0","700","","0000-00-00 00:00:00","2021-04-19 13:37:23","0","0"),
("35","","13375444","3","BUDWEISER","Product","6","0","12","7.5","1","0","","700","","","0","","0","700","","0000-00-00 00:00:00","2021-04-19 13:38:47","0","0"),
("36","","13413884","3","STAR","Product","6","0","12","7.5","1","0","","500","","","0","","0","500","","0000-00-00 00:00:00","2021-04-19 13:41:57","0","0"),
("37","","13425187","3","GUILDER","Product","6","0","12","7.5","1","0","","500","","","0","","0","500","","0000-00-00 00:00:00","2021-04-19 13:43:01","0","0"),
("38","","13433036","3","TROPHY ","Product","6","0","12","7.5","1","0","","500","","","0","","0","500","","0000-00-00 00:00:00","2021-04-19 13:43:46","0","0"),
("39","","13442635","3","TROPHY STOUT","Product","6","0","12","7.5","1","0","","500","","","0","","0","500","","0000-00-00 00:00:00","2021-04-19 13:44:58","0","0"),
("40","","13452723","3","GOLDBERGER ","Product","6","0","12","7.5","1","0","","500","","","0","","0","500","","0000-00-00 00:00:00","2021-04-19 13:45:44","0","0"),
("41","","13465124","3","GUINESS MEDIUM STOUT ","Product","6","0","12","7.5","1","0","","500","","","0","","0","500","","0000-00-00 00:00:00","2021-04-19 13:47:20","0","0"),
("42","","13481095","3"," GUINESS BIG STOUT","Product","6","0","12","7.5","1","0","","700","","","0","","0","700","","0000-00-00 00:00:00","2021-04-19 13:48:38","0","0"),
("43","","13490388","3","ORIGIN ","Product","6","0","12","7.5","1","0","","700","","","0","","0","700","","0000-00-00 00:00:00","2021-04-19 13:49:27","0","0"),
("44","","13500651","3","HEINEKEN DRAUGHT 50CL ","Product","6","0","12","7.5","1","0","","1000","","","0","","0","1000","","0000-00-00 00:00:00","2021-04-19 13:50:31","0","0"),
("45","","13510938","3","EINEKEN HEINEKEN DRAUGHT DRAUGHT 35CL","Product","6","0","12","7.5","1","0","","800","","","0","","0","800","","0000-00-00 00:00:00","2021-04-19 13:51:29","0","0"),
("46","","13520235","3","NOFF SMIRNOFF ICE ","Product","6","0","12","7.5","1","0","","600","","","0","","0","600","","0000-00-00 00:00:00","2021-04-19 13:52:36","0","0"),
("47","","135318100","3","SHISHA","Product","7","0","12","7.5","1","0","","5000","","","0","","0","5000","","0000-00-00 00:00:00","2021-04-19 13:53:51","0","0"),
("48","","13544272","3","BLACK LABEL","Product","8","0","12","7.5","1","0","","15000","700","","0","","0","15000","","0000-00-00 00:00:00","2021-04-19 13:55:53","0","0"),
("49","","13562369","3","GOLD LABEL","Product","8","0","12","7.5","1","0","","35000 ","1100","","0","","0","35000 ","","0000-00-00 00:00:00","2021-04-19 13:57:33","0","0"),
("50","","13581132","3","BLUE LABEL","Product","8","0","12","7.5","1","0","","90000","","","0","","0","90000","","0000-00-00 00:00:00","2021-04-19 13:59:04","0","0"),
("51","","13593260","3","CHIVAS REGAL ","Product","8","0","12","7.5","1","0","","30000","1200","","0","","0","30000","","0000-00-00 00:00:00","2021-04-19 14:00:17","0","0"),
("52","","14004441","3","JACK DANIELS ","Product","8","0","12","7.5","1","0","","15000","","","0","","0","15000","","0000-00-00 00:00:00","2021-04-19 14:01:23","0","0"),
("53","","14034452","3","JAMESON","Product","8","0","12","7.5","1","0","","15000","","","0","","0","15000","","0000-00-00 00:00:00","2021-04-19 14:04:21","0","0"),
("54","","14045620","3","GLENFIDDICH 12 YEARS ","Product","9","0","12","7.5","1","0","","18000","800","","0","","0","18000","","0000-00-00 00:00:00","2021-04-19 14:06:09","0","0"),
("55","","14065722","3","GLENFIDDICH 15 YEARS ","Product","9","0","12","7.5","1","0","","25000","1100","","0","","0","25000","","0000-00-00 00:00:00","2021-04-19 14:07:44","0","0"),
("56","","14083053","3","GLENFIDDICH 18 YEARS","Product","9","0","12","7.5","1","0","","35000 ","1400","","0","","0","35000 ","","0000-00-00 00:00:00","2021-04-19 14:09:31","0","0"),
("57","","14102084","3","GLEMORANGIE 12 YEARS","Product","9","0","12","7.5","1","0","","18000","800","","","","0","","","0000-00-00 00:00:00","2021-04-19 14:12:22","0","0"),
("58","","14150123","3","HENNESSY XO ","Product","10","0","12","7.5","1","0","","150000","","","0","","0","150000","","0000-00-00 00:00:00","2021-04-19 14:15:53","0","0"),
("59","","14164889","3","150000","Product","10","0","12","7.5","1","0","","50000","2000","","0","","0","50000","","0000-00-00 00:00:00","2021-04-19 14:17:59","0","0"),
("60","","14184236","3","HENNESSY VS","Product","10","0","12","7.5","1","0","","35000","1400","","0","","0","35000","","0000-00-00 00:00:00","2021-04-19 14:19:45","0","0"),
("61","","14201875","3","HENNESSY 35 CL","Product","10","0","12","7.5","1","0","","15000","1100","","0","","0","15000","","0000-00-00 00:00:00","2021-04-19 14:21:13","0","0"),
("62","","14214970","3","REMY MARTINS XO ","Product","10","0","12","7.5","1","0","","140000","","","0","","0","140000","","0000-00-00 00:00:00","2021-04-19 14:22:28","0","0"),
("63","","14231716","3","REMY MARTINS VSOP","Product","10","0","12","7.5","1","0","","35000","","","0","","0","35000","","0000-00-00 00:00:00","2021-04-19 14:23:52","0","0"),
("64","","14242961","3","REMY MARTINS 1738","Product","10","0","12","7.5","1","0","","40000","","","0","","0","40000","","0000-00-00 00:00:00","2021-04-19 14:29:51","0","0"),
("65","","14301872","3","MARTEL XO ","Product","10","0","12","7.5","1","0","","140000","","","0","","0","140000","","0000-00-00 00:00:00","2021-04-19 14:31:24","0","0"),
("66","","14315028","3","MARTEL BLUESWIFT ","Product","11","0","12","7.5","1","0","","40000 ","","","0","","0","40000 ","","0000-00-00 00:00:00","2021-04-19 14:32:21","0","0"),
("67","","14354265","3","sky","Product","11","0","12","7.5","1","0","","16000 ","700","","0","","0","16000 ","","0000-00-00 00:00:00","2021-04-19 14:36:14","0","0"),
("68","","14372357","3","SKY FLAVOURED","Product","11","0","12","7.5","1","0","","18000","1100","","0","","0","18000","","0000-00-00 00:00:00","2021-04-19 14:38:04","0","0"),
("69","","14385672","3","CIROC ","Product","11","0","12","7.5","1","0","","28000 ","1000","","0","","0","28000 ","","0000-00-00 00:00:00","2021-04-19 14:39:40","0","0"),
("70","","14400468","3","CIROC FLAVOURED","Product","11","0","12","7.5","1","0","","30000","1200","","0","","0","30000","","0000-00-00 00:00:00","2021-04-19 14:40:35","0","0"),
("71","","14412464","3","ABSOLUTE BLUE","Product","11","0","12","7.5","1","0","","12000 ","","","0","","0","12000 ","","0000-00-00 00:00:00","2021-04-19 14:41:58","0","0"),
("72","","14435668","3","ABSOLUTE EXTRACT","Product","11","0","12","7.5","1","0","","12000 ","","","0","","0","12000 ","","0000-00-00 00:00:00","2021-04-19 14:44:46","0","0"),
("73","","14451319","3","SMIRNOFF VODKA ","Product","11","0","12","7.5","1","0","","15000","","","0","","0","15000","","0000-00-00 00:00:00","2021-04-19 14:46:15","0","0"),
("74","","14470347","3","MOET ROSE","Product","12","0","12","7.5","1","0","","60000","","","0","","0","60000","","0000-00-00 00:00:00","2021-04-19 14:47:26","0","0"),
("75","","14480486","3","MOET BRUT","Product","12","0","12","7.5","1","0","","40000 ","","","0","","0","40000 ","","0000-00-00 00:00:00","2021-04-19 14:48:36","0","0"),
("76","","14490612","3","MOET ICE","Product","12","0","12","7.5","1","0","","70000","","","0","","0","70000","","0000-00-00 00:00:00","2021-04-19 14:49:39","0","0");




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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;


INSERT INTO register VALUES
("1","20000","26000","26000","0","0","0","0","0","0","0","0","0","46000","26000","","1","","2021-01-22 15:17:32","2021-01-23 15:47:21","2","0"),
("2","60000","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","","2021-01-23 13:16:48","2021-01-23 07:48:56","1","0"),
("3","20000","0","31000","0","0","0","11000","1","1","0","0","0","20000","11000","","1","","2021-01-23 17:25:08","2021-01-24 07:48:56","2","0"),
("4","1000","30000","41000","0","0","0","0","0","0","10000","0","0","31000","40000","","1","","2021-01-24 07:43:49","2021-01-25 06:13:17","2","0"),
("5","60000","502250","562250","0","0","0","0","0","0","0","0","0","562250","502250","","1","","2021-01-25 06:13:36","2021-01-26 06:25:26","2","0"),
("6","0","1500","1500","0","0","0","0","0","0","0","0","0","1500","1500","","0","","2021-01-26 06:30:41","2021-01-27 07:54:47","2","0"),
("7","40000","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","","2021-01-27 07:54:56","2021-01-27 23:05:00","2","0"),
("8","0","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","0","2021-01-28 07:05:00","2021-01-28 23:05:00","2","0"),
("9","1000","0","1000","0","0","0","0","0","0","0","0","0","1000","0","","0","","2021-01-29 18:37:59","2021-01-30 11:05:40","2","0"),
("10","0","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","","2021-03-03 17:18:34","","2","0"),
("11","0","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","","2021-04-07 15:22:25","","2","0"),
("12","0","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","","2021-04-09 08:40:30","2021-04-10 10:40:52","2","0"),
("13","0","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","","2021-04-10 10:41:08","","2","0"),
("14","0","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","0","2021-04-14 21:36:51","","2","0"),
("15","0","0","0","0","0","0","0","0","0","0","0","0","0","0","","0","0","2021-04-19 06:43:57","","2","0");




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

