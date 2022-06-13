<?php

  ob_start(); // turn on output buffering

  //this is to set the default timezone to lagos
  date_default_timezone_set("Africa/Lagos");

  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  //   define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("PUBLIC_PATH", PROJECT_PATH); //modified
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can set a hardcoded value:

  define("WWW_ROOT", '/olak/supermarket');

  // define("WWW_ROOT", '');
  // * Can dynamically find everything in URL up to "/public"
  // $public_end = strpos($_SERVER['SCRIPT_NAME'], '/lawchamber') + 11;
  // $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  // define("WWW_ROOT", $doc_root);

  require_once('functions.php');
  require_once('status_error_functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('validation_functions.php');

  // Load class definitions manually

  // -> Individually
  // require_once('classes/bicycle.class.php');

  // -> All classes in directory
  foreach (glob('classes/*.class.php') as $file) {
      require_once($file);
  }

  // Autoload class definitions
  function my_autoload($class)
  {
      if (preg_match('/\A\w+\Z/', $class)) {
          include('classes/' . $class . '.class.php');
      }
  }
  spl_autoload_register('my_autoload');

  $database = db_connect();
  DatabaseObject::set_database($database);

   $database_lincense = db_connect_lincense();
  DatabaseObjectLincense::set_database($database_lincense);

  $session = new Session;

  $loggedInAdmin = Admin::find_by_email($session->admin);
  $currency = '₦' ;


$company = CompanyDetails::find_by_id(1);
$settings = Settings::find_by_id(1);
$install = Installation::find_by_id(1);

$subscription = Activation::find_by_product('Restaurant');


 $start_date  = date('Y-m-d h:i:s');
 $end_date = $subscription->expire_date;
 // $datediff = $end_date - $start_date;

$dateDiff = Activation::dateDifference($start_date, $end_date);

$today = date('Y-m-d');
$onlineUsers =  LoggedIn::find_all_by_status(['status' => 1, 'time_log_in' => $today]);

if (isset($loggedInAdmin->id)) {
     $product_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->product_mgt ?? 0;
     $warehouse_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->warehouse_mgt ?? 0;
     $purchase_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->purchase_mgt ?? 0;
     $user_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->user_mgt ?? 0;
     $returned = AccessControl::find_by_user_id($loggedInAdmin->id)->returned ?? 0;
     $sales_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->sales_mgt ?? 0;
     $stock_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->stock_mgt ?? 0;
     $credit_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->credit_mgt ?? 0;
     $verify_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->verify_mgt ?? 0;
     $process_delivery = AccessControl::find_by_user_id($loggedInAdmin->id)->process_delivery ?? 0;
     $ledger_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->ledger_mgt ?? 0;
     $shift_mgt = AccessControl::find_by_user_id($loggedInAdmin->id)->shift_mgt ?? 0;

     $void_order = Settings::find_by_id(1)->delete_order ?? 0;
}



