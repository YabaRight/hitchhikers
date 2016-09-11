@extends('admin_master')

@section('content')


    <div class="col-md-9">
        <div class="section">
            <h3>Create Business  </h3>
            <br/>

            <div class=" ">
                <div class=" ">
                @include('errors.showerrors')
                    @if($caCount >0)
                    <form role="form" method="post" action="{{url('admin/create_business')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group"><label class="control-label">Business Name
                                address</label><input class="form-control" name="name"
                                                      placeholder="Enter Business Name" type="text"></div>
                        <div class="form-group"><label class="control-label">Email</label><input
                                    class="form-control" placeholder="Email" name="email"
                                    type="text"></div>
                        <div class="form-group"><label class="control-label">Website</label><input
                                    class="form-control" placeholder="website" name="website"
                                    type="url"></div>
                        <div class="form-group"><label class="control-label">Address</label><input
                                    class="form-control" placeholder="Address" name="address"
                                    type="Address"></div>
                        <div class="form-group"><label class="control-label">Image</label>
                            <input class="form-control" name="biz_image" type="file"></div>
                        <div class="form-group"><label class="control-label">Description</label>
                            <textarea class="form-control" name="biz_description"></textarea></div>
                        <div class="form-group"><label class="control-label">Phone </label><input
                                    class="form-control" placeholder="Phone" name="biz_phone1"
                                    type="text"></div>
                        <div class="form-group"><label class="control-label">Alt Phone</label><input
                                    class="form-control" name="biz_phone2" placeholder="Alternate Phone"
                                    type="text"></div>
                        <hr/>
                        <hr/>

                        <h3> Business Category</h3>

                        
                        <div class="form-group">{!! getCategoriesforBiz() !!}</div>



                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                        @else
                        <h2> Create A Category First Before You Can Create Businesses</h2>
                    @endif

            </div>
        </div>
    </div>
    </div>

@stop
