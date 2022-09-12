<?php require_once('../../../private/initialize.php'); ?>
<?php 
    if(isset($_POST['addItem'])){

    $args = $_POST['addItem'];
    $addItem = new Stock($args);
    $result = $addItem->save();
    if ($result == true) {  
        exit(json_encode(['msg' => 'OK']));
    } else {
        exit(json_encode(['msg' => display_errors($addItem->errors)]));
    }

} 
?>
