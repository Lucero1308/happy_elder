	<?php if ( $this->session->userdata('id') ): ?>
		<form action="<?=  base_url()?>calificaciones_beneficiarios/comentar/<?= $usuario['hash'] ?>" method="post">
			<div class="form-group">
				<label>Valoración</label>
				<nav class="navbar navbar-expand-lg p-0">
					<p class="clasificacion navbar-nav">
						<input id="radio1" type="radio" name="estrellas" value="5">
						<label for="radio1">★</label>
						<input id="radio2" type="radio" name="estrellas" value="4">
						<label for="radio2">★</label>
						<input id="radio3" type="radio" name="estrellas" value="3">
						<label for="radio3">★</label>
						<input id="radio4" type="radio" name="estrellas" value="2">
						<label for="radio4">★</label>
						<input id="radio5" type="radio" name="estrellas" value="1">
						<label for="radio5">★</label>
					</p>
				</nav>
			</div>
			<div class="form-group">
				<label>Comentario</label>
				<textarea class="form-control" data-required-error="Ingresa un comentario" required="" rows="4" cols="100" name="comment" rows="3"></textarea>
				<div class="help-block with-errors"></div>
			</div>
			<div class="form-group">
				<label>Subir con foto:</label>
			</div>
			<div class="form-group text-center">
				<input type="file" class="form-control-file" required="" name="photo">
			</div>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Comentar</button>
			</div>
		</form>
	<?php else: ?>
		<a href="<?=  base_url()?>cuenta/login">Inicia sesión para comentar.</a>
	<?php endif ?>
	<div class="comments-container">
		<?php if ( $comments && count( $comments ) ): ?>
			<ul id="comments-list" class="comments-list list-unstyled">
				<?php foreach ($comments as $key => $comment): ?>
					<li>
						<div class="comment-main-level">
							<div class="comment-avatar">
								<img class="img-thumbnail" width="200" height="200" src="<?= $comment['photo'] ?>" alt="Card image cap">
							</div>
							<div class="comment-box">
								<div class="comment-head">
									<h6 class="comment-name <?= $usuario['id'] == $comment['user_id'] ? 'by-author' : '' ?>"><?= $comment['fullName'] ?></h6>
									<?php $now = date(''); ?>
									<span>hace <?= timespan(strtotime( $comment['date_added'] ), $now) . ''; ?></span>
									<?php if ( $comment['val'] ): ?>
										<nav class="navbar navbar-expand-lg p-0">
											<p class="clasificacion_single navbar-nav">
												<?php for ($i=1; $i < 6; $i++) : ?>
													<label for="" style="<?= $comment['val'] >= $i ? "color: orange" : ''; ?>">★</label>
												<?php endfor ?>
											</p>
										</nav>
									<?php endif ?>
								</div>
								<div class="comment-content">
									<p><?= $comment['comment'] ?></p>
								</div>
							</div>
						</div>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</div>