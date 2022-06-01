<?php require_once('../../private/initialize.php'); ?>
<link rel="stylesheet" media="print" href="<?php echo url_for('/assets/dist/css/printer-80mm.css') ?>">
<body class="receipt">
  <section class="sheet padding-10mm"> 
        <div id="receiptData">
        <?php if(isset($_POST['fetch'])) { 
          $from = $_POST['from'] ?? date('Y-m-d');
          // $to = $_POST['to'] ?? date('Y-m-d'); 
            if(isset($_POST['close_reg'])){
                $created_by = $_POST['created_by'] ?? $loggedInAdmin->id;
            }else{
                $created_by = $_POST['created_by'] ?? "";
            }
            if ($created_by != "") {
                $user = $created_by;
            }else{
                $user = null;
            }
            
        ?>
            
                <?php //if (!empty($current_register)) { ?>

                <div class="modal-content">
                         <div class="modal-header">
                             <button type="button" class="close" data-dismiss="modal" aria-text="true"><i class="fa fa-times"></i></button>
                             <a href="<?php echo url_for('/reports/print_sales_order.php?created_by=' .$created_by.'&'.'from='.$from) ?>"  class="close mr10" >
                              <i class="fa fa-print"></i></a>
                             
                             <h4 class="modal-title" id="myModalLabel"><?php echo $created_by != "" ? Admin::find_by_id($user)->full_name() : "All"; ?> (Sales Order Record for - <?php echo date('D d M Y', strtotime($from))  ?>)</h4>
                            
                         </div>
                         <div class="modal-body">
                            <form id="form">
                                <div id="list-table">
                                     <table  class="table">
                                      <thead>
                                        <tr style="font-weight: bolder;" class="bg-success">
                                            <td>Item</td>
                                            <td>Price</td>
                                            <td>Qunatity</td>
                                            <td>Total</td>
                                          </tr>
                                      </thead>
                                     <tbody>
                                         <?php foreach (Product::find_by_undeleted(['order' => 'ASC']) as  $value) { 
                                          
                                          if ($created_by != "") {
                                            $sales = Sales::find_all_by_product_id(['product_id' => $value->id,'created_by'=>  $created_by,'from'=>  $from]);
                                          }else{
                                            $sales = Sales::find_all_by_product_id(['product_id' => $value->id,'from'=>  $from]);
                                          }
                                          
                                          $qty = $sales ?? 0;
                                          $subtotal = $qty * $value->price ?? 0;
                                          ?>
                                          
                                                <?php if ($value->ref_no != "" ) { ?>
                                                       <?php if ($qty != 0) { ?>
                                                           <tr style="border-bottom: 1px solid #EEE;">
                                                               <td style="font-weight: bolder;"><span data-item='<?php echo $value->id; ?>' class="item" style="cursor: pointer; text-decoration: underline;"><?php echo $value->pname; ?></span>:</td>
                                                               <td><?php echo $value->price ?></td>
                                                               <td><?php echo $qty ?></td>
                
                                                               <td class="subtotal"><?php echo $subtotal;  ?></td>
                                                           </tr>
                                                        <?php } ?>
                                                 <?php } ?>
                                             <?php } ?>
                                             <tr style="font-weight: bolder;">
                                                 <td></td>
                                                 <td align="right">Grand Total</td>
                                                 <td><span id="grand_total">0</span></td>
                                               </tr>
                                        </tbody>

                                     </table>
                                 </div>
                                
                            </form>
                         </div>
                    </div>
                <?php //}else{?>
                    <!-- <div class='text-center' style='font-size: 30px;'>No record Found <a href=""></a></div> -->
                <?php //} ?>
        <?php } ?>
        </div>
    </section>
</body>


<script type="text/javascript">

  function formatToCurrency(amount){
      return (amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
  }


  sumOfReturn();
  function sumOfReturn(){
    var count = [];
    $('.subtotal').each(function() {
          var item = $(this).text();
          
          count.push(parseInt(item));
          
    });
    const sum = count.reduce((a, b) => a + b, 0);
    var amt2 = formatToCurrency(sum); //"12.35"
    // $("#value_of_sold").text(amt2);
    $("#grand_total").text(amt2);


  }

  

 
</script>


