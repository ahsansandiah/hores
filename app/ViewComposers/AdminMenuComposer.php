<?php

namespace App\Http\ViewComposers;

use Auth;
use App\Menu;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class AdminMenuComposer
{
    public function compose(View $view)
    {
    	$menus = [];
    	$user = Auth::user();
    	if ($user) {
    		if ($user->hasRole(['admin'])) {
    			$menus = Menu::with('children')->whereNull('parent_id')->orderBy('order_number', 'asc')->get();
    		} else {
    			$role_id = $user->getRoles()[0]->id;
    			$role_menu = DB::table('role_menu')->where('role_id', $role_id)->get();
    			if ($role_menu) {
    				$menu_ids = [];
	    			foreach ($role_menu as $rm) {
	    				array_push($menu_ids, $rm->menu_id);
	    			}
	    			$menus = Menu::with('children')->whereNull('parent_id')->whereIn('id', $menu_ids)->orderBy('order_number', 'asc')->get();
    			}
    		}
    	}

    	$data = [
    		'menu_sidebar' => $menus
    	];
        $view->with($data);
    }
      
}