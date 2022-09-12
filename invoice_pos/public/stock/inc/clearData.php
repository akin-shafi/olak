<?php require_once('../../../private/initialize.php'); ?>
<?php if(isset($_POST['clearAll'])){
   $item = Product::find_by_exception(0);
    foreach ($item as $key => $value) {
        $each = Product::find_by_id($value->id);
        $data = [
          'quantity' => '0',
          'sold_bottle' => '0',
        ];
        $each->merge_attributes($data);
        $result1 = $each->save();    


    }

    foreach ($item as $key => $p) {
      $st = Stock::find_by_ref($p->ref_no);
        if(!empty($st)){
          $data2 = [
            'last_rec' => 1,
            'exception' => $p->exception,
          ];
         $st->merge_attributes($data2);
         $result2 = $st->save();
        }   
    }
    $today = date('Y-m-d H:i:s');
    if ($result1 == true) {
          $yesterday = date('Y-m-d',strtotime("-1 days"));
          // $yesterday = date('Y-m-d');
          // $stock = Stock::find_by_opened_at($yesterday);
          $stock = Stock::find_by_exception(0);
          foreach ($stock as  $val) {
              $eachStock = Stock::find_by_id($val->id);
              $result = $eachStock->stocK_return_to_zero(['id' => $eachStock->id, 'closed_by' => $loggedInAdmin->id ,'closed_at' => $today]);
              // $result = $eachStock->deleted($eachStock->id);
          }
    }else{
      exit(json_encode(['msg' => 'Nothing to do at Product level']));
    }
            
   $stockD = StockDetails::find_by_exception(0);
   foreach ($stockD as  $va) {
      $eac = StockDetails::find_by_id($va->id);
      // $result3 = $eac->deleted($eac->id);
      $result3 = $eac->return_to_zero(['id' => $eac->id, 'closed_by' => $loggedInAdmin->id, 'closed_at' => $today]);
    }
    if ($result3 == true) {
      exit(json_encode(['msg' => 'OK']));
    }else{
      exit(json_encode(['msg' => 'Nothing to do at StockDetails level']));
    }
            

} ?> 