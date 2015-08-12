@extends('layout')
     
@section('content')
    <div class="page-header">
        <h1>Configurar Trampa</h1>
    </div>

<ul class="errors">
    @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
    @endforeach
</ul>
    
    <form action="{{ action('ConfiguracionTrampaController@handleCreate') }}" method="post" role="form">
    <div class="form-group">
     <label for="numero">Numero</label>
     <input type="text" class="form-control" name="numero" data-bind="value: numero" />
     </div>
    
        <select name="perro" class="form-control" data-bind="value: idtipotrampa, options: mvvm.tipostrampa, optionsText: 'description', optionsValue: 'id' " ></select>
      
    <select name="idclasificaiontrampa" class="form-control" data-bind="value: idclasificaiontrampa, options: mvvm.clasificaciones, optionsText: 'description', optionsValue: 'id' " ></select>
        
        <select name="idubicacion" class="form-control" data-bind="value: idubicacion, options: mvvm.ubicaciones, optionsText: 'Description', optionsValue: 'idubicacion' " ></select>
        
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" data-bind="value: description" />
        </div>
        
        <input data-bind='click:SaveEdit' type="submit" value="Create" class="btn btn-primary" />
		 <!--button type="button" data-bind="click: SaveEdit" class="btn btn-primary">Save</button-->
        <a href="{{ action('ConfiguracionTrampaController@index') }}" class="btn btn-link">Cancel</a>
    </form>
@stop