<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bug extends Model
{
    use SoftDeletes;
    //
    
    protected $table = 'bug';
    protected $fillable = [
        "test_case_id",
        "version_id",
        "bug_name",
        "team_id",
        "owner_id",
        "description",
        "requirement",
        "status",
        "serverity",
        "priority",
    ];

    public function historys()
    {
        return $this->hasMany('App\Http\Models\Project\BugHistory');
    }
}
