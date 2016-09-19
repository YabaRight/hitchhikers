@extends('external')

@section('content')


    <div class="col-md-8 col-md-offset-2">
        <div class="section">
            <h3>Create Business </h3>
            <br/>

            <div class=" ">
                <div class=" ">
                    @include('errors.showerrors')
                    @if($caCount >0)
                        <form role="form" method="post" action="{{url('admin/create_business')}}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group"><label class="control-label">Business Name
                                    </label><input class="form-control" name="name" required 
                                    value="{{old('name')}}"  placeholder="Enter Business Name" type="text"></div>
                            <div class="form-group"><label class="control-label">Email</label><input
                                        class="form-control" placeholder="Email" name="email" 
                                      value="{{old('email')}}"  type="text"></div>
                            <div class="form-group"><label class="control-label">Website</label><input
                                        class="form-control" placeholder="website" name="website"
                                       value="{{old('website')}}"  type="url"></div>
                            <div class="form-group"><label class="control-label">Address</label><input
                                        class="form-control" placeholder="Address" name="address" required
                                       value="{{old('address')}}" id="us3-address" type="Address"></div>
                                       <div id="us3" style="width: 100%; height: 400px;"></div>
                    <div class="clearfix">&nbsp;</div>
                            <div class="form-group"><label class="control-label">X-coordinates</label><input
                                        class="form-control" name="x_cords" id="us3-lat" placeholder=""
                                      value="{{old('x_cords')}}"  type="text"></div>
                            <div class="form-group"><label class="control-label">Y-coordinates</label><input
                                        class="form-control" name="y_cords" id="us3-lon" placeholder=""
                                      value="{{old('y_cords')}}"  type="text"></div>
                                      
                            <div class="form-group"><label class="control-label">Image</label>
                                <input class="form-control" name="biz_image[]" accept="image/*" type="file" required  multiple></div>
                            <div class="form-group"><label class="control-label">Description</label>
                                <textarea class="form-control" required name="biz_description"></textarea> {{old('biz_description')}}</div>
                            <div class="form-group"><label class="control-label">Phone </label><input
                                        class="form-control" required placeholder="08163222222,07011222222" name="phone" value="{{old('phone')}}" 
                                        type="text"></div>


                            <div class="form-group"><label class="control-label">Twitter</label><input
                                        class="form-control" name="twitter" placeholder=""
                                         value="{{old('twitter')}}"  type="text"></div>
                            <div class="form-group"><label class="control-label">Facebook</label><input
                                        class="form-control" name="facebook" placeholder=""
                                       value="{{old('facebook')}}"   type="text"></div>
                            <div class="form-group"><label class="control-label">Instagram</label><input
                                        class="form-control" name="instagram" placeholder=""
                                        value="{{old('instagram')}}"   type="text"></div>
                            <div class="form-group"><label class="control-label">Open Hours</label><input
                                        class="form-control" required name="hours" placeholder="8am - 5pm, Monday to Friday"  value="{{old('hours')}}"  
                                        type="text"></div>


                            <hr/>

                            <h3> Attributes </h3>


                            <div class="form-group">
                                {!! getCategoriesforBiz() !!}
                            </div>

                            <div class="form-group" id="form-cat-group">

                            </div>

                            <button type="submit" class="btn btn-default">Submit</button><br />
                        </form>
                        <br />
                        <br />
                    @else
                        <h2> Create A Category First Before You Can Create Businesses</h2>
                    @endif

                </div>
            </div>
        </div>
    </div>

@stop
@section('scripts')
    <script>
         
            var use_id = {{$initial_usage_id}};
            makeCategoryCall(use_id);
            function makeCategoryCall(index) {
                var url = "{{url('admin/ajax/get_cat_property')}}" +"/" +index + "";
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

            $('#us3').locationpicker({
                            location: {
                                latitude: 6.517790600000001,
                                longitude: 3.382686299999932
                            },
                            radius: 3,
                            inputBinding: {
                                latitudeInput: $('#us3-lat'),
                                longitudeInput: $('#us3-lon'),
                                radiusInput: $('#us3-radius'),
                                locationNameInput: $('#us3-address')
                            },
                            enableAutocomplete: true,
                            onchanged: function (currentLocation, radius, isMarkerDropped) {
                                // alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                            }
                        });

        


    </script>
@stop