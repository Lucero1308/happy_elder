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
		<?=	form_open_multipart('admin/eventos/registrar/',['data-toggle'=>"validator",'class'=>'col-12 col-xl-5']) ?>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<div class="form-group">
				<label for="name">Título</label> 
				<input id="name" name="name" value="<?= $name ?>" type="text" data-required-error="Por favor ingresa el título del evento" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="description">Descripción</label> 
				<textarea name="description" data-required-error="Por favor ingresa una descripción" required="required" class="form-control" id="description" cols="30" rows="5"><?= $description ?></textarea>
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="organizer">Organizador</label> 
				<input id="organizer" name="organizer" value="<?= $organizer ?>" type="text" data-required-error="¿Quién es el organizador?" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="location">Ubicación</label> 
				<input id="location" name="location" value="<?= $location ?>" type="text" data-required-error="¿Dónde será el evento?" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="dateEvent">Fecha</label>
				<div class="input-group date">
					<input id="dateEvent" value="<?= $dateEvent ?>" readonly name="dateEvent" type="text" data-required-error="¿Cuándo será el evento?" required="required" class="form-control"><span class="input-group-addon" style="display: none;"></span>
				</div>
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<input type="file" class="form-control-file" name="photo">
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-primary">Registrar</button>
				 <a class="btn btn-cancel" href="<?= base_url( '/admin/eventos' ) ?>">Cancelar</a>
			</div>
		</form>
	</div>
</div>
