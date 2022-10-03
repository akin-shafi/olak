<?php require_once('../../private/initialize.php'); ?>

<?php if (isset($_POST['gen_code'])) { 
$rand = rand(10, 100);
$unique = date('His');
// Create trans_no dynamically
$barcode = $unique . $rand;

// $barcode = "SPO" . $rand;

exit(json_encode(['msg' => 'OK', 'barcode' => $barcode]));

} ?>