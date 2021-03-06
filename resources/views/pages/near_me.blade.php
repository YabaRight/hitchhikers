@extends('ui1')

@section('content')


    <div class="col-md-12">
        <div class="section">
            <div class="container ">
                @if($biz->count() > 0)
                    <div class=" ">
                        <h4>Showing Places Near {{ucwords($area)}}</h4>
                        @foreach( $biz as $b)
                            <a href="{{url('biz/'.$b->id)}}" >
                            <div class="col-md-3 margin-bottom-30 table-bordered padding-15 margin-15">
                                <?php
                                $image = json_decode($b->image);
                                $construcCat = "";
                                $bizCat = $b->bussinessCategoryListing;
                                foreach ($bizCat as $bc) {
                                    $construcCat .= "<i>&nbsp;" . $bc->name . "</i>";
                                }
                                ?>

                                    <img class="img-responsive" style="height: 200px;"
                                         src="{{(count($image)>0)? url("/")."/".$image[0] : ""}} ">

                                    <h2>{{ $b->name }}</h2>
                                    <p class="text-primary">{{ $b->address }}, {{ $b->email }}, {{ $b->phone }}</p>
                                    <p class="text-primary">Website:

                                    {!!  $b->website !!}
                                    <p class="text-primary">Categories:

                                        {!!  $construcCat !!}  </p>

                                  {{--<i--}}
                                                {{--class="fa fa-eye"></i>--}}


                            </div></a>
                        @endforeach

                    </div>
                @else
                    <div class="col-md-6 col-md-offset-3 table-bordered margin-top-30">

                        <h4>Showing Places Near {{ucwords($area)}}</h4>
                        <br/>
                        <br/>
                        <h2>No Registered Business Near You.</h2>
                        <br />
                    </div>
                @endif
            </div>
        </div>
    </div>


@stop

