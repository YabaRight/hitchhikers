@extends('ui1')

@section('content')


    <div class="col-md-12">
        <br/>
        <div class="section">
            <div class=" ">
                @if($biz->count() > 0)
                    <div class=" ">

                        @foreach( $biz as $b)
                            <div class="col-md-8 col-md-offset-2 table-bordered padding-15">
                                <br/>
                                <?php
                                $images = json_decode($b->image);
                                $construcCat = $construcImg = "";
                                $bizCat = $b->bussinessCategoryListing;
                                foreach ($bizCat as $bc) {
                                    $construcCat .= "<i>&nbsp;" . $bc->name . "</i>";
                                }
                                foreach ($images as $img) {
                                    $directory = (count($img) > 0) ? url("/") . "/" . $img : "";
                                    $construcImg .= "<img class='img-responsive padding-15 col-md-6' style='height: 300px;'  src='$directory ' >";
                                }
                                ?>
                                <div>
                                    {!! $construcImg !!}
                                </div>

                                <h2>{{ $b->name }}</h2>
                                <p class="text-primary">{{ $b->address }}, {{ $b->email }}, {{ $b->phone }} </p>
                                <p class="text-primary">Website:

                                {!!  $b->url !!}
                                <p class="text-primary">Description:

                                    {!!  $b->description !!}  </p>

                                <p class="text-primary">Categories:

                                    {!!  $construcCat !!}  </p>
                                <a onclick="get_map_direction({{$b->x_coordinate}},{{$b->y_coordinate}})" class="btn btn-primary"> Get Map Direction </a>

                            </div>
                        @endforeach

                    </div>
                @else
                    <h2>No Registered Business</h2>
                @endif
            </div>
        </div>
    </div>


@stop
@section('script')
    <script>
        var could_get_user_location = null;
        if (navigator.geolocation) {
            console.log("entered locator");
            // user  allows
            navigator.geolocation.getCurrentPosition(function (position) {
                var gpsLat = position.coords.latitude;
                var gpsLng = position.coords.longitude;
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
                    }
                });

            }, function () {
                console.log(" get location ended with error");
            });
            could_get_user_location = true;

        }else{
            could_get_user_location = false;

        }
        function get_map_direction(x,y) {
            if(could_get_user_location){
                window.location  = "{{url("/get_map_direction/")}}" + "/" + x + "/" + y;
//                alert(" Your Current Location Is Available. ");
            }else{
                alert(" Your Current Location Is Not Available. ");
            }

        }
    </script>
@stop