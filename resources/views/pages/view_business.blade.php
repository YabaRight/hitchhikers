@extends('master_layout')

@section('content')


    <div class="col-md-12">
        <div class="section">
            <div class=" ">
                @if($biz->count() > 0)
                    <div class=" ">

                        @foreach( $biz as $b)
                            <div class="col-md-6 col-md-offset-3 table-bordered">
                                <?php
                                $image = json_decode($b->image_url);
                                $construcCat = "";
                                $bizCat = $b->bussinessCategories;
                                foreach ($bizCat as $bc) {
                                    $construcCat .= "<i>&nbsp;" . $bc->category->name . "</i>";
                                }
                                ?>
                          <img class="img-responsive"    src="{{(count($image)>0)? url("/")."/".$image[0] : ""}}" >
                                <h2>{{ $b->name }}</h2>
                                <p class="text-primary">{{ $b->address }}, {{ $b->email }}, {{ $b->phone1 }}
                                    ,{{ $b->phone2 }}</p>
                                    <p class="text-primary">Website:

                                    {!!  $b->website !!}
                                <p class="text-primary">Description:

                                    {!!  $b->description !!}  </p>

                                <p class="text-primary">Categories:

                                    {!!  $construcCat !!}  </p>

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
