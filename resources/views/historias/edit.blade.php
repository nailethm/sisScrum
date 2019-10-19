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

            {!!Form::open(array('action'=>array('HistoriaController@update', $proyecto->idproyecto,$historia->idhistoria),'method'=>'patch'))!!}
            {{Form::token()}}
            <div class="form-group">
                <label for="actor">Como...</label>
                <input type="text" name="actor" class="form-control" placeholder="Usuario" value="{{$historia->actor}}">
            </div>
            <div class="form-group">
                <label for="requerimiento">necesito...</label>
                <input type="text" name="requerimiento" class="form-control" placeholder="Requerimiento" value="{{$historia->requerimiento}}">
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="form-group">
                        <label for="funcionalidad">así podré...</label>
                        <input type="text" name="funcionalidad" class="form-control" placeholder="" value="{{$historia->funcionalidad}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="prioridad">Prioridad</label>
                        <select class="form-control" name="prioridad">
                          <option value="alta" @if('alta'==$historia->prioridad) selected @endif >Alta</option>
                          <option value="media" @if('media'==$historia->prioridad) selected @endif >Media</option>
                          <option value="baja" @if('baja'==$historia->prioridad) selected @endif >Baja</option>                                                      
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="notas">Notas</label>
                <textarea class="form-control" rows="3" name="notas">{{$historia->notas}}</textarea>
            </div>                                  
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
            {!!Form::close()!!}    	                
                
    	</div>
    </div>
@stop