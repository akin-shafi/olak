<?php require_once('../../private/initialize.php');
$page = 'Stock';
$page_title = 'Stock'; 
require_login();
$from = $_GET['from'] ?? date('Y-m-d');
$to = $_GET['to'] ?? date('Y-m-d');
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

              

              <div class="">
                <label class="label-control">Branch</label>
                <?php if (in_array($loggedInAdmin->admin_level, [1,2,3])) : ?>
                <select class="form-control" id="filter_branch" style="width: 150px; ">
                    <option value="" selected>All</option>
                    <?php foreach (Branch::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                    <option value="<?php echo $value->id ?>" <?php echo $branch_id ==  $value->id ? 'selected' : ''; ?>><?php echo $value->branch_name ?> </option>
                    <?php } ?>
                    
                </select>
                <?php else: ?>
                   
                    <input type="hidden" id="filter_branch" name="" value="<?php echo $branch_id ?>">
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label class="label-control">Date From:</label>
                <input type="date" id="date_from" class="form-control" value="<?php echo $from ?>">
              </div>
              <div class="form-group">
                <label class="label-control">Date To:</label>
                <input type="date" id="date_to" class="form-control" value="<?php echo $to ?>">
              </div>
              <button type="button" id="search" class="btn btn-primary btn-sm">Search</button>
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
                    <tr class="text-center text-uppercase">
                        <th>S/n</th>
                        <th>Item</th>
                        <th class="d-none" title="TotalStock - Sales">OPENING STOCK</th>
                        <th>STOCK IN/EXCESS</th>
                        <th> BREAKAGES/SCRAP</th>
                        <th>RETURNED INWARDS</th>
                        <th title="StockIn + ReturnInward">TOTAL STOCK</th>
                        <th> OUTFLOW/SALES</th>
                        
                        <th title="TotalStock - Outflow - breakage"> CLOSING STOCK </th>
                        <th title="ClosingStock - Breakage "> TOTAL (CLOSING STOCK) </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $sn = 1; 
                    $company_id = $loggedInAdmin->company_id;
                    $branch_id = $_GET['branch'] ?? $loggedInAdmin->branch_id;
                    $product =  Product::find_by_branch_id(['branch_id' => $branch_id]);
                     foreach ($product as $key => $item) {
                      
                      
                      $stock_in = StockDetails::find_by_date([ 'item_id' => $item->id, 'from' => $from, 'to' => $to, 'order' => 'ASC']);

                      $arr = end($stock_in);
                    //   pre_r($arr);
                      $last_entry = $arr->supply ?? 0;
                      $breakage = $arr->breakage ?? 0;
                      $return_inward =  $arr->return_inward ?? 0;
                    
                      $totalStock = StockDetails::sum_of_Stock(['item_id' => $item->id,   //'from' => $from 
                      ])  ?? 0;
                      $sales = Invoice::find_all_by_service_type(['service_type' => $item->id , 'status' => 1 , 'from' => $from, 'to' => $to,]);
                     
                      $outflow = intval($sales->sum_of_quantity) ?? 0;
                      $opening_stock = $totalStock - $outflow;
                      $closingStock = intval($totalStock - $outflow - $breakage + $return_inward); //* TotalStock - Outflow - breakage
                     
                      $totalClosingStock = intval($closingStock - $breakage ) ?? 0; //* Breakage + ClosingStock 
                      if (!empty($item->ref_no)) {
                        $supply = StockDetails::find_by_ref($item->ref_no)->supply ?? "0";
                        $sold = StockDetails::find_by_ref($item->ref_no)->sold_stock ?? "0";
                        $outflow = StockDetails::find_by_ref($item->ref_no)->deleted ?? "0";
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
                        <td class="d-none"><?php echo $opening_stock?></td>
                        <td><?php echo $last_entry ?></td>
                        <td><?php echo $breakage ?></td>
                        <td><?php echo $return_inward ?></td>
                        <td><?php echo $totalStock ?? 0; ?></td>
                        <td><?php echo $sales->sum_of_quantity ?? 0; ?></td>
          
                        <td><?php echo $closingStock ?? 0; ?></td>
                        <td><?php echo $totalClosingStock; ?></td>
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
// alert($("#filter_branch").val());

$(document).on('click', '#addStock', function(e) {
    e.preventDefault();
    let selected = $("#filter_branch").find(":selected").val() || $("#filter_branch").val();
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
                window.location.href = BASE_URL + '?branch=' +selected;
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
search
$(document).on('change', '#filter_branch', function() {
    let from = $("#date_from").val();
    let to = $("#date_to").val();
    let branch = $(this).val();
    // window.location.href = BASE_URL + 'index.php?branch='+ branch;
    window.location.href = BASE_URL + 'index.php?branch='+ branch + '&from=' +from +'&to=' + to ;
})

$(document).on('click', '#search', function() {
    let from = $("#date_from").val();
    let to = $("#date_to").val();
    let branch = $("#filter_branch").val();
    window.location.href = BASE_URL + 'index.php?branch='+ branch + '&from=' +from +'&to=' + to ;
})
</script>