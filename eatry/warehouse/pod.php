<?php require_once('../private/initialize.php');
$page_title = 'POD';
$page = 'Warehouse';
require_login();
$store_id = 1;
$shopping_cart = $_SESSION['warehouse_cart'] ?? '';

include(SHARED_PATH . '/store-header.php'); ?>


<input type="hidden" id="store" value="<?php echo $store_id ?>">
<input class="pull-right" type="hidden" id="shopping_cart" value="<?php echo $shopping_cart ?>">
<input type="hidden" id="loggedInAdmin" value="<?php echo Admin::find_by_id($loggedInAdmin->id)->full_name(); ?>">
<input type="hidden" id="company_name" value="<?php echo $company->company_name ?>">
<input type="hidden" id="address" value="<?php echo $company->address ?>">
<input type="hidden" id="phone" value="<?php echo $company->phone ?>">
   <style type="text/css">

       .menu {
         list-style-type: none;
         margin: 0;
         padding: 0;
         overflow: hidden;
         background-color: #333;
         margin-bottom: 10px
       }

       .menu li {
         float: left;
       }

       .menu li a {
         display: block;
         color: white;
         text-align: center;
         padding: 14px 16px;
         text-decoration: none;
       }

       .menu li a:hover:not(.current) {
         background-color: #111;
       }
       .current {
         background-color: #3c8dbc;
       }
       
   </style>
 <div class="content-wrapper">
    
    <div  class="container-fluid">
                <div class="row">
                   <div class="col-lg-4 col-md-12 col-sm-12 order-lg-first order-sm-last">
                      <div id="pos" >
                         <form action="pos" id="pos-sale-form" method="post" accept-charset="utf-8">
                            <input type="hidden" name="spos_token" value="0d496bb8b652f6882158a8720663a4ed" />
                            
                            <div class="well well-sm" id="leftdiv" >
                               <div id="lefttop" style="margin-bottom:5px;" >
                                  <div class="form-group" style="margin-bottom:5px;">
                                     <div class="input-group">

                                        <!-- <select name="customer_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" data-placeholder="Select Customer" style="width: 100%;position:absolute;" id="customer">
                                           <option value="" selected="selected">Select Customer</option>
                                           <option value="0">Walk-in customer</option>
                                           <?php //foreach (Customer::find_by_undeleted() as $customer) { ?>
                                             <option value="<?php //echo $customer->id; ?>"><?php //echo $customer->full_name(); ?></option>
                                           <?php //} ?>
                                         </select> -->
                                         <input type="text" class="form-control" name="receiver" id="receiver" style="width: 100%;" placeholder="Receiver's Name">

                                        <div class="input-group-addon no-print" style="padding: 2px 5px;">
                                           <a href="#" id="add-customer" class="external" data-toggle="modal" data-target="#myModal"><i class="fa fa-2x fa-plus-circle" id="addIcon"></i></a>
                                        </div>
                                     </div>
                                     <div style="clear:both;"></div>
                                  </div>
                                  <div class="form-group" style="margin-bottom:5px;">
                                     <input type="text" name="note" value="" id="note" class="form-control kb-text" placeholder="Reference Note" />
                                  </div>
                                  <div class="form-group" style="margin-bottom:5px;">
                                     <!-- <input type="text" name="code" id="add_item" class="form-control" placeholder="Search product by code or name, you can scan barcode too" /> -->

                                     <select name="search" class="form-control form-md-control select2 select2-danger" data-dropdown-css-class="select2-danger" data-placeholder="Search product by code or name, you can scan barcode too" style="width: 100%;position:absolute;" id="product_input">
                                        <option value="" selected="">Search product</option>
                                        <?php foreach (WarehouseItem::find_by_undeleted() as $product) { ?>
                                           <?php if($product->quantity <= $product->alert_quantity){ ?>
                                               <option disabled="" onclick="errorOption('Low in stock', 'Would you like to Re-stock ?')" value="<?php echo $product->id; ?>" 
                                                data-name="<?php echo $product->item_name; ?>"
                                                data-price="<?php echo $product->unit_cost; ?>"
                                                data-stock="<?php echo $product->quantity; ?>"
                                               >
                                               <span><?php echo $product->item_name ?>
                                               (Stock Unit = <?php echo $product->quantity; ?>)</span>
                                                </option>
                                             <?php }else{ ?>
                                                <option class="" value="<?php echo $product->id; ?>" 
                                                data-name="<?php echo $product->item_name; ?>"
                                                data-price="<?php echo $product->unit_cost; ?>"
                                                data-stock="<?php echo $product->quantity; ?>"
                                               >
                                               <span><?php echo $product->item_name ?>
                                               (Stock Unit = <?php echo $product->quantity; ?>)</span>
                                                </option>
                                             <?php } ?>
                                        <?php } ?>
                                      </select>

                                  </div>
                               </div>
                               <!-- <div id="printhead" class="print">
                                  <h2><strong>Simple POS</strong></h2>
                                  My Shop Lot, Shopping Mall,<br>
                                  Post Code, City<br>                                        
                                  <p>Date: Thu 12 Nov 2020</p>
                               </div> -->
                               <div id="print" class="fixed-table-container">
                                  <div id="list-table-div">
                                     <div class="fixed-table-header">
                                        <table  class="table table-striped table-condensed table-hover list-table" style="margin:0;">
                                           <thead>
                                              <tr class="success">
                                                 <th>Product</th>
                                                 <th style="width: 15%;text-align:center;">Price(₦)</th>
                                                 <!-- <th></th> -->
                                                 <th style="width: 15%;text-align:center;">Qty</th>
                                                 <th style="width: 20%;text-align:center;">Subtotal(₦)</th>
                                                 <th style="width: 20px;" class="satu"><i class="fa fa-trash-o"></i></th>
                                              </tr>
                                           </thead>
                                        </table>
                                     </div>
                                     <table id="posTable" class="table table-striped table-condensed table-hover list-table " style="margin:0px;" data-height="100" >
                                        <thead>
                                           <tr class="success">
                                                 <th>Product</th>
                                                 <th style="width: 15%;text-align:center;">Price(₦)</th>
                                                 <!-- <th></th> -->
                                                 <th style="width: 15%;text-align:center;">Qty</th>
                                                 <th style="width: 20%;text-align:center;">Subtotal(₦)</th>
                                                 <th style="width: 20px;" class="satu"><i class="fa fa-trash-o"></i></th>
                                              </tr>
                                        </thead>
                                        <tbody id="cart_details">
                                           
                                        </tbody>
                                     </table>
                                  </div>
                                  <div style="clear:both;"></div>
                                  <div id="totaldiv">
                                     <table id="totaltbl" class="table table-condensed totals" style="margin-bottom:10px;">
                                        <tbody>
                                           <tr class="info">
                                              <td width="25%">Total Items</td>
                                              <td class="text-right" style="padding-right:10px;">
                                                 <span id="count">0</span>(<span id="total_quantity">0</span>)
                                                 <input type="hidden" name="total_item" id="t_item">
                                                 <input type="hidden" name="quantity_in_item" id="quantity_in_item">

                                               </td>
                                              <td width="25%">Total</td>
                                              <td class="text-right" colspan="2"><span id="total">0</span></td>
                                           </tr>
                                           <tr class="info">
                                              <td width="25%"><a href="#" id="add_discount">Discount</a></td>
                                              <td class="text-right" style="padding-right:10px;"><span id="ds_con">0</span></td>
                                              <td width="25%"><a href="#" id="add_tax">Order Tax</a></td>
                                              <td class="text-right"><span id="ts_con">0</span></td>
                                           </tr>
                                           <tr class="success">
                                              <td colspan="2" style="font-weight:bold;">
                                                 Total Payable <a role="button" data-toggle="modal" data-target="#noteModal">
                                                 <i class="fa fa-comment"></i>
                                                 </a>
                                              </td>
                                              <td class="text-right" colspan="2" style="font-weight:bold;">
                                                 <span id="total-payable">0</span></td>
                                                 <input type="hidden" name="total_cost" id="total_cost">
                                           </tr>
                                        </tbody>
                                     </table>
                                  </div>
                               </div>
                               <div id="botbuttons" class="col-xs-12 text-center">
                                  <div class="row d-flex justify-content-between">
                                     <div class="col-xs-4" style="padding: 0;">
                                        <div class="btn-group-vertical btn-block">
                                           <button type="button" class="btn btn-warning btn-block btn-flat d-none"
                                              id="save_to_draft">Save to Draft</button>
                                           <button type="button" class="btn btn-danger btn-block btn-flat" style="height:67px;"
                                              id="clear_cart">Clear</button>
                                        </div>
                                     </div>
                                     <div class="col-xs-4 d-none" style="padding: 0 5px;">
                                        <div class="btn-group-vertical btn-block">
                                           <button type="button" class="btn bg-purple btn-block btn-flat" id="print_order">Print Order</button>
                                           <!-- <button type="button" class="btn bg-purple btn-block btn-flat" id="add_to_draft">Add to Draft</button> -->
                                           <button type="button" class="btn bg-navy btn-block btn-flat" id="print_bill">Print Bill</button>
                                        </div>
                                     </div>
                                     <div class="col-xs-4" style="padding: 0;">
                                        <button type="button" class="btn btn-success btn-block btn-flat" id="check_out" style="height:67px;">Check Out</button>
                                     </div>
                                  </div>
                               </div>
                               <div class="clearfix"></div>
                               <span id="hidesuspend"></span>
                               
                            </div>
                         </form>
                      </div>
                   </div>
                   <div class="col-lg-8 col-md-12 col-sm-12 order-lg-last order-sm-first">
                      <div class="contents  p-0 pt-4 " id="">

                         <div id="all_items"></div>

                         
                      </div>
                   </div>
                </div>
             </div>
    
 </div>



<input type="hidden" id="url" value="<?php echo url_for('/') ?>">
<input type="hidden" id="print_order_url" value="<?php echo url_for('/warehouse/print_order.php') ?>">
<input type="hidden" id="stock_url" value="<?php echo url_for('/warehouse/items.php') ?>">
<input type="hidden" id="date" value="<?php echo date("Y-m-d") ?>">


<?php include(SHARED_PATH . '/footer.php'); ?>
 <script src="<?php echo url_for('assets/dist/js/sweetalert2.all.min.js') ?>"></script>
  <script src="<?php echo url_for('assets/dist/js/sweet.js') ?>"></script>
  <script src="<?php echo url_for('assets/dist/js/select2.full.min.js') ?>"></script>
<script type="text/javascript">
  function errorOption(title, text, eid, store_id){
    var stock_url = $("#stock_url").val()
      var c_url = stock_url+'?id'+'='+ eid+'&store_id'+'='+ store_id;
      swal({
         title: title,
         text: text,
         icon: "warning",
         buttons: true,
         dangerMode: true,
       })
       .then((willDelete) => {
         if (willDelete) {
          // alert(c_url)
           window.location.href = c_url;
         } 
         // else {
         //   swal("Your imaginary file is safe!");
         // }
       });
  }

   $(document).on('change', '#product_input', function(){

       var selected = $(this).find('option:selected');
       var product_id = $(this).val();
       var product_name = selected.data('name');
       var product_price = selected.data('price');
       var stockUnit = selected.data('stock');
       var product_qty = 1;
       var product_discount = 0;
       var product_tax = 0;
       var action = "add";
       
       if (product_price != "") {
          if(product_qty > 0){
             $.ajax({
                url:"cart/action.php",
                method:"POST",
                data:{
                   product_id: product_id, 
                   product_name: product_name, 
                   // product_price: product_price, 
                   product_quantity: product_qty,
                   // product_tax: product_tax, 
                   // product_discount: product_discount, 
                   stockUnit: stockUnit,
                   action:action
                },
                success:function(data)
                {
                   load_cart_data();
                }
             });
          }
          else
          {
             alert("lease Enter Number of Quantity");
          }
       }else{
            errorAlert("Not available for shot Sales");
       }
       
   });

    load_cart_data();
     function load_cart_data(){
       $.ajax({
          url:"cart/fetch_cart.php",
          method:"POST",
          dataType:"json",
          success:function(data)
          {
             // console.log(data.cart_details);
             $('#cart_details').html(data.cart_details);
             $('#shopping_cart').val(data.total_item);
             $('#total-payable').text(data.total_payable);
             $('#total').text(data.total_price);
             $('#count').text(data.total_item); 
             $('#t_item').val(data.total_item); 
             $('#total_cost').val(data.total_p); 
             $('#total_quantity').text(data.total_quantity);
             $('#quantity_in_item').val(data.total_quantity);
             $('#ts_con').text(data.tax);
          }
       });
    }

    fetch();
    function fetch() {
       $.ajax({
          url: 'cart/fetch_item.php',
          method: 'post',
          data: {
             fetch: 1,
             store_id: $('#store').val(),
          },
          success: function(data) {
             $('#all_items').html(data);
                        
          }
      });
    }
    
    $(document).on('click', '.menu_item', function(){
      var id = $(this).data('id');
      $.ajax({
          url: 'cart/fetch_item.php',
          method: 'post',
          data: {
             fetch: 1,
             id: id,
             store_id: $('#store').val(),
          },
          success: function(data) {
             $('#all_items').html(data);
                        
          }
      });
    });

    $(document).on('click', '.add_to_cart', function(){
       var product_id = $(this).attr("id");
       var product_name = $('#name_'+product_id+'').val();
       var product_price = $('#price_'+product_id+'').val();
       var product_quantity = $('#quantity_'+product_id).val();
       var product_discount = $('#discount_'+product_id).val();
       var product_tax = $('#tax_'+product_id).val();
       var stockUnit = $('#stockUnit_'+product_id).val();
       var action = "add";
       var url_w = $('#stock_url').val();
       if (stockUnit == 0) {
            errorOption('Low in stock', 'Would you like to Re-stock ?', product_id, url_w)
        }else{
             if (product_price != "") {
                if(product_quantity > 0)
                {
                   $.ajax({
                      url:"cart/action.php",
                      method:"POST",
                      data:{
                         product_id: product_id, 
                         product_name: product_name, 
                         product_price: product_price, 
                         product_quantity: product_quantity,
                         product_tax: product_tax, 
                         product_discount: product_discount, 
                         stockUnit: stockUnit, 
                         action:action
                      },
                      success:function(data)
                      {
                         load_cart_data();
                      }
                   });
                }
                else
                {
                   alert("lease Enter Number of Quantity");
                }
             }else{
                  errorAlert("Not available for shot Sales");
             }
      }

    });
    $(document).on("keyup", ".qty", function (t) {

                 if (parseInt($(this).val()) >= $(this).attr('max')){
                    // $(this).val($(this).attr('max'));
                    
                    $(this).css('border', '3px solid red');
                    alert("You have exceeded the available stock unit ");
                    $(this).val(1);
                 }

            });
            $(document).on('change', '.qty', function(){
               var product_id = $(this).data('id');
               var quantity = $('#quantity'+product_id).val();
               
               var product_name = $('#product_name'+product_id).val();
               var product_price = $('#unit_cost'+product_id).val();
               var product_quantity = $(this).val();
               var product_tax = $('#p_tax'+product_id).val();
               var stockUnit = $('#stockUnit'+product_id).val();
               var edit = "edit_quantity";

               // var n = stockUnit - quantity;
               // $('#stockUnit'+product_id).val(n)
               // console.log(n)
               if(product_quantity > 0)
               {
                  $.ajax({
                     url:"cart/action.php",
                     method:"POST",
                     data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity,product_tax:product_tax
                        ,stockUnit:stockUnit, edit:edit},
                     success:function(data)
                     {
                        load_cart_data();
                     }
                  });
               }
               else
               {
                  alert("lease Enter Number of Quantity");
                  $(this).val(1);
               }   
            });

            $(document).on('click', '#editItemy', function(e){
               e.preventDefault();
               var product_id = $(this).data('id'); 
               var discount = $('#product_discount_y'+product_id).val();
               var product_name = $('#product_name_y'+product_id).val();
               var product_price = $('#product_price_y'+product_id).val();
               var product_quantity = $('#product_quantity_y'+product_id).val();
               var product_tax = $('#product_tax'+product_id).val();

               // console.log(discount, product_name, product_quantity, product_tax)
               var edit = "edit_product";
               if(product_quantity > 0)
               {
                  $.ajax({
                     url:"cart/action.php",
                     method:"POST",
                     data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity,product_tax:product_tax, discount:discount, edit:edit },
                     success:function(data)
                     {
                        $("#proModal").modal('hide');
                        load_cart_data();
                     }
                  });
               }
               else
               {
                  alert("lease Enter Number of Quantity");
               }   
            });

    function clearCartIt() {
             var action = 'empty';
             $.ajax({
                url:"cart/action.php",
                method:"POST",
                data:{action:action},
                success:function()
                {
                   load_cart_data();
                   // $('#cart-popover').popover('hide');
                   // successTime("Your Cart has been clear");
                }
             });
    }
    function clear(){
       var action = 'empty';
       
          $.ajax({
             url:"cart/action.php",
             method:"POST",
             data:{action:action},
             success:function()
             {
                load_cart_data();
                $('#cart-popover').popover('hide');
                successTime("Your Cart has been clear");
             }
          });
      
    }
    function clearCart(){
       var action = 'empty';
       if(confirm("Are you sure you want to clear this cart?"))
       {
          $.ajax({
             url:"cart/action.php",
             method:"POST",
             data:{action:action},
             success:function()
             {
                load_cart_data();
                $('#cart-popover').popover('hide');
                successTime("Your Cart has been clear");
             }
          });
       }else{
          return false;
       }
    }
    $(document).on('click', '#clear_cart', function(){
       clearCart()
    });
    $(document).on('click', '.deleteItem', function(){
       var product_id = $(this).attr("id");
       var action = 'remove';
          $.ajax({
             url:"cart/action.php",
             method:"POST",
             data:{product_id:product_id, action:action},
             success:function()
             {
                load_cart_data();
             }
          });
    });

    $(document).on('click', '#check_out', function() {
         var receiver = $('#receiver').val();
         var note = $('#note').val();
         // var table_url = $("#table_url").val()
         if(receiver == ""){
            errorAlert("Enter Receiver's Name");
         }else if(note == ""){
            errorAlert("Please Enter refrence note");
         }else{
           // confirmOrder("Alert", 'Are you sure you want to place order ?')
             // var table_url = $("#table_url").val()
             var print_order_url = $("#print_order_url").val()
             if(confirm("Are you sure you want to Check Out?")){
                $.ajax({
                  url: 'cart/check_out.php',
                  method: 'post',
                  data: $('#pos-sale-form').serialize(),
                  dataType: 'json',
                  success: function(r) {
                     if(r.msg == 'FAIL'){
                        bootbox.alert(r.error);
                     }else{
                        clearCartIt();
                        $('#pos-sale-form')[0].reset();
                        // clear();
                        // window.location.href = print_order_url+'?trans_no'+'='+ r.trans_no;
                        window.open(print_order_url+'?trans_no'+'='+ r.trans_no, '_blank');
                     }
                                
                  }
                });
              }else{
                  return false;
               }
         }
    });
    $(document).on('click', '#save_to_draft', function() {
      $.ajax({
          url: 'cart/save_to_draft.php',
          method: 'post',
          data: $('#pos-sale-form').serialize(),
          dataType: 'json',
          success: function(r) {
             if(r.msg == 'FAIL'){
                bootbox.alert(r.error);
             }else{
                clearCartIt();
                $('#pos-sale-form')[0].reset();
                successAlert("Saved successfully");
             }
                        
          }
        });
    });


  

</script>

