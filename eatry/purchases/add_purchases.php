 <?php require_once('../private/initialize.php');
$page_title = 'Add';
$page = 'Purchases';



require_login();


if ($loggedInAdmin->admin_level != 1) {
    // redirect_to(url_for('/login.php'));
}

if (is_post_request()) {

  // Create record using post parameters
    $rand = rand(1, 2);

    $args = $_POST['purchases'];

    if ($rand == 1) { 
        $args['profile_img'] = 'user1.png';
    } elseif ($rand == 2) {
        $args['profile_img'] = 'user2.png';
    }
    // print_r($args);
    $purchases = new Purchases($args);
    // echo '<pre>';print_r($purchases);'</pre>';
    $result = $purchases->save();

    if ($result === true) {
        $new_id = $purchases->id;
    
        // Logfile
        log_action('New purchases', "id: {$purchases->id}, Created by {$loggedInAdmin->full_name()}", "purchases");
    
        $session->message('purchases added successfully.');
        redirect_to(url_for('/purchases/'));
    } else {
        // show errors
    }
} else {
    // display the form
    $purchases = new Purchases;
}

include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ." ". $page; ?></h1>
       
       <ol class="breadcrumb">
            <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo url_for('/') ?>purchases">Purchases</a></li>
            <li><a href="<?php echo url_for('/') ?>purchases/list_purchases">purchases</a></li>
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
                	<!-- <div class="col-xs-6"> -->
                      <?php include('form_field_purchase.php'); ?>
                  	<!-- </div> -->
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
