<?php require_once('../../private/initialize.php');
$page = 'Stock';
$page_title = 'Stock'; 
require_login();
$from = $_GET['from'] ?? date('Y-m-d');
$to = $_GET['to'] ?? date('Y-m-d');
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
            <table class="table table-sm table-bordered" id="rowSelection">
                <thead>
                    <tr class="text-center">
                        <th>S/n</th>
                        <th>Item</th>
                        <th>Sum of Supply</th>
                        <th>Qty Sold</th>
                        <th>Avail Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $sn = 1; 
                    $company_id = $loggedInAdmin->company_id;
                    $branch_id = $_GET['branch'] ?? $loggedInAdmin->branch_id;
                    $product =  Product::find_by_branch_id(['branch_id' => $branch_id]);
                     foreach ($product as $key => $item) {
                      
                      $stock = StockDetails::sum_of_Stock([ 'item_id' => $item->id,   //'from' => $from 
                      ]) ?? 0;

                      $sales = Invoice::find_all_by_service_type(['service_type' => $item->id , 'status' => 1  //'from' => $from, 'to' => $to,
                      ]);
                      $qty = intval($sales->sum_of_quantity) ?? 0;
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
                            <a class="" href="<?php echo url_for('stock/items.php?id='.$item->id) ?>"
                                style="text-decoration: underline;" data-id="<?php echo $item->id ?>">
                                <?php echo $item->pname; ?>
                            </a>
                        </td>

                        <td><?php echo $stock ?? 0; ?></td>
                        <td><?php echo $sales->sum_of_quantity ?? 0; ?></td>
                        <td><?php echo $left_over ?? 0; ?></td>
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
var BASE_URL = $("#eUrl").val();
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
                window.location.href = BASE_URL;
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
                    window.location.href = BASE_URL
                } else {
                    errorAlert(r.msg)
                }
            }
        });
    } else {
        return false
    }
})
$(document).on('change', '#filter_branch', function() {
    let branch = $(this).val();
    window.location.href = BASE_URL + 'index.php?branch='+ branch;
})

$(document).on('click', '#search', function() {
    let from = $("#from").val();
    let to = $("#to").val();
    window.location.href = BASE_URL + 'index.php?from='+ from +'&to=' + to ;
})
</script>