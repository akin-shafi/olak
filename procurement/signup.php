<?php
require_once('private/initialize.php');


$branch = Branch::find_by_undeleted(['order' => 'ASC']);
$companies = Company::find_by_undeleted();


?>

<!doctype html>
<html lang="en">

<!-- Mirrored from templates.iqonic.design/posdash/html/backend/auth-sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 09 Mar 2022 06:08:53 GMT -->

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>OLAK | Procurement</title>

   <!-- Favicon -->
   <link rel="shortcut icon" href="ico/favicon.ico" />
   <link rel="stylesheet" href="css/backend-plugin.min.css">
   <link rel="stylesheet" href="css/backende209.css?v=1.0.0">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/line-awesome.min.css">
   <link rel="stylesheet" href="css/remixicon.css">
</head>

<body class=" ">
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->

   <div class="wrapper">
      <section class="login-content">
         <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
               <div class="col-lg-8">
                  <div class="card auth-card">
                     <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                           <div class="col-lg-7 align-self-center">
                              <div class="p-3">
                                 <h2 class="mb-2">Sign Up</h2>
                                 <p>Create your access account.</p>

                                 <form id="user_form" enctype="multipart/form-data">
                                    <input type="hidden" name="user[admin_level]" value="4" class="form-control" readonly>

                                    <div class="row">
                                       <div class="col-md-12 mb-2">
                                          <label for="fName" class="col-form-label">Full Name</label>
                                          <input type="text" class="form-control" name="user[full_name]" id="fName" placeholder="Full name">
                                       </div>
                                       <div class="col-md-6 mb-2">
                                          <label class="label-control">Company Name<sup class="text-danger">*</sup></label>
                                          <select class="form-control company" name="user[company_id]" id="company" required>
                                             <option value="">select a company</option>
                                             <?php foreach ($companies as $value) :
                                                $company_name = $value->name != '' ? $value->name : 'Not Set'
                                             ?>
                                                <option value="<?php echo $value->id ?>" <?php echo $value->name == '' ? 'disabled' : '' ?>>
                                                   <?php echo $company_name ?></option>
                                             <?php endforeach; ?>
                                          </select>
                                       </div>
                                       <div class="col-md-6 mb-2">
                                          <div id="branch">
                                             <label class="label-control">Branch<sup class="text-danger">*</sup></label>
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-2">
                                          <label for="email" class="col-form-label">Email</label>
                                          <input type="text" class="form-control" name="user[email]" id="email" placeholder="Email" required>
                                       </div>
                                       <div class="col-md-6 mb-2">
                                          <label for="phone" class="col-form-label">Phone</label>
                                          <input type="tel" class="form-control" name="user[phone]" id="phone" placeholder="Phone number" required>
                                       </div>
                                       <div class="col-md-6 mb-2">
                                          <label for="password" class="col-form-label">Password</label>
                                          <input type="password" class="form-control" name="user[password]" id="password" placeholder="12345">
                                       </div>
                                       <div class="col-md-6 mb-2">
                                          <label for="cPass" class="col-form-label">Confirm password</label>
                                          <input type="password" class="form-control" name="user[confirm_password]" id="cPass" placeholder="12345">
                                       </div>
                                       <div class="col-md-12">
                                          <label for="address" class="col-form-label">Address</label>
                                          <textarea name="user[address]" id="address" class="form-control" placeholder="Contact address" rows="2"></textarea>
                                       </div>
                                       <div class="col-md-6 mb-2 mx-auto">
                                          <label for="avatar" class="col-form-label">Profile Image</label>
                                          <input type="file" class="form-control" name="profile" id="avatar">
                                       </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                    <p class="mt-3">
                                       Already have an Account <a href="<?php echo url_for('/login.php') ?>" class="text-primary">Sign In</a>
                                    </p>
                                 </form>
                              </div>
                           </div>
                           <div class="col-lg-5 content-right">
                              <img src="png/01-2.png" class="img-fluid image-right" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>

   <?php include(SHARED_PATH . '/admin_footer.php'); ?>

   <script>
      $(document).ready(function() {
         const USER_URL = 'settings/inc/process.php';

         $('#user_form').on("submit", function(e) {
            e.preventDefault();
            let uId = $('#uId').val()

            let formData = new FormData(this);
            formData.append('new_user', 1)

            $.ajax({
               url: USER_URL,
               method: "POST",
               data: formData,
               contentType: false,
               cache: false,
               processData: false,
               dataType: 'json',
               beforeSend: function() {
                  $('.lds-hourglass').removeClass('d-none');
               },
               success: function(r) {
                  if (r.success == true) {
                     successAlert(r.msg);
                     setTimeout(() => {
                        $('.lds-hourglass').addClass('d-none');
                        window.location.href = './login.php'
                     }, 250);
                  } else {
                     errorAlert(r.msg);
                  }
               }
            })
         });

         $(document).on('change', '.company', function() {
            const selected = $(".company option:selected").val();
            $.ajax({
               url: USER_URL,
               method: "GET",
               data: {
                  company_id: selected
               },
               success: function(data) {
                  $('#branch').html(data)
               }
            });
         });
      })
   </script>