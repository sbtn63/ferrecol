document.querySelectorAll('.toggle-button').forEach(button => {
    button.addEventListener('click', function() {
        var targetId = this.getAttribute('data-toggle-target');
        var targetElement = document.querySelector(targetId);
        
        if (targetElement.classList.contains('hidden')) {
            targetElement.classList.remove('hidden');
        } else {
            targetElement.classList.add('hidden');
        }
    });
});



var map = L.map('map').setView([5, -74], 7);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

function addMapTitle(map, title) {
    var mapTitle = L.control({ position: 'topright' });
        mapTitle.onAdd = function () {
            var div = L.DomUtil.create('div', 'bg-gray-700 p-1 text-white font-semibold');
            div.innerHTML = `<h2>${title}</h2>`;
            return div;
        };
    mapTitle.addTo(map);
}

addMapTitle(map, 'Municipios con Estaciones de Tren en Boyacá y Cundinamarca');

async function getMunicipalities() {
    try {
        const response = await fetch('api/municipality/');
        if (!response.ok) {
            throw new Error('Error en la solicitud HTTP: ' + response.status);
        }
        
        const data = await response.json();
            return data.data.map(municipality => municipality.name);
    } catch (error) {
        console.error('Error al obtener los datos de la API de municipios:', error);
    }
}

async function getCoordinates(municipality) {
    var apiKey = '55985ec2cf764168bd53eafbf523f9df';
    var url = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(municipality)},Colombia&key=${apiKey}&limit=1`;

    try {
        const response = await fetch(url);
        const data = await response.json();
        if (data.results.length > 0) {
            var lat = data.results[0].geometry.lat;
            var lon = data.results[0].geometry.lng;
            L.marker([lat, lon]).addTo(map)
                .bindPopup(`<b>${municipality}</b>`)
                .openPopup();
        } else {
            console.log(`No se encontraron coordenadas para ${municipality}`);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function showMunicipalitiesMap() {
    const municipalities = await getMunicipalities();
    municipalities.forEach(municipality => getCoordinates(municipality));
}

showMunicipalitiesMap();