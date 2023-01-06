<?php require_once('../private/initialize.php');
require_login();

$page = 'Settings';
$page_title = 'Access Control';
include(SHARED_PATH . '/admin_header.php');

$access = AccessControl::find_by_undeleted(['order' => 'ASC']);
$admins = Admin::find_by_undeleted();

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
            <h4 class="mb-3">Access Control List (ACL)</h4>
            <p class="mb-0">An access control list (ACL) is a list of rules that specifies which users <br>
              are granted or denied access to a particular data or system resource.</p>
          </div>
          <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#userModel">
            &plus; Add Permission</button>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="table-responsive rounded mb-3">
          <table class="table data-table border-0">
            <thead>
              <tr class="ligth text-white text-center">
                <th>SN</th>
                <th>Users</th>
                <th>Role</th>
                <th>Dashboard</th>
                <th>Request</th>
                <th>Settings</th>
                <th>User Mgt</th>
                <th>Status Mgt</th>
                <th>Sales Mgt</th>
                <th>Expenses Mgt</th>
                <th>Report Mgt</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php $sn = 1;
              foreach ($access as $data) :
                $user = Admin::find_by_id($data->user_id);
                $adminLevel = Admin::ADMIN_LEVEL[$user->admin_level]; ?>

                <tr>
                  <td><?php echo $sn++; ?></td>
                  <td><?php echo ucwords($user->full_name); ?></td>
                  <td><?php echo ucwords($adminLevel); ?></td>
                  <td class="text-center">
                    <?php echo $data->dashboard == 1 ? '<span class="bg-success rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'
                      : '<span class="bg-secondary rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $data->request == 1 ? '<span class="bg-success rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'
                      : '<span class="bg-secondary rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $data->settings == 1 ? '<span class="bg-success rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'
                      : '<span class="bg-secondary rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $data->users_mgt == 1 ? '<span class="bg-success rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'
                      : '<span class="bg-secondary rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $data->change_status == 1 ? '<span class="bg-success rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'
                      : '<span class="bg-secondary rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $data->sales_mgt == 1 ? '<span class="bg-success rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'
                      : '<span class="bg-secondary rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $data->expenses_mgt == 1 ? '<span class="bg-success rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'
                      : '<span class="bg-secondary rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'; ?>
                  </td>
                  <td class="text-center">
                    <?php echo $data->report_mgt == 1 ? '<span class="bg-success rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'
                      : '<span class="bg-secondary rounded-circle p-2 d-block m-auto" style="width:5px;height:5px;"></span>'; ?>
                  </td>

                  <td>
                    <!-- <div class="btn-group"> -->
                    <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#userModel">
                      <i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger remove-btn d-none" data-id="<?php echo $data->id; ?>">
                      <i class="fa fa-trash"></i>
                    </button>
                    <!-- </div> -->
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

<div class="modal fade" id="userModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Access Control</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="access_form">
        <input type="hidden" name="access[created_by]" value="<?php echo $loggedInAdmin->id ?>" readonly>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="mb-3">
                    <label for="staff" class="col-form-label">All Staff</label>
                    <select class="form-control" name="access[user_id]" id="staff">
                      <option value="">select staff</option>
                      <?php foreach ($admins as $admin) :
                        $adminLevel = Admin::ADMIN_LEVEL[$admin->admin_level] ?>
                        <option value="<?php echo $admin->id ?>">
                          <?php echo ucwords($admin->full_name) . ' (' . $adminLevel . ')' ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input" name="access[dashboard]" id="dashMgt">
                  <label class="custom-control-label" for="dashMgt">Dashboard</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input" name="access[request]" id="reqMgt">
                  <label class="custom-control-label" for="reqMgt">Request</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input" name="access[settings]" id="setMgt">
                  <label class="custom-control-label" for="setMgt">Settings</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input" name="access[users_mgt]" id="userMgt">
                  <label class="custom-control-label" for="userMgt">User Mgt</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input" name="access[change_status]" id="proMgt">
                  <label class="custom-control-label" for="proMgt">Status Mgt</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input" name="access[sales_mgt]" id="salMgt">
                  <label class="custom-control-label" for="salMgt">Sales Mgt</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input" name="access[expenses_mgt]" id="expMgt">
                  <label class="custom-control-label" for="expMgt">Expenses Mgt</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="custom-control custom-switch mb-3">
                  <input type="checkbox" class="custom-control-input" name="access[report_mgt]" id="report">
                  <label class="custom-control-label" for="report">Report Mgt</label>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<input type="hidden" id="aId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const ACCESS_URL = 'inc/process.php';

    $('#access_form').on("submit", function(e) {
      e.preventDefault();
      let aId = $('#aId').val()

      let formData = new FormData(this);

      if (aId == "") {
        formData.append('new_access', 1)
      } else {
        formData.append('edit_access', 1)
        formData.append('aId', aId)
      }

      $.ajax({
        url: ACCESS_URL,
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
          $('.lds-hourglass').removeClass('d-none');
        },
        success: function(r) {
          if (r.success == true) {
            successAlert(r.msg);
            setTimeout(() => {
              $('.lds-hourglass').addClass('d-none');
              window.location.reload()
            }, 250);
          } else {
            errorAlert(r.msg);
          }
        }
      })
    });

    $('.edit-btn').on("click", function() {
      let aId = this.dataset.id
      $('#aId').val(aId)

      $('#staff').attr('disabled', true)

      $.ajax({
        url: ACCESS_URL,
        method: "GET",
        data: {
          aId: aId,
          get_access: 1
        },
        dataType: 'json',
        success: function(r) {
          let hasDashPermit = r.data.dashboard == '1' ? true : false
          let hasReqPermit = r.data.request == '1' ? true : false
          let hasSetPermit = r.data.settings == '1' ? true : false
          let hasUserPermit = r.data.users_mgt == '1' ? true : false
          let hasProductPermit = r.data.change_status == '1' ? true : false
          let hasSalesPermit = r.data.sales_mgt == '1' ? true : false
          let hasExpensesPermit = r.data.expenses_mgt == '1' ? true : false
          let hasReportPermit = r.data.report_mgt == '1' ? true : false

          $('#staff').val(r.data.user_id)
          $('#dashMgt').prop('checked', hasDashPermit);
          $('#reqMgt').prop('checked', hasReqPermit);
          $('#setMgt').prop('checked', hasSetPermit);
          $('#userMgt').prop('checked', hasUserPermit);
          $('#proMgt').prop('checked', hasProductPermit);
          $('#salMgt').prop('checked', hasSalesPermit);
          $('#expMgt').prop('checked', hasExpensesPermit);
          $('#report').prop('checked', hasReportPermit);
        }
      })
    });

    $(document).on('click', '.remove-btn', function() {
      let aId = this.dataset.id;
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
            url: ACCESS_URL,
            method: "POST",
            data: {
              aId: aId,
              delete_access: 1
            },
            dataType: 'json',
            success: function(data) {
              Swal.fire(
                'Deleted!',
                data.msg,
                'success'
              )
            }
          });

        }
      }).then(() => window.location.reload())

    });
  })
</script>