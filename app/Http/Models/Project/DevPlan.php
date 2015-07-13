<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DevPlan extends Model
{
    use SoftDeletes;
    //
    
    protected $table = 'dev_plan';
    protected $fillable = [
        'dev_plan_name',
        'story_id',
        'team_id',
        'owner_id',
        'plan_start_at',
        'plan_complete_at',
        'start_at',
        'complete_at',
        'status',
        'remark',
        'priority',
        'work_hour',
        'dev_plan_type',
        'description',
    ];

    public function owner()
    {
        return $this->hasOne('App\User', "id", "owner_id");
    }

    public function story()
    {
        return $this->belongsTo('App\Http\Models\Project\Story');
    }

    public function team()
    {
        return $this->belongsTo('App\Http\Models\Project\Team');
    }
}
