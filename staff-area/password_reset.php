<?php
require_once('private/initialize.php');

$user = $loggedInAdmin;

if (is_post_request()) {

  $employee = Employee::find_by_id($user->id);

  $args = $_POST['change'];
  $args['update_profile'] = 1;

  if (is_blank($args['password'])) {
    http_response_code(404);
    exit(json_encode(['errors' => "Password cannot be blank."]));
  }
  if ($args['password'] !== $args['confirm_password']) {
    http_response_code(404);
    exit(json_encode(['errors' => "Password not well matched."]));
  }

  $employee->merge_attributes($args);
  $employee->save();

  http_response_code(200);
  exit(json_encode(['message' => 'Profile updated successfully!']));

  log_action('Employee Password Changed', "{$employee->full_name()} Update password.", "Updated Password");
  redirect_to(url_for('/dashboard'));
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome | IMS </title>
  <link rel="stylesheet" type="text/css" href="<?php echo url_for('../style.css') ?>">
  <link rel="stylesheet" href="../bootstrap.css">
  <link rel="shortcut icon" type="image/x-icon" href="../favicon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;500&family=Poppins:wght@200;300;500&display=swap" rel="stylesheet">

</head>

<body>
  <style>
    .grid-container {
      height: auto;
    }
  </style>
  <div class="container shadow olak bg-white my-5">
    <header class="welcome pt-3">
      <div class="welcome-box">
        <img src="../images/blue-top-right.png" title="Welcome" alt="Welcome">
      </div>
    </header>

    <main class="container grid-container">
      <div class="row">

        <aside class="col-md-6 grid aside-left">
          <div class="login-box mt-3">
            <div class="login-header mb-5 text-center">
              <h2 class="custom-blue">Welcome <?php echo $user->full_name() ?></h1>
                <h5 class="custom-blue">Kindly confirm your details and <strong class="text-danger">RESET YOUR PASSWORD</strong></h5>
            </div>

            <div class="login-body">
              <div id="alertMsg"></div>
              <form id="password_reset_form">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="change[first_name]" class="form-control" value="<?php echo $user->first_name; ?>" placeholder="Enter first name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="change[last_name]" class="form-control" value="<?php echo $user->last_name; ?>" placeholder="Enter last name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="change[email]" class="form-control" value="<?php echo $user->email; ?>" placeholder="Enter email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="change[phone]" class="form-control" value="<?php echo $user->phone; ?>" placeholder="Enter phone">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label">New Password <span class="text-danger">*</span></label>
                        <input type="password" name="change[password]" class="form-control" placeholder="password" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                        <input type="password" name="change[confirm_password]" class="form-control" placeholder="Confirm New Password" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Present Address</label>
                        <textarea name="change[present_add]" id="present_add" rows="3" class="form-control" placeholder="Address1"><?php echo $user->present_add ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Next of Kin Name</label>
                        <input type="text" name="change[kin_name]" id="kin_name" value="<?php echo $user->kin_name; ?>" class="form-control" placeholder="Next of Kin Name">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Next of Kin Number</label>
                        <input type="text" name="change[kin_phone]" id="kin_phone" value="<?php echo $user->kin_phone; ?>" class="form-control" placeholder="Contact Number">
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn bg-custom-blue text-light my-4 w-100" id="submit">
                    Update your profile</button>
                </div>
              </form>

              <div class="text-center">
                <a href="../" class="text-decoration-none">&leftarrow; Back</a>
              </div>
            </div>
          </div>
        </aside>
        <aside class="col-md-6 grid aside-right">
          <img src="../images/reset-splash.png" class="hidden-xs img-fluid" title="banner balance" alt="banner balance">
        </aside>
      </div>
    </main>
    <div class="d-flex justify-content-end align-items-center pb-4">
      <a href="#" class="custom-blue text-decoration-none">Developed by <strong>Sandsify Systems</strong></a>
    </div>
  </div>

  <script src="<?php echo url_for('assets/plugins/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo url_for('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
  <!-- <script src="<?php //echo url_for('assets/js/bootstrap.bundle.min.js') 
                    ?>"></script> -->
</body>

</html>


<script>
  $(document).ready(function() {

    const message = (type, payload) => {
      let msg = '<div class="alert alert-' + type + ' text-center" role="alert">' + payload + '</div>';
      $('#alertMsg').html(msg);
      setTimeout(() => {
        $('#alertMsg').html('');
        window.location = './dashboard';
      }, 1500);
    }

    const submitForm = async (url, payload) => {
      const formData = new FormData(payload);

      const data = await fetch(url, {
        method: "POST",
        body: formData,
      });

      const res = await data.json();

      if (res.errors) message('danger', res.errors);
      if (res.message) message('success', res.message);
    };

    const resetForm = document.getElementById("password_reset_form");

    resetForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      submitForm('./password_reset.php', resetForm);
    });
  })
</script>