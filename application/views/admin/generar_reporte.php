<?php 
	if( $this->input->post('is_submitted') ) {
		$type			= set_value('type');
		$date_from			= set_value('date_from');
		$date_to			= set_value('date_to');
		$formato			= set_value('formato');
	} else {
		$type			= '';
		$date_from			= '';
		$date_to			= '';
		$formato			= '';
	}
?>
<div class="row">
	<form class="col-12 col-xl-5" action="" method="post" data-toggle="validator" >
		<?php if( isset($errors) ): ?>
			<div class="alert alert-danger text-left">
				<?php print_r($errors); ?>
			</div>
		<?php endif ?>
		<div class="form-group">
			<label for="type">Tipo</label> 
			<select id="type" data-required-error="Por favor selecciona un tipo" name="type" class="form-control" required="required">
				<option <?= $type == 'valoracion' ? "selected = 'selected'" : "" ;?> value="valoracion">Valoración</option>
				<option <?= $type == 'servicios' ? "selected = 'selected'" : "" ;?> value="servicios">Servicios</option>
				<option <?= $type == 'cuentas' ? "selected = 'selected'" : "" ;?> value="cuentas">Cuentas</option>
				<option <?= $type == 'eventos' ? "selected = 'selected'" : "" ;?> value="eventos">Eventos</option>
			</select>
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<label for="formato">Formato</label> 
			<select id="formato" data-required-error="Por favor selecciona un formato" name="formato" class="form-control" required="required">
				<option <?= $formato == 'pdf' ? "selected = 'selected'" : "" ;?> value="pdf">PDF</option>
				<option <?= $formato == 'xls' ? "selected = 'selected'" : "" ;?> value="xls">Excel</option>
			</select>
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<label for="inputUserName">Fecha</label> 
			<div class="input-daterange input-group" id="datepicker">
			    <input type="text" class="input-sm form-control" name="date_from" value="<?= $date_from ?>" />
			    <span class="input-group-addon px-2">Hasta</span>
			    <input type="text" class="input-sm form-control" name="date_to" value="<?= $date_to ?>" />
			</div>
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<input type="hidden" name="is_submitted" value="1">
			<button type="submit" class="btn btn-primary">Generar</button>
			<a class="btn btn-cancel" href="<?= base_url( '/admin/reportes' ) ?>">Cancelar</a>
		</div>
	</form>
</div>