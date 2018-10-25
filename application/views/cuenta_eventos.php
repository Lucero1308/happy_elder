<div class="pt-2">
	<div class="mb-3">
		<a href="<?= base_url( '/cuenta/registrar_evento' ) ?>" class="btn btn-primary">Registrar nuevo</a>
	</div>
	<div class="table-responsive">
		<table id="list" class="table-hover table table-bordered">
		<thead>
			<tr>
				<th width="50"><center>Acciones</center></th>
				<th width="150"><center>Foto</center></th>
				<th width="130"><center>Nombre</center></th>
				<th width="350"><center>Descripción</center></th>
				<th width="50"><center>Ubicación</center></th>
				<th width="150"><center>Fecha</center></th>
				<th><center>Cant. de donantes</center></th>
			</tr>
		</thead>
		<tbody>
			<?php if ( isset( $list ) && $list && count( $list ) ): ?>
				<?php foreach ($list as $key => $row): ?>
					<tr>
						<td><a class="btn btn-primary" href="<?= base_url("/cuenta/editar_evento/" . $row['id'] ) ?>">Editar</a></td>
						<td><img src="<?= $row['photo'] ?>" class="img-fluid"></td>
						<td><font size="2"><?= $row['name'] ?></font></td>
						<td align="justify"><font size="2"><?= $row['description'] ?></font></td>
						<td><center><?= $row['location'] ?></center></td>
						<td><?= $row['dateEvent'] ?></td>
						<td><center><?= $row['donaciones'] ?></center></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
