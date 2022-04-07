<?php
$clients = Billing::find_all();
$due = Billing::find_due_date();

?>
<div class="bg-primary card">
  <div class="rounded  left-list">
    <a class="<?php if ($page_title == 'New Invoice') {
                echo 'active';
              } ?>" href="<?php echo url_for('/invoice/index.php') ?>">Add New Invoice</a>
    <a class="<?php if ($page_title == 'All Invoices') {
                echo 'active';
              } ?>" href="<?php echo url_for('/invoice/all_invoices.php') ?>">All Invoices <span class="float-right fs-12"><?php echo Count($clients) ?></span></a>
    <a class="<?php if ($page_title == 'Due Invoices') {
                echo 'active';
              } ?>" href="<?php echo url_for('/invoice/dueinvoices.php') ?>">Due Invoices <span class="float-right fs-12">
        <?php echo Count($due) ?>
      </span></a>
    <a class="<?php if ($page_title == 'Cleared') {
                echo 'active';
              } ?>" href="<?php echo url_for('/invoice/cleared.php') ?>">Cleared Check<span class="float-right fs-12"></span></a>
  </div>
</div>