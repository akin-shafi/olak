<?php require_once('../../private/initialize.php'); ?>

<?php $page = 'Return';
$page_title = 'All Returned Goods'; ?>

<?php include(SHARED_PATH . '/admin_header.php'); ?>

<div class="main-container">


  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
        <div class="daterange-container">

          <a href="#" class="btn btn-sm btn-success" id="create">
            <i class="feather-file-text"></i> Retun Goods
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="content-wrapper">
  <div class="table-responsive">
    <table class="table table-sm table-bordered" id="rowSelection">
        <thead>
            <th>s/n</th>
            <th>Customer Name</th>
            <th>Ref No</th>
            <th>Date Returned</th>
            <th>Processed By</th>
            <th>Branch</th>
        </thead>
        <tbody>
            <td>1</td>
            <td>Ade Kunle</td>
            <td>112234</td>
            <td>25 May, 2023</td>
            <td>Adeolu</td>
            <td>A Division</td>
        </tbody>
    </table>
  </div>

  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>