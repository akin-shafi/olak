<?php require_once('../../private/initialize.php'); ?>
<?php

//fetch_cart.php

// session_start();

$total_price = 0;
$total_item = 0;
$tax = 0;
$sum = 0;

	$output = '
	<div class="table-responsive" id="order_table">
		<table class="table table-bordered table-striped">
			
	';
	// print_r($_SESSION->shopping_cart);
// <?php if(isset($_GET)) { 
	$trans_no = $_POST['trans_no'] ?? '';
	$transaction = Transaction::find_transaction($trans_no);
	$sales = Sales::find_all_transaction($trans_no);

// $transaction = DraftDetails::find_by_ref($_POST['ref_no']);
$customer_id = $transaction->customer_id;

if(!empty($sales))
	{
		$pn = 1; $qn = 1; $an = 1;  
		
		foreach($sales as $keys => $value){	
			// $product = Transaction::find_transaction($trans_no);
			// pre_r($value);

			$stockUnit = Product::find_by_id($value->product_id)->quantity;
			$product_tax = 0;
			$price = $value->unit_price ; //Product::find_by_id($value->id)->price;
			$quantity = $value->product_quantity;
			// print_r($quantity);
			$output .= '

			<tr id="p_'.$value->product_id.'" class="'.$value->product_id.'" data-item-id="'.$value->product_id.'" data-id="'.$value->product_id.'">
				<td><button type="button" class="btn bg-purple btn-block btn-xs edit" data-id="'.$value->product_id.'"><span class="sname" id="name_'.Product::find_by_id($value->product_id)->pname.'"><span class="sname" id="name_'.Product::find_by_id($value->product_id)->pname.'">'.Product::find_by_id($value->product_id)->pname .' ('.$stockUnit.')</span></button> <input type="hidden" name="product_name[]" value="'.Product::find_by_id($value->product_id)->pname.'" class="product_name'.$value->product_id.'">
					<input type="hidden" id="product_name'.$value->id.'" value="'.Product::find_by_id($value->product_id)->pname.'"> 
					<input type="hidden" name="id[]"  value="'.$value->product_id.'">
				</td>

				<td align="right"> '.$price.' <input type="hidden" name="product_price[]" id="unit_cost'.$value->id.'" value="'.$price.'" class="unit_cost"></td>
				
				<td align="center">
				<input autocomplete="no" class="form-control input-qty kb-pad text-center qty" name="quantity[]" type="text" value="'.$quantity.'" id="quantity'.$value->id.'" data-id="'.$value->id.'" max="'.$stockUnit.'">
				</td>
				
				<td align="right" id="total'.$value->id.'"> <span id="sub_'.$value->id.'">'.$quantity * $price .'</span>
				<input type="hidden" size="1" class="amount" name="total_price[]" value="'.$quantity * $price.'" id="total_price'.$value->id.'">
				</td>
				

				<input type="hidden" size="1" class="tax" name="product_tax[]" value="'.$product_tax.'" id="p_tax'.$value->id.'">

				<input type="hidden" size="1" class="discount" name="product_discount[]" value="'.$value->id.'" id="product_discount'.$value->id.'">

				<input type="hidden" size="1" class="tax" name="stockUnit[]" value="'.$stockUnit.'" id="stockUnit'.$value->id.'">

			</tr>
			';
			$total_price = $total_price + ($quantity * $price);
			$total_item = $total_item + 1;
			// $tax = $tax + ($quantity * $values->product_tax);
			$tax = $tax + ($quantity * 0);
			$sum += $quantity;
			
		}
		
	}
	else
	{
		$output .= '
	    <tr>
	    	<td colspan="5" align="center">
	    		Your Cart is empty!
	    	</td>
	    </tr>
	    ';
	}
	$output .= '</table></div>';
	$data = array(
		'cart_details'		=>	$output,
		'total_price'		=>	 number_format($total_price, 2),
		'total_item'		=>	$total_item,
		'total_quantity'	=>	$sum,
		'tax'			    =>	$tax,
		'customer_id'		=>	$customer_id,
		// 'total_payable'	    =>	 number_format($total_price + $tax, 2),
		'total_payable'	    =>	 number_format($total_price, 2),
		'gtotal'	    	=>	 $total_price,
	);	

	echo json_encode($data);



?>