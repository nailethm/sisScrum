@extends('layouts.admin')
@section('contenido')
	<div class="panel panel-info main-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Datos de Usuario</h3>
            <div class="small-tools">
            	<ul>
            		<li>
            			@if(Auth::user()->isAdmin() || Auth::user()->id == $usuario->id)
			            	<a href="{{URL::action('UsuarioController@edit',$usuario->id)}}" class="btn btn-primary btn-xs tooltips pull-right" data-placement="bottom" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
			            @endif	
            		</li>
            		<li>
            			@if(Auth::user()->isAdmin())
			            	<a target="_blank" href="{{URL::action('PdfController@reporteUsuario',$usuario->id)}}" class="btn btn-default btn-xs tooltips pull-right" data-placement="bottom" data-original-title="Imprimir"><i class="fa fa-print"></i></a>
			            @endif	
            		</li>
            	</ul>
            </div>            
        </div>
        <div class="panel-body">
        	<div class="row">
        		<div class="col-md-3">
        			<div id="profile-02">
						<div class="user">
							<i class="fa fa-user fa-3x"></i>
							<h4>{{ $usuario->name }}</h4>
							<h5>{{ $usuario->CI }}{{ $usuario->issued }}</h5>
						</div>
					</div>	
        		</div>
        		<div class="col-md-9">
        			<div class="table-responsive">          
			            <table class="table table-hover table-striped">
		                    <tr>
		                        <th width="30%">Empresa:</th>
		                        <td>{{ $usuario->company }}</td>
		                    </tr>
		                    <tr>
		                        <th>Cargo:</th>
		                        <td>{{ $usuario->occupation }}</td>
		                    </tr>
		                    <tr>
		                        <th>Correo Electrónico:</th>
		                        <td>{{ $usuario->email }}</td>
		                    </tr>		                    
		                    <tr>
		                        <th>Dirección:</th>
		                        <td>{{ $usuario->address }}</td>
		                    </tr>
		                    <tr>
		                        <th>Teléfono:</th>
		                        <td>{{ $usuario->phone }}</td>
		                    </tr>
			            </table>
			        </div>	
        		</div>
        	</div>
        	<hr>
        	<div class="content-panel">
		        <h4><i class="fa fa-angle-right"></i> Proyectos Asignados</h4>
		        <div class="table-responsive">          
		            <table class="table table-hover">
		                <thead>
		                    <tr>
		                        <th width="2%">#</th>
		                        <th width="37%"><i class="fa fa-bullhorn"></i> Nombre</th>
		                        <th width="25%"><i class="fa fa-question-circle"></i> Estado</th>
		                        <th width="21%"><i class=" fa fa-edit"></i> Rol Asignado</th>		                        
		                        <th width="15%"><i class="fa fa-cogs"></i> Opciones</th>
		                    </tr>
		                </thead>
		                <tbody>
		                    @foreach ($misProyectos as $key => $proy)
		                        @if($proy->proyecto->estado <> 0) <!-- Cambiar esta comparación a == 2 -->
		                        <tr>
		                            <td>{{ $key+1 }}</td>
		                            <td><a href="{{URL::action('ProyectoController@show',$proy->idproyecto)}}">{{ $proy->proyecto->nombre}}</a></td>
		                            <td>
		                                <div class="progress">
		                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$proy->proyecto->porcentaje_proyecto}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$proy->proyecto->porcentaje_proyecto}}%;">{{$proy->proyecto->porcentaje_proyecto}}%</div>
		                                </div>
		                            </td>
		                            <td>{{ $proy->nombre_rol}}</td>		                            
		                            <td>
		                                <a href="{{URL::action('ProyectoController@show',$proy->proyecto->idproyecto)}}"><button class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-bar-chart-o"></i></button></a>
		                                @if(Auth::user()->isAdmin())
		                                    <a href="{{URL::action('ProyectoController@edit',$proy->proyecto->idproyecto)}}"><button class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></button></a>
		                                    <a href="" data-target="#modal-delete-{{ $proy->proyecto->idproyecto}}" data-toggle="modal" class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></a>
		                                @endif                              
		                            </td>
		                        </tr>
		                        @endif
		                        @include('proyecto.modal')
		                    @endforeach
		                </tbody>
		            </table>
		        </div>
		        {{$misProyectos->render()}}                    
		    </div>        	        	        	
       	</div>       			    
    </div>
@stop