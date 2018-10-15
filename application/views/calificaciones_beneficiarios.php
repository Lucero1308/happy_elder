<?php if ( $voluntarios && count( $voluntarios ) ): ?>
	<h4>Voluntarios</h4>
	<?php foreach ($voluntarios as $key => $voluntario): ?>
		<div class="card shadow-sm h-md-250">
			<div class="card-body">
				<div class="row">
					<div class="col-auto">
						<img class="img-thumbnail" width="200" height="200" src="<?= $voluntario['photo'] ?>" alt="Card image cap">
					</div>
					<div class="col-auto">
						<strong class="d-inline-block mb-2 text-primary"><?= $voluntario['fullName'] ?></strong>
						<h5 class="mb-0">
							<div class="text-dark">Correo: <?= $voluntario['userName'] ?></div>
						</h5>
						<div class="mb-0 text-muted">Teléfono: <?= $voluntario['telephone'] ?></div>
						<br/>
						<a class="text-dark navbar-nav" href="#"><?= $voluntario['count'] ?> comentarios</a>
						<nav class="navbar navbar-expand-lg p-0">
							<form>
							<p class="clasificacion navbar-nav">
								<input id="radio1" type="radio" name="estrellas" value="5">
								<label for="radio1">★</label>
								<input id="radio2" type="radio" name="estrellas" value="4">
								<label for="radio2">★</label>
								<input id="radio3" type="radio" name="estrellas" value="3">
								<label for="radio3">★</label>
								<input id="radio4" type="radio" name="estrellas" value="2">
								<label for="radio4">★</label>
								<input id="radio5" type="radio" name="estrellas" value="1">
								<label for="radio5">★</label>
								</p>
							</form>
						</nav>
						<a href="<?= base_url("/calificaciones_beneficiarios/comentarios/".$voluntario['hash']) ?>" class="btn btn-primary" style="" >Comentarios</a>
					</div>
				</div>
			</div>
		</div>
		<div class="card flex-md-row  col-xs-9 mb-4">
		</div>
	<?php endforeach ?>
<?php endif ?>
<?php if ( $enfermeras && count( $enfermeras ) ): ?>
	<h4>Enfermeras</h4>
	<?php foreach ($enfermeras as $key => $enfermera): ?>
		<div class="card flex-md-row shadow-sm h-md-250 col-xs-9 mb-4">
			<img class="card-img-right flex-auto d-none d-lg-block" width="200" height="200" src="<?= $voluntario['photo'] ?>" alt="Card image cap">
			<div class="card-body d-flex flex-column align-items-start mb-0">
				<strong class="d-inline-block mb-2 text-primary"><?= $enfermera['fullName'] ?></strong>
				<h5 class="mb-0">
					<div class="text-dark">Correo: <?= $enfermera['userName'] ?></div>
				</h5>
				<div class="mb-0 text-muted">Teléfono: <?= $enfermera['telephone'] ?></div>
				<br/>
				<a class="text-dark navbar-nav" href="#"><?= $enfermera['count'] ?> comentarios</a>
				<nav class="navbar navbar-expand-lg p-0">
					<form>
					<p class="clasificacion navbar-nav">
						<input id="radio1" type="radio" name="estrellas" value="5">
						<label for="radio1">★</label>
						<input id="radio2" type="radio" name="estrellas" value="4">
						<label for="radio2">★</label>
						<input id="radio3" type="radio" name="estrellas" value="3">
						<label for="radio3">★</label>
						<input id="radio4" type="radio" name="estrellas" value="2">
						<label for="radio4">★</label>
						<input id="radio5" type="radio" name="estrellas" value="1">
						<label for="radio5">★</label>
						</p>
					</form>
				</nav>
				<a href="<?= base_url("/calificaciones_beneficiarios/comentarios/".$enfermera['hash']) ?>" class="btn btn-primary" style="" >Comentarios</a>
			</div>
		</div>
	<?php endforeach ?>
<?php endif ?>
