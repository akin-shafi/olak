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
							 		<td contenteditable="true" id="open_stock<?php echo $os++ ?>" class="text-right">  29,100.00 </td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>NEW STOCK(INFLOW) </td>
							 	<?php $ns = 1; foreach ($array as $key => $value) { ?>
							 		<td class="text-right new_stock p-0">
							 			<input type="text" size="12"  style="width: 90%; text-align: right; border: none;" name="new_stock" value="" placeholder='0'>
							 		</td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>TOTAL STOCK </td>
							 	<?php $ts = 1; foreach ($array as $key => $value) { ?>
							 		<td contenteditable="true" id="total_stock<?php echo $ts++ ?>" class="text-right"></td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>SALES(LTRS) </td>
							 	<?php $sa = 1; foreach ($array as $key => $value) { ?>
							 		<td contenteditable="true" id="sales<?php echo $sa++ ?>"></td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>EXPECTED STOCK(LTRS) </td>
							 	<?php foreach ($array as $key => $value) { ?>
							 		<td contenteditable="true" id="" class="expected_stock"></td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>ACTUAL STOCK(LTRS) </td>
							 	<?php foreach ($array as $key => $value) { ?>
							 		<td contenteditable="true" id=""></td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>OVER/SHORT </td>
							 	<?php foreach ($array as $key => $value) { ?>
							 		<td contenteditable="true" id=""></td>
							 	<?php } ?>
							 </tr>
							 <tr class="bg-light font-weight-bold">
							 	<td>EXP. SALES VALUE # </td>
							 	<?php foreach ($array as $key => $value) { ?>
							 		<td id="" class="font-weight-bold"></td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>CASH SUBMITTED # </td>
							 	<?php foreach ($array as $key => $value) { ?>
							 		<td contenteditable="true" id=""></td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>TOTAL SALES(LTRS)</td>
							 	<?php foreach ($array as $key => $value) { ?>
							 		<td contenteditable="true" id=""></td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>TOTAL VALUE #</td>
							 	<?php foreach ($array as $key => $value) { ?>
							 		<td contenteditable="true" id=""></td>
							 	<?php } ?>
							 </tr>
							 <tr>
							 	<td>GRAND TOTAL VALUE # </td>
							 	<?php foreach ($array as $key => $value) { ?>
							 		<td contenteditable="true" id=""></td>
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
	$(document).on('keyup', 'td', function(e) {
		// var eid = $(this)[0].id
		// var value = $(this).html()

		// var rate = $("#rat"+eid).html()
		// console.log(rate)
		// $( this ).closest( "form" )
		var elem = $(this).closest('tr');
		// var input = (e.target).closest("tr")
		// input = elem;
		

		console.log(elem);
	})

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
                     if(data=='Error1')  
                     {  
                          alert("Invalid File");  
                     }  
                     else if(data == "Error2")  
                     {  
                          alert("Please Select File");  
                     }                           
                     else if(data == "Success")  
                     {  
                          alert("CSV file data has been imported");  
                          $('#upload_csv_form')[0].reset();
                     }  
                     else  
                     {  
                         // $('#employee_table').html(data);  
                     }  
                }  
           })  
     });  
	
	// alert(char)

	// for (var j = 1; j <= count; j++) {
	// 	var myString = $()
	// 	var char = myString.slice(-1);

	// 	quantity = $('#quantity' + j).val();
	// }
</script>