<?php require_once('../private/initialize.php');
$page_title = 'Access Control';
$page = 'Settings';
require_login();


if ($loggedInAdmin->admin_level != 1) {
    redirect_to(url_for('/login.php'));
}

include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title; ?> </h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $page_title; ?></li>
       </ol>
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" style="display:none;">
          <div class="alert alert-dismissable">
             <div class="custom-msg"></div>
          </div>
       </div>
    </div>
    <section class="content">

       <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary">
                <div class="d-flex justify-content-between p-4">
                    <div class="title">All Authorized Access</div>
                    <div class="btn-group">
                      <button class="btn btn-sm btn-primary add">Add New User</button>
                    </div>
                </div>
                <div></div>
                <div class="box-body">
                     <div class="table-responsive">
                <table class="table table-striped custom-table">
                  <thead>
                    <tr class="text-center">
                      <th>SN</th>
                      <th>User</th>
                      <th>Product Mgt</th>
                      <th>User Mgt</th>
                      <th>Stock Mgt</th>
                      <th>Warehouse Mgt</th>
                      <th>Procurement Mgt</th>
                      <th>Shift Mgt</th>
                      <th>Ledger Mgt</th>
                      <th>View Report</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="record">
                    
                  </tbody>
                </table>
              </div>  

                         
                                
                      
                  
                </div>
            </div>
          </div>
       </div>
    </section>
 </div>

<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center text-warning font-weight-bolder"><i class="fas fa-motorcycle fa-2x"></i></h4>
        <p class="">Add New</p>
      </div>
      <div class="modal-body bg-light">
          
          <form class="row" id="addForm">
            <div id="addError" class="text-center"></div>
            <div class="form-group col-sm-6">
              <label class="control-label">User name</label>
                <select class="form-control" name="addRecord[user_id]">
                <option value="">Select User</option>
                <?php foreach (Admin::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                  <option value="<?php echo $value->id ?>"><?php echo Admin::find_by_id($value->id)->full_name() ?></option>
                <?php } ?>
                
              </select>
            </div>

            <div class="form-group col-sm-6">
              <label class="control-label">Product Mgt</label>
              <select class="form-control" name="addRecord[product_mgt]">
                <option value="1">On</option>
                <option value="0" selected="">off</option>
              </select>
            </div>

            <div class="form-group col-sm-6">
              <label class="control-label">User Mgt</label>
              <select class="form-control" name="addRecord[user_mgt]">
                <option value="1">On</option>
                <option value="0" selected="">off</option>
              </select>
            </div>

            <div class="form-group col-sm-6">
              <label class="control-label">Stock Mgt</label>
              <select class="form-control" name="addRecord[stock_mgt]">
                <option value="1">On</option>
                <option value="0" selected="">off</option>
              </select>
            </div>

            <div class="form-group col-sm-6">
              <label class="control-label">Warehouse Mgt</label>
              <select class="form-control" name="addRecord[warehouse_mgt]">
                <option value="1">On</option>
                <option value="0" selected="">off</option>
              </select>
            </div>

            <div class="form-group col-sm-6">
              <label class="control-label">Procurement Mgt</label>
              <select class="form-control" name="addRecord[purchase_mgt]">
                <option value="1">On</option>
                <option value="0" selected="">off</option>
              </select>
            </div>
            <div class="form-group col-sm-6">
              <label class="control-label">Shift Mgt</label>
              <select class="form-control" name="addRecord[shift_mgt]">
                <option value="1">On</option>
                <option value="0" selected="">off</option>
              </select>
            </div>
            <div class="form-group col-sm-6">
              <label class="control-label">Ledger Mgt</label>
              <select class="form-control" name="addRecord[ledger_mgt]">
                <option value="1">On</option>
                <option value="0" selected="">off</option>
              </select>
            </div>

            <div class="form-group col-sm-6">
              <label class="control-label">View Report</label>
              <select class="form-control" name="addRecord[view_report]">
                <option value="1">On</option>
                <option value="0" selected="">off</option>
              </select>
            </div>

            <div class="p-3 border-top d-flex justify-content-between">
              <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
              <button type="button" name="genManifest" class="btn btn-sm bg-gradient-primary" id="addRecord">Save</button>
            </div>
          </form>
      </div>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title text-center text-warning font-weight-bolder"><i class="fas fa-motorcycle fa-2x"></i></h4>
        <p class="">Edit</p>
      </div>
      <div id="editError"></div>
      <div class="modal-body bg-light" id="show_result">
          
      </div>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



<?php include(SHARED_PATH . '/footer.php'); ?>
 <script type="text/javascript">

    load_data();
   function load_data(){
     $.ajax({
        url:"store/edit_control.php",
        method:"POST",
        data: {
          record: 1,
        },
        success:function(r)
        {
          $("#record").html(r);
        }
     });
  }

   $(document).on('click', '.add', function() {
    $('#addModal').modal('show');
   })

   $(document).on('click', '#addRecord', function(e) {
      e.preventDefault();
       $.ajax({
          url: "store/edit_control.php",
          method:"POST",
          data: $('#addForm').serialize(),
          dataType: 'json',
          success:function(r)
          {
            if (r.msg == "OK") {
              load_data();
              $('#addModal').modal('hide');
              successAlert('Added successfully')
            }else{
              
              
              $("#addError").html(r.msg);
            }
             
          }
       });
   })
   
  $(document).on('click', '.edit', function(e) {
     e.preventDefault();
    $('#editModal').modal('show');
         var id = $(this).data('id');
        $.ajax({
          url: "store/edit_control.php",
          method:"POST",
          data:{
             showEdit: 1,
             id: id,
          },
          // dataType: "json",
          success:function(r)
          {
             $("#show_result").html(r);
          }
       });
  })
  $(document).on('click', '#editRecord', function() {
      $.ajax({
          url: "store/edit_control.php",
          method:"POST",
          data: $('#editForm').serialize(),
          dataType: 'json',
          success:function(r)
          {
            if (r.msg == "OK") {
              load_data();
              $('#editModal').modal('hide');
              successAlert('Edited successfully')
            }else{
             $("#editError").html(r.msg);
            }
             
          }
       });
    
  })



 </script>