<?php require_once('../../private/initialize.php'); ?>

<?php if(isset($_POST['fetch'])) { ?>
	<?php  $sn = 1; 
          $from = $_POST['from'] ?? '';
          $to = $_POST['to'] ?? '';
          $sales_rep = $_POST['sales_rep'] ?? '';
          // echo $from;


          foreach (Transaction::find_trans(['from' => $from, 'to' => $to, 'created_by' => $sales_rep,]) as $value) {  
          		if( $value->balance == 0 ){
	              $status = 'Paid';
	            }else{
	              $status = 'Owning';
	            }
          	?>
		    <tr class="text-center">
		        <td style="max-width:30px;"><?php echo $sn++ ?></td>
		        <td class="col-xs-2"><?php echo date('D d M y h:i:a', strtotime($value->created_at)) ?></td>
		        <td class="action" style="min-width:115px; max-width:115px; text-align:center;">
		                <li class="dropdown hidden-xs">
		                    <button class="dropdown-toggle btn btn-primary btn-xs" data-toggle="dropdown">
		                      Options
		                    </button>
		                    <ul class="dropdown-menu ">
		                        <li class="view_sale" data-id="<?php echo $value->trans_no ?>" title="View sale"><a href="#" ><i class="fa fa-list"></i>View Sales</a>
		                        </li>
		                        <li class="void" data-id="<?php echo $value->trans_no ?>" title="Void sale"><a href="#"><i class="fa fa-ban"></i>Void Sales</a></li>
		                        <!--<li class="edit_sale" data-id="" title="Edit Sale">-->
	                         <!-- <a href="<?php //echo url_for('/return/index.php?ref_no='.$value->trans_no); ?>" >-->
	                         <!--     <i class="fa fa-edit"></i>Edit Sales</a>-->
	                         <!--   </li>-->
		                        
		                    </ul>
		                </li>
		        </td>
		        <td><?php echo !empty($value->created_by) ? Admin::find_by_id($value->created_by)->full_name() : "Not Set"; ?></td>
		       
		        
		        <td class="col-xs-1"><?php echo $value->payment_method == "credit_card" ? "POS" : $value->payment_method; ?></td>
		        <td class="col-xs-1"><?php echo $value->trans_no; ?></td>
		        <td class="col-xs-1"><?php echo $value->total_item; ?></td>
		        <td class="col-xs-1"><?php echo number_format($value->cost_of_item, 2); ?></td>
		        

		        <td class="col-xs-1">
		          
		          <div class="text-center">
		            <span class="sale_status label <?php 
		            echo $status == 'Paid' ? 'label-success' : 'label-warning' ?>"><?php echo $status; ?></span>
		          </div>
		        </td>
		        
		    </tr>

	<?php } ?>
<?php } ?>

