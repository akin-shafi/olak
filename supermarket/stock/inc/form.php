<?php require_once('../../private/initialize.php'); ?>

<?php 
if(isset($_POST['stockForm'])){ 
  $id = $_POST['id'];
  // $ref = product::find_by_id($id)->ref_no ?? '0';
  // $editStock = StockDetails::find_by_item($id);
  // $find = StockDetails::find_by_ref($ref);
  // pre_r($find);
?>
<div class="modal-body row" id="append">
    <input type="hidden" name="addStock[created_by]" class="form-control" value="<?php echo $loggedInAdmin->id ?>">
    <div class="col-12 text-center text-danger flash inifinte animated" id="stockErrors"></div>
    <div class="form-group col-sm-6">
      <label>Item Name</label>
      
      <!-- <input type="text" name="addStock[item]" placeholder="e.g Rice" class="form-control"> -->
      <select readonly name="addStock[item_id]" class="form-control">
        <option value="">--Select--</option>
        <?php foreach (Product::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
          <option value="<?php echo $value->id ?>"  <?php echo $id == $value->id ? 'selected' : '' ?>><?php echo $value->pname ?></option>
        <?php } ?>
        
        
      </select>
    </div>

    <div class="form-group col-sm-6">
      <label>Quantity Supplied</label>
      <input type="number" min="0" name="addStock[supply]" placeholder="e.g 19" class="form-control" id="supply">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button type="submit" id="addStock" class="btn btn-secondary save-event waves-effect waves-light">Submit</button>
</div>

<?php } exit();?>