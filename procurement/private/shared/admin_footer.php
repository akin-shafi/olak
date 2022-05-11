<footer class="iq-footer">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <ul class="list-inline mb-0">
              <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
              <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
            </ul>
          </div>
          <div class="col-lg-6 text-right">
            <span class="mr-1">
              <script>
                document.write(new Date().getFullYear())
              </script>©
            </span> <a href="#" class="">Sandsify Systems</a>.
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="<?php echo url_for('js/jquery.min.js') ?>"></script>
<script src="<?php echo url_for('js/backend-bundle.min.js') ?>"></script>

<script src="<?php echo url_for('js/table-treeview.js') ?>"></script>

<script src="<?php echo url_for('js/customizer.js') ?>"></script>

<script async src="<?php echo url_for('js/chart-custom.js') ?>"></script>

<!-- <script src="<?php //echo url_for('js/select2.min.js') 
                  ?>"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script src="<?php echo url_for('js/app.js') ?>"></script>


<script>
  // $('.select2').select2({
  //   // theme: "classic",
  //   theme: "bootstrap-5"
  // });

  function numberWithCommas(params) {
    return params.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }


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


</body>

</html>