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

    $rangeText = $_GET['rangeText'];
    $explode = explode('- ', $rangeText);
    $dateFrom = $explode[0];
    $dateTo = $explode[1];
    $dateConvertFrom = date('Y-m-d', strtotime($dateFrom));
    $dateConvertTo = date('Y-m-d', strtotime($dateTo));

    $admComp = $loggedInAdmin->company_id;

    $expenses = Expense::find_by_expenses($dateConvertFrom, $dateConvertTo, ['company' => $admComp, 'branch' => $branch]);
    $cashFlow = CashFlow::find_by_cash_flow($dateConvertFrom, ['company' => $admComp, 'branch' => $branch]);
    $today = date('Y-m-d');

    $remit = DataSheet::find_by_remittance($today, ['company' => $admComp, 'branch' => $branch]);

    $creditVoucher = isset($cashFlow->credit_voucher) ? $cashFlow->credit_voucher : 'olak.png';

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
              <h3 class="text-uppercase text-right">Remittance: <?php echo $currency . ' ' . number_format($remit->remittance, 2); ?></h3>

              <div class="table-responsive">
                <table class="table custom-table table-sm">
                  <thead>
                    <tr class="bg-primary text-white text-center">
                      <th>Particulars</th>
                      <th>Inflow (<?php echo $currency ?>)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (CashFlow::FLOW as $flow) :
                      $isNaN = in_array($flow, ['narration', 'credit_voucher']);
                      $alternate = isset($cashFlow->$flow) && $cashFlow->$flow != '' ? $cashFlow->$flow : 'Not Set';
                      $amount = isset($cashFlow->$flow) && !$isNaN && $cashFlow->$flow != '' ? $cashFlow->$flow : '0';
                    ?>
                      <tr>
                        <td class="tds font-weight-bold text-uppercase"><?php echo $flow ?></td>
                        <td colspan="2">
                          <p class="mb-0">
                            <?php echo !$isNaN ? number_format($amount) : $alternate; ?></p>
                        </td>
                      </tr>
                    <?php endforeach; ?>
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
