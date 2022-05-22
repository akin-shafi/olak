<?php require_once('../private/initialize.php');
require_login();

$page = 'Materials';
$page_title = 'Material Category';
include(SHARED_PATH . '/admin_header.php');

$categories = MaterialCategory::find_by_undeleted(['order' => 'ASC']);

?>

<div class="content-wrapper">
  <div class="d-flex justify-content-between">
    <h3 class="text-uppercase">Manage material category</h3>
    <!-- <button class="btn btn-primary mb-3">
      &plus; Add Category</button> -->
  </div>

  <div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

      <div class="card">
        <div class="card-body px-5">
          <div class="row shadow">
            <div class="col-md-8">
              <div class="table-container border-0">
                <div class="table-responsive">
                  <table class="table custom-table table-sm dataTable">
                    <thead>
                      <tr class="bg-primary text-white ">
                        <th>SN</th>
                        <th>Category</th>
                        <th>Updated At</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $sn = 1;
                      foreach ($categories as $data) : ?>
                        <tr>
                          <td><?php echo $sn++; ?></td>
                          <td><?php echo ucwords($data->name); ?></td>
                          <td><?php echo date('Y-m-d (h:i:s a)', strtotime($data->updated_at)); ?></td>
                          <td><?php echo date('Y-m-d (h:i:s a)', strtotime($data->created_at)); ?></td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>">
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

            <div class="col-md-4">
              <form id="category_form">
                <div class="container">
                  <div class="mb-3">
                    <div class="form-group">
                      <label for="catName" class="col-form-label">Category Name</label>
                      <input type="text" class="form-control" name="category[name]" id="catName" placeholder="Enter Category Name" required>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary d-block m-auto title">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

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
      $('.title').text('Update')

      $.ajax({
        url: FACTORY_URL,
        method: "GET",
        data: {
          cId: cId,
          get_category: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#catName').val(r.data.name)
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
              setTimeout(() => {
                window.location.reload()
              }, 1500);
            }
          });

        }
      })

    });
  })
</script>