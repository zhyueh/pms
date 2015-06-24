<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model
{
    use SoftDeletes;
    //
    protected $table="version";

    protected $fillable = ["version_name", "project_id"];

    public static function dict($project_id)
    {
        if ($project_id < 1)
        {
            $objs = Version::get();
        }
        else
        {
            $objs = Version::where("project_id", $project_id)->get();
        }
        $obj_dict = [];
        foreach( $objs as $obj)
        {
            $obj_dict[$obj->id] = $obj->version_name;
        }
        return $obj_dict;
    }
}
