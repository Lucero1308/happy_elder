<form class="form-signin mt-4" action="" method="post">
	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left">
			<?php print_r($errors); ?>
		</div>
	<?php endif ?>
	<div class="text-center">
		<img class="mb-2" src="<?= base_url('assets/img/logo.png') ?>" style="width: 150px; ">
		<h1 class="h3 mb-3	font-weight-normal">Registrarse</h1>
	</div>
	
	<div class="form-group">
		<label for="firstName">Nombres</label> 
		<input id="firstName" name="firstName" type="text" class="form-control" required="required">
	</div>
	<div class="form-group">
		<label for="lastName">Apellidos</label> 
		<input id="lastName" name="lastName" type="text" class="form-control" required="required">
	</div>
	<div class="form-group">
		<label for="telephone">Teléfono</label> 
		<input id="telephone" name="telephone" type="text" class="form-control" required="required">
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
			<div class="input-group-addon">
				<i class="fa fa-user-circle-o"></i>
			</div> 
			<input id="userName" name="userName" type="text" class="form-control" required="required">
		</div>
	</div>
	<div class="form-group">
		<label for="password">Contraseña</label> 
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-key"></i>
			</div> 
			<input id="password" name="password" type="password" class="form-control" required="required">
		</div>
	</div> 
	<div class="form-group">
		<button name="submit" type="submit" class="btn btn-lg btn-primary btn-block">Registrar</button>
	</div>
	<p class="text-center mt-3"><a href="<?= base_url("/cuenta/login") ?>">Iniciar sesión</a></p>
</form>