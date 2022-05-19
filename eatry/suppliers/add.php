<?php require_once('../private/initialize.php');
$page_title = 'Add New';
$page = 'User';



require_login();


if ($loggedInAdmin->admin_level != 1) {
    redirect_to(url_for('/login.php'));
}

if (is_post_request()) {

  // Create record using post parameters
    $rand = rand(1, 2);

    $args = $_POST['supplier'];

    if ($rand == 1) { 
        $args['profile_img'] = 'user1.png';
    } elseif ($rand == 2) {
        $args['profile_img'] = 'user2.png';
    }
    // print_r($args);
    $supplier = new supplier($args);
    // echo '<pre>';print_r($supplier);'</pre>';
    $result = $supplier->save();

    if ($result === true) {
        $new_id = $supplier->id;
    
        // Logfile
        // log_action('New supplier', "id: {$supplier->id}, Created by {$loggedInsupplier->full_name()}", "supplier");
    
        $session->message('Suppliers created successfully.');
        redirect_to(url_for('/suppliers/'));
    } else {
        // show errors
    }
} else {
    // display the form
    $supplier = new supplier;
}

include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title; ?> Suppliers</h1>
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
                <div></div>
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
                    value: "supplier@tecdiary.com",
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
