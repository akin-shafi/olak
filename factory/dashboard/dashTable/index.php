<?php require_once('../../private/initialize.php');

if (is_get_request()) {
  if (isset($_GET['filter'])) :
    $branchId = $_GET['branch'];
    $dataSheets = StockPhaseOne::get_sheets($branchId);

    $metricTopProductName = [];
    $metricTopProduction = [];
    $metricTopSales = [];
    $topSelling = StockPhaseOne::get_top_selling_product($branchId);
    foreach ($topSelling as $value) {
      array_push($metricTopProductName, ucwords($value->product_name));
      array_push($metricTopProduction, number_format($value->total_production, 2));
      array_push($metricTopSales, number_format($value->total_sales, 2));
    }
    $impLabel = implode('","',  $metricTopProductName);
    $impSeriesSales = implode(',',  $metricTopSales);
    $impSeriesPro = implode(',',  $metricTopProduction);

    $label = '"' . $impLabel . '"';
    $seriesSales = $impSeriesSales;
    $seriesProduct = $impSeriesPro;

?>

    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
        <div class="shadow-sm p-3">
          <h4 class="card-title text-uppercase">Top Selling Product</h4>
          <div id="consolidated-sBar"></div>
        </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-5">
        <div class="shadow-sm p-3">
          <div class="table-responsive">
            <table class="table custom-table">
              <thead>
                <tr class="bg-primary text-white ">
                  <th>SN</th>
                  <th>Product</th>
                  <th>Total Production</th>
                  <th>Total Sales</th>
                  <th>Return Inward</th>
                  <th>Closing Stock</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $sn = 1;
                foreach ($dataSheets as $data) :
                  $product = Product::find_by_id($data->product_id);
                  $category = Category::find_by_id($data->category_id);
                  $gauge = Gauge::find_by_id($data->gauge_id);
                  $lagInCash = $data->return_inward;
                ?>
                  <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo ucwords($product->name); ?></td>
                    <td><?php echo number_format($data->total_production, 2); ?></td>
                    <td><?php echo number_format($data->total_sales, 2); ?></td>
                    <td>
                      <span class="<?php echo $data->return_inward < 0 ? 'text-danger' : 'text-dark' ?>">
                        <?php echo number_format($data->return_inward, 2); ?>
                      </span>
                    </td>
                    <td><?php echo number_format($data->closing_stock, 2); ?></td>
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
    </div>

<?php endif;
}

?>

<script>
  var sBarOptions = {
    chart: {
      type: 'bar',
      height: 350,
      stacked: true,
      stackType: "100%"
    },
    plotOptions: {
      bar: {
        horizontal: true,
      }
    },
    dataLabels: {
      enabled: true
    },
    stroke: {
      width: 1,
      colors: ['#fff']
    },
    series: [{
        name: 'Production',
        data: [<?php echo $seriesProduct ?>],
        fillColor: '#2E294E',
      },
      {
        name: 'Sales',
        data: [<?php echo $seriesSales ?>],
        strokeColor: '#C23829',
      }
    ],
    xaxis: {
      categories: [<?php echo $label ?>],
    },
    colors: ['#2E294E', '#00E396'],
    tooltip: {
      y: {
        formatter: function(val) {
          return numberWithCommas(val)
        }
      }
    },
    fill: {
      opacity: 1
    },
    legend: {
      position: 'top',
      horizontalAlign: 'center',
      offsetX: 40
    }
    // theme: {
    //   monochrome: {
    //     enabled: true,
    //     color: '#1a8e5f',
    //   },
    // },
  }
  var sBarChart = new ApexCharts(
    document.querySelector("#consolidated-sBar"),
    sBarOptions
  );

  sBarChart.render();
</script>