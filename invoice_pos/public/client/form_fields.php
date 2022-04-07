<!-- Row start -->
<div class="row gutters">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="card">
      <div class="card-body">
       
        <div class="">
          <!-- CLIENT DETAIL -->
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
            <div class="form-group col-md-6 col-sm-6 col-12">
              <input type="text" name="client[phone]" value="<?php echo $client->phone; ?>" class="form-control" id="phone" placeholder="Phone Number">
            </div>
            <div class="form-group col-md-6 col-sm-6 col-12">
              <input type="text" name="client[email]" value="<?php echo $client->email; ?>" class="form-control" id="email" placeholder="Email">
            </div>
          </div>

          <!-- VEHICLE DETAILS -->
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 d-none">
            <div class="form-group">
              <input type="text" name="vehicle[plate_no]" value="<?php echo $vehicle->plate_no; ?>" class="form-control" id="plate_noistration" placeholder="Plate Number">
            </div>
            <div class="form-group">
              <input type="text" name="vehicle[make]" value="<?php echo $vehicle->make; ?>" class="form-control" id="make" placeholder="Make">
            </div>
            <div class="form-group">
              <input type="text" name="vehicle[model]" value="<?php echo $vehicle->model; ?>" class="form-control" id="model" placeholder="Model">
            </div>
            <div class="form-group">
              <input type="text" name="vehicle[year]" value="<?php echo $vehicle->year; ?>" class="form-control" id="year" placeholder="Year">
            </div>
            <div class="form-group">
              <label for="last_service">Last Service</label>
              <input type="date" name="vehicle[last_service]" value="<?php //echo date('Y-m-d', strtotime($vehicle->last_service)); ?>" class="form-control" id="last_service" placeholder="Last Service">
            </div>
          </div>

        </div>

      </div>