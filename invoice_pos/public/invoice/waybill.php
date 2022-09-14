<?php require_once('../../private/initialize.php');
$page_title = "Invoices";

require_login();

$invoice_no = $_GET['invoice_no'] ?? '1'; // PHP > 7.0

$company = CompanyDetails::find_by_id("1");

$billing = Billing::find_by_invoice_no($invoice_no);

if ($_POST['p'] == 1) {
   $rand = rand(0, 100);
   $unique = uniqid();
   if(empty($billing->waybill_no)) {
      $args = [
         "status" => 2,
         "waybill_no" => $rand."-".$unique,
      ];
      $billing->merge_attributes($args);
      $result = $billing->save();
      if ($result == true) {
      $all_invoice = Invoice::find_by_invoiceNum($invoice_no);
     
         foreach ($all_invoice as $value) {
            $inv = Invoice::find_by_id($value->id);
            $data = [
               'status' => 1,
            ];
            $inv->merge_attributes($data);
         $result_data = $inv->save();
       }

         exit(json_encode(['success' => true, 'msg' => 'Waybill processed successfully']));
      }
   }
}




$invoices = Invoice::find_by_transid($billing->invoiceNum);
$clients = Client::find_by_id($billing->client_id);

$today = date('Y-m-d');
$due_date =  date('Y-m-d',strtotime('+'.$billing->due_date.' days',strtotime($today)));


?>
<!DOCTYPE html>
<html>

<head>
   <title>Waybill</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link rel="stylesheet" type="text/css" href="<?php echo url_for('css/template.css') ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo url_for('css/generator.min.css') ?>">
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

     <script src="<?php echo url_for('js/jquery.min.js') ?>"></script>
      <script src="<?php echo url_for('js/jquery_qrcode.min.js') ?>"></script>
</head>
<style type="text/css">
   .d-none {
      display: none;
   }
</style>
<div>
   <div class=" btn-wrp d-none">
      <div class="holder">
         <a href="<?php echo url_for('invoice/all_invoices.php') ?>" class="default-btn">
            << Back</a> 
            <button class="default-btn" id="cmd" style="" ><i class="fa fa-download"></i> Download Reciept</button>
            <!-- <button class="default-btn" id="save" style="" ><i class="fa fa-download"></i> Save Reciept</button> -->

            <button class="default-btn" id="print" style="float: right;" i><i class="fa fa-print"></i> Print Reciept</button>
            <button class="default-btn" id="printBoth" style="float: right;" i><i class="fa fa-print"></i> Print Reciept & WayBill</button>
            
      </div>
   </div>
   <div class="separator"></div>
   <div class="separator"></div>
</div>
<style type="text/css">
   .bodyt {
    font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,Sans-serif;
    background: white;
    width: 100%;
    max-width: 920px;
    /* min-height: 1158px; */
    min-height: 900px;
    margin: 20px auto 30px auto;
    /*-moz-box-shadow: 0px 0px 20px rgba(80,80,80,0.7);
    -webkit-box-shadow: 0px 0px 20px rgb(80 80 80 / 70%);
    box-shadow: 0px 0px 20px rgb(80 80 80 / 70%);*/
}
</style>
<body>

    <section class="body" id="content">
      <?php //pre_r($billing); ?>
      <div class="container">
         <section id="memo">
            <div class="logo">

               <!-- <img data-logo="company_logo" src="../../images/justice.svg"> -->

            </div>
            <div class="company-info  float-right">
               <span class="ibcl_company_name">
                  <?php echo $company->company_name; ?>
               </span>
               <div class="separator less"></div>
               <span class="ibcl_company_address"><?php echo $company->address; ?></span>
               <!-- <span class="ibcl_company_city_zip_state">30000 Bedrock, Cobblestone County</span> -->
               <br>
               <span class="ibcl_company_email_web"><?php echo $company->web_address; ?> | <?php echo $company->email; ?></span><br>
               <span class="ibcl_company_phone_fax"><?php echo $company->phone_no; ?> | <?php echo $company->mobile_no; ?></span>
            </div>
         </section>
         <section id="invoice-title-number">
            <span id="title" class="ibcl_invoice_title" style="text-transform: uppercase;">WayBill</span>
            <div class="separator"></div>
            <span id="number" class="ibcl_invoice_number">#<?php echo $billing->invoiceNum ?? '00000'; ?></span>
         </section>
         <div class="clearfix"></div>
         <section id="invoice-info">
            <div>
               <span data-ibcl-id="issue_date_label" class="ibcl_issue_date_label" data-tooltip="tooltip" data-placement="top" title="Enter issue date label">Processed By: </span>
               <span data-ibcl-id="issue_date_label" class="ibcl_issue_date_label" data-tooltip="tooltip" data-placement="top" title="Enter issue date label">Issue Date: </span>
               <span data-ibcl-id="due_date_label" class="ibcl_due_date_label" data-tooltip="tooltip" data-placement="top" title="Enter invoice due date label">Due Date:</span>
               <span data-ibcl-id="currency_label" class="ibcl_currency_label" data-tooltip="tooltip" data-placement="top" title="Enter invoice currency label">Currency:</span>
               <span data-ibcl-id="po_number_label" class="ibcl_po_number_label" data-tooltip="tooltip" data-placement="top" title="Enter P.O. label">Print Date</span>
            </div>
            <div>
               <span data-ibcl-id="issue_date" class="ibcl_issue_date" data-tooltip="tooltip" data-placement="top" title="Select invoice issue date" data-date="11/16/2019"><?php echo Admin::find_by_id($billing->created_by)->full_name() ?? 'Not Set'; ?></span>

               <span data-ibcl-id="issue_date" class="ibcl_issue_date" data-tooltip="tooltip" data-placement="top" title="Select invoice issue date" data-date="11/16/2019"><?php echo $billing->created_date ?? '00/00/00'; ?></span>
               <span data-ibcl-id="due_date" class="ibcl_due_date" data-tooltip="tooltip" data-placement="top" title="Select invoice due date" data-date="12/07/2019"><?php echo $due_date ?? '00/00/00'; ?></span>
               <!-- <span data-ibcl-id="net_term" class="ibcl_net_term" data-tooltip="tooltip" data-placement="top" title="Enter invoice net days">21</span> -->
               <span data-ibcl-id="currency" class="ibcl_currency" data-tooltip="tooltip" data-placement="top" title="Enter invoice currency"><?php echo $billing->currency ?? 'NGN'; ?></span>

               <span  title=""><?php echo date('Y-m-d') ?></span>
            </div>
         </section>
         <section id="client-info">
            <span data-ibcl-id="bill_to_label" class="ibcl_bill_to_label" data-tooltip="tooltip" data-placement="top" title="Enter bill to label">Being bill of Charges For:</span>
            <div>
              <span class="client-name ibcl_client_name" data-ibcl-id="client_name" data-tooltip="tooltip" data-placement="top" title="Enter client name"> <strong>Name: </strong>  <?php
               echo $clients->first_name . ' '. $clients->last_name ?? 'NOT SET'; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_address" class="ibcl_client_address" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Enter client address"><strong>Address:</strong> <?php echo  $clients->address ?? 'NOT SET'; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_phone_fax" class="ibcl_client_phone_fax" data-tooltip="tooltip" data-placement="top" title="Enter client pnone &amp; fax"><strong>Phone:</strong> <?php echo  $clients->phone ?? 'NOT SET'; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_email" class="ibcl_client_email" data-tooltip="tooltip" data-placement="top" title="Enter client email"><strong>Email:</strong> <?php echo $clients->email; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_other" class="ibcl_client_other" data-tooltip="tooltip" data-placement="top" title="Enter other client info">Attn: Find details attached below</span>
            </div>
         </section>
         <div class="clearfix"></div>

         <section id="items">
            <table cellspacing="0" cellpadding="0">
               <tbody>
                  <tr>
                     <th class="ibcl_item_row_number_label"></th>
                     <!-- Dummy cell for the row number and row commands -->
                     <th class="ibcl_item_description_label">Item/Service</th>
                     <th class="ibcl_item_quantity_label">Quantity</th>
                     <!-- <th class="ibcl_item_price_label">Unit cost</th> -->
                     <!-- <th class="ibcl_item_discount_label">Discount</th> -->
                     <!-- <th class="ibcl_item_tax_label">Tax(5%)</th> -->
                     <!--<th class="ibcl_item_line_total_label">Subtotal</th>-->
                  </tr>
                  <?php foreach ($invoices as $invoice) { ?>
                     <tr data-iterate="item">
                        <td class="ibcl_item_row_number" style="position: relative;">

                        </td>
                        <!-- Don't remove this column as it's needed for the row commands -->
                        <td>
                           <span class="show-mobile ibcl_item_description_label">Service Type</span>
                           <span class="ibcl_item_description"><?php echo Product::find_by_id($invoice->service_type)->pname; ?></span>
                        </td>

                        <td>
                           <span class="show-mobile ibcl_item_quantity_label">Quantity</span>
                           <span class="ibcl_item_quantity"><?php echo $invoice->quantity; ?></span>
                        </td>

                        <!-- <td>
                           <span class="show-mobile ibcl_item_quantity_label">Unit Cost</span>
                           <span class="ibcl_item_quantity"><?php //echo number_format($invoice->unit_cost); ?></span>
                        </td> -->

                        <!--<td>-->
                        <!--   <span class="show-mobile ibcl_item_quantity_label">Subtotal</span>-->
                        <!--   <span class="ibcl_item_quantity"><?php //echo number_format($invoice->amount); ?></span>-->
                        <!--</td>-->
                     </tr>
                  <?php } ?>

               </tbody>
            </table>
         </section>

         <!-- <div class="acctDetails border"> -->

         <div class="payment-info" id="part2" style="position: absolute; left: 50; margin-top: 20px">
            <div class="d-none" style="display: none;">
               <div class="ibcl_payment_info1">Account details:</div><br>
               <p class="ibcl_payment_info2">Bank Name: <?php echo $company->bank_name; ?> </p>
               <div class="ibcl_payment_info3">ACCT Name: <?php echo $company->acct_name; ?> |</div>
               <div class="ibcl_payment_info4">ACCT No: <?php echo $company->acct_no ?></div>
            </div>

            <div class="ibcl_payment_info5"></div>
            <section id="terms">
               <span class="hidden ibcl_terms_label">Terms Notes</span>
               <div class="ibcl_terms">Dear <?php echo $clients->full_name() ?? 'NOT SET'; ?>, We appreciate your patrionage.
               </div>


            </section>

            <div>
               <h3>Terms  Notes:</h3>
               <p>This is an evidence of release of the above Goods item to <?php
               echo $clients->first_name . ' '. $clients->last_name ?? 'NOT SET'; ?> or his/her representative on this day <?php echo date("Y-m-d"); ?> by <?php echo Admin::find_by_id($billing->created_by)->full_name() ?? 'Not Set'; ?>.
               
               </p>
            </div>


         </div>
         <!-- </div> -->

         <section id="sums" class="d-none">
            <table cellspacing="0" cellpadding="0">
               <tbody>
                  <tr>
                     <th data-ibcl-id="amount_subtotal_label" class="ibcl_amount_subtotal_label" data-tooltip="tooltip" data-placement="top" title="Enter subtotal label">Subtotal:</th>
                     <td data-ibcl-id="amount_subtotal" class="ibcl_amount_subtotal" data-tooltip="tooltip" data-placement="top" title=""><?php echo $billing->currency ?? 'NOT SET'; ?> <?php echo $billing->total_amount ?? 'NOT SET'; ?></td>
                  </tr>
                  <tr>
                     <th data-ibcl-id="amount_subtotal_label" class="ibcl_amount_subtotal_label" data-tooltip="tooltip" data-placement="top" title="Enter subtotal label">Tax(5%):</th>
                     <td data-ibcl-id="amount_subtotal" class="ibcl_amount_subtotal" data-tooltip="tooltip" data-placement="top" title=""><?php echo $billing->currency ?? 'NOT SET'; ?>
                        <?php echo $billing->tax ? $billing->tax : '0.00'; ?></td>
                  </tr>
                  <tr data-iterate="tax" style="display: none;">
                     <th data-ibcl-id="tax_name" class="ibcl_tax_name" data-tooltip="tooltip" data-placement="top" title="Enter tax label">Tax:</th>
                     <td data-ibcl-id="tax_value" class="ibcl_tax_value" data-tooltip="tooltip" data-placement="top" title=""></td>
                  </tr>
                  <tr class="amount-total">
                     <th data-ibcl-id="amount_total_label" class="ibcl_amount_total_label" data-tooltip="tooltip" data-placement="top" title="Enter total label">Total:</th>
                     <td data-ibcl-id="amount_total" class="ibcl_amount_total" data-tooltip="tooltip" data-placement="top" title=""><?php echo $billing->currency; ?> <?php echo $billing->grand_total ?: '0.00'; ?></td>
                  </tr>
                  <!-- You can use attribute data-hide-on-quote="true" to hide specific information on quotes.
                     For example Invoicebus doesn't need amount paid and amount due on quotes  -->
                  <tr data-hide-on-quote="true">
                     <th data-ibcl-id="amount_paid_label" class="ibcl_amount_paid_label" data-tooltip="tooltip" data-placement="top" title="Enter amount paid label">Paid:</th>
                     <td data-ibcl-id="amount_paid" class="ibcl_amount_paid add_currency_left" data-tooltip="tooltip" data-placement="top" title="Enter amount paid" data-currency="<?php echo $billing->currency; ?> "><?php echo $billing->part_payment ?: '0.00'; ?></td>
                  </tr>
                  <tr data-hide-on-quote="true">
                     <th data-ibcl-id="amount_due_label" class="ibcl_amount_due_label" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Enter amount due label">Balance:</th>
                     <td data-ibcl-id="amount_due" class="ibcl_amount_due" data-tooltip="tooltip" data-placement="top" title=""><?php echo $billing->currency; ?> <?php echo $billing->balance ?: '0.00'; ?></td>
                  </tr>
               </tbody>
            </table>
         </section>
         <div class="clearfix"></div>



      </div>
      <!-- <div id="editor"></div> -->
   </section>
   <section class="bodyt" id="content" style="">
      <?php //pre_r($billing); ?>
      <div class="container">
         <section id="memo">
            <div class="logo">

               <!-- <img data-logo="company_logo" src="../../images/justice.svg"> -->

            </div>
            <div class="company-info  float-right">
               <span class="ibcl_company_name">
                  <?php echo $company->company_name; ?>
               </span>
               <div class="separator less"></div>
               <span class="ibcl_company_address"><?php echo $company->address; ?></span>
               <!-- <span class="ibcl_company_city_zip_state">30000 Bedrock, Cobblestone County</span> -->
               <br>
               <span class="ibcl_company_email_web"><?php echo $company->web_address; ?> | <?php echo $company->email; ?></span><br>
               <span class="ibcl_company_phone_fax"><?php echo $company->phone_no; ?> | <?php echo $company->mobile_no; ?></span>
            </div>
         </section>
         <section id="invoice-title-number">
            <span id="title" class="ibcl_invoice_title" style="text-transform: uppercase; color: red;">Waybill</span>
            <div class="separator"></div>
            <span id="number" class="ibcl_invoice_number">#<?php echo $billing->waybill_no ?? '00000'; ?></span>
            <div>Being Reciept of: <?php echo $billing->invoiceNum ?? '00000'; ?> </div>
            <div id="qrcode"></div>
         </section>
         <div class="clearfix"></div>
         <section id="invoice-info">
            <div>
               <span data-ibcl-id="issue_date_label" class="ibcl_issue_date_label" data-tooltip="tooltip" data-placement="top" title="Enter issue date label">Processed By: </span>
               <span data-ibcl-id="issue_date_label" class="ibcl_issue_date_label" data-tooltip="tooltip" data-placement="top" title="Enter issue date label">Issue Date: </span>
              
            </div>
            <div>
               <span data-ibcl-id="issue_date" class="ibcl_issue_date" data-tooltip="tooltip" data-placement="top" title="Select invoice issue date" data-date="11/16/2019"><?php echo Admin::find_by_id($billing->created_by)->full_name() ?? 'Not Set'; ?></span>
               <span data-ibcl-id="issue_date" class="ibcl_issue_date" data-tooltip="tooltip" data-placement="top" title="Select invoice issue date" data-date="11/16/2019"><?php echo $billing->created_date ?? '00/00/00'; ?></span>
              
            </div>
         </section>
         <section id="client-info">
            <span data-ibcl-id="bill_to_label" class="ibcl_bill_to_label" data-tooltip="tooltip" data-placement="top" title="Enter bill to label">Being bill of Charges For:</span>
            <div>
              <span class="client-name ibcl_client_name" data-ibcl-id="client_name" data-tooltip="tooltip" data-placement="top" title="Enter client name"> <strong>Name: </strong>  <?php
               echo $clients->first_name . ' '. $clients->last_name ?? 'NOT SET'; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_address" class="ibcl_client_address" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Enter client address"><strong>Address:</strong> <?php echo  $clients->address ?? 'NOT SET'; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_phone_fax" class="ibcl_client_phone_fax" data-tooltip="tooltip" data-placement="top" title="Enter client pnone &amp; fax"><strong>Phone:</strong> <?php echo  $clients->phone ?? 'NOT SET'; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_email" class="ibcl_client_email" data-tooltip="tooltip" data-placement="top" title="Enter client email"><strong>Email:</strong> <?php echo $clients->email; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_other" class="ibcl_client_other" data-tooltip="tooltip" data-placement="top" title="Enter other client info">Attn: Find details attached below</span>
            </div>
         </section>
         <div class="clearfix"></div>

         <section id="items">
            <table cellspacing="0" cellpadding="0">
               <tbody>
                  <tr>
                     <th class="ibcl_item_row_number_label"></th>
                     <!-- Dummy cell for the row number and row commands -->
                     <th class="ibcl_item_description_label">Item/Service</th>
                     <th class="ibcl_item_quantity_label">Quantity</th>
                     <!-- <th class="ibcl_item_price_label">Unit cost</th> -->
                     <!-- <th class="ibcl_item_discount_label">Discount</th> -->
                     <!-- <th class="ibcl_item_tax_label">Tax(5%)</th> -->
                     <!-- <th class="ibcl_item_line_total_label">Subtotal</th> -->
                  </tr>
                  <?php foreach ($invoices as $invoice) { ?>
                     <tr data-iterate="item">
                        <td class="ibcl_item_row_number" style="position: relative;">

                        </td>
                        <!-- Don't remove this column as it's needed for the row commands -->
                        <td>
                           <span class="show-mobile ibcl_item_description_label">Service Type</span>
                           <span class="ibcl_item_description"><?php echo Product::find_by_id($invoice->service_type)->pname; ?></span>
                        </td>

                        <td>
                           <span class="show-mobile ibcl_item_quantity_label">Quantity</span>
                           <span class="ibcl_item_quantity"><?php echo $invoice->quantity; ?></span>
                        </td>

                        <td class="d-none">
                           <span class="show-mobile ibcl_item_quantity_label">Unit Cost</span>
                           <span class="ibcl_item_quantity"><?php echo number_format($invoice->unit_cost); ?></span>
                        </td>

                        <td class="d-none">
                           <span class="show-mobile ibcl_item_quantity_label">Subtotal</span>
                           <span class="ibcl_item_quantity"><?php echo number_format($invoice->amount); ?></span>
                        </td>
                     </tr>
                  <?php } ?>

               </tbody>
            </table>
         </section>

         <!-- <div class="acctDetails border"> -->

         <div class="payment-info" id="part2" style="position: absolute; left: 50; margin-top: 20px">
            <div class="d-none" style="display: none;">
               <div class="ibcl_payment_info1">Account details:</div><br>
               <p class="ibcl_payment_info2">Bank Name: <?php echo $company->bank_name; ?> </p>
               <div class="ibcl_payment_info3">ACCT Name: <?php echo $company->acct_name; ?> |</div>
               <div class="ibcl_payment_info4">ACCT No: <?php echo $company->acct_no ?></div>
            </div>

            <div class="ibcl_payment_info5"></div>
            <section id="terms">
               <span class="hidden ibcl_terms_label">Terms Notes</span>
               <div class="ibcl_terms">Dear <?php echo $clients->full_name() ?? 'NOT SET'; ?>, We appreciate your patrionage.
               </div>


            </section>

            


         </div>
         <!-- </div> -->

         
         <div class="clearfix"></div>



      </div>
      <!-- <div id="editor"></div> -->
   </section>

   


   <input type="hidden" id="url" value="<?php echo  $clients->first_name . ' '. $clients->last_name ?? 'NOT SET'; ?>">
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

   <script src="es6-promise.auto.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
   

   <input type="hidden" id="cert_id" value="<?php echo $billing->invoiceNum ?? '00000'; ?>">
   <script type="text/javascript">
      // var cert_id = $('#cert_id').val();
      //  $('#qrcode').qrcode(
      //  {
      //      text: "https://gettonote.com/app/public/classroom/certificate.php?cert=" + cert_id,
      //      size: 80,
      //      // text: "https://gettonote.com#solutions"
      //  });
      $(document).ready(function() {
            setTimeout(function(){
                window.print(); 
            }, 1000);//wait 1 seconds
            
            setTimeout(function(){
                window.close();
            }, 1000);//wait 1 seconds
         });
   </script>
   
   
</body>

</html>