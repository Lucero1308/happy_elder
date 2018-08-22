<form class="form-signin text-center mt-4" >
	<img class="mb-2" src="<?= base_url('assets/img/logo.png') ?>" style="width: 150px; ">
	<h1 class="h3 mb-3  font-weight-normal">Registrarse</h1>
	<label for="inputEmail" class="sr-only">Nombre</label>
	<input type="text" id="inputEmail" class="form-control" placeholder="Nombre" required="" autofocus="" autocomplete="off" >
	<label for="inputEmail" class="sr-only">Apellidos</label>
	<input type="text" id="inputEmail" class="form-control" placeholder="Apellidos" required="" autofocus="" autocomplete="off" >
	<label for="inputEmail" class="sr-only">Correo (usuario)</label>
	<input type="email" id="inputEmail" class="form-control" placeholder="Correo (usuario)" required="" autofocus="" autocomplete="off" >
	<label for="inputEmail" class="sr-only">Teléfono</label>
	<input type="email" id="inputEmail" class="form-control" placeholder="Teléfono" required="" autofocus="" autocomplete="off" >
	<label for="inputPassword" class="sr-only">Contraseña</label>
	<input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required="" autocomplete="off" >
	<label for="inputPassword" class="sr-only">Confirmar contraseña</label>
	<input type="password" id="inputPassword" class="form-control" placeholder="Confirmar contraseña" required="" autocomplete="off" >
	<button class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
	<p class="text-center mt-3"><a href="<?= base_url("/login") ?>">Iniciar sesión</a></p>
</form>