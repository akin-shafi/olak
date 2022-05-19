<?php require_once('../../private/initialize.php'); ?>

 <?php if (isset($_POST['fetch'])) { 
  $id = $_POST['id'] ?? 1;
  $from = $_POST['from'] ?? date('Y-m-d');

  $soldItem = Sales::find_item(['product_id' => $id, 'from' => $from]);

  // pre_r($soldItem);
  ?>  
<div class="table-responsive">

  <table class="table table-sm">
	  	<thead>
	  	<tr>
	  		<th>s/n</th>
	  		<th>Product Name</th>
	  		<th>Qty</th>
	  	</tr>
	  </thead>
	  <tbody>
	  	<?php $sn = 1; foreach ($soldItem as $key => $value): ?>
	  		<tr>
		  		<td><?php echo $sn++ ?></td>
		  		<td><?php echo Product::find_by_id($value->product_id)->pname; ?></td>
		  		<td><?php echo $value->product_quantity; ?></td>
		  	</tr>	
	  	<?php endforeach ?>
	  </tbody>
  </table>
</div>
  <?php } ?>