//var data1 = new Array();
//var data2 = new Array();

var mvvm;
var GraficaModel = function () {

	var self = this;
    this.meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    this.clasificaciones = [];
    this.idclasificaiontrampa = ko.observable();
    self.selectedClasificacion = ko.observable(); // Nothing selected by default
        
    
    this.obtenerClasificacionTrampa = function(){
        $.ajax({
			type: "GET",
			dataType: "json",
            url: 'data/clastrampa.json',            
            async: false,
            success: function (response) {
                self.clasificaciones = response;                
            },
            error: function(a, b, c){ }
        });
    };
    
    /*self.selectedClasificacion.subscribe(function (data){
        console.log(data);                
        
    });*/
    
};


    

//Animate counter
var count = $(('#count'));
$({ Counter: 0 }).animate({ Counter: count.text() }, {
  duration: 3000,
  easing: 'linear',
  step: function () {
    count.text(Math.ceil(this.Counter));
  }
});
/*
var s = Snap('#animated');
var progress = s.select('#progress');

progress.attr({strokeDasharray: '0, 251.2'});
Snap.animate(0,251.2, function( value ) {
    progress.attr({ 'stroke-dasharray':value+',251.2'});
}, 5000);*/
//

//Chart eventos en general por mes.
var chart = c3.generate({
    
    bindto: '#chart-eventos-gral',
    data: {
        columns: [
            ['data',9]
        ],
        type: 'gauge',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    gauge: {
        label: {
            format: function(value, ratio) {
                return value;
            },
            show: false // to turn off the min/max labels.
        },
//    min: 0, // 0 is default, //can handle negative min e.g. vacuum / voltage / current flow / rate of change
//    max: 100, // 100 is default
    //units: ' %',
//    width: 39 // for adjusting arc thickness
    },
    color: {
        pattern: ['#FF0000', '#F97600', '#F6C600', '#60B044'], // the three color levels for the percentage values.
        threshold: {
           unit: 'value', // percentage is default
//            max: 200, // 100 is default
            values: [30, 60, 90, 100]
        }
    },
    size: {
        height: 180
    }
});


//eventos por dispositivo.
var chart = c3.generate({
    bindto: '#chart-eventos-clasificacion',
    data: {        
        json: {
            data1: [5],
            data2: [7],
            data3: [6],

        },
        types: {
            data1: 'bar',
            data2: 'bar',
            data3: 'bar'
            
        },
        labels: true,
        names: {
            data1: 'interior',           
            data2: 'exterior',
            data3: 'feromona'           
        }
    },

    tooltip: {
        show: false
    },

    axis: {
        x: {
            type: 'category',
            categories:['dispositivo']//['interior','exterior','feromona']
        }
    },

});

//DEtalle del evento. plagas

 var chart = c3.generate({
     bindto: '#chart-plagas',
     data: {
         //json: deliveryProductive,
         json: {
             data1: [2],
             data2: [1],
             data3: [2]


         },
         types: {
             data1: 'bar',
             data2: 'bar',
             data3: 'bar',
         },
         colors: {
             data1: '#FDB900',
             data2: '#465053',
             data3: '#B00707',
             
         },
         labels: true,
         names: {
             data1: 'Raton',
             data2: 'Insecto',
             data3: 'Cucaracha'
         }
     },

     tooltip: {
         show: false
     },

     axis: {
         x: {
             type: 'category',
             categories: ['Feb']
         }
     },

 });
/*
this.obtenerEventos = function () {
        $.ajax({

            //COREGIR ESTO. solo para pruebas esta amarrado 
            url: "/evento/GetDetail/2",
            type: "GET",
            dataType: "json",
            contentType: 'application/json',
            //async: false,
            success: function (response) {


                if (!response.error) {
                    console.log(response);

                    var ratones = [];
                    var insectos = [];
                    var cucarachas = [];


                    for (var i = 0; i < response.eventosdetalle.length; i++) {
                        if (response.eventosdetalle[i].plaga == "Raton")
                            ratones.push(response.eventosdetalle[i].cantidad);
                        if (response.eventosdetalle[i].plaga == "Insectos")
                            insectos.push(response.eventosdetalle[i].cantidad);
                        if (response.eventosdetalle[i].plaga == "Cucaracha")
                            cucarachas.push(response.eventosdetalle[i].cantidad);

                    }

                    var deliveryProductive = {
                        data1: ratones,
                        data2: insectos,
                        data3: cucarachas,
                    };

                    var chart = c3.generate({
                        bindto: '#chart-plagas',
                        data: {
                            //json: deliveryProductive,
                            json: {
                                data1: [8, 7, 7, 7, 7, 8, 8, 8, 7, 3, 4, 6],
                                data2: [6, 5, 5, 5, 5, 6, 6, 6, 6, 2, 5, 8],
                                data3: [2, 1, 1, 1, 1, 2, 2, 2, 2, 3, 3, 2]


                            },
                            types: {
                                data1: 'bar',
                                data2: 'bar',
                                data3: 'bar',
                            },
                            labels: true,
                            names: {
                                data1: 'Raton',
                                data2: 'Insecto',
                                data3: 'Cucaracha'
                            }
                        },

                        tooltip: {
                            show: false
                        },

                        axis: {
                            x: {
                                type: 'category',
                                categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
                            }
                        },

                    });


                }

            },
            error: function (a, b, c) {
                console.log(a + b + c);
            }
        });
    }
*/

    /*
    var chart = c3.generate({
        bindto: '#chart',
        data: {
            columns: [
                ['data1', 30, 200, 100, 400, 150, 250],
                ['data2', 50, 20, 10, 40, 15, 25]
            ],
            regions: {
                'data1': [{
                    'start': 1,
                    'end': 2,
                    'style': 'dashed'
                }, {
                    'start': 3
                }], // currently 'dashed' style only
                'data2': [{
                    'end': 4
                }]
            }
        }
    });*/

//por semana.
/*var chart = c3.generate({
    bindto: '#chart-semanal',
    data: {
        //json: deliveryProductive,
        json: {
            data1: [8, 7, 7, 7, 7, 8, 8, 8, 7, 3, 4, 6],
            data2: [6, 5, 5, 5, 5, 6, 6, 6, 6, 2, 5, 8],
            data3: [2, 1, 1, 1, 1, 2, 2, 2, 2, 3, 3, 2]


        },
        types: {
            data1: 'bar',
            data2: 'bar',
            data3: 'bar',
        },
        labels: true,
        names: {
            data1: 'Raton',
            data2: 'Insecto',
            data3: 'Cucaracha'
        }
    },

    tooltip: {
        show: false
    },

    axis: {
        x: {
            type: 'category',
            categories: ['S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8', 'S9', 'S10', 'S11', 'S12']
        }
    },

});*/

$(document).ready(function () {
    //obtenerEventos();
    mvvm = new GraficaModel();
    mvvm.obtenerClasificacionTrampa();
    ko.applyBindings(mvvm);
    
});