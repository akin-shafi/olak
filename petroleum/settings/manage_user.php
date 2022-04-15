<?php require_once('../private/initialize.php');
require_login();

if ($loggedInAdmin->admin_level != 1) {
  redirect_to('../sales/');
}

$page = 'Settings';
$page_title = 'Manage Users';
include(SHARED_PATH . '/admin_header.php');

$ownerId = $loggedInAdmin->full_name;

$company = Company::find_by_id($loggedInAdmin->company_id);
$branches = Branch::find_all_branch(['company_id' => $company->id]);

$admins = Admin::find_by_undeleted();
// $admins = Admin::find_all_employee();

?>
<style>
  th {
    font-size: 10px;
    vertical-align: middle;
  }

  td {
    min-width: 100px;
  }
</style>

<div class="content-wrapper">
  <div class="d-flex justify-content-end">
    <?php if ($loggedInAdmin->admin_level == 1) : ?>
      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#userModel">
        &plus; Create User</button>
    <?php endif; ?>
  </div>

  <div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

      <div class="card">
        <div class="card-body">
          <div class="table-container">
            <h3>Users</h3>
            <div class="table-responsive">
              <table class="table custom-table table-sm">
                <thead>
                  <tr class="bg-primary text-white ">
                    <th>profile_img</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Admin level</th>
                    <th>Branch</th>
                    <th>Password reset</th>
                    <th>created_by</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <?php if ($loggedInAdmin->admin_level == 1) : ?>
                      <th>Action</th>
                    <?php endif; ?>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($admins as $data) :
                    if ($data->admin_level == 1) continue;

                    $adminLevel = $data->admin_level != '' ? Admin::ADMIN_LEVEL[$data->admin_level] : 'Not set';
                    $createdBy = $data->created_by != '' ? Admin::find_by_id($data->created_by)->full_name : 'Not set';
                    if ($data->branch_id != '') :
                      $branch = Branch::find_by_id($data->branch_id)->name;
                    endif;
                  ?>
                    <tr>
                      <td>
                        <img class="img-thumbnail" src="<?php echo url_for('settings/uploads/profile/' . $data->profile_img); ?>" width="100" alt="<?php echo ucwords($data->full_name); ?>">
                      </td>
                      <td><?php echo strtoupper($data->full_name); ?></td>
                      <td><?php echo $data->email; ?></td>
                      <td><?php echo $adminLevel; ?></td>
                      <td><?php echo isset($branch) ? ucwords($branch) : 'Not set'; ?></td>
                      <td><?php echo $data->reset_password != 0 ? '<span class="badge badge-success">Activated</span>' : '<span class="badge badge-warning">Pending</span>'; ?></td>
                      <td><?php echo ucwords($createdBy); ?></td>
                      <td><?php echo date('Y-m-d', strtotime($data->created_at)); ?></td>
                      <td><?php echo date('Y-m-d', strtotime($data->updated_at)); ?></td>

                      <?php if ($loggedInAdmin->admin_level == 1) : ?>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#userModel">
                              <i class="icon-edit1"></i></button>
                            <button class="btn btn-danger remove-btn" data-id="<?php echo $data->id; ?>">
                              <i class="icon-trash"></i>
                            </button>
                          </div>
                        </td>
                      <?php endif; ?>

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

<div class="modal fade" id="userModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="user_form" enctype="multipart/form-data">
        <input type="hidden" name="user[created_by]" value="<?php echo $loggedInAdmin->id ?>" readonly>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fName" class="col-form-label">Full Name</label>
                  <input type="text" class="form-control" name="user[full_name]" id="fName" placeholder="Full name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="aLevel" class="col-form-label">Admin Level</label>
                  <select name="user[admin_level]" class="form-control" id="aLevel" required>
                    <option value="">select level</option>
                    <?php foreach (Admin::ADMIN_LEVEL as $key => $data) : ?>
                      <option value="<?php echo $key ?>"><?php echo $data ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cName" class="col-form-label">Company Name</label>
                  <input type="text" class="form-control" id="cName" value="<?php echo $company->name ?>" disabled>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="regNo" class="col-form-label">Branch</label>
                  <select name="user[branch_id]" class="form-control" id="bId" required>
                    <option value="">select branch</option>
                    <?php foreach ($branches as $data) : ?>
                      <option value="<?php echo $data->id ?>"><?php echo ucwords($data->name) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="col-form-label">Email</label>
                  <input type="text" class="form-control" name="user[email]" id="email" placeholder="Email" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone" class="col-form-label">Phone</label>
                  <input type="tel" class="form-control" name="user[phone]" id="phone" placeholder="Phone number" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password" class="col-form-label">Password</label>
                  <input type="password" class="form-control" name="user[password]" id="password" placeholder="12345">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cPass" class="col-form-label">Confirm password</label>
                  <input type="password" class="form-control" name="user[confirm_password]" id="cPass" placeholder="12345">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="address" class="col-form-label">Address</label>
                  <textarea name="user[address]" id="address" class="form-control" placeholder="Contact address" rows="3"></textarea>
                </div>
              </div>
              <div class="col-md-6 m-auto">
                <div class="form-group">
                  <label for="avatar" class="col-form-label">Profile Image</label>
                  <input type="file" class="form-control" name="profile" id="avatar">
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

<input type="hidden" id="uId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const USER_URL = 'inc/process.php';

    $('#user_form').on("submit", function(e) {
      e.preventDefault();
      let uId = $('#uId').val()

      let formData = new FormData(this);

      if (uId == "") {
        formData.append('new_user', 1)
      } else {
        formData.append('edit_user', 1)
        formData.append('uId', uId)
      }

      $.ajax({
        url: USER_URL,
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
      let uId = this.dataset.id
      $('#uId').val(uId)
      $('#password').val('')
      $('#cPass').val('')

      $.ajax({
        url: USER_URL,
        method: "GET",
        data: {
          uId: uId,
          get_user: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#fName').val(r.data.full_name)
          $('#email').val(r.data.email)
          $('#phone').val(r.data.phone)
          // $('#cName').val(r.data.name)
          $('#aLevel').val(r.data.admin_level)
          $('#bId').val(r.data.branch_id)
          $('#address').val(r.data.address)
        }
      })
    });

    $(document).on('click', '.remove-btn', function() {
      let uId = this.dataset.id;
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
            url: USER_URL,
            method: "POST",
            data: {
              uId: uId,
              delete_user: 1
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