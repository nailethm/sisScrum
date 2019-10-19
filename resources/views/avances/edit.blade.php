@extends('layouts.admin')
@section('contenido')
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Editar comentario: <strong></strong></h3>
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

            {!!Form::open(array('action'=>array('TareaController@update', $proyecto->idproyecto,$historia->idhistoria,$tarea->idtarea,$avance->idavance_tarea),'method'=>'patch'))!!}
            {{Form::token()}}
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="comentario">¿Qué hiciste?</label>
                            <textarea class="form-control" rows="3" name="comentario">{{ $avance->comentario }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="htrabajada">¿Cuántas horas?</label>
                            <input type="text" name="htrabajada" class="form-control"  placeholder="" value="{{ $avance->htrabajada }}">
                        </div>
                    </div>                    
                </div>
                
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>                
            {!!Form::close()!!}    	                
                
    	</div>
    </div>
@stop