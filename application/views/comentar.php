	<?php if ( $this->session->userdata('id') ): ?>
		<form enctype="multipart/form-data" action="<?=  base_url()?>calificaciones_beneficiarios/comentar/<?= $usuario['hash'] ?>" method="post">
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
				<input type="file" class="form-control-file" name="photo">
			</div>
			<div class="form-group">
				<label>Subir con video:</label>
				<input type="file" class="form-control-file" name="video">
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
								<img class="img-thumbnail" width="200" height="200" src="<?= $comment['photoUser'] ?>" alt="Card image cap">
							</div>
							<div class="comment-box">
								<div class="comment-head">
									<h6 class="comment-name <?= $usuario['id'] == $comment['user_id'] ? 'by-author' : '' ?>"><?= $comment['fullName'] ?></h6>
									<?php $now = date(''); ?>
									<span>hace <?= timespan(strtotime( $comment['date_added'] ), $now) . ''; ?></span>
									<?php if ( $this->session->userdata('rol') == 1 || $comment['user_id'] == $this->session->userdata('id') ): ?>
										<p style="clear: both; " >
											<a onclick="return confirm('¿Seguro que quiere eliminar este comentario?')"  href="<?=  base_url()?>calificaciones_beneficiarios/eliminar/<?= $usuario['hash'] ?>/<?= $comment['comment_id'] ?>">Eliminar</a>
										</p>
									<?php endif ?>
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
									<?php if ( $comment['photo'] ): ?>
										<p>
											<img class="img-thumbnail" style="max-width: 250px" src="<?= $comment['photo'] ?>" alt="Card image cap">
										</p>
									<?php endif ?>
									<?php if ( $comment['video'] ): ?>
										<p>
											<video src="<?= $comment['video'] ?>" controls ></video>
										</p>
									<?php endif ?>
								</div>
							</div>
						</div>
					</li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
	</div>