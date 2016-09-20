@extends('admin_master')

@section('content')


    <div class="col-md-9">
        <div class="section">
            <h3>All Unverified Businesses </h3>
            <br/>

            <div class=" ">
                @if($biz->count() > 0)
                    <div class=" ">
                        @include('errors.showerrors')
                        @foreach( $biz as $b)
                            <div class="col-md-4 margin-bottom-30">
                                <?php
                                $image = json_decode($b->image);

                                // print_r($image);
                                $construcCat = "";
                                $bizCat = $b->bussinessCategoryListing;
                                // dd($bizCat);
                                foreach ($bizCat as $bc) {
                                    $construcCat .= "<i>&nbsp;" . $bc->name . "</i>";
                                }
                                ?>
                                        <!-- <a href="javascript:;" onclick="updateimage({{--$b--}})" class="btn btn-sm btn-danger"> <i
                                    class="fa fa-edit"></i> Edit Image</a> -->
                                <img class="img-responsive" style="height: 200px;"
                                     src="{{(count($image)>0)? url("/")."/".$image[0] : ""}} ">
                                <h2>{{ $b->name }}</h2>
                                <p class="text-primary">{{ $b->address }}, {{ $b->email }}, {{ $b->phone }}
                                </p>
                                <p class="text-primary">Website:

                                    {!!  $b->url !!}
                                </p>
                                <p class="text-primary">Category:

                                    {!!  $construcCat !!}  </p>
                                <a href="{{url('admin/verify_biz/'.$b->id)}}" title="Verify" class="btn btn-primary">
                                    <i class="fa fa-magic"></i>
                                </a>
                                <a href="{{url('admin/edit_biz/'.$b->id)}}" title="Edit" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{url('admin/biz/'.$b->id)}}"  title="View" class="btn btn-primary"> <i
                                            class="fa fa-eye"></i></a>
                                <a href="javascript:;" title="Delete" onclick="delBiz({{$b->id}})" class="btn btn-danger"> <i
                                            class="fa fa-trash-o"></i></a>

                            </div>
                        @endforeach
                        <div class="col-md-12">
                            {{ $biz->links() }}
                        </div>

                    </div>
                @else
                    <h2>No Unverified Business</h2>
                @endif
            </div>
        </div>
    </div>


@stop
@section('scripts')
    <script>


        function delBiz(catObj) {
            var r = confirm("Are you sure you want to delete this Business?");
            if (r == true) {
                window.location = "{{ url('admin/delete_biz') }}" + "/" + catObj;
            }

        }

        function updateBiz(bizObj) {
            $('.bizinputhidden').html('<input type="hidden" name="id" value="' + bizObj.id + '">');

            $('input.name').val(bizObj.name);
            $('input.email').val(bizObj.email);
            $('input.address').val(bizObj.address);
            $('input.website').val(bizObj.website);
//            $('input.biz_image').val(bizObj.name);
            $('input.biz_description').val(bizObj.description);
            $('input.biz_phone1').val(bizObj.phone1);
            $('input.biz_phone2').val(bizObj.phone2);
            $('#updateBiz').modal('show')

        }


    </script>
@stop
