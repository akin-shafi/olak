<?php require_once('private/initialize.php');

$invoiceNo = $_GET['invoice_no'] ?? '';

if (empty($invoiceNo)) {
  redirect_to('../requests/');
}

$invoices = Request::find_by_invoices($invoiceNo);
$invoice = Request::find_by_invoice($invoiceNo);

$companyName = Request::get_company($invoice->company_id)->company_name;
$branchName = Request::get_branch($invoice->branch_id)->branch_name;

$page = 'Invoice';
$page_title = 'User Invoices';
include(SHARED_PATH . '/admin_header.php');


?>

<style>
  .table td,
  .table th {
    padding: 0.3rem !important;
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
            <div class="invoice-btn">
              <button type="button" class="btn btn-primary-dark mr-2"><i class="fa la-print"></i> Print
                Print</button>
              <button type="button" class="btn btn-primary-dark"><i class="fa la-file-download"></i>PDF</button>
            </div>
          </div>
          <div class="card-body">
            <img src="<?php echo url_for('png/logo.png'); ?>" class="logo-invoice img-fluid mb-3">

            <div class="row my-4">
              <div class="col-lg-6">
                <p class="mb-0">Plot 5, Irewolede Industrial Estate, <br> New Yidi Rd, Ilorin<br>
                  Phone: +123 4803 357 8864<br>
                  Email: olak@integrated.com<br>
                  Web: www.integratedolak.com
                </p>
              </div>
              <div class="col-lg-6 text-right">
                <p class="mb-0">Name: <?php echo $invoice->full_name ?><br>
                  Company: <?php echo $companyName ?><br>
                  Branch: <?php echo $branchName ?>
                </p>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <h5 class="mb-3">Request Summary</h5>
                <div class="table-responsive-sm">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Request ID</th>
                        <th scope="col">Item Name</th>
                        <th class="text-center" scope="col">Quantity</th>
                        <th class="text-center" scope="col">Status</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Request Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($invoices as $data) : ?>
                        <tr>
                          <td><?php echo '00' . $data->id ?></td>
                          <td><?php echo $data->item_name ?></td>
                          <td class="text-center"><?php echo $data->quantity ?></td>
                          <td class="text-center">
                            <?php switch ($data->status) {
                              case '2':
                                echo '<span class="badge badge-success">Unpaid</span>';
                                break;
                              case '3':
                                echo '<span class="badge badge-danger">Unpaid</span>';
                                break;
                              default:
                                echo '<span class="badge badge-primary">New</span>';
                                break;
                            } ?>
                          </td>
                          <td><?php echo date('M d, Y', strtotime($data->due_date)) ?></td>
                          <td><?php echo date('M d, Y', strtotime($data->created_at)) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <b class="text-danger">Notes:</b>
                <p class="mb-0"><?php echo ucfirst($invoice->note) ?></p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include(SHARED_PATH . '/admin_footer.php'); ?>