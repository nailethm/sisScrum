@extends('layouts.admin')

@section('contenido')
	<h2>> Administrar Reportes</h2>
	<hr>
	<div class="row mb">
        <div class="col-md-6 col-sm-6">
            <div class="box1">
                <i class="fa fa-dashboard"></i>
                <h3>PROYECTOS</h3>
            </div>
            <div class="centered">

				<h4>REPORTE</h4>
				<div class="form-group">
					<input type="hidden" name="idproyecto" class="form-control" value="">
					<input type="hidden" name="idusuario" class="form-control" value="">
					<label for="preport">Filtrar por:</label>
					<select class="form-control" name="usuario-reporte" id="preport">
	                	<option default >Elegir opción</option>
	                	<option value="p1">Por usuario</option>
	                	<option value="p2">Por proyecto</option>
	                	<option value="p3">Por mes</option>
	                	<option value="p4">Por año</option>                                                      
	                </select>	                
				</div>
				<div class="rbox1 p3">
					<div class="form-group">
						<label for="preport-m">Seleccione el mes:</label>
						<select class="form-control" name="preport-m">
		                	<option default >Elegir mes</option>
		                	<option value="1">Enero</option>
		                	<option value="2">Febrero</option>
		                	<option value="3">Marzo</option>
		                	<option value="4">Abril</option>                                                      
		                </select>	
					</div>                	
                </div>
                <div class="rbox1 p4">
					<div class="form-group">
						<label for="preport-y">Seleccione el mes:</label>
						<select class="form-control" name="preport-y">
		                	<option default >Elegir año</option>
		                	<!-- <option value="1">2015</option>
		                	<option value="2">2016</option>
		                	<option value="3">2017</option> -->
		                	<option value="4">2018</option>                                                      
		                </select>	
					</div>                	
                </div>
				<button type="submit" class="btn btn-success">Ver</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Borrar</button>				
			</div>    
        </div>
        <div class="col-md-6 col-sm-6">
        	{{Form::open(array('action'=>array('PdfController@reporteUsuarios'),'method'=>'post'))}}
			{{Form::token()}}
            <div class="box1">
                <i class="fa fa-users"></i>
                <h3>USUARIOS</h3></a>
            </div>
			<div class="centered">

				<h4>REPORTE</h4>
				<div class="form-group">
					<input type="hidden" name="idproyecto" class="form-control" value="">
					<input type="hidden" name="idusuario" class="form-control" value="">
					<label for="ureport">Filtrar por:</label>
					<select class="form-control" name="ureport" id="ureport">
	                	<option default >Elegir opción</option>
	                	<option value="u1">Por usuario</option>
	                	<option value="u2">Por proyecto</option>
	                	<option value="u3">Por mes</option>
	                	<option value="u4">Por año</option>                                                      
	                </select>	                
				</div>
				<div class="rbox2 u3">
					<div class="form-group">
						<label for="ureport-m">Seleccione el mes:</label>
						<select class="form-control" name="ureport-m">
		                	<option default >Elegir mes</option>
		                	<option value="1">Enero</option>
		                	<option value="2">Febrero</option>
		                	<option value="3">Marzo</option>
		                	<option value="4">Abril</option>                                                      
		                </select>	
					</div>                	
                </div>
                <div class="rbox2 u4">
					<div class="form-group">
						<label for="ureport-y">Seleccione el año:</label>
						<select class="form-control" name="ureport-y">
		                	<!-- <option default >Elegir año</option>
		                	<option value="1">2015</option>
		                	<option value="2">2016</option>
		                	<option value="3">2017</option> -->
		                	<option value="4">2018</option>                                                      
		                </select>	
					</div>                	
                </div>
				<button type="submit" class="btn btn-success">Ver</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Borrar</button>				
			</div>
			{{Form::Close()}}                
        </div>                                
        <div class="col-md-3 col-sm-3">
                
        </div>
        <div class="col-md-3 col-sm-3">
                
        </div>
    </div>       
@endsection