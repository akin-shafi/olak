<?php require_once('../../private/initialize.php');
$page_title = 'Stock';
$page = 'Products';
require_login();

include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ." ". $page; ?></h1>
       
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" style="display:none;">
          <div class="alert alert-dismissable">
             <div class="custom-msg"></div>
          </div>
       </div>
    </div>
    <section class="content">
    	<div class="col-lg-12 alerts d-flex justify-content-center mn-4">
            <?php //echo display_errors($product->errors); ?>
         </div>
       <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary">
                
                <div class="box-body">
                   <h5 class="text-uppercase">Stock Record</h5>
                      <div class="d-flex justify-content-between pb-3">
                          <div class="btn-group">
                            
                              <a href="<?php echo url_for('/products/stock/list.php') ?>" class="btn btn-sm btn-dark view" id="1">List view</a>
                            <?php //if (in_array($loggedInAdmin->admin_level, [1])) { ?>
                              <a href="<?php echo url_for('/products/stock/detailed_view.php') ?>" class="btn btn-sm btn-outline-dark view" id="2">Detailed view</a>
                            <?php //} ?>
                          </div>
                          <!-- <div class="btn-group">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ItemModal" id="btn-item">Create Item</button>
                           
                          </div> -->
                      </div>

                      <table class="table table-sm table-bordered" id="example2">
                        <thead>
                          <tr class="text-center">
                            <th>S/n</th>
                            <th>Item</th>
                            <th>AVAIL STOCK</th>
                            <!-- <th>Sold</th> -->
                          </tr>
                        </thead>
                        <tbody >

                             <?php $sn = 1; 
                             foreach (Product::find_by_undeleted(['order' => 'ASC']) as $key => $item) { ?>
                                <tr class="text-center">
                                  <td><?php echo $sn++; ?>.</td>
                                  <td>
                                    <?php if(in_array($loggedInAdmin->admin_level, [1,4])){ ?>
                                          <a class="" href="<?php echo url_for('products/stock/items.php?id='.$item->id) ?>" style="text-decoration: underline;" data-id="<?php echo $item->id ?>">
                                            <?php echo $item->pname; ?>
                                          </a>
                                        <?php }else{ ?>
                                            <?php echo $item->pname; ?>
                                    <?php } ?>
                                    <?php //echo $item->name; ?></td>
                                  <td><?php echo $item->quantity; ?></td>
                                </tr>
                              <?php } ?>
                        <tbody>
                      </table>
                </div>
            </div>
          </div>
       </div>
       
    </section>
 </div>


<div class="modal fade none-border" id="ItemModal" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Create Item</strong></h4>
            </div>
            <form method="post" id="formItem">
              <input type="hidden" name="addItem[created_by]" class="form-control" value="<?php echo $loggedInAdmin->id ?>">
            <div class="modal-body row">
              <div class="col-12 text-center" id="ItemErrors"></div>
              <div class="form-group col-sm-12">
                <label>Item Name</label>
                
                <input type="text" name="addItem[item]" placeholder="e.g Rice" class="form-control">
              </div>

              
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" id="addItem" class="btn btn-secondary save-event waves-effect waves-light">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
 
<script type="text/javascript">
  

  $(document).on('click', '#addItem', function(e){
    e.preventDefault();
      $.ajax({
          url: 'inc/addItem.php',
          method: 'post',
          // data: {new: 1,},
          data: $('#formItem').serialize(),
          dataType: 'json',
          success: function(r) {
            if(r.msg == 'OK'){
              successTime("Stock Added Succesfully" );
              $("#ItemModal").modal('hide');
              load_product();
              $('#form')[0].reset();
            }else{
              $("#ItemErrors").html(r.msg)
            }           
          }

      });
  })

  

</script>

