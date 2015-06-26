<?php

namespace App\Http\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Enum extends Model
{
    protected $table = 'enum';
    protected $fillable = ['type', 'value', 'name', 'order'];

    public $timestamps = false;

    public static function dict($type)
    {
        $objs = Enum::where('type', $type)->get();
        $obj_dict = [];
        foreach($objs as $obj)
        {
            $obj_dict[$obj->value] = $obj->name;
        }
        return $obj_dict;
    }
}
