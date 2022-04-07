<?php

require_once('../../private/initialize.php');

require_login();

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
<?php $page = 'Product'; $page_title = 'Edit Product'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title; ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
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
    
      <div class="text-danger bg-light ">
          <?php //echo $errors; ?>
          <?php echo display_errors($product->errors); ?>
      </div>
      <div class="">
        <?php echo display_session_message(); ?>
      </div>


      <?php include('form_fields.php'); ?>
  </div>



<?php include(SHARED_PATH . '/admin_footer.php');?>
