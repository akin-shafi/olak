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
      INTO TABLE employees
      FIELDS TERMINATED BY "," 
      LINES TERMINATED BY "\r\n"
      IGNORE 1 LINES

      (@column1, @column2, @column3, @column4, @column6, @column7, @column8, @column9, @column10, @column11, @column12, @column13, @column14, @column15, @column16, @column17, @column18, @column19, @column20, @column21, @column22, @column23, @column24, @column25, @column26)

      SET employee_id = @column1, first_name = @column2, last_name = @column3, other_name = @column4, phone = @column6, email = @column7, gender = @column8, marital_status = @column9, dob = @column10, kin_name = @column11, kin_phone = @column12, present_add = @column13, permanent_add = @column14, highest_qualification = @column15, company = @column16, branch = @column17, department = @column18, job_title = @column19, date_employed = @column20, employment_type = @column21, present_salary = @column22, grade_step = @column23, bank_name = @column24, account_number = @column25, blood_group = @column26
    ';

    $statement = $connect->prepare($query_1);
    $statement->execute();

    $output = [
      'message' => 'Total of ' . $total_row . ' data successfully imported'
    ];

    echo json_encode($output);
  }
}
