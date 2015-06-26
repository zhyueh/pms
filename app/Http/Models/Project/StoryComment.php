<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoryComment extends Model
{
    use SoftDeletes;
    //
    
    protected $table = 'story_comment';
    protected $fillable = ['story_id', 'team_id', 'description', 'difficult', 'work_hour'];
}
