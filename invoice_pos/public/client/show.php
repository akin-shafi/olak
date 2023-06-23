<?php

require_once('../../private/initialize.php');

// require_login();

$id = $_GET['id'];
$clients = Client::find_by_id($id);
$walletBalance = intval($clients->balance);
$walletDetails = WalletFundingMethod::find_by_customer_id($clients->customer_id);
$transactions = Billing::find_by_client_id($id);
$totalDeposit = WalletFundingMethod::sum_of_unapproved(['approval' => 1, 'customer_id' => $clients->customer_id ]) ?? 0;
$totalDelivered = Billing::sum_of_sales(['client_id' => $id, 'status' => 2]);
$totalUndelivered = Billing::sum_of_sales(['client_id' => $id, 'status' => 1]);
// pre_r($clients);
?>
<?php $page_title = 'Admins'; ?>
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
<div class="main-container">


  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title">Client Profile</h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          <a href="<?php echo url_for('client/index.php') ?>" data-toggle="tooltip" data-placement="top" title="view all Customers" class="download-reports" data-original-title="iew all Customers">
            <i class="feather-arrow-left"></i>
          </a>
        </div>
      </div>
    </div>
  </div>


  <div class="content-wrapper">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12 border">
            <div class="profile-view">
              <div class="profile-img-wrap border">
                <div class="profile-img">
                  <a href="">
                    <img src="<?php echo url_for('/img/user1.png') ?>" alt="">
                  </a>
                </div>
              </div>
              <div class="profile-basic border">
                <div class="row">
                  <div class="col-md-5 col-sm-12 col-12">
                    <div class="profile-info-left">
                      <h3 class="user-name m-t-0"><?php echo $clients->full_name() ?? "Not Set" ?></h3>
                      <h5 class="company-role m-t-0 mb-0">Customer ID: <?php echo $clients->customer_id; ?></h5>
                      <div class="staff-id"><i>Registered By : <?php echo Admin::find_by_id($clients->created_by)->full_name(); ?></i></div>
                      <div class="staff-msg">
                          <a href="<?php echo url_for('wallet/add.php?id=' . $clients->customer_id) ?>" class="btn btn-sm btn-primary "> <i class="feather-plus text-success"></i> Load wallet</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7 col-sm-12 col-12">
                    <ul class="personal-info">
                      <li>
                        <span class="title">Phone:</span>
                        <span class="text"><a href=""><?php echo $clients->phone; ?></a></span>
                      </li>
                      <li>
                        <span class="title">Email:</span>
                        <span class="text"><a href=""><?php echo $clients->email; ?></a></span>
                      </li>
                      <li class="d-none">
                        <span class="title">Wallet Balance:</span>
                        <span class="text"><a href=""><?php echo number_format($walletBalance, 2) ?></a></span>
                      </li>

                    </ul>

                    <div class="table-responsive">
                      <h3>Account Narration</h3>
                      <table class="table table-bordered">
                        <tr>
                          <th>Wallet Balance:</th>
                          <td>
                            <?php echo $currency . ' ' . number_format($walletBalance) ?>
                            <?php if (in_array($loggedInAdmin->admin_level, [1, 2])) : ?>
                            <button class="btn btn-sm btn-outline-primary editClient" data-id="<?php echo $clients->id ?>"><i class="feather-edit"></i></div>
                            <?php endif ?>
                        </td>
                        </tr>
                       
                        <tr>
                          <th>Total Transaction:</th>
                          <td><?php echo $currency . ' ' . number_format($totalDelivered + $totalUndelivered) ?></td>
                        </tr>
                        <tr>
                          <th>Total Delivered</th>
                          <td><?php echo $currency . ' ' . number_format($totalDelivered) ?></td>
                        </tr>
                        <tr>
                          <th>Total UnDelivered</th>
                          <td><?php echo $currency . ' ' . number_format($totalUndelivered) ?></td>
                        </tr>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <h3>Deposit History</h3>
    <div class="table-responsive">
      <div class="d-flex justify-content-end">
        <!-- <h3>Sum of Deposit </h3> -->
        <h3>Total Deposit: <span class="text-danger"><?php echo $currency . ' ' . number_format($totalDeposit) ?></span></h3>
      </div>
      <table class="table table-bordered " id="rowSelection">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Payment ID</th>
            <th>Payment Method</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Post By</th>
            <th>Branch </th>
            <th>Bank Name</th>
            <th>Account No.</th>
            <th>Created At</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php $sn = 1;
          foreach ($walletDetails as $value) {
            $bankName = Bank::find_by_id($value->bank_name)->bank_name ?? "Not Set";
            $account_no = Bank::find_by_id($value->bank_name)->account_number ?? "Not Set";
            $createdBy = Admin::find_by_id($value->created_by)->full_name();
            $branch_id = Admin::find_by_id($value->created_by)->branch_id;
            $branch = Branch::find_by_id($branch_id)->branch_name;
          ?>
           
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><a href="<?php echo url_for('wallet/pop.php?payment_id=' . h(u($value->payment_id))); ?>"><?php echo h(ucwords($value->payment_id)); ?></a></td>
              <td><?php echo Billing::PAYMENT_METHOD[$value->payment_method]; ?></td>

              <td>
                
                    <?php if ($value->approval == 0) {?>
                      <a href="#" data-id="<?php echo $clients->customer_id ?>" class="red deposit"><?php echo number_format(floatval($value->amount)) ?></a>
                    <?php }else{ ?>
                      <?php echo number_format(floatval($value->amount)) ?>
                    <?php } ?>
              </td>             
              <td>
                <?php  echo $value->approval == 0 ? "Unapproved" : "Approved"; ?>
                <?php  echo $value->deleted == 1 ? " and Deleted" : ""; ?>

              </td>
              <td><?php echo $createdBy; ?></td>
              <td><?php echo $branch; ?></td>
              <td><?php echo ucwords($bankName); ?></td>
              <td><?php echo $account_no; ?></td>
              <td><?php echo date('dS M, Y H:i:s', strtotime($value->created_at)); ?></td>
              
              <td>
                <a href="#!" class="btn btn-sm btn-danger" id="delete_pop"  data-id="<?php echo $value->id; ?>"> <i class="feather-trash tet-info"></i> <?php //echo $value->id; ?>  </a>

              </td>
              <!-- <td><a href="record.php"><i class="feather-settings bold"> History</i></a></td> -->
            </tr>
          <?php } ?>
        </tbody>
      </table>
      
    </div>

    <h3>Transaction History</h3>
    <div class="table-responsive">
      <table class="table table-bordered" id="highlightRowColumn">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Status</th>
            <th>Invoice No.</th>
            <th>Created By</th>
            <th>Branch</th>
            <th>Created Date</th>
            <th>Total Amount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $sn = 1;
          foreach ($transactions as $value) {
            $branch = Branch::find_by_id($value->branch_id);

            $createdBy = $value->created_by != '' ? Admin::find_by_id($value->created_by)->full_name() : "No Name" ;
          ?>
          
            <tr>
              <td><?php echo $sn++; ?></td>
              <td>
                <?php echo h(Billing::STATUS[$value->status]); ?>
              </td>
              <td>
                
                <?php if(intval($value->invoiceNum) != 0 ): ?>
                <a href="<?php echo url_for('invoice/invoice.php?invoice_no=' . h(u(intval($value->invoiceNum)))); ?>">
                  <?php echo h(ucwords(intval($value->invoiceNum))) ?></a>
                <?php else: ?>
                  <span class="h3 text-danger">Error</span>
                <?php endif ?>
                
              </td>
              <td><?php echo $createdBy ?></td>
              <td><?php echo h(ucwords(substr($branch->branch_name, 0, 30))); ?></td>
              <td><?php echo h(date('D jS M, Y H:i:s', strtotime($value->created_date))); ?></td>
              <td><?php echo number_format(intval($value->total_amount)); ?></td>
              <?php if (in_array($loggedInAdmin->admin_level, [1])) : ?>
              <td>
              <?php if(intval($value->invoiceNum) != 0 ): ?>
                <?php if (in_array($loggedInAdmin->id, [1])) : ?>
                <a class="btn btn-sm btn-primary" href="<?php echo url_for('/invoice/edit.php?invoiceNum=' . $value->invoiceNum); ?>"> <i class="feather-maximize-2 tet-info"></i> Recall Invoice </a>
                <?php endif ?>
                <a href="#!" class="btn btn-sm btn-primary" id="delete_void" data-customerid="<?php echo $clients->id ?>" data-id="<?php echo $value->id; ?>"> <i class="feather-maximize-2 tet-info"></i> Void  </a>
              <?php else: ?>
                  <span class="h3 text-danger">Error</span>
              <?php endif ?>
                
              </td>
              <?php endif ?>
            </tr>
           
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-end">
      <table>
        <tr>
          <td>Total Delivered</td>
          <td><?php echo $currency . ' ' . number_format($totalDelivered) ?></td>
        </tr>
        <tr>
          <td>Total Not Yet Delivered</td>
          <td><?php echo $currency . ' ' . number_format($totalUndelivered) ?></td>
        </tr>
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

<div class="modal fade none-border"clientModal" aria-modal="true" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong> Edit wallet</strong></h4>
            </div>
            <div class="col-12 text-center" id="editwalletErrors"></div>
            <form method="post" id="editwalletInput">
                <div class="modal-body row" id="fetchwalletForm">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="editwallet"
                        class="btn btn-primary save-event waves-effect waves-light">Edit
                        wallet</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php');
?>
<script>
  $(document).ready(function() {
    

    $(document).on('click', '#delete_pop', function() {
      let deletePOP = this.dataset.id;
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "inc/script.php",
            method: "POST",
            data: {
              id: deletePOP,
              delete_pop: 1,
            },
            dataType: 'json',
            success: function(data) {
              if (data.success == true) {
                successAlert(data.msg);
                window.location.reload()
              }else{
                errorAlert(data.msg)
              }
            }
          });
        }
      })
    //   .then(() => window.location.reload())

    });


  $(document).on('click', '#delete_void', function() {
      let deleteVoid = this.dataset.id;
      let customerID = this.dataset.customerid;
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "../invoice/inc/index.php",
            method: "POST",
            data: {
              id: deleteVoid,
              delete_void: 1,
              customerID: customerID
            },
            dataType: 'json',
            success: function(data) {
              if (data.success == true) {
                successAlert(data.msg);
              }else{
                errorAlert(data.msg)
              }
            }
          });
        }
      })
      .then(() => window.location.reload())

    });



    // editwallet
    $(document).on('click', '.editClient', function(e) {
        $("#editModal").modal('show');
        var eid = $(this).data('id');
        console.log(eid)
        $.ajax({
            url: 'inc/fetch_wallet_form.php',
            method: 'post',
            data: {
                walletForm: 1,
                id: eid,
            },
            success: function(r) {
                $("#fetchwalletForm").html(r)
            }

        }); 
    })

    $(document).on('click', '#editwallet', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'inc/script.php',
            method: 'post',
            data: $('#editwalletInput').serialize(),
            dataType: 'json',
            success: function(r) {
                if (r.msg == 'OK') {
                    successTime("Item updated Succesfully Reload to see changes");
                    $("#editwalletModal").modal('hide');
                    window.location.reload();
                } else {
                    $("#editwalletErrors").html(r.msg)
                }
            }

        });
    })





  $(document).on("click", ".deposit", function() {
    $("#show_deposit").modal('show');
    let customer_id = $(this).data('id');
    getPaymentHistory(customer_id);
  })
  function getPaymentHistory(customer_id) {
    $.ajax({
        url:"inc/process.php",
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
        url:"inc/process.php",
        method:"POST",
        dataType: 'json',
        data:{
          approve: 1,
          id: id,
        },
        success:function(data)
        {
          if(data.success == true){
            getPaymentHistory(customer_id);
            showData();
            successTime(data.msg);
          }else{
            getPaymentHistory(customer_id);
            showData();
            errorAlert(data.msg)
            
          }
        }
    });
  }

  $(document).on("submit", "#submit_ref", function(e) {
    e.preventDefault();
      let id = $("#data_id").val();
      let customer_id = $("#customer_id").val();
      $.ajax({
        url:"inc/process.php",
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
          url: 'inc/script.php',
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


  });
</script>