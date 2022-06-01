<?php require_once('../private/initialize.php');
$page_title = 'Scan';
$page = 'Inspection';
require_login();
include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ." ". $page; ?></h1>
       
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
                
                <div class="box-body">
                    <div id="reader"></div> 
                </div>
            </div>
          </div>
       </div>
    </section>
 </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
 

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
<script type="text/javascript" src="<?php echo url_for('assets/dist/js/html5-qrcode.min.js') ?>"></script>
<script type="text/javascript">

  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 }
  );
  html5QrcodeScanner.render(onScanSuccess);



  function onScanSuccess(qrCodeMessage) {
      // handle on success condition with the decoded message
      var unique_id = qrCodeMessage;
      $.ajax({
          type: "get",
          url: "inc/verify.php",
          data: {
            verify: 1, 
            id: unique_id, 
          },
          dataType: "json",
          success: function (data) {
              // bootbox.alert({message: data.msg, size: 'small'});
              if (data.msg == "OK") {
                successAlert("Verified Sucessfully");
              }else{
                onScanError();
                errorAlert("Invalid Credential");

              }
          },
      });





      // html5QrcodeScanner.clear();
      // ^ this will stop the scanner (video feed) and clear the scan area.
  }

  function onScanError(errorMessage) {
      // handle on error condition, with error message
      errorAlert("Sorry an error occuied. Please Try again")
  }

 

  

</script>

