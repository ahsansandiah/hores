<?php

namespace App\Http\Controllers\UserManagement;

use Auth;
use Validator;
use App\Menu;
use App\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','role:admin'], ['except' => ['setRoleMenu']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $menus = Menu::with('children')->whereNull('parent_id')->get();
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
        $user = Auth::user();
        if (!$user) {
            $result = [
                'error' => true,
                'data' => null,
                'message' => 'Unauthenticated'
            ];
            return response()->json($result, 403);
        }

        if (!$user->hasRole(['admin'])) {
            $result = [
                'error' => true,
                'data' => null,
                'message' => 'Unauthenticated'
            ];
            return response()->json($result, 403);
        }

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

    /**
     * Set user role menu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setRoleMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'menu_id' => 'required'
        ]);

        if ($validator->fails()) {
            $error_messages = $validator->errors()->toArray();
            $messages = [];
            foreach ($error_messages as $key => $val) {
                array_push($messages, $val);
            } 
            $result = [
                'error' => true,
                'data' => $messages,
                'message' => 'Validation error'
            ];
            return response()->json($result);
        }

        $action_ids = $request->input('actions');
        $role_id = $request->input('role_id');
        $menu_id = $request->input('menu_id');

        $check_menu = DB::table('role_menu')->where(['role_id' => $role_id, 'menu_id' => $menu_id])->first();

        $save = false;
        if ($check_menu) {
            $check_menu->action_ids = json_encode($action_ids);
            $update = DB::table('role_menu')->where('role_id', $role_id)->where('menu_id', $menu_id)->update(['action_ids' => json_encode($action_ids)]);
            if ($update) {
                $save = true;
            }
        } else {
            $params = [
                'role_id' => $request->input('role_id'),
                'menu_id' => $request->input('menu_id'),
                'action_ids' => json_encode($action_ids)
            ];
            $role_menu_id = DB::table('role_menu')->insertGetId($params);

            if ($role_menu_id) {
                $save = true;
            }
        }
        
        if ($save) {
            $menus = DB::table('role_menu')
                            ->leftJoin('menus', 'menus.id', '=', 'role_menu.menu_id')
                            ->where('role_id', $role_id)->get();

            foreach ($menus as &$menu) {
                $action_ids = json_decode($menu->action_ids);
                $get_actions = DB::table('actions')->select('name')->whereIn('id', $action_ids)->get();
                $actions = [];
                if ($get_actions) {
                    foreach ($get_actions as $act) {
                        array_push($actions, $act->name);
                    }
                }
                
                $menu->actions = $actions;
            }

            $result = [
                'error' => false,
                'data' => $menus,
                'message' => 'Set role menu access success'
            ];
        } else {
            $result = [
                'error' => true,
                'data' => null,
                'message' => 'Set role menu failed'
            ];
        }

        return response()->json($result);
    }
}
