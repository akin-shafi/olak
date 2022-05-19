
<?php require_once('../private/initialize.php');
 
// Fetch records from database 
$id = $_GET['id'];
$stock = StockDetails::find_by_item_id($id); 
$prod_name = Product::find_by_id($id)->pname;

if(count($stock) > 0){
    // $delimiter = ",";
    // $fileName = 'search_terms.csv';
    $delimiter = ","; 
    $filename = "Stock-data-for_" . $prod_name . "_". date('Y-m-d') . ".csv";  

    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers 

    $fields = array('ID', 'created On',  'Item', 'Ref No', 'Initial Stock',  'Supply', 'Total Stock', 'Unit Price',  'Unit Sold',  'Value in(NGN)', 'Avail Stock Value in(NGN)'); 

    fputcsv($f, $fields, $delimiter);

    $sn = 1;
    foreach ($stock as $val){
          $total_stock = $val->supply + $val->initial_stock;
          $qty_left = $val->qty_left == '' ? 0 : $val->qty_left; 
          $value_of_avail = intval($val->unit_price) * $qty_left;
          $value_of_sold = $val->sold_stock * $val->unit_price ?? 0;
          $unit_price = $val->unit_price ?? 0;
          $sold_stock = $val->sold_stock ?? '0';
        $lineData = array(
            $sn++, 
            date('D M, y h:i:a', strtotime($val->created_at)), 
            Product::find_by_id($val->item_id)->pname, 
            $val->ref_no, 
            $val->initial_stock, 
            $val->supply, 
            $total_stock, 
            number_format($unit_price, 2),
            $sold_stock,
            number_format($value_of_sold, 2),
            $qty_left,
            $value_of_avail
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