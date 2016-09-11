@extends('admin_master')

@section('content')


    <div class="col-md-9">
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

    <div id="updateCat" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 400px;  ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Edit Category <span class="person_full_name"> </span></h4>
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


    </script>
@stop
