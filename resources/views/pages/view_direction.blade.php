@extends('ui1')

@section('content')


    <div class="col-md-12">
        <br/>
        <div class="section">
            <div class=" padding-15">
                @if(1 > 0)
                    <div class="col-md-12">
                        <h4 class=" padding-15">Showing directions from your current location to {{ $address }} </h4>
                    </div>
                    <a class="btn btn-primary direction_mode" onclick="switch_direction_mode('walking')">WALKING</a>
                    <a class="btn btn-primary direction_mode" onclick="switch_direction_mode('driving')">DRIVING</a>
                    <div id="map"></div>
                @else
                    <h2>No Registered Business</h2>
                @endif
            </div>
        </div>
    </div>


@stop
@section('script')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoWgxBWrrdF1XpdAG26fbifxwALZZJ23Y">
    </script>
    <script>
        var could_get_user_location = null;
        var user_direction_mode = "DRIVING";
        var gpsLat;
        var gpsLng;

        function switch_direction_mode(mode) {
            if (could_get_user_location) {
                var current_mode = mode;
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 17,
                    center: {lat: gpsLat, lng: gpsLng}
                });
                directionsDisplay.setMap(map);


                if (current_mode == 'walking') {
                    user_direction_mode = 'WALKING';
                    calculateAndDisplayRoute(directionsService, directionsDisplay, "WALKING");
                } else {
                    user_direction_mode = 'DRIVING';
                    calculateAndDisplayRoute(directionsService, directionsDisplay, "DRIVING");
                }
            } else {
                window.alert(' Directions request failed. We Could not get your current location.  ');
            }

        }

        if (navigator.geolocation) {

            // user  allows
            navigator.geolocation.getCurrentPosition(function (position) {
                gpsLat = position.coords.latitude;
                gpsLng = position.coords.longitude;
                var token = '{{ csrf_token() }}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    url: '{{url("ajax/saveLocationToSession")}}',
                    type: "post",
                    data: {'_token': token, 'gps_lat': gpsLat, 'gps_lng': gpsLng},

                    success: function (data) {
                        console.log(" get location was successful. ");
                        initMap();
                    }
                });

            }, function () {
                console.log(" get location ended with error");
            });
            could_get_user_location = true;

        } else {
            could_get_user_location = false;

        }

        //        Initialize the map
        function initMap() {
            if (could_get_user_location) {
                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 17,
                    center: {lat: gpsLat, lng: gpsLng}
                });
                directionsDisplay.setMap(map);
//            display the route for the map
                calculateAndDisplayRoute(directionsService, directionsDisplay, user_direction_mode);

            } else {
                window.alert(' Directions request failed. We Could not get your current location.  ');
            }


        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay, travelMODE) {
            if (could_get_user_location) {
                directionsService.route({
                    origin: new google.maps.LatLng(gpsLat,gpsLng),
                    destination: new google.maps.LatLng({{$x}}, {{$y}}),
                    travelMode: travelMODE
                }, function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);

                    } else {
                        window.alert(' Directions request failed  ');
                    }
                });
            } else {
                window.alert(' Directions request failed. We Could not get your current location.  ');
            }
        }
    </script>

@stop