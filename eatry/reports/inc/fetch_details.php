<?php require_once('../../private/initialize.php'); ?>

 <?php if (isset($_POST['fetch'])) { 
  $id = $_POST['id'] ?? 1;
  $from = $_POST['from'] ?? date('Y-m-d');
  ?>  
      
      <?php
          $sn = 1;
          
          $stock = StockDetails::find_by_deleted_item(['item_id' => $id, 'from' => $from]);

          $arr = end($stock);
          foreach ($stock as $val) { 
          $total_stock = $val->supply + $val->initial_stock;
          $qty_left = $val->qty_left == '' ? 0 : $val->qty_left; 
          $value_of_avail = intval($val->unit_price) * $qty_left;
          $value_of_sold = $val->sold_stock * $val->unit_price ?? 0;
          $unit_price = $val->unit_price ?? 0;
          $sold_stock = $val->sold_stock ?? 0;
          ?>
          <?php if (!empty($val)) { ?>
            <tr class="text-center">
              <td><?php echo $sn++ ?>.</td>
              <td><?php echo date('d/m/y h:i:a', strtotime($val->created_at)) ?></td>
              <td> 
                <?php echo Product::find_by_id($val->item_id)->pname; ?>
              </td>
              <td><?php echo $val->ref_no ?></td>
              <td><?php echo $val->initial_stock ?></td>
              <td><?php echo $val->supply ?></td>
              
              <td><?php echo $total_stock ?></td>
              <td><?php echo $currency.' '.number_format($unit_price, 2); ?></td>
              <td class="bg-yellow"><?php echo $sold_stock ?></td>
              
              <td class="bg-yellow"><?php  echo $currency.' '.number_format($value_of_sold, 2)?></td>
              <td class="bg-green"><?php echo $qty_left ?? '';?></td>
              <td class="bg-green">
                <?php   echo $currency.' '.number_format($value_of_avail, 2);?></td>
              
            </tr>
          <?php }else{ ?>
            <tr>
              <td colspan="4" class="text-center"> No record Found</td>
            </tr>
          <?php } ?>
        <?php } ?>
 <?php } ?>