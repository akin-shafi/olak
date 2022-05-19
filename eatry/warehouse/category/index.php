<?php require_once('../../private/initialize.php');
$page_title = 'All Categories';
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
       <h1><?php echo $page_title; ?></h1>
       
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
                      <div class="daterange-container btn btn-primary" id="addInvoice">
                        Create New Category
                      </div>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                      </ul>
                   </div>
                   <h5 class="text-uppercase">Warehouse Items</h5>
                      <div class="d-flex justify-content-between pb-3">
                          <div class="btn-group">
                            
                              <a href="<?php echo url_for('/products/stock/list.php') ?>" class="btn btn-sm btn-dark view" id="1">List view</a>
                            <?php //if (in_array($loggedInAdmin->admin_level, [1])) { ?>
                              <a href="<?php echo url_for('/products/stock/detailed_view.php') ?>" class="btn btn-sm btn-outline-dark view d-none" id="2">Detailed view</a>
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
                            <th>Category</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody >

                             <?php $sn = 1; 
                             foreach (WarehouseItemCategory::find_by_undeleted(['order' => 'ASC']) as $key => $item) {
                              ?>
                                <tr class="text-center">
                                  <td><?php echo $sn++; ?>.</td>
                                  <td><?php echo $item->category ?></td>
                                  
                                  <td>
                                    <button type="button" class="btn btn-sm bg-yellow editItem" data-id="<?php echo $item->id ?>"><i class="fa fa-pencil"></i> Edit</button>
                                    <button type="button" class="btn btn-sm bg-maroon deleteItem" data-id="<?php echo $item->id ?>"><i class="fa fa-trash"></i> Delete </button>
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
          <h3 class="modal-title" id="exampleModalCenterTitle">New Category </h3>
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
        </div>
        <center id="errors"></center>
             <form class="form-group" method="post" id="itemForm">
          <input type="hidden" name="created_by" value="<?php echo $loggedInAdmin->id; ?>">
          <div class="modal-body">
            <div class="table-responsive">
              <span id="error"></span>
                <table class="table table-sm table-borderless">
                  <thead>
                    <tr class="fs-12">
                      <th class="fs-12">SN.</th>   
                      <th >Category:</th>    
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody id="items">
                    <tr>
                      <td>1.</td>
                      <td>
                        <input type="text"  name="category[]" id="category1" class="form-control category" placeholder="Enter Category">
                       
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
<input type="hidden" id="eUrl" value="<?php echo url_for('/warehouse/category/') ?>">

<?php include(SHARED_PATH . '/footer.php'); ?>
 
<script type="text/javascript">


 

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
        html_code += '<td><input type="text"  name="category[]" id="category' + count + '" data-srno="' + count + '" class="form-control category" placeholder="Enter Category"></td>';
        

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
        $('.category').each(function() {
          var count = 1;
          if ($(this).val() == '') {
            $('.category').removeClass('suc');
            $('.category').addClass('err');
            error += 'Enter item type at row ' + count + '. ';
            return false;
          } else {
            $('.category').removeClass('err');
            $('.category').addClass('suc');
            return true;
          }
          count = count + 1;
      });
      

      // var formData = $(this).serialize();
      if (error == '') {
        
        $.ajax({
          url: 'category/inc/addItem.php',
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
            url: 'category/inc/fetch_form.php',
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
       url: 'category/inc/category_crud.php',
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
            url: 'category/inc/category_crud.php',
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

</script>

