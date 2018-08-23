<form class="form-signin text-center mt-4" action="" method="post">
	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left">
			<?php print_r($errors); ?>
		</div>
	<?php endif ?>
	<img class="mb-2" src="<?= base_url('assets/img/logo.png') ?>" style="width: 150px; ">
	<h1 class="h3 mb-3  font-weight-normal">Registrarse</h1>
	<label for="inputFirstName" class="sr-only">Nombres</label>
	<input type="text" name="firstName" id="inputFirstName" class="form-control" placeholder="Nombres" required>
	<label for="inputLastName" class="sr-only">Apellidos</label>
	<input type="text" name="lastName" id="inputLastName" class="form-control" placeholder="Apellidos" required>
	<label for="inputTelephone" class="sr-only">Teléfono</label>
	<input type="text" name="telephone" id="inputTelephone" class="form-control" placeholder="Teléfono" required>
	<label for="inputUserName" class="sr-only">Correo (usuario)</label>
	<input type="email" name="userName" id="inputUserName" class="form-control" placeholder="Correo (usuario)" required>
	<label for="inputPassword" class="sr-only">Contraseña</label>
	<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
	<p class="text-center mt-3"><a href="<?= base_url("/login") ?>">Iniciar sesión</a></p>
</form>