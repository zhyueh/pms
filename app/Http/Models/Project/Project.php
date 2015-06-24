<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $table="project";

    protected $fillable = ['project_name'];
    //
    //
    public function modules()
    {
        return $this->hasMany('App\Http\Models\Project\Module');
    }

    public function versions()
    {
        return $this->hasMany('App\Http\Models\Project\Version');
    }

    public function teams()
    {
        return $this->hasMany('App\Http\Models\Project\Team');
    }

    public function storys()
    {
        return $this->hasMany('App\Http\Models\Project\Story');
    }

    public static function dict()
    {
        $projects = Project::get();
        $project_dict = [];
        foreach($projects as $project)
        {
            $project_dict[$project->id] = $project->project_name;
        }
        return $project_dict;

    }



}
