<?php if ( $servicio ): ?>
	<div class="text-center mb-3">
		<img class="img-fluid img-thumbnail" alt="<?= $servicio['name'] ?>" src="<?= $servicio['photo'] ?>" >
	</div>
	<h6 class="font-italic btn btn-outline-warning">Descripcion del servicio:</h6><div align="center"><?= $servicio['description'] ?></div>
	<hr>
	<h6 class="font-italic btn btn-outline-warning">Disponibilidad:</h6><div class="cart-text" align="center"><?= $servicio['schedule'] ?></div>
	<hr>
	<h6 class="font-italic btn btn-outline-warning">Beneficiario:</h6><div class="cart-text" align="center"><?= $servicio['usuario'] ?></div>
	<hr>
	<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
		<?php if ( $this->session->userdata['rol'] == 2 ): ?> 
			<!-- CONDICIONAL -->
			<h6 class="font-italic btn btn-outline-warning">Precio del servicio:</h6><div class="cart-text" align="center"><?= $servicio['price'] ?></div>
			<hr>
			<br/><a class="btn btn-primary" href="<?= base_url( '/servicios/reservar/'.$servicio['slug'] )  ?>">Reservar servicio</a>
		<?php endif ?>

	<?php endif ?>
<?php endif ?>
<a class="btn btn-cancel" href="<?= base_url( '/servicios')?>">Regresar</a>