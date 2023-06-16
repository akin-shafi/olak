<?php 

require_once('../../private/initialize.php');
$page = "Report";
$page_title = 'Report'; 

$branch_id =  $_GET['branch_id'] ?? $loggedInAdmin->branch_id;
$from = $_GET['from'] ?? date("Y-m-01");
$to = $_GET['to'] ?? date("Y-m-d");


?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<style>
    #loading-spinner {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.8);
    z-index: 2;
  }
    .filter-container {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
    }

    .filter-input {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .filter-label {
      min-width: 70px;
    }

    /* Additional styling for the table (just for visualization purposes) */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
<div class="main-container">


  <!-- Page header start -->
  <div class="page-title">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <h5 class="title"><?php echo $page_title ?></h5>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="daterange-container">

          
        </div>
      </div>
    </div>
  </div>
  <!-- Page header end -->
<div class="content-wrapper">
 

 <div class="container">
    <form class="row" action="/inc/export.php">
      <div class="col-md-3">
        <div class="mb-3">
          <label for="date_from" class="form-label">From:</label>
          <input id="date_from" value="<?php echo $from ?>" name="from" class="form-control" type="date" placeholder="Filter by 'From'">
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="date_to" class="form-label">To:</label>
          <input id="date_to" name="to" value="<?php echo $to ?>" class="form-control" type="date" placeholder="Filter by 'To'">
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="branch-input" class="form-label">Branch:</label>
          <?php if (in_array($loggedInAdmin->admin_level, [1,2,6])) { ?>
            <select class="form-control" name="branch_id" id="branch_id" >
              <option value="" >All</option>
              <?php foreach (Branch::find_by_undeleted() as $key => $value) { ?>
                <option value="<?php echo $value->id ?>" <?php echo $branch_id == $value->id ? 'selected' : ''?> ><?php echo $value->branch_name; ?></option>
              <?php } ?>
            </select>
          <?php } ?>
        </div>
      </div>

      <div class="col-md-3">
        <div class="mb-3">
          <label for="branch-input" class="form-label">...</label> <!-- Empty label to align the button -->
          <button id="filter" class="btn btn-primary w-100">Filter</button>
        </div>
      </div>

      
    </form>
  </div>

<div id="loading-spinner" style="padding-top:400px">
    <div class="spinner-border text-primary" role="status"></div>
    <h3>Processing...</h3>
  </div>
<div class="table-responsive">
  <div class="d-flex justify-content-end mb-3">
    <button id="exportBtn" class="btn btn-success me-3"><i class="fa fa-file-excel-o"></i>  Export Data as CSV</button>
  
  </div>

  <div id="get_data"></div>

   <table id="rowSelection" class="table table-sm table-striped " >
    <thead>
      <tr role="row">
        <th>S/N</th>
        <th>Trans ID</th>
        <th>Date</th>
        <th>Customer Name</th>
        <th>Product Name</th>
        <th>Unit Cost</th>
        <th>Quantity</th>
        <th>Grand Total</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="show_data"></tbody>
  </table>
 
</div>
</div>

</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
 
 $("#exportBtn").click(function() {
    // Retrieve input field values
      var dateFrom = $("#date_from").val();
      var dateTo = $("#date_to").val();
      var branch = $("#branch_id").val();
      const eUrl = 'inc/export.php'

      // Construct the URL with parameters
      var url = eUrl + "?date_from=" + encodeURIComponent(dateFrom) +
                "&date_to=" + encodeURIComponent(dateTo) +
                "&branch=" + encodeURIComponent(branch);

      // Open the URL in a new window
      window.open(url);

    });
  


    $('#filter').click(function(e) {
      e.preventDefault();
      $('#loading-spinner').show();
      $.ajax({
          url: 'inc/filter.php',
          method: "POST",
          data: {
            branch_id: $("#branch_id").val(),
            from: $("#date_from").val(),
            to: $("#date_to").val(),
          },
          success: function(r) {
            $('#show_data').html(r);
            $('#loading-spinner').hide();

          }
      });
    });


    setTimeout(function () {
        $('#loading-spinner').hide() 
    }, 1000);
</script>