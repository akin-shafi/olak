<?php
require_once('../private/initialize.php');

$user = Employee::find_by_id($loggedInAdmin->id);
$designationName = Designation::find_by_id($user->designation_id)->designation_name;
$departmentName = Department::find_by_id($user->department_id)->department_name;
$employmentType = Employee::EMPLOYMENT_TYPE[$user->employment_type] ?? '';

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
        <div class="d-flex align-items-center mb-4">
          <div class="profile-image mr-3">
            <img class="img-lg rounded-circle" src="<?php echo url_for('assets/uploads/' . $user->photo); ?>" alt="profile image">
            <div class="dot-indicator bg-success"></div>
          </div>

          <div class="w-50" style="color: #0A3069;">
            <div class="d-flex">
              <h5 class="font-weight-bolder mr-3 mb-0 ">
                <?php echo ucwords($user->full_name()); ?>
              </h5>
              <p class="mt-1 badge text-light d-none d-sm-block" style="background: #15C327;">Active</p>
            </div>
            <div class="row">
              <p class="col-md-6 mb-0">
                <span class="badge text-light" style="background: #759DD9;">
                  <?php echo ucwords($departmentName); ?></span>
              </p>
              <p class="col-md-6 mb-0"><?php echo ucwords($designationName); ?></p>
            </div>
            <div class="row">
              <p class="font-weight-bold col-md-6 mb-0">
                <?php echo ucwords($user->employee_id); ?>
              </p>
              <p class="col-md-6 mb-0"><?php echo strtolower($user->email); ?></p>
            </div>
          </div>

          <button class="btn btn-sm btn-outline-dark d-block ml-auto mb-auto">
            <span class="icon-note"></span> <span class="d-none d-sm-inline-block">Edit</span></button>
        </div>

        <div class="row">
          <ul class="nav nav-pills nav-pills-custom" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link nav-link-custom active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">
                General Information</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link nav-link-custom" id="user-document-tab" data-bs-toggle="tab" data-bs-target="#user-document" type="button" role="tab" aria-controls="user-document" aria-selected="false">Documents</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link nav-link-custom" id="loan-info-tab" data-bs-toggle="tab" data-bs-target="#loan-info" type="button" role="tab" aria-controls="loan-info" aria-selected="false">Loan Request</button>
            </li>
          </ul>

          <div class="tab-content my-4">
            <div class="tab-pane active" id="general" role="tabpanel" aria-labelledby="general-tab">
              <div class="row">
                <div class="col-md-6">
                  <div class="grid-gen">
                    <p style="color:#759DD9">Gender</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo ucwords($user->gender) ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Date of Birth</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->dob != '0000-00-00'
                        ? date('Y/m/d', strtotime($user->dob)) : 'Not Set' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Country</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->country ? ucwords($user->country) : 'Not Set' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">State</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->state ? ucwords($user->state) : 'Not Set' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Address</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->address ? ucwords($user->address) : 'Block 12, Flat 5, Iponri Housing Estate, Surulere, Lagos' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Marital Status</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->marital_status ? ucwords($user->marital_status) : 'Not Set' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Religion</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->religion ? ucwords($user->religion) : 'Not Set' ?></p>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="grid-gen">
                    <p style="color:#759DD9">Employment Start</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->date_employed != '0000-00-00'
                        ? date('Y/m/d', strtotime($user->date_employed)) : 'Not Set' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Employment Type</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->employment_type ? ucwords($employmentType) : 'Not Set' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Department</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->department_id ? ucwords($departmentName) : 'Not Set' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Designation</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->designation_id ? ucwords($designationName) : 'Block 12, Flat 5, Iponri Housing Estate, Surulere, Lagos' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Employee ID</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->employee_id ? strtoupper($user->employee_id) : 'Not Set' ?></p>
                  </div>
                  <div class="grid-gen">
                    <p style="color:#759DD9">Station</p>
                    <p class="font-weight-bold text-start" style="color:#0A3069;">
                      <?php echo $user->location ? ucwords($user->location) : 'Not Set' ?></p>
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane" id="user-document" role="tabpanel" aria-labelledby="user-document-tab">
              <div class="table-responsive">

                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>sch leaving cert.pdf wednesday 12, 2021 09:30am</td>
                      <td class="text-danger">
                        <a href="#">
                          <img class="rounded-0" style="width: 20px!important;height: 20px!important;" src="<?php echo url_for('images/download.png'); ?>" alt="download">
                        </a>
                      </td>
                      <td>
                        <div class="dropdown">
                          <a class="btn dropdown-toggle" type="button" id="moreAction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon-options"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="moreAction">
                            <a class="dropdown-item" href="#">
                              <span class="icon-note"></span> Edit</a>
                            <a class="dropdown-item" href="#">
                              <span class="icon-trash"></span> Delete</a>
                          </div>
                        </div>

                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="tab-pane" id="loan-info" role="tabpanel" aria-labelledby="loan-info-tab">
              loan-info
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include('../inc/modal/all.php');  ?>
<?php include(SHARED_PATH . '/employee_footer.php');  ?>