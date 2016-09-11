@extends('admin_master')

@section('content')


    <div class="col-md-9">
        <div class="section">
            <div class=" ">
                @if($biz->count() > 0)
                    <div class=" ">
                        @include('errors.showerrors')
                        @foreach( $biz as $b)
                            <div class="col-md-4 margin-bottom-30">
                                <?php
                                $image = json_decode($b->image_url);
                                $construcCat = "";
                                $bizCat = $b->bussinessCategories;
                                foreach ($bizCat as $bc) {
                                    $construcCat .= "<i>&nbsp;" . $bc->category->name . "</i>";
                                }
                                ?>
                                    <a href="javascript:;" onclick="updateimage({{$b}})" class="btn btn-sm btn-danger"> <i
                                                class="fa fa-edit"></i> Edit Image</a>
                                <img class="img-responsive"
                                     src="{{(count($image)>0)? url("/")."/".$image[0] : ""}} ">
                                <h2>{{ $b->name }}</h2>
                                <p class="text-primary">{{ $b->address }}, {{ $b->email }}, {{ $b->phone1 }}
                                    ,{{ $b->phone2 }}</p>
                                <p class="text-primary">Website:

                                    {!!  $b->website !!}
                                </p><p class="text-primary">Categories:

                                    {!!  $construcCat !!}  </p>
                                <a href="javascript:;" onclick="updateBiz({{$b}})" class="btn btn-primary"> <i
                                            class="fa fa-edit"></i></a>
                                <a href="{{url('admin/biz/'.$b->id)}}" class="btn btn-primary"> <i
                                            class="fa fa-eye"></i></a>
                                <a href="javascript:;" onclick="updateCat({{$b->id}})" class="btn btn-primary"> Add
                                    Category</a> <a href="javascript:;" onclick="delBiz({{$b->id}})"
                                                    class="btn btn-danger"> <i class="fa fa-trash-o"></i>
                                </a>
                            </div>
                        @endforeach

                    </div>
                @else
                    <h2>No Registered Business</h2>
                @endif
            </div>
        </div>
    </div>

    <div id="updateBiz" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 400px;  ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Edit Business Details <span class="person_full_name"> </span></h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('admin/update_biz') }}">
                        {{ csrf_field() }}
                        <div class="form-group"><label class="control-label">Business Name
                                address</label><input class="form-control name" name="name"
                                                      placeholder="Enter Business Name" type="text"></div>
                        <div class="form-group"><label class="control-label">Email</label><input
                                    class="form-control email" placeholder="Email" name="email"
                                    type="text">
                        </div>
                        <div class="form-group"><label class="control-label">Website</label><input
                                    class="form-control website" placeholder="Website" name="website"
                                    type="url">
                        </div>
                        <div class="form-group"><label class="control-label">Address</label><input
                                    class="form-control address" placeholder="Address" name="address"
                                    type="Address">
                        </div>

                        <div class="form-group"><label class="control-label">Description</label>
                            <textarea class="form-control biz_description" name="biz_description"></textarea>
                        </div>
                        <div class="form-group"><label class="control-label">Phone </label><input
                                    class="form-control biz_phone1" placeholder="Phone" name="biz_phone1"
                                    type="text"></div>
                        <div class="form-group"><label class="control-label">Alt Phone</label><input
                                    class="form-control biz_phone2" name="biz_phone2" placeholder="Alternate Phone"
                                    type="text"></div>
                        <div class="bizinputhidden">

                        </div>
                        <button type="submit" class="btn btn-info btn-xs pull-right">Update</button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
    </div>
    <div id="updateCat" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 400px;  ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Edit Category </h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('admin/update_category') }}">
                        {{ csrf_field() }}
                        <div class="catinputhidden">

                        </div>
                        <div class="form-group">{!! getCategoriesforBiz() !!}</div>
                        <div class="line line-dashed line-lg pull-in"></div>

                        <button type="submit" class="btn btn-info btn-xs pull-right">Update</button>
                        <br/>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>

        </div>
    </div>

@stop
@section('script')
    <script>
        function updateCat(catObj) {

            $('.catinputhidden').html('<input type="hidden" name="id" value="' + catObj + '">');


            $('#updateCat').modal('show')

        }

        function updateimage(catObj) {

            $('.Imageinputhidden').html('<input type="hidden" name="id" value="' + catObj.id + '">');


            $('#updateImage').modal('show')

        }
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
