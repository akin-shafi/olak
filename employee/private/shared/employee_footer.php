  </div>
  </div>

  <script src="<?php echo url_for('vendors/js/vendor.bundle.base.js'); ?>"></script>
  <script src="<?php echo url_for('vendors/moment/moment.min.js'); ?>"></script>
  <script src="<?php echo url_for('vendors/daterangepicker/daterangepicker.js'); ?>"></script>
  <script src="<?php echo url_for('vendors/select2/select2.min.js'); ?>"></script>
  <script src="<?php echo url_for('js/off-canvas.js'); ?>"></script>
  <script src="<?php echo url_for('js/misc.js'); ?>"></script>
  <script src="<?php echo url_for('js/dist/apexcharts.min.js'); ?>"></script>
  <script src="<?php echo url_for('js/select2.js'); ?>"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
  <script src="<?php echo url_for('js/calendar.min.js'); ?>"></script>
  <!-- <script src="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/calendar.min.js"></script> -->

  <script src="<?php echo url_for('js/clock.js'); ?>"></script>
  <script src="<?php echo url_for('js/sweetalert.min.js'); ?>"></script>

  <script>
    $('.calendar-wrapper').calendar();

    $(document).ready(function() {
      const EMPLOYEE_URL = "<?php echo url_for('inc/employee_script.'); ?>php";

      const loanForm = document.getElementById("add_loan_form");
      const attendanceForm = document.getElementById("attendance_form");

      const message = (req, res) => {
        swal(req + "!", res, {
          icon: req,
          buttons: {
            confirm: {
              className: (req == 'error') ? 'btn btn-danger' : 'btn btn-success'
            }
          }
        }).then(() => location.reload())
      }

      const submitForm = async (url, payload) => {
        const formData = new FormData(payload);
        formData.append("update", 1);

        const data = await fetch(url, {
          method: "POST",
          body: formData,
        });

        const response = await data.json();

        if (response.errors) {
          message('error', response.errors)
        }

        if (response.message) {
          message('success', response.message)
        }
      };

      const clearLoan = async (url, payload) => {
        const data = await fetch(url);
        const response = await data.json();
        if (response.message) {
          message('success', response.message)
        }
      };

      loanForm.addEventListener("submit", (e) => {
        e.preventDefault();
        submitForm(EMPLOYEE_URL, loanForm);
      });

      attendanceForm.addEventListener("submit", (e) => {
        e.preventDefault();
        submitForm(EMPLOYEE_URL, attendanceForm);
      });

      // setTimeout(() => {
      //   clearLoan(EMPLOYEE_URL + '?clear_loan');
      // }, 5000);

      var options = {
        series: [{
          data: [21, 22, 10, 28, 16, 21, 13, 30, 21, 4, 5, 12]
        }],
        chart: {
          height: 350,
          type: 'bar',
          events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          }
        },
        colors: ["#133d80"],
        plotOptions: {
          bar: {
            columnWidth: '45%',
            distributed: true,
          }
        },
        dataLabels: {
          enabled: true
        },
        legend: {
          show: false
        },
        xaxis: {
          categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
          labels: {
            style: {
              colors: ["#133d80"],
              fontSize: '12px'
            }
          }
        }
      };

      var attendance = new ApexCharts(document.querySelector("#attendance-chart"), options);
      attendance.render();

    });
  </script>

  </body>

  </html>