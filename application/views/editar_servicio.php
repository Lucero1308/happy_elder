<div class="pt-2">
	 <?php 
		$servicio_id 		= $servicio['id'];
		if( $this->input->post('is_submitted') ) {
			$name			= set_value('name');
			$description	= set_value('description');
			$price			= set_value('price');
			$schedule		= set_value('schedule');
		} else {
			$name			= $servicio['name'];
			$description	= $servicio['description'];
			$price			= $servicio['price'];
			$schedule		= $servicio['schedule'];
		}
	?>
	<div class="row">
		<?=	form_open_multipart('cuenta/editar_servicio/'.$servicio_id,['data-toggle'=>"validator",'class'=>'col-12 col-xl-5']) ?>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<div class="form-group">
				<label for="name">Título</label> 
				<input id="name" name="name" value="<?= $name ?>" type="text" data-required-error="Por favor ingresa un título" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="description">Descripción</label> 
				<textarea name="description" data-required-error="Es necesario que el servicio tenga una descripcion" required="required" class="form-control" id="description" cols="30" rows="5"><?= $description ?></textarea>
				<div class="help-block with-errors"	></div>
			</div>
			<div class="form-group">
				<label for="schedule">Horario</label> 
				<input id="schedule" name="schedule" value="<?= $schedule ?>" type="text" data-required-error="Es necesario que establezca un horario" required="required" class="form-control">
				<div class="help-block with-errors"	></div>
			</div>
			<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['id'] ) ): ?>
				<?php if ( $this->session->userdata['rol'] != 3 ): ?>
					<div class="form-group">
						<label for="price">Precio</label> 
						<input id="price" name="price" value="<?= $price ?>" type="number" data-required-error="¿Cuál es el precio que se cobrará?" required="required" class="form-control">
						<div class="help-block with-errors"	></div>
					</div>
				<?php endif ?>
			<?php endif ?>
			<div class="form-group">
				<div class="input-group">
					<input type="file" class="form-control-file" name="photo">
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="is_submitted" value="1">
				<button type="submit" class="btn btn-primary">Actualizar</button>
				 <a class="btn btn-cancel" href="<?= base_url( '/cuenta/servicios' ) ?>">Cancelar</a>
			</div>
		</form>
	</div>
</div>
