 <?php 
	if( $this->input->post('is_submitted') ) {
		$visitanteFecha	= set_value('visitanteFecha');
	} else {
		$visitanteFecha			= '';
	}
?>
<?php if( isset($errors) ): ?>
	<div class="alert alert-danger text-left">
		<?php print_r($errors); ?>
	</div>
<?php endif ?>
<?php if ( isset( $servicio ) ): ?>
	<div class="pt-2">
		<div class="row">
			<?=	form_open('servicios/reservar/'.$servicio['slug'],['class'=>'col-12 col-xl-5']) ?>
				<div class="form-group">
					<label for="nombreServicio">Servicio</label> 
					<input id="nombreServicio" value="<?= $servicio['name'] ?>" type="text" required="required" disabled class="form-control">
				</div>
				<div class="form-group">
					<label for="horarioServicio">Horario</label> 
					<input id="horarioServicio" value="<?= $servicio['schedule'] ?>" type="text" required="required" disabled class="form-control">
				</div>
				<div class="form-group">
					<label for="precioServicio">Precio</label> 
					<input id="precioServicio" value="<?= $servicio['price'] ?>" type="text" required="required" disabled class="form-control">
				</div>
				<div class="form-group" id="visitanteFecha">
					<label for="visitanteFecha">Fecha de servicio</label> 
					<div class="input-group date">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input value="<?= $visitanteFecha ?>" name="visitanteFecha" type="text" required="required" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-primary">Reservar</button>
					<a class="btn btn-cancel" href="<?= base_url( '/servicios' ) ?>">Cancelar</a>
				</div>
			</form>
		</div>
	</div>
<?php endif ?>
