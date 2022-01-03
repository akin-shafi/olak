<?php
require_once('../private/initialize.php');

$page = 'Organisation';
$page_title = 'All Companies';
include(SHARED_PATH . '/admin_header.php');
?>

<div class="page-wrapper">
   <div class="content container-fluid">
      <div class="page-header">
         <div class="row align-items-center">
            <div class="col">
               <h3 class="page-title">Companies</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Companies</li>
               </ul>
            </div>
            <div class="col-auto float-end ms-auto">
               <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#company_modal"><i class="fa fa-plus"></i> Add Company</a>
               <div class="view-icons">
                  <!-- <a href="<?php //echo url_for('companies/') 
                                 ?>" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a> -->
                  <a href="<?php echo url_for('organisation/company.php') ?>" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
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
               <table class="datatable table table-stripped mb-0" id="company-table">
                  <thead>
                     <tr>
                        <th>SN</th>
                        <th>Company Name</th>
                        <th>Registration No</th>
                        <th class="text-end no-sort">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $sn = 1;
                     foreach (Company::find_by_undeleted() as $company) {
                     ?>
                        <tr>
                           <td><?php echo $sn++ ?></td>
                           <td>
                              <h2 class="table-avatar">
                                 <a href="profile.php" class="avatar"><img alt="" src="assets/img/profiles/<?php echo $company->logo ?>"></a>
                                 <a href="profile.php"><?php echo ucwords($company->company_name) ?> </a>
                              </h2>
                           </td>
                           <td><?php echo $company->registration_no ?></td>
                           <td class="text-end">
                              <div class="dropdown dropdown-action">
                                 <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" data-id="<?php echo $company->id ?>" id="edit-company-btn"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-id="<?php echo $company->id ?>" id="delete-company-btn"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                 </div>
                              </div>
                           </td>
                        </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <div id="company_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="company-title">Add Company</h5>
               <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div id="showAlert"></div>

               <form id="add_company_form">
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">Company name <span class="text-danger">*</span></label>
                           <input class="form-control" name="company_name" id="company_name" type="text">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label class="col-form-label">Registration No.</label>
                           <input class="form-control" name="registration_no" id="registration_no" type="text">
                        </div>
                     </div>

                  </div>

                  <div class="submit-section">
                     <button class="btn btn-primary submit-btn" id="add_company_btn">Submit</button>
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
      const COMPANY_URL = "inc/company_script.php";

      const companyModal = new bootstrap.Modal(document.getElementById("company_modal"));
      const companyTitle = document.getElementById('company-title');
      const submitCompanyBtn = document.getElementById("add_company_btn");
      const companyForm = document.getElementById("add_company_form");

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

      $(document).on('submit', '#add_company_form', function(e) {
         e.preventDefault();

         $.ajax({
            url: COMPANY_URL,
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
               $('#company_modal').modal('hide');
               message('success', data.message)
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


      $('#company-table tbody').on('click', '#edit-company-btn', async function(e) {
         let id = this.dataset.id
         companyForm.id = 'edit_company_form';
         const editCompanyForm = document.getElementById("edit_company_form");

         let data = await fetch(COMPANY_URL + "?companyId=" + id);
         let response = await data.json();

         document.getElementById('company_name').value = response.data.company_name;
         document.getElementById('registration_no').value = response.data.registration_no;

         companyTitle.innerText = 'Edit Company';
         submitCompanyBtn.innerText = "Update";
         submitCompanyBtn.id = "edit_company_btn";
         companyModal.show();

         submitCompanyBtn.addEventListener("click", async (e) => {
            e.preventDefault();

            const editFormData = new FormData(editCompanyForm);
            editFormData.append("update", 1);
            editFormData.append('companyId', id);

            submitCompanyBtn.innerText = "Please Wait...";

            let data = await fetch(COMPANY_URL, {
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

         $('#company_modal').on('hidden.bs.modal', function() {
            location.reload()
         })
      });


      $('#company-table tbody').on('click', '#delete-company-btn', function() {
         let companyId = this.dataset.id;

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
               fetch(COMPANY_URL + '?companyId=' + companyId + '&deleted=1')
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


   })
</script>