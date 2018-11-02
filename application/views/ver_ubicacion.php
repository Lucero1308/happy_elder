<?php if ( $ubicacion ): ?>



    <section class="page-section about-heading">
      <div class="container">
        <center><img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="<?= $ubicacion['photo'] ?>" alt="" width="800px" height="70px"></center>
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <span class="section-heading-upper">UBICACIÓN: <?= $ubicacion['address'] ?></span>
                </h2>
                <p style="text-align: justify;"><?= $ubicacion['description'] ?></p>

	<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
		<?php if ( $this->session->userdata['rol'] == 4 ): ?>
		<center><a class="btn btn-success" href="<?= base_url( '/ubicaciones/seleccionar/'.$ubicacion['slug'] )  ?>">Seleccionar beneficiario</a></center>
			<?php endif ?>
		<?php endif ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php endif ?>
<center><a class="btn btn-cancel" href="<?= base_url( '/ubicaciones')?>">Regresar</a></center>

