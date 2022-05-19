<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_POST['view_payment'])) { 
	$trans_no = $_POST['trans_no'];
	$transactionDetails = TransactionDetail::find_transaction($trans_no);
	$transaction = Transaction::find_transaction($trans_no);
	// pre_r($transactionDetails);
?>
	<div class="row">
		<div class="col-xs-6">
			
			<table class=" table-condensed">
		        <tbody>
		        	<tr>
		        		<td>Trans No:</td> <td style="font-size: 30px;"><?php echo $transaction->trans_no; ?></td>
		        	</tr>
		        	<tr>
						<td>Customer Name: </td>
						<td><?php 
			        		if($transaction->customer_id == 0){
			        			echo "Walk-in Customer";
			        		}else{
			        			echo Customer::find_by_id($transaction->customer_id)->full_name();
			        		}

		                ?> </td>
		            </tr>
		            <tr>
		        		<td>Date:</td> <td><?php echo date("D d M Y h:i:a", strtotime($transaction->created_at)); ?></td>
		        	</tr>	
		           
		        </tbody>
		     </table>
		</div>
		<div class="col-xs-6"></div>
	</div>
	<div class="table-responsive" >
	  <table id="CompTable" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
		   <thead>
		      <tr>
		         <th >Sn</th>
		         <th >Date</th>
		         <th >Reference</th>
		         <th >Amount</th>
		         <th >Outstanding</th>
		         <th >Paid by</th>
		         <th >Sales Person</th>
		         <th >Actions</th>
		      </tr>
		   </thead>
		   <tbody>
		   	 <?php $sn = 1; $rn = 1; foreach($transactionDetails as $value){ ?>
			    <tr class="text-center row<?php echo $rn++ ?>">
			       <td><?php echo $sn++ ?></td>
			       <td><?php echo date('D d M Y h:i:a', strtotime($value->paid_at)); ?></td>
			       <td><?php echo $value->ref_no; ?></td>
			       <td class=""><?php echo number_format($value->total_paid, 2); ?></td>
			       <td class=""><?php echo number_format($value->outstanding, 2); ?></td>
			       <td><?php echo $value->payment_method ?></td>
			       <td><?php echo Admin::find_by_id($transaction->created_by)->full_name(); ?></td>
			       <td>
			          <div class="">
			             <!-- <a href="https://spos.tecdiary.net/sales/payment_note/1"><i class="fa fa-file-text-o"></i></a> -->
			             <a class="tip" href="https://spos.tecdiary.net/sales/edit_payment/1" data-toggle="ajax"><i class="fa fa-edit"></i></a>
			             <a class="tip" title="Delete Payment" href="https://spos.tecdiary.net/sales/delete_payment/1" onclick="return confirm('You are going to delete payment, please click ok to delete.')"><i class="fa fa-trash-o"></i></a>
			          </div>
			       </td>
			    </tr>
			<?php } ?>
		   </tbody>

		    
	  </table>
	  <table class=" table-condensed" style="margin-top:10px;" align="right">
        <tbody >
        	
           <tr>
           	  <td class="text-right">Total Cost of Items :</td>
              <td><?php echo $currency." ".number_format($transaction->cost_of_item, 2); ?></td>
           </tr>
           <tr>
           	  <td class="text-right">Amount Paid:</td>
              <td><?php echo $currency." ".number_format($transaction->total_paid, 2); ?></td>
           </tr>
           <tr>  
           	  <td class="text-right">Outstanding :</td>
              <td><?php echo $currency." ".number_format($transaction->balance, 2);; ?></td>
              
           </tr>
        </tbody>
     </table>


	</div>
<?php } ?>