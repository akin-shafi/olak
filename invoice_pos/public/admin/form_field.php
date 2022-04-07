<form method="post">
            <div class="form-group">
              <div class="input-group">
                <!-- <label for="first_name" class="control-label">First Name</label><br> -->
                <input type="text" class="form-control" name="admin[first_name]" value="<?php echo $admin->first_name; ?>" placeholder="First Name" />

                <!-- <label for="last_name" class="control-label">Last Name</label><br> -->
                <input type="text" class="form-control" name="admin[last_name]" value="<?php echo $admin->last_name; ?>" placeholder="Last Name">
              </div>
              <!--  <small id="passwordHelpInline" class="text-muted">
                Password must be 8-20 characters long.
              </small> -->
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="admin[email]" value="<?php echo $admin->email; ?>" placeholder="Email Address" />
            </div>
            
            <div class="form-group">
              <input type="text" class="form-control" name="admin[phone]" value="<?php echo $admin->phone; ?>" placeholder="Phone Number" />
            </div>
            <div class="form-group">
              <div class="input-group">
                <input type="password" class="form-control" name="admin[password]" placeholder="Password" />
                <input type="password" class="form-control" name="admin[confirm_password]" placeholder="Confirm">
              </div>
              <small id="passwordHelpInline" class="text-muted">
                Password must be 8-20 characters long.
              </small>
            </div>
            <div class="form-group">
              <select name="admin[admin_level]" id="admin_level" class="form-control">
                <option value="">-select-</option>
                <?php foreach (Admin::ADMIN_LEVEL as $key => $level) { ?>
                  <option value="<?php echo $key; ?>"><?php echo $level; ?></option>
                <?php } ?>
              </select>
            </div>

            
            
          </form>


