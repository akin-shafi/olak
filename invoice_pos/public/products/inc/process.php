<?php require_once('../../../private/initialize.php'); ?>

<?php if (isset($_POST['view'])) { 
	$item = Product::find_by_id($_POST['id']);
?>
		 <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
              </button><button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
              
              <h4 class="modal-title" id="myModalLabel"><?php echo $item->pname; ?></h4>
          </div>
          <div class="modal-body" >
			<div class="row">
		        <div class="col-xs-4">
		            <img id="pr-image" src="<?php echo url_for('/uploads/thumbs/' . $item->file) ?>" alt="<?php echo $item->file; ?>" class="img-responsive img-thumbnail">
		        </div>
		        <div class="col-xs-8">
		            <div class="table-responsive">
		                <table class="table table-borderless table-striped dfTable table-right-left">
		                    <tbody>
		                        <tr>
		                            <td class="col-xs-5">Product Type</td>
		                            <td class="col-xs-7"><?php echo $item->type; ?></td>
		                        </tr>
		                        <tr>
		                            <td>Product Name</td>
		                            <td><?php echo $item->pname; ?></td>
		                        </tr>
		                        <tr>
		                            <td>Product Code</td>
		                            <td><?php echo $item->code; ?></td>
		                        </tr>
		                        <tr>
		                            <td>Category</td>
		                            <td> <?php echo $item->type .'('. $item->category .')';?></td>
		                        </tr>
		                        <tr><td>Cost</td><td><?php echo $item->cost; ?></td></tr>
		                        <tr>
		                            <td>Price</td>
		                            <td><?php echo $item->price; ?></td>
		                        </tr>
		                        <tr>
		                            <td>Tax Rate</td>
		                            <td><?php echo $item->product_tax; ?></td>
		                        </tr>
		                        <tr>
		                            <td>Tax Method</td>
		                            <td><?php echo $item->tax_method; ?></td>
		                        </tr>
		                        <tr>
		                            <td>Quantity</td>
		                            <td><?php echo $item->quantity; ?></td>
		                        </tr>
		                    </tbody>
		                </table>
		            </div>

		                        </div>

		        <div class="col-xs-12">
		            <div class="panel panel-primary"><div class="panel-heading">Product Details</div><div class="panel-body"><?php echo $item->details ? $item->details : "Not Set"; ?></div></div>            
		        </div>
		    </div>
		  </div>
<?php } ?>

<?php 
 if (isset($_POST['delete'])) { 
	$id = $_POST['id'];
	$delete = Product::find_by_id($id);
	$result = $delete->deleted($id);
	if ($result === true) {
		exit(json_encode(['msg' => 'OK']));
	} else {
		exit(json_encode(['msg' => 'FAIL']));
	}
 }
?>