<p><a class="btn btn-primary" href="<?= base_url("/admin/usuarios/registrar/" ) ?>">Crear nuevo</a></p>

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
					<!-- Condicional para solo mostrar editar con el usuario activo -->
					<?php if ( $row['id'] == $this->session->userdata['id'] ): ?>
						<td><a href="<?= base_url("/admin/usuarios/editar/" . $row['id'] ) ?>">Editar</a></td>
					<?php else: ?>
						<td><a onclick="return confirm('¿Seguro que quiere eliminar este usuario?')" href="<?= base_url("/admin/usuarios/eliminar/" . $row['id']) ?>">Eliminar</a> | <a href="<?= base_url("/admin/usuarios/editar/" . $row['id'] ) ?>">Editar</a></td>
					<?php endif ?>
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