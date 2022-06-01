<?php require_once('../../private/initialize.php');?>
<?php 

if (isset($_POST['process_mail'])) {
	$sn = 1;
	$rec = Recipients::find_by_undeleted();
	
		$output = '
		<div class="table-responsive" id="order_table">
			<table class="table table-bordered table-striped">
				
		';

		$output .= '
			<tr class="alert-light bold">
				<td>SN</td>
				<td>Email</td>
				<td>Name</td>
				<td>Action</td>
			</tr>
			<tbody id="items">
		';

		$total_rec = count($rec);
		foreach ($rec as $key => $value) {
			if ($value->id != 1) {
				$output .= '
					
					<tr>
						<td>'.$sn++.'.</td>
						<td> 	
							<span class="eSelect" data-id="'.$value->id.'" id="eEmail'.$value->id.'" contenteditable="true">'.$value->email.'</span> 
							<input type="hidden" name="mail[email][]" id="email'.$key.'" data-srno="1"  value="'.$value->email.'">
						</td>
						<td> <span class="eSelect" data-id="'.$value->id.'" id="eName'.$value->id.'" contenteditable="true">'.$value->name.'</span>  <input type="hidden" name="mail[name][]" id="name'.$key.'" data-srno="'.$key.'"  value="'.$value->name.'"> <input type="hidden" name="type" id="type'.$key.'" data-srno="'.$key.'"  value="'.$value->type.'"></td>
						<td>
							<div class="btn-group editWrap' .$value->id. '" style="display:none">
								<span class="btn btn-sm  edit" id="' .$value->id. '">Edit</span> 
								<span class="btn btn-sm  eCancel" id="' .$value->id. '">cancel</span>
							</div>';
					
					// echo $total_rec;
					if ($sn == $total_rec) {
						$output .= '<span class="btn" id="add"><i class="fa fa-plus text-success"></i></span></td>';
					}else{
						
					}
					

					$output .= '
					</tr>
					
				';
			}
		}
		$output .= '
		</tbody>
			<tr>
                  <th class="text-bold" class="fs-12">Total: <b class="text-danger total_item">'.($total_rec - 1).' item</b> 
                    <input type="hidden" name="total_item" id="item_amt" value="'. ($total_rec - 1).'"></th>
            </tr>
        ';
		$output .= '</table></div>';
		

	if(empty($rec)){
		exit(json_encode(["msg" => "FAIL"]));
	}else{
		 exit(json_encode(["msg" => "OK", "output" => $output]));
	}
}

if(isset($_POST["sendMail"]))
{	
	
	
	$from = $_POST['from'] ?? date('Y-m-d');
	$to = $_POST['to'] ?? date('Y-m-d');
	$subject = $_POST['subject'] ?? "";
	$body = $_POST['body'] ?? "";
	$exception = $_POST['exception'] ?? ''; 
	if(isset($_POST['close_reg'])){
	    $created_by = $_POST['created_by'] ?? $loggedInAdmin->id;
	    
	}else{
	    $created_by = $_POST['created_by'] ?? "";
	}
	if ($created_by != "") {
	    $user = $created_by;
	}else{
	    $user = null;
	}

	// $allMail = $_POST['mail'];
	$allMail = Recipients::find_all();
	$mainTo = Recipients::find_by_id(1);
	$mailerSetup = MailerSetup::find_by_id(1);

	include(SHARED_PATH . '/mailer/pdf.php');
	$file_name = md5(rand()) . '.pdf';
	$html_code = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
	$html_code .= Register::fetch_customer_data($from, $created_by, $exception);
	$pdf = new Pdf();
	$pdf->load_html($html_code);
	$pdf->render();
	$file = $pdf->output();
	file_put_contents($file_name, $file);
	require '../../private/shared/mailer/class/class.phpmailer.php';
	$mail = new PHPMailer;
	$mail->IsSMTP();								//Sets Mailer to send message using SMTP
	$mail->Host = $mailerSetup->host;		//smtpout.secureserver.net //Sets the SMTP hosts of your Email hosting, this for Godaddy
	$mail->Port = $mailerSetup->port;								//80 Sets the default SMTP server port
	$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                       // 1 = errors and messages
                                       // 2 = messages only
	$mail->Username = $mailerSetup->username;					//Sets SMTP username
	$mail->Password = $mailerSetup->password;					//Sets SMTP password
// 	$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
	$mail->From = $mailerSetup->fromEmail;			//Sets the From email address for the message
	$mail->FromName = $mailerSetup->fromName;			//Sets the From name of the message
	$mail->AddAddress($mainTo->email, $mainTo->name);	
	$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
	$mail->IsHTML(true);							//Sets message type to HTML				
	$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
	$mail->Subject = $subject;			//Sets the Subject of the message
	$mail->Body = $body;				//An HTML or plain text message body
	foreach($allMail as $key => $val)
	{
	   $mail->AddCC($val->email, $val->name);
	   //pre_r($mail);
	}
	$mail->addBCC("sandsify@gmail.com", "Sandsify Systems");

	if($mail->Send())								//Send an Email. Return true on success or false on error
	{
		// $message = '<label class="text-success">Email sent successfully...</label>';
		exit(json_encode(['success' => true, 'msg' => "Email sent successfully..."]));
	}else{
// 		exit(json_encode(['success' => false, 'msg' => "Fail to send mail"]));
		exit(json_encode(['success' => false, 'msg' =>  $mail->ErrorInfo]));
	}
	unlink($file_name);
}

 ?>