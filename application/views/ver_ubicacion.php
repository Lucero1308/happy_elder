<?php if ( $ubicacion ): ?>
	<div class="text-center mb-3">
		<img class="img-fluid img-thumbnail" alt="<?= $ubicacion['name'] ?>" src="<?= $ubicacion['photo'] ?>" >
	</div>
	<div class="cart-text"><?= $ubicacion['description'] ?></div>
<?php endif ?>