<?php require_once('../../../private/initialize.php');
 
// Fetch records from database 
$branch_id =  $_GET['branch'] ?? $loggedInAdmin->branch_id;
$from = $_GET['date_from'] ?? date("Y-m-d");
$to = $_GET['date_to'] ?? date("Y-m-d");

$fetchInvoice = Invoice::filter_option(['branch_id' => $branch_id, 'from' => $from, 'to' => $to, ]);
// pre_r($fetchInvoice);
if(count($fetchInvoice) > 0){
    // $delimiter = ",";
    // $fileName = 'search_terms.csv';
    $delimiter = ","; 
    $filename = "invoice-record_" . date('Y-m-d') . ".csv"; 

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    $fields = array('ID','Trans ID','Date','Customer Name','Product Name','Unit Cost','Quantity','Grand Total','Status');
    fputcsv($f, $fields, $delimiter);

    $sn = 1;
    foreach ($fetchInvoice as $value){
        $client_id =  $value->transid != '' ? Billing::find_by_invoice_no($value->transid)->client_id : '';

        $customer_name = $client_id != '' ? Client::find_by_id($client_id)->full_name() : 'Not name';
        $product_name = Product::find_by_id($value->service_type)->pname;
        $qbacklog = Billing::find_by_invoice_no($value->transid)->backlog ?? 0;
        $status = Billing::find_by_invoice_no($value->transid)->status ?? 0;
        $trans_status = $qbacklog == 0 && $status == 1  ? 'Not yet' : 'Supplied'; 
        
        $lineData = array(

          $sn++,
          $value->transid,
          date('Y-m-d', strtotime($value->created_at)),
          $customer_name,
          $product_name,
          $value->unit_cost,
          $value->quantity,
          $value->amount,
          $trans_status,
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