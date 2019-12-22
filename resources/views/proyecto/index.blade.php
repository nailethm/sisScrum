@extends('layouts.admin')
@section('proyecto-selected', 'active')
@section('contenido')
	<div class="row">
		<div class="col-md-6">
		</div>
		<div class="col-md-6">
			@if(Auth::user()->isAdmin())
				<a href="proyectos/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo Proyecto</a>
			@endif
		</div>
	</div>
	<div class="panel panel-info main-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Proyectos</h3>
        </div>
        <div class="panel-body">
			@include('proyecto.search')   	 				 		
       	</div>
       	<div class="content-panel">
       		<h4><i class="fa fa-angle-right"></i> Proyectos en progreso</h4>
       		@if($proyectos->count() <> 0)
	        <div class="table-responsive">        	
				<table class="table table-striped table-advance table-hover">
		            <thead>
		            <tr>
		                <th width="2%">#</th>
		                <th width="37%"><i class="fa fa-bullhorn"></i> Nombre</th>
		                <th width="25%"><i class="fa fa-question-circle"></i> Avance</th>
		                <th width="12%"><i class=" fa fa-edit"></i> Inicio</th>
		                <th width="12%"><i class="fa fa-clock-o"></i> Fin</th>
		                <th width="15%"><i class="fa fa-cogs"></i> Opciones</th>
	            	</tr>
		            </thead>
		            <tbody>
		            @foreach ($proyectos as $key => $proy)
		            	@if($proy->estado <> 0) <!-- Cambiar esta comparación a == 2 -->
			            <tr>
			                <td>{{ $key+1 }}</td>
			                <td><a href="{{URL::action('ProyectoController@show',$proy->idproyecto)}}">{{ $proy->nombre}}</a></td>
			                <td>
			                	<div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$proy->porcentaje_proyecto}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$proy->porcentaje_proyecto}}%;">{{$proy->porcentaje_proyecto}}%</div>
                                </div>
			                </td>
			                <td>{{ $proy->inicio_proyecto}}</td>
			                <td>{{ $proy->fin_proyecto}}</td>
			                <td>
			                	<a href="{{URL::action('ProyectoController@show',$proy->idproyecto)}}"><button class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-bar-chart-o"></i></button></a>
			                	@if(Auth::user()->isAdmin())
			                        <a href="{{URL::action('ProyectoController@edit',$proy->idproyecto)}}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></button></a>
			                        <a href="" data-target="#modal-delete-{{ $proy->idproyecto}}" data-toggle="modal" class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></a>
		                        @endif		                        
		                    </td>
			            </tr>
			            @endif
			            @include('proyecto.modal')
			        @endforeach
		            </tbody>
		        </table>
		    </div>
		    {{$proyectos->render()}}		    
		    @else
		    	<p class="text-centered">No hay proyectos que listar</p>
		    @endif
	    </div>
		<div class="content-panel">
		    <h4><i class="fa fa-angle-right"></i> Proyectos terminados</h4>
	        @if($proyectos->count() <> 0)
		        <div class="table-responsive">        	
					<table class="table table-striped table-advance table-hover">
			            <thead>
			            <tr>
			                <th width="2%">#</th>
			                <th width="37%"><i class="fa fa-bullhorn"></i> Nombre</th>
			                <th width="25%"><i class="fa fa-question-circle"></i> Avance</th>
			                <th width="12%"><i class=" fa fa-edit"></i> Inicio</th>
			                <th width="12%"><i class="fa fa-clock-o"></i> Fin</th>
			                <th width="15%"><i class="fa fa-cogs"></i> Opciones</th>
			            </tr>
			            </thead>
			            <tbody>
			            @foreach ($proyectos as $key => $proy) 
				            @if($proy->estado == 3)
				            <tr>
				                <td>{{ $key+1 }}</td>
				                <td width="31%"><a href="{{URL::action('ProyectoController@show',$proy->idproyecto)}}">{{ $proy->nombre}}</a></td>
				                <td>
				                	<div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$proy->porcentaje_proyecto}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$proy->porcentaje_proyecto}}%;">{{$proy->porcentaje_proyecto}}%</div>
                                    </div>
				                </td>
				                <td>{{ $proy->inicio_proyecto}}</td>
				                <td>{{ $proy->fin_proyecto}}</td>
				                <td>
			                        <a href="{{URL::action('ProyectoController@show',$proy->idproyecto)}}"><button class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-bar-chart-o"></i></button></a>
				                	@if(Auth::user()->isAdmin())
				                        <a href="{{URL::action('ProyectoController@edit',$proy->idproyecto)}}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></button></a>
				                        <a href="" data-target="#modal-delete-{{ $proy->idproyecto}}" data-toggle="modal" class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></a>
			                        @endif
			                    </td>
				            </tr>
				            @include('proyecto.modal')
				            @endif
				        @endforeach
			            </tbody>
			        </table>
			    </div>
			    {{$proyectos->render()}}
		    @else
		    	<p class="text-centered">No hay proyectos que listar</p>
		    @endif
	    </div>    
    </div>
@endsection