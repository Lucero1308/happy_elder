<form class="form-signin mt-4" enctype="multipart/form-data" action="" method="post" data-toggle="validator">
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
		<input id="firstName" name="firstName" type="text" data-required-error="Por favor ingresa tu nombre" class="form-control" placeholder="Ingresa tu nombre" required>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label for="lastName">Apellidos</label> 
		<input id="lastName" name="lastName" type="text" data-required-error="Por favor ingresa tu apellido" class="form-control" placeholder="Ingresa tu apellido" required>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label for="firstName" >Foto</label> 
		<div class="input-group">
			<input type="file" class="form-control-file" required="" name="photo">
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label for="telephone">Teléfono</label> 
		<input id="telephone" name="telephone" input pattern=".{7,9}" data-required-error="Por favor tu número de contacto" data-pattern-error="La cantidad mínima es de 7 dígitos , y la máxima 9" type="text" maxlength="9" class="form-control onlyNumbers" placeholder="Ingresa tu móvil" required>
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
	<div id="preguntas">
	</div>
	<div class="form-group">
		<label for="userName">Correo (usuario)</label> 
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
			<input id="userName" data-pattern-error="Ingresa un	correo válido" data-required-error="Por favor ingresa tu correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="userName" type="text" class="form-control" required>
		</div> 
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label for="password">Contraseña</label> 
		<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-key"></i></span>
			<input id="password" data-required-error="Por favor ingresa una contraseña" data-minlength-error="OJO:La cantidad minima de caracteres es de 6 digitos" data-minlength="6" name="password" type="password" class="form-control" required="required">
		</div>
		<div class="help-block with-errors"></div>
	</div> 
	<div class="form-group">
		<button type="submit" class="btn btn-lg btn-primary btn-block">Registrar</button>
	</div>
	<p class="text-center mt-3"><a href="<?= base_url("/cuenta/login") ?>">Iniciar sesión</a></p>
	<p class="text-center mt-3"><a href="<?= base_url("/cuenta/restablecer") ?>">¿Olvisdaste tu contraseña?</a></p>
</form>
<div id="preguntas_enfermera"  style="display: none;">
	<div class="form-group">
		<label >¿Conoce usted que tipo de enfermedades puede tener un adulto mayor?</label> 
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt1" value="Sí">
			<label class="form-check-label" for="rpt1_1">
				Sí
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt1" value="No">
			<label class="form-check-label" for="rpt1_2">
				No
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt1" value="No sé">
			<label class="form-check-label" for="rpt1_3">
				No sé 
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label >¿Tienes experiencia en el cuidado de personas mayores dependientes?</label> 
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt2" value="Sí">
			<label class="form-check-label" for="rpt2_1">
				Sí
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt2" value="No">
			<label class="form-check-label" for="rpt2_2">
				No
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label >¿Cómo reacciona ante personas enfadadas, testarudas, temerosas?</label> 
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt3" value="Agresivamente">
			<label class="form-check-label" for="rpt3_1">
				Agresivamente
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt3" value="Hostilmente">
			<label class="form-check-label" for="rpt3_2">
				Hostilmente
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt3" value="Empleo de frases dramáticas o exageradas">
			<label class="form-check-label" for="rpt3_3">
				Empleo de frases dramáticas o exageradas 
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label >¿Cómo se siente con respecto a cuidar a una persona incapacitada?¿O a una persona con problemas de la memoria?</label> 
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt4" value="Me gusta ayudar a quienes lo necesitan">
			<label class="form-check-label" for="rpt4_1">
				Me gusta ayudar a quienes lo necesitan
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt4" value="Me estresa las personas dependientes">
			<label class="form-check-label" for="rpt4_2">
				Me estresa las personas dependientes
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label >¿Tiene usted algún problema de salud, condición física, o discapacidad que afecta el tipo o la cantidad de cuidado que usted puede proveer?</label> 
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt5" value="Sí">
			<label class="form-check-label" for="rpt5_1">
				Sí
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt5" value="No">
			<label class="form-check-label" for="rpt5_2">
				No
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt5" value="No sé">
			<label class="form-check-label" for="rpt5_3">
				No sé 
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label >¿Ha estudiado en un instituto y/o universidad alguna carrera para el cuidado de ancianos? </label> 
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt6" value="Sí">
			<label class="form-check-label" for="rpt6_1">
				Sí
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt6" value="No">
			<label class="form-check-label" for="rpt6_2">
				No
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
</div>
<div id="preguntas_voluntario" style="display: none;">
	<div class="form-group">
		<label >¿Sabes cocinar menús adaptados para personas mayores?</label> 
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt1" value="Sí">
			<label class="form-check-label" for="rpt1_1">
				Sí
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt1" value="No">
			<label class="form-check-label" for="rpt1_2">
				No
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt1" value="No sé">
			<label class="form-check-label" for="rpt1_3">
				No sé 
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label >¿Tiene usted algún problema de salud, condición física, o discapacidad que afecta el tipo o la cantidad de cuidado que usted puede proveer?</label>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt2" value="Sí">
			<label class="form-check-label" for="rpt2_1">
				Sí
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt2" value="No">
			<label class="form-check-label" for="rpt2_2">
				No
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt2" value="No sé">
			<label class="form-check-label" for="rpt2_3">
				No sé 
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label >¿Cuanto tiempo ha trabajado realizando servicios de cuidado de este tipo de personas?</label>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt3" value="Menos de un año">
			<label class="form-check-label" for="rpt3_1">
				Menos de un año
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt3" value="1 - 3 años">
			<label class="form-check-label" for="rpt3_2">
				1 - 3 años
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt3" value="4 - 8 años">
			<label class="form-check-label" for="rpt3_3">
				4 - 8 años 
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt3" value="9 - 12 años">
			<label class="form-check-label" for="rpt3_4">
				9 - 12 años 
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt3" value="Más de 12 años">
			<label class="form-check-label" for="rpt3_5">
				Más de 12 años 
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label >¿Has realizado algún curso de ayuda en domicilio?</label>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt4" value="Sí">
			<label class="form-check-label" for="rpt4_1">
				Sí
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt4" value="No">
			<label class="form-check-label" for="rpt4_2">
				No
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label >¿Cómo fue designado para cuidador?</label>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt5" value="Por iniciativa propia ">
			<label class="form-check-label" for="rpt5_1">
				Por iniciativa propia 
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt5" value="Por decisión familiar">
			<label class="form-check-label" for="rpt5_2">
				Por decisión familiar 
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt5" value="Por solicitud del enfermo">
			<label class="form-check-label" for="rpt5_2">
				Por solicitud del enfermo 
			</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" required="" name="rpt5" value="Por ser el único que podía">
			<label class="form-check-label" for="rpt5_2">
				Por ser el único que podía
			</label>
		</div>
		<div class="help-block with-errors"></div>
	</div>
</div>