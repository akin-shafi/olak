<?php require_once('../private/initialize.php'); ?>
<?php 
$from = $_GET['from'] ?? date('Y-m-d');
$to = $_GET['to'] ?? date('Y-m-d'); 
$location = $_GET['location'] ?? ""; 
// $created_by = "";
$created_by = $_GET['created_by'] ?? $loggedInAdmin->id;

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Order Report</title>
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
                        <?php echo $company->address; ?><br><?php echo $company->phone_no; ?>
                    </p>
                     <p><h2>Order Report</h2></p>
                  </div>
                  <p style="width: 85%; margin: 0 auto; font-size: 12px">
                      Date: <?php echo date('D d M Y', strtotime($from)) .' to '. date('D d M Y', strtotime($to)); ?> <br>
                        Sales Person:  <?php echo $created_by != "" ? Admin::find_by_id($created_by)->full_name() : "All"; ?><br>
                  </p>
                  <div style="clear:both;"></div>
                     <table  class="table">
                     	<thead>
                     		<tr>
                         		<th>Item</th>
                         		<th>Pr/Q</th>
                         		<th>Total</th>
                         	</tr>
                     	</thead>
                         <tbody>
                         <?php foreach (Product::find_by_undeleted(['order' => 'ASC']) as  $value) { 
                                          
                          if ($created_by != "") {
                            $sales = Sales::find_all_by_product_id(['product_id' => $value->id,'created_by'=>  $created_by,'from'=>  $from,'to'=>  $to]);
                          }else{
                            $sales = Sales::find_all_by_product_id(['product_id' => $value->id,'from'=>  $from,'to'=>  $to]);
                          }
                          
                          $qty = $sales ?? 0;
                          $subtotal = $qty * $value->price ?? 0;
                          ?>
                          
                              <?php if ($value->ref_no != "" ) { ?>
                                    <?php if ($qty != 0) { ?>
                                           <tr style="border-bottom: 1px solid #EEE;">
                                               <td style="font-weight: bolder;"><?php echo $value->pname; ?>:</td>
                                               <td><?php echo $value->price ." x " .$qty ?></td>

                                               <td class="subtotal"><?php echo $subtotal;  ?></td>
                                           </tr>
                                        <?php } ?>
                                 <?php } ?>
                             <?php } ?>
                             <tr style="font-weight: bolder;">
                                 <td></td>
                                 <td align="right">Grand Total</td>
                                 <td><span id="grand_total">0</span></td>
                               </tr>
                        </tbody>

                     </table>
                <div class="p-2"  style="margin-top:10px;">
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
	       
	       <div style="clear:both;"></div>
	    </div>
	    <!-- end -->
	 </div>
	</div>
	<!-- start -->
<input type="hidden" id="url" value="<?php echo url_for('/logout.php') ?>">
<script src="<?php echo url_for('assets/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
<script type="text/javascript">

  function formatToCurrency(amount){
      return (amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
  }


  sumOfReturn();
  function sumOfReturn(){
    var count = [];
    $('.subtotal').each(function() {
          var item = $(this).text();
          
          count.push(parseInt(item));
          
    });
    const sum = count.reduce((a, b) => a + b, 0);
    var amt2 = formatToCurrency(sum); //"12.35"
    // $("#value_of_sold").text(amt2);
    $("#grand_total").text(amt2);
 }
</script>

<?php if ($location == "pos") { ?>
	<script type="text/javascript">
		$(document).ready(function() {
		         setTimeout(function(){
		             window.print(); 
		         }, 1000);//wait 1 seconds
		      
				setTimeout(function(){
					var logout = $('#logout').val()
			        window.location.href = logout;
			    }, 1000);//wait 1 seconds
	    });
	</script>
	
<?php }else{ ?>
	<script type="text/javascript">
		$(document).ready(function() {
		         setTimeout(function(){
		             window.print(); 
		         }, 1000);//wait 1 seconds
	         setTimeout(function(){
	             window.history.back();
	         }, 1000);//wait 1 seconds
	    });
	</script>
<?php } ?>
</body>
</html>