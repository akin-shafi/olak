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

  if (isset($_POST['edit_invoice'])) {
    $invoice_no = $_POST['invoice_num'];

    for ($i = 0; $i < count($amount); $i++) {
      $dataDesc = [
        "invoice_no"    => $invoice_no,
        "full_name"     => $_POST['full_name'],
        "due_date"      => $_POST['due_date'],
        "note"          => $_POST['note'],
        "item_name"     => $_POST['item_name'][$i],
        "unit"          => $_POST['unit'][$i],
        "quantity"      => $_POST['quantity'][$i],
        "unit"          => $_POST['unit'][$i],
      ];

      if (!empty(Request::find_by_invoice($invoice_no)[$i])) :
        $proRequest = Request::find_by_invoice($invoice_no)[$i];

        $proRequest->merge_attributes($data);
        $proRequest->save();
      else :
        $invoice_no = "PRO-" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;

        $data = [
          "invoice_no"    => $invoice_no,
          "full_name"     => $_POST['full_name'],
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

  if (isset($_POST['delete_invoice'])) {
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
      </tr>
    <?php endforeach; ?>
    <tr>
      <td><?php echo $request->note != '' ? $request->note : 'Message not set' ?></td>

    </tr>
<?php endif;
}
