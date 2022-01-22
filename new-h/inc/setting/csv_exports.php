<?php
require_once('../../private/initialize.php');
// Fetch records from database
$employees = Employee::find_by_undeleted();
if (count($employees) > 0) {
  // $delimiter = ",";
  // $fileName = 'search_terms.csv';
  $delimiter = ",";
  $filename = "payroll_" . date('Y-m-d') . ".csv";

  // Create a file pointer
  $f = fopen('php://memory', 'w');

  $fields = array('ID', 'firstname', 'lastname', 'email', 'Role');

  fputcsv($f, $fields, $delimiter);

  $sn = 1;
  foreach ($employees as $item) {
    $lineData = array(
      $sn++,
      $item->first_name,
      $item->last_name,
      $item->email,
    );
    fputcsv($f, $lineData, $delimiter);
  }

  fseek($f, 0);

  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $filename . '";');

  fpassthru($f);
}
exit;
