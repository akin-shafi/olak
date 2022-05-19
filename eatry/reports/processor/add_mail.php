<?php require_once('../../private/initialize.php'); ?>
<?php 
    if(isset($_POST['addMail'])){
	        $data = [
			    "email" => $_POST['email'],
			    "name" => $_POST['name'],
			    "type" => $_POST['type'],
			    "created_by" => $loggedInAdmin->id,
			];
			$addEmail = new Recipients($data);
			$result = $addEmail->save();
		if ($result == true) {
			exit(json_encode(['msg' => 'OK']));
		}else{
			exit(json_encode(['error' => display_errors($addEmail->errors)]));
		}
	} 

?>

<?php 

	if(isset($_POST['editMail'])){
	        $id = $_POST['id'];
			$rep = Recipients::find_by_id($id);
			
	        $data2 = [
			    "email" => $_POST['email'],
			    "name" => $_POST['name'],
			    "created_by" => $loggedInAdmin->id,
			];
			$rep->merge_attributes($data2);
// 			pre_r($rep);
			$result = $rep->save();
		if ($result == true) {
			exit(json_encode(['msg' => 'OK']));
		}else{
			exit(json_encode(['error' => display_errors($rep->errors)]));
		}
	} 
 ?>
