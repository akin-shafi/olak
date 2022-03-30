<?php
require_once('private/initialize.php');?>
<!doctype html>
<html lang="en">
<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="Responsive Bootstrap4 Dashboard Template">
		<meta name="author" content="ParkerThemes">
		<link rel="shortcut icon" href="png/fav.png" />

		<!-- Title -->
		<title>Wafi Admin Template - Forgot Password</title>
		
		<!-- *************
			************ Common Css Files *************
		************ -->
			
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />

		<!-- Main CSS -->
		<link rel="stylesheet" href="css/main.css" />


	</head>

	<body class="authentication">

		<!-- Container start -->
		<div class="container">
			
			<form action="<?php echo url_for('/dashboard/') ?>">
				<div class="row justify-content-md-center">
					<div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
						<div class="login-screen">
							<div class="login-box">
								<a href="#" class="login-logo">
									<!-- <img src="png/logo-dark.png" alt="Wafi Admin Dashboard" /> -->
									Olak Pet.
								</a>
								<h5>In order to access your dashboard, please enter the email id you provided during the registration process.</h5>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Enter Email Address" />
								</div>
								<div class="actions">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>

		</div>
		<!-- Container end -->

	</body>

<!-- Mirrored from bootstrap.gallery/wafi-admin/dashboard-v2/topbar/forgot-pwd.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 09 Mar 2022 05:52:01 GMT -->
</html>