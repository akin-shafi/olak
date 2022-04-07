<?php

require_once('../../private/initialize.php');

require_login();


?>
<?php $page_title = 'Terms & Policy'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>

 <!-- *************
        ************ Main container start *************
        ************* -->
      <div class="main-container">


        <!-- Page header start -->
        <div class="page-title">
          <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              <h5 class="title">Terms & Policy</h5>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="daterange-container">
                <div class="date-range">
                  <div id="reportrange">
                    <i class="feather-calendar cal"></i>
                    <span class="range-text">Jan 20, 2020 - Feb 18, 2020</span>
                    <i class="feather-chevron-down arrow"></i>
                  </div>
                </div>
                <a href="#" data-toggle="tooltip" data-placement="top" title="" class="download-reports" data-original-title="Download CSV">
                  <i class="feather-download"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Page header end -->


        <!-- Content wrapper start -->
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel sodales mauris. Nunc accumsan mi massa, ut maximus magna ultricies et:</p>
              <ol>
                <li>Integer quam odio, ullamcorper id diam in, accumsan convallis libero. Duis at lacinia urna.</li>
                <li>Mauris eget turpis sit amet purus pulvinar facilisis at sed lacus.</li>
                <li>Quisque malesuada volutpat orci, accumsan scelerisque lorem pulvinar vitae.</li>
                <li>Vestibulum sit amet sem aliquam, vestibulum nisi sed, sodales libero.</li>
              </ol>

              <h4>Aenean accumsan aliquam justo, et rhoncus est ullamcorper at</h4>
              <p>Donec posuere dictum enim, vel sollicitudin orci tincidunt ac. Maecenas mattis ex eu elit tincidunt egestas. Vivamus posuere nunc vel metus bibendum varius. Vestibulum suscipit lacinia eros a aliquam. Sed dapibus arcu eget egestas hendrerit.</p>

              <p>Vivamus consectetur metus at nulla efficitur mattis. Aenean egestas eu odio vestibulum vestibulum. Duis nulla lectus, lacinia vitae nibh vitae, sagittis interdum lacus. Mauris lacinia leo odio, eget finibus lectus pharetra ut. Nullam in semper enim, id gravida nulla.</p>

              <p>Fusce gravida auctor justo, vel lobortis sem efficitur id. Cras eu eros vitae justo dictum tempor.</p>

              <h4>Etiam sed fermentum lectus. Quisque vitae ipsum libero</h4>
              <p>Phasellus sit amet vehicula arcu. Etiam pulvinar dui libero, vitae fringilla nulla convallis in. Fusce sagittis cursus nisl, at consectetur elit vestibulum vestibulum:</p>
              <ul>
                <li>Nunc pulvinar efficitur interdum.</li>
                <li>Donec feugiat feugiat pulvinar.</li>
                <li>Suspendisse eu risus feugiat, pellentesque arcu eu, molestie lorem. </li>
                <li>Duis non leo commodo, euismod ipsum a, feugiat libero.</li>
              </ul>
              <h4>pulvinar</h4> 
              <p>Sed sollicitudin, diam nec tristique tincidunt, nulla ligula facilisis nunc, non condimentum tortor leo id ex.</p>

              <p>Vivamus consectetur metus at nulla efficitur mattis. Aenean egestas eu odio vestibulum vestibulum. Duis nulla lectus, lacinia vitae nibh vitae, sagittis interdum lacus. Mauris lacinia leo odio, eget finibus lectus pharetra ut. Nullam in semper enim, id gravida nulla.</p>

              <p>Donec posuere dictum enim, vel sollicitudin orci tincidunt ac. Maecenas mattis ex eu elit tincidunt egestas. Vivamus posuere nunc vel metus bibendum varius. Vestibulum suscipit lacinia eros a aliquam. Sed dapibus arcu eget egestas hendrerit.Donec posuere dictum enim, vel sollicitudin orci tincidunt ac. Maecenas mattis ex eu elit tincidunt egestas. Vivamus posuere nunc vel metus bibendum varius. Vestibulum suscipit lacinia eros a aliquam. Sed dapibus arcu eget egestas hendrerit.</p>

              <h4>efficitur</h4>

              <p>Fusce gravida auctor justo, vel lobortis sem efficitur id. Cras eu eros vitae justo dictum tempor.</p>

              <p><strong>Vivamus posuere nunc vel metus bibendum varius. Vestibulum suscipit lacinia eros a aliquam. Sed dapibus arcu eget egestas hendrerit.Donec posuere dictum enim, vel sollicitudin orci tincidunt ac.</strong></p>
        
            </div>
          </div>
          

        </div>
        <!-- Content wrapper end -->


      </div>
      <!-- *************
        ************ Main container end *************
        ************* -->

<?php include(SHARED_PATH . '/admin_footer.php'); 
?>