<div class="table-responsive">
	<table class="table-hover table table-bordered">
		<tr>
			<th width="150">Acciones</th>
			<th width="50">ID</th>
			<th>Correo</th>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Teléfono</th>
			<th>Rol</th>
		</tr>
		<?php if ( $list && count( $list ) ): ?>
			<?php foreach ($list as $key => $row): ?>
				<tr>
					<td><a href="<?= base_url("/admin/usuarios/eliminar/" . $row['id']) ?>">Eliminar</a> | <a href="<?= base_url("/admin/usuarios/editar/" . $row['id'] ) ?>">Editar</a></td>
					<td><?= $row['id'] ?></td>
					<td><?= $row['userName'] ?></td>
					<td><?= $row['firstName'] ?></td>
					<td><?= $row['lastName'] ?></td>
					<td><?= $row['telephone'] ?></td>
					<td><?= $row['rolName'] ?></td>
				</tr>
			<?php endforeach ?>
		<?php endif ?>
	</table>
</div>