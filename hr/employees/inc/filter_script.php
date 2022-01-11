<?php
require_once('../../private/initialize.php');


if (is_get_request()) {
  if (isset($_GET['query'])) {
    $id = $_GET['employee_id'];
    $name = $_GET['name'];
    $designate = $_GET['designate'];

    $employees = Employee::find_by_query(['employee_id' => $id, 'name' => $name, 'designate' => $designate]);

    if (empty($employees)) :
      echo '<h3 class="text-center text-danger mt-5">No Record Found!</h3>';
    else :


      foreach ($employees as $employee) :
        $departmentName = Department::find_by_id($employee->department_id)->department_name;
        $designationName = Designation::find_by_id($employee->designation_id)->designation_name;
?>
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
          <div class="profile-widget">
            <div class="profile-img">
              <a href="profile.php" class="avatar">
                <img src="<?php echo url_for('/assets/uploads/' . $employee->photo); ?>" alt=""></a>
            </div>
            <div class="dropdown profile-action employee_list">
              <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#" data-id="<?php echo $employee->id ?>" id="edit-employee-btn"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                <a class="dropdown-item" href="#" data-id="<?php echo $employee->id ?>" id="delete-employee-btn"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
              </div>
            </div>
            <h4 class="user-name m-t-10 mb-0 text-ellipsis">
              <a href="profile.php"><?php echo ucwords($employee->full_name()); ?></a>
            </h4>
            <div class="small text-muted">
              <?php echo ucwords($departmentName); ?>
              <?php echo '(' . strtoupper($employee->employee_id) . ')'; ?>
            </div>
          </div>
        </div>
<?php endforeach;

    endif;
  }
}
