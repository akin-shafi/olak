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
$draftDetails = DraftDetails::find_by_ref($_POST['ref_no']);
$customer_id = Draft::find_by_ref($_POST['ref_no'])->customer_id;

if(!empty($draftDetails))
	{
		$pn = 1; $qn = 1; $an = 1;  
		
		foreach($draftDetails as $keys => $values){	
			$product = Product::find_product($values->product_id);
			// pre_r($product);

			$stockUnit = '';
			$product_tax = 0;
			$output .= '

			<tr id="p_'.$values->id.'" class="'.$values->id.'" data-item-id="'.$values->id.'" data-id="'.$values->id.'">
				<td><button type="button" class="btn bg-purple btn-block btn-xs edit" data-id="'.$values->id.'"><span class="sname" id="name_'.$values->product_name.'"><span class="sname" id="name_'.$values->product_name.'">'.$values->product_name .' ('.$stockUnit.')</span></button> <input type="hidden" name="product_name[]" value="'.$values->product_name.'" class="product_name'.$values->id.'">
					<input type="hidden" id="product_name'.$values->id.'" value="'.$values->product_name.'"> 
					<input type="hidden" name="product_id[]"  value="'.$values->id.'">
				</td>

				<td align="right"> '.$values->product_price.' <input type="hidden" name="product_price[]" id="unit_cost'.$values->id.'" value="'.$values->product_price.'" class="unit_cost"></td>
				
				<td align="center">
				<input autocomplete="no" class="form-control input-qty kb-pad text-center qty" name="quantity[]" type="text" value="'.$values->quantity.'" id="quantity'.$values->id.'" data-id="'.$values->id.'" max="'.$stockUnit.'">
				</td>
				
				<td align="right" id="total'.$values->id.'"> '.number_format($values->quantity * $values->product_price, 2).'
				<input type="hidden" size="1" class="amount" name="total_price[]" value="'.$values->quantity * $values->product_price.'" id="total_price'.$values->id.'">
				</td>

				<td><button type="button" name="delete" class="btn btn-danger btn-xs deleteItem" id="'. $values->id.'"><i class="fa fa-trash-o"></i></button></td>

				<input type="hidden" size="1" class="tax" name="product_tax[]" value="'.$product_tax.'" id="p_tax'.$values->id.'">

				<input type="hidden" size="1" class="discount" name="product_discount[]" value="'.$values->id.'" id="product_discount'.$values->id.'">

				<input type="hidden" size="1" class="tax" name="stockUnit[]" value="'.$stockUnit.'" id="stockUnit'.$values->id.'">

			</tr>
			';
			$total_price = $total_price + ($values->quantity * $values->product_price);
			$total_item = $total_item + 1;
			// $tax = $tax + ($values->quantity * $values->product_tax);
			$tax = $tax + ($values->quantity * 0);
			$sum += $values->quantity;
			
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
	);	

	echo json_encode($data);



if (isset($_POST['edit_cart'])) {

}


?>