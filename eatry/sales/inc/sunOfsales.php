<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_POST['fetch'])) { ?>

	<?php  $sn = 1; 
          $from = $_POST['from'];
          $to = $_POST['to'];

            $sales_rep = $_POST['sales_rep'] ?? "";
            // pre_r($sales_rep);
            if ($sales_rep != "") {
                $user = Admin::find_by_id($sales_rep)->full_name();
            }else{
                $user = "";
            }
          // echo $from;

          $total_sales = Transaction::sum_of_sales(['from' => $from, 'to' => $to, 'created_by' => $sales_rep]);
	      $cash_sales = Transaction::sum_of_sales(['from' => $from, 'to' => $to, 'payment_method' => 'cash', 'created_by' => $sales_rep]);
        $pos_sales = Transaction::sum_of_sales(['from' => $from, 'to' => $to, 'payment_method' => 'credit_card', 'created_by' => $sales_rep]);
        $transfer = Transaction::sum_of_sales(['from' => $from, 'to' => $to, 'payment_method' => 'transfer', 'created_by' => $sales_rep]);
	      $gift = Transaction::sum_of_sales(['from' => $from, 'to' => $to, 'payment_method' => 'gift_card', 'created_by' => $sales_rep]);
        $others = Transaction::sum_of_sales(['from'=>$from, 'to'=>$to, 'payment_method'=>'others', 'created_by'=>$sales_rep]); 

          
    ?>
		    <div class="col-12  p-3 mt-2">Name:<br> <span class="bold fs-20">
          <?php echo $sales_rep != "" ? Admin::find_by_id($sales_rep)->full_name() : " All Sales Rep" ?></span></div>
              <div class="d-flex justify-content-between">
                
                <div class="">
                	<div class="info-box bg-olive p-3 mt-2">
	                	<span class="info-box-text">Total Sales:</span><br> 
	                	<span class="bold fs-20 info-box-number" id="repcashTotal"> ₦ <?php echo number_format($total_sales, 2) ?></span>
	                </div>
                </div>

                <div class="">
                	<div class="info-box bg-maroon p-3 mt-2">
	                	<span class="info-box-text">Cash Sales:</span><br> 
	                	<span class="bold fs-20 info-box-number" id="repcashTotal"> ₦ <?php echo number_format($cash_sales, 2) ?></span>
	                </div>
                </div>

                <div class="">
                	<div class="info-box bg-purple p-3 mt-2">
	                	<span class="info-box-text">POS Sales:</span><br> 
	                	<span class="bold fs-20 info-box-number" id="repcashTotal"> ₦ <?php echo number_format($pos_sales, 2) ?></span>
	                </div>
                </div>

                <div class="">
                  <div class="info-box bg-purple p-3 mt-2">
                    <span class="info-box-text">Transfer:</span><br> 
                    <span class="bold fs-20 info-box-number" id="repcashTotal"> ₦ <?php echo number_format($transfer, 2) ?></span>
                  </div>
                </div>

                <div class="">
                  <div class="info-box bg-purple p-3 mt-2">
                    <span class="info-box-text">Gift:</span><br> 
                    <span class="bold fs-20 info-box-number" id="repcashTotal"> ₦ <?php echo number_format($gift, 2) ?></span>
                  </div>
                </div>

                <div class="">
                  <div class="info-box bg-purple p-3 mt-2">
                    <span class="info-box-text">Others:</span><br> 
                    <span class="bold fs-20 info-box-number" id="repcashTotal"> ₦ <?php echo number_format($others, 2) ?></span>
                  </div>
                </div>

                
              </div>

	
<?php } ?>

