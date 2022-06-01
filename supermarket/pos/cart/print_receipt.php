<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_GET)) { 
	$trans_no = $_GET['trans_no'];
	$transaction = Transaction::find_transaction($trans_no);
	$sales = Sales::find_all_transaction($trans_no);
	$where = $_GET['where'];

}?>
<style type="text/css">
 .bolder{
    color: #000; font-weight: bolder !important;
  }
  td,
    th,
    tr,
    .print-table {
        border-top: 1px solid black;
        border-collapse: collapse;
        width: 75%;
        /*font-size: 12px;*/
    }
    table th {
        width: auto !important;
        /*padding: 0px 0px 0px 50px;*/
    }
</style>
<link rel="stylesheet" media="print" href="<?php echo url_for('/assets/dist/css/printer-58mm.css') ?>" />
<body class="receipt">
  <section class="sheet padding-10mm">

    <input type="hidden" name="" id="h_trans" value="<?php echo $transaction->trans_no; ?>">
    <div id="receiptData" style="padding-left: 10px;">
       <div id="receipt-data">
        
        
          <div>
             <div style="text-align:left;">
                <!-- <img src="https://spos.tecdiary.net/uploads/logo.png" alt="SimplePOS"> -->
                <p style="text-align:center;">
                    <strong><h4><?php echo $company->company_name; ?></h4></strong>
                    <h5><?php echo $company->address; ?></h5>
                     <h5><?php echo $company->phone_no; ?></h5>
                </p>
                <p></p>
             </div>
             <div class="row">
                 <div class="col-xs-12">
                    Date: <?php echo date('D d M Y h:i:a', strtotime($transaction->created_at)); ?> <br>
                    Sale No/Ref: <?php echo $transaction->trans_no; ?><br>
                    Customer: 
                    <?php 
                        if($transaction->customer_id == 0){
                            echo "Walk-in";
                        }else{
                            echo Customer::find_by_id($transaction->customer_id)->full_name();
                        }

                    ?> <br>
                    Sales Person: <?php echo Admin::find_by_id($transaction->created_by)->first_name; ?> <br>
                 </div>
                 <!-- <div class="col-xs-4">
                    <div id="bcTarget"></div>
                    <span class="qrcode img-fluid" id="qr_code"></span>
                    

                 </div> -->
             </div>
             <div style="clear:both;"></div>
             <div class="table-responsive">
                 <table class="print-table" >
                    
                    <tbody>
                        <tr>
                          <th colspan="" style="text-align:left; border-bottom: 2px solid #ddd;">Product</th>
                          <th colspan="" style="text-align:left; border-bottom: 2px solid #ddd;">Qty</th>
                          <th colspan="" style="text-align:left; border-bottom: 2px solid #ddd;">Subtotal(<?php echo $currency ?></th>
                       </tr>
                       <?php $sn = 1; foreach ($sales as $value) { 
                        $subtotal = $value->product_quantity * Product::find_by_id($value->product_id)->price;
                        ?>
                           <tr>
                              <td colspan=""><?php echo $sn++ . '.' . Product::find_by_id($value->product_id)->pname; ?><br>
                                
                              </td>
                              <td colspan="">(<?php echo $value->product_quantity.'x'. $value->unit_price; ?>)</td>
                              <td colspan="" class="text-left"><?php echo number_format($value->subtotal, 2); ?></td>
                           </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                       <tr>
                          <td>Total</td>
                          <td><?php echo number_format($transaction->cost_of_item, 2); ?></td>
                       </tr>
                       <tr>
                          <td>Order Tax</td>
                          <td><?php echo number_format($transaction->tax, 2); ?></td>
                       </tr>
                       <tr>
                          <td>Grand Total</td>
                          <td><?php echo number_format($transaction->cost_of_item + $transaction->tax, 2); ?></td>
                       </tr>
                    </tfoot>
                 </table>
                 
             </div>
             <div id="bcTarget"></div>
             <span class="qrcode img-fluid" id="qr_code"></span>
             <div class="" style="margin-top:10px;">

                <div style="text-align: center;">

                    <?php echo 'This receipt is from the '.Store::CATEGORY[$transaction->store_id]  ?? ''; //; ?>
                    
                </div>
             </div>
          </div>
          <div style="clear:both;"></div>
       </div>
       <!-- start -->
       <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
          <hr>
          <div class="btn-group btn-group-justified" role="group" aria-label="...">
             <div class="btn-group" role="group">
                <button id="print" href="<?php echo url_for('/pos/cart/print_receipt.php?trans_no='. $trans_no) ?>" onclick="window.print();" class="btn btn-block btn-primary">Print</button>                                
             </div>
             <div class="btn-group" role="group">
                <a class="btn btn-block btn-success" href="#" id="email">Email</a>
             </div>
             <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
          </div>
          <div style="clear:both;"></div>
       </div>
       <!-- end -->
    </div>
  </section>
</body>

<?php if ($where != "table") { ?>
  <script type="text/javascript">
	    	 
	  // $(document).ready(function() {
	  // 	setTimeout(function(){
		 // 	window.print(); 
		 // }, 1000);//wait 1 seconds
	     
	  //    setTimeout(function(){
	  //    	$('#receiptModal').modal('hide');
		 // }, 1000);//wait 1 seconds
	  // });
  </script>
<?php } ?>

