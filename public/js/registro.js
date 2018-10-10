$(document).ready(function() {

	/*   Inicializacion variables para registro de personas   */
	$('.patente_1').mask('SSS000')
	var cant_vehiculos = 1


	/*   Cambia las reglas de inputs de patentes en el registro de personas   */
	 $(document).on('change', '.tipo_patente_1, .tipo_patente_2, .tipo_patente_3', function(event) {
	 	
		//Busca el input siguiente para modificar las reglas
		var input = $(this).parent().siblings().find('input')

		if ($(this).val() == 0) {

			input.unmask().val('')
			input.mask('SSS000')

		} else {

			input.unmask().val('')
			input.mask('SS000SS')

		}

	});
	

	/*   Recibe los datos del formulario de registro, envia un mensaje de exito o fracaso. Envia a traves de AJAX los campos de formulario para que sean validados    */
	$(document).on('click', '#btn_registrar', function (event) {

		event.preventDefault();

		/* Act on the event */
		var _token = $("input[name='_token']").val()

		 	var patentes = {
		 		tipo_patentes: [],
		 		patentes: []
		 	}

		 	var usuario = 'web_' + Math.random().toString(36).substring(7)

		 	if($('.patente_2').val() != undefined)
		 		patente_vehiculo_2 = $('.patente_2').val()
		 	else
		 		patente_vehiculo_2 = ''

		 	if($('.patente_3').val() != undefined)
		 		patente_vehiculo_3 = $('.patente_3').val()
		 	else
		 		patente_vehiculo_3 = ''

		 	var telefono_completo = $('.cod_area_registro').val()+$('.telefono_registro').val()

		 	for (var i = 1; i <= cant_vehiculos; i++) {

		 		patentes.tipo_patentes[i-1] = $('.tipo_patente_'+i).val()
		 		patentes.patentes[i-1] = $('.patente_vehiculo_'+i).val()
		 	}


		 	try{

			 	$.ajax({
			 		url: 'registrar',
			 		type: 'POST',
			 		data: {

			 			_token: _token,
			 			nombre: $('.nombre_registro').val(),
			 			apellido: $('.apellido_registro').val(),
			 			dni: $('.dni_registro').val(),
			 			compania: $('.compania').val(),
			 			cod_area: $('.cod_area_registro').val(),
			 			telefono: $('.telefono_registro').val(),
			 			telefono_completo: telefono_completo,
			 			email: $('.email_registro').val(),
			 			password: $('.password').val(),
			 			password_repeat: $('.password_repeat').val(),
			 			usuario: usuario,
			 			cant_vehiculos: cant_vehiculos,
			 			tipo_patente_1: $('.tipo_patente_1').val(),
			 			tipo_patente_2: $('.tipo_patente_2').val(),
			 			tipo_patente_3: $('.tipo_patente_3').val(),
			 			patente_vehiculo_1: $('.patente_1').val(),
			 			patente_vehiculo_2: patente_vehiculo_2,
			 			patente_vehiculo_3: patente_vehiculo_3

			 			},

			 		beforeSend: function(){
			 			$('.modal_body_registro').toggleClass('sk-loading')
			 		},

		            success: function(data){

				 		$('.modal_body_registro').toggleClass('sk-loading')

		            	if(data.errors != undefined){
		            		
		            		$('.alerta_validacion_registro').html('')

							$('.modal_body_registro').toggleClass('sk-loading')

			          		$.each(data.errors, function(key, value){
			          			$('.alerta_validacion_registro').append(value+'<br>').slideDown(200);
			          		});
		            		
		            	} else {

		            		switch(data){

		            			case 'error_telefono':
							        swal({
							            title: "Oops",
							            text: "El tel\u00E9fono ingresado ya se encuentra registrado.",
							            type: "error"
							        })
							        break;
							    case 'error_mail':
							        swal({
							            title: "Oops",
							            text: "El E-mail ingresado ya se encuentra registrado.",
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
							            text: "Chequee su casilla de E-mail para completar su registro.",
							            type: "success"
							        })
					 				$('#form_registrar').trigger('reset')
					 				break;
		            		}

					 		if($('.alerta_validacion_registro').is(':visible'))
			 					$('.alerta_validacion_registro').slideUp(400)

		            	}
		            },

		            error: function(xhr, ajaxOptions, thrownError){

						$.ajax({

							type	: 'POST',
							url		: 'registrar/log_error',
							data	: {
										_token: _token,
										mensaje: 'ESTADO:' + xhr.status + ', MENSAJE: ' + xhr.statusText,
										subject: 'Error solicitud_registro_usuario 1',
							 			nombre: $('.nombre_registro').val(),
							 			apellido: $('.apellido_registro').val(),
							 			dni: $('.dni_registro').val(),
							 			compania: $('.compania').val(),
							 			cod_area: $('.cod_area_registro').val(),
							 			telefono: $('.telefono_registro').val(),
							 			email: $('.email_registro').val(),
							 			password: $('.password').val(),
							 			password_repeat: $('.password_repeat').val(),
							 			cant_vehiculos: cant_vehiculos,
							 			patente_vehiculo_1: $('.patente_1').val(),
							 			patente_vehiculo_2: $('.patente_2').val(),
							 			patente_vehiculo_3: $('.patente_3').val()
							},

							success	: function(data){

								$('.modal_body_registro').toggleClass('sk-loading')

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
					url		: 'registrar/log_error',
					data	: {
								_token: _token,
								mensaje: 'Error: '+error.toString(),
								subject: 'Error solicitud_registro_usuario 2',
					 			nombre: $('.nombre_registro').val(),
					 			apellido: $('.apellido_registro').val(),
					 			dni: $('.dni_registro').val(),
					 			compania: $('.compania').val(),
					 			cod_area: $('.cod_area_registro').val(),
					 			telefono: $('.telefono_registro').val(),
					 			email: $('.email_registro').val(),
					 			password: $('.password').val(),
					 			password_repeat: $('.password_repeat').val(),
					 			cant_vehiculos: cant_vehiculos,
					 			patente_vehiculo_1: $('.patente_1').val(),
					 			patente_vehiculo_2: $('.patente_2').val(),
					 			patente_vehiculo_3: $('.patente_3').val()
					},


					success	: function(data){

						$('.modal_body_registro').toggleClass('sk-loading')

						swal ({
							title: "Oops" ,
							text: "Ocurri\u00F3 un fallo inesperado. Verifique los datos ingresados y vuelva a intentarlo.",
							type: "error" 
						})

					}

				})

		 	}

	});


	/*   Agregar mas vehiculos para registrar en el registro de personas*/
	$('.control_vehiculos').on('click', '.agregar_vehiculos', function (event) {

		event.preventDefault();

		if (cant_vehiculos < 3) {

			cant_vehiculos++

			var nuevo_vehiculo = '<div class="wrapper_vehiculos" style="display: none;"><div class="form-row"><div class="form-group col-md-4">' +
				'<select name="tipo_patente" class="tipo_patente_'+cant_vehiculos+' form-control"><option value="0">Tradicional</option><option value="1">Mercosur</option></select></div><div class="form-group col-md-8">' +
				'<div class="input-group mb-3"><input type="text" name="patente_'+cant_vehiculos+'" class="patente_'+cant_vehiculos+' form-control" placeholder="Patente Vehiculo '+cant_vehiculos+'" style="text-transform: uppercase">' +
				'<div class="input-group-append"><button class="quitar_vehiculos btn btn-danger"><i class="fa fa-minus"></i></button></div></div></div></div></div>'

			$('.control_vehiculos').slideDown(400, function () {
				$(nuevo_vehiculo).appendTo($(this)).slideDown(200);
			});

			$('.patente_' + cant_vehiculos).mask('SSS-000')

		}

	});

	/*   Quitar inputs de vehiculos en el registro de personas   */
	$('.control_vehiculos').on('click', '.quitar_vehiculos', function (event) {
		event.preventDefault();

		$('.wrapper_vehiculos:last').slideUp(200, function () {
			$(this).remove()
		})

		cant_vehiculos--

	});


	/*   Envia el codigo al controlador "Registrar" para verificar en la base de datos y confirmar el registro de nuevo usuario   */
	$('#form_verificar_code').on('click', '#btn_verificar_code', function(event) {

		event.preventDefault();
		/* Act on the event */

		var _token = $("input[name='_token']").val()

		var hash = $('#hash').val()

		var code = $('#code').val()

		if(code){

			$.ajax({
				url: base_url+'/registrar/verificar_code',
				type: 'POST',
				data: { _token: _token,
					code: code, hash: hash },

				beforeSend: function(){
					$('.spinner_registro_code').toggleClass('sk-loading');
				},

				success: function(result){

					$('.spinner_registro_code').toggleClass('sk-loading');

					switch(result){

						case '0': swal( "Error" , 'Codigo Inv\u00E1lido',  "error" );

						case '5': swal({
							title: "Bienvenido",
							text: 'Usted se ha registrado exitosamente',
							type: "success" }, function(){
								window.location = base_url });
					}

				},

				error: function(xhr, ajaxOptions, thrownError){

					$('.spinner_registro_code').toggleClass('sk-loading');

					$.ajax({

						url: base_url+'/registrar/log_error',
						type: 'POST',
						data: {
							_token: _token,
							mensaje: 'ESTADO:' + xhr.status + ', MENSAJE: ' + xhr.statusText,
							subject: 'Error confirmacion_registro_usuario 1'
						},

						success	: function(data){

							$('.modal_body_registro').toggleClass('sk-loading')

							swal ({
								title: "Oops" ,
								text: "Ocurri\u00F3 un fallo inesperado. Verifique el c\u00F3digo ingresado y vuelva a intentarlo.",
								type: "error" 
							})

						}

					})

				}
			})
			
		} else {

			swal( "Error" , 'Debe ingresar un c\u00F3digo.',  "error" );

		}
	});

});