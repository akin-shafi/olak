
<?php require_once('../../../private/initialize.php');  ?>
<?php if (isset($_GET['fetch'])) : 
    $action = $_GET['action'];
    $id = $_GET['id'];
    // pre_r($id);
    $summary_report = SummaryReport::find_by_id($id);
    $date = $summary_report->report_date ?? date('Y-m-d');

;?>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><?php echo $action == 'add' ? 'Create Report' : 'Edit Report'; ?></h4>
        <button required type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form id="form">
        <input type="hidden" name="createReport[<?php echo $action == 'add' ? 'add' : 'edit'; ?>]" value="<?php echo $action == 'add' ? 'add' : 'edit'; ?>">
        <input type="hidden" name="createReport[id]" value="<?php echo $id; ?>">

          <div class="form-group">
            <label for="date">Date:</label>
            <input required name="createReport[report_date]" type="date" class="form-control" id="date" value="<?php echo $date ?>">
          </div>
          <div class="form-group">
            <input required name="createReport[company_id]" type="hidden" value="<?php echo $loggedInAdmin->company_id ?>">
            <input required name="createReport[created_by]" type="hidden" value="<?php echo $loggedInAdmin->id ?>">
            <label for="branch">Branch Name:</label>
            <select name="createReport[branch_id]" class="form-control" id="branch">
                <option value="" selected>Select</option>
                <?php foreach (Branch::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                <option value="<?php echo $value->id ?>" <?php echo $loggedInAdmin->branch_id ==  $value->id ? 'selected' : ''; ?>><?php echo $value->branch_name ?> </option>
                <?php } ?>
                
            </select>
          </div>
          <div class="form-group">
            <label for="cashSales">Cash Sales (Manual):</label>
            <input required value="<?php echo $summary_report->cash_sales ?? '' ?>" name="createReport[cash_sales]" type="number" class="form-control" id="cashSales">
          </div>
          <div class="form-group">
            <label for="expenses">Expenses:</label>
            <input required value="<?php echo $summary_report->expenses ?? '' ?>" name="createReport[expenses]" type="number" class="form-control" id="expenses">
          </div>
          <div class="form-group">
            <label for="refund">Sum of Refund:</label>
            <input required value="<?php echo $summary_report->sum_of_refund ?? '' ?>" name="createReport[sum_of_refund]" type="number" class="form-control" id="refund">
          </div>

          <div class="form-group">
            <label for="complaintsInput">Complaints</label>
            <textarea  name="createReport[complains]" class="form-control" id="complaintsInput" rows="3" placeholder="Enter Complaints"><?php echo $summary_report->complains ?? '' ?></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button required type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
        <button required type="button" id="<?php echo $action == 'add' ? 'save' : 'editRecord'; ?>" class="btn btn-primary"><?php echo $action == 'add' ? 'Create' : 'Update'; ?></button>
       

      </div>
      
<?php endif;?>

<?php 
if(isset($_POST['createReport'])):

    $args = $_POST['createReport'];
    $createReport = new SummaryReport($args);
    $result = $createReport->save();
    if ($result == true) {  
          $rand = rand(10, 100);
          $new_id = $createReport->id;
          $ref_no = "03" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;
            $data = [
              'ref_no' => $ref_no,
            ];
            $createReport->merge_attributes($data);
            $result2 = $createReport->save();
  
            exit(json_encode(['msg' => 'OK']));
    } else {
        exit(json_encode(['msg' => display_errors($createReport->errors)]));
    }
  
endif
?>

