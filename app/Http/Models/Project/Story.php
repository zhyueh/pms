<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model
{
    use SoftDeletes;
    //
    
    protected $table = 'story';
    protected $fillable = ["story_name", "project_id", "module_id", "version_id", "description", "requirement", "remark", "priority", "status"];
}
