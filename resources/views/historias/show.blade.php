@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-md-10">
			<h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>
		</div>
		<div class="col-md-2">
			<a href="{{URL::action('TareaController@create', [$proyecto->idproyecto,$historia->idhistoria])}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nueva Tarea</a>
		</div>
	</div>
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Tareas</strong></h3>
            <div class="small-tools">
                <ul>                    
                    <li>
                        <a target="_blank" href="{{URL::action('PdfController@reporteTareas', $historia->idhistoria)}}" class="btn btn-default btn-xs tooltips pull-right" data-placement="bottom" data-original-title="Imprimir"><i class="fa fa-print"></i></a> 
                    </li>
                </ul>
            </div>
    	</div>
    	<div class="panel-body">
            <div class="panel story-box center-block">
                <div class="panel-body">
	                <div class="story-header">
	                    <h3 class="text-center"><strong>H<span>{{$historia->idhistoria}}</span></strong>  Como <span>{{$historia->actor}}</span> necesito <span>{{$historia->requerimiento}}</span> así podré <span>{{$historia->funcionalidad}}</span></h3>                                            
	                </div>
	                <h4><strong>Notas:</strong></h4>
	                <p>{{$historia->notas}}</p>
                </div>
                <div class="panel-footer">
                    <div class="row">
                    	<div class="col-md-6"><h4><strong>Prioridad:</strong> <br/>{{$historia->prioridad}}</h4></div>
                        <div class="col-md-6"><h4><strong>Estado:</strong> <br/>{{$historia->nombre_estado_historia}}</h4></div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered"> 
                <thead> 
                    <tr> 
                        <th>#</th> 
                        <th>Tarea</th> 
                        <th width="12%">Asignado a</th> 
                        <th width="10%">Dificultad <span>1 a 5</span></th>
                        <th width="30%">Estado</th>                                                
                        <th width="12%"><i class="fa fa-cogs"></i> Opciones</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    @foreach ($tareas as $key => $tarea) 
                    <tr>
                        <td>{{ $key+1 }}</td>   
                        <td><a href="{{URL::action('AvanceTareaController@index',[$proyecto->idproyecto,$tarea->idtarea])}}">{{ $tarea->titulo }}</a></td>                                              
                        <td><a href="{{URL::action('UsuarioController@show',$tarea->usuario->id)}}">{{ $tarea->usuario->name }}</a></td>
                        <td>{{ $tarea->dificultad }}</td>                        
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$tarea->porcentaje_tarea}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tarea->porcentaje_tarea}}%;">{{$tarea->porcentaje_tarea}}%</div>
                            </div>
                        </td>
                        <td>
                            <a href="{{URL::action('AvanceTareaController@index',[$proyecto->idproyecto,$tarea->idtarea])}}" class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-search"></i></a>
                            <a href="{{URL::action('TareaController@edit',[$proyecto->idproyecto,$historia->idhistoria,$tarea->idtarea])}}" class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
                            <a href="" data-target="#modal-delete-{{ $tarea->idtarea }}" data-toggle="modal" class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></a>
                        </td>
                    </tr>
                    @include('tareas.modal')   
                    @endforeach                     
                </tbody> 
            </table>
          
                                                
        </div>
    </div>
    <a href="{{URL::previous()}}" class="btn btn-warning pull-left"><i class="fa fa-chevron-left"></i> Regresar</a>
@stop