<?php
require_once('../../private/initialize.php');

// ! This script can upload upto 30,000 data at the same time

if (is_post_request()) {
  if (isset($_POST['csv'])) {
    $connect = new PDO("mysql:host=localhost;dbname=hr", "root", "", [
      PDO::MYSQL_ATTR_LOCAL_INFILE => true
    ]);

    $total_row = count(file($_FILES['employee_csv_data']['tmp_name'])) - 1;

    $file_location = str_replace("\\", "/", $_FILES['employee_csv_data']['tmp_name']);

    $query_1 = '
      LOAD DATA LOCAL INFILE "' . $file_location . '" 
      IGNORE 
      INTO TABLE employee 
      FIELDS TERMINATED BY "," 
      LINES TERMINATED BY "\r\n"
      IGNORE 1 LINES

      (@column1, @column2, @column3, @column4, @column5, @column6, @column7, @column8, @column9, @column10, @column11, @column12, @column13, @column14, @column15, @column16, @column17, @column18)

      SET firstname = @column1, lastname = @column2, othername = @column3, department = @column4, location = @column5, phone = @column6, email = @column7, marital_status = @column8, dob = @column9, kin_name = @column10, kin_phone = @column11, highest_qualification = @column12, date_employed = @column13, bank_name = @column14, bank_account = @column15, professional_body = @column16, present_salary = @column17, grade_step = @column18
    ';

    $statement = $connect->prepare($query_1);
    $statement->execute();

    $output = [
      'message' => 'Total of ' . $total_row . ' data successfully imported'
    ];

    echo json_encode($output);
  }
}
