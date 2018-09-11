<div class="pt-2">
	 <?php 
		if( $this->input->post('is_submitted') ) {
			$name			= set_value('name');
			$description	= set_value('description');
			$address		= set_value('address');
		} else {
			$name			= '';
			$description	= '';
			$address		= '';
		}
	?>
	<div class="row">
		<?=	form_open_multipart('admin/ubicaciones/registrar/',['class'=>'col-12 col-xl-5']) ?>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<div class="form-group">
				<label for="name">Título</label> 
				<input id="name" name="name" value="<?= $name ?>" type="text" required="required" class="form-control">
			</div>
			<div class="form-group">
				<label for="description">Descripción</label> 
				<textarea name="description" required="required" class="form-control" id="description" cols="30" rows="5"><?= $description ?></textarea>
			</div>
			<div class="form-group">
				<label for="address">Dirección</label> 
				<input id="address" name="address" value="<?= $address ?>" type="text" required="required" class="form-control">
			</div>
			<div class="form-group">
				<div class="input-group">
					<input type="file" class="form-control-file" name="photo">
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-primary">Registrar</button>
				 <a class="btn btn-cancel" href="<?= base_url( '/admin/ubicaciones' ) ?>">Cancelar</a>
			</div>
		</form>
	</div>
</div>
