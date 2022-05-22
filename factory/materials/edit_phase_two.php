<?php require_once('../private/initialize.php');

$page = 'Materials';
$page_title = 'Stock Materials';
$phase = 'Phase Two';

if (!isset($_GET['id']) || $_GET['id'] == '') redirect_to('../materials');

$material = MaterialPhaseTwo::find_by_id($_GET['id']);
$products = Product::find_by_undeleted();

if (empty($material)) redirect_to('../materials');


include(SHARED_PATH . '/admin_header.php');

?>
<style type="text/css">
  th {
    font-size: 12px;
    vertical-align: middle;
  }

  td {
    min-width: 90px;
    padding: 0.2rem 0.3rem !important;
  }

  label {
    text-transform: uppercase;
  }

  input,
  select {
    display: block;
    border-radius: 0 !important;
    border: none;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  input[type=number] {
    -moz-appearance: textfield;
    text-align: right;
  }

  input:focus {
    outline: 1px solid green;
  }

  .remarks {
    width: 30%;
    min-width: 120px;
  }
</style>


<div class="content-wrapper">
  <div class="d-flex justify-content-between align-items-center">
    <h4>EDIT DAILY STOCK FOR RAW MATERIALS (<?php echo strtoupper($phase) ?>) </h4>
  </div>

  <div class="table-container border-0 shadow">
    <div class="table-responsive">
      <form id="material_form" method="post">
        <input type="hidden" name="edit_material_form" readonly>
        <input type="hidden" name="mat[material_id]" value="<?php echo $material->id; ?>" readonly>

        <table class="table table-bordered table-sm">
          <thead>
            <tr class="bg-primary text-white text-center">
              <th>PRODUCTS</th>
              <th>WEIGHT (KG)</th>
              <th title="SLABS, COILS & BAGS">OPEN STOCK S.C.B <span class="icon-question_answer"></span></th>
              <th>OPENING STOCK (KG)</th>
              <th title="SLABS, COILS & BAGS">INFLOW S.C.B <span class="icon-question_answer"></span></th>
              <th>INFLOW (KG)</th>
              <th title="SLABS, COILS & BAGS">TOTAL S.C.B <span class="icon-question_answer"></span></th>
              <th>TOTAL STOCK (KG)</th>
              <th title="SLABS, COILS & BAGS">OUTFLOW S.C.B <span class="icon-question_answer"></span></th>
              <th>OUTFLOW (KG)</th>
              <th title="SLABS, COILS & BAGS">CLOSE STOCK S.C.B <span class="icon-question_answer"></span></th>
              <th>CLOSING STOCK (KG)</th>
            </tr>
          </thead>

          <tbody id="material-table">
            <tr class="border-0">
              <td>
                <select name="mat[product_id]" class="form-control form-control-sm product_id" required>
                  <option value="">select product</option>
                  <?php foreach ($products as $product) : ?>
                    <option value="<?php echo $product->id; ?>" <?php echo $product->id == $material->product_id ? 'selected' : ''; ?>>
                      <?php echo ucwords($product->name); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
              <td>
                <input type="text" required name="mat[weight]" value="<?php echo $material->weight ?>" class="form-control form-control-sm weight actions">
              </td>
              <td>
                <input type="text" required name="mat[open_scb]" value="<?php echo $material->open_scb ?>" class="form-control form-control-sm open_scb in_scb" title="SLABS, COILS & BAGS">
              </td>
              <td>
                <input type="text" required name="mat[open_stock]" value="<?php echo $material->open_stock ?>" class="form-control form-control-sm open_stock in_flow">
              </td>
              <td>
                <input type="text" required name="mat[inflow_scb]" value="<?php echo $material->inflow_scb ?>" class="form-control form-control-sm inflow_scb in_scb" title="SLABS, COILS & BAGS">
              </td>
              <td>
                <input type="text" required name="mat[inflow]" value="<?php echo $material->inflow ?>" class="form-control form-control-sm inflow in_flow">
              </td>
              <td>
                <input type="text" required name="mat[total_stock_scb]" value="<?php echo $material->total_stock_scb ?>" class="form-control form-control-sm total_stock_scb" readonly>
              </td>
              <td>
                <input type="text" required name="mat[total_stock]" value="<?php echo $material->total_stock ?>" class="form-control form-control-sm total_stock" readonly>
              </td>
              <td>
                <input type="text" required name="mat[outflow_scb]" value="<?php echo $material->outflow_scb ?>" class="form-control form-control-sm outflow_scb action_scb">
              </td>
              <td>
                <input type="text" required name="mat[outflow]" value="<?php echo $material->outflow ?>" class="form-control form-control-sm outflow actions">
              </td>
              <td>
                <input type="text" required name="mat[closing_stock_scb]" value="<?php echo $material->closing_stock_scb ?>" class="form-control form-control-sm font-weight-bold closing_stock_scb" readonly>
              </td>
              <td>
                <input type="text" required name="mat[closing_stock]" value="<?php echo $material->closing_stock ?>" class="form-control form-control-sm font-weight-bold closing_stock" readonly>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary mb-3" id="submit_sales">Submit</button>
        </div>
      </form>

      <input type="hidden" class="form-control" id="total_item" value="1" readonly>
    </div>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script type="text/javascript">
  $(document).ready(function() {
    var BACK_URL = './?phase=2'
    const MATERIAL_URL = 'inc/process_two.php';

    $('#material_form').on("submit", function(e) {
      e.preventDefault();
      $('#submit_sales').attr('disabled', true);

      $.ajax({
        url: MATERIAL_URL,
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function(r) {
          if (r.success == true) {
            successAlert(r.msg);
            window.location.href = BACK_URL
          } else {
            errorAlert(r.msg);
          }
        }
      })
    });

    window.onload = () => {
      addStock()
    }

    const addStock = () => {
      let in_scb = document.querySelectorAll('.in_scb')
      let out_scb = document.querySelectorAll('.outflow_scb')

      in_scb.forEach(elem => {
        elem.addEventListener('input', function() {
          let tRow = $(this).closest('#material-table tr');

          let openSCB = parseFloat(tRow.find('.open_scb').val())
          let inflowSCB = parseFloat(tRow.find('.inflow_scb').val())

          let resultSCB = openSCB + inflowSCB

          tRow.find('.total_stock_scb').val(resultSCB)
        })
      });

      out_scb.forEach(elem => {
        elem.addEventListener('input', function() {
          let tRow = $(this).closest('#material-table tr');

          let totalSCB = parseFloat(tRow.find('.total_stock_scb').val())
          let outSCB = parseFloat(tRow.find('.outflow_scb').val())

          let resultSCB = totalSCB - outSCB

          parseFloat(tRow.find('.closing_stock_scb').val(resultSCB))

        })
      });


      let in_flow = document.querySelectorAll('.in_flow')
      let outflow = document.querySelectorAll('.outflow')

      in_flow.forEach(elem => {
        elem.addEventListener('input', function() {
          let tRow = $(this).closest('#material-table tr');

          let openStock = parseFloat(tRow.find('.open_stock').val())
          let inflow = parseFloat(tRow.find('.inflow').val())

          let resultSCB = openStock + inflow

          tRow.find('.total_stock').val(resultSCB)
        })
      });

      outflow.forEach(elem => {
        elem.addEventListener('input', function() {
          let tRow = $(this).closest('#material-table tr');

          let totalStock = parseFloat(tRow.find('.total_stock').val())
          let outflow = parseFloat(tRow.find('.outflow').val())

          let result = totalStock - outflow

          parseFloat(tRow.find('.closing_stock').val(result))

        })
      });
    }



















    // ***** Close Of Business CronJob *****
    const COBCronJob = setInterval(() => {
      let date = new Date()
      let hr = date.getHours()
      if (hr >= 23 || hr <= 6) {
        // $('#material_form :input').prop('disabled', true)
        // $('.out-of-service').removeClass('d-none');
      }
    }, 250)

    setTimeout(() => clearInterval(COBCronJob), 250)
    // ***** Close Of Business CronJob *****

    // ***** Start Of Business CronJob *****
    const SOBCronJob = setInterval(() => {
      let date = new Date()
      let hr = date.getHours()
      if (hr >= 7) {
        $('#material_form :input').prop('disabled', false)
        // $('.out-of-service').removeClass('d-none'); //! Comment this out!
      }
    }, 250)

    setTimeout(() => clearInterval(SOBCronJob), 250)
    // ***** Start Of Business CronJob *****
  })
</script>