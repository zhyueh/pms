<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BugHistory extends Model
{
    use SoftDeletes;
    //
    protected $table="bug_history";

    protected $fillable=[
        "bug_id",
        "comment"
        ];

    public function created_user()
    {
        return $this->hasOne('App\User', "id", "created_by");
    }
}
