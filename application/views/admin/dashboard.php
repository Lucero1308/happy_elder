<div class="row">
	<?php if ( $usuarios && count( $usuarios ) ): ?>
		<div class="col-12 col-lg-4">
			<h3>Usuarios</h3>
			<div class="table-responsive">
				<table id="" class="table-hover table table-bordered">
					<thead>
						<tr>
							<th>Rol</th>
							<th width="150">Cantidad</th>
						</tr>
					</thead>
					<tbody>
						<?php $total = 0; ?>
						<?php foreach ($usuarios as $key => $row): $total+=$row['count'] ?>
							<tr>
								<td><?= $row['rolName'] ?></td>
								<td><?= $row['count'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr>
							<th>Total</th>
							<th><?= $total ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	<?php endif ?>
	<?php if ( $servicios && count( $servicios ) ): ?>
		<div class="col-12 col-lg-4">
			<h3>Servicios</h3>
			<div class="table-responsive">
				<table id="" class="table-hover table table-bordered">
					<thead>
						<tr>
							<th>Estado</th>
							<th width="150">Cantidad</th>
						</tr>
					</thead>
					<tbody>
						<?php $total = 0; ?>
						<?php foreach ($servicios as $key => $row): $total+=$row['count'] ?>
							<tr>
								<td><?= $row['rolName'] ?></td>
								<td><?= $row['count'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr>
							<th>Total</th>
							<th><?= $total ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	<?php endif ?>
	<?php if ( $eventos && count( $eventos ) ): ?>
		<div class="col-12 col-lg-4">
			<h3>Eventos</h3>
			<div class="table-responsive">
				<table id="" class="table-hover table table-bordered">
					<thead>
						<tr>
							<th>Estado</th>
							<th width="150">Cantidad</th>
						</tr>
					</thead>
					<tbody>
						<?php $total = 0; ?>
						<?php foreach ($eventos as $key => $row): $total+=$row['count'] ?>
							<tr>
								<td><?= $row['rolName'] ?></td>
								<td><?= $row['count'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr>
							<th>Total</th>
							<th><?= $total ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	<?php endif ?>
	<?php if ( $ubicaciones && count( $ubicaciones ) ): ?>
		<div class="col-12 col-lg-4">
			<h3>Ubicaciones</h3>
			<div class="table-responsive">
				<table id="" class="table-hover table table-bordered">
					<thead>
						<tr>
							<th>Estado</th>
							<th width="150">Cantidad</th>
						</tr>
					</thead>
					<tbody>
						<?php $total = 0; ?>
						<?php foreach ($ubicaciones as $key => $row): $total+=$row['count'] ?>
							<tr>
								<td><?= $row['rolName'] ?></td>
								<td><?= $row['count'] ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
					<tfoot>
						<tr>
							<th>Total</th>
							<th><?= $total ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	<?php endif ?>
</div>