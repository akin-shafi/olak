<?php

require_once('../../private/initialize.php');

require_login();

$clients = Billing::find_by_undeleted();
$companies = Company::find_by_undeleted();
// $branches = Branch::find_by_company_id($companyId);


$page = 'Invoice';
$backlog = $_GET['backlog'] ?? 0;
// echo $backlog;
$status = $_GET['status'] ?? 0;
if ($backlog == 0 && $status == 1) {
  $page_title = 'In Progress';
} else if (($backlog == 0 && $status == 2)) {
  $page_title = 'Delivered';
} else if ($backlog == 1 && $status == 1) {
  $page_title = 'Backlog';
}


?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<style>
  #loading-spinner {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.8);
    z-index: 2;
  }
</style>

<div class="main-container">
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title">All Invoices</h5>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 d-none">

        <div class="d-flex justify-content-end align-items-center">
          <div class="btn-group">
            <select class="form-control mr-2" id="company">
              <option value="">Select company</option>
              <?php foreach ($companies as $company) : ?>
                <option value="<?php echo $company->id ?>">
                  <?php echo ucwords($company->company_name) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="btn-group" id="get_branch">
            <select class="form-control" id="branch">
              <option value="">Select branch</option>
            </select>
            <button class="btn btn-primary query">
              <i class="feather-filter"></i></button>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="content-wrapper">

    <section class="">
      <?php echo display_session_message(); ?>
      <div class="row">

        <div class="col-lg-2 ">
          <?php include('sideNav.php'); ?>
        </div>

        <div class="col-lg-10">

          <div id="loading-spinner" style="padding-top:400px">
            <div class="spinner-border text-primary" role="status"></div>
            <h3>Processing...</h3>
          </div>

          <div class="table-responsive" id="complete_filter">

          </div>
          <!-- <div class="btn-group">
							<div class="btn btn-danger btn-sm">Clear Check</div>
						</div> -->
        </div>
      </div>
    </section>

  </div>

</div>



<div class="modal fade" tabindex="-1" id="modal_confirm" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" id="invoice_num" name="">
      <div class="modal-body">
        <p class="text-center">Are you sure, you want to process this transaction ?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="yes_process">Yes</button>
      </div>

    </div>
  </div>
</div>


<input type="hidden" id="company_id" value="<?php echo $loggedInAdmin->company_id ?>">
<input type="hidden" id="branch_id" value="<?php echo $loggedInAdmin->branch_id ?>">
<input type="hidden" id="backlog" value="<?php echo $backlog ?? 0 ?>">
<input type="hidden" id="status" value="<?php echo $status ?? 0 ?>">


<input type="hidden" id="BASE_URL" value="<?php echo url_for('/') ?>">
<?php include(SHARED_PATH . '/admin_footer.php');
?>

<script>
  $(document).ready(function() {
    const FILTER_URL = "inc/filter.php";

    $('#loading-spinner').show();

    $('#company').on('change', function() {
      let companyId = this.value;
      getBranches(companyId)
    })

    function getBranches(params) {
      $.ajax({
        url: FILTER_URL,
        method: "POST",
        data: {
          comp_id: params
        },
        success: function(r) {
          $('#get_branch').html(r);
        }
      });
    }

    $(document).on('click', '.query', function() {
      let companyId = $('#company').val()
      let branchId = $('#branch').val()
      let backlog = $('#backlog').val()
      let status = $('#status').val()

      if ((companyId == '') || (branchId == '')) {
        errorAlert('Company and branch is required!')
        return
      }

      completeFilter(companyId, branchId, backlog, status)
    })

    function completeFilter(companyId, branchId, backlog, status) {
      $.ajax({
        url: FILTER_URL,
        method: "GET",
        data: {
          companyId: companyId,
          branchId: branchId,
          qbacklog: backlog,
          status: status,
          complete_filter: 1
        },
        success: function(r) {
          $('#complete_filter').html(r);
        },
        complete: function() {
          $('#loading-spinner').hide();
        }
      });
    }
    let cId = $('#companyId').val();
    let bId = $('#branchId').val();
    let backlog = $('#backlog').val();
    let status = $('#status').val();

    completeFilter(cId, bId, backlog, status);
    $(document).on('click', '.waybill', function(e) {
      e.preventDefault();
      let BASE_URL = $("#BASE_URL").val();
      let waybill_no = $(this).data('id');
      let c_url = BASE_URL + "invoice/waybill.php?invoice_no=" + waybill_no;
      // errorOption('Warning', "Are you sure you want to print waybill ?", c_url)
      window.location.href = c_url
    })

    $(document).on('click', '.process_waybill', function(e) {
      e.preventDefault();
      let id = $(this).data('id');
      $("#modal_confirm").modal("show");
      $("#invoice_num").val(id);
    });

    $(document).on('click', '#yes_process', function(e) {
      let invoice_num = $("#invoice_num").val();
      let BASE_URL = $("#BASE_URL").val();
      $.ajax({
        url: "inc/index.php",
        method: "POST",
        data: {
          process_waybill: 1,
          invoice_num: invoice_num
        },
        dataType: 'json',
        success: function(data) {
          if (data.success == true) {
            successAlert(data.msg);
            window.location.href = BASE_URL + "invoice/waybill.php?invoice_no=" + invoice_num;
          }
        }
      });
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
            url: "inc/index.php",
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
  })
</script>