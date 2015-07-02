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

    public function bugs()
    {
        return $this->hasMany('App\Http\Models\Project\Bug');
    }

    public function test_cases()
    {
        return $this->hasManyThrough(
            'App\Http\Models\Project\TestCase',
            'App\Http\Models\Project\Story'
        );
    }

    public function updateDevplans()
    {
        $this->dev_plan_num = 0;
        $this->completed_plan_num = 0;

        foreach ($this->storys as $story)
        {
            foreach($story->dev_plans as $dev_plan)
            {
                $this->dev_plan_num += 1;
                if (!empty($dev_plan->complete_at))
                {
                    $this->completed_plan_num+= 1;
                }
            }
        }
    }

    public function updateBugs()
    {
        $bugs = 0;
        $fix_bugs = 0;
        /*
        foreach($this->test_cases as $test_case)
        {
            $bugs += count($test_case->bugs);
            foreach($test_case->bugs as $bug)
            {
                if (!empty($bug->fix_time ))
                {
                    $fix_bugs += 1;
                }
            }
        }
         */

        foreach($this->bugs as $bug)
        {
            $bugs += 1;
            if (!empty($bug->fix_time ))
            {
                $fix_bugs += 1;
            }
        }

        $this->bugs = $bugs;
        $this->fix_bugs = $fix_bugs;
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
