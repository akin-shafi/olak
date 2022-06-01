<?php require_once('../../private/initialize.php');
require_login();

$page = 'Settings';
$page_title = 'Manage Users';
include(SHARED_PATH . '/admin_header.php');

$admins = Admin::find_by_undeleted();

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
          <div class="table-container border-0 shadow">
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
                    <th>Action</th>
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
                    $imgUrl = !empty($data->profile_img) ? $data->profile_img : 'olak.png';
                  ?>
                    <tr>
                      <td>
                        <img class="avatar rounded-circle" src="<?php echo url_for('settings/uploads/profile/' . $imgUrl); ?>" width="100" alt="<?php echo ucwords($data->full_name); ?>">
                      </td>
                      <td><?php echo strtoupper($data->full_name); ?></td>
                      <td><?php echo $data->email; ?></td>
                      <td><span class="badge badge-primary"><?php echo $adminLevel; ?></span></td>
                      <td><?php echo isset($branch) ? ucwords($branch) : 'Not set'; ?></td>
                      <td><?php echo $data->reset_password != 0 ? '<span class="badge badge-success">Activated</span>' : '<span class="badge badge-warning">Pending</span>'; ?></td>
                      <td><?php echo ucwords($createdBy); ?></td>
                      <td><?php echo date('Y-m-d', strtotime($data->created_at)); ?></td>
                      <td><?php echo date('Y-m-d', strtotime($data->updated_at)); ?></td>

                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#userModel">
                            <i class="icon-edit1"></i></button>
                          <button class="btn btn-danger remove-btn" data-id="<?php echo $data->id; ?>">
                            <i class="icon-trash"></i>
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

<div class="modal fade" id="userModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div id="user_form_fields">
        <?php include('./form_fields.php'); ?>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="uId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const USER_URL = './process.php';

    $(document).on("submit", '#user_form', function(e) {
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
          successAlert(r.msg);
          setTimeout(() => {
            $('.lds-hourglass').addClass('d-none');
            window.location.reload()
          }, 250);
        },
        error: function(e) {
          errorAlert(e.responseJSON.msg[0]);
        }
      })
    });

    $('.edit-btn').on("click", function() {
      let uId = this.dataset.id
      $('#uId').val(uId)
      $('#password').val('')
      $('#cPass').val('')
      $('.title').text('Edit User')

      $.ajax({
        url: USER_URL,
        method: "GET",
        data: {
          uId: uId,
          get_user: 1
        },
        success: function(r) {
          $('#user_form_fields').html(r)
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

    $('#aLevel').on('change', function() {
      let role = parseInt($(this).val())

      let topLevel = [1, 2, 3, 4, 8] // ? 'Super Admin', 'Chairman', 'General Manager', 'Head Account', 'Special',
      let compliance = [5] // ? 'Compliance', 
      let manager = [6] // ? 'Manager', 
      let supervisor = [7] // ? 'Supervisor', 

      if (inArray(role, topLevel)) {
        $('.permit').attr('checked', true)
      } else {
        $('.permit').attr('checked', false)
      }
    })


    function inArray(target, array) {
      for (var i = 0; i < array.length; i++) {
        if (array[i] === target) {
          return true;
        }
      }
      return false;
    }
  })
</script>