<?php

namespace App\Http\Controllers\UserManagement;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Action;

class ActionController extends Controller
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
        $actions = Action::all();

        $data = [
            'actions' => $actions
        ];
        return view('contents.roles.actions', $data);
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
        ];

        $save = Action::create($params);

        if ($save) {
            return back()->with('success', 'Add new action success!');
        }

        return back()->withInput()->with('error', 'Add new action failed!');
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
        $action = Action::where('id', $id)->first();
        if(!$action) {
            return back()->with('error', 'Action data not found!');
        }

        $action->name = $name;
        $action->slug = str_replace(' ', '-', strtolower($name));

        if ($action->save()) {
            return back()->with('success', 'Update action data success');
        }

        return back()->with('error', 'Update action data failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $action = Action::where('id', $id)->first();

        if (!$action) {
            return back()->with('error', 'Action data not found!');
        }

        if ($action->delete()) {
            return back()->with('success', 'Delete action data success');
        }

        return back()->with('error', 'Delete action data failed!');
    }
}
