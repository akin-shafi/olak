<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Settings';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="side-app">

  <div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
      <h4 class="page-title">Settings</h4>
    </div>
    <div class="page-rightheader ms-md-auto">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
        <div class="btn-list">
          <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button>
          <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button>
          <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-xl-6 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header  border-0">
              <h4 class="card-title">Company</h4>
              <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                  <div class="btn-list">
                    <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#company_modal">
                      Add Company</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                    <div class="col-sm-12">
                      <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="dept-table" role="grid" aria-describedby="hr-table_info">
                        <thead>
                          <tr role="row">
                            <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column ascending" style="width: 678.872px;">Company Name</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Company Label: activate to sort column ascending" style="width: 678.872px;">Company Label</th>
                            <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $sn = 1;
                          foreach (Company::find_by_undeleted() as $company) : ?>
                            <tr>
                              <td><?php echo $sn++ ?></td>
                              <td>
                                <a href="#" class="d-flex align-items-center">
                                  <span class="avatar avatar-md brround me-3" style="background-image: url( <?php echo url_for('assets/uploads/company/' . $company->logo) ?>)"></span>

                                  <h6 class="mb-0 fs-14"><?php echo ucwords($company->company_name) ?></h6>
                                </a>
                              </td>

                              <td>
                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $company->id ?>" id="edit-dept-btn">
                                  <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                </a>
                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $company->id ?>" id="delete_dept">
                                  <i class="feather feather-trash-2"></i>
                                </a>
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
        </div>

        <div class="col-xl-6 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header  border-0">
              <h4 class="card-title">Branch</h4>
              <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                  <div class="btn-list">
                    <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#branch_modal">
                      Add Branch</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                    <div class="col-sm-12">
                      <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="des-table" role="grid" aria-describedby="hr-table_info">
                        <thead>
                          <tr role="row">
                            <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Branch Name: activate to sort column ascending" style="width: 678.872px;">Branch Name</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Branch Label: activate to sort column ascending" style="width: 678.872px;">Branch Label</th>
                            <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $sn = 1;
                          foreach (Branch::find_by_undeleted() as $branch) : ?>
                            <tr>
                              <td><?php echo $sn++ ?></td>
                              <td><?php echo ucwords($branch->branch_name) ?></td>

                              <td>
                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $branch->id ?>" id="edit_des">
                                  <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                </a>
                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $branch->id ?>" id="delete_des">
                                  <i class="feather feather-trash-2"></i>
                                </a>
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
        </div>

        <div class="col-xl-6 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header  border-0">
              <h4 class="card-title">Employee Type</h4>
              <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                  <div class="btn-list">
                    <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#employee_type_modal">
                      Add Employee Type</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                    <div class="col-sm-12">
                      <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="des-table" role="grid" aria-describedby="hr-table_info">
                        <thead>
                          <tr role="row">
                            <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 678.872px;">Name</th>
                            <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $sn = 1;
                          foreach (EmployeeType::find_by_undeleted() as $eType) : ?>
                            <tr>
                              <td><?php echo $sn++ ?></td>
                              <td><?php echo ucwords($eType->name) ?></td>

                              <td>
                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $eType->id ?>" id="edit_eType">
                                  <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                </a>
                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $eType->id ?>" id="delete_eType">
                                  <i class="feather feather-trash-2"></i>
                                </a>
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
        </div>

        <div class="col-xl-6 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header  border-0">
              <h4 class="card-title">Leave Type</h4>
              <div class="page-rightheader ms-md-auto">
                <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
                  <div class="btn-list">
                    <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#leave_type_modal">
                      Add Leave Type</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                    <div class="col-sm-12">
                      <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="leave-table" role="grid" aria-describedby="hr-table_info">
                        <thead>
                          <tr role="row">
                            <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 678.872px;">Leave Type</th>
                            <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $sn = 1;
                          foreach (EmployeeLeaveType::find_by_undeleted() as $leave) : ?>
                            <tr>
                              <td><?php echo $sn++ ?></td>
                              <td><?php echo ucwords($leave->name) ?></td>

                              <td>
                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $leave->id ?>" id="edit_leave">
                                  <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                </a>
                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $leave->id ?>" id="delete_leave">
                                  <i class="feather feather-trash-2"></i>
                                </a>
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
        </div>

      </div>
    </div>
  </div>
</div>

<?php include('../inc/modal/all.php'); ?>
<?php include(SHARED_PATH . '/footer.php'); ?>
<script src="../../assets/plugins/circle-progress/circle-progress.min.js"></script>

<script>
  $(document).ready(function() {
    const message = (req, res) => {
      swal(req + "!", res, {
        icon: req,
        timer: 2000,
        buttons: {
          confirm: {
            className: req == "error" ? "btn btn-danger" : "btn btn-success",
          },
        },
      }).then(() => location.reload());
    };

    const deleted = async (url) => {
      swal({
        title: "Are you sure?",
        text: "You won't be able to reverse this!",
        icon: "warning",
        buttons: {
          confirm: {
            text: "Yes, delete it!",
            className: "btn btn-danger",
          },
          cancel: {
            visible: true,
            className: "btn btn-secondary",
          },
        },
      }).then((Delete) => {
        if (Delete) {
          fetch(url)
            .then((res) => res.json())
            .then((data) => {
              swal({
                title: "Deleted!",
                text: data.message,
                icon: "success",
                buttons: {
                  confirm: {
                    className: "btn btn-success",
                  },
                },
              }).then(() => location.reload());
            });
        } else {
          swal.close();
        }
      });
    };

    const submitForm = async (url, payload) => {
      const formData = new FormData(payload);

      const data = await fetch(url, {
        method: "POST",
        body: formData,
      });

      const res = await data.json();

      if (res.errors) {
        message("error", res.errors);
      }

      if (res.message) {
        message("success", res.message);
      }
    };

    const SETTING_URL = "../inc/setting/";

    const companyForm = document.getElementById("add_company_form");
    const branchForm = document.getElementById("add_branch_form");
    const eTypeForm = document.getElementById("add_eType_form");
    const leaveForm = document.getElementById("add_leave_form");

    companyForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, companyForm);
    });

    branchForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, branchForm);
    });

    eTypeForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, eTypeForm);
    });

    leaveForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, leaveForm);
    });
  })
</script>