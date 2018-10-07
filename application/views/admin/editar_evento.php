<div class="pt-2">
	 <?php 
		$evento_id 			= $evento['id'];
		$photo = '';
		if( $this->input->post('is_submitted') ) {
			$name			= set_value('name');
			$description	= set_value('description');
			$organizer		= set_value('organizer');
			$location		= set_value('location');
			$dateEvent		= set_value('dateEvent');
			$photo		= $evento['photo'];
		} else {
			$name			= $evento['name'];
			$description	= $evento['description'];
			$organizer		= $evento['organizer'];
			$location		= $evento['location'];
			$dateEvent		= $evento['dateEvent'];
			$photo		= $evento['photo'];
		}
	?>
	<div class="row">
		<?=	form_open_multipart('admin/eventos/editar/'.$evento_id,[ 'data-toggle'=>"validator", 'class'=>'col-12 col-xl-5']) ?>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<div class="form-group">
				<label for="name">Título</label> 
				<input id="name" name="name" data-required-error="Por favor ingresa un titulo para el evento" value="<?= $name ?>" type="text" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="description">Descripción</label> 
				<textarea name="description" data-required-error="Por favor ingresa una descripción para el evento" required="required" class="form-control" id="description" cols="30" rows="5"><?= $description ?></textarea>
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="organizer">Organizador</label> 
				<input id="organizer" data-required-error="¿Quién sera el organizador del evento?" name="organizer" value="<?= $organizer ?>" type="text" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="location">Ubicación</label> 
				<input id="location" data-required-error="¿Donde será el evento?" name="location" value="<?= $location ?>" type="text" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="dateEvent">Fecha</label> 
				<div class="input-group date">
					<input id="dateEvent" data-required-error="¿Cuándo será el evento?" readonly value="<?= $dateEvent ?>" name="dateEvent" type="text" required="required" class="form-control"><span class="input-group-addon" style="display: none;"></span>
				</div>
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="dateEvent">Foto</label> 
				<?php if ( $photo ): ?>
					<img src="<?= $photo ?>" class="img-fluid mb-4 img-thumbnail rounded mx-auto d-block" width="350">
				<?php endif ?>
				<div class="input-group">
					<input type="file" class="form-control-file" name="photo">
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-primary">Actualizar</button>
				 <a class="btn btn-cancel" href="<?= base_url( '/admin/eventos' ) ?>">Cancelar</a>
			</div>
		</form>
	</div>
</div>
