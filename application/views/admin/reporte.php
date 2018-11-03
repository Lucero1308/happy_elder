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
					echo "Enfermeras asignadas";
					break;
				
				case 'servicios':
					echo "Reporte de servicios reservados";
					break;
				
				case 'valoracion':
					echo "Reporte de valoración";
					break;
				default:
					break;
			}
		?>
		</h2>
		<script>
			document.title += ': ' + '<?= $data_post['date_from'] ?>' + ' a ' + '<?= $data_post['date_to'] ?>';
		</script>
		<?php if ( $data_post['type'] == 'cuentas' ): ?>
			<div class="text-center">
				<div id="wrapChart_2" class="mb-4">
					<canvas id="myChart2" ></canvas>
				</div>
				<p><a href="#" id="downloadPdf" class="btn btn-primary">Descargar</a></p>
			</div>
			<script>
				jQuery( window ).ready( function () {
					var data = <?= json_encode( $data_graf ); ?>;
					var data_chart = {
						type: 'line',
						data: {
							labels: [],
							datasets: [{
								label: 'Calificaciones de usuarios',
								fill: false,
								data: [],
								borderColor: [
									'rgba(255, 99, 132, 1)',
								],
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
								display: false,
								position: 'top',
							},
							title: {
								display: false,
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
					if( data ) {
						for (var key in data) {
							if (!data.hasOwnProperty(key)) continue;

							var obj = data[key];
							console.log( obj );
							data_chart.data.labels.push( obj.name ); 
							data_chart.data.datasets[0].data.push( obj.total ); 
						}
					}
					var ctx = document.getElementById("myChart2");
					var myChart = new Chart(ctx, data_chart);

					$('#downloadPdf').click(function(event) {
						// get size of report page
						var reportPageHeight = $('#wrapChart_2').innerHeight();
						var reportPageWidth = $('#wrapChart_2').innerWidth();
						
						// create a new canvas object that we will populate with all other canvas objects
						var pdfCanvas = $('<canvas />').attr({
							id: "canvaspdf",
							width: reportPageWidth,
							height: reportPageHeight
						});
						
						// keep track canvas position
						var pdfctx = $(pdfCanvas)[0].getContext('2d');
						var pdfctxX = 0;
						var pdfctxY = 0;
						var buffer = 100;
						
						// for each chart.js chart
						$("canvas").each(function(index) {
							// get the chart height/width
							var canvasHeight = $(this).innerHeight();
							var canvasWidth = $(this).innerWidth();
							
							// draw the chart into the new canvas
							pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
							pdfctxX += canvasWidth + buffer;
							
							// our report page is in a grid pattern so replicate that in the new canvas
							if (index % 2 === 1) {
								pdfctxX = 0;
								pdfctxY += canvasHeight + buffer;
							}
						});
						
						// create new pdf and add our new canvas as an image
						var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
						pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
						
						// download the pdf
						pdf.save('reporte.pdf');
					});
				} );
			</script>
		<?php endif ?>
		<?php if ( $data_post['type'] == 'eventos' ): ?>
			<div class="text-center">
				<div id="wrapChart_2" class="mb-4">
					<canvas id="myChart2" ></canvas>
				</div>
				<p><a href="#" id="downloadPdf" class="btn btn-primary">Descargar</a></p>
			</div>
			<script>
				jQuery( window ).ready( function () {
					var data = <?= json_encode( $data_graf ); ?>;
					var data_chart = {
						type: 'horizontalBar',
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
								display: false,
								position: 'top',
							},
							title: {
								display: false,
								text: 'Chart.js Doughnut Chart'
							},
							animation: {
								animateScale: true,
								animateRotate: true
							},
							scales: {
								xAxes: [{
									display: true,
									ticks: {
										min: 0,
										stepSize: 1
									}
								}]
							}
						}
					};
					if( data ) {
						for (var key in data) {
							if (!data.hasOwnProperty(key)) continue;

							var obj = data[key];
							console.log( obj );
							data_chart.data.labels.push( obj.name ); 
							data_chart.data.datasets[0].data.push( obj.total ); 
						}
					}
					var ctx = document.getElementById("myChart2");
					var myChart = new Chart(ctx, data_chart);

					$('#downloadPdf').click(function(event) {
						// get size of report page
						var reportPageHeight = $('#wrapChart_2').innerHeight();
						var reportPageWidth = $('#wrapChart_2').innerWidth();
						
						// create a new canvas object that we will populate with all other canvas objects
						var pdfCanvas = $('<canvas />').attr({
							id: "canvaspdf",
							width: reportPageWidth,
							height: reportPageHeight
						});
						
						// keep track canvas position
						var pdfctx = $(pdfCanvas)[0].getContext('2d');
						var pdfctxX = 0;
						var pdfctxY = 0;
						var buffer = 100;
						
						// for each chart.js chart
						$("canvas").each(function(index) {
							// get the chart height/width
							var canvasHeight = $(this).innerHeight();
							var canvasWidth = $(this).innerWidth();
							
							// draw the chart into the new canvas
							pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
							pdfctxX += canvasWidth + buffer;
							
							// our report page is in a grid pattern so replicate that in the new canvas
							if (index % 2 === 1) {
								pdfctxX = 0;
								pdfctxY += canvasHeight + buffer;
							}
						});
						
						// create new pdf and add our new canvas as an image
						var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
						pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
						
						// download the pdf
						pdf.save('reporte.pdf');
					});
				} );
			</script>
		<?php endif ?>
		<?php if ( $data_post['type'] == 'valoracion' ): ?>
			<div class="text-center">
				<div id="wrapChart_2" class="mb-4">
					<canvas id="myChart2" ></canvas>
				</div>
				<p><a href="#" id="downloadPdf" class="btn btn-primary">Descargar</a></p>
			</div>
			<script>
				jQuery( window ).ready( function () {
					var data = <?= json_encode( $data_graf ); ?>;
					var data_chart = {
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
								display: false,
								position: 'top',
							},
							title: {
								display: false,
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
					if( data ) {
						for (var key in data) {
							if (!data.hasOwnProperty(key)) continue;

							var obj = data[key];
							console.log( obj );
							data_chart.data.labels.push( obj.name ); 
							data_chart.data.datasets[0].data.push( obj.total ); 
						}
					}
					var ctx = document.getElementById("myChart2");
					var myChart = new Chart(ctx, data_chart);

					$('#downloadPdf').click(function(event) {
						// get size of report page
						var reportPageHeight = $('#wrapChart_2').innerHeight();
						var reportPageWidth = $('#wrapChart_2').innerWidth();
						
						// create a new canvas object that we will populate with all other canvas objects
						var pdfCanvas = $('<canvas />').attr({
							id: "canvaspdf",
							width: reportPageWidth,
							height: reportPageHeight
						});
						
						// keep track canvas position
						var pdfctx = $(pdfCanvas)[0].getContext('2d');
						var pdfctxX = 0;
						var pdfctxY = 0;
						var buffer = 100;
						
						// for each chart.js chart
						$("canvas").each(function(index) {
							// get the chart height/width
							var canvasHeight = $(this).innerHeight();
							var canvasWidth = $(this).innerWidth();
							
							// draw the chart into the new canvas
							pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
							pdfctxX += canvasWidth + buffer;
							
							// our report page is in a grid pattern so replicate that in the new canvas
							if (index % 2 === 1) {
								pdfctxX = 0;
								pdfctxY += canvasHeight + buffer;
							}
						});
						
						// create new pdf and add our new canvas as an image
						var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
						pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
						
						// download the pdf
						pdf.save('reporte.pdf');
					});
				} );
			</script>
		<?php endif ?>
		<?php if ( $data_post['type'] == 'servicios' ): ?>
			<div class="text-center">
				<div id="wrapChart_2" class="mb-4">
					<canvas id="myChart2" ></canvas>
				</div>
				<p><a href="#" id="downloadPdf" class="btn btn-primary">Descargar</a></p>
			</div>
			<script>
				jQuery( window ).ready( function () {
					var data = <?= json_encode( $data_graf ); ?>;
					var data_chart = {
						type: 'line',
						data: {
							labels: [],
							datasets: [{
								label: 'Servicios reservados',
								data: [],
								backgroundColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)',
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
								display: false,
								position: 'top',
							},
							title: {
								display: false,
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
					if( data ) {
						for (var key in data) {
							if (!data.hasOwnProperty(key)) continue;
							var obj = data[key];
							console.log( obj );
							data_chart.data.labels.push( obj.name ); 
							data_chart.data.datasets[0].data.push( obj.total ); 
						}
					}
					var ctx = document.getElementById("myChart2");
					var myChart = new Chart(ctx, data_chart);

					$('#downloadPdf').click(function(event) {
						// get size of report page
						var reportPageHeight = $('#wrapChart_2').innerHeight();
						var reportPageWidth = $('#wrapChart_2').innerWidth();
						
						// create a new canvas object that we will populate with all other canvas objects
						var pdfCanvas = $('<canvas />').attr({
							id: "canvaspdf",
							width: reportPageWidth,
							height: reportPageHeight
						});
						
						// keep track canvas position
						var pdfctx = $(pdfCanvas)[0].getContext('2d');
						var pdfctxX = 0;
						var pdfctxY = 0;
						var buffer = 100;
						
						// for each chart.js chart
						$("canvas").each(function(index) {
							// get the chart height/width
							var canvasHeight = $(this).innerHeight();
							var canvasWidth = $(this).innerWidth();
							
							// draw the chart into the new canvas
							pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
							pdfctxX += canvasWidth + buffer;
							
							// our report page is in a grid pattern so replicate that in the new canvas
							if (index % 2 === 1) {
								pdfctxX = 0;
								pdfctxY += canvasHeight + buffer;
							}
						});
						
						// create new pdf and add our new canvas as an image
						var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
						pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
						
						// download the pdf
						pdf.save('reporte.pdf');
					});
				} );
			</script>
		<?php endif ?>
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
		<pre><?php //print_r( $list ); ?></pre>
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
						<?php if ( $list && count( $list ) ): ?>
							<?php foreach ($list as $key => $row): ?>
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
			<?php if ( $data_post['type'] == 'servicios' ): ?>
				<table id="list" class="table table-bordered">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Servicios</th>
							<th>Fecha reserva</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( $list && count( $list ) ): ?>
							<?php foreach ($list as $key => $row): ?>
								<tr>
									<td><?= $row['usuario'] ?></td>
									<td><?= $row['name'] ?></td>
									<td><?= $row['visitanteFecha'] ?></td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			<?php endif ?>
			<?php if ( $data_post['type'] == 'eventos' ): ?>
				<table id="list" class="table table-bordered">
					<thead>
						<tr>
							<th>Evento</th>
							<th>Organizador</th>
							<th>Fecha</th>
							<th>Donaciones</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( $list && count( $list ) ): ?>
							<?php foreach ($list as $key => $row): ?>
								<tr>
									<td><?= $row['name'] ?></td>
									<td><?= $row['organizer'] ?></td>
									<td><?= $row['dateEvent'] ?></td>
									<td><?= $row['donaciones'] ?></td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			<?php endif ?>
			<?php if ( $data_post['type'] == 'cuentas' ): ?>
				<table id="list" class="table table-bordered">
					<thead>
						<tr>
							<th>Usuario</th>
							<th>Ubicación</th>
							<th>Asignaciones</th>
						</tr>
					</thead>
					<tbody>
						<?php if ( $list && count( $list ) ): ?>
							<?php foreach ($list as $key => $row): ?>
								<tr>
									<td><?= $row['fullName'] ?></td>
									<td><?= $row['location'] ?></td>
									<td><?= $row['total'] ?></td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
	</div>
</div>