<div class="pt-2">
	<?php 
		$photo = '';
		if( $this->input->post('is_submitted') ) {
			$inputFirstName			= $usuario['firstName'];
			$inputLastName			= $usuario['lastName'];
			$inputTelephone			= set_value('telephone');
			$inputUserName			= set_value('userName');
			$inputPassword			= set_value('password');
			$photo		= $usuario['photo'];
		} else {
			$inputFirstName			= $usuario['firstName'];
			$inputLastName			= $usuario['lastName'];
			$inputTelephone			= $usuario['telephone'];
			$inputUserName			= $usuario['userName'];
			$inputPassword			= '';
			$photo		= $usuario['photo'];
		}
	?>
	<div class="row">
		<form class="col-12 col-xl-5" action="" method="post" data-toggle="validator" >
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<div class="form-group">
				<label for="inputFirstName">Nombres</label> 
				<input id="inputFirstName" disabled value="<?= $inputFirstName ?>" type="text" class="form-control" data-required-error="Por favor ingresa tu nombre" placeholder="Ingresa tu nombre" required>
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="inputLastName">Apellidos</label> 
				<input id="inputLastName" disabled value="<?= $inputLastName ?>" type="text" class="form-control" data-required-error="Por favor ingresa un apellido" required="required">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="dateEvent">Foto</label> 
				<?php if ( $photo ): ?>
					<img src="<?= $photo ?>" class="img-fluid mb-4 img-thumbnail rounded mx-auto d-block" width="350">
				<?php endif ?>
			</div>
			<div class="form-group">
				<label for="inputTelephone">Teléfono</label> 
				<input id="inputTelephone" data-required-error="Ingresa un número de contacto" name="telephone" value="<?= $inputTelephone ?>" input pattern=".{7,9}"  data-pattern-error="OJO:La cantidad mínima es de 7 dígitos , y la máxima 9"maxlength="9"  required class="form-control onlyNumbers">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="inputUserName">Correo (usuario)</label> 
				<input id="inputUserName" data-pattern-error="Ingresa un correo válido" data-required-error="Ingresa tu correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="userName" value="<?= $inputUserName ?>" type="email" class="form-control" required="required">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="inputPassword">Contraseña</label> 
				<input id="inputPassword" data-minlength="7" data-minlength-error="OJO:La cantidad mínima con 7 caracteres" name="password" value="<?= $inputPassword ?>" type="password" class="form-control">
				<div class="help-block with-errors"	></div>
			</div> 
			<div class="form-group">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-primary">Actualizar</button>
			</div>
		</form>
	</div>
</div>
