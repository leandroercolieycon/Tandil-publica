$(document).ready(function() {
		

	$(document).on('click', '#btn_cargarsaldo', function (event) {

	event.preventDefault();

	/* Act on the event */
	var _token = $("input[name='_token']").val()

		$.ajax({

			url: 'cargarsaldo',
			type: 'POST',
			data: {
				_token: _token,
				tarjeta:  $("#formCargarSaldo").find('input[name=tarjeta]').val(),
				email: $("#formCargarSaldo").find('input[name=email]').val(),
				importe: $("#formCargarSaldo").find('input[name=importe]').val(),
				mediopago: $("#formCargarSaldo").find('select[name=medioPago] :selected').val()
			},

			beforeSend: function () {
				$('.modal_body_cargar').toggleClass('sk-loading')
			},

			success: function (data) {

				$('.alerta_validacion_cargar').html('')

				if (data.errors != undefined) {

					$('.modal_body_cargar').toggleClass('sk-loading')


					$.each(data.errors, function (key, value) {
						$('.alerta_validacion_cargar').append(value + '<br>').slideDown(200);
					});

				} else {

					$('.modal_body_cargar').toggleClass('sk-loading')
					$('#formCargarSaldo').trigger('reset')

					if ($('.alerta_validacion_cargar').is(':visible'))
						$('.alerta_validacion_cargar').slideUp(400)

				}
			}

		})

});


});	

