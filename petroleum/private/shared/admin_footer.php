    </div>
    <!-- *************
        ************ Main container end *************
      ************* -->

    <!-- Footer start -->
    <footer class="main-footer">© Olak Pet <?php echo date('Y') ?></footer>
    <!-- Footer end -->

    </div>
    <!-- Container fluid end -->
    <!-- *************
      ************ Required JavaScript Files *************
    ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="<?php echo url_for('js/jquery.min.js') ?>"></script>
    <script src="<?php echo url_for('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo url_for('js/moment.js') ?>"></script>

    <script src="<?php echo url_for('js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?php echo url_for('js/sweet.js') ?>"></script>
    <script type="text/javascript">
      // Alert
      function confirmAlert(title, msg) {
        $(".msgTitle").html(title);
        $("#displayMsg").html(msg);
        $("#confirmModal").modal("show");
      }

      function successAlert(msg) {
        Swal.fire({
          title: msg,
          type: "success",
          showCloseButton: !1,
          focusConfirm: !1,
          confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
          confirmButtonAriaLabel: "Thumbs up, great!",
          confirmButtonClass: "btn btn-primary",
          buttonsStyling: !1,
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
          timer: 1500,
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
          timer: 1500,
          confirmButtonClass: "btn btn-primary",
          buttonsStyling: !1
        })
      }
    </script>

    <!-- *************
      ************ Vendor Js Files *************
    ************* -->
    <!-- Slimscroll JS -->
    <script src="<?php echo url_for('js/slimscroll.min.js') ?>"></script>
    <script src="<?php echo url_for('js/custom-scrollbar.js') ?>"></script>

    <!-- Daterange -->
    <script src="<?php echo url_for('js/daterange.js') ?>"></script>
    <script src="<?php echo url_for('js/custom-daterange.js') ?>"></script>

    <!-- Chartist JS -->
    <script src="<?php //echo url_for('js/chartist.min.js') 
                  ?>"></script>
    <script src="<?php //echo url_for('js/chartist-tooltip.js') 
                  ?>"></script>
    <script src="<?php //echo url_for('js/threshold.js') 
                  ?>"></script>
    <script src="<?php //echo url_for('js/bar-chart-orders.js') 
                  ?>"></script>

    <!-- jVector Maps -->
    <script src="<?php echo url_for('js/jquery-jvectormap-2.0.3.min.js') ?>"></script>
    <script src="<?php echo url_for('js/world-mill-en.js') ?>"></script>
    <script src="<?php echo url_for('js/gdp-data.js') ?>"></script>
    <script src="<?php echo url_for('js/world-map-markers2.js') ?>"></script>

    <!-- Rating JS -->
    <script src="<?php echo url_for('js/raty.js') ?>"></script>
    <script src="<?php echo url_for('js/raty-custom.js') ?>"></script>

    <!-- Data Tables -->
    <script src="<?php echo url_for('js/datatables.min.js') ?>"></script>
    <script src="<?php echo url_for('js/datatables.bootstrap.min.js') ?>"></script>

    <!-- Custom Data tables -->
    <script src="<?php echo url_for('js/custom-datatables.js') ?>"></script>
    <script src="<?php echo url_for('js/fixedheader.js') ?>"></script>

    <!-- Download / CSV / Copy / Print -->
    <script src="<?php echo url_for('js/buttons.min.js') ?>"></script>
    <script src="<?php echo url_for('js/jszip.min.js') ?>"></script>
    <script src="<?php echo url_for('js/pdfmake.min.js') ?>"></script>
    <script src="<?php echo url_for('js/vfs_fonts.js') ?>"></script>
    <script src="<?php echo url_for('js/html5.min.js') ?>"></script>
    <script src="<?php echo url_for('js/buttons.print.min.js') ?>"></script>

    <!-- Main Js Required -->
    <script src="<?php echo url_for('js/main.js') ?>"></script>

    </body>

    </html>