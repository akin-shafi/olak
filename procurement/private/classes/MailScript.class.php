<?php
class MailScript extends DatabaseObject
{

	public static function pushMail($options=[]){ 
			$subject = $options['subject'] ?? false;
		 	$copy = $options['copy'] ?? false;
		 	$body = $options['body'] ?? false;
		 	$mailTo = $options['mailTo'] ?? '';
	 		$recieverName = $options['recieverName'] ?? false;

		    // require_once(SHARED_PATH . '/mailer/class/class.phpmailer.php');
            // require_once(SHARED_PATH . '/mailer/class/class.smtp.php');
  
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 2; 
            $mail->IsSMTP();
            $mail->CharSet = 'UTF-8';
            
            // // localhost method
            $mail->Host       = 'sandbox.smtp.mailtrap.io';    // Specify main SMTP server (gmail = smtp.gmail.com)
            $mail->SMTPAuth   = true;               // Enable SMTP authentication
            $mail->Username   = '9f7a0feed1bf54';     // SMTP username
            $mail->Password   = '4ace91a1750fbd';         // SMTP password
            $mail->SMTPSecure = 'ssl';              // Enable TLS encryption, 'ssl' also accepted
            $mail->Port       = 2525;                // TCP port to connect to (gmail = 465)

           
            $mail->From = "ask@gettonote.com";
            $mail->FromName = "Tonote Technologies limited";

            $mail->AddAddress($mailTo, $recieverName);
            $mail->AddReplyTo('ask@gettonote.com', 'ToNote Technologies Limited');

            $mail->IsHTML(true);

            $mail->Subject = $subject;

            $mail->Body    =  $body;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            // pre_r($mail);
            if(!$mail->Send()) {
                return true;
            }else{
            	return $mail->ErrorInfo;
            }
	}
}