<?php require_once('../../private/initialize.php');?>
<?php 

$from = $_POST['from'] ?? date('Y-m-d');
$to = $_POST['to'] ?? date('Y-m-d'); 
if(isset($_POST['close_reg'])){
    $created_by = $_POST['created_by'] ?? $loggedInAdmin->id;
}else{
    $created_by = $_POST['created_by'] ?? "";
}
if ($created_by != "") {
    $user = $created_by;
}else{
    $user = null;
}
$reg = Register::fetch_customer_data($from, $to, $created_by,$user);

echo $reg;

?>