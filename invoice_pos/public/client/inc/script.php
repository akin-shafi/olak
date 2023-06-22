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
    }
}

?>


<?php if(isset($_POST['editWallet'])){
   $id = $_POST['editWallet']['id'];
   $update = Client::find_by_id($id);  
   $args = $_POST['editWallet'];    
   $args['updated_at'] = date('Y-m-d h:i:s');
    $update->merge_attributes($args);
    $result = $update->save();
    if ($result == true) {  
        exit(json_encode(['msg' => 'OK']));
    } else {
        exit(json_encode(['msg' => display_errors($update->errors)]));
    }

} ?>
