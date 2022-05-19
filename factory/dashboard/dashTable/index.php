<?php require_once('../../private/initialize.php');

if (is_get_request()) {
  if (isset($_GET['filter'])) :
    $branchId = $_GET['branch'];
    $dataSheets = StockPhaseOne::get_sheets($branchId);


    $metricTopProductName = [];
    $metricTopProductValue = [];
    $topSelling = StockPhaseOne::get_top_selling_product($branchId);
    foreach ($topSelling as $value) {
      array_push($metricTopProductName, $value->product_name);
      array_push($metricTopProductValue, $value->total_sales);
    }
    $impLabel = implode('","',  $metricTopProductName);
    $impSeries = implode(',',  $metricTopProductValue);

    $label = '"' . $impLabel . '"';
    $series = $impSeries;

?>

    <div class="row gutters">
      <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12 mb-5">
        <div class="shadow-sm p-3">
          <div class="table-responsive">
            <table class="table custom-table table-sm">
              <thead>
                <tr class="bg-primary text-white ">
                  <th>SN</th>
                  <th>Product (Tank)</th>
                  <th>In Stock</th>
                  <th>Sales</th>
                  <th>Expected Stock</th>
                  <th>Actual Stock</th>
                  <th>Over/Short</th>
                  <th>Expected Sales (<?php echo $currency; ?>)</th>
                  <th>Cash Remitted (<?php echo $currency; ?>)</th>
                  <th>Over/Short (<?php echo $currency; ?>)</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $sn = 1;
                foreach ($dataSheets as $data) :
                  $product = Product::find_by_id($data->product_id);
                  $lagInCash = intval($data->cash_submitted) - intval($data->exp_sales_value);
                ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo ucwords($product->name) . ' (' . $product->tank . ')'; ?></td>
                    <td><?php echo number_format($data->total_stock); ?></td>
                    <td><?php echo number_format($data->total_sales); ?></td>
                    <td><?php echo number_format($data->expected_stock); ?></td>
                    <td><?php echo number_format($data->actual_stock); ?></td>
                    <td>
                      <span class="<?php echo $data->over_or_short < 0 ? 'text-danger' : 'text-dark' ?>">
                        <?php echo number_format($data->over_or_short); ?>
                      </span>
                    </td>
                    <td><?php echo number_format($data->exp_sales_value); ?></td>
                    <td><?php echo number_format($data->cash_submitted); ?></td>
                    <td>
                      <span class="<?php echo $lagInCash < 0 ? 'text-danger' : 'text-dark' ?>">
                        <?php echo number_format($lagInCash); ?>
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
          <h4 class="card-title text-uppercase">Top Selling Product</h4>
          <div id="consolidated-sBar"></div>
        </div>
      </div>
    </div>

<?php endif;
}

?>

<script>
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
          return "<?php echo $currency; ?> " + numberWithCommas(val)
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