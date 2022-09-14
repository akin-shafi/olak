<?php require_once('../private/initialize.php');
$page_title = 'List';
$page = 'Products'; 
include(SHARED_PATH . '/header.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Products</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Products</li>
        </ol>
    </section>

    <div class="col-lg-12 alerts">
        <div id="custom-alerts" style="display:none;">
            <div class="alert alert-dismissable">
                <div class="custom-msg"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <style type="text/css">
    .table td:first-child {
        padding: 1px;
    }

    .table td:nth-child(6),
    .table td:nth-child(7),
    .table td:nth-child(8) {
        text-align: center;
    }

    .table td:nth-child(9),
    .table td:nth-child(10) {
        text-align: right;
    }
    </style>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="dropdown pull-right">
                            <a href="<?php echo url_for('products/exportData2.php') ?>" class="btn btn-success"><i
                                    class="fa fa-file-excel-o"></i> Export as CSV</a>
                            <!-- <button class="btn btn-primary" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      alphaPOS (POS)                        
                      <span class="caret"></span> -->
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                            </ul>
                        </div>
                        <div class=" d-flex justify-content-center mn-4">
                            <?php echo display_session_message(); ?>
                        </div>
                        <h3 class="box-title">Please use the table below to navigate or filter the results.</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered table-hover"
                                style="margin-bottom:5px;">
                                <thead>
                                    <tr class="active">
                                        <th style="max-width:30px;">ID</th>
                                        <th style="max-width:30px;">Image</th>
                                        <!-- <th class="col-xs-1">Code</th> -->
                                        <th>Name</th>
                                        <!-- <th class="col-xs-1">Type</th> -->
                                        <th class="col-xs-1">Category</th>
                                        <th class="col-xs-1">Quantity</th>
                                        <!-- <th class="col-xs-1">Tax</th> -->
                                        <!-- <th class="col-xs-1">Method</th> -->
                                        <th class="col-xs-1">P.Price</th>
                                        <th class="col-xs-1">S.Price</th>
                                        <th style="width:165px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sn = 1; foreach (Product::find_by_company(['company_id' => $loggedInAdmin->company_id,  'branch_id' => $loggedInAdmin->branch_id, ]) as $key => $value) {

                                        $stock = StockDetails::sum_of_Stock([ 'item_id' => $value->id, 
                                        //   'from' => $date,
                                          ]) ?? 0;
                                          $sales = Sales::find_all_by_product_id(['product_id' => $value->id, 
                                        //   'from'=> $date 
                                        ]);
                                          $qty = $sales ?? 0;
                                          $left_over = intval($stock - $qty);
                                    // pre_r($value);
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++; ?> </td>
                                        <td>
                                            <div style="width:32px; margin: 0 auto;"><a
                                                    href="<?php echo !empty($value->file) ? url_for('/uploads/thumbs/' . $value->file) :  url_for('/uploads/thumbs/bottles.jpg'); ?>"
                                                    class="open-image">
                                                    <img src="<?php echo !empty($value->file) ? url_for('/uploads/thumbs/' . $value->file) :  url_for('/uploads/thumbs/bottles.jpg'); ?>"
                                                        alt="images" class="img-responsive"></a></div>
                                        </td>
                                        <!-- <td><?php //echo $value->code; ?></td> -->
                                        <td><?php echo $value->pname; ?></td>
                                        <!-- <td><?php //echo $value->type; ?></td> -->
                                        <td>
                                            <?php 
                                  $e = $value->category; 
                                  $cat = ProductCategory::find_by_id($value->category)->category;
                                if($e == 1) { ?>
                                            <span class="label label-danger"><?php echo $cat ?></span>
                                            <?php }else if($e == 2) { ?>
                                            <span class="label label-success"><?php echo $cat ?></span>
                                            <?php }else if($e == 3) { ?>
                                            <span class="label label-danger"><?php echo $cat ?></span>
                                            <?php }else if($e == 4) { ?>
                                            <span class="label bg-black text-white"><?php echo $cat ?></span>
                                            <?php }else if($e == 5) { ?>
                                            <span class="label label-warning"><?php echo $cat ?></span>
                                            <?php }else{ ?>
                                            <span class="label label-primary"><?php echo $cat ?></span>

                                            <?php } ?>
                                        </td>
                                        <td><?php echo $left_over; ?></td>
                                        <!-- <td><?php //echo $value->product_tax; ?></td> -->
                                        <!-- <td>
                                        <?php //$n = $value->tax_method;
                              //echo ($n == 2) ? '<span class="label label-primary">Inclusive</span>' : '<span class="label label-warning">Exclusive</span>'; ?>
                                        </td>
 -->                                        <td><?php echo $value->cost; ?></td>
                                        <td><?php echo $value->price; ?></td>
                                        <td>
                                            <div class="text-center">
                                                <div class="btn-group">

                                                    <a title="View" class="tip btn btn-primary btn-xs view"
                                                        data-id="<?php echo $value->id; ?>"><i
                                                            class="fa fa-file-text-o"></i></a>



                                                    <a title="Print Labels" class="tip btn btn-default btn-xs label"
                                                        data-id="<?php echo $value->id; ?>"><i
                                                            class="fa fa-print"></i></a>

                                                    <a href="#" title="Print Barcodes"
                                                        class="tip btn btn-default btn-xs barcode"
                                                        data-id="<?php echo $value->id; ?>"><i
                                                            class="fa fa-print"></i></a> <a
                                                        href="<?php echo url_for('/products/edit.php?id=') ?><?php echo $value->id; ?>"
                                                        title="Edit Product" class="tip btn btn-warning btn-xs edit"
                                                        data-id="<?php echo $value->id; ?>"><i
                                                            class="fa fa-edit"></i></a> <a title="Delete Product"
                                                        class="tip btn btn-danger btn-xs delete"
                                                        data-id="<?php echo $value->id; ?>"><i
                                                            class="fa fa-trash-o"></i></a>
                                                </div>
                                        </td>


                                    </tr>
                                    <!-- <tr>
                               <td colspan="12" class="dataTables_empty">Leading data from server</td>
                            </tr> -->
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="url" value="<?php echo url_for('/products') ?>">
    </section>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
<div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="show_view">

        </div>
    </div>
</div>

<div class="modal fade" id="picModal" tabindex="-1" role="dialog" aria-labelledby="picModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                        class="fa fa-times"></i></button>
                <button type="button" class="close mr10" onclick="window.print();"><i class="fa fa-print"></i></button>
                <!-- <h4 class="modal-title" id="myModalLabel">Print label</h4> -->
            </div>
            <div class="modal-body text-center" id="product_image">
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="module" value="<?php echo url_for('/products/') ?>" />
<script type="text/javascript">
$(document).ready(function() {
    var eUrl = $("#url").val();
    $(document).on('click', '.view', function() {
        $("#posModal").modal("show");
        var eid = $(this).data('id');
        // console.log(id)
        $.ajax({
            url: "/inc/process.php",
            method: "POST",
            data: {
                view: 1,
                id: eid,
            },
            success: function(r) {
                $("#show_view").html(r)
            }
        });
    });

    $(document).on('click', '.delete', function() {
        $("#posModal").modal("show");
        var eid = $(this).data('id');
        var module = $("#module").val();
        // console.log(eid)
        if (confirm("Are you sure you want to delete this product ?")) {
            $.ajax({
                url: module + "/inc/process.php",
                method: "POST",
                data: {
                    delete: 1,
                    id: eid,
                },
                dataType: "json",
                success: function(r) {
                    if (r.msg == 'OK') {
                        // fetch_data();
                        window.location.href = 'index.php'
                        successTime("Deleted Succesfully")
                    }
                }
            });
        } else {
            return false;
        }
    });

    $('#prTables').on('click', '.image', function() {
        var a_href = $(this).attr('href');
        var code = $(this).attr('id');
        $('#myModalLabel').text(code);
        $('#product_image').attr('src', a_href);
        $('#picModal').modal();
        return false;
    });
    $(document).on('click', '.barcode', function() {
        $('#picModal').modal('show');
        var code = $(this).data('id');

        $.ajax({
            url: "/inc/barcode.php",
            method: "POST",
            data: {
                print_barcode: 1,
                id: code,
            },
            success: function(r) {
                $("#product_image").html(r);

            }
        });
    });

    $(document).on('click', '.label', function() {
        $('#picModal').modal('show');
        var code = $(this).data('id');

        $.ajax({
            url: "/inc/label.php",
            method: "POST",
            data: {
                print_label: 1,
                id: code,
            },
            success: function(r) {
                $("#product_image").html(r);

            }
        });
    });
    $('#prTables').on('click', '.open-image', function() {
        var a_href = $(this).attr('href');
        var code = $(this).closest('tr').find('.image').attr('id');
        $('#myModalLabel').text(code);
        $('#product_image').attr('src', a_href);
        $('#picModal').modal();
        return false;
    });
});
</script>