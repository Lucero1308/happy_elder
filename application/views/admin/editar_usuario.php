<?php 
	$user_id 				= $usuario['id'];
	if( $this->input->post('is_submitted') ) {
		$inputFirstName			= set_value('inputFirstName');
		$inputLastName			= set_value('inputLastName');
		$inputTelephone			= set_value('inputTelephone');
		$userRole				= set_value('userRole');
		$inputUserName			= set_value('inputUserName');
		$inputPassword			= set_value('password');
	} else {
		$inputFirstName			= $usuario['firstName'];
		$inputLastName			= $usuario['lastName'];
		$inputTelephone			= $usuario['telephone'];
		$userRole				= $usuario['rol'];
		$inputUserName			= $usuario['userName'];
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
			<input id="inputTelephone" name="telephone" value="<?= $inputTelephone ?>" type="text" required="required" class="form-control onlyNumbers">
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
			<input id="inputUserName" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="userName" value="<?= $inputUserName ?>" type="email" class="form-control" required="required">
		</div>
		<div class="form-group">
			<label for="inputPassword">Contraseña</label> 
			<input id="inputPassword" name="password" value="<?= $inputPassword ?>" type="password" class="form-control here">
		</div> 
		<div class="form-group">
			<input type="hidden" name="is_submitted" value="1">
			<input type="hidden" name="inputUseId" value="<?= $user_id ?>">
			<button name="submit" type="submit" class="btn btn-primary">Actualizar</button>

			<a class="btn btn-cancel" href="<?= base_url( '/admin/usuarios' ) ?>">Cancelar</a>
		</div>
	</form>
</div>