<?php require_once('../private/initialize.php');
$page_title = 'List';
$page = 'User';
include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1>Users</h1>
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
      <?php echo display_session_message(); ?>
       <div class="row">
          <div class="col-xs-12">
             <div class="box box-primary">
                <div class="box-header">
                   
                   <h3 class="box-title">Please use the table below to navigate or filter the results.</h3>
                   <div class="dropdown pull-right">
                     <a href="<?php echo url_for('users/add.php') ?>" class="btn btn-primary btn-sm">Add New User</a>
                   </div>
                </div>
                <div class="box-body">
                   <div class="table-responsive">
                      <table id="example2" class="table table-bordered table-striped table-hover">
                        <thead class="cf">
                        <tr>
                            <th>SN</th>
                            <th>FullName</th>
                            <!-- <th>Last Name</th> -->
                            <th>Email</th>
                            <th>Group</th>
                            <th>Store</th>
                            <th style="width:100px;">Status</th>
                            <th style="width:80px;">Actions</th>
                        </tr>
                        </thead>
                         </thead>
                         <tbody>
                          <?php $sn = 1; foreach (Admin::find_by_undeleted() as $value) { 
                            if( $value->account_status == 0 ){
                              $status = 'Inactive';
                            }else{
                              $status = 'Active';
                            }
                          ?>
                          <?php  if ($value->id != 1) { ?>
                         	  <tr role="row" class="odd">
                              <td><?php echo $sn++; ?></td>
                              <td class="sorting_1"><?php echo Admin::find_by_id($value->id)->full_name() ?></td>
                              <!-- <td>Sales</td> -->
                              <td><?php echo $value->email ?></td>
                              <td><?php echo Admin::ADMIN_LEVEL[$value->admin_level] ?></td>
                              <td>Store 1</td>
                              <td class="text-center" style="padding:6px;">
                                <span class="sale_status label <?php 
                                      echo $status == 'Paid' ? 'label-warning' : 'label-success' ?>"><?php echo $status; ?>
                                </span>

                                <!-- <span class="label label-success">Active</span> -->
                              </td>
                              <td class="text-center" style="padding:6px;">
                                <div class="btn-group btn-group-justified" role="group">
                                  <?php if (!in_array($value->admin_level, [1,2])): ?>
                                    <div class="btn-group btn-group-xs" role="group">
                                      <a class="tip btn btn-warning btn-xs" title="Profile" href="<?php echo url_for('users/edit.php?id=' . $value->id) ?>">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                    </div>

                                    <div class="btn-group btn-group-xs" role="group">
                                      <a class="tip btn btn-danger btn-xs" title="Delete User" href="<?php echo url_for('users/delete.php?id=' . $value->id) ?>" onclick="return confirm('You are going to remove this user permanently. Press OK to proceed and Cancel to Go Back')">
                                        <i class="fa fa-trash-o"></i>
                                      </a>
                                    </div>
                                  <?php endif ?>
                                  

                                  
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



   <!--  <script type="text/javascript">
        $(document).ready(function () {
            $('#print').click(function (e) {
                e.preventDefault();
                var link = $(this).attr('href');
                $.get(link);
                console.log(link)
                return false;
            });
            $('#email').click(function () {
                bootbox.prompt({
                    title: "Email Address",
                    inputType: 'email',
                    value: "customer@tecdiary.com",
                    callback: function (email) {
                        if (email != null) {
                            $.ajax({
                                type: "post",
                                url: "https://spos.tecdiary.net/pos/email_receipt",
                                data: {spos_token: "c4d8a1c258ec0fd41c11a781fd9f3efe", email: email, id: 1},
                                dataType: "json",
                                success: function (data) {
                                    bootbox.alert({message: data.msg, size: 'small'});
                                },
                                error: function () {
                                    bootbox.alert({message: 'Ajax request failed!', size: 'small'});
                                    return false;
                                }
                            });
                        }
                    }
                });
                return false;
            });
        });
    </script>
 -->
