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

    public function project()
    {
        return $this->belongsTo('App\Http\Models\Project\Project');
    }

    public function storys()
    {
        return $this->hasMany('App\Http\Models\Project\Story');
    }

    public static function dict($project_id)
    {
        if ($project_id < 1)
        {
            $objs = Version::orderBy('id', 'desc')->get();
        }
        else
        {
            $objs = Version::with("project")->where("project_id", $project_id)->orderBy('id', 'desc')->get();
        }
        $obj_dict = [];
        foreach( $objs as $obj)
        {
            $obj_dict[$obj->id] = $obj->project->project_name."::".$obj->version_name;
        }
        return $obj_dict;
    }
}
