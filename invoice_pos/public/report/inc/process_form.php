
<?php require_once('../../../private/initialize.php');  ?>

<?php 
if(isset($_POST['createReport']['add'])):
    $args = $_POST['createReport'];
    $date = $_POST['createReport']['report_date'];
    $branch = $_POST['createReport']['branch_id'];
    $find_date = SummaryReport::find_by_date(['report_date' => $date, 'branch_id' => $branch]);
    // pre_r($find_date);
    if(empty($find_date)){
        
        $createReport = new SummaryReport($args);
        $result = $createReport->save();
        if ($result == true) {  
            $rand = rand(10, 100);
            $new_id = $createReport->id;
            $ref_no = "04" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
                $data = [
                'ref_no' => $ref_no,
                ];
                $createReport->merge_attributes($data);
                $result2 = $createReport->save();
    
                exit(json_encode(['msg' => 'OK', 'date' => $date]));
        } else {
            exit(json_encode(['msg' => display_errors($createReport->errors)]));
        }
    }else{
        exit(json_encode(['msg' => 'Record already exist for the selected date edit instead']));
    }
  
endif
?>

<?php if(isset($_POST['createReport']['edit'])){
   $id = $_POST['createReport']['id'];
   $date = $_POST['createReport']['report_date'];
   $editReport = SummaryReport::find_by_id($id); 
   $args = $_POST['createReport'];  
   $args['updated_date'] = date('Y-m-d h:i:s'); // Add updated_at field with current date
   $editReport->merge_attributes($args);
    $result = $editReport->save();
    if ($result == true) {  
        exit(json_encode(['msg' => 'OK', 'date' => $date]));
    } else {
        exit(json_encode(['msg' => display_errors($editReport->errors)]));
    }

} ?>

