<?php require_once('../../../private/initialize.php'); ?>

<?php 
if(isset($_POST['walletForm'])){ 
	$id = $_POST['id'];
	$editWallet = Client::find_by_id($id);
?>
    <input type="hidden" name="editWallet[id]" value="<?php echo $id ?>">
    <div class="form-group col-sm-12">
        <label class="control-label">Balance</label>
        <input type="text" class="form-control" name="editWallet[balance]" value="<?php echo $editWallet->balance ?>">
    </div>

<?php } exit();?>