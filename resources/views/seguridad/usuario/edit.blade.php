@extends('layouts.admin')
@section('contenido')
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Editar Usuario: <strong>{{$usuario->name}}</strong></h3>
    	</div>
    	<div class="panel-body">
            
            {!!Form::model($usuario,['method'=>'PATCH','route'=>['seguridad.usuario.update',$usuario->id]])!!}
            {{Form::token()}}
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Nombre</label>
                        <input id="name" type="text" class="form-control text-uppercase" name="name" value="{{ old('name', $usuario->name) }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8 {{ $errors->has('CI') ? ' has-error' : '' }}">
                                <label for="CI" class="control-label">Carnet Identidad</label>
                                <input type="numeric" name="CI" class="form-control" placeholder="" value="{{ old('CI',$usuario->CI) }}">
                                {!! $errors->first('CI', '<span class="help-block"><strong>:message</strong></span>') !!}
                            </div>
                            <div class="col-md-4">
                                <label for="issued">Exp.</label>                    
                                <select class="form-control" name="issued">
                                    <option value="SC" @if('SC'==$usuario->issued) selected @endif >SC</option>
                                    <option value="LP" @if('LP'==$usuario->issued) selected @endif >LP</option>
                                    <option value="CB" @if('CB'==$usuario->issued) selected @endif >CB</option>
                                    <option value="CH" @if('CH'==$usuario->issued) selected @endif >CH</option>
                                    <option value="PT" @if('PT'==$usuario->issued) selected @endif >PT</option>
                                    <option value="TR" @if('TR'==$usuario->issued) selected @endif >TR</option>
                                    <option value="OR" @if('OR'==$usuario->issued) selected @endif >OR</option>
                                    <option value="BN" @if('BN'==$usuario->issued) selected @endif >BN</option>
                                    <option value="PN" @if('PN'==$usuario->issued) selected @endif >PN</option>
                                </select>    
                            </div>
                        </div>                        
                    </div>    
                </div> 
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-Mail</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="admin" class="control-label">Administrador</label>
                        <select class="form-control" name="admin">
                            <option value="0" @if('0'==$usuario->admin) selected @endif>No</option>
                            <option value="1" @if('1'==$usuario->admin) selected @endif >Si</option>                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">                        
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Contraseña</label>
                        <input id="password" type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">  
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="control-label">Confirmar contraseña</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>        
            <div class="row">                              
                <div class="col-md-9">
                    <label for="address">Dirección</label>
                    <input type="text" name="address" class="form-control text-uppercase" placeholder="" value="{{ $usuario->address }}">    
                </div>
                <div class="col-md-3">
                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="control-label">Celular</label>
                        <input type="numeric" name="phone" class="form-control" placeholder="" value="{{ $usuario->phone }}">
                        {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}    
                    </div>    
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company">Empresa</label>
                        <input type="text" name="company" class="form-control" placeholder="" value="{{ $usuario->company }}">    
                    </div>    
                </div>
                <div class="col-md-6">
                    <label for="occupation">Cargo</label>
                    <input type="text" name="occupation" class="form-control text-uppercase" placeholder="" value="{{ $usuario->occupation }}">    
                </div>
            </div>
            <p class="pull-right"><i>* Campos requeridos</i></p>
            
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ url('/seguridad/usuario') }}" type="reset" class="btn btn-danger">Cancelar</a>
            {!!Form::close()!!}    	                
                
    	</div>
    </div>
@stop