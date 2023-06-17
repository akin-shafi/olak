<?php require_once('../../../private/initialize.php'); 

$branch_id =  $_POST['branch_id'] ?? $loggedInAdmin->branch_id;
$from = $_POST['from'] ?? date("Y-m-01");
$to = $_POST['to'] ?? date("Y-m-d");

?>

 <?php //if($from != ''){?>
       
  <?php $sn = 1;
  foreach (Invoice::filter_option(['branch_id' => $branch_id, 'from' => $from, 'to' => $to, ]) as $value) : 
    $client_id = Billing::find_by_invoice_no($value->transid)->client_id;

    $customer_name = Client::find_by_id($client_id)->full_name();
    $product_name = Product::find_by_id($value->service_type)->pname;

    $qbacklog = Billing::find_by_invoice_no($value->transid)->backlog ?? 0;
    $status = Billing::find_by_invoice_no($value->transid)->status ?? 0;
    $trans_status = $qbacklog == 0 && $status == 1  ? 'Not yet' : 'Supplied'; 
    // $trans_status = 0;
  ?>
    <tr>
      <td><?php echo $sn++ ?></td>
      <td><?php echo $value->transid; ?></td>
      <td><?php echo date('Y-m-d', strtotime($value->created_at)); ?></td>
      <td><?php echo $customer_name; ?></td>
      <td><?php echo $product_name; ?></td>
      <td><?php echo $value->unit_cost; ?></td>
      <td><?php echo $value->quantity; ?></td>
      <td><?php echo $value->amount; ?></td>
      <td><?php echo $trans_status; ?></td>
    </tr>
  <?php endforeach; ?>

