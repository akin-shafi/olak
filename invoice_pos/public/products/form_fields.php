 <div class="col-lg-12">
   <form  id="form" class="validation" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <input type="hidden" name="exception" id="exception" value="<?php echo $product->exception ?>" />                                                                            
      <div class="row">
         <div class="col-md-6">
            <div class="row ">
               <div class="form-group col-md-6">
                  <label for="type">Type</label>                                                                
                  <select name="type" class="form-control tip select2" id="type"  required="required" style="width:100%;">
                     <option value="">Select Type</option>
                     <?php foreach (Product::PRODUCT_TYPE as $key => $value) { ?>
                         <option value="<?php echo $value; ?>" <?php echo $value == $product->type ? 'selected' : '';  ?>><?php echo $value; ?></option>
                     <?php } ?>
                  </select>
               </div>

               <div class="form-group col-md-6">
                  <label for="category">Category</label>                                                                        
                  <select name="category" class="form-control select2 tip" id="category"  required="required" style="width:100%;">
                     <option value="">Select Category</option> 
                     <?php foreach (ProductCategory::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                         <option value="<?php echo $value->id; ?>" data-exception="<?php echo $value->exception ?>" <?php echo $product->category == $value->id ? 'selected' : '';  ?>><?php echo $value->category; ?>  </option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <div class="form-group">
               <label for="name">Name</label>                                    
               <input type="text" name="pname" value="<?php echo h($product->pname); ?>"  class="form-control tip" id="name"  required="required" />
            </div>
            <div class="form-group d-none">
               <label for="code">Code</label> you can use product barcode as code 
               <span style="float: right; margin-bottom: 1px" id="gen" class="btn btn-primary btn-sm">Generate</span>                                   
               <input type="text" name="code" readonly value="<?php echo h($product->code); ?>"  class="form-control tip" id="code" required/>
            </div>
            <div class="form-group d-none">
               <label for="barcode_symbology">Barcode Symbology</label>                                    
               <select name="barcode_symbology" class="form-control select2" id="barcode_symbology" required="required" style="width:100%;">
                  <option value="">Select Barcode Symbology</option>
                  <?php foreach (Product::BARCODE_SYMBOLOGY as $key => $value) { 
                     $product->barcode_symbology = 3; 
                  ?>
                      <option value="<?php echo $key; ?>" <?php echo $product->barcode_symbology == $key ? 'selected' : '';  ?>><?php echo $value; ?></option>
                  <?php } ?>
               </select>
            </div>
            
            <div class="row">
               <div class="form-group col-md-6">
                  <label for="cost">Purchasing Price</label>                                    
                  <input type="text" name="cost" value="<?php echo h($product->cost); ?>"  class="form-control tip" id="cost" />
               </div>
               <div class="form-group col-md-6">
                  <label for="price">Selling Price: </label>                                    
                  <input type="text" name="price" value="<?php echo h($product->price); ?>"  class="form-control tip" id="price"  required="required" />
                  <input type="hidden" name="total_price" id="total_price" value="<?php echo h($product->total_price); ?>">
               </div>
            </div>
            <!-- <div class="form-group">
               <label for="per_shut"> Sell per Shut ?</label>
               <select name="per_shut" class=" form-control" id="per_shut">
                  <option value="1">No</option>
                  <option value="2">Yes</option>
               </select>
            </div> -->

            <div class="row shut_wrap d-none">
               <div class="form-group col-md-6">
                  <label for="price">Selling Price: {Per Shot}</label>                                    
                  <input type="text" name="shut_price" value="<?php echo h($product->shut_price); ?>"  class="form-control tip" id="shut_price"   />
               </div>

               <div class="form-group col-md-6">
                  <label for="price">No. of Shot in bottle</label>                                    
                  <input type="text" name="no_of_shut" value="<?php echo h($product->no_of_shut); ?>"  class="form-control tip" id="no_shut"   />
                  
               </div>
               <div  class="form-group col-md-12">
                 <span class="btn" id="t_shut"></span>
               </div>
            </div>

            <div class="form-group">
               <label for="details">Details</label>                            
               <textarea name="details" cols="5" rows="5"  class="form-control tip redactor" id="details" value="<?php echo h($product->details); ?>"><?php echo h($product->details); ?></textarea>
            </div>
           
            
         </div>
         <div class="col-md-6">
            <div id="ct" style="display:none;">
               <div class="form-group">
                  <label for="add_item">Add Products</label> 
                  <input type="text" name="add_item" value=""  class="form-control ttip" id="add_item" data-placement="top" data-trigger="focus" data-bv-notEmpty-message="Please add items below" placeholder="Add Item" />
               </div>
               <div class="control-group table-group">
                  <label class="table-label" for="combo">Combo Products</label>
                  <div class="controls table-controls">
                     <table id="prTable"
                        class="table items table-striped table-bordered table-condensed table-hover">
                        <thead>
                           <tr>
                              <th class="col-xs-9">Product Name (Product Code)</th>
                              <th class="col-xs-2">Quantity</th>
                              <th class=" col-xs-1 text-center"><i class="fa fa-trash-o trash-opacity-50"></i></th>
                           </tr>
                        </thead>
                        <tbody></tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="">
               <div class="well well-sm">
                  <!-- <h4> (Items in Store)</h4> -->
                  <div class="row">
                    <div class="form-group col-md-6">
                       <label for="quantity1">Quantity</label>
                       <input type="text" name="quantity" value="<?php echo h($product->quantity); ?>"  class="form-control tip" id="quantity1" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="alert_quantity">Alert Quantity</label>
                        <input type="text" name="alert_quantity" value="<?php echo h($product->alert_quantity); ?>"  class="form-control tip" id="alert_quantity"  required="required" />
                     </div>
                    <div class="form-group col-md-6" style="margin-bottom:0;">
                       <input type="hidden" name="left_bottle" value="<?php echo h($product->left_bottle); ?>"  class="form-control tip" id="left_bottle" />

                       <input type="hidden" name="left_shut" id="left_shut" class="form-control tip" value="<?php echo h($product->left_shut); ?>">
                    </div>
                  </div>
               </div>
            </div>

            
            <div class="form-group">
               <label for="image">Image</label>
               <!-- <input type="file" name="userfile" id="image"> -->
               <input type="file" class="form-control" value="<?php echo h($product->file); ?>"  name="file[]" multiple id="image">
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                  <label for="product_tax">Product Tax</label>                                  
                  <input value="7.5" type="text" name="product_tax" value="<?php echo h($product->product_tax); ?>"  class="form-control tip" id="product_tax"  required="required" />
                  <input type="hidden" name="vat" id="vat_input">
               </div>
               <div class="form-group col-md-6">
                  <label for="tax_method">Tax Method</label>                                                                        
                  <select name="tax_method" class="form-control tip select2" id="tax_method"  required="required" style="width:100%;">
                     <!-- <option value="">Select Tax method</option> -->
                     <?php foreach (Product::TAX_METHOD as $key => $value) { ?>
                         <option value="<?php echo $key; ?>" <?php echo $product->tax_method == $key ? 'selected' : '';  ?>><?php echo $value; ?></option>
                     <?php } ?>
                     
                  </select>
               </div>
            </div>

            <?php //if ($page_title == 'Edit'): ?>
              
            
            <div class="alert alert-light">
                  
                  <table class="table table-striped" style="background: none">
                     <tr style="font-weight: bold;">
                        <td>Estimate Price </td>
                        <td align="right">(<?php echo $currency ?>)</td>
                     </tr>
                     <tr>
                        <td>Selling Price </td>
                        <td align="right" id="sprice">0.00</td>
                     </tr>
                     <tr>
                        <td>VAT (<span id="vat"></span>)</td>
                        <td align="right" id="tax">0.00</td>
                     </tr>
                     <tr>
                        <td>Total Price</td>
                        <td align="right" id="tprice">0.00</td>
                     </tr>
                  </table>
               
            </div>
            <?php //endif ?>
         </div>
      </div>
      
      <div class="form-group">
         <input type="submit" name="uploadFile" id="add_product" value="Add Products"  class="btn btn-primary float-right" />
      </div>
   </form>
</div>

<script type="text/javascript">
  
   gen_code();
   function gen_code(){
      $.ajax({
            url: 'inc/barcode.php',
            method: 'post',
            data: {
               gen_code: 1,
            },
            dataType: "json",
            success: function(data) {
               if(data.msg == 'OK'){
                  $('#code').val(data.barcode);
               }
                          
            }
        });
   }


   cal();
   function cal(){
    var price = $('#price').val();
    var product_tax = $('#product_tax').val();
    var to_price = $('#total_price').val();

    $('#vat').text(product_tax);
    $('#sprice').text(price);
    $('#tprice').text(to_price)

    var tax = price / 100 * product_tax
    $('#tax').text(tax)
    $('#vat_input').val(tax);
  }

    $(document).on('input', '#shut_price', function(){
      var shut_price = $(this).val();
      var total_cost_per_shut = parseInt(shut_price) * parseInt($("#no_shut").val());
      $('#t_shut').text('Total cost Per Shut:'+ formatMoney(total_cost_per_shut) )
     })

    $(document).on('input', '#no_shut', function(){
      var shut_price = $("#shut_price").val();
      var total_cost_per_shut = parseInt(shut_price) * parseInt($(this).val());
      $('#t_shut').text('Total cost Per Shut:'+ formatMoney(total_cost_per_shut) )
     })

    

   $(document).on('input', '#product_tax', function(){
    $('#vat').text($(this).val())
   })
   $(document).on('input', '#price', function(){
      var price = $(this).val();
      // var tprice = $('#total_price').val();
      var product_tax = $('#product_tax').val();
      var tax_method = $('#tax_method').val();
      var total_price =  parseFloat(price) + parseFloat(tax)

      // console.log(tax_method)
      $('#sprice').text(price);
      $('#tprice').text(price);

      var tax = price / 100 * product_tax
      if (tax_method == 2) {
         $('#total_price').val(total_price);
         $("#tax").text(tax);
         $("#tprice").text(total_price);
      }else{
         $('#total_price').val(price)
      }

   })
   $(document).on('change', '#category', function(){
    var selected = $(this).find('option:selected');
     var exception = selected.data('exception');
     $("#exception").val(exception);
     // var selected = $("#ref_no_value");
     // var eref_no = selected.val();
   })

   // 1 Exclusive
   // 0 Inclusive
   $(document).on('change', '#tax_method', function(){
      var price = $('#price').val();
      var tax_method = $(this).val();
      var product_tax = $('#product_tax').val();
      var total_price = $('#total_price').val();

      var tax = price / 100 * product_tax

     if (tax_method == 2) { // Inclusive
        console.log(price)

        $('#total_price').val(parseFloat(price) + parseFloat(tax))
        $('#tprice').text(parseFloat(price) + parseFloat(tax))
        $('#tax').text(tax)
        console.log(tax)
     }else{ // Exclusive
         // var tax2 = total_price / 100 * product_tax
         $('#total_price').val(parseFloat(price))
         $('#tprice').text(parseFloat(price))
         console.log(tax)
     }

   });
   function show_shut(){
     $('#shut_price').attr('required', true);
     $('#no_shut').attr('required', true);
     $('.shut_wrap').css('display', 'block');
     // console.log('checked')
  }

  function hide_shut(){
     $('#shut_price').attr('required', false);
     $('#no_shut').attr('required', false);
     $('.shut_wrap').css('display', 'none')
     // console.log('unchecked')
   }

   // var per_shut = $('#per_shut').val();
   // if (per_shut == 2) {   
   //    show_shut()
   // }else{
   //    hide_shut()
   // }
   // var per_shut = $("#no_shut").val();
   // equate_shut(per_shut)

   $(document).on('input', '#no_shut', function(e) {
      var per_shut = $(this).val();
      $("#left_shut").val(per_shut);     
   })

   $(document).on('input', '#quantity1', function(e) {
      var bottle = $(this).val();
      $("#left_bottle").val(bottle);     
   })
</script>