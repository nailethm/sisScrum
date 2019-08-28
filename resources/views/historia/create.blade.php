@extends('layouts.admin')
@section('contenido')
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Nuevo Proyecto</h3>
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

            {!!Form::open(array('url'=>'proyecto','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombreProyecto" placeholder="">
            </div>
            <div class="form-group">
                <label for="descripcionProyecto">Descripción</label>
                <textarea class="form-control" rows="3" name="descripcion"></textarea>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="start_project">Inicio</label>
                        <input type="text" name="inicio_proyecto" class="form-control" id="start_project" placeholder="Inicio del Proyecto">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="end_project">Fin</label>
                        <input type="text" name="fin_proyecto" class="form-control" id="end_project" placeholder="">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
            {!!Form::close()!!}    	                
    	</div>
    </div>
@stop