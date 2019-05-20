<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entities\Service;

class ServiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Services = Service::paginate(20);

        return view('contents.service.index', compact('Services'));
    }
    public function store(Request $request)
    {
        $Services = Service::find($request->$id);
        $Services->category = $request->category;
        $services->name = $request->name;
        $Services->stock = $request->stock;
        $Services->price = $request->price;
        $Services->save();

        return view('service');
    }
}