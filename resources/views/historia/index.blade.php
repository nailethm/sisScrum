@extends('layouts.admin')
@section('contenido')
	<a href="proyecto/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo Proyecto</a>
	<div class="panel panel-info main-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Mis Proyectos</h3>
        </div>
        <div class="panel-body">
   	 		@include('proyecto.search')
       	</div>
        <div class="table-responsive">
			<table class="table table-striped table-advance table-hover">
	            <thead>
	            <tr>
	                <th>Id</th>
	                <th width="25%"><i class="fa fa-bullhorn"></i> Nombre</th>
	                <th><i class="fa fa-question-circle"></i> Descripción</th>
	                <th width="27%"><i class=" fa fa-edit"></i> Inicio</th>
	                <th><i class="fa fa-clock-o"></i> Fin</th>
	                <th><i class="fa fa-cogs"></i> Opciones</th>
	            </tr>
	            </thead>
	            <tbody>
	            @foreach ($proyectos as $proy) 
		            <tr>
		                <td>{{ $proy->idproyecto}}</td>
		                <td><a href="{{URL::action('ProyectoController@show',$proy->idproyecto)}}">{{ $proy->nombre}}</a></td>
		                <td>{{ $proy->descripcion}}</td>
		                <td>{{ $proy->inicio_proyecto}}</td>
		                <td>{{ $proy->fin_proyecto}}</td>
		                <td>
	                        <a href="{{URL::action('ProyectoController@edit',$proy->idproyecto)}}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></button></a>
	                        <a href="" data-target="#modal-delete-{{ $proy->idproyecto}}" data-toggle="modal"><button class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></button></a>
	                        <a href="{{URL::action('ProyectoController@show',$proy->idproyecto)}}"><button class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Datos"><i class="fa fa-bar-chart-o"></i></button></a>
	                    </td>
		            </tr>
		            @include('proyecto.modal')
		        @endforeach
	            </tbody>
	        </table>
	    </div>
	    {{$proyectos->render()}}
        
    </div>
@endsection