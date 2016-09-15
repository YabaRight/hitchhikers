<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
    return view("pages.home");
    }

    public function search(Request $request)
    {
        
        return "coming soon";//view("pages.search");
    }

    public function login()
    {
        return view("pages.login");
    }

    public function register()
    {
        return view("pages.register");
    }
}
