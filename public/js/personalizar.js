$(document).ready(function() {

	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '< Ant',
		nextText: 'Sig >',
		currentText: 'Hoy',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);

	
	$('#form_personalizar').on('click', '#btn_personalizar', function(event) {
		event.preventDefault();
		/* Act on the event */

		var _token = $("input[name='_token']").val()

		try{

			$.ajax({
				url: 'personalizar',
				type: 'POST',
				data: {
					_token: _token,
					nro_tarjeta: $('.nro_tarjeta').val(),
					dni: $('.dni').val()
				},
				beforeSend: function(){
					$('.modal_body_personalizar').toggleClass('sk-loading')
				},
				success: function(data){

			 		$('.modal_body_personalizar').toggleClass('sk-loading')

	            	if(data.errors != undefined){
	            		
	            		$('.alerta_validacion_personalizar').html('')

		          		$.each(data.errors, function(key, value){
		          			$('.alerta_validacion_personalizar').append(value+'<br>').slideDown(200);
		          		});
	            		
	            	} else {

	            		var datos = JSON.parse(data)
	            		$("#fecha_registrar").datepicker({dateFormat: "dd-mm-yy", changeMonth: true, changeYear: true, yearRange: '-100:+0'})

	            		switch(datos.estado){
	            			case 1: swal({
							            title: "Error",
							            text: "La Tarjeta ya est\u00e1 Personalizada.",
							            type: "error"
							        })
	            					break;

	            			case 2: swal({
							            title: "Error",
							            text: "El DNI ingresado ya existe.",
							            type: "error"
							        })
	            					break;

	            			case 3: swal({
							            title: "Error",
							            text: "La Tarjeta no se puede personalizar.",
							            type: "error"
							        })
	            					break;

	            			case 4: swal({
							            title: "Error",
							            text: "La Tarjeta est\u00e1 pendiente de ser Personalizada.",
							            type: "error"
							        })
	            					break;

	            			case 5: swal({
							            title: "Error",
							            text: "El n\u00FAmero de Tarjeta o de DNI ya est\u00e1 utilizado.",
							            type: "error"
							        })
	            					break;

	            			case 6: $('.nro_tarjeta').attr('disabled', 'true');
	            					$('.dni').attr('disabled', 'true');

	            					$('.nombre').val(datos.nombre).attr('disabled', 'true');
	            					$('.apellido').val(datos.apellido).attr('disabled', 'true');
	            					$('.direccion').val(datos.direccion)

	            					$('.botones-consulta').slideUp('400');
	            					$('#form_registrar').slideDown('400');
	            					break;

	            			case 7: $('.nro_tarjeta').attr('disabled', 'true');
	            					$('.dni').attr('disabled', 'true');

	            					$('.botones-consulta').slideUp('400');
	            					$('#form_registrar').slideDown('400');
	            					break;
	            		}
	            	}
				},
				error: function(xhr, ajaxOptions, thrownError){

					$.ajax({

						type	: 'POST',
						url		: 'personalizar/log_error',
						data	: {
									_token: _token,
									mensaje: 'ESTADO:' + xhr.status + ', MENSAJE: ' + xhr.statusText,
									subject: 'Error personalizar tarjeta 1',
						 			nombre: $('.nro_tarjeta').val(),
						 			dni: $('.dni').val(),
						},

						success	: function(data){

							$('.modal_body_personalizar').toggleClass('sk-loading')

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
				url		: 'personalizar/log_error',
				data	: {
							_token: _token,
							mensaje: 'ERROR:' + error.toString(),
							subject: 'Error personalizar tarjeta 2',
				 			nombre: $('.nro_tarjeta').val(),
				 			dni: $('.dni').val(),
				},

				success	: function(data){

					$('.modal_body_personalizar').toggleClass('sk-loading')

					swal ({
						title: "Oops" ,
						text: "Ocurri\u00F3 un fallo inesperado. Verifique los datos ingresados y vuelva a intentarlo.",
						type: "error" 
					})

				}
			})

		}
	})


	$('#form_registrar').on('click', '#btn_registrar', function(event) {
		event.preventDefault();
		/* Act on the event */

		var _token = $("input[name='_token']").val()

		var telefono_completo = $('.cod_area').val()+$('.telefono').val()

		if ($('.nombre').is(':disabled') && $('.apellido').is(':disabled'))
			var padron = 1
		else
			var padron = 0

		$.ajax({

			url: 'personalizar/registrar',
			type: 'POST',
			data: {
				_token: _token,
				nro_tarjeta: $('.nro_tarjeta').val(),
				dni: $('.dni').val(),
				nombre: $('.nombre').val(),
				apellido: $('.apellido').val(),
				direccion: $('.direccion').val(),
				fecha_nac: $('.fecha_nac').val(),
				telefono_fijo: $('.telefono_fijo').val(),
				cod_area: $('.cod_area').val(),
				telefono: $('.telefono').val(),
				telefono_completo: telefono_completo,
				email: $('.email').val(),
				padron: padron,
			},

			beforeSend: function(){

				$('.modal_body_personalizar').toggleClass('sk-loading')

			},

			success: function(data){


		 		$('.modal_body_personalizar').toggleClass('sk-loading')

            	if(data.errors != undefined){
            		
            		$('.alerta_validacion_personalizar').html('')

	          		$.each(data.errors, function(key, value){
	          			$('.alerta_validacion_personalizar').append(value+'<br>').slideDown(200);
	          		})
            		
            	} else {

					var datos = jQuery.parseJSON(data);

            		switch(datos.estado){

            			case 1: 

            				window.location = base_url + '/personalizar/datos_enviados?hash='+datos.hash+'&code='+datos.code+'&nombre='+datos.nombre+
            				'&telefono='+datos.telefono+'&email='+datos.email
            				
            			$('#modal-personalizar').modal('hide')
            			break;
            			case 3: swal({
            				title: 'Error',
            				text: 'Ha ocurrido un error. Verifique los datos ingresados e intente nuevamente.',
            				type: 'error'
            			})
            			break;
            		}

            	}

			}
		})
		
	})


	$('#form_verificar_code').on('click', '#btn_verificar_code', function(event) {
		event.preventDefault();
		/* Act on the event */

		var _token = $("input[name='_token']").val()

		var code = $('#code').val()
		var hash = $('#hash').val()

		$.ajax({
			url: base_url+'/personalizar/verificar_code',
			type: 'POST',
			data: {
				_token: _token,
				code: code,
				hash: hash
			},

			beforeSend: function(){

				$('.spinner_personalizacion_code').toggleClass('sk-loading')

			},

			success: function(data){

				$('.spinner_personalizacion_code').toggleClass('sk-loading')

				if(data.errors != undefined){

					$('.validacion_codigo').html('')

	          		$.each(data.errors, function(key, value){
	          			$('.validacion_codigo').append(value+'<br>').slideDown(200);
	          		})

				} else {

					var datos = $.parseJSON(data);

					if(datos.estado == 0){

						swal({
							title: "Error",
							text: "C\u00F3digo inv\u00e1lido.",
							type: "error"
						})

					} else {

						if(datos.saldo_anterior > 0){

							swal({
								title: "Personalizaci\u00F3n completada",
								text: "Su tarjeta SUMO ya se encuentra personalizada.\nPosee $"+ datos.saldo_anterior +" de saldo restante.",
								type: "success"
							}, function(){
								window.location = base_url
							})
						} else {

							swal({
								title: "Personalizaci\u00F3n completada",
								text: "Su tarjeta SUMO ya se encuentra personalizada.",
								type: "success"
							}, function(){
								window.location = base_url
							})
						}
					}
					
				}

			}
		})
		
	});
});