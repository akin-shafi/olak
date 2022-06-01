<?php 
 
// Load the database configuration file 
include_once 'db/dbConfig.php'; 
 
// Fetch records from database 
$query = $db->query("SELECT * FROM products ORDER BY id ASC"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "product-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'Product Name', 'Category', 'Quantity','Tax method', 'Cost', 'Price');  
    
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        // $status = ($row['status'] == 1)?'Active':'Inactive';
        $c = $row['category'];
        $category = 
        	( $c == 1) ? "Alcoholic Wine" : 
        	( ($c == 2)  ? "Non Alcoholic Wine" : 
        	( ($c == 3)  ? "Beer" : 
        	( ($c == 4)  ? "Soft Drink" : 
        	( ($c == 5)  ? "Juice" : 
        	( ($c == 6)  ? "Water" : 
        	( ($c == 2)  ? "Non Alcoholic Wine" : "Not Set")))))); 
        $lineData = array($row['id'], $row['pname'], $category, $row['quantity'], $row['tax_method'], $row['cost'], $row['price']); 
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