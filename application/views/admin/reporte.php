<?php 
	if( $this->input->post('is_submitted') ) {
		$type			= set_value('type');
		$date_from			= set_value('date_from');
		$date_to			= set_value('date_to');
		$formato			= set_value('formato');
	} else {
		$type			= '';
		$date_from			= '';
		$date_to			= '';
		$formato			= '';
	}
?>
<div class="row">
	<div class="col-12">
		<h2 align="center" class="mb-4">Reporte - 
		<?php 
			switch ( $data_post['type'] ) {
				case 'eventos':
					echo "Reporte de eventos publicados";
					break;
				
				case 'cuentas':
					echo "Reporte de cuentas registradas";
					break;
				
				case 'servicios':
					echo "Reporte de servicios reservador";
					break;
				
				case 'valoracion':
					echo "Reporte de valoración";
					break;
				default:
					break;
			}
		?>
		</h2>
		<div class="text-center">
			<div id="wrapChart">
				<canvas id="myChart" width="500" height="500"></canvas>
			</div>
			<div id="wrapChart_2">
				<canvas id="myChart2" ></canvas>
			</div>
		</div>
		<script>
			jQuery( window ).ready( function () {
				var data_2 = <?= json_encode( $data_graf_2 ); ?>;
				var data_chart_2 = {
					type: 'bar',
					data: {
						labels: [],
						datasets: [{
							label: 'Calificaciones de usuarios',
							data: [],
							backgroundColor: [
								'rgba(255, 99, 132, 1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)',
								'rgba(255, 99, 132, 1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							lineTension: 0,
						}],
					},
					options: {
						responsive: true,
						legend: {
							position: 'top',
						},
						title: {
							display: true,
							text: 'Chart.js Doughnut Chart'
						},
						animation: {
							animateScale: true,
							animateRotate: true
						},
						scales: {
							yAxes: [{
								display: true,
								ticks: {
									min: 0,
									stepSize: 1
								}
							}]
						}
					}
				};

				var data = <?= json_encode( $data_graf ); ?>;
				var data_chart = {
					type: 'doughnut',
					data: {
						labels: [],
						datasets: [{
							data: [],
							backgroundColor: [
								'rgba(255, 99, 132, 1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							lineTension: 0,
						}],
					},
					options: {
						responsive: true,
						legend: {
							position: 'top',
						},
						title: {
							display: true,
							text: 'Chart.js Doughnut Chart'
						},
						animation: {
							animateScale: true,
							animateRotate: true
						}
					}
				};
				if( data ) {
					for (var key in data) {
						if (!data.hasOwnProperty(key)) continue;

						var obj = data[key];
						data_chart.data.labels.push( obj.name ); 
						data_chart.data.datasets[0].data.push( obj.total ); 
					}
				}
				var ctx = document.getElementById("myChart");
				var myChart = new Chart(ctx, data_chart);

				if( data_2 ) {
					for (var key in data_2) {
						if (!data_2.hasOwnProperty(key)) continue;

						var obj = data_2[key];
						console.log( obj );
						data_chart_2.data.labels.push( obj.name ); 
						data_chart_2.data.datasets[0].data.push( obj.total ); 
					}
				}
				var ctx_2 = document.getElementById("myChart2");
				var myChart_2 = new Chart(ctx_2, data_chart_2);
			} );
		</script>
		<?php 
			$meses = array(
				'1' => 'Enero',
				'2' => 'Febrero',
				'3' => 'Marzo',
				'4' => 'Abril',
				'5' => 'Mayo',
				'6' => 'Junio',
				'7' => 'Julio',
				'8' => 'Agosto',
				'9' => 'Septiembre',
				'10' => 'Octubre',
				'11' => 'Noviembre',
				'12' => 'Diciembre',
			);
		?>
		<pre><?php //print_r( $list_2 ); ?></pre>
		<div class="table-responsive">
			<?php if ( $data_post['type'] == 'valoracion' ): ?>
				<table id="list" class="table table-bordered">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Rol</th>
							<th>Calificación</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( $list_2 && count( $list_2 ) ): ?>
							<?php foreach ($list_2 as $key => $row): ?>
								<tr>
									<td><?= $row['nombre'] ?></td>
									<td><?= $row['rol'] ?></td>
									<td><?= $row['avg'] ?></td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
	</div>
</div>