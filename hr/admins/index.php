<?php
require_once('../private/initialize.php');

$page = 'Admins';
$page_title = 'Admin Users';
include(SHARED_PATH . '/header.php');

?>

<div class="page-header d-xl-flex d-block">
	<div class="page-leftheader">
		<h4 class="page-title"><?php echo $page_title ?></h4>
	</div>
	<div class="page-rightheader ms-md-auto">
		<div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
			<div class="btn-list">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal">Create User</button>

				<a href="<?php echo url_for('public/users/exportData.php') ?>" class="btn btn-success d-none"> <i class="fa fa-file-excel-o"></i> Export CSV</a>

			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="d-flex justify-content-between py-2">

	</div>
	<div class="col-12">

		<div class="card">
			<div class="card-body">
				<table id="basic-datatable" class="table dt-responsive nowrap w-100">
					<thead>
						<tr>
							<th>s/n.</th>
							<th>Date</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>


					<tbody>
						<?php $sn = 1;
						foreach (Admin::find_by_undeleted() as $key => $value) : ?>
							<?php if ($value->id != 1) : ?>
								<tr>
									<td><?php echo $sn++ ?></td>
									<td><?php echo date('M j, Y, g:i a', strtotime($value->created_at)) ?></td>
									<td><?php echo $value->first_name . " " . $value->last_name; ?></td>
									<td><?php echo $value->email; ?></td>
									<td><?php echo Admin::ADMIN_LEVEL[$value->admin_level]; ?></td>
									<td>
										<button data-id="<?php echo $value->id ?>" class="btn btn-outline-info btn-sm update">Update</button>
										<button data-id="<?php echo $value->id ?>" class="btn btn-outline-danger btn-sm deleted">Delete</button>
									</td>
								</tr>
							<?php endif; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-body">
				<div class="text-center mt-2 mb-4">
					<h3 class="text-primary">Add User</h3>
				</div>
				<div class="error d-none"></div>

				<form class="ps-3 pe-3 row" id="form">
					<input type="hidden" name="created_by" value="<?php echo $loggedInAdmin->id;  ?>">
					<div class="mb-3 col-lg-6 col-md-6">
						<label for="firstname" class="form-label">Role</label>
						<select class="form-control" name="admin_level" type="text" id="admin_level" required="">
							<option value="">Select Role</option>
							<?php foreach (Admin::ADMIN_LEVEL as $key => $value) { ?>
								<?php if ($key != 1) { ?>
									<option value="<?php echo $key ?>"><?php echo $value ?></option>
								<?php } ?>
							<?php } ?>

						</select>
					</div>

					<div class="mb-3 col-lg-6 col-md-6">
						<label for="firstname" class="form-label">Firstname</label>
						<input class="form-control" name="first_name" type="text" id="firstname" required="" placeholder="Michael">
					</div>
					<div class="mb-3 col-lg-6 col-md-6">
						<label for="lastname" class="form-label">Lastname</label>
						<input class="form-control" name="last_name" type="text" id="lastname" required="" placeholder=" Zenaty">
					</div>

					<div class="mb-3 col-lg-6 col-md-6">
						<label for="emailaddress" class="form-label">Email address</label>
						<input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="john@deo.com">
					</div>

					<div class="mb-3 col-lg-6 col-md-6">
						<label for="password" class="form-label">Password</label>
						<input class="form-control" name="password" type="password" required="" id="password" placeholder="Enter your password">
					</div>
					<div class="mb-3 col-lg-6 col-md-6">
						<label for="password" class="form-label">Confirm Password</label>
						<input class="form-control" name="confirm_password" type="password" required="" id="password" placeholder="Enter your password">
					</div>

					<div class="mb-3 text-center">
						<button class="btn btn-primary" type="submit">Create Account</button>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>

<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-body">
				<div class="text-center mt-2 mb-4">
					<h3 class="text-primary">Edit User</h3>
				</div>

				<form id="updateform" class="ps-3 pe-3" action="#">

					<div id="showData"></div>

					<div class="mb-3 text-center">
						<button class="btn btn-primary" type="submit">Update</button>
					</div>

				</form>

			</div>
		</div>
	</div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">
	$(document).ready(function name() {
		const message = (req, res) => {
			swal(req + "!", res, {
				icon: req,
				timer: 2000,
				buttons: {
					confirm: {
						className: req == "error" ? "btn btn-danger" : "btn btn-success",
					},
				},
			});
		};

		$(document).on("click", ".update", function(e) {
			$("#updateModal").modal('show');
			var user_id = $(this).data('id');
			$.ajax({
				url: 'inc/edit_form.php',
				method: "POST",
				data: {
					update: 1,
					id: user_id,
				},
				success: function(data) {
					$("#showData").html(data)
				}
			})
		})

		$(document).on("submit", "#updateform", function(e) {
			e.preventDefault();
			$.ajax({
				url: 'inc/process_update.php',
				method: "POST",
				data: $(this).serialize(),
				dataType: 'json',
				success: function(data) {
					if (data.success == true) {

						$("#updateModal").modal('hide');
						window.location.reload()
						// successAlert(data.msg);
						// message(data.msg, 'success');
					} else {
						// errorAlert(data.msg);
						// message(data.msg, 'error');
					}
				}
			})
		})

		$(document).on("submit", "#form", function(e) {
			e.preventDefault();
			$.ajax({
				url: 'inc/createUser.php',
				method: "POST",
				data: $(this).serialize(),
				dataType: "json",
				success: function(data) {
					if (data.success == true) {

						$(".signup-modal").modal('hide');
						window.location.reload()
						// message(data.msg, 'success');
						// CreateUserMail(data.email, data.firstname, data.lastname, data.password)
					} else {
						// errorAlert(data.msg);
						$(".error").removeClass('d-none');
						$(".error").html(data.msg);
					}
				}
			})
		})

		$('tbody').on('click', '.deleted', function() {
			let userId = this.dataset.id;

			swal({
					title: "Are you sure?",
					text: "You will not be able to recover this data!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((del) => {
					if (del) {
						$.ajax({
							url: 'inc/deleteUser.php',
							method: "POST",
							data: {
								userId: userId
							},
							dataType: 'json',
							success: function(data) {
								if (data.success == true) {
									message("success", data.msg);

									setTimeout(() => {
										window.location.reload();
									}, 1000);
								}
							}
						})
					}
				});

		})
	})
</script>