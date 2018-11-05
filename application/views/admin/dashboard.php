<div class="row">

        <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>  	
                 <b><div class="mr-5">Cant.servicios</div></b>
                 <?php if ( $servicios && count( $servicios ) ): ?>
                  <div class="col-xs-9 text-right">
                  	<?php $total = 0; ?>
				<?php foreach ($servicios as $key => $row): $total+=$row['count'] ?>
				<?php endforeach ?>
                  	<h2 style="color: black;"><?= $total ?></h2>
                     </div>
                </div>
              </div>
            </div>
	<?php endif ?>

            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <b><div class="mr-5">Cant. ubicaciones</div></b>
                  <?php if ( $ubicaciones && count( $ubicaciones ) ): ?>
                  <div class="col-xs-9 text-right">
                  	<?php $total = 0; ?>
                  	<?php foreach ($ubicaciones as $key => $row): $total+=$row['count'] ?>
                  	<?php endforeach ?>
                        <h2 style="color: black;"><?= $total ?></h2>
                     </div>
                </div>
	<?php endif ?>

              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <b><div class="mr-5">Cant. eventos</div></b>
                 <?php if ( $eventos && count( $eventos ) ): ?>
                   <div class="col-xs-9 text-right">
                   	<?php $total = 0; ?>
					<?php foreach ($eventos as $key => $row): $total+=$row['count'] ?>
					<?php endforeach ?>
                   	<h2 style="color: black;"><?= $total ?></h2>
                     </div>
                </div>
              </div>
            </div>
	<?php endif ?>

            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <b><div class="mr-5">Total de usuarios</div></b>	
            <?php if ( $usuarios && count( $usuarios ) ): ?>
            	<div class="col-xs-9 text-right">
            		<?php $total = 0; ?>
					<?php foreach ($usuarios as $key => $row): $total+=$row['count'] ?>
					<?php endforeach ?>
            		<h2 style="color: black;"><?= $total ?></h2>
                     </div>
                </div>
              </div>
            </div>



		<div class="col-12">
			<canvas class="my-4 w-100" id="myChart" width="1740" height="733"></canvas>
		</div>  <!-- si se elimina este cod, no figura imagen -->
		<script>
			jQuery( window ).ready( function () {
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
						// para el nombre de abajo
						data_chart.data.datasets[0].data.push( type_user.count ); 
						// datos,cantidad
					});
				}
				var ctx = document.getElementById("myChart");
				var myChart = new Chart(ctx, data_chart);
			} );
		</script>
</div>


   <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Detalle de la página</div>
            <div class="card-body">
            <div class="row">
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
            </div>
</div>