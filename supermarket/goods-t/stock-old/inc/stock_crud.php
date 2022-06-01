<?php require_once('../../../private/initialize.php'); ?>

<?php 
if(isset($_POST['addStock'])){

	$args = $_POST['addStock'];
	$addStock = new StockDetails($args);
  $products = Product::find_by_id($_POST['addStock']['item_id']);
  // pre_r($products);

  if (!empty($products)) {
    # code...
  
        $initial_stock = $products->quantity;
        $supply = $_POST['addStock']['supply'];
        // $unit_price = $_POST['addStock']['unit_price'];
        $rand = rand(10, 100);
        $result = $addStock->save();
         // $result = true;
         if ($result == true) {
              $new_id = $addStock->id;
              // Generate Unique refrence number
              $ref_no = "03" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
                $data = [
                  'initial_stock' => $initial_stock,
                  'ref_no' => $ref_no,
                  'unit_price' => 0,
                  'total_amt' => 0,
                  // 'total_amt' => ($initial_stock + $supply) * $unit_price 
                ];
                $addStock->merge_attributes($data);
                $result2 = $addStock->save();
              
              
              // $result2 = true;
              if ($result2 == true) {
                // pre_r($addStock);
                $new_quantity = $initial_stock + $supply;
                $data2 = [
                  'quantity' => $new_quantity,
                  'ref_no' => $ref_no,
                ];
                $products->merge_attributes($data2);
                $result3 = $products->save();
                 // $result3 = true;
              }
             
              if ($result3 == true) {
                $data3 = [
                  'ref_no' => $ref_no,
                  'opened_at' => date('Y-m-d h:i:s'),
                  'opened_by' => $loggedInAdmin->id,
                  
                ];
                $Stock = new Stock($data3);
                $result4 = $Stock->save();
                // pre_r($Stock);
                // $result4 = true;
              }

              if ($result4 == true) {  
                    exit(json_encode(['msg' => 'OK']));
              } else {
                  exit(json_encode(['msg' => display_errors($Stock->errors)]));
              }
         }else{
            exit(json_encode(['msg' => display_errors($addStock->errors)]));
         }
   }else{
    exit(json_encode(['msg' => 'Item Is not yet attached to any product in the menu']));
   }
   

} ?>



<?php if(isset($_POST['openStock'])){
    $args = $_POST['openStock'];
    // pre_r($args);
    $rand = rand(10, 100);
    $data1 = [
        'opened_by' => $loggedInAdmin->id
    ];
    $openRegister = new KitchenRegister($data1);
    // pre_r($openRegister);
    $result = $openRegister->save();
    // $result = true;
    if ($result == true) {
        $new_id = $openRegister->id;
        // Logfile
        $ref_no = "03" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
        $data = ['ref_no' => $ref_no];
        $openRegister->merge_attributes($data);
        $result2 = $openRegister->save();
        // $result2 = true;
        if ($result2 == true) {
            
            // pre_r($args);
            for ($i = 0; $i < count($args); $i++) { 
                  $data2 = [
                    'item' => $_POST['item'][$i],
                    'ref_no' => $ref_no,
                    'open_stock'  => $_POST['open_stock'][$i],
                    'supply' => $_POST['supply'][$i],
                    'total_stock' => $_POST['total_stock'][$i],
                    'unit_price' => $_POST['unit_price'][$i],
                    'total_value' => $_POST['total_value'][$i],
                    'created_by' => $loggedInAdmin->id
                  ];

              $openStock = new KitchenRegisterDetails($data2);
              // pre_r($openStock);
              $result3 = $openStock->save();
              // $result3 = true;
              if ($result3 == true) {

                   $data3 = [
                    'quantity' => $_POST['total_stock'][$i],
                    // 'sold_stock' => $sold,
                   ];  
                   $product = Products::find_by_name($_POST['item'][$i]);
                   $product->merge_attributes($data3);
                   $result4 = $product->save();
               // pre_r($product);
                   // $result4 = true;
               }
               if ($result4 == true) {  
                    exit(json_encode(['msg' => 'OK']));
                } else {
                    exit(json_encode(['msg' => display_errors($product->errors)]));
                }
            }
            
        }
    }

    

} ?>

<?php if(isset($_POST['editStock'])){

   $args = $_POST['editStock'];

    $ref_no = $_POST['editStock']['ref_no'];
    $editCat = StockDetails::find_by_ref($ref_no);              
    $editCat->merge_attributes($args);
    // pre_r($args);
    // pre_r($editCat);
    $result = $editCat->save();
        if ($result == true) {
          $product = Products::find_by_ref($ref_no); 
          $data2 = [
            'quantity' => $_POST['editStock']['supply'],
          ];
          $product->merge_attributes($data2);
          $result1 = $product->save();
        }
       
    if ($result == true) {  
        exit(json_encode(['msg' => 'OK']));
    } else {
        exit(json_encode(['msg' => display_errors($editCat->errors)]));
    }

} exit();?>