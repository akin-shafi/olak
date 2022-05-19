<?php require_once('../private/initialize.php');
$page_title = 'Ledger | Details';
$page = 'Reports';
$id = $_GET['id'] ?? 1;
$from = $_GET['from'] ?? date('Y-m-d');
require_login();

include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title?></h1>
       
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
          <div class="col-xs-12">
            <div class="box box-primary">

                <div class="box-body">
                   <h5 class="text-uppercase">Inventory Details</h5>
                      <div class="d-flex justify-content-between pb-3"> 
                          <div>
                            <input type="date" name="from" id="from" value="<?php echo $from ?>">
                          </div>
                          <div class="">
                            <a id="export" data-id="<?php echo $id ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export as CSV</a>

                          </div>
                         
                      </div>
                      <h3 class="text-center text-uppercase">Stock Record for: <?php echo Product::find_by_id($id)->pname; ?> <span id="title1"></span></h3>

                        <table class="table table-sm table-bordered" id="">
                          <!-- <table id="example5" class="display table table-sm table-bordered"> -->
                          <thead>
                            <tr>
                              <th></th>
                              <th colspan="6" class="text-center fs-20 bg-success">Open Stock</th>
                              <th colspan="5" class="text-center fs-20 bg-primary">Close Stock</th>
                              <th></th>
                            </tr>
                            <tr class="text-center">
                              <th>S/n</th>
                              <th>created On</th>
                              <th>Item</th>
                              <th>Ref No</th>
                              <th>Initial Stock</th>
                              <th>Supply</th>
                              <th>Total Stock</th>
                              <!--  -->
                              <!-- <th>Total.Amt</th> -->
                              <th>Unit Price</th>
                              <th class="bg-yellow">Unit Sold</th>
                              <th class="bg-yellow">Value in(<?php echo $currency ?>)</th>
                              <th class="bg-green">Avail Stock</th>
                              <th class="bg-green">Value in(<?php echo $currency ?>)</th>
                              <!-- Close -->
                              
                              
                            </tr>
                          </thead>
                          <tbody id="list">
                            
                          <tbody>
                        </table>
                </div>
                
            </div>
          </div>
       </div>
       
    </section>
 </div>




<input type="hidden" id="eid" value="<?php echo $id;  ?>">
<?php include(SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">
  var eid = $('#eid').val();
  var dateFrom = $('#from').val();
  load_product(eid , dateFrom)
  function load_product(eid , dateFrom) {
    $.ajax({
          url: 'inc/fetch_details.php',
          method: 'post',
          data: {
            fetch: 1,
            id: eid,
            from: dateFrom
          },
          success: function(data) {
            $('#list').html(data);   
          }
      });

  }
  $(document).on('change', '#from', function(e){
    var dateFrom = $(this).val()
    load_product(eid , dateFrom)
  })

  $(document).on('click', '#export', function(e){
      e.preventDefault();
      var eid = $(this).data('id');
      $.ajax({
          url: '../export_csv/exportData.php',
          method: 'post',
          data: {
            fetch: 1,
            id: eid,
            table: 'stockBinDetails',
            rows: ['ID', 'Product Name']
          },
          success: function(data) {
            // $('#list').html(data);   
          }
      });
  })
  

</script>






