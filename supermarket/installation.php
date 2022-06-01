<?php 
$page_title = 'Installation';
require_once('private/initialize.php'); 

$errors = [];

if (is_post_request()) { 
    if ($_POST['installation']['code'] != '') {
        if($install->code == $_POST['installation']['code']){
            redirect_to(url_for('/setup.php'));
        }else{
            $errors = "<div class='alert alert-danger fs-18 text-center '>Sorry is incorrect </div>";
        }
    }else{
        $errors = "<div class='alert alert-danger fs-18 text-center '>Field cannot be empty </div>";
    }

}


  
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="shortcut icon" href="assets/images/icon.png"/>
    <link href="assets/dist/css/styles.css" rel="stylesheet" type="text/css" />
    </head>
<body class="login-page login-page-<?php echo $company->color; ?> rtl rtl-inv">
    <div class="login-box">
        <div class="login-logo">
            <a href="index-2.html">alpha<b>POS</b></a>
        </div>
        <div class="login-box-body">
               <p class="login-box-msg">Please enter installation code.</p>
            
                <form method="post">
                    <?php if ($errors) { ?>
                        <!-- <div class="p-2 alert-light mb-3 rounded"> -->
                          <?php echo $errors//display_errors($errors); ?> 

                          
                        <!-- </div> -->
                      <?php } ?>
                    <div class="form-group has-feedback">
                        <label><strong>Installation Code</strong></label>
                        <input type="password" class="form-control" placeholder="" name="installation[code]">
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn  btn-block">Submit</button>
                    </div>
                </form>
            
        </div>

        
    </div>

    <!-- <script src="pwa.js"></script> -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
    <!-- <script src="assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script> -->
    <!-- <script>
        $(function () {
            if ($('#identity').val())
                $('#password').focus();
            else
                $('#identity').focus();
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script> -->
</body>


</html>
