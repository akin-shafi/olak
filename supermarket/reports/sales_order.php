<?php require_once('../private/initialize.php');
$page_title = 'Sales Order';
$page = 'Report';
require_login();
include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title ." ". $page; ?></h1>
       
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" style="display:none;">
          <div class="alert alert-dismissable">
             <div class="custom-msg"></div>
          </div>
       </div>
    </div>
    <section class="content">

       <div class="row">
       <!--  <div class="col-xs-12">
          
        </div> -->
          <div class="col-xs-12">

            <div class="box box-success">
                
                <div class="box-header border-bottom bg-success">
                   <div class="dropdown pull-right">
                      
                      <div class="daterange-container btn btn-">
                        <div class="date-range">
                          <div id="reportrange">
                            <i class="feather-calendar cal"></i>
                            <span class="range-text"></span>
                            <i class="feather-chevron-down arrow"></i>
                          </div>
                        </div>
                        <form class="form-inline p-2 d-flex justify-content-end" >
                          <input max="<?php echo date("Y-m-d") ?>" class="form-control" type="date" value="<?php echo date("Y-m-d") ?>" id="from" >
                          <?php if (in_array($loggedInAdmin->admin_level, [4])){ ?>
                            <input type="text" readonly=""class="form-control" value="<?php echo Admin::find_by_id($loggedInAdmin->id)->full_name()  ?>">
                            <input type="hidden" class="form-control" id="created_by" value="<?php echo $loggedInAdmin->id ?>">
                          <?php }else{ ?>
                              <select class="form-control" id="created_by">
                                <option value="">All</option>
                                <?php foreach (Admin::find_by_undeleted() as $key => $value) { ?> 
                                    <?php if ($value->admin_level == 4) { ?>
                                    <option value="<?php echo $value->id ?>"><?php echo Admin::find_by_id($value->id)->full_name(); ?></option>
                                    <?php } ?>
                                <?php } ?>
                              </select>
                          <?php } ?>
                          <input type="button" class="btn btn-sm btn-success" id="find" value="Find">

                        </form>
                       
                      </div>
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                      </ul>
                   </div>
                   <h3 class="box-title " style="color: #000; padding-top: 18px">You can customize the report as your requirement</h3>
                </div>
                <!--  -->
                <div class="box-body">
                  <div class="modal-content" id="show_register">Processing...</div>
                </div>
            </div>
          </div>
       </div>
    </section>
 </div>


<!-- <input type="text" value="<?php //echo $from ?>" id="dfrom"> -->
<div class="modal fade none-border" id="itemModal" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Item</strong></h4>
            </div>
            <div id="fetchItem"></div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
 
<script type="text/javascript">
  var from = $("#from").val();
  // var created_by = $("#created_by").val();
  var selected = $("#created_by").find('option:selected');
  var created_by = selected.val();
  load_register(from, created_by);
  function load_register(from, created_by) {
     
      $.ajax({
        url: 'inc/fetch_sales_order.php', 
        method: 'post',
        data: {
          fetch: 1,
          from: from,
          created_by: created_by,
        },
        // dataType: 'json',
        success: function(r) {
          $('#show_register').html(r);       
        }
      });
  }

  $(document).on('click', '#find', function(e){
        e.preventDefault();
        var from = $("#from").val();
        var selected = $("#created_by").find('option:selected');
        var created_by = selected.val();
        load_register(from, created_by);
  })

  $(document).on('click', '.item', function(e) {
      e.preventDefault()
      var id = $(this).data('item');
      var dfrom = $('#from').val();

      $('#itemModal').modal('show');
      $.ajax({
        url: 'inc/fetch_item.php',
        method: 'post',
        data: {
          fetch: 1,
          id: id,
          from: dfrom,
        },
        // dataType: 'json',
        success: function(r) {
              $('#fetchItem').html(r);       
        }
      });
  })
</script>