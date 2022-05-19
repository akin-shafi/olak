<?php require_once('../private/initialize.php');
$page_title = 'Edit'; 
$page = 'Products'; 
?>

<?php 
$id = $_GET['id'] ?? $loggedInAdmin->id; 
$product = Product::find_by_id($id);

if (is_post_request()) {
// if (isset($_POST['uploadFile'])) {
      $args = $_POST;
      $product->merge_attributes($args);
      // pre_r($product);
      // Insert into database
      $result = $product->save();
      $session->message('Product edited successfully.');
    if($result === true) {
    	    $new_id = $product->id;
    	    // File upload configuration 
		    $targetDir = "../uploads/thumbs/"; 
		    // $targetDir = url_for('images/uploaded/'); 
		    $allowTypes = array('jpg','png','jpeg','gif'); 
		     
		    // $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
		    $rand = rand(10, 100);
		    $fileNames = array_filter($_FILES['file']['name']); 
		    
		    
		    if(!empty($fileNames)){ 
		    	
		        foreach($fileNames as $key => $val){ 
		            // File upload path 
		            $fileName = basename($fileNames[$key]); 

		            $newfilename = date('dmYHis').str_replace(" ", "", basename($fileName));
		            
		            $targetFilePath = $targetDir . $newfilename; 
		             // echo $targetFilePath;
		            // Check whether file type is valid 
		            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
		          
		            if(in_array($fileType, $allowTypes)){ 
		                // Upload file to server  and  Move file to destination folder
						
						
		                // $moveFiled = $_FILES["file"]["tmp_name"][$key];

		                if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath)){ 

		                     	$check = Product::find_by_id($new_id);
								  $data = [
							    	'file' => $newfilename,
                                    'created_by' => $loggedInAdmin->id,                             
							    	' created_at' => date('Y-m-d H:i:s'),   	                        
							    ];
							    $product->merge_attributes($data);
							    $result = $product->save();
		                	    
			                    $session->message('Picture Saved successfully.');
		                    	redirect_to(url_for('/products/'));
		                }else{ 
		                    $errors[] = 'Sorry, there was a problem uploading ' . $_FILES['file']['name'];
		                } 
		            }else{ 
		                $errors[] = $_FILES['file']['type']. " is not a permitted type of file.";
		                // $errorUploadType .= $_FILES['file']['name'][$key].' | '; 
		            } 
		        }  
		    }else{ 
		        
		        $errors[] = 'Please select a file to upload.'; 
		    }

    } 
}else{
    // $product = new Product;
}
?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div class="content-wrapper">
<section class="content-header">
   <h1>Add Products</h1>
   <ol class="breadcrumb">
      <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="https://spos.tecdiary.net/products">Products</a></li>
      <li class="active">Add Products</li>
   </ol>
</section>
<div class="col-lg-12 alerts">
   <div id="custom-alerts" style="display:none;">
      <div class="alert alert-dismissable">
         <div class="custom-msg"></div>
      </div>
   </div>
</div>
<div class="clearfix"></div>
<section class="content">
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-primary">
            <div class="box-header">
               <h3 class="box-title">Please fill in the information below</h3>
            </div>
            <div class="box-body">
            	<div class="text-danger text-center bg-light d-flex justify-content-center">
    			<?php //echo $errors; ?>
    			<?php echo display_errors($product->errors); ?>
    			</div>
            	<div class=" d-flex justify-content-center mn-4">
	              <?php echo display_session_message(); ?>
	            </div>
              <?php include('form_fields.php'); ?>
              
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
   </div>
</section>

    

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script type="text/javascript" charset="utf-8">
    var price = 0; cost = 0; items = {};
    $(document).ready(function() {
        $('#type').change(function(e) {
            var type = $(this).val();
            if (type == 'combo') {
                $('.st').slideUp();
                $('#ct').slideDown();
                //$('#cost').attr('readonly', true);
            } else if (type == 'service') {
                $('.st').slideUp();
                $('#ct').slideUp();
                //$('#cost').attr('readonly', false);
            } else {
                $('#ct').slideUp();
                $('.st').slideDown();
                //$('#cost').attr('readonly', false);
            }
        });

        $("#add_item").autocomplete({
            source: 'https://spos.tecdiary.net/products/suggestions',
            minLength: 1,
            autoFocus: false,
            delay: 200,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    bootbox.alert('No product found!', function () {
                        $('#add_item').focus();
                    });
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    bootbox.alert('No product found!', function () {
                        $('#add_item').focus();
                    });
                    $(this).val('');

                }
            },
            select: function (event, ui) {
                event.preventDefault();
                if (ui.item.id !== 0) {
                    var row = add_product_item(ui.item);
                    if (row) {
                        $(this).val('');
                    }
                } else {
                    bootbox.alert('No product found!');
                }
            }
        });
        $('#add_item').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                $(this).autocomplete("search");
            }
        });

        $(document).on('click', '.del', function () {
            var id = $(this).attr('id');
            delete items[id];
            $(this).closest('#row_' + id).remove();
        });


        $(document).on('change', '.rqty', function () {
            var item_id = $(this).attr('data-item');
            items[item_id].row.qty = (parseFloat($(this).val())).toFixed(2);
            add_product_item(null, 1);
        });

        $(document).on('change', '.rprice', function () {
            var item_id = $(this).attr('data-item');
            items[item_id].row.price = (parseFloat($(this).val())).toFixed(2);
            add_product_item(null, 1);
        });

        function add_product_item(item, noitem) {
            if (item == null && noitem == null) {
                return false;
            }
            if (noitem != 1) {
                item_id = item.row.id;
                if (items[item_id]) {
                    items[item_id].row.qty = (parseFloat(items[item_id].row.qty) + 1).toFixed(2);
                } else {
                    items[item_id] = item;
                }
            }
            price = 0;
            cost = 0;

            $("#prTable tbody").empty();
            $.each(items, function () {
                var item = this.row;
                var row_no = item.id;
                var newTr = $('<tr id="row_' + row_no + '" class="item_' + item.id + '"></tr>');
                tr_html = '<td><input name="combo_item_id[]" type="hidden" value="' + item.id + '"><input name="combo_item_code[]" type="hidden" value="' + item.code + '"><input name="combo_item_name[]" type="hidden" value="' + item.name + '"><input name="combo_item_cost[]" type="hidden" value="' + item.cost + '"><span id="name_' + row_no + '">' + item.name + ' (' + item.code + ')</span></td>';
                tr_html += '<td><input class="form-control text-center rqty" name="combo_item_quantity[]" type="text" value="' + formatDecimal(item.qty) + '" data-id="' + row_no + '" data-item="' + item.id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
                //tr_html += '<td><input class="form-control text-center rprice" name="combo_item_price[]" type="text" value="' + formatDecimal(item.price) + '" data-id="' + row_no + '" data-item="' + item.id + '" id="combo_item_price_' + row_no + '" onClick="this.select();"></td>';
                tr_html += '<td class="text-center"><i class="fa fa-times tip del" id="' + row_no + '" title="Remove" style="cursor:pointer;"></i></td>';
                newTr.html(tr_html);
                newTr.prependTo("#prTable");
                //price += formatDecimal(item.price*item.qty);
                cost += formatDecimal(item.cost*item.qty);
            });
            $('#cost').val(cost);
            return true;

        }

  //       $(document).on('submit', '#form', function (e) {
		// 	e.preventDefault();
		// 	$('#add_product').attr('disabled', false)
		// 	$.ajax({
	 //            url: 'inc/add_product.php',
	 //            method: 'post',
	 //            // data: {new: 1,},
	 //            data: $('#form').serialize(),
	 //            dataType: 'json',
	 //            success: function(r) {
	 //            	if(r.msg == 'OK'){
	 //            		successTime("Food Created Succesfully" );
	 //            		$("#foodMenu").modal('hide');
	 //            		load_product();
	 //            	}           
	 //            }
	 //        });
		// }); 
    });






</script>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>