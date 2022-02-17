
<?php require_once('../private/initialize.php');

$thisMonth  = $_GET['month'] ?? date('Y-m');
$bank       = $_GET['bank'] ?? '1';

$sort_code      = $_GET['sort_code'] ?? ''; // Access Bank
$company_name   = $_GET['coy'] ?? '1';
$branch_name    = $_GET['branch'] ?? '';

$employees  = Employee::find_by_company_and_branch(strtolower($company_name), strtolower($branch_name));

if (count($employees) > 0) {

    $delimiter = ",";
    $filename = $company_name . "_salary_" . date('M_Y', strtotime($thisMonth)) . ".csv";

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    $fields = ['ID', 'FULL NAME', 'COMPANY NAME', 'BRANCH NAME', 'BANK NAME', 'ACCOUNT NUMBER', 'SALARY', 'SORT CODE'];

    fputcsv($f, $fields, $delimiter);

    $sn = 1;
    foreach ($employees as $value) {
        $payroll        = Payroll::find_by_employee_id($value->id, ['month' => $thisMonth]);
        $gross_salary   = intval($value->present_salary);
        $salary_advance = intval($payroll->salary_advance);
        $loan           = intval($payroll->loan);

        $full_name      = isset($value->first_name) ? $value->full_name() : 'Not Set';
        $bank_name      = $value->bank_name ?? 'Not Set';
        $account_number = $value->account_number ?? 'Not Set';
        $takeHome       = $gross_salary - ($salary_advance + $loan);

        $lineData = [
            $sn++,
            $full_name,
            $company_name,
            $branch_name,
            $bank_name,
            $account_number,
            $takeHome,
            $sort_code,
        ];

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