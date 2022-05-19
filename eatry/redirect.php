<?php require_once('private/initialize.php'); 
$page_title ="Welcome";
$action = $_GET['action'] ?? "";

// pre_r($user_mgt);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" href="assets/images/icon.png">
    <!-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="<?php echo url_for('/assets/dist/css/styles.css')?>" rel="stylesheet" type="text/css"> 
    <link href="<?php echo url_for('/assets/dist/css/animate.min.css')?>" rel="stylesheet" type="text/css"> 
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>
<style type="text/css">
	.card {
	    width: 353px;
	    height: 150px;
	    margin: 15px auto;
	    color: #000004;
	    background-color: rgb(0 0 0 / 20%);
	}
	.card i{color: gold}
	.title{
		text-align: center;
		font-weight: bold;
		font-size: 3rem
	}
	.card:hover{background-color: white}
	a:hover{color: black}
</style>
<body class="login-page login-page-<?php echo $company->color; ?> rtl rtl-inv">
	<div class="container">
		<div class="text-center fa-3x">Welcome</div>
		<div class="text-center fa-2x">
			<?php echo Admin::find_by_id($loggedInAdmin->id)->full_name() ?>
			(<?php echo Admin::ADMIN_LEVEL[$loggedInAdmin->admin_level] ?>)
		</div>
		<?php if ($action == 1) { ?>
			
		<div class="alert alert-danger alert-dismissable text-center"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>You are Unauthorized</strong></div>
		<?php } ?>
		<div class="container">
			<div class="row">
					<?php if ($warehouse_mgt == 1){?>
						<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
							<a href="<?php echo url_for('warehouse/') ?>" class="card border d-flex align-items-center justify-content-center">
								<div> 
									<div class="text-center">
									<i class="las la-box fa-5x"></i>
									</div>
									<div class="title">Store Mgt</div>
									<div class="text-center"><small >(Stock before Production)</small></div>
									
								</div>
							</a>
						</div>
					<?php } ?>
					
					<?php if ($stock_mgt == 1){?>
					
						<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
							<a href="<?php echo url_for('stock/list') ?>" class="card border d-flex align-items-center justify-content-center">
								<div> 
									<div class="text-center">
									<i class="las la-cart-arrow-down fa-5x"></i>
									</div>
									<div class="title">Stock Mgt </div>
									<div class="text-center"><small >(Stock after Production)</small></div>
								</div>
							</a>
						</div>
					<?php } ?>

					<?php if (in_array($loggedInAdmin->admin_level, [1,2,3,4]) ){?>
					<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
						<a href="<?php echo url_for('reports/today_sale') ?>" class="card border d-flex align-items-center justify-content-center">
							<div> 
								<div class="text-center">
								<i class="las la-chart-bar fa-5x"></i>
								</div>
								<div class="title">Sales Report</div>
								<div class="text-center"><small >(Cashier Book keeping)</small></div>
							</div>
						</a>
					</div>
					<?php } ?>

					<?php if ($ledger_mgt == 1){?>
					<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
						<a href="<?php echo url_for('reports/ledger.php') ?>" class="card border d-flex align-items-center justify-content-center">
							<div> 
								<div class="text-center">
								<i class="las la-file fa-5x"></i>
								</div>
								<div class="title">Balance Sheet</div>
								<div class="text-center"><small >(Daily: Stock, Sales and Leftover)</small></div>
							</div>
						</a>
					</div>
					<?php } ?>
					<?php if (in_array($loggedInAdmin->admin_level, [1,4]) ){?>

						<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
							<a href="<?php echo url_for('pos/') ?>" class="card border d-flex align-items-center justify-content-center">
								<div> 
									<div class="text-center">
									<i class="las la-calculator fa-5x"></i>
									</div>
									<div class="title">POS</div>
									<div class="text-center"><small >(Point of Sales)</small></div>
								</div>
							</a>
						</div>
					<?php } ?>
					<?php if (in_array($loggedInAdmin->admin_level, [1,2,3,4]) ){?>
						<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12 d-none">
							<a href="<?php echo url_for('dashboard/') ?>" class="card border d-flex align-items-center justify-content-center">
								<div> 
									<div class="text-center">
									<i class="las la-tachometer-alt fa-5x"></i>
									</div>
									<div class="title">Sales Dashboard</div>
								</div>
							</a>
						</div>
						
					<?php } ?>
					

					<?php if ($user_mgt == 1){?>
						
						<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
							<a href="<?php echo url_for('users/') ?>" class="card border d-flex align-items-center justify-content-center">
								<div> 
									<div class="text-center">
									<i class="las la-users fa-5x"></i>
									</div>
									<div class="title">User Mgt</div>
								</div>
							</a>
						</div>
					<?php } ?>
					<?php if ($product_mgt == 1){?>
						<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
							<a href="<?php echo url_for('products/') ?>" class="card border d-flex align-items-center justify-content-center">
								<div> 
									<div class="text-center">
									<i class="las la-gift fa-5x"></i>
									</div>
									<div class="title">Product Mgt</div>
								</div>
							</a>
						</div>
						
					<?php } ?>

					
					
					<?php if ($shift_mgt == 1){?>
					<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
						<a href="<?php echo url_for('shift/') ?>" class="card border d-flex align-items-center justify-content-center">
							<div> 
								<div class="text-center">
								<i class="las la-calendar-week fa-5x"></i>
								</div>
								<div class="title">Shift Mgt</div>
							</div>
						</a>
					</div>
					<?php } ?>
					
					
					
					
					<?php if (in_array($loggedInAdmin->admin_level, [1]) ){?>
					<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
						<a href="<?php echo url_for('settings/') ?>" class="card border d-flex align-items-center justify-content-center">
							<div> 
								<div class="text-center">
								<i class="las la-tools fa-5x"></i>
								</div>
								<div class="title">Settings</div>
							</div>
						</a>
					</div>
					<?php } ?>
					<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
						<a href="<?php echo url_for('logout.php') ?>" class="card border d-flex align-items-center justify-content-center">
							<div> 
								<div class="text-center">
								<i class="las la-power-off fa-5x"></i>
								</div>
								<div class="title">Logout</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>