<?php require_once('../../private/initialize.php'); ?>
<?php if(isset($_POST['draft'])){ 
  $draftDetails = DraftDetails::find_by_ref($_POST['ref_no']);
  // pre_r($draftDetails);
?>
	<table class="table text-center table-sm">
		<thead>
			
			  <tr class="success text-uppercase">
			  	 <td>SN</td>
	             <th>Product</th>
	             <th style="width: 15%;text-align:center;">Price(₦)</th>
	             <!-- <th></th> -->
	             <th style="width: 15%;text-align:center;">Qty</th>
	             <th style="width: 20%;text-align:center;">Subtotal(₦)</th>
	             <th style="width: 20px;" class="satu"><i class="fa fa-trash-o"></i></th>
	          </tr>
		</thead>
		<tbody>
			<?php $sn = 1; foreach ($draftDetails as $key => $value) { ?>
				<tr>
					<td><?php echo $sn++; ?></td>
					<td><?php echo $value->product_name; ?></td>
					<!-- <td><?php //echo $value->quantity; ?></td> -->
					<td align="center">
						<input size="4" autocomplete="no" class="form-control input-qty kb-pad text-center qty" name="quantity[]" type="text" value="<?php echo $value->quantity; ?>" id="quantity4" data-id="4">
					</td>
					<td><?php echo $value->product_price; ?></td>
					<td><?php echo $value->total_price; ?></td>
					<td><button type="button" name="delete" class="btn btn-danger btn-xs deleteItem" id="4"><i class="fa fa-trash-o"></i></button></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<table id="totaltbl" class="table table-condensed totals" style="margin-bottom:10px;">
        <tbody>
           <tr class="info">
              <td width="25%">Total Items</td>
              <td class="text-right" style="padding-right:10px;">
                 <span id="count">1</span>(<span id="total_quantity">1</span>)
                 <input type="hidden" name="total_item" id="t_item" value="1">
               </td>
              <td width="25%">Total</td>
              <td class="text-right" colspan="2"><span id="total">1,500.00</span></td>
           </tr>
           <tr class="info">
              <td width="25%"><a href="#" id="add_discount">Discount</a></td>
              <td class="text-right" style="padding-right:10px;"><span id="ds_con">0</span></td>
              <td width="25%"><a href="#" id="add_tax">Order Tax</a></td>
              <td class="text-right"><span id="ts_con">0</span></td>
           </tr>
           <tr class="success">
              <td colspan="2" style="font-weight:bold;">
                 Total Payable                                                            
                 <a role="button" data-toggle="modal" data-target="#noteModal">
                 <i class="fa fa-comment"></i>
                 </a>
              </td>
              <td class="text-right" colspan="2" style="font-weight:bold;">
                 <span id="total-payable">1,500.00</span></td>
           </tr>
        </tbody>
     </table>
<?php } ?>