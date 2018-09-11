<?php 
	if( $this->input->post('is_submitted') ) {
		$firstName			= set_value('firstName');
		$lastName			= set_value('lastName');
		$telephone			= set_value('telephone');
		$dni				= set_value('dni');
	} else {
		$firstName			= '';
		$lastName			= '';
		$telephone			= '';
		$dni				= '';
	}
?>
<div class="row">
	<form class="col-12 col-xl-5" action="" method="post">
		<?php if( isset($errors) ): ?>
			<div class="alert alert-danger text-left">
				<?php print_r($errors); ?>
			</div>
		<?php endif ?>
		<div class="form-group">
			<label for="firstName">Nombres</label> 
			<input id="firstName" name="firstName" value="<?= $firstName ?>" type="text" required="required" class="form-control here">
		</div>
		<div class="form-group">
			<label for="lastName">Apellidos</label> 
			<input id="lastName" name="lastName" value="<?= $lastName ?>" type="text" required="required" class="form-control here">
		</div>
		<div class="form-group">
			<label for="telephone">Teléfono</label> 
			<input id="telephone" name="telephone" value="<?= $telephone ?>" type="text" required="required" class="form-control here">
		</div>
		<div class="form-group">
			<label for="dni">DNI</label> 
			<input id="dni" name="dni" value="<?= $dni ?>" type="text" required="required" class="form-control here">
		</div>
		<div class="form-group">
			<input type="hidden" name="is_submitted" value="1">
			<button type="submit" class="btn btn-primary">Registrar</button>
			<a class="btn btn-cancel" href="<?= base_url( '/admin/ubicaciones' ) ?>">Cancelar</a>
		</div>
	</form>
</div>