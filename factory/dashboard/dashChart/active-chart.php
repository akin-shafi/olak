<script>
  function numberWithCommas(params) {
    return params.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  var barOptions = {
    chart: {
      height: 350,
      type: 'bar',
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: 'rounded',
        columnWidth: '50%',
      },
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    series: [{
      name: 'Net Profit',
      data: [<?php echo $profit; ?>]
    }, {
      name: 'Revenue',
      data: [<?php echo $inflow; ?>]
    }, {
      name: 'Expenses Incurred',
      data: [<?php echo $outflow; ?>]
    }],
    xaxis: {
      categories: [<?php echo $month; ?>],
    },
    yaxis: {
      title: {
        text: 'Monetary value in (<?php echo $currency; ?>)'
      }
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      y: {
        formatter: function(val) {
          return "<?php echo $currency; ?> " + numberWithCommas(val)
        }
      }
    },
    grid: {
      row: {
        colors: ['#f5f9fe', '#ffffff'], // takes an array which will be repeated on columns
        opacity: 0.5
      },
    },
    colors: ["#1B998B", "#2E294E", "#D7263D", "#F46036", "#E2C044"],
  }
  var barChart = new ApexCharts(
    document.querySelector("#consolidated-bar"),
    barOptions
  );
  barChart.render();



  var pieOptions = {
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
      type: 'donut',
    },
    labels: ['Profit', 'Revenue', 'Expenses'],
    series: [<?php echo $pieProfit; ?>, <?php echo $pieSales; ?>, <?php echo $pieExpenses; ?>],
    responsive: [{
      breakpoint: 480,
      options: {
        chart: {
          width: 200
        },
        legend: {
          position: 'bottom'
        }
      }
    }],
    stroke: {
      width: 0,
    },
    fill: {
      type: 'gradient',
    },
    colors: ['#1a8e5f', '#2E294E', '#D7263D', '#63686f', '#868a90'],
  }
  var pieChart = new ApexCharts(
    document.querySelector("#consolidated-pie"),
    pieOptions
  );
  pieChart.render();
</script>