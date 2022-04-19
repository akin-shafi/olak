<?php require_once('../../private/initialize.php');

if (is_post_request()) {
    $uploadDir = '../uploads/';

    if (isset($_POST['new_expense'])) {
        $args = $_POST;

        for ($i = 0; $i < count($args['expense_type']); $i++) {
            $data = [
                "expense_type"  => $args['expense_type'][$i],
                "product"       => $args['product'][$i],
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

        for ($i = 0; $i < count($args['expense_type']); $i++) {
            $data = [
                "expense_type"  => $args['expense_type'][$i],
                "product"       => $args['product'][$i],
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

    if (isset($_GET['get_rate'])) :
        $expId = $_GET['pName'];
        $data = Product::find_by_name($expId);
        exit(json_encode(['success' => true, 'data' => $data]));
    endif;
}
