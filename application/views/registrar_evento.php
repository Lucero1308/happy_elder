<div class="pt-2">
	 <?php 
		if( $this->input->post('is_submitted') ) {
			$name			= set_value('name');
			$description	= set_value('description');
			$organizer		= set_value('organizer');
			$location		= set_value('location');
			$dateEvent		= set_value('dateEvent');
		} else {
			$name			= '';
			$description	= '';
			$organizer		= '';
			$location		= '';
			$dateEvent		= '';
		}
	?>
	<div class="row">
		<?=	form_open_multipart('cuenta/registrar_evento/',['data-toggle'=>"validator",'class'=>'col-12 col-xl-5']) ?>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<div class="form-group">
				<label for="name">Título</label> 
				<input id="name" name="name" value="<?= $name ?>" type="text" data-required-error="CAMBIAR TEXTO" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="description">Descripción</label> 
				<textarea name="description" data-required-error="CAMBIAR TEXTO" required="required" class="form-control" id="description" cols="30" rows="5"><?= $description ?></textarea>
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="organizer">Organizador</label> 
				<input id="organizer" name="organizer" value="<?= $organizer ?>" type="text" data-required-error="CAMBIAR TEXTO" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="location">Ubicación</label> 
				<input id="location" name="location" value="<?= $location ?>" type="text" data-required-error="CAMBIAR TEXTO" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="dateEvent">Fecha</label> 
				<input id="dateEvent" name="dateEvent" value="<?= $dateEvent ?>" type="text" data-required-error="CAMBIAR TEXTO" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<input type="file" class="form-control-file" name="photo">
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-primary">Actualizar</button>
				 <a class="btn btn-cancel" href="<?= base_url( '/cuenta/eventos' ) ?>">Cancelar</a>
			</div>
		</form>
	</div>
</div>
