<div class="text-danger text-center bg-light d-flex justify-content-center">
<?php //echo $errors; ?>
<?php echo display_errors($expenses->errors); ?>
</div>
<div class=" d-flex justify-content-center mn-4">
  <?php echo display_session_message(); ?>
</div>
<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
    <!-- <input type="hidden" name="spos_token" value="3ba37286989b610e0438dbdf40dbc73b" />                 -->

    <div class="form-group">
        <label for="date">Date</label>                                
        <input type="text" name="expenses[date]" value="<?php echo h($expenses->date); ?>"  class="form-control datetimepicker" id="date" required="required" />
    </div>
    
    <div class="form-group">
        <label for="reference">Item bought</label>                                
        <input required="" type="text" name="expenses[item]" value="<?php echo h($expenses->item); ?>"  class="form-control tip" id="item" />
    </div>

    <div class="form-group">
        <label for="amount">Amount</label>                                
        <input name="expenses[amount]" type="text" id="amount" value="<?php echo h($expenses->amount); ?>" class="pa form-control kb-pad amount"
        required="required"/>
    </div>

    <div class="form-group">
        <label for="attachment">Receipt (optional)</label>                                
        <input id="attachment" type="file" name="file[]" data-show-upload="false" data-show-preview="false"
        class="form-control file">
    </div>

    <div class="form-group">
        <label for="note">Note</label>                                
        <textarea name="expenses[note]" cols="40" rows="10"  class="form-control redactor" id="note"><?php echo h($expenses->note); ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="Add Expense"  class="btn btn-primary" />
    </div>

</form> 