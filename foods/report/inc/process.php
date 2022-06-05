<?php require_once('../../private/initialize.php');
if (is_get_request()) {
  if (isset($_GET['filter'])) :
    $metricLabels = [];
    $metricSeries = [];

    $branch = isset($_GET['branch']) && $_GET['branch'] != '' ? $_GET['branch'] : $loggedInAdmin->branch_id;

    $rangeText = $_GET['rangeText'];
    $explode = explode('-', $rangeText);
    $dateFrom = $explode[0];
    $dateTo = $explode[1];
    $dateConvertFrom = date('Y-m-d', strtotime($dateFrom));
    $dateConvertTo = date('Y-m-d', strtotime($dateTo));
    $admComp = $loggedInAdmin->company_id;

    $expenses = Expense::find_by_expenses($dateConvertFrom, $dateConvertTo, ['company' => $loggedInAdmin->company_id, 'branch' => $branch]);
    $cashFlow = CashFlow::single_cash_flow($dateConvertFrom, ['company' => $admComp, 'branch' => $branch]);
    $today = date('Y-m-d');

    $credit_sales = isset($cashFlow->credit_sales) ? floatval($cashFlow->credit_sales) : 0;
    $cash_sales   = isset($cashFlow->cash_sales) ? floatval($cashFlow->cash_sales) : 0;
    $pos          = isset($cashFlow->pos) ? floatval($cashFlow->pos) : 0;
    $transfer     = isset($cashFlow->transfer) ? floatval($cashFlow->transfer) : 0;

    $remittance = $credit_sales + $cash_sales + $pos + $transfer;

    $uploads = Uploads::find_by_date($dateConvertFrom);

?>
    <style>
      .tds {
        width: 50%;
        min-width: 600px !important;
      }
    </style>

    <div>
      <div class="table-container border-0 shadow">
        <div class="d-flex justify-content-between align-items-center">
          <h3>Summary</h3>
          <h3>
            Date:
            <?php echo date('d-m-Y', strtotime($dateConvertFrom)) ?>
          </h3>
        </div>

        <div class="mt-4 mb-5">

          <div class="row gutters">
            <div class="col-md-12">
              <h3 class="text-uppercase text-right">Remittance: <?php echo $currency . ' ' . number_format($remittance, 2); ?></h3>

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
                      <td class="tds font-weight-bold">Narration</td>
                      <td colspan="2">
                        <p class="mb-0">
                          <?php echo isset($cashFlow->narration)
                            ? ucfirst($cashFlow->narration) : 'Narration not set'; ?></p>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Cash Sales</td>
                      <td class="text-center">
                        <?php echo isset($cashFlow->cash_sales)
                          ? number_format($cashFlow->cash_sales) : '0.00'; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Transfer</td>
                      <td class="text-center">
                        <?php echo isset($cashFlow->transfer)
                          ? number_format($cashFlow->transfer) : '0.00'; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">P.O.S</td>
                      <td class="text-center">
                        <?php echo isset($cashFlow->pos)
                          ? number_format($cashFlow->pos) : '0.00'; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Credit Sales</td>
                      <td class="text-center">
                        <?php echo isset($cashFlow->credit_sales)
                          ? number_format($cashFlow->credit_sales) : '0.00'; ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Uploads</td>
                      <td class="text-center">
                        <?php foreach ($uploads as $upload) :
                          $file = isset($upload->file_name) ? $upload->file_name : 'olak.png';
                        ?>
                          <img loading="lazy" src="<?php echo url_for('sales/uploads/' . $file) ?>" class="avatar">
                        <?php endforeach; ?>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-md-12 mt-4">
              <div class="table-responsive">
                <table class="table custom-table table-sm">
                  <thead>
                    <tr class="bg-secondary text-white text-center">
                      <th>Particulars</th>
                      <th>Narration</th>
                      <th>Outflow (<?php echo $currency ?>)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($expenses as $expense) : ?>
                      <tr>
                        <td>
                          <?php echo isset($expense->title) ? ucfirst($expense->title) : 'Not set' ?>
                        </td>
                        <td>
                          <?php echo isset($expense->narration) ? ucfirst($expense->narration) : 'Not set' ?>
                        </td>
                        <td class="text-center">
                          <?php echo isset($expense->amount) ? number_format($expense->amount) : '0.00'; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      function numberWithCommas(params) {
        return params.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

      // var options = {
      //   plotOptions: {
      //     pie: {
      //       startAngle: 0,
      //       endAngle: 360,
      //       expandOnClick: true,
      //       offsetX: 0,
      //       offsetY: 0,
      //       customScale: 1,
      //       dataLabels: {
      //         offset: 0,
      //         minAngleToShowLabel: 10
      //       },
      //       donut: {
      //         size: '65%',
      //         background: 'transparent',
      //         labels: {
      //           show: true,
      //           name: {
      //             show: true,
      //             fontSize: '20px',
      //             fontFamily: 'Helvetica, Arial, sans-serif',
      //             fontWeight: 600,
      //             color: undefined,
      //             offsetY: -10,
      //             formatter: function(val) {
      //               return val
      //             }
      //           },
      //           value: {
      //             show: true,
      //             fontSize: '16px',
      //             fontFamily: 'Helvetica, Arial, sans-serif',
      //             fontWeight: 400,
      //             color: undefined,
      //             offsetY: 16,
      //             formatter: function(val) {
      //               return numberWithCommas(val)
      //             }
      //           },
      //           total: {
      //             show: false,
      //             showAlways: false,
      //             label: 'Total',
      //             fontSize: '18px',
      //             fontFamily: 'Helvetica, Arial, sans-serif',
      //             fontWeight: 600,
      //             color: '#373d3f',
      //             formatter: function(w) {
      //               return w.globals.seriesTotals.reduce((a, b) => {
      //                 return a + b
      //               }, 0)
      //             }
      //           }
      //         }
      //       },
      //     }
      //   },
      //   chart: {
      //     width: 400,
      //     type: "donut",
      //   },
      //   labels: [<?php //echo $label . ', "Expected Cash"'; 
                    ?>],
      //   series: [<?php //echo $series . ', ' . $cashToHO; 
                    ?>],
      //   responsive: [{
      //     breakpoint: 480,
      //     options: {
      //       chart: {
      //         width: 200,
      //       },
      //       legend: {
      //         position: "top",
      //       },
      //     },
      //   }, ],
      //   stroke: {
      //     width: 0,
      //   },
      //   fill: {
      //     type: "gradient",
      //     gradient: {
      //       shadeIntensity: 0.6,
      //       inverseColors: false,
      //       opacityFrom: 1,
      //       opacityTo: 1,
      //       stops: [70, 100],
      //     },
      //   },
      //   // colors: ["#A300D6", "#7D02EB", "#5653FE", "#2983FF", "#00B1F2"],
      //   // colors: ["#008FFB", "#00E396", "#FEB019", "#FF4560", "#775DD0"],
      //   // colors: ["#3F51B5", "#03A9F4", "#4CAF50", "#F9CE1D", "#FF9800"],
      //   // colors: ["#449DD1", "#F86624", "#EA3546", "#662E9B", "#C5D86D"],
      //   colors: ["#D7263D", "#1B998B", "#2E294E", "#F46036", "#E2C044", "#00B1F2"],
      //   // colors: ["#1a8e5f", "#262b31", "#434950", "#63686f", "#868a90"],

      // };
      // var chart = new ApexCharts(document.querySelector("#daily-report"), options);
      // chart.render();
    </script>

<?php endif;
}
