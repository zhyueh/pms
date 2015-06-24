<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;
    //
    
    protected $table = 'team';
    protected $fillable = ['team_name', 'project_id'];

    public function member()
    {
        return $this->belongsToMany('App\User', 'team_member', 'team_id', 'user_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Http\Models\Project\Project');
    }
}
