var mvvm;
var Evento = function () {

    var self = this;
    this.plagas = [];
    self.eventos = ko.observableArray([]);
    self.evento = ko.observable();
    self.cfgtrampas = ko.observableArray([]);
    self.availableUsers =[];
    self.eventodetalle = ko.observable();
    self.showPlagaBtn = ko.observable(true);
    self.idEvetoGlobal = ko.observable(0);

    //get row selected.
    self.select = function () {
        self.evento(this);
        console.log(this);
    }
    
    self.selectDetail = function(){
        self.eventodetalle(this);
        console.log(this);
    }

    self.newEvent = function () {
        self.evento(new EventoModel({
            idctrampa: 0,
            idevento: 0,
            number: "",
            ubicacion: "",
            clasificacion: "",            
            idclasificacion: 0,
            fechaevento: "",
            semana: 0,
            observaciones: ""
        }));

    };
    
    self.newEventDetail = function () {
        self.eventodetalle(new EventoDetalleModel({
            iddetalle: 0,
            idevento: 0,
            idplaga: 0,
            cantidad: 0,
            plaga: 0            
        }));

    };

    //populate inputs select
    this.obtenerPlagas = function () {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'data/plaga.json',
            async: false,
            success: function (response) {
                self.plagas = response;
            },
            error: function (a, b, c) {}
        });
    };

    this.obtenerEventos = function () {
        self.eventos.removeAll();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'evento/list',
            async: false,
            success: function (response) {
                if (!response.error)
                //self.eventos = response.eventos;   
                    for (var i = 0; i < response.eventos.length; i++)
                    self.eventos.push(new EventoModel(response.eventos[i]));
            },
            error: function (a, b, c) {}
        });
    };
    //no se usa por lo pronto
    this.obtenerCfgTrampa = function () {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'trampa/GetCfgTrampa',
            //async: false,
            success: function (response) {
                if (!response.error)                
                    for (var i = 0; i < response.cfgtrampas.length; i++)
                    self.cfgtrampas.push(new CfgTrampaModel(response.cfgtrampas[i]));
            },
            error: function (a, b, c) {}
        });
    };
    
    $('#saveModal').on('shown.bs.modal', function () {
    $('#number').typeahead({
       source: function (query, process) {
            $.ajax({
                url: 'trampa/GetCfgTrampa',               
                dataType: "json",
                type: "GET",
                async: false,
                timeout: 2000,
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    self.availableUsers = data.cfgtrampas;
                    var availableTags = [];
                    for (var i = 0; i < data.cfgtrampas.length; i++){                                                
                      availableTags.push(data.cfgtrampas[i].notrampa);                      
                      //availableTags.push(data.cfgtrampas[i].notrampa+"     " + data.cfgtrampas[i].ubicacion);                      
                    }                    
                    
                    process(availableTags);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log('error occured while autocomplete');
                }
            });
        },                    
       updater: function (number) {
            
            var data = _.find(
                self.availableUsers, function (item) {
                    return item.notrampa == number;
                });

            $('#ubicacion').val(data.ubicacion);
            $('#clasificacion').val(data.clasificaciontrampa);
            self.evento().idctrampa(data.idctrampa);
            self.evento().idclasificacion(data.idclasificacion);
           
            return number;
        }
    });
});


    /**
     * SAve /Edit Header evento.
     */ 
    this.SaveEdit = function () {
        var data = {
            idevento: self.evento().idevento(),            
            idctrampa: self.evento().idctrampa(),
            idclasificacion:self.evento().idclasificacion(),
            fechaevento: self.evento().fechaevento(),
            semana: self.evento().semana(),
            observaciones: self.evento().observaciones(),

        };

        $.ajax({
            url: 'evento/create',
            data: ko.toJSON(data),
            type: "POST",
            dataType: "json",
            contentType: 'application/json',
            //async: false,
            success: function (response) {
                console.log(response);
                $("#saveModal").modal('hide');
                self.obtenerEventos();
                if(!response.error)
                 createAutoClosingAlert('.alert-success', 3000);
                else
                    createAutoClosingAlert('.alert-warning', 3000);
                
            },
            error: function (a, b, c) {
                console.log(a + b + c);
            }
        });

    };
    
    /**
     * Save / Edit detalle del evento.
     */ 
    this.SaveEditDetail = function () {
        var data = {
            iddetalle: self.eventodetalle().iddetalle(),
            idevento: self.idEvetoGlobal(),            
            idplaga: self.eventodetalle().idplaga(),
            cantidad:self.eventodetalle().cantidad()            
        };

        $.ajax({
            url: 'eventoDetail/create',
            data: ko.toJSON(data),
            type: "POST",
            dataType: "json",
            contentType: 'application/json',
            //async: false,
            success: function (response) {
                console.log(response);
                $("#saveEventoDetalleModal").modal('hide');
                self.obtenerEventos();
                if(!response.error)
                 createAutoClosingAlert('.alert-success', 3000);
                else
                    createAutoClosingAlert('.alert-warning', 3000);
                
            },
            error: function (a, b, c) {
                console.log(a + b + c);
            }
        });

    };

    self.eventosDetalle = ko.observableArray([]);

    self.loadEventoDetalle = function () {
        self.show(!self.show());
        //allow to edit detalle evento.                
        self.idEvetoGlobal(this.idevento());
        
        self.eventosDetalle.removeAll();
        if (self.show()) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/evento/GetDetail/" + this.idevento(),                 
                async: false,
                success: function (response) {
                    if (!response.error){         
                         self.showPlagaBtn(response.eventosdetalle.length>0?false:true);
                        for (var i = 0; i < response.eventosdetalle.length; i++)
                            self.eventosDetalle.push(new EventoDetalleModel(response.eventosdetalle[i]));
                    }
                    
                },
                error: function (a, b, c) {
                    console.log(a + b + c);
                }

            });
        } else {
            self.eventosDetalle.removeAll();
                        
        }
    };

    self.show = ko.observable(false);
    self.status = ko.observable(false);
    self.isExpanded = ko.computed(function () {
        if (self.show()) {
            return "fa fa-minus-circle fa-fw";
        }
        return "fa fa-plus-circle fa-fw";
    });

    self.btnClass = ko.computed(function () {
        var status = self.status();
        if (status == 0)
            return "btn-success";
        else
            return "btn-danger";

    });
    
    Date.prototype.getWeek = function() {
        var onejan = new Date(this.getFullYear(),0,1);
        return Math.ceil((((this - onejan) / 86400000) + onejan.getDay()+1)/7);
    }
    
    self.DayofWeek = ko.computed(function(){
        if(self.evento()){
        var week = new Date(self.evento().fechaevento());
        //binding
        self.evento().semana(week.getWeek());
        return week.getWeek();
        }
    });

};

function createAutoClosingAlert(selector, delay) {
   var alert = $(selector).alert();
   window.setTimeout(function() { alert.alert('close') }, delay);
}

$(function () {

    //console.log( "ready!" );    
   // createAutoClosingAlert('.alert-success', 3000);
    $(".alert-success").hide();
    $(".alert-warning").hide();
    
   /* window.setTimeout(function() {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);*/
    
    mvvm = new Evento();
    mvvm.obtenerEventos();
    mvvm.obtenerPlagas();
    
    ko.applyBindings(mvvm);

    $('#pnlTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
    


    /*$("#pnlTabs").tab({ hide: 'fade', show: 'fade' });
    $(".dropdown-menu li a").click(function () {

        $(".btn:first-child").text($(this).text());
        $(".btn:first-child").val($(this).text());

    });*/


});