$(function (e) {
  /* Data Table */
  $("#emp-attendance").DataTable({
    order: [],
    columnDefs: [{ orderable: false, targets: [0, 8] }],
    language: {
      searchPlaceholder: "Search...",
      sSearch: "",
    },
  });
  /* End Data Table */

  //Daterangepicker with Callback
  $('input[name="singledaterange"]').daterangepicker({
    singleDatePicker: true,
  });
  $('input[name="daterange"]').daterangepicker(
    {
      opens: "left",
    },
    function (start, end, label) {
      // console.log("A new date selection was made: " + start.format('MMMM D, YYYY') + ' to ' + end.format('MMMM D, YYYY'));
    }
  );

  $("#daterange-categories").on("change", function () {
    $(".leave-content").hide();
    $("#" + $(this).val()).show();
  });

  /* Select2 */
  $(".select2").select2({
    minimumResultsForSearch: Infinity,
    width: "100%",
  });
});
