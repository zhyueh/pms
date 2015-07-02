<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Http\Models\Setting\Menu;
use Route;
use Mail;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        if (Auth::check()){
            view()->share("login_user", Auth::user());
        }

        $nav_menu = Menu::ofParent(0)->orderBy('display_order')->get();
        view()->share("nav_menu", $nav_menu);

        $nav_menu_dict = [];
        foreach($nav_menu as $menu)
        {
            $nav_menu_dict[explode('\\', $menu->action)[0]] = [
                'id' => $menu->id,
                'name'=>$menu->name,
                ];
        }

        $route = Route::currentRouteAction();
        if (!isset($this->controller)){
            list($this->controller, $action) = explode('@', $route);
            $this->controller = ltrim($this->controller, 'App\\Http\\Controllers\\');
        }

        $nav_name = explode('\\', $this->controller)[0];
        $sub_menu = [];
        if (array_key_exists($nav_name, $nav_menu_dict))
        {
            $sub_menu = Menu::ofParent($nav_menu_dict[$nav_name]["id"])->orderBy('display_order')->get();
            view()->share('nav_active_menu', $nav_menu_dict[$nav_name]["name"]);
        }
        else
        {
            view()->share('nav_active_menu', '');
        }
        view()->share('nav_sub_menu', $sub_menu);
        view()->share('privileges',[]);

    }
}
