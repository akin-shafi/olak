<?php require_once('../private/initialize.php');
$page_title = 'POS';

require_login();
$ref_no  = $_GET['ref_no'] ?? '';
$cc_id = $_GET['cc_id'] ?? '';
$action = $_GET['action'] ?? '';
$store_id = $_SESSION['store_id'] ?? 1;

$location = $_GET['location'] ?? '';// echo $cc_id;
$shopping_cart = $_SESSION['shopping_cart']['product_name'] ?? '';
if (in_array($loggedInAdmin->admin_level, [4, 1])) {
   // check if register was closed yesterday by this user
   $yesterday = date('Y-m-d', strtotime("-1 days"));
   $close_register = Register::find_by_time(['open_time' => $yesterday, 'created_by' => $loggedInAdmin->id]);
   if (!empty($close_register->open_time) && empty($close_register->close_time)) {
      redirect_to(url_for('/pos/close_register'));
   } else {
      // Select store type to log into [either wine store or lounge]
      if (!isset($store_id)) {
         redirect_to(url_for('/settings/store/select_store'));
      } else {
         // Check if register is opened by the loggedIn user
         $today = date("Y-m-d");
         $register = Register::find_by_time(['open_time' => $today, 'created_by' => $loggedInAdmin->id]);
         if (empty($register)) {
            redirect_to(url_for('/pos/open_register'));
         }
      }
   }
} else {
   $session->message('Sorry only sales rep is authorized to access POS.');
   redirect_to(url_for('/dashboard/'));
}

include(SHARED_PATH . '/pos-header.php');
?>

<input type="hidden" id="ref_noe" value="<?php echo $ref_no ?>">
<input type="hidden" id="processed_by" value="<?php //echo Credit::find_by_ref($ref_no)->processed_by 
                                                ?>">
<input type="hidden" id="store" value="<?php echo $store_id ?>">
<input class="pull-right" type="hidden" id="shopping_cart" value="<?php echo $shopping_cart ?>">
<input type="hidden" id="loggedInAdmin" value="<?php echo Admin::find_by_id($loggedInAdmin->id)->full_name(); ?>">
<input type="hidden" id="company_name" value="<?php echo $company->company_name ?>">
<input type="hidden" id="address" value="<?php echo $company->address ?>">
<input type="hidden" id="phone" value="<?php //echo $company->phone 
                                       ?>">
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

   .err {
      border: 1px solid red;
   }

   .suc {
      border: 1px solid green;
   }
</style>

<div class="content-wrapper container-fluid">
   <!-- <div class="col-lg-12 alerts">
            <?php //echo display_errors($cust->errors) 
            ?>
         </div> -->

   <div class=" d-flex justify-content-center mn-4">
      <?php echo display_session_message(); ?>
   </div>

   <table style="width:100%;" class="layout-table">
      <tr>
         <td style="width: 460px;">
            <div id="pos">
               <form action="pos" id="pos-sale-form" method="post" accept-charset="utf-8">
                  <input type="hidden" name="spos_token" value="0d496bb8b652f6882158a8720663a4ed" />
                  <input type="hidden" name="refrence" value="<?php echo $cc_id ?>">
                  <input type="hidden" name="ref_no" value="<?php echo $ref_no ?>">
                  <div class="well well-sm" id="leftdiv">
                     <div id="lefttop" style="margin-bottom:5px;">


                        <div class="input-group">

                           <select name="customer_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" data-placeholder="Select Customer" style="width: 100%;position:absolute;" id="spos_customer">
                              <option value="" selected="selected">Select Customer</option>
                              <option value="0">Walk-in customer</option>
                              <?php foreach (Customer::find_by_undeleted() as $customer) { ?>
                                 <option value="<?php echo $customer->id; ?>"><?php echo $customer->full_name(); ?></option>
                              <?php } ?>
                           </select>

                           <div class="input-group-addon no-print" style="padding: 2px 5px;">
                              <a href="#" id="add-customer" class="external" data-toggle="modal" data-target="#myModal"><i class="fa fa-2x fa-plus-circle" id="addIcon"></i></a>
                           </div>
                        </div>
                        <div class="form-group" style="margin-bottom:5px;">
                           <input type="text" name="hold_ref" value="" id="hold_ref" class="form-control kb-text" placeholder="Reference Note" />
                        </div>
                        <div class="form-group" style="margin-bottom:5px;">

                           <select name="search" class="form-control form-md-control select2 select2-danger" data-dropdown-css-class="select2-danger" data-placeholder="Search product by code or name, you can scan barcode too" style="width: 100%;position:absolute;" id="product_input">
                              <option value="" selected="">Search product</option>
                              <?php foreach (Product::find_by_undeleted() as $product) { ?>
                                 <?php if ($store_id == 1) {
                                    if ($product->quantity <= $product->alert_quantity) { ?>
                                       <option disabled="" onclick="errorOption('Low in stock', 'Would you like to Re-stock ?')" value="<?php echo $product->id; ?>" data-name="<?php echo $product->pname; ?>" data-price="<?php echo $product->price; ?>" data-stock="<?php echo $product->quantity; ?>">
                                          <span><?php echo $product->pname ?>
                                             (Stock Unit = <?php echo $product->quantity; ?>)</span>
                                       </option>
                                    <?php } else { ?>
                                       <option class="" value="<?php echo $product->id; ?>" data-name="<?php echo $product->pname; ?>" data-price="<?php echo $product->price; ?>" data-stock="<?php echo $product->quantity; ?>">
                                          <span><?php echo $product->pname ?>
                                             (Stock Unit = <?php echo $product->quantity; ?>)</span>
                                       </option>
                                    <?php } ?>
                                 <?php } else { ?>
                                    <?php if ($product->no_of_shut <= 0) { ?>
                                       <option disabled="" onclick="errorOption('Low in stock', 'Would you like to Re-stock ?')" value="<?php echo $product->id; ?>" data-name="<?php echo $product->pname; ?>" data-price="<?php echo $product->shut_price; ?>" data-stock="<?php echo $product->quantity; ?>">
                                          <span><?php echo $product->pname ?>
                                             (Stock Unit = <?php echo $product->no_of_shut; ?>)</span>
                                       </option>
                                    <?php } else { ?>
                                       <option class="" value="<?php echo $product->id; ?>" data-name="<?php echo $product->pname; ?>" data-price="<?php echo $product->shut_price; ?>" data-stock="<?php echo $product->no_of_shut; ?>">
                                          <span><?php echo $product->pname ?>
                                             (Stock Unit = <?php echo $product->no_of_shut; ?>)</span>
                                       </option>
                                    <?php } ?>
                                 <?php } ?>
                              <?php } ?>
                           </select>

                        </div>
                     </div>
                     <div id="printhead" class="print">
                        <h2><strong>Simple POS</strong></h2>
                        My Shop Lot, Shopping Mall,<br>
                        Post Code, City<br>
                        <p>Date: Thu 12 Nov 2020</p>
                     </div>
                     <div id="print" class="fixed-table-container">
                        <div id="list-table-div">
                           <div class="fixed-table-header">
                              <table class="table table-striped table-condensed table-hover list-table" style="margin:0;">
                                 <thead>
                                    <tr class="success">
                                       <th>Product</th>
                                       <th style="width: 15%;text-align:center;">Price(₦)</th>
                                       <th style="width: 15%;text-align:center;">Qty</th>
                                       <th style="width: 20%;text-align:center;">Subtotal(₦)</th>
                                       <th style="width: 20px;" class="satu"><i class="fa fa-trash-o"></i></th>
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
                                    <th style="width: 20%;text-align:center;">Subtotal</th>
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
                                       <input type="hidden" name="total_quantity" id="t_qty">
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
                                       <span id="total-payable">0</span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div id="botbuttons" class="col-xs-12 text-center">
                        <div class="row d-flex justify-content-center">
                           <div class="col-xs-4 d-none" style="padding: 0;">
                              <div class="btn-group-vertical btn-block">

                                 <button type="button" class="btn btn-danger btn-block btn-flat" id="clear_cart" style="height:67px;">Clear</button>
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
                              <?php if ($action == 0) { ?>
                                 <button type="button" class="btn btn-primary btn-block btn-flat" id="save_to_draft" style="height:67px;">Update Cart</button>
                              <?php } else { ?>
                                 <button type="button" class="btn btn-success btn-block btn-flat" id="pay_bill" style="height:67px;">Payment</button>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <span id="hidesuspend"></span>

                  </div>
               </form>
            </div>
         </td>

         <td>
            <div class="contents  p-0 pt-4 " id="">

               <div id="all_items"></div>

               <div class="product-nav">
                  <div class="btn-group btn-group-justified">
                     <div class="btn-group">
                        <a style="z-index:10002;" href="<?php //echo url_for('pos/tables.php') 
                                                         ?>" class="btn btn-warning pos-tip btn-flat" id="previou"><i class="fa fa-chevron-left"></i></a>
                     </div>
                     <div class="btn-group">
                        <!-- <button style="z-index:10003;" class="btn btn-success pos-tip btn-flat" type="button" id="sellGiftCard"><i class="fa fa-credit-card" id="addIcon"></i> Sell Gift Card</button> -->
                        <button style="z-index:10003;" class="btn btn-success pos-tip btn-flat" type="button"><i class="fa fa-credit-card" id="addIcon"></i> </button>
                     </div>
                     <div class="btn-group">
                        <button style="z-index:10004;" class="btn btn-warning pos-tip btn-flat" type="button" id="next"><i class="fa fa-chevron-right"></i></button>
                     </div>
                  </div>
               </div>
            </div>
         </td>

      </tr>
   </table>

</div>
</div>
<aside class=" control-sidebar control-sidebar-dark" id="categories-list">
   <div class="tab-content sb">
      <div class="tab-pane active sb" id="control-sidebar-home-tab">
         <div id="filter-categories-con">
            <input type="text" autocomplete="off" data-list=".control-sidebar-menu" name="filter-categories" id="filter-categories" class="form-control sb col-xs-12 kb-text" placeholder="Type to filter categories" style="margin-bottom: 20px;">
         </div>
         <div class="clearfix sb"></div>
         <div id="category-sidebar-menu">
            <ul class="control-sidebar-menu">
               <li>
                  <a href="#" class="category active" id="1">
                     <div class="menu-icon"><img src="<?php echo url_for('uploads/thumbs/no_image.png') ?>" alt="" class="img-thumbnail img-responsive"></div>
                     <div class="menu-info">
                        <h4 class="control-sidebar-subheading"><?php echo $company->company_name ?></h4>
                        <p><?php echo Store::CATEGORY[$_SESSION['store_id']] ?></p>
                     </div>


                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</aside>
<div class="control-sidebar-bg sb"></div>
</div>
</div>
<div id="order_tbl" style="display:none;">
   <span id="order_span"></span>
   <table id="order-table" class="prT table table-condensed" style="width:100%;margin-bottom:0;"></table>
</div>
<div id="bill_tbl" style="display:none;">
   <span id="bill_span"></span>
   <table id="bill-table" width="100%" class="prT table table-condensed" style="width:100%;margin-bottom:0;"></table>
   <table id="bill-total-table" width="100%" class="prT table table-condensed" style="width:100%;margin-bottom:0;"></table>
</div>
<div style="width:435px;background:#FFF;display:block">
   <div id="order-data" style="display:none;" class="text-center">
      <h1>SimplePOS</h1>
      <h2>Order</h2>
      <div id="preo" class="text-left"></div>
   </div>
   <div id="bill-data" style="display:none;" class="text-center">
      <h1>SimplePOS</h1>
      <h2>Bill</h2>
      <div id="preb" class="text-left"></div>
   </div>
</div>

<div id="ajaxCall"><i class="fa fa-spinner fa-pulse"></i></div>
<div class="modal" data-easein="flipYIn" id="gcModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel">Sell Gift Card</h4>
         </div>
         <div class="modal-body">
            <p>Please fill in the information below</p>
            <div class="alert alert-danger gcerror-con" style="display: none;">
               <button data-dismiss="alert" class="close" type="button">×</button>
               <span id="gcerror"></span>
            </div>
            <div class="form-group">
               <label for="gccard_no">Card No</label> *
               <div class="input-group">
                  <input type="text" name="gccard_no" value="" class="form-control" id="gccard_no" />
                  <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;"><a href="#" id="genNo"><i class="fa fa-cogs"></i></a></div>
               </div>
            </div>
            <input type="hidden" name="gcname" value="Gift Card" id="gcname" />
            <div class="form-group">
               <label for="gcvalue">Value</label> *
               <input type="text" name="gcvalue" value="" class="form-control" id="gcvalue" />
            </div>
            <div class="form-group">
               <label for="gcprice">Price</label> *
               <input type="text" name="gcprice" value="" class="form-control" id="gcprice" />
            </div>
            <div class="form-group">
               <label for="gcexpiry">Expiry Date</label> <input type="text" name="gcexpiry" value="" class="form-control" id="gcexpiry" />
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="addGiftCard" class="btn btn-primary">Sell Gift Card</button>
         </div>
      </div>
   </div>
</div>

<div class="modal" data-easein="flipYIn" id="dsModal" tabindex="-1" role="dialog" aria-labelledby="dsModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="dsModalLabel">Discount (5 or 5%)</h4>
         </div>
         <div class="modal-body">
            <input type='text' class='form-control input-sm kb-pad' id='get_ds' onClick='this.select();' value=''>
            <label class="checkbox" for="apply_to_order">
               <input type="radio" name="apply_to" value="order" id="apply_to_order" checked="checked" />
               Apply to order total </label>
            <label class="checkbox" for="apply_to_products">
               <input type="radio" name="apply_to" value="products" id="apply_to_products" />
               Apply to all order items </label>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="updateDiscount" class="btn btn-primary btn-sm">Update</button>
         </div>
      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="tsModal" tabindex="-1" role="dialog" aria-labelledby="tsModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="tsModalLabel">Tax (5 or 5%)</h4>
         </div>
         <div class="modal-body">
            <input type='text' class='form-control input-sm kb-pad' id='get_ts' onClick='this.select();' value=''>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="updateTax" class="btn btn-primary btn-sm">Update</button>
         </div>
      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="noteModalLabel">Note</h4>
         </div>
         <div class="modal-body">
            <textarea name="snote" id="snote" class="pa form-control kb-text"></textarea>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="update-note" class="btn btn-primary btn-sm">Update</button>
         </div>
      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="proModal" tabindex="-1" role="dialog" aria-labelledby="proModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" id="item_show">


      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="susModal" tabindex="-1" role="dialog" aria-labelledby="susModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="susModalLabel">Suspend Sale</h4>
         </div>
         <div class="modal-body">
            <p>Type Reference Note</p>
            <div class="form-group">
               <label for="reference_note">Reference Note</label>
               <input type="text" name="reference_note" value="" class="form-control kb-text" id="reference_note" />
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
            <button type="button" id="suspend_sale" class="btn btn-primary">Submit</button>
         </div>
      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="chooseOrder">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="susModalLabel">Draft</h4>
         </div>
         <div class="modal-body">
            <p>Select which order you will like to add new items to</p>

            <select class="form-control" id="ref_no_value">
               <?php $sn = 1;
               foreach (Draft::find_all()  as $key => $value) {
               ?>
                  <option value="<?php echo $value->ref_no ?>">Order <?php echo $sn++ ?></option>
               <?php } ?>
            </select>


         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
            <button type="button" id="post_draft" class="btn btn-primary">Submit</button>
         </div>
      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="saleModal" tabindex="-1" role="dialog" aria-labelledby="saleModalLabel" aria-hidden="true"></div>
<div class="modal" data-easein="flipYIn" id="opModal" tabindex="-1" role="dialog" aria-labelledby="opModalLabel" aria-hidden="true"></div>
<div class="modal" data-easein="flipYIn" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-success">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="payModalLabel">
               Payment
            </h4>
         </div>
         <section id="show_pay"></section>
      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="cModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header modal-primary">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="cModalLabel">
               Add Customer
            </h4>
         </div>
         <form action="" id="customer-form" method="post" accept-charset="utf-8">

            <!-- <input type="hidden" name="spos_token" value="0d496bb8b652f6882158a8720663a4ed" /> -->
            <div class="modal-body">
               <div id="c-alert" style="display:none; color: #FFF"></div>
               <div class="row">
                  <div class="col-xs-6">
                     <div class="form-group">
                        <label class="control-label" for="code">Firstname </label>
                        <input type="text" name="first_name" value="" class="form-control input-sm kb-text" id="fname" required />
                     </div>
                  </div>

                  <div class="col-xs-6">
                     <div class="form-group">
                        <label class="control-label" for="code">lastname</label>
                        <input type="text" name="last_name" value="" class="form-control input-sm kb-text" id="lname" required />
                     </div>
                  </div>
               </div>
               <div class="row">

                  <div class="col-xs-12">
                     <div class="form-group">
                        <label class="control-label" for="phone">Phone</label>
                        <input type="text" name="phone" value="" class="form-control input-sm kb-pad" id="cphone" required />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-6">
                     <div class="form-group">
                        <label class="control-label" for="cf1">Shop address</label>
                        <input type="text" name="shop_address" value="" class="form-control input-sm kb-text" id="cf1" />
                     </div>
                  </div>
                  <div class="col-xs-6">
                     <div class="form-group">
                        <label class="control-label" for="cf2">Home address</label>
                        <input type="text" name="home_address" value="" class="form-control input-sm kb-text" id="cf2" />
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer" style="margin-top:0;">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
               <button type="submit" class="btn btn-primary" id="add_customer"> Add Customer </button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="printModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" style="width:400px;">
      <div class="modal-content">
         <div class="modal-header np">
            <button type="button" class="close" id="print-modal-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
            <h4 class="modal-title" id="print-title"></h4>
         </div>
         <div class="modal-body">
            <div id="print-body"></div>
         </div>
      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog" style="width:400px;">
      <div class="modal-content">
         <div class="modal-header np">
            <button type="button" class="close" id="receipt-modal-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
            <h4 class="modal-title" id="receipt-title"></h4>
         </div>
         <div class="modal-body">
            <div id="print-receipt"></div>
         </div>
      </div>
   </div>
</div>
<div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div class="modal" data-easein="flipYIn" id="posModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true"></div>
<div class="modal in" data-easein="flipYIn" id="registerModal">
   <div class="modal-dialog" id="show_register">


   </div>
</div>

<div class="modal in" data-easein="flipYIn" id="draftModal">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header np">

            <button type="button" class="close" id="receipt-modal-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
            <h4 class="modal-title" id="receipt-title">Discount</h4>
         </div>
         <div class="modal-body">
            <div id="show_draft"></div>
         </div>
      </div>

   </div>
</div>

<div class="modal in" data-easein="flipYIn" id="viewdraftModal">
   <div class="modal-dialog modal-md">
      <div class="modal-content">
         <div class="modal-header np">
            <button type="button" class="close" id="receipt-modal-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
            <h4 class="modal-title" id="receipt-title"></h4>
         </div>
         <div class="modal-body">
            <div id="show_draftItem"></div>
         </div>
      </div>

   </div>
</div>

<input type="hidden" id="url" value="<?php echo url_for('/') ?>">
<input type="hidden" id="stock_url" value="<?php echo url_for('/stock/index.php') ?>">
<input type="hidden" id="print_receipt_page" value="<?php echo url_for('/pos/print_slip.php') ?>">
<input type="hidden" id="date" value="<?php echo date("Y-m-d") ?>">

<form id="newForm">
   <div class="pull-right">
      <?php

      $transaction = Transaction::find_by_trans($ref_no);
      $sales = Sales::find_all_transaction($transaction->trans_no);
      // pre_r($sales);

      foreach ($sales as $key => $value) { ?>
         <input type="hidden" name="trans_no[]" value="<?php echo $value->trans_no ?>">
         <input type="hidden" name="sale_id[]" value="<?php echo $value->id ?>">
         <input type="hidden" name="product_id[]" value="<?php echo $value->product_id ?>">
         <input type="hidden" name="product_name[]" value="<?php echo Product::find_by_id($value->product_id)->pname ?>">
         <input type="hidden" name="product_price[]" value="<?php echo $value->unit_price ?>">
         <input type="hidden" name="subtotal[]" id="subtotal<?php echo $key; ?>">
         <input type="hidden" name="product_quantity[]" value="<?php echo $value->product_quantity ?>">
         <input type="hidden" name="product_tax[]" value="0">
         <input type="hidden" name="product_discount[]" value="0">
         <input type="hidden" name="stockUnit[]" value="<?php echo product::find_by_id($value->product_id)->quantity + $value->product_quantity ?>">
      <?php } ?>
   </div>
</form>
<?php //echo pre_r($_SESSION['shopping_cart']); 
?>
</div>

<script data-cfasync="false" src="<?php echo url_for('assets/dist/js/email-decode.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo url_for('assets/dist/js/settings.js') ?>"></script>

<script src="<?php echo url_for('assets/dist/js/sweetalert2.all.min.js') ?>"></script>
<script src="<?php echo url_for('assets/dist/js/sweet.js') ?>"></script>
<script src="<?php echo url_for('assets/dist/js/select2.full.min.js') ?>"></script>

<input type="hidden" id="link_url" value="<?php echo url_for('/') ?>">

<script type="text/javascript">
   // $('.select2').select2();
   $('.select2').select2({
      theme: "classic",
      minimumResultsForSearch: 6
      // theme: 'bootstrap4'
   });

   var link_url = $("#link_url").val();

   $(document).ready(function() {
      $(document).on('click', '#pay_bill', function() {
         // console.log($('#spos_customer').val())
         var estore_id = $('#select_store').val();
         var ref_no = $("#ref_noe").val();
         var processed_by = $("#processed_by").val();
         var customer = $('#spos_customer').val();
         var error = '';
         var stock = $('.stockUnit').each(function() {
            var count = 1;

            if ($(this).val() <= 0) {
               $('.pItem').removeClass('suc');
               $('.pItem').addClass('err');
               error += "Remove item on row " + count + ". it's out of stock ";
               return false;
            } else {
               $('.pItem').removeClass('err');
               $('.pItem').addClass('suc');
               return true;
            }
            count = count + 1;
         });

         $('.qty').each(function() {
            var count = 1;

            if ($(this).val() > stock.val()) {
               $('.pItem').removeClass('suc');
               $('.pItem').addClass('err');
               error += "Quantity on row " + count + ". is more than stock value, reduce";
               return false;
            } else {
               $('.pItem').removeClass('err');
               $('.pItem').addClass('suc');
               return true;
            }
            count = count + 1;
         });

         if (error == '') {
            if (customer == "") {
               bootbox.alert('Please select customer');
            } else {
               $("#payModal").modal('show');
               $.ajax({
                  url: "hold/billing.php",
                  method: "POST",
                  data: {
                     process_bill: 1,
                     loggedInAdmin: $('#loggedInAdmin').val(),
                     spos_customer: $('#spos_customer').val(),
                     ref_no: ref_no,
                     processed_by: processed_by,
                     store_id: estore_id
                  },
                  success: function(r) {

                     $('#show_pay').html(r);
                     $("#total_paying").text(formatMoney(parseFloat($("#total_paying").text())));
                     $("#twt").text(formatMoney(parseFloat($("#twt").text())));
                     // $("#quick-payable").text(formatMoney(parseFloat($("#quick-payable").text())));
                     // $("#amount").focus();
                     $("#amount").val($("#cost_of_item").val()).focus();
                  }
               });
            }
         } else {
            errorTime(error);
         }
      });



      $(document).on('click', '#btn-draft', function() {
         $("#draftModal").modal('show');
         $.ajax({
            url: "draft.php",
            method: "POST",
            data: {
               draft: 1,
            },
            // dataType:"json",
            success: function(r) {
               $('#show_draft').html(r);
            }
         });
      });



      $(document).on('click', '.edit', function() {
         var eid = $(this).data('id');
         $("#proModal").modal('show');
         var action = 'show_item';
         $.ajax({
            url: "draft.php",
            method: "POST",
            data: {
               show_item: 1,
               id: eid,
               action: action
            },
            // dataType:"json",
            success: function(r) {
               $('#show_draft').html(r);
            }
         });
      });


      $(document).on('click', '#save_to_draft', function() {
         var customer = $('#customer').val();
         // var table_url = $("#table_url").val()
         if (customer == "") {
            bootbox.alert('Please select customer');
         } else {
            var eUrl = $("#url").val();

            $.ajax({
               url: 'hold/add_item.php',
               method: 'post',
               data: $('#pos-sale-form').serialize(),
               dataType: 'json',
               success: function(r) {
                  if (r.msg == 'FAIL') {
                     bootbox.alert(r.error);
                  } else {
                     load_cart_data();
                     // location.reload(true)
                     window.open(eUrl + 'pos/print_slip.php?trans_no=' + r.trans_no +'&'+ "where='return'", "_blank");
                  }

               }
            });
         }
      });



      $(document).on("click", ".quick-cash", function() {
         var item = $(this).val();
         var amt = $("#cost_of_item").val();
         if (item == "") {
            $("#amount").val("").focus();
            $("#balance").text(formatMoney(0));
            $("#balance_input").val(0);
         } else {
            $("#amount").val(parseFloat(item)).focus();
            process_amt(amt);
            $("#token").val("")
         }
      })


      function process_amt(amt) {
         // var amt = $("#amount").val();
         var grand_total = $("#cost_of_item").val();
         $("#total_paying").text(formatMoney(amt));
         $("#balance").text(formatMoney(parseFloat(grand_total) - amt));
         $("#balance_input").val(parseFloat(grand_total) - amt);
      }

      function process_discount(amt) {
         // var amt = $("#amount").val();
         var grand_total = $("#cost_of_item").val();
         $("#total_paying").text(formatMoney(amt));
         $("#balance").text(formatMoney(parseFloat(grand_total) - amt));
         // $("#balance_input").val(parseFloat(grand_total) - amt);
      }

      $(document).on("keyup", "#amount", function(t) {
         var grand_total = $("#cost_of_item").val();
         var amt = $(this).val();
         if (amt == "" || amt == 0) {
            $("#balance").text(formatMoney(grand_total));
            $("#balance_input").val(grand_total);
            $("#total_paying").text(formatMoney(0));
         } else {
            process_amt(amt)
         }
      });

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

      $(document).on('click', '.menu_item', function() {
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

      $(document).on('change', '#product_input', function() {

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
            if (product_qty > 0) {
               $.ajax({
                  url: "hold/action.php",
                  method: "POST",
                  data: {
                     product_id: product_id,
                     product_name: product_name,
                     product_price: product_price,
                     product_quantity: product_qty,
                     product_tax: product_tax,
                     product_discount: product_discount,
                     stockUnit: stockUnit,
                     action: action
                  },
                  success: function(data) {
                     load_cart_data();
                  }
               });
            } else {
               alert("lease Enter Number of Quantity");
            }
         } else {
            errorAlert("Not available for shot Sales");
         }

      });

      record();

      function record() {
         // var product_id = $(this).data("id");
         $.ajax({
            url: "cart/return_action.php",
            method: "POST",
            data: $('#newForm').serialize(),
            // dataType: 'json',
            success: function(r) {
               load_cart_data();
            }
         });
      }


      function load_cart_data() {
         $.ajax({
            url: "hold/fetch_cart.php",
            method: "POST",
            dataType: "json",
            success: function(data) {
               // console.log(data.cart_details);
               $('#cart_details').html(data.cart_details);
               $('#shopping_cart').val(data.total_item);
               $('#total-payable').text(data.total_payable);
               $('#total').text(data.total_price);
               $('#count').text(data.total_item);
               $('#t_item').val(data.total_item);
               $('#t_qty').val(data.total_quantity);
               $('#total_quantity').text(data.total_quantity);
               $('#ts_con').text(data.tax);
            }
         });
      }


      $(document).on('click', '.add_to_cart', function() {
         var product_id = $(this).attr("id");
         var product_name = $('#name_' + product_id + '').val();
         var product_price = $('#price_' + product_id + '').val();
         var product_quantity = $('#quantity_' + product_id).val();
         var product_discount = $('#discount_' + product_id).val();
         var product_tax = $('#tax_' + product_id).val();
         var stockUnit = $('#stockUnit_' + product_id).val();
         var action = "add";
         if (product_price != "") {
            if (product_quantity > 0) {
               $.ajax({
                  url: "hold/action.php",
                  method: "POST",
                  data: {
                     product_id: product_id,
                     product_name: product_name,
                     product_price: product_price,
                     product_quantity: product_quantity,
                     product_tax: product_tax,
                     product_discount: product_discount,
                     stockUnit: stockUnit,
                     action: action,

                  },
                  success: function(data) {
                     load_cart_data();
                  }
               });
            } else {
               alert("lease Enter Number of Quantity");
            }
         } else {
            errorAlert("Not available for shot Sales");
         }
      });

      $(document).on('click', '.deleteItem', function() {
         var product_id = $(this).attr("id");
         var action = 'remove';
         if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
               url: "hold/action.php",
               method: "POST",
               data: {
                  product_id: product_id,
                  action: action
               },
               success: function() {
                  load_cart_data();
               }
            });
         } else {
            return false;
         }
      });

      function clearCartIt() {
         var action = 'empty';
         var ref_no = $("#ref_noe").val();
         $.ajax({
            url: "hold/action2.php",
            method: "POST",
            data: {
               action: action,
               ref_no: ref_no
            },
            success: function() {
               load_cart_data();
               // $('#cart-popover').popover('hide');
               // successTime("Your Cart has been clear");
            }
         });
      }

      function clear() {
         var action = 'empty';
         var ref_no = $("#ref_noe").val();
         $.ajax({
            url: "hold/action.php",
            method: "POST",
            data: {
               action: action,
               ref_no: ref_no
            },
            success: function() {
               load_cart_data();
               $('#cart-popover').popover('hide');
               successTime("Your Cart has been clear");
            }
         });

      }

      function clearCart() {
         var action = 'empty';
         var ref_no = $("#ref_noe").val();
         var pos_url = $("#pos_url").val()
         // var c_url = pos_url+'?id'+'='+ eid+'&store_id'+'='+ store_id;
         if (confirm("Are you sure you want to clear this cart?")) {

            $.ajax({
               url: "hold/action.php",
               method: "POST",
               data: {
                  action: action,
                  ref_no: ref_no
               },
               dataType: 'json',
               success: function(r) {
                  if (r.msg == 'OK') {
                     load_cart_data();
                     $('#cart-popover').popover('hide');
                     successTime("Your Cart has been clear");
                     window.location.href = pos_url;
                  } else if (r.msg == 'empty') {
                     window.location.href = pos_url;
                  }
               }
            });
         } else {
            return false;
         }
      }
      $(document).on('click', '#clear_cart', function() {
         clearCart()
      });

      $(document).on('click', '#add_customer', function(e) {
         e.preventDefault();
         $.ajax({
            url: "../customers/add_customer.php",
            method: "POST",
            data: $('#customer-form').serialize(),
            dataType: "json",
            success: function(r) {
               if (r.msg == 'FAIL') {
                  $("#c-alert").html(r.error);
                  $("#c-alert").css("display", "block");
               } else {
                  $('#customerModal').modal('hide')
                  successAlert('Created Succesfully')
               }


            }
         });
      });

      $(document).on("keyup", ".qty", function(t) {

         if (parseInt($(this).val()) >= $(this).attr('max')) {
            // $(this).val($(this).attr('max'));

            $(this).css('border', '3px solid red');
            alert("You have exceeded the available stock unit ");
            $(this).val(1);
         }

      });


      $(document).on('change', '.qty', function() {
         var product_id = $(this).data('id');
         var quantity = $('#quantity' + product_id).val();

         var product_name = $('#product_name' + product_id).val();
         var product_price = $('#unit_cost' + product_id).val();
         var product_quantity = $(this).val();
         var product_tax = $('#p_tax' + product_id).val();
         var stockUnit = $('#stockUnit' + product_id).val();
         var edit = "edit_quantity";

         if (product_quantity > 0) {
            $.ajax({
               url: "hold/action.php",
               method: "POST",
               data: {
                  product_id: product_id,
                  product_name: product_name,
                  product_price: product_price,
                  product_quantity: product_quantity,
                  product_tax: product_tax,
                  stockUnit: stockUnit,
                  edit: edit
               },
               success: function(data) {
                  load_cart_data();
               }
            });
         } else {
            alert("lease Enter Number of Quantity");
            $(this).val(1);
         }
      });

      $(document).on('click', '#editItemy', function(e) {
         e.preventDefault();
         var product_id = $(this).data('id');
         var discount = $('#product_discount_y' + product_id).val();
         var product_name = $('#product_name_y' + product_id).val();
         var product_price = $('#product_price_y' + product_id).val();
         var product_quantity = $('#product_quantity_y' + product_id).val();
         var product_tax = $('#product_tax' + product_id).val();

         // console.log(discount, product_name, product_quantity, product_tax)
         var edit = "edit_product";
         if (product_quantity > 0) {
            $.ajax({
               url: "hold/action.php",
               method: "POST",
               data: {
                  product_id: product_id,
                  product_name: product_name,
                  product_price: product_price,
                  product_quantity: product_quantity,
                  product_tax: product_tax,
                  discount: discount,
                  edit: edit
               },
               success: function(data) {
                  $("#proModal").modal('hide');
                  load_cart_data();
               }
            });
         } else {
            alert("lease Enter Number of Quantity");
         }
      });

      $(document).on('keyup', '.discount', function(e) {
         var product_id = $(this).data('id');
         var product_discount = $("#product_discount_y" + product_id).val();
         var product_price = $("#product_price_y" + product_id).val();

         var result = product_price - product_discount

         $("#product_price_y" + product_id).val(formatMoney(result))
      });

      function qrcode() {
         var unique = $("#h_trans").val();

         document.getElementById("qr_code");
         var qrcode = new QRCode(document.getElementById("qr_code"), {
            text: unique,
            width: 100,
            height: 100,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
         });

         var qrcode = new QRCode(document.getElementById("staff_code"), {
            text: unique,
            width: 60,
            height: 60,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
         });
      }
      $(document).on('click', '#submit-sale', function(e) {
         e.preventDefault()
         $.ajax({
            url: link_url + "pos/cart/transaction.php",
            method: "POST",
            data: $('#trans').serialize(),
            dataType: "json",
            success: function(r) {
               if (r.msg != 'FAIL') {
                  $('#payModal').modal('hide');
                  successAlert('Procesed Succesfully');
                  var print_receipt_page = $("#print_receipt_page").val()
                  var c_url = print_receipt_page + '?trans_no' + '=' + r.trans_no + '&where=' + 'draft';
                  clearCartIt();
                  // fetch();
                  window.location.href = c_url;

               } else {
                  $("#alert").css("display", "block");
                  $("#alert").html(r.error);

               }
            }
         });
      });

      $(document).on('click', '#dis_cal', function(e) {
         var token = $("#token").val();
         var input_amt = $("#cost_of_item").val()
         if (token == "") {
            errorAlert("Token Cannot be empty")
         } else {
            $.ajax({
               url: "hold/cal_discount.php",
               method: "POST",
               data: {
                  calculate_discount: 1,
                  token: token,
               },
               dataType: "json",
               success: function(r) {
                  if (r.msg == "OK") {
                     if (r.discount_type == 1) {
                        var discount_type = "In Value";
                        var amt = input_amt - r.discount_value;
                        // $("#amount").val(amt);
                        process_discount(amt);
                        $("#discount_value").text(r.discount_value)
                        $("#discount_type").text(discount_type)
                        // successAlert(amt)
                     } else {
                        var discount_type = "In Percentage";
                        var percent = input_amt / 100 * r.discount_value;
                        var amt = input_amt - percent;
                        // $("#amount").val(amt);
                        process_discount(amt);
                        $("#discount_value").text(r.discount_value)
                        $("#discount_type").text(discount_type)
                        // successAlert(amt)
                     }
                  } else {
                     errorAlert(r.error)
                     // $("#token").val('').focus();
                  }
               }
            });
         }
      });

      $(document).on('change', '#select_store', function(e) {
         var estore_id = $(this).val();
         $.ajax({
            url: "cart/fetch_item.php",
            method: "POST",
            data: {
               fetch: 1,
               store_id: estore_id,
            },
            // dataType: "json",
            success: function(data) {
               $('#all_items').html(data);
               clearCartIt();
               if (estore_id == 1) {
                  successAlert('Wine Store Mode Activated')
                  $('#store').val(estore_id);

               } else {
                  successAlert('Lounge Mode Activated')
                  $('#store').val(estore_id);

               }


            }
         });
      });

   })
</script>

<script type="text/javascript">
   // Alert
   function successAlert(msg) {
      Swal.fire({
         title: msg,
         type: "success",
         // html: 'Would you like to send an <b>sms or email</b> to the Customer ?',
         showCloseButton: !1,
         // showCancelButton: !0,
         focusConfirm: !1,
         confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
         confirmButtonAriaLabel: "Thumbs up, great!",
         // cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
         // cancelButtonAriaLabel: "Thumbs down",
         confirmButtonClass: "btn btn-primary",
         buttonsStyling: !1,
         // cancelButtonClass: "btn btn-danger ml-1"
      });
   }

   function successTime(msg) {
      Swal.fire({
         position: "center",
         type: "success",
         title: msg,
         showConfirmButton: !1,
         timer: 1500,
         confirmButtonClass: "btn btn-primary",
         buttonsStyling: !1
      })
   }

   function errorAlert(msg) {
      Swal.fire({
         title: msg,
         type: "error",
         // html: 'Would you like to send an <b>sms or email</b> to the Customer ?',
         showCloseButton: !1,
         timer: 1500,
         showCancelButton: !1,
         // focusConfirm: !1,
         // confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
         // confirmButtonAriaLabel: "Thumbs up, great!",
         // cancelButtonText: '<i class="la la-thumbs-down"></i> No',
         // cancelButtonAriaLabel: "Thumbs down",
         confirmButtonClass: "btn btn-primary",
         buttonsStyling: !1,
         // cancelButtonClass: "btn btn-danger ml-1"
      });
   }

   function errorTime(msg) {
      Swal.fire({
         position: "center",
         type: "error",
         title: msg,
         showConfirmButton: !1,
         timer: 1500,
         confirmButtonClass: "btn btn-primary",
         buttonsStyling: !1
      })
   }

   function errorOption(title, text, eid, store_id) {
      var stock_url = $("#stock_url").val()
      var c_url = stock_url + '?id' + '=' + eid + '&store_id' + '=' + store_id;
      swal({
            title: title,
            text: text,
            icon: "warning",
            buttons: true,
            dangerMode: true,
         })
         .then((willDelete) => {
            if (willDelete) {
               window.location.href = c_url;
            }
            // else {
            //   swal("Your imaginary file is safe!");
            // }
         });
   }
</script>

<script type="text/javascript">
   var socket = null;

   function printBill(bill) {
      if (Settings.remote_printing == 1) {
         Popup($('#bill_tbl').html(), 'bill');
      } else if (Settings.remote_printing == 2) {
         if (socket.readyState == 1) {
            if (Settings.print_img == 1) {
               $('#bill-data').show();
               $('#preb').html(
                  '<pre style="background:#FFF;font-size:20px;margin:0;border:0;color:#000 !important;">' +
                  bill_data.info +
                  bill_data.items +
                  '\n' +
                  bill_data.totals +
                  '</pre>'
               );
               var element = $('#bill-data').get(0);
               html2canvas(element, {
                  scrollY: 0,
                  scale: 1.7
               }).then(function(canvas) {
                  var dataURL = canvas.toDataURL();
                  var socket_data = {
                     'printer': false,
                     'text': dataURL,
                     'cash_drawer': 0
                  };
                  socket.send(JSON.stringify({
                     type: 'print-img',
                     data: socket_data
                  }));
                  // return Canvas2Image.saveAsPNG(canvas);
               });
               setTimeout(function() {
                  $('#bill-data').hide();
               }, 500);
            } else {
               var socket_data = {
                  'printer': false,
                  'logo': 'uploads/logo.png',
                  'text': bill
               };
               socket.send(JSON.stringify({
                  type: 'print-receipt',
                  data: socket_data
               }));
            }
            return false;
         } else {
            bootbox.alert('Unable to connect to socket, please make sure that server is up and running fine.');
            return false;
         }
      }
   }

   var order_printers = [];

   function printOrder(order) {
      if (Settings.remote_printing == 1) {
         Popup($('#order_tbl').html(), 'order');
      } else if (Settings.remote_printing == 2) {
         if (socket.readyState == 1) {
            if (Settings.print_img == 1) {
               $('#order-data').show();
               $('#preo').html(
                  '<pre style="background:#FFF;font-size:20px;margin:0;border:0;color:#000 !important;">' + order_data.info + order_data.items + '</pre>'
               );
               var element = $('#order-data').get(0);
               html2canvas(element, {
                  scrollY: 0,
                  scale: 1.7
               }).then(function(canvas) {
                  var dataURL = canvas.toDataURL();
                  var socket_data = {
                     'printer': false,
                     'text': dataURL,
                     'order': 1,
                     'cash_drawer': 0
                  };
                  socket.send(JSON.stringify({
                     type: 'print-img',
                     data: socket_data
                  }));
                  // return Canvas2Image.saveAsPNG(canvas);
               });
               setTimeout(function() {
                  $('#order-data').hide();
               }, 500);
            } else {
               if (order_printers == '') {
                  var socket_data = {
                     'printer': false,
                     'order': true,
                     'logo': 'uploads/logo.png',
                     'text': order
                  };
                  socket.send(JSON.stringify({
                     type: 'print-receipt',
                     data: socket_data
                  }));
               } else {
                  $.each(order_printers, function() {
                     var socket_data = {
                        'printer': this,
                        'logo': 'uploads/logo.png',
                        'text': order
                     };
                     socket.send(JSON.stringify({
                        type: 'print-receipt',
                        data: socket_data
                     }));
                  });
               }
            }
            return false;
         } else {
            bootbox.alert('Unable to connect to socket, please make sure that server is up and running fine.');
            return false;
         }
      }
   }

   $(document).on('click', '#register_details', function() {
      $("#registerModal").modal('show');
      var date = $("#date").val();
      $.ajax({
         url: 'cart/fetch_register.php',
         method: 'post',
         data: {
            fetch: 1,
            from: date
         },
         // dataType: 'json',
         success: function(r) {
            $('#show_register').html(r);
         }
      });
   })

   $(document).on('click', '#close_reg', function() {
      $("#registerModal").modal('show');
      var date = $("#date").val();
      $.ajax({
         url: 'cart/fetch_register.php',
         method: 'post',
         data: {
            fetch: 1,
            close_reg: 1,
            from: date
         },
         // dataType: 'json',
         success: function(r) {
            $('#show_register').html(r);
         }
      });
   });

   $(document).on('click', '#close_register', function(e) {
      e.preventDefault();
      var eUrl = $('#url').val()
      $.ajax({
         url: 'cart/post_sales.php',
         method: 'post',
         data: $('#form').serialize(),
         dataType: 'json',
         success: function(r) {
            if (r.msg == 'OK') {
               window.location.href = eUrl;
            } else {
               errorAlert('Could not close Register')
            }
         }
      });
   })
</script>

<script type="text/javascript">

</script>
<script src="<?php echo url_for('/assets/dist/js/libraries.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo url_for('/assets/dist/js/scripts.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo url_for('/assets/dist/js/pos.min.js') ?>" type="text/javascript"></script>
</body>

</html>