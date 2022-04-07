<?php require_once('../../private/initialize.php') ?>


<?php include(SHARED_PATH . '/auth_header.php') ?>

<!-- Container start -->
<div class="container">

  <form action="index.html">
    <div class="row justify-content-md-center">
      <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
        <div class="login-screen">
          <div class="login-box">
            <a href="#" class="login-logo">
              <span class="text-danger">R</span><span class="text-warning">e</span><span class="text-success">t</span><span class="text-info">a</span><span class="text-royal-orange">i</span><span class="text-jungle-green">l</span>
            </a>
            <h5 class="mr-5">In order to access your dashboard, please enter the email id you provided during the registration process.</h5>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Enter Email Address" />
            </div>
            <div class="actions">
              <button type="submit" class="btn btn-danger btn-lg">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

</div>
<!-- Container end -->

<?php include(SHARED_PATH . '/auth_footer.php') ?>