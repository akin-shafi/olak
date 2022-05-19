<?php require_once('../../private/initialize.php') ?>
<?php 
if (isset($_POST['fetch_record'])) { 
	$trans_no = $_POST['trans_no'] ?? '';
	$sales = Sales::find_all_transaction($trans_no);
	$transaction = Transaction::find_transaction($trans_no);

?>

	<?php $sn =1;  foreach ($sales as $key => $value) { 
	    $price = $value->unit_price;
	    $total_price = $price * $value->product_quantity;
	  ?>
	   <tr class="text-center">
	     <input type="hidden" name="" value="<?php echo $value->id ?>">
	     <input type="hidden" name="" value="<?php echo $loggedInAdmin->id ?>">
	     <input type="hidden" name="" value="<?php echo date('Y-m-d h:i:a') ?>">

	     <input  id="q<?php echo $value->product_id; ?>" class="text-center" type="hidden" disabled="" size="1" name="" value="<?php echo $value->product_quantity ?>">

	     <input  id="tp<?php echo $value->product_id; ?>" class="text-center" type="hidden" disabled="" size="" name="" value="<?php echo $total_price;  ?>">

	     <td><?php echo $sn++; ?></td>
	     <td id="name"><?php echo Product::find_by_id($value->product_id)->pname; ?></td>
	     <td><input class="text-center" disabled size="3" value="<?php echo $value->unit_price; ?>" id="unit_price<?php echo $value->product_id; ?>"></td>

	     <td><input data-id="<?php echo $value->product_id; ?>" id="quantity<?php echo $value->product_id; ?>" class="text-center" type="" disabled="" size="1" name="" value="<?php echo $value->product_quantity ?>"></td>

	     <td><input data-id="<?php echo $value->product_id; ?>" id="total_price<?php echo $value->product_id; ?>" class="text-center" type="" disabled="" size="" name="" value="<?php echo $total_price;  ?>"></td>

	     <td><input data-id="<?php echo $value->product_id; ?>" id="returned_item<?php echo $value->product_id; ?>" class="text-center returned" type="text" size="2" name="" value="<?php echo $value->returned ?>"></td>
	   </tr>

	<?php } ?>
<?php } ?>


