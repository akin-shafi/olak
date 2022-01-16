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
        <div class="d-flex align-items-center mb-5">
          <div class="profile-image mr-4">
            <img class="img-lg rounded-circle" src="<?php echo url_for('assets/uploads/' . $user->photo); ?>" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>

          <div class="row w-100">
            <div class="col-md-9 d-flex align-items-center">
              <h3 class="font-weight-bolder mr-3 mb-0">
                <?php echo ucwords($user->full_name()); ?>
              </h3>
              <span class="badge text-light" style="background: #15C327;">Active</span>
            </div>
            <div class="col-md-3">
              <button class="btn btn-sm btn-outline-secondary d-block ml-auto">
                <span class="icon-note"></span> Edit</button>
            </div>

            <div class="col-md-2">
              <p class="mb-0">
                <span class="badge text-light" style="background: #759DD9;">
                  <?php echo ucwords($departmentName); ?></span>
              </p>
            </div>
            <div class="col-md-10">
              <p class="mb-0"><?php echo ucwords($designationName); ?></p>
            </div>

            <div class="col-md-2">
              <p class="font-weight-bold mb-0">
                <?php echo ucwords($user->employee_id); ?>
              </p>
            </div>
            <div class="col-md-10">
              <p class="mb-0"><?php echo strtolower($user->email); ?></p>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- Nav tabs -->
          <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Messages</button>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab"> home </div>
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab"> profile </div>
            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab"> messages </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include('../inc/modal/all.php');  ?>
<?php include(SHARED_PATH . '/employee_footer.php');  ?>