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
						<?php if ( $voluntario['avg_comment'] ): ?>
							<nav class="navbar navbar-expand-lg p-0">
								<p class="clasificacion_single navbar-nav">
									<?php for ($i=1; $i < 6; $i++) : ?>
										<label for="" style="<?= (int) $voluntario['avg_comment'] >= $i ? "color: orange" : ''; ?>">★</label>
									<?php endfor ?>
									<small>( <?= $voluntario['total_cal'] ?> de calificaciones )</small>
								</p>
							</nav>
						<?php endif ?>
						<a href="<?= base_url("/calificaciones_beneficiarios/comentarios/".$voluntario['hash']) ?>" class="btn btn-primary" style="" >Comentarios</a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
<?php endif ?>
<?php if ( $enfermeras && count( $enfermeras ) ): ?>
	<h4>Enfermeras</h4>
	<?php foreach ($enfermeras as $key => $enfermera): ?>
		<div class="card shadow-sm h-md-250">
			<div class="card-body">
				<div class="row">
					<div class="col-auto">
						<img class="img-thumbnail" width="200" height="200" src="<?= $voluntario['photo'] ?>" alt="Card image cap">
					</div>
					<div class="col-auto">
						<strong class="d-inline-block mb-2 text-primary"><?= $enfermera['fullName'] ?></strong>
						<h5 class="mb-0">
							<div class="text-dark">Correo: <?= $enfermera['userName'] ?></div>
						</h5>
						<div class="mb-0 text-muted">Teléfono: <?= $enfermera['telephone'] ?></div>
						<br/>
						<a class="text-dark navbar-nav" href="#"><?= $enfermera['count'] ?> comentarios</a>
						<?php if ( $enfermera['avg_comment'] ): ?>
							<nav class="navbar navbar-expand-lg p-0">
								<p class="clasificacion_single navbar-nav">
									<?php for ($i=1; $i < 6; $i++) : ?>
										<label for="" style="<?= (int) $enfermera['avg_comment'] >= $i ? "color: orange" : ''; ?>">★</label>
									<?php endfor ?>
									<small>( <?= $enfermera['total_cal'] ?> de calificaciones )</small>
								</p>
							</nav>
						<?php endif ?>
						<a href="<?= base_url("/calificaciones_beneficiarios/comentarios/".$enfermera['hash']) ?>" class="btn btn-primary" style="" >Comentarios</a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
<?php endif ?>
