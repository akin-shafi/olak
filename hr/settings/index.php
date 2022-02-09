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
        <div class="btn-list d-none">
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
                      <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="company-table" role="grid" aria-describedby="hr-table_info">
                        <thead>
                          <tr role="row">
                            <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column ascending" style="width: 678.872px;">Company Name</th>
                            <!-- <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Company Label: activate to sort column ascending" style="width: 678.872px;">Company Label</th> -->
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
                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $company->id ?>" id="edit_company">
                                  <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                </a>
                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $company->id ?>" id="delete_company">
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
                      <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="branch-table" role="grid" aria-describedby="hr-table_info">
                        <thead>
                          <tr role="row">
                            <th class="border-bottom-0 w-5 sorting_disabled" rowspan="1" colspan="1" aria-label="#ID" style="width: 24.3576px;">#ID</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column ascending" style="width: 678.872px;">Company Name</th>
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Branch Label: activate to sort column ascending" style="width: 678.872px;">Branch Name</th>
                            <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $sn = 1;
                          foreach (Branch::find_by_undeleted() as $branch) :
                            // pre_r($branch);
                            $company = Company::find_by_company_name($branch->company_name);
                          ?>
                            <tr>
                              <td><?php echo $sn++ ?></td>
                              <td><?php echo ucwords($company->company_name) ?></td>
                              <td><?php echo ucwords($branch->branch_name) ?></td>

                              <td>
                                <a class="btn btn-primary btn-icon btn-sm" data-id="<?php echo $branch->id ?>" id="edit_branch">
                                  <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="Edit" data-bs-original-title="" title=""></i>
                                </a>
                                <a class="btn btn-danger btn-icon btn-sm" data-id="<?php echo $branch->id ?>" id="delete_branch">
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
                      <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="eType-table" role="grid" aria-describedby="hr-table_info">
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

      </div>
    </div>
  </div>
</div>

<?php //include('../inc/modal/all.php'); 
?>
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

    const employeeTypeModal = new bootstrap.Modal(
      document.querySelector("#employee_type_modal")
    );
    const companyModal = new bootstrap.Modal(
      document.querySelector("#company_modal")
    );
    const branchModal = new bootstrap.Modal(
      document.querySelector("#branch_modal")
    );


    const SETTING_URL = "../inc/setting/";

    const companyForm = document.getElementById("add_company_form");
    const companyBtn = document.querySelector("#add_company_btn");
    const branchForm = document.getElementById("add_branch_form");
    const branchBtn = document.getElementById("add_branch_btn");
    const eTypeForm = document.getElementById("add_eType_form");
    const eTypeTitle = document.querySelector("#eType-title");
    const eTypeBtn = document.querySelector("#add_e_type_btn");

    companyForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, companyForm);
    });

    $("#company-table tbody").on("click", "#edit_company", async function() {
      let id = this.dataset.id;

      let data = await fetch(SETTING_URL + "?companyId=" + id);
      let response = await data.json();

      document.getElementById("companyId").value = id;
      document.getElementById("comp_name").value = response.data.company_name;
      document.getElementById("comp_reg").value = response.data.registration_no;

      companyModal.show();

      companyBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        submitForm(SETTING_URL, companyForm);
      });

      $("#company_modal").on("hidden.bs.modal", function() {
        location.reload();
      });
    });

    $(document).on("click", "#delete_company", function() {
      let delId = this.dataset.id;
      deleted(SETTING_URL + "?companyId=" + delId + "&companyDelete=1");
    });

    branchForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, branchForm);
    });

    $("#branch-table tbody").on("click", "#edit_branch", async function() {
      let id = this.dataset.id;

      let data = await fetch(SETTING_URL + "?branchId=" + id);
      let response = await data.json();

      document.getElementById("branchId").value = id;
      document.getElementById("company_id").value = response.data.company_id;
      document.getElementById("branch_name").value = response.data.branch_name;
      document.getElementById("branch_address").value = response.data.address;
      document.getElementById("branch_state").value = response.data.state;
      document.getElementById("branch_city").value = response.data.city;
      document.getElementById("established_id").value = response.data.established_id;

      branchModal.show();

      branchBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        submitForm(SETTING_URL, branchForm);
      });

      $("#branch_modal").on("hidden.bs.modal", function() {
        location.reload();
      });
    });

    $(document).on("click", "#delete_branch", function() {
      let delId = this.dataset.id;
      deleted(SETTING_URL + "?branchId=" + delId + "&branchDelete=1");
    });

    eTypeForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, eTypeForm);
    });

    $("#eType-table tbody").on("click", "#edit_eType", async function() {
      let id = this.dataset.id;

      let data = await fetch(SETTING_URL + "?eTypeId=" + id);
      let response = await data.json();

      document.getElementById("eTypeId").value = id;
      document.getElementById("e_name").value = response.data.name;

      eTypeTitle.innerText = "Edit Employee Type";
      eTypeBtn.innerText = "Update";

      employeeTypeModal.show();

      eTypeBtn.addEventListener("click", async (e) => {
        e.preventDefault();
        submitForm(SETTING_URL, eTypeForm);
      });

      $("#employee_type_modal").on("hidden.bs.modal", function() {
        location.reload();
      });
    });

    $(document).on("click", "#delete_eType", function() {
      let delId = this.dataset.id;
      deleted(SETTING_URL + "?eTypeId=" + delId + "&deleteType=1");
    });

  })
</script>