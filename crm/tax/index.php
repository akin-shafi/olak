<?php 
	require_once('../private/initialize.php');

$page = 'Tax';
$page_title = 'All tax';
include(SHARED_PATH . '/admin_header.php'); 
?>
	<div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <div class="row">

                      <div class="col-md-5">
                  <div class="box">
                    <div class="box-header with-border">
                                        <h3 class="box-title"> </h3>
                      
                      <div class="box-tools pull-right">
                                        </div>
                    </div>

                    <div class="box-body">
                      <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="http://accufy.originlabsoft.com/admin/tax/add_type" role="form" novalidate>

                        <div class="form-group">
                          <label>Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" required name="name" value="" >
                        </div>
                        

                        <input type="hidden" name="id" value="">
                        <!-- csrf token -->
                        <input type="hidden" name="csrf_test_name" value="891165ec628dd40890d8b4e497fff5d5">

                        <div class="row m-t-30">
                          <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save </button>
                                                </div>
                        </div>

                      </form>

                      <br>

                                      <table class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Name</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                                                </tbody>
                      </table>
                      

                    </div>
                  </div>
              </div>
              


                      <div class="col-md-7">

                <div class="box add_area" style="display: none">
                  <div class="box-header with-border">
                                    <h3 class="box-title">Add new tax </h3>
                    
                    <div class="box-tools pull-right">
                                        <a href="#" class="text-right btn btn-default rounded btn-sm cancel_btn"><i class="fa fa-angle-left"></i> Back</a>
                                    </div>
                  </div>

                  <div class="box-body">
                    <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="http://accufy.originlabsoft.com/admin/tax/add" role="form" novalidate>

                      <div class="form-group">
                          <label class="col-sm-2 control-label p-0" for="example-input-normal">Tax <span class="text-danger">*</span></label>
                          <select class="form-control" name="type" required>
                              <option value="">Select</option>
                                                  </select>
                      </div>

                      <div class="form-group">
                        <label>Tax Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="name" value="" >
                      </div>

                      <div class="form-group">
                        <label>Tax Rate  (%)<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" required name="rate" value="">
                        <p>Tax rate should be a number only, without a percent sign</p>
                      </div>

                      <div class="form-group">
                        <label>Tax Number / ID</label>
                        <input type="text" class="form-control" required name="number" value="" >
                      </div>

                      <div class="form-group">
                        <label>Details</label>
                        <textarea class="form-control" name="details" rows="6"></textarea>
                      </div>

                      <div class="form-group m-t-30">
                          <input type="checkbox" id="md_checkbox_1" class="filled-in chk-col-blue" value="1" name="is_invoices" >
                          <label for="md_checkbox_1"> Show the tax Number on invoices</label>
                      </div>

                      <input type="hidden" name="id" value="">
                      <!-- csrf token -->
                      <input type="hidden" name="csrf_test_name" value="891165ec628dd40890d8b4e497fff5d5">

                      <hr>

                      <div class="row m-t-30">
                        <div class="col-sm-12">
                                                <button type="submit" class="btn btn-info rounded pull-left"><i class="fa fa-check"></i> Save </button>
                                            </div>
                      </div>

                    </form>

                  </div>
                </div>


                            <div class="list_area container">

                                    <h3 class="box-title">All tax <a href="#" class="pull-right btn btn-info rounded btn-sm add_btn"><i class="fa fa-plus"></i> Add new tax</a></h3>
                    
                      
                    <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive mt-20 p-0">
                        <table class="table table-bordered table-hover  cushover " id="dg_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Rate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                                    </tbody>
                        </table>
                    </div>
                  </div>
                
              </div>
              
            </div>

        </section>
    </div>
<?php include(SHARED_PATH . '/admin_footer.php');  ?> 