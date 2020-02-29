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