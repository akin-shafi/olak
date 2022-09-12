<?php require_once('../../../private/initialize.php'); ?>

<?php 
if(isset($_POST['addStock'])):

  $args = $_POST['addStock'];
  $addStock = new StockDetails($args);
  $result = $addStock->save();
  if ($result == true) {  
        $rand = rand(10, 100);
        $new_id = $addStock->id;
        $ref_no = "03" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
          $data = [
            'ref_no' => $ref_no,
          ];
          $addStock->merge_attributes($data);
          $result2 = $addStock->save();
          exit(json_encode(['msg' => 'OK']));
  } else {
      exit(json_encode(['msg' => display_errors($addStock->errors)]));
  }

endif

?>



<?php if(isset($_POST['editStock'])){
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

} ?>


      
