@extends('layouts.admin')
@section('proyecto-selected', 'active')
@section('contenido')
	<h2>> Proyecto: <strong class="text-uppercase">{{ $proyecto->nombre }}</strong></h2>
    <hr>
    <div class="btn-group btn-group-justified">
        <div class="btn-group">
            <a href="{{URL::action('AsignadoController@index',$proyecto->idproyecto)}}" class="btn btn-default btn-lg btn-block"><i class="fa fa-users"></i> Equipo</a>
        </div>
        <div class="btn-group">
            <a href="{{URL::action('BacklogController@index',$proyecto->idproyecto)}}" class="btn btn-default btn-lg btn-block"><i class="fa fa-list"></i> Pila Producto</a>    
        </div>
        <div class="btn-group">
            <a href="{{URL::action('SprintController@index',$proyecto->idproyecto)}}" class="btn btn-default btn-lg btn-block"><i class="fa fa-tasks"></i> Sprints</a>    
        </div>
        <!-- <div class="btn-group">
            <a href="#" class="btn btn-default btn-lg btn-block"><i class="fa fa-calendar"></i> Reuniones</a>    
        </div>
        <div class="btn-group">
            <a href="#" class="btn btn-default btn-lg btn-block"><i class="fa fa-archive"></i> Entregables</a>    
        </div> -->        
    </div>                
	<div class="panel panel-info board-box">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Tablón de Historias del Sprint Actual - <span>{{ $sprintActual<>null ? $sprintActual->titulo : '' }}</span></h3>
    	</div>
    	<div class="panel-body">
            <div class="row">                
                <div class="col-md-4">
                    <p><b>Sprint Actual:</b><br/> {{ $sprintActual<>null ? $sprintActual->titulo : '' }}</p>
                </div>
                <div class="col-md-5">
                    <p><b>Estado Actual:</b><br/> {{ $sprintActual<>null ? $sprintActual->estado : '' }}</p>
                </div>
                @if( $sprintActual<>null)
                <div class="col-md-3">
                    <a href="{{URL::action('SprintController@Chartjs',[$proyecto->idproyecto,$sprintActual->idsprint])}}" class="btn btn-default btn-lg btn-block"><i class="fa fa-line-chart"></i><br><span>DIAGRAMA BURN DOWN</span></a>
                </div>
                @endif
            </div>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th width="33.3%">Pendientes</th>
                        <th width="33.3%">En Progreso</th>
                        <th width="33.3%">Terminadas</th>
                    </tr>
                </thead>
                <tbody>
                  
                    <tr>
                        <td>
                            @if($historiasProgreso == null || $historiasPendientes->count() == 0)
                                <p class="text-center">No hay historias pendientes</p>
                            @else
                                @foreach ($historiasPendientes as $historiaP) 
                                <div class="panel story-box">
                                    <div class="panel-body">
                                        <a href="{{URL::action('HistoriaController@show',[$proyecto->idproyecto,$historiaP->idhistoria])}}" class="text-center"><strong>H<span>{{ $historiaP->idhistoria }}</span></strong>  Como <span>{{ $historiaP->actor }}</span> necesito <span>{{ $historiaP->requerimiento }}</span> así podré <span>{{ $historiaP->funcionalidad }}</span></a>
                                    </div>                                
                                </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($historiasProgreso == null || $historiasProgreso->count() == 0)
                                <p class="text-center">No hay historias en progreso</p>
                            @else
                                @foreach ($historiasProgreso as $historiaPr) 
                                <div class="panel story-box">
                                    <div class="panel-body">
                                        <a href="{{URL::action('HistoriaController@show',[$proyecto->idproyecto,$historiaPr->idhistoria])}}" class="text-center"><strong>H<span>{{ $historiaPr->idhistoria }}</span></strong>  Como <span>{{ $historiaPr->actor }}</span> necesito <span>{{ $historiaPr->requerimiento }}</span> así podré <span>{{ $historiaPr->funcionalidad }}</span></a>
                                    </div>                                
                                </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($historiasTerminadas == null || $historiasTerminadas->count() == 0)
                                <p class="text-center">No hay historias en Terminadas</p>
                            @else
                                @foreach ($historiasTerminadas as $historiaT) 
                                <div class="panel story-box">
                                    <div class="panel-body">
                                        <a href="{{URL::action('HistoriaController@show',[$proyecto->idproyecto,$historiaT->idhistoria])}}" class="text-center"><strong>H<span>{{ $historiaT->idhistoria }}</span></strong>  Como <span>{{ $historiaT->actor }}</span> necesito <span>{{ $historiaT->requerimiento }}</span> así podré <span>{{ $historiaT->funcionalidad }}</span></a>
                                    </div>                                
                                </div>
                                @endforeach
                            @endif
                        </td>                                              
                    </tr>
                </tbody>
            </table>
    	</div>
    </div>
@stop