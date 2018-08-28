<?php if ( $evento ): ?>
	<div class="text-center mb-3">
		<img class="img-fluid img-thumbnail" alt="<?= $evento['name'] ?>" src="<?= $evento['photo'] ?>" >
	</div>
	<div class="cart-text"><?= $evento['description'] ?></div>
<?php endif ?>