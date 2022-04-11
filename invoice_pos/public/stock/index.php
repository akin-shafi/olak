<?php
require_once('../../private/initialize.php');
require_login();

?>
<?php $page = 'Stock'; $page_title = 'Stock'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- ************* Main container start ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
        <div class="daterange-container">

          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->

  <!-- Content wrapper start -->
  <div class="content-wrapper">
   <!-- <h5>STOCK RECORD</h5> -->
    <div class="table-responsive">
      <table id="rowSelection" class="table table-sm table-striped ">
        <thead>
          <tr class="active">
            <th>Product</th>
            <th>Recent Supply</th>
            <!-- <th>Total overtime</th> -->
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (Product::find_by_undeleted() as $result => $value) { ?>
            <tr>
              <td> <?php echo $value->pname; ?></td>
              <td>0.0</td>
              <td>
                <button class="btn btn-primary btn-sm add_stock">Add Stock</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</div>



<div class="modal fade " id="addStockModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customModalLabel">Add Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" >
          <div class="row">
            <div class="form-group col-md-6">
              <label>Product Name</label>
              <input type="text" name="" class="form-control">
            </div>

            <div class="form-group col-md-6">
              <label>Quantity</label>
              <input type="text" name="" class="form-control">
            </div>


            <div class="form-group col-md-12 d-flex justify-content-end">
              <input type="submit" class="btn-sm btn-primary">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script type="text/javascript">
  $(document).on('click', '.add_stock', function(e){
    e.preventDefault();
    $("#addStockModal").modal('show')
  })
</script>
