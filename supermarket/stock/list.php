<?php require_once('../private/initialize.php');
$page_title = 'List';
$page = 'Stock';
require_login();
$date = date('Y-01-01');
include(SHARED_PATH . '/header.php'); ?>
<style type="text/css">
td a {
    text-decoration: underline;
    color: red;
}
</style>
<div class="content-wrapper">
    <section class="content-header d-flex justify-content-between">
        <h1><?php echo $page_title ." ". $page; ?></h1>
        <div>
            <?php echo $page ?> > <a href="<?php echo url_for('/reports/ledger.php') ?>">Go to Ledger >></a>
        </div>
    </section>

    <div class="col-lg-12 alerts">
        <div id="custom-alerts" style="display:none;">
            <div class="alert alert-dismissable">
                <div class="custom-msg"></div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="col-lg-12 alerts d-flex justify-content-center mn-4">
            <?php //echo display_errors($product->errors); ?>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">

                    <div class="box-body">
                        <h5 class="text-uppercase">Stock Record</h5>
                        <div class="d-flex justify-content-between pb-3">
                            <div class="btn-group d-none">
                                <a href="<?php echo url_for('stock/exportData.php') ?>" class="btn btn-success"><i
                                        class="fa fa-file-excel-o"></i> Export as CSV</a>
                            </div>
                            <div class="btn-group d-none">


                                <button class="daterange-container btn btn-warning " id="clearData">
                                    <i class="fa fa-retrun-o"></i> Return to Zero
                                </button>

                                <?php if ($loggedInAdmin->id == 1) { ?>
                                <button class="btn  btn-primary" id="updExp" id="btn-item">Update Exception</button>
                                <button class="daterange-container btn btn-danger " id="clearDataAdmin">
                                    <i class="fa fa-trash-o"></i> Delete All Data
                                </button>
                                <?php } ?>

                            </div>
                        </div>

                        <input type="date" value="<?php echo $date?>">
                        <table class="table table-sm table-bordered" id="example2">
                            <thead>
                                <tr class="text-center">
                                    <th>S/n</th>
                                    <th>Item</th>
                                    <!-- <th>Unit Price</th> -->
                                    <!-- <th>Unit Sold</th> -->
                                    <th>Sum of Supply</th>
                                    <th>Qty Sold</th>
                                    <th>Avail Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $sn = 1; 
                             foreach (Product::find_by_undeleted(['order' => 'ASC']) as $key => $item) {
                              $value = intval($item->price) * $item->quantity;
                              // pre_r($value);
                              
                              $stock = StockDetails::sum_of_Stock([ 'item_id' => $item->id, 
                            //   'from' => $date,
                              ]) ?? 0;
                              $sales = Sales::find_all_by_product_id(['product_id' => $item->id, 
                            //   'from'=> $date 
                            ]);
                              $qty = $sales ?? 0;
                              $left_over = intval($stock - $qty);
                              if (!empty($item->ref_no)) {
                                $supply = StockDetails::find_by_ref($item->ref_no)->supply ?? "0";
                                $sold = StockDetails::find_by_ref($item->ref_no)->sold_stock ?? "0";
                                $qty = StockDetails::find_by_ref($item->ref_no)->deleted ?? "0";

                                
                              }else{
                                $supply = "None";
                                $sold = "None";
                              }
                              ?>
                                <tr class="text-center">
                                    <td><?php echo $sn++; ?>.</td>
                                    <td>
                                        <?php if($stock_mgt == 1){ ?>
                                        <a class="" href="<?php echo url_for('stock/items.php?id='.$item->id) ?>"
                                            style="text-decoration: underline;" data-id="<?php echo $item->id ?>">
                                            <?php echo $item->pname; ?>
                                        </a>
                                        <?php }else{ ?>
                                        <?php echo $item->pname; ?>
                                        <?php } ?>
                                        <?php //echo $item->name; ?>
                                    </td>
                                    <!-- <td><?php //echo $item->price ?></td> -->
                                    <!-- <td><?php //echo $sold ?></td> -->

                                    <td><?php echo $stock ?? 0; ?></td>
                                    <td><?php echo $sales ?? 0; ?></td>
                                    <td><?php echo $left_over ?? 0; ?></td>

                                    <!-- <td><?php //echo $qty == 1 ? $currency ." ". number_format(0, 2) : $currency ." ".number_format($value, 2); ?></td> -->

                                    <td>
                                        <button type="button" class=" btn btn-sm btn-primary add"
                                            data-id="<?php echo $item->id ?>"><i class="fa fa-plus"></i> Add
                                            Stock</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
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




<form id="details">

    <?php 
 $variable = StockDetails::find_all();
foreach ($variable as $key => $value) { ?>

    <input type="hidden" name="stockDetails[item_id][]" value="<?php echo $value->item_id;  ?>">
    <input type="hidden" name="stockDetails[ref_no][]" value="<?php echo $value->ref_no;  ?>">
    <input type="hidden" name="stockDetails[initial_stock][]" value="<?php echo $value->initial_stock;  ?>">
    <input type="hidden" name="stockDetails[supply][]" value="<?php echo $value->supply;  ?>">
    <input type="hidden" name="stockDetails[unit_price][]" value="<?php echo $value->unit_price;  ?>">
    <input type="hidden" name="stockDetails[total_amt][]" value="<?php echo $value->total_amt;  ?>">
    <input type="hidden" name="stockDetails[sold_stock][]" value="<?php echo $value->sold_stock;  ?>">
    <input type="hidden" name="stockDetails[sold_stock_amt][]" value="<?php echo $value->sold_stock_amt;  ?>">
    <input type="hidden" name="stockDetails[qty_left][]" value="<?php echo $value->qty_left;  ?>">

    <?php  } ?>


    <input type="hidden" name="deleteAll" value="1">
</form>

<form id="stockData">


    <?php  $stock = Stock::find_all();
foreach ($stock as $key => $val) {?>

    <input type="hidden" name="stock[ref_no][]" value="<?php echo $val->ref_no;  ?>">
    <input type="hidden" name="stock[opened_at][]" value="<?php echo $val->opened_at;  ?>">
    <input type="hidden" name="stock[closed_at][]" value="<?php echo $val->closed_at;  ?>">
    <input type="hidden" name="stock[opened_by][]" value="<?php echo $val->opened_by;  ?>">
    <?php  } ?>

</form>

<input type="hidden" id="eUrl" value="<?php echo url_for('/stock/list') ?>">
<?php include(SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">
var eUrl = $("#eUrl").val();
$(document).on('click', '.add', function(e) {
    e.preventDefault();
    var eid = $(this).data('id');
    var ref = $(this).data('ref');
    $("#stockModal").modal("show");
    $.ajax({
        url: 'inc/form.php',
        method: 'post',
        data: {
            stockForm: 1,
            id: eid,
        },
        success: function(r) {
            $("#form").html(r)
        }

    });
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
                // load_product();
                // $('#form')[0].reset();
                window.location.href = eUrl;
            } else {
                $("#stockErrors").html(r.msg)
            }
        }

    });
})

$(document).on("click", "#clearData", function() {
    if (confirm("Are you sure you! want to return to Zero ?")) {
        $(this).attr("disabled", true).html("Processing...");
        $.ajax({
            url: 'inc/clearData.php',
            method: 'post',
            data: {
                clearAll: 1,
            },
            dataType: 'json',
            success: function(r) {
                if (r.msg == 'OK') {
                    successTime("Returned Succesfully");
                    window.location.reload();
                } else {
                    errorAlert(r.msg)
                }
            }
        });
    } else {
        return false
    }
})
$(document).on("click", "#updExp", function() {
    if (confirm("Are you sure you want to clear all data ?")) {
        $(this).attr("disabled", true).html("Processing...");
        $.ajax({
            url: 'inc/push_to_ledger.php',
            method: 'post',
            data: {
                deleteAll: 1,
            },
            dataType: 'json',
            success: function(r) {
                if (r.msg == 'OK') {
                    successTime("Deleted Succesfully");
                    window.location.reload();
                } else {
                    errorAlert(r.msg)
                }
            }
        });
    } else {
        return false
    }
})
$(document).on("click", "#clearDataAdmin", function() {
    if (confirm("Are you sure you want to clear all data ?")) {
        $.ajax({
            url: 'inc/clearDataAdmin.php',
            method: 'post',
            data: {
                'deleteAll': 1
            },
            dataType: 'json',
            success: function(r) {
                if (r.msg == 'OK') {
                    successTime("Deleted Succesfully");
                    window.location.href = eUrl
                } else {
                    errorAlert(r.msg)
                }
            }
        });
    } else {
        return false
    }
})
</script>