<?php require_once('../../private/initialize.php'); 

require_login();

?>
<?php $page_title = 'Help'; ?>
<?php include(SHARED_PATH . '/admin_header.php'); ?>
<style type="text/css">
  /*-----------------
  13. Activity
-----------------------*/
.avatar {
    background-color: #032950;
	border-radius: 50%;
	color: #fff;
    display: inline-block;
    font-weight: 500;
    height: 38px;
    line-height: 38px;
    margin: 0 10px 0 0;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    vertical-align: middle;
    width: 38px;
    position: relative;
    white-space: nowrap;
}
.activity-box {
  position: relative;
}
.activity-list {
  list-style: none;
  margin: 0 0 0 10px;
  padding: 0;
  position: relative;
}
.activity .activity-list {
  list-style: none;
  margin: 0;
  padding: 0;
  position: relative;
}
.activity .activity-list > li .activity-user {
  height: 32px;
  margin: 0;
  padding: 0;
  position: absolute;
  top: 12px;
  left: 8px;
  width: 32px;
}
.activity .activity-list > li .activity-content {
  background-color: #fff;
  margin: 0 0 0 40px;
  padding: 0;
  position: relative;
}
.activity-list::before {
  background: #ddd;
  bottom: 0;
  content: "";
  left: 23px;
  position: absolute;
  top: 8px;
  width: 2px;
}
.activity .activity-list li::before {
  background: #ddd;
  bottom: 0;
  content: "";
  left: 22px;
  position: absolute;
  top: 12px;
  width: 2px;
}
.activity-list li::before {
  background: #eee;
  bottom: 0;
  content: "";
  left: 8px;
  position: absolute;
  top: 8px;
  width: 2px;
}
.activity-list > li {
  background-color: #fff;
  margin-bottom: 10px;
  padding: 10px;
  position: relative;
  border: 1px solid #ededed;
  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2);
}
.activity-list > li:last-child .activity-content {
  margin-bottom: 0;
}
.activity-user .avatar {
  height: 32px;
  line-height: 32px;
  margin: 0;
  width: 32px;
}
.activity-list > li .activity-user {
  background: #fff;
  height: 32px;
  left: -7px;
  margin: 0;
  padding: 0;
  position: absolute;
  top: 3px;
  width: 32px;
}
.activity-list > li .activity-content {
  background-color: #fff;
  margin: 0 0 20px 40px;
  padding: 0;
  position: relative;
}
.activity-list > li .activity-content .timeline-content {
  color: #9e9e9e;
}
.activity-list > li .activity-content .timeline-content a {
    color: #616161;
}
.activity-list > li .time {
  color: #bdbdbd;
  display: block;
  font-size: 13px;
}
</style>

 <!-- *************
        ************ Main container start *************
        ************* -->
      <div class="main-container">


        <!-- Page header start -->
        <div class="page-title">
          <div class="row gutters">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              <h5 class="title">How it works</h5>
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
						<div class="col-md-12">
							<div class="activity">
								<div class="activity-box">
									<ul class="activity-list">
										<li>
											<div class="activity-user">
												<a href="profile.html" title="" data-toggle="tooltip" class="avatar" data-original-title="Lesley Grauer">
													<i class="feather-book"></i>
												</a>
											</div>
											<div class="activity-content">
												<div class="timeline-content">
													<h2>Booking</h2>
													<a href="profile.html" class="name">Lesley Grauer</a> added new task <a href="#">Hospital Administration</a>
													<span class="time">4 mins ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="activity-user">
												<a href="profile.html" class="avatar" title="" data-toggle="tooltip" data-original-title="Jeffery Lalor">
													<img src="assets/img/profiles/avatar-16.jpg" alt="">
												</a>
											</div>
											<div class="activity-content">
												<div class="timeline-content">
													<a href="profile.html" class="name">Jeffery Lalor</a> added <a href="profile.html" class="name">Loren Gatlin</a> and <a href="profile.html" class="name">Tarah Shropshire</a> to project <a href="#">Patient appointment booking</a>
													<span class="time">6 mins ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="activity-user">
												<a href="profile.html" title="" data-toggle="tooltip" class="avatar" data-original-title="Catherine Manseau">
													<img src="assets/img/profiles/avatar-08.jpg" alt="">
												</a>
											</div>
											<div class="activity-content">
												<div class="timeline-content">
													<a href="profile.html" class="name">Catherine Manseau</a> completed task <a href="#">Appointment booking with payment gateway</a>
													<span class="time">12 mins ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="activity-user">
												<a href="#" title="" data-toggle="tooltip" class="avatar" data-original-title="Bernardo Galaviz">
													<img src="assets/img/profiles/avatar-13.jpg" alt="">
												</a>
											</div>
											<div class="activity-content">
												<div class="timeline-content">
													<a href="profile.html" class="name">Bernardo Galaviz</a> changed the task name <a href="#">Doctor available module</a>
													<span class="time">1 day ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="activity-user">
												<a href="profile.html" title="" data-toggle="tooltip" class="avatar" data-original-title="Mike Litorus">
													<img src="assets/img/profiles/avatar-05.jpg" alt="">
												</a>
											</div>
											<div class="activity-content">
												<div class="timeline-content">
													<a href="profile.html" class="name">Mike Litorus</a> added new task <a href="#">Patient and Doctor video conferencing</a>
													<span class="time">2 days ago</span>
												</div>
											</div>
										</li>
										<li>
											<div class="activity-user">
												<a href="profile.html" title="" data-toggle="tooltip" class="avatar" data-original-title="Jeffery Lalor">
													<img src="assets/img/profiles/avatar-16.jpg" alt="">
												</a>
											</div>
											<div class="activity-content">
												<div class="timeline-content">
													<a href="profile.html" class="name">Jeffery Lalor</a> added <a href="profile.html" class="name">Jeffrey Warden</a> and <a href="profile.html" class="name">Bernardo Galaviz</a> to the task of <a href="#">Private chat module</a>
													<span class="time">7 days ago</span>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
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