<?php
require_once('../../private/initialize.php');



$page = 'Transactions'; 
// $page_title = 'Wallet History';
$page_title = "All Transactions";
require_login();

?>

<?php include(SHARED_PATH . '/admin_header.php'); ?>
<div class="main-container">
	<!-- Content wrapper start -->

  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
        <div class="daterange-container">

        
        </div>
      </div>
    </div>

  </div>
  <!-- Page header end -->

  <div class="content-wrapper">
    <div>
      <table>
        <tr>
          <td>from: <input type="date" id="from" class="form-control form-control-sm" value="<?php echo date("Y-m-d") ?>"></td>
          <td>To: <input type="date" id="to" class="form-control form-control-sm" value="<?php echo date("Y-m-d") ?>"></td>
          <td><button id="find" class="mt-3 btn btn-primary btn-sm">Find</button></td>
        </tr>
      </table>
    </div>
    <div class="row gutters justify-content-center" id="show_matrics">
      
      
    </div>




    <?php echo display_session_message(); ?>
    <div class="table-responsive">
        <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="wallet-table">
          <thead>
            <tr role="row">
              <th>S/N</th>
              <th>Customer Name</th>
              <th>Amount</th>
              <th>Payment Method</th>
              <th>Bank Name</th>
              <th>Account No</th>
              <th>Action</th>
              <th>Registered at</th>
              <th>Registered By</th>
              
            </tr>
          </thead>
          <tbody id="show_data">

            
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
            <tbody id="show_details"></tbody>
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
          <div class="form-group col-md-12">
            <label class="form-label">Reference Number </label>
            <!-- <span style="float: right; margin-bottom: 1px" id="gen" class="btn btn-primary btn-sm">Generate</span> -->
            <input type="text" class="form-control" name="refrence_no" required id="code" readonly>
          </div>

          <div class="form-group col-md-12">
            <label class="form-label">Description </label>
            <textarea type="text" class="form-control" name="description" required></textarea>
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
  // $(document).on("click", "#gen", function() {
  //   gen_code();
  // });


    function gen_code() {
       $.ajax({
          url: 'codegen.php',
          method: 'post',
          data: {
             gen_code: 1,
          },
          dataType: "json",
          success: function(data) {
             if (data.msg == 'OK') {
                $('#code').val(data.barcode);
             }

          }
       });
    }

  $(document).on("click", ".deposit", function() {
    $("#show_deposit").modal('show');
     let customer_id = $(this).data('id');
     getPaymentHistory(customer_id);
  })

  $(document).on("click", "#find", function() {
    let from = $("#from").val();
    let to = $("#to").val();
    showMatrics(from, to);
  })

  let from = $("#from").val();
  let to = $("#to").val();
  showMatrics(from, to);
  function showMatrics(from, to) {
    $.ajax({
        url:"script.php",
        method:"POST",
        data:{
          matrics: 1,
          from: from,
          to: to,
        },
        success:function(data)
        {
           $("#show_matrics").html(data)
        }
     });
  }
  

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
     let id = $(this).attr('id');
     let customer_id = $(this).data('cust');
     let payment_method = $(this).data('type');

     if (payment_method == 3) {
        $("#customer_id").val(customer_id);
        $("#data_id").val(id);
        $("#enter_refrence").modal('show');
        gen_code();
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
            let from = $("#from").val();
            let to = $("#to").val();
            showMatrics(from, to);
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
</script>