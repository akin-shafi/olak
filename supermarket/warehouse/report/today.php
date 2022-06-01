<?php require_once('../../private/initialize.php');
$page_title = 'Warehouse Transaction Record';
$page = 'Reports';


require_login();

include(SHARED_PATH . '/store-header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title?> </h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $page_title ?></li>
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
    
    <style type="text/css">
       .table td:first-child { padding: 1px; }
       .table td:nth-child(6), .table td:nth-child(7), .table td:nth-child(8) { text-align: center; }
       .table td:nth-child(9), .table td:nth-child(10) { text-align: right; }
       .action li{list-style: none;}
    </style>
    <section class="content">
      <?php echo display_session_message(); ?>
       <div class="row">
          <div class="col-xs-12">
             <div class="box box-primary">
                <div class="box-header ">
                   
                   <h3 class="box-title">Please use the table below to navigate or filter the results.</h3>
                   <div class="pull-right form-inline">
                     <input type="date" name="" id="from" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                     <input type="date" name="" id="to" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                     <button class="btn btn-primary btn-sm" id="find">Find</button>
                   </div>
                </div>
                <div>
                  
                </div>
                <div class="container-fluid" id="fetch_rec">
                    
                </div>
             </div>
          </div>
       </div>
    </section>
 </div>
<?php include(SHARED_PATH . '/footer.php'); ?>


<input type="hidden" id="url" value="<?php echo url_for('/') ?>">  

<script type="text/javascript" charset="UTF-8">
  $('#example2').DataTable()
  var start = $("#from").val();
  var end = $("#to").val();
  record(start, end)
  function record(start, end){
      $.ajax({
        url: 'fetch_sales.php',
        method: 'post',
        data: {
          fetch: 1,
          from: start,
          to: end
        },
        // dataType: 'json',
        success: function(r) {
              $('#fetch_rec').html(r); 
        }
      });
  }


  $(document).on('click', '#find', function() {
     var start = $("#from").val();
     var end = $("#to").val();
     record(start, end)
  });

    var eUrl = $("#url").val();
   $(document).on('click', '.view_sale', function() {
      // $("#posModal").modal("show");
      var trans_no = $(this).data('id');
      // console.log(id)
      window.open(eUrl +'warehouse/print_order.php?trans_no='+ trans_no, 'blank')
    });
   
</script>

