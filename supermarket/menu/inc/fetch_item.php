<?php require_once('../../private/initialize.php'); ?>
<?php if (isset($_POST['fetch']) || isset($_POST['fetch_cat']) ) {
    $PCAT = ProductCategory::find_by_undeleted(['order' => 'ASC']);
    $id = array_values($PCAT)[0]->id; 
    $category = $_POST['id'] ?? $id;
    $categories = Product::find_by_category($category);
?>
                <div class="row">
                    <?php if (isset($categories)){ ?>
                        <ul class="nav nav-tabs menu_tab mb-4" id="myTab" role="tablist">
                          <?php foreach (ProductCategory::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                          
                            <li class="nav-item">
                                <a class="nav-link <?php echo $category == $value->id ? 'active' : '' ?> menu_item" id="breakfast-tab" data-id="<?php echo $value->id; ?>" href="#" ><?php echo $value->category; ?></a>

                            </li>
                          <?php } ?>    
                        </ul>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="tab-content col-lg-12" id="myTabContent">
                        <div class="tab-pane fade show active" id="breakfast" role="tabpanel" aria-labelledby="breakfast-tab">
                            <div class="row">
                                <!-- if product is arranged in categories  -->
                    <?php if (isset($categories)): ?>
                        <?php if (!empty($categories)): ?> <!-- if there is result to display  -->
                              <?php foreach ($categories as $item) { ?>
                                    <div class="col-md-6 col-sm-12 col-12 single_menu pb-2">
                                        <div class="row">
                                            <div class="col-sm-12 col-12">
                                                <!-- <img class="img-fluid" src="<?php //echo url_for('/uploads/thumbs/'. $item->file) ?>" alt="<?php //echo $item->pname ?>"> -->

                                                <img class="img-fluid" src="<?php echo $item->file != "" ? url_for('/uploads/thumbs/'. $item->file) : url_for('/uploads/thumbs/bottles.jpg') ?>" alt="<?php echo $item->pname ?>" style="width: 100px; height: 100px;">
                                            </div>
                                            <div class="col-sm-12 col-12">
                                                <div class="menu_content">
                                                    <h4><?php echo $item->pname ?>  <span><?php echo $currency.$item->price; ?></span></h4>
                                                    <p><?php echo $item->details; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                              <?php } ?>
                          <?php else: ?>
                                    <div class="text-center h2  w-100 text-white">We are stocking...</div>
                          <?php endif ?>        
                    <?php else: ?>
                        <div class="col-md-6 col-sm-12 col-6 single_menu pb-2">
                            <img class="img-fluid" src="<?php echo url_for('/uploads/thumbs/'. $item->file) ?>" alt="<?php echo $item->pname ?>">
                            <div class="menu_content">
                                <h4><?php echo $item->pname ?>  <span><?php echo $currency.$item->price; ?></span></h4>
                                <p><?php echo $item->details; ?></p>
                            </div>
                        </div>

                    <?php endif ?>
                </div>
            </div>
        </div>
        <!-- <a href="#" class=" menu_btn btn btn-danger">view more</a> -->
    </div>
<?php } ?>