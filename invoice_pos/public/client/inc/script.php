<?php require_once('../../../private/initialize.php');
if (is_post_request()) {
    if (isset($_POST['delete_pop'])) {
        $popID = $_POST['id'];
        
        $walletDetails = WalletFundingMethod::find_by_id($popID);
        
        if($walletDetails->approval == 1){
            exit(json_encode(['success' => false, 'msg' => 'Error: POP already approved, you can no longer delete']));
        }else{
            $wallet = Wallet::find_by_payment_id($walletDetails->payment_id);
            $amt_left = $wallet->deposit - $walletDetails->amount;
            // pre_r($amt_left);
            if($amt_left == 0){
                $wallet::deleted($wallet->id);
                $walletDetails::deleted($popID);
                exit(json_encode(['success' => true, 'msg' => 'POP record deleted successfully']));
            }
            else{
                $args = [
                    'deposit' => $amt_left,
                    'balance' => $amt_left,
                ];
                $wallet->merge_attributes($args);
                // pre_r($wallet);
                $result = $wallet->save();
                if($result){
                    $result2 =$walletDetails::deleted($popID);
                    if($result2){
                        exit(json_encode(['success' => true, 'msg' => 'POP record deleted successfully']));
                    }
                }
            }

        }


        // $invoices = Invoice::find_by_transid($billing->invoiceNum);
        // foreach ($invoices as $value) {
        //     Invoice::deleted($value->id);
        // }

        // $billing::deleted($invoiceId);

        // exit(json_encode(['success' => true, 'msg' => 'Invoice record deleted successfully']));
    
    }
}

?>
