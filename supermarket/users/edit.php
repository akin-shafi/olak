<?php require_once('../private/initialize.php');
$page_title = 'Edit';
$page = 'User';



require_login();

// if(!isset($_GET['id'])) {
//   redirect_to(url_for('/staff/admins/index.php'));
// }

$id = $_GET['id'] ?? $loggedInAdmin->id;
$admin = Admin::find_by_id($id);

$accesControl = AccessControl::find_by_user_id($id);

// pre_r($admin);
if ($admin == false) {
  redirect_to(url_for('/users/'));
}

if (is_post_request()) {

  // Save record using post parameters
  $args = $_POST['admin'];
  $admin_level = $_POST['admin']['admin_level'];
  $admin->merge_attributes($args);
  $result = $admin->save();

  if ($result === true) {
    if (in_array($admin_level, [1,2])) {
      $data = [

       'stock_mgt' => 1,
       'user_mgt' => 1,
       'warehouse_mgt' => 1,
       'purchase_mgt' => 1,
       'product_mgt' => 1,
       'shift_mgt' => 1,
       
      ];
    }elseif (in_array($admin_level, [3])) {
      $data = [
        'stock_mgt' => 0,
         'user_mgt' => 1,
         'warehouse_mgt' => 0,
         'purchase_mgt' => 1,
         'product_mgt' => 1,
         'shift_mgt' => 1,
         
      ];
    }elseif (in_array($admin_level, [4])) {
      $data = [
         'stock_mgt' => 0,
         'user_mgt' => 0,
         'warehouse_mgt' => 0,
         'purchase_mgt' => 0,
         'product_mgt' => 0,
         'shift_mgt' => 0,
         
      ];
    }elseif (in_array($admin_level, [5])) {
      $data = [
        'stock_mgt' => 0,
         'user_mgt' => 0,
         'warehouse_mgt' => 0,
         'purchase_mgt' => 0,
         'product_mgt' => 0,
         'shift_mgt' => 0,
         
      ];
    }elseif (in_array($admin_level, [8])) {
      $data = [
         'ledger_mgt' => 1,
      ];
    }else{
      $data = [
        'user_id' => $id,
        'stock_mgt' => 0,
         'user_mgt' => 0,
         'warehouse_mgt' => 0,
         'purchase_mgt' => 0,
         'product_mgt' => 0,
         'shift_mgt' => 0,
         
      ];
    }

    $accesControl->merge_attributes($data);
    $result2 = $accesControl->save();
    // logfile
    log_action('Edit Admin', "id: {$admin->id}, Editted by {$loggedInAdmin->full_name()}", "admin");

    $session->message('User updated successfully.');
    redirect_to(url_for('/users/'));
  } else {
    // show errors
  }
} else {

  // display the form
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
      <?php echo display_session_message(); ?>
      
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



   <!--  <script type="text/javascript">
        $(document).ready(function () {
            $('#print').click(function (e) {
                e.preventDefault();
                var link = $(this).attr('href');
                $.get(link);
                console.log(link)
                return false;
            });
            $('#email').click(function () {
                bootbox.prompt({
                    title: "Email Address",
                    inputType: 'email',
                    value: "customer@tecdiary.com",
                    callback: function (email) {
                        if (email != null) {
                            $.ajax({
                                type: "post",
                                url: "https://spos.tecdiary.net/pos/email_receipt",
                                data: {spos_token: "c4d8a1c258ec0fd41c11a781fd9f3efe", email: email, id: 1},
                                dataType: "json",
                                success: function (data) {
                                    bootbox.alert({message: data.msg, size: 'small'});
                                },
                                error: function () {
                                    bootbox.alert({message: 'Ajax request failed!', size: 'small'});
                                    return false;
                                }
                            });
                        }
                    }
                });
                return false;
            });
        });
    </script>
 -->