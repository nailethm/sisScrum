@extends('layouts.admin')
@section('proyecto-selected', 'active')
@section('contenido')
	<div class="row">
		<div class="col-md-10">
			<h2>> Proyecto: <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}"><strong class="text-uppercase">{{$proyecto->nombre}}</strong></a></h2>
		</div>
		<div class="col-md-2">
			@if (Auth::user()->isAdmin() || $proyecto->esDP(Auth::user()))			
				<a href="{{URL::action('HistoriaController@create', $proyecto->idproyecto)}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Agregar Historia</a>
			@endif
		</div>
	</div>
	
	<div class="panel panel-info main-panel">
        <div class="panel-heading">
            <h3 class="panel-title">Pila del Producto</h3>
            <div class="small-tools">
            	<ul>            		
            		<li>
		            	<a target="_blank" href="{{URL::action('PdfController@reportePilaProducto', $proyecto->idproyecto)}}" class="btn btn-default btn-xs tooltips pull-right" data-placement="bottom" data-original-title="Imprimir"><i class="fa fa-print"></i></a>	
            		</li>
            	</ul>
            </div> 
        </div>        
        <div class="table-responsive">
			<table class="table table-bordered">
	            <thead> 
	                <tr>	                	 
	                    <th width="3%">#</th> 
	                    <th width="9%">como...</th> 
	                    <th width="23%">necesito...</th> 
	                    <th width="23%">así podré...</th>
	                    <th width="15%">Nota</th>
	                    <th width="9%">Prioridad</th>	                    
	                    <th width="11%">Opciones</th> 
	                </tr> 
	            </thead>
	            <tbody>
	            @foreach ($historias as $key => $historia) 
		            <tr>		            	
		            	<td>{{ $key+1 }}</td>	
		                <td>{{ $historia->actor }}</td>		                		                
		                <td>{{ $historia->requerimiento }}</td>
		                <td>{{ $historia->funcionalidad }}</td>
		                <td>{{ $historia->notas }}</td>
		                <td>{{ $historia->prioridad }}</td>		                
		                <td>
		                	@if (Auth::user()->isAdmin() || $proyecto->esDP(Auth::user()))
	                    	<a href="{{URL::action('HistoriaController@edit',[$proyecto->idproyecto,$historia->idhistoria])}}" class="btn btn-primary btn-xs tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
	                    	<a href="" data-target="#modal-delete-{{ $historia->idhistoria }}" data-toggle="modal" class="btn btn-danger btn-xs tooltips" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash-o "></i></a>
	                    	@endif
	                    	<a href="{{URL::action('HistoriaController@show',[$proyecto->idproyecto,$historia->idhistoria])}}" class="btn btn-warning btn-xs tooltips" data-placement="top" data-original-title="Mas"><i class="fa fa-plus"></i></a>	
	                    </td>
		            </tr>
		        	@include('historias.modal')   
		        @endforeach
	            </tbody>
	        </table>
	    </div>
	    {{$historias->render()}}   
    </div>
    <a href="{{URL::action('ProyectoController@show', $proyecto->idproyecto)}}" class="btn btn-warning pull-left"><i class="fa fa-chevron-left"></i> Regresar</a>
@endsection