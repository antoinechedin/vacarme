var map = L.map('dynamic-map', {
    minZoom: 0,
    maxZoom: 2
});

L.tileLayer('http://localhost/wp-content/uploads/2022/01/{z}{y}{x}.jpg', {
    minZoom: 0,
    maxZoom: 2,
    noWrap: true,
    bounds: L.latLngBounds(L.latLng(-90, -180), L.latLng(90, 180))
}).addTo(map);

map.setView([0, 0], 0);
