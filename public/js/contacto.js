/*   FORMULARIO CONTACTO   */
$(document).ready(function() {
	/*   Recibe los datos del formulario de contacto, envia un mensaje de exito o fracaso. Envia a traves de AJAX los campos de formulario para que sean validados    */
	$(document).on('click', '#btn_contacto', function (event) {

		event.preventDefault();

		/* Act on the event */
		var _token = $("input[name='_token']").val()

		$.ajax({
			url: 'contacto',
			type: 'POST',
			data: {
				_token: _token,
				nombre: $("#formContacto").find('input[name=nombre]').val(),
				apellido: $("#formContacto").find('input[name=apellido]').val(),
				email: $("#formContacto").find('input[name=email]').val(),
				cod_area: $("#formContacto").find('input[name=cod_area]').val(),
				celular: $("#formContacto").find('input[name=celular]').val(),
				mensaje_tipo: $("#formContacto").find('select[name=mensaje_tipo]').val(),
				mensaje_cuerpo: $("#formContacto").find('textarea[name=mensaje_cuerpo]').val() 
			},

			beforeSend: function () {
				$('.modal_body_contacto').toggleClass('sk-loading')
			},

			success: function (data) {
				$('.alerta_validacion_contacto').html('')

				if (data.errors != undefined) {
					$('.modal_body_contacto').toggleClass('sk-loading')

					$.each(data.errors, function (key, value) {
						$('.alerta_validacion_contacto').append(value + '<br>').slideDown(200);
					});
				} else {
					$('.modal_body_contacto').toggleClass('sk-loading')
					$('#formContacto').trigger('reset')				

					if ($('.alerta_validacion_contacto').is(':visible')){
						$('.alerta_validacion_contacto').slideUp(400)
					}

					swal({
						title: "Mensaje enviado",
						text: "Gracias por enviar su mensaje.",
						type: "success"
					});
				}
			},

			error: function(data){
				swal({
					title: "Oops",
					text: "Hubo un error en el envío del mensaje. Intente nuevamente.",
					type: "error"
				});

				$('.modal_body_contacto').toggleClass('sk-loading')
			}
		})
	});
});