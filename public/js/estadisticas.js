$(document).ready(function () {
    //Cuando carga la pagina ejecuta la llamada ajax para generar el grafico
    var selector = $("#selector").val().toString();
    llamadaAjax(selector);
    //Cuando cambie la opcion select realizar la llamada ajax para generar el grafico dependiendo del valor
    $("#selector").on("change", function () {
        llamadaAjax($("#selector").val().toString());
    });
});
function llamadaAjax(opcion) {
    $.ajax({
        url: "/estadisticas/" + opcion,
        method: "get",
        success: function (response) {
            switch ($("#selector").val()) {
                case "estado":
                    $("#periodo").remove();
                    $("#permiso").remove();
                    $(".estadisticas").append("<div id='estado'></div>");
                    mostrarestado(response);
                    break;
                case "periodo":
                    $("#estado").remove();
                    $("#permiso").remove();
                    $(".estadisticas").append("<div id='periodo' class='p-0'></div>");
                    mostrarperiodo(response);
                    break;
                default:
                    $("#periodo").remove();
                    $("#estado").remove();
                    $(".estadisticas").append("<div id='permiso'></div>");
                    mostrarpermiso(response);
            }
        }
    });
}
function mostrarestado(respuesta) {
    var options = {
        series: [respuesta['privado'], respuesta['publico']],
        colors: ["#7A01C9", "#a16aff"],
        chart: {
            width: 380,
            type: 'donut',
        },
        labels: ['Privado', 'Público'],
        plotOptions: {
            pie: {
                startAngle: -90,
                endAngle: 270
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            type: 'gradient',
        },
        legend: {
            formatter: function (val, opts) {
                return val + " - " + opts.w.globals.series[opts.seriesIndex];
            }
        },
        responsive: [{
                breakpoint: 8547,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
    };
    var chart = new ApexCharts(document.querySelector("#estado"), options);
    chart.render();
}
function mostrarperiodo(respuesta) {
    var options = {
        series: [{
                data: [respuesta[0]['porcentaje'], respuesta[1]['porcentaje'], respuesta[2]['porcentaje'], respuesta[3]['porcentaje'], respuesta[4]['porcentaje'], respuesta[5]['porcentaje'], respuesta[6]['porcentaje'], respuesta[7]['porcentaje'], respuesta[8]['porcentaje'], respuesta[9]['porcentaje'], respuesta[10]['porcentaje'], respuesta[11]['porcentaje']]
            }],
        colors: ["#a16aff"],
        chart: {
            type: 'bar',
            height: 350,
            foreColor: '#000000',
        },
        plotOptions: {
            bar: {
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ],
        },
    };
    var chart = new ApexCharts(document.querySelector("#periodo"), options);
    chart.render();
}
function mostrarpermiso(respuesta) {
    var options = {
        series: [respuesta['administrador'], respuesta['invitado']],
        colors: ["#7A01C9", "#a16aff"],
        chart: {
            width: 380,
            type: 'pie',
        },
        labels: ['Administrador', 'Invitado'],
        responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
    };
    var chart = new ApexCharts(document.querySelector("#permiso"), options);
    chart.render();
}
