<?php

require_once('../../../private/initialize.php');

require_login();

// $errors = [];

// if(!isset($_GET['id'])) {
//   redirect_to(url_for('/staff/admins/index.php'));
// }

// $id = $_GET['id'] ?? $loggedInAdmin->id;
$admin = Admin::find_by_id($loggedInAdmin->id);

if($admin == false) {
  redirect_to(url_for('/staff/transactions/'));
}

if(is_post_request()) { 

  // Save record using post parameters
  $oldpwd = $_POST['oldpwd'] ?? '';
  $newpwd = $_POST['newpwd'] ?? '';
  $confirmnewpwd = $_POST['confirmnewpwd'] ?? '';

  if (is_blank($oldpwd) || is_blank($newpwd) || is_blank($confirmnewpwd)) {
    $errors[] = "Kindly fill all the entry of the form!";
  }

  if ($admin->verify_password($oldpwd)) {

        $args['password'] = $newpwd;
        $args['confirm_password'] = $confirmnewpwd;
        $admin->merge_attributes($args);
        $result = $admin->save();


        if($result === true) {
      
           // logfile
          log_action('Edit Admin', "id: {$admin->id}, {$loggedInAdmin->full_name()} change his/her Password", "admin");
          
          $session->message('Password changed successfully.');
          redirect_to(url_for('/staff/transactions/'));
          
        } else {
          // $errors[] = "Opss! Try Again later";
          // print_r($admin->errors);
          // show errors
        }
    
  }else{
    $admin->errors[] = "Incorrect Current Password";
  }

} else {

  // display the form

}

?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<dl class="d-flex justify-content-center mt-2">
  <div class="btn-group">
    <a class="btn btn-navy" href="<?php echo url_for('/staff/transactions/'); ?>">&laquo; Back to List</a>
    <span class="btn btn-outline-navy"><?php echo $page_title; ?></span>
  </div>

</dl>

<div id="content" class="container">

  <div class=" p-2"> 
    <!-- <div class="card-header">
      <h4 class="mb-0">EDIT ADMIN</h4>
    </div> -->

    <div class="text-danger text-center d-flex justify-content-center"><?php echo display_errors($admin->errors); ?></div>
    <!-- <div class="card-body"></div> -->

      <form class="form" method="post">

        <section class=" rounded box-shadow border">
          <div class="table-responsive p-1">
            <div class="bg-orange text-white p-2"><i class="fas fa-dolly">Change Password</i></div>
            <section class="container p-4">
              <div id="content" class="p-2 alert-light">
                <section class="">
                  <form method="POST" class="form-group">
                    <p>Current Password : <input class="form-control" type="password" name="oldpwd" required value="<?php echo $oldpwd ?? ''; ?>"></p>
                    <p>New Password : <input class="form-control" type="password" name="newpwd" required value="<?php echo $newpwd ?? ''; ?>"></p>
                    <p>Confirm New Password : <input class="form-control" type="password" name="confirmnewpwd" required value="<?php echo $confirmnewpwd ?? ''; ?>"></p>
                    <p><input  class="btn btn-success" type="submit" name="changepwd" value="Change Password"> </p>
                  </form>
                </section>
              </div>
            </section>
          </div>
        </section>
      </form> 
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
