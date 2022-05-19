<?php require_once('../private/initialize.php');
$page_title = 'All Items';
$page = 'Warehouse';
require_login();

include(SHARED_PATH . '/store-header.php'); ?>
<style>
  .err {
    border: 1px solid red;
  }

  #hide {
    display: none;
  }
  .insureNotice,.list-inc{
    display:none;
  }
  caption {
     color: #000 !important; 

}
</style>
 <div class="content-wrapper">
    <section class="content-header">
       <h1>All Items in Store</h1>
       
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
                  <div class="dropdown pull-right">
                    <?php if ($loggedInAdmin->id == 1) { ?>
                      <button class="daterange-container btn btn-danger " id="clearData">
                        <i class="fa fa-trash-o"></i>  Clear all Data
                      </button>
                    <?php } ?>
                      
                      <a href="<?php echo url_for('warehouse/category') ?>" class="daterange-container btn btn-warning">
                        Items Categories
                      </a>
                      <div class="daterange-container btn btn-primary" id="addInvoice">
                        Register New Item
                      </div>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                      </ul>
                   </div>
                   <h5 class="text-uppercase">Warehouse Items</h5>
                      <div class="d-flex justify-content-between pb-3">
                          <div class="btn-group">
                            
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
                            <th>Measurement</th>
                            <th>Last Supply</th>
                            <th>Unit Issued</th>
                            <!-- <th>Issued To</th> -->
                            <th>Avail Unit</th>
                            <th>Value</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody >

                             <?php $sn = 1; 
                             foreach (WarehouseItem::find_by_undeleted(['order' => 'ASC']) as $key => $item) {
                              // $value = intval($item->price) * $item->quantity;
                              // // pre_r($item);

                              if (!empty($item->ref_no)) {
                                $WarehouseItemDetails = WarehouseItemDetails::find_by_ref_no($item->ref_no);
                                $unit = $WarehouseItemDetails->unit_cost ?? 0;
                                $supply = $WarehouseItemDetails->qty_supplied ?? "0";
                                $unit_issued = $WarehouseItemDetails->sold_stock ?? "0";
                                // $issued_to = $WarehouseItemDetails->issued_to ?? "0";
                                $qty_left = $WarehouseItemDetails->qty_left ?? "0";
                                $value = $supply * $unit ?? "0";
                              }else{
                                $supply = "Not Set";
                                $unit_issued = "Not Set";
                                // $issued_to = "Not Set";
                                $qty_left = "Not Set";
                                $value = "Not Set";
                              }
                              ?>
                                <tr class="text-center">
                                  <td><?php echo $sn++; ?>.</td>
                                  <td>
                                    <a class="" href="<?php echo url_for('warehouse/items.php?id='.$item->id) ?>" style="text-decoration: underline;" data-id="<?php echo $item->id ?>">
                                    <?php echo $item->item_name; ?></a></td>
                                  <td><?php echo $item->measurement; ?></td>
                                  <td><?php echo $supply; ?></td>
                                  <td><?php echo $unit_issued; ?></td>
                                  <!-- <td><?php //echo $issued_to; ?></td> -->
                                  <td><?php echo $qty_left; ?></td>
                                  <td><?php echo $value; ?></td>
                                  
                                  <td>
                                    <button type="button" class="btn btn-sm bg-maroon addItem" data-id="<?php echo $item->id ?>"><i class="fa fa-plus"></i> Add Stock</button>
                                    <button type="button" class="btn btn-sm bg-black editItem" data-id="<?php echo $item->id ?>"><i class="fa fa-pencil"></i> Edit Category</button>
                                  </td>
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


<div class="modal fade" data-easein="flipYIn" id="addModal">
    <div class="modal-dialog modal-lg modal-dialog-top" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h3 class="modal-title" id="exampleModalCenterTitle">New Item </h3>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        </div>
        <center id="addError"></center>
        <form class="form-group" method="post" id="itemForm">
          <input type="hidden" name="created_by" value="<?php echo $loggedInAdmin->id; ?>">
          <div class="modal-body">
            <div class="table-responsive">
              <span id="error"></span>
                <table class="table table-sm table-borderless">
                  <thead>
                    <tr class="fs-12">
                      <th class="fs-12">SN.</th>
                      <th >Item Name:</th>
                      <th >Measurement:</th>    
                      <th >Category:</th>    
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody id="items">
                    <tr>
                      <td>1.</td>
                      <td>
                        <input type="text"  name="item_name[]" id="name1" class="form-control name" placeholder="Item Name">
                      </td>
                      <td>
                        <input type="text" name="measurement[]" id="measurement1" class="form-control measurement" placeholder="Measurement">

                      </td>
                      <td>
                        <!-- <input type="text"  name="item_name[]" id="name1" class="form-control form-control-sm name" placeholder="Item Name"> -->
                        <select class="form-control category" <select class="form-control category" name="category">>
                          <option value="">Select Category</option>
                          <?php foreach (WarehouseItemCategory::find_by_undeleted() as $key => $value) { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->category; ?></option>
                          <?php } ?>
                          
                        </select>
                      </td>

                      
                      <td><span class="btn" id="add"><i class="fa fa-plus text-success"></i></span></td>
                    </tr>
                  </tbody>

                  
                </table>
                

                <tr>
                  <th class="text-bold" class="fs-12">Total: <b class="text-danger total_item">1 item</b> 
                    <input type="hidden" name="total_item" id="item_amt" value="1"></th>
                </tr>
            </div>
          </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary " id="btnAdd">Add</button>
          <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Cancel</button>
        </div>
        </form>
      </div>
    </div>
  </div>

<div class="modal fade none-border" id="stockModal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Item</strong></h4>
            </div>
            <form method="post" id="form"></form>
        </div>
    </div>
</div>

<div class="modal fade none-border" id="editModal" aria-modal="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h4 class="modal-title"><strong>Edit Item</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>

            </div>
            <div class="modal-body row" id="append">
              <div id="editErrors"></div>
              <form method="post" id="fetchForm"></form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary " id="editCategory">Edit</button>
              <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="eUrl" value="<?php echo url_for('/warehouse/') ?>">

<?php include(SHARED_PATH . '/footer.php'); ?>
 
<script type="text/javascript">
  $(document).on('click', '.addItem', function(e){
    e.preventDefault();
    var eid = $(this).data('id');
    var ref = $(this).data('ref');
    $("#stockModal").modal("show");
    $.ajax({
          url: 'inc/form.php',
          method: 'post',
          data: {
            stockForm: 1,
            id: eid,
          },
          success: function(r) {
            $("#form").html(r)         
          }

      });
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
  function cal_final_total(quantity, unit_cost) {

      if (quantity > 0) {
        
        if (unit_cost > 0) {
             var actual_amount = parseFloat(quantity) * parseFloat(unit_cost);
              $('#total_cost').val(actual_amount); 
        }

      }

  }


  $(document).on('click', '#addItem', function(e){
    e.preventDefault();
    var eUrl = $("#eUrl").val();
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
              window.location.href = eUrl;
            }else{
              $("#stockErrors").html(r.msg)
            }           
          }

      });
  })

  var eUrl = $("#eUrl").val();
  $(document).on("click", "#addInvoice", function(){
    $("#addModal").modal("show")
  })

addMultipleFormInput();
function addMultipleFormInput(){


   var final_total_amount = $('#final_total_amount').text();
      // console.log(final_total_amount)
      
      var count = 1;
      $(document).on('click', '#add', function() {
        count = count + 1;

        if (count <= 1) {
          $('.total_item').text(count + ' item');
          $('#item_amt').val(count);
        } else {
          $('.total_item').text(count + ' items');
          $('#item_amt').val(count);
        }

        var html_code = '';
        html_code += '<tr id="row_id' + count + '">';
        html_code += '<td><span id="sr_no">'+count+'.</span></td>';
        html_code += '<td><input type="text"  name="item_name[]" id="name' + count + '" data-srno="' + count + '" class="form-control  name" placeholder="Item Name"></td>';
        html_code += '<td><input type="text"  name="measurement[]" id="measurement' + count + '" data-srno="' + count + '" class="form-control  measurement" placeholder="measurement"></td>';

        html_code += '<td><select class="form-control category" <select class="form-control category" name="editCategory[category]">><option value="">Select Category</option><?php foreach (WarehouseItemCategory::find_by_undeleted() as $key => $value) { ?><option value="<?php echo $value->id; ?>"><?php echo $value->category; ?></option><?php } ?></select></td>';

        html_code += '<td><span class="btn remove" id="' + count + '"><i class="fa fa-minus text-danger bold fs-22"></i></span></td>';

        $('#items').append(html_code);

      });


      // Remove Item

      $(document).on('click', '.remove', function() {
          var row_id = $(this).attr('id');
          

          $('#row_id' + row_id).remove();
          count = count - 1;
          if (count <= 1) {
            $('.total_item').text(count + ' item');
            // $('#item_amt').val(count);
          } else { 
            $('.total_item').text(count + ' items');
             // $('#item_amt').val(count);
          }
      });


      $(document).on('click', '#btnAdd', function(e) {
      e.preventDefault();
      var error = '';
      $('.name').each(function() {
        var count = 1;
        if ($(this).val() == '') {
          $('.name').removeClass('suc');
          $('.name').addClass('err');
          error += 'Enter item type at row ' + count + '. ';
          return false;
        } else {
          $('.name').removeClass('err');
          $('.name').addClass('suc');
          return true;
        }
        count = count + 1;
      });
      $('.measurement').each(function() {
        var counter = 1;
        if ($(this).val() == '') {
          $('.measurement').removeClass('suc');
          $('.measurement').addClass('err');
          error += 'Enter measurement at row ' + counter + '. ';
          return false;
        } else {
          $('.measurement').removeClass('err');
          $('.measurement').addClass('suc');
          return true;
        }
        counter = counter + 1;
      });
      $('.category').each(function() {
        var counter = 1;
        if ($(this).val() == '') {
          $('.category').removeClass('suc');
          $('.category').addClass('err');
          error += 'Enter category at row ' + counter + '. ';
          return false;
        } else {
          $('.category').removeClass('err');
          $('.category').addClass('suc');
          return true;
        }
        counter = counter + 1;
      });
      

      // var formData = $(this).serialize();
      if (error == '') {
        
        $.ajax({
          url: 'inc/addItem.php',
          method: 'POST',
          data: $('#itemForm').serialize(),
          dataType: 'json',
          success: function(r) {
            if (r.msg == 'OK') {
              $("#addModal").modal("hide");
              $("#itemForm")[0].reset();
              successAlert("Invoice raised successfully.")
              window.location.href = eUrl
            }else{
                
                $("#addError").html(r.error)
                errorAlert("Error: Something went wrong.")
            }
          }
        });
      } else {
          errorAlert("TO CONTINUE PLEASE, FILL ALL THE NECCESSARY FIELDS.");
      }



    });
     
   
}

$(document).on("click", ".editItem", function(){
  $("#editModal").modal("show");
    var eid = $(this).data('id');
    $.ajax({
            url: 'inc/fetch_form.php',
            method: 'post',
            data: {
              stockForm: 1,
              id: eid,
            },
            success: function(r) {
              $("#fetchForm").html(r)       
            }
    });
})

// Edit Stock
$(document).on('click', '#editCategory', function(e){
  e.preventDefault();
    $.ajax({
       url: 'inc/crud.php',
       method: 'post',
       data: $('#fetchForm').serialize(),
       dataType: 'json',
        success: function(r) {
          if (r.msg == 'OK') {
            successTime("Item updated Succesfully");
            $("#editModal").modal('hide'); 
            window.location.href = eUrl
          }else{
            $("#editErrors").html(r.msg)
          }   
        }

    });
})

$(document).on("click", ".deleteItem", function(){
  // $("#editModal").modal("show");
    var eid = $(this).data('id');
    $.ajax({
            url: 'inc/crud.php',
            method: 'post',
            data: {
              delete: 1,
              id: eid,
            },
            dataType: 'json',
            success: function(r) {
              if (r.msg == 'OK') {
                successTime("Deleted Succesfully");
                window.location.href = eUrl
              }else{
                errorAlert(r.msg)
              }         
            }
    });
})
$(document).on("click", "#clearData", function(){
    if (confirm("Are you sure you want to clear all data ?")) {
      $.ajax({
              url: 'inc/crud.php',
              method: 'post',
              data: {
                deleteAll: 1,
                // id: eid,
              },
              dataType: 'json',
              success: function(r) {
                if (r.msg == 'OK') {
                  successTime("Deleted Succesfully");
                  window.location.href = eUrl
                }else{
                  errorAlert(r.msg)
                }         
              }
      });
    }else{
        return false
    }
})

</script>

