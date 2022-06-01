<?php require_once('../private/initialize.php');
$page_title = 'Draft';
$page = 'POS';
include(SHARED_PATH . '/header.php'); ?>
<input type="hidden" id="store" value="<?php echo $_SESSION['store_id'] ?>">
 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title; ?></h1>
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
       .action li{list-style: none !important;}
    </style>
    <section class="content">
      <!-- <div id="bcTarget"></div>
      
      <script type="text/javascript">

        // $("#bcTarget").barcode("1234567890128", "ean13",{barWidth:2, barHeight:30});
      </script> -->
       <div class="row">
          <div class="col-xs-12">
             <div class="box box-primary">
                <div class="box-header">
                   <div class="dropdown pull-right">
                      
                      <div class="daterange-container btn btn-primary">
                        <div class="date-range">
                          <div id="reportrange">
                            <i class="feather-calendar cal"></i>
                            <span class="range-text"></span>
                            <i class="feather-chevron-down arrow"></i>
                          </div>
                        </div>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Tutorial Guide" class="download-reports">
                          <i class="feather-clipboard"></i>
                        </a>
                      </div>
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
                                <th style="max-width:30px;">SN</th>
                                <th class="col-xs-2">Date</th>
                                <!-- <th>Customer</th> -->
                                <th>Ref No.</th>
                                <th class="col-xs-1">No. of Items</th>
                                <th class="col-xs-1">Sold By</th>
                                <th style="min-width:115px; max-width:115px; text-align:center;">Actions</th>
                            </tr>
                         </thead>
                         <tbody id="fetch_rec">
                          <?php $sn = 1; foreach (Draft::find_by_undeleted(['order' => 'Asc']) as $key => $value) {
                                  // $p = DraftDetails::find_by_ref($value->ref_no);
                                  // pre_r($p);
                                 ?>
                                  <tr align="center">
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo date('jS, M Y', strtotime($value->created_at)); ?></td>
                                     <td><a href="<?php echo url_for('pos/draft_payment.php?ref_no='.$value->ref_no.'&cc_id='.$value->customer_id.'&action=1'.'&location=1') ?>" style="text-decoration: underline;"><?php echo $value->ref_no; ?></a></td>
                                    <td><?php echo $value->total_item; ?></td>
                                    <td><?php echo $value->created_by != "" ? Admin::find_by_id($value->created_by)->full_name() : "Not Set"; ?></td>
                                    <td><button type="text" class="btn btn-sm btn-danger delete" data-ref_no="<?php echo $value->ref_no ?>"><i class="fa fa-trash"></i>Delete</button></td>
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
  <div class="modal-dialog" >
      <div class="modal-content">
           <div class="modal-header no-print">
              <button type="button" class="close" id="receipt-modal-close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
              <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
              <h4 class="modal-title" id="receipt-title"></h4>
           </div>
            <div id="show_view" style="padding: 20px;"></div>
      </div>
  </div>
</div>



<input type="hidden" id="url" value="<?php echo url_for('/') ?>">  


<script type="text/javascript" >
  
     $(document).on("click", ".delete", function() {
      var ref_no = $(this).data('ref_no');
      if(confirm("Are you sure you want delete item from draft ?")){
        $.ajax({
          url: 'hold/action2.php',
          method: 'post',
          data: {
            action: "delete_draft",
            ref_no: ref_no
          },
          dataType: 'json',
          success: function(r) {
             if(r.msg == 'FAIL'){
                errorAlert(r.error);
             }else{
                successAlert("Deleted Successfully");
                window.location.reload();
             }
                        
          }
        });
      }else{
          return false;
       }
     })
</script>

