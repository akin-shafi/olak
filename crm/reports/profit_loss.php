
<?php 
  require_once('../private/initialize.php');

$page = 'Report';
$page_title = 'Profit & Loss';
include(SHARED_PATH . '/admin_header.php'); 

?>
    

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-25">Profit & Loss <a href="#" class="btn btn-default btn-rounded print pull-right"><i class="fa fa-print"></i> Print </a></h2>

                    <form method="GET" class="sort_report_form validate-form" action="http://accufy.originlabsoft.com/admin/reports/profit_loss">
                        <div class="reprt-box">
                          <div class="row mb-10 pl-15">
                              <div class="col-md-5 col-xs-12 mt-5 pl-0">
                                  <select class="form-control single_select report_type" required name="report_type">
                                      <option value="">Report Types</option>
                                      <option selected value="1">Paid & Unpaid (Including paid & unpaid invoices and bills)</option>
                                      <option  value="2">Paid (Including only paid invoices and bills)</option>
                                  </select>
                              </div>

                              <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                  <div class="input-group">
                                      <input type="text" class="inv-dpick form-control datepicker" placeholder="From" name="start" value="2021-01-01" autocomplete="off">
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  </div>
                                  <small>Start date</small>
                              </div>

                              <div class="col-md-2 col-xs-12 mt-5 pl-0">
                                  <div class="input-group">
                                      <input type="text" class="inv-dpick form-control datepicker" placeholder="To" name="end" value="2021-12-08" autocomplete="off">
                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  </div>
                                  <small>End date</small>
                              </div>
                         
                              <div class="col-md-3 col-xs-12 mt-5 pl-0 text-right">
                                  <button type="submit" class="btn btn-info btn-report"><i class="fa fa-search"></i> Show Report</button>
                              </div>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="print_area">

              <div class="profit-and-loss-report mt-50">
                  <div class="profit-and-loss-single">
                    <p class="mb-0">Income</p>
                    <h1 class="fs-40 text-dark">₦ 323,589.31</h1>
                  </div>
                  <div class="seperater-minus profit-and-loss-seperater">-</div>

                  <div class="profit-and-loss-single">
                    <p class="mb-0">Expenses</p>
                    <h1 class="fs-40 text-dark">₦ 1,283,959.36</h1>
                  </div>
                  <div class="seperater-minus profit-and-loss-seperater">=</div>

                  <div class="profit-and-loss-single">
                    <p class="mb-0">Net Profit</p>
                                          <h1 class="fs-40 text-danger">- ₦ 960370.05</h1>
                                      </div>
              </div>

              <div class="profit-and-loss-report mt-30 bb-2">
                  <div>
                    <h4 class="mb-0">Profit & Loss Reports</h4>
                  </div>

                  <div class="mb-10">
                    <p class="p-0 m-0">&emsp;2021-01-01</p>
                    <p class="p-0 m-0"><strong>to</strong> 2021-12-08</p>
                  </div>
              </div>

              <div class="profit-and-loss-report mt-20">
                  <div>
                    <h4 class="m-0 fwn">Income</h4>
                  </div>

                  <div class="mb-10">
                    <p class="p-0 m-0 fs-20">NGN 323,589.31</p>
                  </div>
              </div>

              <div class="profit-and-loss-report pt-10 pb-10 bb-2">
                  <div>
                    <h4 class="m-0 fwn">Expense</h4>
                  </div>

                  <div class="mb-10">
                    <p class="p-0 m-0 fs-20">NGN 1,283,959.36</p>
                  </div>
              </div>

              <div class="profit-and-loss-report pt-10">
                  <div>
                    <h4 class="m-0 fwn">Net Profit</h4>
                  </div>

                  <div class="mb-10">
                                          <p class="fs-20 p-0 m-0 text-danger">- NGN 960370.05</p>
                                      </div>
              </div>

            </div>

        </div>
    </section>
</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>


