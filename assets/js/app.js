import PerfectScrollbar from 'perfect-scrollbar';
let mapboxgl = require('mapbox-gl/dist/mapbox-gl.js');

// КАРТА
mapboxgl.accessToken = 'pk.eyJ1IjoiZGltYWd1ZGtvdiIsImEiOiJjanAwNXVvN2gyc2JoM21ucnNhdmFobm9hIn0.fxJ2-ihm6ij4slQCh7Nymg';
let map = new mapboxgl.Map({
    container: 'main',
    style: 'mapbox://styles/mapbox/dark-v10',
    scrollZoom: false,
    zoom: 15.5,
    center: [37.1577431,56.7381785]
});

map.addControl(new mapboxgl.NavigationControl());

map.on('click', function(e) {
    let form = document.querySelector('form[name="marker"]');
    if(form){
        document.querySelector('#marker_lat').value = e.lngLat.lng;
        document.querySelector('#marker_lon').value = e.lngLat.lat;
    }
});

// view с метками текущего пользователя
const url = "/marker/list.json";

fetch(url)  
  .then(function(response) {  
      response.json().then(function(data) {  
        data.features.forEach(function(marker) {
            var el = document.createElement('div');
            el.className = 'marker';
          
            new mapboxgl.Marker(el)
              .setLngLat(marker.geometry.coordinates)
              .setPopup(new mapboxgl.Popup({ offset: 25 }) 
              .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
              .addTo(map);
        });
      }); 
    }  
  )  
  .catch(function(err) {  
    console.log(err);  
  });

// КРАСИВЫЙ СКРОЛЛ БЛОКА С МЕТКАМИ
const container = document.querySelector('.user-pointers');
if (container){
    const ps = new PerfectScrollbar(container);
}