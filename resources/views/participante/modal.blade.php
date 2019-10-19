<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-{{$noasig->id}}">
	{!!Form::open(array('action'=>array('AsignadoController@store', $proyecto->idproyecto),'method'=>'post'))!!}
	{{Form::token()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>					
				</button>
				<h4 class="modal-title">Agregar usuario</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idproyecto" class="form-control" value="{{$proyecto->idproyecto}}">
				<input type="hidden" name="idusuario" class="form-control" value="{{$noasig->id}}">
				<label for="rol"></label>
				<select class="form-control" name="rol">
                	<option value="SM">Scrum Master</option>
                	<option value="DP">Dueño Producto</option>
                	<option value="De">Desarrollador</option>                                                      
                </select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{!!Form::close()!!} 
</div>