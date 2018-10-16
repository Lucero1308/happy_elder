<p><a class="btn btn-primary" href="<?= base_url("/admin/servicios/registrar/" ) ?>">Crear nuevo</a></p>
<div class="table-responsive">
	<table id="list" class="table-hover table table-bordered">
		<thead>
			<tr>
				<th width="150">Acciones</th>
				<th width="50">ID</th>
				<th>Nombre</th>
				<th>Usuario</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody>
			<?php if ( $list && count( $list ) ): ?>
				<?php foreach ($list as $key => $row): ?>
					<tr>
						<td><a 
							<?php if ($row['status'] == 'reservado'): ?>
								href="#"
								onclick="return alert('Este servicio está reservado.')" 
							<?php else: ?>
								onclick="return confirm('¿Seguro que quiere eliminar este servicio?')" 
								href="<?= base_url("/admin/servicios/eliminar/" . $row['id']) ?>"
							<?php endif ?>
							 >Eliminar</a> | <a href="<?= base_url("/admin/servicios/editar/" . $row['id'] ) ?>">Editar</a></td>
						<td><?= $row['id'] ?></td>
						<td><?= $row['name'] ?></td>
						<td><?= $row['usuario'] ?></td>
						<td><?= $row['status'] ?></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</tbody>
	</table>
</div>