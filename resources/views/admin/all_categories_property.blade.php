@extends('admin_master')

@section('content')


    <div class="col-md-9">
    <h3>Category Properties </h3>
            <br/>

        <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
            <br/>
            <br/>
            <div class="">
                @include('errors.showerrors')

                <div class="col-md-10 col-md-offset-1">
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
                                    {!! getCategoriesWithActiontoModifyProperties() !!}
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
@section('scripts')
    <script>


        function modifyCat(id) {
            var r = true;
            if (r == true) {
                window.location = "{{ url('admin/modify_category_property/') }}" + "/" + id;
            }
        }
    </script>
@stop
