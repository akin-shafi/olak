<?php require_once('private/initialize.php');

$invoiceNo = $_GET['invoice_no'] ?? '';

if (empty($invoiceNo)) {
  redirect_to('./requests');
}

$invoice = Request::find_by_invoice($invoiceNo);
$invoices = RequestDetail::find_by_requests($invoice->id);

$companyName = Company::find_by_id($invoice->company_id)->name;
$branchName = Branch::find_by_id($invoice->branch_id)->name;

$page = 'Invoice';
$page_title = 'User Invoices';
include(SHARED_PATH . '/admin_header.php');


?>

<style>
  .table td,
  .table th {
    padding: 0.3rem !important;
  }

  .divider {
    border-top: 1px solid #333;
  }
</style>


<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-block card-stretch card-height print rounded">
          <div class="card-header d-flex justify-content-between bg-primary header-invoice">
            <div class="iq-header-title">
              <h4 class="card-title mb-0">Invoice#<?php echo $invoiceNo ?></h4>
            </div>
            <div class="invoice-btn d-flex align-items-center">
              <div id="test"></div>
              <button type="button" class="btn btn-primary-dark mx-2" onclick="handlePrint()"><i class="fa la-print"></i> Print
                Print</button>
            </div>
          </div>
          <div class="card-body" id="printInvoice">
            <img src="<?php echo url_for('png/logo.png'); ?>" width="50" height="50" class="logo-invoice img-fluid mb-3">

            <div style="display:flex; justify-content:space-between;margin-bottom:50px">
              <div class="col-lg-6">
                <p class="mb-0">Plot 5, Irewolede Industrial Estate, <br> New Yidi Rd, Ilorin<br>
                  Phone: +123 4803 357 8864<br>
                  Email: olak@integrated.com<br>
                  Web: www.integratedolak.com
                </p>
              </div>
              <div class="col-lg-6" style="text-align:right">
                <p class="mb-0">Name: <?php echo $invoice->full_name ?><br>
                  Company: <?php echo $companyName ?><br>
                  Branch: <?php echo $branchName ?><br>
                  Date: <?php echo date('M d, Y', strtotime($invoice->created_at)) ?>

                </p>
                <h4 class="m-0">INVOICE NO: <?php echo $invoiceNo ?></h4>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <h5 class="mb-3">Request Summary</h5>
                <div class="table-responsive">
                  <table border="1" class="table mb-0 tbl-server-info" style="width: 100%;border-collapse:collapse;" id="invoicePrint">
                    <thead class="bg-light">
                      <tr>
                        <th class="text-center">SN</th>
                        <th class="text-center" scope="col">Item Name</th>
                        <th class="text-center" scope="col">Quantity</th>
                        <th class="text-center" scope="col">Unit Price</th>
                        <th class="text-center" scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $sn = 1;
                      foreach ($invoices as $data) :
                        $request = Request::find_by_id($data->request_id);
                      ?>
                        <tr>
                          <td style="text-align:center"><?php echo $sn++ ?></td>
                          <td style="text-align:center"><?php echo $data->item_name ?></td>
                          <td style="text-align:center"><?php echo $data->quantity ?></td>
                          <td style="text-align:center"><?php echo number_format($data->unit_price) ?></td>
                          <td style="text-align:center"><?php echo number_format($data->amount) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>

                <div style="float:right;">
                  <table border="1" class="table tbl-server-info table-bordered" style="border-collapse:collapse; margin:20px 0" id="invoicePrint">
                    <tr>
                      <td style="min-width: 150px;text-align:right;">
                        <h3 style="margin-bottom:0">GRAND TOTAL</h3>
                      </td>
                      <td style="min-width: 150px;text-align:right;">
                        <h3 style="margin-bottom:0"><?php echo number_format($invoice->grand_total, 2) ?></h3>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

            <div class="row" style="margin-top: 100px;">
              <div class="col-sm-12">
                <b class="text-danger">Notes:</b>
                <p class="mb-0"><?php echo ucfirst($invoice->note) ?></p>
              </div>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center;margin-top:100px">
              <div>
                ______________________________
                <h4 style="text-align:center">
                  <?php echo strtoupper($loggedInAdmin->full_name) ?>
                </h4>
              </div>
              <div style="text-align:center">
                ______________________________
                <h4>Accountant Signature</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  // $(document).ready(function() {
  //   let table = $('#invoicePrint').DataTable({
  //     dom: 'Bfrtip',
  //     buttons: [{
  //       extend: 'print',
  //       customize: function(win) {
  //         $(win.document.body)
  //           .css('font-size', '10pt')
  //           .prepend(
  //             '<img src="<?php //echo url_for('png/logo.png') 
                            ?>" style="position:absolute; top:0; left:0;" />'
  //           );

  //         $(win.document.body).find('#printInvoice')
  //           .addClass('compact')
  //           .css('font-size', 'inherit');
  //       }
  //     }]
  //   });

  //   table.buttons().container().appendTo($('#test'));
  // });

  function handlePrint() {

    let toPrint = document.getElementById('printInvoice');

    let newWin = window.open('', 'Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">' + toPrint.innerHTML + '</body></html>');

    newWin.document.close();

    setTimeout(function() {
      newWin.close();
    }, 10);

  }
</script>