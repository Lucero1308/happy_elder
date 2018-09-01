<p><a class="btn btn-primary" href="<?= base_url("/admin/ubicaciones/registrar/" ) ?>">Crear nuevo</a></p>
<div class="table-responsive">
	<table class="table-hover table table-bordered">
		<tr>
			<th width="150">Acciones</th>
			<th width="50">ID</th>
			<th>Nombre</th>
		</tr>
		<?php if ( $list && count( $list ) ): ?>
			<?php foreach ($list as $key => $row): ?>
				<tr>
					<td><a href="<?= base_url("/admin/ubicaciones/eliminar/" . $row['id']) ?>">Eliminar</a> | <a href="<?= base_url("/admin/ubicaciones/editar/" . $row['id'] ) ?>">Editar</a></td>
					<td><?= $row['id'] ?></td>
					<td><?= $row['name'] ?></td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</table>
</div>