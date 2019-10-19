@extends('layouts.admin')

@section('contenido')
	<a href="usuario/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo Usuario</a>	
	<div class="panel panel-info main-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Administrar Usuarios</h3>
        </div>
        <div class="panel-body">
        	<div class="row">
        		<div class="col-md-6">
        			@include('seguridad.usuario.search')
        		</div>
        		<div class="col-md-6">
        			
        		</div>
        	</div>        	        	        	
       	</div>

       	<div class="content-panel">
       		@if(session('notification'))
       			<div class="alert alert-warning">
       				{{ session('notification') }}
       			</div>
       		@endif
       		<h4><i class="fa fa-angle-right"></i> Cuentas Activas</h4>
	        <div class="table-responsive">	        	        	
				<table class="table table-striped table-advance table-hover">
		            <thead>
		            <tr>
		                <th>Id</th>
		                <th><i class="fa fa-bullhorn"></i> Nombre</th>
		                <th><i class="fa fa-question-circle"></i> Email</th>		                		                
		                <th><i class="fa fa-cogs"></i> Opciones</th>
		            </tr>
		            </thead>
		            <tbody>
		            @foreach ($usuarios as $usuario) 
			            <tr>
			                <td>{{ $usuario->id }}</td>
			                <td><a href="{{URL::action('UsuarioController@show',$usuario->id)}}">{{ $usuario->name }}</a></td>
			                <td>{{ $usuario->email }}</td>			                
			                <td>
			                	<a href="{{URL::action('UsuarioController@show',$usuario->id)}}" class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-search"></i></a>
		                        <a href="{{URL::action('UsuarioController@edit',$usuario->id)}}" class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
		                        <a href="" data-target="#modal-delete-{{ $usuario->id}}" data-toggle="modal" class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Desactivar"><i class="fa fa-times "></i></a>		                        
		                    </td>
			            </tr>
			            @include('seguridad.usuario.modal')
			        @endforeach
		            </tbody>
		        </table>
		        {{$usuarios->render()}}
		    </div>		    
	    </div>
	    <div class="content-panel">
       		<h4><i class="fa fa-angle-right"></i> Cuentas Inactivas</h4>
	        <div class="table-responsive">	        	        	
				<table class="table table-striped table-advance table-hover">
		            <thead>
		            <tr>
		                <th>Id</th>
		                <th><i class="fa fa-bullhorn"></i> Nombre</th>
		                <th><i class="fa fa-question-circle"></i> Email</th>		                		                
		                <th><i class="fa fa-cogs"></i> Opciones</th>
		            </tr>
		            </thead>
		            <tbody>
		            @foreach ($uinactivos as $uinactivo) 
			            <tr>
			                <td>{{ $uinactivo->id }}</td>
			                <td><a href="{{URL::action('UsuarioController@show',$uinactivo->id)}}">{{ $uinactivo->name }}</a></td>
			                <td>{{ $uinactivo->email }}</td>			                
			                <td>
			                	<a href="{{URL::action('UsuarioController@show',$usuario->id)}}" class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-search"></i></a>
		                        <a href="{{URL::action('UsuarioController@edit',$uinactivo->id)}}" class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
		                        {!!Form::model($uinactivo,['method'=>'PATCH','route'=>['seguridad.usuario.update',$uinactivo->id]])!!}
            					{{Form::token()}}
            						<input type="hidden" name="status" class="form-control" value="1"> 
                                    <button type="submit" class="btn btn-success btn-xs tooltips" data-placement="top" data-original-title="Activar"><i class="fa fa-check "></i></button>
                                {!!Form::close()!!}		                        		                        
		                    </td>
			            </tr>
			        @endforeach
		            </tbody>
		        </table>
		        {{$uinactivos->render()}}
		    </div>		    
	    </div>		    
    </div>
@endsection