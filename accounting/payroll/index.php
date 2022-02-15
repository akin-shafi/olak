<?php
require_once('../private/initialize.php');

$page = 'payroll';
$page_title = '';

$lastDate = date('Y-m', strtotime('last month'));
$thisDate = date('Y-m');
$month = $_GET['month'] ?? $thisDate;


include(SHARED_PATH . '/admin_header.php');
?>



<div class="d-flex justify-content-between">
 <h5 class="border-bottom pb-2 text-capitalize"><b><?php echo $page ?></b></h5>
 <form class="form-inline p-2 d-flex justify-content-end" id="find_week">

      <select class="form-control" id="company_id">
        <option value="">All</option>
          <?php foreach ($company as $key => $value) { ?>
            <option value="<?php echo $value->id ?>"><?php echo $value->company_name ?></option>
          <?php } ?>
         </select>

        <select class="form-control" id="month">
          <?php foreach (Payroll::MONTH as $key => $value) { ?>
            <option value="<?php echo date('Y')."-".$key ?>" <?php echo date('Y')."-".$key == $month ? 'selected' : '' ?>><?php echo $value ?></option>
          <?php } ?>
        </select>
        
        <input type="button" class="btn btn-sm btn-primary" id="find" value="Find">
  </form>
</div>


<div id="pageloader"></div>


<div class="modal" id="downloadExcelModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Select Template</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="btn-group">
          <a href="<?php echo url_for('payroll/exportData.php?id=1') ?>" class="btn-warning btn" style="background:orange; color: #FFF;"> Download for Access Bank</a>
          <a href="<?php echo url_for('payroll/exportData.php?id=2') ?>" class=" btn" style="background:purple; color: #FFF;"> Download for Wema Bank</a>
        </div>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="page" value="<?php echo $page; ?>">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>
<script type="text/javascript">


  var month = $("#month").val();
  var page = $("#page").val();
  var selected = $("#company_id");
  var company_id = selected.val();

  // console.log(month)
  loadPage(page, month, company_id);
  //View Record

  $(document).on('click', '#find', function(e) {
       e.preventDefault();
    var company_id = $("#company_id").val();
    var month = $("#month").val();
    loadPage(page, month, company_id);
  })

   function loadPage(page, month, company_id){
     $("#pageloader").html("<h3 class='text-center text-primary' id='loader' style='margin-top: 150px;'>Loading...</h3>");
     $.ajax({
      url : "components/action.php",
      type: "POST",
      data: {
          fetch_page: page,
          company_id: company_id,
          month: month,
      },
      success:function(response){
        $("#loader").css('display', 'none');
          $("#pageloader").html(response);
          $("table").DataTable({
            order:[0, 'ASC']
          });
        }
      });
    }


    $(document).on('click', '.download', function(e) {
      $("#downloadExcelModal").modal('show')
    })

  


   
</script>
