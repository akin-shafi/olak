
<?php require_once('../private/initialize.php');
 
// Fetch records from database 
$allProduct = Product::find_by_undeleted(['order' => 'ASC']);
if(count($allProduct) > 0){
    // $delimiter = ",";
    // $fileName = 'search_terms.csv';
    $delimiter = ","; 
    $filename = "Stock-data_" . date('Y-m-d') . ".csv"; 



    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers 
    $fields = array('ID', 'Product Name', 'Unit Price','Last Supply', 'Unit Sold', 'Value of Sold','Available Stock', 'Value of Available'); 

    fputcsv($f, $fields, $delimiter);


    foreach ($allProduct as $item){
        $value = intval($item->price) * $item->quantity;
        
          // pre_r($item);

          if (!empty($item->ref_no)) {
            $supply = StockDetails::find_by_ref($item->ref_no)->supply ?? "0";
            $sold = StockDetails::find_by_ref($item->ref_no)->sold_stock ?? "0";
            $value_of_sold = intval($item->price) * $sold;
          }else{
            $supply = "None";
            $sold = "None";
          }

        // $c = ProductCategory::find_by_id($item->category)->category;
        $lineData = array(
            $item->id, 
            $item->pname, 
            $item->price, 
            $supply, 
            $sold, 
            number_format($value_of_sold, 2), 
            $item->quantity, 
            number_format($value, 2)
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