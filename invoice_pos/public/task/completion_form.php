<?php

require_once('../../private/initialize.php');

require_login();

// Find all undeleted admins
// $admins = Admin::find_all();
// $admins = Admin::find_by_undeleted();

?>
<?php $page_title = 'Job Completion Form'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo url_for('css/animate.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo url_for('css/sweetalert2.min.css') ?>">
<style type="text/css">
  /*-----------------
  20. Focus Label
-----------------------*/

.form-focus {
  height: 50px;
  position: relative;
}
.form-focus .focus-label {
  font-size: 16px;
  font-weight: 400;
  opacity: 0.4;
  pointer-events: none;
  position: absolute;
  -webkit-transform: translate3d(0, 22px, 0) scale(1);
  -ms-transform: translate3d(0, 22px, 0) scale(1);
  -o-transform: translate3d(0, 22px, 0) scale(1);
  transform: translate3d(0, 22px, 0) scale(1);
  transform-origin: left top;
  transition: 240ms;
  left: 12px;
  top: -8px;
  z-index: 1;
  color: #888;
  margin-bottom: 0;
}
.form-focus.focused .focus-label {
  opacity: 1;
  font-weight: 300;
  top: -14px;
  font-size: 12px;
  z-index: 1;
}
.form-focus .form-control:focus ~ .focus-label, 
.form-focus .form-control:-webkit-autofill ~ .focus-label {
  opacity: 1;
  font-weight: 300;
  top: -14px;
  font-size: 12px;
  z-index: 1;
}
.form-focus .form-control {
  height: 50px;
  padding: 21px 12px 6px;
}
.form-focus .form-control::-webkit-input-placeholder {
  color: transparent;
  transition: 240ms;
}
.form-focus .form-control:focus::-webkit-input-placeholder {
  transition: none;
}
.form-focus.focused .form-control::-webkit-input-placeholder {
  color: #bbb;
}
.form-focus.select-focus .focus-label {
  opacity: 1;
  font-weight: 300;
  top: -20px;
  font-size: 12px;
  z-index: 1;
}
.form-focus .select2-container .select2-selection--single {
  border: 1px solid #e3e3e3;
  height: 50px;
}
.form-focus .select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 48px;
  right: 7px;
}
.form-focus .select2-container--default .select2-selection--single .select2-selection__arrow b {
  border-color: #ccc transparent transparent;
  border-style: solid;
  border-width: 6px 6px 0;
  height: 0;
  left: 50%;
  margin-left: -10px;
  margin-top: -2px;
  position: absolute;
  top: 50%;
  width: 0;
}
.form-focus .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
  border-color: transparent transparent #ccc;
  border-width: 0 6px 6px;
}
.form-focus .select2-container .select2-selection--single .select2-selection__rendered {
  padding-right: 30px;
  padding-left: 12px;
  padding-top: 10px;
}
.form-focus .select2-container--default .select2-selection--single .select2-selection__rendered {
  color: #676767;
  font-size: 14px;
  font-weight: normal;
  line-height: 38px;
}
.form-focus .select2-container--default .select2-results__option--highlighted[aria-selected] {
  background-color: #fc6075;
}

/*-----------------
  21. Leave
-----------------------*/

.filter-row .btn {
  min-height: 50px;
  padding: 12px;
  text-transform: uppercase;
}
.action-label .label {
  display: inline-block;
  min-width: 85px;
  padding: 0.5em 0.6em;
}
.action-label i {
  margin-right: 3px;
}
.action-label .dropdown-menu .dropdown-item {
    padding: 5px 10px;
}

</style>
<!-- *************
        ************ Main container start *************
        ************* -->
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">
          
          <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
            <i class="feather-download"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->


  <!-- Content wrapper start -->
  <div class="content-wrapper">

    <section class="review-section">
            <div class="review-header text-center">
              <h3 class="review-title">Special Report and Job Completion form</h3>
              <p class=" text-muted bold fs-14">Please enter report, observation and recommendation of technician on this vehicle</p>
            </div>

            <form method="post">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered table-review review-table mb-0" id="table_achievements">
                      <thead>
                        <tr>
                          <th style="width:40px;">#</th>
                          <th>Part</th>
                          <th>Fault</th>
                          <th>Work done</th>
                          <th style="width: 64px;"><button type="button" class="btn btn-primary btn-add-row"><i class="feather-plus"></i></button></th>
                        </tr>
                      </thead>
                      <tbody id="table_achievements_tbody">
                        <tr>
                          <td>1</td>
                          <td><input type="text" required class="form-control"></td>
                          <td><input type="text" required class="form-control"></td>
                          <td><input type="text" required class="form-control"></td>
                          <td></td>
                        </tr>
                       
                        
                      </tbody>
                    </table>

                    <table class="table mt-2 table-bordered table-review review-table">
                      <tbody>
                         <tr >
                          <!-- <td>2</td> -->
                          <td ><textarea class="form-control" placeholder="Recommendation" style="min-height: 200px"></textarea></td>
                        </tr>
                       

                      </tbody>
                      <tfoot>
                         <tr class="">
                          <td>
                            <!-- <input type="submit" value="Submit Report" class="btn btn-primary btn-sm float-right"> -->
                            <button type="submit" class="btn btn-outline-primary mr-1 mb-1 float-right" id="type-success">Submit Report</button>
                            <!-- <button type="button" class="btn btn-outline-primary" id="shake-animation">Shake</button> -->
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </form>
          </section>

  </div>
  <!-- Content wrapper end -->


</div>
<!-- *************
        ************ Main container end *************
        ************* -->

<?php include(SHARED_PATH . '/admin_footer.php'); ?> 

<script type="text/javascript" src="<?php echo url_for('js/sweetalert2.all.min.js') ?>"></script>
<!-- BEGIN: Page JS-->
<!-- <script src="<?php //echo url_for('js/sweet-alerts.min.js') ?>"></script> -->
<!-- END: Page JS-->
<script>
    $(function () {
      $(document).on("click", '.btn-add-row', function () {
        var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
        console.log(id);
        var div = $("<tr />");
        div.html(GetDynamicTextBox(id));
        $("#"+id+"_tbody").append(div);
      });
      $(document).on("click", "#comments_remove", function () {
        $(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="feather-trash"></i></button>');
        $(this).closest("tr").remove();
      });
      function GetDynamicTextBox(table_id) {
        $('#comments_remove').remove();
        var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
        return '<td>'+rowsLength+'</td>' + '<td><input type="text" required name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" required name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" required name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="feather-trash"></i></button></td>'
      }
    });

    // --- End --- //

    function alert(){
      
     }
     $("#type-success").on("click", function () {

        Swal.fire({
          title: "Report Submitted Successfully!",
          type: "success",
          html: 'Would you like to send an <b>sms or email</b> to the Customer ?',
          showCloseButton: !0,
          showCancelButton: !0,
          focusConfirm: !1,
          confirmButtonText: '<a href="https://pixinvent.com/" target="_blank"><i class="fa fa-thumbs-up"></i> Yes!</a>',
          confirmButtonAriaLabel: "Thumbs up, great!",
          cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
          cancelButtonAriaLabel: "Thumbs down",
          confirmButtonClass: "btn btn-primary",
          buttonsStyling: !1,
          cancelButtonClass: "btn btn-danger ml-1"
        });
      // if(){

      // }else{
      //   alert();
      // }
   });

   
    
    </script>