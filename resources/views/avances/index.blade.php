@extends('layouts.admin')
@section('proyecto-selected', 'active')
@section('contenido')
	<div class="row">
		<div class="col-md-10">
			<h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>
		</div>
		<div class="col-md-2">
            @if (Auth::user()->isAdmin() || $proyecto->esSM(Auth::user()) || $tarea->estaAT(Auth::user()))
			    <a href="{{URL::action('AvanceTareaController@create', [$proyecto->idproyecto,$tarea->idtarea])}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Registra tu avance</a>
            @endif
		</div>
	</div>
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Avances de la tarea</strong></h3>
    	</div>
    	<div class="panel-body">
            <div class="panel task-box center-block">
                <div class="panel-body">
	                <div class="task-header">
	                    <h3 class="text-center"><strong>T<span>{{$tarea->idtarea}}</span></strong> {{$tarea->titulo}}</h3>
	                </div>
                    <p><strong>Notas:</strong> {{$tarea->descripcion}}</p>
                </div>
                <div class="panel-footer">
                    <div class="row">
                    	<div class="col-md-3"><h4><i>Tiempo Estimado:</i> <br/><strong>{{$tarea->testimado}}</strong></h4></div>
                        <div class="col-md-4"><h4><i>Tiempo Real:</i> <br/><strong>{{$tarea->total_horas_trabajadas}}</strong></h4></div>
                        <div class="col-md-5"><h4><i>Completado:</i><br/><span class="percent">{{$tarea->porcentaje_tarea}}%</span></h4></div>
                    </div>
                </div>
            </div>
            <hr>
            <table class="table table-striped table-advance table-hover"> 
                <thead> 
                    <tr>                          
                        <th width="10%">Fecha</th> 
                        <th>Comentario</th>                         
                        <th width="15%">Hr Trabajadas <span>En Hr</span></th>
                        <th width="12%"><i class="fa fa-cogs"></i> Opciones</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    @foreach ($avances as $key => $avance) 
                    <tr>   
                        <td>{{ $avance->fecha }}</td>                                              
                        <td class="goleft">{{ $avance->comentario }}</td>
                        <td>{{ $avance->htrabajada }}</td>
                        <td>
                            @if ($tarea->estaAT(Auth::user()))
                                <a href="{{URL::action('AvanceTareaController@edit',[$proyecto->idproyecto,$tarea->idtarea,$avance->idavance_tarea])}}" class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
                                {{Form::open(array('action'=>array('AvanceTareaController@destroy', $proyecto->idproyecto,$tarea->idtarea,$avance->idavance_tarea),'method'=>'delete', 'class'=>'inline-block pull-right'))}}
                                 {{Form::token()}} 
                                    <button type="submit" class="pull-right btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></button>
                                {{Form::Close()}}
                            @endif                            
                        </td>
                    </tr>                       
                    @endforeach                     
                </tbody> 
            </table>          
        </div>
    </div>
    <a href="{{URL::previous()}}" class="btn btn-warning pull-left"><i class="fa fa-chevron-left"></i> Regresar</a>
@endsection