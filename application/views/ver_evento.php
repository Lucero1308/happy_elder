<?php if ( $evento ): ?>
	<div class="text-center mb-3">
		<img class="img-fluid img-thumbnail" alt="<?= $evento['name'] ?>" src="<?= $evento['photo'] ?>" >
	</div>
	<h6 class="font-italic btn btn-outline-warning">Descripcion del evento:</h6><div class="cart-text" align="center"><?= $evento['description'] ?></div>
	<hr>
	<h6 class="font-italic btn btn-outline-warning">Organizador:</h6><div class="cart-text" align="center"><?= $evento['organizer'] ?></div>
	<hr>
	<h6 class="font-italic btn btn-outline-warning">Ubicación:</h6><div class="cart-text" align="center"><?= $evento['location'] ?></div>
	<hr>
<?php endif ?>
<a class="btn btn-cancel" href="<?= base_url( '/eventos')?>">Regresar</a>
