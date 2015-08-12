@extends('layout') 
@section('sidemenu')

    <div class="mini-submenu" >
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </div>
<div class="list-group" >

    <span href="#" class="list-group-item active">

        Filtro para la grafica
        <span class="pull-right" id="slide-submenu">
            <i class="fa fa-times"></i>

        </span>
    </span>
    <a href="#" class="list-group-item">
        <i class="fa fa-calendar"></i> Fecha        
    </a>
    <select name="idmes" class="form-control" data-bind="options: mvvm.meses " ></select>        
    <a href="#" class="list-group-item">
        <i class="fa fa-bar-chart-o"></i> Clasificacion
    </a>
    <select  name="idclasificaiontrampa" class="form-control" data-bind="value: selectedClasificacion, options: mvvm.clasificaciones, optionsText: 'description', optionsValue: 'description' " ></select>  
</div>   

 @stop         
@section('content')
<div class="page-header">
    <h3>Grafica </h3>
</div>


<div id="pnlTabs">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#pnlInterior">Interior</a>
        </li>
        <li role="presentation"><a href="#pnlExterior">Exterior</a>
        </li>
        <li role="presentation"><a href="#pnlVoladores">Feromona</a>
        </li>
    </ul>
</div>


<h3> <span class="label label-primary">Total de eventos en el mes.</span></h3>  
<div id="inner">
    <svg id="animated" viewbox="0 0 100 100" style="width:40%;">
        <circle cx="50" cy="50" r="45" fill="#FDB900" />
        <path fill="none" stroke-linecap="round" stroke-width="5" stroke="#fff" stroke-dasharray="251.2,0" d="M50 10
           a 40 40 0 0 1 0 80
           a 40 40 0 0 1 0 -80">
            <animate attributeName="stroke-dasharray" from="0,251.2" to="251.2,0" dur="3s" />
        </path>
        <text id="count" x="50" y="50" text-anchor="middle" dy="7" font-size="20">18</text>
    </svg>
</div>

<!--div id="chart-eventos-gral"></div-->

<h3>   <span class="label label-primary">Total de eventos por dispositivo.</span></h3>
<div id="chart-eventos-clasificacion"></div>
<h3>   
    <span id="clasicifacion-selected" class="label label-primary" data-bind="text: 'Detalle de plaga en ' + selectedClasificacion()"> </span>    
</h3>  
<div id="chart-plagas"></div>

{{ HTML::style('css/c3.min.css') }}
{{ HTML::script('js/d3.min.js') }}
{{ HTML::script('js/c3.min.js') }}
{{ HTML::script('js/sidemenu.js') }}

{{ HTML::script('js/viewmodels/evento/grafica.js') }}

@stop