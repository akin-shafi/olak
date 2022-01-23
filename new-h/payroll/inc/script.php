<?php require_once('../../private/initialize.php'); ?>

 <?php if (isset($_POST['fetch'])) { 
 	$staff_id = $_POST['staff_id'] ?? '';
 	$employee = Employee::find_by_id($staff_id);
 	$salary = $employee->present_salary ?? 0;

 ?>
 	<div class="row">
	  <div class="col-sm-6">
	     <div class="form-group">
	        <label>Select Staff</label>
	        <select class="form-control select2" id="staff_id">
	           <option value="">--- Select ---</option>
	           <?php foreach (Employee::find_by_undeleted() as $key => $value) { ?>
	               <option <?php echo $value->id == $staff_id ? 'selected' : '' ?> value="<?php echo $value->id ?>" data-salary="<?php echo $value->present_salary ?>"><?php echo Employee::find_by_id($value->id)->full_name() ?></option>
	           <?php } ?>
	          
	        </select>
	        
	     </div>
	  </div>
	  <div class="col-sm-6">
	     <label>Net Salary</label>
	     <input class="form-control" type="text" value="<?php echo $salary ?>">
	  </div>
	</div>
	<div class="row">
	  <div class="col-sm-6">
	     <h4 class="text-primary">Earnings</h4>
	     <?php foreach (PayrollItem::find_by_category(1) as $key => $allItem) { ?>
	     
		     <div class="form-group">
		        <label><?php echo $allItem->item ?>( <?php echo $allItem->amount ?>%)</label>
		        <input class="form-control" type="text" value="<?php echo $salary / 100 * $allItem->amount   ?>">
		     </div>
	     <?php } ?>

	     
	     <!-- <div class="add-more">
	        <a href="#"><i class="fa fa-plus-circle"></i> Add More</a>
	     </div> -->
	  </div>
	  <div class="col-sm-6">
	     <h4 class="text-primary">Deductions</h4>
	     <?php foreach (PayrollItem::find_by_category(3) as $key => $allItem) { ?>

		     <div class="form-group">
		        <label><?php echo $allItem->item ?>( <?php echo $allItem->amount ?>%)</label>
		        <?php if ($allItem->item  == "Tax(PAYE)") { 
		        	$netPay = $salary * 12;
		        ?>
		        	<input class="form-control" type="text" value="PayE">
		        <?php } else {  ?>
		        	<input class="form-control" type="text" value="<?php echo $salary / 100 * $allItem->amount   ?>">
		        <?php } ?>
		     </div>
	     <?php } ?>
	     
	     <!-- <div class="add-more">
	        <a href="#"><i class="fa fa-plus-circle"></i> Add More</a>
	     </div> -->
	  </div>
	</div>
  <?php } ?>  
	