<?php

if (in_array($loggedInAdmin->admin_level, [1,2,3])) :
    $inprogress = Billing::find_by_filtering(['status' => 1, 'backlog' => 0 ]);
    $delivered = Billing::find_by_filtering([ 'status' => 2, 'backlog' => 0 ]);
    $backlog_count = Billing::find_by_filtering([ 'status' => 1, 'backlog' => 1 ]);
else :
    $inprogress = Billing::find_by_filtering(['company_id' => $loggedInAdmin->company_id, 'branch_id' => $loggedInAdmin->branch_id, 'status' => 1  ]);
    $delivered = Billing::find_by_filtering(['company_id' => $loggedInAdmin->company_id, 'branch_id' => $loggedInAdmin->branch_id,  'status' => 2 ]);
    $backlog_count = Billing::find_by_filtering(['company_id' => $loggedInAdmin->company_id, 'branch_id' => $loggedInAdmin->branch_id, 'status' => 1, 'backlog' => 1 ]);
endif;

$due = Billing::find_due_date();

?>
<div class="bg-primary card">
  <div class="rounded  left-list">
    <a class="<?php if ($page_title == 'New Invoice') {
                echo 'active';
              } ?>" href="<?php echo url_for('/invoice/index.php') ?>">Add New Receipts</a>
    <a class="<?php if ($page_title == 'In Progress ') {
                echo 'active';
              } ?>" href="<?php echo url_for('/invoice/all_invoices.php?backlog=0&status=1') ?>">In Progress <span class="float-right fs-12"><?php echo Count($inprogress) ?></span></a>
    <a class="<?php if ($page_title == 'Delivered') {
                echo 'active';
              } ?>" href="<?php echo url_for('/invoice/all_invoices.php?backlog=0&status=2') ?>">Delivered <span class="float-right fs-12"><?php echo Count($delivered) ?></span></a>
    <a class="<?php if ($page_title == 'Backlog') {
                echo 'active';
              } ?>" href="<?php echo url_for('/invoice/all_invoices.php?backlog=1&status=1') ?>">Backlog <span class="float-right fs-12"><?php echo Count($backlog_count) ?></span></a>
    <!-- <a class="<?php //if ($page_title == 'Due Invoices') { echo 'active';  } ?>" href="<?php // echo url_for('/invoice/dueinvoices.php') ?>">Due Receipts <span class="float-right fs-12"> -->
        <?php //echo Count($due) ?> 
    <!-- </span></a> -->
    <!-- a class="<?php //if ($page_title == 'Cleared') { echo 'active'; } ?>" href="<?php //echo url_for('/invoice/cleared.php') ?>">Cleared Check<span class="float-right fs-12"></span></a> -->
  </div>
</div>