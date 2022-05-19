<?php require_once('../private/initialize.php');
$page_title = 'List';
$page = 'Categories'; ?> 
<?php
//*********** Create Category ****** //
if(isset($_POST['category'])){
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
if(isset($_POST['editExcept'])){
   $args = $_POST['editExcept'];

     $id = $_POST['editExcept']['id'];
     $editExcept = ProductCategory::find_by_id($id);
     $editExcept->merge_attributes($args);
     $result = $editExcept->save();// Save

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
if(isset($_POST['editCat'])){
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
<?php
include(SHARED_PATH . '/header.php'); ?>

<div class="content-wrapper">

   <section class="content-header">
      <h1>Categories</h1>
      <ol class="breadcrumb">
         <li><a href="https://spos.tecdiary.net/"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Categories</li>
      </ol>
   </section>

   <?php if ($category->errors) { ?>
    <div class="p-2 alert-light mb-3 rounded">
      <?php echo display_errors($category->errors); ?> 
      
    </div>
  <?php } ?>
  <?php echo display_session_message(); ?>
   
   <div class="clearfix"></div>
   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            

            <div class="box box-primary">
               <div class="box-header">
                  <h3 class="box-title">Please use the table below to navigate or filter the results.</h3>
                  <div class="dropdown pull-right">
                      <button class="btn btn-primary" id="dLabel" type="button" data-toggle="modal" data-target="#add_category">
                      Add Category                        
                      <span class="caret"></span>
                      </button>

                      <!-- <button class="btn bg-maroon" id="exception">Create Exception</button> -->
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                      </ul>
                   </div>
               </div>
               <div class="box-body">
                  
                  <div class="table-responsive">
                     <table id="catData" class="table table-striped table-bordered table-condensed table-hover" >
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
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- <div class="modal fade" id="picModal" tabindex="-1" role="dialog" aria-labelledby="picModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body text-center">
               <img id="product_image" src="" alt="" />
            </div>
         </div>
      </div>
   </div> -->

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
</div>

<input type="hidden" id="eUrl" value="<?php echo url_for('/categories') ?>">

<?php include(SHARED_PATH . '/footer.php'); ?>

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