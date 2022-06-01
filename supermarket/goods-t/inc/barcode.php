<?php require_once('../../private/initialize.php'); ?>

<?php if (isset($_POST['print_barcode'])) { 
	$item = Product::find_by_id($_POST['id']);
	// pre_r($item);
	$code = $item->code;
?>
<script type="text/javascript">
	JsBarcode("#barcode", "<?php echo $code ?>", {
	  format: "CODE128",
	  lineColor: "#000",
	  // width: 3,
	  // height: 50,
	  displayValue: true
	});
</script>
<div class="row">
   <div class="col-md-12">
      <div class="">
         <table class="table table-bordered table-centered mb0">
            <tbody>
            	<?php for ($j=1; $j <= 10 ; $j++) { ?>
               <tr>
               	<?php for ($i=1; $i <= 2 ; $i++) { ?>
                  <td>
                     <h4>eZeePOS</h4>
                     <strong><?php echo $item->pname ?></strong><br>
                        <svg id="barcode"></svg> <br>
					<span class="price">Price: <?php echo $currency . $item->price ?></span>
                  </td>
              <?php } ?>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
   </div>
</div>


<?php } ?>

<?php if (isset($_POST['gen_code'])) { 
$rand = rand(10, 100);
$unique = date('His');
// Create trans_no dynamically
$barcode = $unique . $rand;

// $barcode = "SPO" . $rand;

exit(json_encode(['msg' => 'OK', 'barcode' => $barcode]));

} ?>