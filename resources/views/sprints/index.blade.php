@extends('layouts.admin')
@section('proyecto-selected', 'active')
@section('contenido')
	<div class="row">
		<div class="col-md-10">
			<h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>
		</div>
		<div class="col-md-2">
			@if (Auth::user()->isAdmin() || $proyecto->esSM(Auth::user()))
				<a href="{{URL::action('SprintController@create', $proyecto->idproyecto)}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo Sprint</a>
			@endif
		</div>
	</div>		
	
	<div class="panel panel-info main-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Sprints del Proyecto</h3>
        </div>
        <div class="table-responsive">
			<table class="table table-striped table-advance table-hover">
	            <thead>
	            <tr>
	                <th>#</th>
	                <th width="25%"><i class="fa fa-bullhorn"></i> Título</th>
	                <th><i class=" fa fa-edit"></i> Inicio</th>
	                <th><i class="fa fa-clock-o"></i> Fin</th>
	                <th width="30%"><i class="fa fa-clock-o"></i> Estado</th>
	                <th width="12%"><i class="fa fa-cogs"></i> Opciones</th>
	            </tr>
	            </thead>
	            <tbody>
	            @foreach ($sprints as $key => $sprint) 
		            <tr>
		            	<td>{{ $key+1 }}</td>	
		                <td><a href="{{URL::action('SprintController@show',[$proyecto->idproyecto,$sprint->idsprint])}}">{{ $sprint->titulo }}</a></td>		                		                
		                <td>{{ $sprint->inicio_sprint }}</td>
		                <td>{{ $sprint->fin_sprint }}</td>
		                <td>
		                	<div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$sprint->porcentaje_sprint}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$sprint->porcentaje_sprint}}%;">{{$sprint->porcentaje_sprint}}%</div>
                            </div>
		                </td>
		                <td>
		                	<a href="{{URL::action('SprintController@show',[$proyecto->idproyecto,$sprint->idsprint])}}" class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-search"></i></a>
		                	@if (Auth::user()->isAdmin() || $proyecto->esSM(Auth::user()))
	                    		<a href="{{URL::action('SprintController@edit',[$proyecto->idproyecto,$sprint->idsprint])}}" class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
	                    		<a href="" data-target="#modal-delete-{{ $sprint->idsprint }}" data-toggle="modal" class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></a>
	                    	@endif	                        	                            
	                    </td>
		            </tr>
		        	@include('sprints.modal')   
		        @endforeach
	            </tbody>
	        </table>
	    </div>
	    {{$sprints->render()}}        
    </div>
    <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}" class="btn btn-warning pull-left"><i class="fa fa-chevron-left"></i> Regresar</a>
@endsection