 <?php require_once('../private/initialize.php');
$page_title = 'Add-';
$page = 'Purchases';

require_login();

if ($loggedInAdmin->admin_level != 1) {
    // redirect_to(url_for('/login.php'));
}

if (is_post_request()) {

  // Create record using post parameters
   

    $targetDir = "../uploads/thumbs/"; 
    // $targetDir = url_for('images/uploaded/'); 
    $allowTypes = array('jpg','png','jpeg','gif'); 
     
    // $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['file']['name']); 
    
    $args = $_POST['expenses'];
    $expenses = new Expenses($args);
    // echo '<pre>';print_r($expenses);'</pre>';
    $result = $expenses->save();
    
    if ($result === true) {
        
        $new_id = $expenses->id;
        $randr = rand(10, 100);
          // Create trans_no dynamically
        $ref_no = "1" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $randr;
         $data = [
            'ref' => $ref_no,
            'created_by' => $loggedInAdmin->id,                             
         ];
        $expenses->merge_attributes($data); // merge newly created trans_no and
        $result2 = $expenses->save(); // Save tran_no into transaction table 
        if ($result2 === true) {
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

                              $check = expenses::find_by_id($new_id);
                              $data2 = [
                                'file' => $newfilename,                            
                              ];
                              $expenses->merge_attributes($data2);
                              $result = $expenses->save();
                              log_action('New expenses', "id: {$expenses->id}, Created by {$loggedInAdmin->full_name()}", "expenses");        
                              $session->message('Expenses added  with Receipt.');
                              redirect_to(url_for('/expenses/'));
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
              log_action('New expenses', "id: {$expenses->id}, Created by {$loggedInAdmin->full_name()}", "expenses");
              $session->message('Expenses added successfully without Receipt.');
              redirect_to(url_for('/expenses/'));
            }
        }
        
    } else {
        // show errors
    }
} else {
    // display the form
    $expenses = new Expenses;
}

include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ." ". 'Expenses'; ?></h1>
       
       <ol class="breadcrumb">
            <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo url_for('/') ?>purchases">Purchases</a></li>
            <li><a href="<?php echo url_for('/') ?>purchases/list_expenses">Expenses</a></li>
            <li class="active">Add Expense</li>            
        </ol>
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" style="display:none;">
          <div class="alert alert-dismissable">
             <div class="custom-msg"></div>
          </div>
       </div>
    </div>
    <section class="content">

       <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Please fill in the information below</h3>
                </div>
                <div class="box-body">
                	<div class="col-lg-6 col-md-12 col-sm-12">
                      <?php include('form_field.php'); ?>
                  	</div>
                </div>
            </div>
          </div>
       </div>
    </section>
 </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
 <div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:400px;">
	    <div class="modal-content">
	       <div class="modal-header np">
	          <button type="button" class="close" id="receipt-modal-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
	          <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
	          <h4 class="modal-title" id="receipt-title"></h4>
	       </div>
      		<div id="show_view" style="padding: 20px;"></div>
      	</div>
  </div>
</div>

<div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="opacity: 1; display: block;">
    <div class="modal-content" >
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <div id="show_view">
                
            </div>
            <!-- start -->
            
                            
        </div>
    </div>
  </div>
</div>

