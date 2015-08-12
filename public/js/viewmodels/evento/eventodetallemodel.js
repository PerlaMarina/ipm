function EventoDetalleModel(data){
    var self = this;
    self.iddetalle= ko.observable(data.iddetalle);
    self.idevento = ko.observable(data.idevento);    
    self.idplaga = ko.observable(data.idplaga);
    self.plaga = ko.observable(data.plaga);	
    self.cantidad = ko.observable(data.cantidad);
    
    
}
