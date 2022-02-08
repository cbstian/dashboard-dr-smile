$(function(){

    Highcharts.setOptions({
        lang: {
            downloadCSV  : "Descargar CSV",
            downloadJPEG : "Descargar JPEG",
            downloadPDF  : "Descargar PDF",
            downloadPNG  : "Descargar PNG",
            downloadSVG  : "Descargar SVG",
            downloadXLS  : "Descargar XLS",
            exportData:{
                annotationHeader:"Annotations",
                categoryDatetimeHeader:"DateTime",
                categoryHeader:"Categoría"
            },
            decimalPoint: ",",
            thousandsSep: "."
        }
    });

    grafico1 = function(){

        $.ajax({
            type: 'POST',
            url: window.location.origin+"/dashboard/grafico1",
            headers : { 'X-CSRF-Token': $("meta[name='csrf-token']").attr('content') },
            data: {
                fecha : $('select[name=fechaGrafico1]').val()
            },
            dataType: "json",
            success: function(result) {

                Highcharts.chart('grafico-1', {
                    chart: {
                        type: 'pie',
                        /*
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        },*/
                        backgroundColor:'#FFFFFF'
                    },
                    exporting: {
                        sourceHeight: 500,
                        sourceWidth: 1200,
                        scale: 1,
                        buttons: {
                            contextButton: {
                                menuItems: [
                                    "downloadPNG",
                                    "downloadJPEG",
                                    "downloadPDF",
                                    "downloadSVG",
                                    "separator",
                                    "downloadCSV",
                                    "downloadXLS"
                                ]
                            }
                        }
                    },
                    credits: {
                        enabled:false
                    },
                    title: {
                        text: result.title
                    },
                    subtitle: {
                        text: result.subtitle
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    tooltip: {
                        shared: true,
                        useHTML: true,
                        headerFormat: '<b>{point.key}</b><br>',
                        pointFormat: 'Total: <b>{point.y}</b><br>Porcentaje: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            showInLegend: true,
                            cursor: 'pointer',
                            //depth: 35,
                            dataLabels: {
                                enabled: false,
                                format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                                distance: -50,
                                /*filter: {
                                    property: 'percentage',
                                    operator: '>',
                                    value: 4
                                }*/
                            }
                        }
                    },
                    series: [{
                        name: 'Formularios',
                        colorByPoint: true,
                        data: [{
                            name: 'Promo Odonto',
                            y: result.promoodonto,
                            sliced: true,
                            selected: true,
                            color: '#8BB8EF'
                        }, {
                            name: 'Promo Estética',
                            y: result.promoestetica,
                            color: '#DBABD5'
                        }]
                    }]
                });
            },
            error : function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

    };

    grafico2 = function(){

        $.ajax({
            type: 'POST',
            url: window.location.origin+"/dashboard/grafico2",
            headers : { 'X-CSRF-Token': $("meta[name='csrf-token']").attr('content') },
            data: {
                fecha : $('select[name=fechaGrafico2]').val()
            },
            dataType: "json",
            success: function(result) {

                Highcharts.chart('grafico-2', {
                    chart: {
                        type: 'pie',
                        /*options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        },*/
                        backgroundColor:'#FFFFFF'
                    },
                    exporting: {
                        sourceHeight: 500,
                        sourceWidth: 1200,
                        scale: 1,
                        buttons: {
                            contextButton: {
                                menuItems: [
                                    "downloadPNG",
                                    "downloadJPEG",
                                    "downloadPDF",
                                    "downloadSVG",
                                    "separator",
                                    "downloadCSV",
                                    "downloadXLS"
                                ]
                            }
                        }
                    },
                    credits: {
                        enabled:false
                    },
                    title: {
                        text: 'Total por estados'
                    },
                    subtitle: {
                        text: result.subtitle
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    tooltip: {
                        shared: true,
                        useHTML: true,
                        headerFormat: '<b>{point.key}</b><br>',
                        pointFormat: 'Total: <b>{point.y}</b><br>Porcentaje: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            showInLegend: true,
                            cursor: 'pointer',
                            //depth: 35,
                            dataLabels: {
                                enabled: true,
                                //format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                                format: '<b>{point.percentage:.1f} %</b>',
                                distance: -50,
                                filter: {
                                    property: 'percentage',
                                    operator: '>',
                                    value: 2
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Formularios',
                        colorByPoint: true,
                        data: [{
                            name: 'Pendiente',
                            color: '#FFC107',
                            y: result.pendiente,
                        }, {
                            name: 'Contactado',
                            color: '#28A745',
                            y: result.contactado,
                            sliced: true,
                            selected: true
                        }, {
                            name: 'No contesta',
                            color: '#6C757D',
                            y: result.nocontesta
                        }]
                    }]
                });
            },
            error : function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

    };

    grafico3 = function(){

        $.ajax({
            type: 'POST',
            url: window.location.origin+"/dashboard/grafico3",
            headers : { 'X-CSRF-Token': $("meta[name='csrf-token']").attr('content') },
            data: {
                cantmeses : $('select[name=cantmeses]').val()
            },
            dataType: "json",
            success: function(result) {

                Highcharts.chart('grafico-3', {
                    chart: {
                        type: 'column',
                        backgroundColor:'#FFFFFF'
                    },
                    exporting: {
                        sourceHeight: 500,
                        sourceWidth: 1200,
                        scale: 1,
                        buttons: {
                            contextButton: {
                                menuItems: [
                                    "downloadPNG",
                                    "downloadJPEG",
                                    "downloadPDF",
                                    "downloadSVG",
                                    "separator",
                                    "downloadCSV",
                                    "downloadXLS"
                                ]
                            }
                        }
                    },
                    credits: {
                        enabled:false
                    },
                    title: {
                        text: 'Análisis actividad últimos 6 meses'
                    },
                    xAxis: {
                        categories: result.categories
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: ''
                        },
                        stackLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                color: ( // theme
                                    Highcharts.defaultOptions.title.style &&
                                    Highcharts.defaultOptions.title.style.color
                                ) || 'gray'
                            }
                        }
                    },
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom',
                        backgroundColor:
                            Highcharts.defaultOptions.legend.backgroundColor || // theme
                            'rgba(255,255,255,0.25)'
                    },
                    tooltip: {
                        headerFormat: '<b>{point.x}</b><br/>',
                        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    series: [{
                        name: 'Promo Odonto',
                        data: result.promoodonto,
                        color: '#8BB8EF'
                    },
                    {
                        name: 'Promo Estética',
                        data: result.promoestetica,
                        color: '#DBABD5'
                    }]
                });
            },
            error : function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

    };

    grafico4 = function(){

        $.ajax({
            type: 'POST',
            url: window.location.origin+"/dashboard/grafico4",
            headers : { 'X-CSRF-Token': $("meta[name='csrf-token']").attr('content') },
            data: {
                fecha : $('select[name=fecha]').val()
            },
            dataType: "json",
            success: function(result) {

                Highcharts.chart('grafico-4', {
                    chart: {
                        type: 'line',
                        backgroundColor:'#FFFFFF'
                    },
                    exporting: {
                        sourceHeight: 500,
                        sourceWidth: 1200,
                        scale: 1,
                        buttons: {
                            contextButton: {
                                menuItems: [
                                    "downloadPNG",
                                    "downloadJPEG",
                                    "downloadPDF",
                                    "downloadSVG",
                                    "separator",
                                    "downloadCSV",
                                    "downloadXLS"
                                ]
                            }
                        }
                    },
                    credits: {
                        enabled:false
                    },
                    title: {
                        text: result.title
                    },
                    xAxis: {
                        categories: result.categories
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: ''
                        },
                        stackLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                color: ( // theme
                                    Highcharts.defaultOptions.title.style &&
                                    Highcharts.defaultOptions.title.style.color
                                ) || 'gray'
                            }
                        }
                    },
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom',
                        backgroundColor:
                            Highcharts.defaultOptions.legend.backgroundColor || // theme
                            'rgba(255,255,255,0.25)'
                    },
                    tooltip: {
                        shared: true,
                        crosshairs: true
                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    series: [{
                        name: 'Promo Odonto',
                        data: result.promoodonto,
                        color: '#8BB8EF'
                    },
                    {
                        name: 'Promo Estética',
                        data: result.promoestetica,
                        color: '#DBABD5'
                    }]
                });
            },
            error : function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

    };

    grafico1();
    grafico2();
    grafico3();
    grafico4();

    $("#btn-grafico-1").click( grafico1 );
    $("#btn-grafico-2").click( grafico2 );
    $("#btn-grafico-3").click( grafico3 );
    $("#btn-grafico-4").click( grafico4 );

});
