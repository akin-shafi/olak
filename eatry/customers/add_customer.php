<?php require_once('../private/initialize.php'); ?>

<?php 

// if (isset($_POST['addRoom'])) {
    $args = $_POST;
    $cust = new Customer($args);
    // pre_r($cust);
    $result = $cust->save();

    if ($result === true) {  
        exit(json_encode(['msg' => 'OK']));
    } else {
        exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($cust->errors)]));
    }

?>