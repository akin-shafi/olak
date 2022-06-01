<?php require_once('../private/initialize.php');
$page_title = 'Dashboard';
$page  = "";
if(!in_array($loggedInAdmin->admin_level, [4])){ 
  // redirect('/');
}
    $day = date('w');
    $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
    $week_end = date('Y-m-d', strtotime('+'.(7-$day).' days')); 
    $sales = Register::sum_of_sales(['from'=>$week_start, 'to'=>$week_end, 'created_by'=>$loggedInAdmin->id]); 
    $expenses = Expenses::sum_of_expenses(['from'=>$week_start, 'to'=>$week_end, 'created_by'=>$loggedInAdmin->id]);
    
?>
<?php include(SHARED_PATH . '/header.php');  ?>
    <div class="content-wrapper" style="min-height: 341px;">
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>            </ol>
        </section>

        <div class="col-lg-12 alerts">
            <div id="custom-alerts" style="display:none;">
                <div class="alert alert-dismissable">
                    <div class="custom-msg"></div>
                </div>
            </div>
                    </div>
        <div class="clearfix"></div>


<div class="p-3"><?php echo display_session_message(); ?></div>


    <section class="content">

       <div class="row">
          <div class="col-xs-12">
             <div class="box box-primary">
                <div class="box-header">
                   <p>Please review the report below</p>
                </div>
                <div class="box-body">
                   <div class="col-sm-12">
                      <div class="row ">
                         <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-aqua">
                               <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                               <div class="info-box-content">
                                  <span class="info-box-text">Sales Value</span>
                                  <span class="info-box-number"><?php echo $currency.' '. number_format($sales, 2) ?></span>
                                  <div class="progress">
                                     <div style="width: 100%" class="progress-bar"></div>
                                  </div>
                                  <span class="progress-description">
                                  This Week                                      </span>
                               </div>
                            </div>
                         </div>
                         <div class="col-md-3 col-sm-6 col-xs-12 d-none">
                            <div class="info-box bg-yellow">
                               <span class="info-box-icon"><i class="fa fa-plus"></i></span>
                               <div class="info-box-content">
                                  <span class="info-box-text">Purchases Value</span>
                                  <span class="info-box-number">0.00</span>
                                  <div class="progress">
                                     <div style="width: 0%" class="progress-bar"></div>
                                  </div>
                                  <span class="progress-description">
                                  0 Purchases                                        </span>
                               </div>
                            </div>
                         </div>
                         <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-red">
                               <span class="info-box-icon"><i class="fa fa-circle-o"></i></span>
                               <div class="info-box-content">
                                  <span class="info-box-text">Expenses Value</span>
                                  <span class="info-box-number"><?php echo $currency.' '. number_format($expenses, 2) ?></span>
                                  <div class="progress">
                                     <div style="width: 0%" class="progress-bar"></div>
                                  </div>
                                  <span class="progress-description">
                                  This Week                                       </span>
                               </div>
                            </div>
                         </div>
                         <div class="col-md-3 col-sm-6 col-xs-12 d-none">
                            <div class="info-box bg-green">
                               <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                               <div class="info-box-content">
                                  <span class="info-box-text">Profit and/or Loss</span>
                                  <span class="info-box-number">0.00</span>
                                  <div class="progress">
                                     <div style="width: 100%" class="progress-bar"></div>
                                  </div>
                                  <span class="progress-description">- 0 - 0</span>
                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="row">
                         <div class="col-md-12">
                            <div class="calendar table-responsive">
                               <div class="d-flex justify-content-between">
                                 <h5 class="border-bottom pb-2 text-uppercase"><b>This Week Submitted Report</b></h5>
                                 <form class="form-inline p-2 d-flex justify-content-end" id="find_week">
                                      <input type="date" class="form-control" id="from" value="<?php echo $week_start ?>">
                                      <input type="date" class="form-control" id="to" value="<?php echo $week_end ?>">
                                      <input type="button" class="btn btn-sm btn-primary" id="find" value="Find">
                                  </form>
                               </div>
                               <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Open Time</th>
                                            <th>Close Time</th>
                                            <th>Cash in hand</th>
                                            <th>Total Sales</th>
                                           <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fetch_submitted">
                                        
                                    </tbody> 
                               </table>
                            </div>
                         </div>
                         <!-- <div class="col-md-4">
                            
                         </div> -->
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>

</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        Version <strong>4.0.30</strong>
    </div>
    Copyright © 2020 SimplePOS. All rights reserved.
</footer>
</div>
<div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<div class="modal in" data-easein="flipYIn" id="registerModal" >
     <div class="modal-dialog" id="show_register">
         

     </div>
  </div>

<div id="ajaxCall"><i class="fa fa-spinner fa-pulse"></i></div>


 
<input type="hidden" id="url" value="<?php echo url_for('/dashboard/') ?>">
<input type="hidden" id="admin_level" value="<?php echo $loggedInAdmin->id ?>">
<script src="<?php echo url_for('/assets/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
<script src="<?php echo url_for('/assets/dist/js/scripts.min.js') ?>" type="text/javascript"></script>

    <script type="text/javascript" src="<?php echo url_for('assets/dist/js/settings.js') ?>"></script>

    <script src="<?php echo url_for('assets/dist/js/select2.full.min.js') ?>"></script>
    <script src="<?php echo url_for('/assets/dist/js/libraries.min.js') ?>" type="text/javascript"></script>

    <script src="<?php echo url_for('/assets/dist/js/pos.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo url_for('assets/dist/js/sweetalert2.all.min.js') ?>"></script>
<script src="<?php echo url_for('assets/dist/js/spos_ad.min.js') ?>"></script>

<script type="text/javascript">
    
    var from = $('#from').val();
    var to = $('#to').val();
    var admin_level = $('#admin_level').val();
    fetch_sumitted(from, to);
    function fetch_sumitted(from, to){
        $.ajax({
          url: 'fetch_sales.php',
          method: 'post',
          data: {
            fetch: 1,
            from: from,
            to: to,
            admin_level: admin_level, 
          },
          // dataType: 'json',
          success: function(r) {
                $('.fetch_submitted').html(r);       
          }
        });
    }
    $(document).on('click', '#find', function(e){
        e.preventDefault();
        var from = $('#from').val();
        var to = $('#to').val();
        fetch_sumitted(from, to);
    })

    $(document).on('click', '.view', function(){
        $("#registerModal").modal('show');
        var eid = $(this).data('id');
        var level = $(this).data('level');
        

        $.ajax({
          url: 'show_register.php',
          method: 'post',
          data: {
            fetch: 1,
            id: eid,
            admin_level: level,
            close_reg: 1,
          },
          // dataType: 'json',
          success: function(r) {
                $('#show_register').html(r);       
          }
        });
    })

    $(document).on('click', '#close_register', function(e){
           e.preventDefault();
           var eUrl = $('#url').val()
           $.ajax({
             url: 'approve_sales.php',
             method: 'post',
             data: $('#form').serialize(),
             dataType: 'json',
             success: function(r) {
               if (r.msg =='OK' ) {
                  window.location.href = eUrl;
                  $("#registerModal").modal('hide');
                  successAlert('Account Approved')
               }else{
                  errorAlert('Could not Approve Account')
               }    
             }
           });
    })
</script>

</body>
</html>