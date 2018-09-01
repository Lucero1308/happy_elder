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
	<form class="col-12 col-xl-5" action="" method="post">
		<?php if( isset($errors) ): ?>
			<div class="alert alert-danger text-left">
				<?php print_r($errors); ?>
			</div>
		<?php endif ?>
		<div class="form-group">
			<label for="inputFirstName">Nombres</label> 
			<input id="inputFirstName" name="firstName" value="<?= $inputFirstName ?>" type="text" required="required" class="form-control here">
		</div>
		<div class="form-group">
			<label for="inputLastName">Apellidos</label> 
			<input id="inputLastName" name="lastName" value="<?= $inputLastName ?>" type="text" required="required" class="form-control here">
		</div>
		<div class="form-group">
			<label for="inputTelephone">Teléfono</label> 
			<input id="inputTelephone" name="telephone" value="<?= $inputTelephone ?>" type="text" required="required" class="form-control here">
		</div>
		<?php if ( isset( $roles ) && $roles ): ?>
			<div class="form-group">
				<label for="userRole">Rol</label> 
				<select id="userRole" name="rol" class="form-control" required="required">
					<?php foreach ($roles as $key => $rol): ?>
						<option <?= $userRole == $rol['role_id'] ? "selected = 'selected'" : "" ;?> value="<?= $rol['role_id'] ?>"><?= $rol['name'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		<?php endif ?>
		<div class="form-group">
			<label for="inputUserName">Correo (usuario)</label> 
			<input id="inputUserName" name="userName" value="<?= $inputUserName ?>" type="email" class="form-control here" required="required">
		</div>
		<div class="form-group">
			<label for="inputPassword">Contraseña</label> 
			<input id="inputPassword" name="password" value="<?= $inputPassword ?>" type="password" class="form-control here">
		</div> 
		<div class="form-group">
			<input type="hidden" name="is_submitted" value="1">
			<button name="submit" type="submit" class="btn btn-primary">Registrar</button>
			<a class="btn btn-cancel" href="<?= base_url( '/admin/usuarios' ) ?>">Cancelar</a>
		</div>
	</form>
</div>