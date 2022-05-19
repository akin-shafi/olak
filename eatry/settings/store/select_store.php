<?php require_once('../../private/initialize.php');
$page_title = 'Select';
$page = 'Settings';

require_login();



include(SHARED_PATH . '/header.php'); ?>
<style type="text/css">
  .store:hover{
    cursor: pointer;
    border: 4px solid #aaa;
  }
</style>
 <div class="content-wrapper">
    <section class="content-header">
       <h1><?php echo $page ." | ". $page_title; ?></h1>
       <ol class="breadcrumb">
          <li><a href="<?php echo url_for('/') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $page_title; ?></li>
       </ol>
    </section>

    <div class="col-lg-12 alerts">
       <div id="custom-alerts" >
          <div class="alert alert-warning alert-dismissable">
             <div class="custom-msg"></div>
             <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-warning"></i> Warning</h4>
                Please select store first  
          </div>
       </div>
    </div>

  

    <section class="content">
      <?php echo display_session_message(); ?>
       <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <!-- <h2 class="box-title text-center">Please Select a Store</h2> -->
                </div>
                <div class="box-body">
                      <?php //include('form_field.php'); ?>
                      <div class="row p-5">
                        <?php foreach (Store::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                          <div class="col-md-6 store" data-id="<?php echo $value->id; ?>">
                            <div class="border text-center  p-5">
                              <img width="200" height="130" src="<?php echo url_for('uploads/'.$value->image) ?>">
                              <h3><?php echo $value->category ?></h3>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                </div>
            </div>
          </div>
       </div>
    </section>
 </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
 
 <script type="text/javascript">
  $(document).on('click', '.store', function(){
    var store_id = $(this).data('id')
    // console.log(store_id)
      $.ajax({
        url:"../../pos/cart/fetch_item.php",
        method:"POST",
        data:{
           fetch: 1,
           store_id: store_id,
        },
        // dataType: "json",
        success:function(data)
        {
           successAlert('Store Selected Successfully');
           window.location.href = "../../pos/";
        }
     });
  })
   
 </script>