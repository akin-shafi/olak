
<?php 
   if ($page_title == 'Edit') {
     $url = url_for('/customers/edit.php?id=' . h(u($id)));
   }else{
      $url = "";
   }
 ?>
 <form action="<?php echo $url ?>" method="post" accept-charset="utf-8">
    <!-- <input type="hidden" name="spos_token" value="49838b1047939f60a39bb3ba432c9cd5" /> -->

    <div class="col-md-6">
      <div class="row">
                        <div class="col-xs-6">
                           <div class="form-group">
                              <label class="control-label" for="code">Firstname </label>
                              <input type="text" name="customer[first_name]" value="<?php echo h($customer->first_name); ?>"  class="form-control input-sm kb-text" id="fname" required />
                           </div>
                        </div>

                        <div class="col-xs-6">
                           <div class="form-group">
                              <label class="control-label" for="code">lastname</label>
                              <input type="text" name="customer[last_name]" value="<?php echo h($customer->last_name); ?>"  class="form-control input-sm kb-text" id="lname" required />
                           </div>
                        </div>
                     </div>
                     <div class="row">
                       
                        <div class="col-xs-12">
                           <div class="form-group">
                              <label class="control-label" for="phone">Phone</label>
                              <input type="text" name="customer[phone]" value="<?php echo h($customer->phone); ?>"  class="form-control input-sm kb-pad" id="cphone" required />
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-6">
                           <div class="form-group">
                              <label class="control-label" for="cf1">Shop address</label>
                              <input type="text" name="customer[shop_address]" value="<?php echo h($customer->shop_address); ?>"  class="form-control input-sm kb-text" id="cf1"  />
                           </div>
                        </div>
                        <div class="col-xs-6">
                           <div class="form-group">
                              <label class="control-label" for="cf2">Home address</label>
                              <input type="text" name="customer[home_address]" value="<?php echo h($customer->home_address); ?>"  class="form-control input-sm kb-text" id="cf2"  />
                           </div>
                        </div>
                     </div>


      <div class="form-group">
        <input type="submit"  value="Add Customer"  class="btn btn-primary" />
      </div>
    </div>
</form> 

