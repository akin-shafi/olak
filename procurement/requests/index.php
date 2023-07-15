<?php require_once('../private/initialize.php');

$page = 'Request';
$page_title = 'List Requests';
include(SHARED_PATH . '/admin_header.php');
$url_status = $_GET['status'] ?? '';
$branches = Branch::find_all_branch();
$requests =  in_array($loggedInAdmin->admin_level, [1, 2, 3])
  ? Request::find_by_status(['status' => $url_status, 'branch_id' => $loggedInAdmin->branch_id])
  : Request::find_by_status(['status' => $url_status]);


$isRequester = $loggedInAdmin->admin_level == 4 ? true : false;



?>

<style>
  th,
  td {
    font-size: 0.9rem !important;
  }

  #analytic .col > .card:hover{
      background-color: #32BDEA;
      border: 1px solid gray;
  }

  #analytic .col > .card:hover h5{
      color: #FFF !important;
  }
  .col > .active{
      background-color: #32BDEA !important;
  }
  .col > .active h5{
    color: #FFF !important;
  }
</style>

<div class="content-page">

<div class="container">
  <div class="row" id="analytic">
    <?php foreach (Request::STATUS as $key => $value) { 
      
      ?>
    <div class="col">
      <a class="card <?php echo $url_status == $key ? 'active' : '' ?>"  href="<?php echo url_for('requests/index.php?status='. $key) ?>">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="text-start">
              <h5 class="card-title"><?= $value ?></h5>
            </div>
            <div class="text-end">
              <h5 class="card-title"><?php echo count(Request::find_by_status(['status' => $key])) ?></h5>
            </div>
          </div>
        </div>
      </a>
    </div>
    <?php } ?>
    
  </div>
</div>



  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
          <div>
            <h4 class="mb-3">Request List</h4>
            <!-- <p class="mb-0">The request list effectively dictates request presentation and provides
              space<br> to list your requests and offering in the most appealing way.</p> -->
          </div>
          <?php  if($isRequester): ?>
          <a href="<?php echo url_for('requests/add-request.php'); ?>" class="btn btn-primary add-list"><i class="fa la-plus mr-3"></i>Add Request</a>
          <?php endif ?>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="table-responsive rounded mb-3">
          <table class="data-table table mb-0 tbl-server-info">
            <thead class="bg-white">
              <tr class="ligth ligth-data">
                <th scope="col">Invoice No</th>
                <th scope="col">Processed By</th>
                <th scope="col">Branch</th>
                <th scope="col">Total Qty</th>
                <th scope="col">Grand Total (<?php echo $currency ?>)</th>
                <th scope="col">Status</th>
                <th scope="col">Due Date</th>
                <th scope="col">Request Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="ligth-body" id="tBranch">
              <?php foreach ($requests as $data) :
                $branch = Branch::find_by_id($data->branch_id)->name; ?>
                <tr>
                  <td>
                    <a href="<?php echo url_for('invoice.php?invoice_no=' . $data->invoice_no) ?>">
                      <?php echo $data->invoice_no ?>
                    </a>
                  </td>
                  <td><?php echo $data->full_name ?></td>
                  <td><?php echo $branch; ?></td>
                  <td class="text-center">
                    <?php echo $data->quantity != '' ? number_format($data->quantity) : 'Not Set' ?>
                  </td>
                  <td><?php echo number_format(intval($data->grand_total)) ?></td>
                  <td class="text-center">
                    <?php foreach (Request::STATUS as $key => $value) :
                      $color = RequestDetail::COLOR[$key];

                      if ($key == $data->status) :
                    ?>
                        <span class="badge badge-<?php echo $color; ?>">
                          <?php echo $value ?>
                        </span>
                    <?php endif;
                    endforeach; ?>
                  </td>
                  <td><?php echo date('M d, Y', strtotime($data->due_date)) ?></td>
                  <td><?php echo date('M d, Y', strtotime($data->created_at)) ?></td>
                  <td>
                    <div class="d-flex align-items-center list-action">
                      <button class="btn btn-sm badge badge-info view-btn mr-2 position-relative" data-invoice="<?php echo $data->invoice_no; ?>" data-toggle="modal" data-target="#view-request">
                        <i class="ri-eye-line mr-0"></i>
                        <span class="d-flex justify-content-center rounded-circle align-items-center bg-danger text-white p-2" style="width:10px;height:10px;position:absolute;top:-6px;right:-5px"><?php echo $data->counts; ?></span>
                      </button>

                      <a href="<?php echo url_for('requests/edit-request.php?invoice_no=' . $data->invoice_no) ?>" class="btn btn-sm badge bg-success mr-2"><i class="ri-pencil-line mr-0"></i></a>

                      <?php if ($access->change_status ?? 0) : ?>
                        <div class="dropdown">
                          <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v mr-0"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php foreach (Request::STATUS as $key => $value) :
                              if ($value == 'New') continue;
                            ?>
                              <button class="dropdown-item status" data-id="<?php echo $data->id; ?>" data-status="<?php echo $key; ?>">
                                <?php echo $value; ?>
                              </button>
                            <?php endforeach; ?>

                            <button class="dropdown-item text-center text-white delete_request d-none" data-id="<?php echo $data->id; ?>" style="background-color: red;"><i class="ri-delete-bin-line mr-0"></i>Delete</button>
                          </div>
                        </div>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edit-request" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="popup text-left">
            <div class="media align-items-top justify-content-between">
              <h3 class="mb-3">Request</h3>
              <div class="btn-cancel p-0" data-dismiss="modal"><i class="fa la-times"></i></div>
            </div>
            <div class="content edit-notes">
              <div class="card card-transparent card-block card-stretch event-note mb-0">
                <div class="card-body px-0 bukmark">
                  <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                    <div class="quill-tool">
                    </div>
                  </div>
                  <div id="quill-toolbar1">
                    <p>Virtual Digital Marketing Course every week on Monday, Wednesday and
                      Saturday.Virtual Digital Marketing Course every week on Monday</p>
                  </div>
                </div>
                <div class="card-footer border-0">
                  <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                    <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                    <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="view-request" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="popup text-left">
            <h4 class="mb-3">Order Items</h4>
            <div class="content create-workform bg-body">
              <div class="table-responsive">
                <table class="table table-hoverable">
                  <thead>
                    <tr>
                      <th scope="col">Request ID</th>
                      <th scope="col">Item name</th>
                      <th class="text-center" scope="col">Quantity</th>
                      <th class="text-center" scope="col">Unit Price (<?php echo $currency ?>)</th>
                      <th class="text-center" scope="col">Amount (<?php echo $currency ?>)</th>
                    </tr>
                  </thead>
                  <tbody id="get_request"></tbody>
                </table>
              </div>

              <div class="col-lg-12 mt-4">
                <div class="d-flex flex-wrap align-items-center justify-content-end">
                  <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
  $(document).ready(function() {
    const REQ_URL = './inc/request.php'

    $('.view-btn').on("click", function() {
      let iNo = this.dataset.invoice

      $.ajax({
        url: REQ_URL,
        method: "GET",
        data: {
          iNo: iNo,
          get_request: 1,
          view: 1
        },
        success: function(r) {
          $('#get_request').html(r)
        }
      })
    });


    $(document).on('click', '.delete_request', function() {
      let deleteRow = this.dataset.id;
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
            url: REQ_URL,
            method: "POST",
            data: {
              id: deleteRow,
              delete_request: 1
            },
            dataType: 'json',
            success: function(data) {
              Swal.fire(
                'Deleted!',
                data.message,
                'success'
              )
              setTimeout(() => window.location.reload(), 1000);
            }
          });

        }
      })

    });


    $('tbody').on('click', '.status', function() {
      let invoiceId = this.dataset.id;
      let request_status = this.dataset.status;

      updateStatus(invoiceId, request_status)
    })

    const updateStatus = async (id, status) => {
      const data = await fetch(REQ_URL + '?invoiceId=' + id + '&request_status=' + status);
      const res = await data.json();
      successAlert(res.message)

      setTimeout(() => {
        window.location.reload();
      }, 1000);
    }
  })
</script>