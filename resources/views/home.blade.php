@extends('layouts.admin')

@section('home-selected', 'active')

@section('contenido')
<div class="panel panel-info main-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Bienvenido: {{ Auth::user()->name }}</h3>
    </div>
    <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i> Mis proyectos</h4>
        <div class="table-responsive">          
            <table class="table table-hover">
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
                            <td>{{ $proy->proyecto->inicio_proyecto}}</td>
                            <td>{{ $proy->proyecto->fin_proyecto}}</td>
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
    <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i> Mis tareas</h4>
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
</div>
@endsection