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
        $services = Service::paginate(20);

        return view('contents.service.index', compact('services'));
    }

    public function store(Request $request)
    {
        $credentials = [
            'name' => $request->name,
            'category' => $request->category,
            'stock' => $request->stock,
            'price' => $request->price
        ];
                
        $service = Service::create($request->all());

        if (!$service) {
            return Redirect::back()->with('error_message', 'Tambah service gagal');
        }

        return redirect('service')->with('message', 'Tambah service berhasil');
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->code = $request->code;
        $service->category = $request->category;
        $service->name = $request->name;
        $service->stock = $request->stock;
        $service->price = $request->price;
        $service->update();

        $service = Service::create($request->all());

        if (!$service) {
            return Redirect::back()->with('error_message', 'Ubah service gagal');
        }

        return redirect('service')->with('message', 'Ubah service berhasil');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        $service = Service::create($request->all());

        if (!$service) {
            return Redirect::back()->with('error_message', 'Hapus service gagal');
        }

        return redirect('service')->with('message', 'Hapus service berhasil');
    }
}