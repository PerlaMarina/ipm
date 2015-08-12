@extends('layout') @section('content')
<div class="page-header">
    <h3>Eventos <small>List</small></h3>
</div>

<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#saveModal" data-bind="click: newEvent">
    <i class="fa fa-plus-circle fa-fw"></i>&nbsp; Crear
</button>

<div id="pnlTabs">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#pnlInterior">Interior</a>
        </li>
        <li role="presentation"><a href="#pnlExterior">Exterior</a>
        </li>
        <li role="presentation"><a href="#pnlVoladores">Voladores</a>
        </li>
    </ul>
</div>

<div class="tab-pane active" id="pnlInterior" style="overflow-y: hidden;">
    <table class="table table-striped">
        <thead>
            <tr>            
                <th></th>
                <!--th>#</th-->
                <th>Trampa</th>
                <th>ubicacion</th>
                <th>Clasificacion</th>                
                <th>Fecha Evento</th>
                <th>Semana</th>
                <th>Observaciones</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody data-bind="foreach: eventos()">
            <!--tr data-toggle="collapse" data-bind="click: $parent.loadEventoDetalle,attr: { 'data-target': '#details'+idevento() }"-->
            <tr>
                <th>
                    <!--i data-toggle="collapse" class="glyphicon expand-evento" data-bind="css: $parent.isExpanded,click: $parent.loadEventoDetalle,  attr: { 'data-target': '#details'+idevento() }"></i-->
                <a data-toggle="collapse"  class="expand-evento" data-bind="text:clasificacion(),click: $parent.loadEventoDetalle,  attr: { 'data-target': '#details'+idevento() }"></a>
                </th>
                <!--td data-bind="text: idevento()"></td-->
                <td data-bind="text: number()"></td>    
                <td data-bind="text: ubicacion()"></td>                
                <td data-bind="text: clasificacion()"></td>                
                <td data-bind="text: fechaevento()"></td>
                <td data-bind="text: semana()"></td>
                <td data-bind="text: observaciones()"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" data-bind="click: $parent.select" data-toggle="modal" data-target="#deleteModal">
                        <i class="fa fa-trash-o fa-fw"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm" data-bind="click: $parent.select" data-toggle="modal" data-target="#saveModal">
                        <i class="fa fa-pencil fa-fw"></i>
                    </button>                
                  
                </td>
            </tr>
                            
            <!--ko if: $parent.eventosDetalle().length > 0 -->
            <tr class="collapse" data-bind="attr: { id: 'details'+idevento() }">
                <td></td>
                <td colspan="5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Plaga</th>
                                <th>Cantidad</th>
                                <th>
                                    <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#saveEventoDetalleModal" data-bind="click: $parent.newEventDetail">
                                        <i class="fa fa-plus-circle fa-fw"></i> Agregar Plaga
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody data-bind="foreach: $parent.eventosDetalle()">
                            <tr>

                                <td data-bind="text: plaga()"></td>
                                <td data-bind="text: cantidad()"></td>
                                <td>
                                    <button class="btn btn-sm pull-right" data-toggle="modal" data-target="#saveEventoDetalleModal" data-bind="click: mvvm.selectDetail">
                                        <i class="fa fa-pencil fa-fw"></i>
                                    </button>
                                    <!--button class="btn btn-sm pull-right" data-toggle="modal">
                                        <i class="fa fa-trash-o fa-fw"></i>
                                    </button-->
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </td>
            </tr>            
            <!--/ko-->
            <!--Show this section if Evento has detail (plaga and cantidad) -->
              <tr class="collapse" data-bind="attr: { id: 'details'+idevento() },visible:$parent.showPlagaBtn()" >
                <td></td>
                <td colspan="5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Plaga</th>
                                <th>Cantidad</th>
                                <th>
                                    <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#saveEventoDetalleModal" data-bind="click: $parent.newEventDetail">
                                        <i class="fa fa-plus-circle fa-fw"></i> Agregar Plaga
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        
                    </table>

                </td>
            </tr>            
            
        </tbody>
    </table>
</div>

<!--Save Modal -->
<div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="updateLabel" aria-hidden="true" data-bind="with: evento()">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="updateLabel">Evento</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="cantidad">Numero de Trampa</label>
                    <input type="text" autocomplete="off" placeholder="Escribir Numero de Trampa" class="form-control " name="number" id ="number" data-bind="value: number, valueUpdate: 'blur'"  />
                </div>
                <div class="form-group">
                    <label for="clasificacion">Ubicacion</label>
                    <input type="text" class="form-control" name="ubicacion" id="ubicacion" data-bind="value: ubicacion" readonly />
                </div>
                <div class="form-group">
                    <label for="clasificacion">Clasificacion</label>
                    <input type="text" class="form-control" name="clasificacion"  id="clasificacion" data-bind="value: clasificacion" readonly />
                </div>
                
                <!--div class="form-group">
                    <label for="plaga">Plaga</label>
                    <select name="plaga" class="form-control" data-bind="value:plagaid, options: mvvm.plagas, optionsText: 'description', optionsValue: 'id' "></select>
                </div-->

                <div class="form-group">
                    <label for="fechaevento">Fecha Evento</label>
                    <input type="date" class="form-control" name="fechaevento" data-bind="value: fechaevento" />
                </div>
                <div class="form-group">
                    <label for="semana">Semana</label>
                    <input type="number" class="form-control" name="semana" data-bind="value: $parent.DayofWeek" readonly />
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <textarea class="form-control" name="observaciones" data-bind="value: observaciones" >
                    </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-bind="click: $parent.SaveEdit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
<!--Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true" data-bind="with: evento()">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="deleteLabel">Delete User</h4>
            </div>
            <div class="modal-body">
                Esta seguro de eliminar el registro "<span data-bind="text: idevento()"></span>"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" data-bind="click: $parent.deleteUser">Delete</button>
            </div>
        </div>
    </div>
</div>

<!--Save Evento detalle Modal -->
<div class="modal fade" id="saveEventoDetalleModal" tabindex="-1" role="dialog" aria-labelledby="updateLabel" aria-hidden="true" data-bind="with: eventodetalle()">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="updateLabel">Plagas en el Evento</h4>
            </div>
            <div class="modal-body">
                <!--div class="form-group">
                    <label for="plaga">Plaga</label>
                    <input type="text" autocomplete="off" placeholder="Escribir Plaga" class="form-control " name="plaga" id ="plaga" data-bind="value: plaga, valueUpdate: 'blur'"  />
                </div-->                
                
                <div class="form-group">
                    <label for="plaga">Plaga</label>
                    <select name="plaga" class="form-control" data-bind="value:idplaga, options: mvvm.plagas, optionsText: 'description', optionsValue: 'id' "></select>
                </div>
              
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" data-bind="value: cantidad" />
                </div>
             
            </div>
            <div class="modal-footer">
                <button type="button" data-bind="click: $parent.SaveEditDetail" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

<div class="alert alert-success alert-dismissible" role="alert"  style="display:hide;" >
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Guardado correctamente</strong>
</div>

<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> al guardar los datos.
</div>


{{ HTML::script('js/viewmodels/evento/eventodetallemodel.js') }} {{ HTML::script('js/viewmodels/evento/eventomodel.js') }} {{ HTML::script('js/viewmodels/evento/eventos.js') }} {{ HTML::script('js/viewmodels/trampa/cfgTrampa.js') }}
@stop