<?php require_once('../../../private/initialize.php');

if (is_post_request()) {
  $uploadDir = '../uploads/';

  if (isset($_POST['new_expense'])) {
    $args = $_POST;

    for ($i = 0; $i < count($args['title']); $i++) {
      $data = [
        "company_id"    => $loggedInAdmin->company_id,
        "branch_id"     => $args['branch_id'],
        "title"         => $args['title'][$i],
        "quantity"      => $args['quantity'][$i],
        "amount"        => $args['amount'][$i],
        "narration"     => $args['narration'][$i],
        "created_by"    => $loggedInAdmin->id,
      ];

      $expense = new Expense($data);
      $expense->save();
    }


    if ($expense == true) :
      exit(json_encode(['success' => true, 'msg' => 'Expenses created successfully!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($expense->errors)]));
    endif;
  }

  if (isset($_POST['edit_expense'])) {
    $expId = $_POST['expId'];
    $args = $_POST;
    $expense = Expense::find_by_id($expId);

    for ($i = 0; $i < count($args['title']); $i++) {
      $data = [
        "branch_id"     => $args['branch_id'],
        "title"         => $args['title'][$i],
        "quantity"      => $args['quantity'][$i],
        "amount"        => $args['amount'][$i],
        "narration"     => $args['narration'][$i],
        "updated_at"    => date('Y-m-d H:i:s'),
      ];

      $expense->merge_attributes($data);
      $expense->save();
    }

    if ($expense == true) :
      exit(json_encode(['success' => true, 'msg' => 'Expenses updated successfully!']));
    endif;
  }

  if (isset($_POST['delete_expense'])) {
    $expId = $_POST['expId'];
    $expense = Expense::find_by_id($expId);
    $expense::deleted($expId);

    if ($expense == true) :
      exit(json_encode(['success' => true, 'msg' => 'Expenses deleted successfully!']));
    endif;
  }
}


if (is_get_request()) {
  if (isset($_GET['get_expense'])) :
    $expId = $_GET['expId'];
    $expense = Expense::find_by_id($expId);
    exit(json_encode(['success' => true, 'data' => $expense]));
  endif;

  // if (isset($_GET['get_rate'])) :
  //   $expId = $_GET['pName'];
  //   $data = Product::find_by_name($expId);
  //   exit(json_encode(['success' => true, 'data' => $data]));
  // endif;



  if (isset($_GET['filter'])) :

    $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : $loggedInAdmin->branch_id;

    $rangeText = $_GET['rangeText'];
    $explode = explode('- ', $rangeText);
    $dateFrom = $explode[0];
    $dateTo = $explode[1];
    $dateConvertFrom = date('Y-m-d', strtotime($dateFrom));
    $dateConvertTo = date('Y-m-d', strtotime($dateTo));

    $expenses = Expense::find_by_expenses($dateConvertFrom, $dateConvertTo, ['company' => $loggedInAdmin->company_id, 'branch' => $branch]);
    $totalExpenses = Expense::get_total_expenses($dateConvertFrom, $dateConvertTo, ['company' => $loggedInAdmin->company_id, 'branch' => $branch])->total_amount;

    $filterDate = $dateConvertFrom != date('Y-m-d') ? $rangeText : date('d-m-Y');
    $access = AccessControl::find_by_user_id($loggedInAdmin->id);
?>

    <div>
      <div class="d-flex justify-content-between align-items-center">
        <h3>Incurred Expenses (<?php echo $filterDate ?>)</h3>
        <h3>Total: <span class="text-danger"><?php echo $currency . ' ' . number_format($totalExpenses) ?></span></h3>
      </div>

      <div class="table-responsive">
        <table class="table custom-table table-sm dataTable">
          <thead>
            <tr class="bg-primary text-white text-center">
              <th>SN</th>
              <th>Title</th>
              <th>Quantity</th>
              <th>Amount (<?php echo $currency ?>)</th>
              <th>Narration</th>
              <th>Created At</th>
              <?php if ($access->expenses_mgt == 1) : ?>
                <th>Action</th>
              <?php endif; ?>
            </tr>
          </thead>

          <tbody>
            <?php $sn = 1;
            foreach ($expenses as $data) : ?>
              <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo ucwords($data->title); ?></td>
                <td class="text-right"><?php echo $data->quantity; ?></td>
                <td class="text-right"><?php echo number_format($data->amount); ?></td>
                <td><?php echo ucfirst($data->narration); ?></td>
                <td><?php echo date('D, j M, Y', strtotime($data->created_at)); ?></td>

                <?php if ($access->expenses_mgt == 1) : ?>
                  <td>
                    <div class="btn-group">
                      <?php if ($access->edit_exp == 1) : ?>
                        <button class="btn btn-sm btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#expenseModel">
                          <i class="icon-edit1"></i>Edit</button>
                      <?php endif; ?>
                      <?php if ($access->delete_exp == 1) : ?>
                        <button class="btn btn-sm btn-danger remove-btn" data-id="<?php echo $data->id; ?>">
                          <i class="icon-trash"></i>Delete
                        </button>
                      <?php endif; ?>
                    </div>
                  </td>
                <?php endif; ?>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

<?php
  endif;
}
