<?php

namespace App\Http\Controllers\UserManagement;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Action;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
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
        $menus = Menu::all();

        $data = [
            'menus' => $menus
        ];
        return view('contents.menu.index', $data);
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
            'name' => 'required'
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
            'parent_id' => $request->input('parent_id'),
            'name' => $name,
            'slug' => str_replace(' ', '-', strtolower($name)),
            'route' => $request->input('route'),
            'order_number' => $request->input('order_number'),
            'icon' => $request->input('icon')
        ];

        $save = Menu::create($params);
        if ($save) {
            return back()->with('success', 'Add menu data success');
        }

        return back()->with('error', 'Add menu data failed!');
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
            'name' => 'required'
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
        $menu = Menu::where('id', $id)->first();
        if (!$menu) {
            return back()->with('error', 'Menu data not found!');
        }

        $menu->parent_id = $request->input('parent_id');
        $menu->name = $name;
        $menu->slug = str_replace(' ', '-', strtolower($name));
        $menu->route = $request->input('route');
        $menu->order_number = $request->input('order_number');
        $menu->icon = $request->input('icon');

        if ($menu->save()) {
            return back()->with('success', 'Update menu data success');
        }

        return back()->with('error', 'Update menu data failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::where('id', $id)->first();

        if (!$menu){
            return back()->with('error', 'Menu data not found!');
        }

        if ($menu->delete()) {
            return back()->with('success', 'Delete menu data success');
        }

        return back()->with('error', 'Delete menu data failed!');
    }

    /**
     * Get Menu By Role
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRoleMenu($id)
    {
        $role = DB::table('roles')->where('id', $id)->first();

        if ($role->slug !== 'admin') {
            $menus = DB::table('role_menu')
                            ->leftJoin('menus', 'menus.id', '=', 'role_menu.menu_id')
                            ->where('role_id', $id)->get();

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
        } else {
            $menus = Menu::all();
        }

        $result = [
            'error' => false,
            'data' => $menus,
            'message' => 'Get role menu success'
        ];
        return response()->json($result);
    }
}
