@extends('master_layout')

@section('content')


    <div class="col-md-12">
        <div class="section">
            <div class="container ">
                @if($biz->count() > 0)
                    <div class=" ">
                        <h4>You searched for <h1>{{$searcher}}</h1></h4>
                        @foreach( $biz as $b)
                            <div class="col-md-3 margin-bottom-30 table-bordered">
                                <?php
                                $image = json_decode($b->image_url);
                                $construcCat = "";
                                $bizCat = $b->bussinessCategories;
                                foreach ($bizCat as $bc) {
                                    $construcCat .= "<i>&nbsp;" . $bc->category->name . "</i>";
                                }
                                ?>

                                    <img class="img-responsive"
                                         src="{{(count($image)>0)? url("/")."/".$image[0] : ""}} ">
                                    <h2>{{ $b->name }}</h2>
                                    <p class="text-primary">{{ $b->address }}, {{ $b->email }}, {{ $b->phone1 }}
                                        ,{{ $b->phone2 }}</p>
                                    <p class="text-primary">Website:

                                    {!!  $b->website !!}
                                    <p class="text-primary">Categories:

                                        {!!  $construcCat !!}  </p>

                                    <a href="{{url('biz/'.$b->id)}}" class="btn btn-primary"> <i
                                                class="fa fa-eye"></i></a>


                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="col-md-6 col-md-offset-3 table-bordered">

                        <h4>You searched for <h1>{{$searcher}}</h1></h4>
                        <br/><br/><br/>
                        <h2>No Registered Business with the search criteria</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>


@stop

