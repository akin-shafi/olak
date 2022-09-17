<div class="card">
  <div class="card-body">

    <div class="row">
      <div class="form-group col-md-6 col-sm-6 col-12">
        <input type="hidden" name="client[created_by]" value="<?php echo $loggedInAdmin->id; ?>" class="form-control">
        <input type="hidden" name="client[company_id]" value="<?php echo $loggedInAdmin->company_id; ?>" class="form-control">
        <input type="hidden" name="client[branch_id]" value="<?php echo $loggedInAdmin->branch_id; ?>" class="form-control">
        <input type="text" name="client[first_name]" value="<?php echo $client->first_name; ?>" class="form-control" id="first_name" placeholder="First Name">
      </div>
      <div class="form-group col-md-6 col-sm-6 col-12">
        <input type="text" name="client[last_name]" value="<?php echo $client->last_name; ?>" class="form-control" id="last_name" placeholder="Last Name">
      </div>
      <div class="form-group col-md-12 col-sm-12 col-12">
        <textarea name="client[address]" class="form-control" id="address" placeholder="Address"><?php echo $client->address; ?></textarea>
      </div>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="text" name="client[phone]" value="<?php echo $client->phone; ?>" class="form-control" id="phone" placeholder="Phone Number">
      </div>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <input type="text" name="client[email]" value="<?php echo $client->email; ?>" class="form-control" id="email" placeholder="Email">
      </div>
      <?php if ($accessControl->can_approve == 1) { ?>
      <div class="form-group col-md-4 col-sm-6 col-12">
        <div class="custom-control custom-switch mt-2">
          <input type="checkbox" class="custom-control-input permit" name="credit_facility" id="credit">
          <label class="custom-control-label" for="credit">Credit Facility?</label>
        </div>
      </div>

      <div class="form-group col-md-4 col-sm-6 col-12">
        <div class="custom-control custom-switch mt-2">
          <label class="custom-control-label" for="credit_capcity">Maximum Credit Capacity ?</label>
          <input type="textx" class="custom-control-input" id="credit_capcity" name="credit_capcity">
          
        </div>
      </div>

      <?php } ?>

      
      <div class="d-none">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="form-group">
            <input type="text" name="vehicle[plate_no]" value="<?php echo $vehicle->plate_no ?? ''; ?>" class="form-control" id="plate_noistration" placeholder="Plate Number">
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="form-group">
            <input type="text" name="vehicle[make]" value="<?php echo $vehicle->make ?? ''; ?>" class="form-control" id="make" placeholder="Make">
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="form-group">
            <input type="text" name="vehicle[model]" value="<?php echo $vehicle->model ?? ''; ?>" class="form-control" id="model" placeholder="Model">
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="form-group">
            <input type="text" name="vehicle[year]" value="<?php echo $vehicle->year ?? ''; ?>" class="form-control" id="year" placeholder="Year">
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="form-group">
            <label for="last_service">Last Service</label>
            <input type="date" name="vehicle[last_service]" class="form-control" id="last_service" placeholder="Last Service">
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="card-footer">
    <input type="submit" class="btn btn-success float-right" value="Create">
  </div>
</div>