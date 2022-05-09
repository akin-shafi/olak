<?php

require_once('../../private/initialize.php');

require_login();
$page_title = 'List';
$page = 'Categories';

//*********** Create Category ****** //
if (isset($_POST['category'])) {
  $args = $_POST['category'];
  $category = new ProductCategory($args);
  $result = $category->save();

  if ($result === true) {
    $session->message('category created successfully.');
  } else {
    // show errors
  }
} else {
  // display the form
  $category = new ProductCategory;
}

//*********** edit Category ****** //
if (isset($_POST['editExcept'])) {
  $args = $_POST['editExcept'];

  $id = $_POST['editExcept']['id'];
  $editExcept = ProductCategory::find_by_id($id);
  $editExcept->merge_attributes($args);
  $result = $editExcept->save(); // Save

  if ($result == true) {
    $variable = Product::find_by_category($id);
    foreach ($variable as $key => $value) {
      $prod = Product::find_by_id($value->id);
      $data = [
        'exception' => $_POST['editExcept']['exception']
      ];
      $prod->merge_attributes($data);
      $result2 = $prod->save(); // Save

      $stock = StockDetails::find_by_ref($prod->ref_no);
      if (!empty($stock)) {
        $data2 = [
          'exception' => $_POST['editExcept']['exception']
        ];
        $stock->merge_attributes($data2);
        $result3 = $stock->save();
      }
      # code...
    }
    # code...
  }
  $result2 = true;
  if ($result2 === true) {

    $session->message('Exception updated successfully.');
  } else {
    // show errors
  }
}
//*********** edit Category ****** //
if (isset($_POST['editCat'])) {
  $args = $_POST['editCat'];

  $id = $_POST['editCat']['id'];
  $editCat = ProductCategory::find_by_id($id);


  $editCat->merge_attributes($args);
  $result = $editCat->save();

  if ($result === true) {

    $session->message('category updated successfully.');
  } else {
    // show errors
  }
}

//*********** Delete Category ****** //

if (isset($_POST['deleteCat'])) {
  $id = $_POST['deleteCat']['id'];
  $cat = ProductCategory::find_by_id($id);
  // logfile
  // log_action('Delete Category', "id: {$admin->id}, Deleted by {$loggedInAdmin->full_name()}", "Category");

  // Delete admin
  $result = $cat->deleted($id);
  $session->message('The Category was deleted successfully.');
} else {
  // Display form
}
?>
<?php $page_title = 'Product Categories'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">
  <!-- Page header start -->
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
  <!-- Page header end -->




  <!-- Content wrapper start -->
  <div class="content-wrapper">
    <div class="d-flex justify-content-end mb-2">
      <button class="btn btn-primary" id="dLabel" type="button" data-toggle="modal" data-target="#add_category">
        Add Category </button>
    </div>


    <div class="text-danger text-center bg-light d-flex justify-content-center">
      <div class="table-responsive">
        <table id="catData" class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <tr class="bg-primary">
              <th>s/n</th>
              <th>category</th>
              <th>Exception</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="showCat">


          </tbody>

        </table>
      </div>

    </div>
  </div>


  <div class="modal fade none-border" id="add_category">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><strong>Add Category</strong></h4>
        </div>
        <form method="post">
          <div class="modal-body row">

            <div class="col-sm-6">
              <label>Category Name</label>

              <input type="text" name="category[category]" placeholder="Category Name" class="form-control">


            </div>




          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-secondary save-event waves-effect waves-light">Create
              Category</button>

            <!-- <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button> -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade none-border" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><strong>Edit Category</strong></h4>
        </div>
        <form method="post">
          <div class="modal-body row" id="showInput">




          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-secondary save-event waves-effect waves-light">Edit
              Category</button>

            <!-- <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button> -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade none-border" id="exceptionModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><strong>Edit Exception</strong></h4>
        </div>
        <form method="post">
          <div class="modal-body row" id="showException">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-secondary save-event waves-effect waves-light">Edit
              Exception</button>

            <!-- <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button> -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade none-border" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><strong>Delete Category</strong></h4>
        </div>
        <form method="post">
          <div class="modal-body row" id="deleteInput">




          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger save-event waves-effect waves-light">Delete
              Category</button>

            <!-- <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button> -->
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- *************
        ************ Main container end *************
        ************* -->

  <input type="hidden" id="eUrl" value="<?php echo url_for('/categories') ?>">
  <?php include(SHARED_PATH . '/admin_footer.php'); ?>

  <script type="text/javascript">
    var eUrl = $("#eUrl").val();
    returnBox()

    function returnBox() {
      $.ajax({
        url: 'inc/category_script.php',
        method: 'post',
        data: {
          fetch_table: 1,
          // startDate: start,
          // endDate: end,
        },
        success: function(r) {

          $('#showCat').html(r);
          console.log(r);
        }
      });
    }
    $(document).on('click', '#edit', function(e) {
      $("#editModal").modal('show');
      var eid = $(this).data('id');

      $.ajax({
        url: 'inc/category_script.php',
        method: 'post',
        data: {
          showEdit: 1,
          id: eid,
        },
        // dataType: 'json',
        success: function(r) {
          $('#showInput').html(r);
        }
      });
    })
    $(document).on('click', '.exception', function(e) {
      $("#exceptionModal").modal('show');
      var eid = $(this).data('id');

      $.ajax({
        url: 'inc/category_script.php',
        method: 'post',
        data: {
          exceptionEdit: 1,
          id: eid,
        },
        // dataType: 'json',
        success: function(r) {
          $('#showException').html(r);
        }
      });
    })


    $(document).on('click', '#delete', function(e) {
      e.preventDefault();
      $("#deleteModal").modal('show');
      var eid = $(this).data('id');
      $.ajax({
        url: 'inc/category_script.php',
        method: 'post',
        data: {
          showDelete: 1,
          id: eid,
        },
        // dataType: 'json',
        success: function(r) {
          $('#deleteInput').html(r);
        }
      });
    })
  </script>