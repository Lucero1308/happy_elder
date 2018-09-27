<?php 
	$userName = set_value( 'userName' );
?>
<form class="form-signin text-center mt-4" action="" method="post" data-toggle="validator" >
	<a href="<?= base_url() ?>"><img class="mb-4" src="<?= base_url('assets/img/cambio.png') ?>" style="width: 150px; "></a>
	<h2 class="h2 mb-3	font-weight-normal">Introduce el email asociado a tu cuenta</h2>
	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left ">
			<?php print_r($errors); ?>
		</div>
	<?php endif ?>
	<div class="form-group">
		<div class="input-group" >
			<span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
			<input value="<?= $userName ?>" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="userName" name="userName" class="form-control" placeholder="Correo electrónico" data-pattern-error="Ingresa un  correo válido" data-required-error="Por favor ingresa tu correo" required>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Restablecer contraseña</button>
</form>
