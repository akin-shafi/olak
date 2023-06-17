<!DOCTYPE html>
<html>
<head>
  <title>Data Fetching Example</title>
  <style>
    .container {
      margin: 20px;
    }
    .table-container {
      margin-bottom: 20px;
    }
    .date-header {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .table {
      width: 100%;
      border-collapse: collapse;
    }
    .table th, .table td {
      border: 1px solid #ccc;
      padding: 8px;
    }
    .selected-date {
      background-color: lightblue;
    }
  </style>
</head>
<body>
  <div class="container">
    <div>
      <button id="previousBtn">Previous</button>
      <button id="nextBtn">Next</button>
    </div>
    <div class="table-container">
      <h2 class="date-header"></h2>
      <table id="dataTable" class="table">
        <thead>
          <tr>
            <th>Data Column 1</th>
            <th>Data Column 2</th>
            <th>Data Column 3</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <div>
      <h2>Selected Dates:</h2>
      <ul id="selectedDates"></ul>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script >
   $(document).ready(function() {
        var currentDate = new Date(); // Current date
        var dateFormat = 'Y-m-d';
        var selectedDates = [];

        // Fetch and display data for the specified date
        function fetchData(date) {
            var formattedDate = formatDate(date);
            $('.date-header').text(formattedDate);
            
            // Make an AJAX request to fetch data from the server
            $.ajax({
            url: 'inc/fetch_data.php', // Replace with your server-side script that fetches data
            type: 'POST',
            data: { date: formattedDate },
            success: function(response) {
                displayData(response.table);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
            });
        }
        
        // Display the fetched data in the table
        function displayData(data) {
            var tableBody = $('#dataTable tbody');
            tableBody.empty(); // Clear existing data
            
            for (var i = 0; i < data.length; i++) {
            var row = '<tr>' +
                        '<td>' + data[i].column1 + '</td>' +
                        '<td>' + data[i].column2 + '</td>' +
                        '<td>' + data[i].column3 + '</td>' +
                        '</tr>';
            tableBody.append(row);
            }
        }
        
        // Format date in "Y-m-d" format
        function formatDate(date) {
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
            return year + '-' + month + '-' + day;
        }
        
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
        
        // Event listener for table row click to select/deselect date
        $(document).on('click', '#dataTable tbody tr', function() {
            var clickedDate = $('.date-header').text();
            var index = selectedDates.indexOf(clickedDate);
            
            if (index === -1) {
            selectedDates.push(clickedDate);
            $(this).addClass('selected-date');
            $('#selectedDates').append('<li>' + clickedDate + '</li>');
            } else {
            selectedDates.splice(index, 1);
            $(this).removeClass('selected-date');
            $('#selectedDates li:contains(' + clickedDate + ')').remove();
            }
        });
        });

  </script>
</body>
</html>