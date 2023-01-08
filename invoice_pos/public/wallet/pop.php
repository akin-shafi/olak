<?php require_once('../../private/initialize.php');
$page_title = "Proof of Payment";

require_login();

$payment_id = $_GET['payment_id'] ?? '1'; // PHP > 7.0


$company = CompanyDetails::find_by_id("1");
$wallet = Wallet::find_by_payment_id($payment_id);

$walletFundingMethod = WalletFundingMethod::find_by_payment_id($payment_id);
$clients = Client::find_by_customer_id($wallet->customer_id);

// pre_r($wallet);


?>
<!DOCTYPE html>
<html>

<head>
   <title>Proof of Payment</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link rel="stylesheet" type="text/css" href="<?php echo url_for('css/template.css') ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo url_for('css/generator.min.css') ?>">
   <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<div>
   <div class=" btn-wrp">
      <div class="holder">
         <a href="<?php echo url_for('wallet/') ?>" class="default-btn">
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
                  <!-- <img src="<?php //echo url_for('images/glogo.png') ?>" width="25" height="25"> -->
                  <?php echo $company->company_name; ?></span>
               <div class="separator less"></div>
               <span class="ibcl_company_address"><?php echo $company->address; ?></span>
               <!-- <span class="ibcl_company_city_zip_state">30000 Bedrock, Cobblestone County</span> -->
               <br>
               <span class="ibcl_company_email_web"><?php echo $company->web_address; ?> | <?php echo $company->email; ?></span><br>
               <span class="ibcl_company_phone_fax"><?php echo $company->phone_no; ?> | <?php echo $company->mobile_no; ?></span>
            </div>
         </section>
         <section id="invoice-title-number">
            <span id="title" class="ibcl_invoice_title">POP</span>
            <div class="separator"></div>
            <span id="number" class="ibcl_invoice_number">#<?php echo $payment_id ?? '00000'; ?></span>
         </section>
         <div class="clearfix"></div>
         <section id="invoice-info">
            <div>
               <span data-ibcl-id="issue_date_label" class="ibcl_issue_date_label" data-tooltip="tooltip" data-placement="top" title="Enter issue date label"> Date: </span>
               <!-- <span data-ibcl-id="net_term_label" class="ibcl_net_term_label" data-tooltip="tooltip" data-placement="top" title="Enter net days label">Net:</span> -->
               <span data-ibcl-id="currency_label" class="ibcl_currency_label" data-tooltip="tooltip" data-placement="top" title="Enter invoice currency label">Currency:</span>
               <!-- <span data-ibcl-id="po_number_label" class="ibcl_po_number_label" data-tooltip="tooltip" data-placement="top" title="Enter P.O. label">Contact No. #</span> -->
            </div>
            <div>
               <span data-ibcl-id="issue_date" class="ibcl_issue_date" data-tooltip="tooltip" data-placement="top" title="Select invoice issue date" data-date="11/16/2019"><?php echo $wallet->created_at ?? '00/00/00'; ?></span>
               <!-- <span data-ibcl-id="net_term" class="ibcl_net_term" data-tooltip="tooltip" data-placement="top" title="Enter invoice net days">21</span> -->
               <span data-ibcl-id="currency" class="ibcl_currency" data-tooltip="tooltip" data-placement="top" title="Enter invoice currency">NGN<?php //echo $wallet->currency ?? 'NGN'; ?></span>

               <!-- <span data-ibcl-id="po_number" class="ibcl_po_number" data-tooltip="tooltip" data-placement="top" title="Enter P.O. Number">1/3-147</span> -->
            </div>
         </section>
         <section id="client-info">
            <span data-ibcl-id="bill_to_label" class="ibcl_bill_to_label" data-tooltip="tooltip" data-placement="top" title="Enter bill to label">Proof of Payment For:</span>
            <div>
               <span class="client-name ibcl_client_name" data-ibcl-id="client_name" data-tooltip="tooltip" data-placement="top" title="Enter client name"><?php echo  $clients->full_name() ?? 'NOT SET'; ?></span>
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
                     <th class="ibcl_item_description_label">Payment Method</th>
                     <th class="ibcl_item_line_total_label">Amount</th>
                     <th class="bank">Bank Name</th>
                     <th class="bank">Bank Account</th>
                  </tr>
                  <?php $sn = 1; foreach ($walletFundingMethod as $value) { 
                    ?>
                     <tr data-iterate="item">
                        <td class="ibcl_item_row_number" style="position: relative;">
                            <?php echo $sn++; ?>
                        </td>
                        <!-- Don't remove this column as it's needed for the row commands -->
                        <td>
                           <span class="show-mobile ibcl_item_description_label">Payment Method</span>
                           <span class="ibcl_item_description"><?php echo walletFundingMethod::PAYMENT_METHOD[$value->payment_method]; ?></span>
                        </td>

                        <td>
                           <span class="show-mobile ibcl_item_line_total_label">Amount</span>
                           <span class="ibcl_item_line_total"><?php echo $value->amount; ?></span>
                        </td>


                        <td><?php echo Bank::find_by_id($value->bank_name)->bank_name ?? "Not Set"; ?></td>
		                <td><?php echo Bank::find_by_id($value->bank_name)->account_number ?? "Not Set"; ?></td>
                     </tr>
                  <?php } ?>

               </tbody>
            </table>
         </section>

         <!-- <div class="acctDetails border"> -->
         <div class="payment-info " id="part2" style="position: absolute; left: 50; margin-top: 20px">

           
            <div class="ibcl_payment_info5"></div>
            <section id="terms">
               <span class="hidden ibcl_terms_label">Terms &amp; Notes</span>
               <div class="ibcl_terms">Dear <?php echo $clients->full_name() ?? 'NOT SET'; ?>, We appreciate your patrionage.</div>
            </section>
             <div>
            <h3 class="h3">Narration:</h3>
            <div>
               <?php echo $wallet->narration ?? "Not Set" ?>

            </div>
         </div>
         </div>
         <!-- </div> -->
        

         <section class="d-none" id="sums">
            <table cellspacing="0" cellpadding="0">
               <tbody>
                  <tr>
                     <th data-ibcl-id="amount_subtotal_label" class="ibcl_amount_subtotal_label" data-tooltip="tooltip" data-placement="top" title="Enter subtotal label">Deposit:</th>
                     <td data-ibcl-id="amount_subtotal" class="ibcl_amount_subtotal" data-tooltip="tooltip" data-placement="top" title="" data-currency="NGN "> NGN <?php echo $wallet->deposit ?? 'NOT SET'; ?></td>
                  </tr>
                 
          
                  <tr data-hide-on-quote="true">
                     <th data-ibcl-id="amount_paid_label" class="ibcl_amount_paid_label" data-tooltip="tooltip" data-placement="top" title="Enter amount paid label">Wallet Balance:</th>
                     <td data-ibcl-id="amount_paid" class="ibcl_amount_paid add_currency_left" data-tooltip="tooltip" data-placement="top" title="Enter amount paid" data-currency="NGN "><?php echo $wallet->balance ?: '0.00'; ?></td>
                  </tr>
                 
               </tbody>
            </table>
         </section>
         <div class="clearfix"></div>


      </div>
      <!-- <div id="editor"></div> -->
   </section>

   <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

   

 
   <script type="text/javascript">
      $('#cmd').click(function() {
         window.print() 
      });

   </script>

</body>

</html>