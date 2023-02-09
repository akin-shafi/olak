<?php require_once('../../private/initialize.php');
$page_title = "Invoices";

require_login();

$invoice_no = $_GET['invoice_no'] ?? '1'; // PHP > 7.0

$company = CompanyDetails::find_by_id("1");
$billing = Billing::find_by_invoice_no($invoice_no);

$invoices = Invoice::find_by_transid($billing->invoiceNum);
$clients = Client::find_by_id($billing->client_id);

$pop = Wallet::find_by_customer_id($clients->customer_id);
$last_deposit = array_values(array_slice($pop, -1))[0]; 
$last_deposit_details = WalletFundingMethod::find_by_payment_id($last_deposit->payment_id);

$today = date('Y-m-d');
$due_date =  date('Y-m-d',strtotime('+'.$billing->due_date.' days',strtotime($today)));


?>
<!DOCTYPE html>
<html>

<head>
   <title>Invoice</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link rel="stylesheet" type="text/css" href="<?php echo url_for('css/template.css') ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo url_for('css/generator.min.css') ?>">
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
   <!-- bootstrap css 5.* -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<style type="text/css">
   .d-none {
      display: none;
   }
   .modal-dialog{
      max-height: 300px !important ;
   }
</style>
<div>
   <div class=" btn-wrp">
      <div class="holder">
         <a href="<?php echo url_for('invoice/all_invoices.php') ?>" class="default-btn">
            << Back</a> 
            <!-- <button class="default-btn" id="cmd" style="" ><i class="fa fa-download"></i> Download Reciept</button> -->
            <!-- <button class="default-btn" id="save" style="" ><i class="fa fa-download"></i> Save Reciept</button> -->

            <div class="default-btn" id="printBoth" style="float: ;" >Process Waybill</div>
            <a class="default-btn" id="printBoth" href="<?php echo url_for('invoice/rebate.php?invoice_no='. $invoice_no) ?>" style="float: ;" >Check Rebate</a>
            <button class="default-btn" id="print" style="float: right;" i><i class="fa fa-print"></i> Print Reciept</button> 
      </div>
   </div>
   <div class="separator"></div>
   <div class="separator"></div>
</div>

   <section class="body" id="content">
      <?php //pre_r($billing); ?>
      <div class="container-fluid">
         <section id="memo">
            <div class="logo">
            <section id="invoice-title-number">
               <span id="title" class="ibcl_invoice_title" style="text-transform: uppercase;">Receipt</span>
               <div class="separator"></div>
               <span id="number" class="ibcl_invoice_number">#<?php echo $billing->invoiceNum ?? '00000'; ?></span>
               
               <div>
                  <h5 id="" class="ibcl_invoice_title" style="text-transform: uppercase;">Customer No: <b style="border-bottom: 1px solid #000;"><?php echo Client::find_by_id($billing->client_id)->customer_id; ?></b></h5>
               </div>
               
            </section>
            
               <!-- <img data-logo="company_logo" src="../../images/justice.svg"> -->
               <?php if ($billing->backlog == 1) : ?>
                  <div style="width: 100px; height: 100px; background: #000;"></div>
               <?php endif ?>

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
            <span data-ibcl-id="bill_to_label" class="ibcl_bill_to_label" data-tooltip="tooltip" data-placement="top" title="Enter bill to label">Issued To:</span>
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

         <section id="items" style="margin-top:-10px ;">
            <table cellspacing="0" cellpadding="0" style="font-size: 12px;">
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
       
            <section class="mb-2" style="margin-top: 10px;">
                Dear <b><?php echo $clients->full_name() ?? 'NOT SET'; ?></b><br>
                <div>Please afix your signature below.</div>
            </section>

            <div style="margin-top: -10px;">
               <h3>Sales & Purchase Agreement </h3>
               <p>
                  <b><u>Price Validity</u></b><br>
                  1. Prices on this receipt is valid for <?php echo $billing->due_date ?>days Only.
                     <b><?php //echo date('D jS F, Y', strtotime($due_date)) ?></b> <br>
                  <b><u>Unpicked Goods</u></b><br>
                  1. All Goods paid for must be picked-up within 90days after payment.<br>
                  2. After 90days customer will be liable to pay a warehousing service charge.<br>
                  <b><u>Return Policy</u></b><br>
                  1. After sales retun/refunds can only be considered within 7days of purchase. <br>
                  2. All returned goods shall be valued on the 
                        management scale as second-grade goods at 10% discount of the sales price, and duction of VAT<br>
                  3. Customer should note that the refund process may take up to 3 working days.<br>
               </p>
               <p>Thanks for your patrionage. </p>
            </div>

            
            
            

         </div>
         <!-- </div> -->

         <section id="sums">
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
                  <tr>
                     <td colspan="2">
                        <div>
                           <tr>
                              <td>Signature:</td>
                              <td>_______________________</td>
                           </tr>
                           <tr>
                              <td>Date:</td>
                              <td>_______________________</td>
                           </tr>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>

         </section>
         <div class="clearfix"></div>

    <h5 class="mt-5">Last Payment Record</h5>
    <div class="table-responsive ">
      <table class="table table-bordered " style="font-size: 12px;" id="rowSelection">
        <thead>
          <tr>
            <th>S/N</th>
            <!-- <th>Payment ID</th> -->
            <th>Payment Method</th>
            <th>Amount</th>
            <!-- <th>Status</th> -->
            <th>Post By</th>
            <th>Bank Name</th>
            <th>Account No.</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sn = 1;
          foreach ($last_deposit_details as $value) {
            $bankName = Bank::find_by_id($value->bank_name)->bank_name ?? "Not Set";
            $account_no = Bank::find_by_id($value->bank_name)->account_number ?? "Not Set";
            $createdBy = Admin::find_by_id($value->created_by)->full_name();
          ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <!-- <td><a href="<?php //echo url_for('wallet/pop.php?payment_id=' . h(u($value->payment_id))); ?>"><?php echo h(ucwords($value->payment_id)); ?></a></td> -->
              <td><?php echo Billing::PAYMENT_METHOD[$value->payment_method]; ?></td>
              <td><?php echo number_format(floatval($value->amount)); ?></td>
              <!-- <td><?php  //echo $value->approval == 0 ? "Unapproved" : "Approved"; ?></td> -->
              <td><?php echo $createdBy; ?></td>
              <td><?php echo ucwords($bankName); ?></td>
              <td><?php echo $account_no; ?></td>
              <td><?php echo date('dS M, Y H:i:s', strtotime($value->created_at)); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>



      </div>
      <!-- <div id="editor"></div> -->
   </section>

   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Please confirm</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <div class="text-center">Are you sure you want to Print waybill ?</div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <a href="<?php echo url_for('/invoice/waybill.php?invoice_no='. $invoice_no."&p=1") ?>" class="btn btn-success">Yes</a>
         </div>
       </div>
     </div>
   </div>


   <input type="hidden" id="url" value="<?php echo  $clients->first_name . ' '. $clients->last_name ?? 'NOT SET'; ?>">
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

   <!-- <script src="es6-promise.auto.min.js"></script> -->
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> -->
   <script src="https://cdn.jsdelivr.net/npm/jspdf@latest/dist/jspdf.min.js"></script>


   <!-- js -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>



   
   <script type="text/javascript">
      $('#print').click(function() {
         window.print() 
         // downloadDivAsPDF()
      })
      $('#cmd').click(function() {
         // download();
      });
      
      function downloadDivAsPDF() {
         var div = document.getElementById('#print');
         var pdf = new jsPDF('p', 'pt', 'letter');
         var options = {
            background: 'white',
            pagesplit: true
         };
         pdf.addHTML(div, 0, 0, options, function() {
            pdf.save('div_as_pdf.pdf');
         });
      }
      $("#printBoth").click(function(){
         $("#exampleModal").modal("show")
      });
      // $(document).on('click', '#save', function() {
      //    save()
      // });

      // function save() {
      //       var url = $('#url').val();

      //       var element = document.getElementById('content');
      //       var opt = {
      //         image:        { type: 'jpeg', quality: 0.98 },
      //         html2canvas:  { scale: 3 },
      //         jsPDF:        { unit: 'cm', format: 'letter', orientation: 'landscape' }
      //       };

      //       html2pdf().from(element).set(opt).toPdf().output('datauristring').then(function (pdfAsString) {
      //           // The PDF has been converted to a Data URI string and passed to this function.
      //           // Use pdfAsString however you like (send as email, etc)!

      //       var arr = pdfAsString.split(',');
      //       pdfAsString= arr[1];    

      //               // var data = new FormData();
      //               // data.append("data" , pdfAsString);
      //               // var xhr = new XMLHttpRequest();
      //               // xhr.open( 'post', 'upload.php', true ); //Post the Data URI to php Script to save to server
      //               // xhr.send(data);

      //               // })

      //       e.preventDefault();  //stop the browser from following
      //           window.location.href = 'inc/'+url+'-invoice.pdf';
      // })
   // }
   </script>

</body>

</html>