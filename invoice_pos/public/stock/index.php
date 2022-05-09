<?php
require_once('../../private/initialize.php');
require_login();

?>
<?php $page = 'Stock';
$page_title = 'Stock'; ?>
<?php include(SHARED_PATH . '/admin_header.php');

$products = Product::find_by_undeleted();
$stockId = '';

?>


<div class="main-container">


  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-9 col-9 ">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-3 col-3 ">
        <div class="daterange-container">

          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-file-text"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="content-wrapper">
    <div class="d-flex justify-content-end align-tems-center mb-2">
      <button class="btn btn-primary btn-sm add_stock" disabled>Add Stock</button>
    </div>

    <div class="table-responsive">
      <table class="table table-sm table-striped ">
        <thead>
          <tr class="active">
            <th>Product</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (Stock::find_by_undeleted() as $value) :
            $product = Product::find_by_id($value->product_id);
          ?>
            <tr>
              <td> <?php echo ucwords($product->pname); ?></td>
              <td> <?php echo number_format($value->quantity, 2); ?></td>
              <td>
                <button class="btn btn-warning btn-sm edit_stock" data-id="<?php echo $value->id ?>" disabled>
                  <i class="feather-edit"></i></button>
                <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $value->id ?>" disabled>
                  <i class="feather-delete"></i></button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>



<div class="modal fade" id="addStockModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customModalLabel">Add Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="stock_form">
          <div class="row">
            <div class="form-group col-md-6">
              <div class="mb-3">
                <label for="product_id" class="form-label">Product Name</label>
                <select class="form-control" name="stock[product_id]" id="product_id">
                  <option value="">select product</option>
                  <?php foreach ($products as $product) : ?>
                    <option value="<?php echo $product->id; ?>">
                      <?php echo $product->pname; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group col-md-6">
              <label>Quantity</label>
              <input type="text" name="stock[quantity]" class="form-control" id="quantity">
            </div>


            <div class="form-group col-md-12 d-flex justify-content-end">
              <button type="submit" class="btn-sm btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<input type="text" value="<?php echo $stockId ?>" id="stockId" readonly>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
  $(document).ready(function() {
    const STOCK_URL = 'inc/process.php';

    $(document).on('click', '.add_stock', function() {
      $("#addStockModal").modal('show')
    })

    $('#stock_form').on("submit", function(e) {
      e.preventDefault();
      let stockId = $('#stockId').val()

      let formData = new FormData(this);

      if (stockId == "") {
        formData.append('new_stock', 1)
      } else {
        formData.append('edit_stock', 1)
        formData.append('stockId', stockId)
      }

      $.ajax({
        url: STOCK_URL,
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
          $('.ajax-wrap').removeClass('d-none');
        },
        success: function(r) {
          successAlert(r.message);
          setTimeout(() => {
            $('.ajax-wrap').addClass('d-none');
            window.location.reload()
          }, 250);
        },

        error: function(jqXHR, textStatus, error) {
          errorAlert(jqXHR.responseJSON.errors);
          $('.ajax-wrap').addClass('d-none');
        }
      })
    });

    $('tbody').on("click", '.edit_stock', function(e) {
      let stockId = this.dataset.id;
      $('#stockId').val(stockId);

      $.ajax({
        url: STOCK_URL,
        method: "GET",
        data: {
          stockId: stockId,
          get_stock: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#product_id').val(r.data.product_id)
          $('#quantity').val(r.data.quantity)

          $("#addStockModal").modal('show')
        }
      })
    });


    $('tbody').on('click', '.delete-btn', function(e) {
      let stockId = this.dataset.id;

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
            url: STOCK_URL,
            method: "POST",
            data: {
              stockId: stockId,
              delete_stock: 1
            },
            dataType: 'json',
            success: function(data) {
              Swal.fire(
                'Deleted!',
                data.message,
                'success'
              )

              window.location.reload()
            }
          });

        }
      })

    });
  })
</script>