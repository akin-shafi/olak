
<?php 
   if ($page_title == 'Sales') {
     $url = url_for('/sales/index.php?id=' . h(u($id)));
   }else{
      $url = "";
   }

   
 ?>
 <input type="hidden" id="trans_no" value="<?php echo $transaction->trans_no ?>">
 <form action="<?php echo $url ?>" method="post" accept-charset="utf-8">
    <!-- <input type="hidden" name="spos_token" value="49838b1047939f60a39bb3ba432c9cd5" /> -->
     <div class="col-md-6">
        <table class="table table-borderless">
          <tr><td>Date:</td> <td><?php echo date('D d M Y h:i:a', strtotime($transaction->created_at)); ?></td></tr>
          <tr><td>Trans No:</td> <td><?php echo $transaction->trans_no ?></td></tr>
          <tr><td>Customer Name:</td> 
            <td>
             <?php 
                if($transaction->customer_id == 0){
                  echo "Walk-in Customer";
                }else{
                  echo Customer::find_by_id($transaction->customer_id)->full_name();
                }
              ?>
          </td></tr>
          <tr><td>Sales Person:</td> <td><?php echo Admin::find_by_id($transaction->created_by)->full_name(); ?></td></tr>

        </table>
     </div>

    <div class="col-md-12">
       
       <table class="table table-bordered">
          <thead>
            <tr>
              <th>SN</th>
              <th>Item</th>
              <th>Unit Price</th>
              <th>Quantity</th>
              <th>Subtotal</th>
              <th>Returned Items</th>
            </tr>
          </thead>
          <tbody id="show_record">
             
         </tbody>
       </table>


        <div class="form-group">
          <input type="submit"  value="Edit Sales"  class="btn btn-primary pull-right" />
        </div>
    </div>
</form> 

<script type="text/javascript">
  $(document).ready(function () {
      load_data()
      
      function load_data(){
        var trans = $('#trans_no').val();
        $.ajax({
              url: 'inc/fetch_edit_cart.php',
              method: 'post',
              data: {
                 fetch_record: 1,
                 trans_no: trans,
              },
              success: function(data) {
                 $('#show_record').html(data);

                            
              }
          });
      }

      $(document).on('change', '.returned', function(){

         var product_id = $(this).data('id');
         var returned_item = $('#returned_item'+product_id+'').val();
         var total_price = $('#total_price'+product_id+'').val();
         var unit_price = $('#unit_price'+product_id+'').val();
         // var product_quantity = $('#quantity'+product_id+'').val() ;

         var q = $('#q'+product_id+'').val();
         var tp = $('#tp'+product_id+'').val();

         // Calculate quantity
         $('#quantity'+product_id+'').val(q - returned_item)

         // Calculate Price
         var value = unit_price * returned_item;
         $('#total_price'+product_id+'').val(tp - value);
         


           
      });



  });

 
</script>

