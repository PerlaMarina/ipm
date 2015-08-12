@extends('layout') @section('content')
<div class="page-header">
    <h3>Configuracion Trampa <small>List</small></h3>
</div>

<!--div class="panel panel-default">
    <div class="panel-body">
        <a href="{{ action('ConfiguracionTrampaController@create') }}" class="btn btn-primary" >Crear</a>
    </div>
</div-->

<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#saveModal">
            <i class="fa fa-plus-circle fa-fw"></i>&nbsp; Crear
</button>

@if ($trampas->isEmpty())
<p>No hay registros! :(</p>
@else
<table class="table table-striped">
    <thead>
        <tr>
            <th>Numero</th>
            <th>Tipo</th>
            <th>clasificaciontrampa</th>            
            <th>Ubicacion</th>

        </tr>
    </thead>
    <tbody>
        @foreach($trampas as $item)
        <tr>
            <td>{{ $item->notrampa }}</td>
            <td>{{ $item->tipotrampa }}</td>
            <td>{{ $item->clasificaciontrampa }}</td>
            <td>{{ $item->ubicacion }}</td>            
        </tr>
        @endforeach
    </tbody>
</table>

<!--Save Modal -->
<div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-labelledby="updateLabel" aria-hidden="true">   
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="updateLabel">Trampa</h4>
            </div>
            <div class="modal-body">           

				<div class="form-group">
				<label for="numero">Numero</label>
				<input type="text" class="form-control" name="numero" data-bind="value: numero" />
				</div>    
				<div class="form-group">
				<label for="idtipotrampa">Tipo Dispositivo</label>
				<select name="idtipotrampa" class="form-control" data-bind="value: SelectedTipo, options: mvvm.tipostrampa, optionsText: 'name' " ></select>      
				</div>
				<div class="form-group" data-bind='with: SelectedTipo'>
				<label for="idtipotrampa">Ubicacion Dispositivo</label>
				<select name="idclasificaiontrampa" class="form-control" data-bind="value: SelectedLocalizacion, options: Localizaciones, optionsText: 'name' " ></select>        
				</div>
                <div class="form-group" data-bind='with: SelectedTipo'>
				<label for="idtipotrampa">Clasificacion de Dispositivo</label>
				<select name="idclasificaiontrampa" class="form-control" data-bind="value: SelectedClasificacion, options: Clasificaciones, optionsText: 'name' " ></select>        
				</div>
				<div class="form-group">
				<label for="idtipotrampa">Area de Ubicacion</label>
				<select name="id" class="form-control" data-bind="value: idubicacion, options: ubicaciones(), optionsText: 'description', optionsValue: 'id' " ></select>        
                    <!--select name="idubicacion" class="form-control" data-bind="value: idubicacion, options: ubicaciones(), optionsText: 'Description', optionsValue: 'idubicacion' " ></select-->        
				</div>				
				<div class="form-group">
				<label for="description">Description</label>
				<input type="text" class="form-control" name="description" data-bind="value: description" />
				</div>
            </div>
		<div class="modal-footer">
			<button type="button" data-bind="click: SaveEdit" class="btn btn-primary">Guardar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>
        </div>
    </div>
</div>
{{ HTML::script('js/viewmodels/trampa/trampa.js') }} 
{{ HTML::script('js/viewmodels/trampa/ubicacionmodel.js') }} 
{{ HTML::script('js/viewmodels/trampa/TipoTrampaModel.js') }} 
@endif @stop