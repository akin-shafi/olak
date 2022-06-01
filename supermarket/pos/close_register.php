<?php require_once('../private/initialize.php');
$page_title = 'Register';
$page = 'Report';
require_login();

$yesterday = date('Y-m-d',strtotime("-1 days"));
// echo $yesterday;
$close_register = Register::find_by_time(['open_time' => $yesterday, 'created_by' => $loggedInAdmin->id]);
// pre_r($close_register);

if (!empty($close_register->close_time) ) {
   // redirect_to(url_for('/pos/'));
}

include(SHARED_PATH . '/header.php'); ?>
<style type="text/css">
  #list-table{display: none;}
</style>
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
       <!--  <div class="col-xs-12">
          
        </div> -->
          <div class="col-xs-12">

            <div class="box box-danger">
                
                <div class="box-header border-bottom " style="background-color: red">
                   <div class="dropdown pull-right">
                      
                      <div class="daterange-container btn btn-">
                        <div class="date-range">
                          <div id="reportrange">
                            <i class="feather-calendar cal"></i>
                            <span class="range-text"></span>
                            <i class="feather-chevron-down arrow"></i>
                          </div>
                        </div>
                        <button class="pull-right btn btn-default" id="more">More/less</button>
                        <input  class="pull-right" type="hidden" value="<?php echo date('Y-m-d',strtotime("-1 days")) ?>" id="date" >
                      </div>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                      </ul>
                   </div>
                   <h3 class="box-title " style="color: #FFF; padding-top: 18px; ">
                     Wait You did not close your register yesterday
                   </h3>
                </div>
                <!--  -->
                <div class="box-body">
                  <div class="modal-content" id="show_register"><h1 class="text-center" style="width: 100%">Loading...</h1></div>
                </div>
            </div>
          </div>
       </div>
    </section>
 </div>
<input type="hidden" id="url" value="<?php echo url_for('/pos/') ?>">
<input type="hidden" id="yesterday" value="<?php echo $yesterday ?>">
<input type="hidden" id="print_sale" value="<?php echo url_for('/reports/print_sales_order.php') ?>">
<input type="hidden" id="created_by" value="<?php echo $loggedInAdmin->id ?>">
<?php include(SHARED_PATH . '/footer.php'); ?>
 
<script type="text/javascript">

  var current_date = $("#date").val();
  load_register(current_date);
  function load_register(current_date) {
     
      $.ajax({
        url: '../pos/cart/fetch_register.php',
        method: 'post',
        data: {
          fetch: 1,
          close_reg: 1,
          from: current_date,
          created_by: $("created_by").val(),
        },
        // dataType: 'json',
        success: function(r) {
          $('#show_register').html(r);     
        }
      });
  }

  $(document).on('change', '#date', function(){
    var current_date = $(this).val()
    load_register(current_date)
  });
  $(document).on('click', '#more', function(){
    $("#list-table").toggle();
  })

  $(document).on('click', '#close_register', function(e){
     e.preventDefault();
     var print_sale = $('#print_sale').val()
     var yesterday = $('#yesterday').val()
     $.ajax({
       url: '../pos/cart/post_sales.php',
       method: 'post',
       data: $('#form').serialize(),
       dataType: 'json',
       success: function(r) {
         if (r.msg =='OK' ) {
            // window.location.href = eUrl;
             window.location.href = print_sale + "?created_by=" + r.created_by + "&from=" + yesterday + "&to=" + yesterday+ "&location=" + "pos";
         }else{
            errorAlert('Could not close Register')
         }    
       }
     });
  })
</script>