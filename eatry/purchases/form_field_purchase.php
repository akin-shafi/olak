<form action="https://spos.tecdiary.net/purchases/add" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">
   <input type="hidden" name="spos_token" value="3ba37286989b610e0438dbdf40dbc73b" />                                                                                                                 
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label for="date">Date</label>   
            <input type="text" name="date" value=""  class="form-control datetimepicker" id="date" required="required" />
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="reference">Reference</label>                                    <input type="text" name="reference" value=""  class="form-control tip" id="reference" />
         </div>
      </div>
   </div>
   <div class="form-group">
      <input type="text" placeholder="Search product by code or name, you can scan barcode too" id="add_item" class="form-control">
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="table-responsive">
            <table id="poTable" class="table table-striped table-bordered">
               <thead>
                  <tr class="active">
                     <th>Product</th>
                     <th class="col-xs-2">Quantity</th>
                     <th class="col-xs-2">Unit Cost</th>
                     <th class="col-xs-2">Subtotal</th>
                     <th style="width:25px;"><i class="fa fa-trash-o"></i></th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td colspan="5">Add product by searching in above fields</td>
                  </tr>
               </tbody>
               <tfoot>
                  <tr class="active">
                     <th>Total</th>
                     <th class="col-xs-2"></th>
                     <th class="col-xs-2"></th>
                     <th class="col-xs-2 text-right"><span id="gtotal">0.00</span></th>
                     <th style="width:25px;"></th>
                  </tr>
               </tfoot>
            </table>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label for="supplier">Supplier</label>                                                                        
            <select name="supplier" class="form-control select2 tip" id="supplier"  required="required" style="width:100%;">
               <option value="" selected="selected">Select Supplier</option>
               <option value="1">Test Supplier</option>
            </select>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="received">Received</label>                                                                        
            <select name="received" class="form-control select2 tip" id="received"  required="required" style="width:100%;">
               <option value="1">Received</option>
               <option value="0">Not received yet</option>
            </select>
         </div>
      </div>
   </div>
   <div class="form-group">
      <label for="attachment">Attachment</label>                            <input type="file" name="userfile" class="form-control tip" id="attachment">
   </div>
   <div class="form-group">
      <label for="note">Note</label>                            <textarea name="note" cols="40" rows="10"  class="form-control redactor" id="note"></textarea>
   </div>
   <div class="form-group">
      <input type="submit" name="add_purchase" value="Add Purchase"  class="btn btn-primary" />
      <button type="button" id="reset" class="btn btn-danger">Reset</button>
   </div>
</form>