<?php require_once('../../private/initialize.php'); ?>
<?php if (isset($_POST)) {

    $args = $_POST['trans'];
    $transaction = Transaction::find_transaction($args['trans_no']);
    $transaction->merge_attributes($args);
    $result = $transaction->save();
    $result = true;
	if ($result === true) {
		$args2 = $_POST['trans_details'];
	    $trans_details = new TransactionDetail($args2);

	    $new_ref_id = $transaction->id;
      	$dym = rand(10, 200);
      	// Create ref_no dynamically
        $ref_no = 'Ref'. "1" . str_pad($new_ref_id, 2, "0", STR_PAD_LEFT) . $dym;

	    $args3 = [
	    	'trans_no' => $args['trans_no'],
	    	'ref_no' => $ref_no,
	    	'outstanding' => $args['balance'],
	    	'created_by' => $loggedInAdmin->id,
	    ];
	    $trans_details->merge_attributes($args3);
	    $result2 = $trans_details->save();
	    if($result2 === true){
	    	exit(json_encode(['msg' => 'OK' ]));
	    }else{
	    	exit(json_encode(['msg' => 'FAIL' ]));
	    }
    }
 }

?>