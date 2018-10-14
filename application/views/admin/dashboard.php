<div class="row">
		
	<?php if ( $usuarios && count( $usuarios ) ): ?>
		<div class="col-12">
			<canvas class="my-4 w-100" id="myChart" width="1740" height="733"></canvas>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
		<script>
			var usuarios = <?= json_encode( $usuarios ); ?>;
			var data_chart = {
				type: 'line',
				data: {
					labels: [],
					datasets: [{
						data: [],
						lineTension: 0,
						backgroundColor: 'transparent',
						borderColor: '#007bff',
						borderWidth: 4,
						pointBackgroundColor: '#007bff'
					}],
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					},
					legend: {
						display: false,
					}
				}
			};
			if( usuarios ) {
				usuarios.forEach( function( type_user, index ) { 
					console.log( type_user, index );
					data_chart.data.labels.push( type_user.rolName );
					data_chart.data.datasets[0].data.push( type_user.count );
				});
			}
			console.log( usuarios );
			console.log( data_chart );
			var ctx = document.getElementById("myChart");
			var myChart = new Chart(ctx, data_chart);
		</script>
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