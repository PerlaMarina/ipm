function UbicacionModel(data){
    var self = this;
    
    self.id = ko.observable(data.id);
    self.name = ko.observable(data.name);
    self.description = ko.observable(data.description);
}
