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
}
