<div class="col-lg-">
            <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#edit_profile" aria-expanded="true">Edit</a></li>
                  <li class=""><a data-toggle="tab" href="#avatar" aria-expanded="false">Avatar</a></li>
                  <li class=""><a data-toggle="tab" href="#cpassword" aria-expanded="false">Change Password</a></li>
               </ul>
               <div class="tab-content">
                  <div id="edit_profile" class="tab-pane active">
                     <div class="col-lg-6">
                        <p>Please update the information below</p>
                        <form action="<?php echo $url ?>" method="post" accept-charset="utf-8">
                           <div class="text-danger text-center"><?php echo display_errors($admin->errors); ?></div>
                            <div class="col-lg-12">
                              <input type="hidden" name="admin[created_by]" value="<?php echo $loggedInAdmin->id; ?>">
                              <div class="form-group">
                                 <label for="first_name">First Name</label>                            
                                 <input type="text" name="admin[first_name]" value="<?php echo h($admin->first_name); ?>"  class="form-control tip" id="first_name"  required="required" />
                              </div>
                              <div class="form-group">
                                 <label for="last_name">Last Name</label>                            
                                 <input type="text" name="admin[last_name]" value="<?php echo h($admin->last_name); ?>"  class="form-control tip" id="last_name"  required="required" />
                              </div>
                              <div class="form-group">
                                 <label for="phone">Phone</label>                            
                                 <input type="text" name="admin[phone]" value="<?php echo h($admin->phone); ?>"  class="form-control tip" id="phone"  required="required" />
                              </div>
                              <div class="form-group">
                                 <label for="gender">Gender</label>                                                        
                                 <select name="admin[gender]" class="form-control tip select2" style="width:100%;" id="gender"  required="required">
                                    <option value="" selected="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label for="email">Email</label>                            
                                 <input type="text" name="admin[email]" value="<?php echo h($admin->email); ?>"  class="form-control tip" id="email"  required="required" />
                              </div>
                            </div>
                            <button class="btn btn-primary pull-right">Update</button>
                           </form>
                           <div class="clearfix"></div>
                     </div>
                  </div>
                  <div id="avatar" class="tab-pane">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="col-md-5">
                              <img alt="" src="https://spos.tecdiary.net/uploads/avatars/male.png" class="avatar img-thumbnail img-rounded">
                              <form action="https://spos.tecdiary.net/auth/update_avatar" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                 <input type="hidden" name="spos_token" value="a1666c58c813ed65b5dbe9eea6f818aa">
                                 <div class="form-group">
                                    <label for="change_avatar">Change Avatar</label> 

                                    <input type="file" data-browse-label="browse" name="avatar" id="product_image" required="required" data-show-upload="false" data-show-preview="false" accept="image/*" class="form-control file" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">

                                 </div>
                                 <div class="form-group">
                                    <input type="hidden" name="id" value="1">
                                    <input type="hidden" name="QtUSdXLC" value="dKMNO5QA1htRPecCjymB">
                                    <input type="submit" name="update_avatar" value="Update Avatar" class="btn btn-primary">
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="cpassword" class="tab-pane">
                     <div class="col-lg-6">
                        <div class="white-panel">
                           <p>Please update the information below</p>
                           <form  method="post" accept-charset="utf-8">
                              <input type="hidden" name="spos_token" value="a1666c58c813ed65b5dbe9eea6f818aa">                                                                                                                    
                              <div class="row">
                                 <div class="col-md-12">

                                    <!-- <div class="form-group">
                                       <label for="curr_password">Old Password</label> <br>
                                       <input type="password" name="old_password" value="" class="form-control" id="curr_password">
                                    </div> -->
                                    <div class="form-group">
                                       <label for="new_password">New Password</label>
                                       <br>
                                       <input type="password" name="admin[password]" value="" class="form-control" id="new_password" >
                                    </div>
                                    <div class="form-group">
                                       <label for="new_password_confirm">Confirm Password</label> <br>
                                       <input type="password" name="admin[confirm_password]" value="" class="form-control" id="new_password_confirm" >
                                    </div>


                                    <input type="hidden" name="user_id" value="1" id="user_id">
                                    <div class="form-group">
                                       <input type="submit" name="change_password" value="Change Password" class="btn btn-primary">
                                    </div>
                                 </div>

                              </div>
                           </form>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="clearfix"></div>
         </div>