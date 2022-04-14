<?php require_once('../private/initialize.php');
require_login();

$page = 'Settings';
$page_title = 'Company Setup';
include(SHARED_PATH . '/admin_header.php');

$ownerId = $loggedInAdmin->full_name();
$company = Company::find_by_undeleted();
$branch = Branch::find_by_undeleted();

?>
<style>
  th {
    font-size: 10px;
    vertical-align: middle;
  }

  td {
    min-width: 100px;
  }
</style>

<div class="content-wrapper">
  <div class="d-flex justify-content-end">
    <button class="btn btn-primary mb-3 mx-3 <?php echo !empty($company) ? 'd-none' : '' ?>" data-toggle="modal" data-target="#companyModel">
      &plus; Create Company</button>

    <?php if (!empty($company)) : ?>
      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#branchModel">
        &plus; Add Branch</button>
    <?php endif; ?>
  </div>

  <div class="row gutters">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

      <div class="card">
        <div class="card-body">
          <div class="table-container">
            <h3>Company Info</h3>
            <div class="table-responsive">
              <table class="table custom-table table-sm">
                <thead>
                  <tr class="bg-primary text-white ">
                    <th>Company Logo</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Company Name</th>
                    <th>Registration No</th>
                    <th>Company Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($company as $data) : ?>
                    <tr>
                      <td>
                        <img class="img-thumbnail" src="<?php echo url_for('settings/uploads/' . $data->logo); ?>" width="100" alt="<?php echo ucwords($data->name); ?>">
                      </td>
                      <td><?php echo strtoupper($data->full_name); ?></td>
                      <td><?php echo $data->email; ?></td>
                      <td><?php echo $data->phone; ?></td>
                      <td><?php echo ucwords($data->name); ?></td>
                      <td><?php echo strtoupper($data->reg_no); ?></td>
                      <td><?php echo ucfirst($data->address); ?></td>
                      <td><?php echo date('Y-m-d', strtotime($data->created_at)); ?></td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#companyModel">
                            <i class="icon-edit1"></i></button>
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

          <!-- //******* BRANCH */ -->
          <?php if (!empty($company)) : ?>
            <div class="table-container">
              <h3>Branch Info</h3>
              <div class="table-responsive">
                <table class="table custom-table table-sm">
                  <thead>
                    <tr class="bg-primary text-white ">
                      <th>Company Name</th>
                      <th>Branch Name</th>
                      <th>Address</th>
                      <th>State</th>
                      <th>City</th>
                      <th>Established In</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($branch as $data) :
                      $companyName = Company::find_by_id($data->company_id)->name; ?>
                      <tr>
                        <td><?php echo strtoupper($companyName); ?></td>
                        <td><?php echo ucwords($data->name); ?></td>
                        <td><?php echo ucfirst($data->address); ?></td>
                        <td><?php echo ucwords($data->state); ?></td>
                        <td><?php echo ucwords($data->city); ?></td>
                        <td><?php echo date('F d , Y', strtotime($data->established_in)); ?></td>
                        <td><?php echo date('Y-m-d', strtotime($data->created_at)); ?></td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-warning edit-branch-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#branchModel">
                              <i class="icon-edit1"></i></button>
                            <button class="btn btn-danger remove-branch-btn" data-id="<?php echo $data->id; ?>">
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
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="companyModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="company_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fName" class="col-form-label">Owner's Full Name</label>
                  <input type="text" class="form-control" name="company[full_name]" value="<?php echo ucwords($ownerId) ?>" id="fName" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cName" class="col-form-label">Company Name</label>
                  <input type="text" class="form-control" name="company[name]" id="cName" placeholder="Company name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="regNo" class="col-form-label">Registration Number</label>
                  <input type="text" class="form-control" name="company[reg_no]" id="regNo" placeholder="Company number" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="col-form-label">Company Email</label>
                  <input type="text" class="form-control" name="company[email]" id="email" placeholder="Company email" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone" class="col-form-label">Company Contact</label>
                  <input type="tel" class="form-control" name="company[phone]" id="phone" placeholder="Company phone number" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="address" class="col-form-label">Company Address</label>
                  <textarea name="company[address]" id="address" class="form-control" placeholder="Company address" rows="3" required></textarea>
                </div>
              </div>
              <div class="col-md-6 m-auto">
                <div class="form-group">
                  <label for="logo" class="col-form-label">Company Logo</label>
                  <input type="file" class="form-control" name="logo" id="logo">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="branchModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Branch</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form id="branch_form">
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cBId" class="col-form-label">Company Name</label>
                  <select name="branch[company_id]" class="form-control" id="cBId" required>
                    <option value="">select company</option>
                    <?php foreach ($company as $data) : ?>
                      <option value="<?php echo $data->id ?>"><?php echo ucwords($data->name) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="bName" class="col-form-label">Branch Name</label>
                  <input type="text" class="form-control" name="branch[name]" id="bName" placeholder="Branch name" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="bAddress" class="col-form-label">Branch Address</label>
                  <textarea name="branch[address]" id="bAddress" class="form-control" placeholder="branch address" rows="3" required></textarea>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bState" class="col-form-label">State</label>
                  <input type="text" class="form-control" name="branch[state]" id="bState" placeholder="State" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bCity" class="col-form-label">City</label>
                  <input type="text" class="form-control" name="branch[city]" id="bCity" placeholder="City" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="bEst" class="col-form-label">Date Established</label>
                  <input type="date" class="form-control" name="branch[established_in]" id="bEst" placeholder="Date Established" required>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<input type="hidden" id="cId">
<input type="hidden" id="bId">
<?php include(SHARED_PATH . '/admin_footer.php'); ?>


<script>
  $(document).ready(function() {
    const COMP_URL = 'inc/process.php';

    $('#company_form').on("submit", function(e) {
      e.preventDefault();
      let cId = $('#cId').val()

      let formData = new FormData(this);

      if (cId == "") {
        formData.append('new_company', 1)
      } else {
        formData.append('edit_company', 1)
        formData.append('cId', cId)
      }

      $.ajax({
        url: COMP_URL,
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
          $('.lds-hourglass').removeClass('d-none');
        },
        success: function(r) {
          if (r.success == true) {
            successAlert(r.msg);
            setTimeout(() => {
              $('.lds-hourglass').addClass('d-none');
              window.location.reload()
            }, 250);
          } else {
            errorAlert(r.msg);
          }
        }
      })
    });

    $('.edit-btn').on("click", function() {
      let cId = this.dataset.id
      $('#cId').val(cId)

      $.ajax({
        url: COMP_URL,
        method: "GET",
        data: {
          cId: cId,
          get_company: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#fName').val(r.data.full_name)
          $('#email').val(r.data.email)
          $('#phone').val(r.data.phone)
          $('#cName').val(r.data.name)
          $('#regNo').val(r.data.reg_no)
          $('#address').val(r.data.address)
        }
      })
    });

    $(document).on('click', '.remove-btn', function() {
      let cId = this.dataset.id;
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
            url: COMP_URL,
            method: "POST",
            data: {
              cId: cId,
              delete_company: 1
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


    // *********** BRANCH
    $('#branch_form').on("submit", function(e) {
      e.preventDefault();
      let bId = $('#bId').val()

      let formData = new FormData(this);

      if (bId == "") {
        formData.append('new_branch', 1)
      } else {
        formData.append('edit_branch', 1)
        formData.append('bId', bId)
      }

      $.ajax({
        url: COMP_URL,
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function() {
          $('.lds-hourglass').removeClass('d-none');
        },
        success: function(r) {
          if (r.success == true) {
            successAlert(r.msg);
            setTimeout(() => {
              $('.lds-hourglass').addClass('d-none');
              window.location.reload()
            }, 250);
          } else {
            errorAlert(r.msg);
          }
        }
      })
    });

    $('.edit-branch-btn').on("click", function() {
      let bId = this.dataset.id
      $('#bId').val(bId)

      $.ajax({
        url: COMP_URL,
        method: "GET",
        data: {
          bId: bId,
          get_branch: 1
        },
        dataType: 'json',
        success: function(r) {
          $('#cBId').val(r.data.company_id)
          $('#bName').val(r.data.name)
          $('#bAddress').val(r.data.address)
          $('#bState').val(r.data.state)
          $('#bCity').val(r.data.city)
          $('#bEst').val(r.data.established_in)
        }
      })
    });

    $(document).on('click', '.remove-branch-btn', function() {
      let bId = this.dataset.id;
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
            url: COMP_URL,
            method: "POST",
            data: {
              bId: bId,
              delete_branch: 1
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
  })
</script>