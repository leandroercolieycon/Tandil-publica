/*   FORMULARIOS SOLICITUD DE TARJETA   */

$(document).ready(function() {

	/*   Cambia el formato del input de la patente en solicitud de tarjetas   */
	$('.patente').mask('SSS000')

	/*   Cambia las reglas de inputs de patentes en el registro de personas   */
	$(document).on('change', '#tipo_patente', function (event) {

		event.preventDefault();
		/* Act on the event */
		if ($(this).val() == 0) {


			$('.patente').unmask().val('')
			$('.patente').mask('SSS000')

		}
		else {

			$('.patente').unmask().val('')
			$('.patente').mask('SS000SS')

		}

	});


	/* Cambia la vista de los formularios para la solicitud de las tarjetas*/
	$('#btn_solicitar_personal').on('click', function (event) {

		 	if($('.alerta_validacion_solicitud').is(':visible'))
		 		$('.alerta_validacion_solicitud').slideUp(400)
		event.preventDefault();

		/* Act on the event */
		if ($('#form_personal').is(':not(:visible)')) {
			$('#form_empresa').fadeOut('400')
			$('#form_personal').delay(401).fadeIn('400')
		}

		$('.tipo_solicitud').attr('value', '0')
		$(this).removeClass('btn-outline')
		$('#btn_solicitar_empresa').addClass('btn-outline')
		$('#form_tarjeta').trigger('reset')

		if ($('.alerta_validacion_solicitud').is(':visible'))
			$('.alerta_validacion_solicitud').slideUp(400)

	});


	$('#btn_solicitar_empresa').on('click', function (event) {

		 	if($('.alerta_validacion_solicitud').is(':visible'))
		 		$('.alerta_validacion_solicitud').slideUp(400)
		event.preventDefault();

		/* Act on the event */
		if ($('#form_empresa').is(':not(:visible)')) {
			$('#form_personal').fadeOut('400')
			$('#form_empresa').delay(401).fadeIn('400')
		}

		$('.tipo_solicitud').attr('value', '1')
		$(this).removeClass('btn-outline')
		$('#btn_solicitar_personal').addClass('btn-outline')
		$('#form_tarjeta').trigger('reset')

		if ($('.alerta_validacion_solicitud').is(':visible'))
			$('.alerta_validacion_solicitud').slideUp(400)

	});


	/*   Recibe los datos del formulario de solicitud de tarjeta, envia un mensaje de exito o fracaso. Envia a traves de AJAX los campos de formulario para que sean validados    */
	$(document).on('click', '#btn_solicitud_tarjeta', function (event) {

		event.preventDefault();

		/* Act on the event */
		var _token = $("input[name='_token']").val()

		var tipo_solicitud = $('.tipo_solicitud').val()

		var telefono_completo = $('.cod_area').val()+$('.telefono').val()

		var patente = ($('.patente').val()).toUpperCase()

		if(tipo_solicitud == 0){

			var nombre = $('.nombre').val()
			var dni = $('.dni').val()
			var apellido = $('.apellido').val()

		} else {

			var nombre = $('.razon_social').val()
			var dni = $('.cuit').val()
			var apellido = ''

		}

		try {

			$.ajax({
				url: 'solicitar',
				type: 'POST',
				data: {
					
			 			_token: _token,
			 			nombre: nombre,
			 			apellido: apellido,
			 			email: $('.email').val(),
			 			dni: dni,
			 			cod_area: $('.cod_area').val(),
			 			telefono: $('.telefono').val(),
			 			telefono_completo: telefono_completo,
			 			patente: patente,
			 			tipo_solicitud: tipo_solicitud,
			 			tipo_patente: $('#tipo_patente').val(),
			 			email_repeat: $('.email_repeat').val(),

			 		},

			 		beforeSend: function(){

			 			$('.modal_body_solicitud').toggleClass('sk-loading')
			 			
			 		},

		            success: function(data){

						$('.modal_body_solicitud').toggleClass('sk-loading')

		            	if(data.errors!=undefined){

			            	$('.alerta_validacion_solicitud').html('')

				          		$.each(data.errors, function(key, value){
				          			$('.alerta_validacion_solicitud').append(value+'<br>').slideDown(200);
				          		});
		            		
		            	} else {

		            		switch(data){
		            			case 'error_dni':
							        swal({
							            title: "Oops",
							            text: "El DNI ingresado ya se encuentra registrado.",
							            type: "error"
							        });
							        break;

						        case 'error_patente':
							        swal({
							            title: "Oops",
							            text: "La patente ingresada ya se encuentra registrada.",
							            type: "error"
							        })
							        break;
							    case 'error_db':
							        swal({
							            title: "Oops",
							            text: "Hubo un error con la conexi\u00F3n a la base de datos. Intente nuevamente.",
							            type: "error"
							        })
							        break;
							    case 'exito':
							        swal({
							            title: "Usuario registrado correctamente",
							            text: "Se ha completado su registro.",
							            type: "success"
							        })
					 				$('#form_tarjeta').trigger('reset')
							        break;
		            		}

					 		if($('.alerta_validacion_solicitud').is(':visible'))
			 					$('.alerta_validacion_solicitud').slideUp(400)

			 			}

					},

					error: function(xhr, ajaxOptions, thrownError){

						$.ajax({

							type	: 'POST',
							url		: 'solicitar/log_error',
							data	: {
										_token: _token,
										mensaje: 'ESTADO:' + xhr.status + ', MENSAJE: ' + xhr.statusText,
										subject: 'Error solicitud_tarjeta_1',
							 			nombre: nombre,
							 			apellido: apellido,
							 			email: $('.email').val(),
							 			dni: dni,
							 			cod_area: $('.cod_area').val(),
							 			telefono: $('.telefono').val(),
							 			telefono_completo: telefono_completo,
							 			patente: patente,
							 			tipo_solicitud: tipo_solicitud,
							},

							success	: function(data){

								$('.modal_body_solicitud').toggleClass('sk-loading')

								swal ({
									title: "Oops" ,
									text: "Ocurri\u00F3 un fallo inesperado. Verifique los datos ingresados y vuelva a intentarlo.",
									type: "error" 
								})

							}

						})
							
					}

			})


		}

		catch(error){

			$.ajax({

				type	: 'POST',
				url		: 'log_error',
				data	: {
							_token: _token,
							mensaje: 'Error: '+error.toString(),
							subject: 'Error solicitud_tarjeta_2',
				 			nombre: nombre,
				 			apellido: apellido,
				 			email: $('.email').val(),
				 			dni: dni,
				 			cod_area: $('.cod_area').val(),
				 			telefono: $('.telefono').val(),
				 			telefono_completo: telefono_completo,
				 			patente: patente,
				 			tipo_solicitud: tipo_solicitud,
				},

				success	: function(data){

					$('.modal_body_solicitud').toggleClass('sk-loading')

					swal ({
						title: "Oops" ,
						text: "Ocurri\u00F3 un fallo inesperado. Verifique los datos ingresados y vuelva a intentarlo.",
						type: "error" 
					})

				}

			})

		}


	});


});