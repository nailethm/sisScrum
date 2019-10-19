@extends('layouts.admin')
@section('contenido')
    <h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>
	<div class="panel panel-info">        
    	<div class="panel-heading">
    	    <h3 class="panel-title">Nueva Historia</h3>
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
            {!!Form::open(array('action'=>array('TareaController@store', $proyecto->idproyecto, $historia->idhistoria),'method'=>'post'))!!}
            {{Form::token()}}

                <div class="form-group">
                    <label for="titulo">Titulo tarea</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Tarea">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="testimado">Duración (en horas)</label>
                            <input type="text" name="testimado" class="form-control"  placeholder="Duración tarea">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dificultad">Dificultad (1 a 5)</label>
                            <input type="text" name="dificultad" class="form-control"  placeholder="Dificultad tarea">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="idusuario">Asignado a:</label>
                            <select class="form-control" name="idusuario">
                                @foreach ($programadores as $programador)
                                <option value="{{ $programador->idusuario }}">{{ $programador->usuario->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="descripcion">Notas</label>
                    <textarea class="form-control" rows="3" name="descripcion"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <a href="{{URL::previous()}}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Regresar</a>
            {!!Form::close()!!}    	                
    	</div>
    </div>
    
@stop