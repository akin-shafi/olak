<?php

// Keep database credentials in a separate file
// 1. Easy to exclude this file from source code managers
// 2. Unique credentials on development and production servers
// 3. Unique credentials if working with multiple developers


// define("DB_SERVER", "localhost");
// define("DB_USER", "hoteliap_ambiance_user");
// define("DB_PASS", "Akinshafi@91");
// define("DB_NAME", "hoteliap_restaurant");

if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '192.168.64.2') {
	define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "olak_hr");
}else{
	define("DB_SERVER", "127.0.0.1");
	define("DB_USER", "hoteliap_ambiance_user");
	define("DB_PASS", "Akinshafi@91");
	define("DB_NAME", "hoteliap_olak_hr");
}

