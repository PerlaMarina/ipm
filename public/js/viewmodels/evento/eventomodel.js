function EventoModel(data){
    var self = this;
    
    self.idctrampa = ko.observable(data.idctrampa);
    self.idevento = ko.observable(data.idevento);
    self.number = ko.observable(data.number);
    self.ubicacion = ko.observable(data.ubicacion);
    self.idclasificacion = ko.observable(data.idclasificacion);    
    self.clasificacion = ko.observable(data.clasificacion);    	
    self.fechaevento = ko.observable(data.fechaevento);    
    self.semana = ko.observable(data.semana);
    self.observaciones = ko.observable(data.observaciones);
}
