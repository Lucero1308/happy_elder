<form class="form-signin text-center mt-4" action="" method="post" data-toggle="validator" >
	<a href="<?= base_url() ?>"><img class="mb-4" src="<?= base_url('assets/img/cambio.png') ?>" style="width: 150px; "></a>
	<h4 class="h4 mb-3	font-weight-normal alert alert-warning">Cambia tu contraseña</h4>
	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left ">
			<?php print_r($errors); ?>
		</div>
	<?php endif ?>
	<a>Nueva contraseña:</a>
		<div class="form-group">
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-key"></i></div> 
			<label for="inputPassword" class="sr-only" >Contraseña</label>
			<input id="inputPassword" data-required-error="Por favor ingresa tu nueva contraseña" data-minlength-error="El campo minimo debe ser de 6 caracteres" data-minlength="6" name="password" type="password" class="form-control" placeholder="Nueva contraseña" required >
		</div>
		<div class="help-block with-errors"	></div>
	</div>
		<div class="form-group">
<br/>
<a>Repita su contraseña:</a>
<br/>
		<div class="form-group">
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-key"></i></div> 
			<label for="inputPassword" class="sr-only" >Contraseña</label>
			<input id="changePassword" data-required-error="Por favor ingresa de nuevo tu nueva contraseña" data-minlength-error="El campo minimo debe ser de 6 caracteres" data-minlength="6" name="changepassword" type="password" class="form-control" placeholder="Repita su nueva contraseña" required >
		</div>
		<div class="help-block with-errors"	></div>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Actualizar contraseña</button>
</form>
