<div class="pt-2">
	<?php 
		if( $this->input->post('is_submitted') ) {
			$inputFirstName			= $usuario['firstName'];
			$inputLastName			= $usuario['lastName'];
			$inputTelephone			= set_value('telephone');
			$inputUserName			= set_value('userName');
			$inputPassword			= set_value('password');
		} else {
			$inputFirstName			= $usuario['firstName'];
			$inputLastName			= $usuario['lastName'];
			$inputTelephone			= $usuario['telephone'];
			$inputUserName			= $usuario['userName'];
			$inputPassword			= '';
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
				<label for="inputFirstName">Nombres</label> 
				<input id="inputFirstName" disabled value="<?= $inputFirstName ?>" type="text" class="form-control here">
			</div>
			<div class="form-group">
				<label for="inputLastName">Apellidos</label> 
				<input id="inputLastName" disabled value="<?= $inputLastName ?>" type="text" class="form-control here">
			</div>
			<div class="form-group">
				<label for="inputTelephone">Teléfono</label> 
				<input id="inputTelephone" name="telephone" value="<?= $inputTelephone ?>" type="number" required="required" class="form-control here">
			</div>
			<div class="form-group">
				<label for="inputUserName">Correo (usuario)</label> 
				<input id="inputUserName" name="userName" value="<?= $inputUserName ?>" type="email" class="form-control here" required="required">
			</div>
			<div class="form-group">
				<label for="inputPassword">Contraseña</label> 
				<input id="inputPassword" name="password" value="<?= $inputPassword ?>" type="password" class="form-control here">
			</div> 
			<div class="form-group">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>
	</div>
</div>
