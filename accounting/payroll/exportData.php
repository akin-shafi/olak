
<?php require_once('../private/initialize.php');

// Fetch records from database 
$thisMonth = $_GET['month'] ?? date('Y-m');
$allmember = Payroll::find_by_created_at($thisMonth);
$bank = $_GET['bank'] ?? '1';

$sort_code = $_GET['sort_code'] ?? ''; // Access Bank
$sort_code = $_GET['sort_code'] ?? ''; // Wema Bank
$company_name = $_GET['coy'] ?? '1';


if (count($allmember) > 0) {

    $delimiter = ",";
    $filename = $company_name . "_salary_for_" . $thisMonth . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');


    $fields = array('ID', 'FULL NAME', 'COMPANY NAME', 'BANK NAME', 'ACCOUNT NUMBER', 'SALARY', 'SORT CODE');


    fputcsv($f, $fields, $delimiter);
    $sn = 1;
    foreach ($allmember as $value) {
        $net_salary = intval($value->present_salary);
        $salary_advance = intval($value->salary_advance);
        $loan = intval($value->loan);

        $employee = Employee::find_by_employee_id($value->employee_id);

        $full_name = isset($employee->first_name) ? $employee->full_name() : 'Not Set';
        $bank_name = $employee->bank_name ?? 'Not Set';
        $account_number = $employee->account_number ?? 'Not Set';
        $takehome = $net_salary - ($salary_advance + $loan);


        $lineData = array(
            $sn++,
            $full_name,
            $company_name,
            $bank_name,

            $account_number,
            $takehome,
            $sort_code,

        );

        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file 
    fseek($f, 0);

    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer 
    fpassthru($f);
}
exit;



?>