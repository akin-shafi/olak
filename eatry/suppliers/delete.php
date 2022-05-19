<?php require_once('../private/initialize.php');
$page_title = 'Delete';
$page = 'supplier';


//require_login();

if (!isset($_GET['id'])) {
  redirect_to(url_for('/suppliers/index.php'));
}
$id = $_GET['id'];
$supplier = supplier::find_by_id($id);
if ($supplier == false) {
  redirect_to(url_for('/suppliers/index.php'));
}

if (is_post_request()) {

  // logfile
  log_action('Delete supplier', "id: {$supplier->id}, Deleted by {$loggedInAdmin->full_name()}", "supplier");

  // Delete supplier
  $result = $supplier->deleted($id);
  $session->message('The supplier was deleted successfully.');
  redirect_to(url_for('/suppliers/index.php'));
} else {
  // Display form
}


include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ." ". $page; ?></h1>
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
    <div class="clearfix"></div>
    
    <section class="content">

       <div class="row">
          <div class="col-xs-12">
            <div class="card text-center ">
              <div class="bg-primary" style="padding: 10px">
                <!-- <h1>Delete supplier</h1> -->
                <p>Are you sure you want to delete this supplier?</p>
                <p class="item"><?php //echo h($supplier->full_name()); ?></p>

                <form action="<?php echo url_for('/suppliers/delete.php?id=' . h(u($id))); ?>" method="post">
                  <div id="operations" class="btn-group">
                    <input type="submit" name="commit" class="btn btn-danger border-0" value="Yes" />
                    <a href="<?php echo url_for('/suppliers/index.php'); ?>" class="btn btn-info">No</a>
                  </div>
                </form>
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


