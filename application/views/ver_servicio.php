<?php if ( $servicio ): ?>
	<div class="text-center mb-3">
		<img class="img-fluid img-thumbnail" alt="<?= $servicio['name'] ?>" src="<?= $servicio['photo'] ?>" >
	</div>
	<div class="cart-text"><?= $servicio['description'] ?></div>
<?php endif ?>