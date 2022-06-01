<?php require_once('../private/initialize.php');
$page_title = 'Single | Product';
$page = 'Warehouse';
$id = $_GET['id'] ?? 1;
require_login();

include(SHARED_PATH . '/store-header.php'); ?>
<style type="text/css">
  .fs-20{font-size: 20px !important; font-weight: bold}
</style>
 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title?></h1>
       
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
                <?php
                $accessControl = AccessControl::find_by_user_id($loggedInAdmin->id)->warehouse_mgt ?? '';
                 if ($accessControl == 1): ?>
                  
                
                <div class="box-body">
                   <h5 class="text-uppercase">Inventory Details</h5>
                      <div class="d-flex justify-content-between pb-3"> 
                          <div class="">
                            <!-- <input type="date" id="inputDate" value="<?php //echo date('Y-m-d') ?>" class="form-control"> -->

                          </div>
                          <div class="btn-group">   
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#stockModal"><i class="fa fa-plus"></i> Add Item</button>
                            <!-- <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit Stock</button> -->
                           
                          </div>
                      </div>
                      <h3 class="text-center text-uppercase">Warehouse Record for: <?php echo WarehouseItem::find_by_id($id)->item_name; ?> <span id="title1"></span></h3>

                        <table class="table table-sm table-bordered" id="">
                          <!-- <table id="example5" class="display table table-sm table-bordered"> -->
                          <thead>
                            <tr>
                              <th></th>
                              <th colspan="7" class="text-center fs-20 bg-success">Open Entry</th>
                              <th colspan="5" class="text-center fs-20 bg-primary">Close Entry</th>
                              <th></th>
                            </tr>
                            <tr class="text-center">
                              <th>S/n</th>
                              <th>created On</th>
                              <th>Date Received</th>
                              <th>Item</th>
                              <th>Ref No</th>
                              <th>Initial Stock</th>
                              <th>Supply</th>
                              <th>Total Stock</th>
                              <!--  -->
                              <!-- <th>Total.Amt</th> -->
                              <th>Unit Price</th>
                              <th class="bg-maroon">Unit Issued</th>
                              <th class="bg-maroon">Value in(<?php echo $currency ?>)</th>
                              <th class="bg-olive">Avail Items</th>
                              <th class="bg-olive">Value in(<?php echo $currency ?>)</th>
                              <!-- Close -->
                              
                              <th>Action</th>
                              <!-- <th></th> -->
                              
                            </tr>
                          </thead>
                          <tbody id="list">
                            
                          <tbody>
                        </table>
                </div>
                <?php else: ?>
                  <div class="box-body">
                    <div class="alert alert-danger">Sorry you are unauthorized to updated warehouse record please contact</div>
                    <ul type="1">

                        <?php foreach (AccessControl::find_warehouse_authorized(1) as $key => $value) { ?>
                          <li><?php echo Admin::find_by_id($value->user_id)->full_name(); ?></li> OR
                        <?php } ?>
                      
                    </ul>
                  </div>
                <?php endif ?>
            </div>
          </div>
       </div>
       
    </section>
 </div>


 
<input type="hidden" id="eid" value="<?php echo $id; ?>">
<div class="modal fade none-border" id="stockModal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Item</strong></h4>
            </div>
            <form method="post" id="form">
              <input type="hidden" name="addItem[created_by]" class="form-control" value="<?php //echo $loggedInAdmin->id ?>">
                <div class="modal-body row">
                  <div class="col-12 text-center text-danger flash inifinte animated" id="stockErrors"></div>
                  <div class="form-group col-sm-6">
                    <label>Item Name: <span class="text-danger fs-16">*</span></label>
                    
                    <!-- <input type="text" name="addItem[item]" placeholder="e.g Rice" class="form-control"> -->
                    <select readonly name="addItem[item_id]" class="form-control" id="item_id">
                      <option value="">--Select--</option>
                      <?php foreach (WarehouseItem::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                        <option value="<?php echo $value->id ?>" data-m="<?php echo $value->measurement ?>"  <?php echo $id == $value->id ? 'selected' : '' ?>><?php echo $value->item_name ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-sm-6">
                    <label>Supplier Name: <span class="text-danger fs-16">*</span></label>
                    <input type="text" name="addItem[supplier]" required="" placeholder="e.g ABC Limited" class="form-control" id="supplier">
                  </div>

                  <div class="form-group col-sm-6">
                    <label>Quantity in (<span id="measurement"><?php echo WarehouseItem::find_by_id($id)->measurement ?></span>): <span class="text-danger fs-16">*</span></label>
                    <input type="number" min="0" name="addItem[qty_supplied]" required="" placeholder="e.g 19" class="form-control" id="quantity" value="0">
                  </div>

                  <div class="form-group col-sm-6">
                    <label>Supplier Contact: <span class="text-danger fs-16"></span></label>
                    <input type="text" min="0" name="addItem[supplier_contact]"  placeholder="e.g +234 801 111 2222" class="form-control" id="supplier_contact">
                  </div>

                  <div class="form-group col-sm-6">
                    <label>Unit Cost of Item: <span class="text-danger fs-16">*</span></label>
                    <input type="text" min="0" name="addItem[unit_cost]" required="" placeholder="e.g 19" class="form-control" id="unit_cost" value="0">
                  </div>

                  <div class="form-group col-sm-6">
                    <label>Total Cost: <span class="text-danger fs-16"></span></label>
                    <input type="text" readonly=""  name="addItem[total_cost]" placeholder="e.g 19" class="form-control" id="total_cost" value="0">
                  </div>


                  <div class="form-group col-sm-6">
                    <label>Received by: <span class="text-danger fs-16">*</span></label>
                    <input type="text" min="0" name="addItem[received_by]" required="" placeholder="e.g John Doe" class="form-control" id="received_by">
                  </div>

                  <div class="form-group col-sm-6">
                    <label>Date Received: <span class="text-danger fs-16">*</span></label>
                    <input type="datetime-local" min="0" name="addItem[date_received]"  required="" class="form-control" id="date_received">
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


<div class="modal fade none-border" id="editStockModal" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title"><strong> Edit Stock</strong></h4>
      </div>
      <div class="col-12 text-center" id="editStockErrors"></div>
      <form method="post" id="editStockInput">
        <div class="modal-body row" id="fetchstockForm">


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" id="editStock" class="btn btn-primary save-event waves-effect waves-light">Edit
                Stock</button>
        </div>
      </form>
    </div>
  </div>
</div>

<input type="hidden" id="eid" value="<?php echo $id;  ?>">
<?php include(SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">
  var eid = $('#eid').val();
  load_product()
  function load_product() {
    $.ajax({
          url: 'inc/fetch_item.php',
          method: 'post',
          data: {
            fetch: 1,
            id: eid
          },
          success: function(data) {
            $('#list').html(data);   
          }
      });

  }
  


// ***************** Add Stock *********************// 

  $(document).on('click', '#addItem', function(e){
    e.preventDefault();
      $.ajax({
          url: 'inc/warehouse_crud.php',
          method: 'post',
          // data: {new: 1,},
          data: $('#form').serialize(),
          dataType: 'json',
          success: function(r) {
            if(r.msg == 'OK'){
              successTime("Item Added Succesfully" );
              $("#stockModal").modal('hide');
              load_product();
              $('#form')[0].reset();
            }else{
              $("#stockErrors").html(r.msg)
            }           
          }

      });
  })
  
  $(document).on('click', '.oneItem', function(e){
      $("#editStockModal").modal('show');
      var eid = $(this).data('id');
      var ref = $(this).data('ref');
      // console.log(eid)
      $.ajax({
          url: 'inc/fetch_stock_form.php',
          method: 'post',
          data: {
            stockForm: 1,
            id: eid,
            ref: ref,
          },
          success: function(r) {
            $("#fetchstockForm").html(r)       
          }

      });
  })
// Edit Stock
    $(document).on('click', '#editStock', function(e){
      e.preventDefault();
        $.ajax({
           url: 'inc/warehouse_crud.php',
           method: 'post',
           data: $('#editStockInput').serialize(),
           dataType: 'json',
            success: function(r) {
              if (r.msg == 'OK') {
                load_product();
                successTime("Item updated Succesfully");
                $("#editStockModal").modal('hide'); 
              }else{
                $("#editStockErrors").html(r.msg)
              }   
            }

        });
    })

    $(document).on('change', '#item_id', function(e){
      var selected = $(this).find('option:selected');
      var measurement = selected.data('m');
      $("#measurement").text(measurement);

    })

    $(document).on('input', '#quantity', function(e){
      var quantity = $(this).val();
      var unit_cost = $('#unit_cost').val();
      cal_final_total(quantity, unit_cost)
    })

    $(document).on('input', '#unit_cost', function(e){
      var unit_cost = $(this).val();
      var quantity = $('#quantity').val();
      cal_final_total(quantity, unit_cost)
      
    })

    $(document).on('input', '#quantityy', function(e){
      var quantity = $(this).val();
      var unit_cost = $('#unit_costy').val();
      console.log(unit_cost)
      cal_final_total(quantity, unit_cost)
    })

    $(document).on('input', '#unit_costy', function(e){
      var unit_cost = $(this).val();
      var quantity = $('#quantityy').val();
      console.log(quantity)
      cal_final_total(quantity, unit_cost)
      
    })

    function cal_final_total(quantity, unit_cost) {

        if (quantity > 0) {
          
          if (unit_cost > 0) {
               var actual_amount = parseFloat(quantity) * parseFloat(unit_cost);
                $('#total_cost').val(actual_amount); 
          }

        }

    }
    function cal_final_total(quantity, unit_cost) {

        if (quantity > 0) {
          
          if (unit_cost > 0) {
               var actual_amount = parseFloat(quantity) * parseFloat(unit_cost);
                $('#total_costy').val(actual_amount); 
          }

        }

    }
</script>






