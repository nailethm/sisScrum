@extends('layouts.admin')
@section('contenido')
    <h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>
	<div class="panel panel-info">        
    	<div class="panel-heading">
    	    <h3 class="panel-title">Registra tu avance en la tarea</h3>
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
            {!!Form::open(array('action'=>array('AvanceTareaController@store', $proyecto->idproyecto, $tarea->idtarea),'method'=>'post'))!!}
            {{Form::token()}}
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="comentario">¿Qué hiciste?</label>
                            <textarea class="form-control" rows="3" name="comentario">{{ old('comentario') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="htrabajada">¿Cuántas horas?</label>
                            <input type="text" name="htrabajada" class="form-control"  placeholder="" value="{{ old('htrabajada') }}">
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