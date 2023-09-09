// let map;
// let marker;

// const { Map } = await google.maps.importLibrary("maps");
// const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

// async function initMap() {
//     const position = { lat: 37.9922, lng: -1.1307 }

//     let mapOptions = {
//         zoom: 7,
//         center: position,
//         mapId: "DEMO_MAP_ID",
//     };
//     map = new Map(document.getElementById("map"), mapOptions);

//     // marker = new AdvancedMarkerElement({
//     //     map: map,
//     //     position: position,
//     // });
// }

// initMap();

// function addMarker(location){
//     marker = new AdvancedMarkerElement({
//         map: map,
//         position: location,
//     });
// }

// addMarker({ lat: 37.9922, lng: -1.1307 })
// addMarker({lat: 39.4699, lng: -0.3763})


    function initMap() {
        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer();
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 232, lng: -1.021}, // Change the center to your desired location
        });
        directionsRenderer.setMap(map);

        var request = {
            origin: 'San Francisco, CA', // Starting point
            destination: 'Los Angeles, CA', // Destination
            travelMode: 'DRIVING' // You can use BICYCLING, TRANSIT, or WALKING as well
        };

        directionsService.route(request, function (result, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(result);
            }
        });
    }
    // Initialize the map when the page loads
    // google.maps.event.addDomListener(window, 'load', initMap);
initMap();
