<?php require_once('../../private/initialize.php'); ?>

<?php 
	 $sn = 1; 
	 $from = $_POST['from'] ?? ''; 
	 // $to = $_POST['to'] ?? ''; 
	
   foreach (Product::find_by_undeleted(['order' => 'ASC']) as  $value) { 
        $sales = Sales::find_all_by_product_id(['product_id' => $value->id,'from'=>  $from ]); 
        $stock = StockDetails::sum_of_Stock(['item_id' => $value->id, 'from' => $from]) ?? 0;
        // pre_r($stock);
     
      
      $qty = $sales ?? 0;
      $subtotal = $qty * $value->price ?? 0;
      $left_over = intval($stock - $qty);
      ?>
      
             <?php if ($value->ref_no != "" ) { ?>
                    <?php //if ($qty != 0) { ?>
                       <tr style="border-bottom: 1px solid #EEE; text-align: center;">
                           
                           <td>
                           		<a class="" href="<?php echo url_for('stock/items.php?id='.$value->id.'&'.'from='.$from.'&'.'to='.$to) ?>" style="text-decoration: underline;" data-id="<?php echo $value->id ?>">
                                            <?php echo $value->pname; ?>
                              </a>
                           </td>
                           <td><?php echo $value->price ?></td>
                           <td><?php echo $stock ?></td>
                           <td class="bg-success"><?php echo $qty ?></td>

                           <td class=" bg-success">
                                <?php echo $subtotal;  ?>
                                <input class="soldValue" type="hidden" value="<?php echo $subtotal ?>">
                            </td>
                           
                           <td class="bg-red"><?php echo $left_over ?></td>
                           <td class=" bg-red">
                            <?php echo number_format($left_over * $value->price , 2)?>
                                <input class="returnValue" type="hidden" value="<?php echo $left_over * $value->price ?>">
                           </td>
                       </tr>
                    <?php //} ?>
             <?php } ?>
 <?php } ?>
         <tr style="font-weight: bolder;">
             <td></td>
             <td align="right">Grand Total</td>
             <td><span id="grand_total">0</span></td>
           </tr>
    

<input type="hidden" id="currency" value="<?php echo $currency ?>">
<script type="text/javascript">

  function formatToCurrency(amount){
      return (amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
  }


  sumOfReturn();
  function sumOfReturn(){
  	var currency = $('#currency').val();
    // var count = [];
    // $('.leftover').each(function() {
    //       var item = $(this).text();
          
    //       count.push(parseInt(item));
          
    // });
    // const sum = count.reduce((a, b) => a + b, 0);
    // $("#sum_of_return").text(sum);







    // Calculate reurn value
    var count1 = [];
    $('.returnValue').each(function() {
          var item1 = $(this).val();
          
          count1.push(parseInt(item1));
          
    });
    const add1 = count1.reduce((a, b) => a + b, 0);
    var amt1 = formatToCurrency(add1); //"12.35"
    $("#value_of_return").text(currency + amt1);











    // Calculate Sold value
    var count2 = [];
    $('.soldValue').each(function() {
          var item2 = $(this).val();
          
          count2.push(parseInt(item2));
          
    });
    const add2 = count2.reduce((a, b) => a + b, 0);
    var amt2 = formatToCurrency(add2); //"12.35"
    $("#value_of_sold").text(currency + amt2);

  }
</script>


