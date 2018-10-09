<p><a class="btn btn-primary" href="<?= base_url("/admin/eventos/registrar/" ) ?>">Crear nuevo</a></p>
<div class="table-responsive">
	<table id="list" class="table-hover table table-bordered">
		<thead>
			<tr>
				<th width="150">Acciones</th>
				<th width="50">ID</th>
				<th>Nombre</th>
				<th>Usuario</th>
			</tr>
		</thead>
		<tbody>
			<?php if ( $list && count( $list ) ): ?>
				<?php foreach ($list as $key => $row): ?>
					<tr>
						<td><a onclick="return confirm('¿Seguro que quiere eliminar este evento?')" href="<?= base_url("/admin/eventos/eliminar/" . $row['id']) ?>">Eliminar</a> | <a href="<?= base_url("/admin/eventos/editar/" . $row['id'] ) ?>">Editar</a></td>
						<td><?= $row['id'] ?></td>
						<td><?= $row['name'] ?></td>
						<td><?= $row['usuario'] ?></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</tbody>
	</table>
</div>