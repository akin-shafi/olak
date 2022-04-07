<?php

require_once('../../private/initialize.php');

require_login();

if (isset($_POST['uploadFile'])) {
    $args = $_POST;     
    $product = new Product($args);
    // pre_r($product);
    // Insert into database
    $result = $product->save();
    if($result == true) {
        $new_id = $product->id;

            if(!empty($fileNames)){ 
                // File upload configuration 
                $targetDir = "../uploads/thumbs/"; 
                // $targetDir = url_for('images/uploaded/'); 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                 
                // $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
                $rand = rand(10, 100);
                $fileNames = array_filter($_FILES['file']['name']);
                
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
                                
                                $session->message('Product added  with Image.');
                                redirect_to(url_for('products/'));
                        }else{ 
                            $errors[] = 'Sorry, there was a problem uploading ' . $_FILES['file']['name'];
                        } 
                    }else{ 
                        $errors[] = $_FILES['file']['type']. " is not a permitted type of file.";
                        // $errorUploadType .= $_FILES['file']['name'][$key].' | '; 
                    } 
                }  
            }else{ 
                
                // $errors[] = 'Please select a file to upload.'; 
                
                $session->message('Product added successfully without Image.');
            }

    } 
}else{
    $product = new Product;
}

?>

<?php $page = 'Product'; $page_title = 'Add New Product'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">
      <!-- Page header start -->
      <div class="page-title">
        <div class="row gutters">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
            <h5 class="title"><?php echo $page_title ?></h5>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
            <div class="daterange-container">
              <a href="<?php echo url_for('products/index.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="View all Products">
                <i class="feather-file-text"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Page header end -->

      <!-- Content wrapper start -->
      <div class="content-wrapper">
       
        <div class="text-danger text-center bg-light d-flex justify-content-center">

        <?php echo display_errors($product->errors); ?>
        </div>
        <?php if (display_session_message() != '') { ?>
          <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4>    <i class="icon fa fa-check"></i> Success</h4>
                <p><?php echo display_session_message(); ?></p>            
          </div>
       <?php } ?>


        <form  id="form" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">
          <?php include("form_fields.php") ?>
         <!--  <div class="card-footer">
            <input type="submit" class="btn btn-success float-right" value="Create">
          </div> -->
         <!--  <div class="form-group">
             <input type="submit" name="uploadFile" id="add_product" value="Add Products"  class="btn btn-primary float-right" />
          </div> -->
        </form>
      </div>
</div>




<!-- *************
        ************ Main container end *************
        ************* -->


<?php include(SHARED_PATH . '/admin_footer.php');?>

<script type="text/javascript" charset="utf-8">
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
    //  e.preventDefault();
    //  $('#add_product').attr('disabled', false)
    //  $.ajax({
   //            url: 'inc/add_product.php',
   //            method: 'post',
   //            // data: {new: 1,},
   //            data: $('#form').serialize(),
   //            dataType: 'json',
   //            success: function(r) {
   //             if(r.msg == 'OK'){
   //               successTime("Food Created Succesfully" );
   //               $("#foodMenu").modal('hide');
   //               load_product();
   //             }           
   //            }
   //        });
    // }); 
    });






</script>

