@extends('ui1')

@section('content')


    <div class="col-md-12">
        <br />
        <div class="section">
            <div class=" ">
                @if($biz->count() > 0)
                    <div class=" ">

                        @foreach( $biz as $b)
                            <div class="col-md-8 col-md-offset-2 table-bordered">
                                <br />
                                <?php
                                $images = json_decode($b->image);
                                $construcCat = $construcImg = "";
                                $bizCat = $b->bussinessCategoryListing;
                                foreach ($bizCat as $bc) {
                                    $construcCat .= "<i>&nbsp;" . $bc->name . "</i>";
                                }
                                foreach ($images as $img) {
                                    $directory  = (count($img)>0)? url("/")."/".$img : "";
                                    $construcImg .= "<img class='img-responsive padding-15 col-md-6' style='height: 300px;'  src='$directory ' >";
                                }
                                ?>
                                <div>
                                    {!! $construcImg !!}
                                </div>

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
