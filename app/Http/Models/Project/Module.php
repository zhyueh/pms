<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;
    //
    protected $table = 'module';

    protected $fillable = ['module_name', 'project_id'];

    public static function dict($project_id)
    {
        if($project_id < 1)
        {
            $objs = Module::get();
        }
        else
        {
            $objs = Module::where("project_id", $project_id)->get();
        }
        $obj_dict = [];
        foreach( $objs as $obj)
        {
            $obj_dict[$obj->id] = $obj->module_name;
        }
        return $obj_dict;
    }
}
