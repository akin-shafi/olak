<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Employees View';
include(SHARED_PATH . '/header.php');
$all = Employee::find_by_undeleted(['order' => 'ASC']);
$my_id = array_values($all)[0]->id;
$id = $_GET['id'] ?? $my_id;



$employee = Employee::find_by_id($id);


if (!empty($employee->photo)) {
   $profile_picture = url_for('assets/uploads/profiles/' . $employee->photo);
} else {
   if ($employee->gender == 'male') {
      $profile_picture = url_for('assets/images/users/male.jpg');
   } else {
      $profile_picture = url_for('assets/images/users/female.jpg');
   }
}

$select2 = '';
?>

<link rel="stylesheet" href="<?php echo url_for('assets/plugins/rating/css/ratings.css') ?>">
<link rel="stylesheet" href="<?php echo url_for('assets/plugins/rating/css/rating-themes.css') ?>">
<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">View Employee</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-center">
         <!-- <div class="add">Add New Employee</div> -->
         <a href="<?php echo url_for('employees/hr-addemployee.php') ?>" class="btn btn-primary me-3">Add New Employee</a>
         <select  name="query[employee_id]" class="select2" data-placeholder="Select Employee" id="query_employee">
            <option label="Select Employee"></option>
            <?php foreach (Employee::find_by_undeleted() as $value) : ?>
               <option value="<?php echo $value->id ?>"><?php echo ucwords($value->full_name()) ?></option>
            <?php endforeach; ?>
         </select>

         <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right ms-4 d-none">
            <div class="btn-list"> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
         </div>
      </div>
   </div>
</div>


<div class="content container-fluid">
  
   <div class="card mb-0">
      <div class="card-body">
         <div class="row">
            <div class="col-md-12">
               <div class="profile-view">
                  <div class="profile-img-wrap">
                     <div class="profile-img">
                        <a href="#"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                     </div>
                  </div>
                  <div class="profile-basic">
                     <div class="row">
                        <div class="col-md-5">
                           <div class="profile-info-left">
                              <h3 class="user-name m-t-0 mb-0">John Doe</h3>
                              <h6 class="text-muted">UI/UX Design Team</h6>
                              <small class="text-muted">Web Designer</small>
                              <div class="staff-id">Employee ID : FT-0001</div>
                              <div class="small doj text-muted">Date of Join : 1st Jan 2013</div>
                              <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div>
                           </div>
                        </div>
                        <div class="col-md-7">
                           <ul class="personal-info">
                              <li>
                                 <div class="title">Phone:</div>
                                 <div class="text"><a href="">9876543210</a></div>
                              </li>
                              <li>
                                 <div class="title">Email:</div>
                                 <div class="text"><a href="">johndoe@example.com</a></div>
                              </li>
                              <li>
                                 <div class="title">Birthday:</div>
                                 <div class="text">24th July</div>
                              </li>
                              <li>
                                 <div class="title">Address:</div>
                                 <div class="text">1861 Bayonne Ave, Manchester Township, NJ, 08759</div>
                              </li>
                              <li>
                                 <div class="title">Gender:</div>
                                 <div class="text">Male</div>
                              </li>
                              <li>
                                 <div class="title">Reports to:</div>
                                 <div class="text">
                                    <div class="avatar-box">
                                       <div class="avatar avatar-xs">
                                          <img src="assets/img/profiles/avatar-16.jpg" alt="">
                                       </div>
                                    </div>
                                    <a href="profile.html">
                                    Jeffery Lalor
                                    </a>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="pro-edit"><a data-bs-target="#profile_info" data-bs-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="card tab-box mt-5">
      <div class="row user-tabs">
         <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
            <ul class="nav nav-tabs nav-tabs-bottom">
               <li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Profile</a></li>
               <li class="nav-item"><a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Projects</a></li>
               <li class="nav-item"><a href="#bank_statutory" data-bs-toggle="tab" class="nav-link">Bank &amp; Statutory <small class="text-danger">(Admin Only)</small></a></li>
            </ul>
         </div>
      </div>
   </div>
   <div class="tab-content">
      <div id="emp_profile" class="pro-overview tab-pane fade show active">
         <div class="row">
            <div class="col-md-6 d-flex">
               <div class="card profile-box flex-fill">
                  <div class="card-body">
                     <h3 class="card-title">Personal Informations <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h3>
                     <ul class="personal-info">
                        <li>
                           <div class="title">Passport No.</div>
                           <div class="text">9876543210</div>
                        </li>
                        <li>
                           <div class="title">Passport Exp Date.</div>
                           <div class="text">9876543210</div>
                        </li>
                        <li>
                           <div class="title">Tel</div>
                           <div class="text"><a href="">9876543210</a></div>
                        </li>
                        <li>
                           <div class="title">Nationality</div>
                           <div class="text">Indian</div>
                        </li>
                        <li>
                           <div class="title">Religion</div>
                           <div class="text">Christian</div>
                        </li>
                        <li>
                           <div class="title">Marital status</div>
                           <div class="text">Married</div>
                        </li>
                        <li>
                           <div class="title">Employment of spouse</div>
                           <div class="text">No</div>
                        </li>
                        <li>
                           <div class="title">No. of children</div>
                           <div class="text">2</div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-6 d-flex">
               <div class="card profile-box flex-fill">
                  <div class="card-body">
                     <h3 class="card-title">Emergency Contact <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a></h3>
                     <h5 class="section-title">Primary</h5>
                     <ul class="personal-info">
                        <li>
                           <div class="title">Name</div>
                           <div class="text">John Doe</div>
                        </li>
                        <li>
                           <div class="title">Relationship</div>
                           <div class="text">Father</div>
                        </li>
                        <li>
                           <div class="title">Phone </div>
                           <div class="text">9876543210, 9876543210</div>
                        </li>
                     </ul>
                     <hr>
                     <h5 class="section-title">Secondary</h5>
                     <ul class="personal-info">
                        <li>
                           <div class="title">Name</div>
                           <div class="text">Karen Wills</div>
                        </li>
                        <li>
                           <div class="title">Relationship</div>
                           <div class="text">Brother</div>
                        </li>
                        <li>
                           <div class="title">Phone </div>
                           <div class="text">9876543210, 9876543210</div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 d-flex">
               <div class="card profile-box flex-fill">
                  <div class="card-body">
                     <h3 class="card-title">Bank information</h3>
                     <ul class="personal-info">
                        <li>
                           <div class="title">Bank name</div>
                           <div class="text">ICICI Bank</div>
                        </li>
                        <li>
                           <div class="title">Bank account No.</div>
                           <div class="text">159843014641</div>
                        </li>
                        <li>
                           <div class="title">IFSC Code</div>
                           <div class="text">ICI24504</div>
                        </li>
                        <li>
                           <div class="title">PAN No</div>
                           <div class="text">TC000Y56</div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-6 d-flex">
               <div class="card profile-box flex-fill">
                  <div class="card-body">
                     <h3 class="card-title">Family Informations <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#family_info_modal"><i class="fa fa-pencil"></i></a></h3>
                     <div class="table-responsive">
                        <table class="table table-nowrap">
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Relationship</th>
                                 <th>Date of Birth</th>
                                 <th>Phone</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Leo</td>
                                 <td>Brother</td>
                                 <td>Feb 16th, 2019</td>
                                 <td>9876543210</td>
                                 <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                       <a aria-expanded="false" data-bs-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <a href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                          <a href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 d-flex">
               <div class="card profile-box flex-fill">
                  <div class="card-body">
                     <h3 class="card-title">Education Informations <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#education_info"><i class="fa fa-pencil"></i></a></h3>
                     <div class="experience-box">
                        <ul class="experience-list">
                           <li>
                              <div class="experience-user">
                                 <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                 <div class="timeline-content">
                                    <a href="#/" class="name">International College of Arts and Science (UG)</a>
                                    <div>Bsc Computer Science</div>
                                    <span class="time">2000 - 2003</span>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="experience-user">
                                 <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                 <div class="timeline-content">
                                    <a href="#/" class="name">International College of Arts and Science (PG)</a>
                                    <div>Msc Computer Science</div>
                                    <span class="time">2000 - 2003</span>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 d-flex">
               <div class="card profile-box flex-fill">
                  <div class="card-body">
                     <h3 class="card-title">Experience <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#experience_info"><i class="fa fa-pencil"></i></a></h3>
                     <div class="experience-box">
                        <ul class="experience-list">
                           <li>
                              <div class="experience-user">
                                 <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                 <div class="timeline-content">
                                    <a href="#/" class="name">Web Designer at Zen Corporation</a>
                                    <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="experience-user">
                                 <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                 <div class="timeline-content">
                                    <a href="#/" class="name">Web Designer at Ron-tech</a>
                                    <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="experience-user">
                                 <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                 <div class="timeline-content">
                                    <a href="#/" class="name">Web Designer at Dalt Technology</a>
                                    <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-pane fade" id="emp_projects">
         <div class="row">
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
               <div class="card">
                  <div class="card-body">
                     <div class="dropdown profile-action">
                        <a aria-expanded="false" data-bs-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                           <a data-bs-target="#edit_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                           <a data-bs-target="#delete_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                     </div>
                     <h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
                     <small class="block text-ellipsis m-b-15">
                     <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                     <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                     </small>
                     <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. When an unknown printer took a galley of type and
                        scrambled it...
                     </p>
                     <div class="pro-deadline m-b-15">
                        <div class="sub-title">
                           Deadline:
                        </div>
                        <div class="text-muted">
                           17 Apr 2019
                        </div>
                     </div>
                     <div class="project-members m-b-15">
                        <div>Project Leader :</div>
                        <ul class="team-members">
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Jeffery Lalor" aria-label="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                           </li>
                        </ul>
                     </div>
                     <div class="project-members m-b-15">
                        <div>Team :</div>
                        <ul class="team-members">
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="John Doe" aria-label="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Richard Miles" aria-label="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="John Smith" aria-label="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Mike Litorus" aria-label="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
                           </li>
                           <li>
                              <a href="#" class="all-users">+15</a>
                           </li>
                        </ul>
                     </div>
                     <p class="m-b-5">Progress <span class="text-success float-end">40%</span></p>
                     <div class="progress progress-xs mb-0">
                        <div style="width: 40%" title="" data-bs-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%" data-bs-original-title=""></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
               <div class="card">
                  <div class="card-body">
                     <div class="dropdown profile-action">
                        <a aria-expanded="false" data-bs-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                           <a data-bs-target="#edit_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                           <a data-bs-target="#delete_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                     </div>
                     <h4 class="project-title"><a href="project-view.html">Project Management</a></h4>
                     <small class="block text-ellipsis m-b-15">
                     <span class="text-xs">2</span> <span class="text-muted">open tasks, </span>
                     <span class="text-xs">5</span> <span class="text-muted">tasks completed</span>
                     </small>
                     <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. When an unknown printer took a galley of type and
                        scrambled it...
                     </p>
                     <div class="pro-deadline m-b-15">
                        <div class="sub-title">
                           Deadline:
                        </div>
                        <div class="text-muted">
                           17 Apr 2019
                        </div>
                     </div>
                     <div class="project-members m-b-15">
                        <div>Project Leader :</div>
                        <ul class="team-members">
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Jeffery Lalor" aria-label="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                           </li>
                        </ul>
                     </div>
                     <div class="project-members m-b-15">
                        <div>Team :</div>
                        <ul class="team-members">
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="John Doe" aria-label="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Richard Miles" aria-label="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="John Smith" aria-label="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Mike Litorus" aria-label="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
                           </li>
                           <li>
                              <a href="#" class="all-users">+15</a>
                           </li>
                        </ul>
                     </div>
                     <p class="m-b-5">Progress <span class="text-success float-end">40%</span></p>
                     <div class="progress progress-xs mb-0">
                        <div style="width: 40%" title="" data-bs-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%" data-bs-original-title=""></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
               <div class="card">
                  <div class="card-body">
                     <div class="dropdown profile-action">
                        <a aria-expanded="false" data-bs-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                           <a data-bs-target="#edit_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                           <a data-bs-target="#delete_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                     </div>
                     <h4 class="project-title"><a href="project-view.html">Video Calling App</a></h4>
                     <small class="block text-ellipsis m-b-15">
                     <span class="text-xs">3</span> <span class="text-muted">open tasks, </span>
                     <span class="text-xs">3</span> <span class="text-muted">tasks completed</span>
                     </small>
                     <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. When an unknown printer took a galley of type and
                        scrambled it...
                     </p>
                     <div class="pro-deadline m-b-15">
                        <div class="sub-title">
                           Deadline:
                        </div>
                        <div class="text-muted">
                           17 Apr 2019
                        </div>
                     </div>
                     <div class="project-members m-b-15">
                        <div>Project Leader :</div>
                        <ul class="team-members">
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Jeffery Lalor" aria-label="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                           </li>
                        </ul>
                     </div>
                     <div class="project-members m-b-15">
                        <div>Team :</div>
                        <ul class="team-members">
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="John Doe" aria-label="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Richard Miles" aria-label="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="John Smith" aria-label="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Mike Litorus" aria-label="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
                           </li>
                           <li>
                              <a href="#" class="all-users">+15</a>
                           </li>
                        </ul>
                     </div>
                     <p class="m-b-5">Progress <span class="text-success float-end">40%</span></p>
                     <div class="progress progress-xs mb-0">
                        <div style="width: 40%" title="" data-bs-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%" data-bs-original-title=""></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
               <div class="card">
                  <div class="card-body">
                     <div class="dropdown profile-action">
                        <a aria-expanded="false" data-bs-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                           <a data-bs-target="#edit_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                           <a data-bs-target="#delete_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                     </div>
                     <h4 class="project-title"><a href="project-view.html">Hospital Administration</a></h4>
                     <small class="block text-ellipsis m-b-15">
                     <span class="text-xs">12</span> <span class="text-muted">open tasks, </span>
                     <span class="text-xs">4</span> <span class="text-muted">tasks completed</span>
                     </small>
                     <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. When an unknown printer took a galley of type and
                        scrambled it...
                     </p>
                     <div class="pro-deadline m-b-15">
                        <div class="sub-title">
                           Deadline:
                        </div>
                        <div class="text-muted">
                           17 Apr 2019
                        </div>
                     </div>
                     <div class="project-members m-b-15">
                        <div>Project Leader :</div>
                        <ul class="team-members">
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Jeffery Lalor" aria-label="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                           </li>
                        </ul>
                     </div>
                     <div class="project-members m-b-15">
                        <div>Team :</div>
                        <ul class="team-members">
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="John Doe" aria-label="John Doe"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Richard Miles" aria-label="Richard Miles"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="John Smith" aria-label="John Smith"><img alt="" src="assets/img/profiles/avatar-10.jpg"></a>
                           </li>
                           <li>
                              <a href="#" data-bs-toggle="tooltip" title="" data-bs-original-title="Mike Litorus" aria-label="Mike Litorus"><img alt="" src="assets/img/profiles/avatar-05.jpg"></a>
                           </li>
                           <li>
                              <a href="#" class="all-users">+15</a>
                           </li>
                        </ul>
                     </div>
                     <p class="m-b-5">Progress <span class="text-success float-end">40%</span></p>
                     <div class="progress progress-xs mb-0">
                        <div style="width: 40%" title="" data-bs-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%" data-bs-original-title=""></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="tab-pane fade" id="bank_statutory">
         <div class="card">
            <div class="card-body">
               <h3 class="card-title"> Basic Salary Information</h3>
               <form>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Salary basis <span class="text-danger">*</span></label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-1-lnje" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-3-0grr">Select salary basis type</option>
                              <option>Hourly</option>
                              <option>Daily</option>
                              <option>Weekly</option>
                              <option>Monthly</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-2-p3yc" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-tfvh-container" aria-controls="select2-tfvh-container"><span class="select2-selection__rendered" id="select2-tfvh-container" role="textbox" aria-readonly="true" title="Select salary basis type">Select salary basis type</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Salary amount <small class="text-muted">per month</small></label>
                           <div class="input-group">
                              <span class="input-group-text">$</span>
                              <input type="text" class="form-control" placeholder="Type your salary amount" value="0.00">
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Payment type</label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-4-9l3z" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-6-r1qg">Select payment type</option>
                              <option>Bank transfer</option>
                              <option>Check</option>
                              <option>Cash</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-5-vr3e" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-2543-container" aria-controls="select2-2543-container"><span class="select2-selection__rendered" id="select2-2543-container" role="textbox" aria-readonly="true" title="Select payment type">Select payment type</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                  </div>
                  <hr>
                  <h3 class="card-title"> PF Information</h3>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">PF contribution</label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-7-7jb1" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-9-8dp7">Select PF contribution</option>
                              <option>Yes</option>
                              <option>No</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-8-sjvo" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ivij-container" aria-controls="select2-ivij-container"><span class="select2-selection__rendered" id="select2-ivij-container" role="textbox" aria-readonly="true" title="Select PF contribution">Select PF contribution</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">PF No. <span class="text-danger">*</span></label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-10-1dqh" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-12-jm2r">Select PF contribution</option>
                              <option>Yes</option>
                              <option>No</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-11-2nyc" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-szyo-container" aria-controls="select2-szyo-container"><span class="select2-selection__rendered" id="select2-szyo-container" role="textbox" aria-readonly="true" title="Select PF contribution">Select PF contribution</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Employee PF rate</label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-13-zrkf" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-15-snao">Select PF contribution</option>
                              <option>Yes</option>
                              <option>No</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-14-6gwv" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-pdol-container" aria-controls="select2-pdol-container"><span class="select2-selection__rendered" id="select2-pdol-container" role="textbox" aria-readonly="true" title="Select PF contribution">Select PF contribution</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-16-ht44" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-18-2hnp">Select additional rate</option>
                              <option>0%</option>
                              <option>1%</option>
                              <option>2%</option>
                              <option>3%</option>
                              <option>4%</option>
                              <option>5%</option>
                              <option>6%</option>
                              <option>7%</option>
                              <option>8%</option>
                              <option>9%</option>
                              <option>10%</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-17-wnaz" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-4lz2-container" aria-controls="select2-4lz2-container"><span class="select2-selection__rendered" id="select2-4lz2-container" role="textbox" aria-readonly="true" title="Select additional rate">Select additional rate</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Total rate</label>
                           <input type="text" class="form-control" placeholder="N/A" value="11%">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Employee PF rate</label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-19-o0pz" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-21-zqy8">Select PF contribution</option>
                              <option>Yes</option>
                              <option>No</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-20-4o2r" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-84vn-container" aria-controls="select2-84vn-container"><span class="select2-selection__rendered" id="select2-84vn-container" role="textbox" aria-readonly="true" title="Select PF contribution">Select PF contribution</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-22-zqt8" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-24-c0cf">Select additional rate</option>
                              <option>0%</option>
                              <option>1%</option>
                              <option>2%</option>
                              <option>3%</option>
                              <option>4%</option>
                              <option>5%</option>
                              <option>6%</option>
                              <option>7%</option>
                              <option>8%</option>
                              <option>9%</option>
                              <option>10%</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-23-hscm" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-546e-container" aria-controls="select2-546e-container"><span class="select2-selection__rendered" id="select2-546e-container" role="textbox" aria-readonly="true" title="Select additional rate">Select additional rate</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Total rate</label>
                           <input type="text" class="form-control" placeholder="N/A" value="11%">
                        </div>
                     </div>
                  </div>
                  <hr>
                  <h3 class="card-title"> ESI Information</h3>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">ESI contribution</label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-25-mseh" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-27-q7sg">Select ESI contribution</option>
                              <option>Yes</option>
                              <option>No</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-26-szbq" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-kw78-container" aria-controls="select2-kw78-container"><span class="select2-selection__rendered" id="select2-kw78-container" role="textbox" aria-readonly="true" title="Select ESI contribution">Select ESI contribution</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">ESI No. <span class="text-danger">*</span></label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-28-njrx" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-30-mvlr">Select ESI contribution</option>
                              <option>Yes</option>
                              <option>No</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-29-4bm7" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ky9r-container" aria-controls="select2-ky9r-container"><span class="select2-selection__rendered" id="select2-ky9r-container" role="textbox" aria-readonly="true" title="Select ESI contribution">Select ESI contribution</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Employee ESI rate</label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-31-4gdu" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-33-rlgb">Select ESI contribution</option>
                              <option>Yes</option>
                              <option>No</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-32-zrk4" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-a1c7-container" aria-controls="select2-a1c7-container"><span class="select2-selection__rendered" id="select2-a1c7-container" role="textbox" aria-readonly="true" title="Select ESI contribution">Select ESI contribution</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                           <select class="select select2-hidden-accessible" data-select2-id="select2-data-34-jnv6" tabindex="-1" aria-hidden="true">
                              <option data-select2-id="select2-data-36-97x7">Select additional rate</option>
                              <option>0%</option>
                              <option>1%</option>
                              <option>2%</option>
                              <option>3%</option>
                              <option>4%</option>
                              <option>5%</option>
                              <option>6%</option>
                              <option>7%</option>
                              <option>8%</option>
                              <option>9%</option>
                              <option>10%</option>
                           </select>
                           <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-35-190x" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-1mxl-container" aria-controls="select2-1mxl-container"><span class="select2-selection__rendered" id="select2-1mxl-container" role="textbox" aria-readonly="true" title="Select additional rate">Select additional rate</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <label class="col-form-label">Total rate</label>
                           <input type="text" class="form-control" placeholder="N/A" value="11%">
                        </div>
                     </div>
                  </div>
                  <div class="submit-section">
                     <button class="btn btn-primary submit-btn" type="submit">Save</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


<?php include(SHARED_PATH . '/footer.php') ?>


<script>
   $(document).ready(function() {
      const message = (req, res) => {
         swal(req + "!", res, {
            icon: req,
            timer: 2000,
            buttons: {
               confirm: {
                  className: req == "error" ? "btn btn-danger" : "btn btn-success",
               },
            },
         }).then(() => location.reload());
      };

      const deleted = async (url) => {
         swal({
            title: "Are you sure?",
            text: "You won't be able to reverse this!",
            icon: "warning",
            buttons: {
               confirm: {
                  text: "Yes, delete it!",
                  className: "btn btn-danger",
               },
               cancel: {
                  visible: true,
                  className: "btn btn-secondary",
               },
            },
         }).then((Delete) => {
            if (Delete) {
               fetch(url)
                  .then((res) => res.json())
                  .then((data) => {
                     swal({
                        title: "Deleted!",
                        text: data.message,
                        icon: "success",
                        buttons: {
                           confirm: {
                              className: "btn btn-success",
                           },
                        },
                     }).then(() => location.reload());
                  });
            } else {
               swal.close();
            }
         });
      };

      const submitForm = async (url, payload) => {
         const formData = new FormData(payload);

         const data = await fetch(url, {
            method: "POST",
            body: formData,
         });

         const res = await data.json();

         if (res.errors) {
            message("error", res.errors);
         }

         if (res.message) {
            message("success", res.message);
         }
      };

      const EMPLOYEE_URL = "../inc/employee/";
      const SETTING_URL = "../inc/setting/";

      const personalForm = document.getElementById("add_personal_form");
      const employeeCompForm = document.getElementById("add_employee_company_form");
      const bankForm = document.getElementById("add_bank_form");
      const docForm = document.getElementById("add_doc_form");

      personalForm.addEventListener("submit", async (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, personalForm);
      });

      employeeCompForm.addEventListener("submit", (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, employeeCompForm);
      });

      bankForm.addEventListener("submit", (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, bankForm);
      });

      docForm.addEventListener("submit", (e) => {
         e.preventDefault();
         submitForm(EMPLOYEE_URL, docForm);
      });

      $('#query_employee').select2().on("change", async () => {
         let emp_id = $("#query_employee").val()
         let data = await fetch(EMPLOYEE_URL + '?employeeId=' + emp_id)
         let res = await data.json();

         console.log(res.data);

         document.querySelector('#first_name').value = res.data.first_name ?? '';
         document.querySelector('#last_name').value = res.data.last_name ?? '';
         document.querySelector('#other_name').value = res.data.other_name ?? '';
         document.querySelector('#phone').value = res.data.phone ?? '';
         document.querySelector('#kin_name').value = res.data.kin_name ?? '';
         document.querySelector('#kin_phone').value = res.data.kin_phone ?? '';
         document.querySelector('#dob').value = res.data.dob ?? '';
         document.querySelector('#gender').value = res.data.gender ?? '';
         document.querySelector('#marital_status').value = res.data.marital_status ?? '';
         document.querySelector('#blood_group').value = res.data.blood_group ?? '';
         document.querySelector('#present_add').value = res.data.present_add ?? '';
         document.querySelector('#permanent_add').value = res.data.permanent_add ?? '';
         document.querySelector('#email').value = res.data.email ?? '';
         document.querySelector('#notification').value = res.data.notification ?? '';

         document.querySelector('#company_id').value = res.data.company ?? '';
         document.querySelector('#employee_number').value = res.data.employee_id ?? '';
         document.querySelector('#department_id').value = res.data.department ?? '';
         document.querySelector('#branch_id').value = res.data.branch ?? '';
         document.querySelector('#job_title_id').value = res.data.job_title ?? '';
         document.querySelector('#date_employed').value = res.data.date_employed ?? '';
         document.querySelector('#employment_type').value = res.data.employment_type ?? '';
         document.querySelector('#present_salary').value = res.data.present_salary ?? '';

         document.querySelector('#account_number').value = res.data.account_number ?? '';
         document.querySelector('#bank_name').value = res.data.bank_name ?? '';


      });

   });
</script>