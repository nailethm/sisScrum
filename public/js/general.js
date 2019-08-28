$(function() {
      var defaults = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults(defaults);
  
      $("#fecha_planificacion, #start_project, #end_project").datepicker();
  });
$(document).ready(function () {

    //Sprint Board Accordion
    $('#accordion').collapse();
    $("#boardAccordion").accordion();

    

    $("#date-popover").popover({html: true, trigger: "manual"});
    $("#date-popover").hide();
    $("#date-popover").click(function (e) {
        $(this).hide();
    });

    $("#my-calendar").zabuto_calendar({
        action: function () {
            return myDateFunction(this.id, false);
        },
        action_nav: function () {
            return myNavFunction(this.id);
        },
        ajax: {
            url: "show_data.php?action=1",
            modal: true
        },
        legend: [
            {type: "text", label: "Special event", badge: "00"},
            {type: "block", label: "Regular event", }
        ]
    });
});

function myNavFunction(id) {
    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation");
    var to = $("#" + id).data("to");
    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
}

var Script = function () {


    var lineChartData = {
        labels : ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19"],
        datasets : [
            {
                fillColor : "rgba(255,255,255,0.5)",
                strokeColor : "rgba(61,61,61,1)",
                pointColor : "rgba(151,187,205,0.1)",
                pointStrokeColor : "#fff",
                data : [72,68,64,60,56,52,48,44,40,36,32,28,24,20,16,12,8,4,0]
            },
            {
                fillColor : "rgba(151,187,205,0.5)",
                strokeColor : "rgba(151,187,205,1)",
                pointColor : "rgba(151,187,205,1)",
                pointStrokeColor : "#fff",
                data : [70,60,25,22,20,19]
            }
        ]

    };

    // new Chart(document.getElementById("burndown").getContext("2d")).Line(lineChartData, {
    //     bezierCurve: false
    // });


}();