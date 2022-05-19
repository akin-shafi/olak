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
      <label>Item Name: <span class="text-danger fs-16">*</span></label>
      
      <!-- <input type="text" name="addItem[item]" placeholder="e.g Rice" class="form-control"> -->
      <select readonly name="addItem[item_id]" class="form-control" id="item_id">
        <option value="">--Select--</option>
        <?php foreach (WarehouseItem::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
          <option value="<?php echo $value->id ?>" data-m="<?php echo $value->measurement ?>"  <?php echo $id == $value->id ? 'selected' : '' ?>><?php echo $value->item_name ?></option>
        <?php } ?>
      </select>
    </div>

    <div class="form-group col-sm-6">
      <label>Supplier Name: <span class="text-danger fs-16">*</span></label>
      <input type="text" name="addItem[supplier]" required="" placeholder="e.g ABC Limited" class="form-control" id="supplier">
    </div>

    <div class="form-group col-sm-6">
      <label>Quantity in (<span id="measurement"><?php echo WarehouseItem::find_by_id($id)->measurement ?></span>): <span class="text-danger fs-16">*</span></label>
      <input type="number" min="0" name="addItem[qty_supplied]" required="" placeholder="e.g 19" class="form-control" id="quantity" value="0">
    </div>

    <div class="form-group col-sm-6">
      <label>Supplier Contact: <span class="text-danger fs-16"></span></label>
      <input type="text" min="0" name="addItem[supplier_contact]"  placeholder="e.g +234 801 111 2222" class="form-control" id="supplier_contact">
    </div>

    <div class="form-group col-sm-6">
      <label>Unit Cost of Item: <span class="text-danger fs-16">*</span></label>
      <input type="text" min="0" name="addItem[unit_cost]" placeholder="e.g 19" required="" class="form-control" id="unit_cost" value="0">
    </div>

    <div class="form-group col-sm-6">
      <label>Total Cost: <span class="text-danger fs-16"></span></label>
      <input type="text" readonly=""  name="addItem[total_cost]" placeholder="e.g 19" class="form-control" id="total_cost" value="0">
    </div>


    <div class="form-group col-sm-6">
      <label>Received by: <span class="text-danger fs-16">*</span></label>
      <input type="text" min="0" name="addItem[received_by]" required="" placeholder="e.g John Doe" class="form-control" id="received_by">
    </div>

    <div class="form-group col-sm-6">
      <label>Date Received: <span class="text-danger fs-16">*</span></label>
      <input type="datetime-local" min="0" name="addItem[date_received]"  required="" class="form-control" id="date_received">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button type="submit" id="addItem" class="btn btn-secondary save-event waves-effect waves-light">Submit</button>
</div>

<?php } exit();?>