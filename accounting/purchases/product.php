<?php 
  require_once('../private/initialize.php');

$page = 'Dashboard';
$page_title = 'User Dashboard';
include(SHARED_PATH . '/admin_header.php'); 

?>
<div class="content-wrapper" style="min-height: 623px;">
   <!-- Main content -->
   <section class="content">
      <div class="col-md-6 m-auto box add_area" style="display: none">
         <div class="box-header with-border">
            <h3 class="box-title">Add Product </h3>
            <div class="box-tools pull-right">
               <a href="#" class="text-right btn btn-default rounded btn-sm cancel_btn"><i class="fa fa-angle-left"></i> Back</a>
            </div>
         </div>
         <div class="box-body">
            <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="http://accufy.originlabsoft.com/admin/product/add" role="form" novalidate="">
               <div class="form-group">
                  <label>Product Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" required="" name="name" value="">
               </div>
               <div class="form-group">
                  <label>Price <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" required="" name="price" value="">
               </div>
               <input type="hidden" class="form-control" name="quantity" value="">
               <div class="form-group col-md-12 p-0 income_list">
                  <label class="col-sm-12 control-label p-0" for="example-input-normal">Income Category </label>
                  <select class="form-control" name="income_category">
                     <option value="0">Select</option>
                  </select>
               </div>
               <br>
               <input type="hidden" name="is_sell" value="1">
               <input type="hidden" name="is_buy" value="0">
               <div class="form-group m-t-30">
                  <input type="checkbox" id="md_checkbox_11" class="filled-in chk-col-blue" value="1" name="is_both">
                  <label for="md_checkbox_11"> Add Product for both type (Sales &amp; Purchases)</label>
               </div>
               <div class="form-group">
                  <label>Product Details</label>
                  <textarea class="form-control" name="details" rows="6"></textarea>
               </div>
               <input type="hidden" name="id" value="">
               <input type="hidden" name="type" value="sell">
               <!-- csrf token -->
               <input type="hidden" name="csrf_test_name" value="068df1bcd3d2903a41d948503457ba0f">
               <div class="row m-t-30">
                  <div class="col-sm-12">
                     <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save </button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class="list_area container">
         <h3 class="box-title">(Sales) Products &amp; Services  
            <a href="#" class="pull-right btn btn-info btn-sm add_btn rounded"><i class="fa fa-plus"></i> Add Product</a>
         </h3>
         <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
            <table class="table table-hover cushover ">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Price</th>
                     <th>Type</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
         </div>
      </div>
   </section>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>