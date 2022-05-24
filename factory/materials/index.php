<?php require_once('../private/initialize.php');
require_login();

$page = 'Materials';
$page_title = 'Material Dashboard';
include(SHARED_PATH . '/admin_header.php');

$phase = $_GET['phase'] ?? '1';

$groupType = MaterialPhaseOne::find_by_type();

$phaseTwo = MaterialPhaseTwo::find_by_undeleted();

?>

<style>
  th {
    text-align: center;
    font-size: 10px;
  }

  div.dataTables_wrapper div.dataTables_filter {
    padding: 10px 8px 5px 0;
  }

  div.dataTables_wrapper div.dataTables_paginate {
    padding: 0 8px 5px 0;
  }
</style>

<div class="content-wrapper">


  <ul class="nav nav-tabs" id="phaseTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link text-uppercase <?php echo isset($phase) && $phase == '1' ? 'active' : '' ?>" id="phase-one-tab" data-toggle="tab" data-target="#phase-one" type="button" role="tab" aria-controls="phase-one" aria-selected="true">Phase One</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link text-uppercase <?php echo isset($phase) && $phase == '2' ? 'active' : '' ?>" id="phase-two-tab" data-toggle="tab" data-target="#phase-two" type="button" role="tab" aria-controls="phase-two" aria-selected="false">Phase Two</button>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane <?php echo isset($phase) && $phase == '1' ? 'active' : '' ?>" id="phase-one" role="tabpanel" aria-labelledby="phase-one-tab">
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-end align-items-center ">
                <a href="<?php echo url_for('/materials/phase_one.php') ?>" class="btn btn-primary">
                  &plus; Add Stock</a>
              </div>

              <div class="table-container p-0 border-0">
                <?php foreach ($groupType as $data) :
                  $phaseGroupOne = MaterialPhaseOne::find_by_group_id(1, $data->type);
                  $phaseGroupTwo = MaterialPhaseOne::find_by_group_id(2, $data->type); ?>
                  <h3 class="text-uppercase">Stock for raw materials
                    (<?php echo MaterialPhaseOne::TYPE[$data->type];
                      echo $data->type == 1 ? ' KG' : '' ?>)
                  </h3>
                  <div class="table-responsive shadow p-3 mb-5">
                    <div class="tg-wrap d-flex">
                      <table class="table table-bordered dataTable mr-2" id="material-weight">
                        <thead>
                          <tr>
                            <th><?php echo date('M d') ?></th>
                            <th colspan="6">Imported coil</th>
                          </tr>
                          <tr>
                            <th>Colors</th>
                            <th>Opening Stock</th>
                            <th>Inflow</th>
                            <th>Total Stock</th>
                            <th>Outflow</th>
                            <th>Closing Stock</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody id="material-table">
                          <?php foreach ($phaseGroupTwo as $data) :
                            $category = MaterialCategory::find_by_id($data->raw_category_id)->name;
                          ?>
                            <tr>
                              <td><?php echo ucwords($category) ?></td>
                              <td class="text-right open_stock"><?php echo number_format($data->open_stock, 2) ?></td>
                              <td class="text-right inflow"><?php echo number_format($data->inflow, 2) ?></td>
                              <td class="text-right total_stock"><?php echo number_format($data->total_stock, 2) ?></td>
                              <td class="text-right outflow"><?php echo number_format($data->outflow, 2) ?></td>
                              <td class="text-right closing_stock"><?php echo number_format($data->closing_stock, 2) ?></td>
                              <td>
                                <div class="btn-group">
                                  <a href="<?php echo url_for('materials/edit_phase_one.php?id=' . $data->id); ?>" class="btn btn-sm btn-warning edit-btn">
                                    <i class="icon-edit1"></i></a>
                                  <button class="btn btn-sm btn-danger remove-btn" data-id="<?php echo $data->id; ?>">
                                    <i class="icon-trash"></i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                            <!-- <tr>
                              <th>Total</th>
                              <td class="text-danger text-right s_open_stock"></td>
                              <td class="text-danger text-right s_inflow"></td>
                              <td class="text-danger text-right s_total_stock"></td>
                              <td class="text-danger text-right s_outflow"></td>
                              <td class="text-danger text-right s_closing_stock"></td>
                              <td></td>
                            </tr> -->
                          <?php endforeach; ?>

                        </tbody>
                      </table>

                      <table class="table table-bordered dataTable">
                        <thead>
                          <tr>
                            <th colspan="6">Local coil</th>
                          </tr>
                          <tr>
                            <th>Colors</th>
                            <th>Opening Stock</th>
                            <th>Inflow</th>
                            <th>Total Stock</th>
                            <th>Outflow</th>
                            <th>Closing Stock</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($phaseGroupOne as $data) :
                            $category = MaterialCategory::find_by_id($data->raw_category_id)->name;
                          ?>
                            <tr>
                              <td><?php echo ucwords($category) ?></td>
                              <td class="text-right"><?php echo number_format($data->open_stock, 2) ?></td>
                              <td class="text-right"><?php echo number_format($data->inflow, 2) ?></td>
                              <td class="text-right"><?php echo number_format($data->total_stock, 2) ?></td>
                              <td class="text-right"><?php echo number_format($data->outflow, 2) ?></td>
                              <td class="text-right"><?php echo number_format($data->closing_stock, 2) ?></td>
                              <td>
                                <div class="btn-group">
                                  <a href="<?php echo url_for('materials/edit_phase_one.php?id=' . $data->id); ?>" class="btn btn-sm btn-warning edit-btn">
                                    <i class="icon-edit1"></i></a>
                                  <button class="btn btn-sm btn-danger remove-btn" data-id="<?php echo $data->id; ?>">
                                    <i class="icon-trash"></i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>


    <div class="tab-pane <?php echo isset($phase) && $phase == '2' ? 'active' : '' ?>" id="phase-two" role="tabpanel" aria-labelledby="phase-two-tab">
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 text-uppercase">Daily stock for raw materials report</h3>
                <a href="<?php echo url_for('/materials/phase_two.php') ?>" class="btn btn-info">
                  &plus; Add Stock</a>
              </div>

              <div class="table-container border-0 shadow">
                <div class="table-responsive">
                  <table class="table custom-table table-sm dataTable">
                    <thead>
                      <tr class="bg-info text-white ">
                        <th>SN</th>
                        <th>Products</th>
                        <th>Weight (KG)</th>
                        <th title="SLABS, COILS & BAGS">Open Stock S.C.B <span class="icon-question_answer"></span></th>
                        <th>Opening Stock (KG)</th>
                        <th title="SLABS, COILS & BAGS">Inflow S.C.B <span class="icon-question_answer"></span></th>
                        <th>Inflow (KG)</th>
                        <th title="SLABS, COILS & BAGS">Total S.C.B <span class="icon-question_answer"></span></th>
                        <th>Total Stock (KG)</th>
                        <th title="SLABS, COILS & BAGS">Outflow S.C.B <span class="icon-question_answer"></span></th>
                        <th>Outflow (KG)</th>
                        <th title="SLABS, COILS & BAGS">Close Stock S.C.B <span class="icon-question_answer"></span></th>
                        <th>Closing Stock (KG)</th>
                        <th>created by</th>
                        <th>updated at</th>
                        <th>created at</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $sn = 1;
                      foreach ($phaseTwo as $data) :
                        $createdBy = Admin::find_by_id($data->created_by)->full_name;
                        $exp = explode(' ', $createdBy);
                        $firstName = $exp[0];
                        $initials = substr($exp[1], 0, 1);
                        $officer = $firstName . ' ' . $initials . '.';
                        $product = Product::find_by_id($data->product_id)->name;
                      ?>
                        <tr>
                          <td><?php echo $sn++; ?></td>

                          <td><?php echo ucwords($product) ?></td>
                          <td class="text-right"><?php echo number_format($data->weight, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->open_scb, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->open_stock, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->inflow_scb, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->inflow, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->total_stock_scb, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->total_stock, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->outflow_scb, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->outflow, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->closing_stock_scb, 2) ?></td>
                          <td class="text-right"><?php echo number_format($data->closing_stock, 2) ?></td>

                          <td><?php echo ucwords($officer) ?></td>

                          <td><?php echo $data->updated_at != '0000-00-00 00:00:00' ? date('Y-m-d (h:i:s a)', strtotime($data->updated_at)) : date('Y-m-d'); ?></td>
                          <td><?php echo date('Y-m-d', strtotime($data->created_at)); ?></td>

                          <td>
                            <div class="btn-group">
                              <a href="<?php echo url_for('materials/edit_phase_two.php?id=' . $data->id); ?>" class="btn btn-warning edit-btn">
                                <i class="icon-edit1"></i></a>
                              <button class="btn btn-danger remove-btn" data-id="<?php echo $data->id; ?>">
                                <i class="icon-trash"></i>
                              </button>
                            </div>
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
    </div>
  </div>

</div>

<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const PHASE_URL = 'inc/process_two.php';

    $(document).on('click', '.remove-btn', function() {
      let stockId = this.dataset.id;
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: PHASE_URL,
            method: "POST",
            data: {
              stockId: stockId,
              delete_stock: 1
            },
            dataType: 'json',
            success: function(data) {
              Swal.fire(
                'Deleted!',
                data.msg,
                'success'
              )
            }
          });

        }
      }).then(() => window.location.reload())

    });

    // s_open_stock
    // s_inflow
    // s_total_stock
    // s_outflow
    // s_closing_stock
    window.addEventListener('load', function() {


    })


    const addStock = () => {
      let actions = document.querySelectorAll('.actions')


      actions.forEach(elem => {
        let tRow = $(this).closest('#material-table tr');

        sum = 0;
        let openStock = parseFloat(tRow.find('.open_stock').val())

      });
    }
  })
</script>