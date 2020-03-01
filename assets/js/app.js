import PerfectScrollbar from 'perfect-scrollbar';
let mapboxgl = require('mapbox-gl/dist/mapbox-gl.js');

mapboxgl.accessToken = 'pk.eyJ1IjoiZGltYWd1ZGtvdiIsImEiOiJjanAwNXVvN2gyc2JoM21ucnNhdmFobm9hIn0.fxJ2-ihm6ij4slQCh7Nymg';
let map = new mapboxgl.Map({
    container: 'main',
    style: 'mapbox://styles/mapbox/dark-v10',
    scrollZoom: false,
    zoom: 15.5,
    center: [37.1577431,56.7381785]
});

map.addControl(new mapboxgl.NavigationControl());

const url = "/marker/list.json";

fetch(url)  
  .then(function(response) {  
      response.json().then(function(data) {  
        data.features.forEach(function(marker) {
            var el = document.createElement('div');
            el.className = 'marker';
          
            new mapboxgl.Marker(el)
              .setLngLat(marker.geometry.coordinates)
              .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
              .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
              .addTo(map);
        });
      }); 
    }  
  )  
  .catch(function(err) {  
    console.log(err);  
  });

const container = document.querySelector('.user-pointers');
const ps = new PerfectScrollbar(container);