<?php require_once('../private/initialize.php');
$page_title = 'Edit Business';
$page = 'Settings';

require_login();

$id = $_GET['id'] ?? '';
$store = Store::find_by_id($id);
if ($loggedInAdmin->admin_level != 1) {
    redirect_to(url_for('/login.php'));
}

if (is_post_request()) {

  // Save record using post parameters
  $args = $_POST['store'];
  $store->merge_attributes($args);
  // pre_r($store);
  $result = $store->save();

  if ($result === true) {

    // logfile
    log_action('Edit store', "id: {$store->id}, Editted by {$loggedInAdmin->full_name()}", "store");

    $session->message('The store was updated successfully.');
    redirect_to(url_for('/settings/stores'));
  } else {
    // show errors
  }
} else {

  // display the form
}

include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page ." | ". $page_title; ?></h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $page_title; ?></li>
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
                      <?php include('form_field.php'); ?>
                      
                  
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


