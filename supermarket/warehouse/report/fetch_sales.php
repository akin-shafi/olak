<?php  require_once('../../private/initialize.php'); ?>

<?php if (isset($_POST['fetch'])) { ?>
	
	<div class="row ">
	  <?php 
	  	$from = $_POST['from'];
		$to = $_POST['to'];
	  // for ($i=1; $i <= 1 ; $i++) { 
	      if (in_array($loggedInAdmin->admin_level, [1,2,3])) {
	        $created_by = "";
	      }else{
	        $created_by = $loggedInAdmin->id;
	      }
	    // if ($i == 1) {
	      $title = "Total Sales";
	      $sales = CheckOut::sum_of_sales(['from' => $from, 'to' => $to,  'created_by'=>$created_by]); 
	      $icon = "shopping-cart"; 
	      $color = "navy"; 
	    // }

	      if (in_array($loggedInAdmin->admin_level, [1,2,3])) {
	          $trans =  CheckOut::find_by_rec(['from' => $from, 'to' => $to, 'order' => 'DESC']);
	        }else{
	           $trans = CheckOut::find_by_rec(['from' => $from, 'to' => $to, 'created_by' => $loggedInAdmin->id, 'order' => 'DESC']);
	        }
	  ?>
	     <div class="col-md-3 col-sm-6 col-xs-12">
	        <div class="info-box bg-<?php echo $color ?>">
	           <span class="info-box-icon"><i class="fa fa-<?php echo $icon ?>"></i></span>
	           <div class="info-box-content">
	              <span class="info-box-text"><?php echo $title ?> </span>
	              <span class="info-box-number">₦ <?php echo number_format($sales, 2); ?></span>
	              <div class="progress">
	                 <div style="width: 100%" class="progress-bar"></div>
	              </div>
	              <span class="progress-description">Today </span>
	           </div>
	        </div>
	     </div> 
	     <div class="col-md-3 col-sm-6 col-xs-12">
	        <div class="info-box bg-maroon">
	           <span class="info-box-icon"><i class="fa fa-gift"></i></span>
	           <div class="info-box-content">
	              <span class="info-box-text">Total Items Issued </span>
	              <span class="info-box-number"><?php echo count($trans) ?></span>
	              <div class="progress">
	                 <div style="width: 100%" class="progress-bar"></div>
	              </div>
	              <span class="progress-description">Today </span>
	           </div>
	        </div>
	     </div> 
	  <?php //} ?>
	       
	</div>

	<div class="box-body">
	   <div class="table-responsive">
	        <table id="example2" class="table table-bordered table-striped table-hover">
	          <thead class="cf">
	            <tr class="active">
	                  <th >SN</th>
	                  <th style=" text-align:center;">Actions</th>
	                  <th class="col-xs-2">Date</th>
	                  <th class="col-xs-2">Created By</th>
	                  <th>Reciever</th>
	                  <th>Trans_no</th>
	                  <th class="col-xs-1">Qty</th>
	                  <!-- <th class="col-xs-1">Tax</th> -->
	                  <th class="col-xs-1">G.Total(<?php echo $currency; ?>)</th>
	                  
	              </tr>
	          </thead>
	           <tbody >
	          <?php  $sn = 1;  foreach ($trans as $value) { ?>
	            <tr class="text-center">
	                <td style="max-width:30px;"><?php echo $sn++ ?></td>
	                <td class="action" style="min-width:115px; max-width:115px; text-align:center;">
	                        <li class="dropdown hidden-xs">
	                            <button class="dropdown-toggle btn btn-primary btn-xs" data-toggle="dropdown">
	                              Options
	                            </button>
	                            <ul class="dropdown-menu ">
	                              <li class="view_sale" data-id="<?php echo $value->trans_no ?>" title="View sale"><a href="#" ><i class="fa fa-list"></i>View Sales</a>
	                                </li>
	                              <!-- <li>View</li> -->
	                                
	                                
	                            </ul>
	                        </li>
	                </td>
	                <td class="col-xs-2"><?php echo date('D d M y h:i:a', strtotime($value->created_at)) ?></td>
	                <td><?php echo !empty($value->created_by) ? Admin::find_by_id($value->created_by)->full_name() : "Not Set"; ?></td>
	                <td><?php echo $value->receiver ?></td>
	                
	                <td class="col-xs-1"><?php echo $value->trans_no; ?></td>
	                <td class="col-xs-1"><?php echo $value->total_item; ?></td>
	                <td class="col-xs-1"><?php echo number_format($value->total_cost, 2); ?></td>
	                
	            </tr>
	          <?php } ?>
	           </tbody>

	           
	        </table>

	   </div>
	   
	</div>


<?php } ?>
