@extends('layouts.admin')
@section('contenido')
	<h2>> <strong class="text-uppercase">{{$proyecto->nombre}}</strong></h2>
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Detalles del Proyecto</h3>
    	</div>
    	<div class="panel-body">            
            <div class="row">
            	<div class="col-md-9">
            		<div class="panel panel-borders">
						<div class="panel-heading">
							<h4>PILA DEL PRODUCTO</h4> <a href="{{URL::action('BacklogController@index',$proyecto->idproyecto)}}" class="btn btn-default pull-right"><i class="fa fa-plus"></i></a>			
						</div>						
						<div class="panel-body">							
							<div class="row">
								<div class="col-md-6">
									<p><b>Estado Actual:</b> En producción</p>
								</div><div class="col-md-6">
									<p><b>Sprint Actual:</b> 3</p>
								</div>
							</div>
							<div class="table-responsive">
								<h5>Historias</h5>
								<table class="table table-striped table-advance table-hover">
									<tr>
						                <td>1</td>
						                <td><a href="#">linnk</a></td>							                
						                <td>2</td>
						                <td>3</td>							                
						            </tr>
						            <tr>
						                <td>1</td>
						                <td><a href="#">linnk</a></td>							                
						                <td>2</td>
						                <td>3</td>							                
						            </tr>						        						           
							    </table>
							</div>
						</div>	
					</div>
            	</div>
            	<div class="col-md-3">
            		<a href="#" class="btn btn-default btn-lg btn-block"><i class="fa fa-users"></i> Equipo</a>
            		<a href="{{URL::action('SprintController@index',$proyecto->idproyecto)}}" class="btn btn-default btn-lg btn-block"><i class="fa fa-list"></i> Sprints</a>
            		<a href="#" class="btn btn-default btn-lg btn-block"><i class="fa fa-gears"></i> Herramientas</a>
            		<a href="#" class="btn btn-default btn-lg btn-block"><i class="fa fa-archive"></i> Entregables</a>
            	</div>
            </div>
                
    	</div>
    </div>
@stop