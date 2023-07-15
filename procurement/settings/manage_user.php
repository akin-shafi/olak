<?php require_once('../private/initialize.php');
require_login();

$page = 'Settings';
$page_title = 'Manage Users';
include(SHARED_PATH . '/admin_header.php');


$admins = Admin::find_by_undeleted(['order' => 'ASC']);
$companies = Company::find_by_undeleted();


?>
<style>
  th,
  td {
    font-size: 0.9rem !important;
    vertical-align: middle;
  }
</style>

<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
          <div>
            <h4 class="mb-3"><?= $page_title ?></h4>
            <!-- <p class="mb-0">A dashboard provides you an overview of user list with access to the most important data,
              <br> functions and controls.
            </p> -->
          </div>
          <?php if ($loggedInAdmin->admin_level == 1) : ?>
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#userModel">
              &plus; Create User</button>
          <?php endif; ?>
        </div>
      </div>

      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
          <div class="card-body">
            <div class="table-container border-0 shadow">
              <h4 class="mb-3">Admin Management</h4>
              <div class="table-responsive">
                <table class="table table-sm data-table">
                  <thead class="bg-primary">
                    <tr class="ligth ligth-data">
                      <th>Avatar</th>
                      <th>Full name</th>
                      <th>Email</th>
                      <th>Admin level</th>
                      <th>Company</th>
                      <th>Branch</th>
                      <!-- <th>Created By</th> -->
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php foreach ($admins as $data) :
                      // if ($data->admin_level == 1) continue;

                      $company_name = Company::find_by_id($data->company_id)->name ?? '';
                      $branch_name = Branch::find_by_id($data->branch_id)->name ?? '';
                      $adminLevel = $data->admin_level != '' ? Admin::ADMIN_LEVEL[$data->admin_level] : 'Not set';
                      $imgUrl = !empty($data->profile_img) ? $data->profile_img : 'pro.png';
                      $createdBy = $data->created_by != '' ?  Admin::find_by_id($data->created_by)->full_name : 'Not set';
                    ?>
                      <tr>
                        <td>
                          <img class="rounded-circle shadow" src="<?php echo url_for('settings/uploads/profile/' . $imgUrl); ?>" width="40" height="40" alt="<?php echo ucwords($data->full_name); ?>">
                        </td>
                        <td><?php echo ucwords($data->full_name); ?></td>
                        <td><?php echo $data->email; ?></td>
                        <td><?php echo $adminLevel; ?></td>
                        <td><?php echo isset($company_name) ? ucwords($company_name) : 'Not set'; ?></td>
                        <td><?php echo isset($branch_name) ? ucwords($branch_name) : 'Not set'; ?></td>
                        <td><?php echo date('Y-m-d', strtotime($data->created_at)); ?></td>
                        <td><?php echo date('Y-m-d', strtotime($data->updated_at)); ?></td>

                        <td>
                          <div class="btn-group">
                            <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#userModel">
                              <i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger remove-btn" data-id="<?php echo $data->id; ?>">
                              <i class="fa fa-trash"></i>
                            </button>
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
                <label for="fName" class="col-form-label">Full Name</label>
                <input type="text" class="form-control" name="user[full_name]" id="fName" placeholder="Full name">
              </div>
              <?php if ($loggedInAdmin->admin_level == 1) : ?>
                <div class="col-md-6">
                  <label for="aLevel" class="col-form-label">Admin Level</label>
                  <select name="user[admin_level]" class="form-control" id="aLevel" required>
                    <option value="">select level</option>
                    <?php foreach (Admin::ADMIN_LEVEL as $key => $data) : ?>
                      <option value="<?php echo $key ?>"><?php echo $data ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              <?php endif;
              ?>
              <div class="col-md-6">
                <label class="label-control">Company Name<sup class="text-danger">*</sup></label>
                <select class="form-control company" name="user[company_id]" id="company" required>
                  <option value="">select a company</option>
                  <?php foreach ($companies as $value) :
                    $company_name = $value->name != '' ? $value->name : 'Not Set'
                  ?>
                    <option value="<?php echo $value->id ?>" <?php echo $value->name == '' ? 'disabled' : '' ?>>
                      <?php echo $company_name ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6">
                <div id="branch"></div>
              </div>
              <div class="col-md-6">
                <label for="email" class="col-form-label">Email</label>
                <input type="text" class="form-control" name="user[email]" id="email" placeholder="Email" required>
              </div>
              <div class="col-md-6">
                <label for="phone" class="col-form-label">Phone</label>
                <input type="tel" class="form-control" name="user[phone]" id="phone" placeholder="Phone number" required>
              </div>
              <div class="col-md-6">
                <label for="password" class="col-form-label">Password</label>
                <input type="password" class="form-control" name="user[password]" id="password" placeholder="12345">
              </div>
              <div class="col-md-6">
                <label for="cPass" class="col-form-label">Confirm password</label>
                <input type="password" class="form-control" name="user[confirm_password]" id="cPass" placeholder="12345">
              </div>
              <div class="col-md-12">
                <label for="address" class="col-form-label">Address</label>
                <textarea name="user[address]" id="address" class="form-control" placeholder="Contact address" rows="2"></textarea>
              </div>
              <div class="col-md-6 m-auto">
                <label for="avatar" class="col-form-label">Profile Image</label>
                <input type="file" class="form-control" name="profile" id="avatar">
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

              setTimeout(() => {
                window.location.reload()
              }, 1000);
            }
          });

        }
      })

    });



    $(document).on('change', '.company', function() {
      const selected = $(".company option:selected").val();
      console.log(selected);
      $.ajax({
        url: USER_URL,
        method: "GET",
        data: {
          company_id: selected
        },
        success: function(data) {
          console.log(data);
          $('#branch').html(data)
        }
      });
    });
  })
</script>