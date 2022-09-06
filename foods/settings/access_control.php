<?php require_once('../private/initialize.php');
require_login();

$page = 'Settings';
$page_title = 'Access Control';
include(SHARED_PATH . '/admin_header.php');

$access = AccessControl::find_by_undeleted();
$admins = Admin::find_by_undeleted();

?>
<style>
  th {
    font-size: 12px;
    vertical-align: middle;
  }
</style>

<div class="content-wrapper">
  <!-- <div class="d-flex justify-content-end">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#userModel">
      &plus; Add Permission</button>
  </div> -->

  <div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

      <div class="card">
        <div class="card-body">
          <div class="table-container border-0 shadow">
            <h3>Access Control Management (Permissions / Visibility)</h3>
            <div class="table-responsive">
              <table class="table custom-table table-sm">
                <thead>
                  <tr class="bg-primary text-white text-center">
                    <th>SN</th>
                    <th>Fullname</th>
                    <th>Role</th>
                    <th>Dashboard</th>
                    <th>Sales mgt</th>
                    <th>Add sales</th>
                    <th>Edit sales</th>
                    <th>Manage sales</th>
                    <th>Expenses mgt</th>
                    <th>Add exp</th>
                    <th>Edit exp</th>
                    <th>Delete exp</th>
                    <th>Report mgt</th>
                    <th>Access control</th>
                    <th>Company setup</th>
                    <th>User mgt</th>
                    <th>Filtering</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php $sn = 1;
                  $isTrue = '<span class="bg-success rounded-circle d-block m-auto" style="width:3px;height:3px;padding:5px"></span>';
                  $isFalse = '<span class="bg-secondary rounded-circle d-block m-auto" style="width:3px;height:3px;padding:5px"></span>';

                  foreach ($access as $data) :
                    $user = Admin::find_by_id($data->user_id);
                    if ($user->admin_level == 1) continue;
                    isset($user->admin_level) ? $adminLevel = Admin::ADMIN_LEVEL[$user->admin_level] : '';
                  ?>

                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo ucwords($user->full_name); ?></td>
                      <td><span class="badge badge-primary"><?php echo ucwords($adminLevel); ?></span></td>
                      <td class="text-center"><?php echo $data->dashboard == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->sales_mgt == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->add_sales == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->edit_sales == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->manage_sales == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->expenses_mgt == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->add_exp == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->edit_exp == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->delete_exp == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->report_mgt == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->access_control == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->company_setup == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->user_mgt == 1 ? $isTrue : $isFalse ?></td>
                      <td class="text-center"><?php echo $data->filtering == 1 ? $isTrue : $isFalse ?></td>

                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#userModel">
                            <i class="icon-edit1"></i></button>
                          <button class="btn btn-danger remove-btn d-none" data-id="<?php echo $data->id; ?>">
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
        <h5 class="modal-title">Access Control</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="access_form">
        <input type="hidden" name="access[created_by]" value="<?php echo $loggedInAdmin->id ?>" readonly>
        <div class="modal-body">
          <div class="container">
            <div class="row" id="assigned">

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
          successAlert(r.msg);
          setTimeout(() => {
            $('.lds-hourglass').addClass('d-none');
            window.location.reload()
          }, 250);
        },
        error: function(e) {
          errorAlert(e.responseJSON.msg);
          $('.lds-hourglass').addClass('d-none');
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
        success: function(r) {
          $('#assigned').html(r)
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