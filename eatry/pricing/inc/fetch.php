<?php require_once('../../private/initialize.php');  ?>

<?php if(isset($_POST['fetch'])) { 

    $plan1 = Subscription::find_by_id(1);
	$plan2 = Subscription::find_by_id(2);
	$plan3 = Subscription::find_by_id(3);
	$plan4 = Subscription::find_by_id(4);

	if ($_POST['plan_type'] == 1) {
		$plan1_amt = $plan1->amount;
		$plan2_amt = $plan2->amount;
		$plan3_amt = $plan3->amount;
		$plan4_amt = $plan4->amount;

	}elseif ($_POST['plan_type'] == 2){
		$plan1_amt = $plan1->amount * 3 + 0.10 * $plan1->amount * 3;
        $plan2_amt = $plan2->amount * 3 + 0.10 * $plan2->amount * 3;
        $plan3_amt = $plan3->amount * 3 + 0.10 * $plan3->amount * 3;
        $plan4_amt = $plan4->amount * 3 + 0.10 * $plan4->amount * 3;
	}elseif ($_POST['plan_type'] == 3){
        
		$plan1_amt = $plan1->amount * 12 - 0.08 * $plan1->amount * 12;
		$plan2_amt = $plan2->amount * 12 - 0.08 * $plan2->amount * 12;
		$plan3_amt = $plan3->amount * 12 - 0.08 * $plan3->amount * 12;
		$plan4_amt = $plan4->amount * 12 - 0.08 * $plan4->amount * 12;
	}
?>
	 


            <div class="col-md-4 col-sm-6">
                <div class="pricingTable">
                    <div class="pricingTable-header">
                        <i class="fa fa-adjust"></i>
                        <div class="price-value"> 
                        	<?php echo $currency . number_format($plan1_amt, 2)?>
                        	<span class="month">Paid <?php  
                        		if ($_POST['plan_type'] == 1) { 
                        			echo 'Monthly';
                        		}elseif ($_POST['plan_type'] == 2) {
                        			echo 'Quarterly';
                        		}elseif ($_POST['plan_type'] == 3){
                        			echo 'Annually';
                        		}?></span> 
                        </div>
                    </div>
                    <h3 class="heading"><?php echo $plan1->plan;  ?></h3>
                    <div class="pricing-content">
                        <ul>
                            <li>Front Office Module</li>
							<li>Housekeeping Module</li>
							<li class="through">Procurement & Stock Control Module</li>
							<li class="through">Accounting Module</li>
							<li class="through">HR Module</li>
							<li class="through">Maintenance Module</li>

                        </ul>
                    </div>
                    <div class="pricingTable-signup">
                        <a href="#" class="select_plan" data-id="1" data-name="<?php echo $plan1->plan?>" data-amt="<?php echo $plan1_amt?>" data-package="<?php echo $_POST['plan_type'] ?>">Select Plan</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="pricingTable green">
                    <div class="pricingTable-header">
                        <i class="fa fa-briefcase"></i>
                        <div class="price-value"> <?php echo $currency . number_format($plan2_amt, 2)?> <span class="month">Paid <?php  
                        		if ($_POST['plan_type'] == 1) { 
                        			echo 'Monthly';
                        		}elseif ($_POST['plan_type'] == 2) {
                        			echo 'Quarterly';
                        		}elseif ($_POST['plan_type'] == 3){
                        			echo 'Annually';
                        		}?></span> </div>
                    </div>
                    <h3 class="heading"><?php echo $plan2->plan;  ?></h3>
                    <div class="pricing-content">
                        <ul>
                            <li>Front Office Module</li>
							<li>Housekeeping Module</li>
							<li>Procurement & Stock Control Module</li>
							<li class="through">Accounting Module</li>
							<li class="through">HR Module</li>
							<li class="through">Maintenance Module</li>
                        </ul>
                    </div>
                    <div class="pricingTable-signup">
                        <a href="#" class="select_plan" data-id="2" data-name="<?php echo $plan2->plan?>" data-amt="<?php echo $plan2_amt?>" data-package="<?php echo $_POST['plan_type'] ?>">Select Plan</a>
                    </div>
                </div>
            </div>
           
            <div class="col-md-4 col-sm-6">
                <div class="pricingTable red">
                    <div class="pricingTable-header">
                        <i class="fa fa-cube"></i>
                        <div class="price-value"> <?php echo $currency . number_format($plan4_amt, 2)?> <span class="month">
                        Paid monthly</span> </div>
                    </div>
                    <h3 class="heading"><?php echo $plan4->plan;  ?></h3>
                    <div class="pricing-content">
                        <ul>
                            <li>Front Office Module</li>
							<li>Housekeeping Module</li>
							<li>Procurement & Stock Control Module</li>
							<li>Accounting Module</li>
							<li>HR Module</li>
							<li>Maintenance Module</li>
                        </ul>
                    </div>
                    <div class="pricingTable-signup">
                        <a href="#" class="select_plan" data-id="4" data-name="<?php echo $plan4->plan?>" data-amt="<?php echo $plan4_amt?>" data-package="<?php echo $_POST['plan_type'] ?>">Select Plan</a>

                    </div>
                </div>
            </div>
        
 <?php } ?>


 <?php if (isset($_POST['fetch_option'])) { 
 	$today = date("Y-m-d H:i:s");
 	// $date = date("Y-m-d h:i:s",strtotime("+3 Months"));

 	if ($_POST['package'] == 1) {
 		$plan_type = "Monthly Plan";
 		$expire_date = date("Y-m-d H:i:s",strtotime("+1 Months"));
 	}elseif ($_POST['package'] == 2){
 		$plan_type = "Quarterly Plan";
 		$expire_date = date("Y-m-d H:i:s",strtotime("+3 Months"));
 	}elseif ($_POST['package'] == 3){
 		$plan_type = "Annual Plan";
 		$expire_date = date("Y-m-d H:i:s",strtotime("+12 Months"));
 	}


 ?>
 	  <div class="modal-body" id="">
         <table class="table table-sm table-borderless">
            <tr>
                <td>Plan</td>
                <td><?php echo $_POST['plan_name'] ?></td>
            </tr>
            <tr>
                <td>Plan Type</td>
                <td><?php echo $plan_type ?></td>
            </tr>
            <tr>
                <td>Amount</td><td><?php echo $currency . number_format($_POST['plan_amt'], 2) ?></td>
            </tr>
            <tr>
                <td>Start Date</td><td><?php echo date('D d M Y h:i:a', strtotime($today)) ?></td>
            </tr>
            <tr>
                <td>End Date</td><td> <?php echo date('D d M Y h:i:a', strtotime($expire_date)) ?></td>
            </tr>
        </table>
      </div>
      <div class="p-3">
          <div class="form-group">
              <label>Enter your Full name:</label>
              <input type="text" id="fullname" required class="form-control">
          </div>

          <div class="form-group">
              <label>Email:</label>
              <input type="text" id="email" required class="form-control">
          </div>

          <div class="form-group">
              <label>Phone Number:</label>
              <input type="text" id="phone" required class="form-control">
          </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Close</button>

        <!-- <button class="btn btn-sm btn-success" type="button" id="continue" >Proceed</button> -->

        <button  class="btn btn-sm btn-success" type="submit" id="proceed" data-name="<?php echo $_POST['plan_name'] ?>" data-amt="<?php echo $_POST['plan_amt'] ?>" data-package="<?php echo $plan_type ?>">Proceed</button>
      </div>
	
    <!-- <div class="btn-group d-flex justify-content-end">
        <button class="btn btn-sm btn-success" type="submit" id="proceed">Proceed</button>
    </div> -->
	<input type="hidden" name="plan_name" value="<?php echo $_POST['plan_name'] ?>">
	<input type="hidden" name="plan_type" value="<?php echo $plan_type ?>">
	<input type="hidden" name="amount" value="<?php echo $_POST['plan_amt'] ?>">
	<input type="hidden" name="create_at" value="<?php echo $today ?>">
	<input type="hidden" name="expire_date" value="<?php echo $expire_date ?>">
	<input type="hidden" name="product" value="PMS">
	
 <?php } ?>
