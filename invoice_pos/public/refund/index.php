<?php
require_once('../../private/initialize.php');
require_login();

?>
<?php $page = 'Wallet'; $page_title = 'All Refund'; ?>
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
           <a href="<?php echo url_for('refund/new.php') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New wallet">
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
              <!-- <th>Wallet Balance</th> -->
              <th>Refund Value</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="show_data">
            <?php $sn = 1;
              foreach (Refund::find_by_undeleted() as $value) : 
                $customer_name = Client::find_by_customer_id($value->customer_id)->full_name();
                $balance =  Client::find_by_customer_id($value->customer_id)->balance;
                // $sum =  Refund::sum_of_unapproved(['customer_id' => $value->customer_id, 'approval' => 0]);
              ?>
                <tr>
                  <td><?php echo $sn++ ?></td>
                  <td>
                    <h6 class="mb-0 fs-14"><?php echo ucwords($customer_name) ?></h6>
                  </td>
                  <!-- <td class="green"><?php //echo number_format($balance, 2) ?> </td> -->
                  <td>
                    
                      <?php echo $currency." ". number_format($value->amount, 2) ?>
                   
                  </td>
                  <td><?php echo Refund::STATUS[$value->status] ?? 'NULL' ?></td>
                  <td>
                    <?php if ($value->status == 0) { ?>
                      <a class="btn btn-sm btn-primary approve" id="<?php echo  $value->id ?>"> <i class="feather-plus text-success"></i> Approve</a> 
                    <?php } ?>
                  </td>

                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
    </div>
    
  </div>

</div>


<div class="modal fade" tabindex="-1" id="confirm" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <h1>Alert</h1>
        <p class="">Are you sure you want to approve this refund request ?</p>
          
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary yes" id="yes">Yes</button>
      </div>
    </div>

    
  </div>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>
<script type="text/javascript">
  
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


  $(document).on("click", ".approve", function() {
     let eid = $(this).attr('id');
     $("#confirm").modal("show");
     $('#yes').attr('id',eid)
  });


   $(document).on("click", ".yes", function() {
     let id = $(this).attr('id');
     // console.log(id);
     approval(id);

  });

  function approval(id) {
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
            $("#confirm").modal("hide");
            showData();
            successAlert("Approved Successfully");
          }
        }
     });
  }


</script>

