<?php if ( $posts ): ?>
	<div class="pt-2 row">
	<?php foreach ($posts as $key => $post): ?>
		<div class="col-md-4">
			<div class="card mb-4 shadow-sm">
				<ul class="slider-wrapper">
					<li class="current-slide">
				<?php if ( isset($post['photo']) && $post['photo'] ): ?>
					<a href="<?= base_url( '/eventos/ver/'.$post['slug'] )  ?>"><img class="card-img-top img-fluid" alt="<?= $post['name'] ?>" src="<?= $post['photo'] ?>" data-holder-rendered="true"></a>
				<?php endif ?>
				<div class="caption">
					<h5 class="slider-title"><a href="<?= base_url( '/eventos/ver/'.$post['slug'] )  ?>"><?= $post['name'] ?></a></h5>
					<!-- <div class="card-text"><?= $post['description'] ?></div> -->
				</div>
			</div>
		</li>
	</ul>
		</div>
	<?php endforeach ?>
	</div>
<?php endif ?>
