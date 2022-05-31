<?php require_once('../../private/initialize.php');

if (is_get_request()) {
  if (isset($_GET['filter'])) :
    $branchId = $_GET['branch'];
    $dataSheets = DataSheet::get_sheets($branchId);


    $metricTopProductName = [];
    $metricTopProductValue = [];

    $topSelling = DataSheet::get_top_selling_product($branchId);
    foreach ($topSelling as $value) {
      array_push($metricTopProductName, $value->product_name);
      array_push($metricTopProductValue, intval($value->actual_sales));
    }
    $impLabel = implode('","',  $metricTopProductName);
    $impSeries = implode(',',  $metricTopProductValue);

    $label = '"' . $impLabel . '"';
    $series = $impSeries;

?>
    <style>
      .list-group .list-group-item {
        border: 3px solid #000;
      }
    </style>
    <div class="row gutters">

      <?php foreach ($topSelling as $pro) :
        $lagInCash = intval($pro->total_sales) - intval($pro->expected_sales);
      ?>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
          <ul class="list-group list-group-flush shadow px-2">
            <li class="list-group-item border-left-0 border-right-0 text-right">
              <div class="d-flex justify-content-between align-items-center">
                <div class="left">
                  <p class="mb-0" style="font-size: 36px;">
                    <span class="d-block d-flex justify-content-center align-items-center p-1 text-white rounded-circle" style="width:50px;height:50px;background-color:darkslategray">
                      <?php echo $currency ?>
                    </span>
                  </p>
                </div>
                <div class="right">
                  <h6 class="text-uppercase">Expected Sales: <?php echo strtoupper($pro->product_name) ?></h6>
                  <h2 class="mb-0"><?php echo number_format($pro->expected_sales); ?></h2>
                </div>
              </div>
            </li>
            <li class="list-group-item border-left-0 border-right-0 text-right">
              <div class="d-flex justify-content-between">
                <div class="left">
                  <p class="mb-0" style="font-size: 36px;">
                    <span class="d-block d-flex justify-content-center align-items-center p-1 text-white rounded-circle" style="width:50px;height:50px;background-color:darkcyan">
                      <?php echo $currency ?>
                    </span>
                  </p>
                </div>
                <div class="right">
                  <h6 class="text-uppercase">Remittance: <?php echo strtoupper($pro->product_name) ?></h6>
                  <h2 class="mb-0"><?php echo number_format($pro->total_sales); ?></h2>
                </div>
              </div>
            </li>
            <li class="list-group-item border-left-0 border-right-0 text-right">
              <div class="d-flex justify-content-between">
                <div class="left">
                  <p class="mb-0" style="font-size: 36px;">
                    <span class="d-block d-flex justify-content-center align-items-center p-1 text-white rounded-circle" style="width:50px;height:50px;background-color:brown">
                      <?php echo $currency ?>
                    </span>
                  </p>
                </div>
                <div class="right">
                  <h6 class="text-uppercase">Difference: <?php echo strtoupper($pro->product_name) ?></h6>
                  <h2 class="mb-0"><?php echo number_format($lagInCash); ?></h2>
                </div>
              </div>
            </li>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="row gutters">
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12 mb-5">
        <div class="shadow-sm p-3">
          <div class="table-responsive">
            <table class="table custom-table table-sm">
              <thead>
                <tr class="bg-primary text-white ">
                  <th>SN</th>
                  <th>Product (Tank)</th>
                  <th>Stock for Sale (LTR)</th>
                  <th>Actual Sales (LTR)</th>
                  <th>Available Stock (LTR)</th>
                  <th>Over/Short (LTR)</th>
                  <th>Expected Sales (<?php echo $currency; ?>)</th>
                  <th>Remittance (<?php echo $currency; ?>)</th>
                  <th>Difference (<?php echo $currency; ?>)</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $sn = 1;
                foreach ($dataSheets as $data) :
                  $product = Product::find_by_id($data->product_id);
                  $lagInCash = intval($data->total_sales) - intval($data->expected_sales);
                ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo ucwords($product->name) . ' (' . $product->tank . ')'; ?></td>
                    <td class="text-right"><?php echo number_format($data->total_stock, 2); ?></td>
                    <td class="text-right"><?php echo number_format($data->actual_sales, 2); ?></td>
                    <td class="text-right"><?php echo number_format($data->available_stock, 2); ?></td>
                    <td class="text-right">
                      <span class="<?php echo $data->over_or_short < 0 ? 'text-danger' : 'text-dark' ?>">
                        <?php echo number_format($data->over_or_short, 2); ?>
                      </span>
                    </td>
                    <td class="text-right"><?php echo number_format($data->expected_sales, 2); ?></td>
                    <td class="text-right"><?php echo number_format($data->total_sales, 2); ?></td>
                    <td class="text-right">
                      <span class="<?php echo $lagInCash < 0 ? 'text-danger' : 'text-dark' ?>">
                        <?php echo number_format($lagInCash, 2); ?>
                      </span>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <tr>
                  <td colspan="10" class="text-center font-weight-bold">
                    <a href="<?php echo url_for('/sales') ?>" class="text-danger">view more...</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
        <div class="shadow-sm p-3">
          <h4 class="card-title text-uppercase">Sales (ltr)</h4>
          <div id="consolidated-sBar"></div>
        </div>
      </div>
    </div>

<?php endif;
}

?>

<script>
  function numberWithCommas(params) {
    return params.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  var sBarOptions = {
    chart: {
      type: 'bar',
    },
    plotOptions: {
      bar: {
        horizontal: true,
        barHeight: '35%',
      }
    },
    dataLabels: {
      enabled: true
    },
    series: [{
      name: 'Sales',
      data: [<?php echo $series ?>]
    }],
    xaxis: {
      categories: [<?php echo $label ?>],
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return numberWithCommas(val) + " (LTR)"
        }
      }
    },
    theme: {
      monochrome: {
        enabled: true,
        color: '#1a8e5f',
        shadeIntensity: 0.1
      },
    },
  }
  var sBarChart = new ApexCharts(
    document.querySelector("#consolidated-sBar"),
    sBarOptions
  );

  sBarChart.render();
</script>