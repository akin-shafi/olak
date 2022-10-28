<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Configurations';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="side-app">

  <div class="page-header d-xl-flex d-block">
    <div class="page-leftheader">
      <h4 class="page-title">Configurations</h4>
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
              <h4 class="card-title">Loan Configuration</h4>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                  <div class="row">
                    <div class="col-sm-12">
                      <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="loan-table" role="grid" aria-describedby="hr-table_info">
                        <thead>
                          <tr role="row">
                            <th class="border-bottom-0 sorting" tabindex="0" aria-controls="hr-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 678.872px;">Status</th>
                            <th class="border-bottom-0 sorting_disabled" rowspan="1" colspan="1" aria-label="Actions" style="width: 291.771px;">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $sn = 1;
                          foreach (Configuration::find_all() as $config) : ?>
                            <tr>
                              <td>
                                <?php echo $config->loan_config == 1
                                  ? '<span class="badge badge-success">Activated</span>'
                                  : '<span class="badge badge-dark">Deactivated</span>' ?>
                              </td>

                              <td>
                                <div class="btn-group">
                                  <a class="btn btn-primary loan_action" data-id="<?php echo $config->id ?>" data-status="1" id="activate_loan">
                                    <i class="feather feather-eye" data-bs-toggle="tooltip" data-original-title="Activate" data-bs-original-title="Activate" title="Activate"></i>
                                  </a>
                                  <a class="btn btn-dark text-light loan_action" data-id="<?php echo $config->id ?>" data-status="2" id="deactivate_loan">
                                    <i class="feather feather-eye-off" data-bs-toggle="tooltip" data-original-title="Deactivate" data-bs-original-title="Deactivate" title="Deactivate"></i>
                                  </a>
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
        </div>

      </div>
    </div>
  </div>
</div>

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

    companyForm.addEventListener("submit", (e) => {
      e.preventDefault();
      submitForm(SETTING_URL, companyForm);
    });

    $("#loan-table tbody").on("click", ".loan_action", async function() {
      let id = this.dataset.id;
      let status = this.dataset.status;

      if (status == '1') {
        status = 'activate';
      } else {
        status = 'deactivate';
      }

      let data = await fetch(SETTING_URL + "?status_id=" + id + '&status=' + status);
      let response = await data.json();
      message('success', response.message);
    });
  })
</script>