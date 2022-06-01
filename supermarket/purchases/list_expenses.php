<?php require_once('../private/initialize.php');
$page_title = 'List of';
$page = 'Purchases';
include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title .' Expenses'?> </h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $page_title .' '. $page ?> </li>
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
                   
                   <h3 class="box-title">Please use the table below to navigate or filter the results.</h3>
                </div>
                <div class="box-body">
                   <div class="table-responsive">
                      <table id="example2" class="table table-bordered table-striped table-hover">
                        <thead class="cf">
                          <tr>
                              <th style="max-width:30px;">ID</th>
                              <th>Date</th>
                              <th>Refrence</th>
                              <th>Total</th>
                              <th>Note</th>
                              
                              <th style="width:65px;">Actions</th>
                          </tr>
                        </thead>
                         </thead>
                         <tbody>
                          <?php $sn = 1; foreach (Expenses::find_by_undeleted() as $value) { 
                            // if( $value->account_status == 0 ){
                            //   $status = 'Inactive';
                            // }else{
                            //   $status = 'Active';
                            // }
                          ?>
                          <?php  if ($value->id != 1) { ?>
                         	  <tr role="row" class="odd">
                              <td><?php echo $sn++; ?></td>
                              <td class="sorting_1"><?php echo $value->date?></td>
                              <td><?php echo $value->ref; ?></td>
                              <td><?php echo $value->amount; ?></td>
                              <td><?php echo $value->note; ?></td>
                              
                             
                               <td class="text-center" style="padding:6px;">
                                <div class="btn-group btn-group-justified" role="group">
                                  <div class="btn-group btn-group-xs" role="group">
                                    <a class="tip btn btn-info btn-xs" title="Profile" href="#">
                                      <i class="fa fa-file-text-o"></i>
                                    </a>
                                  </div>

                                  <?php if (in_array($loggedInAdmin->admin_level, [1])) { ?>
                                  <div class="btn-group btn-group-xs" role="group">
                                    <a class="tip btn btn-warning btn-xs" title="Profile" href="<?php echo url_for('expenses/edit.php?id=' . $value->id) ?>">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  </div>
                                  <div class="btn-group btn-group-xs" role="group">
                                    <a class="tip btn btn-danger btn-xs" title="Delete User" href="<?php echo url_for('expenses/delete.php?id=' . $value->id) ?>" onclick="return confirm('You are going to remove this user permanently. Press OK to proceed and Cancel to Go Back')">
                                      <i class="fa fa-trash-o"></i>
                                    </a>
                                  </div>
                                  <?php } ?>
                                </div>
                              </td>
                             
                              
                            </tr>
                          <?php } ?>
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


