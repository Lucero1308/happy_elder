<form class="form-signin text-center mt-4" action="" method="post">
	<img class="mb-3" src="<?= base_url('assets/img/logo.png') ?>" style="width: 150px; ">
	<h1 class="h3 mb-3  font-weight-normal">Iniciar sesión</h1>
	<?php if ( $this->session->flashdata('log_success') ): ?>
		<div class="alert alert-success">
			<?php echo $this->session->flashdata('log_success');?>
		</div>
	<?php endif ?>
	<?php if ( $this->session->flashdata('log_error') ): ?>
		<div class="alert alert-danger">
			<?php echo $this->session->flashdata('log_error');?>
		</div>
	<?php endif ?>
	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left">
			<p class="mb-0"><?php print_r($errors);?></p>
		</div>
	<?php endif ?>
	<label for="inputEmail" class="sr-only">Usuario</label>
	<input type="text" name="username" id="inputEmail" class="form-control" placeholder="Usuario" required="" autofocus="" autocomplete="off">
	<label for="inputPassword" class="sr-only">Contraseña</label>
	<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required="" autocomplete="off" >
	<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar</button>
	<p class="text-center mt-3"><a href="<?= base_url("/register") ?>">Registrarse</a></p>
</form>