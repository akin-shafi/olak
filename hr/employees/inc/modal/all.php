   <div id="profile_info" class="modal custom-modal fade" role="dialog">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Profile Information</h5>
           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form id="add_employee_form">
             <input type="hidden" name="employeeId" value="<?php echo $employee->id; ?>" readonly>
             <div class="row">
               <div class="col-md-12">
                 <div class="profile-img-wrap edit-img">
                   <img class="inline-block" alt="user profile" src="<?php echo url_for('/assets/uploads/' . $employee->photo); ?>">
                   <div class="fileupload btn">
                     <span class="btn-text">edit</span>
                     <input class="upload" type="file" name="profile_image" id="profile_image">
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>First Name</label>
                       <input type="text" class="form-control" name="employee[first_name]" value="<?php echo $employee->first_name ?? '' ?>">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Last Name</label>
                       <input type="text" class="form-control" name="employee[last_name]" value="<?php echo $employee->last_name ?? '' ?>">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Birth Date</label>
                       <input class="form-control" type="date" name="employee[dob]" value="<?php echo $employee->dob ?? '' ?>">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Gender</label>
                       <select class="select form-control" name="employee[gender]">
                         <option value="male" <?php echo $employee->gender == 'male' ? 'selected' : '' ?>>
                           Male</option>
                         <option value="female" <?php echo $employee->gender == 'female' ? 'selected' : '' ?>>
                           Female</option>
                       </select>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12">
                 <div class="form-group">
                   <label>Address</label>
                   <input type="text" class="form-control" name="employee[address]" value="<?php echo $employee->address ?? '' ?>">
                 </div>
               </div>

               <div class="col-md-6">
                 <div class="form-group">
                   <label>Email</label>
                   <input type="email" class="form-control" name="employee[email]" value="<?php echo $employee->email ?? '' ?>">
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label>Tel</label>
                   <input type="text" class="form-control" name="personal[phone]" value="<?php echo $employee->phone ?>">
                 </div>
               </div>

               <div class="col-md-6">
                 <div class="form-group">
                   <label>Department <span class="text-danger">*</span></label>
                   <select class="select" name="employee[department_id]">
                     <option>Select Department</option>
                     <?php foreach (Department::find_by_undeleted() as $depart) : ?>
                       <option value="<?php echo $depart->id ?>" <?php echo $depart->id == $department->id ? 'selected' : '' ?>>
                         <?php echo $depart->department_name ?></option>
                     <?php endforeach; ?>
                   </select>
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label>Designation <span class="text-danger">*</span></label>
                   <select class="select" name="employee[designation_id]">
                     <option>Select Designation</option>
                     <?php foreach (Designation::find_by_undeleted() as $design) : ?>
                       <option value="<?php echo $design->id ?>" <?php echo $design->id == $designation->id ? 'selected' : '' ?>>
                         <?php echo $design->designation_name ?></option>
                     <?php endforeach; ?>
                   </select>
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label>Reports To <span class="text-danger">*</span></label>
                   <select class="select">
                     <option>-</option>
                     <option>Wilmer Deluna</option>
                     <option>Lesley Grauer</option>
                     <option>Jeffery Lalor</option>
                   </select>
                 </div>
               </div>

               <div class="col-md-6">
                 <div class="form-group">
                   <label class="col-form-label">Password</label>
                   <input class="form-control" name="employee[password]" id="password" type="password">
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label class="col-form-label">Confirm Password</label>
                   <input class="form-control" name="employee[confirm_password]" id="confirm_password" type="password">
                 </div>
               </div>
             </div>
             <div class="submit-section">
               <button class="btn btn-primary submit-btn">Submit</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>

   <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Personal Information</h5>
           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form id="add_personal_form">
             <input type="hidden" name="employeeId" value="<?php echo $employee->id; ?>" readonly>
             <div class="row">
               <div class="col-md-6">
                 <div class="form-group">
                   <label>Nationality</label>
                   <input type="text" class="form-control" name="personal[country]" value="<?php echo $employee->country ?>">
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label>State</label>
                   <input type="text" class="form-control" name="personal[state]" value="<?php echo $employee->state ?>">
                 </div>
               </div>

               <div class="col-md-6">
                 <div class="form-group">
                   <label>Religion</label>
                   <input class="form-control" name="personal[religion]" value="<?php echo $employee->religion ?>" type="text">
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label>Marital Status</label>
                   <select class="select form-control" name="personal[marital_status]">
                     <option value="single" <?php echo $employee->marital_status == 'single' ? 'selected' : '' ?>>
                       Single</option>
                     <option value="married" <?php echo $employee->marital_status == 'married' ? 'selected' : '' ?>>
                       Married</option>
                     <option value="divorced" <?php echo $employee->marital_status == 'divorced' ? 'selected' : '' ?>>
                       Divorced</option>
                   </select>
                 </div>
               </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label>No. of children </label>
                   <input class="form-control" name="personal[children]" value="<?php echo $employee->children; ?>" type="text">
                 </div>
               </div>
             </div>
             <div class="submit-section">
               <button class="btn btn-primary submit-btn">Submit</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>

   <div id="bank_modal" class="modal custom-modal fade" role="dialog">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title"> Bank Account Information</h5>
           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form id="add_bank_form">
             <input type="hidden" name="employeeId" value="<?php echo $employee->id; ?>" readonly>
             <div class="form-scroll">
               <div class="card">
                 <div class="card-body">
                   <h3 class="card-title">Bank Information</h3>
                   <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">
                         <label>Bank Name <span class="text-danger">*</span></label>
                         <input class="form-control" name="details[bank_name]" value="<?php echo $employeeInfo->bank_name ?? '' ?>" type="text">
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         <label>Account Name <span class="text-danger">*</span></label>
                         <input class="form-control" name="details[account_name]" value="<?php echo $employeeInfo->account_name ?? '' ?>" type="text">
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         <label>Account Number <span class="text-danger">*</span></label>
                         <input class="form-control" name="details[account_number]" value="<?php echo $employeeInfo->account_number ?? '' ?>" type="text">
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div class="submit-section">
               <button class="btn btn-primary submit-btn">Submit</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>

   <div id="kin_contact_modal" class="modal custom-modal fade" role="dialog">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Next of Kin Contact</h5>
           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form id="add_kin_form">
             <input type="hidden" name="employeeId" value="<?php echo $employee->id; ?>" readonly>
             <div class="card">
               <div class="card-body">
                 <h3 class="card-title">Next of Kin</h3>
                 <div class="row">
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Name <span class="text-danger">*</span></label>
                       <input class="form-control" name="details[kin_name]" value="<?php echo $employeeInfo->kin_name ?? '' ?>" type="text">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Relationship <span class="text-danger">*</span></label>
                       <input class="form-control" name="details[kin_relationship]" value="<?php echo $employeeInfo->kin_relationship ?? '' ?>" type="text">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Phone <span class="text-danger">*</span></label>
                       <input class="form-control" name="details[kin_phone_1]" value="<?php echo $employeeInfo->kin_phone_1 ?? '' ?>" type="text">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label>Phone 2</label>
                       <input class="form-control" name="details[kin_phone_2]" value="<?php echo $employeeInfo->kin_phone_2 ?? '' ?>" type="text">
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div class="submit-section">
               <button class="btn btn-primary submit-btn" id="add_kin_btn">Submit</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>

   <div id="education_info" class="modal custom-modal fade" role="dialog">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title"> Education Information</h5>
           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form id="add_education_form">
             <input type="hidden" name="employeeId" value="<?php echo $employee->id; ?>" readonly>
             <input type="hidden" name="education" readonly>
             <div class="form-scroll">
               <?php if (isset($education) && count($education) > 0) : ?>
                 <?php foreach ($education as $edu) : ?>
                   <div class="card">
                     <div class="card-body">
                       <h3 class="card-title">Education Information
                         <a href="javascript:void(0);" class="delete-icon delEdu" data-id="<?php echo $edu->id ?>">
                           <i class="fa fa-trash-o"></i></a>
                       </h3>

                       <div class="row">
                         <div class="col-md-6">
                           <div class="form-group form-focus focused">
                             <input type="text" name="institution[]" value="<?php echo $edu->institution ?>" class="form-control floating">
                             <label class="focus-label">Institution</label>
                           </div>
                         </div>
                         <div class="col-md-6">
                           <div class="form-group form-focus focused">
                             <input type="text" name="subject[]" value="<?php echo $edu->subject ?? '' ?>" class="form-control floating">
                             <label class="focus-label">Subject</label>
                           </div>
                         </div>
                         <div class="col-md-6">
                           <div class="form-group form-focus focused">
                             <input type="date" name="start_date[]" value="<?php echo $edu->start_date ?? '' ?>" class="form-control floating">
                             <label class="focus-label">Starting Date</label>
                           </div>
                         </div>
                         <div class="col-md-6">
                           <div class="form-group form-focus focused">
                             <input type="date" name="complete_date[]" value="<?php echo $edu->complete_date ?? '' ?>" class="form-control floating">
                             <label class="focus-label">Complete Date</label>
                           </div>
                         </div>
                         <div class="col-md-6">
                           <div class="form-group form-focus focused">
                             <input type="text" name="degree[]" value="<?php echo $edu->degree ?? '' ?>" class="form-control floating">
                             <label class="focus-label">Degree</label>
                           </div>
                         </div>
                         <div class="col-md-6">
                           <div class="form-group form-focus focused">
                             <input type="text" name="grade[]" value="<?php echo $edu->grade ?? '' ?>" class="form-control floating">
                             <label class="focus-label">Grade</label>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 <?php endforeach; ?>

               <?php else : ?>
                 <div class="card">
                   <div class="card-body">
                     <h3 class="card-title">Education Information</h3>
                     <div class="row">
                       <div class="col-md-6">
                         <div class="form-group form-focus focused">
                           <input type="text" name="institution[]" value="" class="form-control floating">
                           <label class="focus-label">Institution</label>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group form-focus focused">
                           <input type="text" name="subject[]" value="" class="form-control floating">
                           <label class="focus-label">Subject</label>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group form-focus focused">
                           <input type="date" name="start_date[]" value="" class="form-control floating">
                           <label class="focus-label">Starting Date</label>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group form-focus focused">
                           <input type="date" name="complete_date[]" value="" class="form-control floating">
                           <label class="focus-label">Complete Date</label>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group form-focus focused">
                           <input type="text" name="degree[]" value="" class="form-control floating">
                           <label class="focus-label">Degree</label>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group form-focus focused">
                           <input type="text" name="grade[]" value="" class="form-control floating">
                           <label class="focus-label">Grade</label>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               <?php endif; ?>
               <div id="more_education">
                 <!-- //? AJAX CALL -->
               </div>
               <div class="add-more pull-right">
                 <a href="javascript:void(0);" id="add_edu"><i class="fa fa-plus-circle"></i> Add Morse</a>
               </div>
             </div>
             <div class="submit-section">
               <button class="btn btn-primary submit-btn">Submit</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>

   <div id="experience_info" class="modal custom-modal fade" role="dialog">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Experience Information</h5>
           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form id="add_experience_form">
             <input type="hidden" name="employeeId" value="<?php echo $employee->id; ?>" readonly>
             <input type="hidden" name="experience" readonly>
             <div class="form-scroll">
               <?php if (isset($experience) && count($experience) > 0) : ?>
                 <?php foreach ($experience as $exp) : ?>
                   <div class="card">
                     <div class="card-body">
                       <h3 class="card-title">Experience Information
                         <a href="javascript:void(0);" class="delete-icon delExp" data-id="<?php echo $exp->id ?>">
                           <i class="fa fa-trash-o"></i></a>
                       </h3>
                       <div class="row">
                         <div class="col-md-6">
                           <div class="form-group form-focus">
                             <input type="text" name="company_name[]" class="form-control floating" value="<?php echo $exp->company_name ?>">
                             <label class="focus-label">Company Name</label>
                           </div>
                         </div>
                         <div class="col-md-6">
                           <div class="form-group form-focus">
                             <input type="text" name="location[]" class="form-control floating" value="<?php echo $exp->location ?>">
                             <label class="focus-label">Location</label>
                           </div>
                         </div>
                         <div class="col-md-6">
                           <div class="form-group form-focus">
                             <input type="text" name="job_position[]" class="form-control floating" value="<?php echo $exp->job_position ?>">
                             <label class="focus-label">Job Position</label>
                           </div>
                         </div>
                         <div class="col-md-6">
                           <div class="form-group form-focus">
                             <input type="date" name="period_from[]" class="form-control floating" value="<?php echo $exp->period_from ?>">
                             <label class="focus-label">Period From</label>
                           </div>
                         </div>
                         <div class="col-md-6">
                           <div class="form-group form-focus">
                             <input type="date" name="period_to[]" class="form-control floating" value="<?php echo $exp->period_to ?>">
                             <label class="focus-label">Period To</label>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 <?php endforeach; ?>
               <?php else : ?>
                 <div class="card">
                   <div class="card-body">
                     <h3 class="card-title">Experience Information</h3>
                     <div class="row">
                       <div class="col-md-6">
                         <div class="form-group form-focus">
                           <input type="text" name="company_name[]" class="form-control floating" value="">
                           <label class="focus-label">Company Name</label>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group form-focus">
                           <input type="text" name="location[]" class="form-control floating" value="">
                           <label class="focus-label">Location</label>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group form-focus">
                           <input type="text" name="job_position[]" class="form-control floating" value="">
                           <label class="focus-label">Job Position</label>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group form-focus">
                           <input type="date" name="period_from[]" class="form-control floating" value="">
                           <label class="focus-label">Period From</label>
                         </div>
                       </div>
                       <div class="col-md-6">
                         <div class="form-group form-focus">
                           <input type="date" name="period_to[]" class="form-control floating" value="">
                           <label class="focus-label">Period To</label>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               <?php endif; ?>

               <div id="more_experience">
                 <!-- //? AJAX CALL -->
               </div>
               <div class="add-more pull-right">
                 <a href="javascript:void(0);" id="add_exp"><i class="fa fa-plus-circle"></i> Add More</a>
               </div>
             </div>
             <div class="submit-section">
               <button class="btn btn-primary submit-btn">Submit</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>