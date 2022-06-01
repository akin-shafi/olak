<?php require_once('../../../private/initialize.php'); ?>

 <?php if (isset($_POST['fetch'])) { 
  $id = $_POST['id'] ?? 1;
  ?>  
      
      <?php
          $sn = 1;
          
          $stock = StockDetails::find_by_item_id($id);

          $arr = end($stock);
          foreach ($stock as $val) { 
          $total_stock = $val->supply + $val->initial_stock;
          // $closing_stock = $total_stock - $val->sold_stock ?? '0';
          ?>
          <?php if (!empty($val)) { ?>
            <tr class="text-center">
              <td><?php echo $sn++ ?>.</td>
              <td><?php echo date('D M, y h:i:a', strtotime($val->created_at)) ?></td>
              <td> 
                <!-- <?php //if(in_array($loggedInAdmin->admin_level, [1,5])){ ?>
                  <a class="oneItem" href="#" style="text-decoration: underline;" data-id="<?php //echo $val->id ?>">
                    <?php //echo Products::find_by_id($Products->item_id)->name; ?>
                  </a>
                <?php //}else{ ?>
                    <?php //echo Products::find_by_id($val->item_id)->name; ?>
                <?php //} ?> -->
                <?php echo Product::find_by_id($val->item_id)->pname; ?>
              </td>
              <td><?php echo $val->ref_no ?></td>
              <td><?php echo $val->initial_stock ?></td>
              <td><?php echo $val->supply ?></td>
              
              <td><?php echo $total_stock ?></td>
              
              <!-- <td><?php //echo $currency.' '.number_format($val->total_amt ?? 0, 2); ?></td> -->
              <td><?php echo $currency.' '.number_format($val->unit_price ?? 0, 2); ?></td>
              <td class="bg-yellow"><?php echo $val->sold_stock ?? '0'?></td>
              
              <td class="bg-yellow"><?php  echo $currency.' '.number_format($val->sold_stock * $val->unit_price ?? 0, 2)

              //echo $currency .' '.number_format($val->sold_stock_amt ?? 0, 2) ?? '0' ?></td>
              <td class="bg-green"><?php echo !empty($val->qty_left) ? $val->qty_left : 0;?></td>
              <td class="bg-green"><?php echo $currency.' '.number_format(!empty($val->qty_left) ? $val->qty_left : 0 * $val->unit_price ?? 0, 2);?></td>
              <td>
                <?php if (in_array($loggedInAdmin->admin_level, [1])) { ?>
                    <?php  if ($val->id == $arr->id) { ?>
                      <button type="button" class="btn btn-sm btn-secondary oneItem" data-ref="<?php echo $val->ref_no;  ?>"  data-id="<?php echo $val->item_id;  ?>" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit Stock </button>
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