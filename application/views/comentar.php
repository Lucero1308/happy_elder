	<?php if ( $this->session->userdata('id') ): ?>
		<form action="<?=  base_url()?>calificaciones_beneficiarios/comentar/<?= $usuario['hash'] ?>" method="post">
			<div class="form-group">
				<label>Comentario</label>
				<textarea class="form-control" data-required-error="Ingresa un comentario" required="" rows="4" cols="100" name="comment" rows="3"></textarea>
				<div class="help-block with-errors"></div>
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