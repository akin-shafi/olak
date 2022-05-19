<?php require_once('../private/initialize.php');
$page_title = 'Return';
$page = 'Return';
require_login();


if ($loggedInAdmin->admin_level != 1) {
    redirect_to(url_for('/login.php'));
}

include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title; ?> Sales</h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $page_title; ?></li>
       </ol>
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" style="display:none;">
          <div class="alert alert-dismissable">
             <div class="custom-msg"></div>
          </div>
       </div>
    </div>
    <section class="content">

       <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Please fill in the information below</h3>
                </div>
                <div></div>
                <div class="box-body">
                  <form id="form">
                       <label class="control-label" for="code">Transaction Number </label>
                      <div class="form-inline">
                          <div class="form-group ">
                            <input type="text" class="form-control" id="trans_no" name="trans_no"  placeholder="e.g 110234" value="104084">
                          </div>
                          <div class="form-group ">
                            <input type="button" class="btn btn-sm btn-primary" id="find" value="Find">
                          </div>
                      </div>
                  

                      <div id="print" class="fixed-table-container">
                        <div id="list-table-div">
                           <div class="fixed-table-header">
                              <table class="table table-striped table-condensed table-hover list-table" style="margin:0;">
                                 <thead>
                                    <tr class="success">
                                       <th>Product</th>
                                       <th style="width: 15%;text-align:center;">Price(₦)</th>
                                       <!-- <th></th> -->
                                       <th style="width: 15%;text-align:center;">Qty</th>
                                       <th style="width: 20%;text-align:right;">Subtotal(₦)</th>
                                       <!-- <th style="width: 20px;" class="satu"><i class="fa fa-trash-o"></i></th> -->
                                    </tr>
                                 </thead>
                              </table>
                           </div>
                           <table id="posTable" class="table table-striped table-condensed table-hover list-table" style="margin:0px;" data-height="100">
                              <thead>
                                 <tr class="success">
                                    <th>Product</th>
                                    <th style="width: 15%;text-align:center;">Price</th>
                                    <!-- <th></th> -->
                                    <th style="width: 15%;text-align:center;">Qty</th>
                                    <th style="width: 20%;text-align:right;">Subtotal</th>
                                    <!-- <th style="width: 20px;" class="satu"><i class="fa fa-trash-o"></i></th> -->
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
                                       <input type="hidden" name="quantity_in_item" id="qty_in_item">
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
                                       Total Payable                                                            <a role="button" data-toggle="modal" data-target="#noteModal">
                                       <i class="fa fa-comment"></i>
                                       </a>
                                    </td>
                                    <td class="text-right" colspan="2" style="font-weight:bold;">
                                       <span id="total-payable">0</span></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                      </div>

                     <div id="botbuttons" class="col-xs-12 text-center">
                        <div class="row">
                           
                           <div class="col-xs-4 pull-right" style="padding: 0;">
                              <button type="button" class="btn btn-success btn-block btn-flat" id="save" style="height:67px;">Save</button>
                           </div>
                        </div>
                     </div>
                              
                                
                </form>  
                  
                </div>
            </div>
          </div>
       </div>
    </section>
 </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
 <script type="text/javascript">
  var trans_no = $("#trans_no").val();
  load_cart_data();     
   function load_cart_data(){
    // console.log(ref_no)
     $.ajax({
        url:"inc/find_sales.php",
        method:"POST",
        data: {
          trans_no: trans_no
        },
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
           $('#qty_in_item').val(data.total_quantity); 
           $('#total_quantity').text(data.total_quantity);
           $('#customer_id').val(data.customer_id);

           // var selected = $('#spos_customer').find('option:selected').val();
           // selected.val(data.customer_id);
           $('#ts_con').text(data.tax);
        }
     });
  }

  $(document).on("keyup", ".qty", function (t) {
         // var max = $(this).attr('max');
         // if (parseInt($(this).val()) >= $(this).attr('max')){
         //    // $(this).val($(this).attr('max'));
            
         //    $(this).css('border', '3px solid red');
         //    alert("You have exceeded the available stock unit ");
         //    $(this).val(max);
         // }
         // var product_id = $(this).data('id');
         // var qty = $(this).val();
         // var unit_price = $("#unit_cost"+product_id).val();
         // console.log(unit_price)
         // var mt = qty * unit_price;
         // var sub = $('#sub_'+product_id).html(formatMoney(mt));
         // console.log(sub)

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

            $.ajax({
               url:"inc/action.php",
               method:"POST",
               data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity,product_tax:product_tax
                  ,stockUnit:stockUnit, edit:edit},
               success:function(data)
               {
                  load_cart_data();
               }
            });
         
         
    });

  
  $(document).on('click', '#save', function(){

    var trans_no = $("#trans_no").val();
    // var eref_no = selected.val();
    var edata = $('#form').serializeArray();
    edata.push({name: 'save', value: 1});
    $.ajax({
         url:"inc/action.php",
         method:"POST",
         data: edata,
         success:function()
         {
            // load_cart_data();
         }
      });
  })
 </script>