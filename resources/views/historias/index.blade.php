@extends('layouts.admin')
@section('proyecto-selected', 'active')
@section('contenido')
	<a href="{{URL::action('SprintController@create', $proyecto->idproyecto)}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo Sprint</a>
	<div class="panel panel-info main-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Sprints del Proyecto: <strong>{{ $proyecto->nombre }}</strong></h3>
        </div>
        <div class="table-responsive">
			<table class="table table-striped table-advance table-hover">
	            <thead>
	            <tr>
	                <th>#</th>
	                <th width="25%"><i class="fa fa-bullhorn"></i> Título</th>
	                <th width="27%"><i class=" fa fa-edit"></i> Inicio</th>
	                <th><i class="fa fa-clock-o"></i> Fin</th>
	                <th><i class="fa fa-clock-o"></i> Estado</th>
	                <th><i class="fa fa-cogs"></i> Opciones</th>
	            </tr>
	            </thead>
	            <tbody>
	            @foreach ($sprints as $key => $sprint) 
		            <tr>
		            	<td>{{ $key+1 }}</td>	
		                <td>{{ $sprint->titulo }}</td>		                		                
		                <td>{{ $sprint->inicio_sprint }}</td>
		                <td>{{ $sprint->fin_sprint }}</td>
		                <td>{{ $sprint->estado }}</td>
		                <td>
	                    	<a href="{{URL::action('SprintController@edit',[$proyecto->idproyecto,$sprint->idsprint])}}" class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
	                    	<a href="" data-target="#modal-delete-{{ $sprint->idsprint }}" data-toggle="modal"><button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></button></a>
	                        
	                            
	                    </td>
		            </tr>
		        	@include('sprints.modal')   
		        @endforeach
	            </tbody>
	        </table>
	    </div>
	    {{$sprints->render()}}
        
    </div>
@endsection