<?php require_once('../private/initialize.php');
$page_title = 'List';
$page = 'Reports';

$from = date("Y-m-d");
$to = date("Y-m-d");
include(SHARED_PATH . '/header.php'); ?>
<input type="hidden" id="store" value="<?php echo $_SESSION['store_id'] ?>">
 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ." ". $page; ?></h1>
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
                      
                      <!-- <div class="daterange-container btn btn-primary">
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
                      </ul> -->
                   </div>
                   <h3 class="box-title">Please use the table below to navigate or filter the results.</h3>
                </div>
                <div class="box-body">





                  <div class="container-fluid border p-2 mb-3">
                    <div class="row">
                      <div class="col-lg-3 ">
                        <div class="form-group">
                              <select class="form-control " id="sales_rep" >
                                    <option value="">* All * </option>
                                    <?php foreach (Admin::find_by_undeleted() as $key => $value) { ?>
                                      <?php if ($value->admin_level == 4) { ?>
                                        <option value="<?php echo $value->id ?>"><?php echo Admin::find_by_id($value->id)->full_name() ?></option>
                                      <?php } ?>
                                      
                                    <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                          <input type="date" class="form-control" id="trans_date_from" value="<?php echo $from ?>" required="">
                        </div>
                        <div class="form-group">
                          <input type="date" class="form-control" id="trans_date_to" value="<?php echo $to ?>" required="">
                        </div>
                      </div>

                      <div class="col-lg-9 " id="return">
                          
                      </div>

                      <div class="col-lg-3 ">
                        <button class="btn-primary form-control btn-sm" id="find">Find</button>
                      </div>
                    </div>
                  </div>


                   <div class="table-responsive">
                      <table id="example2" class="table table-striped table-bordered table-hover" style="margin-bottom:5px;">
                         <thead>
                            <tr class="active">
                                <th style="max-width:30px;">SN</th>
                                <th class="col-xs-2">Date</th>
                                <th style="min-width:115px; max-width:115px; text-align:center;">Actions</th>
                                <th class="col-xs-2">Created By</th>
                                <th class="col-xs-2">Payment Method</th>
                                <th>Trans_no</th>
                                <th class="col-xs-1">No. of Items</th>
                                <th class="col-xs-1">Grand Total(<?php echo $currency; ?>)</th>
                                <th class="col-xs-1">Status</th>
                                
                            </tr>
                         </thead>
                         <tbody id="fetch_rec">
                          
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
            <div id="show_view" class="modal-body" style="font-size: 10px !important"></div>
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
                 <label for="attachment">Attachment</label>        <input id="attachment" type="file" name="userfile" class="form-control file">
              </div>
              <div class="form-group">
                 <label for="note">Note</label>        <textarea name="note" cols="40" rows="10"  class="form-control redactor" id="note"></textarea>
              </div>
           </div>
           <div class="modal-footer">
              <input type="submit" name="add_payment" value="Add Payment"  class="btn btn-primary" />
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
                         <input type="text" name="trans_details[paid_at]" value=""  class="form-control datetimepicker" id="date" required="required" />
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
  <div class="modal-dialog modal-lg">
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
<input type="hidden" id="url" value="<?php echo url_for('/') ?>">  


<script type="text/javascript" >
      function qrcode(){
          var unique = $(".h_trans").val();
          var element = $(".qrcode");
          for (var i = 0; i < element.length; i++) {
            // element[i]
            // console.log(element[i])
              var qrcode = new QRCode(element[i], {
               text: unique,
               width: 170,
               height: 170,
               colorDark : "#000000",
               colorLight : "#ffffff",
               correctLevel : QRCode.CorrectLevel.H
             });
          }
          
          var ele = $(".code");
          for (var i = 0; i < ele.length; i++) {
              var qrcode = new QRCode(ele[i], {
                 text: unique,
                 width: 60,
                 height: 60,
                 colorDark : "#000000",
                 colorLight : "#ffffff",
                 correctLevel : QRCode.CorrectLevel.H
               });
          }
      }
      $(document).ready(function() {
        
        var eUrl = $("#url").val();
         $(document).on('click', '.view_sale', function() {
            var trans_no = $(this).data('id');
            window.open(eUrl +'pos/print_slip.php?trans_no='+ trans_no, "_blank");

            
         });

         $(document).on('click', '.add_payment', function() {
            var trans_no = $(this).data('id');
            $("#payModal").modal('show');

            $.ajax({
               url:eUrl +"sales/inc/addPayForm.php",
               method:"GET",
               data:{
                add_payment: 1, 
                trans_no: trans_no, 
               },
               // dataType: "json",
               success:function(r)
               {             
                 $("#show_pay").html(r);
                 $("#total_paying").text(formatMoney(parseFloat($("#total_paying").text())));
                  $("#twt").text(formatMoney(parseFloat($("#twt").text())));
                  $("#quick-payable").text(formatMoney(parseFloat($("#quick-payable").text())));
                  $("#amount").focus();
                  $("#c_name").val($("#r_cname").data('name'));

               }
            });

         });

         $(document).on("click", ".quick-cash", function() {
             var item = $(this).val();
             var num = parseFloat($("#cbalance").val());
             var cbalance = Math.round(num);
             if(item == ""){
                $("#amount").val("").focus();
                $("#balance").text(formatMoney(cbalance));
                $("#balance_input").val(cbalance);
             }else{
                $("#amount").val(parseFloat(item)).focus();
                process_amt();
             }
          })

         function process_amt(){
           var amt = parseFloat($("#amount").val());
           var num = parseFloat($("#cbalance").val());
           var cbalance = Math.round(num);
           var tpaid = parseFloat($("#tpaid").val());
           var paid = tpaid + amt;
           $("#total_paying").text(formatMoney(paid));
           $("#paid").val(paid);
           $("#balance").text(formatMoney( cbalance - amt));
           $("#balance_input").val(cbalance - amt);
        }
        $(document).on("keyup", "#amount", function (t) {
           var num = parseFloat($("#cbalance").val());
           var cbalance = Math.round(num);
           var tpaid = parseFloat($("#tpaid").val());

           if($("#amount").val() == "" || $("#amount").val() == 0){
              $("#balance").text(formatMoney(cbalance));
              $("#balance_input").val(cbalance);
              $("#total_paying").text(formatMoney(tpaid));
           }else if (parseInt($(this).val()) >= $(this).attr('max')){
              $(this).val($(this).attr('max'));
              process_amt()
           }else{
            process_amt()
           }

        });
        // Listen for input event on numInput.
        $(document).on("keydown", "#amount", function (e) {
        // number.onkeydown = function(e) {
            if(!((e.keyCode > 95 && e.keyCode < 106)
              || (e.keyCode > 47 && e.keyCode < 58) 
              || e.keyCode == 8)) {
                return false;
            }
        });

        
        // Save newly payment
        $(document).on('submit', '#trans', function(e) {
            e.preventDefault();
            $.ajax({
               url:eUrl +"sales/inc/addPaymentScript.php",
               method:"POST",
               data: $('#trans').serialize(),
               dataType: "json",
               success:function(r)
               {             
                  if (r.msg == 'OK') {
                    $("#payModal").modal('hide');
                    successAlert("Payment added successfully");
                    record();
                  }else{
                    errorAlert("Error: Something went wrong");
                  }

               }
            });

         });

        $(document).on('click', '.view_payments', function() {
            $("#viewPaymentModal").modal("show");
            var trans_no = $(this).data('id');
            // console.log(id)
            $.ajax({
               url:"inc/view_payment.php",
               method:"POST",
               data:{
                view_payment: 1, 
                trans_no: trans_no, 
               },
               success:function(r)
               {             
                 $("#showPayment").html(r);
                // qrcode();

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
                success: function (data) {
                    // bootbox.alert({message: data.msg, size: 'small'});
                    if (data.msg == "OK") {
                      successAlert("Verified Sucessfully");
                      record();
                    }else{
                      // onScanError();
                      errorAlert("Invalid Credential");

                    }
                },
            });
         });
        
        var start = moment().subtract(6, 'days');
        // var start = moment();
        var end = moment();

        function record(){
            $.ajax({
              url: 'inc/fetch_record.php',
              method: 'post',
              data: {
                fetch: 1,
                from: start.format('YYYY-MM-D'),
                to: end.format('YYYY-MM-D'),
                sales_rep: sales_rep
              },
              // dataType: 'json',
              success: function(r) {
                    $('#fetch_rec').html(r);       
              }
            });
        }

          var to   = $("#trans_date_to").val();
          var from = $("#trans_date_from").val();
          var sales_rep = $("#sales_rep").val();
          // alert(to);
           find(from, to, sales_rep);
           salesSum(from, to, sales_rep)

        function find(from, to, sales_rep){
            $.ajax({
              url: 'inc/fetch_record.php',
              method: 'post',
              data: {
                fetch: 1,
                from: from,
                to: to,
                sales_rep: sales_rep
              },
              // dataType: 'json',
              success: function(r) {
                    $('#fetch_rec').html(r);       
              }
            });
        }
        function salesSum(from, to, sales_rep){
            $.ajax({
              url: 'inc/sunOfsales.php',
              method: 'post',
              data: {
                fetch: 1,
                from: from,
                to: to,
                sales_rep: sales_rep
              },
              // dataType: 'json',
              success: function(r) {
                    $('#return').html(r);       
              }
            });
        }
        
        $(document).on('click', '.void', function(e) {
            e.preventDefault();
            var trans_no = $(this).data('id');
            if (confirm("Are you sure you want to void transaction ?")) {

               $.ajax({
                  url: "../reports/inc/void.php",
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

        $(document).on('click', '#find', function(e) {
          e.preventDefault();
          // 
          var to   = $("#trans_date_to").val();
          var from = $("#trans_date_from").val();
          var sales_rep = $("#sales_rep").val();
          // alert(to);
           find(from, to, sales_rep);
           salesSum(from, to, sales_rep)
        });

          $('#reportrange').daterangepicker({
            opens: 'left',
            startDate: start,
            endDate: end,
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              '3 Days ago': [moment().subtract(2, 'days'), moment()],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
          }, fetch_table);
          fetch_table(start, end);

          function fetch_table(start, end) {
            $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
            // var Datefrom = start.format('YYYY-MM-D');
            // var Dateto = end.format('YYYY-MM-D');
            // console.log(Datefrom, Dateto)

            // $("#loading-wrapper").show();
              $.ajax({
                url: 'inc/fetch_record.php',
                method: 'post',
                data: {
                  fetch: 1,
                  from: start.format('YYYY-MM-D'),
                  to: end.format('YYYY-MM-D')
                },
                // dataType: 'json',
                success: function(r) {
                      $('#fetch_rec').html(r);       
                }
              });
          } 

          var value = 0;
         
          
      });

 
</script>

