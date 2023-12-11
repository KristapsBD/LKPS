@extends('layouts.admin')

@section('head-scripts')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.api_key') }}&callback=initMap" async defer></script>
@endsection

    @section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold dark:text-gray-200">Route Generation</h2>
    </div>

    <div id="map" class="h-[400px]"></div>

@endsection

@section('scripts')
    <script>
        var responseData = @json($optimizedRoute);
        var route = responseData.routes[0];

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -34.92, lng: 138.60 },
                zoom: 8
            });

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: false
            });

            var waypoints = route.legs.flatMap(function (leg) {
                var waypoint = {
                    location: { lat: leg.start_location.lat, lng: leg.start_location.lng },
                    stopover: true
                };
                return waypoint;
            });

            // Include the finish address as the last waypoint
            waypoints.push({
                location: { lat: route.legs[route.legs.length - 1].end_location.lat, lng: route.legs[route.legs.length - 1].end_location.lng },
                stopover: true
            });

            var request = {
                origin: waypoints[0].location,
                destination: waypoints[waypoints.length - 1].location,
                waypoints: waypoints.slice(1, -1), // Exclude the first and last waypoints from the waypoints array
                travelMode: 'DRIVING'
            };

// // Assuming `response` is the response from the DirectionsService.route call
//             var route = responseData.routes[0];
//
// // Extract total distance and duration from the route
//             var totalDistance = route.legs.reduce((sum, leg) => sum + leg.distance.value, 0);
//             var totalDuration = route.legs.reduce((sum, leg) => sum + leg.duration.value, 0);
//
// // Convert distances from meters to your preferred unit (e.g., kilometers)
//             var totalDistanceInKm = (totalDistance / 1000).toFixed(2);
//
// // Convert durations from seconds to your preferred unit (e.g., minutes)
//             var totalDurationInMinutes = Math.round(totalDuration / 60);
//
// // Display the information in a designated area of your UI
//             var tickerElement = document.getElementById('route-ticker');
//             tickerElement.innerHTML = `Total Distance: ${totalDistanceInKm} km | Total Duration: ${totalDurationInMinutes} minutes`;

            directionsService.route(request, function (result, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);
                } else {
                    console.error('Directions request failed:', status);
                }
            });
        }
    </script>
@endsection



{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Optimized Route</title>--}}
{{--    <style>--}}
{{--        #map {--}}
{{--            height: 400px;--}}
{{--        }--}}
{{--    </style>--}}
{{--    <script src="https://maps.googleapis.com/maps/api/js?key={{ config(google.maps.api_key) }}&callback=initMap" async defer></script>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div id="map"></div>--}}

{{--<script>--}}
{{--    var responseData = @json($optimizedRoute);--}}

{{--    function initMap() {--}}
{{--        var map = new google.maps.Map(document.getElementById('map'), {--}}
{{--            center: { lat: -34.92, lng: 138.60 }, // Adjust this to fit your needs--}}
{{--            zoom: 8--}}
{{--        });--}}

{{--        var directionsService = new google.maps.DirectionsService();--}}
{{--        var directionsRenderer = new google.maps.DirectionsRenderer({--}}
{{--            map: map,--}}
{{--            suppressMarkers: false--}}
{{--        });--}}

{{--        var waypoints = responseData.routes[0].legs.map(function (leg) {--}}
{{--            return {--}}
{{--                location: { lat: leg.start_location.lat, lng: leg.start_location.lng },--}}
{{--                stopover: true--}}
{{--            };--}}
{{--        });--}}

{{--        var request = {--}}
{{--            origin: waypoints[0].location,--}}
{{--            destination: waypoints[waypoints.length - 1].location,--}}
{{--            waypoints: waypoints.slice(1, -1),--}}
{{--            travelMode: 'DRIVING'--}}
{{--        };--}}

{{--        directionsService.route(request, function (result, status) {--}}
{{--            if (status === 'OK') {--}}
{{--                directionsRenderer.setDirections(result);--}}
{{--            } else {--}}
{{--                console.error('Directions request failed:', status);--}}
{{--            }--}}
{{--        });--}}
{{--    }--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}
