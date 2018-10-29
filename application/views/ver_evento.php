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
		<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="item_name" value="<?= $evento['name'] ?>"> <!-- jalar el nombre del evento en paypal -->
				<INPUT TYPE="hidden" NAME="return" value="<?= base_url() ?>eventos/ver/<?= $evento['slug'] ?>?action=complete"> <!-- regresar a la pagina -->
				<input type="hidden" name="currency_code" value="PEN">
				<input type="hidden" name="hosted_button_id" value="MSUUZDMNXQBAY">
				<input type="image" src="https://www.sandbox.paypal.com/es_ES/ES/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
				<img alt="" border="0" src="https://www.sandbox.paypal.com/en_PE/i/scr/pixel.gif" width="1" height="1">
			</form>
		<?php else: ?>
			<!-- aqui valida que un usuario se haya logueado -->
			Debes iniciar sesión para hacer una donación
		<?php endif ?>
	</div>
	<hr>
<?php endif ?>
<center><a class="btn btn-cancel" href="<?= base_url( '/eventos')?>" >Regresar</a></center>
