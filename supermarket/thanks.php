<?php require_once('private/initialize.php'); 
	// ========== TO LOGIN =========
require_login();
if ($_SESSION['register'] == "") {
   redirect_to(url_for('/login'));
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thanks </title>
    <link rel="shortcut icon" href="assets/images/icon.png"/>
        <script type="text/javascript">if (parent.frames.length !== 0) { top.location = 'login.php'; }</script>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
    <link href="assets/dist/css/styles.css" rel="stylesheet" type="text/css" />
    </head>
<body class="login-page login-page-blue rtl rtl-inv">
    <div class="login-box">
        <div class="login-logo">
            <a href="index-2.html">alpha<b>POS</b></a>
        </div>
        <div class="login-box-body" style="font-size: 23px">
              <center>
              	<p>Dear <b><?php echo Admin::find_by_id($loggedInAdmin->id)->full_name(); ?></b> <br>Thanks you for your service</p>
              <a href="<?php echo url_for('/logout') ?>" class="btn btn-danger">logout</a>  
              </center>        
        
        </div>

       
    </div>

    
</body>

<!-- Mirrored from spos.tecdiary.net/login by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Nov 2020 18:54:00 GMT -->
</html>
