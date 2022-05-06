<?php require_once('../../private/initialize.php');

if (is_post_request()) {

  if (isset($_POST['new_request'])) {
    $rand = rand(10, 100);
    $new_id = 1;
    $invoice_no = "PRO-" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;

    $item_name = $_POST['item_name'];

    for ($i = 0; $i < count($item_name); $i++) {
      $data = [
        "invoice_no"    => $invoice_no,
        "full_name"     => $_POST['full_name'],
        "company_id"    => $_POST['company_id'],
        "branch_id"     => $_POST['branch_id'],
        "due_date"      => $_POST['due_date'],
        "note"          => $_POST['note'],
        "item_name"     => $_POST['item_name'][$i],
        "unit"          => $_POST['unit'][$i],
        "quantity"      => $_POST['quantity'][$i],
        "unit"          => $_POST['unit'][$i],
        "created_by"    => 1,
      ];

      $proRequest = new Request($data);
      $result = $proRequest->save();
    }

    if ($result == true) {
      exit(json_encode(['success' => true, 'message' => 'Request sent Successfully', 'invoice_no' => $invoice_no]));
    }
  }

  if (isset($_POST['edit_request'])) {
    $invoice_no = $_POST['invoice_num'];
    $item_name = $_POST['item_name'];

    for ($i = 0; $i < count($item_name); $i++) {
      $data = [
        "invoice_no"    => $invoice_no,
        "full_name"     => $_POST['full_name'],
        "company_id"    => $_POST['company_id'],
        "branch_id"     => $_POST['branch_id'],
        "due_date"      => $_POST['due_date'],
        "note"          => $_POST['note'],
        "item_name"     => $_POST['item_name'][$i],
        "unit"          => $_POST['unit'][$i],
        "quantity"      => $_POST['quantity'][$i],
        "unit"          => $_POST['unit'][$i],
      ];

      if (!empty(Request::find_by_invoices($invoice_no)[$i])) :
        $proRequest = Request::find_by_invoices($invoice_no)[$i];

        $proRequest->merge_attributes($data);
        $proRequest->save();
      else :
        $data = [
          "invoice_no"    => $invoice_no,
          "full_name"     => $_POST['full_name'],
          "company_id"    => $_POST['company_id'],
          "branch_id"     => $_POST['branch_id'],
          "due_date"      => $_POST['due_date'],
          "note"          => $_POST['note'],
          "item_name"     => $_POST['item_name'][$i],
          "unit"          => $_POST['unit'][$i],
          "quantity"      => $_POST['quantity'][$i],
          "unit"          => $_POST['unit'][$i],
          "created_by"    => 1,
        ];

        $proRequest = new Request($data);
        $proRequest->save();
      endif;
    }

    exit(json_encode(['success' => true, 'message' => 'Request Updated Successfully', 'invoice_no' => $invoice_no]));
  }

  if (isset($_POST['delete_request'])) {
    $requestId = $_POST['id'];
    $invoice = Request::find_by_id($requestId);

    $invoice::deleted($requestId);

    exit(json_encode(['message' => 'Request record deleted successfully']));
  }
}


if (is_get_request()) {
  if (isset($_GET['get_request'])) :
    $requestId = $_GET['iNo'];
    $requests = Request::find_by_invoices($requestId);

    if (isset($_GET['view'])) :
      foreach ($requests as $request) :
?>
        <tr>
          <td><?php echo '00' . $request->id ?></td>
          <td><?php echo $request->item_name != '' ? $request->item_name : 'Not set' ?></td>
          <td class="text-center"><?php echo $request->quantity != '' ? $request->quantity : 'Not Set' ?></td>
          <td class="text-center">
            <?php switch ($request->status) {
              case '2':
                echo '<span class="badge badge-success">Unpaid</span>';
                break;
              case '3':
                echo '<span class="badge badge-danger">Unpaid</span>';
                break;
              default:
                echo '<span class="badge badge-primary">New</span>';
                break;
            } ?>
          </td>
          <td><?php echo date('M d, Y', strtotime($request->due_date)) ?></td>
          <td><?php echo date('M d, Y', strtotime($request->created_at)) ?></td>
          <td>
            <button class="btn btn-sm badge bg-warning mr-2 delete_request" data-original-title="Delete" data-id="<?php echo $request->id; ?>"><i class="ri-delete-bin-line mr-0"></i></button>
          </td>
        </tr>
      <?php endforeach;
      ?>
      <tr>
        <td colspan="7"><?php echo $request->note != '' ? $request->note : 'Message not set' ?></td>

      </tr>
    <?php endif;
  endif;

  if (isset($_GET['company_id'])) :
    $branches = Request::get_all_branches($_GET['company_id']);
    ?>
    <label class="label-control">Branch<sup class="text-danger">*</sup></label>
    <select class="form-control select2" name="branch_id">
      <option value="">-select branch-</option>
      <?php foreach ($branches as $value) : ?>
        <option value="<?php echo $value->id ?>"><?php echo $value->branch_name ?></option>
      <?php endforeach; ?>
    </select>
<?php endif;
}
