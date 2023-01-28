<?php
require_once('../private/initialize.php');

$page = 'ACL';
$page_title = 'Access Control';

$admins = Admin::find_by_undeleted();
$companies = Company::find_by_undeleted();
$branches = Branch::find_by_undeleted();

include(SHARED_PATH . '/header.php');

?>

<div class="page-header d-xl-flex d-block">
  <div class="page-leftheader">
    <h4 class="page-title"><?php echo $page_title ?> (<?php echo $page ?>)</h4>
  </div>
  <div class="page-rightheader ms-md-auto">
    <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
      <div class="btn-list">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aclModal">
          <i class="fa fa-plus"></i>
          Permission
        </button>

        <a href="<?php echo url_for('public/users/exportData.php') ?>" class="btn btn-success d-none"> <i class="fa fa-file-excel-o"></i> Export CSV</a>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="basic-datatable" class="table table-sm table-hover table-striped dt-responsive nowrap w-100">
            <thead>
              <tr>
                <th>s/n.</th>
                <th>Full Name</th>
                <th>Company</th>
                <th>Branch</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $sn = 1;
              foreach (AccessControl::find_by_undeleted() as $value) :
                $admin = Admin::find_by_id($value->admin_id);
                if ($admin->first_name == 'Admin') continue;
              ?>
                <tr>
                  <td><?php echo $sn++ ?></td>
                  <td style="min-width: 150px;"><?php echo ucwords($admin->full_name()); ?></td>
                  <td>
                    <?php $company = ucwords(Company::find_by_id($value->company_id)->company_name); ?>
                    <span class="badge bg-primary" style="margin: 2.5px 0; font-size:10px">
                      <?php echo $company; ?>
                    </span>
                  </td>
                  <td>
                    <?php $branch = ucwords(Branch::find_by_id($value->branch_id)->branch_name); ?>
                    <span class="badge bg-danger" style="margin: 2.5px 0; font-size:10px">
                      <?php echo $branch; ?>
                    </span>
                  </td>
                  <td style="min-width: 150px;">
                    <!-- <button data-id="<?php //echo $value->id 
                                          ?>" class="btn btn-outline-info btn-sm update">Update</button> -->
                    <button data-id="<?php echo $value->id ?>" class="btn btn-outline-danger btn-sm deleted">Delete</button>
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


<div id="aclModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body">
        <div class="text-center mt-2 mb-4">
          <h3 class="text-primary">Access Control (ACL)</h3>
        </div>
        <div class="error d-none"></div>

        <form class="ps-3 pe-3 row" id="acl_form">
          <input type="hidden" name="created_by" value="<?php echo $loggedInAdmin->id;  ?>">
          <input type="hidden" name="new_access" value="1">

          <div class="mb-3 col-md-12">
            <label for="admin_id" class="form-label">Full name</label>
            <select class="select2 form-control admin" name="admin_id" id="admin_id" required="">
              <?php foreach ($admins as $value) : ?>
                <option value="<?php echo $value->id ?>">
                  <?php echo ucwords($value->full_name()) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3 col-md-12">
            <label for="company_id" class="form-label">Company</label>
            <select class="select2 form-control company" name="company_id[]" id="company_id" multiple="multiple" required="">
              <?php foreach ($companies as $value) : ?>
                <option value="<?php echo $value->id ?>">
                  <?php echo ucwords($value->company_name) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div id="ajax"></div>

          <div class="mb-3 text-center">
            <button class="btn btn-primary" type="submit">Save</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<input type="hidden" id="aId">
<?php include(SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">
  $(document).ready(function name() {
    $('.admin').select2({
      placeholder: 'Select admin',
      dropdownParent: $("#aclModal")
    })

    $('.company').select2({
      placeholder: 'Select company',
      allowClear: true,
      tokenSeparators: [' ']
    }).on("change", () => {
      let selectedOption = $('.company').select2('val')

      $.ajax({
        url: 'inc/add_permission.php',
        method: "GET",
        data: {
          get_branch: 1,
          selected: selectedOption
        },
        success: function(res) {
          $('#ajax').html(res)
        }
      })
    });

    const message = (req, res) => {
      swal(req + "!", res, {
        icon: req,
        timer: 2000,
        buttons: {
          confirm: {
            className: req == "error" ? "btn btn-danger" : "btn btn-success",
          },
        },
      });
    };


    $(document).on("submit", "#acl_form", function(e) {
      e.preventDefault();

      $.ajax({
        url: 'inc/add_permission.php',
        method: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data) {
          if (data.success == true) {
            message('success', data.msg);
            setTimeout(() => {
              window.location.reload()
            }, 2000);
          }
        }
      })
    })

    $('tbody').on('click', '.deleted', function() {
      let accessId = this.dataset.id;

      swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((del) => {
          if (del) {
            $.ajax({
              url: 'inc/add_permission.php',
              method: "POST",
              data: {
                deleted: 1,
                accessId: accessId
              },
              dataType: 'json',
              success: function(data) {
                if (data.success == true) {
                  message("success", data.msg);

                  setTimeout(() => {
                    window.location.reload();
                  }, 1000);
                }
              }
            })
          }
        });

    })
  })
</script>