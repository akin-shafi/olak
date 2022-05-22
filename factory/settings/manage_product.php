<?php require_once('../private/initialize.php');
require_login();

$page = 'Settings';
$page_title = 'Manage Products';
include(SHARED_PATH . '/admin_header.php');

$products = Product::find_by_undeleted();

?>

<div class="content-wrapper">
  <div class="d-flex justify-content-end">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#productModel">
      &plus; Add Product</button>
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
                    <th>Product Type</th>
                    <th>Product Name</th>
                    <th>Created By</th>
                    <th>Updated At</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sn = 1;
                  foreach ($products as $data) :
                    $createdBy = Admin::find_by_id($data->created_by)->full_name;
                    $exp = explode(' ', $createdBy);
                    $firstName = $exp[0];
                    $initials = substr($exp[1], 0, 1);
                    $type = Product::PRODUCT_TYPE[$data->product_type];
                  ?>
                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo ucwords($type); ?></td>
                      <td><?php echo ucwords($data->name); ?></td>
                      <td><?php echo ucwords($firstName . ' ' . $initials . '.'); ?></td>
                      <td><?php echo date('Y-m-d (h:i:s a)', strtotime($data->updated_at)); ?></td>
                      <td><?php echo date('Y-m-d (h:i:s a)', strtotime($data->created_at)); ?></td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#productModel">
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

<div class="modal fade" id="productModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="product_form">
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <div class="form-group">
                    <label for="pType" class="col-form-label">Product Type</label>
                    <select name="product[product_type]" class="form-control" id="pType">
                      <option value="">select type</option>
                      <?php foreach (Product::PRODUCT_TYPE as $key => $type) : ?>
                        <option value="<?php echo $key ?>"><?php echo $type ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-group">
                    <label for="pName" class="col-form-label">Product Name</label>
                    <input type="text" class="form-control" name="product[name]" id="pName" placeholder="Product Name" required>
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

<input type="hidden" id="pId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const FACTORY_URL = 'inc/process.php';

    $('#product_form').on("submit", function(e) {
      e.preventDefault();
      let pId = $('#pId').val()

      let formData = new FormData(this);

      if (pId == "") {
        formData.append('new_product', 1)
      } else {
        formData.append('edit_product', 1)
        formData.append('pId', pId)
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
      let pId = this.dataset.id
      $('#pId').val(pId)
      $('.title').text('Edit Product')

      $.ajax({
        url: FACTORY_URL,
        method: "GET",
        data: {
          pId: pId,
          get_product: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#pType').val(r.data.product_type)
          $('#pName').val(r.data.name)
        }
      })
    });

    $(document).on('click', '.remove-btn', function() {
      let pId = this.dataset.id;
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
              pId: pId,
              delete_product: 1
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