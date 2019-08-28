@extends('layouts.admin')
@section('contenido')
	<div class="panel panel-info">
    	<div class="panel-heading">
    	    <h3 class="panel-title">Proyecto: <strong class="text-uppercase">{{$proyecto->nombre}}</strong></h3>
    	</div>
    	<div class="panel-body">
            <h3>{{$proyecto->nombre}}</h3>    	                
                
    	</div>
    </div>
@stop