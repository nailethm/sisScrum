@extends('layouts.admin')
@section('contenido')
    <h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>
	<div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><span>{{$sprint->titulo}}</span> - Historias</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <h5>Duración Sprint</h5>
                    <p>2 semanas</p>
                </div>
                <div class="col-md-4">
                    <h5>Descripción</h5>
                    <p>{{$sprint->nota}}</p>
                </div>
                <div class="col-md-2">
                    <h5>Avance</h5>
                    <h1 class="large-label">{{$sprint->porcentaje_sprint}}%</h1>
                </div>
                <div class="col-md-3">                
                    <a href="{{URL::action('SprintController@Chartjs',[$proyecto->idproyecto,$sprint->idsprint])}}" class="btn btn-default btn-lg btn-block"><i class="fa fa-line-chart"></i><br><span>DIAGRAMA BURN DOWN</span></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h3 class="centered">Pila del Sprint</h3>
                </div>
                <div class="col-md-4"></div>
            </div>
            @foreach ($selecHistorias as $key => $selecHistoria)
            <div class="panel panel-noborders">                
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">                
                            <h3 class="panel-title"><a href="{{URL::action('HistoriaController@show',[$proyecto->idproyecto,$selecHistoria->idhistoria])}}">
                                <span id="obtenerId">H{{ $key+1 }}</span>. Como <span>{{ $selecHistoria->actor }}</span> necesito <span>{{ $selecHistoria->requerimiento }}</span> así podré <span>{{ $selecHistoria->funcionalidad }}</span></a>
                            </h3>
                        </div>
                        <div class="col-md-2">
                            <div class="story-state">{{ $selecHistoria->nombre_estado_historia }}</div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered"> 
                        <thead> 
                            <tr> 
                                <th>#</th> 
                                <th>Tarea</th> 
                                <th width="12%">Asignado a</th> 
                                <th width="10%">Dificultad <span>1 a 5</span></th>
                                <th width="30%">Estado</th>                                                
                                <th width="15%"><i class="fa fa-cogs"></i> Opciones</th> 
                            </tr> 
                        </thead> 
                        <tbody>
                            @foreach ($selecHistoria->tareas()->where('estado','<>','0')->get() as $key2 => $tarea) 
                            <tr> 
                                <td>{{ $key2+1 }}</td>   
                                <td><a href="{{URL::action('AvanceTareaController@index',[$proyecto->idproyecto,$tarea->idtarea])}}">{{ $tarea->titulo }}</a></td>                                              
                                <td>{{ $tarea->idusuario }}</td>
                                <td>{{ $tarea->dificultad }}</td>                        
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$tarea->porcentaje_tarea}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tarea->porcentaje_tarea}}%;">{{$tarea->porcentaje_tarea}}%</div>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{URL::action('AvanceTareaController@index',[$proyecto->idproyecto,$tarea->idtarea])}}" class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-search"></i></a>
                                    @if (Auth::user()->isAdmin() || $proyecto->esSM(Auth::user()))
                                        <a href="{{URL::action('TareaController@edit',[$proyecto->idproyecto,$selecHistoria->idhistoria,$tarea->idtarea])}}" class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
                                        <a href="" data-target="#modal-delete-{{ $tarea->idtarea }}" data-toggle="modal" class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></a>
                                    @endif
                                </td> 
                            </tr>
                            @endforeach
                        </tbody> 
                    </table>
                </div>                                    
            </div>                                    
            @endforeach

            @if ($sprint->estado == '1')
            <div class="select-story">                
                <div class="panel panel-borders">
                    <div class="panel-heading">
                        <h4 class="panel-title">Pila del Producto</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead> 
                                    <tr>
                                        <th width="7%"></th> 
                                        <th width="2%">#</th> 
                                        <th width="9%">como...</th> 
                                        <th width="26%">necesito...</th> 
                                        <th width="25%">así podré...</th>
                                        <th width="23%">Nota</th>
                                        <th width="8%">Prioridad</th> 
                                    </tr> 
                                </thead>
                                <tbody>
                                @foreach ($historias as $key => $historia) 
                                    <tr>
                                        <td>
                                            <a href="" data-target="#modal-add-{{ $historia->idhistoria}}" data-toggle="modal" class="btn btn-warning btn-xs tooltips" data-placement="top" data-original-title="Agregar"><i class="fa fa-plus "></i></a>    
                                        </td>
                                        <td>{{ $key+1 }}</td>   
                                        <td>{{ $historia->actor }}</td>                                             
                                        <td>{{ $historia->requerimiento }}</td>
                                        <td>{{ $historia->funcionalidad }}</td>
                                        <td>{{ $historia->notas }}</td>
                                        <td>{{ $historia->prioridad }}</td>                                    
                                    </tr>
                                    @include('backlog.modal')                                   
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>                                    
                </div>
                {!!Form::close()!!}    
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                <!-- Actualizamos Estado de Sprint a En curso (2) -->
                {!!Form::open(array('action'=>array('SprintController@update', $sprint->idproyecto,$sprint->idsprint),'method'=>'patch'))!!}
                {{Form::token()}}
                    <input type="hidden" name="estado" class="form-control" value="2">
                    <button type="submit" class="btn btn-success btn-lg btn-block mb mt">Terminar</button>                    
                {!!Form::close()!!} 
                </div>
                <div class="col-md-4"></div>
            </div>
            @endif
                                                                                 
        </div>        
    </div>
    <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}" class="btn btn-warning pull-left"><i class="fa fa-chevron-left"></i> Regresar</a>
@stop