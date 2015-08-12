function CfgTrampaModel(data){
    var self = this;
    
    self.idctrampa = ko.observable(data.idctrampa);    
    self.number = ko.observable(data.notrampa);
    self.idubicacion = ko.observable(data.idubicacion);
    self.ubicacion = ko.observable(data.ubicacion);
    self.idclasificacion = ko.observable(data.idclasificacion);    	
    self.clasificacion = ko.observable(data.clasificaciontrampa);    	
    
    
}
