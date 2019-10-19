@extends('layouts.admin')

@section('tarea-selected', 'active')

@section('contenido')
<div class="panel panel-info main-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Mis tareas</h3>
    </div>    
    <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i> Tareas en progreso</h4>
        <div class="table-responsive">          
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="25%">Proyecto</th>
                        <th width="25%"><i class="fa fa-pencil-square-o"></i> Tarea</th>
                        <th width="25%"><i class="fa fa-question-circle"></i> Estado</th>
                        <th width="12%"><i class=" fa fa-time"></i> Tiempo Estimado</th>                        
                        <th width="15%"><i class="fa fa-cogs"></i> Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($misTareasProgreso as $tareaP)
                    <tr>
                        <td><a href="{{URL::action('ProyectoController@show', $tareaP->historia->backlog->proyecto->idproyecto)}}">{{ $tareaP->historia->backlog->proyecto->nombre }}</td>
                        <td><a href="{{URL::action('AvanceTareaController@index',[$tareaP->historia->backlog->proyecto->idproyecto,$tareaP->idtarea])}}">{{ $tareaP->titulo }}</a></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$tareaP->porcentaje_tarea}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tareaP->porcentaje_tarea}}%;">{{$tareaP->porcentaje_tarea}}%</div>
                            </div>
                        </td>
                        <td>{{ $tareaP->testimado }}</td>
                        <td>
                            <a href="{{URL::action('AvanceTareaController@index',[$tareaP->historia->backlog->proyecto->idproyecto,$tareaP->idtarea])}}" class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-search"></i></a>    
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$misTareasProgreso->render()}}                     
    </div>
    <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i> Tareas terminadas</h4>
        <div class="table-responsive">          
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="25%">Proyecto</th>
                        <th width="25%"><i class="fa fa-pencil-square-o"></i> Tarea</th>
                        <th width="25%"><i class="fa fa-question-circle"></i> Estado</th>
                        <th width="12%"><i class=" fa fa-time"></i> Tiempo Estimado</th>                        
                        <th width="15%"><i class="fa fa-cogs"></i> Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($misTareasTerminadas as $tareaT)
                    <tr>
                        <td><a href="{{URL::action('ProyectoController@show', $tareaT->historia->backlog->proyecto->idproyecto)}}">{{ $tareaT->historia->backlog->proyecto->nombre }}</td>
                        <td><a href="{{URL::action('AvanceTareaController@index',[$tareaT->historia->backlog->proyecto->idproyecto,$tareaT->idtarea])}}">{{ $tareaT->titulo }}</a></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$tareaT->porcentaje_tarea}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tareaT->porcentaje_tarea}}%;">{{$tareaT->porcentaje_tarea}}%</div>
                            </div>
                        </td>
                        <td>{{ $tareaT->testimado }}</td>
                        <td>
                            <a href="{{URL::action('AvanceTareaController@index',[$tareaT->historia->backlog->proyecto->idproyecto,$tareaT->idtarea])}}" class="btn btn-info btn-xs tooltips" data-placement="top" data-original-title="Más"><i class="fa fa-search"></i></a>    
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$misTareasTerminadas->render()}}                     
    </div>    
</div>
@endsection