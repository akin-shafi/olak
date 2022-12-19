<?php
require_once('../../private/initialize.php');
require_login();

?>
<?php $page = 'Wallet'; $page_title = 'Load Wallet'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<style type="text/css">
  .red{
    color: red; 
    font-weight: bold; 
    font-size: 20px; 
    text-decoration:underline;
  }
  .green{
    color: green; 
    font-weight: bold; 
    font-size: 20px; 
    /*text-decoration:underline;*/
  }
</style>
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
          <?php if (!in_array($loggedInAdmin->admin_level, [2,3])) { ?>
           <a href="<?php echo url_for('wallet/add.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New wallet">
            <i class="feather-plus"></i>
          </a>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->

  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <?php echo display_session_message(); ?>


    <div class="table-responsive">
          <table id="rowSelection" class="table table-sm table-striped " >
          <thead>
            <tr role="row">
              <th>S/N</th>
              <th>Customer Name</th>
              <th>Customer No</th>
              <th>Wallet Balance</th>
              <th>Un-confirmed</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="show_data">
            <?php $sn = 1;
              foreach (Client::find_by_undeleted() as $client) : 
                $customer_name = $client->full_name();
                $balance = intval($client->balance);
                $sum =  WalletFundingMethod::sum_of_unapproved(['customer_id' => $client->customer_id, 'approval' => 0]);
              ?>
                <tr>
                  <td><?php echo $sn++ ?></td>
                  <td>
                    <a href="<?php echo url_for('client/show.php?id='. $client->id) ?>" class="d-flex align-items-center">
                      <h6 class="mb-0 fs-14"><?php echo ucwords($customer_name) ?></h6>
                    </a>
                  </td>
                  <td><?php echo ucwords($client->customer_id) ?> </td>
                  <td class="green"><?php echo number_format($balance, 2) ?> </td>
                  <td>
                    <?php if ($sum != 0) {?>
                      <a href="#" data-id="<?php echo $client->customer_id ?>" class="red deposit"><?php echo number_format($sum, 2) ?></a>
                    <?php }else{ ?>
                      <?php echo number_format($sum, 2) ?>
                    <?php } ?>
                  </td>
                

                  <td>
                    <?php if (!in_array($loggedInAdmin->admin_level, [2,3])) { ?>
                      <a href="<?php echo url_for('wallet/add.php?id=' . $client->customer_id) ?>" class="btn btn-sm btn-primary "> <i class="feather-plus text-success"></i> Load wallet</a> 
                    <?php } ?>
                  
                    <?php if (in_array($loggedInAdmin->admin_level, [1,2])){ ?>
                          <a href="<?php echo url_for('token/add.php?id=' . $client->customer_id) ?>" class="btn btn-sm btn-danger d-none"> <i class="feather-plus text-dark"></i> Generate Token</a> 
                    <?php } ?>

                    <?php if (in_array($loggedInAdmin->admin_level, [1,6])){ ?>
                          <a href="<?php echo url_for('refund/new.php?id=' . $client->customer_id) ?>" class="btn btn-sm btn-info "> <i class="feather-plus text-dark"></i> Refund Customer</a> 
                    <?php } ?>
                  </td>

                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
    </div>
    
  </div>

</div>


<div class="modal fade" tabindex="-1" id="show_deposit" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Payment History</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="rowSelection" class="table table-sm table-striped ">
            <thead>
              <tr>
                <td>S/N</td>
                <td>Amount</td>
                <td>Payment Method</td>
                <td>Bank Name</td>
                <td>Account No.</td>
                <td>Date</td>
                <td>Registered By</td>
                <?php if($accessControl->can_approve == 1) : ?>
                <td>Action</td>
                <?php endif  ?>

              </tr>
            </thead>
            <tbody id="show_details">
              
            </tbody>
          </table>
      </div>
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" id="enter_refrence" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter Refrence</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="submit_ref">
          <input type="hidden" id="data_id" name="id">
          <input type="hidden" id="customer_id" name="customer_id">
          <input type="hidden" name="submit">
          <div class="form-group col-md-12">
            <label class="form-label">Refrence Number <sup class="text-danger">*</sup></label>
            <input type="text" required class="form-control" name="refrence_no" readonly id="ref_no">
          </div>

          <div class="form-group col-md-12">
            <label class="form-label">Description <sup class="text-danger">*</sup></label>
            <textarea type="text" class="form-control" name="description"></textarea>
          </div>

          <div class="clearfix">
            <input type="submit" class="btn btn-primary float-right">
          </div>
        </form>
          
      </div>
      
    </div>
  </div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>
<script type="text/javascript">
  $(document).on("click", ".deposit", function() {
    $("#show_deposit").modal('show');
     let customer_id = $(this).data('id');
     getPaymentHistory(customer_id);
  })

  
  function showData() {
    $.ajax({
        url:"script.php",
        method:"POST",
        data:{
          show: 1,
        },
        success:function(data)
        {
           $("#show_data").html(data)
        }
     });
  }
  showData();

  function getPaymentHistory(customer_id) {
    $.ajax({
        url:"script.php",
        method:"POST",
        data:{
          unapproved: 1,
          customer_id: customer_id,
          approval: 0,
        },
        success:function(data)
        {
           $("#show_details").html(data)
        }
     });
  }

  $(document).on("click", ".approve", function() {
    $(this).attr("disabled", true);
    $(this).html("processing..");

     let id = $(this).attr('id');
     let customer_id = $(this).data('cust');
     let payment_method = $(this).data('type');

     if (payment_method == 3) {
        $("#customer_id").val(customer_id);
        $("#data_id").val(id);
        gen_code();
        $("#enter_refrence").modal('show');
     }else{
        approval(id, customer_id);
     }
     
  })

  function approval(id, customer_id) {
    $.ajax({
        url:"script.php",
        method:"POST",
        dataType: 'json',
        data:{
          approve: 1,
          id: id,
        },
        success:function(data)
        {
          if(data.msg == 'OK'){
            getPaymentHistory(customer_id);
            showData();
            successTime("Approved");
          }
        }
     });
  }

  $(document).on("submit", "#submit_ref", function(e) {
    e.preventDefault();
      let id = $("#data_id").val();
      let customer_id = $("#customer_id").val();
      $.ajax({
        url:"script.php",
        method:"POST",
        dataType: 'json',
        data: $(this).serialize(),
        success:function(data)
        {
          if(data.msg == 'OK'){
            approval(id, customer_id)
            $("#enter_refrence").modal('hide');
          }else{
            errorAlert(data.msg);
          }
        }
     });
  })

  gen_code();

    function gen_code() {
       $.ajax({
          url: 'script.php',
          method: 'post',
          data: {
             gen_code: 1,
          },
          dataType: "json",
          success: function(data) {
             if (data.msg == 'OK') {
                $('#ref_no').val(data.barcode);
             }

          }
       });
    }

</script>

