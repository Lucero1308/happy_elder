
jQuery( document ).ready( function ( $ ) {
	$('#fechaVisita .input-group.date').datepicker({
		format: "yyyy-mm-dd",
		language: "es",
		endDate: "+6d",
		startDate: "now",
		autoclose: true,
	});
	$('#visitanteFecha .input-group.date').datepicker({
		format: "yyyy-mm-dd",
		language: "es",
		endDate: "+1m",
		startDate: "now",
		autoclose: true,
	});

	$('#formdateEvent .input-group.date').datepicker({
		format: "yyyy-mm-dd",
		language: "es",
		startDate: "now",
		autoclose: true,
	});

	$('.onlyNumbers').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});


	$('form').validator();

// AQUI SE VALIDA EL CAMBIO DE ROL DE USUARIO

	$('#userRole').change( function (  ) {
		$('#preguntas').html('');
		switch( $('#userRole').val() ){
			case '3':
				$('#preguntas').html( $('#preguntas_voluntario').html() );
				break;
			case '4': 
				$('#preguntas').html( $('#preguntas_enfermera').html() );
				break;
		}
		$('form').validator('update');
	} );
	
	$('#list').DataTable( {
		"language": {
			"sProcessing":		"Procesando...",
			"sLengthMenu":		"Mostrar _MENU_ registros",
			"sZeroRecords":		"No se encontraron resultados",
			"sEmptyTable":		"Ningún dato disponible en esta tabla",
			"sInfo":			"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":		"Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":	"(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":		"",
			"sSearch":			"Buscar:",
			"sUrl":				"",
			"sInfoThousands":	",",
			"sLoadingRecords":	"Cargando...",
			"oPaginate":	{
				"sFirst":		"Primero",
				"sLast":		"Último",
				"sNext":		"Siguiente",
				"sPrevious":	"Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	} );
} );