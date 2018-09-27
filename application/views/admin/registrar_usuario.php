<?php 
	if( $this->input->post('is_submitted') ) {
		$inputFirstName			= set_value('inputFirstName');
		$inputLastName			= set_value('inputLastName');
		$inputTelephone			= set_value('inputTelephone');
		$userRole				= set_value('userRole');
		$inputUserName			= set_value('inputUserName');
		$inputPassword			= set_value('inputPassword');
	} else {
		$inputFirstName			= '';
		$inputLastName			= '';
		$inputTelephone			= '';
		$userRole				= '';
		$inputUserName			= '';
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
			<input id="inputFirstName" name="firstName" data-required-error="Por favor ingresa un nombre" value="<?= $inputFirstName ?>" type="text" required="required" class="form-control">
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<label for="inputLastName">Apellidos</label> 
			<input id="inputLastName" name="lastName" data-required-error="Por favor ingresa un apellido" value="<?= $inputLastName ?>" type="text" required="required" class="form-control">
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<label for="inputTelephone">Teléfono</label> 
			<input id="inputTelephone" name="telephone" data-pattern-error="OJO:La cantidad mínima es de 7 dígitos , y la máxima 9" data-required-error="Ingresa un número de contacto" value="<?= $inputTelephone ?>" type="text" required="required" input pattern=".{7,9}" class="form-control onlyNumbers">
			<div class="help-block with-errors"	></div>
		</div>
		<?php if ( isset( $roles ) && $roles ): ?>
			<div class="form-group">
				<label for="userRole">Rol</label> 
				<select id="userRole" data-required-error="Por favor selecciona un campo" name="rol" class="form-control" required="required">
					<?php foreach ($roles as $key => $rol): ?>
						<option <?= $userRole == $rol['role_id'] ? "selected = 'selected'" : "" ;?> value="<?= $rol['role_id'] ?>"><?= $rol['name'] ?></option>
					<?php endforeach ?>
				</select>
				<div class="help-block with-errors"	></div>
			</div>
		<?php endif ?>
		<div class="form-group">
			<label for="inputUserName">Correo (usuario)</label> 
			<input id="inputUserName" data-pattern-error="Ingresa un correo válido" data-required-error="Ingresa un correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="userName" value="<?= $inputUserName ?>" type="text" class="form-control" required="required">
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<label for="inputPassword">Contraseña</label> 
			<input id="inputPassword" data-minlength="7" data-required-error="Ingresa la contraseña" data-minlength-error="OJO:La cantidad mínima es de 7 caracteres" name="password" value="<?= $inputPassword ?>" type="password" class="form-control" required="required">
			<div class="help-block with-errors"	></div>
		</div> 
		<div class="form-group">
			<input type="hidden" name="is_submitted" value="1">
			<button type="submit" class="btn btn-primary">Registrar</button>
			<a class="btn btn-cancel" href="<?= base_url( '/admin/usuarios' ) ?>">Cancelar</a>
		</div>
	</form>
</div>