<form class="form-signin text-center mt-4" action="" method="post" data-toggle="validator" >
	<a href="<?= base_url() ?>"><img class="mb-3" src="<?= base_url('assets/img/logo.png') ?>" style="width: 150px; "></a>
	<h1 class="h3 mb-3	font-weight-normal">Iniciar sesión</h1>
	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left ">
			<?php print_r($errors); ?>
		</div>
	<?php endif ?>
	<div class="form-group">
		<div class="input-group" >
			<span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
			<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="userName" name="userName" class="form-control" placeholder="Usuario" data-pattern-error="CAMBIAR TEXTO" data-required-error="CAMBIAR TEXTO" required>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-key"></i></div> 
			<label for="inputPassword" class="sr-only" >Contraseña</label>
			<input id="inputPassword" data-required-error="CAMBIAR TEXTO" data-minlength-error="CAMBIAR TEXTO" data-minlength="4" name="password" type="password" class="form-control" placeholder="Contraseña" required >
		</div>
		<div class="help-block with-errors"	></div>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar</button>
	<p class="text-center mt-3"><a href="<?= base_url("/cuenta/register") ?>">Registrarse</a></p>
</form>
