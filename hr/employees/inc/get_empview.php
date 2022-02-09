<?php
require_once('../../private/initialize.php');

if (is_get_request()) {
   if (isset($_GET['get_empview'])) {

      $all = Employee::find_by_undeleted(['order' => 'ASC']);
      $first_id = array_values($all)[0]->id;
      $id = $_GET['employeeId'] != '' ? $_GET['employeeId'] : $first_id;

      $employee = Employee::find_by_id($id);

      $education = EmployeeEducation::find_by_employee_id($id);
      $experience = EmployeeExperience::find_by_employee_id($id);

      if (!empty($employee->photo)) {
         $profile_picture = url_for('assets/uploads/profiles/' . $employee->photo);
      } else {
         if ($employee->gender == 'Male') {
            $profile_picture = url_for('assets/images/users/male.jpg');
         } else {
            $profile_picture = url_for('assets/images/users/female.jpg');
         }
      }
?>
      <div class="d-flex justify-content-end py-2">
         <a class="btn btn-primary btn-sm mb-2" href="<?php echo url_for('employees/hr-editemp.php?id='.$id) ?>">Edit</a>
      </div>
      <div class="card mb-0">
         <div class="card-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="profile-view">
                     <div class="profile-img-wrap">
                        <div class="profile-img">
                           <a href="#"><img alt="" src="<?php echo $profile_picture ?>"></a>
                        </div>
                     </div>
                     <div class="profile-basic">
                        <div class="row">
                           <div class="col-md-5">
                              <div class="profile-info-left">
                                 <h3 class="user-name m-t-0 mb-0"><?php echo $employee->full_name() ?? "Not Set" ?></h3>
                                 <div class="staff-id">Employee ID : <?php echo $employee->employee_id ?? "Not Set"; ?></div>
                                 <h6 class="text-muted"><?php echo $employee->company ?? "Not Set"; ?></h6>
                                 <table class="text-muted table table-sm" style="font-size:12px">
                                    <tr>
                                       <td>Branch: </td>
                                       <td><?php echo $employee->branch ?? "Not Set"; ?> </td>
                                    </tr>
                                    <tr>
                                       <td>Department: </td>
                                       <td><?php echo $employee->department ?? "Not Set"; ?> </td>
                                    </tr>
                                    <tr>
                                       <td>Job Title: </td>
                                       <td><?php echo $employee->job_title ?? "Not Set"; ?> </td>
                                    </tr>
                                 </table>


                                 <div class="small doj text-muted">Date of Join : <?php echo $employee->date_employed ?? "Not Set"; ?></div>
                              </div>
                           </div>
                           <div class="col-md-7">
                              
                              <table class="personal-info table table-sm">
                                 <tr>
                                    <td class="title">Phone:</td>
                                    <td class="text"><a href="">(+234) <?php echo $employee->phone ?? "Not Set"; ?></a></td>
                                 </tr>
                                 <tr>
                                    <td class="title">Email:</td>
                                    <td class="text"><a href=""><?php echo $employee->email ?? "Not Set"; ?></a></td>
                                 </tr>
                                 <tr>
                                    <td class="title">Birthday:</td>
                                    <td class="text"><?php echo $employee->dob ?? "Not Set"; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="title">Present Address:</td>
                                    <td class="text"><?php echo $employee->present_add ?? "Not Set"; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="title">Permanent Address:</td>
                                    <td class="text"><?php echo $employee->permanent_add ?? "Not Set"; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="title">Gender:</td>
                                    <td class="text"><?php echo $employee->gender ?? "Not Set"; ?></td>
                                 </tr>
                                 <tr class="d-none">
                                    <td class="title">Reports to:</td>
                                    <td class="text">
                                       <div class="avatar-box">
                                          <div class="avatar avatar-xs">
                                             <img src="assets/img/profiles/avatar-16.jpg" alt="">
                                          </div>
                                       </div>
                                       <a href="profile.html">
                                          Jeffery Lalor
                                       </a>
                                    </td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="card tab-box my-3 d-none">
         <div class="row user-tabs">
            <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
               <ul class="nav nav-pills nav-tabs-bottom">
                  <li class="nav-item"><a href="#emp_profile" data-bs-toggle="tab" class="nav-link active">Profile</a></li>

                  <li class="nav-item d-none"><a href="#emp_projects" data-bs-toggle="tab" class="nav-link">Projects</a></li>
                  <li class="nav-item d-none"><a href="#bank_statutory" data-bs-toggle="tab" class="nav-link">Bank &amp; Statutory <small class="text-danger">(Admin Only)</small></a></li>
               </ul>
            </div>
         </div>
      </div>

      <div class="tab-content my-5">
         <div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
               <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Other Information </h3>
                        <ul class="personal-info">
                           <li>
                              <div class="title">Passport No.</div>
                              <div class="text"><?php echo $employee->passport_no ?? "Not Set"; ?></div>
                           </li>
                           <li>
                              <div class="title">Passport Exp Date.</div>
                              <div class="text"><?php echo $employee->passport_exp_date ?? "Not Set"; ?></div>
                           </li>

                           <li>
                              <div class="title">Nationality</div>
                              <div class="text"><?php echo $employee->nationality ?? "Not Set"; ?></div>
                           </li>
                           <li>
                              <div class="title">Religion</div>
                              <div class="text"><?php echo $employee->religion ?? "Not Set"; ?></div>
                           </li>
                           <li>
                              <div class="title">Marital status</div>
                              <div class="text"><?php echo $employee->marital_status ?? "Not Set"; ?></div>
                           </li>

                           <?php if ($employee->marital_status == 'Married') : ?>
                              <li>
                                 <div class="title">No. of children</div>
                                 <div class="text"><?php echo $employee->no_of_children ?? "Not Set"; ?></div>
                              </li>
                           <?php endif ?>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Kin Information / Emergency Contact</h3>
                        <ul class="personal-info">
                           <li>
                              <div class="title">Next of Kin full name</div>
                              <div class="text"><?php echo $employee->kin_name ?? "Not Set"; ?></div>
                           </li>
                           <li>
                              <div class="title">Relationship with Kin</div>
                              <div class="text"><?php echo $employee->kin_relationship ?? "Not Set"; ?></div>
                           </li>
                           <li>
                              <div class="title">Kin Phone Number</div>
                              <div class="text"><?php echo $employee->kin_phone ?? "Not Set"; ?></div>
                           </li>
                           <li>
                              <div class="title">Kin Email </div>
                              <div class="text"><?php echo $employee->kin_email ?? "Not Set"; ?></div>
                           </li>
                        </ul>
                        <hr>
                        <div class="d-none">
                           <h5 class="section-title">Secondary</h5>
                           <ul class="personal-info">
                              <li>
                                 <div class="title">Name</div>
                                 <div class="text"><?php echo $employee->no_of_children ?? "Not Set"; ?></div>
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
            </div>
            <div class="row">
               <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Bank information</h3>
                        <ul class="personal-info">
                           <li>
                              <div class="title">Bank name</div>
                              <div class="text"><?php echo $employee->bank_name ?? "Not Set"; ?></div>
                           </li>
                           <li>
                              <div class="title">Bank account No.</div>
                              <div class="text"><?php echo $employee->account_number ?? "Not Set"; ?></div>
                           </li>

                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 ">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Salary Narration</h3>
                        <ul class="personal-info">
                           <li>
                              <div class="title">Annual Salary.</div>
                              <div class="text"><?php echo $currency . ' ' . number_format(intval($employee->present_salary) * 12) ?? "Not Set"; ?></div>
                           </li>

                           <li>
                              <div class="title">Monthly Salary</div>
                              <div class="text"><?php echo $currency . ' ' . number_format(intval($employee->present_salary), 2) ?? "Not Set"; ?></div>
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
                        <h3 class="card-title">Education Information </h3>
                        <div class="experience-box">
                           <ul class="experience-list">
                              <?php
                              if (count($education) > 0) :
                                 foreach ($education as $educate) : ?>
                                    <li>
                                       <div class="experience-user">
                                          <div class="before-circle"></div>
                                       </div>
                                       <div class="experience-content">
                                          <div class="timeline-content">
                                             <a href="#/" class="name">
                                                <?php echo ucwords($educate->institution); ?></a>
                                             <div>
                                                <?php echo ucwords($educate->degree); ?>
                                                <?php echo ucwords($educate->subject); ?>
                                             </div>
                                             <span class="time">
                                                <?php echo date('Y', strtotime($educate->start_date)); ?> -
                                                <?php echo date('Y', strtotime($educate->complete_date)); ?>
                                             </span>
                                          </div>
                                       </div>
                                    </li>
                                 <?php endforeach;
                              else : ?>
                                 <li class="text-center">Information not given</li>
                              <?php endif; ?>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                     <div class="card-body">
                        <h3 class="card-title">Experience </h3>
                        <div class="experience-box">
                           <ul class="experience-list">
                              <?php
                              if (count($experience) > 0) :
                                 foreach ($experience as $exp) : ?>
                                    <li>
                                       <div class="experience-user">
                                          <div class="before-circle"></div>
                                       </div>
                                       <div class="experience-content">
                                          <div class="timeline-content">
                                             <a href="#/" class="name">
                                                <?php echo ucwords($exp->job_position) ?> at
                                                <?php echo ucwords($exp->company_name) ?></a>
                                             <span class="time"><?php echo date('M, Y', strtotime($exp->period_from)) ?> -
                                                <?php echo date('M, Y', strtotime($exp->period_to)) ?>
                                                (<?php echo time_elapsed_string($exp->period_to) ?>)</span>
                                          </div>
                                       </div>
                                    </li>
                                 <?php endforeach;
                              else : ?>
                                 <li class="text-center">Information not given</li>
                              <?php endif; ?>
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
                              <a data-bs-target="#edit_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="feather feather-edit m-r-5"></i> Edit</a>
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
                              <a data-bs-target="#edit_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="feather feather-edit m-r-5"></i> Edit</a>
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
                              <a data-bs-target="#edit_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="feather feather-edit m-r-5"></i> Edit</a>
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
                              <a data-bs-target="#edit_project" data-bs-toggle="modal" href="#" class="dropdown-item"><i class="feather feather-edit m-r-5"></i> Edit</a>
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

   <?php }

   if (isset($_GET['get_branch_via_company'])) {
      $branches = Branch::find_by_company_name($_GET['get_branch_via_company']);
      $employee = Employee::find_by_id($_GET['emp_id']);
   ?>
      <select name="company[branch_id]" id="branch_id" style="width:100%" class="form-control" required>
         <?php foreach ($branches as $value) : ?>
            <option value="<?php echo $value->id ?>" <?php echo $employee->branch == $value->branch_name ? 'selected' : '' ?>><?php echo ucwords($value->branch_name) ?></option>
         <?php endforeach; ?>
      </select>
<?php
   }
}
