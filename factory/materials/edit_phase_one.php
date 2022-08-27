<?php require_once('../private/initialize.php');

$page = 'Materials';
$page_title = 'Stock Materials';
$phase = 'Phase One';

if (!isset($_GET['id']) || $_GET['id'] == '') redirect_to('../materials');

$material = MaterialPhaseOne::find_by_id($_GET['id']);

if (empty($material)) redirect_to('../materials');

$types = MaterialPhaseOne::TYPE;
$categories = MaterialCategory::find_by_undeleted(['order' => 'ASC']);
$groups = MaterialGroup::find_by_undeleted(['order' => 'ASC']);
$company = Company::find_by_id($loggedInAdmin->company_id);
$branches = Branch::find_all_branch(['company_id' => $company->id]);

include(SHARED_PATH . '/admin_header.php');

?>
<style type="text/css">
  th {
    vertical-align: middle;
  }

  td {
    min-width: 150px;
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

  input[type=text] {
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
    <div class="mb-3">
      <div class="d-flex justify-content-start align-items-center">
        <select class="form-control mr-2" name="mat[branch_id]" id="sBranch" form="material_form" required>
          <option value="">select branch</option>
          <?php foreach ($branches as $branch) : ?>
            <option value="<?php echo $branch->id ?>" <?php echo $branch->id == $material->branch_id ? 'selected' : '' ?>>
              <?php echo ucwords($branch->name) ?></option>
          <?php endforeach; ?>
        </select>
        <select name="mat[type]" class="form-control form-control-sm type" form="material_form" required>
          <option value="">select type</option>
          <?php foreach ($types as $key => $type) : ?>
            <option value="<?php echo $key; ?>" <?php echo $key == $material->type ? 'selected' : '' ?>>
              <?php echo ucwords($type); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <div class="table-container border-0 shadow">
    <div class="table-responsive">
      <form id="material_form" method="post">
        <input type="hidden" name="edit_material_form" readonly>
        <input type="hidden" name="mat[material_id]" value="<?php echo $material->id; ?>" readonly>
        <input type="hidden" name="mat[company_id]" value="<?php echo $company->id ?>" readonly>

        <table class="table table-bordered table-sm">
          <thead>
            <tr class="bg-primary text-white text-center">
              <th>GROUP</th>
              <th>COLORS</th>
              <th>OPENING STOCK</th>
              <th>INFLOW</th>
              <th>TOTAL STOCK</th>
              <th>OUTFLOW</th>
              <th>CLOSING STOCK</th>
            </tr>
          </thead>

          <tbody id="phase-table">
            <tr class="border-0">
              <td>
                <select name="mat[raw_group_id]" class="form-control form-control-sm group_id" required>
                  <option value="">select group</option>
                  <?php foreach ($groups as $group) : ?>
                    <option value="<?php echo $group->id; ?>" <?php echo $group->id == $material->raw_group_id ? 'selected' : '' ?>>
                      <?php echo ucwords($group->name); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>
              <td>
                <select name="mat[raw_category_id]" class="form-control form-control-sm category_id" required>
                  <option value="">select color</option>
                  <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category->id; ?>" <?php echo $category->id == $material->raw_category_id ? 'selected' : '' ?>>
                      <?php echo ucwords($category->name); ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </td>

              <td>
                <input type="text" required name="mat[open_stock]" value="<?php echo $material->open_stock; ?>" class="form-control form-control-sm open_stock actions">
              </td>
              <td>
                <input type="text" required name="mat[inflow]" value="<?php echo $material->inflow; ?>" class="form-control form-control-sm inflow actions">
              </td>
              <td>
                <input type="text" required name="mat[total_stock]" value="<?php echo $material->total_stock; ?>" class="form-control form-control-sm total_stock" readonly>
              </td>
              <td>
                <input type="text" required name="mat[outflow]" value="<?php echo $material->outflow; ?>" class="form-control form-control-sm outflow actions">
              </td>
              <td>
                <input type="text" required name="mat[closing_stock]" value="<?php echo $material->closing_stock; ?>" class="form-control form-control-sm font-weight-bold closing_stock" readonly>
              </td>
            </tr>
          </tbody>
        </table>


        <div class="mb-3">
          <textarea name="mat[remarks]" class="form-control remarks" id="remarks" placeholder="Remarks"><?php echo $material->remarks; ?></textarea>
        </div>

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
    var BACK_URL = './?phase=1'
    const MATERIAL_URL = 'inc/process_one.php';

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
      let actions = document.querySelectorAll('.actions')

      actions.forEach(elem => {
        elem.addEventListener('input', function() {
          let tRow = $(this).closest('#phase-table tr');

          // ********** STOCK
          let openStock = parseFloat(tRow.find('.open_stock').val())
          let inflow = parseFloat(tRow.find('.inflow').val())
          let outflow = parseFloat(tRow.find('.outflow').val())

          let resultStock = openStock + inflow
          let resultStockClose = openStock + inflow - outflow

          parseFloat(tRow.find('.total_stock').val(resultStock))
          // ********** STOCK END

          // ********** CLOSING STOCK
          let closingStock = resultStockClose
          parseFloat(tRow.find('.closing_stock').val(closingStock))
          // ********** CLOSING STOCK

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