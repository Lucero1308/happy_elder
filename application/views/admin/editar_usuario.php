<?php 
	$user_id 				= $usuario['id'];
	if( $this->input->post('is_submitted') ) {
		$inputFirstName			= set_value('inputFirstName');
		$inputLastName			= set_value('inputLastName');
		$inputTelephone			= set_value('inputTelephone');
		$userRole				= set_value('userRole');
		$inputUserName			= set_value('inputUserName');
		$inputPassword			= set_value('password');
	} else {
		$inputFirstName			= $usuario['firstName'];
		$inputLastName			= $usuario['lastName'];
		$inputTelephone			= $usuario['telephone'];
		$userRole				= $usuario['rol'];
		$inputUserName			= $usuario['userName'];
		$inputPassword			= '';
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
			<input id="inputFirstName" name="firstName" data-required-error="Por favor ingresa tu nombre" value="<?= $inputFirstName ?>" type="text" class="form-control" required="required">
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<label for="inputLastName">Apellidos</label> 
			<input id="inputLastName" name="lastName" data-required-error="Por favor ingresa tu apellido" value="<?= $inputLastName ?>" type="text" class="form-control" required="required">
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<label for="inputTelephone">Teléfono</label> 
			<input id="inputTelephone" name="telephone" data-required-error="Ingresa tu número de contacto" data-pattern-error="La cantidad mínima es de 7 dígitos , y la máxima 9" value="<?= $inputTelephone ?>" type="text" required="required" input pattern=".{7,9}" class="form-control onlyNumbers">
			<div class="help-block with-errors"	></div>
		</div>
		<?php if ( isset( $roles ) && $roles ): ?>
			<div class="form-group">
				<label for="userRole">Rol</label> 
				<select id="userRole" data-required-error="Seleccionar un rol" name="rol" class="form-control" required="required">
					<?php foreach ($roles as $key => $rol): ?>
						<option <?= $userRole == $rol['role_id'] ? "selected = 'selected'" : "" ;?> value="<?= $rol['role_id'] ?>"><?= $rol['name'] ?></option>
					<?php endforeach ?>
				</select>
				<div class="help-block with-errors"	></div>
			</div>
		<?php endif ?>
		<div class="form-group">
			<label for="inputUserName">Correo (usuario)</label> 
			<input id="inputUserName" data-pattern-error="Ingresa un correo válido" data-required-error="Ingresa tu correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="userName" value="<?= $inputUserName ?>" type="text" class="form-control" required="required" >
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
			<a class="btn btn-cancel" href="<?= base_url( '/admin/usuarios' ) ?>">Cancelar</a>
		</div>
	</form>
</div>