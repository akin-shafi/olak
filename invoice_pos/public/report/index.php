<?php 

require_once('../../private/initialize.php');
$page = "Report";
$page_title = 'Report'; 

$from = date("Y-m-01");
$to = date("Y-m-d");

$branch_id = $loggedInAdmin->branch_id;


?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>


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
    <div class="border">
      <!-- <div class="h4"> Transaction Report</div> -->
      <div class="page-title">
        <div class="row gutters">
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <h5 class="title">Transaction Report</h5>
          </div>
          <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="d-flex justify-content-end">
              <div class="daterange-container d-none">
                <div class="date-range">
                  <div id="reportrange">
                    <i class="feather-calendar cal"></i>
                    <span class="range-text"></span>
                    <i class="feather-chevron-down arrow"></i>
                  </div>
                </div>
              </div>
              <input type="date" name="dateFilter" id="dateFilter" value="<?php echo date('Y-m-d') ?>">
              <?php if (in_array($loggedInAdmin->admin_level, [1,2,6])) { ?>
                <select class="form-control" id="filter-branch" style="width: 150px;">
                  <option value="" selected>All</option>
                  <?php foreach (Branch::find_by_undeleted() as $key => $value) { ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->branch_name ?></option>
                  <?php } ?>
                </select>
              <?php }else{ ?>
                <input type="text" readonly value="<?php echo Branch::find_by_id($loggedInAdmin->branch_id)->branch_name ?>" class="form-control" style="width: 150px;">

                <input type="hidden" value="<?php echo $loggedInAdmin->branch_id ?>" id="filter-branch" name="">
              <?php } ?>

              <button class="btn btn-primary" id="query">Filter</button>

            </div>


          </div>
        </div>
      </div>



      
    </div>

    

    <div id="salesReport"></div>
    
      
    
</div>

<div class="lds-hourglass d-none"></div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script type="text/javascript">
 


  $(function() {
    // var start = moment().subtract(29, 'days');
    var start = moment().subtract(1, 'days');
    var end = moment().subtract(1, 'days');
    function cb(start, end) {
      $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
    }
    $('#reportrange').daterangepicker({
      opens: 'left',
      startDate: start,
      endDate: end,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, cb);
    cb(start, end);


    const EXPENSE_URL = 'inc/process.php';
    $(document).on('click', "#query", function() {
      let branch = $('#filter-branch').val()
      let selectedDate = $('#dateFilter').val()
        getDataSheet(branch, selectedDate);
    })

    // JavaScript/jQuery code
$(document).on('click', "#query", function() {
    let branch = $('#filter-branch').val()
    let selectedDate = $('#dateFilter').val()
    disableButton(); // Call the function to disable the button and show "Processing"
    getDataSheet(branch, selectedDate);
})

const getDataSheet = (branch, fltDate) => {
    $.ajax({
        url: EXPENSE_URL,
        method: "GET",
        data: {
            branch: branch,
            rangeText: fltDate,
            filter: 1
        },
        cache: false,
        beforeSend: function() {
            $('.lds-hourglass').removeClass('d-none');
        },
        success: function(r) {
            $('#salesReport').html(r);
            setTimeout(() => {
                $('.lds-hourglass').addClass('d-none');
                enableButton(); // Call the function to enable the button after data is received
            }, 250);
        },
        error: function() {
            // In case of an error, enable the button again
            enableButton();
        }
    });
}

function disableButton() {
    $('#query').prop('disabled', true); // Disabling the button
    $('#query').text('Processing...'); // Updating button text
    $('.lds-hourglass').removeClass('d-none'); // Show the "Processing" animation
}

function enableButton() {
    $('#query').prop('disabled', false); // Enabling the button
    $('#query').text('Query Data'); // Restoring original button text
    $('.lds-hourglass').addClass('d-none'); // Hiding the "Processing" animation
}


    
    let branch = $('#filter-branch').val()
    let selectedDate = $('#dateFilter').val()

    getDataSheet(branch, selectedDate)
    // console.log(selectedDate)
  });







  
</script>