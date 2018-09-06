 <?php 
	if( $this->input->post('is_submitted') ) {
		$fechaVisita	= set_value('fechaVisita');
	} else {
		$fechaVisita			= '';
	}
?>
<?php if( isset($errors) ): ?>
	<div class="alert alert-danger text-left">
		<?php print_r($errors); ?>
	</div>
<?php endif ?>
<?php if ( isset( $beneficiario ) ): ?>
	<div class="pt-2">
		<div class="row">
			<?=	form_open('ubicaciones/seleccionar/'.$ubicacion['slug'],['class'=>'col-12 col-xl-5']) ?>
				<div class="form-group">
					<label for="fullName">Nombre</label> 
					<input id="fullName" value="<?= $beneficiario['fullName'] ?>" type="text" required="required" disabled class="form-control">
				</div>
				<div class="form-group">
					<label for="telephone">Teléfono</label> 
					<input id="telephone" value="<?= $beneficiario['telephone'] ?>" type="text" required="required" disabled class="form-control">
				</div>
				<div class="form-group">
					<label for="dni">DNI</label> 
					<input id="dni" value="<?= $beneficiario['dni'] ?>" type="text" required="required" disabled class="form-control">
				</div>
				<div class="form-group" id="fechaVisita">
					<label for="fechaVisita">Fecha de visita</label> 
					<div class="input-group date">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<input value="<?= $fechaVisita ?>" name="fechaVisita" type="text" required="required" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="is_submitted" value="1">
					<input type="hidden" name="beneficiario_id" value="<?= $beneficiario['id'] ?>">
					<button name="submit" type="submit" class="btn btn-primary">Asignar</button>
					<a class="btn btn-cancel" href="<?= base_url( '/ubicaciones' ) ?>">Cancelar</a>
				</div>
			</form>
		</div>
	</div>
<?php endif ?>
