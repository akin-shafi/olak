<?php require_once('../private/initialize.php');
require_login();

$page = 'Settings';
$page_title = 'Manage Categories';
include(SHARED_PATH . '/admin_header.php');

$categories = Category::find_by_undeleted();

?>

<div class="content-wrapper">
  <div class="d-flex justify-content-end">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#categoryModel">
      &plus; Add Category</button>
  </div>

  <div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

      <div class="card">
        <div class="card-body">
          <div class="table-container border-0 shadow">
            <div class="table-responsive">
              <table class="table custom-table table-sm dataTable">
                <thead>
                  <tr class="bg-primary text-white ">
                    <th>SN</th>
                    <th>Category Name</th>
                    <th>Created By</th>
                    <th>Updated At</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sn = 1;
                  foreach ($categories as $data) :
                    $createdBy = Admin::find_by_id($data->created_by)->full_name;
                    $exp = explode(' ', $createdBy);
                    $firstName = $exp[0];
                    $initials = substr($exp[1], 0, 1);
                  ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo ucwords($data->name); ?></td>
                      <td><?php echo ucwords($firstName . ' ' . $initials . '.'); ?></td>
                      <td><?php echo date('Y-m-d (h:i:s a)', strtotime($data->updated_at)); ?></td>
                      <td><?php echo date('Y-m-d (h:i:s a)', strtotime($data->created_at)); ?></td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#categoryModel">
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

<div class="modal fade" id="categoryModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="category_form">
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <div class="form-group">
                    <label for="cName" class="col-form-label">Category Name</label>
                    <input type="text" class="form-control" name="category[name]" id="cName" placeholder="Category Name" required>
                  </div>
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

<input type="hidden" id="cId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const FACTORY_URL = 'inc/process.php';

    $('#category_form').on("submit", function(e) {
      e.preventDefault();
      let cId = $('#cId').val()

      let formData = new FormData(this);

      if (cId == "") {
        formData.append('new_category', 1)
      } else {
        formData.append('edit_category', 1)
        formData.append('cId', cId)
      }

      $.ajax({
        url: FACTORY_URL,
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function(r) {
          if (r.success == true) {
            successAlert(r.msg);
            setTimeout(() => {
              window.location.reload()
            }, 1500);
          } else {
            errorAlert(r.msg);
          }
        }
      })
    });

    $('.edit-btn').on("click", function() {
      let cId = this.dataset.id
      $('#cId').val(cId)
      $('.title').text('Edit Category')

      $.ajax({
        url: FACTORY_URL,
        method: "GET",
        data: {
          cId: cId,
          get_category: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#cName').val(r.data.name)
        }
      })
    });

    $(document).on('click', '.remove-btn', function() {
      let cId = this.dataset.id;
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
            url: FACTORY_URL,
            method: "POST",
            data: {
              cId: cId,
              delete_category: 1
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