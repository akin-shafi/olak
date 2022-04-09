<?php require_once('../../private/initialize.php');
$page_title = "Invoices";

require_login();

$invoice_no = $_GET['invoice_no'] ?? '1'; // PHP > 7.0

$company = CompanyDetails::find_by_id("1");
$billing = Billing::find_by_invoice_no($invoice_no);

$invoices = Invoice::find_by_transid($billing->invoiceNum);
$clients = Client::find_by_id($billing->client_id);


?>
<!DOCTYPE html>
<html>

<head>
   <title>Invoice</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link rel="stylesheet" type="text/css" href="<?php echo url_for('css/template.css') ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo url_for('css/generator.min.css') ?>">
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<style type="text/css">
   .d-none {
      display: none;
   }
</style>
<div>
   <div class=" btn-wrp">
      <div class="holder">
         <a href="<?php echo url_for('invoice/all_invoices.php') ?>" class="default-btn">
            << Back</a> <button class="default-btn" id="cmd" style="float: right;"><i class="fa fa-print"></i> Print</button>
      </div>
   </div>
   <div class="separator"></div>
   <div class="separator"></div>
</div>

<body>

   <section class="body" id="content">
      <div class="container">
         <section id="memo">
            <div class="logo">

               <!-- <img data-logo="company_logo" src="../../images/justice.svg"> -->

            </div>
            <div class="company-info  float-right">
               <span class="ibcl_company_name">
                  <!-- <img src="<?php //echo url_for('images/glogo.png') 
                                 ?>" width="25" height="25"> -->
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
            <span id="title" class="ibcl_invoice_title">WAYBILL</span>
            <div class="separator"></div>
            <span id="number" class="ibcl_invoice_number">#<?php echo $billing->invoiceNum ?? '00000'; ?></span>
         </section>
         <div class="clearfix"></div>
         <section id="invoice-info">
            <div>
               <span data-ibcl-id="issue_date_label" class="ibcl_issue_date_label" data-tooltip="tooltip" data-placement="top" title="Enter issue date label">Issue Date: </span>
               <span data-ibcl-id="due_date_label" class="ibcl_due_date_label" data-tooltip="tooltip" data-placement="top" title="Enter invoice due date label">Due Date:</span>
               <!-- <span data-ibcl-id="net_term_label" class="ibcl_net_term_label" data-tooltip="tooltip" data-placement="top" title="Enter net days label">Net:</span> -->
               <span data-ibcl-id="currency_label" class="ibcl_currency_label" data-tooltip="tooltip" data-placement="top" title="Enter invoice currency label">Currency:</span>
               <!-- <span data-ibcl-id="po_number_label" class="ibcl_po_number_label" data-tooltip="tooltip" data-placement="top" title="Enter P.O. label">Contact No. #</span> -->
            </div>
            <div>
               <span data-ibcl-id="issue_date" class="ibcl_issue_date" data-tooltip="tooltip" data-placement="top" title="Select invoice issue date" data-date="11/16/2019"><?php echo $billing->start_date ?? '00/00/00'; ?></span>
               <span data-ibcl-id="due_date" class="ibcl_due_date" data-tooltip="tooltip" data-placement="top" title="Select invoice due date" data-date="12/07/2019"><?php echo $billing->due_date ?? '00/00/00'; ?></span>
               <!-- <span data-ibcl-id="net_term" class="ibcl_net_term" data-tooltip="tooltip" data-placement="top" title="Enter invoice net days">21</span> -->
               <span data-ibcl-id="currency" class="ibcl_currency" data-tooltip="tooltip" data-placement="top" title="Enter invoice currency"><?php echo $billing->currency ?? 'NGN'; ?></span>

               <!-- <span data-ibcl-id="po_number" class="ibcl_po_number" data-tooltip="tooltip" data-placement="top" title="Enter P.O. Number">1/3-147</span> -->
            </div>
         </section>
         <section id="client-info">
            <span data-ibcl-id="bill_to_label" class="ibcl_bill_to_label" data-tooltip="tooltip" data-placement="top" title="Enter bill to label">Being bill of Charges For:</span>
            <div>
               <span class="client-name ibcl_client_name" data-ibcl-id="client_name" data-tooltip="tooltip" data-placement="top" title="Enter client name"><?php $clients->full_name() ?? 'NOT SET'; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_address" class="ibcl_client_address" data-tooltip="tooltip" data-placement="top" title="" data-original-title="Enter client address"><?php echo  $clients->address ?? 'NOT SET'; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_phone_fax" class="ibcl_client_phone_fax" data-tooltip="tooltip" data-placement="top" title="Enter client pnone &amp; fax"><?php echo  $clients->phone ?? 'NOT SET'; ?></span>
            </div>
            <div>
               <span data-ibcl-id="client_email" class="ibcl_client_email" data-tooltip="tooltip" data-placement="top" title="Enter client email"><?php echo $clients->email; ?></span>
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
                     <th class="ibcl_item_price_label">Unit cost</th>
                     <!-- <th class="ibcl_item_discount_label">Discount</th> -->
                     <!-- <th class="ibcl_item_tax_label">Tax(5%)</th> -->
                     <th class="ibcl_item_line_total_label">Subtotal</th>
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

                        <td>
                           <span class="show-mobile ibcl_item_quantity_label">Unit Cost</span>
                           <span class="ibcl_item_quantity"><?php echo number_format($invoice->unit_cost); ?></span>
                        </td>

                        <td>
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
               <span class="hidden ibcl_terms_label">Terms &amp; Notes</span>
               <div class="ibcl_terms">Dear <?php echo $clients->full_name() ?? 'NOT SET'; ?>, We appreciate your patrionage.
               </div>
            </section>


         </div>
         <!-- </div> -->

         <div class="clearfix"></div>


      </div>
      <!-- <div id="editor"></div> -->
   </section>

   <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

   <script src="es6-promise.auto.min.js"></script>
   <script type="text/javascript" src="<?php echo url_for('js/pdfmaker/jspdf.min.js') ?>"></script>
   <script type="text/javascript" src="<?php echo url_for('js/pdfmaker/html2canvas.min.js') ?>"></script>
   <script type="text/javascript" src="<?php echo url_for('js/pdfmaker/html2pdf.js') ?>"></script>



   <script type="text/javascript">
      $('#cmd').click(function() {
         download();
      });

      function download() {
         // Get the element.
         var element = document.getElementById('content');
         // Generate the PDF.

         html2pdf().from(element).set({
            margin: 0,
            filename: '<?php echo  $clients->client_name; ?>-invoice.pdf',
            // image:        { type: 'jpeg', quality: 0.98 },
            html2canvas: {
               scale: 2
            },
            jsPDF: {
               orientation: 'portrait',
               unit: 'in',
               format: 'a4',
               compressPDF: true
            }
            // pagebreak: { mode: 'avoid-all', before: '#part2' }

         }).save();
      }
   </script>

</body>

</html>