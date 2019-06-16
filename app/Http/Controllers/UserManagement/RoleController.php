<?php

namespace App\Http\Controllers\UserManagement;

use Validator;
use App\Menu;
use App\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use jeremykenedy\LaravelRoles\Models\Role;

class RoleController extends Controller
{
    
    public function __construct() {
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }

        if (!$user->hasRole(['admin'])) {
            return back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $menus = Menu::all();
        $actions = Action::all();

        $data = [
            'roles' => $roles,
            'menus' => $menus,
            'actions' => $actions
        ];
        return view('contents.roles.index', $data);
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
        ]);

        if ($validator->fails()) {
            $error_messages = $validator->errors()->toArray();
            $messages = [];
            foreach ($error_messages as $key => $val) {
                array_push($messages, $val);
            } 
            return back()->withInput()->with('errors', $messages);
        }

        $name = $request->input('name');
        $params = [
            'name' => $name,
            'slug' => str_replace(' ', '-', strtolower($name)),
            'description' => $request->input('description')
        ];

        $save = Role::create($params);

        if ($save) {
            return back()->with('success', 'Add new role success!');
        }

        return back()->withInput()->with('error', 'Add new role failed!');
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
        ]);

        if ($validator->fails()) {
            $error_messages = $validator->errors()->toArray();
            $messages = [];
            foreach ($error_messages as $key => $val) {
                array_push($messages, $val);
            } 
            return back()->withInput()->with('errors', $messages);
        }

        $name = $request->input('name');
        $role = Role::where('id', $id)->first();
        if (!$role) {
            return back()->withInput()->with('error', 'Role data not found!');
        }

        $role->name = $name;
        $role->slug = str_replace(' ', '-', strtolower($name));
        $role->description = $request->input('description');

        if ($role->save()) {
            return back()->with('success', 'Update role data success');
        }

        return back()->withInput()->with('error', 'Update role data failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::where('id', $id)->first();

        if (!$role) {
            return back()->with('error', 'Role data not found!');
        }

        if ($role->delete()) {
            return back()->with('success', 'Delete role data success');
        }

        return back()->with('error', 'Delete role data failed!');
    }
}
