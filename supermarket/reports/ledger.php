<?php require_once('../private/initialize.php');
$page_title = 'Balance Sheet';
$page = 'Balance Sheet';
require_login();

include(SHARED_PATH . '/header.php'); ?>
<style type="text/css">
  td a{
    text-decoration: underline;
    color: red;
  }
</style>
 <div class="content-wrapper">
    <section class="content-header d-flex justify-content-between">
       <h1><?php echo $page_title; ?></h1>
       <div>
         <?php echo $page ?> > <a href="<?php echo url_for('/stock/list.php') ?>">Go to Stock >></a>
       </div>
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" style="display:none;">
          <div class="alert alert-dismissable">
             <div class="custom-msg"></div>
          </div>
       </div>
    </div>
    <section class="content">
      <div class="col-lg-12 alerts d-flex justify-content-center mn-4">
            <?php //echo display_errors($product->errors); ?>
         </div>
      <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green">
                       <span class="info-box-icon"><i class="fa fa-money"></i></span>
                       <div class="info-box-content">
                          <span class="info-box-text">Value of Sold  </span>
                          <span class="info-box-number" id="value_of_sold"></span>
                          <div class="progress">
                             <div style="width: 100%" class="progress-bar"></div>
                          </div>
                          <span class="progress-description">Today </span>
                       </div>
                    </div>
                 </div>

                 <div class="col-md-3 col-sm-6 col-xs-12 d-none">
                    <div class="info-box bg-aqua">
                       <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                       <div class="info-box-content">
                          <span class="info-box-text">Sum of Returned  </span>
                          <span class="info-box-number" id="sum_of_return"></span>
                          <div class="progress">
                             <div style="width: 100%" class="progress-bar"></div>
                          </div>
                          <span class="progress-description">Today </span>
                       </div>
                    </div>
                 </div>

                 <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                       <span class="info-box-icon"><i class="fa fa-money"></i></span>
                       <div class="info-box-content">
                          <span class="info-box-text">Value of leftover  </span>
                          <span class="info-box-number" id="value_of_return"></span>
                          <div class="progress">
                             <div style="width: 100%" class="progress-bar"></div>
                          </div>
                          <span class="progress-description">Today </span>
                       </div>
                    </div>
                 </div>

                 
       </div>
       <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary container p-3">

                <div class="row">
                    <div class="col-md-6">
                         <div class="btn-group">
                            <a href="<?php echo url_for('report/exportData.php') ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export as CSV</a>
                          </div>
                    </div>

                    <div class="col-md-6">
                     <form class="form-inline p-2 d-flex justify-content-end" id="find_week">
                        <div class="form-group mr-5">
                          <label class="control-label">From:</label>
                          <input type="date" id="from" class="form-control" value="<?php echo date('Y-m-d') ?>">
                        </div>
                        <div class="form-group d-none">
                          <label class="control-label">To:</label>
                          <!-- <input type="date" id="to" class="form-control" value="<?php //echo date('Y-m-d') ?>"> -->
                        </div>
                          <input type="button" class="btn btn-sm btn-primary d-none" id="find" value="Find">
                      </form>
                    </div>
                </div>
                <div class="box-body">
                   <h5 class="text-uppercase">Sales Ledger</h5>
                      
                    <div class="table-responsive">
                      <table class="table table-sm table-bordered" id="">
                        <thead>
                          <tr class="text-center">
                            <th>Product</th>
                            <th>Unit Cost</th>
                            <th>Issue</th>
                            <th class="bg-success">Quantity Sold</th>
                            <th class="bg-success">Value</th>
                            <th class="bg-red">Left over</th>
                            <th class="bg-red">Value</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody id="fetch_rec" >

                             
                        <tbody>
                      </table>
                    </div>
                </div>
            </div>
          </div>
       </div>
       
    </section>
 </div>


<div class="modal fade none-border" id="stockModal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Item</strong></h4>
            </div>
            <form method="post" id="form"></form>
        </div>
    </div>
</div>

<input type="hidden" id="eUrl" value="<?php echo url_for('/stock/list') ?>">
<?php include(SHARED_PATH . '/footer.php'); ?>


<script type="text/javascript">
  var from = $("#from").val();
  // var to = $("#to").val();
  record(from);

  function record(from, to){
      $.ajax({
        url: 'inc/fetch_record.php',
        method: 'post',
        data: {
          fetch: 1,
          from: from,
          // to: to,
        },
        // dataType: 'json',
        success: function(r) {
              $('#fetch_rec').html(r);       
        }
      });
  }

  // $(document).on("click", "#find", function() {
  //    var from = $("#from").val();
  //    var to = $("#to").val();
  //    var exception = $("#exception").val();
  //    record(from,to, exception);
  // })

  $(document).on('change', '#from', function(e){
    var from = $(this).val()
    // var to = $("#to").val()
    record(from)
    // record(from, to)
  })

</script>


