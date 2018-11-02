<?php if ( $evento ): ?>





  <section class="page-section about-heading">
      <div class="container">
        <center><img class="img-fluid img-thumbnail" alt="<?= $evento['name'] ?>" src="<?= $evento['photo'] ?>" width="800px" height="70px" ></center>
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <span class="section-heading-upper">NOMBRE DEL ORGANIZADOR: <?= $evento['organizer'] ?></span>
                  <p></p>
                  <span class="section-heading-lower">UBICACIÓN: <?= $evento['location'] ?></span>
                </h2>
               <p style="text-align: justify;" ><?= $evento['description'] ?></p>
               <b><i><p style="font-family: 'Malgun Gothic Semilight';">Si quieres donar, dar clic en la opción:</p></i></b>
                <p>
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
                </p>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


	<hr>
<?php endif ?>
<center><a class="btn btn-cancel" href="<?= base_url( '/eventos')?>" >Regresar</a></center>

