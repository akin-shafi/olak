<?php require_once('../../../private/initialize.php'); ?>

<?php if (isset($_POST['fetch'])) { 
  $id = $_POST['id'] ?? 1;
  $from = $_POST['from'] ?? 1;
  $to = $_POST['to'] ?? 1;
  ?>

<?php
          $sn = 1;
          
          $stock = StockDetails::find_by_date([ 
            'item_id' => $id, 
            'from' => $from, 'to' => $to, 
            'order' => 'ASC']);
         
          $arr = end($stock);
          foreach ($stock as $val) { 
            // $supply_val = number_format(Product::find_by_id($val->item_id)->price  * $val->supply, 2) ;
            $supply_val = Product::find_by_id($val->item_id)->price  * $val->supply;
          ?>
<?php if (!empty($val)) { ?>
<tr class="text-center">
    <td><?php echo $sn++ ?>.</td>
    <td><?php echo date('d/m/y h:i:a', strtotime($val->created_at)) ?></td>
    <td>
        <?php echo Product::find_by_id($val->item_id)->pname; ?>
    </td>
    <td><?php echo $val->ref_no ?></td>
    <td> <span class="supply"><?php echo $val->supply ?></span></td>
    <td>
        <span class="supply_val"><?php echo $supply_val ?></span>
    </td>

    <td>
        <?php  if ($val->id == $arr->id) { ?>
        <?php if ($val->qty_left != 0) { ?>

        <button type="button" class="btn btn-sm btn-secondary oneItem" data-ref="<?php echo $val->ref_no;  ?>"
            data-id="<?php echo $val->item_id;  ?>" data-toggle="modal" data-target="#editModal"><i
                class="fa fa-pencil"></i> Edit Stock </button>
        <?php } ?>
        <?php } ?>
    </td>
</tr>

<?php }else{ ?>
<tr>
    <td colspan="4" class="text-center"> No record Found</td>
</tr>
<?php } ?>
<?php } ?>
<?php } ?>

<script type="text/javascript">
function formatToCurrency(amount) {
    return (amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}


sumOfReturn();

function sumOfReturn() {
    var count = [];
    $('.supply').each(function() {
        var item = $(this).text();

        count.push(parseInt(item));

    });

    const sum = count.reduce((a, b) => a + b, 0);
    $("#sum_of_supply").text(sum);



    // Calculate reurn value
    var count1 = [];
    $('.supply_val').each(function() {
        var item1 = $(this).text();

        count1.push(parseInt(item1));

    });
    const add1 = count1.reduce((a, b) => a + b, 0);
    var amt1 = formatToCurrency(add1); //"12.35"

    $("#value_of_supply").text(amt1);




    // // Calculate Sold value
    // var count2 = [];
    // $('.soldValue').each(function() {
    //       var item2 = $(this).val();

    //       count2.push(parseInt(item2));

    // });
    // const add2 = count2.reduce((a, b) => a + b, 0);
    // var amt2 = formatToCurrency(add2); //"12.35"
    // $("#value_of_sold").text(amt2);
}
</script>