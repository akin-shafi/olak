<?php require_once('../private/initialize.php');
$page_title = 'Registry';
$page  = "Reports";
if (!in_array($loggedInAdmin->admin_level, [1,2,3])) {
  redirect('dashboard/sales');
}
include(SHARED_PATH . '/header.php'); ?>
<?php 
    $day = date('w');
    $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
    $week_end = date('Y-m-d', strtotime('+'.(7-$day).' days')); 
    $sales = Register::sum_of_sales(['from'=>$week_start, 'to'=>$week_end]); 
    $expenses = Expenses::sum_of_expenses(['from'=>$week_start, 'to'=>$week_end]);

    // $sales = Register::sum_of_sales(['from'=>$week_start, 'to'=>$week_end, 'created_by' => '']); 
    // $expenses = Expenses::sum_of_expenses(['from'=>$week_start, 'to'=>$week_end]);
?>

    <div class="content-wrapper" style="min-height: 341px;">
        <section class="content-header">
            <h1><?php echo $page_title ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Registry</li>            </ol>
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
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box box-success p-4">
                        <div class="box-body">
                          <div class="row">
                             
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
                                                <th>Sales Rep</th>
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
                             
                             <!-- <div class="col-md-4">
                                
                             </div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                   
                  </div>
            </div>
        </div>
    </section>


</div>

</div>


<?php include(SHARED_PATH . '/footer.php'); ?>
<div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<div class="modal in" data-easein="flipYIn" id="registerModal" >
     <div class="modal-dialog" id="show_register">
         

     </div>
  </div>
<input type="hidden" id="url" value="<?php echo url_for('/dashboard/') ?>">
<input type="hidden" id="admin_level" value="<?php echo $loggedInAdmin->id ?>">
<div id="ajaxCall"><i class="fa fa-spinner fa-pulse"></i></div>


<script type="text/javascript">
    
    var from = $('#from').val();
    var to = $('#to').val();
    var admin_level = $('#admin_level').val();
    fetch_sumitted(from, to);
    function fetch_sumitted(from, to){
        $.ajax({
          url: 'registry_inc/fetch_submitted.php',
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
          url: 'registry_inc/show_register.php',
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
             url: 'registry_inc/approve_sales.php',
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

<script src="<?php echo url_for('assets/plugins/highchart/highcharts.js') ?>"></script>
<script type="text/javascript">

    $(document).ready(function () {
        Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
                stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
            };
        });
      $('#chart').highcharts({
            chart: { },
            credits: { enabled: false },
            exporting: { enabled: false },
            title: { text: '' },
            xAxis: { categories: ['Nov-2020', ] },
            yAxis: { min: 0, title: "" },
            tooltip: {
                shared: true,
                followPointer: true,
                headerFormat: '<div class="well well-sm" style="margin-bottom:0;"><span style="font-size:12px">{point.key}</span><table class="table table-striped" style="margin-bottom:0;">',
                pointFormat: '<tr><td style="color:{series.color};padding:4px">{series.name}: </td>' +
                '<td style="color:{series.color};padding:4px;text-align:right;"> <b>{point.y}</b></td></tr>',
                footerFormat: '</table></div>',
                useHTML: true, borderWidth: 0, shadow: false,
                style: {fontSize: '14px', padding: '0', color: '#000000'}
            },
            legend: {
                useHTML: true,
                style: { direction: "ltr" }
            },
            plotOptions: {
                series: { stacking: 'normal' }
            },
            series: [{
                type: 'column',
                name: 'Tax',
                data: [4.5000]
            },
            {
                type: 'column',
                name: 'Discount',
                data: [0.0000]
            },
            {
                type: 'column',
                name: 'Sales',
                data: [165.0000]
            }
            ]
        });
  $('#chart2').highcharts({
    chart: { },
    title: { text: '' },
    credits: { enabled: false },
    exporting: { enabled: false },
    tooltip: {
        shared: true,
        followPointer: true,
        headerFormat: '<div class="well well-sm" style="margin-bottom:0;"><span style="font-size:12px">{point.key}</span><table class="table table-striped" style="margin-bottom:0;">',
        pointFormat: '<tr><td style="color:{series.color};padding:4px">{series.name}: </td>' +
        '<td style="color:{series.color};padding:4px;text-align:right;"> <b>{point.y}</b></td></tr>',
        footerFormat: '</table></div>',
        useHTML: true, borderWidth: 0, shadow: false,
        style: {fontSize: '14px', padding: '0', color: '#000000'}
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: false
        }
    },

    series: [{
        type: 'pie',
        name: 'Total Sold',
        data: [
          ['Meat Pie', 30],
          ['Special Rice', 24],
          ['Jambolaya Spag', 10],       
          ['Coke', 8],       
          ['Fanta', 7],       
        ]
    }]
});
});

</script>
<script type="text/javascript">
    var base_url = '<?php echo url_for('/') ?>';
    var site_url = '<?php echo url_for('/') ?>';
    var dateformat = 'D j M Y', timeformat = 'h:i A';
        var Settings = {"logo":"logo1.png","site_name":"SimplePOS","tel":"0105292122","dateformat":"D j M Y","timeformat":"h:i A","language":"english","theme":"default","mmode":"0","captcha":"0","currency_prefix":"USD","default_customer":"3","default_tax_rate":"5%","rows_per_page":"10","total_rows":"30","header":"<h2><strong>Simple POS<\/strong><\/h2>\r\n       My Shop Lot, Shopping Mall,<br>\r\n                                                                                              Post Code, City<br>","footer":"Thank you for your business!\r\n<br>","bsty":"3","display_kb":"0","default_category":"1","default_discount":"0","item_addition":"1","barcode_symbology":"","pro_limit":"10","decimals":"2","thousands_sep":",","decimals_sep":".","focus_add_item":"ALT+F1","add_customer":"ALT+F2","toggle_category_slider":"ALT+F10","cancel_sale":"ALT+F5","suspend_sale":"ALT+F6","print_order":"ALT+F11","print_bill":"ALT+F12","finalize_sale":"ALT+F8","today_sale":"Ctrl+F1","open_hold_bills":"Ctrl+F2","close_register":"ALT+F7","java_applet":"0","receipt_printer":"","pos_printers":"","cash_drawer_codes":"","char_per_line":"42","rounding":"1","pin_code":"abdbeb4d8dbe30df8430a8394b7218ef","purchase_code":null,"envato_username":null,"theme_style":"green","after_sale_page":null,"overselling":"1","multi_store":"1","qty_decimals":"2","symbol":null,"sac":"0","display_symbol":null,"remote_printing":"1","printer":null,"order_printers":null,"auto_print":"0","local_printers":null,"rtl":null,"print_img":null,"selected_language":"english"};
    $(window).load(function () {
        $('.mm_welcome').addClass('active');
        $('#welcome_index').addClass('active');
    });
    var lang = new Array();
    lang['code_error'] = 'Code Error';
    lang['r_u_sure'] = '<strong>Are you sure?</strong>';
    lang['register_open_alert'] = 'Register is open, are you sure to sign out?';
    lang['code_error'] = 'Code Error';
    lang['r_u_sure'] = '<strong>Are you sure?</strong>';
    lang['no_match_found'] = 'No match found';
</script>
</body>
</html>