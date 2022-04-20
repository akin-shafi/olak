<?php require_once('../../private/initialize.php');

if (is_post_request()) {
    $uploadDir = '../uploads/';

    if (isset($_POST['new_remit'])) {
        $args = $_POST;

        for ($i = 0; $i < count($args['amount']); $i++) {
            $data = [
                "narration"     => $args['narration'][$i],
                "quantity"      => $args['quantity'][$i],
                "rate"          => $args['rate'][$i],
                "amount"        => $args['amount'][$i],
                "created_by"    => $loggedInAdmin->id,
            ];

            $remit = new Remittance($data);
            $remit->save();
        }


        if ($remit == true) :
            exit(json_encode(['success' => true, 'msg' => 'Sales remitted successfully!']));
        else :
            exit(json_encode(['success' => false, 'msg' => display_errors($remit->errors)]));
        endif;
    }

    if (isset($_POST['edit_remit'])) {
        $remId = $_POST['remId'];
        $args = $_POST;
        $remit = Remittance::find_by_id($remId);

        for ($i = 0; $i < count($args['amount']); $i++) {
            $data = [
                "narration"     => $args['narration'][$i],
                "quantity"      => $args['quantity'][$i],
                "rate"          => $args['rate'][$i],
                "amount"        => $args['amount'][$i],
                "updated_at"    => date('Y-m-d H:i:s'),
            ];

            $remit->merge_attributes($data);
            $remit->save();
        }

        if ($remit == true) :
            exit(json_encode(['success' => true, 'msg' => 'Remitted sales updated successfully!']));
        endif;
    }

    if (isset($_POST['delete_remit'])) {
        $remId = $_POST['remId'];
        $remit = Remittance::find_by_id($remId);
        $remit::deleted($remId);

        if ($remit == true) :
            exit(json_encode(['success' => true, 'msg' => 'Remitted sales deleted successfully!']));
        endif;
    }
}


if (is_get_request()) {
    if (isset($_GET['get_remit'])) :
        $remId = $_GET['remId'];
        $remit = Remittance::find_by_id($remId);
        exit(json_encode(['success' => true, 'data' => $remit]));
    endif;
}
