<?php require_once('../../private/initialize.php'); ?>

<?php if (isset($_POST['print_label'])) { 
	$item = Product::find_by_id($_POST['id']);

?>

<div class="row">
   <div class="col-md-12">
      
         <table class="table table-bordered table-centered mb0">
            <tbody>
            	<?php for ($j=1; $j <= 1 ; $j++) { ?>
               <tr>
               	<?php //for ($i=1; $i <= 2 ; $i++) { ?>
                  <td>
                     <h4><?php echo $company->company_name ?></h4>
                     <div style="font-size:40px">
                        <strong><?php echo $item->pname ?></strong><br>
                        <span class="price" ><?php echo $currency . number_format($item->price, 2) ?></span><br>
                        
                      </div>
                  </td>
                  <?php //} ?>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      
   </div>
</div>


<?php } ?>
