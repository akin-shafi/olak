<?php
require_once('../../private/initialize.php');
require_login();

?>
<?php $page = 'Token'; $page_title = 'All Token'; ?>
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

         <!--  <a href="#" id="btn_add_token"  data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New token">
            <i class="feather-plus"></i>
          </a> -->
           <a href="<?php echo url_for('token/add.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New token">
            <i class="feather-plus"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <?php echo display_session_message(); ?>
    <div class="table-responsive">
        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="token-table">
          <thead>
            <tr role="row">
              <th>S/N</th>
              <th>Token ID</th>
              <th>Amount</th>
              <th>Token Type</th>
              <th>Customer Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $sn = 1;
            foreach (token::find_by_undeleted() as $token) : 
             
            ?>
              <tr>
                <td><?php echo $sn++ ?></td>
                <td><?php echo $token->token_id ?></td>
                <td><?php echo $currency." ".number_format($token->amount, 2) ?></td>
                <td><?php echo  Token::TOKEN_TYPE[$token->token_type] ?? "Not Set" ?></td>
                <td><?php echo Client::find_by_customer_id($token->customer_id)->full_name() ?? "Not Set"; ?> </td>
                <td><?php echo Token::STATUS[$token->status] ?? "Not Set"; ?> </td>
                
                <td>
                  <a href="<?php echo url_for('token/edit.php?id='. $token->customer_id ) ?>" class=" btn btn-sm btn-primary " > <i class="feather-edit text-success"></i> Edit token</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
    
  </div>

</div>



<?php include(SHARED_PATH . '/admin_footer.php'); ?>

