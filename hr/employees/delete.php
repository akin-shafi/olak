<?php
require_once('../private/initialize.php');

require_login();

if (!isset($_GET['emp_id'])) {
  redirect_to(url_for('/employees/hr-emplist.php'));
}
$emp_id = $_GET['emp_id'];
$demployee = Employee::find_by_id($emp_id);
// pre_r($demployee);

if ($demployee == false) {
  redirect_to(url_for('/employees/hr-emplist.php'));
}

if (is_post_request()) {

  // logfile
  log_action('Delete employee', "emp_id: {$demployee->emp_id}, Deleted by {$loggedInAdmin->full_name()}", "employee");

  // Delete employee
  $result = $demployee->deleted($emp_id);
  $session->message('The employee was deleted successfully.');
  redirect_to(url_for('/employees/hr-emplist.php'));
} else {
  // Display form
}


$page = 'Employees';
$page_title = 'Delete Employees';

include(SHARED_PATH . '/header.php');

 ?>

 <div class="content-wrapper ">

 	<div class="page-header d-xl-flex d-block">
	   <div class="page-leftheader">
	      <h4 class="page-title"><?php echo $page_title ?></h4>
	   </div>

	   <div class="page-rightheader ms-md-auto d-none">
	      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
	         <div class="btn-list">
	            <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> 

	            <button class="btn btn-light d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button>

	             <button class="btn btn-primary d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
	         </div>
	      </div>
	   </div>
	</div>

    <div class="card text-center p-4">
	    <!-- <h1>Delete employee</h1> -->
	    <p>Are you sure you want to delete this employee ?</p>
	    <p class="item"><?php echo h($demployee->first_name. " " . $demployee->last_name); ?></p>

	    <form action="<?php echo url_for('/employees/delete.php?emp_id=' . h(u($emp_id))); ?>" method="post">
	      <div id="operations" class="btn-group">
	        <input type="submit" name="commit" class="btn btn-sm btn-danger border-0" value="Yes" />
	        <a href="<?php echo url_for('/employees/hr-emplist.php'); ?>" class="btn btn-sm btn-dark">No</a>
	      </div>
	    </form>
	  </div>

  </div>

<?php include(SHARED_PATH . '/footer.php'); ?>


