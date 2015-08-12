var mvvm;
var TrampaModel = function () {

	var self = this;
    //this.ubicaciones = [];
    self.ubicaciones = ko.observableArray([]);    
    
    self.tipostrampa = ko.observableArray([]);
    self.SelectedTipo = ko.observable([]);
    
	this.idubicacion = ko.observable();
    this.idclasificaiontrampa = ko.observable();
	this.numero = ko.observable();
	this.description = ko.observable();
    this.idtipotrampa = ko.observable();
    
	//populate inputs select
	this.obtenerUbicaciones = function(){
        $.ajax({
			type: "GET",
			dataType: "json",
            url: 'ubicacion/list',            
            //async: false,
            success: function (response) {
                //self.ubicaciones = response.ubicaciones;                
                if (!response.error){                
                  for (var i = 0; i < response.ubicaciones.length; i++)
                    self.ubicaciones.push(new UbicacionModel(response.ubicaciones[i]));
                }
                
            },
            error: function(a, b, c){ }
        });
    };
    
	/*this.obtenerClasificacionTrampa = function(){
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
    };*/
    
	/*this.obtenerTiposTrampa = function(){
        $.ajax({
			type: "GET",
			dataType: "json",
            url: 'data/tipotrampa.json',            
            async: false,
            success: function (response) {
                self.tipostrampa = response;                
            },
            error: function(a, b, c){ }
        });
    };*/
    this.obtenerTipos = function () {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: 'data/tipotrampa.json',
            async: false,
            success: function (response) {

                for (var i = 0; i < response.length; i++) {
                    
                    self.tipostrampa.push(new TipoTrampaModel(response[i]));
                }
                
                self.SelectedTipo(self.tipostrampa()[0]);


            },
            error: function (a, b, c) {}
        });
    };
    
	
	this.SaveEdit = function(){
		var data = {
			numero : self.numero(),
            idtipotrampa : self.idtipotrampa(),
			idclasificaiontrampa : self.idclasificaiontrampa(),
			idubicacion : self.idubicacion(),
			description : self.description(),
			
		};
		
		$.ajax({
			url: '/create',     
			data: ko.toJSON(data),					
			type: "POST",
			dataType: "json",
			contentType: 'application/json',
			//async: false,
			success: function (response) {                
				console.log(response);    
                //TODO: replace in index.blade the code blade. similar to evento index
                location.reload()
			},
			error: function(a, b, c){
			console.log(a+b+c);
			}
		});
		
	};
    

    
};

$(function() {
	
    //console.log( "ready!" );    
    mvvm = new TrampaModel();
    //mvvm.obtenerClasificacionTrampa();
    mvvm.obtenerUbicaciones();
    //mvvm.obtenerTiposTrampa();
    mvvm.obtenerTipos();
	ko.applyBindings(mvvm);
	
	
    
});
