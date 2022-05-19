<?php require_once('../private/initialize.php'); ?>

<?php //if(isset($_GET)) { 
    $trans_no = $_GET['trans_no'];
    $transaction = CheckOut::find_transaction($trans_no);
    $sales = CheckOutDetails::find_all_transaction($trans_no);
    // $where = $_GET['where'];

// }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Invoice <?php echo $transaction->trans_no; ?></title>
      <base href="<?php echo url_for('/') ?>"/>
      <meta http-equiv="cache-control" content="max-age=0"/>
      <meta http-equiv="cache-control" content="no-cache"/>
      <meta http-equiv="expires" content="0"/>
      <meta http-equiv="pragma" content="no-cache"/>
      <link rel="shortcut icon" href="<?php echo url_for('assets/images/icon.png') ?>"/>
      <link href="<?php echo url_for('assets/dist/css/styles.css') ?>" rel="stylesheet" type="text/css" />
      <style type="text/css" media="all">
         body { color: #000; }
         #wrapper { max-width: 520px; margin: 0 auto; padding-top: 20px; }
         .btn { margin-bottom: 5px; }
         .table { border-radius: 3px; width: 85%; word-wrap:break-word; margin: 0 auto;
              table-layout: fixed;}

         .table th { background: #f5f5f5; }
         table thead th {
             text-align: left !important; 
          }
         .table th, .table td { vertical-align: left !important; }
         h3 { margin: 5px 0; }
         @media print {
         .no-print { display: none; }
         #wrapper { max-width: 480px; width: 100%; min-width: 218px; margin: 0 auto; }
         }
         tfoot tr th:first-child { text-align: right; }
      </style>
   </head>
   <body>
      <div id="wrapper">
         <div id="receiptData" style="width: auto; max-width: 580px; min-width: 250px; margin: 0 auto;">
            <div class="no-print">
            </div>
            <div id="receipt-data">
               <div>
                  <div style="text-align:center;">
                     
                     <p style="text-align:center;">
                        <strong><?php echo $company->company_name; ?></strong><br>
                        <?php echo $company->address; ?><br><?php echo $company->phone_no; ?></p>
                     <p></p>
                  </div>
                  <p style="width: 85%; margin: 0 auto; font-size: 12px">
                      Date: <?php echo date('D d M Y h:i:a', strtotime($transaction->created_at)); ?> <br>
                        Sale No/Ref: <?php echo $transaction->trans_no; ?><br>
                        Receiver: 
                        <?php echo $transaction->receiver; ?> <br>
                        Sales Person: <?php echo Admin::find_by_id($transaction->created_by)->first_name; ?> <br>
                  </p>
                  <div style="clear:both;"></div>
                  <table class="table table-striped table-condensed table-bordered" style="font-size: 12px;">
                     <thead>
                        <tr>
                           <th class="text-center" style="width: 30%; border-bottom: 2px solid #ddd;">Item</th>
                           <th class="text-left" style="width: 15%; border-bottom: 2px solid #ddd;">Qty</th>
                           <th class="text-left" style="width: 15%; border-bottom: 2px solid #ddd;"><?php echo $currency ?></th>
                           <th class="text-left" style="width: 20%; border-bottom: 2px solid #ddd; word-wrap: break-all">S.total</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $sn = 1; foreach ($sales as $value) { 
                        $subtotal = $value->product_quantity * WarehouseItem::find_by_id($value->product_id)->price;

                        ?>
                        <tr>
                           <td><?php echo $sn++ . '.' . WarehouseItem::find_by_id($value->product_id)->item_name; ?></td>
                           <td style="text-align:center;"><?php echo $value->product_quantity ?></td>
                           <td class="text-left"><?php echo $value->unit_price; ?></td>
                           <td class="text-left"><?php echo number_format($value->subtotal, 2); ?></td>
                        </tr>
                        <?php } ?>
                     </tbody>
                     <tfoot>
                        <tr>
                           <th class="text-left" colspan="2">Total</th>
                           <th colspan="2"><?php echo number_format($transaction->total_cost, 2); ?></th>
                        </tr>
                        

                        
                     </tfoot>
                  </table>
                  
                  <div class="well well-sm"  style="margin-top:10px;">
                     <div style="text-align: center; font-size: 12px">Printed On: <?php echo date('D d M Y h:i:a') ?></div>
                  </div>
               </div>
               <div style="clear:both;"></div>
            </div>
            <!-- start -->
            <div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">
               <hr>
               <span class="pull-right col-xs-12">
               <button onclick="window.print();" class="btn btn-block btn-primary">Print</button>                            </span>
               <span class="pull-left col-xs-12"><a class="btn btn-block btn-success" href="#" id="email">Email</a></span>
               <span class="col-xs-12">
               <a class="btn btn-block btn-warning" href="<?php echo url_for('/pos') ?>">Back to POS</a>
               </span>
               <div style="clear:both;"></div>
            </div>
            <!-- end -->
         </div>
      </div>
      <!-- start -->
 
      <script src="<?php echo url_for('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
      <script type="text/javascript">
         $(document).ready(function () {
             $('#print').click(function (e) {
                 e.preventDefault();
                 var link = $(this).attr('href');
                 $.get(link);
                 return false;
             });
             $('#email').click(function () {
                 bootbox.prompt({
                     title: "Email Address",
                     inputType: 'email',
                     value: "customer@tecdiary.com",
                     callback: function (email) {
                         if (email != null) {
                             $.ajax({
                                 type: "post",
                                 url: "https://spos.tecdiary.net/pos/email_receipt",
                                 data: {spos_token: "318f15a5a048dba6358dff789a627de2", email: email, id: 2},
                                 dataType: "json",
                                 success: function (data) {
                                     bootbox.alert({message: data.msg, size: 'small'});
                                 },
                                 error: function () {
                                     bootbox.alert({message: 'Ajax request failed!', size: 'small'});
                                     return false;
                                 }
                             });
                         }
                     }
                 });
                 return false;
             });
         });
      </script>
      <!-- end -->
     
<?php //if ($where != "table") { ?>
  <script type="text/javascript">
             
      $(document).ready(function() {
         setTimeout(function(){
             window.print(); 
         }, 1000);//wait 1 seconds
         
         setTimeout(function(){
             window.close();
         }, 1000);//wait 1 seconds
      });
  </script>
<?php //} ?>
   </body>
</html>
