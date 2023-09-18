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


//     function initMap() {
//         var directionsService = new google.maps.DirectionsService();
//         var directionsRenderer = new google.maps.DirectionsRenderer();
//         var map = new google.maps.Map(document.getElementById('map'), {
//             zoom: 10,
//             center: {lat: 232, lng: -1.021}, // Change the center to your desired location
//         });
//         directionsRenderer.setMap(map);

//         var request = {
//             origin: 'San Francisco, CA', // Starting point
//             destination: 'Los Angeles, CA', // Destination
//             travelMode: 'DRIVING' // You can use BICYCLING, TRANSIT, or WALKING as well
//         };

//         directionsService.route(request, function (result, status) {
//             if (status == 'OK') {
//                 directionsRenderer.setDirections(result);
//             }
//         });
//     }
//     // Initialize the map when the page loads
//     // google.maps.event.addDomListener(window, 'load', initMap);
// initMap();


// Initialize the map
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: { lat: 37.7749, lng: -122.4194 } // Set your initial map center
    });

    var waypoints = [
        { location: 'San Francisco, CA' },
        { location: { lat: 36.71595498881492, lng: -119.78094079295637 } },
        { location: { lat: 35.38715202853713, lng: -119.0418580121277 } },
        { location: 'Los Angeles, CA' },
        // Add more waypoints as needed
    ];

    for (var i = 0; i < waypoints.length; i++) {
        var waypoint = waypoints[i];
        var marker = new google.maps.Marker({
            position: typeof waypoint.location === 'string' ? waypoint.location : waypoint.location,
            map: map,
            title: typeof waypoint.location === 'string' ? waypoint.location : '', // Use the location name as the marker title
        });

        // Add an info window for additional information when clicking on a marker
        var infowindow = new google.maps.InfoWindow({
            content: waypoint.location, // You can customize this content as needed
        });

        marker.addListener('click', function () {
            infowindow.open(map, this);
        });
    }

    // Create a DirectionsService to fetch directions
    var directionsService = new google.maps.DirectionsService();

    // Create a DirectionsRenderer to display the route
    var directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true, // You can customize marker appearance
    });

    // Configure the route request
    var request = {
        origin: waypoints[0].location, // Starting point
        destination: waypoints[waypoints.length - 1].location, // Destination
        waypoints: waypoints.slice(1, -1), // Exclude starting and ending points
        travelMode: 'DRIVING', // Travel mode (DRIVING, BICYCLING, WALKING, etc.)
    };

    // Request directions and render the route
    directionsService.route(request, function (result, status) {
        if (status == 'OK') {
            directionsRenderer.setDirections(result);
        }
    });

    var selectedLocationInput = document.getElementById('selected-location');

    // Listen for a click event on the map
    google.maps.event.addListener(map, 'click', function (event) {
        var clickedLocation = event.latLng;
        // Set the input field's value to the selected location's coordinates
        selectedLocationInput.value = clickedLocation.lat() + ', ' + clickedLocation.lng();
    });
}

// Initialize the map when the page loads
google.maps.event.addDomListener(window, 'load', initMap);

