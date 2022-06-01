<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
   
   <div class="text-danger text-center"><?php echo display_errors($store->errors); ?></div>
   <!-- <div class="col-md-6"> -->
      <input type="hidden" id="loggedInAdmin" name="store[created_by]" value="<?php echo $loggedInAdmin->id; ?>">
      <div class="form-group col-md-6">
         <label class="control-label" for="name">Name</label>
         <input type="text" name="store[name]" value="<?php echo $store->name ?>"  class="form-control input-sm" id="name" />
      </div>

      <div class="form-group col-md-6">
         <label class="control-label" for="code">Store Categoty</label>
         <input type="text" name="store[category]" value="<?php echo $store->category ?>"  class="form-control input-sm" id="category" />

         
         
      </div>



      <div class="form-group col-md-12">
         <label for="logo">Picture</label>                     
         <input type="file" name="userfile" id="logo">
      </div>

      <!-- <div class="form-group col-md-6">
         <label class="control-label" for="email_address">Email Address</label>
         <input type="text" name="email" value=""  class="form-control input-sm" id="email_address" />
      </div>

      <div class="form-group col-md-6">
         <label class="control-label" for="phone">Phone</label>
         <input type="text" name="phone" value=""  class="form-control input-sm" id="phone" />
      </div>

      <div class="form-group col-md-6">
         <label class="control-label" for="address1">Address line 1</label>
         <input type="text" name="address1" value=""  class="form-control input-sm" id="address1" />
      </div>

      <div class="form-group col-md-6">
         <label class="control-label" for="address2">Address line 2</label>
         <input type="text" name="address2" value=""  class="form-control input-sm" id="address2" />
      </div>

      <div class="form-group col-md-6">
         <label class="control-label" for="city">City</label>
         <input type="text" name="city" value=""  class="form-control input-sm" id="city" />
      </div>

      <div class="form-group col-md-6">
         <label class="control-label" for="state">State</label>
         <input type="text" name="state" value=""  class="form-control input-sm" id="state" />
      </div>

      <div class="form-group col-md-6">
         <label class="control-label" for="postal_code">Postal Code</label>
         <input type="text" name="postal_code" value=""  class="form-control input-sm" id="postal_code" />
      </div>

      <div class="form-group col-md-6">
         <label class="control-label" for="country">Country</label>
         <input type="text" name="country" value=""  class="form-control input-sm" id="country" />
      </div> -->

      <div class="form-group col-md-6">
         <label class="control-label" for="receipt_header">Receipt Header</label>
         <textarea name="receipt_header" cols="40" rows="10"  class="form-control tip" id="receipt_header" style="height:100px;"></textarea>
      </div>

      <div class="form-group col-md-6">
         <label class="control-label" for="receipt_footer">Receipt Footer</label>
         <textarea name="receipt_footer" cols="40" rows="10"  class="form-control tip" id="receipt_footer" style="height:100px;"></textarea>
      </div>

      <div class="form-group col-md-6">
         <input type="submit" name="add_store" value="Add Store"  class="btn btn-primary" />
      </div>
   <!-- </div> -->
   </form>