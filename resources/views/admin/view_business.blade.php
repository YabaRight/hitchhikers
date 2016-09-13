@extends('admin_master')

@section('content')



    <div class="col-md-9">
        <div class="section">
            <div class=" ">
            @include('errors.showerrors')
                @if($biz->count() > 0)
                    <div class=" ">
                        @foreach( $biz as $b)
                            <div class="col-md-8 col-md-offset-2 table-bordered">
                                <?php
                                $image = json_decode($b->image);
                                $construcCat = "";
                                $construcImg = "";
                                $listing_id =  $b->id;
                                $bizCat = $b->bussinessCategoryListing;
                                foreach ($bizCat as $bc) {
                                    $construcCat .= "<i>&nbsp;" . $bc->name . "</i>";
                                }
                                foreach ($image as $im) {
                                    $construcImg .= "<div class='col-md-6 panel panel-default'><img class='img-responsive' src='".url('/') .'/'. $im . "' alt='' > </div>";
                                }



                                ?>
                            <div class="form-group"><label class="control-label">Business Name
                                    </label><span class="form-control disabled" >{{$b->name}}</span></div>
                            <div class="form-group"><label class="control-label">Email</label><span
                                        class="form-control disabled" >{{$b->email}}</span></div>
                            <div class="form-group"><label class="control-label">Website</label><span
                                        class="form-control disabled" >{{$b->url}}</span></div>
                            <div class="form-group"><label class="control-label">Address</label><span
                                        class="form-control disabled" >{{$b->address}}</span></div>
                            <div class="form-group"><label class="control-label">X-coordinates</label><span
                                        class="form-control disabled" >{{$b->x_coordinate}}</span></div>
                            <div class="form-group"><label class="control-label">Y-coordinates</label><span
                                        class="form-control disabled" >{{$b->y_coordinate}}</span></div>
                             
                            <div class="form-group"><label class="control-label">Description</label>
                                <span class="form-control disabled" >{{$b->description}}</span></div>
                            <div class="form-group"><label class="control-label">Phone </label><span
                                        class="form-control disabled" >{{$b->phone}}</span></div>


                            <div class="form-group"><label class="control-label">Twitter</label><span
                                        class="form-control disabled" >{{$b->twitter}}</span></div>
                            <div class="form-group"><label class="control-label">Facebook</label><span
                                        class="form-control disabled" >{{$b->facebook}}</span></div>
                            <div class="form-group"><label class="control-label">Instagram</label><span
                                        class="form-control disabled" >{{$b->instagram}}</span></div>
                            <div class="form-group"><label class="control-label">Open Hours</label><span
                                        class="form-control disabled" > {{$b->hours}} </span></div>
                            <div class="form-group"><label class="control-label">Category</label><span
                                        class="form-control disabled" >{!!  $construcCat !!}</span>  </div>
                            <hr>
                            <div class="form-group"><label class="control-label">---- Attributes ----</label>  </div>
                            <hr>
                            <div class="form-group" id="form-cat-group">

                            </div>

                            <div class="form-group"><label class="control-label  col-md-12">Photos</label><span
                                        class="block disabled" ></span> {!!  $construcImg !!} </div>
                                 

                            </div>
                        @endforeach

                    </div>
                @else
                    <h2>This Business Doesn't Exist</h2>
                @endif
            </div>
        </div>
    </div>

  
    </div>

@stop
@section('scripts')
    <script>
       var listing_id = {{$listing_id}};
            makeCategoryCall(listing_id);
            console.log(listing_id);
            function makeCategoryCall(index) {
                var url = "{{url('admin/ajax/get_biz_property')}}" +"/" +index + "";
                $.ajax({
                    url: url,
                    type: 'get',
                    context: document.body,
                    beforeSend : function (){
                        $('#form-cat-group').html(" Loading ... ");
//                    alert('');
                    }
                }).done(function (data) {

                    $('#form-cat-group').html(data);

                });
            }
    </script>
@stop
