<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'All Employees';
include(SHARED_PATH . '/admin_header.php');

?>
<div class="page-wrapper" style="min-height: 708px;">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Employee</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
						<li class="breadcrumb-item active">Employee</li>
					</ul>
				</div>
				<div class="col-auto float-end ms-auto">
					<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#employee_modal"><i class="fa fa-plus"></i> Add Employee</a>
					<div class="view-icons">
						<a href="<?php echo url_for('employees/') ?>" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
						<a href="<?php echo url_for('employees/employees-list.php') ?>" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row filter-row">
			<div class="col-sm-6 col-md-3">
				<div class="form-group form-focus">
					<input type="text" id="search_id" class="form-control floating">
					<label class="focus-label">Employee ID</label>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="form-group form-focus">
					<input type="text" id="search_name" class="form-control floating">
					<label class="focus-label">Employee Name</label>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="form-group form-focus select-focus focused">
					<select class="select floating select2-hidden-accessible" data-select2-id="select2-data-1-8h87" tabindex="-1" aria-hidden="true" id="search_designate">
						<option value="" data-select2-id="select2-data-3-rwkw">Select Designation</option>
						<?php foreach (Designation::find_by_undeleted() as  $designate) : ?>
							<option value="<?php echo $designate->id ?>">
								<?php echo ucwords($designate->designation_name) ?></option>
						<?php endforeach; ?>
					</select>

				</div>
			</div>
			<div class="col-sm-6 col-md-3 searched">
				<div class="d-grid">
					<a href="#" class="btn btn-success w-100" id="searched"> Search </a>
				</div>
			</div>
		</div>
		<div class="row staff-grid-row" id="all_employee_list">
			<?php foreach (Employee::find_by_undeleted() as $employee) :
				$departmentName = Department::find_by_id($employee->department_id)->department_name;
				$designationName = Designation::find_by_id($employee->designation_id)->designation_name;
			?>
				<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
					<div class="profile-widget">
						<div class="profile-img">
							<a href="<?php echo url_for('employees/profile.php?employee_id=' . $employee->id) ?>" class="avatar">
								<img src="<?php echo url_for('/assets/uploads/' . $employee->photo); ?>" alt=""></a>
						</div>
						<div class="dropdown profile-action employee_list">
							<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#" data-id="<?php echo $employee->id ?>" id="edit-employee-btn"><i class="fa fa-pencil m-r-5"></i> Edit</a>
								<a class="dropdown-item" href="#" data-id="<?php echo $employee->id ?>" id="delete-employee-btn"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
							</div>
						</div>
						<h4 class="user-name m-t-10 mb-0 text-ellipsis">
							<a href="<?php echo url_for('employees/profile.php?employee_id=' . $employee->id) ?>"><?php echo ucwords($employee->full_name()); ?></a>
						</h4>
						<div class="small text-muted">
							<?php echo ucwords($departmentName); ?>
							<?php echo '(' . strtoupper($employee->employee_id) . ')'; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>

			<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3 d-none">
				<div class="profile-widget">
					<div class="profile-img">
						<a href="profile.php" class="avatar"><img src="<?php echo url_for('assets/img/profiles/avatar-02.jpg') ?>" alt=""></a>
					</div>
					<div class="dropdown profile-action">
						<a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
							<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
						</div>
					</div>
					<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.php">John Doe</a></h4>
					<div class="small text-muted">Web Designer</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php include('inc/modal/employee_modal.php');  ?>
<?php include(SHARED_PATH . '/admin_footer.php');  ?>

<script type="text/javascript">
	$(document).ready(function() {

		const FILTER_URL = "inc/filter_script.php";

		const EMPLOYEE_URL = "inc/employee_script.php";
		const employeeModal = new bootstrap.Modal(document.getElementById("employee_modal"));
		const employeeTitle = document.getElementById('employee-title');
		const submitEmployeeBtn = document.getElementById("add_employee_btn");
		const employeeForm = document.getElementById("add_employee_form");

		const showAlert = document.getElementById('showAlert');

		const message = (req, res) => {
			swal(req + "!", res, {
				icon: req,
				buttons: {
					confirm: {
						className: (req == 'error') ? 'btn btn-danger' : 'btn btn-success'
					}
				}
			}).then(() => location.reload())
		}

		employeeForm.addEventListener("submit", async (e) => {
			e.preventDefault();

			const formData = new FormData(employeeForm);
			formData.append("addEmployee", 1);

			submitEmployeeBtn.innerText = "Please Wait...";

			const data = await fetch(EMPLOYEE_URL, {
				method: "POST",
				body: formData,
			});

			const response = await data.json();

			if (response.errors) {
				showAlert.innerHTML = response.errors

				setTimeout(() => {
					showAlert.innerHTML = '';
					submitEmployeeBtn.innerText = "Submit";
				}, 3000);
			}

			if (response.message) {
				message('success', response.message)
			}
		});

		$(document).on('click', '#edit-employee-btn', async function(e) {
			let id = this.dataset.id
			employeeForm.id = 'edit_employee_form';
			const editEmployeeForm = document.getElementById("edit_employee_form");

			let data = await fetch(EMPLOYEE_URL + "?employeeId=" + id);
			let response = await data.json();

			document.getElementById('first_name').value = response.data.first_name;
			document.getElementById('last_name').value = response.data.last_name;
			document.getElementById('email').value = response.data.email;
			document.getElementById('employee_id').value = response.data.employee_id;
			document.getElementById('date_employed').value = response.data.date_employed;
			document.getElementById('phone').value = response.data.phone;
			document.getElementById('department_id').value = response.data.department_id;
			document.getElementById('designation_id').value = response.data.designation_id;

			employeeTitle.innerText = 'Edit Employee';
			submitEmployeeBtn.innerText = "Update";
			submitEmployeeBtn.id = "edit_employee_btn";
			employeeModal.show();

			submitEmployeeBtn.addEventListener("click", async (e) => {
				e.preventDefault();

				const editFormData = new FormData(editEmployeeForm);
				editFormData.append("update", 1);
				editFormData.append('employeeId', id);

				submitEmployeeBtn.innerText = "Please Wait...";

				let data = await fetch(EMPLOYEE_URL, {
					method: "POST",
					body: editFormData,
				});
				let response = await data.json();

				if (response.errors) {
					message('error', response.errors)
				} else {
					message('success', response.message)
				}
			});

			$('#employee_modal').on('hidden.bs.modal', function() {
				location.reload()
			})
		});


		$(document).on('click', '#delete-employee-btn', function() {
			let employeeId = this.dataset.id;

			swal({
				title: 'Are you sure?',
				text: 'You won\'t be able to revert this!',
				icon: 'warning',
				buttons: {
					confirm: {
						text: 'Yes, delete it!',
						className: 'btn btn-danger'
					},
					cancel: {
						visible: true,
						className: 'btn btn-secondary'
					}
				}
			}).then(Delete => {
				if (Delete) {
					fetch(EMPLOYEE_URL + '?employeeId=' + employeeId + '&deleted=1')
						.then(response => response.json()).then(data => {
							swal({
								title: 'Deleted!',
								text: data.message,
								icon: 'success',
								buttons: {
									confirm: {
										className: 'btn btn-success'
									}
								}
							}).then(() => location.reload());
						})
				} else {
					swal.close();
				}
			})
		});

		$('.searched').on('click', '#searched', async function addMoreFields() {
			let id = document.querySelector('#search_id').value;
			let name = document.querySelector('#search_name').value;
			let designate = document.querySelector('#search_designate').value;

			let data = await fetch(FILTER_URL + "?query&employee_id=" + id + '&name=' + name + '&designate=' + designate);
			let response = await data.text();
			$('#all_employee_list').html(response);
		});



	});
</script>