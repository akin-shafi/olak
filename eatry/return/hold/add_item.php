<?php require_once('../../private/initialize.php'); ?>

<?php

if (isset($_POST)) {

  $referenceNumber = $_POST['ref_no'];

  if (!empty($_SESSION["return_cart"])) {
    $viaSession = $_SESSION['return_cart'];
    $transact = Transaction::find_by_trans_number($referenceNumber);

    $totalItem = $_POST['total_item'];
    $quantityInItem = $_POST['total_quantity'];
    $sumTransaction = array_sum($_POST['total_price']);

    $transData = [
      'total_item' => $totalItem,
      'quantity_in_item' => $quantityInItem,
      'cost_of_item' => $sumTransaction,
      'total_paid' => $sumTransaction,
      'updated_at' => date('Y-m-d H:i:s'),
    ];

    $transact->merge_attributes($transData);
    $transactResult = $transact->save();


    if ($transactResult == true) {
      for ($i = 0; $i < count($viaSession); $i++) {

        $subtotal1 = intval($viaSession[$i]['product_quantity']) * intval($viaSession[$i]['product_price']);

        if (!isset($viaSession[$i]['sale_id'])) {

          $salesData = [
            'product_id' => $_POST['product_id'][$i],
            'trans_no' => $transact->trans_no,
            'product_quantity' => $viaSession[$i]['product_quantity'],
            'unit_price' => $viaSession[$i]['product_price'],
            'subtotal' => $subtotal1,
            'created_by' => $loggedInAdmin->id
          ];

          $sales = new Sales($salesData);
          $salesResult = $sales->save();

          if ($salesResult == true) {
            $product = Product::find_by_id($sale->product_id);
            $stockDetails = StockDetails::find_by_ref($product->ref_no);

            $totalProductQuantitySold = intval($sale->product_quantity);
            $productQuantityLeft = $_POST['stockUnit'][$i];


            $productData = [
              'quantity' => $productQuantityLeft,
              'sold_bottle' => $totalProductQuantitySold,
            ];

            $product->merge_attributes($productData);
            $productResult = $product->save();

            if ($productResult == true) {

              $stock = StockDetails::find_by_ref($product->ref_no);

              $sold_stock_amt = intval($stock->unit_price) * $product->sold_bottle;

              $stockData = [
                'sold_stock' => $product->sold_bottle,
                'qty_left' => $product->quantity,
                'sold_stock_amt' => $sold_stock_amt,
                'updated_by' => $loggedInAdmin->id,
                'updated_at' => date('Y-m-d H:i:s'),
              ];

              $stock->merge_attributes($stockData);
              $stockResult = $stock->save();

              if ($stockResult == true) {
                unset($_SESSION["return_cart"]);
                echo json_encode(['msg' => 'OK', 'trans_no' => $transact->trans_no]);
              } else {
                exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($product->errors), 'location' => 'Fail here']));
              }
            }
          }
        } else {

          $sale = Sales::find_by_id($viaSession[$i]['sale_id']);
          $subtotal = intval($viaSession[$i]['product_quantity']) * intval($viaSession[$i]['product_price']);
          $productQuantity = intval($viaSession[$i]['product_quantity']);

          if ($sale->product_quantity != $viaSession[$i]['product_quantity']) {
            $saleData = [
              'subtotal' => $subtotal,
              'product_quantity' => $productQuantity,
              'updated_at' => date('Y-m-d H:i:s'),
              'updated_by' => $loggedInAdmin->id
            ];

            $productName  = $_POST['product_name'][$i];
            $initialQuantity  = $sale->product_quantity;
            $currentQuantity  = $_POST['quantity'][$i];
            $stockUnit  = $_POST['stockUnit'][$i];

            log_action($productName . ' | initial-quantity ' . $initialQuantity . '| current-quantity ' . $currentQuantity . ' | stock-unit ' . $stockUnit . ' edited by', "{$loggedInAdmin->full_name()} Edited.", "return_item");

            $sale->merge_attributes($saleData);
            $saleResult = $sale->save();

            if ($saleResult == true) {
              $product = Product::find_by_id($sale->product_id);
              $stockDetails = StockDetails::find_by_ref($product->ref_no);

              $totalProductQuantitySold = intval($sale->product_quantity);
              $productQuantityLeft = $_POST['stockUnit'][$i];


              $productData = [
                'quantity' => $productQuantityLeft,
                'sold_bottle' => $totalProductQuantitySold,
              ];

              $product->merge_attributes($productData);
              $productResult = $product->save();

              if ($productResult == true) {

                $stock = StockDetails::find_by_ref($product->ref_no);

                $sold_stock_amt = intval($stock->unit_price) * $product->sold_bottle;

                $stockData = [
                  'sold_stock' => $product->sold_bottle,
                  'qty_left' => $product->quantity,
                  'sold_stock_amt' => $sold_stock_amt,
                  'updated_by' => $loggedInAdmin->id,
                  'updated_at' => date('Y-m-d H:i:s'),
                ];

                $stock->merge_attributes($stockData);
                $stockResult = $stock->save();

                if ($stockResult == true) {
                  unset($_SESSION["return_cart"]);
                  echo json_encode(['msg' => 'OK', 'trans_no' => $transact->trans_no]);
                } else {
                  exit(json_encode(['msg' => 'FAIL', 'error' => display_errors($product->errors), 'location' => 'Fail here']));
                }
              }
            }
          } 
        //   else {
        //     exit(json_encode(['msg' => 'Nothing to do!', 'action' => 1]));
        //   }
        }
      }
    }
  }
}
