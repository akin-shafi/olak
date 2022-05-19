
<?php 
   if ($page_title == 'Edit') {
     $url = url_for('/users/edit.php?id=' . h(u($id)));
   }else{
      $url = "";
   }
 ?>
<form action="<?php echo $url ?>" method="post" accept-charset="utf-8">
   <div class="text-danger text-center"><?php echo display_errors($admin->errors); ?></div>
    <div class="col-lg-6">
      <input type="hidden" name="admin[created_by]" value="<?php echo $loggedInAdmin->id; ?>">
      <!-- <input type="hidden" name="spos_token" value="49838b1047939f60a39bb3ba432c9cd5" /> -->
      <div class="form-group">
         <label for="group">Group</label>                            
         <select name="admin[admin_level]" id="group" data-placeholder="Select Group" class="form-control input-tip select2" style="width:100%;">
            <option value="" selected="selected"></option>
            <?php foreach (Admin::ADMIN_LEVEL as $key => $value) { ?>
                <?php if ($key != 1) { ?>
                   <option value="<?php echo $key; ?>" <?php echo $key == $admin->admin_level ? 'selected' : '';  ?>><?php echo $value; ?></option>
                <?php } ?>
              <?php } ?>
         </select>
      </div>
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
            <?php foreach (Admin::GENDER as $key => $value) { ?>
              <option value="<?php echo $key; ?>" <?php echo $key == $admin->gender ? 'selected' : '';  ?>><?php echo $value; ?></option>
            <?php } ?>
            
         </select>
      </div>
      <div class="form-group">
         <label for="email">Email</label>                            
         <input type="text" name="admin[email]" value="<?php echo h($admin->email); ?>"  class="form-control tip" id="email"  required="required" />
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
         <label for="username">Username</label>                            
         <input type="text" name="admin[username]" value="<?php echo h($admin->username); ?>"  class="form-control tip" id="username"  required="required" />
      </div>
      <div class="form-group">
         <label for="password">Password</label>                            
         <input type="password" name="admin[password]" value=""  class="form-control tip" id="password" />
      </div>
      <div class="form-group">
         <label for="confirm_password">Confirm Password</label>                            
         <input type="password" name="admin[confirm_password]" value=""  class="form-control tip" id="confirm_password" />
      </div>
      <div class="form-group">
         <label for="status">Status</label>                            
         <select name="admin[account_status]" id="status" data-placeholder="Select Status" class="form-control input-tip select2" style="width:100%;">
            <option value="" selected="selected"></option>
            <?php foreach (Admin::ACCOUNT_STATUS as $key => $value) { ?>
               <option value="<?php echo $key; ?>" <?php echo $key == $admin->account_status ? 'selected' : ''; ?>><?php echo $value; ?></option>
            <?php } ?>
         </select>
      </div>
      <!-- <div class="form-group store-con">
         <label for="store_id">Store</label>                            
         <select name="admin[store_id]" id="store_id" data-placeholder="Select Store" class="form-control input-tip select2" style="width:100%;">
            <option value="" ></option>
            <option value="1" selected="selected">SaPLPOS</option>
         </select>
      </div> -->
      <input type="hidden" name="admin[store_id]" id="store_id">
      <div class="form-group">
         <label class="checkbox" for="notify">
         <input type="checkbox" name="admin[notify]" value="1" id="notify" checked="checked"/> Notify User by Email</label>
      </div>
      <div class="form-group">
         <input type="submit" value="Add User"  class="btn btn-primary" />
      </div>
    </div>
   </form>
