<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-{{$historia->idhistoria}}">
	{!!Form::open(array('action'=>array('BacklogController@store', $proyecto->idproyecto, $sprint->idsprint),'method'=>'post'))!!}
	{{Form::token()}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>					
				</button>
				<h4 class="modal-title">Agregar Historia</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idhistoria" class="form-control" value="{{$historia->idhistoria}}">        		
				<p>Confirme si desea agregar ésta historia al Sprint</p>
			</div>
			<div class="modal-footer">
				
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{!!Form::close()!!} 
</div>