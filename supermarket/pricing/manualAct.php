<?php  require_once('../private/initialize.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manual Activation</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel='stylesheet' href='css/bootstrap.min.css'>
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo url_for('app_assets/assets/images/favicon.png')?>">
	<script src="<?php echo url_for('/assets/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
</head>
<body>
	<div class="container">
		<div class="d-flex justify-content-center border p-2">
			<div class="card border">
				<div class="card-body">
					<form>
						<div class="form-group mb-2">
							<label class="control-label">Select Date</label>
							<input type="date" name="expire_date" id="expire_date" class="form-control">
							<div id="error" class="text-danger"></div>
						</div>
						<div class="form-group">
							<input type="button" value="Submit" id="submit" class="form-control btn btn-primary btn-sm">
						</div>

						<div class="alert alert-warining" style="display: none;">
							<p>Activation Code:</p>
							<strong>
								<code id="code"></code>
							</strong>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
</body>

<script type="text/javascript">
	
	$(document).on('click', '#submit', function(e){
		var expire_date = $("#expire_date").val();
		e.preventDefault();
		if (expire_date != "") {
			$("#error").html("")
			$.ajax({
		          url:"inc/manualProcess.php",
		          method:"POST",
		          data: {
		          	manual: 1,
		          	product: 'Restaurant',
					expire_date: expire_date,
		          },
		          dataType:"json",
		          success:function(r)
		          {
		          	

		          	if(r.msg == 'FAIL'){
		                alert("Error: Subcription Fail Try Later")
		             }else{
		                // successAlert('Created Succesfully')
		                $(".alert").css('display', 'block');
		          		$("#code").html(r.code);
		                window.location.href = '../index.php';

		             }
		             
		             
		          }
		    });
	    }else{
	    	$("#error").html("Required")
	    }
    });
</script>
</html>