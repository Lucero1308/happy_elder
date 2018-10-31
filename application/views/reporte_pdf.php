<?php $this->load->view('header_single')?>
<h2 align="center">Reporte - 
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
<?php if ( $data_grafics && count( $data_grafics ) ): ?>
	<?php foreach ($data_grafics as $key => $grafi): ?>
		<table class="table table-borderless table-sm" style="page-break-after: always;">
			<tbody>
				<tr>
					<td class="text-center">
						<img width="350" class="mt-3" src="<?= $grafi['photo'] ?>" >
					</td>
				</tr>
				<tr>
					<td>
						<?php if ( $grafi['names'] ): ?>
							<?php if ( $data_post['type'] == 'valoracion' ): ?>
								<table class="table table-sm">
									<thead>
										<tr>
											<td>#</td>
											<td>Nombre</td>
											<td>Total caloficaciones</td>
											<td>Promedio</td>
										</tr>
									</thead>
									<?php foreach ($grafi['names'] as $key => $name): ?>
										<tr>
											<td><?= $key + 1 ?></td>
											<td><?= $name['nombre'] ?></td>
											<td><?= $name[ 'total' ] ?></td>
											<td><?= $name['avg'] ?></td>
										</tr>
									<?php endforeach ?>
								</table>
							<?php endif ?>
						<?php endif ?>
					</td>
				</tr>
			</tbody>
		</table>
	<?php endforeach ?>
<?php endif; ?>
<?php $this->load->view('footer_single'); ?>
