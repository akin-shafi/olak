<?php require_once('../private/initialize.php'); ?>


        <?php 
        
            $from = $_POST['from']; 
            $to = $_POST['to']; 
            foreach (Register::find_register_report(['from' => $from, 'to' => $to, 'created_by' => $loggedInAdmin->id]) as $value) { ?> 
            
            <?php //if ($value->close_time != '') { ?>
                <tr align="center">
                    <td><?php echo date('D d, Y h:i:a', strtotime($value->open_time)); ?></td>
                    <td><?php echo !empty($value->close_time) ? date('D d, Y h:i:a', strtotime($value->close_time)) : 'Not Set'; ?></td>
                   
                    <td><?php echo number_format($value->cash_in_hand,2); ?></td>
                    <td><?php echo !empty($value->total) ? number_format($value->total, 2) : 'Not Set'; ?></td>
                    <td><?php echo $value->verfication_status == 0 ? "<span class='btn-danger btn-sm badge'>Unconfirmed</span>": "<span class='btn-success btn-sm badge'>Approved</span>"; ?></td>
                    <td><button class="btn btn-success btn-sm view" data-level="<?php echo $loggedInAdmin->id ?>" data-id="<?php echo $value->id ?>">View</button></td>
                </tr>
            <?php //} ?>
        <?php } ?>
