<?php require_once('../../private/initialize.php');
$page_title = 'Single | Product';
$page = 'Stock';
$id = $_GET['id'] ?? 1;
$from = $_GET['from'] ?? date('Y-01-01');
$to = $_GET['to'] ?? date('Y-m-d');
require_login();

include(SHARED_PATH . '/admin_header.php'); ?>

<div class="main-container">

    <div class="page-title">
    
        <div class="daterange-container">

          <a href="<?php echo url_for('stock/') ?>" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Add New Product">
            <i class="feather-arrow-left"></i> 
          </a>
        </div>
        <h5 class="title"><?php echo $page_title ?></h5>
     
  </div>

    <div class="content-wrapper">
        
        <?php
            $accessControl = AccessControl::find_by_user_id($loggedInAdmin->id)->stock_mgt ?? '';
             if ($accessControl == 1): ?>


                <div class="box-body">
                    <h5 class="text-uppercase">Inventory Details</h5>
                    <div class="d-flex justify-content-between pb-3">
                        <div class="">

                            <a href="<?php echo url_for('stock/exportItemData.php?id='. $id) ?>"
                                class="btn btn-success d-none"><i class="fa fa-file-excel-o"></i> Export as CSV</a>

                            <form class="form-inline p-2 d-flex justify-content-end" id="find_week">
                                <div class="form-group mr-5">
                                    <label class="control-label">From:</label>
                                    <input type="date" id="from" class="form-control"
                                        value="<?php echo date('Y-01-01') ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">To:</label>
                                    <input type="date" id="to" class="form-control"
                                        value="<?php echo date('Y-m-d') ?>">
                                </div>
                                <input type="button" class="btn btn-sm btn-primary" id="find" value="Find">
                            </form>

                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#stockModal"><i class="fa fa-plus"></i> Add Stock</button>
                            <!-- <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i> Edit Stock</button> -->

                        </div>
                    </div>
                    <h3 class="text-center text-uppercase">
                        Stock Record for:
                        <?php echo Product::find_by_id($id)->pname; ?>
                        <span id="title1">
                            (<?php echo $currency .' '.number_format(Product::find_by_id($id)->price, 2); ?>)</span>
                    </h3>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" id="">
                            <!-- <table id="example5" class="display table table-sm table-bordered"> -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="6" class="text-center fs-20 bg-success">Open Stock</th>
                                    <!-- <th colspan="5" class="text-center fs-20 bg-primary">Close Stock</th> -->
                                    <th></th>
                                </tr>
                                <tr class="text-center">
                                    <th>S/n</th>
                                    <th>created On</th>
                                    <th>Item</th>
                                    <th>Ref No</th>
                                    <!-- <th>Initial Stock</th> -->
                                    <th>Supply</th>
                                    <th class="bg-yellow">Value in(<?php echo $currency ?>)</th>
                                    <!-- <th>Total Stock</th> -->
                                    <!--  -->
                                    <!-- <th>Total.Amt</th> -->
                                    <!-- <th>Unit Price</th> -->
                                    <!-- <th class="bg-yellow">Unit Sold</th> -->
                                    <!-- <th class="bg-yellow">Value in(<?php // echo $currency ?>)</th> -->
                                    <!-- <th class="bg-green">Avail Stock</th> -->
                                    <!-- <th class="bg-green">Value in(<?php  //echo $currency ?>)</th> -->
                                    <!-- Close -->

                                    <th>Action</th>
                                    <!-- <th></th> -->

                                </tr>
                            </thead>
                            <tbody id="list">

                            <tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="4" align="right">Total</td>
                                    <td align="center" id="sum_of_supply" style="font-weight: bold;"></td>
                                    <td align="center" id="value_of_supply" style="font-weight: bold;"></td>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <?php else: ?>
                <div class="box-body">
                    <div class="alert alert-danger">Sorry you are unauthorized to updated stock record please
                        contact</div>
                    <ul type="1">

                        <?php foreach (AccessControl::find_authorized(1) as $key => $value) { ?>
                        <li><?php echo Admin::find_by_id($value->user_id)->full_name(); ?></li> OR
                        <?php } ?>

                    </ul>
                </div>
                <?php endif ?>
    </div>

</div>

<input type="hidden" id="eid" value="<?php echo $id; ?>">
<div class="modal fade none-border" id="stockModal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Item</strong></h4>
            </div>
            <form method="post" id="form">
                <input type="hidden" name="addStock[created_by]" class="form-control"
                    value="<?php //echo $loggedInAdmin->id ?>">
                <div class="modal-body row">
                    <div class="col-12 text-center text-danger flash inifinte animated" id="stockErrors"></div>
                    <div class="form-group col-sm-6">
                        <label>Item Name</label>

                        <!-- <input type="text" name="addStock[item]" placeholder="e.g Rice" class="form-control"> -->
                        <select readonly name="addStock[item_id]" class="form-control">
                            <option value="">--Select--</option>
                            <?php foreach (product::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                            <option value="<?php echo $value->id ?>" <?php echo $id == $value->id ? 'selected' : '' ?>>
                                <?php echo $value->pname ?></option>
                            <?php } ?>


                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Quantity Supplied</label>
                        <input type="number" min="0" name="addStock[supply]" placeholder="e.g 19" class="form-control"
                            id="supply">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="addStock"
                        class="btn btn-secondary save-event waves-effect waves-light">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade none-border" id="editStockModal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong> Edit Stock</strong></h4>
            </div>
            <div class="col-12 text-center" id="editStockErrors"></div>
            <form method="post" id="editStockInput">
                <div class="modal-body row" id="fetchstockForm">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" id="editStock"
                        class="btn btn-primary save-event waves-effect waves-light">Edit
                        Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" id="eid" value="<?php echo $id;  ?>">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script type="text/javascript">
var eid = $('#eid').val();
var from = $('#from').val();
var to = $('#to').val();
load_product(eid, from, to)

function load_product(eid, from) {
    $.ajax({
        url: 'inc/fetch_item.php',
        method: 'post',
        data: {
            fetch: 1,
            id: eid,
            from: from,
            to: to
        },
        success: function(data) {
            $('#list').html(data);
        }
    });

}

$(document).on('click', '#from', function(e) {
    var eid = $('#eid').val();
    var from = $("#from").val();
    var to = $("#to").val(); 
    load_product(eid, from, to)
})


// ***************** Add Stock *********************// 

$(document).on('click', '#addStock', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'inc/stock_crud.php',
        method: 'post',
        // data: {new: 1,},
        data: $('#form').serialize(),
        dataType: 'json',
        success: function(r) {
            if (r.msg == 'OK') {
                successTime("Stock Added Succesfully");
                $("#stockModal").modal('hide');
                var eid = $('#eid').val();
                var from = $('#from').val();
                var to = $('#to').val();
                load_product(eid, from, to)
                $('#form')[0].reset();
            } else {
                $("#stockErrors").html(r.msg)
            }
        }

    });
})

$(document).on('click', '.oneItem', function(e) {
    $("#editStockModal").modal('show');
    var eid = $(this).data('id');
    var ref = $(this).data('ref');
    console.log(eid)
    $.ajax({
        url: 'inc/fetch_stock_form.php',
        method: 'post',
        data: {
            stockForm: 1,
            id: eid,
            ref: ref,
        },
        success: function(r) {
            $("#fetchstockForm").html(r)
        }

    });
})
// Edit Stock
$(document).on('click', '#editStock', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'inc/stock_crud.php',
        method: 'post',
        data: $('#editStockInput').serialize(),
        dataType: 'json',
        success: function(r) {
            if (r.msg == 'OK') {
                var eid = $('#eid').val();
                var from = $('#from').val();
                var to = $('#to').val();
                load_product(eid, from, to);
                successTime("Item updated Succesfully");
                $("#editStockModal").modal('hide');
            } else {
                $("#editStockErrors").html(r.msg)
            }
        }

    });
})
</script>