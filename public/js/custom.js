$(document).ready(function () {
	var pv = [], pvm = [], park = [], parkm = [], parkmCircles=[], pvCircles = [], map = {}, Debug = {}, timer = {}, caducity = {}, __clear = null;
	var userMarker, userCircleMarker;

	$.ajax({
		type: 'GET',
		url: "getpv",
		data: "",
		success: function (msg) {
			pv = eval(msg);		
		},
		error: function (msg) {
			alert("No se encontraron puntos de recarga.");
		}
	});

	$.ajax({
		type: 'GET',
		url: "getprk",
		data: "",
		success: function (msg) {
			park = eval(msg);
			mostrarParquimetros();
			$('#configbox').toggleClass('sk-loading')
		},
		error: function (msg) {
			alert("No se encontraron parquímetros.");
		}
	});

	Debug =
		{
			apply: true,
			log: function (x) { }
		};

	var markersArray = [];

	function clearOverlays() {
		if (markersArray.length != 0) {
			var seguir = true;
			for (var i = 0; seguir == (true); i++) {
				map.removeLayer(markersArray[i]);
				if (i == markersArray.length - 1) { seguir = false };
			}
		}
		markersArray = [];
	};

	__clear =
		{
			array: function (x) {
				jQuery.each(x, function (k, v) {
					try { map.removeLayer(v); } catch (ex) { Debug.log(['__clear.array', ex]); }
				});
			},
			item: function (x) {
				try { map.removeLayer(x); } catch (ex) { Debug.log(['__clear.item', ex]); }
			},
			layer: function () {
				$("#mapa").show(); $("#suggest").hide(); $("#reclamo").hide();
			}
		};

	__fill =
		{
			array: function (obj, mapa) {
				jQuery.each(obj, function (k, v) {
					try {
						v.bindPopup('<div id="icon_' + k + '">' + v.options.title + '</div>');
						v.addTo(mapa);
					}
					catch (ex) { Debug.log(['__fill.array', ex]); }
				});
			},
			item: function (obj, mapa) {
				try { mapa.addLayer(obj); } catch (ex) { Debug.log(['__fill.item', ex]); }
			}
		};

	timer =
		{
			kill: 10000,
			o: {},
			_do: function () {
				$("#item-recorrido").change();
			},
			start: function () {
				try { this.o = setInterval(this._do, this.kill); } catch (ex) { }
			},
			end: function () {
				try { clearInterval(this.o); } catch (ex) { }
			}
		};

	caducity =
		{
			kill: 1000 * 60 * 2,
			o: {},
			_do: function () {
				$("#item-recorrido").val("0");
				$("#item-recorrido").change();
			},
			start: function () {
				try { this.o = setInterval(this._do, this.kill); } catch (ex) { }
			},
			end: function () {
				try { clearInterval(this.o); } catch (ex) { }
			}
		};

	fn_idle = function () { caducity.end(); caducity.start(); };

	var map = L.map("mapa", {zoomControl: true}).setView([-37.325969,-59.1381165], 14);
	L.tileLayer
		(
		"http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
		{
			attribution: "Map data &copy; <a href='http://openstreetmap.org'>OpenStreetMap</a> contributors, <a href='http://creativecommons.org/licenses/by-sa/2.0/'>CC-BY-SA</a>, Imagery © <a href='http://cloudmade.com'>CloudMade</a>",
			maxZoom: 19,
			//minZoom: 13,
			scrollWheelZoom: true
		}
		).addTo(map);

	map.locate();
	map.on('locationfound', function onLocationFound(e) {
		var radius = e.accuracy / 2;
		var yellowIcon = new L.Icon({
			iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png',
			shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
			iconSize: [25, 41],
			iconAnchor: [12, 41],
			popupAnchor: [1, -34],
			shadowSize: [41, 41]
		  });
		userMarker = new L.marker(e.latlng, {icon: yellowIcon});	
		map.addLayer(userMarker);
		userCircleMarker = new L.circle(e.latlng, radius, {color: '#F5D907', opacity:.5});
		map.addLayer(userCircleMarker);	
		if($("#switch-parquimetros").is(':checked')){
			mostrarParquimetros();
		}
		if($("#switch-pv").is(':checked')){
			mostrarPv();
		}
	});
	map.on('locationerror', function onLocationError(e) {
		alert(e.message);
	});

	/* Reubicar al usuario a su localización con el boton */
	$(document).on('click', '#btn-geo', function (e) {
		map.removeLayer(userMarker);
		map.removeLayer(userCircleMarker)
		map.locate({setView: true, maxZoom: 17});		
	});

	var MyControlProvider = L.Control.extend(
		{
			options:
			{
				position: 'bottomleft'
			},

			onAdd: function (map) {
				var providerControlDiv = L.DomUtil.create('div', 'control_provider');
				providerControlDiv.style.padding = '5px';
				var controlUI = document.createElement('DIV');
				controlUI.style.backgroundColor = 'rgba(255,255,255,0.6)';
				controlUI.style.border = '1px solid #676a6c';
				controlUI.style.cursor = 'pointer';
				controlUI.style.textAlign = 'center';
				providerControlDiv.appendChild(controlUI);
				var controlText = document.createElement('DIV');
				controlText.style.fontSize = '12px';
				controlText.style.paddingLeft = '4px';
				controlText.style.paddingRight = '4px';
				controlText.style.paddingtop = '4px';
				/*controlText.innerHTML 				= '<a href="http://www.e-bus.com.ar" target="_blank" ><img src="<?php echo base_url(); ?>images/logo.gif" border="0" width="60" height="15"  /></a> <a href="http://www.eycon.com.ar" target="_blank" ><img src="<?php echo base_url(); ?>images/logo_eycon_small.png" border="0" width="60" height="12" /></a> <img src="http://www.hit-counts.com/counter.php?t=1315079"  height="12"  /> <br> <span style="font-size:8px;">Copyright &copy; EYCON S.A. 2013 Todos los derechos reservados.</span> '; */
				/*controlText.innerHTML 				= '<a href="http://www.e-bus.com.ar" target="_blank" ><img src="<?php echo base_url(); ?>images/logo.gif" border="0" width="60" height="15"  /></a> <a href="http://www.eycon.com.ar" target="_blank" ><img src="<?php echo base_url(); ?>images/logo_eycon_small.png" border="0" width="60" height="12" /></a> <img src="http://www.reliablecounter.com/count.php?page=www.semivm.com/&digit=style/plain/12/&reloads=0"  height="12"  /> <br> <span style="font-size:8px;">Copyright &copy; EYCON S.A. 2013 Todos los derechos reservados.</span> '; */
				controlText.innerHTML = '<a href="http://www.e-bus.com.ar" target="_blank" ><img src="images/logo.gif" border="0" width="60" height="15"  /></a> <a href="http://www.eycon.com.ar" target="_blank" ><img src="images/logo_eycon_small.png" border="0" width="60" height="12" /></a> <br> <span style="font-size:8px;">Copyright &copy; EYCON S.A. 2013 Todos los derechos reservados.</span> ';
				controlUI.appendChild(controlText);
				return providerControlDiv;
			}
		});
	map.addControl(new MyControlProvider());

	/* Cambios en checkbox PARQUIMETROS, mostrar/ocultar parquímetros */
	$("#switch-parquimetros").change(function (e) {
		if (this.checked) { //mostrar parquímetros
			mostrarParquimetros();
		} else { //ocultar parquímetros
			__clear.layer();
			__clear.array(parkm);
			__clear.array(parkmCircles);
			timer.end();
			caducity.end();
			clearOverlays();
		}
	});	

	/* Cambios en checkbox PUESTOS DE RECARGA, mostrar/ocultar pr */
	$("#switch-pv").change(function (e) {
		if (this.checked) { //mostrar pr
			mostrarPv();
		} else { //ocultar pr
			__clear.layer();
			__clear.array(pvm);
			__clear.array(pvCircles);
			timer.end();
			caducity.end();
			clearOverlays();
		}
	});

	function mostrarParquimetros(){
		__clear.layer();
		__clear.array(parkm);
		__clear.array(parkmCircles);
		timer.end();
		clearOverlays();
		caducity.end();
	
		var myIcon = L.icon(
			{
				iconUrl: 'img/if_parking.png',
				iconSize: [32, 37]
			});
	
		parkm = [];
		parkmCircles = [];		
	
		for (var i in park) {
			if(park[i].lat && park[i].lon)
				var tmp = L.marker([park[i].lat, park[i].lon], { icon: myIcon, title: park[i].ad })
			if(userMarker){ // Agregar circulos a los parquímetros cercanos
				var distAParquimetro = userMarker.getLatLng().distanceTo(tmp.getLatLng());
				if(distAParquimetro < 150){
					var tmpCircleMarker = (new L.marker(tmp.getLatLng(), {icon: L.divIcon({iconSize: [75, 75], className: 'circlemarker'})})).addTo(map);
					parkmCircles.push(tmpCircleMarker);
				}					
			}				
			tmp.addTo(map);
			parkm.push(tmp);
			tmp.bindPopup('<div style="text-align:center">' + park[i].ad + '</div>');	
		}
	}

	function mostrarPv(){
		__clear.layer();
		__clear.array(pvm);
		__clear.array(pvCircles);
		timer.end();
		clearOverlays();
		caducity.end();

		var myIcon = L.icon(
			{
				iconUrl: 'img/pin.png',
				iconSize: [32, 32]
			});

		pvm = [];
		pvCircles = [];

		for (var i in pv) {
			if(pv[i].latitud && pv[i].longitud)
				var tmp = L.marker([pv[i].latitud, pv[i].longitud], { icon: myIcon, title: pv[i].direccion });
			if(userMarker){ // Agregar circulos a los parquímetros cercanos
				var distAPv = userMarker.getLatLng().distanceTo(tmp.getLatLng());
				if(distAPv < 350){
					var tmpCircleMarker = (new L.marker(tmp.getLatLng(), {icon: L.divIcon({iconSize: [75, 75], className: 'circlemarker-pv'})})).addTo(map);
					pvCircles.push(tmpCircleMarker);
				}					
			}	
			tmp.addTo(map);
			pvm.push(tmp);
			tmp.bindPopup('<div style="text-align:center">' + pv[i].direccion + '<br>' + pv[i].razon_social + '</div>');
		}
	}	

	
});

/* Cerrar el navbar collapsible cuando se selecciona una opción */
$(document).on('click', '.navbar-collapse.in', function (e) {
	if ($(e.target).is('a')) {
		$(this).collapse('hide');
	}
});

/* Caja de configuración */
        // SKIN Select
        $('.spin-icon').click(function () {
            $(".theme-config-box").toggleClass("show");
		});
		$('#mapa').on('click touchstart', function(){
			if ($(".theme-config-box").is(".show" ) ) { 
				$(".theme-config-box").toggleClass("show");		 
			}
		})