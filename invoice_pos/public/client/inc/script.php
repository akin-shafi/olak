<?php require_once('../../../private/initialize.php');

if (is_post_request()) {
  
    // $args['credit_facility'] = $_POST['credit_facility'] == 'on' ? 1 : 0;
    $customer = new Client($_POST);

    // pre_r($customer);
    $result = $customer->save();

    


    // if ($result == true) {
    //     $new_id = $client->id;
    //     $rand = rand(10, 200);
    //     $date = date('ymd');

    //     $customer_id = 'C' . str_pad($new_id, 2, '0', STR_PAD_LEFT) . $date;
    //     $customer = Client::find_by_id($new_id);
    //     $data1 = [
    //     'customer_id' => $customer_id,
    //     ];
    //     $customer->merge_attributes($data1);
    //     $data_set = $customer->save();



    
            // if ($data_set == true) {
            //     exit(json_encode(['success' => true, 'msg' => 'The customer was created successfully', 'invoice_no' => $invoice_no]));
            // }
    // } else {
    //     // show errors
    // }
}

?>
