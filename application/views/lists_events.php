<?php if ( $posts ): ?>
	<div class="py-5 row">
	<?php foreach ($posts as $key => $post): ?>
		<div class="col-md-4">
			<div class="card mb-4 shadow-sm">
				<?php if ( isset($post['photo']) && $post['photo'] ): ?>
					<img class="card-img-top img-fluid" alt="<?= $post['name'] ?>" style="display: block;" src="<?= $post['photo'] ?>" data-holder-rendered="true">
				<?php endif ?>
				<div class="card-body">
					<h4 class="card-title"><?= $post['name'] ?></h4>
					<div class="card-text"><?= $post['description'] ?></div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
	</div>
<?php endif ?>