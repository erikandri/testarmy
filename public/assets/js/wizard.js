$(function() {
  'use strict';

  $("#wizard").steps({
    headerTag: "h2",
    bodyTag: "section",
    transitionEffect: "slideLeft",

      onFinished: function(event, currentIndex) {
          $("#formSek").submit();
      }
  });

  $("#wizardVertical").steps({
    headerTag: "h2",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    stepsOrientation: 'vertical',

      onFinished: function(event, currentIndex) {
          $("#formSek").submit();
      }
  });
});
