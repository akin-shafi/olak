<?php require_once('../private/initialize.php');

$page = 'Request';
$page_title = 'List Requests';
include(SHARED_PATH . '/admin_header.php');

$invoices = Request::find_all_invoices();
?>

<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
          <div>
            <h4 class="mb-3">Request List</h4>
            <p class="mb-0">The request list effectively dictates request presentation and provides
              space<br> to list your requests and offering in the most appealing way.</p>
          </div>
          <a href="<?php echo url_for('requests/add-request.php'); ?>" class="btn btn-primary add-list"><i class="fa la-plus mr-3"></i>Add Request</a>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="table-responsive rounded mb-3">
          <table class="data-table table mb-0 tbl-server-info">
            <thead class="bg-white text-uppercase">
              <tr class="ligth ligth-data">
                <th>
                  <div class="checkbox d-inline-block">
                    <input type="checkbox" class="checkbox-input" id="checkbox1">
                    <label for="checkbox1" class="mb-0"></label>
                  </div>
                </th>
                <th scope="col">Request ID</th>
                <th scope="col">Item name</th>
                <th class="text-center" scope="col">Quantity</th>
                <th class="text-center" scope="col">Status</th>
                <th scope="col">Due Date</th>
                <th scope="col">Request Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody class="ligth-body">
              <?php foreach ($invoices as $data) : ?>
                <tr>
                  <td>
                    <div class="checkbox d-inline-block">
                      <input type="checkbox" class="checkbox-input" id="checkbox2">
                      <label for="checkbox2" class="mb-0"></label>
                    </div>
                  </td>
                  <td><?php echo '00' . $data->id ?></td>
                  <td><?php echo $data->item_name != '' ? $data->item_name : 'Not set' ?></td>
                  <td class="text-center"><?php echo $data->quantity != '' ? $data->quantity : 'Not Set' ?></td>
                  <td class="text-center">
                    <?php switch ($data->status) {
                      case '2':
                        echo '<span class="badge badge-success">Unpaid</span>';
                        break;
                      case '3':
                        echo '<span class="badge badge-danger">Unpaid</span>';
                        break;
                      default:
                        echo '<span class="badge badge-primary">New</span>';
                        break;
                    } ?>
                  </td>
                  <td><?php echo date('M d, Y', strtotime($data->due_date)) ?></td>
                  <td><?php echo date('M d, Y', strtotime($data->created_at)) ?></td>
                  <td>
                    <div class="d-flex align-items-center list-action">
                      <button class="btn btn-sm badge badge-info view-btn mr-2 position-relative" data-original-title="View" data-invoice="<?php echo $data->invoice_no; ?>" data-toggle="modal" data-target="#view-request"><i class="ri-eye-line mr-0"></i>
                        <span class="d-flex justify-content-center rounded-circle align-items-center bg-danger text-white p-2" style="width:10px;height:10px;position:absolute;top:-6px;right:-5px"><?php echo $data->counts; ?></span>
                      </button>
                      <a href="<?php echo url_for('requests/edit-request.php?invoice_no=' . $data->invoice_no) ?>" class="btn btn-sm badge bg-success mr-2" data-original-title="Edit" data-toggle="tooltip"><i class="ri-pencil-line mr-0"></i></a>
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
            <h4 class="mb-3">New Order</h4>
            <div class="content create-workform bg-body">
              <div class="table-responsive">
                <table class="table table-hoverable">
                  <thead>
                    <tr>
                      <th scope="col">Request ID</th>
                      <th scope="col">Item name</th>
                      <th class="text-center" scope="col">Quantity</th>
                      <th class="text-center" scope="col">Status</th>
                      <th scope="col">Due Date</th>
                      <th scope="col">Request Date</th>
                      <th>Action</th>
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
  })
</script>