<form class="form-signin mt-4" action="" method="post" data-toggle="validator">
	<div class="text-center">
		<a href="<?= base_url() ?>"><img class="mb-2" src="<?= base_url('assets/img/logo.png') ?>" style="width: 150px; "></a>
		<h1 class="h3 mb-3	font-weight-normal">Registrarse</h1>
	</div>

	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left">
			<?php print_r($errors); ?>
		</div>
	<?php endif ?>

	<div class="form-group">
		<label for="firstName" >Nombres</label> 
		<input id="firstName" name="firstName" type="text" data-required-error="Por favor ingresa tu nombre" class="form-control" placeholder="Ingresa tu nombre" required>
		<div class="help-block with-errors"></div>
	</div>

	<div class="form-group">
		<label for="lastName">Apellidos</label> 
		<input id="lastName" name="lastName" type="text" data-required-error="Por favor ingresa tu apellido" class="form-control" placeholder="Ingresa tu apellido" required>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label for="telephone">Teléfono</label> 
		<input id="telephone" name="telephone" input pattern=".{7,9}" data-required-error="Por favor tu número de contacto" data-pattern-error="La cantidad mínima es de 7 dígitos , y la máxima 9" type="text" maxlength="9" class="form-control onlyNumbers" placeholder="Ingresa tu móvil" required>
		<div class="help-block with-errors"></div>
	</div>
	<?php if ( isset( $roles ) && $roles ): ?>
		<div class="form-group">
			<label for="userRole">Rol</label> 
			<select id="userRole" name="rol" class="form-control" required="required">
				<?php foreach ($roles as $key => $rol): ?>
					<?php if ( $rol['role_id'] != 1 ): ?>
						<option value="<?= $rol['role_id'] ?>"><?= $rol['name'] ?></option>
					<?php endif ?>
				<?php endforeach ?>
			</select>
		</div>
	<?php endif ?>

	<div class="form-group">
		<label for="userName">Correo (usuario)</label> 
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
			<input id="userName" data-pattern-error="Ingresa un  correo válido" data-required-error="Por favor ingresa tu correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="userName" type="text" class="form-control" required>
		</div> 
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label for="password">Contraseña</label> 
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-key"></i></span>
			<input id="password" data-required-error="Por favor ingresa una contraseña" data-minlength-error="OJO:La cantidad minima de caracteres es de 6 digitos" data-minlength="6" name="password" type="password" class="form-control" required="required">
		</div>
		<div class="help-block with-errors"></div>
	</div> 
	<div class="form-group">
		<button type="submit" class="btn btn-lg btn-primary btn-block">Registrar</button>
	</div>
	<p class="text-center mt-3"><a href="<?= base_url("/cuenta/login") ?>">Iniciar sesión</a></p>
	<p class="text-center mt-3"><a href="<?= base_url("/cuenta/restablecer") ?>">¿Olvisdaste tu contraseña?</a></p>
</form>
