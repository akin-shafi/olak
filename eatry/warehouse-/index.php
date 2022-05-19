<?php require_once('../private/initialize.php');
$page_title = 'All Items';
$page = 'Warehouse';
include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title?> in Warehouse</h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $page ?></li>
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
      <?php echo display_session_message(); ?>
       <div class="row">
          <div class="col-xs-12">
             <div class="box box-primary">
                <div class="box-header">
                    <div class="dropdown pull-right">
                      
                      <div class="daterange-container btn btn-primary" id="addInvoice">
                        Add Item
                      </div>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                      </ul>
                   </div>
                   <h3 class="box-title">Please use the table below to navigate or filter the results.</h3>
                </div>
                <div class="box-body">
                   <div class="table-responsive">
                      <table id="example2" class="table table-bordered table-striped table-hover">
                        <thead class="cf">
                          <tr>
                              <th style="max-width:30px;">ID</th>
                              <th>Item</th>
                              <th>P.Price</th>
                              <th>Supplier</th>
                              <th>Date bought</th>
                              <th>Quantity bought</th>
                              <th>Issued Out</th>
                              <th>Issued To</th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <!-- <th>Customer Custom Field 2</th> -->
                              <th style="width:65px;">Actions</th>
                          </tr>
                        </thead>
                         </thead>
                         <tbody>
                          <?php //pre_r(Warehouse::find_by_undeleted()); ?>
                          <?php $sn = 1; foreach (Warehouse::find_by_undeleted() as $key => $value) { 

                            // if( $value->account_status == 0 ){
                            //   $status = 'Inactive';
                            // }else{
                            //   $status = 'Active';
                            // }
                          ?>
                         	  <tr>

                              <td><?php echo $sn++; ?></td>
                              <td> <?php echo !empty($value->item) ? $value->item  : "Not Set" ?></td>
                              <td> <?php echo !empty($value->purchase_price) ? $value->purchase_price : "Not Set" ?></td>
                              <td> <?php echo !empty($value->supplier) ? $value->supplier : "Not Set" ?></td>
                              <td> <?php echo !empty($value->supplied_on) ? $value->supplied_on : "Not Set" ?></td>
                              <td> <?php echo !empty($value->quantity) ? : "Not Set" ?></td>
                              <td> <?php echo !empty($value->issued_to) ? $value->issued_to : "Not Set" ?></td>
                              <td> <?php echo !empty($value->issued_status) ? $value->issued_status : "Not Set" ?></td>
                              <td> <?php echo !empty($value->created_at) ? $value->created_at : "Not Set" ?></td>
                              <td> <?php echo !empty($value->updated_at) ? $value->updated_at : "Not Set" ?></td>
                              <td> <?php echo !empty($value->created_by) ? $value->created_by : "Not Set" ?></td>
                              <td class="text-center" style="padding:6px;">
                                <div class="btn-group btn-group-justified" role="group">
                                  <div class="btn-group btn-group-xs" role="group">
                                    <a class="tip btn btn-warning btn-xs" title="Profile" href="<?php echo url_for('warehouse/edit.php?id=' . $value->id) ?>">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  </div>
                                  <div class="btn-group btn-group-xs" role="group">
                                    <a class="tip btn btn-danger btn-xs" title="Delete User" href="<?php echo url_for('warehouse/delete.php?id=' . $value->id) ?>" onclick="return confirm('You are going to remove this user permanently. Press OK to proceed and Cancel to Go Back')">
                                      <i class="fa fa-trash-o"></i>
                                    </a>
                                  </div>
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


