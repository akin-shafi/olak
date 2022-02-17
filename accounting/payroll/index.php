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
    <select class="form-control mr-5" id="month">
      <?php foreach (Payroll::MONTH as $key => $value) { ?>
        <option value="<?php echo date('Y') . "-" . $key ?>" <?php echo date('Y') . "-" . $key == $month ? 'selected' : '' ?>><?php echo $value ?></option>
      <?php } ?>
    </select>
    <input type="button" class="btn btn-sm btn-primary ml-5" id="find" value="Find">
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
    let key = $("#page").val();

    const EXPENDITURE_URL = 'components/action.php';
    const PROCESS = 'components/process.php';

    async function loadPage(key, month, payload) {
      let args = {
        fetch_page: key,
        month: month,
        params: payload,
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
        loadPage('', month);
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

    loadPage(key, month);
    $(document).on('click', '#find', function(e) {
      e.preventDefault();
      let month = $("#month").val();
      loadPage(key, month);
    });

    $(document).on('click', '.query', function(e) {
      let company = this.dataset.company;
      let month = $("#month").val();
      loadPage('company', month, {
        company
      });
    });

    $(document).on('click', '.branchQuery', function(e) {
      let branch = this.dataset.branch;
      let company = this.dataset.company;
      let month = $("#month").val();
      loadPage('branch', month, {
        branch,
        company
      });
    });

    $(document).on('click', '.received', function(e) {
      let month = $("#month").val();
      fetchData(PROCESS + '?confirm_receipt', 'GET', month);
      loadPage(key, month);
    });

    $(document).on('click', '.confirm', function(e) {
      let branch = this.dataset.branch;
      let company = this.dataset.company;
      let confirmed = [];
      $("input[name='payrollId[]']:checked").each(function(i) {
        confirmed[i] = $(this).val();
      });

      loadPage('confirmed_payment', month, {
        confirmed,
        branch,
        company,
      });
      // fetchData(PROCESS + '?confirmed_payment', 'GET', confirmed);
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