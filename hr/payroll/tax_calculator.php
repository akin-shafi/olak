<?php
require_once('../private/initialize.php');
$page = 'Tax';
$page_title = 'Tax Calculator';
include(SHARED_PATH . '/header.php');
?>

<div class="page-header d-xl-flex d-block">
   <div class="page-leftheader">
      <h4 class="page-title"><?php echo $page_title ?></h4>
   </div>

</div>

<div class="row">
   <div class="card">
      <div class="card-body">
         <div class="row my-5">
            <div class="col-md-6 col-lg-3">
               <div class="form-group">
                  <label class="form-label">Employee Name:</label>
                  <select class="form-control select2 " id="staff_id">
                     <?php foreach (Employee::find_by_undeleted(['order' => 'ASC']) as $key => $value) { ?>
                        <option data-salary="<?php echo $value->present_salary ?>" value="<?php echo $value->id ?>"><?php echo $value->full_name() ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
         </div>

         <div id="salaryField"></div>
      </div>
   </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">
   $(document).on('change', '#staff_id', function() {
      var selected = $(this).find('option:selected');
      var staff_id = $(this).val();
      var staff_salary = selected.data('salary');
      var emp_id = staff_id;
      fetch_data(emp_id);

   })

   function fetch_data(emp_id = '') {
      $.ajax({
         url: 'inc/script.php',
         method: "POST",
         data: {
            tax_calculator: 1,
            emp_id: emp_id,
         },
         success: function(r) {
            $("#salaryField").html(r)
         }
      })
   }
</script>