<?php require_once('../../../private/initialize.php'); ?>
<?php if(isset($_POST['deleteAll'])){
   $warehouseItem = Product::find_all();
  foreach ($warehouseItem as $key => $value) {
    $each = Product::find_by_id($value->id);
    // $result2 = $each->clearQty($each->id);
    $data = [
      'quantity' => '0',
      'sold_bottle' => '0',
    ];
    $each->merge_attributes($data);
    $result1 = $each->save();
    // pre_r($result2);
  }
  if ($result1 == true) {
        $stock = Stock::find_all();
        foreach ($stock as  $val) {
            $all = Stock::find_by_id($val->id);
            $result2 = $all->delete($all->id);
        }
  }
   

              $stockD = StockDetails::find_all();
             foreach ($stockD as  $va) {
                $eac = StockDetails::find_by_id($va->id);
                $result3 = $eac->delete($eac->id);
              }

              

                exit(json_encode(['msg' => 'OK']));
             
    

} ?> 