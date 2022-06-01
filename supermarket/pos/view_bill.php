<?php require_once('../private/initialize.php');  ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer Display | alphaPOS</title>
    <base href=""/>
    <link rel="shortcut icon" href="<?php echo url_for('assets/images/icon.png') ?>"/>
    <meta http-equiv="cache-control" content="max-age=0"/>
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="expires" content="0"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <link href="<?php echo url_for('assets/dist/css/styles.css') ?>" rel="stylesheet" type="text/css" />
    <style type="text/css">
        html, body {
            background: #F9F9F9;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            min-width: 400px;
            color: #333;
        }
        a { outline: none; }
        h2 { margin: 20px 0; }
        .bill {
            min-height: 600px;
            background: #FFF;
            margin: 20px 20px 0 20px;
        }
        .content { display: none; }
        .with-promo-space .wrap {
            margin: 0;
            padding: 0;
            padding-right: 480px;
            overflow: hidden;
        }
        .with-promo-space .main {
            margin: 20px -500px 0 auto;
            width: 100%;
        }
        .with-promo-space .content {
            display: block;
            padding-right: 40px;
        }
        .with-promo-space .bill {
            width: 450px;
            float: left;
            min-height: 600px;
        }
        td { vertical-align: middle !important; }
        #product-list {
            display: block;
            overflow: hidden;
            min-height: 486px;
            border: 1px solid #ddd;
            padding: 20px 20px 0 20px;
        }
        #totals { border-top: 1px solid #ddd; }
        .preview_frame { width: 100%; }
        @media print {
            .wrap { padding: 0; width: 100%; }
            .main { display: none; margin: 0; }
            .bill { width: 90%; margin-left: auto; margin-right: auto; height: auto !important; }
            .bill, #product-list, #billTable { width: 100%; height: auto !important; min-height: 200px; }
            #billTable td { border-bottom: 1px solid #CCC; }
            #totals td { border: 1px solid #CCC !important; border-color: #CCC !important; }
        }
    </style>
    </head>
<body class="with-promo-space">
<!-- just remove the class with-promo-space from body to make it full page -->
<noscript>
    <div class="global-site-notice noscript">
        <div class="notice-inner">
            <p><strong>JavaScript seems to be disabled in your browser.</strong><br>You must have JavaScript enabled in
                your browser to utilize the functionality of this website.</p>
        </div>
    </div>
</noscript>

<div class="wrap">
    <div class="bill" id="bill">
        <div id="product-list">
            <table style="margin-bottom: 0;" id="billTable" class="table table-striped table-condensed">
                <thead>
                <tr>
                    <th width="50%" class="text-center">Product</th>
                    <th width="15%" class="text-center">Price</th>
                    <th width="15%" class="text-center">Qty</th>
                    <th width="20%" class="text-center">Subtotal</th>
                </tr>
                </thead>
                <tbody id="cart_details"></tbody>
            </table>
        </div>
        <div id="totals">
          
            <div style="width:100%; float:right; padding:5px; color:#000; background: #FFF;" id="totalTable">
                 <table id="totaltbl" class="table table-condensed totals" style="margin-bottom:10px; font-size: 20px">
                    <tbody>
                       <tr class="info">
                          <td width="25%">Total Items</td>
                          <td class="text-right" style="padding-right:10px;">
                             <span id="count">0</span>(<span id="total_quantity">0</span>)</td>
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
                             Total Payable<a role="button" data-toggle="modal" data-target="#noteModal">
                             <i class="fa fa-comment"></i>
                             </a>
                          </td>
                          <td class="text-right" colspan="2" style="font-weight:bold;">
                             <span id="total-payable">0</span></td>
                       </tr>
                    </tbody>
                 </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="main">
        <div class="content text-center">
            <!-- you can display any promotional content by editing themes/yourtheme/views/promotions.php -->
            <div class="site-wrapper">

                <div class="site-wrapper-inner">

                    <div class="cover-container">

                        <div class="masthead ">
                            <div class="inner">

                                <!-- <h3 class="text-center"><?php //echo $company->company_name ?></h3> -->
                            </div>
                        </div>

                        <div class="inner cover">
                            <h1 class="cover-heading">Thank you for your visit!!!</h1>
                            <p class="lead">Please come again.</p>
                            <p class="lead">
                            If you are happy with our services, Please tell to your friends otherwise, let us know so that we can improve.</p>
                             <img width="400" class="img-fluid" src="<?php //echo url_for('/assets/images/logo.jpg') ?>">
                             <br>
                            <h3>
                                <dt>
                                    Powered By: <img width="100" class="img-fluid" src="<?php echo url_for('/assets/images/logo-1.png') ?>">
                                    <br>
                                    <h5><a href=""><i>www.sandsify.com</i></a></h5>
                                </dt>
                            </h3>
                        </div>

                        <div class="mastfoot">
                            <div class="inner">
                                <!-- <p>Simple POS by <a href="http://tecdiary.com">Tecdiary</a>.</p> -->
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<script src="https://spos.tecdiary.net/themes/default/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>



<script type="text/javascript">

     // setTimeout(function(){
     //    load_cart_data();
     //  },60000)
    

    
     function load_cart_data(){
       $.ajax({
          url:"cart/fetch_cart.php",
          method:"POST",
          dataType:"json",
          success:function(data)
          {
             // console.log(data.cart_details);
             $('#cart_details').html(data.cart_details);
             $('#total-payable').text(data.total_payable);
             $('#total').text(data.total_price);
             $('#count').text(data.total_item);
             $('#total_quantity').text(data.total_quantity);
             $('#ts_con').text(data.tax);
          }
       });
    }

    var count = 1, an = 1, product_tax = 0, invoice_tax = 0, total_discount = 0, total = 0;

    function widthFunctions(e) {
        var wh = $(window).height(),
            tT = $('#totalTable').outerHeight(true);
        $('#bill').css("height", (wh - 42));
        $('#product-list').css("height", (wh - tT - 42));
        $('.preview_frame').css("height", (wh - 42));
    }
    $(window).bind("resize", widthFunctions);
    $(window).bind("load", widthFunctions);

    $(document).ready(function () {
        load_cart_data();
        window.setInterval(function () {
            // loadItems();
            load_cart_data();
        }, 1000);
    });
    
   
</script>
</body>
</html>