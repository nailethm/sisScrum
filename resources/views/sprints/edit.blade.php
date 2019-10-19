@extends('layouts.admin')
@section('contenido')
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Editar Sprint: <strong>{{$sprint->nombre}}</strong></h3>
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

            {!!Form::open(array('action'=>array('SprintController@update', $sprint->idproyecto,$sprint->idsprint),'method'=>'patch'))!!}
            {{Form::token()}}
            <input type="hidden" name="idproy" class="form-control" value="{{$sprint->idproyecto}}">
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" class="form-control" placeholder="" value="{{$sprint->titulo}}">
            </div>
            <div class="form-group">
                <label for="nota">Nota</label>
                <textarea class="form-control" rows="3" name="nota"></textarea>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="start_project">Inicio</label>
                        <input type="text" name="inicio_sprint" class="form-control" id="start_project" placeholder="" value="{{$sprint->inicio_sprint}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="end_project">Fin</label>
                        <input type="text" name="fin_sprint" class="form-control" id="end_project" placeholder="" value="{{$sprint->fin_sprint}}">
                    </div>
                </div>
            </div>           
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
            {!!Form::close()!!}    	                
                
    	</div>
    </div>
@stop