<form class="form-signin mt-4" action="" method="post" data-toggle="validator">
	<div class="text-center">
		<a href="<?= base_url() ?>"><img class="mb-2" src="<?= base_url('assets/img/logo.png') ?>" style="width: 150px; "></a>
		<h1 class="h3 mb-3	font-weight-normal">Registrarse</h1>
	</div>

	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left">
			<?php print_r($errors); ?>
		</div>
	<?php endif ?>

	<div class="form-group">
		<label for="firstName" >Nombres</label> 
		<input id="firstName" name="firstName" type="text" class="form-control" placeholder="Ingresa tu nombre" required>
        <div class="help-block with-errors"></div>
	</div>

	<div class="form-group">
		<label for="lastName">Apellidos</label> 
		<input id="lastName" name="lastName" type="text" class="form-control" placeholder="Ingresa tu apellido" required>
        <div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label for="telephone">Teléfono</label> 
		<input id="telephone" name="telephone" type="text" class="form-control onlyNumbers" placeholder="Ingresa tu móvil" required>
        <div class="help-block with-errors"></div>
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
			<span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
            <input id="userName" name="userName" type="email" class="form-control" required>
			</div> 
			 <div class="help-block with-errors"></div>
		</div>


	<div class="form-group">
		<label for="password">Contraseña</label> 
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-key"></i></span>
			<input id="password" name="password" type="password" class="form-control" required="required">
		</div>
             <div class="help-block with-errors"></div>
	</div> 

	<div class="form-group">
		<button class="btn btn-lg btn-primary btn-block">Registrar</button>
	</div>
	<p class="text-center mt-3"><a href="<?= base_url("/cuenta/login") ?>">Iniciar sesión</a></p>
</form>
