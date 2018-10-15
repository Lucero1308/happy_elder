	<?php if ( $usuario['rol'] == 4 ): ?>
		<h4>ROL: ENFERMERA</h4>
		<div>
			<div class="form-group">
				<label>¿Conoce usted que tipo de enfermedades puede tener un adulto mayor?</label> 
				<br/><?= $usuario['rpt1'] ?>
			</div>
			<div class="form-group">
				<label >¿Tienes experiencia en el cuidado de personas mayores dependientes?</label> 
				<br/><?= $usuario['rpt2'] ?>
			</div>
			<div class="form-group">
				<label >¿Cómo reacciona ante personas enfadadas, testarudas, temerosas?</label> 
				<br/><?= $usuario['rpt3'] ?>
			</div>
			<div class="form-group">
				<label >¿Cómo se siente con respecto a cuidar a una persona incapacitada?¿O a una persona con problemas de la memoria?</label> 
				<br/><?= $usuario['rpt4'] ?>
			</div>
			<div class="form-group">
				<label >¿Tiene usted algún problema de salud, condición física, o discapacidad que afecta el tipo o la cantidad de cuidado que usted puede proveer?</label> 
				<br/><?= $usuario['rpt5'] ?>
			</div>
			<div class="form-group">
				<label >¿Ha estudiado en un instituto y/o universidad alguna carrera para el cuidado de ancianos? </label> 
				<br/><?= $usuario['rpt6'] ?>
			</div>
		</div>
	<?php endif ?>
	<?php if ( $usuario['rol'] == 3 ): ?>
		<h4>ROL: VOLUNTARIO</h4>
		<div>
			<div class="form-group">
				<label >¿Sabes cocinar menús adaptados para personas mayores?</label> 
				<br/><?= $usuario['rpt1'] ?>
			</div>
			<div class="form-group">
				<label >¿Tiene usted algún problema de salud, condición física, o discapacidad que afecta el tipo o la cantidad de cuidado que usted puede proveer?</label>
				<br/><?= $usuario['rpt2'] ?>
			</div>
			<div class="form-group">
				<label >¿Cuanto tiempo ha trabajado realizando servicios de cuidado de este tipo de personas?</label>
				<br/><?= $usuario['rpt3'] ?>
			</div>
			<div class="form-group">
				<label >¿Has realizado algún curso de ayuda en domicilio?</label>
				<br/><?= $usuario['rpt4'] ?>
			</div>
			<div class="form-group">
				<label >¿Cómo fue designado para cuidador?</label>
				<br/><?= $usuario['rpt5'] ?>
			</div>
		</div>
	<?php endif ?>
	<br/>
	<center>
		<a href="<?= base_url(); ?>admin/usuarios/aprobar/<?=  $usuario['id'] ?>" class="btn btn-primary my-2">Aprobar cuenta</a>
		<a href="<?= base_url(); ?>admin/usuarios/desaprobar/<?=  $usuario['id'] ?>" class="btn btn-secondary my-2">Desaprobar cuenta</a>
	</center>