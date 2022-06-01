<?php require_once('../../private/initialize.php'); ?>
<?php 
 $trans_no = $_POST["trans_no"];

 $query = Sales::void($trans_no);
if ($query == true) {
	exit(json_encode(['msg' => 'OK']));
}else{
	exit(json_encode(['msg' => 'FAIL', 'location' => 'from Void function']));
}
// $sn = 1;
// $is_available = 0;
// foreach ($onlineUsers as $key => $value) {
// 	$admin = Admin::find_by_id($value->user_id);
// 	if ($admin->admin_level == 4) {
// 		$is_available = 1;
// 		$sales_rep = Admin::find_by_id($admin->id);
// 		$name = $sales_rep->full_name();
// 		$level = Admin::ADMIN_LEVEL[$sales_rep->admin_level];
// 		$output = '
// 		<div class="table-responsive" id="order_table">
// 			<table class="table table-bordered table-striped">
				
// 		';
// 		$output .= '
// 			<tr class="alert-light bold">
// 				<td>SN</td>
// 				<td>Name</td>
// 				<td>Designation</td>
// 			</tr>
// 		';
// 		$output .= '

// 			<tr>
// 				<td>'.$sn++.'.</td>
// 				<td>'.$name.'</td>
// 				<td>'.$level.'</td>
// 			</tr>
// 		';
// 		$output .= '</table></div>';
		
// 	}
// }

// if ($is_available == 1) {
// 	exit(json_encode(['msg' => 'FAIL', 'log_details' =>	$output, 'location' => 'from onlineUsers']));
// }else{
// 	$query = Sales::void($trans_no);
// 	if ($query == true) {
// 		exit(json_encode(['msg' => 'OK']));
// 	}else{
// 		exit(json_encode(['msg' => 'FAIL', 'location' => 'from Void function']));
// 	}
	
// }




 ?>