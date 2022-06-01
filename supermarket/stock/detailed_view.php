<?php require_once('../private/initialize.php'); 
// require_login();
$page_title = 'Restaurant | Dashboard'; 
$page_type = 'HasTable';
?> 
<?php include(SHARED_PATH . '/header.php'); ?>
<style type="text/css">
  .editCat-btn{
    margin-bottom: -20px; 
    margin-left: -10px; 
    position: relative; 
    z-index: 1;
  }
  .fs-12{font-size: 12px !important}
</style>
    <div class="container-fluid">
        
        
         <div class="mb-1 btn-group d-none">
           <a class="btn btn-sm btn-secondary" href="<?php echo url_for('restaurant/stock_mgt/open_stock.php') ?>">Open Register</a>
           <a class="btn btn-sm btn-outline-primary" href="<?php echo url_for('restaurant/stock_mgt/close_stock.php') ?>">Close Register</a>
         </div>
         <div class="row d-flex justify-content-center mn-4">
            <?php echo display_session_message(); ?>
            <?php echo isset($addCategory->errors) ? display_errors($addCategory->errors) : ""; ?> 
            <?php echo isset($editCat->errors) ? display_errors($editCat->errors) : ""; ?> 
          </div>


        <div class="row">
            <div class="col-xl-12 col-xxl-6 col-sm-12">

              <div  class="card">
                  <div class="card-footer border-bottom pt-0 pb-0 text-center">
                       <?php 
                            
                        ?>
                  </div>

                  <div class="card-body pb-0 ">
                    <h5 class="text-uppercase">Stock Record</h5>
                     
                     <?php if (in_array($loggedInAdmin->admin_level, [1])) { ?>
                      <div class="d-flex justify-content-between pb-3">
                          <div class="btn-group">
                            <a href="<?php echo url_for('/restaurant/stock/index.php') ?>" class="btn btn-sm btn-outline-dark view" id="1">List view</a>
                            <a href="<?php echo url_for('/restaurant/stock/detailed_view.php') ?>" class="btn btn-sm btn-dark view" id="2">Detailed view</a>
                          </div>
                          <div class="btn-group">   
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#stockModal"><i class="fa fa-plus"></i> Create Stock</button>
                           
                          </div>
                      </div>
                      <?php } ?>
                      
                      
                      <h3 class="text-center text-uppercase">Stock Record for: <span id="title1"></span></h3>
                        <table class="table table-sm table-bordered" id="">
                          <!-- <table id="example5" class="display table table-sm table-bordered"> -->
                          <thead>
                            <tr>
                              <th></th>
                              <th colspan="5" class="text-center fs-20 alert-secondary">Open Stock</th>
                              <th colspan="5" class="text-center fs-20 alert-primary">Close Stock</th>
                            </tr>
                            <tr class="text-center">
                              <th>S/n</th>
                              <th>created On</th>
                              <th>Item</th>
                              <th>Ref No</th>
                              <th>Initial Stock</th>
                              <th>Supply</th>
                              <th>Total Stock</th>
                              <!--  -->
                              <!-- <th>Total.Amt</th> -->
                              <th>Unit Sold</th>
                              <th>Unit Price</th>
                              <th>Total Amt.</th>
                              <th>Avail Stock</th>
                              <!-- Close -->
                              
                              <!-- <th></th> -->
                              <!-- <th></th> -->
                              
                            </tr>
                          </thead>
                          <tbody id="list">
                              
                          <tbody>
                        </table>
                      
                  </div>
                  
               </div>
            </div>

            
        </div>
    </div>

   <!--  Adjustment made 

    initial value = 4,085,000.00
    New Value = 3,435,000.00
    Difference = 650,000.00


    Declared Value = 3,305,000.00
    Difference = 130,000.00

    2,748,000.00
    687,000.00 -->


<div class="modal fade none-border show" id="stockModal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Item</strong></h4>
            </div>
            <form method="post" id="form">
              <input type="hidden" name="addStock[created_by]" class="form-control" value="<?php //echo $loggedInAdmin->id ?>">
            <div class="modal-body row">
              <div class="col-12 text-center text-danger flash inifinte animated" id="stockErrors"></div>
              <div class="form-group col-sm-6">
                <label>Item Name</label>
                
                <!-- <input type="text" name="addStock[item]" placeholder="e.g Rice" class="form-control"> -->
                <select name="addStock[item_id]" class="form-control">
                  <option value="">--Select--</option>
                  <?php foreach (Products::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                  <?php } ?>
                  
                </select>
              </div>

              <div class="form-group col-sm-6">
                <label>Quantity Supplied</label>
                <input type="text" name="addStock[supply]" placeholder="e.g 19" class="form-control" id="supply">
              </div>

              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" id="addStock" class="btn btn-secondary save-event waves-effect waves-light">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade none-border show" id="ItemModal" aria-modal="true">
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
  var date = $('#date').val();
  load_product(date);
  function load_product(date) {
    // var edate = ("#date").val();
    $.ajax({
          url: 'inc/stock_history.php',
          method: 'post',
          data: {
            fetch: 1,
            date: date,
          },
          success: function(data) {
            $('#list').html(data);
               var t = $("#title2").text()
               $("#title1").text(t)     
          }
      });

  }
  
  $(document).on('change', '#date', function(){
        // var val = $('#state').val();
        var date = $(this).val();
        load_product(date);
        // counted_data()
  });
  

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
              load_product(date);
              $('#form')[0].reset();
            }else{
              $("#ItemErrors").html(r.msg)
            }           
          }

      });
  })


// ***************** Add Stock *********************//

  // $(document).on('input', '#supply', function(e){
  //   var value = $(this).val();
   
  // })   

  $(document).on('input', '#unit_price', function(e){
    var unit_price = $(this).val();
    // $("#open_stock").val(value)
    var supply = $("#supply").val();
    $("#total_value").val(parseFloat(unit_price) * parseFloat(supply));
  }) 
  $(document).on('click', '#addStock', function(e){
    e.preventDefault();
      $.ajax({
          url: 'inc/stock_crud.php',
          method: 'post',
          // data: {new: 1,},
          data: $('#form').serialize(),
          dataType: 'json',
          success: function(r) {
            if(r.msg == 'OK'){
              successTime("Stock Added Succesfully" );
              $("#stockModal").modal('hide');
              load_product(date);
              $('#form')[0].reset();
            }else{
              $("#stockErrors").html(r.msg)
            }           
          }

      });
  })

</script>

