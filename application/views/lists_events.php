<?php if ( $posts ): ?>
	<div class="pt-2 row">
	<?php foreach ($posts as $key => $post): ?>
		<div class="col-md-4">
			<div class="card mb-4 shadow-sm">
				<?php if ( isset($post['photo']) && $post['photo'] ): ?>
					<a href="<?= base_url( '/eventos/ver/'.$post['slug'] )  ?>"><img class="card-img-top img-fluid" alt="<?= $post['name'] ?>" src="<?= $post['photo'] ?>" data-holder-rendered="true"></a>
				<?php endif ?>
				<div class="card-body">
					<h4 class="card-title"><a href="<?= base_url( '/eventos/ver/'.$post['slug'] )  ?>"><?= $post['name'] ?></a></h4>
					<div class="card-text"><?= $post['description'] ?></div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
	</div>
<?php endif ?>