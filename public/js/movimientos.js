$(document).ready(function() {
	/*   Recibe los datos del formulario de movimientos, envia un mensaje de exito o fracaso. Envia a traves de AJAX los campos de formulario para que sean validados    */
	$(document).on('click', '#btn_movimientos', function (event) {

		event.preventDefault();

		/* Act on the event */
		var _token = $("input[name='_token']").val()

		// verificar captcha
		$.ajax({
			url: 'https://www.google.com/recaptcha/api/siteverify',
			type: 'POST',
			data: {
				secret: "6LeRPnQUAAAAAN2Av6boqFhmsB0G2YEUYYiVbDnl",
				response: grecaptcha.getResponse()
			},
			success: function (data) {
				if(data["success"]){ // Verificó el captcha
					$.ajax({
						url: 'movimientos',
						type: 'POST',
						data: {
							_token: _token,
							tarjeta: $("#formMovimientos").find('input[name=tarjeta]').val()
						},
			
						beforeSend: function () {
							$('.modal_body_movimientos').toggleClass('sk-loading')
						},
			
						success: function (data) {
							$('.alerta_validacion_movimientos').html('')
			
							if (data.errors != undefined) {
								$('.modal_body_movimientos').toggleClass('sk-loading')
			
								$.each(data.errors, function (key, value) {
									$('.alerta_validacion_movimientos').append(value + '<br>').slideDown(200);
								});
							} else {
								$('.modal_body_movimientos').toggleClass('sk-loading')
								$('#tabla-movimientos').toggleClass('oculto')
								$('#formMovimientos').trigger('reset')				
			
								if ($('.alerta_validacion_movmientos').is(':visible')){
									$('.alerta_validacion_movmientos').slideUp(400)
								}
									
								// Crear tabla
								$("#tabla-movimientoss").footable();
								var gastos = [], mes = [];
								data.forEach(element => {
									gastos.push(parseInt(element["IMPORTE"]));
									mes.push(parseInt(String(element["FECHA_EMISION"]).slice(3,5)));
									$("#tabla-movimientoss tbody").append('<tr><td>' + String(element["FECHA_EMISION"]).slice(0,10) + ' ' + String(element["FECHA_EMISION"]).slice(12,17) +'</td><td>' 
																				+ String(element["TIPO"]).charAt(0).toUpperCase() + String(element["TIPO"]).slice(1).toLowerCase() +'</td><td>' 
																				+ element["RECORRIDO"]+'</td><td align="right">' 
																				+ '$' + element["IMPORTE"]+'</td><td align="right">' 
																				+ '$' + element["SALDO"]+ '</tr>');
								});	
								gastos.reverse();
								mes.reverse();
								$("#tabla-movimientoss").trigger('footable_initialize');
								
								// Obtener saldo de la tarjeta (ultimo movimiento)
								$('#saldo').toggleClass('oculto')
								$('#saldo span').text(data[0]["SALDO"]);
			
								// Construir chart con movimientos por mes
								if(gastos.length > 0){
									const nombresMes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
									"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
									var gastos_chart = [], meses_chart = [];
									gastos_chart.push(gastos[0]);
									meses_chart.push(nombresMes[mes[0]-1]);
									var i; 
									for(i = 1; i < mes.length; i++){
										if(mes[i] == mes[i-1]){ // gasto del mismo mes
											gastos_chart[gastos_chart.length-1] += gastos[i];
										}
										else{ // Gastos de nuevo mes
											meses_chart.push(nombresMes[mes[i]-1]);
											gastos_chart.push(gastos[i]);
										}
									}
				
									var ctx = document.getElementById("chartMovimientos").getContext('2d');
									var myChart = new Chart(ctx, {
										type: 'bar',
										data: {
											labels: meses_chart,
											datasets: [{
												data: gastos_chart,
												backgroundColor: 'rgba(177, 85, 144, 0.4)',
												borderColor: 'rgba(177, 85, 144,1)',
												borderWidth: 2
											}]
										},
										options: {
											maintainAspectRatio: false,
											scales: {
												yAxes: [{
													ticks: {
														beginAtZero:true
													}
												}]
											},
											legend: {
												display:false
											},
											tooltips: {
												titleFontSize: 14,
												bodyFontSize: 14,
												callbacks: {
													label: function(tooltipItems, data) {
														return '$ ' + tooltipItems.yLabel;
													}
												}
											  }
										}
									});
								}	
							}
						},
			
						error: function(data){
							swal({
								title: "Oops",
								text: "Hubo un error al obtener los últimos movimientos. Intente nuevamente.",
								type: "error"
							});
			
							$('.modal_body_movimientos').toggleClass('sk-loading')
						}
					})
				}
			},
			error: function(data){
				swal({
					title: "Oops",
					text: "Hubo un error al obtener los últimos movimientos. Intente nuevamente.",
					type: "error"
				});

				$('.modal_body_movimientos').toggleClass('sk-loading')
			}
		})
	});
});


