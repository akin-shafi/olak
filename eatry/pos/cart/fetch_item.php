<?php require_once('../../private/initialize.php'); ?>
<?php if (isset($_POST['fetch']) || isset($_POST['fetch_cat']) ) { 
    $PCAT = ProductCategory::find_by_undeleted(['order' => 'ASC']);
    $id = array_values($PCAT)[0]->id; 
    $category = $_POST['id'] ?? $id;
    $categories = Product::find_by_category($category);
    // Set session variables
    $_SESSION["store_id"] = $_POST['store_id'] ?? 1;

    $store_id = $_SESSION["store_id"];
    $store = Store::find_by_id($store_id);
    $sales_setup  = Settings::find_by_id(1)->sale_option; // Infinity Sales
    // $leftover = 30;
    $from = date('Y-m-d');
?>
    <?php if (isset($categories)){ ?>
        <ul class="menu">
          <?php foreach (ProductCategory::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
            <li><a class="<?php echo $category == $value->id ? 'current' : '' ?> menu_item" data-id="<?php echo $value->id; ?>" href="#"><?php echo $value->category; ?></a></li>
          <?php } ?>
         </ul>
     <?php } ?>
     <div id="item-list">
            <div class="items">
                <!-- if product is arranged in categories  -->
                <?php if (isset($categories)){ ?>
                    <?php if (!empty($categories)){ ?> <!-- if there is result to display  -->
                      <?php foreach ($categories as $item) { 

                        $sales = Sales::find_all_by_product_id(['product_id' => $item->id,'from'=>  $from]);
                        $stock = StockDetails::sum_of_Stock(['from' => $from, 'item_id' => $item->id]) ?? 0;
                        $qty = $sales ?? 0;
                        $leftover = intval($stock - $qty);
                        ?> 
                        
                            <?php  if ($store->id == 1 ) { $price = $item->total_price;  ?>
                                <!-- // wine store -->
                                    <?php if($leftover <= $item->alert_quantity){ 
                                        
                                        if ($sales_setup == 1) {
                                            $selling_option = "errorOption";
                                            $class = "";
                                        }else{
                                            $selling_option = "Option";
                                            $class = "add_to_cart";
                                        }
                                    ?> 
                                        <!-- if quantity of stock is below set limit  -->

                                        <button   onclick="<?php echo $selling_option; ?>('Low in stock', 'Would you like to Re-stock ?', <?php echo $item->id ?>, <?php echo $store->id ?>)" type="button" data-id="<?php echo $item->id ?>" id="<?php echo $item->id ?>" type="button" value='<?php echo $item->id ?>' class="btn btn-both btn-flat <?php echo $class ?>">
                                            <span class="bg-img">
                                                <div >
                                                   <!-- <span>Shut</span> -->
                                                   <span class="float-right"> <?php echo $currency.' '.$price ?></span>
                                                </div>

                                                <img class="img-fluid" src="<?php echo $item->file != "" ? url_for('/uploads/thumbs/'. $item->file) : url_for('/uploads/thumbs/bottles.jpg') ?>" alt="<?php echo $item->pname ?>" style="width: 100px; height: 100px;">
                                            </span>
                                            <span>
                                              <span><?php echo $item->pname.'('.$leftover.')' ?> </span> 
                                              
                                              
                                            </span>

                                            <input type="hidden" name="hidden_name" id="name_<?php echo $item->id ?>" value="<?php echo $item->pname ?>" /> <br>
                                            <input type="hidden" name="hidden_price" id="price_<?php echo $item->id ?>" value="<?php echo $price ?>" />
                                            <input type="hidden" id="quantity_<?php echo $item->id ?>" value="1" class="input-text qty text" name="quantity"  size="1"/>
                                            <input type="hidden" id="discount_<?php echo $item->id ?>" value="0" class=" discount" name="discount"  size="1"/>
                                            <input type="hidden" id="tax_<?php echo $item->id ?>" value="<?php echo $item->product_tax; ?>" class="input-text tax text" name="tax"  size="1"/>

                                            <input type="hidden" id="stockUnit_<?php echo $item->id ?>" value="<?php echo $leftover ?>">
                                        </button>
                                    <?php }else{ ?>
                                        <!-- if quantity of stock is above set limit  -->
                                        <button  type="button" data-id="<?php echo $item->id ?>" id="<?php echo $item->id ?>" type="button" value='<?php echo $item->id ?>' class="btn btn-both btn-flat add_to_cart">
                                            <span class="bg-img">
                                                <div >
                                                   <!-- <span>Shut</span> -->
                                                   <span class="float-right"> <?php echo $currency.' '.$price ?></span>
                                                </div>
                                                <img src="<?php echo $item->file != "" ? url_for('/uploads/thumbs/'. $item->file) : url_for('/uploads/thumbs/bottles.jpg') ?>" alt="<?php echo $item->pname ?>" style="width: 100px; height: 100px;">
                                            </span>
                                            <span>
                                              <span><?php echo $item->pname.'('.$leftover.')' ?></span> 
                                              
                                            </span>

                                            <input type="hidden" name="hidden_name" id="name_<?php echo $item->id ?>" value="<?php echo $item->pname ?>" /> <br>
                                            <input type="hidden" name="hidden_price" id="price_<?php echo $item->id ?>" value="<?php echo $price ?>" />
                                            <input type="hidden" id="quantity_<?php echo $item->id ?>" value="1" class="input-text qty text" name="quantity"  size="1"/>
                                            <input type="hidden" id="discount_<?php echo $item->id ?>" value="0" class=" discount" name="discount"  size="1"/>
                                            <input type="hidden" id="tax_<?php echo $item->id ?>" value="<?php echo $item->product_tax; ?>" class="input-text tax text" name="tax"  size="1"/>

                                            <input type="hidden" id="stockUnit_<?php echo $item->id ?>" value="<?php echo $leftover ?>">
                                        </button>
                                    <?php } ?>
                            <?php }elseif($store->id == 2 ){ $price = $item->shut_price; ?>
                                <!-- Bar -->
                                    <?php if($item->left_shut <= 0){ ?> 
                                        <!-- if quantity of stock is below set limit  -->

                                        <button   onclick="errorOption('Low in stock', 'Would you like to Re-stock ?', <?php echo $item->id ?>, <?php echo $store->id ?>)" type="button" data-id="<?php echo $item->id ?>" id="<?php echo $item->id ?>" type="button" value='<?php echo $item->id ?>' class="btn btn-both btn-flat">
                                            <span class="bg-img">
                                                <div >
                                                   <!-- <span>Shut</span> -->
                                                   <span class="float-right"> <?php echo $currency.' '.$price ?></span>
                                                </div>

                                                <img class="img-fluid" src="<?php echo $item->file != "" ? url_for('/uploads/thumbs/'. $item->file) : url_for('/uploads/thumbs/bottles.jpg') ?>" alt="<?php echo $item->pname ?>" style="width: 100px; height: 100px;">
                                            </span>
                                            <span>
                                              <span><?php echo $item->pname.'('.$item->left_shut. ')' ?> </span> 
                                              
                                              
                                            </span>

                                            <input type="hidden" name="hidden_name" id="name_<?php echo $item->id ?>" value="<?php echo $item->pname ?>" /> <br>
                                            <input type="hidden" name="hidden_price" id="price_<?php echo $item->id ?>" value="<?php echo $price ?>" />
                                            <input type="hidden" id="quantity_<?php echo $item->id ?>" value="1" class="input-text qty text" name="quantity"  size="1"/>
                                            <input type="hidden" id="discount_<?php echo $item->id ?>" value="0" class=" discount" name="discount"  size="1"/>
                                            <input type="hidden" id="tax_<?php echo $item->id ?>" value="<?php echo $item->product_tax; ?>" class="input-text tax text" name="tax"  size="1"/>

                                            <input type="hidden" id="stockUnit_<?php echo $item->id ?>" value="<?php echo $item->left_shut ?>">
                                        </button>
                                    <?php }else{ ?>
                                        <!-- if quantity of stock is above set limit  -->
                                        <button  type="button" data-id="<?php echo $item->id ?>" id="<?php echo $item->id ?>" type="button" value='<?php echo $item->id ?>' class="btn btn-both btn-flat add_to_cart">
                                            <span class="bg-img">
                                                <div >
                                                   <!-- <span>Shut</span> -->
                                                   <span class="float-right"> <?php echo $currency.' '.$price ?></span>
                                                </div>
                                                <img src="<?php echo $item->file != "" ? url_for('/uploads/thumbs/'. $item->file) : url_for('/uploads/thumbs/bottles.jpg') ?>" alt="<?php echo $item->pname ?>" style="width: 100px; height: 100px;">
                                            </span>
                                            <span>
                                              <span><?php echo $item->pname.'('.$item->left_shut. ')' ?></span> 
                                              
                                            </span>

                                            <input type="hidden" name="hidden_name" id="name_<?php echo $item->id ?>" value="<?php echo $item->pname ?>" /> <br>
                                            <input type="hidden" name="hidden_price" id="price_<?php echo $item->id ?>" value="<?php echo $price ?>" />
                                            <input type="hidden" id="quantity_<?php echo $item->id ?>" value="1" class="input-text qty text" name="quantity"  size="1"/>
                                            <input type="hidden" id="discount_<?php echo $item->id ?>" value="0" class=" discount" name="discount"  size="1"/>
                                            <input type="hidden" id="tax_<?php echo $item->id ?>" value="<?php echo $item->product_tax; ?>" class="input-text tax text" name="tax"  size="1"/>

                                            <input type="hidden" id="stockUnit_<?php echo $item->id ?>" value="<?php echo $item->left_shut ?>">
                                        </button>
                                    <?php } ?>
                            <?php }  ?>
                      <?php } ?>
                    <?php }else{ ?> <!-- if no result to display  -->
                        <div>No record found</div>
                    <?php } ?>
                <?php }else{ ?>
                    <!-- if product is not arranged in categories  -->
                  <?php foreach (Product::find_by_undeleted() as $item) { 
                     if ($store->category == 'wine store') {
                            $price = $item->total_price;
                        }else{
                            $price = $item->shut_price;
                        }

                        $sales = Sales::find_all_by_product_id(['product_id' => $item->id,'from'=>  $from]);
                        $stock = StockDetails::sum_of_Stock(['from' => $from, 'item_id' => $item->id]) ?? 0;
                        $qty = $sales ?? 0;
                        $leftover = intval($stock - $qty);
                    ?>
                    <?php if($leftover <= $item->alert_quantity){ ?>
                        <button   onclick="alert('Out of stock')" type="button" data-id="<?php echo $item->id ?>" id="<?php echo $item->id ?>" type="button" value='<?php echo $item->id ?>' class="btn btn-both btn-flat">
                            <span class="bg-img">
                                <img src="<?php echo $item->file != "" ? url_for('/uploads/thumbs/'. $item->file) : url_for('/uploads/thumbs/bottles.jpg') ?>" alt="<?php echo $item->pname ?>" style="width: 100px; height: 100px;">
                            </span>
                            <span>
                              <span><?php echo $item->pname.'('.$leftover.')' ?></span> 
                              
                            </span>

                            <input type="hidden" name="hidden_name" id="name_<?php echo $item->id ?>" value="<?php echo $item->pname ?>" /> <br>
                            <input type="hidden" name="hidden_price" id="price_<?php echo $item->id ?>" value="<?php echo $price ?>" />
                            <input type="hidden" id="quantity_<?php echo $item->id ?>" value="1" class="input-text qty text" name="quantity"  size="1"/>
                            <input type="hidden" id="discount_<?php echo $item->id ?>" value="0" class=" discount" name="discount"  size="1"/>
                            <input type="hidden" id="tax_<?php echo $item->id ?>" value="<?php echo $item->product_tax; ?>" class="input-text tax text" name="tax"  size="1"/>

                            <input type="hidden" id="stockUnit_<?php echo $item->id ?>" value="<?php echo $leftover ?>">
                        </button>
                    <?php }else{ ?>
                        <button  type="button" data-id="<?php echo $item->id ?>" id="<?php echo $item->id ?>" type="button" value='<?php echo $item->id ?>' class="btn btn-both btn-flat add_to_cart">
                            <span class="bg-img">
                                <img src="<?php echo $item->file != "" ? url_for('/uploads/thumbs/'. $item->file) : url_for('/uploads/thumbs/bottles.jpg') ?>" alt="<?php echo $item->pname ?>" style="width: 100px; height: 100px;">
                            </span>
                            <span>
                              <span><?php echo $item->pname.'('.$leftover.')' ?></span> 
                              
                            </span>

                            <input type="hidden" name="hidden_name" id="name_<?php echo $item->id ?>" value="<?php echo $item->pname ?>" /> <br>
                            <input type="hidden" name="hidden_price" id="price_<?php echo $item->id ?>" value="<?php echo $price ?>" />
                            <input type="hidden" id="quantity_<?php echo $item->id ?>" value="1" class="input-text qty text" name="quantity"  size="1"/>
                            <input type="hidden" id="discount_<?php echo $item->id ?>" value="0" class=" discount" name="discount"  size="1"/>
                            <input type="hidden" id="tax_<?php echo $item->id ?>" value="<?php echo $item->product_tax; ?>" class="input-text tax text" name="tax"  size="1"/>

                            <input type="hidden" id="stockUnit_<?php echo $item->id ?>" value="<?php echo $leftover ?>">
                        </button>
                    <?php } ?>
                  <?php } ?> <!-- end of else  -->
                <?php } ?>
            </div>
     </div>
<?php } ?>