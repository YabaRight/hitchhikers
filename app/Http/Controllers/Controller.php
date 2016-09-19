<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getArea($latitude, $longitude)
    {
        $geolocation = $latitude . ',' . $longitude;
        $request = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $geolocation . '&sensor=false';
        $file_contents = file_get_contents($request);
        $json_decode = json_decode($file_contents);
        if (isset($json_decode->results[0])) {
            $response = array();
            foreach ($json_decode->results[0]->address_components as $addressComponet) {
                if (in_array('route', $addressComponet->types)) {
                    $response[] = $addressComponet->long_name;
                }
            }


            if (isset($response[0])) {
                $second = $response[0];
            } else {
                $second = 'null';
            }

            if ($second != 'null') {
                return $second;

            }
            return;


        }
    }
}
