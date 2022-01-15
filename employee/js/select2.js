(function ($) {
  "use strict";

  if ($(".select2").length) {
    $(".select2").select2({
      dropdownParent: $("#loan_request"),
    });
  }

  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
  }
  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2();
  }
})(jQuery);
