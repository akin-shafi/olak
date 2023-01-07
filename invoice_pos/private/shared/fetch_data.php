<?php require_once('/initialize.php');

if (isset($_POST['fetch'])) {
    $customer = Customer::find_by_id($_POST['cid']);
}


?>