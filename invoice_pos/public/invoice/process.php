<?php
require_once('../../private/initialize.php');
require_login();

$invoice_no = $_GET['invoice_no'] ?? '1'; // PHP > 7.0

$company = CompanyDetails::find_by_id("1");
$billing = Billing::find_by_invoice_no($invoice_no);

$invoices = Invoice::find_by_transid($billing->invoiceNum);
$clients = Client::find_by_id($billing->client_id);

?> 
<?php $page = 'Invoice';
$page_title = 'Billing & Receipts'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<div class="content-wrapper">
  
  <div class="justify-content-center">
    <div>
      <p>Choose an option below</p>
      <div class="btn btn-primary"></div>
      <div class="btn btn-primary">Print Reciept</div>
    </div>
  </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>