
<?php 
   if ($page_title == 'Edit') {
     $url = url_for('/suppliers/edit.php?id=' . h(u($id)));
   }else{
      $url = "";
   }
 ?>
 <form action="<?php echo $url ?>" method="post" accept-charset="utf-8">
    <!-- <input type="hidden" name="spos_token" value="49838b1047939f60a39bb3ba432c9cd5" /> -->
    <div class="text-danger text-center"><?php echo display_errors($supplier->errors); ?></div>
    <div class="col-md-6">
      <div class="row">
                        <div class="col-xs-6">
                           <div class="form-group">
                              <label class="control-label" for="code">Company Name </label>
                              <input type="text" name="supplier[company_name]" value="<?php echo h($supplier->company_name); ?>"  class="form-control input-sm kb-text" id="company_name" required />
                           </div>
                        </div>

                        <div class="col-xs-6">
                           <div class="form-group">
                              <label class="control-label" for="code">Company Phone</label>
                              <input type="text" name="supplier[company_phone]" value="<?php echo h($supplier->company_phone); ?>"  class="form-control input-sm kb-text" id="company_name" required />
                           </div>
                        </div>
                     </div>


                      <div class="row">
                       
                        <div class="col-xs-12">
                           <div class="form-group">
                              <label class="control-label" for="email">email</label>
                              <input type="text" name="supplier[email]" value="<?php echo h($supplier->email); ?>"  class="form-control input-sm kb-pad" id="cemail" required />
                           </div>
                        </div>
                     </div>
                     <div class="row">
                       
                        <div class="col-xs-12">
                           <div class="form-group">
                              <label class="control-label" for="company_address">Company Address</label>
                              <textarea  name="supplier[company_address]" value="<?php echo h($supplier->company_address); ?>"  class="form-control input-sm kb-pad" id="ccompany_address" required><?php echo h($supplier->company_address); ?></textarea>
                              <!-- <input type="text" /> -->
                           </div>
                        </div>
                     </div>
                     <div class="row">
                       
                        <div class="col-xs-6">
                           <div class="form-group">
                              <label class="control-label" for="contact_person">Contact Person [Fullname]</label>
                              <input type="text" name="supplier[contact_person]" value="<?php echo h($supplier->contact_person); ?>"  class="form-control input-sm kb-pad" id="ccontact_person" required />
                           </div>
                        </div>
                    <!--  </div>
                     <div class="row">
                        -->
                        <div class="col-xs-6">
                           <div class="form-group">
                              <label class="control-label" for="phone">Phone</label>
                              <input type="text" name="supplier[phone]" value="<?php echo h($supplier->phone); ?>"  class="form-control input-sm kb-pad" id="cphone" required />
                           </div>
                        </div>
                     </div>
                     


      <div class="form-group">
        <input type="submit"  value="Add supplier"  class="btn btn-primary" />
      </div>
    </div>
</form> 

