<?php require_once('../../private/initialize.php'); ?>

<?php if (isset($_POST['showEdit'])) { 
$id =  $_POST['id'];
$schedule = Schedule::find_by_id($id);
$shift = Shift::find_by_undeleted(['order' => 'ASC']);
?>
	<form class="row" id="editForm">
		<input type="hidden" name="editRecord[id]" value="<?php echo $id ?>">
        

            <div class="form-group col-sm-6">
              <label class="control-label">Shift Period</label>
                  <select class="form-control" name="editRecord[shift_period]">
		            <!-- <option value="">Select</option> -->
		            <?php foreach ($shift as $key => $value) { ?>
	                  <option value="<?php echo $value->id ?>" <?php echo $schedule->shift_period == $value->id ? 'selected' : '0' ?>><?php echo $value->name ?></option>
	                <?php } ?>
		          </select>
            </div>

            <div class="form-group col-sm-6">
              <label class="control-label">Permission</label>
              <select class="form-control" name="editRecord[status]">
                <?php foreach (Schedule::STATUS as $key => $value) { ?>
	            	<option value="<?php echo $key ?>" <?php echo $schedule->status == $key ? 'selected' : '0' ?>><?php echo $value ?></option>
	            <?php } ?>
              </select>
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
  $addRecord = new Schedule($args);
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
    $editRecord = Schedule::find_by_id($id);
    $editRecord->merge_attributes($args);
    $result = $editRecord->save();

    if ($result == true) {
      exit(json_encode(['msg' => 'OK']));  
    } else {
      exit(json_encode(['msg' => display_errors($editRecord->errors)]));
    }
}?>

<?php if (isset($_POST['record'])) { ?>
	<?php $sn = 1; foreach (Schedule::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
      <tr class="text-center">
        <td><?php echo $sn++ ?></td>
        <td><?php echo Admin::find_by_id($value->user_id)->full_name(); ?></td>
        <td><?php echo Shift::find_by_id($value->shift_period)->name ?></td>
        <!-- <td><?php //echo Schedule::STATUS[$value->status] ?></td> -->
        <td><?php echo $value->status == '0' ? '<i class="fa fa-circle text-danger"></i>' : '<i class="fa fa-circle text-success"></i>' ?></td>
        <td>
          <button type="button" class="edit" data-id="<?php echo $value->id ?>">Edit</button>
        </td>
      </tr>
    <?php } ?>
<?php } ?>
