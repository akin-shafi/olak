<?php
require_once('../private/initialize.php');

$user = Employee::find_by_id($loggedInAdmin->id);
$designationName = Designation::find_by_id($user->designation_id)->designation_name;
$departmentName = Department::find_by_id($user->department_id)->department_name;


$id = $loggedInAdmin->id;
$employee = Employee::find_by_id($id);


$employeeInfo = EmployeeDetail::find_by_employee_id($id) ?? '';
$shortTerm = EmployeeLoan::find_by_employee_id($id, ['type' => 1]) ?? '';
$salary = Salary::find_by_employee_id($id);

$page = 'Profile';
$page_title = 'Employee | Profile';

?>

<?php include(SHARED_PATH . '/employee_header.php');  ?>
<?php include(SHARED_PATH . '/side-nav.php');  ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="card shadow">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="profile-image mr-4">
            <img class="img-lg rounded-circle" src="<?php echo url_for('assets/uploads/' . $user->photo); ?>" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>
          <div class="text-wrapper">
            <div class="d-flex align-items-center">
              <h3 class="font-weight-bolder mr-3 mb-0">
                <?php echo ucwords($user->full_name()); ?>
              </h3>
              <span class="badge badge-success">Active</span>
            </div>
            <div class="row">
              <div class="col-md-6">
                <p class="mb-0">
                  <span class="badge badge-info"><?php echo ucwords($departmentName); ?></span>
                </p>
              </div>
              <div class="col-md-6">
                <p class="mb-0"><?php echo ucwords($designationName); ?></p>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <p class="font-weight-bold mb-0">
                  <?php echo ucwords($user->employee_id); ?>
                </p>
              </div>
              <div class="col-md-6">
                <p class="mb-0"><?php echo strtolower($user->email); ?></p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include('../inc/modal/all.php');  ?>
<?php include(SHARED_PATH . '/employee_footer.php');  ?>