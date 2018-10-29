<?php if ( $posts && count( $posts ) ): ?>
	<div class="pt-2 row">
		<?php foreach ($posts as $key => $post): ?>
			<div class="col-md-4">
				<div class="card mb-4 shadow-sm">
					<ul class="slider-wrapper">
					<li class="current-slide">
					<?php if ( isset($post['photo']) && $post['photo'] ): ?>
						<a href="<?= base_url( '/ubicaciones/ver/'.$post['slug'] )  ?>"><img class="card-img-top img-fluid" alt="<?= $post['name'] ?>" src="<?= $post['photo'] ?>" data-holder-rendered="true"></a>
					<?php endif ?>
					<div class="caption">
						<h4 class="slider-title mb-0"><a href="<?= base_url( '/ubicaciones/ver/'.$post['slug'] )  ?>"><?= $post['name'] ?></a></h4>
						<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
							
							<?php if ( $this->session->userdata['rol'] == 4 ): ?>
								<div class="text mt-3"><a class="btn btn-primary" href="<?= base_url( '/ubicaciones/seleccionar/'.$post['slug'] )  ?>">Seleccionar beneficiario</a></div>
							<?php endif ?>
						<?php endif ?>
					</div>
				</div>
			</li>
		</ul>
			</div>
		<?php endforeach ?>
	</div>
<?php endif ?>