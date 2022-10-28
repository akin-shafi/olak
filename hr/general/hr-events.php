<?php
require_once('../private/initialize.php');

$page = 'Eventa';
$page_title = 'Eventa';
include(SHARED_PATH . '/header.php');

?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Events</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="d-flex align-items-end flex-wrap my-auto end-content breadcrumb-end">
         <div class="btn-list"> <a href="#" data-bs-toggle="modal" data-bs-target="#eventmodal" class="btn btn-primary me-3">Add New Events</a> <button class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button> <button class="btn btn-light" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button> <button class="btn btn-primary" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button> </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12 col-xl-4">
      <div class="card">
         <div class="card-header border-bottom-0">
            <h4 class="card-title">Upcoming Events</h4>
         </div>
         <div class="card-body mt-2">
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-success-transparent bradius me-3"><span class="date fs-20">22</span> <span class="month fs-13">FEB</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Anniversary</h6>
                     <span class="clearfix"></span> <small>Office 3rd Anniversary on 22nd Feb</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-purple-transparent bradius me-3"><span class="date fs-20">10</span> <span class="month fs-13">FEB</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Vanessa James</h6>
                     <span class="clearfix"></span> <small>Birthday on Feb 16</small> 
                  </div>
                  <p class="float-end mb-0  ms-auto  my-auto"> <a class="btn btn-outline-orange mt-1" href="#"><i class="fa fa-birthday-cake me-2"></i>Wish Now</a> </p>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-orange-transparent bradius me-3"><span class="date fs-20">18</span> <span class="month fs-13">FEB</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Trade Shows</h6>
                     <span class="clearfix"></span> <small>Smart Device Trade Show</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-warning-transparent bradius me-3"><span class="date fs-20">06</span> <span class="month fs-13">Mar</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Holiday Party</h6>
                     <span class="clearfix"></span> <small>SCreate a Cost-Effective Holiday Party Menu</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-pink-transparent bradius me-3"><span class="date fs-20">13</span> <span class="month fs-13">MAR</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Team-Building </h6>
                     <span class="clearfix"></span> <small>Team Communication &amp; Creative Innovation team members</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-success-transparent bradius me-3"><span class="date fs-20">24</span> <span class="month fs-13">MAR</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Anniversary</h6>
                     <span class="clearfix"></span> <small>Faith Harris 3rd work Anniversary</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-purple-transparent bradius me-3"><span class="date fs-20">10</span> <span class="month fs-13">APR</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Austin Bell</h6>
                     <span class="clearfix"></span> <small>Birthday on Apr 16</small> 
                  </div>
                  <p class="float-end mb-0  ms-auto  my-auto"> <a class="btn btn-outline-orange mt-1" href="#"><i class="fa fa-birthday-cake me-2"></i>Wish Now</a> </p>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-info-transparent bradius me-3"><span class="date fs-20">25</span> <span class="month fs-13">APR</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Board Meeting</h6>
                     <span class="clearfix"></span> <small>It will be held in meeting room</small> 
                  </div>
               </div>
            </div>
            <div class="mb-5">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-purple-transparent bradius me-3"><span class="date fs-20">01</span> <span class="month fs-13">MAY</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Maria Bower</h6>
                     <span class="clearfix"></span> <small>Birthday on May 01</small> 
                  </div>
                  <p class="float-end mb-0  ms-auto  my-auto"> <a class="btn btn-outline-orange mt-1" href="#"><i class="fa fa-birthday-cake me-2"></i>Wish Now</a> </p>
               </div>
            </div>
            <div class="mb-0">
               <div class="d-flex comming_holidays calendar-icon icons">
                  <span class="date_time bg-success-transparent bradius me-3"><span class="date fs-20">21</span> <span class="month fs-13">MAY</span> </span> 
                  <div class="me-3 mt-0 mt-sm-2 d-block">
                     <h6 class="mb-1 font-weight-semibold">Max Wilson Anniversary</h6>
                     <span class="clearfix"></span> <small>Max Wilson 1st work Anniversary</small> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12 col-xl-8">
      <div class="card">
         <div class="card-body">
            <div class="hrevent-calender">
               <div id="calendar1" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                  <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                     <div class="fc-toolbar-chunk"><button class="fc-prev-button fc-button fc-button-primary" type="button" aria-label="prev"><span class="fc-icon fc-icon-chevron-left"></span></button></div>
                     <div class="fc-toolbar-chunk">
                        <h2 class="fc-toolbar-title">January 2022</h2>
                     </div>
                     <div class="fc-toolbar-chunk"><button class="fc-next-button fc-button fc-button-primary" type="button" aria-label="next"><span class="fc-icon fc-icon-chevron-right"></span></button></div>
                  </div>
                  <div class="fc-view-harness fc-view-harness-active" style="height: 749.63px;">
                     <div class="fc-daygrid fc-dayGridMonth-view fc-view">
                        <table class="fc-scrollgrid  fc-scrollgrid-liquid">
                           <thead>
                              <tr class="fc-scrollgrid-section fc-scrollgrid-section-header ">
                                 <td>
                                    <div class="fc-scroller-harness">
                                       <div class="fc-scroller" style="overflow: hidden;">
                                          <table class="fc-col-header " style="width: 1009px;">
                                             <colgroup></colgroup>
                                             <tbody>
                                                <tr>
                                                   <th class="fc-col-header-cell fc-day fc-day-sun">
                                                      <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Sun</a></div>
                                                   </th>
                                                   <th class="fc-col-header-cell fc-day fc-day-mon">
                                                      <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Mon</a></div>
                                                   </th>
                                                   <th class="fc-col-header-cell fc-day fc-day-tue">
                                                      <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Tue</a></div>
                                                   </th>
                                                   <th class="fc-col-header-cell fc-day fc-day-wed">
                                                      <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Wed</a></div>
                                                   </th>
                                                   <th class="fc-col-header-cell fc-day fc-day-thu">
                                                      <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Thu</a></div>
                                                   </th>
                                                   <th class="fc-col-header-cell fc-day fc-day-fri">
                                                      <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Fri</a></div>
                                                   </th>
                                                   <th class="fc-col-header-cell fc-day fc-day-sat">
                                                      <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Sat</a></div>
                                                   </th>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="fc-scrollgrid-section fc-scrollgrid-section-body  fc-scrollgrid-section-liquid">
                                 <td>
                                    <div class="fc-scroller-harness fc-scroller-harness-liquid">
                                       <div class="fc-scroller fc-scroller-liquid-absolute" style="overflow: hidden auto;">
                                          <div class="fc-daygrid-body fc-daygrid-body-balanced " style="width: 1009px;">
                                             <table class="fc-scrollgrid-sync-table" style="width: 1009px; height: 720px;">
                                                <colgroup></colgroup>
                                                <tbody>
                                                   <tr>
                                                      <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past fc-day-other" data-date="2021-12-26">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2021-12-26&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">26</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past fc-day-other" data-date="2021-12-27">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2021-12-27&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">27</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past fc-day-other" data-date="2021-12-28">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2021-12-28&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">28</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past fc-day-other" data-date="2021-12-29">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2021-12-29&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">29</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past fc-day-other" data-date="2021-12-30">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2021-12-30&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">30</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past fc-day-other" data-date="2021-12-31">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2021-12-31&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">31</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past" data-date="2022-01-01">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-01&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">1</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past" data-date="2022-01-02">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-02&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">2</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past" data-date="2022-01-03">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-03&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">3</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past" data-date="2022-01-04">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-04&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">4</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past" data-date="2022-01-05">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-05&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">5</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past" data-date="2022-01-06">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-06&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">6</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past" data-date="2022-01-07">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-07&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">7</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past" data-date="2022-01-08">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-08&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">8</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past" data-date="2022-01-09">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-09&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">9</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past" data-date="2022-01-10">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-10&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">10</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past" data-date="2022-01-11">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-11&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">11</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past" data-date="2022-01-12">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-12&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">12</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past" data-date="2022-01-13">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-13&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">13</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past" data-date="2022-01-14">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-14&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">14</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past" data-date="2022-01-15">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-15&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">15</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past" data-date="2022-01-16">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-16&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">16</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past" data-date="2022-01-17">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-17&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">17</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past" data-date="2022-01-18">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-18&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">18</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-wed fc-day-today " data-date="2022-01-19">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-19&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">19</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future" data-date="2022-01-20">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-20&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">20</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future" data-date="2022-01-21">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-21&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">21</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future" data-date="2022-01-22">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-22&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">22</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future" data-date="2022-01-23">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-23&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">23</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future" data-date="2022-01-24">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-24&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">24</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future" data-date="2022-01-25">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-25&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">25</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future" data-date="2022-01-26">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-26&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">26</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future" data-date="2022-01-27">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-27&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">27</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future" data-date="2022-01-28">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-28&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">28</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future" data-date="2022-01-29">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-29&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">29</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future" data-date="2022-01-30">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-30&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">30</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future" data-date="2022-01-31">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-01-31&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">31</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future fc-day-other" data-date="2022-02-01">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-02-01&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">1</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future fc-day-other" data-date="2022-02-02">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-02-02&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">2</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future fc-day-other" data-date="2022-02-03">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-02-03&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">3</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future fc-day-other" data-date="2022-02-04">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-02-04&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">4</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg"></div>
                                                         </div>
                                                      </td>
                                                      <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future fc-day-other" data-date="2022-02-05">
                                                         <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                            <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-02-05&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">5</a></div>
                                                            <div class="fc-daygrid-day-events"></div>
                                                            <div class="fc-daygrid-day-bg">
                                                               <div class="fc-daygrid-bg-harness" style="left: 0px; right: 0px;">
                                                                  <div class="fc-non-business"></div>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include (SHARED_PATH . '/footer.php') ?>