<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Http\Models\DictModel;
class Story extends DictModel
{
    use SoftDeletes;
    //
    
    protected $table = 'story';
    protected $fillable = ["story_name", "project_id", "module_id", "version_id", "description", "requirement", "remark", "priority", "status"];

    public function comments()
    {
        return $this->hasMany('App\Http\Models\Project\StoryComment');
    }

    public function project()
    {
        return $this->belongsTo('App\Http\Models\Project\Project');
    }

    public function version()
    {
        return $this->belongsTo('App\Http\Models\Project\Version');
    }

    public function dev_plans()
    {
        return $this->hasMany('App\Http\Models\Project\DevPlan');
    }

    public function test_cases()
    {
        return $this->hasMany('App\Http\Models\Project\TestCase');
    }

    public function dict($id = 0)
    {
        if ($id< 1)
        {
            return $this->genDict(Story::get());
        }
        return $this->genDict(Story::where('id', $id)->get());
    }

    public function dictByVersion($id)
    {
        return $this->genDict(Story::where('version_id', $id)->get());
    }
}
