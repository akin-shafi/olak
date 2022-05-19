<?php require_once('../../private/initialize.php'); ?>

 <?php if (isset($_POST['fetch'])) { 
  $id = $_POST['id'] ?? 1;
  ?>  
      
      <?php
          $sn = 1;
          
          $stock = WarehouseItemDetails::find_by_item_id($id);

          $arr = end($stock);
          foreach ($stock as $val) { 
          $total_stock = $val->qty_supplied + $val->initial_stock;
          $qty_left = $val->qty_left == '' ? 0 : $val->qty_left;
          ?>
          <?php if (!empty($val)) { ?>
            <tr class="text-center">
              <td><?php echo $sn++ ?>.</td>

              <td><?php echo date('D M, y h:i:a', strtotime($val->created_at)) ?></td>
              <td><?php echo date('D M, y h:i:a', strtotime($val->date_received)) ?></td>
              <td> 
                <?php echo WarehouseItem::find_by_id($val->item_id)->item_name; ?>
              </td>
              <td><?php echo $val->ref_no ?></td>
              <td><?php echo $val->initial_stock ?></td>
              <td><?php echo $val->qty_supplied ?></td>
              
              <td><?php echo $total_stock ?></td>
              <td><?php echo $currency.' '.number_format($val->unit_cost ?? 0, 2); ?></td>
              <td class="bg-maroon"><?php echo $val->sold_stock ?? '0'?></td>
              
              <td class="bg-maroon"><?php  echo $currency.' '.number_format($val->sold_stock * $val->unit_cost ?? 0, 2); ?></td>
              <td class="bg-olive"><?php echo !empty($val->qty_left) ? $val->qty_left : 0;?></td>
              <td class="bg-olive">
                <?php  $avail_amt = intval($val->unit_cost) * $qty_left; echo $currency.' '.number_format($avail_amt, 2);?></td>
              <td>
                <?php //if (in_array($loggedInAdmin->admin_level, [1,2,3])) { ?>
                    <?php  if ($val->id == $arr->id) { ?>
                      <?php if ($val->qty_left != 0) { ?>
                       
                        <button type="button" class="btn btn-sm btn-secondary oneItem" data-ref="<?php echo $val->ref_no;  ?>"  data-id="<?php echo $val->item_id;  ?>" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit Stock </button>
                      <?php } ?>
                    <?php } ?>
                <?php //} ?>
              </td>
            </tr>
          <?php }else{ ?>
            <tr>
              <td colspan="4" class="text-center"> No record Found</td>
            </tr>
          <?php } ?>
        <?php } ?>
 <?php } ?>