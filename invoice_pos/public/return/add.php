<?php 

if (is_post_request()) {

    $args = $_POST;
    $ref_no = $_POST['editStock']['ref_no'];
    $editCat = StockDetails::find_by_ref($ref_no);  
    $supply = $_POST['editStock']['supply'];
    $args = $_POST['editStock'];    
    $editCat->merge_attributes($args);
    $result = $editCat->save();
    if ($result == true) {  
        exit(json_encode(['msg' => 'OK']));
    } else {
        exit(json_encode(['msg' => display_errors($editCat->errors)]));
    }
}

?>