<?php require_once('../../private/initialize.php'); ?>
<?php 
  $product = Product::find_by_exception(1);
  foreach ($product as $key => $p) {

        $st = Stock::find_by_ref($p->ref_no);
        if(!empty($st)){
          $data2 = [
            'exception' => $p->exception,
          ];
         $st->merge_attributes($data2);
         $result2 = $st->save();
        }  
  }

  foreach ($product as $key => $e) {

        $stockD = StockDetails::find_by_ref($e->ref_no);
        if(!empty($stockD)){
          $data2 = [
            'exception' => $e->exception,
          ];
         $stockD->merge_attributes($data2);
         $result2 = $stockD->save();
        }  
  }

 exit(json_encode(['msg' => 'OK']))
?> 