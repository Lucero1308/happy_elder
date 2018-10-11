<div class="pt-2">
	<div class="table-responsive">
		<table id="list" class="table-hover table table-bordered">
			<thead>
			<tr>
				<th width="300">Nombre</th>
				<th width="300">Telefono</th>
				<th width="300">Fecha de visita</th>
			</tr>
			</thead>
			<tbody>
			<?php if ( isset( $list ) && $list && count( $list ) ): ?>
				<?php foreach ($list as $key => $row): ?>
					<tr>
						<td><?= $row['fullName'] ?></td>
						<td><?= $row['telephone'] ?></td>
						<td><?= $row['fechaVisita'] ?></td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</tbody>
		</table>
	</div>
</div>

