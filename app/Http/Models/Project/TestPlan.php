<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestPlan extends Model
{
    use SoftDeletes;
    //
    
    protected $table = 'test_plan';
    protected $fillable = [
        "test_plan_name",
        "version_id",
    ];

    public function version()
    {
        return $this->belongsTo('App\Http\Models\Project\Version');
    }
}
