<p><a class="btn btn-primary" href="<?= base_url("/admin/usuarios/registrar/" ) ?>">Crear nuevo</a></p>
<div class="table-responsive">
	<table id="list" class="table-hover table table-bordered">
		<thead>
			<tr>
				<th width="150">Acciones</th>
				<th width="50">ID</th>
				<th>Correo</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Teléfono</th>
				<th>Rol</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody>
			<?php if ( $list && count( $list ) ): ?>
				<?php foreach ($list as $key => $row): ?>
					<tr>
						<!-- Condicional para solo mostrar editar con el usuario activo -->
						<td>
							<?php if ( $row['id'] == $this->session->userdata['id'] ): ?>
								<a href="<?= base_url("/admin/usuarios/editar/" . $row['id'] ) ?>">Editar</a>
							<?php else: ?>
								<a onclick="return confirm('¿Seguro que quiere eliminar este usuario?')" href="<?= base_url("/admin/usuarios/eliminar/" . $row['id']) ?>">Eliminar</a> | <a href="<?= base_url("/admin/usuarios/editar/" . $row['id'] ) ?>">Editar</a>
							<?php endif ?>
							<?php if ( $row['status'] == 'pending' ): ?>
								 | <a href="<?= base_url("/admin/usuarios/aprobar/" . $row['id'] ) ?>">Aprobar</a>
								 | <a href="<?= base_url("/admin/usuarios/desaprobar/" . $row['id'] ) ?>">Desprobar</a>
								<?php if ( in_array( $row['rol'], array( 3, 4 ) ) ): ?> 
								 | <a href="<?= base_url("/admin/usuarios/respuestas/" . $row['id'] ) ?>">Ver respuestas</a>
								<?php endif ?>
							<?php endif ?>
						</td>
						<td><?= $row['id'] ?></td>
						<td><?= $row['userName'] ?></td>
						<td><?= $row['firstName'] ?></td>
						<td><?= $row['lastName'] ?></td>
						<td><?= $row['telephone'] ?></td>
						<td><?= $row['rolName'] ?></td>
						<td><?= $row['status'] ?></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</tbody>
	</table>
</div>