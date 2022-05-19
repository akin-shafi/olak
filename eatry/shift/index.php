<?php require_once('../private/initialize.php');
$page_title = 'Shift Type';
$page = 'Shift';
require_login();


if ($shift_mgt != 1) { 
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
                    <div class="title"></div>
                    <div class="btn-group">
                      <button class="btn btn-sm btn-primary add">Add New User</button>
                    </div>
                </div>
                <div></div>
                <div class="box-body">
                     <div class="table-responsive">
                <table class="table table-striped custom-table table-bordered" >
                  <thead>
                    <tr class="text-center">
                      <th>SN</th>
                      <th>Shift</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      
                      <th>Action</th>
                      <th>Status</th>
                      <th></th>
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
              <label class="control-label">Shift Name</label>
              <input type="text" name="addRecord[name]" class="form-control">
            </div>

            <div class="form-group col-sm-6">
              <label class="control-label">Start Time</label>
              <input type="time" name="addRecord[start_time]" class="form-control">
            </div>

            <div class="form-group col-sm-6">
              <label class="control-label">End Time</label>
              <input type="time" name="addRecord[end_time]" class="form-control">
            </div>
            <div class="form-group col-sm-12">
              <div class="p-3 border-top d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
                <button type="button" name="genManifest" class="btn btn-sm bg-gradient-primary" id="addRecord">Save</button>
              </div>
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
        url:"inc/shift_backend.php",
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
          url: "inc/shift_backend.php",
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
          url: "inc/shift_backend.php",
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

  $(document).on('click', '.bn', function(e) {
     e.preventDefault();
         var id = $(this).data('id');
         var btn_type = $(this).data('type');
         
         
         $.ajax({
            url: "inc/shift_backend.php",
            method:"POST",
            data:{
               editStatus: 1,
               id: id,
               type: btn_type,
            },
            dataType: "json",
            success:function(r)
            {
                if (r.msg == "OK") {
                  load_data();
                  successAlert("successful")
                }else{
                  successAlert("Error: Somthing went wrong")
                }
               
            }
         });
  })
  $(document).on('click', '#editRecord', function() {
      $.ajax({
          url: "inc/shift_backend.php",
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