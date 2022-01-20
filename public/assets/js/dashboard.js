$(function () {
    'use strict'

    var gridLineColor = 'rgba(77, 138, 240, .1)';

    var colors = {
        primary: "#727cf5",
        secondary: "#7987a1",
        success: "#42b72a",
        info: "#68afff",
        warning: "#fbbc06",
        danger: "#ff3366",
        light: "#ececec",
        dark: "#282f3a",
        muted: "#686868"
    }

    // Dashbaord date start
    if ($('.dashboardDate').length) {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('.dashboardDate').datepicker({
            format: "dd MM yyyy",
            todayHighlight: true,
            autoclose: true,
            language: 'id'
        });
        $('.dashboardDate').datepicker('setDate', today);
    }
    // Dashbaord date end

    // Dashboard realtime start
    var rtin = document.getElementById(('realtimeIn'));
    function realtime() {
        var d = new Date();
        var s = d.getSeconds();
        var m = d.getMinutes();
        var h = d.getHours();
        rtin.value = ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
    }
    setInterval(realtime, 1000);
    // Dashboard realtime end
});
