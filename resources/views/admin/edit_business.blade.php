@extends('admin_master')

@section('content')



    <div class="col-md-9">
        <div class="section">
        <h3>Edit Business </h3>
            <br/>

            <div class=" ">
            @include('errors.showerrors')
                @if($biz->count() > 0)
                    <div class=" ">
                        @foreach( $biz as $b)
                            <div class="col-md-8 col-md-offset-2 table-bordered">
                                <?php
                                $images = $image = json_decode($b->image);
                                $construcCat = "";
                                $construcImg = "";
                                $listing_id =  $b->id;
                                $bizCat = $b->bussinessCategoryListing;
                                foreach ($bizCat as $bc) {
                                    $construcCat .= "<i>&nbsp;" . $bc->name . "</i>";
                                }
                                foreach ($image as $im) {
                                    $construcImg .= "<div class='col-md-6 panel panel-default'><img class='img-responsive' src='".url('/') .'/'. $im . "' alt='' > </div>";
                                }



                                ?>
                            <form role="form" method="post" action="{{url('admin/update_business')}}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group"><label class="control-label">Business Name
                                    </label><input class="form-control" name="name" required  value='{{$b->name}}' placeholder="Enter Business Name" type="text"></div>
                            <div class="form-group"><label class="control-label">Email</label><input
                                        class="form-control" placeholder="Email" value='{{$b->email}}' name="email" 
                                        type="text"></div>
                            <div class="form-group"><label class="control-label">Website</label><input
                                        class="form-control" placeholder="website" name="website"
                                      value='{{$b->url}}'  type="url"></div>
                            <div class="form-group"><label class="control-label">Address</label><input
                                        class="form-control" placeholder="Address" name="address" required
                                       value='{{$b->address}}' type="Address"></div>
                            <div class="form-group"><label class="control-label">X-coordinates</label><input
                                        class="form-control" name="x_cords" placeholder=""
                                       value='{{$b->x_coordinate}}' type="text"></div>
                            <div class="form-group"><label class="control-label">Y-coordinates</label><input
                                        class="form-control" name="y_cords" placeholder=""
                                       value='{{$b->y_coordinate}}' type="text"></div>
 
                            <div class="form-group"><label class="control-label">Description</label>
                                <textarea class="form-control" required name="biz_description"> {{$b->description}}</textarea></div>
                            <div class="form-group"><label class="control-label">Phone </label><input
                                        class="form-control" required placeholder="08163222222,07011222222" name="phone" value='{{$b->phone}}'
                                        type="text"></div>


                            <div class="form-group"><label class="control-label">Twitter</label><input
                                        class="form-control" name="twitter" placeholder="" value='{{$b->twitter}}'
                                        type="text"></div>
                            <input   class="form-control hidden" name="listing_id"  value='{{$b->id}}'
                                        type="text"> 
                            <div class="form-group"><label class="control-label">Facebook</label><input
                                    class="form-control" name="facebook" placeholder="" value='{{$b->facebook}}'
                                        type="text"></div>
                            <div class="form-group"><label class="control-label">Instagram</label><input
                                    class="form-control" name="instagram" placeholder="" value='{{$b->instagram}}'
                                        type="text"></div>
                            <div class="form-group"><label class="control-label">Open Hours</label><input
                                        class="form-control" required name="hours" placeholder="8am - 5pm, Monday to Friday" value='{{$b->hours}}'
                                        type="text"></div>

                            <div class="form-group"><label class="control-label">Category</label>   </div>
                            <hr>
                            <div class="form-group">
                                {!! getCategoriesforBiz() !!}
                            </div>

                           
                            <div class="form-group" id="form-cat-group">

                            </div>

                            <div class="form-group col-md-12" style="padding:0px;"><label class="control-label  ">Photos</label>
                             <div class="alert alert-warning"> Images should not be above 500kb</div>
                                        </div>
                                <div class="row">


                        

                        <?php  
                        $i = 0;

                        if(count($images) > 0 ) :
                        foreach($images as $image) :
                            $allIMG = $images;
                            unset($allIMG[array_search("$image",$allIMG)] );
                            $allIMG = urlencode( json_encode(array_values($allIMG)) );
                            $allIMG = str_replace("%2F", "@@@@", $allIMG);
                            $link = url('admin/update_imgs/'.$b->id.'/'.$allIMG)
//                            $allIMG = json_encode(array_values($images));
                        ?>
                        <div class=" col-md-3">
                            <div class="thumbnail">
                                <button type="button" class="btn btn-danger" title="Delete" onclick="delImg('{!! $link !!}')">  <i class="fa  fa-trash-o"></i>
                                </button>
                                <img src="{{url('/').'/'. $image}}" class="img-responsive" alt="" /> 

                                
                            </div>
                        </div>
                        <?php
                        $i++;
                        endforeach;?>
                        <div class=" col-md-12">
                            <div class="caption">
                                <p>
                                    <label> Add more images</label>
                                    <input class="form-control" multiple="multiple" accept="image/*" name="biz_image[]" type="file">
                                    </p>
                             </div>
                        </div>
                        <?php

                            else:  ?>

                        <div class=" col-md-12">
                            <div class="caption">
                                <p>
                                    <label> Add new image</label>
                                    <input class="form-control" multiple="multiple" accept="image/*" name="biz_image[]" type="file">
                                    </p>
                            </div>
                        </div>

                        <?php
                        endif;
                        ?>

                    </div> 
                        <br />

 <div class="form-group"  >
<input type="submit" value="Submit" class=" pull-right btn btn-primary">
                            </div>
                        <br />
                        <br />
                        </form>
                            </div>
                        @endforeach

                    </div>
                @else
                    <h2>This Business Doesn't Exist</h2>
                @endif
            </div>
        </div>
    </div>

  
    </div>

@stop
@section('scripts')
    <script>
       var initial_usage_id = {{$initial_usage_id}};
            makeCategoryCall(initial_usage_id);
            console.log(initial_usage_id);
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
            function delImg(imag) {
            var confirmation =  confirm(" Really want to delete this Image? ");

            if(confirmation){
                 window.location = imag;
            }
        }
    </script>
@stop
