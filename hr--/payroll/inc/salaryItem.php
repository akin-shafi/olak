<?php require_once('../../private/initialize.php');

$empId = $_GET['empId'] ?? 1;
$employee = Employee::find_by_id($empId);
// pre_r($employee);
$earnings = PayrollItem::find_all_payroll(['category' => 1]);
$deductions = PayrollItem::find_all_payroll(['category' => 3]);
$salaryAdvance = SalaryAdvance::find_by_employee_id($employee->employee_id);
$longTerm = LongTermLoan::find_by_employee_id($employee->employee_id);
$commitment = $longTerm ? intval($longTerm->commitment) : 0;
$presentSalary = $employee->present_salary ? $employee->present_salary : 0;

$salary = Payroll::find_by_employee_id($employee->employee_id);
$overtime = $salary->overtime_allowance ?? 0;
$leave = $salary->leave_allowance ?? 0;
$otherAllowance = $salary->other_allowance ?? 0;
$otherDeduction = $salary->other_deduction ?? 0;

$tax = Payroll::tax_calculator(['netSalary' => $presentSalary]);
$totalAllowance = $overtime + $leave + $otherAllowance + $presentSalary;
$calculate_tax = 0;

if ($calculate_tax == 1) {
   $totalDeduction = $commitment + $salaryAdvance->total_requested + $otherDeduction + $tax['monthly_tax'] + $tax['pension'];
} else {
   $totalDeduction = $commitment + $salaryAdvance->total_requested + $otherDeduction;
}
$netSalaryComputed = intval($totalAllowance) - intval($totalDeduction);

?>

<div id="printPayroll">
   <div class="modal-header">
      <h5 class="modal-title">Salary Narration</h5>
      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-text="true">×</span> </button>
   </div>
   <div class="modal-header">
      <!-- <div> <img src="<?php //echo url_for('assets/images/brand/logo.png')
                           ?>" class="header-brand-img" alt="Dayonelogo"> </div> -->
      <h1 class="mb-0">Integrated Olak</h1>
      <div class="ms-auto">
         <!-- <div class="font-weight-bold text-md-right mt-3">Date: 01-02-2021</div> -->
      </div>
   </div>
   <div class="modal-body pt-1">
      <div class="table-responsive mt-3 mb-3">
         <table class="table mb-0 modal-paytable">
            <tbody>
               <tr>
                  <td> <strong>Emp Name:</strong> <span><?php echo $employee->full_name() ?></span> </td>
                  <td class="text-end"> <strong>Company:</strong> <span><?php echo $employee->company ?></span> </td>
               </tr>
               <tr>
                  <td> <strong>Emp ID:</strong> <span><?php echo $employee->employee_id ?></span> </td>
                  <td class="text-end"> <strong>Branch:</strong> <span><?php echo $employee->branch ?></span> </td>
               </tr>
            </tbody>
         </table>
      </div>
      <div class="row">

         <div class="col-6 table-responsive">
            <table class="table border text-nowrap mb-0">
               <thead>
                  <tr>
                     <th class="fs-18" rowspan="1" colspan="2">Earnings</th>
                  </tr>
                  <tr>
                     <th>Pay Type</th>
                     <th class="border-start">Amount(<?php echo $currency ?>)</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($earnings as $value) :
                     $amountCalculated = $presentSalary * (intval($value->amount) / 100);
                  ?>
                     <?php if ($value->addon == 0) : ?>
                        <tr>
                           <td><?php echo ucwords($value->item) ?></td>
                           <td class="border-start"><?php echo number_format($amountCalculated) ?>
                              <input value="<?php echo $amountCalculated ?>" class="returnValue" type="hidden">
                           </td>
                        </tr>
                     <?php endif ?>
                  <?php endforeach ?>
                  <tr class="border-top">
                     <td class="font-weight-semibold">Total Earnings</td>
                     <td class="font-weight-semibold border-start">
                        <?php echo number_format($presentSalary, 2); ?>
                        <!-- <div id="value_of_return"></div> -->
                     </td>
                  </tr>
               </tbody>
            </table>
         </div> 
         <div class="col-6 table-responsive">
                     <table class="table text-nowrap mb-0 border">
                        <thead>
                           <tr>
                              <th class="fs-18" rowspan="1" colspan="2">Deductions</th>
                           </tr>
                           <tr>
                              <th>Pay Type</th>
                              <th class="border-start">Amount</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if ($calculate_tax == 1) : ?>
                              <?php
                              foreach ($deductions as $value) :
                                 if ($value->item == 'Tax(PAYE)') {
                                    $amountCalculated = $tax['monthly_tax'];
                                 } elseif ($value->item == 'Pension') {
                                    $amountCalculated = $tax['pension'];
                                 } else {
                                    $amountCalculated = $presentSalary * (intval($value->amount) / 100);
                                 }
                              ?>
                                 <tr>
                                    <td><?php echo ucwords($value->item)
                                          ?></td>
                                    <td class="border-start"><?php echo number_format($amountCalculated) ?></td>
                                 </tr>
                              <?php endforeach;
                              ?>
                           <?php else : ?>
                              <?php
                              foreach ($deductions as $value) :
                                 if ($value->item == 'Tax(PAYE)') {
                                    $amountCalculated = 0;
                                 } elseif ($value->item == 'Pension') {
                                    $amountCalculated = 0;
                                 } else {
                                    $amountCalculated = 0; 
                                 }
                              ?>
                                 <tr>
                                    <td><?php echo ucwords($value->item)
                                          ?></td>
                                    <td class="border-start"><?php echo number_format($amountCalculated) ?></td>
                                 </tr>
                              <?php endforeach;
                              ?>
                           <?php endif ?>
                           <tr class="d-none">
                              <td>Salary Advance</td>
                              <td class="border-start"><?php echo number_format($salaryAdvance->total_requested) ?></td>
                           </tr>

                           <tr class="d-none">
                              <td>Commitment for(Long Term Loan)</td>
                              <td class="border-start"><?php echo number_format($commitment) ?></td>
                           </tr>

                           <tr class="border-top">
                              <td class="font-weight-semibold">Total Deduction</td>
                              <td class="font-weight-semibold border-start"><?php echo number_format(intval($totalDeduction)) ?></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>

      </div>
      <div class="mt-4 mb-3 table-responsive">
         <table class="table mb-0">
            <tbody>
               <tr>
                  <td class="font-weight-semibold w-20 fs-18 pb-0 pt-0">Net Salary</td>
                  <td class="pb-0 pt-0">
                     <h4 class="font-weight-semibold mb-0 fs-24"><?php echo $currency . ' ' . number_format($netSalaryComputed, 2) ?> </h4>
                  </td>
               </tr>
               <tr>
                  <td class="font-weight-semibold w-20 pb-0 pt-1 text-muted">In Words</td>
                  <td class="pb-0 pt-1">
                     <h5 class="mb-0  text-muted"><?php echo convert_number_to_words($netSalaryComputed) . ' Naira Only.' ?></h5>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
   <div class="p-5 border-top text-center">
      <div class="text-center">
         <h6 class="mb-2">Integrated Olak Group.</h6>
         <p class="mb-1 fs-12">Adress</p>
         <div> <small>Tel No: +234 66904 8599,</small> <small>Email: info@olakgroups.com</small> </div>
      </div>
   </div>
</div>
<div class="modal-footer">
   <div class="ms-auto">
      <a href="#" class="btn btn-info" id="btnPrint"><i class="si si-printer"></i> Print</a>
      <!-- <a href="#" class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print</a> -->
      <a href="#" class="btn btn-danger" data-bs-dismiss="modal"><i class="feather feather-x"></i> Close</a>
   </div>
</div>

<style>
   @media screen {
      #printSection {
         display: none;
      }
   }

   @media print {
      body * {
         visibility: hidden;
      }

      #printSection,
      #printSection * {
         visibility: visible;
      }

      #printSection {
         position: absolute;
         left: 0;
         top: 0;
      }
   }
</style>

<script type="text/javascript">
   function formatToCurrency(amount) {
      return (amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
   }

   sumOfReturn();

   function sumOfReturn() {
      var currency = $('#currency').val();

      // Calculate reurn value
      var count1 = [];
      $('.returnValue').each(function() {
         var item1 = $(this).val();

         count1.push(parseInt(item1));

      });
      const add1 = count1.reduce((a, b) => a + b, 0);
      var amt1 = formatToCurrency(add1); //"12.35"
      $("#value_of_return").text('₦' + amt1);


      // Calculate Sold value
      // var count2 = [];
      // $('.soldValue').each(function() {
      //       var item2 = $(this).val();

      //       count2.push(parseInt(item2));

      // });
      // const add2 = count2.reduce((a, b) => a + b, 0);
      // var amt2 = formatToCurrency(add2); //"12.35"
      // $("#value_of_sold").text(currency + amt2);

   }

   document.getElementById("btnPrint").onclick = function() {
      printElement(document.getElementById("printPayroll"));
   }

   function printElement(elem) {
      var domClone = elem.cloneNode(true);

      var $printSection = document.getElementById("printSection");

      if (!$printSection) {
         var $printSection = document.createElement("div");
         $printSection.id = "printSection";
         document.body.appendChild($printSection);
      }

      $printSection.innerHTML = "";
      $printSection.appendChild(domClone);
      window.print();
   }
</script>