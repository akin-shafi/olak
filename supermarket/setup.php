<?php require_once('private/initialize.php'); 
$page_title = 'Setup';
$setup = Installation::find_by_id(1);
$company = CompanyDetails::find_by_id(1);

if(is_post_request()) {

  // Save record using post parameters

  $args1 = $_POST['setup'];
  $setup->merge_attributes($args1);
  $result1 = $setup->save();

  if($result1 === true) {
    $args2 = $_POST['company'];
    $company->merge_attributes($args2);
    $result2 = $company->save();
    if ($result2 === true) {
      redirect_to(url_for('/login.php'));
    }
    

  } else {
    $errors = "<div class='alert alert-danger fs-18 text-center '>Sorry is incorrect </div>";
  }



} else {



  // display the form



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
    <div class=" container">
        <div class="login-logo">
            <a href="index-2.html">alpha<b>POS</b></a>
        </div>
        <div class="login-box-body">
                <h4 class="text-center">SYSTEM SETUP</h4>
               <p class="login-box-msg">Please fill details below.</p>
            
                <form method="post">
                    <div class="p-2 alert-light rounded">
                      <?php 
                        if (isset($setup->errors)) {
                          echo display_errors($setup->errors);
                        }
                        if (isset($company->errors)) {
                          echo display_errors($company->errors);
                        }
                       ?> 
                    </div>
                    <input type="hidden" class="form-control" name="setup[hostname]" value="<?php echo gethostname(); ?>">
                    <div class="row">
                        <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                            <label>Product:</label>
                            <select class="form-control" name="company[product]">
                              <option value="">Select  Product:</option>  
                              <?php foreach (CompanyDetails::PRODUCT as $value) { ?>
                                <option value="<?php echo $value ?>" <?php echo $company->product == $value ? 'selected' : ''?>><?php echo $value ?></option>
                              <?php } ?>
                              
                            </select>
                        </div>
                        <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                            <label>Color:</label>
                            <select class="form-control" name="company[color]">
                              <option value="">Select color</option>  
                              <?php foreach (CompanyDetails::COLOR as $value) { ?>
                                <option value="<?php echo $value ?>" <?php echo $company->color == $value ? 'selected' : ''?>><?php echo $value ?></option>
                              <?php } ?>
                              
                            </select>
                        </div>
                        <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                            <label>Theme:</label>
                            <input type="text" name="" class="form-control" value="default">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-uppercase mb-3">
                            <div class="border-bottom text-center"><strong >Company's Info</strong></div>
                        </div>

                        <div class="form-group  col-lg-4 col-md-6 col-sm-12">
                            <label>Company Name:</label>
                            <input type="text" name="company[company_name]" class="form-control" value="<?php echo $company->company_name ?? '' ?>">
                        </div>
                        
                        <div class="form-group  col-lg-4 col-md-6 col-sm-12">
                            <label>Conctact Phone:</label>
                            <input type="text" name="company[phone_no]" class="form-control" value="<?php echo $company->phone_no ?? '' ?>">
                        </div>
                        <div class="form-group  col-lg-4 col-md-6 col-sm-12">
                            <label>Email:</label>
                            <input type="text" name="company[email]" class="form-control" value="<?php echo $company->email ?? '' ?>">
                        </div>
                        <div class="form-group  col-lg-8 col-md-6 col-sm-12">
                            <label>Company Address:</label>
                            <input type="text" name="company[address]" class="form-control" value="<?php echo $company->address ?? '' ?>">
                        </div>
                        <div class="form-group  col-lg-4 col-md-6 col-sm-12">
                            <label>Website:</label>
                            <input type="text" name="company[web_address]" class="form-control" value="<?php echo $company->web_address ?? '' ?>">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 text-uppercase mb-3">
                            <div class="border-bottom text-center"><strong >Account Details</strong></div>
                        </div>
                        
                        <div class="form-group  col-lg-4 col-md-6 col-sm-12">
                            <label>Account number:</label>
                            <input type="text" name="company[acct_no]" class="form-control" value="<?php echo $company->acct_no ?? '' ?>">
                        </div>

                        <div class="form-group  col-lg-4 col-md-6 col-sm-12">
                            <label>Account Name:</label>
                            <input type="text" name="company[acct_name]" class="form-control" value="<?php echo $company->acct_name ?? '' ?>">
                        </div>

                        <div class="form-group  col-lg-4 col-md-6 col-sm-12">
                            <label>Bank Name:</label>
                            <input type="text" name="company[bank_name]" class="form-control" value="<?php echo $company->bank_name ?? '' ?>">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn  btn-block">Submit</button>
                    </div>
                </form>
            
        </div>

        
    </div>

    <script src="pwa.js"></script>
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
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
    </script>
</body>


</html>
