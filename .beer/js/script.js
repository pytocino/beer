window.onload = function () {
	function quitarMarca() {
		const attributionElements = document.querySelectorAll('.leaflet-control-attribution.leaflet-control');
		attributionElements.forEach((element) => {
			element.remove();
		});
	}

	function verMapa(longitude, latitude) {
		const mapa = L.map("mapa").setView([latitude, longitude], 15);
		L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
			subdomains: 'abcd',
			maxZoom: 20
		}).addTo(mapa);

		const miUbicacion = L.circle([latitude, longitude], {
			color: "red",
			fillColor: 'red',
			fillOpacity: 1,
			radius: 12
		}).addTo(mapa);

		locales.forEach(function (ubicacion) {
			const marcador = L.marker([ubicacion.latitud, ubicacion.longitud]).addTo(mapa);
			marcador.bindPopup(`<a href="${ubicacion.direccion}" target="_blank">${ubicacion.nombre}</a>`);
		});

		quitarMarca();
	}

	function obtenerCoordenadas(position) {
		const { longitude, latitude } = position.coords;
		verMapa(longitude, latitude);
	}

	function gestionError(error) {
		const coordenadas = document.getElementById("coordenadas");
		switch (error.code) {
			case error.UNKNOWN_ERROR:
				coordenadas.innerHTML = "Error en la geolocalización";
				break;
			case error.PERMISSION_DENIED:
				coordenadas.innerHTML = "El usuario no ha autorizado el acceso a su posición";
				break;
			case error.POSITION_UNAVAILABLE:
				coordenadas.innerHTML = "El usuario no puede ser geolocalizado";
				break;
			case error.TIMEOUT:
				coordenadas.innerHTML = "La geolocalización ha excedido el tiempo límite";
				break;
		}
	}

	function generarLocalización() {
		const opciones = {
			watch: true,
			setView: true,
			enableHighAccuracy: true,
			timeout: 6000,
			maximumAge: 4500
		};
		navigator.geolocation.getCurrentPosition(obtenerCoordenadas, gestionError, opciones);
	}

	const botonCoordenadas = document.getElementById("coordenadasBoton");
	if (navigator.geolocation) {
		botonCoordenadas.addEventListener('click', generarLocalización);
	}
};
