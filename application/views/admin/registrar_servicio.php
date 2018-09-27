<div class="pt-2">
	 <?php 
		if( $this->input->post('is_submitted') ) {
			$name			= set_value('name');
			$description	= set_value('description');
			$price			= set_value('price');
			$schedule		= set_value('schedule');
		} else {
			$name			= '';
			$description	= '';
			$price			= '';
			$schedule		= '';
		}
	?>
	<div class="row">
		<?=	form_open_multipart('',['data-toggle'=>"validator",'class'=>'col-12 col-xl-5']) ?>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<div class="form-group">
				<label for="name">Título</label> 
				<input id="name" name="name" value="<?= $name ?>" type="text" data-required-error="Es necesario que coloques un título" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="description">Descripción</label> 
				<textarea name="description" data-required-error="Es necesario que coloques una descripción" required="required" class="form-control" id="description" cols="30" rows="5"><?= $description ?></textarea>
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="schedule">Horario</label> 
				<input id="schedule" name="schedule" value="<?= $schedule ?>" type="text" data-required-error="Por favor ingresa tu disponibilidad" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="price">Precio</label> 
				<input id="price" name="price" value="<?= $price ?>" type="number" data-required-error="Por favor ingresa tu precio required="required" class="form-control">
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
				 <a class="btn btn-cancel" href="<?= base_url( '/admin/servicios' ) ?>">Cancelar</a>
			</div>
		</form>
	</div>
</div>
