function TipoTrampaModel(data) {
    var self = this;

    self.id = ko.observable(data.id);
    self.name = ko.observable(data.name);
    self.SelectedClasificacion = ko.observable();
    self.SelectedLocalizacion = ko.observable();
    self.Clasificaciones = ko.observableArray([]);
    self.Localizaciones = ko.observableArray([]);

    for (var k = 0; k < data.clasificaciones.length; k++) {
        self.Clasificaciones.push(new ClasificacionModel(data.clasificaciones[k]));
    }

    self.SelectedClasificacion(self.Clasificaciones()[0]);

    //Localizaciones

    for (var k = 0; k < data.localizaciones.length; k++) {
        self.Localizaciones.push(new LocalizacionModel(data.localizaciones[k]));
    }

    self.SelectedLocalizacion(self.Clasificaciones()[0]);

}

function LocalizacionModel(data) {
    var self = this;

    self.id = ko.observable(data.id);
    self.name = ko.observable(data.name);

}

function ClasificacionModel(data) {
    var self = this;

    self.id = ko.observable(data.id);
    self.name = ko.observable(data.name);
}