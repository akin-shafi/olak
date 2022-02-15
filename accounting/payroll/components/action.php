<?php require_once('../../private/initialize.php'); ?>

<?php
   

   // if (isset($_POST['action']) && $_POST['action'] == "insert") {
   //    $name = $_POST['name'];
   //    $email = $_POST['email'];
   //    $username = $_POST['username'];
   //    $dob = $_POST['dob'];
   //    $dbObj->insertRecond($name, $email, $username, $dob);
   // }

?>
   <!-- View record -->
   <?php if (isset($_POST['fetch_page'])) {
   	$company_id = $_POST['company_id'] ?? '';
	$calculate_tax = 0;
	$month = $_POST['month'] ?? date('Y-m');
	$page = $_POST['fetch_page'];
	$company_name = Company::find_by_id($company_id)->company_name ?? "All";

	$payrollPayable    = Payroll::sum_of_take_home(['month' => $month, 'company_id' => $company_id]);
	$salaryPayable     = Employee::find_by_total_salary(['company' => $company_name]);
	$tax_payable       = Payroll::sum_of_tax_payable();
   	?>
   	

	 <div class="row">
		<div class="col-xl-4 col-lg-12 col-md-12">
		   <div class="card">
		      <div class="card-body">
		         <div class="row">
		            <div class="col-9">
		               <div class="mt-0 text-start">
		                  <span class="fs-14 font-weight-semibold">Sum of Gross Salary</span> 
		                  <h3 class="mb-0 mt-1  mb-2" id="actual_salary"><?php //echo number_format($salaryPayable->total_salary, 2) ?></h3>
		               </div>
		               <span class="text-muted"> <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>For <?php echo $salaryPayable->counts; ?>  </span> Employees </span> 
		            </div>
		            <div class="col-3">
		               <div class="icon1 bg-success brround my-auto  float-end"> <?php echo $currency ?> </div>
		            </div>
		         </div>
		      </div>
		   </div>
		</div>

		<div class="col-xl-4 col-lg-12 col-md-12">
		   <div class="card">
		      <div class="card-body">
		         <div class="row">
		            <div class="col-9">
		               <div class="mt-0 text-start">
		                  <span class="fs-14 font-weight-semibold">Actual Payroll Payable | <?php echo date('M Y', strtotime($month)) ?></span> 
		                  <h3 class="mb-0 mt-1  mb-2" id=""><?php echo number_format($payrollPayable, 2) ?></h3>
		               </div>
		               <span class="text-muted"> <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>For <?php echo $salaryPayable->counts; ?> </span> Employees  </span> 
		            </div>
		            <div class="col-3">
		               <div class="icon1 bg-primary brround my-auto  float-end"> <?php echo $currency ?> </div>
		            </div>
		         </div>
		      </div>
		   </div>
		</div>
		<?php if ($calculate_tax == 1) { ?>
		<div class="col-xl-4 col-lg-12 col-md-12">
		   <div class="card">
		      <div class="card-body container">
		         <div class="row">
		            <div class="col-9">
		               <div class="mt-0 text-start ">
		                  <span class="fs-14 font-weight-semibold ">Sum of Tax Payable | <?php echo date('M Y', strtotime($month)) ?></span> 
		                  <h3 class="mb-0 mt-1  mb-2"><?php echo number_format($tax_payable, 2) ?? '0.00' ?></h3>
		               </div>
		               <span class="text-muted"> <span class="text-danger fs-12 mt-2 me-1"><i class="feather feather-arrow-up-right me-1 bg-danger-transparent p-1 brround"></i>For <?php echo count($employee) ?? 0 ?> </span> Staff </span> 
		            </div>
		            <div class="col-3">
		               <div class="icon1 bg-secondary brround my-auto  float-end"> <?php echo $currency ?> </div>
		            </div>
		         </div>
		      </div>
		   </div>
		</div>
		<?php } ?>
	</div>


	<div class=" ">
		<div class="row mx-2">
			<div class="col-lg-6 col-12 ">
				<h3 class="box-title"><?php echo !empty($company_name) ? $company_name : 'All' ?> Staff Salary | for <?php echo date('M Y', strtotime($month))   ?></h3>
			</div>
			
				<div class="col-lg-6 col-12">
					<div class="d-flex justify-content-end ">
						<?php if ($company_id == '2') { ?>
								 <a target="_blank" href="#" class="btn-success btn"> Pay Salary</a>
							<!-- <div class="btn-group"> -->
					          <a target="_blank" href="<?php echo url_for('payroll/exportData.php?bank='. '1'.'&month='. $month.'&coy='. $company_name.'&sort_code='. '044140395') ?>" class="btn-warning btn" style="background:orange; color: #FFF;"> Download Excel Report for <?php echo $company_name ?></a>
					          
				         <!-- </div> -->
				      <?php }else{ ?>
				      		<a target="_blank" href="<?php echo url_for('payroll/exportData.php?bank='. '2'.'&month='. $month.'&coy='. $company_name.'&sort_code='. '035141011') ?>" class=" btn" style="background:purple; color: #FFF;">Download Excel Report for <?php echo $company_name ?></a>
				      <?php } ?>
				 	</div>
			    </div>
			 
		</div>

		<div class="card">
			<div class="table-responsive p-4">
		   	<?php  
		   	  $sn = 1;
		      $output = "";
		      $Payroll = Payroll::find_by_created_at($month);
		      if (count($Payroll) > 0) {
		         $output .="<table class='table table-bordered border-bottom no-footer'>
		                 <thead>
		                    <tr>
		                      <th><input type='checkbox' name='id[]' value='apples'></th>
							   	 <th>S/N</th>
							   	 
			                   <th>Emp Name</th>
			                   <th>Branch</th>
			                   <th>Gross Salary (₦)</th>
			                   <th>Salary Advance (₦)</th>
			                   <th>Loan (₦)</th>
			                   <th>Take Home (₦) </th>
			                   <th>Status</th>
			                   
							</tr>
		                 </thead>
		                 <tbody>";
		         foreach (Payroll::find_by_created_at($month) as $key => $value) :
		            $salary = intval($value->present_salary);
					$employee = Employee::find_by_employee_id($value->employee_id);
					// pre_r($employee);
					$firstname = isset($employee->first_name) ? $employee->full_name() : 'Not Set';
					$branch = isset($employee->branch) ? $employee->branch : 'Not Set';
					$employee_id = isset($employee->employee_id) ? str_pad($employee->employee_id, 3, '0', STR_PAD_LEFT) : 'Not Set';


					$cc = $employee->company ?? '';
					$salary_advance = intval($value->salary_advance);
					// pre_r($salary_advance);
					$loan = intval($value->loan);
					$takehome = $salary - ($salary_advance + $loan);
					
					if ($company_id != '') {
						$condition = Company::find_by_company_name($cc)->id == $company_id;
					}else{
						$condition = 1;
					}
					
					if ($condition):
				         $output.="<tr>
				         				<td><input type='checkbox' name='id[]' value='apples'></td>
				         			   <td>".$sn++."</td>
				                     
				                     <td>
				                          <div class='d-flex'>
				                             <span class='avatar avatar-md brround me-3' style='background-image: url('')'></span>
				                             <div class='me-3 mt-0 mt-sm-1 d-block'>
				                                <h6 class='mb-1 fs-14'>".$firstname."</h6>
				                                <p class='text-muted mb-0 fs-12'>Emp ID: ".$employee_id."</p>
				                             </div>
				                          </div>
				                     </td>

				                     <td>".$branch."</td>
				                     <td>".number_format($salary, 2)." <input type='hidden' class='gross_salary' value='".$salary."'></td>
				                     <td>".number_format($salary_advance, 2)."</td>
				                     <td>".number_format($loan, 2)."</td>
				                     <td>".number_format($takehome, 2)."<input type='hidden' class='take_home' value='".$takehome."'></td>
				                     <td>
				                       <span class='badge badge-danger'>Unpaid</span>
				                     </td>
				                     
				                 </tr>";
				    endif;
				endforeach;
				         $output .= "</tbody>

				            </table>";
				         // if (Company::find_by_company_name($cc)->id == ) {
			             echo $output;   

		             	 // }

		      }else{
		         echo '<h3 class="text-center mt-5">No records found</h3>';
		      }
		  
		   ?>

		   </div>
	   </div>
	</div>
 	<?php } ?>
<?php
   // Edit Record   
   

   // if (isset($_POST['editId'])) {
   //    $editId = $_POST['editId'];
   //    $row = $dbObj->getRecordById($editId);
   //    echo json_encode($row);
   // }
   // // Update Record
   // if (isset($_POST['action']) && $_POST['action'] == "update") {
   //    $id = $_POST['id'];
   //    $name = $_POST['uname'];
   //    $email = $_POST['uemail'];
   //    $username = $_POST['uusername'];
   //    $dob = $_POST['udob'];
   //    $dbObj->updateRecord($id, $name, $email, $username, $dob);
   // }
   // // Edit Record   
   // if (isset($_POST['deleteBtn'])) {
   //    $deleteBtn = $_POST['deleteBtn'];
   //    $dbObj->deleteRecord($deleteBtn);
   // }
   // // Export to excel
   // if (isset($_GET['export']) && $_GET['export'] == 'excel') {
   //    header("Content-type: application/vnd.ms-excel; name='excel'");
   //    header("Content-Disposition: attachment; filename=Payroll.xls");
   //    header("Pragma: no-cache");
   //    header("Expires: 0");
   //    $exportData = $dbObj->displayRecord();
   //    echo'<table border="1">
   //       <tr style="font-weight:bold">
   //           <td>Id</td>
   //           <td>Name</td>
   //           <td>Email</td>
   //           <td>Username</td>
   //           <td>Dob</td>
   //       </tr>';
   //    foreach ($exportData as $export) {
   //    echo'<tr>
   //       <td>'.$export['id'].'</td>
   //       <td>'.$export['name'].'</td>
   //       <td>'.$export['email'].'</td>
   //       <td>'.$export['username'].'</td>
   //       <td>'.date('d-M-Y', strtotime($export['dob'])).'</td>
   //         </tr>';
   //       }      
   //    echo '</table>';
   // }
?>

<script type="text/javascript">
	function formatToCurrency(amount) {
      return (amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
   }

   sumOfReturn();

   function sumOfReturn() {
      var currency = $('#currency').val();

      // Calculate Actual Salary
      var count1 = [];
      $('.gross_salary').each(function() {
         var item1 = $(this).val();

         count1.push(parseInt(item1));

      });
      const add1 = count1.reduce((a, b) => a + b, 0);
      var amt1 = formatToCurrency(add1); //"12.35"
      $("#actual_salary").text(amt1);


      //Calculate Take Home
      var count2 = [];
      $('.take_home').each(function() {
            var item2 = $(this).val();

            count2.push(parseInt(item2));

      });
      const add2 = count2.reduce((a, b) => a + b, 0);
      var amt2 = formatToCurrency(add2); //"12.35"
      $("#take_home").text(amt2);

   }
</script>