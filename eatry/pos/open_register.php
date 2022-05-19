<?php require_once('../private/initialize.php');
$page_title = 'Open ';
$page = 'Register';

require_login();

$today = date("Y-m-d");
// $register = Register::find_by_time($today);
$register = Register::find_by_time(['open_time' => $today, 'created_by' => $loggedInAdmin->id]);
// pre_r($register);
if (!empty($register->created_by)) {
   redirect_to(url_for('/pos/'));
}

// if ($_SESSION['register'] != "") {
//    redirect_to(url_for('/pos/'));
// }


include(SHARED_PATH . '/header.php'); ?>
<style type="text/css">
  .store:hover{
    cursor: pointer;
    border: 4px solid #aaa;
  }
</style>
 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ." ". $page; ?></h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $page_title; ?></li>
       </ol>
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" >
          <div class="alert alert-info alert-dismissable">
             <div class="custom-msg"></div>
             <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-danger"></i> Welcome</h4>
                Register is not opened, please open register with cash in hand  
          </div>
       </div>
    </div>

  

    <section class="content">
      <?php echo display_session_message(); ?>
      <div class="row">
          <div class="col-xs-12">
              <div class="box box-primary">
                  <div class="box-header">
                      <h3 class="box-title">Please fill in the information below</h3>
                  </div>
                  <div class="box-body">
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="well well-sm col-sm-6">
                                  <form  data-toggle="validator" role="form" id="form" enctype="multipart/form-data" accept-charset="utf-8">
                                  <input type="hidden" name="register[created_by]" value="<?php echo $loggedInAdmin->id ?>">              
                                  <div class="form-group">
                                      <label for="cash_in_hand">Cash in hand</label>
                                      <input type="text" name="register[cash_in_hand]" value="" id="cash_in_hand" class="form-control">
                                  </div>
                                  <input type="submit" value="Open Register" id="open" class="btn btn-primary">
                                  </form>                                
                                  <div class="clearfix"></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <input type="hidden" id="url" value="<?php echo url_for('/pos/') ?>">
 </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
 
 <script type="text/javascript">
  $(document).on('click', '#open', function(e){
    e.preventDefault();
    var url = $('#url').val()
    // console.log(register_amt)
      $.ajax({
        url:"cart/open.php",
        method:"POST",
        data: $('#form').serialize(),
        dataType: "json",
        success:function(data)
        { 
          if (data.msg == 'OK') {
            successAlert('Register Opened Successfully');
           window.location.href = url;
         }else{
          errorAlert('Could not open Register');
 
          }
        }
     });
  })
   
 </script>