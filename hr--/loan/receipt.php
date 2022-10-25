<?php
require_once('../private/initialize.php');

$id = $_GET['id'] ?? '';
if (empty($id)) {
  redirect_to('../loan/salary_adv_mgt.php');
} else {
  $salAdDet = SalaryAdvanceDetail::find_by_id($id);
  $salAdv = SalaryAdvance::find_by_employee_id($salAdDet->employee_id, ['current' => date('Y-m')]);
  $employee = Employee::find_by_id($salAdDet->employee_id);
  $createdBy = isset($salAdDet->created_by) ?
    ucwords(Admin::find_by_id($salAdDet->created_by)->full_name()) : 'NOT SET';
}

$page = 'Loan';
$page_title = 'Salary Advance Receipt';
include(SHARED_PATH . '/header.php');
$datatable = '';

$fullName =  isset($employee->first_name) ? ucwords($employee->full_name()) : 'NOT SET';
$eCompany = isset($employee->company) ? strtoupper($employee->company) : 'NOT SET';
$eBranch = isset($employee->branch) ? strtoupper($employee->branch) : 'NOT SET';
?>

<div class="row my-5">
  <div class="col-xl-12 col-lg-12 col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="card overflow-hidden">
          <div class="card-body">
            <h2 class="text-muted font-weight-bold">LOAN REQUEST MEMO</h2>
            <div class="">
              <h5 class="mb-1">
                Kindly issue the loan request to the bearer whose name and staff number is stated below!
              </h5>
            </div>
            <div class="card-body ps-0 pe-0">
              <div class="row">
                <div class="col-sm-6"> <span>Reference No.</span><br><strong><?php echo $salAdDet->ref_no ?></strong> </div>
                <div class="col-sm-6 text-end"> <span>Approved Date</span><br><strong><?php echo date('F d, Y', strtotime($salAdDet->date_issued)) ?></strong> </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>

            <div class="row pt-4">
              <div class="col-lg-6 ">
                <p class="h5 font-weight-bold">Staff Designation</p>
                <address><?php echo $eCompany ?>, <?php echo $eBranch ?><br>

              </div>
              <div class="col-lg-6 text-end">
                <p class="h5 font-weight-bold">Staff Details</p>
                <address>Full Name: <?php echo $fullName ?> <br>
                  Staff ID: <?php echo $salAdDet->employee_id ?></address>
              </div>
            </div>

            <div class="table-responsive push">
              <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                  <tr class=" ">
                    <th>Request Type</th>
                    <th class="text-end">Amount</th>
                  </tr>
                  <tr>
                    <td>
                      <p class="font-weight-semibold mb-1"><?php echo $salAdDet->type == 1 ? 'Salary Advance' : 'Long Term Loan' ?></p>
                    </td>
                    <td class="text-end"><?php echo $currency . ' ' . number_format($salAdDet->amount, 2) ?></td>
                  </tr>

                  <tr>
                    <td>
                      <img src="./approved.png" class="" width="100" alt="Approved"><br>
                      By: <?php echo $createdBy ?>
                    </td>
                    <td colspan="2" class="text-end">
                      <button class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <p class="text-muted text-center d-none">Kindly issue the loan request to the bearer whose name and staff number as stated above!</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php') ?>