@extends('layouts.admin')
@section('contenido')
    <h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Nuevo Sprint</h3>
    	</div>
    	<div class="panel-body">
            @if (count($errors)>0)                        
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach    
                </ul>    
            </div>
            @endif
            {!!Form::open(array('action'=>array('SprintController@store', $proyecto->idproyecto),'method'=>'post'))!!}
            {{Form::token()}}
            <input type="hidden" name="idproy" class="form-control" value="{{$proyecto->idproyecto}}">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" class="form-control" placeholder="" value="Sprint #">
            </div>
            <div class="form-group">
                <label for="nota">Nota</label>
                <textarea class="form-control" rows="3" name="nota"></textarea>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="start_project">Inicio</label>
                        <input type="text" name="inicio_sprint" class="form-control" id="start_project" placeholder="Inicio del Proyecto">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="end_project">Fin</label>
                        <input type="text" name="fin_sprint" class="form-control" id="end_project" placeholder="">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <a href="{{URL::previous()}}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Regresar</a>
            {!!Form::close()!!}    	                
    	</div>
    </div>
@stop