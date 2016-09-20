<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Listing;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view("pages.home");
    }

    public function search(Request $request)
    {
        $searcher = $request->search_token;

        $searchToken = $searcher;
        $constraint = $searchToken . "";
        $constraint = explode(" ", trim($constraint));
        $constructor_ = " ";

        foreach ($constraint as $con_value) {
            $constructor_ .= "name LIKE  '%$con_value%' OR ";

            $last_val = $con_value;
        }
        $constructor_ .= " name LIKE '%$last_val%'";

        $biz = Listing::whereRaw("(" . $constructor_ . " ) ")->where("verified", "true")
            ->get();
        return view("pages.search")->with(compact('biz'))->with(compact('searcher'));

    }

    public function near_me(Request $request, $distance = 3)
    {
        // $distance is in kilometers.

        $searcher = " Near me ";
        if ($request->session()->has('lat')) {
            //
            $getLat = $request->session()->get('lat');
        } else {
            $getLat = 0;
        }

        if ($request->session()->has('lng')) {
            //
            $getLng = $request->session()->get('lng');
        } else {
            $getLng = 0;
        }

        if (($getLat == 0) || ($getLng == 0)) {
            $biz = Listing::where("id", "<", 0)
                ->get();
            return view("pages.near_me")->with(compact('biz'))->with(compact('searcher'));
        }

// radius of earth; @note: the earth is not perfectly spherical, but this is considered the 'mean radius'
        $unit = 'km';
        if ($unit == 'km') {
            $radius = 6371.009;
        } elseif ($unit == 'mi') {
            $radius = 3958.761;
        }

        // latitude boundaries
        $maxLat = ( float )$getLat + rad2deg($distance / $radius);
        $minLat = ( float )$getLat - rad2deg($distance / $radius);

        // longitude boundaries (longitude gets smaller when latitude increases)
        $maxLng = ( float )$getLng + rad2deg($distance / $radius) / cos(deg2rad(( float )$getLat));
        $minLng = ( float )$getLng - rad2deg($distance / $radius) / cos(deg2rad(( float )$getLat));

        $max_min_values = array(
            'max_latitude' => $maxLat,
            'min_latitude' => $minLat,
            'max_longitude' => $maxLng,
            'min_longitude' => $minLng
        );
//        dd($max_min_values);
        $area = $this->getArea($getLat, $getLng);

        $biz = Listing::whereBetween('x_coordinate', [$minLat, $maxLat])->whereBetween('y_coordinate', [$minLng, $maxLng])->get();
        return view("pages.near_me")->with(compact('biz'))->with(compact('searcher', "area"));

    }

    public function login()
    {
        return view("pages.login");
    }

    public function register()
    {
        return view("pages.register");
    }

    public function get_map_direction($x = null, $y = null)
    {
        if(($x == null ) || ($y == null)){
            session()->flash('alert-danger', ' Destination is not valid ');
            return redirect()->back();
         }
        $address = $this->getAddress($x,$y);
        return view("pages.view_direction")->with(compact('x', "y",'address'));
        
    }
}
