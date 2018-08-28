<?php if ( $posts && count( $posts ) ): ?>
	<div class="pt-2 row">
		<?php foreach ($posts as $key => $post): ?>
			<div class="col-md-4">
				<div class="card mb-4 shadow-sm">
					<?php if ( isset($post['photo']) && $post['photo'] ): ?>
						<a href="<?= base_url( '/ubicaciones/ver/'.$post['slug'] )  ?>"><img class="card-img-top img-fluid" alt="<?= $post['name'] ?>" src="<?= $post['photo'] ?>" data-holder-rendered="true"></a>
					<?php endif ?>
					<div class="card-body">
						<h4 class="card-title mb-0"><a href="<?= base_url( '/ubicaciones/ver/'.$post['slug'] )  ?>"><?= $post['name'] ?></a></h4>
						<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
							<?php if ( $this->session->userdata['rol'] == 2 ): ?>
								<div class="text mt-3"><a class="btn btn-primary" href="<?= base_url( '/ubicaciones/reservar/'.$post['id'] )  ?>">Reservar servicio</a></div>
							<?php endif ?>
						<?php endif ?>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
<?php endif ?>