<?php require_once('../../private/initialize.php'); ?>
<link rel="stylesheet" media="print" href="<?php echo url_for('/assets/dist/css/printer-80mm.css') ?>">
<body class="receipt">
  <section class="sheet padding-10mm"> 
        <div id="receiptData">
        <?php if(isset($_POST['fetch'])) { 
            
            if(isset($_POST['close_reg'])){
                $created_by = $_POST['created_by'] ?? $loggedInAdmin->id;
            }else{
                $created_by = $_POST['created_by'] ?? "";
            }
            
            if ($created_by != "") {
                $user = Admin::find_by_id($created_by)->full_name();
            }else{
                $user = "";
            }
            
        ?>
            <?php   
                $from = $_POST['from'] ?? '';
                $to = $_POST['to'] ?? '';
                $cash_sales = Transaction::sum_of_sales(['from'=>$from, 'to'=>$to, 'payment_method'=>'cash', 'created_by'=>$created_by]); 
                $cheque_sales = Transaction::sum_of_sales(['from' => $from, 'to'=>$to, 'payment_method'=>'cheque', 'created_by'=>$created_by]); 
                $cc_sales = Transaction::sum_of_sales(['from'=>$from, 'to'=>$to, 'payment_method'=>'credit_card', 'created_by'=>$created_by]); 
                $gcard_sales = Transaction::sum_of_sales(['from'=>$from, 'to'=>$to, 'payment_method'=>'gift_card', 'created_by'=>$created_by]); 
                $transfer_sales = Transaction::sum_of_sales(['from'=>$from, 'to'=>$to, 'payment_method'=>'transfer', 'created_by'=>$created_by]); 
                $others = Transaction::sum_of_sales(['from'=>$from, 'to'=>$to, 'payment_method'=>'others', 'created_by'=>$created_by]); 

                $total = $cash_sales + $cheque_sales + $cc_sales + $gcard_sales + $transfer_sales + $others;    
                
                $current_register = Register::find_by_time(['open_time' => $from, 'created_by' => $created_by]);
                // pre_r($current_register);
                $no_of_cheque = Transaction::number_of_sales(['from' => $from, 'to'=>$to, 'payment_method'=>'cheque', 'created_by'=>$created_by]);
                $no_of_cc_sales = Transaction::number_of_sales(['from' => $from, 'to'=>$to, 'payment_method'=>'credit_card', 'created_by'=>$created_by]);
                // pre_r($current_register);
            ?>
                <?php if (!empty($current_register)) { ?>

        		    <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-text="true"><i class="fa fa-times"></i></button>
                             <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
                             <h4 class="modal-title" id="myModalLabel"><?php echo $user; ?> Register Details (Opened at: <?php 
                                echo !empty($current_register->open_time) ? date('D d M, Y h:i:a', strtotime($current_register->open_time)) : 'Not Set' ?>)</h4>
                            
                         </div>
                         <div class="modal-body">
                            <form id="form">
                                <input type="hidden" name="open_time" value="<?php echo date('Y-m-d', strtotime($current_register->open_time)) ?>">
                                <input type="hidden" name="remitter[close_time]" value="<?php echo date('Y-m-d H:i:s') ?>">
                                <div id="list-table">
                                     <table width="100%" class="stable" >
                                         <tbody>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>Cash in hand:</h4></td>
                                             <td style="text-align:right; border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo !empty($current_register->cash_in_hand) ? $currency.' '.number_format(intval($current_register->cash_in_hand), 2) : '0.00'; ?></span></h4>
                                                     <input type="hidden" name="remitter[cash_in_hand]" value="<?php echo !empty($current_register->cash_in_hand) ? intval($current_register->cash_in_hand) : 0; ?>">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>Cash Sales:</h4></td>
                                             <td style="text-align:right; border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo $currency.' '.number_format($cash_sales, 2); ?></span>
                                                 </h4>
                                             <input type="hidden" name="remitter[cash_sales]" value="<?php echo !empty($cash_sales) ? $cash_sales : 0; ?>">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>POS Sales:</h4></td>
                                             <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo $currency.' '.number_format($cc_sales, 2); ?></span>
                                                 </h4>
                                            <input type="hidden" name="remitter[credit_card_sales]" value="<?php echo !empty($cc_sales) ? $cc_sales : 0; ?>">
                                            </td>
                                         </tr>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>Cheque Sales:</h4></td>
                                             <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo $currency.' '.number_format($cheque_sales, 2); ?></span>
                                                 </h4>
                                            <input type="hidden" name="remitter[cheque_sales]" value="<?php echo !empty($cheque_sales) ? $cheque_sales : 0; ?>">  
                                            </td>
                                         </tr>
                                         <tr>
                                             <td style="border-bottom: 1px solid #EEE;"><h4>Voucher:</h4></td>
                                             <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                                                     <span><?php echo $currency.' '.number_format($gcard_sales, 2); ?></span>
                                                 </h4>
                                             <input type="hidden" name="remitter[gift_card_sales]" value="<?php echo !empty($gcard_sales) ? $gcard_sales : 0; ?>">
                                             </td>
                                            
                                         </tr>
                                         <tr>
                                                 <td style="border-bottom: 1px solid #DDD;"><h4>Bank Transfer:</h4></td>
                                                 <td style="text-align:right;border-bottom: 1px solid #DDD;"><h4>
                                                         <span><?php echo $currency.' '.number_format($transfer_sales, 2); ?></span>
                                                     </h4>
                                                <input type="hidden" name="remitter[bank_transfer_sales]" value="<?php echo !empty($transfer_sales) ? $transfer_sales : 0; ?>">
                                                </td>
                                         </tr>
                                         
                                         <tr>
                                             <td style="border-bottom: 1px solid #008d4c;"><h4>Others:</h4></td>
                                             <td style="text-align:right;border-bottom: 1px solid #008d4c;"><h4>
                                                     <span><?php echo $currency.' '.number_format($others, 2); ?></span>
                                                 </h4>
                                            <input type="hidden" name="remitter[others]" value="<?php echo !empty($others) ? $others : 0; ?>">
                                            </td>
                                         </tr>

                                         <tr>
                                             <td width="300px;" style="font-weight:bold;"><h4>Total Sales:</h4></td>
                                             <td width="200px;" style="font-weight:bold;text-align:right;"><h4>
                                                     <span><?php echo $currency.' '.number_format($total, 2); ?></span>
                                                 </h4></td>
                                                 <input type="hidden" name="remitter[total]" value="<?php echo $total ?>">
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
                                                     <span><strong><?php echo !empty($current_register->cash_in_hand) ? $currency.' '.number_format(intval($current_register->cash_in_hand) + intval($cash_sales), 2) : 'Not Set'; ?></strong></span>
                                                    <input type="hidden" name="remitter[total_cash]" value="<?php echo $current_register->cash_in_hand + $cash_sales ?>">
                                                </h4>
                                             </td>
                                         </tr>

                                         <tr>
                                             <td width="300px;" style="font-weight:bold;">
                                                <h4><strong>Grand Total</strong>:<small>(Total Sales + cash in hand)</small></h4>
                                             </td>
                                             <td style="text-align:right;">
                                                <h4>
                                                     <span><strong><?php echo !empty($current_register->cash_in_hand) ? $currency.' '.number_format( $total + $current_register->cash_in_hand, 2) : 'Not Set'; ?></strong></span>
                                                </h4>
                                             </td>
                                         </tr>
                                        </tbody>

                                     </table>
                                 </div>
                                <?php if (isset($_POST['close_reg'])) { ?>
                                    <section>
                                    <hr>

                                    
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="total_cash_submitted">Total Cash Remitted</label>
                                                    <input type="text" name="remitter[total_cash_submitted]" value="<?php echo $total + $current_register->cash_in_hand; ?>" class="form-control input-tip" id="total_cash_submitted" required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="total_cheques_submitted">Total Cheques</label>                
                                                    <input type="hidden" name="remitter[no_of_cheque]" value="<?php echo $no_of_cheque; ?>">
                                                    <input type="text" readonly name="remitter[total_cheques_submitted]" value="<?php echo $no_of_cheque; ?>" class="form-control input-tip" id="total_cheques_submitted" required="required">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="total_cc_slips_submitted">Total Credit Card Slips</label>                       
                                                    <input type="hidden" name="remitter[no_cc_slips]" value="<?php echo $no_of_cc_sales; ?>">
                                                    <input type="text" readonly name="remitter[total_cc_slips_submitted]" value="<?php echo $no_of_cc_sales; ?>" class="form-control input-tip" id="total_cc_slips_submitted" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <!-- <div class="redactor-box"> -->

                                             <textarea name="details" cols="40" rows="10" name="remitter[note]"  class="form-control tip redactor" id="details"></textarea>
                                             <!-- </div> -->
                                        </div>

                                    </section>
                                
                                <div class="modal-footer no-print">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" onclick="window.print();" class="btn btn-default">Print</button> 
                                    <input <?php 
                                echo !empty($current_register->open_time) ? '' : 'disabled' ?> type="submit" id="close_register" value="Close Register" class="btn btn-primary">
                                </div>
                            <?php } ?>
                            </form>
                         </div>
                    </div>
                <?php }else{?>
                    <div class='text-center' style='font-size: 30px;'>No record Found <a href=""></a></div>
                <?php } ?>
        <?php } ?>
        </div>
    </section>
</body>


