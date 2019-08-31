<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Carbon\Carbon;
use Validator;
use App\User;
use App\Entities\Tenant;

class TenantController extends Controller
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
        $tenants = Tenant::paginate(20);

        return view('contents.tenant.index', compact('tenants'));
    }

    public function getById($id)
    {
        $tenant = Tenant::find($id);

        return view('contents.tenant.index', compact('tenant'));
    }

    public function getByName($name)
    {
        $tenant = Tenant::where('name', 'like', '%'.$name.'%')->first();

        return response()->json($tenant);
    }

    public function getByIdentityCardNumber($identityCardNumber)
    {
        $tenant = Tenant::where('identity_card_number', 'like', '%'.$identityCardNumber.'%')->first();

        return response()->json($tenant);
    }
}