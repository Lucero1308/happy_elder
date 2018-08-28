<div class="pt-2">
	<div class="mb-3">
		<a href="<?= base_url( '/cuenta/registrar_evento' ) ?>" class="btn btn-primary">Registrar nuevo</a>
	</div>
	<div class="table-responsive">
		<table class="table-hover table table-bordered">
			<tr>
				<th width="50">Acciones</th>
				<th width="150">Foto</th>
				<th width="300">Nombre</th>
				<th width="300">Descripción</th>
				<th>Ubicación</th>
				<th>Fecha</th>
			</tr>
			<?php if ( isset( $list ) && $list && count( $list ) ): ?>
				<?php foreach ($list as $key => $row): ?>
					<tr>
						<td><a class="btn btn-primary" href="<?= base_url("/cuenta/editar_evento/" . $row['id'] ) ?>">Editar</a></td>
						<td><img src="<?= $row['photo'] ?>" class="img-fluid"></td>
						<td><?= $row['name'] ?></td>
						<td><?= $row['description'] ?></td>
						<td><?= $row['location'] ?></td>
						<td><?= $row['dateEvent'] ?></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</table>
	</div>
</div>
