 </div>
 <?php //include('../inc/modal/all.php');  
   ?>
 <footer>
    <div class="text-white text-center pb-3">
       &copy; <?php echo date('Y') ?> All-Right Reserved
    </div>
 </footer>
 <!-- Required jQuery first, then Bootstrap Bundle JS -->
 <!-- <script src="<?php //echo url_for('js/jquery.min.js') 
                     ?>"></script> -->
 <script src="<?php echo url_for('js/bootstrap.bundle.min.js') ?>"></script>
 <script src="<?php echo url_for('js/nav.min.js') ?>"></script>
 <script src="<?php echo url_for('js/moment.js') ?>"></script>
 <script src="<?php echo url_for('js/bootstrap-datetimepicker.min.js') ?>"></script>

 <!-- Select2 -->
 <script src="<?php echo url_for('plugins/select2/js/select2.full.min.js'); ?>"></script>

 <!-- Daterange -->
 <script src="<?php echo url_for('vendor/daterange/daterange.js') ?>"></script>

 <!-- Apex Charts -->
 <!-- <script src="<?php //echo url_for('vendor/apex/apexcharts.min.js') 
                     ?>"></script>
    <script src="<?php //echo url_for('vendor/apex/custom/apexLineChartGradient.js') 
                  ?>"></script>
    <script src="<?php //echo url_for('vendor/apex/custom/apexColumnBasic.js') 
                  ?>"></script>
    <script src="<?php //echo url_for('vendor/apex/custom/apexAllCustomGraphs.js') 
                  ?>"></script> -->

 <!-- Data Tables -->
 <script src="<?php echo url_for('vendor/datatables/dataTables.min.js') ?>"></script>
 <script src="<?php echo url_for('vendor/datatables/dataTables.bootstrap.min.js') ?>"></script>

 <!-- Custom Data tables -->
 <script src="<?php echo url_for('vendor/datatables/custom/custom-datatables.js') ?>"></script>
 <script src="<?php echo url_for('vendor/datatables/custom/fixedHeader.js') ?>"></script>

 <!-- Main Js Required -->
 <script src="<?php echo url_for('js/main.js') ?>"></script>

 <script type="text/javascript">
    $('.select2').select2({
       theme: "classic",
       // theme: 'bootstrap4'
    });
 </script>

 <script src="<?php echo url_for('js/sweetalert2.all.min.js') ?>"></script>
 <!-- <script src="<?php //echo url_for('js/sweet.js') 
                     ?>"></script> -->
 <script type="text/javascript">
    function successAlert(msg) {
       Swal.fire({
          title: msg,
          type: "success",
          // html: 'Would you like to send an <b>sms or email</b> to the Customer ?',
          showCloseButton: !1,
          // showCancelButton: !0,
          focusConfirm: !1,
          confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
          confirmButtonAriaLabel: "Thumbs up, great!",
          // cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
          // cancelButtonAriaLabel: "Thumbs down",
          confirmButtonClass: "btn btn-primary",
          buttonsStyling: !1,
          // cancelButtonClass: "btn btn-danger ml-1"
       });
    }

    function successTime(msg) {
       Swal.fire({
          position: 'bottom-end',
          type: "success",
          title: msg,
          showConfirmButton: !1,
          timer: 1000,
       })
    }

    function errorAlert(msg) {
       Swal.fire({
          title: msg,
          type: "error",
          showCloseButton: !1,
          timer: 3000,
          showCancelButton: !1,
          confirmButtonClass: "btn btn-primary",
          buttonsStyling: !1,
       });
    }

    function errorTime(msg) {
       Swal.fire({
          position: "center",
          type: "error",
          title: msg,
          showConfirmButton: !1,
          timer: 5000,
          confirmButtonClass: "btn btn-primary",
          buttonsStyling: !1
       })
    }
 </script>

 </body>

 </html>