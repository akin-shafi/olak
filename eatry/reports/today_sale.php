<?php require_once('../private/initialize.php');
$page_title = 'Today Sales';
$page = 'Reports';
$from = date("Y-m-d");
$to = date("Y-m-d");

require_login();

include(SHARED_PATH . '/header.php'); ?>
<style type="text/css">
   .bold {
      font-weight: bold;
   }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1><?php echo $page_title ?> </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active"><?php echo $page_title ?></li>
      </ol>
   </section>

   <div class="col-lg-12 alerts">
      <div id="custom-alerts" style="display:none;">
         <div class="alert alert-dismissable">
            <div class="custom-msg"></div>
         </div>
      </div>
   </div>
   <div class="clearfix"></div>

   <style type="text/css">
      .table td:first-child {
         padding: 1px;
      }

      .table td:nth-child(6),
      .table td:nth-child(7),
      .table td:nth-child(8) {
         text-align: center;
      }

      .table td:nth-child(9),
      .table td:nth-child(10) {
         text-align: right;
      }

      .action li {
         list-style: none;
      }
   </style>
   <section class="content">
      <?php echo display_session_message(); ?>
      <div class="row">
         <div class="col-xs-12">
            <div class="box box-primary">
               <div class="box-header">

                  <h3 class="box-title">Please use the table below to navigate or filter the results.</h3>
               </div>
               <div>

               </div>
               <div class="container-fluid">
                  <div class="row ">
                     <?php for ($i = 1; $i <= 3; $i++) {
                        if (in_array($loggedInAdmin->admin_level, [1, 2, 3])) {
                           $created_by = "";
                        } else {
                           $created_by = $loggedInAdmin->id;
                        }
                        if ($i == 1) {
                           $title = "Total Sales";
                           $sales = Transaction::sum_of_sales(['from' => $from, 'to' => $to,  'created_by' => $created_by]);
                           $icon = "shopping-cart";
                           $color = "navy";
                        } else if ($i == 2) {
                           $title = "Cash Sales";
                           $sales = Transaction::sum_of_sales(['from' => $from, 'to' => $to, 'payment_method' => 'cash',  'created_by' => $created_by]);
                           $icon = "money";
                           $color = "teal";
                        } else if ($i == 3) {
                           $title = "POS Sales";
                           $sales = Transaction::sum_of_sales(['from' => $from, 'to' => $to, 'payment_method' => 'credit_card',  'created_by' => $created_by]);
                           $icon = "credit-card";
                           $color = "maroon";
                        }
                     ?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                           <div class="info-box bg-<?php echo $color ?>">
                              <span class="info-box-icon"><i class="fa fa-<?php echo $icon ?>"></i></span>
                              <div class="info-box-content">
                                 <span class="info-box-text"><?php echo $title ?> </span>
                                 <span class="info-box-number">₦ <?php echo number_format($sales, 2); ?></span>
                                 <div class="progress">
                                    <div style="width: 100%" class="progress-bar"></div>
                                 </div>
                                 <span class="progress-description">Today </span>
                              </div>
                           </div>
                        </div>
                     <?php } ?>

                  </div>
               </div>
               <div class="box-body">
                  <div class="table-responsive">
                     <table id="example2" class="table table-bordered table-striped table-hover">
                        <thead class="cf">
                           <tr class="active">
                              <th>SN</th>
                              <th style=" text-align:center;">Actions</th>
                              <th class="col-xs-2">Date</th>
                              <th class="col-xs-2">Created By</th>
                              <th>Customer</th>
                              <th>Trans_no</th>
                              <th class="col-xs-1">Qty</th>
                              <!-- <th class="col-xs-1">Tax</th> -->
                              <th class="col-xs-1">G.Total(<?php echo $currency; ?>)</th>
                              <!-- <th class="col-xs-1">Grand Total(<?php //echo $currency; 
                                                                     ?>)</th> -->
                              <!-- <th class="col-xs-1">Paid(<?php echo $currency; ?>)</th> -->
                              <!-- <th class="col-xs-1">Balnc(<?php //echo $currency; 
                                                               ?>)</th> -->
                              <th class="col-xs-1">Verified</th>
                              <th class="col-xs-1">Status</th>

                           </tr>
                        </thead>
                        <tbody>
                           <?php $sn = 1;

                           // echo $from;
                           if (in_array($loggedInAdmin->admin_level, [1, 2, 3])) {
                              $trans =  Transaction::find_trans(['from' => $from, 'to' => $to, 'order' => 'DESC']);
                           } else {
                              $trans = Transaction::find_trans(['from' => $from, 'to' => $to, 'created_by' => $loggedInAdmin->id, 'order' => 'DESC']);
                           }



                           foreach ($trans as $value) {
                              if ($value->balance == 0) {
                                 $status = 'Paid';
                              } else {
                                 $status = 'Owning';
                              }

                              if ($value->verification_status  == 1) {
                                 $verify = 'Verified';
                              } else {
                                 $verify = 'Unverified';
                              }
                           ?>
                              <tr class="text-center">
                                 <td style="max-width:30px;"><?php echo $sn++ ?></td>
                                 <td class="action" style="min-width:115px; max-width:115px; text-align:center;">
                                    <li class="dropdown hidden-xs">
                                       <button class="dropdown-toggle btn btn-primary btn-xs" data-toggle="dropdown">
                                          Options
                                       </button>
                                       <ul class="dropdown-menu ">
                                          <li class="view_sale" data-id="<?php echo $value->trans_no ?>" title="View sale"><a href="#"><i class="fa fa-list"></i>View Sales</a>
                                          </li>
                                          <?php if ($stock_mgt == 1) { ?>
                                             <li class="edit_sale " data-id="" title="Edit Sale">
                                                <a href="<?php echo url_for('/return/index.php?ref_no=' . $value->trans_no); ?>">
                                                   <i class="fa fa-edit"></i>Edit Sales</a>
                                             </li>

                                             <li class="void" data-id="<?php echo $value->trans_no ?>" title="Void sale"><a href="#"><i class="fa fa-ban"></i>Void Sales</a>
                                             </li>
                                          <?php } ?>

                                       </ul>
                                    </li>
                                 </td>
                                 <td class="col-xs-2"><?php echo date('D d M y h:i:a', strtotime($value->created_at)) ?></td>
                                 <td><?php echo !empty($value->created_by) ? Admin::find_by_id($value->created_by)->full_name() : "Not Set"; ?></td>
                                 <td><?php
                                       if ($value->customer_id == 0) {
                                          echo "Walk-in Customer";
                                       } else {
                                          echo Customer::find_by_id($value->customer_id)->full_name();
                                       }

                                       ?></td>

                                 <td class="col-xs-1"><?php echo $value->trans_no; ?></td>
                                 <td class="col-xs-1"><?php echo $value->total_item; ?></td>
                                 <!-- <td class="col-xs-1"><?php //echo number_format($value->discount, 2); 
                                                            ?></td> -->
                                 <td class="col-xs-1"><?php echo number_format($value->cost_of_item, 2); ?></td>
                                 <!-- <td class="col-xs-1"><?php //echo number_format($value->total_paid, 2); 
                                                            ?></td> -->
                                 <!-- <td class="col-xs-1"><?php //echo number_format($value->balance, 2); 
                                                            ?></td> -->
                                 <td class="col-xs-1">

                                    <div class="text-center">
                                       <span class="sale_status label <?php
                                                                        echo $verify == 'Verified' ? 'label-success' : 'label-warning' ?>">
                                          <?php echo $verify; ?></span>
                                    </div>
                                 </td>

                                 <td class="col-xs-1">

                                    <div class="text-center">
                                       <span class="sale_status label <?php
                                                                        echo $status == 'Paid' ? 'label-success' : 'label-warning' ?>"><?php echo $status; ?></span>
                                    </div>
                                 </td>

                              </tr>
                           <?php } ?>
                        </tbody>


                     </table>

                  </div>
                  <div class="modal fade" id="picModal" tabindex="-1" role="dialog" aria-labelledby="picModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                              <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
                              <h4 class="modal-title" id="myModalLabel">title</h4>
                           </div>
                           <div class="modal-body text-center">
                              <img id="product_image" src="" alt="" />
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
<div class="modal" data-easein="flipYIn" id="posModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header no-print">
            <button type="button" class="close" id="receipt-modal-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
            <h4 class="modal-title" id="receipt-title"></h4>
         </div>
         <div id="show_view" class="pl-3"></div>
      </div>
   </div>
</div>

<div class="modal in" data-easein="flipYIn" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="">
   <div class=" modal-dialog modal-success">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Payment</h4>
         </div>
         <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <!-- <input type="hidden" name="spos_token" value="ebce7b530381e77724b12499415b9760" /> -->
            <div class="modal-body">
               <div id="show_fields"></div>


               <div class="form-group">
                  <label for="attachment">Attachment</label> <input id="attachment" type="file" name="userfile" class="form-control file">
               </div>
               <div class="form-group">
                  <label for="note">Note</label> <textarea name="note" cols="40" rows="10" class="form-control redactor" id="note"></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <input type="submit" name="add_payment" value="Add Payment" class="btn btn-primary" />
            </div>
      </div>
      </form>
   </div>
</div>

<div class="modal" data-easein="flipYIn" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
   <div class="modal-dialog ">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="payModalLabel">
               Add Payment
            </h4>
         </div>
         <form id="trans">
            <div class="modal-body">
               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" name="trans_details[paid_at]" value="" class="form-control datetimepicker" id="date" required="required" />
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <label for="reference">Customer</label>
                        <input type="text" class="form-control" name="" readonly="" id="c_name">
                     </div>
                  </div>
                  <section id="show_pay"></section>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> Close </button>
               <button class="btn btn-primary" id="submit-pay">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>


</div>

<div class="modal" data-easein="flipYIn" id="viewPaymentModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" style="opacity: 1; display: block;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
            <h4 class="modal-title" id="myModalLabel">Record of Payment</h4>
         </div>
         <div class="modal-body" id="showPayment">

         </div>
      </div>
   </div>
</div>

<div class="modal" data-easein="flipYIn" id="logModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" style="opacity: 1; display: block;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
            <h4 class="modal-title" id="myModalLabel">Logged In Users</h4>
         </div>
         <div class="modal-body">
            <h4>Please kindly inform this user to logout first and try again.</h4>
            <div id="logDetails"></div>

         </div>
      </div>
   </div>
</div>

<input type="hidden" id="url" value="<?php echo url_for('/') ?>">

<script type="text/javascript">
   // record()
   // function record(){
   //     $.ajax({
   //       url: 'cart/fetch_sales.php',
   //       method: 'post',
   //       data: {
   //         fetch: 1,
   //         // from: start.format('YYYY-MM-D'),
   //         // to: end.format('YYYY-MM-D')
   //       },
   //       // dataType: 'json',
   //       success: function(r) {
   //             $('#fetch_rec').html(r);       
   //       }
   //     });
   // }

   var eUrl = $("#url").val();
   $(document).on('click', '.view_sale', function() {
      $("#posModal").modal("show");
      var trans_no = $(this).data('id');
      window.location.href = eUrl + 'pos/print_slip.php?trans_no=' + trans_no
   });

   $(document).on('click', '.void', function(e) {
      e.preventDefault();
      var trans_no = $(this).data('id');
      if (confirm("Are you sure you want to void transaction ?")) {

         $.ajax({
            url: "inc/void.php",
            method: "POST",
            data: {
               void: 1,
               trans_no: trans_no,
            },
            dataType: 'json',
            success: function(r) {
               if (r.msg == 'OK') {
                  successAlert("Void successfully");
                  window.location.reload();
               } else {
                  // errorAlert(r.msg);
                  $("#logModal").modal("show");
                  $('#logDetails').html(r.log_details);
               }

            }
         });
      } else {
         return false;
      }
   });

   $(document).on('click', '.view_payments', function() {
      $("#viewPaymentModal").modal("show");
      var trans_no = $(this).data('id');
      $.ajax({
         url: "../sales/inc/view_payment.php",
         method: "POST",
         data: {
            view_payment: 1,
            trans_no: trans_no,
         },
         success: function(r) {
            $("#showPayment").html(r);
         }
      });
   });
   $(document).on('click', '.verify', function() {
      var unique_id = $(this).data('id');

      $.ajax({
         type: "get",
         url: "../inspection/inc/verify.php",
         data: {
            verify: 1,
            id: unique_id,
         },
         dataType: "json",
         success: function(data) {
            // bootbox.alert({message: data.msg, size: 'small'});
            if (data.msg == "OK") {
               successAlert("Verified Sucessfully");
               record();
            } else {
               // onScanError();
               errorAlert("Invalid Credential");

            }
         },
      });
   });
</script>