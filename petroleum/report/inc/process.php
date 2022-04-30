<?php require_once('../../private/initialize.php');

if (is_post_request()) {
  $uploadDir = '../uploads/';

  if (isset($_POST['new_remit'])) {
    $args = $_POST;

    for ($i = 0; $i < count($args['amount']); $i++) {
      $data = [
        "narration"     => $args['narration'][$i],
        "quantity"      => $args['quantity'][$i],
        "rate"          => $args['rate'][$i],
        "amount"        => $args['amount'][$i],
        "created_by"    => $loggedInAdmin->id,
      ];

      $remit = new Remittance($data);
      $remit->save();
    }


    if ($remit == true) :
      exit(json_encode(['success' => true, 'msg' => 'Sales remitted successfully!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($remit->errors)]));
    endif;
  }

  if (isset($_POST['edit_remit'])) {
    $remId = $_POST['remId'];
    $args = $_POST;
    $remit = Remittance::find_by_id($remId);

    for ($i = 0; $i < count($args['amount']); $i++) {
      $data = [
        "narration"     => $args['narration'][$i],
        "quantity"      => $args['quantity'][$i],
        "rate"          => $args['rate'][$i],
        "amount"        => $args['amount'][$i],
        "updated_at"    => date('Y-m-d H:i:s'),
      ];

      $remit->merge_attributes($data);
      $remit->save();
    }

    if ($remit == true) :
      exit(json_encode(['success' => true, 'msg' => 'Remitted sales updated successfully!']));
    endif;
  }

  if (isset($_POST['delete_remit'])) {
    $remId = $_POST['remId'];
    $remit = Remittance::find_by_id($remId);
    $remit::deleted($remId);

    if ($remit == true) :
      exit(json_encode(['success' => true, 'msg' => 'Remitted sales deleted successfully!']));
    endif;
  }
}


if (is_get_request()) {
  if (isset($_GET['get_remit'])) :
    $remId = $_GET['remId'];
    $remit = Remittance::find_by_id($remId);
    exit(json_encode(['success' => true, 'data' => $remit]));
  endif;


  if (isset($_GET['filter'])) :
    $metricLabels = [];
    $metricSeries = [];

    $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : $loggedInAdmin->branch_id;

    $dateFrom = $_GET['filterDate'];
    $convertFrom = date('Y-m-d', strtotime($dateFrom));
    $admComp = $loggedInAdmin->company_id;


    $remittance = Remittance::get_all_remittance($convertFrom, ['company' => $admComp, 'branch' => $branch]);
    $additionalRemit = Remittance::get_total_remittance($convertFrom, ['company' => $admComp, 'branch' => $branch])->total_amount;

    $filterReport = DataSheet::data_sheet_report($convertFrom, ['company' => $admComp, 'branch' => $branch]);
    $arr = [];
    foreach ($filterReport as $value) {
      array_push($arr, $value->inflow);
    }
    $totalCashRemit = array_sum($arr);

    $creditSales = Expense::find_by_expense_type($convertFrom, ['expense' => 1, 'company' => $admComp, 'branch' => $branch]);
    $totalCredit = Expense::get_total_expenses($convertFrom, ['expense' => 1, 'company' => $admComp, 'branch' => $branch])->total_amount;

    $operatingExp = Expense::find_by_expense_type($convertFrom, ['expense' => 2, 'company' => $admComp, 'branch' => $branch]);
    $totalOpExp = Expense::get_total_expenses($convertFrom, ['expense' => 2, 'company' => $admComp, 'branch' => $branch])->total_amount;

    $nonOpgExp = Expense::find_by_expense_type($convertFrom, ['expense' => 3, 'company' => $admComp, 'branch' => $branch]);
    $totalNonOpExp = Expense::get_total_expenses($convertFrom, ['expense' => 3, 'company' => $admComp, 'branch' => $branch])->total_amount;

    $headOfficeExp = Expense::find_by_expense_type($convertFrom, ['expense' => 4, 'company' => $admComp, 'branch' => $branch]);
    $totalHOExp = Expense::get_total_expenses($convertFrom, ['expense' => 4, 'company' => $admComp, 'branch' => $branch])->total_amount;

    $transExp = Expense::find_by_expense_type($convertFrom, ['expense' => 5, 'company' => $admComp, 'branch' => $branch]);
    $totalTransExp = Expense::get_total_expenses($convertFrom, ['expense' => 5, 'company' => $admComp, 'branch' => $branch])->total_amount;

    $totalSales = intval($additionalRemit) + intval($totalCashRemit);
    $totalExpenses = $totalCredit + $totalOpExp + $totalNonOpExp + $totalHOExp + $totalTransExp;
    $cashToHO = $totalSales - $totalExpenses;

    $grandTotal = $totalExpenses + $cashToHO;

?>

    <div>
      <div class="table-container border-0 shadow">
        <div class="d-flex justify-content-between align-items-center">
          <h3>Cash/Sales Daily Analysis</h3>
          <h3>
            <?php echo date('Y-m-d', strtotime($convertFrom)) ?>
          </h3>
        </div>

        <div class="mt-4 mb-5">
          <div class="d-flex justify-content-between align-items-center">
            <h3>Summary</h3>
            <a href="#detailed" class="btn btn-secondary">&downarrow; detailed analysis</a>
          </div>

          <div class="row gutters">
            <div class="col-md-4">
              <div class="table-responsive">
                <table class="table custom-table table-sm">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th>Particulars</th>
                      <th>Inflow (<?php echo $currency ?>)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <?php echo 'Cash Sales'; ?>
                      </td>
                      <td class="text-right">
                        <?php echo number_format($totalCashRemit); ?>
                      </td>
                    </tr>
                    <?php foreach ($remittance as $data) : ?>
                      <tr>
                        <td>
                          <?php echo $data->narration; ?>
                        </td>
                        <td class="text-right">
                          <?php echo !empty($data->amount) ? number_format($data->amount) : '-'; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <tr>
                      <td colspan="2" class="text-right">
                        <h5 class="mb-0"><?php echo number_format($totalSales); ?></h5>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-md-4">
              <div class="table-responsive">
                <table class="table custom-table table-sm">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th>Particulars</th>
                      <th>Outflow (<?php echo $currency ?>)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (Expense::EXPENSE_TYPE as $key => $value) :
                      $data = Expense::find_by_expense($key);
                      $total = Expense::get_total_expenses($convertFrom, ['expense' => $key, 'company' => $admComp, 'branch' => $branch])->total_amount;

                      $nextTotal = !empty($total) ? $total : 0;
                      array_push($metricLabels, $value);
                      array_push($metricSeries, $nextTotal);
                    ?>
                      <tr>
                        <td>
                          <?php echo $value == 'Transfer' && isset($data->narration) ? ucfirst($data->narration) : ucwords($value); ?>
                        </td>
                        <td class="text-right">
                          <?php echo number_format($total); ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                    <tr>
                      <td class="font-weight-bold text-uppercase">
                        <?php echo 'Cash to HEAD OFFICE'; ?>
                      </td>
                      <td class="text-right font-weight-bold">
                        <?php echo number_format($cashToHO); ?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" class="text-right">
                        <h5 class="mb-0"><?php echo number_format($grandTotal); ?></h5>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-md-4">
              <?php
              $impLabel = implode('","',  $metricLabels);
              $impSeries = implode(',',  $metricSeries);

              $label = '"' . $impLabel . '"';
              $series = $impSeries;
              ?>
              <div id="daily-report"><span class="badge badge-primary ">Chart Analysis</span></div>
            </div>
          </div>
        </div>

        <div class="table-responsive" id="detailed">
          <table class="table custom-table table-sm">
            <thead>
              <tr class="bg-primary text-white text-center">
                <!-- <th>Date</th> -->
                <th>Particulars</th>
                <th>Quantity (LTR)</th>
                <th>Rate (<?php echo $currency ?>)</th>
                <th>Inflow (<?php echo $currency ?>)</th>
                <th>Credit sales (<?php echo $currency ?>)</th>
                <th>Outflow (<?php echo $currency ?>)</th>
                <th>Remarks</th>
              </tr>
            </thead>

            <tbody>
              <tr class="bg-primary text-white">
                <th colspan="6">
                  <h5 class="mb-0">Cash Remittance</h5>
                </th>
                <th>
                  <button class="btn btn-info d-block m-auto py-0 px-2" data-toggle="modal" data-target="#salesModel">
                    &plus; Remit</button>
                </th>
              </tr>
              <?php foreach ($filterReport as $data) : ?>
                <tr>
                  <td>
                    <?php echo 'Cash Sales (' . strtoupper($data->name) . ')'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($data->sales_quantity); ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($data->rate); ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($data->inflow); ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td>
                    Data is from the sales reps!
                  </td>
                </tr>
              <?php endforeach; ?>

              <?php foreach ($remittance as $data) : ?>
                <tr>
                  <td>
                    <?php echo ucwords($data->narration); ?>
                  </td>
                  <td class="text-right">
                    <?php echo $data->quantity != '' ? number_format(intval($data->quantity)) : '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo $data->rate != '' ? number_format(intval($data->rate)) : '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format(intval($data->amount)); ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td>NOTE: The remit button is used to add exceptional cash inflow that was not captured from the normal sales of the day</td>
                </tr>
              <?php endforeach; ?>

              <tr>
                <th colspan="7" class="bg-secondary text-white">
                  <h5 class="mb-0">Credit sales</h5>
                </th>
              </tr>

              <?php foreach ($creditSales as $data) :
                $rate = Product::find_by_name($data->product)->rate;
              ?>
                <tr>
                  <td>
                    <?php echo ucwords($data->narration); ?>
                  </td>
                  <td class="text-right">
                    <?php echo $data->quantity .  'L of ' . $data->product; ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($rate); ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($data->amount); ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($data->amount); ?>
                  </td>
                  <td>
                    This is registered from the Expenses page
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="5">
                  <h5 class="mb-0">Total</h5>
                </td>
                <td class="text-right">
                  <h5 class="mb-0"> <?php echo number_format($totalCredit); ?></h5>
                </td>
                <td></td>
              </tr>

              <tr>
                <th colspan="7" class="bg-secondary text-white">
                  <h5 class="mb-0">Operating Expenses</h5>
                </th>
              </tr>

              <?php foreach ($operatingExp as $data) :
                $rate = !empty($data->product) ? Product::find_by_name($data->product)->rate : '';
              ?>
                <tr>
                  <td>
                    <?php echo ucwords($data->narration); ?>
                  </td>
                  <td class="text-right">
                    <?php echo !empty($data->quantity) ? $data->quantity .  'L of ' . $data->product : ''; ?>
                  </td>
                  <td class="text-right">
                    <?php echo !empty($rate) ? number_format($rate) : ''; ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($data->amount); ?>
                  </td>
                  <td>
                    This is registered from the Expenses page
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="5">
                  <h5 class="mb-0">Total</h5>
                </td>
                <td class="text-right">
                  <h5 class="mb-0"> <?php echo number_format($totalOpExp); ?></h5>
                </td>
                <td></td>
              </tr>

              <tr>
                <th colspan="7" class="bg-secondary text-white">
                  <h5 class="mb-0">Non-Operating Expenses</h5>
                </th>
              </tr>

              <?php foreach ($nonOpgExp as $data) : ?>
                <tr>
                  <td>
                    <?php echo ucwords($data->narration); ?>
                  </td>
                  <td class="text-right">
                    <?php echo !empty($data->quantity) ? $data->quantity .  'L of ' . $data->product : ''; ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($data->amount); ?>
                  </td>
                  <td>
                    This is registered from the Expenses page
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="5">
                  <h5 class="mb-0">Total</h5>
                </td>
                <td class="text-right">
                  <h5 class="mb-0"> <?php echo number_format($totalNonOpExp); ?></h5>
                </td>
                <td></td>
              </tr>

              <tr>
                <th colspan="7" class="bg-secondary text-white">
                  <h5 class="mb-0">Head Office Expenses</h5>
                </th>
              </tr>
              <?php foreach ($headOfficeExp as $data) :
                $rate = !empty($data->product) ? Product::find_by_name($data->product)->rate : '';
              ?>
                <tr>
                  <td>
                    <?php echo ucwords($data->narration); ?>
                  </td>
                  <td class="text-right">
                    <?php echo !empty($data->quantity) ? $data->quantity .  'L of ' . $data->product : ''; ?>
                  </td>
                  <td class="text-right">
                    <?php echo !empty($rate) ? number_format($rate) : ''; ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo '-'; ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($data->amount); ?>
                  </td>
                  <td>
                    This is registered from the Expenses page
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="5">
                  <h5 class="mb-0">Total</h5>
                </td>
                <td class="text-right">
                  <h5 class="mb-0"> <?php echo number_format($totalHOExp); ?></h5>
                </td>
                <td></td>
              </tr>

              <tr>
                <th colspan="7" class="bg-secondary text-white">
                  <h5 class="mb-0">Transfer</h5>
                </th>
              </tr>

              <?php foreach ($transExp as $data) : ?>
                <tr>
                  <td colspan="5">
                    <?php echo ucwords($data->narration); ?>
                  </td>
                  <td class="text-right">
                    <?php echo number_format($data->amount); ?>
                  </td>
                  <td>
                    This is registered from the Expenses page
                  </td>
                </tr>
              <?php endforeach; ?>

              <tr style="border: 3px solid black">
                <td colspan="5" class="font-weight-bold text-uppercase">
                  <?php echo 'Cash to HEAD OFFICE'; ?>
                </td>
                <td class="text-right font-weight-bold">
                  <?php echo number_format($cashToHO); ?>
                </td>
                <td>
                  This section of the report is auto-generated! <br><br>
                  NOTE: Cash to head office = Total sales (<?php echo number_format($totalSales) ?>) - Total expenses (<?php echo number_format($totalExpenses); ?>)
                </td>
              </tr>

              <tr>
                <td colspan="3">
                  <h4 class="mb-0"><?php echo 'Grand Total'; ?></h4>
                </td>
                <td class="text-right">
                  <h4 class="mb-0"><?php echo number_format($totalSales); ?></h4>
                </td>
                <td class="text-right">
                  <h4 class="mb-0">
                    <?php echo number_format($totalCredit); ?>
                  </h4>
                </td>
                <td class="text-right">
                  <h4 class="mb-0">
                    <span class="text-secondary" style="border-bottom: 3px double">
                      <?php echo number_format($grandTotal); ?></span>
                  </h4>
                </td>
                <td>
                  Since Inflow is equal to Outflow hence, account is balance! <br><br>
                  NOTE: Grand Total = Cash to head office (<?php echo number_format($cashToHO); ?>) + Sum of expenses (<?php echo number_format($totalExpenses); ?>)
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script>
      function numberWithCommas(params) {
        return params.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

      var options = {
        plotOptions: {
          pie: {
            startAngle: 0,
            endAngle: 360,
            expandOnClick: true,
            offsetX: 0,
            offsetY: 0,
            customScale: 1,
            dataLabels: {
              offset: 0,
              minAngleToShowLabel: 10
            },
            donut: {
              size: '65%',
              background: 'transparent',
              labels: {
                show: true,
                name: {
                  show: true,
                  fontSize: '20px',
                  fontFamily: 'Helvetica, Arial, sans-serif',
                  fontWeight: 600,
                  color: undefined,
                  offsetY: -10,
                  formatter: function(val) {
                    return val
                  }
                },
                value: {
                  show: true,
                  fontSize: '16px',
                  fontFamily: 'Helvetica, Arial, sans-serif',
                  fontWeight: 400,
                  color: undefined,
                  offsetY: 16,
                  formatter: function(val) {
                    return numberWithCommas(val)
                  }
                },
                total: {
                  show: false,
                  showAlways: false,
                  label: 'Total',
                  fontSize: '18px',
                  fontFamily: 'Helvetica, Arial, sans-serif',
                  fontWeight: 600,
                  color: '#373d3f',
                  formatter: function(w) {
                    return w.globals.seriesTotals.reduce((a, b) => {
                      return a + b
                    }, 0)
                  }
                }
              }
            },
          }
        },
        chart: {
          width: 400,
          type: "donut",
        },
        labels: [<?php echo $label . ', "Cash H-Office"'; ?>],
        series: [<?php echo $series . ', ' . $cashToHO; ?>],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200,
            },
            legend: {
              position: "top",
            },
          },
        }, ],
        stroke: {
          width: 0,
        },
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 0.6,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [70, 100],
          },
        },
        // colors: ["#A300D6", "#7D02EB", "#5653FE", "#2983FF", "#00B1F2"],
        // colors: ["#008FFB", "#00E396", "#FEB019", "#FF4560", "#775DD0"],
        // colors: ["#3F51B5", "#03A9F4", "#4CAF50", "#F9CE1D", "#FF9800"],
        // colors: ["#449DD1", "#F86624", "#EA3546", "#662E9B", "#C5D86D"],
        colors: ["#D7263D", "#1B998B", "#2E294E", "#F46036", "#E2C044", "#00B1F2"],
        // colors: ["#1a8e5f", "#262b31", "#434950", "#63686f", "#868a90"],

      };
      var chart = new ApexCharts(document.querySelector("#daily-report"), options);
      chart.render();
    </script>

<?php endif;
}
