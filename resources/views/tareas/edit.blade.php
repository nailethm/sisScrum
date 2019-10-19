@extends('layouts.admin')
@section('contenido')
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Editar Historia: <strong>{{$historia->idhistoria}}</strong></h3>
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

            {!!Form::open(array('action'=>array('TareaController@update', $proyecto->idproyecto,$historia->idhistoria,$tarea->idtarea),'method'=>'patch'))!!}
            {{Form::token()}}
                <div class="form-group">
                    <label for="titulo">Titulo tarea</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Tarea"value="{{$tarea->titulo}}">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="testimado">Duración (en horas)</label>
                            <input type="text" name="testimado" class="form-control"  placeholder="Duración tarea" value="{{$tarea->testimado}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="idusuario">Asignado a:</label>
                            <select class="form-control" name="idusuario">
                                <option value="1" @if('1'==$tarea->idusuario) selected @endif>Tatiana</option>
                                <option value="2" @if('2'==$tarea->idusuario) selected @endif>Diego</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="descripcion">Notas</label>
                    <textarea class="form-control" rows="3" name="descripcion">{{$tarea->descripcion}}</textarea>
                </div>
                                             
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
            {!!Form::close()!!}    	                
                
    	</div>
    </div>
@stop