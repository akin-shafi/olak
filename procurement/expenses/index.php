<?php require_once('../private/initialize.php');

$page = 'Expenses';
$page_title = 'List Expenses';
include(SHARED_PATH . '/admin_header.php');
$url_status = $_GET['status'] ?? '';
$branches = Branch::find_all_branch();
$expenses =  Expenses::find_by_undeleted();


// $isExpenses = $loggedInAdmin->admin_level == 4 ? true : false;



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

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
          <div>
            <h4 class="mb-3">Expenses List</h4>
           
          </div>
         
          <a href="<?php echo url_for('expenses/add-expenses.php'); ?>" class="btn btn-primary add-list"><i class="fa la-plus mr-3"></i>Add Expenses</a>
         
        </div>
      </div>

      <div class="col-lg-12">
        <div class="table-responsive rounded mb-3">
          


          <table class="data-table table mb-0 tbl-server-info">
            <thead class="bg-white">
              <tr class="ligth ligth-data">
                <th>SN</th>
                <th>Date</th>
                <th>Expense Type</th>
                <th>Amount</th>
                <th>Paid Through</th>
                <th>Vendor</th>
                <th>Reference</th>
                <th>Note</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach (Expenses::find_by_undeleted() as $value) : $sn = 1?>
              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $value->date; ?></td>
                <td><?php echo $value->expense_type; ?></td>
                <td><?php echo $value->amount; ?></td>
                <td><?php echo ExpensesType::find_by_id($value->paid_through)->expense_account?></td>
                <td><?php echo $value->vendor; ?></td>
                <td><?php echo $value->reference; ?></td>
                <td>
                  <div class="text-truncated"><?php echo $value->note; ?></div>
                </td>
                <td>
                  <a href="<?php echo url_for('expenses/edit-expenses.php?id='. $value->id) ?>" class="btn btn-primary">Edit</a>
                  <a href="<?php echo url_for('expenses/delete.php?id='. $value->id) ?>" class="btn btn-danger">Delete</a>
                </td>
              </tr>
            <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edit-Expenses" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="popup text-left">
            <div class="media align-items-top justify-content-between">
              <h3 class="mb-3">Expenses</h3>
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


  <div class="modal fade" id="view-Expenses" tabindex="-1" role="dialog" aria-hidden="true">
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
                      <th scope="col">Expenses ID</th>
                      <th scope="col">Item name</th>
                      <th class="text-center" scope="col">Quantity</th>
                      <th class="text-center" scope="col">Unit Price (<?php echo $currency ?>)</th>
                      <th class="text-center" scope="col">Amount (<?php echo $currency ?>)</th>
                    </tr>
                  </thead>
                  <tbody id="get_Expenses"></tbody>
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
    const REQ_URL = './inc/Expenses.php'

    $('.view-btn').on("click", function() {
      let iNo = this.dataset.invoice

      $.ajax({
        url: REQ_URL,
        method: "GET",
        data: {
          iNo: iNo,
          get_Expenses: 1,
          view: 1
        },
        success: function(r) {
          $('#get_Expenses').html(r)
        }
      })
    });


    $(document).on('click', '.delete_Expenses', function() {
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
              delete_Expenses: 1
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
      let Expenses_status = this.dataset.status;

      updateStatus(invoiceId, Expenses_status)
    })

    const updateStatus = async (id, status) => {
      const data = await fetch(REQ_URL + '?invoiceId=' + id + '&Expenses_status=' + status);
      const res = await data.json();
      successAlert(res.message)

      setTimeout(() => {
        window.location.reload();
      }, 1000);
    }
  })
</script>