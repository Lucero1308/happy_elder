<?php if ( $ubicacion ): ?>
	<div class="text-center mb-3">
		<img class="img-fluid img-thumbnail" alt="<?= $ubicacion['name'] ?>" src="<?= $ubicacion['photo'] ?>" >
	</div>
	<h6 class="font-italic btn btn-outline-warning">Descripción</h6><div class="cart-text" align="center"><?= $ubicacion['description'] ?></div>
	<hr>
	<h6 class="font-italic btn btn-outline-warning">Ubicación</h6><div class="cart-text" align="center"><?= $ubicacion['address'] ?></div>
	<hr>
	<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
		<?php if ( $this->session->userdata['rol'] == 4 ): ?>
		<br/><a class="btn btn-primary" href="<?= base_url( '/ubicaciones/seleccionar/'.$ubicacion['slug'] )  ?>">Seleccionar beneficiario</a>
			<?php endif ?>
		<?php endif ?>
<?php endif ?>
<a class="btn btn-cancel" href="<?= base_url( '/ubicaciones')?>">Regresar</a>





