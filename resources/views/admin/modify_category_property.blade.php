@extends('admin_master')

@section('content')


    <div class="col-md-9">
        <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
        <h3>Manage Categories </h3>
            <br/>

            <br/>
            <br/>
            <div class="">
                @include('errors.showerrors')
                @if($catName == null)
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                <li> Not a Valid ID</li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <h2> {{$catName}} </h2>
                    </div>
                    <div class="col-md-4 panel panel-default">
                        <a class="navbar-brand block" href="">Add A Property</a>
                        <br/><br/><br/>
                        <section>
                            <div class="">
                                <br/>
                                <form action="{{url('admin/add_property')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input
                                                type="text"
                                                name="name" required
                                                placeholder="e.g Delivery "
                                                class="form-control input-lg">
                                        <input   name="id" value="{{$id}}" class="hidden">
                                    </div>
                                    <div class="form-group">
                                    <textarea
                                            type="text" rows="3"
                                            name="description" required
                                            class="form-control input-lg">
                                    Description

                                    </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <br/>
                                </form>
                            </div>
                            <br/>
                        </section>
                    </div>
                    <div class="col-md-8 ">
                        <a class="navbar-brand block" href="">
                            <div class="h4  ">
                                Property List
                            </div>
                        </a>
                        <section>
                            <div class=" ">

                                {{--<h4 class="font-bold m-t m-b">Info</h4>--}}
                                <div class="panel panel-default">
                                    <br/>

                                    <table class="table table-striped  ">
                                        <thead>
                                        <tr>
                                            <th>s/n</th>
                                            <th>Category</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        {!! getCategoryPropertyWithAction($id) !!}
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </section>
                    </div>
                @endif

            </div>
        </section>
    </div>
    </div>

@stop
@section('scripts')
    <script>
        function editProperty(catObj) {
            var cat_name = catObj.name;
            var cat_description = catObj.description;
            var cat_id = catObj.id;
            $('.catinputhidden').html('<input type="hidden" name="id" value="' + cat_id + '">');


            $('.category_name').val(cat_name);
            $('.category_description').val(cat_description);
//            $('.cat_id').val(cat_id);
            $('#editProperty').modal('show')

        }

        function deleteProperty(id) {
            var r = confirm("Are you sure you want to delete this property?");
            if (r == true) {
                window.location = "{{ url('admin/delete_property/') }}" + "/" + id;
            }
        }
    </script>
@stop
