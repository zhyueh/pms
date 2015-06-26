<?php

namespace App\Http\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    
    protected $table = 'route';
    protected $fillable = ['route', 'route_name'];

    public static function addRoute($route)
    {
        if(! Route::where('route', $route)->first())
        {
            $tmp = new Route;
            $tmp->route = $route;
            $tmp->route_name = $route;
            $tmp->save();
        }
    }
}
