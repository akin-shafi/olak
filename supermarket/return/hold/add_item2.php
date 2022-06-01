<?php require_once('../../private/initialize.php'); ?>
<?php

if (isset($_POST)) {

  $fromSession = $_SESSION['return_cart'];

  $transaction = Transaction::find_by_trans_no($_POST['ref_no']);
  $transactionD = Transaction::find_by_id($transaction->id);
  // $transaction->delete();

  $args = [
    'total_item'=> $_POST['total_item'],
    'total_quantity'=> $_POST['total_quantity']
  ];

  $transaction = new Transaction($_POST);
  // $result1 = $transaction->save();
  pre_r($_POST);
  pre_r($args);

  // for ($i = 0; $i < count($_POST['product_id']); $i++) {
  // }




  $transaction = new Transaction($args);
  // $result1 = $transaction->(save);

  if ($result1 === true) {
    $new_trans_id = $transaction->id;
    $rand = rand(10, 100);

    $trans_no = "1" . str_pad($new_trans_id, 3, "0", STR_PAD_LEFT) . $rand;

    $data2 = [
      'trans_no' => $trans_no,
      'created_by' => $loggedInAdmin->id,
    ];
    $transaction->merge_attributes($data2);
    // $result2 = $transaction->save();

    if ($result2 == true) {
      $trans_details = new TransactionDetail($args);

      $new_ref_id = $transaction->id;
      $dym = rand(10, 200);

      $ref_no = 'Ref' . "1" . str_pad($new_ref_id, 2, "0", STR_PAD_LEFT) . $dym;
      $data3 = [
        'trans_no' => $trans_no,
        'ref_no' => $ref_no,
        'outstanding' => $args['balance'],
        'created_by' => $loggedInAdmin->id,
        'paid_at' => date('Y-m-d H:i:s'),
      ];
      $trans_details->merge_attributes($data3);
      // $result3 = $trans_details->save(); 

      if ($result3 == true) {
        $args2 = $_POST['product_id'];
        for ($i = 0; $i < count($args2); $i++) {
          $data = [
            'product_id' => $_POST['product_id'][$i],
            'trans_no' => $transaction->trans_no,
            'product_quantity' => $_POST['product_quantity'][$i],
            'unit_price' => $_POST['unit_price'][$i],
            'subtotal' => $_POST['subtotal'][$i],
            'created_by' => $loggedInAdmin->id
          ];

          $sales = new Sales($data);
          // $result4 = $sales->save();
        }
        if ($result4 == true) {

          $arr = $_POST['product_id'];
          if ($store_id == 1) {
            $items = 'quantity';
            $sold = 'sold_bottle';
          } else {
            $items = 'left_shut';
            $sold = 'sold_shut';
          }
          for ($i = 0; $i < count($arr); $i++) {
            $product = Product::find_by_id($arr[$i]);

            $itemsold = ($_POST['product_quantity'][$i]) + $product->$sold;
            $args = [
              $items => $_POST['stockUnit'][$i],
              $sold => $itemsold,
            ];
            $product->merge_attributes($args);

            // $result5 = $product->save(); 

            if ($store_id == 1) {
              if ($result5 == true) {

                $stock = StockDetails::find_by_ref($product->ref_no);

                $sold_stock = ($_POST['product_quantity'][$i]) + $stock->sold_stock;
                $sold_stock_amt = ($_POST['product_quantity'][$i]) * $product->price;
                $stock_amt = $sold_stock_amt + $stock->sold_stock_amt;

                $data3 = [
                  'sold_stock' => $sold_stock,
                  'qty_left' => $_POST['stockUnit'][$i],
                  'unit_price' => $_POST['unit_price'][$i],
                  // 'sold_stock_amt' => $stock_amt,
                ];

                $stock->merge_attributes($data3);
                // $result6 = $stock->save();

              } else {
                exit(json_encode(['msg' => 'Error cannot find Stock Record']));
              }
            } else {
              $result6 = true;
            }
          }
          if ($result6 == true) {
            unset($_SESSION["shopping_cart"]);
            echo json_encode(['msg' => 'OK', 'trans_no' => $transaction->trans_no]);
          } else {
            exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($product->errors), 'location' => 'Fail here']));
          }
        }
      } else {
        exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($transaction->errors), 'location' => 'Fail at second attempt to save Transaction']));
      }
    }
  } else {
    exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($transaction->errors), 'location' => 'Fail at first attempt to save Transaction']));
  }
}
