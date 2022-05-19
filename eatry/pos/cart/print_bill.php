<?php require_once('../../private/initialize.php');

//fetch_cart.php

// session_start();

$total_price = 0;
$total_item = 0;
$tax = 0;
$currency = '₦' ;
$sum = 0;
?>
<!--  -->
<style type="text/css">
 .bolder{
    color: #000; font-weight: bolder !important;
  }

</style>
<link rel="stylesheet" media="print"  href="<?php echo url_for('/assets/dist/css/printer-80mm.css') ?>" />	

<?php if(isset($_POST['print_bill'])) { ?>
	<?php if(!empty($_SESSION["shopping_cart"])) { ?>
		

		<body class="receipt bolder">
  			<section class="sheet padding-10mm">
			  <span id="bill_span">
	              <style>.bb td, .bb th { border-bottom: 1px solid #DDD; }.right{ text-align:right; font-weight: normal; }</style>
	              <h2 class="bolder">INVOICE</h2>
	              <span style="text-align:center;">
	                 <h3 class="bolder"><?php echo $_POST['company_name']; ?></h3>
	                 <h5 class="bolder"><?php echo $_POST['address']; ?></h5>
	              </span>

	              <h5 class="bolder">C: <?php 
			        		if($_POST['spos_customer'] == 0){
			        			echo "Walk-in Customer";
			        		}else{
			        			echo Customer::find_by_id($_POST['spos_customer'])->full_name();
			        		}

		                ?>
		          </h5>
	              <!-- <h5>R: </h5> -->
	              <h5 class="bolder">U: <?php echo $_POST['loggedInAdmin']; ?></h5>
	              <h5 class="bolder">T: <?php echo date('D d M Y h:i:a') ?></h5>
	           </span>
	           <table id="bill-table" width="100%" class="prT table table-condensed bolder" style="width:100%;margin-bottom:0;">
	              <tbody>
	              	<?php $sn = 1; foreach($_SESSION["shopping_cart"] as $keys => $values): 
						$p_qty = $values["product_quantity"];
						$p_price = $values["product_price"];
						$tax = 0;
						$order_tax = $tax + ($p_qty * $values["product_tax"]);
						// $t_product_quantity = array_sum($values["product_quantity"]);
						$sum += $values['product_quantity'];
						$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
						$total_item = count($_SESSION["shopping_cart"]);
						// $grand_total = $total_price + $order_tax;
						$grand_total = $total_price;
					?>
	                 <tr class="row_3" data-item-id="3">
	                    <td colspan="2" style="border-bottom:0!important;"><?php echo  $sn++ . '.' .$values["product_name"]; ?></td>
	                 </tr>
	                 <tr class="bb row_3" data-item-id="3">
	                    <td><?php echo '('. $p_qty. ' x ' . number_format($p_price, 2).')' ?></td>
	                    <td class="text-right"><?php echo $currency .' '. number_format($p_qty * $p_price, 2) ?></td>
	                 </tr>
	                 <?php endforeach ?>
	              </tbody>
	           </table>
	           <table id="bill-total-table" width="100%" class="prT table table-condensed bolder" style="width:100%;margin-bottom:0;">
	              <tbody>
	                 <tr class="bolder">
	                    <td>Total Items</td>
	                    <td class="text-right bolder"><?php echo $total_item .'('. $sum .')'; ?></td>
	                 </tr>
	                 <tr class="bolder">
	                    <td>Total</td>
	                    <td class="text-right  bolder"><?php echo  $currency .' '. number_format($total_price, 2); ?></td>
	                 </tr>
	                <!--  <tr class="bolder">
	                    <td>Order Tax</td>
	                    <td class="text-right"><?php //echo $currency .' '. $order_tax; ?></td>
	                 </tr> -->
	                 <tr class="bolder">
	                    <td>Grand Total</td>
	                    <td class="text-right bolder" style="font-weight: bold;"><?php echo $currency .' '. number_format($grand_total, 2); ?></td>
	                 </tr>
	                
	                 <tr>
	                    <td colspan="2" class="text-center bolder">
	                    	<p>Customer's Copy</p>
	                    	<strong>Note: This is a temporary invoice. An orignal receipt would be issued after payment has been processed</strong>
	                    </td>
	                 </tr>
	              </tbody>
	           </table>
	    	</section>
		</body>	

	<?php }else{ ?>
		<?php echo 'Please add product'; ?>
	<?php } ?>
<?php exit(); } ?>

<?php if(isset($_POST['print_order'])) { ?>	
	<?php if(!empty($_SESSION["shopping_cart"])) { ?>
			
	<body class="receipt">
  		<section class="sheet padding-10mm">
		  <span id="bill_span">
              <style>.bb td, .bb th { border-bottom: 1px solid #DDD; }.right{ text-align:right; font-weight: normal; }</style>
              <span style="text-align:center;">
                 <h3><?php echo $_POST['company_name']; ?></h3>
                 <h4>Customer's Order</h4>
              </span>
              <h5>C: 
              	<?php 
	        		if($_POST['spos_customer'] == 0){
	        			echo "Walk-in Customer";
	        		}else{
	        			echo Customer::find_by_id($_POST['spos_customer'])->full_name();
	        		}

                ?></h5>
              <!-- <h5>R: </h5> -->
              <h5>U: <?php echo $_POST['loggedInAdmin']; ?></h5>
              <h5>T: <?php echo date('D d M Y h:i:a') ?></h5>
           </span>
           
           <table id="order-table" class="prT table table-condensed" style="width:100%;margin-bottom:0;">
           	<tbody>
           		<?php $index = 1;  foreach($_SESSION["shopping_cart"] as $keys => $values): 
					$total_item = count($_SESSION["shopping_cart"]);
					$v = $index++;
				?>
	           		<tr class="bb row_<?php echo $v; ?>" data-item-id="<?php echo $v; ?>">
	           			<td><?php echo  $v . '.'; ?> <?php echo $values["product_name"]; ?></td>
	           			<td>[ <?php echo $values["product_quantity"] ?> ]</td>
	           		</tr>
           		<?php endforeach ?>
           	</tbody>
           </table>
	    </section>
	</body>

	<?php }else{ ?>
		<?php echo 'Please add product'; ?>
	<?php } ?>
<?php exit(); } ?>