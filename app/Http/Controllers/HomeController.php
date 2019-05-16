<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    
    public function index()
    {
        return view('contents.home.index');
    }
}
