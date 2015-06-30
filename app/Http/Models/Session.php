<?php

namespace App\Http\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    public $timestamps = false;
    
    protected $table = 'session';
    protected $fillable = [];

    public static function get($k, $default=null) {
        $session = Session::where("user_id", Auth::user()->id)
            ->where("key", $k)->first();
        return $session ? $session->value : $default;
    }

    public static function getInt($k){
        $v = Session::get($k);
        return $v ? intval($v) : 0 ;
    }

    public static function set($k, $v){
        $session = Session::where("user_id", Auth::user()->id)
            ->where("key", $k)->first();

        if ($session)
        {
            $session->value = $v;
            $session->save();
        }
        else
        {
            $session = new Session;
            $session->user_id = Auth::user()->id;
            $session->key = $k;
            $session->value = $v;
            $session->save();
        }
    }
}
