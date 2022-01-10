   <div id="add_addition" class="modal custom-modal fade" role="dialog">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Add Addition</h5>
           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form id="add_addition_form">
             <input type="hidden" name="adding" value="1" readonly>
             <div class="form-group">
               <label>Name <span class="text-danger">*</span></label>
               <input type="text" name="addition[name]" id="addition_name" class="form-control" required>
             </div>
             <div class="form-group">
               <label>Value (%)</label>
               <div class="input-group">
                 <input type="text" name="addition[value]" id="addition_value" class="form-control" required>
                 <span class="input-group-text">%</span>
               </div>
             </div>

             <div class="submit-section">
               <button class="btn btn-primary submit-btn" id="addition_btn">Submit</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>

   <div id="add_overtime" class="modal custom-modal fade" role="dialog">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Add Overtime</h5>
           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form id="add_overtime_form">
             <input type="hidden" name="overtimes" value="1" readonly>
             <div class="form-group">
               <label>Name <span class="text-danger">*</span></label>
               <input name="overtime[name]" id="overtime_name" class="form-control" type="text" required>
             </div>
             <div class="form-group">
               <label>Daily (%) <span class="text-danger">*</span></label>
               <input name="overtime[value]" id="overtime_value" class="form-control" type="text" required>
             </div>
             <div class="submit-section">
               <button class="btn btn-primary submit-btn" id="overtime_btn">Submit</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>

   <div id="add_deduction" class="modal custom-modal fade" role="dialog">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Add Deduction</h5>
           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form id="add_deduction_form">
             <input type="hidden" name="reducing" value="1" readonly>
             <div class="form-group">
               <label>Name <span class="text-danger">*</span></label>
               <input type="text" name="deduction[name]" id="deduction_name" class="form-control" required>
             </div>
             <div class="form-group">
               <label>Value (%)</label>
               <div class="input-group">
                 <input type="text" name="deduction[value]" id="deduction_value" class="form-control" required>
                 <span class="input-group-text">%</span>
               </div>
             </div>

             <div class="submit-section">
               <button class="btn btn-primary submit-btn" id="deduction_btn">Submit</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>