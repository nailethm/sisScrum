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
            {!!Form::open(array('action'=>array('HistoriaController@store', $proyecto->idproyecto),'method'=>'post'))!!}
            {{Form::token()}}            
                <div class="form-group">
                    <label for="actor">Como...</label>
                    <input type="text" name="actor" class="form-control" placeholder="Usuario">
                </div>
                <div class="form-group">
                    <label for="requerimiento">necesito...</label>
                    <input type="text" name="requerimiento" class="form-control" placeholder="Requerimiento">
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                            <label for="funcionalidad">así podré...</label>
                            <input type="text" name="funcionalidad" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="prioridad">Prioridad</label>
                            <select class="form-control" name="prioridad">
                              <option value="alta">Alta</option>
                              <option value="media">Media</option>
                              <option value="baja">Baja</option>                                                      
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="notas">Notas</label>
                    <textarea class="form-control" rows="3" name="notas"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <a href="{{URL::previous()}}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Regresar</a>
            {!!Form::close()!!}    	                
    	</div>
    </div>    
@stop