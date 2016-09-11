<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Business;
use App\Models\BussinessCategory;
use App\Models\Category;
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

    public function post_add_categories(Requests\createCategorRequest $request)
    {
//        dd($request);
        //save a new category
        $catObj = new BussinessCategory();
        $catObj->name = $request->name;
        $catObj->description = $request->description;
        $catObj->save();
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
//        dd($request->all());

        $name = $request->name;
        $email = $request->email;
        $address = $request->address;
        $website = $request->website;
        $biz_description = $request->biz_description;
        $biz_phone1 = $request->biz_phone1;
        $biz_phone2 = $request->biz_phone2;
        $biz_catID = $request->cat_id;
        if (count($biz_catID) < 1) {
            session()->flash('alert-danger', 'Business must belong to a category.  ');
            return redirect()->back();
        }
        // getting all of the images for the story
        $file = $request->file('biz_image');
        $theImages = [];
        if ($file != null) {
            // Making counting of uploaded images
            $file_count = count($file);
            // start count how many uploaded
            $uploadcount = 0;
//            dd($files);


            $rules = array('file' => 'required|mimes:png,gif,jpeg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = 'uploads/' . microtime(true);
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
        $bizObj = new Listing();
        $bizObj->name = $name;
        $bizObj->email = $email;
        $bizObj->address = $address;
        $bizObj->phone1 = $biz_phone1;
        $bizObj->phone2 = $biz_phone2;
        $bizObj->website = $website;
        $bizObj->image_url = json_encode($theImages);
        $bizObj->description = $biz_description;
        $bizObj->save();

        $bizCountObj = new HitCount();
        $bizCountObj->business_id = $bizObj->id;
        $bizCountObj->hits = 0;

        $bizCountObj->save();


        foreach ($biz_catID as $u_k) {
            $updateBizCatConstruct[] = array(
                'business_id' => $bizObj->id,
                'category_id' => $u_k,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );

        }
        DB::table('bussiness_categories')->insert($updateBizCatConstruct);

        session()->flash('alert-success', 'Business Created Successfully.  ');
        return redirect()->back();
    }

    public function update_biz(Request $request)
    {
//        dd($request->all());

        $name = $request->name;
        $email = $request->email;
        $address = $request->address;
        $website = $request->website;
        $biz_description = $request->biz_description;
        $biz_phone1 = $request->biz_phone1;
        $biz_phone2 = $request->biz_phone2;
        $id = $request->id;


        $bizObj = new Listing();
        $bizObj = $bizObj->where(['id' => $id])->update([
            'name' => $name,
            'email' => $email,
            'website' => $website,
            'address' => $address,
            'phone1' => $biz_phone1,
            'phone2' => $biz_phone2,
            'description' => $biz_description
        ]);


        session()->flash('alert-success', 'Business Update Was Successfully.  ');
        return redirect()->back();

    }

    public function delete_category($id = null)
    {
//        dd($request->all());
        if ($id == null) {
            return redirect()->to('/');
        }

        $bcatObj = new BussinessCategory();
        $catQ = $bcatObj->where(['business_id' => $id])->delete();

        //save a new category
        $catObj = new Category();
        $catQ = $catObj->where(['id' => $id])->delete();


        session()->flash('alert-success', 'Category Deleted.  ');
        return redirect()->back();
    }

    public function create_business()
    {
        $cat = BussinessCategory::get();
        $caCount = $cat->count();
        return view("admin.create_business")->with(compact("caCount"));
    }

    public function update_category(Request $request)
    {
        $biz_catID = $request->cat_id;
        if (count($biz_catID) < 1) {
            session()->flash('alert-danger', 'Business must belong to a category.  ');
            return redirect()->back();
        }
        BussinessCategory::where(['business_id' => $request->id])->delete();
        foreach ($biz_catID as $u_k) {
            $updateBizCatConstruct[] = array(
                'business_id' => $request->id,
                'category_id' => $u_k,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            );

        }
        DB::table('bussiness_categories')->insert($updateBizCatConstruct);

        session()->flash('alert-success', 'Business Created Successfully.  ');
        return redirect()->back();
    }

    public function all_businesses()
    {
        $biz = Listing::get();
        return view("admin.all_businesses")->with(compact('biz'));
    }

    public function delete_biz($id = null)
    {


        if ($id == null) {
            return redirect()->to('/');
        }


        //Delete
        $bizCat = new BussinessCategory();
        $bizCat->where(['business_id' => $id])->delete();

        $bizHits = new HitCount();
        $bizHits->where(['business_id' => $id])->delete();

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

    public function hits()
    {
        $hits = HitCount::get();
        return view("admin.hits")->with(compact("hits"));
    }

    public function biz_view($id = null)
    {
        if ($id == null) {
            return redirect()->to('/');
        }

        $catObj = new Listing();
        $biz = $catObj->where(['id' => $id])->get();

        //update HitCount
        $initHit = HitCount::where(['business_id' => $id])->first();
        HitCount::where(['business_id' => $id])->update(['hits' => $initHit->hits + 1]);

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

            $rules = array('file' => 'required|mimes:png,gif,jpeg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
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


}
