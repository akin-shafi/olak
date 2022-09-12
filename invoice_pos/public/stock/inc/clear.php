<?php require_once('../../../private/initialize.php'); ?>
<?php if(isset($_POST['clearAll'])){

          $date = date('Y-m-d');
          $ledger = LedgerTracker::find_date_created($date);

          $ledger =  [
              'status' => 1,
          ];
         $ledger->merge_attributes($ledger);
         // $saveledger = $ledger->save();

          $stock = Stock::find_all();
          foreach ($stock as  $s) {
            $g = Product::find_by_ref($s->ref_no);
            if (!empty($g)) {
              if ($g->exception != 1) {
                $del  = StockDetails::real_delete_all($s->id);
                // $del  = Stock::delete_multiple($s->id);
              }
            }
            
          }

          $stockDetails = StockDetails::find_all();
          $productItem = Product::find_by_exception(0);
            foreach ($productItem as $key => $value) {
              $each = Product::find_by_id($value->id);
              // if ($each->exception == 0) {
                $data = [
                  'quantity' => '0',
                  'sold_bottle' => '0',
                ];
                $each->merge_attributes($data);
                $result2 = $each->save();
                if ($result2 == true) {
                  

                  foreach ($stockDetails as  $p) {
                    $k = Product::find_by_ref($p->ref_no);
                    if ($k->exception == 0) {
                      $end = StockDetails::real_delete_all($p->id);
                      // $end = StockDetails::delete_multiple($p->id);
                    }
                  }
                   
                }
              // }
            }

            if ($result2 == true) {
              exit(json_encode(['msg' => 'OK']));
            }else{
              exit(json_encode(['msg' => 'Nothing']));
            }


} ?> 