
<?php require_once('../private/initialize.php');
 
// Fetch records from database 
$thisMonth = date('Y-m');
$allmember = Salary::find_by_created_at($thisMonth);
if(count($allmember) > 0){
    // $delimiter = ",";
    // $fileName = 'search_terms.csv';
    $delimiter = ","; 
    $filename = "toNoteAgent_" . date('Y-m-d') . ".csv"; 



    // Create a file pointer
    $f = fopen('php://memory', 'w');

    $fields = array('ID', 'FULLNAME', 'NET PAY', 'BASIC', 'HOUSING ALLOWANCE', 'DRESSING ALLOWANCE','TRANSPORT', 'UTILITY', 'OTHERS','SALARY ADV.', 'LOAN REPAYMENT', 'TAKE HOME' );

    fputcsv($f, $fields, $delimiter);

    $sn = 1;
     foreach ($allmember as $value){
        $empLoan = LongTermLoan::find_by_employee_id($value->employee_id);
        $salary_advance = SalaryAdvance::find_by_employee_id($value->employee_id);
        $employee = Employee::find_by_id($value->employee_id);
        $net_salary = intval($value->present_salary);
        $basic = $net_salary * (intval(PayrollItem::find_by_item_name('basic')->amount) / 100);
        $housing = $net_salary * (intval(PayrollItem::find_by_item_name('housing')->amount) / 100);
        $dressing = $net_salary * (intval(PayrollItem::find_by_item_name('dressing')->amount) / 100);
        $transport = $net_salary * (intval(PayrollItem::find_by_item_name('transport')->amount) / 100);
        $utility = $net_salary * (intval(PayrollItem::find_by_item_name('utility')->amount) / 100);
        $others = $net_salary * (intval(PayrollItem::find_by_item_name('others')->amount) / 100);
        
        $commitment = isset($empLoan->commitment) ? $empLoan->commitment : '0.00';
        $take_home = intval($net_salary) - (intval($commitment) + intval($salary_advance->total_requested));

        $lineData = array(
            $sn++, 
            $employee->full_name(),
            $net_salary, 
            $basic, 
            $housing, 
            $dressing, 
            $transport, 
            $utility, 
            $others, 
            $salary_advance->total_requested, 
            $commitment, 
            $take_home, 
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