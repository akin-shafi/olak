<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_GET)) { 
    $trans_no = $_GET['trans_no'];
    $transaction = Transaction::find_transaction($trans_no);
    $sales = Sales::find_all_transaction($trans_no);

?>

<link rel="stylesheet" media="print" href="<?php //echo url_for('/assets/dist/css/print.css') ?>" />
<style>
    
@page { 
    /*size: B5; */
    size: 80mm 100vh 
} /* output size */
body.receipt .sheet { width: 58mm; height: 100vh } /* sheet size */
@media print { 
    body.receipt { width: 58mm } 
    .modal-body {
        padding: 1px !important;
    }
    .modal-dialog {
        margin: 0px !important;
    }
    @media (min-width: 768px){
        .modal-dialog {
            margin: 0px !important;
        }
    }
} /* fix for Chrome */
</style>    
<body class="receipt">
  <section class="sheet padding-10mm">

    <input type="hidden" name="" id="h_trans" value="<?php echo $transaction->trans_no; ?>">
    <div id="receiptData" style="width: auto; max-width: 580px; min-width: 250px; margin: 0 auto;">
       <!-- <div class="no-print"></div> -->
       <div >
        <?php echo $transaction->trans_no; ?>
            <span id="staff_code"></span>
            <?php 
                if ($transaction->verification_status == 0){
                    echo "<span class='text-danger status'>Unverified</span>";
                }else{ 
                    echo "<span class='text-success status'>Verified</span>";
                }

             ?>
       </div>
       <div style="border-bottom: 5px dashed #000; margin-bottom: 5px; margin-top: 5px; text-align: center;">
        <strike>Tear out this part</strike>
       </div>
       <div id="receipt-data">
        
        
          <div>
             <div style="text-align:center;">
                <!-- <img src="https://spos.tecdiary.net/uploads/logo.png" alt="SimplePOS"> -->
                <p style="text-align:center;">
                    <strong><h3><?php echo $company->company_name; ?></h3></strong>
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
                            echo "Walk-in Customer";
                        }else{
                            echo Customer::find_by_id($transaction->customer_id)->full_name();
                        }

                    ?> <br>
                    Sales Person: <?php echo Admin::find_by_id($transaction->created_by)->full_name(); ?> <br>
                 </div>
                 <!-- <div class="col-xs-4">
                    <div id="bcTarget"></div>
                    <span class="qrcode img-fluid" id="qr_code"></span>
                    

                 </div> -->
             </div>
             <div style="clear:both;"></div>
             <div class="table-responsive">
                 <table class="table table-striped table-condensed" width="100%" style="width:100%;margin-bottom:0;">
                    
                    <tbody>
                        <tr>
                          <th colspan="2" style="text-align:left; border-bottom: 2px solid #ddd;">Product</th>
                          <th colspan="2" style="text-align:left; border-bottom: 2px solid #ddd;">Subtotal</th>
                       </tr>
                       <?php $sn = 1; foreach ($sales as $value) { 
                        $subtotal = $value->product_quantity * Product::find_by_id($value->product_id)->price;
                        ?>
                           <tr>
                              <td colspan="2"><?php echo $sn++ . '.' . Product::find_by_id($value->product_id)->pname; ?><br>
                                (<?php echo $value->product_quantity.'x'. $value->unit_price; ?>)
                              </td>
                              
                              <td colspan="2" class="text-left"><?php echo number_format($value->subtotal, 2); ?></td>
                           </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                       <tr>
                          <td colspan="2">Total</td>
                          <td colspan="2"><?php echo $currency." ".number_format($transaction->cost_of_item, 2); ?></td>
                       </tr>
                       <tr>
                          <td colspan="2">Order Tax</td>
                          <td colspan="2"><?php echo number_format($transaction->tax, 2); ?></td>
                       </tr>
                       <!-- <tr>
                          <td>Rounding</td>
                          <td>0.00</td>
                       </tr> -->
                       <tr>
                          <td colspan="2">Grand Total</td>
                          <td colspan="2"><?php echo $currency." ".number_format($transaction->cost_of_item + $transaction->tax, 2); ?></td>
                       </tr>
                    </tfoot>
                 </table>
                 <table class="table table-striped table-condensed" style="margin-top:10px;">
                    <tbody>
                       <tr>
                          <td colspan="2">Amount Paid:</td>
                          <td><?php echo $currency." ".number_format($transaction->total_paid, 2); ?></td>
                       </tr>
                       <tr>  
                          <td colspan="2" class="text-left">Outstanding :</td>
                          <td><?php echo $currency." ".number_format($transaction->balance, 2);; ?></td>
                       </tr>
                       <tr>
                          <td colspan="2" class="text-left">Paid by :</td>
                          <td colspan="2"><?php echo $transaction->payment_method; ?></td>
                       </tr>
                    </tbody>
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
<?php } ?>