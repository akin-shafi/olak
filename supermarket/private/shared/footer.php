         <footer class="main-footer">
            <div class="pull-right hidden-xs">
               Version <strong>4.0.30</strong>
            </div>
            Copyright &copy; <?php echo date("Y") ?> alphaPOS. All rights reserved.
         </footer>
      </div>
      <!-- <div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="modal" data-easein="flipYIn" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div> -->
      <div id="ajaxCall"><i class="fa fa-spinner fa-pulse"></i></div>
      <script src="<?php echo url_for('assets/dist/js/sweetalert2.all.min.js') ?>"></script>
      
      <script type="text/javascript">
         var base_url = 'https://spos.tecdiary.net/';
         var site_url = 'https://spos.tecdiary.net/';
         var dateformat = 'D j M Y', timeformat = 'h:i A';
             var Settings = {"logo":"logo1.png","site_name":"SimplePOS","tel":"0105292122","dateformat":"D j M Y","timeformat":"h:i A","language":"english","theme":"default","mmode":"0","captcha":"0","currency_prefix":"USD","default_customer":"3","default_tax_rate":"5%","rows_per_page":"10","total_rows":"30","header":"<h2><strong>Simple POS<\/strong><\/h2>\r\n       My Shop Lot, Shopping Mall,<br>\r\n                                                                                              Post Code, City<br>","footer":"Thank you for your business!\r\n<br>","bsty":"3","display_kb":"0","default_category":"1","default_discount":"0","item_addition":"1","barcode_symbology":"","pro_limit":"10","decimals":"2","thousands_sep":",","decimals_sep":".","focus_add_item":"ALT+F1","add_customer":"ALT+F2","toggle_category_slider":"ALT+F10","cancel_sale":"ALT+F5","suspend_sale":"ALT+F6","print_order":"ALT+F11","print_bill":"ALT+F12","finalize_sale":"ALT+F8","today_sale":"Ctrl+F1","open_hold_bills":"Ctrl+F2","close_register":"ALT+F7","java_applet":"0","receipt_printer":"","pos_printers":"","cash_drawer_codes":"","char_per_line":"42","rounding":"1","pin_code":"abdbeb4d8dbe30df8430a8394b7218ef","purchase_code":null,"envato_username":null,"theme_style":"green","after_sale_page":null,"overselling":"1","multi_store":"1","qty_decimals":"2","symbol":null,"sac":"0","display_symbol":null,"remote_printing":"1","printer":null,"order_printers":null,"auto_print":"0","local_printers":null,"rtl":null,"print_img":null,"selected_language":"english"};
         // $(window).load(function () {
         //     $('.mm_products').addClass('active');
         //     $('#products_index').addClass('active');
         // });
         var lang = new Array();
         lang['code_error'] = 'Code Error';
         lang['r_u_sure'] = '<strong>Are you sure?</strong>';
         lang['register_open_alert'] = 'Register is open, are you sure to sign out?';
         lang['code_error'] = 'Code Error';
         lang['r_u_sure'] = '<strong>Are you sure?</strong>';
         lang['no_match_found'] = 'No match found';
      </script>

      
      <script src="<?php echo url_for('/assets/dist/js/qrcode.min.js'); ?>"></script>

      <script src="<?php echo url_for('assets/dist/js/JsBarcode.all.min.js') ?>"></script>
      <script src="<?php echo url_for('/assets/dist/js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
      <script src="<?php echo url_for('/assets/dist/js/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
      <script src="<?php echo url_for('/assets/dist/daterange/moment.js'); ?>" type="text/javascript"></script>
      <script src="<?php echo url_for('/assets/dist/daterange/daterange.js'); ?>" type="text/javascript"></script>

      <script src="<?php echo url_for('/assets/plugins/bootstrap-datetimepicker/js/moment.min.js') ?>" type="text/javascript"></script>
      <script src="<?php echo url_for('/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>
      <script type="">
        (() => {
          'use strict'

          if (!('indexedDB' in window)) {
            console.warn('IndexedDB not supported')
            return
          }

          //...IndexedDB code
        })()
      </script>
      
      <script type="text/javascript">
          $(function () {
              $('.datetimepicker').datetimepicker({
                  format: 'YYYY-MM-DD HH:mm'
              });
          });
      </script>

      <script type="text/javascript">
        $('#example2').DataTable()
        function qrcode(){
          var unique = $("#h_trans").val();
          
           document.getElementById("qr_code");
          var qrcode = new QRCode(document.getElementById("qr_code"), {
             text: unique,
             width: 100,
             height: 100,
             colorDark : "#000000",
             colorLight : "#ffffff",
             correctLevel : QRCode.CorrectLevel.H
           });

          var qrcode = new QRCode(document.getElementById("staff_code"), {
             text: unique,
             width: 60,
             height: 60,
             colorDark : "#000000",
             colorLight : "#ffffff",
             correctLevel : QRCode.CorrectLevel.H
           });
        }
        // Alert
        function successAlert(msg){
            Swal.fire({
              title: msg,
              type: "success",
              // html: 'Would you like to send an <b>sms or email</b> to the Customer ?',
              showCloseButton: !1,
              // showCancelButton: !0,
              focusConfirm: !1,
              confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
              confirmButtonAriaLabel: "Thumbs up, great!",
              // cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
              // cancelButtonAriaLabel: "Thumbs down",
              confirmButtonClass: "btn btn-primary",
              buttonsStyling: !1,
              // cancelButtonClass: "btn btn-danger ml-1"
            });
        }
        
        function successTime(msg){
          Swal.fire({
            position:"bottom-end",
            type:"success",
            title:msg,
            showConfirmButton:!1,
            timer:1500,
            confirmButtonClass:"btn btn-primary",
            buttonsStyling:!1
          })
        }
        function errorAlert(msg){
            Swal.fire({
              title: msg,
              type: "error",
              // html: 'Would you like to send an <b>sms or email</b> to the Customer ?',
              showCloseButton: !1,
              timer:1500,
              showCancelButton: !1,
              // focusConfirm: !1,
              // confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
              // confirmButtonAriaLabel: "Thumbs up, great!",
              // cancelButtonText: '<i class="la la-thumbs-down"></i> No',
              // cancelButtonAriaLabel: "Thumbs down",
              confirmButtonClass: "btn btn-primary",
              buttonsStyling: !1,
              // cancelButtonClass: "btn btn-danger ml-1"
            });
        }
        function errorTime(msg){
          Swal.fire({
            position:"bottom-end",
            type:"error",
            title:msg,
            showConfirmButton:!1,
            timer:1500,
            confirmButtonClass:"btn btn-primary",
            buttonsStyling:!1
          })
        }

      function errorOption(){
        swal("Low in Stock", {
          buttons: {
            cancel: "No!",
            catch: {
              text: "Would you like to re-stock ?",
              value: "catch",
            },
            Yes: true,
          },
        })
        .then((value) => {
          switch (value) {
         
            case "Yes":
              swal("Pikachu fainted! You gained 500 XP!");
              break;
         
            case "catch":
              swal("Gotcha!", "Pikachu was caught!", "success");
              break;
         
            default:
              swal("Got away safely!");
          }
        });
      }
    </script>
      <script src="<?php echo url_for('/assets/dist/js/libraries.min.js'); ?>" type="text/javascript"></script>
      <script src="<?php echo url_for('/assets/dist/js/scripts.min.js'); ?>" type="text/javascript"></script>
      <!-- <script src="<?php //echo url_for('/assets/dist/js/pos.min.js'); ?>"></script> -->
      <!-- <script src="<?php //echo url_for('/assets/dist/js/spos_ad.min.js'); ?>"></script> -->
      
   </body>
</html>