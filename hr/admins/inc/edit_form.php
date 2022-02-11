<?php require_once('../../private/initialize.php'); 
$id =  $_POST['id'] ?? 1;
$admin = Admin::find_by_id($id);
?>
	<input type="hidden" name="id" id="user_id" value="<?php echo $admin->id; ?>">
	<div class="row">
		
        <div class="mb-3 col-6">
            <label for="firstname" class="form-label">Firstname</label>
            <input class="form-control" name="first_name"  type="text" id="firstname" required="" value="<?php echo $admin->first_name ?>" placeholder="Michael">
        </div>
        <div class="mb-3 col-6">
            <label for="lastname" class="form-label">Lastname</label>
            <input class="form-control"  name="last_name" type="text" id="lastname" required="" value="<?php echo $admin->last_name ?>" placeholder=" Zenaty">
        </div>

        <div class="mb-3 col-12">
            <label for="emailaddress" class="form-label">Email address</label>
            <input class="form-control" name="email" type="email" id="emailaddress" required="" value="<?php echo $admin->email ?>" placeholder="john@deo.com">
        </div>

        <div class="mb-3 col-6">
            <label for="password" class="form-label">Password</label>
            <input class="form-control" name="password" type="password"  value="" id="password" placeholder="Enter your password">
        </div>
        <div class="mb-3 col-6">
            <label for="password" class="form-label">Confirm Password</label>
            <input class="form-control" name="confirm_password" type="password" id="password" placeholder="Enter your password">
        </div>
	</div>

<?php ?>
	