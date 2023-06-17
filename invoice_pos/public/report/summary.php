<?php 

require_once('../../private/initialize.php');
$page = "Report";
$page_title = 'Summary Report'; 

// $branch_id =  $_GET['branch_id'] ?? $loggedInAdmin->branch_id;
// $from = $_GET['from'] ?? date("Y-m-01");
// $to = $_GET['to'] ?? date("Y-m-d");

$branches = Branch::find_by_undeleted();
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

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    .date-display {
      text-align: center;
      margin-bottom: 10px;
    }

    .navigation {
      text-align: center;
      margin-bottom: 10px;
    }
    #currentDate {
      background-color: lightblue;
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
 

<div id="loading-spinner" style="padding-top:400px">
    <div class="spinner-border text-primary" role="status"></div>
    <h3>Processing...</h3>
  </div>
<div class="table-responsive">
 <div class="text-center mb-2">
    <bUtton class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">+ Add Record</bUtton>
 </div>
  <div class="navigation">
    <!-- <div><input type="date" id="dateInput" /></div> -->

   <div class="d-flex align-items-center justify-content-center">
        <div class="mb-2 w-25">
            <h2>Select Date:</h2>
            <input type="date" id="dateInput" class="form-control mb-3">
        <!-- </div>

        <div class="w-25"> -->
            <button id="previousBtn" class="btn btn-sm btn-outline-primary">&larr; Previous</button>
            <button id="nextBtn" class="btn btn-sm btn-outline-primary">Next &rarr;</button>
        </div>
   </div>
    
  </div>

  <div class="date-display">
    <h2 id="currentDate"></h2>
  </div>

  <div id="tableContainer"></div>


</div>
</div>

</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="addcontent">
      
    </div>
  </div>
</div>
<?php include(SHARED_PATH . '/admin_footer.php'); ?>

<script>
$(document).ready(function() {
  var currentDate = new Date(); // Current date
  var dateFormat = 'Y-m-d';
  var selectedDates = [];

  // Fetch and display data for the specified date
  function fetchData(date) {
    $('#loading-spinner').show();
    var formattedDate = formatDate(date);
    $('#currentDate').text(formattedDate);
    
    // Make an AJAX request to fetch data from the server
    $.ajax({
      url: 'inc/fetch_data.php', // Replace with your server-side script that fetches data
      type: 'POST',
      data: { date: formattedDate },
      success: function(response) {
            $('#loading-spinner').hide() 
            $('#currentDate').html(response.date);
            $('#dateInput').val(response.date)
            $('#tableContainer').html(response.table);
        },
        error: function() {
            // Handle error
            console.log('Error occurred while fetching data.');
        }
        
    });
  }
  
  // Format date in "Y-m-d" format
  function formatDate(date) {
    var year = date.getFullYear();
    var month = ('0' + (date.getMonth() + 1)).slice(-2);
    var day = ('0' + date.getDate()).slice(-2);
    return year + '-' + month + '-' + day;
  }
  // Fetch data for the current date on page load
  fetchData(currentDate);
  // Event listener for previous button
  $('#previousBtn').click(function() {
    currentDate.setDate(currentDate.getDate() - 1);
    fetchData(currentDate);
  });
  
  // Event listener for next button
  $('#nextBtn').click(function() {
    currentDate.setDate(currentDate.getDate() + 1);
    fetchData(currentDate);
  });
  
 

  $('#dateInput').change(function() {
    var selectedDate = new Date($(this).val());
    currentDate = selectedDate;
    fetchData(currentDate);
  });
  
  // Event listener for Create or edit Form
  
  let data = 'add';
  let eid = '';
  fetchForm(data, eid);

  function fetchForm(data, eid){
    $.ajax({
        url: 'inc/form_fields.php', 
        type: 'GET',
        data: { 
            fetch: 1,
            action: data,
            id: eid
        },
        success: function(response) {
                $('#loading-spinner').hide() 
                $('#addcontent').html(response);
            },
            error: function() {
                console.log('Error occurred while fetching data.');
            }    
    });
  }

  $(document).on('click', '.oneItem', function(e) {
    $("#myModal").modal('show');
    let eid = $(this).data('id');
    let data = 'edit';
    fetchForm(data, eid);

  })

  $(document).on('click', '#editRecord', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'inc/process_form.php',
            method: 'post',
            data: $('#form').serialize(),
            dataType: 'json',
            success: function(r) {
                if (r.msg == 'OK') {
                    $("#myModal").modal('hide');
                    successTime("Item updated Succesfully");
                    let selectedDate = new Date(r.date);
                    currentDate = selectedDate;
                    fetchData(currentDate);
                    // fetchData(r.date);
                    
                } else {
                    errorAlert('<div>'+ r.msg + '</div>');
                }
            }

        });
    })

  $(document).on('click', '#save', function(e) {
    e.preventDefault();
    console.log($('#form').serialize())
    $.ajax({
        url: 'inc/process_form.php',
        method: 'post',
        data: $('#form').serialize(),
        dataType: 'json',
        success: function(r) {
            if (r.msg == 'OK') {
                successTime("Stock Added Succesfully");
                $("#myModal").modal('hide');
                let selectedDate = new Date(r.date);
                currentDate = selectedDate;
                fetchData(currentDate);
                // fetchData(r.date);
            } else {
                $("#stockErrors").html(r.msg)
                errorAlert('<div>'+ r.msg + '</div>');
            }
        }

    });
})
});
    

</script>