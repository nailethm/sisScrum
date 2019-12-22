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

    $('#download').click(function() {
        // REPORTE PAGINA BURNDOWN
        var canvas = document.getElementById("burndown");
        var d = new Date();
        var n = d.toISOString();
        var elementHandler = {
            '#ignorePDF': function (element, renderer) {
                return true;
            }
        };
        // only jpeg is supported by jsPDF
        var imgData = canvas.toDataURL("image/png", 1.0);
        var pdf = new jsPDF('l', 'mm');
        var source3 = window.document.getElementById("titulo_informe");        
        pdf.fromHTML(source3, 85, 10, {
              'width': 180,'elementHandlers': elementHandler
        });
        pdf.autoTable({
            html: '#detalle_pdf',
            styles: {fillColor: [255, 255, 255], textColor: [61, 61, 61], fontSize: 13},
            columnStyles: {
                0: {cellWidth: 100, halign: 'left', fillColor: [255, 255, 255]},
                1: {cellWidth: 90, halign: 'left', fillColor: [255, 255, 255]}                
            }, // Cells in first column centered and green
            startY: 20,
            margin: {top: 0, left: 75},
        });
        var etiqueta1 = window.document.getElementById("labelX");        
        pdf.fromHTML(etiqueta1, -5, 137, {
              'width': 180,'elementHandlers': elementHandler
        });
        var etiqueta1 = window.document.getElementById("labelY");        
        pdf.fromHTML(etiqueta1, 20, 43, {
              'width': 180,'elementHandlers': elementHandler
        });
        pdf.addImage(imgData, "JPEG", 30, 60);
        var source1 = window.document.getElementById("titulo_tabla1");        
        pdf.fromHTML( source1, 168, 35, {
              'width': 180,'elementHandlers': elementHandler
        });
        pdf.autoTable({
            html: '#tabla1',
            styles: {fillColor: [249, 249, 249], lineColor: [221, 221, 221], lineWidth: 0.1, textColor: [61, 61, 61], fontSize: 11},
            columnStyles: {
                0: {cellWidth: 10, halign: 'center'},
                1: {cellWidth: 20, halign: 'center'},
                2: {cellWidth: 15, halign: 'center'}
            }, // Cells in first column centered and green
            startY: 45,
            margin: {top: 0, left: 170},
        });
        var source2 = window.document.getElementById("titulo_tabla2");        
        pdf.fromHTML(source2, 233, 35, {
              'width': 180,'elementHandlers': elementHandler
        });
        pdf.autoTable({
            html: '#tabla2',
            styles: {fillColor: [249, 249, 249], lineColor: [221, 221, 221], lineWidth: 0.1, textColor: [61, 61, 61], fontSize: 11},
            columnStyles: {
                0: {cellWidth: 10, halign: 'center'},
                1: {cellWidth: 20, halign: 'center'},
                2: {cellWidth: 15, halign: 'center'}
            }, // Cells in first column centered and green
            startY: 45,
            margin: {top: 0, left: 225},
        });
        pdf.autoTable({
            html: '#footer_pdf',
            styles: {fillColor: [255, 255, 255], textColor: [61, 61, 61], fontSize: 13},
            columnStyles: {
                0: {halign: 'left', fillColor: [255, 255, 255]},
                1: {halign: 'right', fillColor: [255, 255, 255]}                
            }, // Cells in first column centered and green
            startY: 187,
            margin: {top: 0, left: 7},
        });        
        pdf.output('dataurlnewwindow');
    });

    //Sprint Board Accordion
    $('#accordion').collapse();
    $("#boardAccordion").accordion();
       

    $("#date-popover").popover({html: true, trigger: "manual"});
    $("#date-popover").hide();
    $("#date-popover").click(function (e) {
        $(this).hide();
    });

    
    $("#preporte").change(function () {
        $('div.rbox1').hide();
        $('div.rbox1').show();
    });
     $("#ureporte").change(function () {
        $('div.rbox2').hide();
        $('div.rbox2.'+$(this).val()).show();
    });

});

function myNavFunction(id) {
    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation");
    var to = $("#" + id).data("to");
    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
}