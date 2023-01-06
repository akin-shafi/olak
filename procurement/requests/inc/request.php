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
    $request = Request::find_by_id($requestId);

    $result = $request::deleted($requestId);

    if ($result == true) {
      $requestDetails = RequestDetail::find_by_requests($requestId);
      foreach ($requestDetails as $value) {
        RequestDetail::find_by_id($value->id)::deleted($value->id);
      }
    }

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
          <p class="text-muted text-uppercase mb-0">More details</p>
          <?php echo $request->note != '' ? $request->note : 'Message not set' ?>
          <?php if ($request->vendor_img != '') : ?>
            <div style="width:100px;" class="my-3 d-none">
              <img src="uploads/vendors/<?php echo $request->vendor_img ?>" class="img-fluid" onclick="enlargeImg(this)" alt="Additional upload">
            </div>
          <?php endif; ?>
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


  if (isset($_GET['request_by_branch'])) :
    $branchId = $_GET['branch_id'];
    $selectedDate = $_GET['selected_date'];
    $dateExp = explode('/', $selectedDate);

    $totalPending = $branchId != ''
      ? Request::find_total_amount_by_status(['branch_id' => $branchId, 'selected_date' => $dateExp, 'status' => 1])
      : Request::find_total_amount_by_status(['status' => 1]);

    $totalDelivered = $branchId != ''
      ? Request::find_total_amount_by_status(['branch_id' => $branchId, 'selected_date' => $dateExp, 'status' => 2])
      : Request::find_total_amount_by_status(['status' => 2]);

    $requests = $branchId != ''
      ? Request::find_all_requests(['branch_id' => $branchId, 'selected_date' => $dateExp])
      : Request::find_all_requests();

    foreach ($requests as $data) :
      $branch = Branch::find_by_id($data->branch_id)->name; ?>
      <tr>
        <td>
          <a href="<?php echo url_for('invoice.php?invoice_no=' . $data->invoice_no) ?>">
            <?php echo $data->invoice_no ?>
          </a>
        </td>
        <td><?php echo $data->full_name ?></td>
        <td><?php echo $branch ?></td>
        <td class="text-center">
          <?php echo $data->quantity != '' ? number_format($data->quantity) : 'Not Set' ?>
        </td>
        <td><?php echo number_format(intval($data->grand_total)) ?></td>
        <td class="text-center">
          <?php foreach (Request::STATUS as $key => $value) :
            $color = RequestDetail::COLOR[$key];

            if ($key == $data->status) :
          ?>
              <span class="badge badge-<?php echo $color; ?>">
                <?php echo $value ?>
              </span>
          <?php endif;
          endforeach; ?>
        </td>
        <td><?php echo date('M d, Y', strtotime($data->due_date)) ?></td>
        <td><?php echo date('M d, Y', strtotime($data->created_at)) ?></td>
        <td>
          <div class="d-flex align-items-center list-action">
            <button class="btn btn-sm badge badge-info view-btn mr-2 position-relative" data-invoice="<?php echo $data->invoice_no; ?>" data-toggle="modal" data-target="#view-request">
              <i class="ri-eye-line mr-0"></i>
              <span class="d-flex justify-content-center rounded-circle align-items-center bg-danger text-white p-2" style="width:10px;height:10px;position:absolute;top:-6px;right:-5px"><?php echo $data->counts; ?></span>
            </button>

            <?php if (!isset($_GET['report'])) : ?>
              <a href="<?php echo url_for('requests/edit-request.php?invoice_no=' . $data->invoice_no) ?>" class="btn btn-sm badge bg-success mr-2"><i class="ri-pencil-line mr-0"></i></a>
            <?php endif; ?>

            <?php if ($access->change_status ?? 0) : ?>
              <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v mr-0"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <?php foreach (Request::STATUS as $key => $value) :
                    if ($value == 'New') continue;
                  ?>
                    <button class="dropdown-item status" data-id="<?php echo $data->id; ?>" data-status="<?php echo $key; ?>">
                      <?php echo $value; ?>
                    </button>
                  <?php endforeach; ?>

                  <button class="dropdown-item text-center text-white delete_request d-none" data-id="<?php echo $data->id; ?>" style="background-color: red;"><i class="ri-delete-bin-line mr-0"></i>Delete</button>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
    <tr class="d-none">
      <td colspan="9">
        <p id="pending"><?php echo number_format($totalPending->grand_total); ?></p>
        <p id="deliver"><?php echo number_format($totalDelivered->grand_total); ?></p>
      </td>
    </tr>
<?php endif;
}
?>

<script>
  function enlargeImg(img) {
    img.style.transform = "scale(1.5)";
    img.style.transition = "transform 0.25s ease";
  }
</script>