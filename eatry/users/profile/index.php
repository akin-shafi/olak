<?php require_once('../../private/initialize.php');
$page_title = 'Profile';
$page = 'Profile';

require_login();

$id = $_GET['id'] ?? $loggedInAdmin->id;
$admin = Admin::find_by_id($id);


if (is_post_request()) {

  // Save record using post parameters
  $args = $_POST['admin'];
  // pre_r($args);
  $admin->merge_attributes($args);
  $result = $admin->save();

  if ($result === true) {

    // logfile
    log_action('Edit Admin', "id: {$admin->id}, Editted by {$loggedInAdmin->full_name()}", "admin");

    $session->message('The admin was updated successfully.');
    // redirect_to(url_for('/users/profile/show.php?id=' . $id));
  } else {
    // show errors
  }
} else {

  // display the form
}

include(SHARED_PATH . '/header.php'); ?>

<div class="content-wrapper">
   <section class="content-header">
      <h1><?php echo $page_title ?></h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">user</li>
      </ol>
   </section>
   <div class="col-lg-12 alerts">
      <?php echo display_session_message(); ?>
      
    </div>
   <section class="content">
      <div class="row">
        <?php include('form_field.php'); ?>
      </div>
   </section>
</div>

 
<?php include(SHARED_PATH . '/footer.php'); ?>
