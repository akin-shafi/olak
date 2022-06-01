<?php require_once('../private/initialize.php');
$page_title = 'Products | Import';
include(SHARED_PATH . '/header.php'); ?>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Import Products</h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo url_for('/products/') ?>">Products</a></li>
         <li class="active">Import Products</li>
      </ol>
   </section>
   <div class="col-lg-12 alerts">
      <div id="custom-alerts" style="display:none;">
         <div class="alert alert-dismissable">
            <div class="custom-msg"></div>
         </div>
      </div>
   </div>
   <div class="clearfix"></div>
   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box box-primary">
               <div class="box-header">
                  <h3 class="box-title">Please fill in the information below</h3>
               </div>
               <div class="box-body">
                  <div class="well well-sm">
                     <a href="../uploads/csv/sample_products.csv" class="btn btn-info btn-sm pull-right"><i class="fa fa-download"></i> Download sample File</a>
                     <p><span class="text-info">The first line in downloaded csv file should remain as it is. Please do not change the order of columns.</span><br /><span class="text-success">The correct column order is (<b>Product Code, Product Name, Purchase Price, Product Tax, Product Price, Category Code</b>)</span> <span class="text-primary">&amp; you must follow this. If you are using any other language then English, please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM)</span></p>
                  </div>
                  <form action="https://spos.tecdiary.net/products/import" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                     <input type="hidden" name="spos_token" value="0d496bb8b652f6882158a8720663a4ed" />
                     <div class="form-group">
                        <label for="csv_file">Upload File</label>                        <input type="file" name="userfile" id="csv_file">
                        <div class="inline-help">Please select .csv files (allowed file size 200KB)</div>
                     </div>
                     <div class="form-group">
                        <input type="submit" name="import" value="Import"  class="btn btn-primary" />
                     </div>
                  </form>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>