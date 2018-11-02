<?php if ( $servicio ): ?>

    <section class="page-section about-heading">
      <div class="container">
        <center><img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="<?= $servicio['photo'] ?>" alt="" width="800px" height="70px" ></center>
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <span class="section-heading-upper">BENEFICIOSO: <?= $servicio['usuario'] ?></span>
                  <p></p>
                  <span class="section-heading-lower">DISPONIBILIDAD: <?= $servicio['schedule'] ?></span>
                </h2>
                <p style="text-align: justify;"><?= $servicio['description'] ?></p>
                                	
<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
		<?php if ( $this->session->userdata['rol'] == 2 ): ?> 
			<!-- CONDICIONAL -->
			<i><p style="font-family: 'Malgun Gothic Semilight';">PRECIO DEL SERVICIO: S/. <?= $servicio['price'] ?></p></i>
			<center><a class="btn btn-success" href="<?= base_url( '/servicios/reservar/'.$servicio['slug'] )  ?>">Reservar servicio</a></center>
		<?php endif ?>

	<?php endif ?>

                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php endif ?>
<center><a class="btn btn-cancel" href="<?= base_url( '/servicios')?>">Regresar</a></center>

