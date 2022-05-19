<?php require_once('../../private/initialize.php'); ?>

<?php if (isset($_POST['showEdit'])) { 
$id =  $_POST['id'];
$access = AccessControl::find_by_id($id);
?>
	<form class="row" id="editForm">
		<input type="hidden" name="editRecord[id]" value="<?php echo $id ?>">
        <div class="form-group col-sm-6">
          <label class="control-label">Product Mgt</label>
          <select class="form-control" name="editRecord[product_mgt]">
            <!-- <option value="">Select</option> -->
            <?php foreach (AccessControl::VALUE as $key => $value) { ?>
            	<option value="<?php echo $key ?>" <?php echo $access->product_mgt == $key ? 'selected' : '0' ?>><?php echo $value ?></option>
            <?php } ?>
            
          </select>
        </div>

        <div class="form-group col-sm-6">
          <label class="control-label">User Mgt</label>
          <select class="form-control" name="editRecord[user_mgt]">
            <!-- <option value="">Select</option> -->
            <?php foreach (AccessControl::VALUE as $key => $value) { ?>
            	<option value="<?php echo $key ?>" <?php echo $access->user_mgt == $key ? 'selected' : '0' ?>><?php echo $value ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-sm-6">
          <label class="control-label">Stock Mgt</label>
          <select class="form-control" name="editRecord[stock_mgt]">
            <!-- <option value="">Select</option> -->
            <?php foreach (AccessControl::VALUE as $key => $value) { ?>
            	<option value="<?php echo $key ?>" <?php echo $access->stock_mgt == $key ? 'selected' : '0' ?>><?php echo $value ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-sm-6">
          <label class="control-label">Warehouse Mgt</label>
          <select class="form-control" name="editRecord[warehouse_mgt]">
            <!-- <option value="">Select</option> -->
            <?php foreach (AccessControl::VALUE as $key => $value) { ?>
            	<option value="<?php echo $key ?>" <?php echo $access->warehouse_mgt == $key ? 'selected' : '0' ?>><?php echo $value ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-sm-6">
          <label class="control-label">Procurement Mgt</label>
          <select class="form-control" name="editRecord[purchase_mgt]">
            <!-- <option value="">Select</option> -->
            <?php foreach (AccessControl::VALUE as $key => $value) { ?>
            	<option value="<?php echo $key ?>" <?php echo $access->purchase_mgt == $key ? 'selected' : '0' ?>><?php echo $value ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-sm-6">
          <label class="control-label">Shift Mgt</label>
          <select class="form-control" name="editRecord[shift_mgt]">
            <!-- <option value="">Select</option> -->
            <?php foreach (AccessControl::VALUE as $key => $value) { ?>
              <option value="<?php echo $key ?>" <?php echo $access->shift_mgt == $key ? 'selected' : '0' ?>><?php echo $value ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-sm-6">
          <label class="control-label">Ledger Mgt</label>
          <select class="form-control" name="editRecord[ledger_mgt]">
            <!-- <option value="">Select</option> -->
            <?php foreach (AccessControl::VALUE as $key => $value) { ?>
              <option value="<?php echo $key ?>" <?php echo $access->ledger_mgt == $key ? 'selected' : '0' ?>><?php echo $value ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="p-3 border-top d-flex justify-content-between">
	        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
	        <button type="button" name="genManifest" class="btn btn-sm bg-gradient-primary" id="editRecord">Edit</button>
	      </div>
      </form>
<?php } ?>

<?php if(isset($_POST['addRecord'])){
  $args = $_POST['addRecord'];
  $addRecord = new AccessControl($args);
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
    $editRecord = AccessControl::find_by_id($id);
    $editRecord->merge_attributes($args);
    $result = $editRecord->save();

    if ($result == true) {
      exit(json_encode(['msg' => 'OK']));  
    } else {
      exit(json_encode(['msg' => display_errors($editRecord->errors)]));
    }
}?>

<?php if (isset($_POST['record'])) { ?>
	<?php $sn = 1; foreach (AccessControl::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
      <tr class="text-center">
        <td><?php echo $sn++ ?></td>
        <td><?php echo Admin::find_by_id($value->user_id)->full_name(); ?></td>
        <td>
         
          <?php echo $value->product_mgt == '0' ? '<i class="fa fa-circle text-danger"></i>' : '<i class="fa fa-circle text-success"></i>' ?>
        </td>
        <td>
          <?php echo $value->user_mgt == '0' ? '<i class="fa fa-circle text-danger"></i>' : '<i class="fa fa-circle text-success"></i>' ?>
        </td>
        <td>
          <?php echo $value->stock_mgt == '0' ? '<i class="fa fa-circle text-danger"></i>' : '<i class="fa fa-circle text-success"></i>' ?>
        </td>
        <td>
          <?php echo $value->warehouse_mgt == '0' ? '<i class="fa fa-circle text-danger"></i>' : '<i class="fa fa-circle text-success"></i>' ?>
        </td>
        <td>
          <?php echo $value->purchase_mgt == '0' ? '<i class="fa fa-circle text-danger"></i>' : '<i class="fa fa-circle text-success"></i>' ?>
        </td>
        <td>
          <?php echo $value->shift_mgt == '0' ? '<i class="fa fa-circle text-danger"></i>' : '<i class="fa fa-circle text-success"></i>' ?>
        </td>
        <td>
          <?php echo $value->ledger_mgt == '0' ? '<i class="fa fa-circle text-danger"></i>' : '<i class="fa fa-circle text-success"></i>' ?>
        </td>
        <td>
          <button type="button" class="edit" data-id="<?php echo $value->id ?>">Edit</button>
        </td>
      </tr>
    <?php } ?>
<?php } ?>
