<?php
require_once('../private/initialize.php');

$page = 'Organisation';
$page_title = 'Branches';
include(SHARED_PATH . '/admin_header.php');
?>

<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Branches</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Branches</li>
               </ul>
            </div>
            <div class="col-auto float-end ms-auto">
               <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#branch_modal"><i class="fa fa-plus"></i> Add branch</a>
               <div class="view-icons">
                  <!-- <a href="<?php //echo url_for('Branches/') 
                                 ?>" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a> -->
                  <a href="<?php echo url_for('organisation/branch.php') ?>" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
               </div>
            </div>
         </div>
      </div>

      <style>
         td {
            vertical-align: middle;
         }
      </style>

      <div class="row">
         <div class="col-md-12">
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0" id="branch-table">
                  <thead>
                     <tr>
                        <th>SN</th>
                        <th>Company Name</th>
                        <th>Branch</th>
                        <th>State</th>
                        <th>City</th>
                        <th class="text-nowrap">Established In</th>
                        <th>Created At</th>
                        <th class="text-end no-sort">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $sn = 1;
                     foreach (Branch::find_by_undeleted() as $branch) :
                        $companyName = Company::find_by_id($branch->company_id)->company_name; ?>
                        <tr>
                           <td><?php echo $sn++ ?></td>
                           <td>
                              <h2 class="table-avatar">
                                 <a href="profile.php" class="avatar"><img alt="" src="assets/img/profiles/<?php echo $branch->logo ?>"></a>
                                 <a href="profile.php"><?php echo ucwords($companyName) ?> </a>
                              </h2>
                           </td>
                           <td><?php echo $branch->branch_name != '' ? ucwords($branch->branch_name) : 'NOT SET' ?></td>
                           <td><?php echo $branch->state ?></td>
                           <td><?php echo $branch->city ?></td>
                           <td><?php echo date('M jS, Y', strtotime($branch->established_in)) ?></td>
                           <td><?php echo date('Y-m-d', strtotime($branch->created_at)) ?></td>

                           <td class="text-end">
                              <div class="dropdown dropdown-action">
                                 <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-id="<?php echo $branch->id ?>" id="edit-branch-btn"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-id="<?php echo $branch->id ?>" id="delete-branch-btn"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                 </div>
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

   <div id="branch_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="branch-title">Add branch</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div id="showAlert"></div>

               <form id="add_branch_form">
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">Company <span class="text-danger">*</span></label>
                           <select class="form-control" name="company_id" id="company_id">
                              <option value="">Select Company</option>
                              <?php foreach (Company::find_by_undeleted() as $key => $value) { ?>
                                 <option value="<?php echo $value->id ?>"><?php echo $value->company_name ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">Branch name <span class="text-danger">*</span></label>
                           <input class="form-control" name="branch_name" id="branch_name" type="text">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">Address</label>
                           <input class="form-control" name="address" id="address" type="text">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">City</label>
                           <input class="form-control" name="city" id="city" type="text">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">State</label>
                           <input class="form-control" name="state" id="state" type="text">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">Date Established </label>
                           <input class="form-control" name="established_in" id="established_in" type="date">
                        </div>
                     </div>

                  </div>

                  <div class="submit-section">
                     <button class="btn btn-primary submit-btn" id="add_branch_btn">Submit</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php');  ?>

<script type="text/javascript">
   $(document).ready(function() {

      const BRANCH_URL = "inc/branch_script.php";
      const branchModal = new bootstrap.Modal(document.getElementById("branch_modal"));
      const branchTitle = document.getElementById('branch-title');
      const submitBranchBtn = document.getElementById("add_branch_btn");
      const branchForm = document.getElementById("add_branch_form");

      const showAlert = document.getElementById('showAlert');

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

      $(document).on('submit', '#add_branch_form', function(e) {
         e.preventDefault();

         $.ajax({
            url: BRANCH_URL,
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
               $('#branch_modal').modal('hide');
               message('success', response.message)
            },
            error: function(xhr, status, error) {
               let isError = eval("(" + xhr.responseText + ")");
               let msg = `${isError.errors}`;
               showAlert.innerHTML = msg;

               setTimeout(() => {
                  showAlert.innerHTML = '';
               }, 3000);
            }
         })
      });

      $('#branch-table tbody').on('click', '#edit-branch-btn', async function(e) {
         let id = this.dataset.id
         branchForm.id = 'edit_branch_form';
         const editBranchForm = document.getElementById("edit_branch_form");

         let data = await fetch(BRANCH_URL + "?branchId=" + id);
         let response = await data.json();

         document.getElementById('company_id').value = response.data.company_id;
         document.getElementById('branch_name').value = response.data.branch_name;
         document.getElementById('address').value = response.data.address;
         document.getElementById('city').value = response.data.city;
         document.getElementById('state').value = response.data.state;
         document.getElementById('established_in').value = response.data.established_in;

         branchTitle.innerText = 'Edit Branch';
         submitBranchBtn.innerText = "Update";
         submitBranchBtn.id = "edit_branch_btn";
         branchModal.show();

         submitBranchBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            const editFormData = new FormData(editBranchForm);
            editFormData.append("update", 1);
            editFormData.append('branchId', id);

            submitBranchBtn.innerText = "Please Wait...";

            let data = await fetch(BRANCH_URL, {
               method: "POST",
               body: editFormData,
            });
            let response = await data.json();

            if (response.errors) {
               message('error', response.errors)
            } else {
               message('success', response.message)
            }
         });

         $('#branch_modal').on('hidden.bs.modal', function() {
            location.reload()
         })
      });


      $('#branch-table tbody').on('click', '#delete-branch-btn', function() {
         let branchId = this.dataset.id;

         swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            buttons: {
               confirm: {
                  text: 'Yes, delete it!',
                  className: 'btn btn-danger'
               },
               cancel: {
                  visible: true,
                  className: 'btn btn-secondary'
               }
            }
         }).then(Delete => {
            if (Delete) {
               fetch(BRANCH_URL + '?branchId=' + branchId + '&deleted=1')
                  .then(response => response.json()).then(data => {
                     swal({
                        title: 'Deleted!',
                        text: data.message,
                        icon: 'success',
                        buttons: {
                           confirm: {
                              className: 'btn btn-success'
                           }
                        }
                     }).then(() => location.reload());
                  })
            } else {
               swal.close();
            }
         })
      });

   });
</script>