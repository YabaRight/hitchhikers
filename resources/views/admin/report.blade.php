@extends('admin_master')

@section('content')


    <div class="col-md-9">
    <h3>All Categories Report</h3>
             

        <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
            <br/>
            
            <div class="">
                @include('errors.showerrors')
                <div class="col-md-4">
                     <br/> 
                     
                </div>
                <div class="col-md-10">
                    <a class="navbar-brand block" href="">
                        <div class="h4  ">
                            Category Report
                        </div>
                    </a>
                    <section>
                        <div class=" ">

                             <div class="panel panel-default">
 
                                <table class="table table-striped  ">
                                    <thead>
                                    <tr>
                                        <th>s/n</th>
                                        <th>Category</th>
                                        <th>Total</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    {!! getCategoriesReportWithAction() !!}
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
        function editCat(catObj) {
            var cat_name = catObj.name;
            var cat_description = catObj.description;
            var cat_id = catObj.id;
            $('.catinputhidden').html('<input type="hidden" name="id" value="' + cat_id + '">');


            $('#category_name').val(cat_name);
            $('#category_description').val(cat_description);
//            $('.cat_id').val(cat_id);
            $('#editCategory').modal('show')

        }

        function view_category(id) {
             if ( true) {
                window.location = "{{ url('admin/view_category/') }}" + "/" + id;
            }
        }
    </script>
@stop
