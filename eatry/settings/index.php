<?php require_once('../private/initialize.php');
$page_title = 'Systems Setup';
$page = 'Settings';
require_login();


if (!in_array($loggedInAdmin->admin_level, [1,2])) {
    redirect_to(url_for('/login.php'));
}
$setting = Settings::find_by_id(1);
$mailerSetup = MailerSetup::find_by_id(1);
if (isset($_POST['sales']) ){

  $args = $_POST['sales'];
  $setting->merge_attributes($args);
  $result = $setting->save();

  if ($result === true) {

    $session->message('The setting was updated successfully.');
  } else {
    // show errors
  }
} else {

  // display the form
}

if (isset($_POST['mailer']) ){

  $args = $_POST['mailer'];
  
  $mailerSetup->merge_attributes($args);
  $result = $mailerSetup->save();
  // pre_r($mailerSetup);

  if ($result === true) {

    $session->message('The Mailer Setup was updated successfully.');
  } else {
    // show errors
  }
} else {

  // display the form
}

include(SHARED_PATH . '/header.php'); ?>

 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page_title; ?> </h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $page_title; ?></li>
       </ol>
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" style="display:none;">
          <div class="alert alert-dismissable">
             <div class="custom-msg"></div>
          </div>
       </div>
    </div>
    <section class="content">
        <div class="text-danger text-center"><?php //echo display_errors($setting->errors); ?></div>
        <?php echo display_session_message(); ?>
       <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary">
                <div class="d-flex justify-content-between p-4">
                    <div class="title">Change Settings Setup</div>
                    <div class="btn-group">
                      <!-- <button class="btn btn-sm btn-primary add">Add New User</button> -->
                    </div>
                </div>
                <div></div>
                <div class="box-body">
                  <div class="container">
                      <div class="row">
                         

                          <div class="col-lg-6 border">
                            <form id="mailer" method="post">
                              <h4>Mailer Setup</h4>
                              <div class="form-group col-lg-4">
                                <label>Host</label>
                                <input type="text" name="mailer[host]" class="form-control" value="<?php echo $mailerSetup->host ?? $_GET['host'] ?>">
                              </div>

                              <div class="form-group col-lg-4">
                                <label>Port</label>
                                <input type="text" name="mailer[port]" class="form-control" value="<?php echo $mailerSetup->port ?? $_GET['port'] ?>">
                              </div>

                              <div class="form-group col-lg-4">
                                <label>Username</label>
                                <input type="text" name="mailer[username]" class="form-control" value="<?php echo $mailerSetup->username  ?? $_GET['username']?>">
                              </div>

                              <div class="form-group col-lg-4">
                                <label>Password</label>
                                <input type="password" name="mailer[password]" class="form-control" value="<?php echo $mailerSetup->password ?? $_GET['password'] ?>">
                              </div>

                              <div class="form-group col-lg-4">
                                <label>From email address:</label>
                                <input type="text" name="mailer[fromEmail]" class="form-control" value="<?php echo $mailerSetup->fromEmail ?? $_GET['fromEmail'] ?>">
                              </div>

                              <div class="form-group col-lg-4">
                                <label>From Name:</label>
                                <input type="text" name="mailer[fromName]" class="form-control" value="<?php echo $mailerSetup->fromName ?? $_GET['fromName'] ?>">
                              </div>
                              <div class="form-group col-lg-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-primary">Save Mailer Setup</button>
                              </div>

                            </form>
                          </div>

                           <div class="col-lg-6 border">
                            <form>
                              <h4>Sales Setup</h4>
                                <div class="form-group  col-lg-4">
                                  <label>Selling Option</label>
                                  <select class="form-control" name="sales[sale_option]">
                                    <?php foreach (Settings::SALE_OPTION as $key => $value) { ?>
                                      <option value="<?php echo $key ?>" <?php echo $setting->sale_option == $key ? 'selected' : ''?>><?php echo $value ?></option>
                                    <?php } ?>
                                     
                                    <!-- <option value="2">Sale to Infinity </option> -->
                                  </select>
                                </div>

                                <div class="form-group col-lg-12 d-flex justify-content-start">
                                  <button type="submit" class="btn btn-sm btn-primary">Save Selling Setup</button>
                                </div>
                            </form>
                          </div>

                          <!-- <div class="col-lg-6 border"></div> -->

                         
                      </div>  
                  </div>
                </div>
            </div>
          </div>
       </div>
    </section>
 </div>






<?php include(SHARED_PATH . '/footer.php'); ?>
 <script type="text/javascript">

 </script>