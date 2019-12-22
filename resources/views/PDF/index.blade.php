@extends('layouts.admin')
@section('reportes-selected', 'active')

@section('contenido')
	<h2>> Administrar Reportes</h2>
	<hr>
	
	<div class="row mb">
		<div class="col-md-1 col-sm-1"></div>
        <div class="col-md-4 col-sm-4">
	        {{Form::open(array('action'=>array('PdfController@reporteProyectos'),'method'=>'post', 'target'=>'_blank'))}}
			{{Form::token()}}        	
            <div class="box1">
                <i class="fa fa-folder-open"></i>
                <h3>PROYECTOS</h3>
            </div>
			<div class="centered">
				<h4>REPORTE</h4>
				<div class="form-group">										
	                <label for="preporte">Seleccione el Proyecto</label>
	                <select class="form-control selectpicker" name="preporte" id="preporte" data-live-search="true">
						<option default >Elegir proyecto</option>
	                	@foreach ($proyectos as $proyecto)
                        	<option value="{{ $proyecto->idproyecto }}">{{ $proyecto->nombre}}</option>
                        @endforeach                                                      
	                </select>	                
				</div>
				<div class="rbox1">
					<div class="form-group">
						<label for="preporte-o">Filtrar por:</label>
						<select class="form-control" name="preporte-o">
		                	<option default >Elegir Opción</option>
		                	<option value="p1">Pila Producto</option>
		                	<option value="p2">Pila Sprint</option>
		                	<option value="p3">Tareas</option>
		                	<option value="p4">Avances</option>	                                                    
		                </select>	
					</div>                	
                </div>
				                
				<button type="submit" class="btn btn-success">Ver</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Borrar</button>				
			</div>
			{{Form::Close()}}                
        </div>
        <div class="col-md-2 col-sm-2"></div>
        <div class="col-md-4 col-sm-4">
	        {{Form::open(array('action'=>array('PdfController@reporteUsuarios'),'method'=>'post', 'target'=>'_blank'))}}
			{{Form::token()}}        	
            <div class="box1">
                <i class="fa fa-users"></i>
                <h3>USUARIOS</h3>
            </div>
			<div class="centered">
				<h4>REPORTE</h4>
				<div class="form-group">					
					<label for="ureporte">Filtrar por:</label>
					<select class="form-control" name="ureporte" id="ureporte">
	                	<option default >Elegir opción</option>
	                	<option value="u1">Por usuario</option>
	                	<option value="u2">Por proyecto</option>
	                	<option value="u3">Por mes</option>
	                	<option value="u4">Por año</option>                                                      
	                </select>	                
				</div>
				<div class="rbox2 u1">
					<div class="form-group">
						<label for="ureporte-u">Seleccione el usuario:</label>
						<select class="form-control selectpicker" name="ureporte-u" data-live-search="true">
							<option default >Elegir usuario</option>
		                	@foreach ($usuarios as $usuario)
	                        	<option value="{{ $usuario->id }}">{{ $usuario->name}}</option>
	                        @endforeach                                                      
		                </select>	
					</div>                	
                </div>
				<div class="rbox2 u2">
					<div class="form-group">
						<label for="ureporte-p">Seleccione el proyecto:</label>
						<select class="form-control selectpicker" name="ureporte-p" data-live-search="true">
							<option default >Elegir proyecto</option>
		                	@foreach ($proyectos as $proyecto)
	                        	<option value="{{ $proyecto->idproyecto }}">{{ $proyecto->nombre}}</option>
	                        @endforeach                                                      
		                </select>	
					</div>                	
                </div>
				<div class="rbox2 u3">
					<div class="form-group">
						<label for="ureporte-m">Seleccione el mes:</label>
						<select class="form-control" name="ureporte-m">
		                	<option default >Elegir mes</option>
		                	<option value="1">Enero</option>
		                	<option value="2">Febrero</option>
		                	<option value="3">Marzo</option>
		                	<option value="4">Abril</option>
		                	<option value="5">Mayo</option>
		                	<option value="6">Junio</option>
		                	<option value="7">Julio</option>
		                	<option value="8">Agosto</option>
		                	<option value="9">Septiembre</option>
		                	<option value="10">Octubre</option>
		                	<option value="11">Noviembre</option>
		                	<option value="12">Diciembre</option>                                                      
		                </select>	
					</div>                	
                </div>
                <div class="rbox2 u4">
					<div class="form-group">
						<label for="ureporte-y">Seleccione el año:</label>
						<select class="form-control" name="ureporte-y">
							<option default >Elegir año</option>
		                	@for ($año=$iAño; $año <= $fAño; $año++)
	                        	<option value="{{ $año }}">{{ $año }}</option>
	                        @endfor                                                      
		                </select>	
					</div>                	
                </div>
				<button type="submit" class="btn btn-success">Ver</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Borrar</button>				
			</div>
			{{Form::Close()}}                
        </div>
        <div class="col-md-1 col-sm-1"></div>                                        
    </div>               
@endsection