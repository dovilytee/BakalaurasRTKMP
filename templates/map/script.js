mapboxgl.accessToken = 'pk.eyJ1IjoiZG92aWx5dGUiLCJhIjoiY2x3M3hudGg0MHhnaTJrbGNtOGc3Z3I3MCJ9.cRp3bAWUCWUX2GRA8YDmJA';
    const map = new mapboxgl.Map({
    container: 'map', // container ID
    style: 'mapbox://styles/mapbox/streets-v12', // style URL
    center: [-74.5, 40], // starting position [lng, lat]
    zoom: 9, // starting zoom
});