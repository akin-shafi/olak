<div class="col-xs-12">
   <div class="box box-primary">
      <div class="box-body">
         <div class="col-lg-12">
            <!-- <p>Please update the information below</p> -->
            <form action="<?php echo $url ?>" method="post" accept-charset="utf-8">
               <div class="text-danger text-center"><?php //echo display_errors($category->errors); ?></div>
                <div class="col-lg-12">
                  <input type="hidden" name="admin[created_by]" value="<?php echo $loggedInAdmin->id; ?>">
                  <div class="form-group">
                     <label for="first_name">Category</label>                            
                     <input type="text" name="category[category]" value=""  class="form-control tip" id="first_name"  required="required" />
                  </div>
                 
                  
                </div>
                <button class="btn btn-primary pull-right">Add</button>
               </form>
               <div class="clearfix"></div>
         </div>
      </div>
   </div>
</div>