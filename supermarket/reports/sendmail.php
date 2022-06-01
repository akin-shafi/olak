<?php require_once('../private/initialize.php');
require_login();
$page = 'Reports';
$page_title = 'Send Report';
?>

<?php

//index.php

$message = '';

$from = $_GET['from'] ?? date('Y-m-d');
// $to = $_GET['to'] ?? date('Y-m-d');
$exception = $_POST['exception'] ?? ''; 
if(isset($_POST['close_reg'])){
    $created_by = $_GET['created_by'] ?? $loggedInAdmin->id;

}else{
    $created_by = $_GET['created_by'] ?? "";
}
if ($created_by != "") {
    $user = $created_by;
}else{
    $user = null;
}





include(SHARED_PATH . '/header.php'); 

?>
<style type="text/css">
	.err {
	    border: 1px solid red;
	  }

	  #hide {
	    display: none;
	  }
	.eSelect{width: 100%; padding: 10px;}
</style>
 <div class="content-wrapper">
		<section class="content">
			<div class="box box-success">
				<div class="container-fluid">
					<h3 align="center"><?php echo $page_title ?></h3>
					<br />
					<div class="d-flex justify-content-between">
						<form method="post">
							<input type="submit" class="btn btn-danger" name="action" id="action" value="Send Report in PDF " /><?php echo $message; ?>
						</form>

						<form class="form-inline p-2 d-flex justify-content-end" >
              <input name="from" class="form-control" type="date" value="<?php echo $from ?>" id="from" >
              <select class="form-control" id="created_by" name="created_by">
                    <option value="">All</option>
                    <?php foreach (Admin::find_by_undeleted() as $key => $value) { ?> 
                        <?php if ($value->admin_level == 4) { ?>
                        <option value="<?php echo $value->id ?>"><?php echo Admin::find_by_id($value->id)->full_name(); ?></option>
                        <?php } ?>
                    <?php } ?>
                  </select>
              <input type="submit" class="btn btn-sm btn-primary" id="find" value="Find">

            </form>
					</div>
					<br />
					<?php
					echo Register::fetch_customer_data($from, $created_by, $exception);
					?>
				</div>		
			</div>	
		</section>
</div>

<div class="modal fade none-border" id="emailModal" aria-modal="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Send Mail</strong></h4>
            </div>
            
            <div class="d-flex justify-content-between p-4">
	            <div><span class="p-4">Mail with attached report Would be sent to email addresss below</span></div>
	            <div><a class="btn btn-sm btn-primary" id="showMore">Show more/less</a></div>
            </div>
            <form id="itemForm">
            	<div id="addError"></div>
	            <div id="attach" class="p-4"></div>
	        </form>
            <h4 class="text-center" style="text-decoration: underline;">Please fill form below</h4>
            <form method="post" id="form" class="p-4 row">
            	<div class="form-group col-lg-4">	
            		<label>Subject</label> 
            		<input type="text" id="subject" placeholder="Sales Report" value="Sales Report" class="form-control">
            	</div>
            	<div class="form-group col-lg-12">
	            	<label>Message</label>            		
	            	<textarea id="body" class="form-control"  style="height: 100px" placeholder="Please find sales report  in attach PDF File." >Please find sales report  in attach PDF File.</textarea>
            	</div>
            	<div class="col-lg-12 d-flex justify-content-end">
	            	<button type="submit" class="btn btn-danger" name="email" id="send">Send</button>
	            </div>
            </form>
        </div>
    </div>
</div>

<?php 
$rec = Recipients::find_by_undeleted();
$total_rec = count($rec) - 1;
 ?>
 <input type="hidden" id="total_rec" value="<?php echo $total_rec ?>">
<?php include(SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">

  $(document).on('click', '#showMore', function(){
    $("#attach").toggle();
  })

  function formatToCurrency(amount){
      return (amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'); 
  }


  sumOfReturn();
  function sumOfReturn(){
    var count = [];
    $('.subtotal').each(function() {
          var item = $(this).text();
          
          count.push(parseInt(item));
          
    });
    const sum = count.reduce((a, b) => a + b, 0);
    var amt2 = formatToCurrency(sum); //"12.35"
    // $("#value_of_sold").text(amt2);
    $("#grand_total").text(amt2);


  }
 

  $(document).on('click', '#send', function(e){
  	e.preventDefault();
  	
  	 var from = $("#from").val();
  	  var to = $("#from").val();
  	  var subject = $("#subject").val();
  	  var body = $("#body").val();
	  var selected = $("#created_by").find('option:selected');
	  var created_by = selected.val();
	  if (subject == "") {
	  	errorAlert("Eror: Email subject is required");
	  }else if(body == ""){
	  	errorAlert("Eror: Email body is required");
	  }else{
	  	$(this).attr("disabled", true).html("Processing...");
	  	var edata = $('#itemForm').serializeArray();
        edata.push(
        	{name: 'sendMail', value: 1},
        	{name: 'from', value: from},
        	{name: 'to', value: to},
        	{name: 'created_by', value: created_by},
        	{name: 'subject', value: subject},
        	{name: 'body', value: body},
        );

	  	$.ajax({
	          url: 'processor/process_mail.php',
	          method: 'post',
	          data: edata,
	          dataType: 'json',
	          success: function(r) {
	            if (r.success == true) {
	            	$('#send').attr("disabled", false).html("Send");
	            	$("#emailModal").modal("hide");
	            	successAlert(r.msg) 
	            } else {
	            	$('#send').attr("disabled", false).html("Send");
	            	$("#emailModal").modal("hide");
	            	errorAlert(r.msg);

	            }       
	          }

	    });
	    $('#send').attr("disabled", false).html("Send");
	  }
  })
 
   $(document).on('click', '#action', function(e){
    e.preventDefault();
    // 
    $.ajax({
          url: 'processor/process_mail.php',
          method: 'post',
          data: {
            process_mail: 1,
          },
          dataType: 'json',
          success: function(r) {
            if (r.msg == "OK") {
            	$("#emailModal").modal("show");
            	 $("#attach").html(r.output)   
            } else {
            	errorAlert("Please Setup mail");
            }       
          }

    });
  })

  var total_rec = $("#total_rec").val();
  var tal_r = parseInt(total_rec);
  addMultipleFormInput(tal_r);
function addMultipleFormInput(tal_r){
   var final_total_amount = $('#final_total_amount').text();
      // console.log(final_total_amount)
      var count = tal_r;
      $(document).on('click', '#add', function() {
        count += 1;

        if (count <= 1) {
          $('.total_item').text(count + ' item');
          $('#item_amt').val(count);
        } else {
          $('.total_item').text(count + ' items');
          $('#item_amt').val(count);
        }

        var html_code = '';
        html_code += '<tr id="row_id' + count + '">';
        html_code += '<td><span id="sr_no">'+count+'.</span></td>';
        html_code += '<td><input type="text"  name="mail[email][]" id="email' + count + '" data-srno="' + count + '" class="form-control  email" placeholder="Recipient Email"></td>';
        html_code += '<td><input type="text"  name="mail[name][]" id="name' + count + '" data-srno="' + count + '" class="form-control name" placeholder="Name"> <input type="hidden" id="type' + count + '" value="2" name="type"></td>';

       

        html_code += '<td><div class="btn-group saveWrap' + count + '" style="display:none"><span class="btn btn-sm save" id="' + count + '">Save</span> <span class="btn btn-sm cancel" id="' + count + '">cancel</span></div><span class="btn remove" id="' + count + '"><i class="fa fa-minus text-danger bold fs-22"></i></span></td>';

        $('#items').append(html_code);

      });
      // Remove Item

      $(document).on('click', '.remove', function() {
          var row_id = $(this).attr('id');
          

          $('#row_id' + row_id).remove();
          count = count - 1;
          if (count <= 1) {
            $('.total_item').text(count + ' item');
            $('#item_amt').val(count);
          } else { 
            $('.total_item').text(count + ' items');
             $('#item_amt').val(count);
          }
      });


      $(document).on('input', '.email', function() {
          var row_id = $(this).data('srno');
          $('.saveWrap' + row_id).css('display', 'block');
      });
      $(document).on('click', '.cancel', function() {
          var row_id = $(this).attr('id');
          $('.saveWrap' + row_id).css('display', 'none');
      });

      
    // $(document).on('click', '.eSelect', function(e) {
    // 	var id = $(this).attr("id");
    // 	var value = $(this).text();
    // 	console.log(id);
    // 	console.log(value);
    // });

    $(document).on('click', '.eSelect', function(e) {
    	var row_id = $(this).data("id");
    	$('.editWrap' + row_id).css('display', 'block');
    });
    $(document).on('click', '.eCancel', function() {
          var row_id = $(this).attr('id');
          $('.editWrap' + row_id).css('display', 'none');
      });

    $(document).on('click', '.edit', function(e) {
    	var id = $(this).attr("id");
    	var eEmail = $("#eEmail"+id);
    	// var eEmail = $('.eEmail'+ id).text();
    	// var eName = $('.eName'+ id).text();
    	var email = $(this).closest('tr').children()[1].firstChild.nextSibling.innerText;
    	var name = $(this).closest('tr').children()[2].firstChild.nextSibling.innerText;
    	$.ajax({
          url: 'processor/add_mail.php',
          method: 'POST',
          data: {
          	'editMail': 1,
          	'id': id,
          	'email': email,
          	'name': name,
          },
          dataType: 'json',
          success: function(r) {
            if (r.msg == 'OK') {
              successAlert("Saved successfully.")
          	  $('.editWrap' + row_id).css('display', 'none');
            }else{
                $("#addError").html(r.error)
                errorAlert("Error: Something went wrong.")
            }
          }
        });
    });

    $(document).on('click', '.save', function(e) {
      e.preventDefault();
      var error = '';
      $('.email').each(function() {
        var counter = 1;
        if ($(this).val() == '') {
          $('.email').removeClass('suc');
          $('.email').addClass('err');
          error += 'Enter email at row ' + counter + '. ';
          return false;
        } else {
          $('.email').removeClass('err');
          $('.email').addClass('suc');
          return true;
        }
        counter = counter + 1;
      });

      $('.name').each(function() {
        var count = 1;
        if ($(this).val() == '') {
          $('.name').removeClass('suc');
          $('.name').addClass('err');
          error += 'Enter item type at row ' + count + '. ';
          return false;
        } else {
          $('.name').removeClass('err');
          $('.name').addClass('suc');
          return true;
        }
        count = count + 1;
      });
      
      

      // var formData = $(this).serialize();
      if (error == '') {
        var row_id = $(this).attr('id');
        var email = $('#email' + row_id).val();
        var name = $('#name' + row_id).val();
        var type = $('#type' + row_id).val();
        $.ajax({
          url: 'processor/add_mail.php',
          method: 'POST',
          data: {
          	'addMail': 1,
          	'email': email,
          	'name': name,
          	'type': type,
          },
          dataType: 'json',
          success: function(r) {
            if (r.msg == 'OK') {
              successAlert("Saved successfully.")
          	  $('.saveWrap' + row_id).css('display', 'none');
            }else{
                $("#addError").html(r.error)
                errorAlert("Error: Something went wrong.")
            }
          }
        });
      } else {
          errorAlert("TO CONTINUE PLEASE, FILL ALL THE NECCESSARY FIELDS.");
      }



    });
     
   
}
</script>