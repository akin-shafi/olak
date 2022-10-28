<?php require_once('../../private/initialize.php'); ?>

<input type="hidden" name="salary[employee_id]" id="employee_id" readonly>
<div class="modal-body">
   <div class="form-group">
      <label>Employees</label>
      <input type="text" id="employee_name" class="form-control" readonly>
   </div>

   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label>Overtime Allowance <span class="text-danger">*</span></label>
            <input class="form-control" name="salary[overtime_allowance]" type="number" placeholder="Overtime Allowance">
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label>Leave Allowance <span class="text-danger">*</span></label>
            <input class="form-control" name="salary[leave_allowance]" type="number" placeholder="Leave Allowance">
         </div>
      </div>

      <div class="col-md-6">
         <div class="form-group">
            <label>Other Allowance <span class="text-danger">*</span></label>
            <input class="form-control" name="salary[other_allowance]" type="number" placeholder="Other Allowance">
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label>Other Deduction <span class="text-danger">*</span></label>
            <input class="form-control" name="salary[other_deduction]" type="number" placeholder="Other Deduction">
         </div>
      </div>
   </div>

   <div class="form-group">
      <label>Note</label>
      <textarea name="salary[note]" class="form-control" cols="3" placeholder="Notes"></textarea>
   </div>
</div>