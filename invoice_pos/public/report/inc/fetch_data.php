<?php require_once('../../../private/initialize.php');

$date = $_POST['date'] ?? date("Y-m-d");
$branches = Branch::find_by_undeleted();

// Prepare the JSON response
$response = array(
    'date' => $date,
    'table' => generateTableHTML($branches, $date)
);

// Return the response as a JSON string
header('Content-Type: application/json');
echo json_encode($response);

/**
 * Helper function to generate the HTML for the data table
 */
function generateTableHTML($data, $date) {
    $html = '<table class="table table-sm table-striped table-bordered">';
    $html .= 
    '<tr>
        <th>S/N</th>
        <th>Branch</th>
        <th>Cash (Manual)</th>
        <th>Cash (System)</th>
        <th>Transfer</th>
        <th>POS</th>
        <th>Confirmed Trans</th>
        <th>Unconfirmed Trans</th>
        <th>Expenses</th>
        <th>Refund</th>
        <th>Action</th>
    </tr>';
    $sn = 1;
    foreach ($data as $row) {
        
        $summary_report = SummaryReport::find_by_date(['report_date' => $date, 'branch_id' => $row->id]);
        // pre_r($summary_report);
        $manualCash = !empty($summary_report) ? number_format($summary_report->cash_sales, 2) : "No Record";
        $expenses = !empty($summary_report) ? number_format($summary_report->expenses, 2) : "No Record";
        $refund = !empty($summary_report) ? number_format($summary_report->sum_of_refund, 2) : "No Record";
        
        
        $systemCash = WalletFundingMethod::find_transaction([
            'branch_id' => $row->id, 'payment_method' => 2, 'from' => $date
        ]) ?? 0;
        $transfer = WalletFundingMethod::find_transaction([
            'branch_id' => $row->id, 'payment_method' => 3, 'from' => $date
        ]) ?? 0;
        $pos = WalletFundingMethod::find_transaction([
            'branch_id' => $row->id, 'payment_method' => 4, 'from' => $date
        ]) ?? 0;

        $confirmed = WalletFundingMethod::sum_of_approved(['approval' => 1, 'from' => $date, 'to' => $date, 'branch_id' => $row->id, ]) ?? 0; 
        $unconfirmed = WalletFundingMethod::sum_of_unapproved(['approval' => 0, 'from' => $date, 'to' => $date, 'branch_id' => $row->id,]) ?? 0; 

        
        $id = !empty($summary_report) ? $summary_report->id : '0';

        $html .= '<tr>';
        $html .= '<td>' . $sn++. '</td>';
        $html .= '<td>' . $row->branch_name . '</td>';
        $html .= '<td>' . $manualCash . '</td>';
        $html .= '<td>' . number_format($systemCash, 2) . '</td>';
        $html .= '<td>' . number_format($transfer, 2) . '</td>';
        $html .= '<td>' . number_format($pos, 2) . '</td>';
        $html .= '<td>' . number_format($confirmed, 2) . '</td>';
        $html .= '<td>' . number_format($unconfirmed, 2) . '</td>';
        $html .= '<td>' . $expenses . '</td>';
        $html .= '<td>' . $refund . '</td>';
        if(!empty($summary_report)){
            $html .= '<td>' . "<button class='bnt btn-sm btn-primary oneItem' data-id='". $id ."'>Edit</button>" . '</td>';
        }else{
            $html .= '<td></td>';
        }
        $html .= '</tr>';
    }

    $html .= '</table>';

    return $html;
}