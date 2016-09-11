<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet"/>

    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/normalize.css')}}"/>
    <link rel="stylesheet" href="{{url('css/style.css')}}"/>


    {{--<link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">--}}
    <link href=" {{url('css/style.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
@include('widgets.menu_top')
<div class="section">
    <div class="container">
        <div class="row">
            @include('widgets.admin_menu_left')

            @yield("content")


        </div>
    </div>
</div>
<div id="updateImage" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 400px;  ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Business Image <span class="person_full_name"> </span></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('admin/update_image') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="Imageinputhidden">

                    </div>
                    <div class="form-group"><label>Select File</label>
                        <div>
                            <input type="file" required name="image_url">
                        </div>

                    </div>
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
<div id="editCategory" class="modal fade" role="dialog">
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
                    {{--                    <div class="form-group">{!! getCategoriesforBiz() !!}</div>--}}
                    <div class="form-group">
                        <input
                                type="text"
                                id="category_name"
                                name="name" required
                                placeholder="Finance or Eatry"
                                class="form-control input-lg">
                    </div>
                    <div class="form-group">
                                <textarea
                                        id="category_description"
                                        type="text" rows="3"
                                        name="description" required
                                        class="form-control input-lg">
                                    Description

                                </textarea>
                    </div>
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
<script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>

@yield("script")
</body>
</html>
