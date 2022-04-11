<?php require_once('../private/initialize.php');  

$page = 'Sales';
$page_title = 'Add New Sales';
include(SHARED_PATH . '/admin_header.php');

$array = ['PMS','PMS','PMS','PMS','PMS', 'AGO', 'DPK'];
$pms = '162';
$ago = '335';
$dpk = '345';
?>
<style type="text/css">
	label {
		text-transform: uppercase;
	}
	input{border-radius: 0;}
</style>
	<div class="content-wrapper">
		<h4>DAILY TRANSACTION RECORD FOR OLAK PETROLEUM,ILORIN </h4>
		
		<div class="table-container">
			<div class="table-responsive">
				<form id="data_sheet" method="post">
					<table class="table table-bordered table-sm">
						<thead>
							<tr class="bg-primary text-white ">
								<th class="font-weight-bold">Product</th>
								<?php $sn = 1; foreach ($array as $key => $value) { ?>
									<th class="font-weight-bold text-right"><?php echo $value." (Tank". $sn++.")"; ?></th>
								<?php } ?>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td class=" font-weight-bold">Rate</td>
								<?php $sr = 1; foreach ($array as $key => $value) { 
									if ($value == 'PMS') { 
										$rate = $pms;
									}elseif ($value == 'AGO') {
										$rate = $ago;
									}else{
										$rate = $dpk;
									}
								?>
									<td id="rat<?php echo $sr++ ?>" class="font-weight-bold text-right rate"><?php echo $rate; ?></td>
									
								<?php } ?>
							</tr>
							 <tr>
							 	<td>OPENING STOCK </td>
							 	<?php $os = 1; foreach ($array as $key => $value) { ?>
							 		<td class="text-right p-0">							 			
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $os++ ?>[open_stock]" value="29100" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>NEW STOCK(INFLOW) </td>
							 	<?php $ns = 1; foreach ($array as $key => $value) { ?>
							 		<td class="text-right new_stock p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" 
							 			name="<?php echo "tank". $ns++ ?>[new_stock]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>TOTAL STOCK </td>
							 	<?php $ts = 1; foreach ($array as $key => $value) { ?>
							 		<td  class="text-right total_stock p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $ts++ ?>[total_stock]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>SALES(LTRS) </td>
							 	<?php $sa = 1; foreach ($array as $key => $value) { ?>
							 		<td  class="text-right sales_in_ltr p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $sa++ ?>[sales_in_ltr]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>EXPECTED STOCK(LTRS) </td>
							 	<?php $es = 1; foreach ($array as $key => $value) { ?>
							 		
							 		<td  class="text-right expected_stock p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $es++ ?>[expected_stock]" value="" placeholder='0'>
							 		</td>

							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>ACTUAL STOCK(LTRS) </td>
							 	<?php $as = 1; foreach ($array as $key => $value) { ?>
							 		<!-- <td contenteditable="true" id=""></td> -->
							 		<td class="actual_stock text-right p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $as++ ?>[actual_stock]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>OVER/SHORT </td>
							 	<?php $ov = 1; foreach ($array as $key => $value) { ?>
							 		<td class="over_or_short text-right p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $ov++ ?>[over_or_short]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr class="bg-light font-weight-bold">
							 	<td>EXP. SALES VALUE # </td>
							 	<?php $esp = 1; foreach ($array as $key => $value) { ?>
							 		<td class="exp_sales_value text-right p-0">
							 			<input type="text" readonly size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $esp++ ?>[exp_sales_value]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>CASH SUBMITTED # </td>
							 	<?php $cs = 1; foreach ($array as $key => $value) { ?>
							 		<td class="cash_submitted text-right p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $cs++ ?>[cash_submitted]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>TOTAL SALES(LTRS)</td>
							 	<?php $total_s = 1; foreach ($array as $key => $value) { ?>
							 		<td class="total_sales text-right p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $total_s++ ?>[total_sales]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>TOTAL VALUE #</td>
							 	<?php $total_v = 1; foreach ($array as $key => $value) { ?>
							 		<td class="total_value text-right p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $total_v++ ?>[total_value]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>GRAND TOTAL VALUE # </td>
							 	<?php $gtotal_v = 1; foreach ($array as $key => $value) { ?>
							 		<td class="grand_total text-right p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="<?php echo "tank". $gtotal_v++ ?>[grand_total]" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
						</tbody>
					</table>
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-primary btn-sm">Submit</button>	
					</div>
				</form>
			</div>
		</div>
		
	</div>
<?php include(SHARED_PATH . '/admin_footer.php');?>


<script type="text/javascript">

	$('[contenteditable="true"]').keypress(function(e) {
	    var x = event.charCode || event.keyCode;
	    if (isNaN(String.fromCharCode(e.which)) && x!=46 || x===32 || x===13 || (x===46 && event.currentTarget.innerText.includes('.'))) e.preventDefault();
	});
	

	$('#data_sheet').on("submit", function(e){ 

			e.preventDefault();
			$.ajax({  
                url:"inc/create.php",  
                method:"POST",  
                data:new FormData(this),  
                contentType:false,          // The content type used when sending data to the server.  
                cache:false,                // To unable request pages to be cached  
                processData:false,          // To send DOMDocument or non processed data file it is set to false  
                success: function(data){  
                     if(data == true){  
                         successAlert(data.msg); 
                     }else{  
                         errorAlert(data.msg);   
                     }  
                }  
           })  
     });  
	
	
</script>