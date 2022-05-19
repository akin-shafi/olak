<?php require_once('../../private/initialize.php'); ?>

 <?php if (isset($_POST['fetch'])) { ?> 
      
      <?php //$today = $_POST['date']; ?>
      <?php
        $sn = 1;
        foreach (KitchenStockDetails::find_by_date(['order' => 'DESC']) as $KitchenItem) { 
        $total_stock = $KitchenItem->supply + $KitchenItem->initial_stock;
        // $closing_stock = $total_stock - $KitchenItem->sold_stock ?? '0';
        ?>
        <?php if (!empty($KitchenItem)) { ?>
          <tr class="text-center">
            <td><?php echo $sn++ ?>.</td>
            <td><?php echo date('D M, y h:i:a', strtotime($KitchenItem->created_at)) ?></td>
            <td> 
              <!-- <?php //if(in_array($loggedInAdmin->admin_level, [1,5])){ ?>
                <a class="oneItem" href="#" style="text-decoration: underline;" data-id="<?php //echo $KitchenItem->id ?>">
                  <?php //echo Products::find_by_id($Products->item_id)->name; ?>
                </a>
              <?php //}else{ ?>
                  <?php //echo Products::find_by_id($KitchenItem->item_id)->name; ?>
              <?php //} ?> -->
              <?php echo Products::find_by_id($KitchenItem->item_id)->name; ?>
            </td>
            <td><?php echo $KitchenItem->ref_no ?></td>
            <td><?php echo $KitchenItem->initial_stock ?></td>
            <td><?php echo $KitchenItem->supply ?></td>
            
            <td><?php echo $total_stock ?></td>
            
            <!-- <td><?php //echo $currency.' '.number_format($KitchenItem->total_amt ?? 0, 2); ?></td> -->
            <td><?php echo $KitchenItem->sold_stock ?? '0'?></td>
            <td><?php echo $currency.' '.number_format($KitchenItem->unit_price ?? 0, 2); ?></td>
            <td><?php echo $currency .' '.number_format($KitchenItem->sold_stock_amt ?? 0, 2) ?? '0' ?></td>
            <td><?php echo $KitchenItem->qty_left;?></td>

          </tr>
        <?php }else{ ?>
          <tr>
            <td colspan="4" class="text-center"> No record Found</td>
          </tr>
        <?php } ?>
      <?php } ?>
 <?php } ?>