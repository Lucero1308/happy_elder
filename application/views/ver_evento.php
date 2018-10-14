<?php if ( $evento ): ?>
	<div class="text-center mb-3">
		<img class="img-fluid img-thumbnail" alt="<?= $evento['name'] ?>" src="<?= $evento['photo'] ?>" >
	</div>
	<h6 class="font-italic btn btn-outline-warning">Descripcion del evento:</h6>
	<div class="cart-text" align="center"><?= $evento['description'] ?></div>
	<hr>
	<h6 class="font-italic btn btn-outline-warning">Organizador:</h6>
	<div class="cart-text" align="center"><?= $evento['organizer'] ?></div>
	<hr>
	<h6 class="font-italic btn btn-outline-warning">Ubicación:</h6>
	<div class="cart-text" align="center"><?= $evento['location'] ?></div>
	<hr>
	<h6 class="font-italic btn btn-outline-warning">Donar:</h6>
	<div class="text-center">
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="item_name" value="<?= $evento['name'] ?>">
			<INPUT TYPE="hidden" NAME="return" value="<?= base_url() ?>eventos/ver/<?= $evento['slug'] ?>?action=complete">
			<input type="hidden" name="hosted_button_id" value="MSUUZDMNXQBAY">
			<input type="image" src="https://www.sandbox.paypal.com/es_ES/ES/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
			<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
	</div>
	<hr>
<?php endif ?>
<a class="btn btn-cancel" href="<?= base_url( '/eventos')?>">Regresar</a>
