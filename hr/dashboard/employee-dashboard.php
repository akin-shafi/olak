<?php
require_once('../private/initialize.php');

$page = 'Dashboard';
$page_title = 'Employee Dashboard';
include(SHARED_PATH . '/admin_header.php');
?>

<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="row align-items-center">
         <div class="col">
            <h3 class="page-title">All Loan Request</h3>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
               <li class="breadcrumb-item active">Loan</li>
            </ul>
         </div>
         <div class="col-auto float-end ms-auto">
            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#loan_request"><i class="fa fa-plus"></i> Add Loan Request</a>
            <div class="view-icons">
               <a href="/olak/hr/employees/" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
               <a href="/olak/hr/employees/employees-list.php" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
            </div>
         </div>
      </div>

      <div class="col-md-12">
         <div class="row my-3">
            <div class="col-6">
               <ol class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                     <div class="ms-2 me-auto">
                        <div class="fw-bold">Total loan Requested</div>
                     </div>
                     <span class="">900,0000.00</span>
                  </li>
               </ol>
            </div>

            <div class="col-6">
               <ol class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                     <div class="ms-2 me-auto">
                        <div class="fw-bold">Total loan Paid</div>
                     </div>
                     <span class="">700,0000.00</span>
                  </li>
               </ol>
            </div>
         </div>


         <div class="card card-table flex-fill">
            <div class="card-body ">
               <div class="table-responsive table-wrap p-2 ">
                  <table class="table table-nowrap custom-table mb-0 datatable" id="loan_status">
                     <thead>
                        <tr>
                           <th>Ref No.</th>
                           <th>Employee Name</th>
                           <th>Amount</th>
                           <th>Date requested</th>
                           <th>Status</th>
                           <th class="text-end">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach (EmployeeLoan::find_by_undeleted() as $loan) : ?>
                           <tr>
                              <td><a href="invoice-view.html">#<?php echo strtoupper($loan->ref_no) ?></a></td>
                              <td>
                                 <h2>
                                    <a href="#">
                                       <?php echo ucwords(Employee::find_by_id($loan->employee_id)->full_name()) ?>
                                    </a>
                                 </h2>
                              </td>
                              <td>
                                 <h2><a href="#"><?php echo number_format($loan->amount, 2) ?></a></h2>
                              </td>
                              <td><?php echo date('M jS, Y', strtotime($loan->date_requested)) ?></td>
                              <td>
                                 <?php if ($loan->status == 0) : ?>
                                    <span class="badge bg-inverse-warning">new</span>
                                 <?php elseif ($loan->status == 1) : ?>
                                    <span class="badge bg-inverse-success">paid</span>
                                 <?php elseif ($loan->status == 2) : ?>
                                    <span class="badge bg-inverse-danger">rejected</span>
                                 <?php endif; ?>
                              </td>
                              <td class="text-end">
                                 <div class="btn-group btn-group-sm">
                                    <div class="btn btn-sm btn-outline-success loan_action" data-id="<?php echo $loan->employee_id ?>" data-status="1">Approve</div>

                                    <div class="btn btn-sm btn-outline-danger loan_action" data-id="<?php echo $loan->employee_id ?>" data-status="2">Reject</div>
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

<?php include('../employees/inc/modal/all.php');  ?>
<?php include(SHARED_PATH . '/admin_footer.php');  ?>
<script>
   const EMPLOYEE_URL = "../employees/inc/employee_script.php";

   const loanForm = document.getElementById("add_loan_form");

   const message = (req, res) => {
      swal(req + "!", res, {
         icon: req,
         buttons: {
            confirm: {
               className: (req == 'error') ? 'btn btn-danger' : 'btn btn-success'
            }
         }
      }).then(() => location.reload())
   }

   const submitForm = async (url, payload) => {
      const formData = new FormData(payload);
      formData.append("update", 1);

      const data = await fetch(url, {
         method: "POST",
         body: formData,
      });

      const response = await data.json();

      if (response.errors) {
         message('error', response.errors)
      }

      if (response.message) {
         message('success', response.message)
      }
   };

   loanForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(EMPLOYEE_URL, loanForm);
   });

   const updateStatus = async (url) => {
      const data = await fetch(url);
      const response = await data.json();

      if (response.errors) {
         message('error', response.errors)
      }

      if (response.message) {
         message('success', response.message)
      }
   };

   $('#loan_status').on('click', '.loan_action', function() {
      let emId = this.dataset.id;
      let statusVal = this.dataset.status;
      updateStatus(EMPLOYEE_URL + '?emId=' + emId + '&status=' + statusVal);
   });
</script>