<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_GET['add_payment'])) { 
	$trans_no = $_GET['trans_no'];
	$transaction = Transaction::find_transaction($trans_no);
	
	$grand_total = $transaction->balance;
	$ten_percent = $grand_total / 100 * 10;
	$twenty_percent = $grand_total / 100 * 20;
	$thirty_percent = $grand_total / 100 * 30;
	$fifty_percent = $grand_total / 100 * 50;
	$seventy_percent = $grand_total / 100 * 70;
?>
 
	<!-- <p>Please fill in the information below</p> -->
	<center id="alert" class=""></center>
 	
	
	

	<!-- <input type="hidden" name="trans[customer_id]" value="<?php //echo $transaction->customer_id ?>"> -->
	<!-- <input type="hidden" name="trans[total_item]" value="<?php //echo $transaction->total_item; ?>"> -->
	<!-- <input type="hidden" name="trans[quantity_in_item]" value="<?php //echo $transaction->quantity_in_item; ?>"> -->

	<input type="hidden" id="cbalance" value="<?php echo round($transaction->balance, 0, PHP_ROUND_HALF_DOWN); ?>">
	<input type="hidden" id="tpaid" value="<?php echo $transaction->total_paid; ?>">


	<input type="hidden" name="trans[trans_no]" value="<?php echo $transaction->trans_no ?>">
	
	<!-- <input type="hidden" name="trans[cost_of_item]" id="cost_of_item"  
	value="<?php //echo  $transaction->cost_of_item; ?>"> -->


	
	<input type="hidden" name="trans[balance]" id="balance_input" value="<?php echo round( $transaction->balance, 0, PHP_ROUND_HALF_DOWN); ?>">
	<input type="hidden" id="paid" name="trans[total_paid]" value="">
	<?php 
		if($transaction->customer_id == 0){
			$c_name = "Walk-in Customer";
		}else{
			$c_name = Customer::find_by_id($transaction->customer_id)->full_name();
		}  
	 ?>
    <input id="r_cname" type="hidden" data-name="<?php echo $c_name; ?>" value="<?php echo $transaction->customer_id; ?>">
	
	    <div class="col-xs-9">
	       <div class="font16 bg-success" style="color: #000; font-weight: bold; margin-bottom: 10px">
	          <table class="table table-bordered table-condensed" style="margin-bottom: 0;">
	             <tbody>
	                <tr>
	                   <td width="25%" style="border-right-color: #FFF !important;">Total Items</td>
	                   <td width="25%" class="text-right"><span id="item_count"><?php echo $transaction->total_item .'('. $transaction->quantity_in_item .')'; ?></span></td>
	                   <td width="25%" style="border-right-color: #FFF !important;">Total Payable</td>
	                   <td width="25%" class="text-right"><span id="twt"><?php echo  $transaction->cost_of_item; ?></span></td>
	                </tr>
	                <tr>
	                   <td style="border-right-color: #FFF !important;">Total Paying</td>
	                   <td class="text-right"><span id="total_paying"><?php echo $transaction->total_paid; ?></span></td>
	                   <td style="border-right-color: #FFF !important;">Debt</td>
	                   <td class="text-right"><span id="balance"><?php echo number_format($transaction->balance, 2); ?></span></td>
	                </tr>
	             </tbody>
	          </table>
	          <div class="clearfix"></div>
	       </div>

	       

	       <div class="row">
	          <div class="col-xs-12">
	             <div class="form-group">
	                <label for="note">Note</label>                                    
	                <textarea name="trans_details[note]" id="note" class="pa form-control kb-text"></textarea>
	             </div>
	          </div>
	       </div>
	       <div class="row">
	          <div class="col-xs-6">
	             <div class="form-group">
	                <label for="amount">Amount</label>                                    
	                <input required="" name="trans_details[total_paid]" type="number" id="amount"
	                   class="pa form-control kb-pad amount" min="0" max="<?php echo round($transaction->balance, 0, PHP_ROUND_HALF_DOWN) ?>"  />
	             </div>
	          </div>
	          <div class="col-xs-6">
	             <div class="form-group">
	                <label for="paid_by">Paying by</label>                                    
	                <select required="" name="trans_details[payment_method]" id="payment_method" class="form-control paid_by select2" style="width:100%;">
	                   <option value="">Select method</option>
	                   <option value="cash">Cash</option>
	                   <option value="CC">Credit Card</option>
	                   <option value="cheque">Cheque</option>
	                   <option value="gift_card">Gift Card</option>
	                   <option value="stripe">Stripe</option>
	                   <option value="other">Other</option>
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
	                	<input type="text" id="payment_note" name="trans_details[payment_note]" class="form-control payment_note kb-text"/>
	                </div>
	             </div>
	          </div>
	       </div> 
	    </div>
	    <div class="col-xs-3 text-center">
	       <span style="font-size: 1.2em; font-weight: bold;">Quick Cash</span>
	       <div class="btn-group btn-group-vertical" style="width:100%;">
	          <button type="button" class="btn btn-info btn-block quick-cash" id="quick-payable" value="<?php echo round($grand_total, 0, PHP_ROUND_HALF_DOWN); ?>"><?php echo round($grand_total, 0, PHP_ROUND_HALF_DOWN) ; ?></button>
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
	 
<!-- </form> -->

<?php  } ?>

