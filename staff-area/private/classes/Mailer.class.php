<?php 
class Mailer extends DatabaseObject
{
    protected static $table_name = "mailersetup";
    protected static $db_columns = ['id', 'host', 'port', 'username', 'password', 'fromEmail', 'fromName', 'deleted'];
  
    public $id;
    public $host;
    public $port;
    public $username;
    public $password;
    public $fromEmail;
    public $fromName;
    public $deleted;

    
    public function __construct($args=[])
    {
      $this->host = $args['host'] ?? '';
      $this->port = $args['port'] ?? '';
      $this->username = $args['username'] ?? '';
      $this->password = $args['password'] ?? '';
      $this->fromEmail = $args['fromEmail'] ?? '';
      $this->fromName = $args['fromName'] ?? '';
      $this->deleted = $args['deleted'] ?? '';
    }



	 public static function SendMail($options=[]){ 
	 	$subject = $options['subject'] ?? false;
	 	$copy = $options['copy'] ?? false;
	 	$body = $options['body'] ?? false;
	 	$mailTo = $options['mailTo'] ?? Recipients::find_by_id(1);
	 	$recieverName = $options['recieverName'] ?? false;

		include(SHARED_PATH . '/mailer/class/class.phpmailer.php');

		$allMail = Recipients::find_all();
		$mailerSetup = MailerSetup::find_by_id(1);
		
        $mail = new PHPMailer(true); 
        
        $html_code = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">'; 
        try { 
	                                          
	        $mail->isSMTP();                                            
	        $mail->Host = $mailerSetup->host;		//smtpout.secureserver.net //Sets the SMTP hosts of your Email hosting, this for Godaddy
			$mail->Port = $mailerSetup->port;								//80 Sets the default SMTP server port

			$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)                       
	        // $mail->SMTPSecure = 'tls';       
	        $mail->Username = $mailerSetup->username;					//Sets SMTP username
			$mail->Password = $mailerSetup->password;					//Sets SMTP password                         
	        $mail->From = $mailerSetup->fromEmail ?? "ask@gettonote.com";			//Sets the From email address for the message
			$mail->FromName = $mailerSetup->fromName ?? "Tonote Technologies limited";			//Sets the From name of the message
			$mail->addAddress($mailTo, $recieverName);	
			$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of 
	           
	        $mail->isHTML(true);                       
	        $mail->Subject = $subject;
	        $mail->Body    = $body;
	        if ($copy == true) { 
	        	foreach($allMail as $key => $val)
				{
				   $mail->AddCC($val->email, $val->name);
				   // $mail->addBCC("sandsify@gmail.com", "Sandsify Systems");
				}
	        }
        	// $mail->send();
        	pre_r($mail);
        	return true;
        } catch (Exception $e) {
        	return $mail->ErrorInfo;
                
        }

        
        
    }

}
 ?>