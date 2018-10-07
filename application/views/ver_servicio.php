<?php if ( $servicio ): ?>
	<div class="text-center mb-3">
		<img class="img-fluid img-thumbnail" alt="<?= $servicio['name'] ?>" src="<?= $servicio['photo'] ?>" >
	</div>
	<div class="cart-text"><?= $servicio['description'] ?></div>
	<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
		<?php if ( $this->session->userdata['rol'] == 2 ): ?> 
			<!-- CONDICIONAL -->
			<div class="text mt-3"><a class="btn btn-primary" href="<?= base_url( '/servicios/reservar/'.$servicio['slug'] )  ?>">Reservar servicio</a></div>
		<?php endif ?>

	<?php endif ?>
<?php endif ?>