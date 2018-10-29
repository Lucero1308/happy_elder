<p><a class="btn btn-primary" href="<?= base_url("/admin/reportes/generar/" ) ?>">Crear reporte</a></p>
<div class="table-responsive">
	<table id="list" class="table-hover table table-bordered">
		<thead>
			<tr>
				<th width="150">Acciones</th>
				<th width="50">ID</th>
				<th>Tipo</th>
				<th>Desde</th>
				<th>Hasta</th>
			</tr>
		</thead>
		<tbody>
			<?php if ( $list && count( $list ) ): ?>
				<?php foreach ($list as $key => $row): ?>
					<tr>
						<!-- Condicional para solo mostrar editar con el usuario activo -->
						<td>
							<a onclick="return confirm('¿Seguro que quiere eliminar este reporte?')" href="<?= base_url("/admin/reportes/eliminar/" . $row['id']) ?>">Eliminar</a>
							<?php if ( $row['url'] ): ?>
							  | <a href="<?= base_url( $row['url'] ) ?>">Descargar</a>
							<?php endif ?>
						</td>
						<td><?= $row['id'] ?></td>
						<td><?= $row['type'] ?></td>
						<td><?= $row['date_from'] ?></td>
						<td><?= $row['date_to'] ?></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</tbody>
	</table>
</div>