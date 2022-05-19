<?php  require_once('../private/initialize.php'); 
$subscription = Activation::find_by_product('PMS');

 $start_date  = strtotime(date('Y-m-d H:i:s'));
 $end_date = strtotime($subscription->expire_date);
 // $dateDiff = $end_date - $start_date;


$dateDiff = dateDifference($start_date, $end_date);

 function dateDifference($start_date, $end_date)
{
    // calulating the difference in timestamps 
    $diff = strtotime($start_date) - strtotime($end_date);
     
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds
    return ceil(abs($diff / 86400));
    
}

// $admin_level = in_array($loggedInAdmin->admin_level, [1,2]) ?? "";
$page_title = "Subscription Renewal";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pricing Page</title>
	<link rel="stylesheet" type="text/css" href="<?php echo url_for('pricing/css/style.css') ?>">
	<link rel='stylesheet' href='<?php echo url_for('pricing/css/bootstrap.min.css') ?>'>
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo url_for('app_assets/assets/images/favicon.png')?>">
	<script src="<?php echo url_for('/assets/plugins/jQuery/jQuery-2.1.4.min.js')?>"></script>
</head>
<body>
	  <div class="container">
	  	<div class="border-bottom">
	        <a style="text-decoration: none; color: #FFF" href="<?php echo url_for('/') ?>" class="d-flex justify-content-between">
		        <span><- Back</span> 

		        <img class="logo-compact" src="<?php echo url_for('app_assets/images/logo-text-white.png') ?>" alt="">
		    </a> 
	    </div>
	    <div class="text-center text-uppercase fs-20 text-light"><strong><?php echo $page_title ?></strong></div>
	  </div>
	  
	<?php if (isset($loggedInAdmin->id)) { ?>
	    <div class="container">
		  <div class="row my-4">
		    <div class="col-md-12">
		      <div class="card card-table mb-0">
		        <div class="card-header bg-k">
		          <h4 class="card-title mb-0">Current Plan </h4>
		        </div>
		        <div class="card-body">
		          <div class="table-responsive">
		            <table class="table table-hover table-center mb-0">
		              <thead>
		                <tr>
		                  <th>Plan</th>
		                 
		                  <th>Package</th>
		                  <!-- <th>Admins</th> -->
		                  <!-- <th>Rider/Driver</th> -->
		                  <th>Start Date</th>
		                  <th>End Date</th>
		                  <th>Amount</th>
		                  <th>Days Left</th>
		                  
		                </tr>
		              </thead>
		              <tbody>
		                 
		                  <tr>
		                    <td> <?php echo $subscription->plan ?? 'Not Set'; ?></td>
		                    
		                    <td><?php echo $subscription->plan_type ?? 'Not Set'; ?></td>
		                    <!-- <td>1</td> -->
		                    <!-- <td>1</td> -->
		                    <td><?php echo date("D d M  y h:ia", strtotime($subscription->create_date)) ?? 'Not Set'; ?></td>
		                    <td><?php echo date("D d M  y h:ia", strtotime($subscription->expire_date)) ?? 'Not Set'; ?></td>
		                    <td><?php echo $currency . number_format($subscription->amount, 2) ?? 'Not Set'; ?></td>
		                    
		                    <td><div class="btn bg-gradient-navy btn-sm"><?php echo $dateDiff . " Days "; ?></div></td>
		                    
		                  </tr>
		                
		              </tbody>
		            </table>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
	    </div>

	    <div class="container">
	      <div class="row justify-content-center mb-4">
	      	<div class="col-auto">
	          <nav class="nav btn-group">
	            <a href="#monthly" data-type="1" class="plan_type btn btn-outline-light show waves-effect waves-light active" data-toggle="tab">Monthly Plan</a>
	            <!-- <a href="#quarterly" data-type="2" class="plan_type btn btn-outline-dark waves-effect waves-light" data-toggle="tab">Quarterly Plan</a> -->
	            <a href="#annual" data-type="3" class="plan_type btn btn-outline-light waves-effect waves-light" data-toggle="tab">Annual Plan</a>
	          </nav>
	        </div>
	      </div>
	    </div>

		

		<div class="demo">
		    <div class="container">
		        <div class="row" id="table"></div>
		    </div>
		</div>
	<?php }else{ ?>
		<div class="container">
			<!-- <div class="row"> -->
				<div class="d-flex justify-content-center">
					<div class="card card-table mb-0 w-50 text-center">
				        <div class="card-body" style="font-size: 25px"> Application Subscription has expired please contact the Admininstrator</div>
				    </div>
				</div>
			<!-- </div> -->
		</div>
	<?php } ?>

<div class="modal fade" id="view_option">
  <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title ModalLabel" id="ModalLabel">You have selected</h6>
        <button class="btn btn-close p-1 ms-auto" type="button" data-dismiss="modal" aria-label="Close">x</button>
      </div>
      <form method="post" id="form">
      	<div id="show_option">	
	      
	    </div>
      </form>
    </div>
  </div>
</div>
<input type="hidden" id="logo_url" value="<?php echo url_for('/app_assets/images/logo-text-white.png') ?>">

<input type="hidden" id="eUrl" value="<?php echo url_for('/') ?>">
</body>
</html>
<!-- <script type="text/javascript" src="../public/"></script> -->

<script src="<?php echo url_for('app_assets/vendor/global/global.min.js') ?>"></script>
<script type='text/javascript' src='js/popper.min.js'></script>
<script type='text/javascript' src='js/bootstrap.min.js'></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>

<script type="text/javascript">
	var eUrl = $("#eUrl").val();
	var plan_id = 1;
	fetch(plan_id)
	function fetch(plan_id){
		$.ajax({
             url: eUrl + "pricing/inc/fetch.php",
             method:"POST",
             data:{
             	fetch: 1, 
             	plan_type: plan_id,
             },
             success:function(r)
             {
                $('#table').html(r);
             }
        });
	}


	$(document).on('click', '.plan_type', function(){
		var plan_type = $(this).data("type");

		var plan_id = plan_type;
		fetch(plan_id)
	});

	
	$(document).on('click', '.select_plan', function(){

	   $("#view_option").modal('show');
       var plan_id = $(this).data("id");
       var plan_name = $(this).data("name");
       var package = $(this).data("package");
       var amt = $(this).data("amt");

       // $(".ModalLabel").text(plan_name)


		$.ajax({
             url:  eUrl + "pricing/inc/fetch.php",
             method:"POST",
             data:{
             	fetch_option: 1, 
             	id: plan_id,
             	plan_name: plan_name,
             	plan_amt: amt,
             	package: package,
             },
             success:function(r)
             {
                $('#show_option').html(r);
             }
        });
     //   var page_url = $("#page_url").val()
	    // var c_url = page_url+'?id'+'='+ eid+'&store_id'+'='+ store_id;
     //   window.location.href = c_url;

         
    });
	
    // $(document).on('click', '#continue', function(e){
    // 	$(this).css('display', 'none')
    // 	$('#proceed').css('display', 'block')
    // });
    function uuid() {
	  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
	    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
	    return v.toString(16);
	  });
	}

	

    $(document).on('click', '#proceed', function(e){
       e.preventDefault();
       // var plan_id = $(this).data("id");
       var plan_name = $(this).data("name");
       var package = $(this).data("package");
       var amt = $(this).data("amt");
       var start = $(this).data("start");
       var end = $(this).data("end");
       var user = $(this).data("user");
       var fullname = $("#fullname").val();
       var email = $("#email").val();
       var phone = $("#phone").val();
       // console.log(amt)

       if(fullname == "") {
       		$("#fullname").after("<p class='text-danger'>This Field is required</p>")
       }else if(email == ""){
       		$("#email").after("<p class='text-danger'>This Field is required</p>")
       }else if(phone == ""){
       		$("#phone").after("<p class='text-danger'>This Field is required</p>")
       }else{
       	 var userID = uuid();
       	makePayment(plan_name, package, amt, start, end, fullname, email, phone, userID)
       }
       
       // $.ajax({
       //    url:"inc/process.php",
       //    method:"POST",
       //    data: $('#form').serialize(),
       //    dataType:"json",
       //    success:function(r)
       //    {
       //       if(r.msg == 'FAIL'){
       //          alert("Error: Subcription Fail Try Later")
       //       }else{
       //          // successAlert('Created Succesfully')
       //          $("#view_option").modal('hide');
       //          alert("Subcription Succesfully")
       //          window.location.href = '../index.php';

       //       }
            
             
       //    }
       // });
    });   
    
    var logo = $("#logo_url").val(); 
    
    function makePayment(plan_name, package, amt, start, end, fullname, email, phone, userID, logo) {

	    FlutterwaveCheckout({
	      public_key: "FLWPUBK_TEST-b5d7cf18c31fac7cc33538b9816c20ac-X",
	      // public_key: "FLWPUBK-f249db423f92592c444eb8025f3c8b3f-X",
	      tx_ref: userID,
	      amount: amt,
	      currency: "NGN",
	      country: "NG",
	      payment_options: "card, mobilemoneyghana, ussd",
	      // redirect_url: // specified redirect URL
	      //   "https://callbacks.piedpiper.com/flutterwave.aspx?ismobile=34",
	      meta: {
	        // consumer_id: user,
	        // consumer_mac: "92a3-912ba-1192a",
	      },
	      customer: {
	        email: email,
	        phone_number: phone,
	        name: fullname,
	      },
	      callback: function (data) {
	        // console.log(data);
	        if (data.status == success) {
	        	$.ajax({
		          url:  eUrl + "pricing/inc/process.php",
		          method:"POST",
		          data: {
		          	amount: amt,
					currency: "NGN",
					email: email,
					name: fullname,
					phone_number: phone,
					flw_ref: flw_ref,
					transaction_id: transaction_id,
					tx_ref: tx_ref,
		          },
		          dataType:"json",
		          success:function(r)
		          {
		             if(r.msg == 'FAIL'){
		                alert("Error: Subcription Fail Try Later")
		             }else{
		                // successAlert('Created Succesfully')
		                $("#view_option").modal('hide');
		                alert("Subcription Succesfully")
		                window.location.href = '../index.php';

		             }
		            
		             
		          }
		       });
	        }
	      },
	      onclose: function() {
	        // close modal
	      },
	      customizations: {
	        title: plan_name,
	        description: package,
	        logo: logo,
	      },
	    });
	}
    
</script>