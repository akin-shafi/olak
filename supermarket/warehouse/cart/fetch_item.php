<?php require_once('../../private/initialize.php'); ?>
<?php if (isset($_POST['fetch']) || isset($_POST['fetch_cat']) ) { 
    $PCAT = WarehouseItemCategory::find_by_undeleted(['order' => 'ASC']);
    $id = array_values($PCAT)[0]->id; 
    $category = $_POST['id'] ?? $id;
    $categories = WarehouseItem::find_by_category($category);
    // Set session variables
    $_SESSION["s_id"] = $_POST['s_id'] ?? 1;

    $s_id = $_SESSION["s_id"];
    $store = Store::find_by_id($s_id);
    $sales_setup  = Settings::find_by_id(1)->sale_option; // Infinity Sales
?>
    <?php if (isset($categories)){ ?>
        <ul class="menu">
          <?php foreach (WarehouseItemCategory::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
            <li><a class="<?php echo $category == $value->id ? 'current' : '' ?> menu_item" data-id="<?php echo $value->id; ?>" href="#"><?php echo $value->category; ?></a></li>
          <?php } ?>
         </ul>
     <?php } ?>
     <div id="item-list">
            <div class="items">
                <!-- if product is arranged in categories  -->
                <?php if (!empty($categories)){ ?> <!-- if there is result to display  -->
                    <?php foreach ($categories as $item) {  ?> 
                        
                        <?php  if ($store->id == 1 ) { ?>
                           <button   type="button" data-id="<?php echo $item->id ?>" id="<?php echo $item->id ?>" type="button" value='<?php echo $item->id ?>' class="btn btn-both btn-flat add_to_cart">
                                        
                                        <span>
                                          <span><?php echo $item->item_name.'('.$item->quantity. ')' ?> </span> 
                                        </span>

                                        <input type="hidden" name="hidden_name" id="name_<?php echo $item->id ?>" value="<?php echo $item->item_name ?>" /> 
                                         <input type="hidden" name="hidden_price" id="price_<?php echo $item->id ?>" value="<?php echo $item->price ?>" />
                                        <input type="hidden" id="quantity_<?php echo $item->id ?>" value="1" class="input-text qty text" name="quantity"  size="1"/>

                                        <input type="hidden" id="stockUnit_<?php echo $item->id ?>" value="<?php echo $item->quantity ?>">
                            </button>
                        
                        <?php }  ?>
                    <?php } ?>

                <?php }else{ ?> <!-- if no result to display  -->
                    <div>No record found</div>
                <?php } ?>
            </div>
     </div>
<?php } ?>