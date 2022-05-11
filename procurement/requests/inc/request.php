<?php require_once('../../private/initialize.php');

$vendorDir = '../uploads/vendors/';

if (is_post_request()) {

  if (isset($_POST['new_request'])) {
    $rand = rand(10, 100);
    $new_id = 1;
    $invoice_no = "PO-" . str_pad($new_id, 3, "0", STR_PAD_LEFT) . $rand;

    $args = $_POST['req'];
    $args['invoice_no'] = $invoice_no;
    $args['created_by'] = $loggedInAdmin->id;

    if (!empty($_FILES['vend_img']['name'])) {
      $temp = explode('.', $_FILES['vend_img']['name']);
      $fileName = basename($invoice_no . '.' . end($temp));
      $targetFilePath = $vendorDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

      $allowTypes = ['jpeg', 'jpg', 'png', 'pdf'];
      if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['vend_img']['tmp_name'], $targetFilePath)) {
          $args['vendor_img'] = $fileName;
        }
      } else {
        http_response_code(404);
        $response['errors'] = 'Sorry, JPEG, JPG & PNG files are allowed to upload.';
      }
    }

    $orderRequest = new Request($args);
    $result = $orderRequest->save();

    if ($result == true) {
      $reqId = $orderRequest->id;
      $invNum = $orderRequest->invoice_no;

      $item_name = $_POST['item_name'];

      for ($i = 0; $i < count($item_name); $i++) {
        $data = [
          "request_id"    => $reqId,
          "item_name"     => $item_name[$i],
          "unit_price"    => $_POST['unit_price'][$i],
          "quantity"      => $_POST['quantity'][$i],
          "amount"        => $_POST['amount'][$i],
        ];

        $details = new RequestDetail($data);
        $result = $details->save();
      }

      exit(json_encode(['success' => true, 'message' => 'Request sent Successfully', 'invoice_no' => $invNum]));
    }
  }


  if (isset($_POST['edit_request'])) {
    $invoice_no = $_POST['invoice_no'];

    $args = $_POST['req'];

    $args['invoice_no'] = $invoice_no;
    $item_name = $_POST['item_name'];

    $getRequest = Request::find_by_invoice($invoice_no);
    $reqId = $getRequest->id;

    if (!empty(RequestDetail::find_by_requests($reqId))) :

      if (!empty($_FILES['vend_img']['name'])) {
        $dbUpload = $getRequest->vendor_img ?? '';

        if (file_exists($vendorDir . $dbUpload)) {
          unlink($vendorDir . $dbUpload);
        }

        $temp = explode('.', $_FILES['vend_img']['name']);
        $fileName = basename($invoice_no . '.' . end($temp));
        $targetFilePath = $vendorDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowTypes = ['jpeg', 'jpg', 'png', 'pdf'];
        if (in_array($fileType, $allowTypes)) {
          if (move_uploaded_file($_FILES['vend_img']['tmp_name'], $targetFilePath)) {
            $args['vendor_img'] = $fileName;
          }
        } else {
          http_response_code(404);
          $response['errors'] = 'Sorry, JPEG, JPG & PNG files are allowed to upload.';
        }
      }

      $getRequest->merge_attributes($args);
      $result = $getRequest->save();

      if ($result == true) :
        $reqId = $getRequest->id;
        $invNum = $getRequest->invoice_no;
        $requestDetails = RequestDetail::find_by_requests($reqId);

        for ($i = 0; $i < count($requestDetails); $i++) {
          $detail = RequestDetail::find_by_id($requestDetails[$i]->id);

          $data = [
            "request_id"    => $reqId,
            "item_name"     => $_POST['item_name'][$i],
            "unit_price"    => $_POST['unit_price'][$i],
            "quantity"      => $_POST['quantity'][$i],
            "amount"        => $_POST['amount'][$i],
          ];

          $detail->merge_attributes($data);
          $detail->save();
        }

        exit(json_encode(['success' => true, 'message' => 'Request sent Successfully', 'invoice_no' => $invNum]));
      endif;
    else :

      $args = $_POST['req'];

      $newRequest = new Request($args);
      $result = $newRequest->save();

      if ($result == true) {
        $invNum = $newRequest->invoice_no;

        for ($i = 0; $i < count($item_name); $i++) {
          $data = [
            "request_id"    => $reqId,
            "item_name"     => $item_name[$i],
            "unit_price"    => $_POST['unit_price'][$i],
            "quantity"      => $_POST['quantity'][$i],
            "amount"        => $_POST['amount'][$i],
          ];

          $details = new RequestDetail($data);
          $result = $details->save();
        }

        exit(json_encode(['success' => true, 'message' => 'Request sent Successfully', 'invoice_no' => $invNum]));
      }
    endif;

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
    $invoiceNumber = $_GET['iNo'];
    $request = Request::find_by_invoice($invoiceNumber);
    $requestDetails = RequestDetail::find_by_requests($request->id);

    if (isset($_GET['view'])) :
      foreach ($requestDetails as $detail) :
?>
        <tr>
          <td><?php echo '00' . $detail->id ?></td>
          <td><?php echo $detail->item_name != '' ? $detail->item_name : 'Not set' ?></td>
          <td class="text-center"><?php echo $detail->quantity != '' ? $detail->quantity : 'Not Set' ?></td>
          <td class="text-center"><?php echo number_format($detail->unit_price) ?></td>
          <td class="text-center"><?php echo number_format($detail->amount) ?></td>
        </tr>
      <?php endforeach;
      ?>
      <tr>
        <td colspan="7">
          <p class="text-muted text-uppercase mb-0">Terms & conditions</p>
          <?php echo $request->note != '' ? $request->note : 'Message not set' ?>
        </td>
      </tr>
    <?php endif;
  endif;

  if (isset($_GET['company_id'])) :
    $branches = Branch::find_all_branch(['company_id' => $_GET['company_id']]);
    ?>
    <label class="label-control">Branch<sup class="text-danger">*</sup></label>
    <select class="form-control select2" name="branch_id">
      <option value="">-select branch-</option>
      <?php foreach ($branches as $value) : ?>
        <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
      <?php endforeach; ?>
    </select>
<?php endif;

  if (isset($_GET['request_status'])) :
    $invoiceId = $_GET['invoiceId'];
    $status = $_GET['request_status'];

    $request = Request::find_by_id($invoiceId);

    $args = ['status' => $status];

    $request->merge_attributes($args);
    $request->save();

    exit(json_encode(['message' => 'Status updated successfully']));
  endif;
}
