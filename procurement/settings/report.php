<?php require_once('../private/initialize.php');
require_login();

$page = 'Settings';
$page_title = 'Report';
include(SHARED_PATH . '/admin_header.php');

$access = AccessControl::find_by_undeleted(['order' => 'ASC']);
$admins = Admin::find_by_undeleted();

$branches = Branch::find_all_branch();
$requests =  in_array($loggedInAdmin->admin_level, [1, 2, 3])
  ? Request::find_all_requests()
  : Request::find_all_requests(['branch_id' => $loggedInAdmin->branch_id]);

?>

<style>
  th,
  td {
    font-size: 0.9rem !important;
  }
</style>

<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
          <div>
            <h4 class="mb-3">Report</h4>
            <p class="mb-0">An account given of a particular matter, especially in the form of an official document, <br>
              after thorough investigation or consideration by an appointed person.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-12">

        <div class="container-fluid shadow">
          <div class="row mt-3 mb-5">
            <div class="col-md-4 p-4">
              <div class="card my-auto">
                <div class="card-body">
                  <h5 class="card-title">Delivered Items</h5>
                  <div class="d-flex justify-content-end align-items-center">
                    <div class="">
                      <h6 class="mb-2">TOTAL</h6>
                      <a href="#" class="btn btn-lg btn-primary"><sub><?php echo $currency; ?></sub><span id="del" style="font-size: 1.3rem;">0</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 p-4">
              <div class="card my-auto">
                <div class="card-body">
                  <h5 class="card-title">Pending Items</h5>
                  <div class="d-flex justify-content-end align-items-center">
                    <div class="">
                      <h6 class="mb-2">TOTAL</h6>
                      <a href="#" class="btn btn-lg btn-secondary"><sub><?php echo $currency; ?></sub><span id="pen" style="font-size: 1.3rem;">0</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <?php if (in_array($loggedInAdmin->admin_level, [1, 2, 3])) : ?>
              <div class="col-md-4 p-4">
                <div class="card my-auto">
                  <div class="card-body">
                    <h5 class="card-title">Filter by</h5>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <h6 class="card-subtitle mb-2 text-muted ">Branch</h6>
                          <select class="form-control" name="req[branch_id]" id="branch">
                            <option value="">-select a branch-</option>
                            <?php foreach ($branches as $value) : ?>
                              <option value="<?php echo $value->id ?>"><?php echo $value->name ?> </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <h6 class="card-subtitle mb-2 text-muted ">Date Range</h6>
                          <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                            <input type="hidden" id="selected_date" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
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
              <tbody class="ligth-body" id="tableBranch">
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
                    <td><?php echo date('M d, Y', strtotime($data->due_date)) ?> </td>
                    <td><?php echo date('M d, Y', strtotime($data->created_at)) ?></td>
                    <td>
                      <div class="d-flex align-items-center list-action">
                        <button class="btn btn-sm badge badge-info view-btn mr-2 position-relative" data-invoice="<?php echo $data->invoice_no; ?>" data-toggle="modal" data-target="#view-request">
                          <i class="ri-eye-line mr-0"></i>
                          <span class="d-flex justify-content-center rounded-circle align-items-center bg-danger text-white p-2" style="width:10px;height:10px;position:absolute;top:-6px;right:-5px"><?php echo $data->counts; ?></span>
                        </button>
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

<input type="hidden" id="aId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const REQ_URL = '../requests/inc/request.php'

    $(document).on("click", '.view-btn', function() {
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

    function filterRequestByBranchAndDate(params) {
      $.ajax({
        url: REQ_URL,
        method: "GET",
        data: {
          request_by_branch: true,
          report: true,
          branch_id: params.s_branch,
          selected_date: params.s_date
        },
        success: function(data) {
          $('#tableBranch').html(data)
          $('#pen').text($('#pending').text());
          $('#del').text($('#deliver').text());
        }
      });
    }

    $(document).on('change', '#branch', function() {
      const selectedBranchId = $("#branch option:selected").val();
      const selectedDate = $('#selected_date').val()
      const data = {
        s_branch: selectedBranchId,
        s_date: selectedDate
      }

      filterRequestByBranchAndDate(data)
    });

    var start = moment();
    var end = moment();

    function cb(start, end) {
      $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
      const selectedDate = start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD')
      $('#selected_date').val(selectedDate)
      const selectedBranchId = $("#branch option:selected").val();
      const data = {
        s_branch: selectedBranchId,
        s_date: selectedDate
      }

      filterRequestByBranchAndDate(data)
    }

    $('#reportrange').daterangepicker({
      startDate: start,
      endDate: end,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);

    cb(start, end);

  })
</script>