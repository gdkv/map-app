import PerfectScrollbar from 'perfect-scrollbar';
var mapboxgl = require('mapbox-gl/dist/mapbox-gl.js');

mapboxgl.accessToken = 'pk.eyJ1IjoiZGltYWd1ZGtvdiIsImEiOiJjanAwNXVvN2gyc2JoM21ucnNhdmFobm9hIn0.fxJ2-ihm6ij4slQCh7Nymg';
var map = new mapboxgl.Map({
    container: 'main',
    style: 'mapbox://styles/mapbox/dark-v10',
    scrollZoom: false,
    zoom: 15.5,
    center: [37.1618431,56.7381785]
});

map.addControl(new mapboxgl.NavigationControl());

var geojson = {
    type: 'FeatureCollection',
    features: [{
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [37.1618431,56.7381785]
      },
      properties: {
        title: 'Mapbox',
        description: 'Washington, D.C.'
      }
    },
    {
      type: 'Feature',
      geometry: {
        type: 'Point',
        coordinates: [37.1518431,56.7381785]
      },
      properties: {
        title: 'Mapbox',
        description: 'San Francisco, California'
      }
    }]
  };

  fetch(url) // Call the fetch function passing the url of the API as a parameter
  .then(function() {
      // Your code for handling the data you get from the API
  })
  .catch(function() {
      // This is where you run code if the server returns any errors
  });
  
// add markers to map
geojson.features.forEach(function(marker) {

    // create a HTML element for each feature
    var el = document.createElement('div');
    el.className = 'marker';
  
    // make a marker for each feature and add to the map
    new mapboxgl.Marker(el)
      .setLngLat(marker.geometry.coordinates)
      .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
      .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
      .addTo(map);
});