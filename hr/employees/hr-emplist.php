<?php
require_once('../private/initialize.php');

$page = 'Employees';
$page_title = 'Employees List';
include(SHARED_PATH . '/header.php');
$datatable = '';
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title">Employees</h4>
   </div>
   <div class="page-rightheader ms-md-auto">
      <div class="align-items-end flex-wrap my-auto right-content breadcrumb-right">
         <div class="btn-list"> <a href="hr-addemployee.php" class="btn btn-primary me-3">Add New Employee</a>

            <button class="btn btn-light d-none" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="E-mail"> <i class="feather feather-mail"></i> </button>

            <button class="btn btn-light d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Contact"> <i class="feather feather-phone-call"></i> </button>

            <button class="btn btn-primary d-none" data-bs-placement="top" data-bs-toggle="tooltip" title="" data-bs-original-title="Info"> <i class="feather feather-info"></i> </button>
         </div>
      </div>
   </div>
</div>


<div class="row">
   <div class="col-xl-8 col-lg-12 col-md-12">
      <div class="row">
         <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-7">
                        <div class="mt-0 text-start">
                           <span class="font-weight-semibold">Total <br>Employees</span>
                           <h3 class="mb-0 mt-1 text-success"><?php echo count(Employee::find_by_undeleted()) ?></h3>
                        </div>
                     </div>
                     <div class="col-5">
                        <div class="icon1 bg-success-transparent my-auto  float-end"> <i class="las la-users"></i> </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-7">
                        <div class="mt-0 text-start">
                           <span class="font-weight-semibold">Total Male Employees</span>
                           <h3 class="mb-0 mt-1 text-primary"><?php echo count(Employee::find_by_gender('male')) ?? 0 ?></h3>
                        </div>
                     </div>
                     <div class="col-5">
                        <div class="icon1 bg-primary-transparent my-auto  float-end"> <i class="las la-male"></i> </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-7">
                        <div class="mt-0 text-start">
                           <span class="font-weight-semibold">Total Female Employees</span>
                           <h3 class="mb-0 mt-1 text-secondary"><?php echo count(Employee::find_by_gender('female')) ?? 0 ?></h3>
                        </div>
                     </div>
                     <div class="col-5">
                        <div class="icon1 bg-secondary-transparent my-auto  float-end"> <i class="las la-female"></i> </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-lg-6 col-md-12 d-none">
            <div class="card">
               <div class="card-body">
                  <div class="row">
                     <div class="col-7">
                        <div class="mt-0 text-start">
                           <span class="font-weight-semibold">Total New Employees</span>
                           <h3 class="mb-0 mt-1 text-danger">398</h3>
                        </div>
                     </div>
                     <div class="col-5">
                        <div class="icon1 bg-danger-transparent my-auto  float-end"> <i class="las la-user-friends"></i> </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <div class="row">
         <div class="col-xl-12 col-md-12 col-lg-12">
            <div class="card">
               <div class="card-header  border-0">
                  <h4 class="card-title">Employee List</h4>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <div id="hr-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                        <div class="row">
                           <div class="col-sm-12">

                              <table class="table table-vcenter text-nowrap table-bordered border-bottom dataTable no-footer" id="hr-table" role="grid" aria-describedby="hr-table_info">
                                 <thead>
                                    <tr role="row">
                                       <th>S/N</th>
                                       <th>Emp Name</th>
                                       <th>Company</th>
                                       <th>Branch</th>
                                       <th>Department</th>
                                       <th>Phone No.</th>
                                       <th>Join Date</th>
                                       <th>Stay Duration</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php $sn = 1;
                                    foreach (Employee::find_by_undeleted(['order' => 'ASC']) as $key => $value) {
                                       $class = $key % 2 == 0 ? 'even' : 'odd';
                                       $image =  '../assets/images/users/male.png';
                                        $start_date  = date("Y-m-d",strtotime($value->date_employed));
                                        $end_date = date('Y-m-d');
                                      
                                        // $stay_duration = $value->date_employed ? datediff('yyyy',$start_date,$end_date). "years" : 'Not Set';
                                        $stay_duration = $value->date_employed ? time_elapsed_string($start_date, $end_date, true) : 'Not Set';
                                    ?>
                                       <tr class="<?php echo $class; ?>">
                                          <td><?php echo $sn++; ?></td>
                                          <td>
                                             <a href="<?php echo url_for('employees/hr-empview.php?id=' . $value->id); ?>" class="d-flex">
                                                <span class="avatar avatar-md brround me-3" style="background-image: url( <?php echo $image ?>)"></span>

                                                <div class="me-3 mt-0 mt-sm-1 d-block">
                                                   <h6 class="mb-1 fs-14"><?php echo Employee::find_by_id($value->id)->full_name(); ?></h6>
                                                   <p class="text-muted mb-0 fs-12"><?php echo $value->email ?></p>
                                                </div>
                                             </a>
                                          </td>
                                          <td><?php echo $value->company ?></td>
                                          <td><?php echo $value->branch ? $value->branch : 'Not Set'; ?></td>
                                          <td><?php echo $value->department ? $value->department : 'Not Set'; ?></td>

                                          <td><?php echo $value->phone ? $value->phone : 'Not Set'; ?></td>
                                          <td><?php echo $value->date_employed ? date('Y-m-d', strtotime($value->date_employed)) : 'Not Set'; ?></td>
                                          <td><?php echo $stay_duration; ?></td>
                                          <td>
                                             <a class="btn btn-primary btn-icon btn-sm" href="<?php echo url_for('employees/hr-editemp.php?id=' . $value->id) ?>">
                                                <i class="feather feather-edit" data-bs-toggle="tooltip" data-original-title="View/Edit" data-bs-original-title="" title=""></i>
                                             </a>
                                             <a class="btn btn-danger btn-icon btn-sm" data-bs-toggle="tooltip" data-original-title="Delete" data-bs-original-title="" title=""><i class="feather feather-trash-2"></i></a>
                                          </td>
                                       </tr>
                                    <?php } ?>

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
   </div>

   <div class="col-xl-4 col-lg-12 col-md-12">





      <div class="card">
         <div class="card-header  border-0">
            <h4 class="card-title">Staff Analysis </h4>
         </div>
         <div class="card-body">
            <div id="analysis" class="mx-auto apex-dount" style="min-height: 229.561px;"></div>
            <div class="row">
               <div class="col-10 mx-auto">
                  <div class="table-responsive">
                     <table class="table table-vcenter text-nowrap table-bordered border-bottom  no-footer">

                        <tbody>
                           <tr role="row">
                              <td><a href="<?php echo url_for('settings/') ?>">Company</a></td>
                              <td><a href="<?php echo url_for('settings/') ?>">Branch</a></td>
                              <td>T.Staff</td>
                           </tr>
                           <?php
                           $sn = 1;
                           $companies = Company::find_by_undeleted();

                           foreach ($companies as $key => $value) {
                              $branch = Branch::find_by_company_name($value->company_name);
                              $employee = Employee::find_by_company_name($value->company_name);
                              // pre_r($employee);
                              // $color = ['#3366ff', '#01c353', '#ffad00', '#fe7f00', '#f11541', '#02d395'];
                              if ($key == 0) {
                                 $color = '#3366ff';
                              } elseif ($key == 1) {
                                 $color = '#ffad00';
                              } elseif ($key == 2) {
                                 $color = 'green';
                              } elseif ($key == 3) {
                                 $color = '#fe7f00';
                              } elseif ($key == 4) {
                                 $color = '#f11541';
                              } elseif ($key == 5) {
                                 $color = '#02d395';
                              } else {
                                 $color = 'purple';
                              }

                              // for ($i=0; $i < count($color); $i++) { 
                              //    echo $color++;
                              // }
                           ?>
                              <tr>
                                 <td class="p-2 d-flex"><span style="background-color: <?php echo $color; ?>" class="dot-label me-2 mt-1"></span><span class="font-weight-normal company_name"> <?php echo $value->company_name ?></span></td>
                                 <td><?php echo count($branch) ?? 0; ?></td>
                                 <td class="p-2">
                                    <!-- <span class="me-4 fs-16">:</span> -->
                                    <span class="ms-auto font-weight-semibold fs-16 staff_strength"><?php echo count($employee) ?? 0; ?></span>
                                 </td>
                              </tr>
                           <?php } ?>

                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="resize-triggers">
               <div class="expand-trigger">
                  <div style="width: 302px; height: 399px;"></div>
               </div>
               <div class="contract-trigger"></div>
            </div>
         </div>
      </div>








   </div>


</div>


<?php include(SHARED_PATH . '/footer.php') ?>
<script src="<?php echo url_for('assets/plugins/chart.min/chart.min.js') ?>"></script>
<script src="<?php echo url_for('assets/plugins/chart.min/rounded-barchart.js') ?>"></script>
<script src="<?php echo url_for('assets/plugins/apexchart/apexcharts.js') ?>"></script>
<script>
   // sumOfReturn();
   //   function sumOfReturn(){
   //     var label = [];
   //     $('.company_name').each(function() {
   //           var item = $(this).text();

   //           label.push(item);

   //     });
   //     return count;
   //   }


   (function($) {
      "use strict";

      /*Bar-Chart */


      /*----- Advancedtask ------*/


      function find_str(item_class) {
         var label = [];
         item_class.each(function() {
            var item = $(this).text();
            label.push(item);
         });
         var str_name = label;
         return str_name;
      }

      function find_num(item_class) {
         var label = [];
         item_class.each(function() {
            var item = $(this).text();
            label.push(parseInt(item));
         });
         var num_val = label;
         return num_val;
      }

      var coy_name = $('.company_name');
      var staff_strength = $('.staff_strength');
      // console.log(find_item(staff_strength));
      var options = {
         // series: [62, 23, 15,34],
         series: find_num(staff_strength),
         chart: {
            height: 280,
            type: 'donut',
         },
         dataLabels: {
            enabled: false
         },

         legend: {
            show: false,
            // position: bottom
         },
         stroke: {
            show: true,
            width: 0
         },
         plotOptions: {
            pie: {
               donut: {
                  size: '80%',
                  background: 'transparent',
                  labels: {
                     show: true,
                     name: {
                        show: true,
                        fontSize: '29px',
                        color: '#6c6f9a',
                        offsetY: -10
                     },
                     value: {
                        show: true,
                        fontSize: '26px',
                        color: undefined,
                        offsetY: 16,
                        formatter: function(val) {
                           return val + "%"
                        }
                     },
                     total: {
                        show: true,
                        showAlways: false,
                        label: 'Staff Strength',
                        fontSize: '22px',
                        fontWeight: 600,
                        color: '#373d3f',
                        // formatter: function (w) {
                        //   return w.globals.seriesTotals.reduce((a, b) => {
                        //    return a + b
                        //   }, 0)
                        // }
                     }

                  }
               }
            }
         },
         responsive: [{
            breakpoint: 480,
            options: {
               legend: {
                  show: false,
               }
            }
         }],
         labels: find_str(coy_name),
         // colors: ['#3366ff','#fe7f00','#0dcd94','#000','#cd3e06','#02d395'],
         colors: ['#3366ff', '#01c353', '#ffad00', '#fe7f00', '#f11541', '#02d395'],
      };
      var chart = new ApexCharts(document.querySelector("#analysis"), options);
      chart.render();


      /*-----Expenses-----*/

      /* Data Table */
      $('.orders-table').DataTable({
         "paging": false,
         searching: false,
         "info": false,
         "ordering": false
      });
      /* End Data Table */

      /* Data Table */
      $('.invoice-table').DataTable({
         "paging": false,
         searching: false,
         "info": false,
      });
      /* End Data Table */

      /* Data Table */
      $('.projecttable').DataTable({
         "paging": false,
         searching: false,
         "info": false,
         order: [],
         columnDefs: [{
            orderable: false,
            targets: [1]
         }],
      });
      /* End Data Table */

      /* Select2 */
      $('.select2').select2({
         minimumResultsForSearch: Infinity,
         width: '100%'
      });

      //______calendar
      $('.custom-calendar').pignoseCalendar({
         disabledDates: [
            '2021-01-20'
         ],
         format: 'YYY-MM-DD',
      });

      //________ Datepicker
      $('.fc-datepicker').datepicker({
         autoHide: true,
         zIndex: 999998,
      })

   })(jQuery);
</script>