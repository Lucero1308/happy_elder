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
				<input id="inputFirstName" disabled value="<?= $inputFirstName ?>" type="text" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="inputLastName">Apellidos</label> 
				<input id="inputLastName" disabled value="<?= $inputLastName ?>" type="text" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="inputTelephone">Teléfono</label> 
				<input id="inputTelephone" data-minlength="7" data-minlength-error="CAMBIAR TEXTO" data-required-error="CAMBIAR TEXTO" name="telephone" value="<?= $inputTelephone ?>" type="number" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="inputUserName">Correo (usuario)</label> 
				<input id="inputUserName" data-pattern-error="CAMBIAR TEXTO" data-required-error="CAMBIAR TEXTO" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="userName" value="<?= $inputUserName ?>" type="email" class="form-control" required="required">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="inputPassword">Contraseña</label> 
				<input id="inputPassword" data-minlength="7" data-minlength-error="CAMBIAR TEXTO" name="password" value="<?= $inputPassword ?>" type="password" class="form-control">
				<div class="help-block with-errors"	></div>
			</div> 
			<div class="form-group">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>
	</div>
</div>
