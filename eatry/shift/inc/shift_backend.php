<?php require_once('../../private/initialize.php'); ?>

<?php if (isset($_POST['showEdit'])) { 
$id =  $_POST['id'];
$access = Shift::find_by_id($id);
?>
	<form class="row" id="editForm">
		<input type="hidden" name="editRecord[id]" value="<?php echo $id ?>">
        <div class="form-group col-sm-6">
          <label class="control-label">Shift Name</label>
          <input type="text" name="editRecord[name]" class="form-control" value="<?php echo $access->name ?>">
        </div>

        <div class="form-group col-sm-6">
          <label class="control-label">Start Time</label>
          <input type="time" name="editRecord[start_time]" class="form-control" value="<?php echo $access->start_time ?>">
        </div>

        <div class="form-group col-sm-6">
          <label class="control-label">End Time</label>
          <input type="time" name="editRecord[end_time]" class="form-control" value="<?php echo $access->end_time ?>">
        </div>

        <div class="form-group col-sm-12">
          <div class="p-3 border-top d-flex justify-content-between">
  	        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
  	        <button type="button" name="genManifest" class="btn btn-sm bg-gradient-primary" id="editRecord">Edit</button>
  	      </div>
        </div>
      </form>
<?php } ?>

<?php if(isset($_POST['addRecord'])){
  $args = $_POST['addRecord'];
  $addRecord = new Shift($args);
  // pre_r($addRecord);
  $result = $addRecord->save();
    if ($result == true) {  
         exit(json_encode(['msg' => 'OK']));
    } else {
        exit(json_encode(['msg' => display_errors($addRecord->errors)]));
    }
} ?>

<?php 

if(isset($_POST['editRecord'])){
    $args = $_POST['editRecord'];
    $id = $_POST['editRecord']['id'];
    $editRecord = Shift::find_by_id($id);
    $editRecord->merge_attributes($args);
    $result = $editRecord->save();

    if ($result == true) {
      exit(json_encode(['msg' => 'OK']));  
    } else {
      exit(json_encode(['msg' => display_errors($editRecord->errors)]));
    }
}?>

<?php 

if(isset($_POST['editStatus'])){
    // $args = $_POST['editRecord'];
    $id = $_POST['id'];
    $type = $_POST['type'];
    $editStatus = Shift::find_by_id($id);
    $args = [
      'status' => $type
    ];
    $editStatus->merge_attributes($args);
    $result = $editStatus->save();

    if ($result == true) {
      exit(json_encode(['msg' => 'OK']));  
    } else {
      exit(json_encode(['msg' => display_errors($editStatus->errors)]));
    }
}?>

<?php if (isset($_POST['record'])) { ?>
	<?php 
    $current_time = date('H'); $sn = 1; 
    foreach (Shift::find_by_undeleted(['order' => 'ASC']) as $key => $value) { 
       $start = date('H', strtotime($value->start_time));  
       $end = date('H', strtotime($value->end_time));

    ?>
      <tr class="text-center">
        <td><?php echo $sn++ ?></td>
        <td><?php echo $value->name ?></td>
        <td><?php echo date('H:i', strtotime($value->start_time)) ?></td>
        <td><?php echo date('H:i', strtotime($value->end_time)); ?></td>
        <td>
          <button type="button" class="edit" data-id="<?php echo $value->id ?>">Edit</button>
        </td>
        <td><?php echo $value->status == '0' ? '<i class="fa fa-circle text-danger"></i> Inactive' : '<i class="fa fa-circle text-success"></i> Active' ?></td>
        <td>
          <?php //if ($current_time  >= $start && $current_time <= $end) { ?>
                <?php if ($value->status == '0') { ?>
                  <button class="btn btn-success bn" data-type="1" data-id="<?php echo $value->id ?>">Start...</button>
                <?php }else{ ?>
                  <button class="btn btn-danger bn end" data-type="0" data-id="<?php echo $value->id ?>">End...</button>
                <?php } ?>
           <?php //} ?>
        </td>
      </tr>
    <?php } ?>
<?php } ?>
