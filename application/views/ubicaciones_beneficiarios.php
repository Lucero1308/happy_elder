<div class="pt-2">
	<div class="table-responsive">
		<table class="table-hover table table-bordered">
			<tr>
				<th width="300">Nombre</th>

			</tr>
			<?php if ( isset( $list ) && $list && count( $list ) ): ?>
				<?php foreach ($list as $key => $row): ?>
					<tr>
						<td><?= $row['fullName'] ?></td>

					</tr>
				<?php endforeach ?>
			<?php endif ?>
		</table>
	</div>
</div>
