<?php

namespace App\Http\Controllers\UserManagement;

use Auth;
use Validator;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use jeremykenedy\LaravelRoles\Models\Role;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','role:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

        $data = [
            'users' => $users,
            'roles' => $roles
        ];
        return view('contents.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            $error_messages = $validator->errors()->toArray();
            $messages = [];
            foreach ($error_messages as $key => $val) {
                array_push($messages, $val);
            } 
            return back()->withInput()->with('errors', $messages);
        }

        $params = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ];

        $role_id = $request->input('role_id');
        $role = Role::where('id', $role_id)->first();
        $user = User::create($params);

        if (!$user) {
            return back()->withInput()->with('error', 'Create new user failed!');
        }

        $user->attachRole($role);

        return back()->with('success', 'Create new user success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            $error_messages = $validator->errors()->toArray();
            $messages = [];
            foreach ($error_messages as $key => $val) {
                array_push($messages, $val);
            } 
            return back()->withInput()->with('errors', $messages);
        }

        $user = User::where('id', $id)->first();
        if (!$user) {
            return back()->with('error', 'User data not found!');
        }

        $role_id = $request->input('role_id');
        $role = Role::where('id', $role_id)->first();
        $user->detachAllRoles();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($user->save()) {
            $user->attachRole($role);

            return back()->with('success', 'Update user success');
        }

        return back()->with('error', 'Update user failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            return back()->with('error', 'User data not found!');
        }

        if ($user->detachAllRoles() && $user->delete()) {
            return back()->with('success', 'Delete user data success');
        }

        return back()->with('error', 'Delete user data failed!');
    }
}
