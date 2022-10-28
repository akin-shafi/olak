<?php

function url_for($script_path)
{
  // add the leading '/' if not present
  if ($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string = "")
{
  return urlencode($string);
}

function raw_u($string = "")
{
  return rawurlencode($string);
}

function h($string = "")
{
  return htmlspecialchars($string);
}

function error_404()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location)
{
  header("Location: " . $location);
  exit;
}

function is_post_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request()
{
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// PHP on Windows does not have a money_format() function.
// This is a super-simple replacement.
if (!function_exists('money_format')) {
  function money_format($format, $number)
  {
    return '$' . number_format($number, 2);
  }
}

//this function is used format the track number to this format EAGLE/LAG/2018/0023
function createTrackNo($val1, $val2)
{

  $trackNo = "EAGLE/" . strtoupper(substr($val1, 0, 3)) . "/" . date('Y') . "/" . str_pad($val2, 4, "0", STR_PAD_LEFT);

  return $trackNo;
}

// this is used to get the id from 
function getIdFromTrackNo($value)
{
  $return_value = explode("/", $value);
  $totalArray = count($return_value);
  $return_id = $return_value[$totalArray - 1];
  settype($return_id, 'integer');

  return $return_id;
}

function display_message($msg = '')
{
  if (isset($msg) && $msg != '') {
    return "<div id='message'> $msg </div>";
  } else {
    $msg = "";
    return "<div id='message'> $msg </div>";
  }
}

function get_duration_span($value)
{
  $today = date('Y-m-d');
  switch ($value) {
    case 'year':
      $value = [date('Y-01-01'), $today];
      break;

    case 'week':
      $todayD = date('Y-m-d-w');
      $diff = explode('-', $todayD);
      if ($diff[3] === 0) {
        $startwk = $today;
      } else {
        $startwk = date('Y-m-d', strtotime($today) - 60 * 60 * 24 * $diff[3]);
      }
      $value = [$startwk, $today];
      break;

    case 'month':
      $value = [date('Y-m-01'), $today];
      break;

    default:
      $value = [$today, $today];
      break;
  }
  return $value;
}

 function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
    $interval can be:
    yyyy - Number of full years
    q - Number of full quarters
    m - Number of full months
    y - Difference between day numbers
        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d - Number of full days
    w - Number of full weekdays
    ww - Number of full weeks
    h - Number of full hours
    n - Number of full minutes
    s - Number of full seconds (default)
    */

    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }
    $difference = $dateto - $datefrom; // Difference in seconds

    switch($interval) {

    case 'yyyy': // Number of full years

        $years_difference = floor($difference / 31536000);
        if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
            $years_difference--;
        }
        if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
            $years_difference++;
        }
        $datediff = $years_difference;
        break;

    case "q": // Number of full quarters

        $quarters_difference = floor($difference / 8035200);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $quarters_difference--;
        $datediff = $quarters_difference;
        break;

    case "m": // Number of full months

        $months_difference = floor($difference / 2678400);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $months_difference--;
        $datediff = $months_difference;
        break;

    case 'y': // Difference between day numbers

        $datediff = date("z", $dateto) - date("z", $datefrom);
        break;

    case "d": // Number of full days

        $datediff = floor($difference / 86400);
        break;

    case "w": // Number of full weekdays

        $days_difference = floor($difference / 86400);
        $weeks_difference = floor($days_difference / 7); // Complete weeks
        $first_day = date("w", $datefrom);
        $days_remainder = floor($days_difference % 7);
        $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
        if ($odd_days > 7) { // Sunday
            $days_remainder--;
        }
        if ($odd_days > 6) { // Saturday
            $days_remainder--;
        }
        $datediff = ($weeks_difference * 5) + $days_remainder;
        break;

    case "ww": // Number of full weeks

        $datediff = floor($difference / 604800);
        break;

    case "h": // Number of full hours

        $datediff = floor($difference / 3600);
        break;

    case "n": // Number of full minutes

        $datediff = floor($difference / 60);
        break;

    default: // Number of full seconds (default)

        $datediff = $difference;
        break;
    }    

    return $datediff;

}



// This part is for the text messages

//Function to connect to SMS sending server using HTTP GET
function useHTTPGet($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients)
{
  $query_str = http_build_query(array('username' => $username, 'apikey' => $apikey, 'sender' => $sendername, 'messagetext' => $messagetext, 'flash' => $flash, 'recipients' => $recipients));
  return file_get_contents("{$url}?{$query_str}");
}

//For logging of actions on the App
function log_action($action, $message = "", $logtype = "")
{

  switch ($logtype) {
    case 'login':
      $logfile = PRIVATE_PATH . '/logins.txt';
      break;

    case 'admin':
      $logfile = PRIVATE_PATH . '/admin.txt';
      break;

    default:
      $logfile = PRIVATE_PATH . '/trans.txt';
      break;
  }

  $new = file_exists($logfile) ? false : true;

  if ($handle = fopen($logfile, 'a')) { // append

    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
    $content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);

    if ($new) {
      chmod($logfile, 0755);
    }
  } else {
    echo "Could not open log file for writing.";
  }
}

// function findClient($cat, $id){
//   switch ($cat) {
//     case 'credit':
//       $client = CreditClient::find_by_id($id);
//       break;
//     case 'prepaid':
//       $client = PrepaidClient::find_by_id($id);
//       break;
//     default:
//       $client = WalkInClient::find_by_id($id);
//       break;
//   }

//   return $client;
// }

function updateClientPwd($cat, $id, $newpwd)
{
  $hashedpwd = password_hash($newpwd, PASSWORD_BCRYPT);
  switch ($cat) {
    case 'credit':
      $result = DB::query('UPDATE credit_client SET hashed_password = :hashed_password WHERE id = :id', [':id' => $id, ':hashed_password' => $hashedpwd]);
      break;
    case 'prepaid':
      $result = DB::query('UPDATE prepaid_client SET hashed_password = :hashed_password WHERE id = :id', [':id' => $id, ':hashed_password' => $hashedpwd]);
      break;
    default:
      $result = DB::query('UPDATE walk_in_client SET hashed_password = :hashed_password WHERE id = :id', [':id' => $id, ':hashed_password' => $hashedpwd]);
      break;
  }

  return $result;
}

function calcPercentage($a, $b)
{
  if ($b == 0) {
    $result = 0;
    return $result;
  } else {
    $result = ($a / $b) * 100;
    return ceil($result);
  }
}

// function get_array_from_obj($object = [], $attr = '')
// {
//   $array = [];
//   if (is_array($object)) {
//     foreach ($object as $obj) {
//       $array[] = $obj->$attr;
//     }
//     return $array;
//   } else {
//     $array[] = $obj->$attr;
//   }

//   return $array;
// }




function split_date_for_manifest_no($manifestNo)
{
  $arr = str_split($manifestNo);

  $mannifest_date = h($arr[0] . $arr[1] . $arr[2] . $arr[3] . '-' . $arr[4] . $arr[5] . '-' . $arr[6] . $arr[7] . ' ' . $arr[8] . $arr[9] . ':' . $arr[10] . $arr[11] . ':' . $arr[12] . $arr[13]);

  return $mannifest_date;
}

function pre_r($array)
{
  echo '<pre class="text-info">';
  $printer = print_r($array);
  echo '</pre>';
  return $printer;
}



function time_elapsed_string($datetime, $string, $full = false)
{
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = [
    'y' => 'year',
    'm' => 'month',
    'w' => 'week',
    'd' => 'day',
    'h' => 'hour',
    'i' => 'minute',
    's' => 'second',
  ];
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ' : 'just now';
}

function time_diff_string($from, $to, $full = false)
{
  $from = new DateTime($from);
  $to = new DateTime($to);
  $diff = $to->diff($from);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
    'y' => 'year',
    'm' => 'month',
    'w' => 'week',
    'd' => 'day',
    'h' => 'hour',
    'i' => 'minute',
    's' => 'second',
  );
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return implode(', ', $string);
}


function convert_number_to_words($number)
{
  $hyphen      = '-';
  $conjunction = ' and ';
  $separator   = ', ';
  $negative    = 'negative ';
  $decimal     = ' point ';
  $dictionary  = [
    0                   => 'Zero',
    1                   => 'One',
    2                   => 'Two',
    3                   => 'Three',
    4                   => 'Four',
    5                   => 'Five',
    6                   => 'Six',
    7                   => 'Seven',
    8                   => 'Eight',
    9                   => 'Nine',
    10                  => 'Ten',
    11                  => 'Eleven',
    12                  => 'Twelve',
    13                  => 'Thirteen',
    14                  => 'Fourteen',
    15                  => 'Fifteen',
    16                  => 'Sixteen',
    17                  => 'Seventeen',
    18                  => 'Eighteen',
    19                  => 'Nineteen',
    20                  => 'Twenty',
    30                  => 'Thirty',
    40                  => 'Forty',
    50                  => 'Fifty',
    60                  => 'Sixty',
    70                  => 'Seventy',
    80                  => 'Eighty',
    90                  => 'Ninety',
    100                 => 'Hundred',
    1000                => 'Thousand',
    1000000             => 'Million',
    1000000000          => 'Billion',
    1000000000000       => 'Trillion',
    1000000000000000    => 'Quadrillion',
    1000000000000000000 => 'Quintillion'
  ];

  if (!is_numeric($number)) {
    return false;
  }

  if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
    // overflow
    trigger_error(
      'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
      E_USER_WARNING
    );
    return false;
  }

  if ($number < 0) {
    return $negative . convert_number_to_words(abs($number));
  }

  $string = $fraction = null;

  if (strpos($number, '.') !== false) {
    list($number, $fraction) = explode('.', $number);
  }

  switch (true) {
    case $number < 21:
      $string = $dictionary[$number];
      break;
    case $number < 100:
      $tens   = ((int) ($number / 10)) * 10;
      $units  = $number % 10;
      $string = $dictionary[$tens];
      if ($units) {
        $string .= $hyphen . $dictionary[$units];
      }
      break;
    case $number < 1000:
      $hundreds  = $number / 100;
      $remainder = $number % 100;
      $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
      if ($remainder) {
        $string .= $conjunction . convert_number_to_words($remainder);
      }
      break;
    default:
      $baseUnit = pow(1000, floor(log($number, 1000)));
      $numBaseUnits = (int) ($number / $baseUnit);
      $remainder = $number % $baseUnit;
      $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
      if ($remainder) {
        $string .= $remainder < 100 ? $conjunction : $separator;
        $string .= convert_number_to_words($remainder);
      }
      break;
  }

  if (null !== $fraction && is_numeric($fraction)) {
    $string .= $decimal;
    $words = array();
    foreach (str_split((string) $fraction) as $number) {
      $words[] = $dictionary[$number];
    }
    $string .= implode(' ', $words);
  }

  return $string;
}





/**
 * Register our sidebars and widgetized areas.
 */
// function mdb_widgets_init() {

//   register_sidebar( array(
//     'name'          => 'Sidebar',
//     'id'            => 'sidebar',
//     'before_widget' => '',
//     'after_widget'  => '',
//     'before_title'  => '',
//     'after_title'   => '',
//   ) );

// }
// add_action( 'widgets_init', 'mdb_widgets_init' );
