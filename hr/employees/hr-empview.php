<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Employees View';
include(SHARED_PATH . '/header.php');
$all = Employee::find_by_undeleted(['order' => 'ASC']);
$my_id = !empty($all) ?? array_values($all)[0]->id;
$id = $_GET['id'] ?? $my_id;


$employee = Employee::find_by_id($id);

$education = EmployeeEducation::find_by_employee_id($id);
$experience = EmployeeExperience::find_by_employee_id($id);

if (!empty($employee->photo)) {
   $profile_picture = url_for('assets/uploads/profiles/' . $employee->photo);
} else {
   if (isset($employee->gender) && $employee->gender == 'Male') {
      $profile_picture = url_for('assets/images/users/male.jpg');
   } else {
      $profile_picture = url_for('assets/images/users/female.jpg');
   }
}

$select2 = '';
?>

<link rel="stylesheet" href="<?php echo url_for('assets/plugins/rating/css/ratings.css') ?>">
<link rel="stylesheet" href="<?php echo url_for('assets/plugins/rating/css/rating-themes.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo url_for('assets/css/viewemp.css')  ?>">

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">View Employee</h4>
   </div>

   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-center">
         <!-- <a href="<?php //echo url_for('employees/hr-addemployee.php') 
                        ?>" class="btn btn-sm btn-primary me-3">Add New Employee</a> -->

         <select class="select2" data-placeholder="Select Employee" id="query_employee">
            <option label="Select Employee"></option>
            <?php foreach ($all as $value) : ?>
               <option value="<?php echo $value->id ?>" <?php echo $id == $value->id ? 'selected' : '' ?>><?php echo ucwords($value->full_name()) ?></option>
            <?php endforeach; ?>
         </select>

         <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right ms-4 d-none">
            <div class="btn-list"> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
         </div>
      </div>
   </div>
</div>


<div class="content container-fluid" id="load_empview">
   <!-- //? AJAX CALL -->
</div>


<?php include(SHARED_PATH . '/footer.php') ?>


<script>
   $(document).ready(function() {
      const EMP_VIEW_URL = "./inc/get_empview.php";

      const getEmployees = async () => {
         let emp_id = $("#query_employee").val()
         let data = await fetch(EMP_VIEW_URL + '?employeeId=' + emp_id + '&get_empview')
         let res = await data.text();

         $('#load_empview').html(res);
      }

      getEmployees();
      $('#query_employee').select2().on("change", getEmployees);
   });
</script>