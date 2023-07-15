<?php require_once('../private/initialize.php');
require_login();

$page = 'Settings';
$page_title = 'Company Setup';
include(SHARED_PATH . '/admin_header.php');

$ownerId = $loggedInAdmin->full_name;

$company = Company::find_by_undeleted();
$branch = Branch::find_by_undeleted();
?>

<style>
  th,
  td {
    font-size: 0.8rem !important;
    vertical-align: middle;
  }
</style>

<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
          <div>
            <h4 class="mb-3">Company Setup</h4>
            <!-- <p class="mb-0">A dashboard provides you an overview of company setup with access to the most important data,
              <br> functions and controls.
            </p> -->
          </div>
          <div class="d-flex justify-content-end">
            <button class="btn btn-primary mb-3 mx-3 " data-toggle="modal" data-target="#companyModel">
              &plus; Create Company</button>

           
          </div>
        </div>
      </div>

      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <div class="card">
          <div class="card-body">
            

            <!-- //******* BRANCH */ -->
            <?php //if (!empty($company)) : ?>
              <div class="table-container border-0 shadow-sm p-2">
                <h5 class="mb-3">Branch Info</h5>
                <div class="table-responsive">
                  <table class="table data-table table-sm">
                    <thead>
                      <tr class="ligth ligth-data">
                        <th>SN</th>
                        <th>Company Name</th>
                        <!-- <th>Branch</th> -->
                        <th>Address</th>
                        <!-- <th>Established In</th> -->
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $sn = 1;
                      // pre_r($company);
                      foreach ($company as $data) :
                        $companyName = Company::find_by_id($data->id)->name; ?>
                        <tr>
                          <td><?php echo $sn++; ?></td>
                          <td><?php echo ucwords($companyName); ?></td>
                          <!-- <td><?php //echo ucwords($data->name); ?></td> -->
                          <td><?php echo ucfirst($data->address); ?></td>
                          <!-- <td><?php //echo ucwords($data->state); ?></td> -->
                          <!-- <td><?php //echo ucwords($data->city); ?></td> -->
                          <!-- <td><?php //echo date('F d , Y', strtotime($data->established_in)); ?></td> -->
                          <td><?php echo date('Y-m-d', strtotime($data->created_at)); ?></td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-warning edit-btn" data-id="<?php echo $data->id; ?>" data-toggle="modal" data-target="#editCompanyModel">
                                <i class="fas fa-edit"></i></button>
                              <button class="btn btn-danger remove-branch-btn" data-id="<?php echo $data->id; ?>">
                                <i class="fas fa-trash"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php //endif; ?>

          </div>
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
      <form class="company_form" enctype="multipart/form-data">
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

<div class="modal fade" id="editCompanyModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <form class="company_form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <input type="hidden" id="cBId">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cName" class="col-form-label">Company Name</label>
                  <input type="text" class="form-control" name="company[name]" id="editCName" placeholder="Company name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="regNo" class="col-form-label">Registration Number</label>
                  <input type="text" class="form-control" name="company[reg_no]" id="editRegNo" placeholder="Company number" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email" class="col-form-label">Company Email</label>
                  <input type="text" class="form-control" name="company[email]" id="editEmail" placeholder="Company email" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone" class="col-form-label">Company Contact</label>
                  <input type="tel" class="form-control" name="company[phone]" id="editPhone" placeholder="Company phone number" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="address" class="col-form-label">Company Address</label>
                  <textarea name="company[address]" id="editAddress" class="form-control" placeholder="Company address" rows="3" required></textarea>
                </div>
              </div>
              <div class="col-md-6 m-auto">
                <div class="form-group">
                  <label for="logo" class="col-form-label">Company Logo</label>
                  <input type="file" class="form-control" name="logo" id="editEogo">
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

    $('.company_form').on("submit", function(e) {
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
          console.log(r)
          $('#cBId').val(r.data.id)
          $('#editCName').val(r.data.name)
          $('#editRegNo').val(r.data.reg_no)
          $('#editEmail').val(r.data.email)
          $('#editPhone').val(r.data.phone)
          $('#editAddress').val(r.data.address)
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
              setTimeout(() => {
                window.location.reload()
              }, 2000);
            }
          });

        }
      })

    });


    
  })
</script>