<form class="form-signin text-center mt-4" action="" method="post">
	<img class="mb-3" src="<?= base_url('assets/img/logo.png') ?>" style="width: 150px; ">
	<h1 class="h3 mb-3  font-weight-normal">Iniciar sesión</h1>
	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left">
			<?php print_r($errors); ?>
		</div>
	<?php endif ?>
	<label for="inputEmail" class="sr-only">Usuario</label>
	<input type="text" name="userName" id="inputEmail" class="form-control" placeholder="Usuario" required="" autofocus="" autocomplete="off">
	<label for="inputPassword" class="sr-only">Contraseña</label>
	<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required="" autocomplete="off" >
	<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar</button>
	<p class="text-center mt-3"><a href="<?= base_url("/register") ?>">Registrarse</a></p>
</form>