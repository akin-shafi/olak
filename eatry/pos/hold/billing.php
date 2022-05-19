<?php require_once('../../private/initialize.php'); ?>
<?php 
// session_start();  

$total_price = 0;
$total_item = 0;
$tax = 0;
$currency = '₦' ;
$sum = 0;

?>

<?php if(isset($_POST['process_bill'])) { 
	$ref_no = $_POST['ref_no'];
	// $order = DraftDetails::find_by_ref($ref_no);
	$order = $_SESSION["hold_cart"];
	// pre_r($order);
	// $customer = Customer::find_by_id($_POST['spos_customer'])->full_name();
?>
	<?php if(!empty($order)) { 
		?>
		
		<?php $product_tax = 0; $sn = 1; foreach($order as $keys => $values):
			// pre_r($values);
			$product = Product::find_by_id($values["product_id"]); 
			$p_qty = $values["product_quantity"];
			$p_price = $values["product_price"];
			$tax = 0;
			$order_tax = $tax + ($p_qty * $product_tax);
			// $t_quantity = array_sum($values->quantity);
			$sum += $p_qty;
			$total_price = $total_price + ($p_qty * $p_price);
			$total_item = count($order);
			// echo $total_item;
			// $grand_total = $total_price + $order_tax;
			$grand_total = $total_price;
			$stockUnit = $product->quantity - $p_qty;
			$subtotal = $p_qty * $p_price;
		?>
		<form id="trans">
			<input type="hidden" name="trans[store_id]" value="<?php echo($_POST['store_id']) ?>">
			<table class="">
				<tr>
				<td><input type="hidden" name="product_id[]" value="<?php echo $values["product_id"]; ?>"></td>
				<!-- <td><input type="hidden" name="product_name[]" value="<?php //echo $values["product_name"]; ?>"></td> -->
				<td><input type="hidden" name="product_quantity[]" value="<?php echo $values["product_quantity"]; ?>"></td>
				<td><input type="hidden" name="discount[]" value="<?php echo $values["product_discount"]; ?>"></td>
				<td><input type="hidden" name="unit_price[]" value="<?php echo $values["product_price"]; ?>"></td>
				<td><input type="hidden" name="subtotal[]" value="<?php echo $subtotal; ?>"></td>
				<td><input type="hidden" name="stockUnit[]" value="<?php echo $stockUnit; ?>"></td>
				</tr>
			</table>
	         <?php endforeach ?>
	         <center id="alert" class=""></center>
	        <input type="hidden" name="trans[customer_id]" value="<?php echo $_POST['spos_customer'] ?>">
	        <input type="hidden" name="trans[total_item]" value="<?php echo $total_item; ?>">
	        <input type="hidden" name="trans[quantity_in_item]" value="<?php echo $sum; ?>">
			<input type="hidden" name="trans[balance]" id="balance_input" value="0">
			<input type="hidden" name="trans[cost_of_item]" id="cost_of_item"  
			value="<?php echo  $total_price; ?>">


		    <div class="modal-body">
			 <div class="row">
			    <div class="col-xs-9">
			       <div class="font16">
			          <table class="table table-bordered table-condensed" style="margin-bottom: 0;">
			             <tbody>
			                <tr>
			                   <td width="25%" style="border-right-color: #FFF !important;">Total Items</td>
			                   <td width="25%" class="text-right"><span id="item_count"><?php echo $total_item .'('. $sum .')'; ?></span></td>
			                   <td width="25%" style="border-right-color: #FFF !important;">Total Payable</td>
			                   <td width="25%" class="text-right"><span id="twt"><?php echo  $total_price; ?></span></td>
			                </tr>
			                <tr>
			                   <td style="border-right-color: #FFF !important;">Total Paying</td>
			                   <td class="text-right"><span id="total_paying"><?php echo $grand_total; ?></span></td>
			                   <td style="border-right-color: #FFF !important;">Discount</td>
			                   <td class="text-right"><span id="balance">0.00</span></td>
			                </tr>
			             </tbody>
			          </table>
			          <div class="clearfix"></div>
			       </div>
			       <div class="row">
			          <div class="col-xs-12">
			             <div class="form-group">
			                <label for="note">Note</label>                                    
			                <textarea name="trans[note]" id="note" class="pa form-control kb-text"></textarea>
			             </div>
			          </div>
			       </div>
			       <div class="row">
			          <div class="col-xs-6">
			             <div class="form-group">
			                <label for="amount">Amount</label>                                    
			                <input name="trans[total_paid]" type="text" id="amount"
			                   class="pa form-control kb-pad amount" />
			             </div>
			          </div>
			          <div class="col-xs-6">
			             <div class="form-group">
			                <label for="paid_by">Paying by</label>                                    
			                <select name="trans[payment_method]" id="payment_method" class="form-control paid_by select2" style="width:100%;">
			                   <option value="">Select method</option>
			                   <option value="cash">Cash</option>
			                   <option value="credit_card">POS</option>
			                   <option value="transfer">Transfer</option>
			                   <option value="cheque">Cheque</option>
			                   <option value="gift_card">Voucher</option>
			                   <!-- <option value="credit">Credit</option> -->
			                   <option value="others">Other</option>
			                </select>
			             </div>
			          </div>
			       </div>
			       <!-- and end with -->
			       <div class="row">
			          <div class="col-xs-12">
			             <div class="form-group gc" style="display: none;">
			                <label for="gift_card_no">Gift Card No</label> 
			                <input type="text" id="gift_card_no"
			                   class="pa form-control kb-pad gift_card_no gift_card_input" value="" />
			                <div id="gc_details"></div>
			             </div>
			             <div class="pcc" style="display:none;">
			                <div class="form-group">
			                   <input type="text" id="swipe" class="form-control swipe swipe_input"
			                      placeholder="Swipe card here then write security code manually"/>
			                </div>
			                <div class="row">
			                   <div class="col-xs-6">
			                      <div class="form-group">
			                         <input type="text" id="pcc_no"
			                            class="form-control kb-pad"
			                            placeholder="Credit Card No"/>
			                      </div>
			                   </div>
			                   <div class="col-xs-6">
			                      <div class="form-group">
			                         <input type="text" id="pcc_holder"
			                            class="form-control kb-text"
			                            placeholder="Holder Name"/>
			                      </div>
			                   </div>
			                   <div class="col-xs-3">
			                      <div class="form-group">
			                         <select id="pcc_type"
			                            class="form-control pcc_type select2"
			                            placeholder="Card Type">
			                            <option value="Visa">Visa</option>
			                            <option
			                               value="MasterCard">MasterCard</option>
			                            <option value="Amex">Amex</option>
			                            <option
			                               value="Discover">Discover</option>
			                         </select>
			                      </div>
			                   </div>
			                   <div class="col-xs-3">
			                      <div class="form-group">
			                         <input type="text" id="pcc_month"
			                            class="form-control kb-pad"
			                            placeholder="Month"/>
			                      </div>
			                   </div>
			                   <div class="col-xs-3">
			                      <div class="form-group">
			                         <input type="text" id="pcc_year"
			                            class="form-control kb-pad"
			                            placeholder="Year"/>
			                      </div>
			                   </div>
			                   <div class="col-xs-3">
			                      <div class="form-group">
			                         <input type="text" id="pcc_cvv2"
			                            class="form-control kb-pad"
			                            placeholder="CVV2"/>
			                      </div>
			                   </div>
			                </div>
			             </div>
			             <div class="pcheque" style="display:none;">
			                <div class="form-group">
			                	<label for="cheque_no">Cheque No</label>
			                	<input type="text" id="cheque_no" name="cheque_no" class="form-control cheque_no kb-text"/>
			                </div>
			             </div>
			             <div class="pcash">
			                <div class="form-group">
			                	<label for="payment_note">Payment Note</label>
			                	<input type="text" id="payment_note" name="trans[payment_note]" class="form-control payment_note kb-text"/>
			                </div>
			             </div>
			          </div>
			       </div> 
			    </div>
			     <?php 
			    	$ten_percent = $grand_total / 100 * 10;
			    	$twenty_percent = $grand_total / 100 * 20;
			    	$thirty_percent = $grand_total / 100 * 30;
			    	$fifty_percent = $grand_total / 100 * 50;
			    	$seventy_percent = $grand_total / 100 * 70;
			     ?>
			    <div class="col-xs-3 text-center d-none">
			       <span style="font-size: 1.2em; font-weight: bold;">Discounts</span>
			       <div class="btn-group btn-group-vertical" style="width:100%;">
			          <button type="button" class="btn btn-info btn-block quick-cash" id="quick-payable" value="<?php echo $grand_total; ?>">Exact Fee<?php //echo number_format($grand_total,2); ?></button>
			          <button type="button" class="btn btn-block btn-warning quick-cash" 
			          value="<?php echo $ten_percent; ?>">10%</button>
			          <button type="button" class="btn btn-block btn-warning quick-cash" 
			          	value="<?php echo $twenty_percent; ?>">20%</button>
			          <button type="button" class="btn btn-block btn-warning quick-cash" 
			          	value="<?php echo $thirty_percent; ?>">30%</button>
			          <button type="button" class="btn btn-block btn-warning quick-cash" 
			          	value="<?php echo $fifty_percent; ?>">50%</button>
			          <button type="button" class="btn btn-block btn-warning quick-cash" 
			          	value="<?php echo $seventy_percent; ?>">70%</button> 
			          <button type="button" class="btn btn-block btn-danger  quick-cash" id="clear-cash-notes" value="">Clear</button>
			       </div>
			    </div>
			 </div>
			</div>
			<div class="modal-footer">
			 <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
			 <button class="btn btn-primary" id="submit-sale">Submit</button>
			</div>
		</form>
			

	<?php }else{ ?>
		<?php echo 'Please add product'; ?>
	<?php } ?>
<?php exit(); } ?>


<?php if (isset($_POST['susModal'])) {  ?>

	<?php 	
		if(!empty($order)){
			exit(json_encode(['msg' => 'OK']));
		}else{
			exit(json_encode(['msg' => 'FAIL']));
			
		}
	?>

<?php } ?>

<?php if($_POST->action == 'show_item') { ?>
	<?php foreach($order as $keys => $values) { ?>
		<?php if($values->product_id == $_POST->id){ ?>
			   <div class="modal-header modal-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                  <h4 class="modal-title" id="proModalLabel">
                     <?php echo $values->product_name ?>                
                  </h4>
               </div>
			   <div class="modal-body">
                  <table class="table table-bordered table-striped">
                     <tr>
                        <th style="width:25%;">Net Price</th>
                        <th style="width:25%;"><span id="net_price"><?php echo number_format($values->quantity * $values->product_price, 2) ?></span></th>
                        <th style="width:25%;">Product Tax</th>
                        <th style="width:25%;"><span id="pro_tax"><?php echo number_format($product_tax, 2) ?></span> <span id="pro_tax_method"></span></th>
                     </tr>
                  </table>
                  <input type="hidden" id="row_id" />
                  <input type="hidden" id="item_id" />
                  <input type="text"  id="product_name_y<?php echo $values->product_id  ?>" value="<?php echo $values->product_name  ?>" />
                  <input type="hidden" id="product_tax<?php echo $values->product_id  ?>" value="<?php echo $product_tax  ?>" />
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="nPrice">Unit Price</label>
                           <input type="text" class="form-control input-sm kb-pad" onClick="this.select();" placeholder="New Price" value="<?php echo $values->product_price  ?>" id="product_price_y<?php echo $values->product_id ?>">
                        </div>
                        <div class="form-group">
                           <label for="nDiscount">Discount</label>
                           <input type="text" class="form-control input-sm kb-pad discount"  onClick="this.select();" placeholder="Discount" value="<?php echo $values->product_discount ?>" data-id="<?php echo $values->product_id ?>" id="product_discount_y<?php echo $values->product_id ?>">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="nQuantity">Quantity</label>                            
                           <input type="text" class="form-control input-sm kb-pad" id="quantity_y<?php echo $values->product_id ?>" onClick="this.select();" placeholder="Current Quantity" value="<?php echo $values->quantity  ?>">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label for="nComment">Comment</label>                            
                           <textarea class="form-control kb-text" id="<?php echo 'comment'.$values->product_id ?>"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button class="btn btn-success" id="editItemy" data-id="<?php echo $values->product_id  ?>">Update</button>
               </div>
		<?php } ?>
	<?php } ?>
<?php } ?>





