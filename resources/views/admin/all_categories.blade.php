@extends('admin_master')

@section('content')


    <div class="col-md-9">
        <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
            <br/>
            <br/>
            <div class="">
                @include('errors.showerrors')
                <div class="col-md-4">
                    <a class="navbar-brand block" href="">Add A Category</a>
                    <br/><br/><br/>
                    <section>

                        <form action="{{url('admin/add_category')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input
                                        type="text"
                                        name="name" required
                                        placeholder="Finance or Eatry"
                                        class="form-control input-lg">
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


                        </form>
                    </section>
                </div>
                <div class="col-md-8">
                    <a class="navbar-brand block" href="">
                        <div class="h4  ">
                            Category List
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
                                    {!! getCategoriesWithAction() !!}
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </section>
                </div>
            </div>
        </section>
    </div>
    </div>

@stop
@section('script')
    <script>
        function editCat(catObj) {
            var cat_name = catObj.name;
            var cat_description = catObj.description;
            var cat_id = catObj.id;
            $('.inputhidden').html('<input type="hidden" name="id" value="' + cat_id + '">');


            $('#category_name').val(cat_name);
            $('#category_description').val(cat_description);
//            $('.cat_id').val(cat_id);
            $('#editCategory').modal('show')

        }

        function deleteCat(id) {
            var r = confirm("Are you sure you want to delete this Category?");
            if (r == true) {
                window.location = "{{ url('admin/delete_category/') }}" + "/" + id;
            }
        }
    </script>
@stop
