<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Attribute;
use App\Models\Business;
use App\Models\BussinessCategory;
use App\Models\Category;
use App\Models\ListingCategory;
use App\Models\ListingAttribute;
use App\Models\HitCount;
use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use Validator;

class AdminController extends Controller
{
    public function home()
    {
        return view("admin.home");
    }

    public function all_categories()
    {
        return view("admin.all_categories");
    }

    public function all_categories_property()
    {
        return view("admin.all_categories_property");
    }

    public function post_add_categories(Requests\createCategorRequest $request)
    {
//        dd($request);
        // save a new category
        $catObj = new BussinessCategory();
        $catObj->name = $request->name;
        $catObj->description = $request->description;
        $catObj->save();
        return redirect()->back();
    }

    public function report(){
        return view("admin.report");
    }

    public function post_add_property(Requests\createPropertyRequest $request)
    {
//        dd($request->all());
        //save a new category
        $catObj = new Attribute();
        $catObj->name = trim($request->name);
        $catObj->description = trim($request->description);
        $catObj->bussiness_category_id = trim($request->id);
        $catObj->save();
        session()->flash('alert-success', 'Property Created Successfully.  ');
        return redirect()->back();
    }

   
    public function post_edit_category(Request $request)
    {
//        dd($request->all());
        //save a new category
        $catObj = new Category();
        $catQ = $catObj->where(['id' => $request->id])->update([
            'name' => $request->cat_name
        ]);

        session()->flash('alert-success', 'Category Updated.  ');
        return redirect()->back();
    }

    public function post_create_business(Requests\createBizRequest $request)
    {
        // dd( $request->all());
        // save the request thingy as an array
        $request_as_array = $request->all();

        // get all the keys sent
        $all_keys = array_keys($request->all());

        // for reasons unknown, the biz_image key refuses to be subtracted with array_diff
        // so i'm removing it manually. Sadly. PS: bcos it contains an image object, laravel seems to always have
        // it as the last element in the array.
        unset($all_keys[count($all_keys) - 1]);

        // required array keys
        $all_required_default_keys = [
            "_token",
            "name",
            "email",
            "website",
            "address",
            "x_cords",
            "y_cords",
            "biz_description",
            "phone",
            "twitter",
            "facebook",
            "instagram",
            "hours",
            "cat_id",
        ];

        // get difference
        // this difference are the names of the form elements that are appended due to a business category
        $key_diff = array_diff(array_values($all_keys), array_values($all_required_default_keys));
        $key_diff = array_values($key_diff);

        // get category ID
        $biz_catID = $request->cat_id;

        // the values of $key_diff are a concatenation of the property name and the '@@' and the id of the property
        // Next: I'll get all the unique ID's of the properties of the chosen category from the $key_diff

        $all_the_properties = [];
        $the_property = [];
        foreach ($key_diff as $value) {
            # code...
            $index_value_array = explode("@@", $value);
            $the_property['id'] = $index_value_array[1];

            // Next: get the value passed from the form with respect to $value as name of the array index
            $the_property['data'] = $request_as_array[$value];

            $all_the_properties[] = $the_property;
        }


        //-- submitted data structure
        // "name" => "Jasi" -
        //  "email" => "ndu4george14@gmail.com" -
        //  "website" => "http://www.html.com" -
        //  "address" => "32 Ade Street, Yaba Lagos." -
        //  "x_cords" => "29293933.222222"
        //  "y_cords" => "664655.233333"
        //  "biz_description" => "Some sample description" -
        //  "phone" => "08322334499,07844636644" -
        //  "twitter" => "twitter.com/Yaba" -
        //  "facebook" => "fb.com/Yaba" -
        //  "instagram" => "instagram.com/Yaba" -
        //  "hours" => "7am - 4pm, Monday to Sunday" -
        //  "cat_id" => "on"
        //  "Delivery2r@@1" => "yes"
        //  "Suppeee@@2" => "no"
        //  "biz_image" => UploadedFile {#250 ▶}

        $name = $request->name;
        $email = $request->email;
        $address = $request->address;
        $x_cords = $request->x_cords;
        $y_cords = $request->y_cords;
        $website = $request->website;
        $biz_description = $request->biz_description;
        $phone = $request->phone;
        $twitter = $request->twitter;
        $facebook = $request->facebook;
        $instagram = $request->instagram;
        $hours = $request->hours;
        $biz_catID = $request->cat_id;

        // cancel transaction if the biz category is not available
        if ($biz_catID < 1) {
            session()->flash('alert-danger', 'Business must belong to a category.  ');
            return redirect()->back();
        }


        // getting all of the images for the story
        $files = $request->file('biz_image');
        $theImages = [];
// dd($files)
        foreach ($files as $file) {
            // dd($file->getClientSize());
            if ($file != null) {
                if (($file->getClientSize() > 512000) || ($file->getClientSize() == 0)) {

                    session()->flash('alert-danger', ' An Image size has exceeded 500kb');
                    return redirect()->back();
                }
                // Making counting of uploaded images
                // $file_count = count($file);
                // start count how many uploaded
                $uploadcount = 0;
//            dd($files);

                $rules = array('file' => 'required|mimes:png,gif,jpeg,JPG,PNG,JPEG'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                $validator = Validator::make(array('file' => $file), $rules);
                if ($validator->passes()) {
                    $destinationPath = 'uploads/' . $biz_catID . '/' . microtime(true);
                    $filename = $file->getClientOriginalName();
                    $theImages[] = $destinationPath . '/' . $filename;
                    $upload_success = $file->move($destinationPath, $filename);
                    $uploadcount++;


                } else {
                    {
                        session()->flash('alert-danger', 'Image is not valid');
                        return redirect()->back();
                    }
                }


            }
        }
        // dd($theImages);
        $bizObj = new Listing();


        $biz_catID = $request->cat_id;


        $bizObj->name = $name;
        $bizObj->email = $email;
        $bizObj->address = $address;
        $bizObj->phone = $phone;
        $bizObj->x_coordinate = $x_cords;
        $bizObj->y_coordinate = $y_cords;
        $bizObj->url = $website;
        $bizObj->twitter = $twitter;
        $bizObj->facebook = $facebook;
        $bizObj->instagram = $instagram;
        $bizObj->has_attributes = $has_attributes = (count($all_the_properties) > 0) ? 'true' : "false";;
        $bizObj->hours = $hours;
        $bizObj->image = json_encode($theImages);
        $bizObj->description = $biz_description;
        $bizObj->save();

        // Next: construct the array to use in inserting the data into the db
        $queryInsertProData = [];
        foreach ($all_the_properties as $the_prop) {
            # code...
            $queryInsertProData[] = array(
                'listing_id' => $bizObj->id,
                'attribute_id' => $the_prop['id'],
                'category_id' => $biz_catID,
                'value' => $the_prop['data'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );

        }
        // dd($queryInsertProData);

        $bizCountObj = new HitCount();
        $bizCountObj->listing_id = $bizObj->id;
        $bizCountObj->hits = 0;

        $bizCountObj->save();


        $bizCountObj = new ListingCategory();
        $bizCountObj->listing_id = $bizObj->id;
        $bizCountObj->category_id = $biz_catID;

        $bizCountObj->save();

        if ($has_attributes == "true") {
            DB::table('listing_attributes')->insert($queryInsertProData);

        }

        session()->flash('alert-success', 'Business Created Successfully.  ');
        return redirect()->back();
    }



    public function update_property(Request $request)
    {
//        dd($request->all());
        if ((trim($request->id) == null) || ($request->id <= 0)) {
            return null;

        }
        $name = $request->name;
        $description = $request->description;

        $id = $request->id;


        $bizObj = new Attribute();
        $bizObj = $bizObj->where(['id' => $id])->update([
            'name' => $name,
            'description' => $description
        ]);


        session()->flash('alert-success', 'Property Update Was Successfully.  ');
        return redirect()->back();

    }

    public function delete_category($id = null)
    {
        // dd($id);
        if ($id == null) {
            return redirect()->to('/');
        }


        $bcatObj = new ListingAttribute();
        $catQ = $bcatObj->where(['category_id' => $id])->delete();

        $bcatObj = new ListingCategory();
        $catQ = $bcatObj->where(['category_id' => $id])->delete();


        $catObj = new Attribute();
        $catQ = $catObj->where(['bussiness_category_id' => $id])->delete();


        $catObj = new BussinessCategory();
        $catQ = $catObj->where(['id' => $id])->delete();


        session()->flash('alert-success', 'Category Deleted.  ');
        return redirect()->back();
    }

    public function delete_property($id = null)
    {
        // dd($id);
        if ($id == null) {
            return redirect()->to('/');
        }


        $bcatObj = new ListingAttribute();
        $catQ = $bcatObj->where(['attribute_id' => $id])->delete();


        $catObj = new Attribute();
        $catQ = $catObj->where(['id' => $id])->delete();


        session()->flash('alert-success', 'Property Deleted.  ');
        return redirect()->back();
    }


    public function modify_category_property($id = null)
    {
        if ($id == null) {
            return redirect()->to('/');
        }

        //get category name from id
        $catName = getCategoryNamefromID($id);

        return view("admin.modify_category_property")->with(compact("catName", "id"));
    }

    public function external_create_business()
    {
        $cCat = $cat = BussinessCategory::get();
        $caCount = $cat->count();

        $initial_usage_id = 0;
        foreach ($cCat as $i => $cb) {
            $initial_usage_id = $cb->id;
        }
//
        return view("admin.external_create_business")->with(compact("caCount", "initial_usage_id"));
    }

    public function create_business()
    {
        $cCat = $cat = BussinessCategory::get();
        $caCount = $cat->count();

        $initial_usage_id = 0;
        foreach ($cCat as $i => $cb) {
            $initial_usage_id = $cb->id;
        }
//
        return view("admin.create_business")->with(compact("caCount", "initial_usage_id"));
    }

    public function get_cat_property($id = null)
    {
        return getFormInputsForCategory($id);
//        return ($id);
    }

     public function get_cat_property_edit($id = null,$listing_id=null)
    {
        return getFormInputsEditsForCategory($listing_id,$id);
//        return ($id);
    }

    public function get_biz_property($id = null)
    {
        return getDisplayPropertiesForListing($id);
//        return ($id);
    }

    public function update_category(Request $request)
    {
//        dd($request->all());
        $biz_catID = $request->id;
        if ($biz_catID < 1) {
            session()->flash('alert-danger', 'Business must belong to a category.  ');
            return redirect()->back();
        }


        $bizObj = new BussinessCategory();
        $bizObj = $bizObj->where(['id' => $biz_catID])->update([
            'name' => $request->name,
            'description' => $request->description
        ]);


        session()->flash('alert-success', 'Business Category Updated Successfully.  ');
        return redirect()->back();
    }

    public function all_businesses()
    {
        $biz = Listing::paginate(10);
        // dd($biz);
        return view("admin.all_businesses")->with(compact('biz'));
    }

    public function delete_biz($id = null)
    {

        if ($id == null) {
            return redirect()->to('/');
        }

        //Delete
        $bizCat = new ListingAttribute();
        $bizCat->where(['listing_id' => $id])->delete();

        $bizCat = new ListingCategory();
        $bizCat->where(['listing_id' => $id])->delete();

        $bizHits = new HitCount();
        $bizHits->where(['listing_id' => $id])->delete();

        $biz = new Listing();
        $biz->where(['id' => $id])->delete();

        session()->flash('alert-success', 'Business Deleted.  ');
        return redirect()->back();
    }

    public function view_biz($id = null)
    {
        if ($id == null) {
            return redirect()->to('/');
        }


        $catObj = new Listing();
        $biz = $catObj->where(['id' => $id])->get();

        return view("admin.view_business")->with(compact('biz'));
    }

    public function update_imgs($listing_id, $img)
    {

        $img = str_replace("@@@@", "/", $img);
        // dd($img);
        $img = urldecode($img);
        Listing::where(['id' => $listing_id])->update([
            'image' => $img
        ]);

        session()->flash('alert-success', 'Image File Deleted Successfully.');
        return redirect()->back();
    }

    public function update_business(Request $request)
    {
         // save the request thingy as an array
        $request_as_array = $request->all();
        // get all the keys sent
        $all_keys = array_keys($request->all());

        // for reasons unknown, the biz_image key refuses to be subtracted with array_diff
        // so i'm removing it manually. Sadly. PS: bcos it contains an image object, laravel seems to always have
        // it as the last element in the array.
        unset($all_keys[count($all_keys) - 1]);

        // required array keys
        $all_required_default_keys = [
            "_token",
            "name",
            "email",
            "website",
            "address",
            "x_cords",
            "y_cords",
            "biz_description",
            "phone",
            "twitter",
            "facebook",
            "instagram",
            "hours",
            "cat_id",
            "listing_id"
        ];

        // get difference
        // this difference are the names of the form elements that are appended due to a business category
        $key_diff = array_diff(array_values($all_keys), array_values($all_required_default_keys));
        $key_diff = array_values($key_diff);

        // get category ID
        $biz_catID = $request->cat_id;

        // the values of $key_diff are a concatenation of the property name and the '@@' and the id of the property
        // Next: I'll get all the unique ID's of the properties of the chosen category from the $key_diff

        $all_the_properties = [];
        $the_property = [];
        // dd($key_diff);
        foreach ($key_diff as $value) {
            # code...
            $index_value_array = explode("@@", $value);
            $the_property['id'] = $index_value_array[1];

            // Next: get the value passed from the form with respect to $value as name of the array index
            $the_property['data'] = $request_as_array[$value];

            $all_the_properties[] = $the_property;
        }
// dd($all_the_properties);
        $requestData = $request->all();
        unset($requestData['_token']);
        $name = $request->name;
        $email = $request->email;
        $address = $request->address;
        $x_cords = $request->x_cords;
        $y_cords = $request->y_cords;
        $website = $request->website;
        $biz_description = $request->biz_description;
        $phone = $request->phone;
        $twitter = $request->twitter;
        $facebook = $request->facebook;
        $instagram = $request->instagram;
        $hours = $request->hours;
        $has_attributes = "true";
        $biz_catID = $request->cat_id;
        $listing_id = $request->listing_id;
        // cancel transaction if the biz category is not available
        if ($biz_catID < 1) {
            session()->flash('alert-danger', 'Business must belong to a category.  ');
            return redirect()->back();
        }

        // cancel transaction if the biz is not available
        if ($listing_id < 1) {
            session()->flash('alert-danger', 'Business Not Available.  ');
            return redirect()->back();
        }
        // getting all of the images for the story
        $files = $request->file('biz_image');
        $theImages = [];
// dd($files);
        foreach ($files as $file) {
            if ($file != null) {
                 if (($file->getClientSize() > 512000) || ($file->getClientSize() == 0)) {

                    session()->flash('alert-danger', ' An Image size is too large. Max of 500kb required.');
                    return redirect()->back();
                }
                // Making counting of uploaded images
                // $file_count = count($file);
                // start count how many uploaded
                $uploadcount = 0;
//            dd($files);


                $rules = array('file' => 'required|mimes:png,gif,jpeg,JPG,PNG,JPEG'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                $validator = Validator::make(array('file' => $file), $rules);
                if ($validator->passes()) {
                    $destinationPath = 'uploads/' . $biz_catID . '/' . microtime(true);
                    $filename = $file->getClientOriginalName();
                    $theImages[] = $destinationPath . '/' . $filename;
                    $upload_success = $file->move($destinationPath, $filename);
                    $uploadcount++;


                } else {
                    {
                        session()->flash('alert-danger', 'Image is not valid');
                        return redirect()->back();
                    }
                }


            }
        }

        $initialImgs = array();
        $data = Listing::where(['id' => $listing_id])->first();
        $initialImgs = json_decode($data->image);
        if (count($initialImgs) <= 0) {
            $initialImgs = array();
        }
//        dd(count($initialImgs));
        $image = json_encode(array_values(array_merge($theImages, $initialImgs)));
//        dd($requestData);
//update the listing
        Listing::where(['id' => $listing_id])->update([
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'x_coordinate' => $x_cords,
            'y_coordinate' => $y_cords,
            'url' => $website,
            'description' => $biz_description,
            'phone' => $phone,
            'twitter' => $twitter,
            'facebook' => $facebook,
            'instagram' => $instagram,
            'hours' => $hours,
            'image' => $image,

        ]);

        // delete old listing attribute that belong to this biz
        ListingAttribute::where('listing_id', $listing_id)->delete();

        // delete old listing category that belong to this biz
        ListingCategory::where('listing_id', $listing_id)->delete();

// Next: construct the array to use in inserting the data into the db
        $queryInsertProData = [];
        foreach ($all_the_properties as $the_prop) {
            # code...
            $queryInsertProData[] = array(
                'listing_id' => $listing_id,
                'attribute_id' => $the_prop['id'],
                'category_id' => $biz_catID,
                'value' => $the_prop['data'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );

        }
        if ($has_attributes == "true") {
             $queryInsertCatInfo = [];
            # code...
            $queryInsertCatInfo[] = array(
                'listing_id' => $listing_id,
                 'category_id' => $biz_catID,
                 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );

             DB::table('listing_attributes')->insert($queryInsertProData);
             DB::table('listing_categories')->insert($queryInsertCatInfo);

        }

        session()->flash('alert-success', 'Business Listing Updated Successfully.  ');
        return redirect()->to(url('admin/biz/') . '/' . $listing_id);

    }

    public function edit_biz($id = null)
    {
        if ($id == null) {
            return redirect()->to('/');
        }
        $cCat = BussinessCategory::get();
        $initial_usage_id = $id;
        foreach ($cCat as $i => $cb) {
            $initial_usage_id = $cb->id;
        }
        $catObj = new Listing();
        $biz = $catObj->where(['id' => $id])->get();

        return view("admin.edit_business")->with(compact('biz', 'initial_usage_id'));
    }

    public function hits()
    {
        $hits = HitCount::paginate(20);
        return view("admin.hits")->with(compact("hits"));
    }

     public function view_category_details($id = null){
        if ( ($id == null)||($id < 1) ) {
            # code...
            session()->flash('alert-info', 'Category Error.  ');
            return redirect()->back();
        }

        $getListingIdsForCategory =  ListingCategory::where('category_id',$id)->pluck('listing_id')->toArray();
        $getCatObj = BussinessCategory::where('id',$id)->first();
        if (count($getCatObj) > 0 ) {
            # code...
            $catName = $getCatObj->name;
        }else{
            $catName = "Invalid Category";
        }
        
        $biz = Listing::whereIn('id', $getListingIdsForCategory)->paginate(10);
        $biz_count = Listing::whereIn('id', $getListingIdsForCategory)->count();
        return view("admin.view_category_listing")->with(compact('catName','biz','biz_count'));
    }


    public function biz_view($id = null)
    {
        if ($id == null) {
            return redirect()->to('/');
        }

        $catObj = new Listing();
        $biz = $catObj->where(['id' => $id])->get();

        //update HitCount
        $initHit = HitCount::where(['listing_id' => $id])->first();
        HitCount::where(['listing_id' => $id])->update(['hits' => $initHit->hits + 1]);

        return view("pages.view_business")->with(compact('biz'));
    }

    public function update_image(Request $request)
    {
        $file = $request->file('image_url');
        $theImages = [];
        if ($file != null) {
            // Making counting of uploaded images
            $file_count = count($file);
            // start   uploaded
        if (($file->getClientSize() > 512000) || ($file->getClientSize() == 0)) {

                    session()->flash('alert-danger', ' An Image size has exceeded 500kb');
                    return redirect()->back();
                }
            $rules = array('file' => 'required|mimes:png,gif,jpeg,JPG,PNG,JPEG'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = 'uploads/' . microtime(true);
                $filename = $file->getClientOriginalName();
                $theImages[] = $destinationPath . '/' . $filename;
                $upload_success = $file->move($destinationPath, $filename);
                Business::where(['id' => $request->id])->update(['image_url' => json_encode($theImages)]);
                session()->flash('alert-success', 'Image edit was successful');
                return redirect()->back();

            } else {
                {
                    session()->flash('alert-danger', 'Image is not valid');
                    return redirect()->back();
                }
            }


        }
        session()->flash('alert-danger', 'Image is not valid');
        return redirect()->back();

    }
    public function saveLocationToSession(Request $request)
    {
        // Specifying a default value...
        $lt = session('lat', '0');
        $lng = session('lng', '0');

        // Store a piece of data in the session...
        session(['lat' => $request->gps_lat]);
        session(['lng' => $request->gps_lng]);

        return "$request->gps_lat , $request->gps_lng";
    }


}
