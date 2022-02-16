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
        <option value="<?php echo date('Y') . "-" . $key ?>" <?php echo date('Y') . "-" . $key == $month ? 'selected' : '' ?>><?php echo $value ?></option>
      <?php } ?>
    </select>

    <input type="button" class="btn btn-sm btn-primary" id="find" value="Find">
  </form>
</div>


<div id="get_payroll"></div>


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
  $(document).ready(function() {
    let month = $("#month").val();
    let page = $("#page").val();
    let selected = $("#company_id");
    let company_id = selected.val();

    const EXPENDITURE_URL = 'components/action.php';
    const PROCESS = 'components/process.php';

    async function loadPage(page, month, company_id) {
      let args = {
        fetch_page: page,
        company_id: company_id,
        month: month,
      };
      let response;

      try {
        response = await $.ajax({
          url: EXPENDITURE_URL,
          type: 'GET',
          data: args,
          beforeSend: function() {
            $('#ajax_loader').show();
          },
        });

        $('#ajax_loader').hide();
        $("#get_payroll").html(response);
        $("table").DataTable({
          order: [0, 'ASC']
        });
      } catch (error) {
        $('#ajax_loader').hide();
        console.error(error);
      }
    }

    async function fetchData(url, type, payload) {
      let response;
      try {
        response = await $.ajax({
          url: url,
          type: type,
          data: {
            params: payload,
          },
          dataType: 'json',
          beforeSend: function() {
            $('#ajax_loader').show();
          },
        });

        $('#ajax_loader').hide();
        let month = $("#month").val();
        let company_id = $("#company_id").val();
        loadPage(page, month, company_id);
      } catch (error) {
        $('#ajax_loader').hide();
        let err = JSON.parse(error.responseText);
        swal({
          icon: 'error!',
          title: 'Oops...',
          timer: 2000,
          text: err.msg,
          footer: '<a href="">Why do I have this issue?</a>'
        })
      }
    }

    loadPage(page, month, company_id);
    $(document).on('click', '#find', function(e) {
      e.preventDefault();
      let company_id = $("#company_id").val();
      let month = $("#month").val();
      loadPage(page, month, company_id);
    });

    $(document).on('click', '.received', function(e) {
      let month = $("#month").val();
      let company_id = $("#company_id").val();
      fetchData(PROCESS + '?confirm_receipt', 'GET', month);

      loadPage(page, month, company_id);
    });

    $(document).on('click', '.confirm', function(e) {
      let confirmed = [];
      $("input[name='payrollId[]']:checked").each(function(i) {
        confirmed[i] = $(this).val();
      });

      fetchData(PROCESS + '?confirmed_payment', 'GET', confirmed);
    });

    $(document).on('click', '#selectAll', function(e) {
      let table = $(e.target).closest('table');
      $('td input:checkbox', table).prop('checked', this.checked);
    });

    $(document).on('click', '.download', function(e) {
      $("#downloadExcelModal").modal('show')
    });

  })
</script>