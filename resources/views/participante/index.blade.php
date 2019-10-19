@extends('layouts.admin')
@section('proyecto-selected', 'active')
@section('contenido')	
    <h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>
	<div class="panel panel-info main-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Agregar Participantes</h3>
        </div>
        <div class="panel-body">
        	<div class="row">        		        		
        		<div class="col-md-5">
                    @if (Auth::user()->isAdmin() || $proyecto->esSM(Auth::user()))
            			@include('participante.search')
    	        		<div class="participante-panel pn">						
    						<div class="data">
    							<h4>> Seleccione participantes</h4>
    							<ul class="list-group">
                                @foreach ($noasignados as $noasig) 
                                    <li class="list-group-item">
                                        <a href="#">{{ $noasig->name }}</a>
                                        <a href="" data-target="#modal-add-{{ $noasig->id}}" data-toggle="modal" class="pull-right btn btn-warning btn-xs tooltips" data-placement="top" data-original-title="Agregar"><i class="fa fa-plus "></i></a>                              
                                    </li>
                                    @include('participante.modal')
                                @endforeach                                
                                </ul>			
    						</div>						
    					</div>
                    @endif    		   	 			
        		</div>
        		<div class="col-md-1">
        			
        		</div>
        		<div class="col-md-6">
	        		<div class="participante-panel pn">
						<div class="participante-panel-header">							
							<p class="centered">Agregados</p>								
						</div><!-- /participante-panel header -->
						<div class="data">
							<ul class="list-group">
                            @foreach ($asignados as $asig) 
                                <li class="list-group-item">
                                    <a href="#">{{ $asig->usuario->name }}</a>
                                    @if (Auth::user()->isAdmin() || $proyecto->esDP(Auth::user()))
                                        {{Form::open(array('action'=>array('AsignadoController@destroy', $proyecto->idproyecto, $asig->idasignado),'method'=>'delete', 'class'=>'inline-block pull-right'))}}
                                         {{Form::token()}} 
                                            <button type="submit" class="pull-right btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Quitar"><i class="fa fa-minus "></i></button>
                                        {{Form::Close()}}
                                    @endif                                                                        
                                    <span class="badge bg-warning">{{ $asig->nombre_rol }}</span>                              
                                </li>                                
                            @endforeach                                
                            </ul>			
						</div>						
					</div>		   	 			
        		</div>
        	</div>   	 		
       	</div>       			    
    </div>
    <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}" class="btn btn-warning pull-left"><i class="fa fa-chevron-left"></i> Regresar</a>
@endsection