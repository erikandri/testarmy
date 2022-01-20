(function($) {
  'use strict';

  // initializing inputmask
  $(":input").inputmask();

  var inputwaktu = document.getElementsByClassName("input-jam");
  Inputmask("datetime", {
      inputFormat: "HH:MM",
      max: 24
  }).mask(inputwaktu);

})(jQuery);
