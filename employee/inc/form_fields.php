<?php
require_once('../../private/initialize.php');

if (is_get_request()) {
  if (isset($_GET['get_more_education'])) : ?>
    <div class="card" id="inputEdu">
      <div class="card-body">
        <h3 class="card-title">Education Information
          <a href="javascript:void(0);" class="delete-icon delete-edu" id="removeEdu"><i class="fa fa-trash-o"></i></a>
        </h3>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group form-focus focused">
              <input type="text" name="institution[]" value="" class="form-control floating">
              <label class="focus-label">Institution</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-focus focused">
              <input type="text" name="subject[]" value="" class="form-control floating">
              <label class="focus-label">Subject</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-focus focused">
              <div class="cal-icon">
                <input type="text" name="start_date[]" value="" class="form-control floating datetimepicker">
              </div>
              <label class="focus-label">Starting Date</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-focus focused">
              <div class="cal-icon">
                <input type="text" name="complete_date[]" value="" class="form-control floating datetimepicker">
              </div>
              <label class="focus-label">Complete Date</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-focus focused">
              <input type="text" name="degree[]" value="" class="form-control floating">
              <label class="focus-label">Degree</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-focus focused">
              <input type="text" name="grade[]" value="" class="form-control floating">
              <label class="focus-label">Grade</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif;


  // ? EXPERIENCE

  if (isset($_GET['get_more_experience'])) : ?>
    <div class="card">
      <div class="card-body" id="inputExp">
        <h3 class="card-title">Experience Information
          <a href="javascript:void(0);" class="delete-icon delete-exp" id="removeExp"><i class="fa fa-trash-o"></i></a>

        </h3>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group form-focus">
              <input type="text" name="company_name[]" class="form-control floating" value="">
              <label class="focus-label">Company Name</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-focus">
              <input type="text" name="location[]" class="form-control floating" value="">
              <label class="focus-label">Location</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-focus">
              <input type="text" name="job_position[]" class="form-control floating" value="">
              <label class="focus-label">Job Position</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-focus">
              <input type="date" name="period_from[]" class="form-control floating" value="">
              <label class="focus-label">Period From</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group form-focus">
              <input type="date" name="period_to[]" class="form-control floating" value="">
              <label class="focus-label">Period To</label>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php endif;
}
