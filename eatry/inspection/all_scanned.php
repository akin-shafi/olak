<?php require_once('../private/initialize.php');
$page_title = 'All Scanned';
$page = 'Inspection';
include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ?></h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">sales</li>
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
       .table td:first-child { padding: 1px; }
       .table td:nth-child(6), .table td:nth-child(7), .table td:nth-child(8) { text-align: center; }
       .table td:nth-child(9), .table td:nth-child(10) { text-align: right; }
    </style>
    <section class="content">

       <div class="row">
          <div class="col-xs-12">
             <div class="box box-primary">
                <div class="box-header">
                   <div class="dropdown pull-right">
                      <button class="btn btn-primary" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      SimplePOS (POS)                        
                      <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                      </ul>
                   </div>
                   <h3 class="box-title">Please use the table below to navigate or filter the results.</h3>
                </div>
                <div class="box-body">
                   <div class="table-responsive">
                      <table id="example2" class="table table-striped table-bordered table-hover" style="margin-bottom:5px;">
                         <thead>
                            <tr class="active">
                                <th style="max-width:30px;">ID</th>
                                <th class="col-xs-2">Date</th>
                                <th>Customer</th>
                                <th class="col-xs-1">Items</th>
                                <!-- <th class="col-xs-1">Tax</th> -->
                                <th class="col-xs-1">Discount</th>
                                <th class="col-xs-1">Grand Total(<?php echo $currency; ?>)</th>
                                <th class="col-xs-1">Paid(<?php echo $currency; ?>)</th>
                                <!-- <th class="col-xs-1">Balance(<?php //echo $currency; ?>)</th> -->
                                <th class="col-xs-1">Verified</th>
                                <th class="col-xs-1">Status</th>
                                <th style="min-width:115px; max-width:115px; text-align:center;">Actions</th>
                            </tr>
                         </thead>
                         <tbody>
                            <?php $sn = 1; foreach (Transaction::find_verification(['v_status' => 1]) as $value) { 
                                if( $value->cost_of_item - $value->total_paid == 0 ){
                                    $status = 'Paid';
                                }else{
                                    $status = 'Owning';
                                }

                            if( $value->verification_status  == 1 ){
                              $verify = 'Verified';
                            }else{
                              $verify = 'Unverified';
                            }
                            ?>
                            <tr class="text-center">
                                <td style="max-width:30px;"><?php echo $sn++ ?></td>
                                <td class="col-xs-2"><?php echo date('D d M y h:i:a', strtotime($value->created_at)) ?></td>
                                <td><?php 
                                        if($value->customer_id == 0){
                                            echo "Walk-in Customer";
                                        }else{
                                            echo Customer::find_by_id($value->customer_id)->full_name();
                                        }

                                    ?></td>
                                <td class="col-xs-1"><?php echo $value->total_item; ?></td>
                                <!-- <td class="col-xs-1"><?php //echo number_format($value->tax, 2); ?></td> -->
                                <!-- <td class="col-xs-1"><?php //echo number_format($value->discount, 2); ?></td> -->
                                <td class="col-xs-1"><?php echo number_format($value->cost_of_item, 2); ?></td>
                                <td class="col-xs-1"><?php echo number_format($value->total_paid, 2); ?></td>
                                <td class="col-xs-1"><?php echo number_format($value->balance, 2); ?></td>
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
                                <td style="min-width:115px; max-width:115px; text-align:center;">
                                    <div class="text-center">
                                       <div class="btn-group">
                                        <button data-id="<?php echo $value->trans_no ?>" title="View sale" class="tip btn btn-primary btn-xs view_sale"><i class="fa fa-list"></i></button> 

                                        <button data-id="<?php echo $value->trans_no ?>" title="View Payments" class="tip btn btn-primary btn-xs view_payments"><i class="fa fa-money"></i></button> 

                                        <button data-id="<?php echo $value->trans_no ?>" title="Add Payment" class="tip btn btn-primary btn-xs add_payment"><i class="fa fa-briefcase"></i></button> 

                                        <button data-id="<?php echo $value->trans_no ?>" title="Edit Sale" class="tip btn btn-warning btn-xs edit_sale"><i class="fa fa-edit"></i></button> 

                                        <button data-id="<?php echo $value->id ?>" onclick="return confirm('You are going to delete sale, please click ok to delete.')" title="Delete Sale" class="tip btn btn-danger btn-xs delete_sale"><i class="fa fa-trash-o"></i></button></div>
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
 <div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:400px;">
        <div class="modal-content">
           <div class="modal-header np">
              <button type="button" class="close" id="receipt-modal-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
              <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
              <h4 class="modal-title" id="receipt-title"></h4>
           </div>
            <div id="show_view" style="padding: 20px;"></div>
        </div>
  </div>
</div>

<div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="opacity: 1; display: block;">
    <div class="modal-content" >
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <div id="show_view">
                
            </div>
            <!-- start -->
            
                            
        </div>
    </div>
  </div>
</div>



    <script type="text/javascript">
       $(document).ready(function() {
           $(document).on('click', '.view_sale', function() {
              $("#posModal").modal("show");
              var trans_no = $(this).data('id');
              // console.log(id)
              $.ajax({
                 url:"../pos/cart/print_receipt.php",
                 method:"GET",
                 data:{
                  view_receipt: 1, 
                  trans_no: trans_no, 
                 },
                 success:function(r)
                 {             
                   $("#show_view").html(r)
                   qrcode();
                 }
              });
           });


       });


    </script>
 