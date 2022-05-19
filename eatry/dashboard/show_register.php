<?php require_once('../private/initialize.php'); ?>
<link rel="stylesheet" media="print" href="<?php echo url_for('/assets/dist/css/printer-80mm.css') ?>">
<body class="receipt">
  <section class="sheet padding-10mm">
    <div id="receiptData">
        <?php 

            if(isset($_POST['fetch'])) { ?>
        	<?php   
               $id = $_POST['id'] ?? '';
               $current_register = Register::find_by_id($id);
                // pre_r($current_register);
            ?>
            
        		    <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
                             <h4 class="modal-title" id="myModalLabel">Register Details (Opened at: <?php 
                                echo !empty($current_register->open_time) ? date('D d M, Y h:i:a', strtotime($current_register->open_time)) : 'Not Set' ?>)</h4>
                            
                         </div>
                         <div class="modal-body">
                            <form id="form">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="remitter[verfication_status]" value="1">
                                <div id="list-table">
                                     <table width="100%" class="stable" >
                                         <tbody>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>Cash in hand:</h4></td>
                                             <td style="text-align:right; border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo !empty($current_register->cash_in_hand) ? $currency.' '.number_format($current_register->cash_in_hand, 2) : '0.00'; ?></span></h4>
                                                     
                                             </td>
                                         </tr>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>Cash Sales:</h4></td>
                                             <td style="text-align:right; border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo $currency.' '.number_format($current_register->cash_sales, 2); ?></span>
                                                 </h4>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>Credit Card Sales:</h4></td>
                                             <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo $currency.' '.number_format($current_register->credit_card_sales, 2); ?></span>
                                                 </h4>
                                            </td>
                                         </tr>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>Cheque Sales:</h4></td>
                                             <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo $currency.' '.number_format($current_register->cheque_sales, 2); ?></span>
                                                 </h4>  
                                            </td>
                                         </tr>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>Gift Card Sales:</h4></td>
                                             <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo $currency.' '.number_format($current_register->gift_card_sales, 2); ?></span>
                                                 </h4>
                                             </td>
                                            
                                         </tr>
                                         <tr>
                                                 <td style="border-bottom: 1px solid #DDD;"><h4>Bank Transfer:</h4></td>
                                                 <td style="text-align:right;border-bottom: 1px solid #DDD;"><h4>
                                                         <span><?php echo $currency.' '.number_format($current_register->bank_transfer_sales, 2); ?></span>
                                                     </h4>
                                                </td>
                                         </tr>
                                         
                                         <tr>
                                             <td style="border-bottom: 1px solid #008d4c;"><h4>Others:</h4></td>
                                             <td style="text-align:right;border-bottom: 1px solid #008d4c;"><h4>
                                                     <span><?php echo $currency.' '.number_format($current_register->others, 2); ?></span>
                                                 </h4>
                                            </td>
                                         </tr>

                                         <tr>
                                             <td width="300px;" style="font-weight:bold;"><h4>Total Sales:</h4></td>
                                             <td width="200px;" style="font-weight:bold;text-align:right;"><h4>
                                                     <span><?php echo $currency.' '.number_format($current_register->total, 2); ?></span>
                                                 </h4></td>
                                         </tr>

                                         <tr>
                                             <td width="300px;" style="font-weight:bold;"><h4>Expenses:</h4></td>
                                             <td width="200px;" style="font-weight:bold;text-align:right;"><h4>
                                                     <span>0.00</span>
                                                 </h4></td>
                                         </tr>

                                         <tr>
                                             <td width="300px;" style="font-weight:bold;">
                                                <h4><strong>Total Cash</strong>:<small>(Cash in hand + Cash Sales)</small></h4>
                                             </td>
                                             <td style="text-align:right;">
                                                <h4>
                                                     <span><strong>
                                                        <?php echo !empty($current_register->total_cash) ? $currency.' '.number_format($current_register->total_cash, 2) : 'Not Set'; ?></strong></span>
                                                </h4>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td width="300px;" style="font-weight:bold;">
                                                <h4><strong>Grand Total</strong>:<small>(Total Sales + cash in hand)</small></h4>
                                             </td>
                                             <td style="text-align:right;">
                                                <h4>
                                                     <span><strong><?php echo !empty($current_register->cash_in_hand) ? $currency.' '.number_format( $current_register->total + $current_register->cash_in_hand, 2) : 'Not Set'; ?></strong></span>
                                                </h4>
                                             </td>
                                         </tr>
                                        </tbody>

                                     </table>
                                     <?php //echo $_POST['admin_level'] ?>
                                 </div>
                                 <?php if ($current_register->verfication_status != 1) { ?>
                                
                                    <?php if (isset($_POST['close_reg'])) { ?>
                                        
                                        <?php if (in_array($loggedInAdmin->admin_level, [1,2,3])) { ?>
                                            <div class="modal-footer no-print">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="button" onclick="window.print();" class="btn btn-default">Print</button> 
                                                <input <?php 
                                            echo !empty($current_register->open_time) ? '' : 'disabled' ?> type="submit" id="close_register" value="Approve" class="btn btn-danger">
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                 <?php }else{ ?>
                                        <button type="button" disabled class="btn btn-success pull-right no-print">Transaction Approved</button>
                                        <br class="clearfix"></br> 
                                 <?php } ?>
                            </form>
                         </div>
                    </div>

        <?php } ?>
    </div>
   </section>
</body>



