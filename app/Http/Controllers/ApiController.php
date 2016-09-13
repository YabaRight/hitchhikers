<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{
    public function search($token)
    {
        $searcher = $token;
        $searchReturn = [];
        $searchToken = str_replace(" ", "%", trim($searcher));
        $biz = Business::where('name', 'LIKE', '%' . $searchToken . '%')
            ->orWhere('description', 'LIKE', '%' . $searchToken . '%') ->get();
        foreach ($biz as $b){
            $construcCat = [];
            $bizCat = $b->bussinessCategories;
            foreach ($bizCat as $bc) {
                $construcCat[] =   $bc->category->name  ;
            }
            $searchReturn[] =[
                'name' => $b->name,
                'address' => $b->address,
                'website' => $b->website,
                'image' => json_decode($b->image_url),
                'phone1' => $b->phone1,
                'phone2' => $b->phone2,
                'categories' => $construcCat,
            ];
        }

        return json_encode($searchReturn);
    }
    public function postsearch(Request $request)
    {
        $searcher = $request->search;
        $searchReturn = [];
        $searchToken = str_replace(" ", "%", trim($searcher));
        $biz = Business::where('name', 'LIKE', '%' . $searchToken . '%')
            ->orWhere('description', 'LIKE', '%' . $searchToken . '%') ->get();
        foreach ($biz as $b){
            $construcCat = [];
            $bizCat = $b->bussinessCategories;
            foreach ($bizCat as $bc) {
                $construcCat[] =   $bc->category->name  ;
            }
            $searchReturn[] =[
                'name' => $b->name,
                'address' => $b->address,
                'website' => $b->website,
                'image' => json_decode($b->image_url),
                'phone1' => $b->phone1,
                'phone2' => $b->phone2,
                'categories' => $construcCat,
            ];
        }

        return json_encode($searchReturn);
    }
}
