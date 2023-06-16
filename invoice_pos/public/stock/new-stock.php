<?php require_once('../../private/initialize.php');
$page = 'Stock';
$page_title = 'Stock'; 
require_login();
$from = $_GET['from'] ?? date('Y-m-d');
$to = $_GET['to'] ?? date('Y-m-d');

 $company_id = $loggedInAdmin->company_id;
 $branch_id = $_GET['branch'] ?? $loggedInAdmin->branch_id;

include(SHARED_PATH . '/admin_header.php'); ?>
<style type="text/css">
td a {
    text-decoration: underline;
    color: red;
}
</style>

<div class="main-container">

    <div class="page-title">
        <div class="row gutters">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title"><?php echo $page_title ?></h5>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
           <div class="d-flex justify-content-end">

              

            <?php if (in_array($loggedInAdmin->admin_level, [1,2,3])) : ?>
              <select class="form-control" id="filter_branch" style="width: 150px; ">
                <option value="" selected>All</option>
                <?php foreach (Branch::find_by_undeleted() as $key => $value) { ?>
                  <option value="<?php echo $value->id ?>"><?php echo $value->branch_name ?></option>
                <?php } ?>
                
              </select>
            <?php endif; ?>
              <!-- <button type="button" id="search" class="btn btn-primary btn-sm">Search</button> -->
           </div>
          </div>
        </div>
      </div>

    <div class="content-wrapper">
        <div class="col-lg-12 alerts">
            <div id="custom-alerts" style="display:none;">
                <div class="alert alert-dismissable">
                    <div class="custom-msg"></div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">

            <form>
                

            </form>
            <table class="table table-sm table-bordered" id="rowSelection">
                <thead>
                    <tr class="text-center text-uppercase">
                        <th>S/n</th>
                        <th>PRODUCT/TYPE</th>
                        <th>OPENING STOCK</th>
                        <th>STOCK IN/EXCESS</th>
                        <th>RETURNED INWARDS/ PURCHASE</th>
                        <th>TOTAL STOCK</th>
                        <th> OUT FLOW </th>
                        <th> BREAKAGES/SCRAP</th>
                        <th> CLOSING STOCK</th>
                        <th> TOTAL (CLOSING STOCK) </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    $sn = 1; 
                   
                    $product =  Product::find_by_branch_id(['branch_id' => $branch_id]);
                     foreach ($product as $key => $item) 
                    {?>
                    <tr class="text-center">
                        <td><?php echo $sn++; ?>.</td>
                        <td>
                            <a class="" href="<?php echo url_for('stock/items.php?id='.$item->id) ?>"
                                style="text-decoration: underline;" data-id="<?php echo $item->id ?>">
                                <?php echo $item->pname; ?>
                            </a>
                        </td>
                        <td>OPENING STOCK</td>
                        <td>STOCK IN/EXCESS</td>
                        <td>RETURNED INWARDS/ PURCHASE</td>
                        <td>TOTAL STOCK</td>
                        <td> OUT FLOW </td>
                        <td> BREAKAGES/SCRAP</td>
                        <td> CLOSING STOCK</td>
                        <td> TOTAL (CLOSING STOCK) </td>
                        <td>Action</td>
                    </tr>
                    <?php } ?>
                <tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade none-border" id="stockModal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Item</strong></h4>
            </div>
            <form method="post" id="form"></form>
        </div>
    </div>
</div>




<input type="hidden" id="eUrl" value="<?php echo url_for('/stock/') ?>">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script type="text/javascript">

</script>