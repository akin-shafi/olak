<?php

//fetch_cart.php

session_start();

$total_price = 0;
$total_item = 0;
$tax = 0;
$sum = 0; 

	$output = '
	<div class="table-responsive" id="order_table">
		<table class="table table-bordered table-striped">
			
	';
	if(!empty($_SESSION["shopping_cart"])){
		$pn = 1; $qn = 1; $an = 1;  foreach($_SESSION["shopping_cart"] as $keys => $values)
		
		{	
			
			$output .= '

			<tr id="p_'.$values["product_id"].'" class="'.$values["product_id"].'" data-item-id="'.$values["product_id"].'" data-id="'.$values["product_id"].'">
				<td><button type="button" class="btn bg-purple btn-block btn-xs edit" data-id="'.$values["product_id"].'"><span class="sname" id="name_'.$values["product_name"].'"><span class="sname" id="name_'.$values["product_name"].'">'.$values["product_name"] .' </span></button> <input type="hidden" name="product_name[]" value="'.$values["product_name"].'" class="product_name'.$values["product_id"].'">
					<input type="hidden" id="product_name'.$values["product_id"].'" value="'.$values["product_name"].'"> 
					<input type="hidden" name="product_id[]"  value="'.$values["product_id"].'">
				</td>

				<td align="right"> '.$values["product_price"].' <input type="hidden" name="product_price[]" id="unit_cost'.$values["product_id"].'" value="'.$values["product_price"].'" class="unit_cost"></td>
				
				<td align="center">
				
				<div class="dropdown user user-menu">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<input autocomplete="off"  class="form-control input-qty kb-pad text-center qty" name="quantity[]" type="text" 
							value="'.$values["product_quantity"].'" id="quantity'.$values["product_id"].'" data-id="'.$values["product_id"].'" >
                            
                        </div>
                        <div class="dropdown-menu" style="right: 0; left: auto;">
                            <div class="keypad">
                                <div class="key" data-id="1">1</div>
                                <div class="key" data-id="1">2</div>
                                <div class="key" data-id="1">3</div>
                                <div class="key" data-id="1">4</div>
                                <div class="key" data-id="1">5</div>
                                <div class="key" data-id="1">6</div>
                                <div class="key" data-id="1">7</div>
                                <div class="key" data-id="1">8</div>
                                <div class="key" data-id="1">9</div>
                                <div class="key" data-id="clear">clear</div>
                                <div class="key" data-id="1">0</div>
                                <!-- <div class="key" data-id="1">&rarr;</div> -->
                                <div class="key" data-id="backspace">&larr;</div>
								<div style="padding:2px;">
									<div class="btn-success key" data-id="confirm" style="width:100%;">Confirm</div>
								</div>
                            </div>
                        </div>
                    </div>
				</td>
				
				<td align="right" id="total'.$values["product_id"].'"> '.number_format($values["product_quantity"] * $values["product_price"], 2).'
				<input type="hidden" size="1" class="amount" name="total_price[]" value="'.$values["product_quantity"] * $values["product_price"].'" id="total_price'.$values["product_id"].'">
				</td>

				<td><button type="button" name="delete" class="btn btn-danger btn-xs deleteItem" id="'. $values["product_id"].'"><i class="fa fa-trash-o"></i></button></td>

				<input type="hidden" size="1" class="tax" name="product_tax[]" value="'.$values["product_tax"].'" id="p_tax'.$values["product_id"].'">

				<input type="hidden" size="1" class="discount" name="product_discount[]" value="'.$values["product_id"].'" id="product_discount'.$values["product_id"].'">

				

			</tr>
			';
			$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
			$total_item = $total_item + 1;
			// $tax = $tax + ($values["product_quantity"] * $values["product_tax"]);
			$tax = $tax + ($values["product_quantity"] * 0);
			$sum += $values['product_quantity'];
			
		}
		
	}
	else
	{
		$output .= '
	    <tr>
	    	<td colspan="5" align="center">
	    		Your Cart is Empty!
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
		// 'stockUnit'			=>	$stockUnit,
		// 'total_payable'	    =>	 number_format($total_price + $tax, 2),
		'total_payable'	    =>	 number_format($total_price, 2),
	);	

	echo json_encode($data);



if (isset($_POST['edit_cart'])) {

}


?>